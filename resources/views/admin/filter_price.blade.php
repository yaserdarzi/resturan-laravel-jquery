<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
  <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
  <li style="display: inline-block;padding:10px 8px;width:350px;">نام مشتری</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">شماره فاکتور</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">مبلغ فاکتور</li>
</ul>
<?php
$i=1;
$factors = array();
if (isset($fields)){
  foreach($fields as $field){
    $user = DB::table('z_users')->whereId($field->user_id)->first();
    if (isset($factors[$field->refid])){
      continue;
    }else{
      $factors[$field->refid]=$field->refid;
    }
    ?>
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
      <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i?></li>
      <li style="display: inline-block;padding:10px 8px;width:350px;"><?php echo $user->name;?></li>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->refid;?></li>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->total_fee;?></li>
    </ul>
    <?php
    $i++;
  }
}
?>