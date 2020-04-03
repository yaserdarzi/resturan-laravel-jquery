<form id="editVoteForm">
@if(isset($question))
    <input type="text" name="question[<?php echo $question->id?>]" value="{{$question->title}}" style="width: 200px;"><br><br><br>
@endif

@if(isset($vote_answers))
    @foreach($vote_answers as $vote_answer)
        <input name="answers[][<?php echo $vote_answer->id?>]" value="{{$vote_answer->title}}" style="width: 200px;">
    @endforeach
@endif
    <br>
    <div id="voteAnswers" style="margin-right:22px;">
        <i class="fa fa-plus" style="cursor: pointer;" id="newGroup">&nbsp;</i><br>
    </div>
</form>
<a href="#" class="jsubmit" id="submitEdit"><i class="fa fa-check"></i></a>
<script>
    $('#newGroup').on('click',function(){
        $('#voteAnswers').append('<input style="padding:4px;width:200px;margin:4px;" name="ans[]"><br>');
    });
    $('#submitEdit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('editVoteForm','<?php echo url()?>/admin/submit-edit-vote',true,'editVoteDialog');
        setTimeout("responder('votes-report')",1500);
        setTimeout("$('#loading').hide()",1600);
    });
</script>