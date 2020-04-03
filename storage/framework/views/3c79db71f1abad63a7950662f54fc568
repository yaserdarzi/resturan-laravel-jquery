<form id="transForm">
  <label for="fromBank">از حساب:</label>
  <select name="fromBank" id="fromBank" style="width:140px;">
    <?php
    if (isset($accounts)) {
      foreach ($accounts as $account) {
        ?>
        <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
        <?php
      }
    }
    ?>
  </select><br>
  <label for="toBank">به حساب:</label>
  <select name="toBank" id="toBank" style="width:140px;">
    <?php
    if (isset($accounts)) {
      foreach ($accounts as $account) {
        ?>
        <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
        <?php
      }
    }
    ?>
  </select><br>
  <label for="cash">مبلغ:</label>
  <input id="cash" type="text" name="cash" style="width:200px;padding:4px;margin:4px;color:#2f2f2f;"><br>
  <label for="desc">توضیحات:</label>
  <input type="text" name="desc" id="desc" style="width:200px;padding:4px;margin:4px;color:#2f2f2f;"><br>
</form>
<a href="#" class="jsubmit" id="transSubmit"><i class="fa fa-check"></i></a>
<script>
  $(function(){
      $('#transSubmit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('transForm','<?php echo url()?>/admin/insert-trans',true,'transDialog');
        setTimeout("responder('account-transaction')",1500);
        setTimeout("$('#loading').hide()",1600);
      });
  });
</script>