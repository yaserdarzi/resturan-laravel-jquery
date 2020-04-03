<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
  <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
  <li style="display: inline-block;padding:10px 8px;width:350px;">نوع سفارش</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">مجموع تعداد</li>
</ul>
<?php
$title = ['پیش سفارش','حضوری','بیرون بر با پیک','بیرون بر حضوری'];
$data = [$preOrder,$inside,$outside,$present];
if (isset($preOrder)){
  ?>
  <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
    <li style="display: inline-block;padding:10px 8px;width:35px;">1</li>
    <li style="display: inline-block;padding:10px 8px;width:350px;">پیش سفارش</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $preOrder;?></li>
  </ul>
  <?php
}
if (isset($inside)){
  ?>
  <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
    <li style="display: inline-block;padding:10px 8px;width:35px;">2</li>
    <li style="display: inline-block;padding:10px 8px;width:350px;">حضوری</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $inside;?></li>
  </ul>
  <?php
}
if (isset($outside)){
  ?>
<ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
<li style="display: inline-block;padding:10px 8px;width:35px;">3</li>
<li style="display: inline-block;padding:10px 8px;width:350px;">بیرون بر با پیک</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $outside;?></li></ul>
</ul>
  <?php
}

if (isset($present)){
  ?>
  <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
    <li style="display: inline-block;padding:10px 8px;width:35px;">4</li>
    <li style="display: inline-block;padding:10px 8px;width:350px;">بیرون بر حضوری</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $present;?></li>
  </ul>
  <?php
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
    $('#export').on('click',function(){
      var fromi = $('#datepicker0').val();
      var toi = $('#datepicker1').val();
      $.ajax('<?php echo url();?>/admin/exportXls',{
        dataType:'json',
        data:{
          fromDate:fromi,
          toDate:toi
        },
        success:function(data){
          alert(data.YES);
        }
      });
    });
  });
</script>
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