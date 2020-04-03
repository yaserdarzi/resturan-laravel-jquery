<form id="mLoanForm">
    <label for="amount">مبلغ:</label>
    <input type="text" style="width: 100px;color:#111;padding:4px;margin:4px;" id="amount" name="amount">
    <label for="account">حساب:</label>
    <select name="account" id="account" style="width:120px;">
        <?php
        if (isset($account)){
            foreach($account as $acc){
                ?>
                <option value="<?php echo $acc->id?>"><?php echo $acc->name?></option>
                <?php
            }
        }
        ?>
    </select>
    <label for="loanDate">تاریخ وام:</label>
    <input type="text" id="loanDate" name="loanDate" style="width: 100px;color:#111;padding:4px;margin:4px;">
    <label for="payBackDate">تاریخ سررسید:</label>
    <input type="text" id="payBackDate" name="payBackDate" style="width: 100px;color:#111;padding:4px;margin:4px;">
    <input type="hidden" name="id" value="<?php echo $staff_id?>">
    <a href="#" id="summit">ثبت</a>
</form>
<script>
    $('#loanDate').datepicker({
        changeMonth:true,
        changeYear:true,
        dateFormat:'yy/mm/dd'
    });
    $('#payBackDate').datepicker({
        changeMonth:true,
        changeYear:true,
        dateFormat:'yy/mm/dd'
    });
    $('#summit').on('click',function(){
        ajaxyFormData('mLoanForm','<?php echo url()?>/admin/addLoan',false);
        cleanForm('mLoanForm');
        ajaxRequest('<?php echo url()?>/admin/getLoans/<?php echo $staff_id?>','staffLoanSummary');
    });
</script>
