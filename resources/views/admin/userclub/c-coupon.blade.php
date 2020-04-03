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
" href="#" id="add">افزودن</a>
			<div  style="margin-top: -40px;">
				<table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th>ردیف</th>
						<th >تاریخ انقضا</th>
						<th >نوع تخفیف</th>
						<th >مقدار تخفیف</th>
						<th>از مبلغ</th>
						<th>تا مبلغ</th>
						<th>نوع</th>
						<th>حداکثر استفاده</th>
						<th class="jaction">عملیات</th>
					</tr>
					</thead>
					<tfoot>
					<tr>
						<th>ردیف</th>
						<th >تاریخ انقضا</th>
						<th >نوع تخفیف</th>
						<th >مقدار تخفیف</th>
						<th>از مبلغ</th>
						<th>تا مبلغ</th>
						<th>نوع</th>
						<th>حداکثر استفاده</th>
						<th class="jaction">عملیات</th>
					</tr>
					</tfoot>
					<tbody>
	<?php
	if (isset($fields)){
		$i=1;
		foreach($fields as $field){
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo g2j($field->expire)?></td>
				<?php
					if ($field->type==1)
						$type="درصد";
					if ($field->type==2)
						$type="تومان";
				?>
				<td><?php echo $type;?></td>
				<td ><?php echo $field->amount?></td>
				<td ><?php echo $field->from_fee?></td>
				<td ><?php echo $field->to_fee?></td>
				<?php
				if ($field->type_type==1)
					$type_type="هنگام خرید";
				if ($field->type_type==2)
					$type_type="بعد از خرید";
				?>
				<td ><?php echo $type_type?></td>
				<td ><?php echo $field->max_per_user?></td>
				<td >
					<a href="#" title="ویرایش" onclick="editccoupon('<?php echo $field->id?>')"><i class="fa fa-pencil"></i></a>
				</td>
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
			ajaxRequest('<?php echo url()?>/admin/new-c-coupon','ReportDialog');
			setDialog('ReportDialog',600,400);
		});
	});

	function editccoupon(id){
		ajaxRequest('<?php echo url()?>/admin/edit-c-coupon/'+id,'ReportDialog');
		setDialog('ReportDialog',600,400);
	}
	
</script>