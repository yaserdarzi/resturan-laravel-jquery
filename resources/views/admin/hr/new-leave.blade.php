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
      <a class="submit jtimerange" style="position: absolute; top: 15px; z-index: 99; width: 120px;    padding: 1.5px 10px;
" href="#" id="add">ثبت مرخصی</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >تاریخ شروع</th>
            <th >تاریخ پایان</th>
            <th >ساعت شروع</th>
            <th >ساعت پایان</th>
            <th >توضیحات</th>
            <th >وضعیت</th>
            <th class="jaction" >تغییر وضعیت</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >تاریخ شروع</th>
            <th >تاریخ پایان</th>
            <th >ساعت شروع</th>
            <th >ساعت پایان</th>
            <th >توضیحات</th>
            <th >وضعیت</th>
            <th class="jaction" >تغییر وضعیت</th>
          </tr>
          </tfoot>
          <tbody>
<?php
  if (isset($fields)){
    $i=0;
    $counter = 1;
    foreach($fields as $field){
        if (isset($staff_name[$i])){
      $date = explode('-',$field->from_date);
      $jDate = gregorian_to_jalali($date[0],$date[1],$date[2],'/');
      $toDate = explode('-',$field->to_date);
      $toJdate = gregorian_to_jalali($toDate[0],$toDate[1],$toDate[2],'/');
      ?>
      <tr>
        <td ><?php echo $counter;?></td>
        <td ><?php echo $staff_name[$i]->name?></td>
        <td ><?php echo $jDate?></td>
        <td ><?php echo $toJdate?></td>
        <td ><?php echo $field->from_time?></td>
        <td ><?php echo $field->to_time?></td>
        <td ><?php echo $field->desc?></td>
        <td ><?php echo $condition[$i]->title?></td>

        <td >
          <?php
          if ($condition[$i]->title=="ثبت شده")
          {
            ?>
            <a id="indicator" class="jactpayok" href="#" title="تایید شده" onclick="requestCoordinator('<?php echo $field->id?>','accept')"><i class="fa fa-check"></i></a>
            <a id="indicator" class="jactpayno" href="#" title="تایید نشده" onclick="requestCoordinator('<?php echo $field->id?>','reject')"><i class="fa fa-times"></i></a>
              <?php
          }
          ?>
          <?php
          if ($condition[$i]->title=="تایید شده")
          {
            ?>
            <a id="indicator" class="jactpayno" href="#" title="تایید نشده" onclick="requestCoordinator('<?php echo $field->id?>','reject')"><i class="fa fa-times"></i></a>
            <?php
          }
          ?>
          <?php
          if ($condition[$i]->title=="تایید نشده")
          {
            ?>
            <a id="indicator" class="jactpayok" href="#" title="تایید شده" onclick="requestCoordinator('<?php echo $field->id?>','accept')"><i class="fa fa-check"></i></a>
            <?php
          }
          ?>




        </td>

      </tr>
      <?php
      $i++;
      $counter++;
    }
  }
              }
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="dialog-parent" style="display: none;"></div>
<script>

  $(function(){
    $('#add').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/submit-new-leave','dialog-parent');
      setDialog('dialog-parent',600,400);
    });
  });

</script>
<script>
  function requestCoordinator(id,requestType){
    $('#loading').show();
    $.ajax('<?php echo url()?>/admin/change-vacation',{
      dataType:'json',
      data:{
        type:requestType,
        staff_id:id
      },
      success:function(data){
        $('#page-content').html(data.content);
      }
    });
    $('#loading').hide();
  }
</script>
