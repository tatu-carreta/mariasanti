@if (Session::has('mensaje'))
    <script src="{{URL::to('js/divAlertaFuncs.js')}}"></script>
    <div class="divAlerta error alert alert-success">{{ Session::get('mensaje') }}<button type="button" class="close" data-dismiss="alert">&times;</button></div>
@endif