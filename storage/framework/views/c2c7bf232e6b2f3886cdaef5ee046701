<form id="userForm">
    <label for="admin_name">نام و نام خانوادگی</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="admin_name" id="admin_name"><br>
    <label for="admin_phone">شماره تلفن:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="admin_phone" id="admin_phone"><br>
    <label for="admin_mail">ایمیل:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="admin_mail" id="admin_mail"><br>
    <label for="admin_user">نام کاربری:</label>
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="admin_user" id="admin_user"><br>
    <label for="admin_pass">رمز عبور:</label>
    <input type="password" style="width:200px;padding:4px;margin:4px;" name="admin_pass" id="admin_pass"><br>
    <a href="#" id="submitter">ثبت</a>
</form>
<span style="color:#3f0;font-weight: bold;" id="userFormMessage">&nbsp;</span>
<script>
    $('#submitter').on('click',function(){
        ajaxyFormData('userForm','<?php echo url()?>/admin/new-panel-user',false);
        cleanForm('userForm');
        $('#userFormMessage').html('با موفقیت ذخیره شد.');
    });
</script>