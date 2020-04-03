<div id="costsReport">
    <?php
        if (isset($fields) && count($fields) > 0){
            $i=1;
            $me=array();
            $mDates=array();
            foreach($fields as $field){
                if (!isset($mDates[$field->date])){
                    $mDates[$field->date] = $field->date;
                    $dates[] = g2j($field->date);
                    $dateVals[$field->date]=$field->cash;
                }else{
                    $dateVals[$field->date]+=$field->cash;
                }
                $jDate = g2j($field->date);
                $values[] = [$i,$field->subType,$field->cash,$jDate,$field->time];
                $i++;
            }
            $titles = ['ردیف','شاخه فرعی','مبلغ تراکنش','تاریخ','ساعت'];
            $tableFields = ['','subType','z_transactions.cash','z_transactions.date','z_transactions.time'];
            echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterIncomeReports','costsReport');
        }else{
            $titles = ['ردیف','شاخه فرعی','مبلغ تراکنش','تاریخ','ساعت'];
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
        <a class="xlsx jfleft" style="margin-left:3px;" href="#" id="export"></a>
        <li class="nav"><a id="second" class="jtab" href="#mSecondDiv" data-toggle="tab" aria-expanded="true">نمودار تاریخ / مبلغ</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="mSecondDiv">
            <?php if (isset($dates)&&isset($dateVals)){?>
                <?php echo highCharts('تاریخ / مبلغ',$dates,'مبلغ','date-trans','area',$dateVals,true);?>
                <div id="date-trans" class="jreportchart jtransition active" ></div>
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
    $('#export').on('click',function(){
        window.open('<?php echo url()?>/admin/excel-export?title=<?php echo json_encode($mTitle);?>&data=<?php echo json_encode($mValues)?>');
    });
    <?php
    }
    ?>
    $('#first').on('click',function(){
        $('#trans-fee').css('display','block');
    });
</script>