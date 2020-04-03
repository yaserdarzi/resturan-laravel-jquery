<form id="editLoanForm">
    <select name="account" style="width: 120px;margin:8px">
        @foreach($accounts as $account)
            @if($account->id == $field->account_id)
                <option value="{{$account->id}}" selected>{{$account->name}}</option>
            @else
                <option value="{{$account->id}}">{{$account->name}}</option>
            @endif
        @endforeach
    </select>
    <input type="hidden" value="{{$field->id}}" name="loan_id">
    <label for="amount">مبلغ</label>
    <input name="amount" id="amount" style="width: 200px;" value="{{$field->amount}}"><br>
    <label for="loan_date">تاریخ وام</label>
    <input name="loan_date" id="loan_date" value="{{g2j($field->loan_date)}}" style="width: 200px;">
    <label for="payback_date">تاریخ بازپرداخت</label>
    <input name="payback_date" id="payback_date" value="{{g2j($field->payback_date)}}" style="width: 200px;"><br><br><br>
</form>
<a href="#" class="jsubmit" id="editLoanFormSubmit"><i class="fa fa-check"></i></a>
<script>
    $('#loan_date,#payback_date').datepicker({
        changeMonth:true,
        changeYear:true,
        dateFormat:'yy/mm/dd'
    });
    $('#editLoanFormSubmit').on('click',function(){
        $('#loading').show();
       ajaxyFormData('editLoanForm','<?php echo url()?>/admin/submit-edit-loan',true,'editLoanDialog');
       setTimeout(
            function(){
                ajaxRequest('<?php echo url()?>/admin/getLoans/<?php echo $staff_id?>','staffLoanSummary');
            },1000);
        setTimeout("$('#loading').hide()",1100);
    });
</script>