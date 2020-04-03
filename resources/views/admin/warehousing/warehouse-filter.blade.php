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
" href="#" id="changematerial">انتقال مواد</a>
            <div  style="margin-top: -40px;">
                <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th >نام</th>
                        <th >انبار</th>
                        <th >موجودی</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ردیف</th>
                        <th >نام</th>
                        <th >انبار</th>
                        <th >موجودی</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @section('content')
@if (isset($fields))
<?php $i=0;
$j=1;?>
@foreach($fields as $field)
<tr >
    <td>{{$j}}</td>
    <td >{{$field->name}}</td>
    <td >{{$field->storageName}}</td>
    <td >{{$field->amount . ' '. $field->title}}</td>
</tr>
<?php $i++;
$j++;?>
@endforeach
@else
<tr >
    <td>{{1}}</td>
    <td >{{$field->name}}</td>
    <td >{{$field->amount . ' '. $units->title}}</td>
</tr>
@endif
@show

</tbody>
</table>
</div>
</div>
</div>
</div>


<script>
    $(function(){
        $('#changematerial').on('click',function(){
            ajaxRequest('<?php echo url()?>/admin/add-mat-exchange','ReportDialog');
            setDialog('ReportDialog',600,400);
        });
    });
</script>