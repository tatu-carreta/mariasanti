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
    <section class="container" id="ng-app" ng-app="app">
        <div ng-controller="ImagenMultiple" nv-file-drop="" uploader="uploader" filters="customFilter, sizeLimit">
        {{ Form::open(array('url' => 'admin/portfolio_completo/editar', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Editar obra</span></h2>
        
            @if(Auth::user()->can('cambiar_seccion_item'))
                <select name="seccion_nueva_id">
                    <option value="">Seleccione Nueva Sección</option>
                    @foreach($secciones as $seccion)
                        <option value="{{$seccion->id}}" @if($seccion->id == $item->seccionItem()->id) selected @endif>@if($seccion->nombre != ""){{$seccion->nombre}}@else Sección {{$seccion->id}} - {{$seccion->menuSeccion()->nombre}}@endif</option>
                    @endforeach
                </select>
            @endif
            
            <h3>Título de la obra</h3>
            <div class="form-group marginBottom2">
                <input class="form-control" type="text" name="titulo" placeholder="Título de la obra" required="true" value="{{ $item->titulo }}" maxlength="50">
            </div>
            
            <div class="row marginBottom2">
                <!-- Abre columna de imágenes -->
                <div class="col-md-12 cargaImg">
                	<div class="fondoDestacado">
	                    <h3>Recorte de imágenes</h3>
	                    @include('imagen.modulo-imagen-angular-crop-horizontal-multiples')
    	                <div class="row">
                            <div class="col-md-12">
                                <h3>Imágenes seleccionadas</h3>
                            </div>
                            @if(count($item->imagen_destacada()) > 0)
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <input type="hidden" name="imagen_crop_editar[]" value="{{$item->imagen_destacada()->id}}">
                                        <img src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}" alt="{{$item->titulo}}">
                                        <input type="text" name="epigrafe_imagen_crop_editar[]" value="{{$item->imagen_destacada()->epigrafe}}">
                                        <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$item->imagen_destacada()->id}}');" class="fa fa-times fa-lg"></i>
                                    </div>
                                </div>
                            @endif
                            @foreach($item->imagenes as $img)
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <input type="hidden" name="imagen_crop_editar[]" value="{{$img->id}}">
                                        <img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}">
                                        <input type="text" name="epigrafe_imagen_crop_editar[]" value="{{$img->epigrafe}}">
                                        <i onclick="borrarImagenReload('{{ URL::to('admin/imagen/borrar') }}', '{{$img->id}}');" class="fa fa-times fa-lg"></i>
                                    </div>
                                </div>
                            @endforeach
                            <div ng-repeat="img in imagenes_seleccionadas">
                                <div class="col-md-3">
                                    <div class="thumbnail">
                                        <input type="hidden" name="imagen_portada_ampliada[]" value="<% img.imagen_portada_ampliada %>">
                                        <img ng-src="<% img.src %>">
                                        <input type="hidden" name="epigrafe_imagen_portada[]" value="<% img.epigrafe %>">
                                        <input type="hidden" name="imagen_portada_crop[]" value="<% img.imagen_portada %>">
                                        <i ng-click="borrarImagenCompleto($index)" class="fa fa-times fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="row">
                <div class="col-md-12">
                    <h3>Texto descriptivo de la obra</h3>
                    <div class="divEditorTxt marginBottom2">
                        <textarea id="texto" contenteditable="true" name="cuerpo">{{ $item->portfolio()->portfolio_completo()->cuerpo }}</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h3>Videos</h3>
                </div>
            </div>
            <div class="row">
                @foreach($item->videos as $video)
                    <div class="col-md-4">
                        <iframe class="video" src="https://www.youtube.com/embed/{{ $video->url }}"></iframe>
                        <i onclick="borrarImagenReload('{{ URL::to('admin/video/borrar') }}', '{{$video->id}}');" class="fa fa-times fa-lg"></i>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(count($item->videos) == 2)
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                    @elseif(count($item->videos) == 1)
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                    @elseif(count($item->videos) == 0)
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                        <div class="form-group marginBottom2">
                            <input class="form-control" type="text" name="video[]" placeholder="URL de video">
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="borderTop">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>


            {{Form::hidden('continue', $continue)}}
            {{Form::hidden('id', $item->id)}}
            {{Form::hidden('portfolio_completo_id', $portfolio_completo->id)}}
        {{Form::close()}}
        </div>
    </section>
@stop

@section('footer')

    @parent

    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.0/angular.min.js"></script>
    <script src="{{URL::to('js/angular-file-upload.js')}}"></script>
    <script src="{{URL::to('js/ng-img-crop.js')}}"></script>
    <script src="{{URL::to('js/controllers.js')}}"></script>

@stop
