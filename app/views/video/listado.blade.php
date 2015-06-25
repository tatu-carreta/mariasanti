@extends($project_name.'-master')

@section('contenido')
<section class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Videos</h3>
        </div>
    </div>
    
    <div class="row">
        @foreach($videos as $video)
        <div class="col-md-3">
            <iframe src="https://www.youtube.com/embed/{{ $video->url }}"></iframe>
        </div>
        @endforeach
    </div>
</section>

@stop