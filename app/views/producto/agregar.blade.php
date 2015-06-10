@extends($project_name.'-master')

@section('head')

    @parent

    <link rel="stylesheet" href="{{URL::to('css/ng-img-crop.css')}}" />
@stop

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
        {{ Form::open(array('url' => 'admin/producto/agregar', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Carga y modificación de productos</span></h2>
            <div id="error" class="error" style="display:none"><span></span></div>
            <div id="correcto" class="correcto ok" style="display:none"><span></span></div>

        <div class="row marginBottom2">
            <!-- Abre columna de descripción -->
            <div class="col-md-8 datosProductos">
                <h3>Nombre y modelo del producto</h3>
                <div class="form-group marginBottom2">
                    <input class="form-control" type="text" name="titulo" placeholder="Código" required="true" maxlength="50">
                </div>

                <div class="fondoDestacado marginBottom2">
                    <div class="class_checkbox marginBottom1">
                        <label for="destacarProducto" class="destacarProducto noTocado">
                            <input id="destacarProducto" class="precioDisabled check_box" type="checkbox" name="item_destacado" value="A">
                            <span class="spanDestacarProd">Destacar este producto</span>
                        </label>
                    </div>

                    <p>Los últimos 5 productos destacados se muestran en la home.<br>
                        Los productos destacados deben tener precio</p>

                    <div class="form-group">
                        <label for="precio">Precio</label><span>$</span>
                        <input type="text" name="precio" disabled="true" class="precioAble"> 
                    </div>
                </div>

                <h3>Secciones</h3>
                @foreach($menues as $men)
                    @if(count($men->children) == 0)
                        <h5>{{$men->nombre}}</h5>

                        @foreach($men->secciones as $seccion)
                            <input type="checkbox" name="secciones[]" value="{{$seccion->id}}" @if($seccion->id == $seccion_id) checked="true" disabled @endif>@if($seccion->titulo != ""){{$seccion->titulo}}@else Sección {{$seccion->id}} @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <!-- Abre columna de imágenes -->
            <div class="col-md-4 fondoDestacado cargaImg">
                <h3>Imagen principal</h3>
                @include('imagen.modulo-imagen-angular-crop')
            </div>

            <div class="clear"></div>
            <!-- cierran columnas -->


        </div>  
            

            <div class="punteado">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('seccion_id', $seccion_id)}}
            {{Form::hidden('descripcion', '')}}
            {{Form::hidden('tipo_precio_id[]', '2')}}
        {{Form::close()}}
    </section>
@stop

@section('footer')

    @parent

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop