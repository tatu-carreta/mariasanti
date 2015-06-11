@extends($project_name.'-master')

@section('head')

    @parent

    <link rel="stylesheet" href="{{URL::to('css/ng-img-crop.css')}}" />
@stop

@section('contenido')
    <script src="{{URL::to('js/ckeditorLimitado.js')}}"></script>
    @if (Session::has('mensaje'))
        <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    @endif
    <section class="container">
        {{ Form::open(array('url' => 'admin/muestra/editar', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Carga y modificación de muestra</span></h2>
        
            @if(Auth::user()->can('cambiar_seccion_item'))
                <select name="seccion_nueva_id">
                    <option value="">Seleccione Nueva Sección</option>
                    @foreach($secciones as $seccion)
                        <option value="{{$seccion->id}}" @if($seccion->id == $item->seccionItem()->id) selected @endif>@if($seccion->nombre != ""){{$seccion->nombre}}@else Sección {{$seccion->id}} - {{$seccion->menuSeccion()->nombre}}@endif</option>
                    @endforeach
                </select>
            @endif
            
            <h3>Título de la muestra</h3>
            <input class="block anchoTotal marginBottom" type="text" name="titulo" placeholder="Título" required="true" value="{{ $item->titulo }}" maxlength="50">
            
            <div class="row marginBottom2">
                <!-- Abre columna de imágenes -->
                <div class="col-md-4 fondoDestacado cargaImg">
                    <h3>Imagen principal</h3>
                    @if(!is_null($item->imagen_destacada()))
                        <div class="divCargaImgProducto">
                            <div class="marginBottom1 divCargaImg">
                                <img alt="{{$item->titulo}}"  src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}">
                                <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                            </div>
                            <input type="hidden" name="imagen_portada_editar" value="{{$item->imagen_destacada()->id}}">
                            <input class="block anchoTotal marginBottom" type="text" name="epigrafe_imagen_portada_editar" placeholder="Ingrese una descripción de la foto" value="{{ $item->imagen_destacada()->epigrafe }}">
                        </div>
                    @else
                        @include('imagen.modulo-imagen-angular-crop')
                    @endif
                    
                </div>

                <div class="clear"></div>
                <!-- cierran columnas -->
            </div>  
            
            <h3>Cuerpo</h3>
            <div class="divEditorTxt marginBottom2">
                <textarea id="texto" contenteditable="true" name="cuerpo">{{ $item->muestra()->cuerpo }}</textarea>
            </div>
            

            <div class="punteado">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('muestra_id', $muestra->id)}}
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
