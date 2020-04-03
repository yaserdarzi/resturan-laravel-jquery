<div class="row jfirst-child">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class=" portlet light jform">

            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <?php echo renderFilters(url().'/admin/filterDeliveryReports','reportResult',true,true,'datepicker0','datepicker1');?>
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
                <input class="zinput" data-filter="facId" id="facId" placeholder="روش تحویل">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromCount" id="fromCount" placeholder="حداقل تعداد فروش">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toCount" id="toCount" placeholder="حداکثر تعداد فروش">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromFee" id="fromFee" placeholder="حداقل میزان فروش">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toFee" id="toFee" placeholder="حداکثر میزان فروش">
            </div>

            <?php if (count($restaurants) > 1) { ?>

                <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                    <select class="multy" id="restaurants" multiple>
                        <?php
                        if (isset($restaurants)){
                            foreach($restaurants as $restaurant){

                                if ($restaurant->id != 1) {
                                    ?>
                                    <option value="<?php echo $restaurant->id?>"><?php echo $restaurant->title?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>

            <?php } ?>

            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <select class="multy" id="foods" multiple>
                    <?php
                    if (isset($foods)){
                        foreach($foods as $food){
                            ?>
                            <option value="<?php echo $food->id?>"><?php echo $food->title?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                <select class="multy" id="menus" multiple>
                    <?php
                    if (isset($menus)){
                        foreach($menus as $menus){
                            ?>
                            <option value="<?php echo $menus->id?>"><?php echo $menus->title?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
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
        getAllReports();
        $('#restaurants').multiselect({
            nonSelectedText: 'لطفا یکی از زیرمجموعه ها را انتخاب کنید',
            selectAllText: 'همه ی زیرمجموعه ها',
            allSelectedText: 'همه ی زیرمجموعه ها'
        });
        $('#foods').multiselect({
            nonSelectedText: 'لطفا یک غذا انتخاب کنید',
            selectAllText: 'همه ی غذاها',
            allSelectedText: 'همه ی غذاها'
        });
        $('#menus').multiselect({
            nonSelectedText: 'لطفا یک دسته بندی غذا را انتخاب کنید',
            selectAllText: 'همه ی دسته بندی های غذا',
            allSelectedText: 'همه ی دسته بندی های غذا'
        });

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
        var facId = $('#facId').val();
        var selectedVal = $('#restaurants').val();
        var foods = $('#foods').val();
        var menu = $('#menus').val();
        //var countFrom = $('#fromCount').val();
        //var countTo = $('#toCount').val();
        $.ajax('<?php echo url()?>/admin/reportingDelivery',{
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
                factor_id:facId,
                branch:selectedVal,
                food:foods,
                menus:menu
            },
            success:function(data){
                $('#reportResult').html(data.content);
            }
        });
    }
</script>