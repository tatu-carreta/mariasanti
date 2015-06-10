@extends($project_name.'-master')

@section('contenido')
<style>
    .check_box {
    display:none;
}

.noTocado{
    background:url('{{URL::to("images/destacadoAzul.png")}}') no-repeat;
    height: 30px;
    width: 30px;
    display: inline-block;
    padding: 0 0 0 2em;
}

.tocado{
    background:url('{{URL::to("images/destacadoRojo.png")}}') no-repeat;
    height: 30px;
    width: 30px;
    display: inline-block;
    padding: 0 0 0 2em;
}

</style>
<script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
<script src="{{URL::to('js/producto-funcs.js')}}"></script>
<section class="container">
    {{ Form::open(array('url' => 'admin/producto/editar', 'files' => true)) }}
        <h2 class="marginBottom2"><span>Carga y modificación de productos</span></h2>

    <div class="row marginBottom2">    
        <!-- abre datos del Producto-->
        <div class="col-md-8 datosProductos">
            <h3>Nombre y modelo del producto</h3>
            <div class="form-group marginBottom2">
                <input class="form-control" type="text" name="titulo" placeholder="Título" required="true" value="{{ $item->titulo }}" maxlength="50">
            </div>
            <div class="fondoDestacado marginBottom2">
                <div class="marginBottom1 class_checkbox">
                    <label for="destacarProducto" class="destacarProducto @if($item->destacado()) tocado @else noTocado @endif">
                        <input id="destacarProducto" class="precioDisabled check_box" type="checkbox" name="item_destacado" value="A" @if($item->destacado())checked="true"@endif>
                        <span class="spanDestacarProd">Destacar este producto</span>
                    </label>
                </div>
                <p>Los últimos 5 productos destacados se muestran en la home.<br>
                    Los productos destacados deben tener precio</p>

                <div class="form-group">
                    <label for="precio">Precio</label><span>$</span>
                    <input type="text" name="precio" placeholder="Precio" disabled="true" class="precioAble" value="@if($item->destacado()){{ $producto->precio(2) }}@endif">
                </div>
            </div>
            
            <h3>Secciones</h3>
            @foreach($menues as $men)
                @if(count($men->children) == 0)
                    <h5>{{$men->nombre}}</h5>

                    @foreach($men->secciones as $seccion)
                        <input type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if(in_array($seccion->id, $item->secciones->lists('id'))) checked="true" @endif>@if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif
                    @endforeach
                @endif
            @endforeach
        </div>
        <!-- Cierra columna ancha -->


        <!-- Columna 60% imágenes-->
        <div class="col-md-4 fondoDestacado cargaImg">
            <h3>Imagen principal</h3>
            @if(!is_null($item->imagen_destacada()))
                <div class="divCargaImgProducto">
                    <div class="marginBottom1 divCargaImg">
                        <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}">
                        <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                    </div>
                    <input type="hidden" name="imagen_producto_editar" value="{{$item->imagen_destacada()->id}}">
                    <input class="form-control" type="text" name="epigrafe_imagen_producto_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->epigrafe }}">
                </div>
            @else
                @include('imagen.modulo-imagen-euge')
            @endif
        </div>
        <!-- fin Columna imágenes-->
    </div>

        <div class="clear"></div>

        <div class="punteado">
            <input type="submit" value="Guardar" class="btn btn-primary marginRight5">
            <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
        </div>

        {{Form::hidden('continue', $continue)}}
        {{Form::hidden('id', $item->id)}}
        {{Form::hidden('producto_id', $producto->id)}}
        {{Form::hidden('descripcion', '')}}
        {{Form::hidden('tipo_precio_id[]', '2')}}
    {{Form::close()}}
</section>
@stop
