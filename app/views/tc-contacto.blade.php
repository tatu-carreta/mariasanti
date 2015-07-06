@extends($project_name.'-master')

@section('contenido')
<section class="container">
	<div class="row">
		<div class="col-md-12 marginBottom2">
			<h2>Contacto</h2>
		</div>
	</div>

	<div class="row">
	    <div class="col-md-6">
    		<div class="col-info">
		        <div class="textocolumnaizquierda">
		            <h3>Representación exclusiva</h3>
		            <p>PRAXIS INTERNATIONAL ART <br> <a href="http://www.praxis-art.com">www.praxis-art.com</a></p>
		        </div>
		    </div>
	    </div>

	    <div class="col-md-6">
    		<div class="col-form">
		        <div class="formulario">
		            {{Form::open(array('url' => 'consulta', 'class' => 'contact_form'))}}
		                <div>  
		                    <ul>  
		                        <li>  
		                            <span class="required_notification"></span>  
		                        </li>  
		                        <li>  
		                            <label for="name">Nombre y apellido</label><br>  
		                            <input class="form-control" name="nombre" type="text" id="name" required>
		                        </li></br>
		                        <li>  
		                            <label for="email">Email</label><br>  
		                            <input class="form-control" name="email" type="email" id="email" required>
		                        </li></br>
		                        <li>  
		                            <label for="message">Comentarios</label><br>  
		                            <textarea class="form-control" name="consulta" id="message"></textarea>
		                        </li></br>
		                        <li>  
		                            <button class="btn btn-default submit" type="submit">Enviar</button>  
		                        </li>  
		                    </ul>  
		                </div>  
		            {{Form::close()}}
		        </div>
		    </div>
	    </div>
	</div>

</section>
@stop