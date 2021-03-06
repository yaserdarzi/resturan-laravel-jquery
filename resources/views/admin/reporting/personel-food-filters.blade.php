<div class="row jfirst-child">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class=" portlet light jform">

      <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
        <?php echo renderFilters(url().'/admin/filterStaffOrdersReport','reportResult',true,true,'datepicker0','datepicker1');?>
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
        <input class="zinput" data-filter="fromCount" id="fromCount" placeholder="حداقل تعداد غذا">
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <input class="zinput" data-filter="toCount" id="toCount" placeholder="حداکثر تعداد غذا">
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <input class="zinput" data-filter="fromFee" id="fromFee" placeholder="حداقل مبلغ">
      </div>

      <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
        <input class="zinput" data-filter="toFee" id="toFee" placeholder="حداکثر مبلغ">
      </div>

        <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
          <select class="multy" id="orderTypes" multiple>
            <?php
            if (isset($orderTypes)){
              foreach($orderTypes as $orderType){
                  ?>
                  <option value="<?php echo $orderType->id?>"><?php echo $orderType->title?></option>
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
    $('#orderTypes').multiselect({
      nonSelectedText: 'لطفا محل تهیه را انتخاب کنید',
      selectAllText: 'همه موارد',
      allSelectedText: 'همه موارد'
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
    var countFrom = $('#fromCount').val();
    var countTo = $('#toCount').val();
    var feeFrom = $('#fromFee').val();
    var feeTo = $('#toFee').val();
    var orderType = $('#orderTypes').val();

    $.ajax('<?php echo url()?>/admin/reportingStaffOrders',{
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
        orderTypes:orderType
      },
      success:function(data){
        $('#reportResult').html(data.content);
      }
    });
  }
</script>