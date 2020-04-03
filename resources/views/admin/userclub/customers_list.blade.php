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
" href="#"  id="addcustomer">ثبت مشتریان</a>
      <div  style="margin-top: -40px;">
        <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
          <thead>
          <tr>
            <th>نام و نام خانوداگی</th>
            <th >شماره تماس</th>
            <th>شماره اشتراک</th>
            <th >تاریخ ثبت نام</th>
            <th >تاریخ آخرین بازدید</th>
            <th class="jaction">عملیات</th>
          </tr>
          </thead>
          <tfoot>
          <tr>
            <th>نام و نام خانوداگی</th>
            <th >شماره تماس</th>
            <th>شماره اشتراک</th>
            <th >تاریخ ثبت نام</th>
            <th >تاریخ آخرین بازدید</th>
            <th class="jaction">عملیات</th>
          </tr>
          </tfoot>
          <tbody>

  @section('customers')
    <input type="hidden" id="query" value="<?php echo $query?>">
  @if(isset($customers))
    @foreach($customers as $customer)
      <tr>
          <td>{{$customer->name}}</td>
          <td >{{$customer->phone}}</td>
          <td>{{$customer->cctt}}</td>
          <td >{{g2j($customer->submit_date)}}</td>
          <td >{{g2j($customer->last_visit)}}</td>
        <td><a href="javascript:void(0);" title="ویرایش" onclick="editcustomer('{{$customer->id}}')"><i class="fa fa-pencil"></i></a><a href="javascript:void(0);" class="jtrashicon" title="حذف" onclick="deletcustomer('{{$customer->id}}')"><i class="fa fa-trash"></i></a></td>
      </tr>
  @endforeach
  @endif
@show

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>


  $(function(){
    $('#addcustomer').on('click',function(){
      ajaxRequest('<?php echo url()?>/admin/add-customers','ReportDialog');
      setDialog('ReportDialog',600,400);
    });
  });

  function deletcustomer(id){
    $('#loading').show();
    ajaxSendDataWithOutBack({
      itemId:id
    },'<?php echo url()?>/admin/delete-customers');
    setTimeout("responder('customers')",1500);
    setTimeout("$('#loading').hide()",1600);
  }

  function editcustomer(id){
    ajaxRequest('<?php echo url()?>/admin/edit-customers/'+id,'ReportDialog');
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
