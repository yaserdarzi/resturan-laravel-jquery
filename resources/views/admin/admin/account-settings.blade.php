<form id="accountSettings">
    <label for="admin_user_name">تغییر نام کاربری:</label>
    <input name="user_name" id="admin_user_name" value="{{Session::get('admin_enter')}}"><br>
    <label for="newPass">رمزعبور جدید:</label>
    <input id="newPass" name="newPass"><br>
    <label for="repeatPass">تکرار رمز عبور:</label>
    <input name="repeatPass" id="repeatPass">
    <a href="#" onclick="submitForm()">ثبت</a>
</form>
<span id="errorPan"></span>
<script>
    function submitForm(){
        var val1 = $('#newPass').val();
        var val2 = $('#repeatPass').val();
        if (val1 != val2){
            $('#errorPan').html('فیلدهای پسورد مساوی نیستند.');
            return;
        }else{
            ajaxyFormData('accountSettings',"{{url('/admin/editAdminAccount')}}",false);
        }
    }
</script>
