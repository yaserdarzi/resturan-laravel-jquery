<link href="{{URL::asset('assets/datatable/css/style.css')}}" rel="stylesheet" type="text/css"/>

<script type="text/javascript" language="javascript"
        src="{{URL::asset('assets/datatable/js/jquery.dataTables.min.js')}}">
</script>
<script type="text/javascript" language="javascript"
        src="{{URL::asset('assets/datatable/js/dataTables.bootstrap.min.js')}}">
</script>

<div class="row jfirst-child">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class=" portlet light jform">
            <div  style="margin-top: -40px;">
                <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>سفارشات</th>
                        <th>نوع تحویل</th>
                        <th>نوع پرداخت</th>
                        <th>مبلغ کل</th>
                        <th>تاریخ ثبت</th>
                        <th>ساعت ثبت</th>
                        <th>توضیحات</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>سفارشات</th>
                        <th>نوع تحویل</th>
                        <th>نوع پرداخت</th>
                        <th>مبلغ کل</th>
                        <th>تاریخ ثبت</th>
                        <th>ساعت ثبت</th>
                        <th>توضیحات</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>

<?php
$i=1;
if (isset($fields)) {
    foreach ($fields as $field) {
        ?>
        <tr>
            <td><?php echo $i?></td>

            <td>
                <?php
                if($field->user_id!=null) {
                    $user = DB::table('z_users')->whereId($field->user_id)->first();
                    echo $user->name;
                }
                ?>
            </td>
            <td>
                <?php
                $food_names="";
                $foods= DB::table('z_food_orders')->where('order_id',$field->id)->get();
                foreach($foods as $food){
                    $foodname = DB::table('z_foods')->whereId($food->food_id)->first();
                    $food_names .=' '.$foodname->title.' ('.$food->foodcount.') ';
                }
                echo $food_names;
                ?>
            </td>
            <td>
                <?php
                if($field->order_type!=null) {
                    $orderType = DB::table('z_order_types')->whereId($field->order_type)->first();
                    echo $orderType->name;
                }
                ?>
            </td>
            <td>
                <?php
                if($field->payment_type!=null) {
                    $payment_type = DB::table('z_payments')->whereId($field->payment_type)->first();
                    echo $payment_type->title;
                }
                ?>
            </td>
            <td><?php echo $field->total_fee?></td>
            <td><?php echo g2j($field->date)?></td>
            <td><?php echo $field->time?></td>
            <td><?php echo $field->note?></td>
            <td>
                <a href="<?php echo url()?>/admin/print/<?php echo $field->id?>" target="_blank">پرینت</a>
                <a href="javascript:void(0);" onclick="changestatus('<?php echo $field->id?>')">عملیات</a>
            </td>
        </tr>
        <?php
        $i++;
    }
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
