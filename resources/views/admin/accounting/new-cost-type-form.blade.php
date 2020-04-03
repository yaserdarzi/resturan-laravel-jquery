<form id="costForm">
  @if(isset($cost) && $cost!="")
    <input type="hidden" value="{{$cost->id}}" name="edit">
  @endif
  <label for="title">عنوان</label>
  <input id="title" name="title" style="width:200px;color:#2f2f2f;padding:4px;margin:6px;" value="{{isset($cost->title) ? $cost->title : ''}}"><br>
  <label for="desc">توضیحات</label>
  <input id="desc" name="desc" style="width:200px;color:#2f2f2f;padding:4px;margin:6px;" value="{{isset($cost->desc) ? $cost->desc : ''}}"><br>
</form>
<a href="#" class="jsubmit" id="costSubmit"><i class="fa fa-check"></i></a>
<script>
  $(function(){
    $('#costSubmit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('costForm','<?php echo url()?>/admin/submit-cost-type',true,'costDialog');
      setTimeout("responder('add-cost-type')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>