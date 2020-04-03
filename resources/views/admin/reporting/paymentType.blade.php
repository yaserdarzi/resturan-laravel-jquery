<div id="paymentTypeReport">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    $orderTypes=array();
    if (isset($fields) && count($fields) > 0){
        $i=1;
        $count=0;
        foreach ($fields as $field) {
            $title[] = $field->paymentType;
            $sales[] = $field->totalFee;
            $solds[] = $field->foodcount;
            $values[] = [$i,$field->paymentType,$field->foodcount,$field->totalFee];
            $i++;
        }
        $titles = ['ردیف','روش پرداخت','تعداد فروش','میزان فروش'];
        $tableFields = ['','z_payments.name','foodcount','totalFee'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterPaymentTypeReports','paymentTypeReport');
    }else{
        $titles = ['ردیف','روش پرداخت','تعداد فروش','میزان فروش'];
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
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار روش پرداخت / میزان فروش</a></li>
        <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار روش پرداخت / تعداد فروش</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($title)&&isset($sales)){?>
                <?php echo highCharts('روش پراخت / میزان فروش',$title,'میزان فروش','del-sale','pie',$sales,true);?>
                <div id="del-sale" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="secondDiv">
            <?php if (isset($title)&&isset($solds)){?>
                <?php echo highCharts('روش پرداخت / تعداد فروش',$title,'تعداد فروش','del-sold','pie',$solds,true);?>
                <div id="del-sold" class="jreportchart jtransition active"  style="display: none;"></div>
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
        $('#del-sold').css('display','none');
    });

    $('#second').on('click',function(){
        $('#del-sale').css('display','none');
        $('#del-sold').css('display','block');
    });
</script>