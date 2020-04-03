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
" href="#" id="add">معرفی</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >سمت</th>
            <th >شماره بیمه</th>
            <th >تاریخ شروع فعالیت</th>
            <th >حقوق</th>
            <th class="jaction">عملیات</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >سمت</th>
            <th >شماره بیمه</th>
            <th >تاریخ شروع فعالیت</th>
            <th >حقوق</th>
            <th class="jaction">عملیات</th>
          </tr>
          </tfoot>
          <tbody>
<?php
  if (isset($staff)){
    $i=1;
    foreach($staff as $stf){
      ?>
      <tr>
        <td ><?php echo $i;?></td>
        <td ><?php echo $stf->name;?></td>
        <td ><?php echo $stf->position?></td>
        <td ><?php echo $stf->insurance_code?></td>
        <td ><?php echo $stf->bg_date?></td>
        <td ><?php echo $stf->salary?></td>
        <td ><a href="javascript:void(0);" title="ویرایش" onclick="editstaff('{{$stf->id}}}')"><i class="fa fa-pencil"></i></a><a href="javascript:void(0);" class="jtrashicon" title="حذف" onclick="deleteStaff('{{$stf->id}}}')"><i class="fa fa-trash"></i></a><a href="javascript:;" onclick="showEve('{{$stf->id}}')"><i class="fa fa-files-o"></i></a></td>
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


<div id="Dialog" style="display: none; padding:8px;"></div>
<script>
  $(function(){
    $('#add').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/new-add-personel','Dialog');
      setDialog('Dialog',600,400);
    });
  });

  function editstaff(id){
    ajaxRequest('<?php echo url()?>/admin/new-edit-personel/'+id,'Dialog');
    setDialog('Dialog',600,400);
  }

  function deleteStaff(id){
    $('#loading').show();
    ajaxSendDataWithOutBack({
      itemId:id
    },'<?php echo url()?>/admin/delete-staff');
    setTimeout("responder('personelList')",1500);
    setTimeout("$('#loading').hide()",1600);
  }

  function showEve(id){
    window.open('<?php echo url()?>/admin/eve/'+id);
  }

</script>
