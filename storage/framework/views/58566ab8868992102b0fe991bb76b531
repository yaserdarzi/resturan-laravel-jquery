<div id="wareHouseReport">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    if (!isset($orderField)){$orderField = "z_orders.date";}
    $dates=array();
    $mats=array();
    if (isset($fields) && count($fields) > 0){
        $i=1;
        foreach ($fields as $field) {
            if (!isset($dates[$field->date])){
                $dates[$field->date] = $field->date;
                $date[] = g2j($field->date);
                $dateValues[$field->date] = $field->matCost;
            }else{
                $dateValues[$field->date] += $field->matCost;
            }
            if (!isset($mats[$field->matName])){
                $mats[$field->matName] = $field->matName;
                $material[] =$field->matName;
                $matVals[$field->matName] = $field->matUsage;
                $matCosts[$field->matName] = $field->matCost;
            }else{
                $matVals[$field->matName] += $field->matUsage;
                $matCosts[$field->matName] += $field->matCost;
            }

            $values[] = [$i,$field->orderId,$field->food_name,$field->food_count,$field->matName,$field->matUsage,$field->matCost,g2j($field->date),$field->time];
            $i++;
        }
        $titles = ['ردیف','شماره سفارش','نام غذا','تعداد','مواد','مقدار','هزینه','تاریخ','ساعت'];
        $tableFields = ['','z_orders.refid','food_name','food_count','matName','matUsage','matCost','z_orders.date','z_orders.time'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterWareHouseReports','wareHouseReport');
    }else{
        $titles = ['ردیف','شماره سفارش','نام غذا','تعداد','مواد','مقدار','هزینه','تاریخ','ساعت'];
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
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار تاریخ / هزینه</a></li>
        <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار مواد / مقدار</a></li>
        <li class="nav"><a id="third" class="jtab" href="#thirdDiv" data-toggle="tab">نمودار مواد / هزینه</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($date)&&isset($dateValues)){?>
                <?php echo highCharts('تاریخ / هزینه',$date,'هزینه','date-cost','area',$dateValues,true);?>
                <div id="date-cost" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="secondDiv">
            <?php if (isset($material)&&isset($matVals)){?>
                <?php echo highCharts('مواد / مقدار',$material,'مقدار','food-amount','pie',$matVals,true);?>
                <div id="food-amount" class="jreportchart jtransition active" style="display: none;"></div>
            <?php } ?>
        </div>
        <div id="thirdDiv">
            <?php if (isset($material)&&isset($matCosts)){?>
                <?php echo highCharts('مواد / هزینه',$material,'هزینه','place-cost','pie',$matCosts,true);?>
                <div id="place-cost" class="jreportchart jtransition active" style="display: none;"></div>
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
    });

    $('#second').on('click',function(){
        $('#food-amount').css('display','block');
        $('#date-cost').css('display','none');
        $('#place-cost').css('display','none');
    });

    $('#third').on('click',function(){
        $('#place-cost').css('display','block');
        $('#food-amount').css('display','none');
        $('#date-cost').css('display','none');
    });
</script>
