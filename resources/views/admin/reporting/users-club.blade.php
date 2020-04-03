<div id="usersReport">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    if (!isset($orderField)){$orderField = "z_users.submit_date";}
    $user=array();
    if (isset($fields) && count($fields) > 0){
        $i=1;
        foreach ($fields as $field) {
            if ($field->totalFee==null){
                $field->totalFee = 0;
            }
            if ($field->food_count == null){
                $field->food_count=0;
            }
            if (!isset($field->lastPurchase) || $field->lastPurchase == null || $field->lastPurchase == ""){
               $lastPurchase ='---';
            }else{
                $lastPurchase = g2j($field->lastPurchase);
            }

            if (!isset($user[$field->user_id])){
                $user[$field->user_id] = $field->user_id;
                $users_name[] =$field->name;
                $userTotalFee[$field->user_id] = $field->totalFee;
                $userCountTotal[$field->user_id] =$field->food_count;
            }else{
                $userTotalFee[$field->user_id] += $field->totalFee;
                $userCountTotal[$field->user_id] +=$field->food_count;
            }
            $values[] = [$i,$field->name,$field->phone,$field->user_id,$field->totalFee,$field->food_count,g2j($field->submit_date),g2j($field->last_visit),$lastPurchase];
            $i++;
        }
        $titles = ['ردیف','نام','شماره تماس','شماره اشتراک','میزان خرید','تعداد خرید','تاریخ ثبت نام','آخرین بازدید','آخرین خرید'];
        $tableFields = ['','z_users.name','z_users.phone','user_id','totalFee','food_count','z_users.submit_date','z_users.last_visit','lastPurchase'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterUsersClubReports','usersReport');
    }else{
        $titles = ['ردیف','نام','شماره تماس','شماره اشتراک','میزان خرید','تعداد خرید','تاریخ ثبت نام','آخرین بازدید','آخرین خرید'];
        echo zTable($titles,array(),'titleli','titleul','rowli','rowul',null,$orderType,$orderField,'','');
        ?>
        <ul class="rowul">
            <li class="titleli" style="border-left:1px solid #e0e0e0;">موردی یافت نشد.</li>
        </ul>
        <?php
    }
    ?>
    <br><br>
    @if(isset($user_ids))
    <input type="hidden" name="ids" id="ids" value="{{$user_ids}}">
    @endif
            
    <ul class="nav nav-tabs">
        <a class="xlsx jfleft" style="margin-left:3px;" href="#" id="excelExport"></a>
        <li class="nav active"><a id="first" class="jtab" href="#firstDiv" data-toggle="tab" aria-expanded="true">نمودار کاربر / میزان خرید</a></li>
        <li class="nav"><a id="second" class="jtab" href="#secondDiv" data-toggle="tab">نمودار کاربر / تعداد خرید</a></li>
    </ul>
    <div class="jreportchartdiv" style="text-align: center;">
        <div id="firstDiv">
            <?php if (isset($users_name)&&isset($userTotalFee)){?>
                <?php echo highCharts('کاربر / میزان خرید',$users_name,'میزان خرید','del-sale','pie',$userTotalFee,true);?>
                <div id="del-sale" class="jreportchart jtransition active"></div>
            <?php } ?>
        </div>
        <div id="secondDiv">
            <?php if (isset($users_name)&&isset($userCountTotal)){?>
                <?php echo highCharts('کاربر / تعداد خرید',$users_name,'تعداد خرید','del-sold','pie',$userCountTotal,true);?>
                <div id="del-sold" class="jreportchart jtransition active"  style="display: none;"></div>
            <?php } ?>
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