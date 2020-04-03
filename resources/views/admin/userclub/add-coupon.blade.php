<link href="{{URL::asset('assets/datatable/css/style.css')}}" rel="stylesheet" type="text/css"/>

<script type="text/javascript" language="javascript"
		src="{{URL::asset('assets/datatable/js/jquery.dataTables.min.js')}}">
</script>
<script type="text/javascript" language="javascript"
		src="{{URL::asset('assets/datatable/js/dataTables.bootstrap.min.js')}}">
</script>

<div class="row jfirst-child">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<div class=" portlet light jform">
			<a class="submit jtimerange" style="position: absolute; top: 15px; z-index: 99; width: 120px;    padding: 1.5px 10px;
" href="#" id="add">ثبت</a>
			<div  style="margin-top: -40px;">
				<table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th >کد کوپن</th>
						<th >تاریخ انقضا</th>
						<th >میزان تخفیف</th>
						<th >نوع تخفیف</th>
						<th >حداکثر استافده برای کاربر</th>
						<th class="jaction">عملیات</th>
					</tr>
					</thead>
					<tfoot>
					<tr>
						<th >کد کوپن</th>
						<th >تاریخ انقضا</th>
						<th >میزان تخفیف</th>
						<th >نوع تخفیف</th>
						<th >حداکثر استافده برای کاربر</th>
						<th class="jaction">عملیات</th>
					</tr>
					</tfoot>
					<tbody>
	<?php
	if (isset($coupon)){
		$i=1;
		foreach($coupon as $coupons){
			$jDate = g2j($coupons->expire);
			?>

			<tr >
				<td><?php echo $coupons->code;?></td>
				<td><?php echo $jDate;?></td>
				<td><?php echo $coupons->amount;?></td>
				<td><?php if($coupons->type==1) echo "درصد"; else echo "تومان";?></td>
				<td><?php echo $coupons->max_per_user;?></td>
				<td><a href="javascript:void(0);" title="ویرایش" onclick="editcoupon('{{$coupons->id}}')"><i class="fa fa-pencil"></i></a></td>
			</tr>
			<?php
			$i++;
		}
	}
	?>
</tbody>
</table>
</div>
</div>
</div>
</div>


<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
	$(function(){
		$('#add').on('click',function(){
			ajaxRequest('<?php echo url()?>/admin/add-coupons','ReportDialog');
			setDialog('ReportDialog',600,400);
		});
	});


	function editcoupon(id){
		ajaxRequest('<?php echo url()?>/admin/edit-coupon/'+id,'ReportDialog');
		setDialog('ReportDialog',600,400);
	}

	$('#submit_date').datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy/mm/dd'
	});
	$('#last_visit').datepicker({
		changeMonth:true,
		changeYear:true,
		dateFormat:'yy/mm/dd'
	});
</script>