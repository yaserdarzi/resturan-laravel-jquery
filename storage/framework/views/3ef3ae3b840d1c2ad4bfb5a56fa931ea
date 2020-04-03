<?php
$factorIds =array();
$i=1;
if (isset($fields)) {
    foreach ($fields as $field) {
        $foods = DB::table('z_food_orders')->whereFactorId($field->refid)->get();
        if (!isset($factorIds[$field->refid])){
            $factorIds[$field->refid]=$field->refid;
        }else{
            continue;
        }
        ?>
        <ul style="display: flex;justify-content: space-between;background-color:#eee;align-items: center;max-width: 900px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
            <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i?></li>
            <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->username?></li>
            <li style="display: inline-block;padding:10px 8px;width:300px;">
                <?php
                $food_names="";
                foreach($foods as $food){
                    $foodname = DB::table('z_foods')->whereId($food->food_id)->first();
                    $food_names .=' '.$foodname->title.' ('.$food->foodcount.') ';
                }
                echo $food_names;
                ?>
            </li>
            <li style="display: inline-block;padding:10px 8px;width:350px;"><?php echo $field->orderType." ".$field->order_set?></li>
            <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $field->paymentType?></li>
            <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->totalFee?></li>
            <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo g2j($field->date)?></li>
            <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $field->time?></li>
            <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->note?></li>
            <li style="display: inline-block;padding:10px 8px;width:50px;"><a href="<?php echo url()?>/admin/print/<?php echo $field->or_id?>" target="_blank">پرینت</a></li>        </ul>
        <?php
        $i++;
    }
}
?>