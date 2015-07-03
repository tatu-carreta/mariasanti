@extends($project_name.'-master')

@section('contenido')

    <div id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
        </ol>

        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill imagenslider1"></div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill imagenslider2"></div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill imagenslider3"></div>
            </div>
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill imagenslider4"></div>
            </div>
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill imagenslider5"></div>
            </div>
        </div>
    </div>

@stop