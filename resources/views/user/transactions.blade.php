<html>
<head>
  <meta charset="utf-8">
  <title>مشاهده تراکنش ها</title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/user/transactions.css')}}">
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
<ul class="entry">
  <li style="width: 35px;">ردیف</li>
  <li>شماره فاکتور</li>
  <li>تاریخ ثبت</li>
  <li>زمان ثبت</li>
  <li>مبلغ کل فاکتور</li>
</ul>
  <?php
  $i=1;
    if (isset($transactions)){
      foreach ($transactions as $trans) {
        $date = explode('-',$trans->date);
        $jDate= gregorian_to_jalali($date[0],$date[1],$date[2],'/');
        ?>
        <ul class="factor_entry">
        <li style="width: 35px;"><?php echo $i?></li>
        <li><?php echo $trans->refid;?></li>
        <li><?php echo $jDate;?></li>
        <li><?php echo $trans->time;?></li>
        <li><?php echo $trans->total_fee;?></li>
        </ul>
        <hr>
        <?php
        $i++;
      }
      ?>
      <ul class="factor_entry">
        <li style="width: 35px;"></li>
        <li></li>
        <li></li>
        <li</li>
        <li>مبلغ کل خرید شما:&nbsp;<?php echo$total;?>تومان</li>
      </ul>
      <?php
    }
  ?>
</body>
</html>