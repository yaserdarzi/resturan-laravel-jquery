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
" href="#" id="submitAccount">ثبت حساب</a>
<div  style="margin-top: -40px;">
    <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>ردیف</th>
            <th>بانک</th>
            <th>شماره حساب</th>
            <th>شماره شبا</th>
            <th>نوع حساب</th>
            <th>موجودی</th>
            <th class="jaction">عملیات</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>ردیف</th>
            <th>بانک</th>
            <th>شماره حساب</th>
            <th>شماره شبا</th>
            <th>نوع حساب</th>
            <th>موجودی</th>
            <th class="jaction">عملیات</th>
        </tr>
        </tfoot>
        <tbody>
        <?php
        if (isset($accounts)) {
            $i = 1;
            foreach ($accounts as $account) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $account->name; ?></td>
                    <td><?php echo $account->account_number; ?></td>
                    <td><?php echo $account->sheba_number; ?></td>
                    <td><?php echo $account->account_type; ?></td>
                    <td><?php echo $account->cash; ?></td>
                    <td><a href="javascript:void(0);" title="ویرایش" onclick="editaccount('{{$account->id}}')"><i class="fa fa-pencil"></i></a><a
                            href="javascript:void(0);" class="jtrashicon" title="حذف" onclick="deleteaccount('{{$account->id}}}')"><i class="fa fa-trash"></i></a></td>
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
<div id="accountReportDialog" style="display: none;padding:8px;"></div>
<script>
    $(function () {
        $('#submitAccount').on('click', function () {
            ajaxRequest('<?php echo url()?>/admin/new-account-form', 'accountReportDialog');
            setDialog('accountReportDialog', 600, 400);
        });
    });

    function deleteaccount(id) {
        $('#loading').show();
        ajaxSendDataWithOutBack({
            itemId: id
        }, '<?php echo url()?>/admin/delete-account');
        setTimeout("responder('add-account')", 1500);
        setTimeout("$('#loading').hide()", 1600);
    }

    function editaccount(id) {
        ajaxRequest('<?php echo url()?>/admin/edit-account/' + id, 'accountReportDialog');
        setDialog('accountReportDialog', 600, 400);
    }

</script>
