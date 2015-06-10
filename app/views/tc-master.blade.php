<!Doctype html>
<html lang="es">
    <head>
        @section('head')
        <meta charset="UTF-8">
        <title>MariaSanti</title>

        <!-- abre LINK -->
        <link href="favicon.ico" rel="shortcut icon">
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
        <meta name="description" content="">
        <meta name="Keywords" content="">
        <meta property="og:image" content="" />
        <meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1">
        
        <!-- B O O T S T R A P -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="{{URL::to('bootstrap-3.3.4-dist/css/bootstrap.css')}}">
        
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/jquery-ui.css')}}">
        <link rel="stylesheet" href="{{URL::to('font-awesome-4.2.0/css/font-awesome.css')}}">
        <link href="{{URL::to('css/jquery.Jcrop.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{URL::to('css/owl.carousel.css')}}">
        <link rel="stylesheet" href="{{URL::to('css/owl.theme.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/base.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{URL::to('css/stylesOffitec.css')}}"> 
        
        <!-- M O D E R N I Z R -->
        <script src="{{URL::to('js/modernizr.custom.05470.js')}}"></script>
        
        <!-- abre SCRIPT -->
        <script src="{{URL::to('js/jquery-1.11.2.min.js')}}"></script>
        <script src="{{URL::to('js/jquery-ui.min.js')}}"></script>
        <script src="{{URL::to('js/funcs.js')}}"></script>
        
        @show
    </head>
    <body>
        @section('header')
            @include('analyticstracking')
            <!-- abre H E A D E R -->
            @if(Auth::check())
            <div class="headerAdmin">
                @if((Auth::user()->hasRole('Superadmin')) || (Auth::user()->hasRole('Administrador')))
                <div class="divAdministrar">
                    @if(Auth::user()->can("exportar_clientes"))
                        <a href="{{URL::to('admin/exportar-clientes')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Exportar Clientes</a>
                    @endif
                    <a href="{{URL::to('admin/exportar-personas')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Exportar Personas</a>
                    @if(Auth::user()->can("ver_menu_admin"))
                        <a href="{{URL::to('admin/menu')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Menú</a>
                    @endif
                    @if(Auth::user()->can("ver_item_admin"))
                        <a href="{{URL::to('admin/item')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Items</a>
                    @endif
                    @if(Auth::user()->can("ver_seccion_admin"))
                        <a href="{{URL::to('admin/seccion')}}" class="btnCalado"><i class="fa fa-pencil fa-lg"></i>Secciones</a>
                    @endif
                </div>
                @endif

                @if(true)
                <div class="divSalir">
                    <span class="nameAdmin"><i class="fa fa-user fa-lg marginRight5"></i>{{Auth::user()->perfil()->name}}</span>
                    <a href="{{URL::to('logout')}}" class="btnCalado"><i class="fa fa-share  fa-lg"></i>Salir</a>
                </div>
                @else
                <div class="divSalir">
                    <a href="{{URL::to('login')}}" class="btnCalado"><i class="fa fa-share  fa-lg"></i>Ingresar</a>
                </div>
                @endif
            </div>
            @endif
            <!-- H E A D E R -->
            <header>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <a class="navbar-brand" href="#"><img alt="logo" src="{{URL::to('images/offitec.svg')}}"></a>
                            
                            <!-- N A V -->
                            @include('menu.'.$project_name.'-desplegar-menu')

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </header>  
            <!-- abre S L I D E estático -->
            <div class="slideHome"></div>          
        @show
        

        <!-- abre S E C T I O N -->

        @yield('contenido')

        @section('footer')
        <!-- abre F O O T E R -->
        <footer>

        </footer>
        
        <script src="{{URL::to('ckeditor/ckeditor.js')}}"></script>
        <script src="{{URL::to('ckeditor/adapters/jquery.js')}}"></script>
        <script src="{{URL::to('js/jquery.previewInputFileImage.js')}}"></script>
        <script src="{{URL::to('js/jquery.lazyload.js')}}"></script>
        <script src="{{URL::to('js/jquery-ui.min.js')}}"></script>
        <script src="{{URL::to('js/jquery.Jcrop.min.js')}}"></script>
        
        <script>
            $(function () {
                $("img.lazy").lazyload({
                    effect: "fadeIn"
                });
            });
        </script>

        <!-- Include OWL CARROUSEL -->
        <script src="{{URL::to('js/owl.carousel.js')}}"></script>
         <script>
            $(document).ready(function() {
              $("#owl-demo-prod").owlCarousel({
             
                  items : 4,
                  itemsDesktop : [1199,3],
                  itemsDesktopSmall : [979,3]
             
              });
            });
        </script>

        <!-- Div alerta  -->
        @include($project_name.'-div-alerta')
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{URL::to('bootstrap-3.3.4-dist/js/bootstrap.min.js')}}"></script>
        
        @show
        
        
    
    </body>
</html>