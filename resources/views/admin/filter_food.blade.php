<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
  <li style="display: inline-block;padding:10px 8px;width:100px;">ردیف<div style="width:20px;height:20px;display: inline-block;"><img onclick="sortTable('ASC','id','z_orders','admin.filter_food')" style="width:20px;height:20px;cursor:pointer;" src="{{URL::asset('assets/images/up.png')}}"><img onclick="sortTable('DESC','id','z_orders','admin.filter_food')" style="width:20px;height:20px;cursor:pointer;" src="{{URL::asset('assets/images/down.png')}}"></div></li>
  <li style="display: inline-block;padding:10px 8px;width:350px;">نام غذا</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">مجموع تعداد</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">مجموع فروش</li>
</ul>
<?php
if (isset($fields)) {
  $i=1;
  $title=array();
  $data=array();
  if (!isset($orderBy)){
    $orderBy = 'ASC';
  }
  foreach ($fields as $field) {
    $newFoods = DB::table('z_food_orders')->whereOrderId($field->id)->orderBy('id',$orderBy)->get();
    foreach($newFoods as $newFood){
      $fname = DB::table('z_foods')->whereId($newFood->food_id)->first();
      if (isset($foodname[$fname->title])){
        continue;
      }else{
        $foodname[$fname->title] = $fname->title;
      }
      $sum = DB::table('z_food_orders')->whereFoodId($newFood->food_id)->sum('foodcount');
      $title[] = $fname->title;
      $data[] = $sum;
      ?>
      <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
        <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $i;?></li>
        <li style="padding:12px 8px;width:350px;display: inline-block;"><?php echo $fname->title;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $sum;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $fname->price * $sum;?></li>
      </ul>
      <?php
      $i++;
    }
  }
}
?>
<ul class="nav nav-tabs">
  <li class="nav" ><a id="aCircle" data-toggle="tab" href="#circle">نمودار دایره ای</a></li>
  <li class="nav"><a id="aBar" data-toggle="tab" href="#bar">نمودار میله ای</a></li>
  <li class="nav"><a id="aLine" data-toggle="tab" href="#line">نمودار خطی</a></li>
</ul>
<div id="circle" style="visibility: hidden;display: inline-block;">
  <?php echo pieChart($title,$data,'myCanvas0');?>
    <a href="#" onclick="takePicture('circle')" style="color:#f80;">عکس</a><br>
  <div>
    <div id="legend" style=" display: inline-block;width: 250px;height: 40px;margin-right: 5px;direction: ltr;"></div>
  </div>
</div>
<div id="bar" style="visibility: hidden;display: inline-block">
  <?php echo chart($title,$data,'Bar','myCanvas1');?>
    <a href="#" onclick="takePicture('bar')" style="color:#f80;">عکس</a>
</div>
<div id="line" style="visibility: hidden;display: inline-block">
  <?php echo chart($title,$data,'Line','myCanvas2');?>
  <a href="#" onclick="takePicture('line')" style="color:#f80;">عکس</a>
</div>

<script>
  $(function(){
    $('#aCircle').on('click',function(){
      $('#line').css('visibility','hidden');
      $('#bar').css('visibility','hidden');
      $('#circle').css('visibility','visible');
    });
    $('#aBar').on('click',function(){
      $('#circle').css('visibility','hidden');
      $('#line').css('visibility','hidden');
      $('#bar').css('visibility','visible');
    });
    $('#aLine').on('click',function(){
      $('#circle').css('visibility','hidden');
      $('#bar').css('visibility','hidden');
      $('#line').css('visibility','visible');
    });
  });
</script>
  <script>
    function takePicture(id){
      var element= $('#'+id);
      html2canvas(element,{
        onrendered: function( canvas ) {
          var img = canvas.toDataURL()
          window.open(img);
        },
        background:'#fff'
      });
    }
  </script>
<script>
  function sortTable(type,field,dbTable,view){
    var dateFrom = $('#datepicker0').val();
    var dateTo = $('#datepicker1').val();
    var timeFrom = $('#timepicker0').val();
    var timeTo = $('#timepicker1').val();
    $.ajax('<?php echo url()?>/admin/sort-table',{
      dataType:'json',
      data:{
        field_name:field,
        sortType:type,
        table_name:dbTable,
        finalView:view,
        fromDate:dateFrom,
        toDate:dateTo,
        fromTime:timeFrom,
        toTime:timeTo
      },
      success:function(data){
        $('#reportResult').html(data.content);
      }
    });
  }
</script>