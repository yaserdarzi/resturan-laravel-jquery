<div id="salaryReports">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    $dates=array();
    if (isset($fields) && count($fields) > 0){
        $i=1;
        foreach ($fields as $field) {
            if (!isset($dates[$field->date])){
                $dates[$field->date] = $field->date;
                $title[] = g2j($field->date);
                $sales[$field->date] = $field->cash;
            }else{
                $sales[$field->date] += $field->cash;
            }
            $values[] = [$i,$field->name,$field->salary,$field->cash,$field->account_name,g2j($field->date),$field->time];
            $i++;
        }
        $titles = ['ردیف','نام','حقوق','مبلغ پرداختی','حساب','تاریخ پرداخت','ساعت'];
        $tableFields = ['','z_staff.name','z_staff.salary','z_salary.cash','z_bank_account.name','z_salary.date','z_salary.time'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterSalaryReports','salaryReports');
    }else{
        $titles = ['ردیف','نام','حقوق','مبلغ پرداختی','حساب','تاریخ پرداخت','ساعت'];
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
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار تاریخ / مبلغ</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($title)&&isset($sales)){?>
                <?php echo highCharts('تاریخ / مبلغ',$title,'مبلغ','del-sale','area',$sales,true);?>
                <div id="del-sale" class="jreportchart jtransition active"></div>
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
        $('#del-sale').css('display','block');
    });
</script>