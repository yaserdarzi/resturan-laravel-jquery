<?php
use Illuminate\Support\Facades\Session;
?>
  <html>
  <head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{URL::asset('assets/food/font.css')}}">
    <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
  </head>
  <body style="background-color:#eee;direction:rtl;text-align:center;font-size:14pt;font-family: IRANSans;">
  <div style="margin:100px auto;">
    <span>کاربر گرامی سفارش شما با موفقیت ثبت شد.</span><br><br>
    <span style="font-weight: bold">شماره پیگری : <?php echo Session::get('factorId')?>&nbsp;می باشد.</span><br><br><br>
    <a href="<?php echo url()?>/food/menu" style="color:#f80;text-decoration: none">برگشت به منو</a>
  </div>
  </body>
  </html>
<?php
    Session::forget('foods');
    Session::forget('price');
    Session::forget('total');
    Session::forget('pre');
    Session::forget('discount');
    Session::forget('discount_type');
    Session::forget('new_total');
?>