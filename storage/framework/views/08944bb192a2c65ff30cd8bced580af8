<?php if (!isset($sorting)){$sorting="desc";}?>
<div id="cReportCotainer">
    <?php
    $i=0;
    foreach($fields as $field) {
        $date = explode('-', $field->date);
        $jDate = gregorian_to_jalali($date[0], $date[1], $date[2], '/');
        $array = [$fields, $user, $counts[$i]];
        $values[] = [$i+1,$field->name,$field->refid,$counts[$i],$field->orderType,$jDate,$field->time,$field->total_fee];
        $i++;
    }
    $titles=['ردیف','نام مشتری','شماره فاکتور','تعداد غذا','نوع تحویل','تاریخ ثبت','ساعت ثبت','مبلغ کل'];
    $tableFields=['z_orders.id','z_users.name','z_orders.refid','z_food_orders.foodcount','z_order_types.name','z_orders.date','z_orders.time','z_orders.total_fee'];
    echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$sorting,$orderField,url().'/admin/reportingOrdersSort','cReportCotainer');
    ?>
</div><br><br><br>