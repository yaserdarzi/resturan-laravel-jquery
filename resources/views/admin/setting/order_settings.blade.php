<form id="orderSettingsForm">
    <select name="orderType" style="width:140px;">
        <option name="preorder">پیش سفارش حضوری</option>
        <option name="outPayk">بیرون بر با پیک</option>
        <option name="inside">حضوری</option>
        <option name="outPresent">بیرون بر حضوری</option>
    </select><br><br>
    <select name="paymentType" style="width: 140px;">
        <option name="3" value="3">هردو</option>
        <option name="2" value="2">فقط آنلاین</option>
        <option name="1" value="1">فقط نقدی</option>
    </select><br><br>
</form>
<a href="#" id="submitSettingForm">ثبت</a>
<span id="settingFormMessage" style="color:#3f0;font-weight:bold;"></span>
<script>
    $('#submitSettingForm').on('click',function(){
        ajaxyFormData('orderSettingsForm','<?php echo url()?>/admin/order-setting',false);
        cleanForm('orderSettingsForm');
        $('#settingFormMessage').html('با موفقیت ذخیره شد');
    });
</script>