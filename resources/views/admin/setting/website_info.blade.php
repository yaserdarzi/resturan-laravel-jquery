<form action="<?php echo url()?>/admin/site-info" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <label for="website_name">نام وبسایت:</label>
    <input type="text" id="website_name" name="website_name" style="width:200px;padding:4px;margin:4px;" value="<?php if (isset($fields)){echo $fields->site_name;}?>" required><br>
    <label for="website_title">عنوان:</label>
    <input type="text" id="website_title" name="website_title" style="width:200px;padding:4px;margin:4px;" value="<?php if (isset($fields)){echo $fields->site_title;}?>"required><br>
    <label for="website_tel">شماره تماس:</label>
    <input type="text" id="website_tel" name="website_tel" style="width:200px;padding:4px;margin:4px;" value="<?php if (isset($fields)){echo $fields->tel;}?>" required><br><br>
    <label for="site_desc">توضیحات وبسایت:</label>
    <input id="site_desc" name="desc" style="width:300px;height:100px;padding:8px;" required><br>
    <label for="website_email">ایمیل:</label>
    <input type="text" id="website_email" name="website_email" style="width:200px;padding:4px;margin:4px;" value="<?php if (isset($fields)){echo $fields->email;}?>" required><br>
    لوگو سایت. حداکثر سایز 512×512<input style="display: inline-block;" name="logo" id="logo" type="file" required><br><br>
    <label for="header">عکس هدر سایت حداکثر سایز 1400×700</label>
    <input type="file" style="display: inline-block" name="header" id="header" required><br>
    <label for="area">عکس از محیط با سایز 1080×1600</label>
    <input type="file" style="display: inline-block;" name="area" id="area" required><br>
    <button type="submit">ثبت</button>
</form>
