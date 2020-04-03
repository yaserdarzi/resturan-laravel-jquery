<form id="c-coupon-form">
	@if(isset($fields) && $fields!="")
	<input type="hidden" value="{{$fields->id}}" name="edit">
	@endif
	<div class="row">
		<label>نوع</label>
		<select id="type" name="type"  style="width:140px;padding:4px">
			@if(isset($fields))
			@if($fields->type_type == 1)
			<option value="1" selected>هنگام خرید</option>
			<option value="2" >بعد از خرید</option>
			@else
			<option value="1">هنگام خرید</option>
			<option value="2" selected>بعد از خرید</option>
			@endif
			@else
			<option value="1">هنگام خرید</option>
			<option value="2">بعد از خرید</option>
			@endif
		</select>
	</div>
	<div class="row">
		<label>مدت اعتبار:</label>
		<input type="text" name="dates" id="dates" value="{{isset($fields) ? g2j($fields->expire) : ''}}" style="width:250px;padding:4px">
	</div>

	<div class="row">
		<label>نوع تخفیف:</label>
		<select name="dis_type" id="dis_type" style="width:140px;padding:4px">
			@if(isset($fields))
			@if($fields->type == 1)
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

	<div class="row" id="divmax_per_user" style="
	<?php
	if(isset($fields))
	if($fields->type_type==1)
		echo "display: none;";
	else
		echo "display: block;";
	?>
		">
		<label>حداکثر استفاده برای هر کاربر</label>
		<input type="text" name="max_per_user" value="{{isset($fields) ? $fields->max_per_user : ''}}" id="max" style="width:140px;padding:4px">
	</div>

	<div class="row">
		<label>میزان تخفیف:</label>
		<input type="text" name="discount" id="discount" value="{{isset($fields) ? $fields->amount : ''}}" style="width:250px;padding:4px">
	</div>
	<div class="row">
		<label>از مبلغ:</label>
		<input type="text" name="from_fee" id="from_fee" value="{{isset($fields) ? $fields->from_fee : ''}}" style="width:250px;padding:4px">
		<label>تا مبلغ:</label>
		<input type="text" name="to_fee" id="to_fee" value="{{isset($fields) ? $fields->to_fee : ''}}" style="width:250px;padding:4px">
	</div>
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>

<script>
	$('#submit').on('click',function(){
		$('#loading').show();
		ajaxyFormData('c-coupon-form','<?php echo url()?>/admin/add-c-coupon',true,'ReportDialog');
		setTimeout("responder('c-coupon')",1500);
		setTimeout("$('#loading').hide()",1600);
	});

	$('#type').on('change',function(){
		var val = $(this).find(":selected").text();
		if (val== "هنگام خرید"){
			$('#divmax_per_user').css('display','none');
		}else{
			$('#divmax_per_user').css('display','block');
		}
	});
	$('#dates').datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy/mm/dd'
	});
</script>