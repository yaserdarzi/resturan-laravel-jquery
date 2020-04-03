<form id="gMap">
    <label for="lat">latitude</label>
    <input type="text" name="lat"  id="lat" style="margin:6px;padding:4px;" value="<?php echo $info->lat?>">
    <label for="lang">longitude</label>
    <input type="text" name="lang" id="lang" style="margin:6px;padding:4px;" value="<?php echo $info->lang?>">
</form>
<a href="#" id="submitGmap">ثبت</a>
<span id="successMessage">&nbsp;</span>
<script>
    $('#submitGmap').on('click',function(){
       ajaxyFormData('gMap','<?php echo url()?>/admin/googleMap',false);
        cleanForm('gMap');
        $('#successMessage').html('با موفقیت ثبت شد.');
    });
</script>