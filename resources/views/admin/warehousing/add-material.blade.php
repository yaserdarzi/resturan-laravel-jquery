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
" href="#"  id="addmaterial">ثبت مواد</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >مقدار</th>
            <th >دسته بندی</th>
            <th >واحد</th>
            <th class="jaction">عملیات</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th >ردیف</th>
            <th >نام</th>
            <th >مقدار</th>
            <th >دسته بندی</th>
            <th >واحد</th>
            <th class="jaction">عملیات</th>
          </tr>
          </tfoot>
          <tbody>
<?php
if (isset($groups)){
  $i=0;
  $counter=1;
  foreach($materials as $material){
    ?>
    <tr>
      <td ><?php echo $counter;?></td>
      <td ><?php echo $material->name;?></td>
      <td ><?php echo $material->amount;?></td>
      <td ><?php echo $groups[$i]->title;?></td>
      <td ><?php echo $eachUnit[$i]->title;?></td>
      <td ><a href="#" title="ویرایش" onclick="editMatCat('<?php echo $material->id?>')"><i class="fa fa-pencil"></i></a></td>
    </tr>
    <?php
    $i++;
    $counter++;
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
    $('#addmaterial').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/add-material','ReportDialog');
      setDialog('ReportDialog',600,400);
    });
  });

  function editMatCat(id){
    ajaxRequest('<?php echo url()?>/admin/edit-material/'+id,'ReportDialog');
    setDialog('ReportDialog',600,400);
  }

</script>