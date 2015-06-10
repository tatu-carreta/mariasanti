@extends($project_name.'-master')

@section('footer_consulta_form')
<div class="clear"></div>
@stop

@section('contenido')
<section>
    @if (Session::has('mensaje'))
    <div class="divAlerta ok alert-success">{{ Session::get('mensaje') }}<i onclick="" class="cerrarDivAlerta fa fa-times fa-lg"></i></div>
    @endif
    <div>
        <table>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Borrar</th>
            </tr>
            @if(Cart::count()>0)
                @foreach(Cart::content() as $producto)
                <tr>
                    <td><img class="lazy" data-original="@if(!is_null($producto->producto->item()->imagen_destacada())){{ URL::to($producto->producto->item()->imagen_destacada()->carpeta.$producto->producto->item()->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$producto->producto->item()->titulo}}"></td>
                    <td>{{ $producto->producto->item()->titulo }}</td>
                    <td><input class="cant_prod_carrito" type="text" name="cantidad" value="{{ $producto->qty }}" data='{{ $producto->rowid }}' id="{{ $producto->id }}"></td>
                    <td><a href="{{URL::to('carrito/borrar/'.$producto->id.'/'.$producto->rowid.'/carrito')}}">Borrar</a></td>
                </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td><a href="{{ URL::to('carrito/borrar') }}">Borrar Carrito</a></td>
                    <td></td>
                    <td>${{Cart::total()}}</td>
                </tr>
            @endif
        </table>
    </div>
</section>
@stop