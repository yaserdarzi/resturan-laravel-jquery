<div class="row jfirst-child">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class=" portlet light jform">

            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <?php echo renderFilters(url().'/admin/filterUsersClubReports','reportResult',true,true,'datepicker0','datepicker1');?>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromDate" id="datepicker0" placeholder="از تاریخ">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toDate" id="datepicker1" placeholder="تا تاریخ">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromTime" id="timepicker0" placeholder="از ساعت">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toTime" id="timepicker1" placeholder="تا ساعت">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="name" id="name" placeholder="نام مشتری">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="ssid" id="ssid" placeholder="شماره اشتراک">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromCount" id="fromCount" placeholder="حداقل تعداد خرید">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toCount" id="toCount" placeholder="حداکثر تعداد خرید">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromFee" id="fromCount" placeholder="حداقل مبلغ خرید">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toFee" id="toCount" placeholder="حداکثر مبلغ خرید">
            </div>

            <select class="multy" id="sortingType">
                <option value="z_users.submit_date" selected>تاریخ ثبت نام</option>
                <option value="z_users.last_visit">آخرین بازدید</option>
                <option value="z_users.last_visit">آخرین خرید</option>
            </select>

            <select id="coupon" style="width:200px;padding:4px;">
                @if(isset($coupons))
                @foreach($coupons as $coupon)
                <option value="{{$coupon->code}}">{{$coupon->code}}</option>
                @endforeach
                @endif
            </select><a href="javascript:void(0);" id="submitCoupon">ثبت کوپن</a>
            <span id="ajRep"></span>
            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 jfleft">
                <a href="#" class="submit jfleft" id="filter">گزینش</a>
            </div>

        </div>
    </div>
</div>

<div class="row jlast-child " style="padding-top: 0;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
        <div id="reportResult" class=" portlet light jform ">

        </div></div></div>
<script>
    $(function(){
        $('#datepicker0').val('<?php echo getCurrentJalaliDate()?>');
        $('#datepicker1').val('<?php echo getCurrentJalaliDate()?>');
        $('#timepicker0').val('00:00:00');
        $('#timepicker1').val('23:59:59');
        $('#datepicker0').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy/mm/dd'
        });
        $('#datepicker1').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy/mm/dd'
        });
        $('#timepicker0').timepicker({ 'timeFormat': 'H:i:s' });
        $('#timepicker1').timepicker({ 'timeFormat': 'H:i:s' });
    });
    getAllReports();
    $('#filter').on('click',function(){
        getAllReports();
    });
    function getAllReports(){
        var dateFrom = $('#datepicker0').val();
        var dateTo = $('#datepicker1').val();
        var timeFrom = $('#timepicker0').val();
        var timeTo = $('#timepicker1').val();
        var countFrom = $('#fromCount').val();
        var countTo = $('#toCount').val();
        var feeFrom = $('#fromFee').val();
        var feeTo = $('#toFee').val();
        var nma = $('#name').val();
        var facId = $('#ssid').val();
        var sortingType = $('#sortingType').val();
        //var countFrom = $('#fromCount').val();
        //var countTo = $('#toCount').val();
        $.ajax('<?php echo url()?>/admin/reportingUsersClub',{
            dataType:'json',
            data:{
                fromDate:dateFrom,
                toDate:dateTo,
                fromTime:timeFrom,
                toTime:timeTo,
                fromCount:countFrom,
                toCount:countTo,
                fromFee:feeFrom,
                toFee:feeTo,
                name:nma,
                ssid:facId,
                sortType:sortingType
            },
            success:function(data){
                $('#reportResult').html(data.content);
            }
        });
    }

    $('#submitCoupon').on('click',function(){
        var ids = $('#ids').val();
        var coupon = $('#coupon').val();
        ajaxSendData('ajRep',{
            ids:ids,
            coupon:coupon
        },'/admin/attachCoupon');
    });
</script>