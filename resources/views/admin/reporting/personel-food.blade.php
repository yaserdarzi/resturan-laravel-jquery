<div id="deliveryReports">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    if (isset($fields) && count($fields) > 0){
        $i=1;
        $dates=array();
        $foods =array();
        $places = array();
        foreach ($fields as $field) {
            if (isset($field->foodname) && $field->foodname!=""){
                $food_name = $field->foodname;
                $label = 'z_foods.title';
            }else{
                $food_name = $field->food_name;
                $label = 'z_staff_orders.food_name';
            }
            if (isset($field->cost) && $field->cost!=""){
                $cost = $field->cost;
            }else{
                $cost = "داخلی رستوران";
            }
            if (!isset($dates[$field->date])){
                $dates[$field->date] = $field->date;
                $firstChartTitles []= g2j($field->date);
                $firstChartValue[$field->date] = $cost;
            }else{
                $firstChartValue[$field->date] += $cost;
            }

            if (!isset($foods[$food_name])){
                $foods[$food_name] = $food_name;
                $foodNames[] = $food_name;
                $foodCounts[$food_name] = $field->count;
            }else{
                $foodCounts[$food_name] += $field->count;
            }

            if (!isset($places[$field->orderType])){
                $places[$field->orderType] = $field->orderType;
                $place[] = $field->orderType;
                $placeCounts[$field->orderType] = $cost;
            }else{
                $placeCounts[$field->orderType] += $cost;
            }

            $values[] = [$i,$field->orderType,$food_name,$field->count,$cost,g2j($field->date),$field->time];
            $i++;
        }
        $titles = ['ردیف','محل تهیه','نام غذا','مقدار','هزینه','تاریخ','ساعت'];
        $tableFields = ['',$label,'orderType','z_staff_orders.count','z_staff_orders.cost','z_staff_orders.date','z_staff_orders.time'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterStaffOrdersReport','deliveryReports');
    }else{
        $titles = ['ردیف','نام غذا','محل تهیه','مقدار','هزینه','تاریخ'];
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
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار تاریخ / هزینه مصرف</a></li>
        <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار غذا / مقدار</a></li>
        <li class="nav"><a id="third" class="jtab" href="#thirdDiv" data-toggle="tab">نمودار محل تهیه / هزینه</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($firstChartTitles)&&isset($firstChartValue)){?>
                <?php echo highCharts('تاریخ / هزینه',$firstChartTitles,'هزینه','date-cost','area',$firstChartValue,true);?>
                <div id="date-cost" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="secondDiv">
            <?php if (isset($foodNames)&&isset($foodCounts)){?>
                <?php echo highCharts('غذا / مقدار',$foodNames,'مقدار','food-amount','pie',$foodCounts,true);?>
                <div id="food-amount" class="jreportchart jtransition active" style="display: none;"></div>
            <?php } ?>
        </div>
        <div id="thirdDiv">
            <?php if (isset($place)&&isset($placeCounts)){?>
                <?php echo highCharts('محل تهیه / هزینه',$place,'هزینه','place-cost','pie',$placeCounts,true);?>
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