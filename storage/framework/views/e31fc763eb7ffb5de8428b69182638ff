<?php if (!isset($orderType)){$orderType = "title-desc";}
      if (isset($error)){
          ?>
          <script>
              alert('<?php echo $error?>');
          </script>
          <?php
      }
?>
<div id="foodReports">
<?php
$i=1;
if (isset($fields) && count($fields) > 0){
    $resTitles=array();
    $categoryTitle=array();
    foreach($fields as $field){
        if ($field->foodcount == ""){
            $field->foodcount=0;
            $field->totalFee = 0;
        }
        $values [] = [$i,$field->resTitle,$field->catTitle,$field->title,$field->foodcount,$field->totalFee];
        $title[] = $field->title;
        $data[] = $field->foodcount;
        $fees [] = $field->totalFee;
        if (!isset($resTitles[$field->resTitle])){
            $resTitles[$field->resTitle] = $field->resTitle;
            $rests[]=$field->resTitle;
            $countRestsSale[$field->resTitle] = $field->foodcount;
            $countRestSolds [$field->resTitle] = $field->totalFee;
        }else{
            $countRestsSale[$field->resTitle] += $field->foodcount;
            $countRestSolds [$field->resTitle] += $field->totalFee;
        }
        if (!isset($categoryTitle[$field->catTitle])){
            $categoryTitle[$field->catTitle]=$field->catTitle;
            $cats[] = $field->catTitle;
            $catsSale[$field->catTitle] = $field->foodcount;
            $catSold[$field->catTitle] = $field->totalFee;
        }else{
            $catsSale[$field->catTitle] += $field->foodcount;
            $catSold[$field->catTitle] += $field->totalFee;
        }
        $i++;
    }
    $titles=['ردیف','نام زیرمجموعه','دسته بندی غذا','نام غذا','تعداد فروش','میزان فروش'];
    $tableFields=['','z_res_subset.title','z_food_cats.title','z_foods.title','foodcount','totalFee'];
    echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterFoodsReport','foodReports');
}else{
    $titles=['ردیف','نام زیرمجموعه','دسته بندی غذا','نام غذا','تعداد فروش','میزان فروش'];
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
    <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار غذا / تعداد فروش</a></li>
    <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار غذا / میزان فروش</a></li>
    <li class="nav"><a id="third" class="jtab" href="#thirdDiv" data-toggle="tab">نمودار زیرمجموعه / تعداد فروش</a></li>
    <li class="nav"><a id="fourth" class="jtab" href="#fourthDiv" data-toggle="tab">نمودار زیرمجموعه / میزان فروش</a></li>
    <li class="nav"><a id="fifth" class="jtab" href="#fifthDiv" data-toggle="tab">نمودار دسته بندی / تعداد فروش</a></li>
    <li class="nav"><a id="sixth" class="jtab" href="#sixthDiv" data-toggle="tab">نمودار دسته بندی / میزان فروش</a></li>
</ul>

<div class="jreportchartdiv" style="text-align: center;">
    <div id="firstDiv" class="jreportchart jtransition active">
        <?php if (isset($title)&&isset($data)){?>
            <?php echo highCharts('غذا / تعداد فروش',$title,'تعداد فروش','count-sale','pie',$data,true);?>
            <div id="count-sale" class="jreportchart jtransition active"></div>
        <?php } ?>
    </div>
    <div id="secondDiv" class="jreportchart jtransition">
        <?php if (isset($title)&&isset($fees)){?>
            <?php echo highCharts('غذا / میزان فروش',$title,'میزان فروش','feeReport-sale','pie',$fees,true);?>
            <div id="feeReport-sale" class="jreportchart jtransition active" style="display: none;"></div>
        <?php } ?>
    </div>
    <div id="thirdDiv" class="jreportchart jtransition">
        <?php if (isset($rests)&&isset($countRestsSale)){?>
            <?php echo highCharts('زیرمجموعه / تعداد فروش',$rests,'تعداد فروش','rest-sale','pie',$countRestsSale,true);?>
            <div id="rest-sale" class="jreportchart jtransition active" style="display: none;"></div>
        <?php } ?>
    </div>
    <div id="fourthDiv" class="jreportchart jtransition">
        <?php if (isset($rests)&&isset($countRestSolds)){?>
            <?php echo highCharts('زیرمجموعه / میزان فروش',$rests,'میزان فروش','rest-count','pie',$countRestSolds,true);?>
            <div id="rest-count" class="jreportchart jtransition active" style="display: none;"></div>
        <?php } ?>
    </div>
    <div id="fifthDiv" class="jreportchart jtransition">
        <?php if (isset($rests)&&isset($catsSale)){?>
            <?php echo highCharts('دسته بندی / تعداد فروش',$cats,'میزان فروش','cat-count','pie',$catsSale,true);?>
            <div id="cat-count" class="jreportchart jtransition active" style="display: none;"></div>
        <?php } ?>
    </div>
    <div id="sixthDiv" class="jreportchart jtransition">
        <?php if (isset($rests)&&isset($catSold)){?>
            <?php echo highCharts('دسته بندی / میزان فروش',$cats,'میزان فروش','cat-sale','pie',$catSold,true);?>
            <div id="cat-sale" class="jreportchart jtransition active" style="display: none;"></div>
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
    $('#count-sale').css('display','block');
    $('#feeReport-sale').css('display','none');
    $('#rest-sale').css('display','none');
    $('#rest-count').css('display','none');
    $('#cat-count').css('display','none');
    $('#cat-sale').css('display','none');
});

$('#second').on('click',function(){
    $('#count-sale').css('display','none');
    $('#feeReport-sale').css('display','block');
    $('#rest-sale').css('display','none');
    $('#rest-count').css('display','none');
    $('#cat-count').css('display','none');
    $('#cat-sale').css('display','none');
});
$('#third').on('click',function(){
    $('#count-sale').css('display','none');
    $('#feeReport-sale').css('display','none');
    $('#rest-sale').css('display','block');
    $('#rest-count').css('display','none');
    $('#cat-count').css('display','none');
    $('#cat-sale').css('display','none');
});
$('#fourth').on('click',function(){
    $('#count-sale').css('display','none');
    $('#feeReport-sale').css('display','none');
    $('#rest-sale').css('display','none');
    $('#rest-count').css('display','block');
    $('#cat-count').css('display','none');
    $('#cat-sale').css('display','none');
});
$('#fifth').on('click',function(){
    $('#count-sale').css('display','none');
    $('#feeReport-sale').css('display','none');
    $('#rest-sale').css('display','none');
    $('#rest-count').css('display','none');
    $('#cat-count').css('display','block');
    $('#cat-sale').css('display','none');
});
$('#sixth').on('click',function(){
    $('#count-sale').css('display','none');
    $('#feeReport-sale').css('display','none');
    $('#rest-sale').css('display','none');
    $('#rest-count').css('display','none');
    $('#cat-count').css('display','none');
    $('#cat-sale').css('display','block');
});
</script>
