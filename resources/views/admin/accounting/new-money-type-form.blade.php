<form id="moneyForm">
  @if(isset($income) && $income!="")
    <input type="hidden" value="{{$income->id}}" name="edit">
  @endif
  <label for="title">عنوان</label>
  <input id="title" name="title" style="width:200px;color:#2f2f2f;padding:4px;margin:6px;" value="{{isset($income) ? $income->title : ''}}" ><br>
  <label for="desc">توضیحات</label>
  <input id="desc" name="desc" style="width:200px;color:#2f2f2f;padding:4px;margin:6px;" value="{{isset($income) ? $income->desc : ''}}"><br>
</form>
<a href="#" class="jsubmit" id="moneySubmit"><i class="fa fa-check"></i></a>
<script>
  $(function(){
    $('#moneySubmit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('moneyForm','<?php echo url()?>/admin/submit-money-type',true,'moneyDialog');
      setTimeout("responder('add-money-type')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>