<html>
<head>
    <meta charset="utf-8">
    <script src="{{URL::asset('assets/calc/jquery-2.1.4.min.js')}}"></script>
    <script src="{{URL::asset('assets/calc/SimpleCalculadorajQuery.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/calc/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/calc/SimpleCalculadorajQuery.css')}}">
    <title>ماشین حساب</title>
</head>
<body>
<div id="micalc"> </div>
</body>
</html>
<script>
    $(function(){
        window.scrollTo(0,1);
        $("#micalc").Calculadora({
             EtiquetaBorrar:'Clear',
             TituloHTML:''
        });
    });
</script>