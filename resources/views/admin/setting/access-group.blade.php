<form id="accessForm">
  <input name="_token" value="{{Session::token()}}" type="hidden">
  <select name="user_id" style="width:140px;">
    <?php
      if (isset($users)){
        foreach($users as $user){
          ?>
          <option value="<?php echo $user->id?>"><?php echo $user->name?></option>
          <?php
        }
      }
    ?>
  </select><br>
  <input type="checkbox" id="mOrders" onchange="shower('all','allStaff')" name="all">همه دسترسی ها
  <div style="margin:8px;">
    <input type="checkbox" id="mOrders" onchange="shower('mOrders','orderStaff')" name="سفارشات">سفارشات
</div>
  <div style="margin:8px;">
    <input type="checkbox" id="mReport" onchange="shower('mReport','reportStaff')" name="گزارش گیری">گزارش گیری
    <br><div id="reportStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="سفارشات">سفارشات<br>
      <input type="checkbox" name="غذاها">غذاها<br>
      <input type="checkbox" name="روش های پرداخت">روش های پرداخت<br>
      <input type="checkbox" name="روش های تحویل">روش های تحویل<br>
      <input type="checkbox" name="تراکنش ها">تراکنش ها<br>
      <input type="checkbox" name="هزینه ها">هزینه ها<br>
      <input type="checkbox" name="حقوق">حقوق<br>
      <input type="checkbox" name="درآمد جانبی">درآمد جانبی<br>
      <input type="checkbox" name="باشگاه مشتریان">باشگاه مشتریان<br>
      <input type="checkbox" name="فیلدهای ثبت نام کاربر">فیلدهای ثبت نام کاربر<br>
      <input type="checkbox" name="گزارش مصرف پرسنل">گزارش مصرف پرسنل<br>
      <input type="checkbox" name="انبارگردانی">انبارگردانی<br>
      <input type="checkbox" name="وام">وام<br>
    </div>
  </div>
  <div style="margin:8px;">
    <input type="checkbox" id="accounting" onchange="shower('accounting','accountingStaff')" name="حسابداری">حسابداری
    <br><div id="accountingStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="ثبت حساب">ثبت حساب<br>
      <input type="checkbox" name="تعریف نوع هزینه">تعریف نوع هزینه<br>
      <input type="checkbox" name="تعریف نوع درآمد">تعریف نوع درآمد<br>
      <input type="checkbox" name="ثبت هزینه">ثبت هزینه<br>
      <input type="checkbox" name="ثبت درآمد">ثبت درآمد<br>
      <input type="checkbox" name="پرداخت حقوق">پرداخت حقوق<br>
      <input type="checkbox" name="انتقال وجه بین حسابها">انتقال وجه بین حسابها<br>
    </div>
  </div>
  <div style="margin:8px;">
    <input type="checkbox" id="personing" onchange="shower('personing','personStaff')" name="مدیریت منابع انسانی">مدیریت منابع انسانی
    <br><div id="personStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="لیست پرسنل">لیست پرسنل<br>
      <input type="checkbox" name="معرفی پرسنل">معرفی پرسنل<br>
      <input type="checkbox" name="ثبت مصرف پرسنل">ثبت مصرف پرسنل<br>
      <input type="checkbox" name="مرخصی">مرخصی<br>
      <input type="checkbox" name="تسهیلات">تسهیلات<br>
    </div>
  </div>
  <div style="margin:8px;">
    <input type="checkbox" id="storage" onchange="shower('storage','storeStaff')" name="انبارداری">انبارداری
    <br><div id="storeStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="انبارها">انبارها<br>
      <input type="checkbox" name="دسته بندی">دسته بندی<br>
      <input type="checkbox" name="ثبت مواد">ثبت مواد<br>
      <input type="checkbox" name="موجودی انبار">موجودی انبار<br>
      <input type="checkbox" name="تعریف واحد">تعریف واحد<br>
    </div>
  </div>
  <div style="margin:8px;">
    <input type="checkbox" id="club" onchange="shower('club','clubStaff')" name="باشگاه مشتریان">باشگاه مشتریان
    <br><div id="clubStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="ثبت کاربر جدید">ثبت کاربر جدید<br>
      <input type="checkbox" name="تنظیمات کوپن تخفیف">تنظیمات کوپن تخفیف<br>
      <input type="checkbox" name="کوپن های ثبت شده">کوپن های ثبت شده<br>
      <input type="checkbox" name="شبکه های اجتماعی">شبکه های اجتماعی<br>
      <input type="checkbox" name="فیلدهای ثبت نام کاربر">فیلدهای ثبت نام کاربر<br>
      <input type="checkbox" name="ایجاد نظرسنجی">ایجاد نظرسنجی<br>
      <input type="checkbox" name="گزارش نظرسنجی">گزارش نظرسنجی<br>
    </div>
  </div>
  <div style="margin:8px;">
    <input type="checkbox" id="settings" onchange="shower('settings','settingStaff')" name="تنظیمات">تنظیمات
    <br><div id="settingStaff" style="visibility:hidden;display: inline-block;margin-right:8px;">
      <input type="checkbox" name="ایجاد کاربر برای پنل مدیریت">ایجاد کاربر برای پنل مدیریت<br>
      <input type="checkbox" name="اطلاعات وبسایت">اطلاعات وبسایت<br>
      <input type="checkbox" name="تنظیمات سفارش">تنظیمات سفارش<br>
      <input type="checkbox" name="تنظیمات سرویس دهی">تنظیمات سرویس دهی<br>
      <input type="checkbox" name="نقشه گوگل">نقشه گوگل<br>
      <input type="checkbox" name="زیرمجموعه های رستوران">زیرمجموعه های رستوران<br>
      <input type="checkbox" name="دسته بندی غذا">دسته بندی غذا<br>
      <input type="checkbox" name="غذا">غذا<br>
      <input type="checkbox" name="تنظیمات دسترسی">تنظیمات دسترسی<br>
      <input type="checkbox" name="تنظیمات پیام کوتاه">تنظیمات پیام کوتاه<br>
    </div>
  </div>
  <!-- To Be Continued!-->
  <a href="#" onclick="sendAccessForm()">ثبت</a>
</form>
<script>
  function shower(callerId,id){
    if ($('#'+callerId).is(':checked')){
      $('#'+id).css('visibility', 'visible');
    }else{
      $('#'+id).css('visibility', 'hidden');
    }
  }
  function sendAccessForm(){
    ajaxyFormData('accessForm','<?php echo url()?>/admin/accessGroup',false);
    responder('access-group');
  }
</script>