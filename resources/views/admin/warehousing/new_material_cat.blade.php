<form id="myForm">
  @if(isset($mat) && $mat!="")
  <input type="hidden" value="{{$mat->id}}" name="edit">
  @endif
  <label for="title">عنوان</label>
  <input id="title" name="title" style="width:200px;padding:4px;margin:4px;color:#2f2f2f" value="{{isset($mat->title) ? $mat->title : ''}}" ><br>
  <label for="desc">توضیحات</label>
  <input id="desc" name="desc" style="width:200px;padding:4px;margin:4px;color:#2f2f2f" value="{{isset($mat->desc) ? $mat->desc : ''}}" ><br><br><br>
</form>
<a href="#" class="jsubmit" id="Submit"><i class="fa fa-check"></i></a>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#Submit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('myForm','<?php echo url()?>/admin/update-mat-cat',true,'ReportDialog');
      setTimeout("responder('mat-cat')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>