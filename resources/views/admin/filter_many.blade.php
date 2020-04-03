<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
  <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
  <li style="display: inline-block;padding:10px 8px;width:350px;">نام غذا</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">تعداد</li>
</ul>
<?php
$foodname = array();
$i=1;
if (isset($fields)){
  foreach($fields as $field){
    $food = DB::table('z_foods')->whereId($field->food_id)->first();
    if (isset($foodname[$food->title])){
      continue;
    }else {
      $foodname[$food->title]=$food->title;
    }
    ?>
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
      <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i?></li>
      <li style="display: inline-block;padding:10px 8px;width:350px;"><?php echo $food->title;?></li>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->foodcount;?></li>
    </ul>
    <?php
    $i++;
  }
}
?>