<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8"/>
  <title>ورود</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/admin/font.css')}}" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN PAGE LEVEL STYLES -->
  <link href="{{URL::asset('assets/css/login-rtl.css')}}" rel="stylesheet" type="text/css"/>
  <!-- END PAGE LEVEL SCRIPTS -->
  <!-- BEGIN THEME STYLES -->
  <link href="{{URL::asset('assets/css/components-rtl.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/plugins-rtl.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/layout-rtl.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/css/darkblue-rtl.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="{{URL::asset('assets/css/custom-rtl.css')}}" rel="stylesheet" type="text/css"/>
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <!-- END THEME STYLES -->
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
  <style>
    *{
      font-family:IRANSans;
    }
  </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGO -->
<div class="logo">
  <a href="<?php url();?>">
    <img src="{{URL::asset('assets/images/logo.png')}}" alt="" style="width:120px;height: 80px;"/>
  </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
  <!-- BEGIN LOGIN FORM -->
  <form class="login-form" action="<?php echo url();?>/admin/z.admin" method="post">
    <h3 class="form-title" style="font-family: BTitrBold;">ورود به پنل کاربری</h3>
    <div class="form-group">
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Username</label>
      <input name="_token" type="hidden" value="{{Session::token()}}">
      <input class="form-control form-control-solid placeholder-no-fix" style="direction: ltr" type="text" autocomplete="off" placeholder="نام کاربری" name="username"/>
    </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Password</label>
      <input class="form-control form-control-solid placeholder-no-fix" style="direction: ltr" type="password" autocomplete="off" placeholder="رمز عبور" name="password"/>
    </div>
    <div class="form-actions">
      <button type="submit" class="btn btn-success uppercase">ورود</button>
    </div>
    <div class="create-account">
      <p>
        <a href="javascript:;" id="forget-password" class="forget-password">رمز عبور خود را فراموش کردم</a>
      </p>
    </div>
  </form>
</div>
<div class="copyright" style="font-family:tahoma;direction: ltr">
  CopyRight 2015-2016 - Zagrot
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
  jQuery(document).ready(function() {
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    Login.init();
    Demo.init();
  });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>