@extends($project_name.'-master')

@section('contenido')
<section class="container">
    <div class="columnaizquierda">
        <div class="textocolumnaizquierda">
            <h3>Representación exclusiva</h3>
            <p>PRAXIS INTERNATIONAL ART <br> www.praxis-art.com</p>
        </div>
    </div>
    <div class="columnaderecha">
        <div class="formulario">
            {{Form::open(array('url' => 'consulta', 'class' => 'contact_form'))}}
                <div>  
                    <ul>  
                        <li>  
                            <span class="required_notification"></span>  
                        </li>  
                        <li>  
                            <label for="name">Nombre y apellido</label><br>  
                            <input name="nombre" type="text" required>
                        </li></br>
                        <li>  
                            <label for="name">email</label><br>  
                            <input name="email" type="email" required>
                        </li></br>
                        <li>  
                            <label for="message">Comentarios</label><br>  
                            <textarea name="consulta"></textarea>
                        </li></br>
                        <li>  
                            <button class="submit" type="submit">Enviar</button>  
                        </li>  
                    </ul>  
                </div>  
            {{Form::close()}}
        </div>
    </div>
</section>
@stop