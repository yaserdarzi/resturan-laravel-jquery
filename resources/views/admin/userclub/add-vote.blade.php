<form id="voteForm">
    <label for="question">سوال:</label>
    <input type="text" name="question" id="question" style="padding:4px;width:200px;margin:4px;"><br><br><br>
    <p style="font-weight: bold;font-size:140%;">جوابها:</p>
    <div id="voteAnswers" style="margin-right:22px;">
        <input style="padding:4px;width:200px;margin:4px;" name="answers[]">
        <i class="fa fa-plus" style="cursor: pointer;" id="newGroup">&nbsp;</i><br>
    </div>
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
<script>
    $(function(){
        $('#newGroup').on('click',function(){
            $('#voteAnswers').append('<input style="padding:4px;width:200px;margin:4px;" name="answers[]"><br>');
        });
        $('#submit').on('click',function(){
            $('#loading').show();
            ajaxyFormData('voteForm','<?php echo url()?>/admin/insert-vote',true,'ReportDialog');
            setTimeout("responder('votes-report')",1500);
            setTimeout("$('#loading').hide()",1600);
        });
    });
</script>