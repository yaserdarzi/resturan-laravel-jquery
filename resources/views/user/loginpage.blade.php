<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ورود به سیستم کاربری</title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/style.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/css/tooltip/tooltipster.css')}}" type="text/css">
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/jquery.tooltipster.min.js')}}"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
<div class="content">
  <div class="container">
    <form action="<?php echo url();?>/user/register" method="post" class="register-form" style="direction: rtl;" id="register-form">
      <div class="formHeader"><span class="tooltip" id="controlPanel">ثبت نام در سیستم</span></div>
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <!--div class="formContainer"><div style="text-align:right;margin-right:20px;"><span class="tooltip" id="username">نام و نام خانوادگی</span></div><input id="email" type="text" class="inputer" name="name"></div>
      <div class="formContainer"><div style="text-align:right;margin-right:20px;"><span class="tooltip" id="pass">شماره تلفن</span></div><input id="password" type="password" class="inputer" name="phone"></div-->
      <label style="color:#2f2f2f">نام</label>
      <input type="text" name="firstName" class="inputer"><br>
      <label style="color:#2f2f2f">نام خانوادگی</label>
      <input type="text" name="lastName" class="inputer"><br>
      <label style="color:#2f2f2f">شماره تلفن</label>
      <input type="text" name="phone" class="inputer"><br>
      <?php
        if (isset($fields)){
            $i=0;
            foreach($fields as $field){
                echo renderRegisterForm($field->id,$fieldNames[$i]->name,$field->default_value,$field->title,$field->required,$field->en_name);
                $i++;
            }
        }
        ?>
      <button type="submit">ثبت نام</button>
    </form>
  </div>
<div class="container">
  <form action="<?php echo url();?>/user/logincheck" method="post" class="register-form" id="register-form">
    <div class="formHeader"><span class="tooltip" id="controlPanel">ورود به پنل کاربری</span></div>
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="formContainer"><div style="text-align:right;margin-right:20px;"><span class="tooltip" id="username">شماره تلفن</span></div><input id="email" type="text" class="inputer" name="name"></div>
    <div class="formContainer"><div style="text-align:right;margin-right:20px;"><span class="tooltip" id="pass">کد اشتراک</span></div><input id="password" type="password" class="inputer" name="cid"></div>
    <button type="submit">ورود</button>
    <a id="forget" href="<?php echo url();?>/user/forget" class="forget-pass">رمز عبور خود را فراموش کرده ام</a>
  </form>
</div>
<div style="margin-top:100px;">
  <?php
    if (isset($socials)){
      foreach($socials as $social){
        $url = $social->url;
          if (!strpos($url,'http') || !strpos($url,'http')){
            $url = 'http://'.$url;
          }
        ?>
        <a class="social" href="{{$url}}" target="_blank" id="<?php echo $social->id?>" onmouseover="tooltip('<?php echo $social->id?>','{{$social->desc}}')">{{$social->title}}</a>
        <?php
      }
    }
  ?>
</div>
<?php
if (isset($login)){
  echo "<div style='margin-top:35px;'><span style='color:#f00;text-shadow: 2px 2px rgba(0,0,0,0.3)'>$login</span></div>";
}
?>

</body>
</html>
<script>
  $(function(){
    $('#password').on('keyup',function(){
      var val = $('#password').val();
      if (val.length<11){
        $('#password').css('border','1px solid #f00');
      }else{
        $('#password').css('border','1px solid #8aff00');
      }
    });
  });
function tooltip(itemId,message){
  $('#'+itemId).tooltipster({
    animation: 'grow',
    contentAsHTML: true,
    interactive: true,
    multiple:true,
    content: $("<span>"+message+"</span>")
  });
}
</script>
