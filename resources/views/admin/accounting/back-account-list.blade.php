<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
  <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">بانک</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">شماره حساب</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">شماره شبا</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">نوع حساب</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">موجودی</li>
  <li style="display: inline-block;padding:10px 8px;width:200px;">عملیات</li>
</ul>
<?php
  if (isset($accounts)){
    $i=1;
    foreach($accounts as $account){
      ?>
      <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
        <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i;?></li>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $account->name;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $account->account_number;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $account->sheba_number;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $account->account_type;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $account->cash;?></li>
        <li style="padding:12px 8px;width:200px;display: inline-block;"><a href="javascript:void(0);" onclick="backaccount('{{$account->id}}}')">بازگشت</a>
      </ul>
      <?php
      $i++;
    }
  }
?>
<div id="accountReportDialog" style="display: none;padding:8px;"></div>
<script>
  function backaccount(id){
    $('#loading').show();
    ajaxSendDataWithOutBack({
      itemId:id
    },'<?php echo url()?>/admin/back-account');
    setTimeout("responder('back-accounting')",1500);
    setTimeout("$('#loading').hide()",1600);
  }
</script>
