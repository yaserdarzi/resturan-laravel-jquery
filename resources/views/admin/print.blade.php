<html>
<head>
    <meta charset="utf-8">
    <title>پرینت فاکتور</title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/admin/print.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}">
    <script src="{{URL::asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
</head>
<body>
<div id="factor-header">
    <?php
    if (isset($order)){
        $orderDate = explode('-',$order->date);
        $jOrderDate = gregorian_to_jalali($orderDate[0],$orderDate[1],$orderDate[2],'/');
        ?>
        <span class="factor-desc">نام: <?php echo $user->name?></span>
        <span class="factor-desc">شماره فاکتور: <?php echo $order->refid?></span>
        <span class="factor-desc">تاریخ سفارش: <?php echo $order->time .' - '.$jOrderDate?></span>
    <?php
    }
    ?>
</div>
    <ul class="top-flex">
        <li class="top-item">ردیف</li>
        <li class="top-item">نام غذا</li>
        <li class="top-item">تعداد</li>
        <li class="top-item">فی</li>
    </ul>
<?php
    if (isset($foodOrders)){
        $i=0;
        foreach($foodOrders as $foodOrder){
            ?>
            <ul class="item-flex">
                <li class="top-item"><?php echo $i+1?></li>
                <li class="top-item"><?php echo $foodNames[$i]->title?></li>
                <li class="top-item"><?php echo $foodOrder->foodcount?></li>
                <li class="top-item"><?php echo $foodNames[$i]->price?></li>
            </ul>
            <?php
            $i++;
        }
    }
?>
<hr>
<div class="totalFee">
    <p>جمع کل: <?php echo $order->total_fee?> تومان</p>
</div>
</body>
</html>
<script>
    $(function(){
       window.print();
    });
</script>