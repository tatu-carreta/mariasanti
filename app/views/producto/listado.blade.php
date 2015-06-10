<div class="row sortable">
@foreach($seccion -> items as $i)

    <div class="col-md-3">
        <div class="thumbnail">
        @if(Auth::check())
            <div class="iconos">
            <span class="pull-left">
                @if(!$i->producto()->nuevo())
                    @if(Auth::user()->can("destacar_item"))
                        <i onclick="destacarItemSeccion('{{URL::to('admin/producto/nuevo')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack fa-lg"></i>
                    @endif
                @else
                    @if(Auth::user()->can("quitar_destacado_item"))
                        <i onclick="destacarItemSeccion('{{URL::to('admin/item/quitar-destacado')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack prodDestacado fa-lg"></i>
                    @endif
                @endif
                @if(!$i->producto()->oferta())
                    @if(Auth::user()->can("destacar_item"))
                        <a href="{{URL::to('admin/producto/oferta/'.$i->producto()->id.'/'.$seccion->id.'/seccion')}}" class="destacarProducto"><i  class="fa fa-thumb-tack fa-lg"></i></a>
                    @endif
                @else
                    @if(Auth::user()->can("quitar_destacado_item"))
                        <i onclick="destacarItemSeccion('{{URL::to('admin/item/quitar-destacado')}}', '{{$seccion->id}}', '{{$i->id}}');" class="fa fa-thumb-tack prodDestacado fa-lg"></i>
                    @endif
                @endif
                </span>
                <span class="pull-right">
                    @if(Auth::user()->can("editar_item"))
                        <a href="{{URL::to('admin/producto/editar/'.$i->producto()->id.'/seccion')}}" data='{{$seccion->id}}'><i class="fa fa-pencil fa-lg"></i></a>
                    @endif
                    @if(Auth::user()->can("borrar_item"))
                        <i onclick="borrarData('{{URL::to('admin/item/borrar')}}', '{{$i->id}}');" class="fa fa-times fa-lg"></i>
                    @endif
                </span>
                <div class="clearfix"></div>
            </div>
        @endif
{{--
        @if($i->producto()->nuevo())
        <h2>NUEVO</h2>
        @elseif($i->producto()->oferta())
        <h2>OFERTA</h2>
        @endif
--}}
        @if(!Auth::check())
            <a href="{{URL::to('producto/'.$i->url)}}">
        @endif
               <img class="lazy" data-original="@if(!is_null($i->imagen_destacada())){{ URL::to($i->imagen_destacada()->carpeta.$i->imagen_destacada()->nombre) }}@else{{URL::to('images/sinImg.gif')}}@endif" alt="{{$i->titulo}}">
        @if(!Auth::check())
            </a>
        @endif

        <div class="bandaProd @if($i->producto()->nuevo()) nuevos @elseif($i->producto()->oferta()) ofertas @endif">
            <p class="pull-left">{{ $i->titulo }}</p>
            {{-- <p class="marca">Marca: @if(!is_null($i->producto()->marca_principal())){{$i->producto()->marca_principal()->nombre}}@endif</p> --}}
            @if($c = Cart::search(array('id' => $i->producto()->id)))
                <a class="carrito btn btn-default pull-right" href="{{URL::to('carrito/borrar/'.$i->producto()->id.'/'.$c[0].'/seccion')}}">Quitar de Carrito</a>
            @else
                <a href="{{URL::to('carrito/agregar/'.$i->producto()->id.'/seccion')}}" class="btn btn-default pull-right"><i class="fa fa-plus"></i>Presupuestar</a>
                {{-- <a class="carrito btn btn-default pull-right" href="{{URL::to('carrito/agregar/'.$i->producto()->id)}}">Agregar Carrito</a> --}}
            @endif
            <div class="clearfix"></div>
        </div>
        @if($i->producto()->oferta())
            <span class="precio">Oferta: ${{$i->producto()->precio(1)}} ${{$i->producto()->precio(2)}}</span>
        @elseif($i->producto()->nuevo())
            <span>NUEVO</span>
        @endif

        {{-- <a class="detalle" href="{{URL::to('producto/'.$i->url)}}">Detalle</a>	--}}
        @if(Auth::check())
            <input type="hidden" name="orden[]" value="{{$i->id}}">
        @endif            		
        </div>
    </div>

@endforeach
</div>