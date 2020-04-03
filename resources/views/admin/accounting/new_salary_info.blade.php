<form id="sallaryForm">
    <label for="salaryThisMonth">حقوق قابل پرداخت : </label>
    <input type="text" id="salaryThisMonth" name="cash" style="width:140px;padding:4px;" value="<?php echo $salarygrid->cash?>">تومان
   <input type="hidden" id="staffId" name="staffId" value="<?php echo $salarygrid->id?>">
    <label>پرداخت از طریق حساب : </label>
    <select id="accounts" name="accounts" style="width:120px;">
        <?php
            if (isset($accounts)){
                foreach($accounts as $account){
                    ?>
                        <option value="<?php echo $account->id?>"><?php echo $account->name?></option>
                    <?php
                }
            }
        ?>
    </select>
    </form>
<a href="#" class="jsubmit" id="paySubmit"><i class="fa fa-check"></i></a>
<script>
    $(function(){
        $('#paySubmit').on('click',function(){
            $('#loading').show();
            ajaxyFormData('sallaryForm','<?php echo url()?>/admin/paySalary',true,'sallaryDialog');
            setTimeout("responder('pay-salary')",1500);
            setTimeout("$('#loading').hide()",1600);
        });
    });
</script>