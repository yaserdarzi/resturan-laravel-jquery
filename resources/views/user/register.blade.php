<html>
<head>
  <meta charset="UTF-8">
  <title>ثبت نام</title>
  <link rel="stylesheet" href="{{URL::asset('assets/user/style.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/font-awesome.css')}}" type="text/css" />
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
  <a href="<?php echo url()?>"><img src="{{URL::asset('assets/images/logo.png')}}" class="logo"></a>
<form action="<?php echo url()?>/user/register" method="post" id="form">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
<div class="container">
  <input type="text" required name="name" placeholder="نام و نام خانوادگی">
  <input type="text" required name="phone" placeholder="شماره تماس">
  <label for="marriage">متاهل</label>
  <input type="checkbox" name="marriage" id="marriage"><br>
  <input type="text" id="birthday" required name="birthday">
  <label for="address">آدرس : </label>
  <textarea name="address" id="address" required></textarea><br>
  <input name="postalCode" required type="text" id="postalCode" placeholder="کد پستی">
  <input type="text" required name="email" id="email" placeholder="ایمیل">
  <input type="password" required name="password" id="password" placeholder="رمز عبور">
  <button type="submit" id="submit">ثبت نام</button>
</div>
</form>
<span id="error">&nbsp;</span>
</body>
</html>
<script>
  $(function(){
    $('#password').on('keyup',function(){
      var value = $(this).val();
      if (value.length<6){
        $(this).css('border','1px solid #f00');
      }else{
        $(this).css('border','1px solid #0f2');
      }
    });
    $('#email').on('keyup',function(){
        var value = $(this).val();
      $.ajax('<?php echo url();?>/user/emailvalidate',{
        dataType:'json',
        data:{
          email:value
        },
        success:function(data){
          if (data==1){
            $('#email').css('border','1px solid #0f2');
            $('#error').text('');
          }else if (data==0){
            $('#email').css('border','1px solid #f00');
            $('#error').text('ایمیل وارد شده معتبر نمی باشد و یا قبلا در سیستم ثبت شده است.');
          }
        }
      })
    });

    $('#postalCode').on('keyup',function(){
      var value = $(this).val();
      if (value.length < 10){
        $(this).css('border','1px solid #f00');
      }else{
        $(this).css('border','1px solid #0f2');
      }
    });
  });
</script>
<script>
  function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
  };
</script>