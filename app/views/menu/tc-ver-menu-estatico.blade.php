@extends($project_name.'-master')

@section('contenido')
    @if(Auth::check())
        <script src="{{URL::to('js/popupFuncs.js')}}"></script>
    @endif
    <section class="container">
        <div class="row">
            <div class="col-md-12 marginBottom2">
                <h2>{{ $menu -> nombre }}</h2>
            </div>
        </div>
        
        @if(Auth::check())
            @if(Auth::user()->can("ordenar_seccion_estatica"))
                @if(count($menu->secciones) >= 2)
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{URL::to('admin/seccion/ordenar-por-menu/'.$menu->id)}}" class="btn pull-right popup-nueva-seccion"><i class="fa fa-exchange fa-lg"></i>Ordenar secciones</a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                @endif
            @endif
        @endif

        @if(Auth::check())
            @if(Auth::user()->can("ver_menu_estatico_admin"))
            <div class="row">
                <div class="col-md-12 fondoDestacado text-center menuInsertContenido">       
                    @if(Auth::user()->can("agregar_slide"))
                       <a href="{{URL::to('admin/slide/agregar/'.$menu->id.'/E')}}" class="btn btn-primary popup-nueva-seccion">Agregar slide</a>
                    @endif
                    @if(Auth::user()->can("agregar_slide"))
                        <a href="{{URL::to('admin/slide/agregar/'.$menu->id.'/I')}}" class="btn btn-primary popup-nueva-seccion">Agregar slide en Index</a>
                    @endif
                    @if(Auth::user()->can("agregar_galeria"))
                        <a href="{{URL::to('admin/galeria/agregar/'.$menu->id)}}" class="btn btn-primary popup-nueva-seccion">Agregar galería</a>
                    @endif
                    @if(Auth::user()->can("agregar_texto"))
                        <a href="{{URL::to('admin/texto/agregar/'.$menu->id)}}" class="btn btn-primary popup-nueva-seccion">Agregar texto</a> 
                    @endif
                    @if(Auth::user()->can("agregar_html"))
                        <a href="{{URL::to('admin/html/agregar/'.$menu->id)}}" class="btn btn-primary popup-nueva-seccion">Agregar HTML</a>
                    @endif
                </div>
            </div>
            <div class="clearfix"></div>
            @endif
        @endif

        @foreach($menu -> secciones as $seccion)
            @if((count($seccion->items) > 0) || (count($seccion->slides) > 0))
                @include('seccion.'.$project_name.'-ver-seccion-estatica')
            @endif
        @endforeach

        <div class="clearfix"></div>
        @if(Auth::check())
            <div class="modal fade" id="nueva-seccion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="width: 900px !important;">
                    <div class="modal-content">
                        
                    </div>
                </div>
            </div>
        @endif
    </section>
@stop