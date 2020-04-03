<div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat green-haze">
      <div class="visual">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <div class="details">
        <div class="number"><?php echo $thisWeekSales?> تومان</div>
        <div class="desc">کل فروش هفته جاری</div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat green-haze">
      <div class="visual">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <div class="details">
        <div class="number"><?php echo $thisMonthSales?> تومان</div>
        <div class="desc">کل فروش این ماه</div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="dashboard-stat green-haze">
      <div class="visual">
        <i class="fa fa-shopping-cart"></i>
      </div>
      <div class="details">
        <div class="number"><?php echo $totalOrders?> عدد</div>
        <div class="desc">کل سفارشات ثبت شده</div>
      </div>
    </div>
  </div><br><br><br><br><br><br><br><br>
  <div style="display: block;margin-right:25px;">
    <input style="width:200px;height:35px;padding: 8px;direction: rtl;text-align:right" id="datepicker0" type="text" placeholder="از تاریخ">&nbsp;&nbsp;
    <input style="width:200px;height:35px;padding:8px;direction: rtl;text-align:right" id="datepicker1" type="text" placeholder="تا تاریخ">
    <label for="food">به تفکیک غذا</label>
    <input style="padding:8px;margin:12px;" onchange="mFilter('food')" type="checkbox" id="food" name="food">
    <label for="order">نوع سفارش</label>
    <input style="padding:8px;margin:12px;" onchange="mFilter('order')" type="checkbox" id="order" name="order">
    <label for="pay">پرداخت</label>
    <input style="padding:8px;margin:12px;" onchange="mFilter('pay')" type="checkbox" id="pay" name="pay">
  </div>
  <div style="margin-top:24px;margin-right:25px;display: inline-block">
    <label for="countFrom">تعداد اقلام</label>
    <input name="countFrom" id="countFrom" placeholder="از" style="padding:4px;margin:12px;">
    <input name="countTo" id="countTo" placeholder="تا" style="padding:4px;margin:12px;">
    <a href="#" id="filterCount" style="color:#f80;">فیلتر</a>
  </div>
  <div style="margin-top:24px;margin-right:25px;display: inline-block">
    <label>مبلغ سفارش</label>
    <input name="priceFrom" id="priceFrom" placeholder="از" style="padding:4px;margin:12px;">
    <input name="priceTo" id="priceTo" placeholder="تا" style="padding:4px;margin:12px;">
    <a href="#" id="filterPrice" style="color:#f80;">فیلتر</a>
  </div>
  <div style="margin-top:24px;margin-right:25px;display: inline-block">
    <label>ساعت ثبت سفارش</label>
    <input name="timeFrom" id="timeFrom" placeholder="از" style="padding:4px;margin:12px;">
    <input name="timeTo" id="timeTo" placeholder="تا" style="padding:4px;margin:12px;">
    <a href="#" id="filterTime" style="color:#f80;">فیلتر</a>
  </div>
</div>
<div id="contentContainer" style="margin-top:24px;padding:16px;"></div>

<script>
  $(function(){
    $('#datepicker0').datepicker({
      changeMonth: true,
      changeYear: true
    });
    $('#datepicker1').datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<script>
  $(function(){
    $('#timeFrom').timepicker({ 'timeFormat': 'H:i:s' });
    $('#timeTo').timepicker({ 'timeFormat': 'H:i:s' });
  });
</script>

<script>
  $(function(){
    $('#filterCount').on('click',function(){
        var countFrom = $('#countFrom').val();
        var countTo = $('#countTo').val();
      $.ajax('<?php echo url();?>/admin/manycount',{
          dataType:'json',
        data:{
          fromCount:countFrom,
          toCount:countTo
        },
        success:function(data){
          $('#contentContainer').html(data.content);
        }
      });
    });
    $('#filterPrice').on('click',function(){
      var priceFrom = $('#priceFrom').val();
      var priceTo = $('#priceTo').val();
      $.ajax('<?php echo url();?>/admin/pricecount',{
        dataType:'json',
        data:{
          fromPrice:priceFrom,
          toPrice:priceTo
        },
        success:function(data){
          $('#contentContainer').html(data.content);
        }
      });
    });
    $('#filterTime').on('click',function(){
      var timeFrom = $('#timeFrom').val();
      var timeTo = $('#timeTo').val();
      $.ajax('<?php echo url();?>/admin/timecount',{
        dataType:'json',
        data:{
          fromTime:timeFrom,
          toTime:timeTo
        },
        success:function(data){
          $('#contentContainer').html(data.content);
        }
      });
    });
  });
</script>
<script>
  function mFilter(id){
    var fromi = $('#datepicker0').val();
    var toi = $('#datepicker1').val();
    if ($('#'+id).is(':checked')){
      $.ajax('<?php echo url()?>/admin/report',{
        dataType:'json',
        data:{
          key:id,
          fromDate:fromi,
          toDate:toi
        },
        success:function(data){
          $('#contentContainer').html(data.content);
        }
      });
    }
  }
</script>