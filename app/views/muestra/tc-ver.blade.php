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
        <div class="col-md-12">
            <h2>{{ $item -> titulo }}</h2>
            <a class="volveraSeccion" href="{{URL::to('/'.$item -> seccionItem() -> menuSeccion() -> url)}}">Volver a {{ $item -> seccionItem() -> menuSeccion() -> nombre }}</a>
            @if(Auth::check())
                @if(Auth::user()->can("editar_item"))
                <a href="{{URL::to('admin/muestra/editar/'.$item->muestra()->id)}}" data='{{$item -> seccionItem() -> id}}' style="display:none">Editar<i class="fa fa-pencil fa-lg"></i></a>
                @endif
            @endif
        </div>
    </div>
    <div class="clear"></div>
    <div class="row">
        <div class="col-md-3">
            @if(count($item->imagen_destacada()) > 0)
                <a href="#"><img src="{{ URL::to($item->imagen_destacada()->carpeta.$item->imagen_destacada()->nombre) }}" alt="{{$item->titulo}}"></a>
                {{-- <p>{{$item->imagen_destacada()->epigrafe}}</p> --}}
            @else
                <img src="{{ URL::to('images/sinImg.gif') }}" alt="{{$item->titulo}}">
            @endif
        </div>
        @foreach($item->imagenes as $img)
            <div class="col-md-3">
                <a href="#"><img src="{{ URL::to($img->carpeta.$img->nombre) }}" alt="{{$item->titulo}}"></a>
                {{-- <p>{{$img->epigrafe}}</p> --}}
            </div>
        @endforeach
    </div>
    <div class="clear"></div>
    <div class="row">
        <div class="col-md-12">
            {{ $item->muestra()->cuerpo }}
        </div>
    </div>
        
</section>
@stop