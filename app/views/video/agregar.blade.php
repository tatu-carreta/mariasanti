@extends($project_name.'-master')

@section('contenido')
    <section class="container">
        {{ Form::open(array('url' => 'admin/video/agregar/youtube', 'files' => true, 'role' => 'form')) }}
            <h2 class="marginBottom2"><span>Carga y modificación de videos</span></h2>

            <div class="row marginBottom2">
                <!-- Abre columna de descripción -->
                <div class="col-md-8">
                    <h3>URL del Video</h3>
                    <div class="form-group marginBottom2">
                        <input class="form-control" type="text" name="video" placeholder="URL Video Youtube" required="true">
                    </div>
                </div>
            </div>  


            <div class="punteado">
                <input type="submit" value="Publicar" class="btn btn-primary marginRight5">
                <a onclick="window.history.back();" class="btn btn-default">Cancelar</a>
            </div>
            {{Form::hidden('item_id', $item_id)}}
        {{Form::close()}}
    </section>
@stop
