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
" href="#" id="add">ثبت</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>توضیحات</th>
            <th class="jaction">عملیات</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ردیف</th>
            <th>عنوان</th>
            <th>توضیحات</th>
            <th class="jaction">عملیات</th>
          </tr>
          </tfoot>
          <tbody>
<?php
if (isset($fields)){
  $i=1;
  foreach($fields as $field){
    ?>
    <tr>
      <td ><?php echo $i;?></td>
      <td ><?php echo $field->title;?></td>
      <td ><?php echo $field->desc;?></td>
      <td><a href="javascript:void(0);" class="jtrashicon" title="حذف" onclick="deletemastcat('<?=$field->id ?>}')"><i class="fa fa-trash"></i></a><a
            href="javascript:void(0);" title="ویرایش" onclick="editMatCat('<?=$field->id?>')"><i class="fa fa-pencil"></i></a></td>
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
<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#add').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/add-mat-cat','ReportDialog');
      setDialog('ReportDialog',600,400);
    });
  });

  function deletemastcat(id){
    $('#loading').show();
    ajaxSendDataWithOutBack({
      itemId:id
    },'<?php echo url()?>/admin/delete-matcat');
    setTimeout("responder('mat-cat')",1500);
    setTimeout("$('#loading').hide()",1600);
  }

  function editMatCat(id){
    ajaxRequest('<?php echo url()?>/admin/edit-mat-group/'+id,'ReportDialog');
    setDialog('ReportDialog',600,400);
  }

</script>