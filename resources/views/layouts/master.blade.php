<html>
<title>@yield('title')</title>
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
<head>

</head>
<body>
@section('top')
<div class="header">
  @yield('headerContent')
</div>
<div class="container">
  @yield('content')
</div>
<div class="footer">
  @yield('footerContent')
</div>
</body>
</html>