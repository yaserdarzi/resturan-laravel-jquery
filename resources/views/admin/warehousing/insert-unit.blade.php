<form id="unitForm">
  <label for="title">عنوان</label>

  @if(isset($unit) && $unit!="")
    <input type="hidden" name="edit" value="{{$unit->id}}">
  @endif

  <input type="text" id="title" name="title" style="padding:4px;width:200px;color:#2f2f2f;" value="{{isset($unit) ? $unit->title : ''}}" ><br>
  <label for="desc">توضیحات</label>
  <input type="text" id="desc" name="desc" style="padding:4px;width:200px;color:#2f2f2f;" value="{{isset($unit) ? $unit->desc : ''}}" ><br>
</form>
<a href="#" class="jsubmit" id="unitSubmit"><i class="fa fa-check"></i></a>
<script>
  $(function(){
    $('#unitSubmit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('unitForm','<?php echo url()?>/admin/new-unit',true,'unitDialog');
      setTimeout("responder('add-unit')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>