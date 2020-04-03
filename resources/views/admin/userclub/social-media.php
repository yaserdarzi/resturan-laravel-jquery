<div>
  <a href="#" id="add">افزودن</a>
</div>
<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
  <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">عنوان</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">آیکون</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">عملیات</li>
</ul>
<?php
if (isset($fields)){
  $i=1;
  foreach($fields as $field){
    ?>
    <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
      <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i;?></li>
      <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->title;?></li>
      <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $field->icon;?></li>
      <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $field->url;?></li>
      <li style="padding:12px 8px;width:200px;display: inline-block;"><a href="javascript:void(0);" title="ویرایش" onclick="editsocial('<?php echo $field->id;?>')">ویرایش</a></li>/<li style="padding:12px 8px;width:200px;display: inline-block;"><a href="javascript:void(0);" class="jtrashicon" title="حذف" onclick="deletecost('<?php echo $field->id;?>')">حذف</a>
    </ul>
    <?php
    $i++;
  }
}
?>
<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#add').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/new-social-media','ReportDialog');
      setDialog('ReportDialog',600,400);
    });
  });

  function  deletecost(id){
    $('#loading').show();
    ajaxSendDataWithOutBack({
      itemId:id
    },'<?php echo url()?>/admin/delete-social-media');
    setTimeout("responder('social-medias')",1500);
    setTimeout("$('#loading').hide()",1600);
  }

  function editsocial(id){
    ajaxRequest('<?php echo url()?>/admin/edit-social-media/'+id,'ReportDialog');
    setDialog('ReportDialog',600,400);
  }
</script>