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
                        <th>عنوان</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>
<?php
    if (isset($questions)){
        $i=0;
        $j=1;
        foreach($votes as $vote){
            ?>
            <tr >
                <td ><?php echo $j;?></td>
                <td><?php echo $questions[$i]->title;?></td>
                <td >
                    <a href="#" title="ویرایش" onclick="editVote('<?php echo $questions[$i]->id?>')"><i class="fa fa-pencil"></i></a>|
                    <a href="#" onclick="vote('<?php echo $questions[$i]->id?>')">جزئیات</a>|
                    <a href="#" class="jtrashicon" title="حذف" onclick="deleteVote('<?php echo $questions[$i]->id?>')"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
            <?php
            $i++;
            $j++;
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
<br><br><br>
<div id="chartView" style="margin-top:25px;padding:4px;"></div>
<div id="editVoteDialog" style="display: none"></div>
<script>
    $(function(){
        $('#add').on('click',function(){
            ajaxRequest('<?php echo url()?>/admin/new-vote','ReportDialog');
            setDialog('ReportDialog',600,400);
        });
    });
    function deleteVote(qid){
        $('#loading').show();
        ajaxSendData('ReportDialog',{
            id:qid
        },'<?php echo url()?>/admin/delete-vote');
        setTimeout("responder('votes-report')",1500);
        setTimeout("$('#loading').hide()",1600);
    }
    function vote(qid){
        ajaxSendData('chartView',{
            id:qid
        },'<?php echo url()?>/admin/vote-detail');
    }

    function editVote(id){
        ajaxSendData('editVoteDialog',{
            qid:id
        },'<?php echo url()?>/admin/edit-vote');
        setDialog('editVoteDialog',600,500);
    }

</script>