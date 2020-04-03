<a href="#" id="phoneDialog">ثبت شماره جدید</a>
<div>
    <ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 1000px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
        <li style="display: inline-block;padding:10px 8px;width:150px;">نام</li>
        <li style="display: inline-block;padding:10px 8px;width:150px;">شماره تماس</li>
        <li style="display: inline-block;padding:10px 8px;width:150px;">شماره همراه</li>
        <li style="display: inline-block;padding:10px 8px;width:100px;">شرکت</li>
        <li style="display: inline-block;padding:10px 8px;width:100px;">گروه</li>
        <li style="display: inline-block;padding:10px 8px;width:250px;">آدرس</li>
        <li style="display: inline-block;padding:10px 8px;width:200px;">ایمیل</li>
        <li style="display: inline-block;padding:10px 8px;width:100px;">وبسایت</li>
        <li style="display: inline-block;padding:10px 8px;width:200px;">یادداشت</li>
    </ul>
    <?php
        if (isset($contacts)){
            foreach($contacts as $contact){
                ?>
                <ul style="display: flex;justify-content: space-between;background-color:#eee;align-items: center;max-width: 1000px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
                    <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $contact->name?></li>
                    <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $contact->phone?></li>
                    <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $contact->mobile?></li>
                    <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $contact->company?></li>
                    <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $contact->group?></li>
                    <li style="display: inline-block;padding:10px 8px;width:250px;"><?php echo $contact->address?></li>
                    <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $contact->email?></li>
                    <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $contact->website?></li>
                    <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $contact->note?></li>
                </ul>
                <?php
            }
        }
    ?>
</div>
<div id="phoneBook" style="display: none;padding:8px;overflow: scroll">
    <form id="submitPhone" style="height:100%;display: block">
        <label for="name">نام:</label>
        <input id="name" name="name" style="width:120px;padding:4px;margin:4px;">
        <label for="phone">تلفن:</label>
        <input id="phone" name="phone" style="width:120px;padding:4px;margin:4px;">
        <label for="mobile">شماره همراه:</label>
        <input id="mobile" name="mobile" style="width:120px;padding:4px;margin:4px;">
        <label for="company">نام شرکت:</label>
        <input id="company" name="company" style="width:120px;padding:4px;margin:4px;">
        <label for="group">گروه:</label>
        <input id="group" name="group" style="width:120px;padding:4px;margin:4px;">
        <label for="address">آدرس:</label>
        <input id="address" name="address" style="width:120px;padding:4px;margin:4px;">
        <label for="email">ایمیل:</label>
        <input id="email" name="email" style="width:120px;padding:4px;margin:4px;">
        <label for="website">وبسایت:</label>
        <input id="website" name="website" style="width:120px;padding:4px;margin:4px;">
        <label for="note">یادداشت:</label>
        <input id="note" name="note" style="width:120px;padding:4px;margin:4px;">
    </form>
    <a href="#" id="summitPhone">ثبت</a>
    <script>
        $('#summitPhone').on('click',function(){
            ajaxyFormData('submitPhone','<?php echo url()?>/admin/phoneBook',true,'phoneBook');
            cleanForm('submitPhone');
            responder('phonebook',this);
        });
    </script>
</div>
<script>
    $('#phoneDialog').on('click',function(){
        setDialog('phoneBook',600,450);
    });
</script>