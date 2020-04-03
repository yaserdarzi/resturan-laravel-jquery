<div id="loanReport">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    if (!isset($orderField)){$orderField = "z_orders.date";}
    if (isset($fields) && count($fields) > 0){
        $i=1;
        $loanDate=array();
        $paybackDate=array();
        $real = array();
        $users= array();
        foreach ($fields as $field) {
            if ($field->payed==1){
                $label = 'پرداخت شده';
            }else{
                $label = 'پرداخت نشده';
            }
            if (!isset($loanDate[$field->loan_date])){
                $loanDate[$field->loan_date] = $field->loan_date;
                $loanDates[] = g2j($field->loan_date);
                $loanDateVals[$field->loan_date] = $field->amount;
            }else{
                $loanDateVals[$field->loan_date] += $field->amount;
            }
            if (!isset($paybackDate[$field->payback_date])){
                $paybackDate[$field->payback_date] = $field->payback_date;
                $payBackDates[] = g2j($field->payback_date);
                $payBackDatesVals[$field->loanId] = $field->amount;
            }else{
                $payBackDatesVals[$field->loanId] += $field->amount;
            }
            if (!isset($real[$field->loan_date])){
                $real[$field->loan_date] = $field->loan_date;
                $reals[] = g2j($field->payback_real_date);
                $realVals[$field->loan_date] = $field->amount;
            }else{
                $realVals[$field->loan_date] += $field->amount;
            }
            if (!isset($users[$field->name])){
                $users[$field->name] = $field->name;
                $user[] = $field->name;
                $userVals [$field->name] = $field->amount;
            }else{
                $userVals [$field->name] += $field->amount;
            }
            $values[] = [$i,$field->name,$field->amount,$field->fromAccount,g2j($field->loan_date),$field->loan_time,g2j($field->payback_date),g2j($field->payback_real_date),$field->toAccount,$label];
            $i++;
        }
        $titles = ['ردیف','نام','مبلغ وام','برداشت از حساب','تاریخ وام','ساعت','تاریخ سررسید','تاریخ بازپرداخت','واریز به حساب','وضعیت'];
        $tableFields = ['','z_staff.name','z_staff_loan.amount','acc1.name','z_staff_loan.loan_date','z_staff_loan.loan_time','z_staff_loan.payback_date','z_staff_loan.payback_real_date','acc2.name','z_staff_loan.payed'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterLoanReports','loanReport');
    }else{
        $titles = ['ردیف','نام','مبلغ وام','برداشت از حساب','تاریخ وام','ساعت','تاریخ سررسید','تاریخ بازپرداخت','واریز به حساب','وضعیت'];
        echo zTable($titles,array(),'titleli','titleul','rowli','rowul',null,$orderType,$orderField,'','');
        ?>
        <ul class="rowul">
            <li class="titleli" style="border-left:1px solid #e0e0e0;">موردی یافت نشد.</li>
        </ul>
        <?php
    }
    ?>
    <br><br>
    <ul class="nav nav-tabs">
        <a class="xlsx jfleft" style="margin-left:3px;" href="#" id="excelExport"></a>
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار تاریخ وام / مبلغ</a></li>
        <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار تاریخ سررسید / مبلغ</a></li>
        <li class="nav"><a id="third" class="jtab" href="#thirdDiv" data-toggle="tab">نمودار تاریخ بازپرداخت / مبلغ</a></li>
        <li class="nav"><a id="fourth" class="jtab" href="#fourthDiv" data-toggle="tab">نمودار کارمند / مبلغ</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($loanDates)&&isset($loanDateVals)){?>
                <?php echo highCharts('تاریخ وام / مبلغ',$loanDates,'مبلغ','date-cost','area',$loanDateVals,true);?>
                <div id="date-cost" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="secondDiv">
            <?php if (isset($payBackDates)&&isset($payBackDatesVals)){?>
                <?php echo highCharts('تاریخ سررسید / مبلغ',$payBackDates,'مبلغ','food-amount','area',$payBackDatesVals,true);?>
                <div id="food-amount" class="jreportchart jtransition active" style="display: none;"></div>
            <?php } ?>
        </div>
        <div id="thirdDiv">
            <?php if (isset($reals)&&isset($realVals)){?>
                <?php echo highCharts('تاریخ بازپرداخت / مبلغ',$reals,'مبلغ','place-cost','area',$realVals,true);?>
                <div id="place-cost" class="jreportchart jtransition active" style="display: none;"></div>
            <?php } ?>
        </div>
        <div id="fourthDiv">
            <?php if (isset($user)&&isset($userVals)){?>
                <?php echo highCharts('کارمند / مبلغ',$user,'مبلغ','staff-cost','pie',$userVals,true);?>
                <div id="staff-cost" class="jreportchart jtransition active" style="display: none;"></div>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    <?php if (isset($titles) && isset($values)){
    $mTitle = $titles;
    unset($mTitle[0]);
    $mValues = $values;
    for ($i=0;$i<count($mValues);$i++){
        unset($mValues[$i][0]);
    }
    ?>
    $('#excelExport').on('click',function(){
        window.open('<?php echo url()?>/admin/excel-export?title=<?php echo json_encode($mTitle);?>&data=<?php echo json_encode($mValues)?>');
    });
    <?php
    }
    ?>
    $('#first').on('click',function(){
        $('#date-cost').css('display','block');
        $('#place-cost').css('display','none');
        $('#food-amount').css('display','none');
        $('#staff-cost').css('display','none');
    });

    $('#second').on('click',function(){
        $('#food-amount').css('display','block');
        $('#date-cost').css('display','none');
        $('#place-cost').css('display','none');
        $('#staff-cost').css('display','none');
    });

    $('#third').on('click',function(){
        $('#place-cost').css('display','block');
        $('#food-amount').css('display','none');
        $('#date-cost').css('display','none');
        $('#staff-cost').css('display','none');
    });

    $('#fourth').on('click',function(){
        $('#staff-cost').css('display','block');
        $('#food-amount').css('display','none');
        $('#date-cost').css('display','none');
        $('#place-cost').css('display','none');
    });
</script>
