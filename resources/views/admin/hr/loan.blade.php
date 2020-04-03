<form id="loanstaffpageform">


<select id="staff" style="width:150px;margin:8px">
    <option></option>
    @if(isset($fields))
    @foreach($fields as $field)
        <option value="{{$field->id}}">{{$field->name}}</option>
    @endforeach
    @endif
</select>

<div id="staffLoanSummary">
    @section('content')
    <a href="#" id="newLoanForm">ثبت وام</a>
    <div id="new-loan-dialog"></div>
    <script>
        $('#newLoanForm').on('click',function(){
            var selectedId = $('#staff').val();
            ajaxSendData('new-loan-dialog',{
                itemId:selectedId
            },'<?php echo url()?>/admin/loans');
        });
    </script>
</form>
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
                <div  style="margin-top: -40px;">
                    <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th >وام</th>
                            <th >تاریخ دریافت</th>
                            <th >بازپرداخت</th>
                            <th class="jaction">عملیات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th >وام</th>
                            <th >تاریخ دریافت</th>
                            <th >بازپرداخت</th>
                            <th class="jaction">عملیات</th>
                        </tr>
                        </tfoot>
                        <tbody>
    @if (isset($loans))
        @foreach($loans as $stf)
            @if ($stf->payed == 0)
                <?php $image ="times";?>
                <?php $payclass ="jactpayno";?>
                <?php $paytitle ="تایید نشده";?>
            @else
                <?php $image ="check";?>
                <?php $payclass ="jactpayok";?>
                <?php $paytitle ="تایید شده";?>
            @endif
            <tr>
                <td >{{$stf->amount}}</td>
                <td >{{g2j($stf->loan_date)}}</td>
                <td >{{g2j($stf->payback_date)}}</td>
                <td >
                    <a href="#" title="ویرایش" onclick="editLoan('{{$stf->id}}','{{$stf->staff_id}}','{{$stf->payed}}')"><i class="fa fa-pencil"></i></a>
                    <a id="indicator" class="<?php echo $payclass?>" href="#" title="<?php echo $paytitle?>" onclick="payed('{{$stf->id}}','{{$stf->payed}}')"><i class="fa fa-<?php echo $image?>"></i></a>
                </td>
            </tr>
    @endforeach
    @endif
    @stop

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editLoanDialog" style="display: none;"></div>
<script>
    $('#staff').on('change',function(){
        var selectedId = $(this).val();
        ajaxRequest('<?php echo url()?>/admin/getLoans/'+selectedId,'staffLoanSummary');
    });
    function editLoan(loanId,staff_id){
        ajaxSendData('editLoanDialog',{
            itemId:loanId,
            staffId:staff_id
        },'<?php echo url()?>/admin/editLoan');
        setDialog('editLoanDialog',600,400);
    }

    function payed(id,status,pay){
        var selectedId = $('#staff').val();
        ajaxSendDataWithOutBack({
            state:status,
            itemId:id,
            paye:pay
        },'<?php echo url()?>/admin/payLoan');
        setTimeout(
            function(){
                ajaxRequest('<?php echo url()?>/admin/getLoans/'+selectedId,'staffLoanSummary');
            },1000);
    }
</script>