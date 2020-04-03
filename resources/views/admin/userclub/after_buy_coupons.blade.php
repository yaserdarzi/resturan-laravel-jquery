<form id="coupon-form">
  <label for="coupon_code">کد کوپن(اختیار):</label>
  <input type="text" name="code" id="coupon_code" style="width:200px;padding:4px;"><br>
  <label for="expiration_date">تاریخ انقضاء:</label>
  <input type="text" name="expiration_date" id="expiration_date" style="width:200px;padding:4px;" required><br>
  <label for="valid_date">مدت اعتبار:</label>
  <input type="text" name="valid_date" id="valid_date" style="width:200px;padding:4px;" required><br>روز
  <label for="from_fee">از مبلغ:</label>
  <input type="text" name="from_fee" id="from_fee" style="width:200px;padding:4px;" required><br>
  <label for="to_fee">تا مبلغ:</label>
  <input type="text" name="to_fee" id="to_fee" style="width:200px;padding:4px;" required><br>
  <label for="amount_type">تا مبلغ:</label>
  <select name="amount_type" id="amount_type" style="width:140px;padding:4px;">
    <option value="1">درصد
    <option value="2">تومان
  </select><br>
  <label for="amount">میزان تخفیف:</label>
  <input type="text" name="amount" id="amount" style="width:200px;padding:4px;" required><br>
</form>
<a href="#" id="submit_coupon">ثبت</a>
<p id="coupon_code_response"></p>
<br><br><br><br><br>
<div>
  <ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 700px;text-align:center;margin: 0 auto;color:#fff;min-width:300px;">
      <li style="display: inline-block;padding:10px 8px;width:100px;">شماره کوپن</li>
      <li style="display: inline-block;padding:10px 8px;width:100px;">تاریخ انقضا</li>
      <li style="display: inline-block;padding:10px 8px;width:200px;">از مبلغ</li>
      <li style="display: inline-block;padding:10px 8px;width:200px;">تا مبلغ</li>
      <li style="display: inline-block;padding:10px 8px;width:70px;">نوع تخفیف</li>
      <li style="display: inline-block;padding:10px 8px;width:150px;">میزان تخفیف</li>
      <li style="display: inline-block;padding:10px 8px;width:100px;">عملیات</li>
  </ul>
  @if(isset($coupons))
    @foreach($coupons as $coupon)
      <ul style="display: flex;justify-content: space-between;align-items: center;max-width: 700px; color:#FAFAFA;margin: 0 auto;text-align: center; color:#2f2f2f;">
          <li style="display: inline-block;padding:10px 8px;width:100px;">{{$coupon->code}}</li>
          <li style="display: inline-block;padding:10px 8px;width:100px;">{{g2j($coupon->expire)}}</li>
          <li style="display: inline-block;padding:10px 8px;width:200px;">{{$coupon->from_fee}}</li>
          <li style="display: inline-block;padding:10px 8px;width:200px;">
            @if($coupon->to_fee >= 100000000)
              <span>---</span>
            @else
              {{$coupon->to_fee}}
            @endif
          </li>
          <li style="display: inline-block;padding:10px 8px;width:70px;">
              @if($coupon->type == 1)
                درصد
              @else
                تومان
              @endif
          </li>
          <li style="display: inline-block;padding:10px 8px;width:150px;">{{$coupon->amount}}</li>
          <li style="padding:10px 8px;width:100px;display: inline-block;"><a href="#" class="jtrashicon" title="حذف" onclick="deleteCoupon('{{$coupon->id}}')">حذف</a></li>
      </ul>
  @endforeach
  @endif
</div>


<script>

  $('#expiration_date').datepicker({
    changeMonth:true,
    changeYear:true,
    dateFormat:'yy/mm/dd'
  });
  // $('#valid_date').datepicker({
  //   changeMonth:true,
  //   changeYear:true,
  //   dateFormat:'yy/mm/dd'
  // });

  $('#submit_coupon').on('click',function(){
    ajaxyFormData('coupon-form',"{{url('/admin/add-after-buy-coupon')}}",false);
    cleanForm('coupon-form');
    setTimeout("responder('after-buy-coopens')",2500);
  });

  function deleteCoupon(id){
      ajaxSendDataWithOutBack({
        itemId:id
      },'{{url("/admin/deleteAfterBuyCoupon")}}');
      setTimeout("responder('after-buy-coopens')",1500);
  }
</script>
