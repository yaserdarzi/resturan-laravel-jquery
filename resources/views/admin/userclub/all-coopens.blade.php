<div><label for="searchCoop">جستجو: </label>
<input type="text" id="searchCoop" style="width:200px;padding:4px;"><br><br><br><br><br>
</div>
<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
    <li style="display: inline-block;padding:10px 8px;width:35px;">ردیف</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">شماره کوپن</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">میزان تخفیف</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">نوع کوپن</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">تاریخ انقضا</li>
    <li style="display: inline-block;padding:10px 8px;width:175px;">وضعیت</li>
    <li style="display: inline-block;padding:10px 8px;width:175px;">عملیات</li>
</ul>
@section('coops')
    <div id="coops">
<?php
    if (isset($fields)){
        $i=0;
        foreach($fields as $field){
            ?>
            <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 800px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
                <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i+1;?></li>
                <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->coopen_id;;?></li>
                <li style="padding:12px 8px;width:200px;display: inline-block;">
                    <?php
                        if ($field->type == 0){
                            echo $field->discount;?> درصد<?php
                        }else{
                            echo $field->discount;?> تومان<?php
                        }
                    ?>
                </li>
                <li style="padding:12px 8px;width:200px;display: inline-block;">
                    <?php
                        if ($field->from_fee > 0 && $field->for_all == 1){
                            echo "خرید در ازای مبالغ بیش از $field->from_fee";
                        }else if ($field->for_all == 0){
                            echo "برای کاربر خاص";
                        }else{
                            echo "کوپن برای تمام کاربران";
                        }
                    ?>
                </li>
                <li style="padding:12px 8px;width:200px;display: inline-block;"><?php echo $dates[$i];?></li>
                <li style="padding:12px 8px;width:175px;display: inline-block;">
                    <?php
                        if ($field->enabled == 1){
                            echo "فعال";
                            ?>
                            <a href="#" onclick="deactivateCoop('<?php echo $field->id;?>')"> / غیرفعال کردن</a>
                            <?php
                        }else{
                            echo "غیر فعال";
                            ?>
                            <a href="#" onclick="activateCoop('<?php echo $field->id;?>')"> / فعال سازی</a>
                            <?php
                        }
                    ?>
                </li>
                <li style="padding:12px 8px;width:175px;display: inline-block;"><a href="javascript:;" class="jtrashicon" title="حذف" onclick="deleteCoopen('{{$field->id}}}')">حذف</a></li>
            </ul>
            <?php
            $i++;
        }
    }
?>
    </div>
@show
<span id="span123" style="display: none;"></span>
<script>
    function deactivateCoop(id){
        ajaxSendData('span123',{
            itemId:id
        },'<?php echo url()?>/admin/change-coopen-state');
        setTimeout(responder('all-coopens'),2000);
    }
    function activateCoop(id){
        ajaxSendData('span123',{
            itemId:id
        },'<?php echo url()?>/admin/activate-coopen-state');
        setTimeout(responder('all-coopens'),2000);
    }

    function deleteCoopen(id){
        ajaxRequest('<?php echo url()?>/admin/delete-coopen/'+id,'');
        setTimeout("responder('all-coopens')",1500);
    }

    $('#searchCoop').on('keyup change',function(){
        var val = $(this).val();
        if (val == ""){
            responder('all-coopens');
        }else{
            ajaxSendData('coops',{
                num:val
            },'<?php echo url()?>/admin/search-coopen');
        }
    });

</script>
