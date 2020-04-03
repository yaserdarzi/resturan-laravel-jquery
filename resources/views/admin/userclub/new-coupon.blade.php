<form id="coupon-form">
	@if(isset($coupon) && $coupon!="")
	<input type="hidden" value="{{$coupon->id}}" name="edit">
	@endif
	<div class="row">
		<label for="coupon_code">کد کوپن (اختیاری)</label>
		<input type="text" name="coupon_code" id="coupon_code" value="{{isset($coupon->code) ? $coupon->code : ''}}" class=" zinput" style="width:250px;padding:4px;">
		<span id="code-response"></span>
	</div>
	<div class="row">
		<label for="expire">تاریخ انقضا:</label>
		<input type="text" name="expire" id="expire"  value="{{isset($coupon->expire) ? g2j($coupon->expire) : ''}}" class="form-control zinput" style="width:250px;padding:4px;">
	</div>
	<div class="row">
		<label for="type">نوع تخفیف:</label>
		<!-- <input type="text" name="type" id="type" class="form-control zinput" style="width:250px;padding:4px;"> -->
		<select name="type" id="type" style="width:250px;padding:4px;">
			@if(isset($coupon))
			@if($coupon->type == 1)
			<option value="1" selected>درصد</option>
			<option value="2"  >تومان</option>
			@else
			<option value="1" >درصد</option>
			<option value="2" selected >تومان</option>
			@endif
			@else
			<option value="1" >درصد</option>
			<option value="2" >تومان</option>
			@endif
		</select>
	</div>

	<div class="row">
		<label for="amount">میزان تخفیف:</label>
		<input type="text" name="amount" id="amount" value="{{isset($coupon->amount) ? $coupon->amount : ''}}" class="form-control zinput" style="width:250px;padding:4px;">
	</div>

	<div class="row">
		<label>حداکثر استافده برای هر کاربر</label>
		<input type="text" name="max_per_user" value="{{isset($coupon->max_per_user) ? $coupon->max_per_user : ''}}" id="max_per_user" class="form-control zinput" style="width:250px;padding:4px;">
	</div>
</form>


<a href="#" class="jsubmit" id="Submit"><i class="fa fa-check"></i></a>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
	$(function(){
		$('#Submit').on('click',function(){
			var expire = $('#expire').val();
			if(expire == ""){
				alert("لطفا تاریخ انقضا را وارد نمایید");
				return;
			}
			$('#loading').show();
			ajaxyFormData('coupon-form','<?php echo url()?>/admin/add-coupon',true,'ReportDialog');
			setTimeout("responder('coupon')",1500);
			setTimeout("$('#loading').hide()",1600);
		});
	});
	$('#expire').datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy/mm/dd'
	});
</script>
