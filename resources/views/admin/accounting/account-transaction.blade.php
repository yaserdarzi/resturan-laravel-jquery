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
      <a class="submit jtimerange" style="position: absolute; top: 15px; z-index: 99; width: 160px;    padding: 1.5px 10px;
" href="#" id="newTransaction">انتقال وجه بین حسابها</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>ردیف</th>
            <th>از حساب</th>
            <th>به حساب</th>
            <th>مبلغ</th>
            <th>تاریخ</th>
            <th>توضیحات</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>ردیف</th>
            <th>از حساب</th>
            <th>به حساب</th>
            <th>مبلغ</th>
            <th>تاریخ</th>
            <th>توضیحات</th>
          </tr>
          </tfoot>
          <tbody>
<div>
  <a href="#"
</div>
<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">

</ul>
<?php
if (isset($fields)){
  $i=1;
  $j=0;
  foreach($fields as $field){
    ?>
    <tr >
      <td><?php echo $i;?></td>
      <td><?php echo $sourceAccounts[$j]->name;?></td>
      <td ><?php echo $destAccounts[$j]->name;?></td>
      <td ><?php echo $field->cash;?></td>
      <td ><?php echo $dates[$j];?></td>
      <td ><?php echo $field->desc;?></td>
    </tr>
    <?php
    $i++;
    $j++;
  }
}
?>

</tbody>
</table>
</div>
</div>
</div>
</div>

<div id="transDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#newTransaction').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/new-trans-form','transDialog');
      setDialog('transDialog',600,400);
    });
  });
</script>

