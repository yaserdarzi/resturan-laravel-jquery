<span>وضعیت سفارش گیری:</span>
<?php
    if (isset($fields)){
        if ($fields->service_status == 1){
            ?>
            <span>آنلاین</span>
            <a href="#" onclick="offline()"> / آفلاین</a>
            <?php
        }else{
            ?>
            <span>آفلاین</span>
            <a href="#" onclick="online()"> / آنلاین</a>
            <?php
        }
    }
?>
<a></a>
<form id="serviceSetting">
    <label for="failure">درصد خطای آماده سازی غذا:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" id="failure" name="failure" value="<?php if (isset($fields)){echo $fields->service_failure;}?>">درصد<br>
    <label for="startTime">ساعت شروع کار:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" id="startTime" name="startTime" value="<?php if (isset($fields)){echo $fields->start_time;}?>"><br>
    <label for="endTime">ساعت پایان کار:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" id="endTime" name="endTime" value="<?php if (isset($fields)){echo $fields->end_time;}?>"><br>
</form>
<a href="#" id="submitService">ثبت</a>
<span id="serviceMessage" style="color:#3f0;font-weight:bold;"></span>
<script>
    $('#submitService').on('click',function(){
        ajaxyFormData('serviceSetting','<?php echo url()?>/admin/service-settings',false);
        cleanForm('serviceSetting');
        $('#serviceMessage').html('با موفقیت ذخیره شد');
    });
    function offline(){
        ajaxSendData('serviceMessage',{
            key:'offline'
        },'<?php echo url()?>/admin/changeOrderingStatus');
        responder('service-settings');
    }
    function online(){
        ajaxSendData('serviceMessage',{
            key:'online'
        },'<?php echo url()?>/admin/changeOrderingStatus');
        responder('service-settings');
    }
</script>
