@extends($project_name.'-master')

@section('contenido')
@if(Session::has('mensaje'))
<script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
@endif
<section class="container">
    @if (Session::has('mensaje'))
        <div class="divAlerta ok alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
    @endif
    <div class="row">
        <div class="col-md-12 marginBottom2">
            <h2>{{ $item -> titulo }}</h2>
            <a class="volveraSeccion" href="{{URL::to('/'.$item -> seccionItem() -> menuSeccion() -> url)}}"><i class="fa fa-caret-left"></i>Volver a {{ $item -> seccionItem() -> menuSeccion() -> nombre }}</a>
            @if(Auth::check())
                @if(Auth::user()->can("editar_item"))
                <a href="{{URL::to('admin/portfolio_completo/editar/'.$item->portfolio()->portfolio_completo()->id)}}" data='{{$item -> seccionItem() -> id}}' style="display:none">Editar<i class="fa fa-pencil fa-lg"></i></a>
                @endif
            @endif
        </div>
    </div>
    <div class="clear"></div>
    <div class="row marginBottom2">
        <div class="col-md-3">
            <div class="thumbnail">
                @if(count($item->imagen_destacada()) > 0)
                    <a class="fancybox" href="{{URL::to($item->imagen_destacada()->ampliada()->carpeta.$item->imagen_destacada()->ampliada()->nombre)}}" title="{{ $item->imagen_destacada()->ampliada()->epigrafe }}" rel='group'><img src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}" alt="{{$item->titulo}}"></a>
                    {{-- <p>{{$item->imagen_destacada()->epigrafe}}</p> --}}
                @else
                    <a class="fancybox" href="{{ URL::to('images/sinImg.gif') }}" title="{{$item->titulo}}" rel='group'><img src="{{ URL::to('images/sinImg.gif') }}" alt="{{$item->titulo}}"></a>
                @endif
            </div>
        </div>
        @foreach($item->imagenes as $img)
            <div class="col-md-3">
                <div class="thumbnail">
                    <a class="fancybox" href="{{URL::to($img->ampliada()->carpeta.$img->ampliada()->nombre)}}" title="{{ $img->ampliada()->epigrafe }}" rel='group'><img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}"></a>
                    {{-- <p>{{$img->epigrafe}}</p> --}}
                </div>
            </div>
        @endforeach
    </div>
    <div class="clear"></div>
    <div class="row ">
        <div class="col-md-12 divCuerpoTxt">
            {{ $item->portfolio()->portfolio_completo()->cuerpo }}
        </div>
    </div>
    
    @if(count($item->videos) > 0)
        <div class="row ">
            <div class="col-md-12">
                <h3>Videos</h3>
            </div>
        </div>
        <div class="row">
            @foreach($item->videos as $video)
                <div class="col-md-4">
                    <iframe class="video-tc" src="https://www.youtube.com/embed/{{ $video->url }}"></iframe>
                </div>
            @endforeach
        </div>
    @endif
</section>
@stop