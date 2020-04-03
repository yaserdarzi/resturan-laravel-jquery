<form id="newCostForm">
  <label for="group">نوع هزینه:</label>
  @if(isset($transactions))
    <input type="hidden" value="{{$transactions->id}}" name="edit" id="edit">
  @endif
  <select id="group" name="group" style="width: 140px;">
    <?php
    if (isset($fields)){
    foreach($fields as $field){
    ?>
    @if(isset($transactions))
      @if($transactions->subType == $field->id)
        <option value="<?php echo $field->id?>" selected><?php echo $field->title?></option>
      @else
        <option value="<?php echo $field->id?>"><?php echo $field->title?></option>
      @endif
      @else
        <option value="<?php echo $field->id?>"><?php echo $field->title?></option>
    @endif
    <?php
    }
    }
    ?>
  </select><br>
  <label for="bank">حساب بانکی:</label>
  <select id="bank" name="bank" style="width: 140px;">
    <?php
    if (isset($accounts)){
    foreach($accounts as $account){
    ?>
      @if(isset($transactions))
        @if($transactions->acc_id == $account->id)
          <option value="<?php echo $account->id?>" selected><?php echo $account->name?></option>
        @else
          <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
        @endif
        @else
        <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
      @endif
    <?php
    }
    }
    ?>
  </select><br>
  <label for="cash">مبلغ:</label>
  <input id="cash" type="text" name="cash" style="width:200px;color:#2f2f2f;margin:4px;padding:4px;" value="{{isset($transactions) ? $transactions->cash : ''}}"><br>
  <label for="desc">توضیحات:</label>
  <input id="desc" type="text" name="desc" style="width:200px;color:#2f2f2f;margin:4px;padding:4px;" value="{{isset($transactions) ? $transactions->desc : ''}}"><br>
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
<script>
  $('#submit').on('click',function(){
    $('#loading').show();
    ajaxyFormData('newCostForm','<?php echo url()?>/admin/submit-new-cost',true,'costReportDialog');
    setTimeout("responder('accounting-add-cost')",1500);
    setTimeout("$('#loading').hide()",1600);
  });
</script>