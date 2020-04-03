<br><ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
    <li style="display: inline-block;padding:10px 8px;width:200px;">نام</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">مبلغ</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">تاریخ پرداخت</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">حساب</li>
</ul>
<?php
if (isset($salaries)){
    foreach($salaries as $salary){
        $payDate = g2j($salary->date);
        ?>
        <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; background-color:#fff;margin: 0 auto;text-align: center; color:#2f2f2f;">
            <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $salary->staff_name;?></li>
            <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $salary->cost?></li>
            <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $payDate?></li>
            <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $salary->name?></li>
        </ul>
        <?php
    }
}
?>