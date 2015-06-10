@extends($project_name.'-master')

@section('head')@stop
@section('header')@stop

@section('contenido')
<div class="modal">
    {{ Form::open(array('url' => 'admin/producto/oferta')) }}
    <h2>destacar producto</h2>
    <input class="block anchoTotal marginBottom" type="text" name="precio_antes" placeholder="Precio Anterior" required="true">
    <input class="block anchoTotal marginBottom" type="text" name="precio_actual" placeholder="Precio Actual" required="true">
    <div class="floatRight">
        <a onclick="cancelarPopup('destacar-producto');" class="btnGris marginRight5">Cancelar</a>
        <input type="submit" value="Guardar" class="btn">
    </div>
    {{Form::hidden('continue', $continue)}}
    {{Form::hidden('producto_id', $producto->id)}}
    {{Form::hidden('seccion_id', $seccion_id)}}
    {{Form::close()}}
</div>
@stop

@section('footer')@stop