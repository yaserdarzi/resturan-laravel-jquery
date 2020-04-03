<form action="<?php echo url()?>/admin/area-image-upload" method="post" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{Session::token()}}">
  <div id="fileContainer" style="display: inline-block">
    <input type="text" name="title[]" style="width:200px;padding:4px;margin:4px" placeholder="عنوان">
    <input type="text" name="desc[]" style="width:200px;padding:4px;margin:4px" placeholder="توضیحات">
    <input type="file" name="image[]" style="display: inline-block;width:200px;">
    <i class="fa fa-plus" style="cursor: pointer;" id="newImageFile">&nbsp;</i>
  </div><br><br>
  <button type="submit">ثبت</button>
</form>
<script>
  $('#newImageFile').on('click',function(){
    $('#fileContainer').append('<br><input type="text" name="title[]" style="width:200px;padding:4px;margin:4px" placeholder="عنوان"><input type="text" name="desc[]" style="width:200px;padding:4px;margin:4px" placeholder="توضیحات"><input type="file" name="image[]" style="display: inline-block;width:200px;">');
  });
</script>