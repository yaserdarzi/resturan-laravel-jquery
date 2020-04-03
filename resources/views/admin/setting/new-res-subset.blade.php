<form id="form">
    @if(isset($fields) && $fields!="")
    <input type="hidden" value="{{$fields->id}}" name="edit">
    @endif

    <div class="row">
        <label>نام رستوران:</label>
        <input type="text" name="title" id="title" value="{{isset($fields) ? $fields->title : ''}}" style="width:250px;padding:4px">
    </div>

    <div class="row">
        <label>توضیحات :</label>
        <input type="text" name="desc" id="desc" value="{{isset($fields) ? $fields->desc : ''}}" style="width:250px;padding:4px">
    </div>
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>

<script>
    $('#submit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('form','<?php echo url()?>/admin/add-res-subset',true,'ReportDialog');
        setTimeout("responder('subsets')",1500);
        setTimeout("$('#loading').hide()",1600);
    });
</script>