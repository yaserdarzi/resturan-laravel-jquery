<?php
$j=1;
$factor=0;
foreach($fields as $value){
  $foodname = DB::table('z_food_menu')->whereId($value->food_id)->first();
  if ($factor !=$value->factorid) {
    $factor = $value->factorid;
  }else{
    continue;
  }
  $user = DB::table('z_users')->whereId($value->userid)->first();
  ?>
  <ul id="pan" style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;min-width:500px;">
    <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $j;?></li>
    <li style="display: inline-block;padding:10px 8px;width:200px;"><img id="info<?php echo $j?>" class="tooltip" onmouseover="display('info<?php echo $j?>','<?php echo $user->name?>','<?php echo $user->address?>')" style="width:70px;height:70px;" src="{{URL::asset('assets/images/profile.png')}}"><?php echo $value->userid?></li>
    <li style="display: inline-block;padding:10px 8px;width:300px;">
      <?php
      $orders = DB::table('z_orders_id')->whereFactorId($value->factorid)->first();
      $foods = DB::table('z_orders')->whereFactorid($orders->factor_id)->get();
      foreach($foods as $food){
        $food_name = DB::table('z_food_menu')->whereId($food->food_id)->first();
        ?>
        <span><?php echo $food_name->foodname."(".$food->foodcount.")"?></span>
        <?php
      }
      ?>
    </li>
    <li style="display: inline-block;padding:10px 8px;width:250px;"><?php echo $value->purchase_time;?></li>
    <?php
    if (isset($value->table_no) && $value->table_no !=""){
      ?>
      <li style="display: inline-block;padding:10px 8px;width:410px;">مشتری حضوری<br>میز شماره:<?php echo $value->table_no?></li>
      <?php
    }else if (isset($user->address) && $user->address != "" && isset($value->howtime_in) && $value->howtime_in!=""){
      ?>
      <li style="display: inline-block;padding:10px 8px;width:410px;">بیرون بر با پیک<br>ساعت:<?php echo $value->howtime_in?><br>اشتراک:<?php echo $user->cctt?></li>
      <?php
    }else if (isset($value->come_later) && $value->come_later!=""){
      ?>
      <li style="display: inline-block;padding:10px 8px;width:410px;">پیش سفارش حضوری<br>ساعت:<?php echo $value->come_later?></li>
      <?php
    }else if (isset($value->howtime_out)&&$value->howtime_out!=""){
      ?>
      <li style="display: inline-block;padding:10px 8px;width:410px;">بیرون بر حضوری<br>ساعت:<?php echo $value->howtime_out?></li>
      <?php
    }
    if (isset($value->desc)){
      ?>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $value->desc;?></li>
      <?php
    }else{?>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $value->desc;?></li><?php
    }
    ?>
  </ul>
  <hr>
  <?php
  $j++;
}
?>

<script>
  function display(id,username,address){
    $('#'+id).tooltipster({
      content: $("<span>نام مشتری:"+username+"</span><br><span>آدرس:"+address+"</span>")
    });
  }
</script>

