<div id="transactionReport">
    <?php
        if (isset($fields) && count($fields) > 0){
            $i=1;
            $me=array();
            $mDates=array();
            foreach($fields as $field){
                if (!isset($me[$field->catTitle])){
                    $me[$field->catTitle] = $field->catTitle;
                    $transTitle[] = $field->catTitle;
                    $fees[$field->catTitle] = $field->cash;
                }else{
                    $fees[$field->catTitle] += $field->cash;
                }
                if (!isset($mDates[$field->date])){
                    $mDates[$field->date] = $field->date;
                    $dates[] = g2j($field->date);
                    $dateVals[$field->date]=$field->cash;
                }else{
                    $dateVals[$field->date]+=$field->cash;
                }
                $jDate = g2j($field->date);
                $values[] = [$i,$field->trans_id,$field->catTitle,$field->subType,$field->cash,$jDate,$field->time];
                $i++;
            }
            $titles = ['ردیف','شماره تراکنش','نوع تراکنش','شاخه فرعی','مبلغ تراکنش','تاریخ','ساعت'];
            $tableFields = ['','z_transactions.trans_id','catTitle','subType','z_transactions.cash','z_transactions.date','z_transactions.time'];
            echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterTransactionsReport','transactionReport');
        }else{
            $titles = ['ردیف','نوع تحویل','تعداد فروش','میزان فروش'];
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
        <li class="nav active"><a id="first" class="jtab" href="#mFirstDiv" data-toggle="tab" aria-expanded="true">نمودار نوع تراکنش / مبلغ</a></li>
        <li class="nav"><a id="second" class="jtab" href="#mSecondDiv" data-toggle="tab">نمودار تاریخ / مبلغ</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="mFirstDiv">
            <?php if (isset($transTitle)&&isset($fees)){?>
                <?php echo highCharts('نوع تراکنش / مبلغ',$transTitle,'مبلغ','trans-fee','pie',$fees,true);?>
                <div id="trans-fee" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="mSecondDiv">
            <?php if (isset($dates)&&isset($dateVals)){?>
                <?php echo highCharts('تاریخ / مبلغ',$dates,'مبلغ','date-trans','area',$dateVals,true);?>
                <div id="date-trans" class="jreportchart jtransition active"  style="display: none;"></div>
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
        $('#date-trans').css('display','none');
    });

    $('#second').on('click',function(){
        $('#trans-fee').css('display','none');
        $('#date-trans').css('display','block');
    });
</script>