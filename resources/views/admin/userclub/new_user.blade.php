<form id="form">
  @if(isset($customer))
  <input type="hidden" value="{{$customer->id}}" name="edit" id="edit">
  @endif
  <label for="name">نام و نام خانوداگی</label>
  <input type="text" id="name" name="name" value="{{isset($customer) ? $customer->name : ''}}" style="padding:8px;width: 200px;color:#2f2f2f"><br><br>
  <label for="phone">شماره تماس</label>
  <input type="text" id="phone" name="phone" value="{{isset($customer) ? $customer->phone : ''}}" style="padding:8px;width: 200px;color:#2f2f2f"><br><br>
</form>


<a href="#" class="jsubmit" id="Submit"><i class="fa fa-check"></i></a>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $('#priceForUnit').on('keyup',function(){
    var priceForUnit =$('#priceForUnit').val();
    var amount =$('#amount').val();
    var price = priceForUnit*amount;
    $('#totalPrice').val(price);
  });

  $(function(){
    $('#Submit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('form','<?php echo url()?>/admin/submit-user',true,'ReportDialog');
      setTimeout("responder('customers')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>