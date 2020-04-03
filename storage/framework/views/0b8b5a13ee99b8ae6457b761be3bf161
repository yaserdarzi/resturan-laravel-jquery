<div class="row jfirst-child">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class=" portlet light jform">

            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <?php echo renderFilters(url().'/admin/filterCostsReport','reportResult',true,true,'datepicker0','datepicker1');?>
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
                <input class="zinput" data-filter="transId" id="transId" placeholder="شماره تراکنش">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="fromFee" id="fromFee" placeholder="حداقل مبلغ">
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <input class="zinput" data-filter="toFee" id="toFee" placeholder="حداکثر مبلغ">
            </div>

            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-6">
                <select class="multy" id="subTypes" multiple>
                    <?php
                    if (isset($subTypes)){
                        foreach($subTypes as $subType){
                            ?>
                            <option value="<?php echo $subType->id?>"><?php echo $subType->title?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-9 col-xs-6">
                <select class="multy" id="accounts" multiple>
                    <?php
                    if (isset($accounts)){
                        foreach($accounts as $account){
                            ?>
                            <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
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
        $('#types').multiselect({
            nonSelectedText: 'لطفا یک دسته بندی انتخاب کنید',
            selectAllText: 'همه دسته بندی ها',
            allSelectedText: 'همه دسته بندی ها'
        });
        $('#subTypes').multiselect({
            nonSelectedText: 'لطفا یک زیر شاخه انتخاب کنید',
            selectAllText: 'همه زیرشاخه ها',
            allSelectedText: 'همه زیر شاخه ها'
        });

        $('#accounts').multiselect({
            nonSelectedText: 'لطفا یک حساب انتخاب کنید',
            selectAllText: 'همه حساب ها',
            allSelectedText: 'همه حساب ها'
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
    getAllReports();

    function getAllReports(){
        var dateFrom = $('#datepicker0').val();
        var dateTo = $('#datepicker1').val();
        var timeFrom = $('#timepicker0').val();
        var timeTo = $('#timepicker1').val();
        var feeFrom = $('#fromFee').val();
        var feeTo = $('#toFee').val();
        var trans_id = $('#transId').val();
        var subType = $('#subTypes').val();
        var account = $('#accounts').val();

        $.ajax('<?php echo url()?>/admin/reportingCosts',{
            dataType:'json',
            data:{
                fromDate:dateFrom,
                toDate:dateTo,
                fromTime:timeFrom,
                toTime:timeTo,
                fromFee:feeFrom,
                toFee:feeTo,
                transId:trans_id,
                subTypes:subType,
                accounts:account
            },
            success:function(data){
                $('#reportResult').html(data.content);
            }
        });
    }
</script>