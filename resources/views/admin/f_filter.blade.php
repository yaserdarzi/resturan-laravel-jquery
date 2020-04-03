<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
    <li style="display: inline-block;padding:10px 8px;width:200px;">عنوان</li>
    <li style="display: inline-block;padding:10px 8px;width:400px;">توضیحات</li>
    <li style="display: inline-block;padding:10px 8px;width:100px;">تاریخ</li>
    <li style="display: inline-block;padding:10px 8px;width:100px;">مبلغ</li>
</ul>
<?php
    if (isset($details)){
        foreach($details as $detail){
            $date = g2j($detail->date);
            ?>
            <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
                <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $name->title?></li>
                <li style="padding:12px 8px;width:400px;display: inline-block;"><?php echo $detail->desc;?></li>
                <li style="padding:12px 8px;width:100px;display: inline-block;"><?php echo $date;?></li>
                <li style="padding:12px 8px;width:100px;display: inline-block;"><?php echo $detail->cash;?></li>
            </ul>
            <?php
        }
    }
?>
<hr>
<div style="width:100px;padding:4px;background-color:#111;float:left;margin-left:40px;text-align:center;">
    <p style="color:#eee">جمع کل: <?php echo $total?></p>
</div>
