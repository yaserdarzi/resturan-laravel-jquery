<?php
$j=1;
$factor=0;
foreach($fields as $filed) {
  foreach ($filed as $value) {
    $foodname = DB::table('z_foods')->whereId($value->food_id)->first();
    if ($factor != $value->factor_id) {
      $factor = $value->factor_id;
    } else {
      continue;
    }
    ?>
    <ul id="pan"
        style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;min-width:500px;">
      <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $j;?></li>
      <li style="display: inline-block;padding:10px 8px;width:300px;">
        <?php
        $orders = DB::table('z_orders')->whereRefid($value->factor_id)->first();
        $foods = DB::table('z_food_orders')->whereFactorId($orders->refid)->get();
        foreach ($foods as $food) {
          $food_name = DB::table('z_foods')->whereId($food->food_id)->first();
          ?>
          <span><?php echo $food_name->title . "(" . $food->foodcount . ")"?></span>
          <?php
        }
        ?>
      </li>
      <li style="display: inline-block;padding:10px 8px;width:250px;"><?php echo $orders->time;?></li>
      <?php
      if (isset($orders->table_no) && $orders->table_no != "") {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:410px;">مشتری حضوری<br>میز
          شماره:<?php echo $orders->table_no?></li>
        <?php
      } else if (isset($user->address) && $user->address != "" && isset($orders->howtime_in) && $orders->howtime_in != "") {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:410px;">بیرون بر با
          پیک<br>ساعت:<?php echo $orders->intime ?><br>اشتراک:<?php echo $user->cctt ?></li>
        <?php
      } else if (isset($orders->come_later) && $orders->come_later != "") {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:410px;">پیش سفارش
          حضوری<br>ساعت:<?php echo $orders->come_later ?></li>
        <?php
      } else if (isset($orders->outtime) && $orders->outtime != "") {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:410px;">بیرون بر
          حضوری<br>ساعت:<?php echo $orders->outtime ?></li>
        <?php
      }
      if (isset($orders->total_fee)) {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $orders->total_fee;?></li>
        <?php
      }
      if (isset($value->desc)) {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $value->desc;?></li>
        <?php
      } else {
        ?>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $orders->note;?></li><?php
      }
      ?>
    </ul>
    <hr>
    <?php
    $j++;
  }
}
?>
<script>
  function display(id,username,address){
    $('#'+id).tooltipster({
      content: $("<span>نام مشتری:"+username+"</span><br><span>آدرس:"+address+"</span>")
    });
  }
</script>

