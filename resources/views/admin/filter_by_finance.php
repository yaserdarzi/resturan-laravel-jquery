<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
    <li style="display: inline-block;padding:10px 8px;width:300px;">عنوان</li>
    <li style="display: inline-block;padding:10px 8px;width:250px;">جمع کل</li>
</ul>
<?php
    if (isset($sales)){
        ?>
        <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
            <li style="display: inline-block;padding:10px 8px;width:300px;">فروش جانبی</li>
            <li style="padding:12px 8px;width:250px;display: inline-block;"><?php echo $sales;?></li>
        </ul>
        <?php
    }
?>
<?php
if (isset($ordersSold)){
    ?>
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
        <li style="display: inline-block;padding:10px 8px;width:300px;">فروش سفارشات</li>
        <li style="padding:12px 8px;width:250px;display: inline-block;"><?php echo $ordersSold;?></li>
    </ul>
    <?php
}
?>

<?php
if (isset($cost)){
    ?>
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
        <li style="display: inline-block;padding:10px 8px;width:300px;">هزینه</li>
        <li style="padding:12px 8px;width:250px;display: inline-block;"><?php echo $cost;?></li>
    </ul>
    <?php
}
?>
