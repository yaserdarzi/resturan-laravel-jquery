<html>
<head>
  <meta charset="utf-8">
  <title>بازیابی کد اشتراک</title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/style.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}" type="text/css">
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
<div class="container">
  <form style="height:280px;" action="<?php echo url();?>/user/forget" method="post" class="register-form" id="register-form">
    <div class="formHeader"><span class="tooltip" id="controlPanel">بازیابی اطلاعات</span></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="formContainer"><div style="text-align:right;margin-right:20px;"><span class="tooltip" id="username">شماره تلفن</span></div><input style="padding:8px;height:35px;" id="email" type="text" class="inputer" name="name"></div>
    <button type="submit">ثبت درخواست</button>
  </form>
</div>
</body>
</html>