<form id="accountForm">
  @if(isset($account) && $account!="")
  <input type="hidden" value="{{$account->id}}" name="edit">
  @endif
  <label for="name">نام بانک:</label>
  <input type="text" id="name" name="name" style="padding:8px;width:200px;margin:4px;color:#2f2f2f;" value="{{isset($account->name) ? $account->name : ''}}" ><br>
  <label for="acc_number">شماره حساب</label>
  <input type="text" id="acc_number" name="acc_number" style="padding:8px;width:200px;margin:4px;color:#2f2f2f;" value="{{isset($account->account_number) ? $account->account_number : ''}}"  ><br>
  <label for="sheba">شماره شبا</label>
  <input type="text" id="sheba" name="sheba" style="padding:8px;width:200px;margin:4px;color:#2f2f2f;" value="{{isset($account->sheba_number) ? $account->sheba_number : ''}}" ><br>
  <label for="acc_type">نوع حساب</label>
  <input type="text" id="acc_type" name="acc_type" style="padding:8px;width:200px;margin:4px;color:#2f2f2f;" value="{{isset($account->account_type) ? $account->account_type : ''}}" ><br>
  <label for="card_number">شماره کارت</label>
  <input type="text" id="card_number" name="card_number" style="padding:8px;width:200px;margin:4px;color:#2f2f2f;" value="{{isset($account->card_number) ? $account->card_number : ''}}" ><br>
  <label for="check">چک دارد</label>
  <input type="checkbox" name="is_check" id="check"  ><br>
</form>
<a href="#" class="jsubmit" id="mSubmit"><i class="fa fa-check"></i></a>
<script>
  $('#mSubmit').on('click',function(){
    $('#loading').show();
    ajaxyFormData('accountForm','<?php echo url()?>/admin/submit-account',true,'accountReportDialog');
    setTimeout("responder('add-account')",1500);
    setTimeout("$('#loading').hide()",1600);
  });
</script>
