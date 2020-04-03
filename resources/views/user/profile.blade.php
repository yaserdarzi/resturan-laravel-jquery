<html>
<head>
  <meta charset="utf-8">
  <title>پروفایل کاربری</title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/style.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/date/jquery-ui-1.8.14.css')}}" type="text/css">
  <link href="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
  <script src="{{URL::asset('assets/js/jquery-1.6.2.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/jquery.ui.datepicker-cc.all.min.js')}}" type="text/javascript"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
<div class="container">
  <a style="color:#ff2800;text-decoration: none;" target="_blank" href="<?php echo url()?>/user/transactions/<?php echo $id;?>">مشاهده تراکنش ها</a>
  <?php
  if (isset($discounts)) {
    foreach ($discounts as $discount) {
      $gDate = $discount->exp_date;
      $currentDate = getCurrentDate();
      if ($currentDate > $gDate){
        DB::table('z_discounts')->whereId($discount->id)->update(['enabled'=>0]);
        continue;
      }
        $userUsedDiscount = DB::table('z_discounts_usage')->whereDiscountId($discount->id)->whereUserId($id)->first();
        if (isset($userUsedDiscount) && count($userUsedDiscount) >0){
          DB::table('z_users')->whereId($id)->update(['discount_id'=>null]);
          continue;
        }
      $gDate = explode('-',$gDate);
      $jDate = gregorian_to_jalali($gDate[0],$gDate[1],$gDate[2],'/');
      ?>
      <div style="background-color:#2f2f2f;direction: rtl">
        <h3>کوپن تخفیف</h3>
        <p>شماره کوپن تخفیف:<?php echo $discount->coopen_id;?></p>
        <?php
        if ($discount->from_fee > 100){
          ?>
            <span style="padding:4px;margin:8px;">برای خریدهای بالاتر از <?php echo $discount->from_fee;?>تومان</span><br>
          <?php
        }
      if ($discount->for_all == 0){
          ?>
            <span style="color:#f00;font-weight: bold">اختصاصی برای شما.</span>
          <?php
        }
        if ($discount->type == 0) {
          ?>
          <p>میزان تخفیف:<?php echo $discount->discount;?>درصد</p>
          <?php
        } else if ($discount->type == 1) {
          ?>
          <p>میزان تخفیف:<?php echo $discount->discount ?>تومان</p>
          <?php
        }
        ?>
        <p>تاریخ انقضا:<?php echo $jDate;?></p>
      </div>
      <?php
    }
  }
  ?>
  <p></p>
</div>
</body>
</html>
<script>
  $(function(){
    $('#datepicker0').datepicker({
      dateFormat: 'yy/mm/dd',
      changeMonth: true,
      changeYear: true
    });
    $('#datepicker1').datepicker({
      dateFormat: 'yy/mm/dd',
      changeMonth: true,
      changeYear: true
    });
  });
</script>