<form id="new-food-category-form">
    @if(isset($fields) && $fields!="")
    <input type="hidden" value="{{$fields->id}}" name="edit">
    @endif
    <div class="row">
        <label for="subset">زیرمجموعه رستوران:</label>
        <select id="subset" name="parent_id">
            <?php
            if (isset($subsets)){
                foreach($subsets as $subset){
                    ?>
                    @if(isset($fields))
                    @if($fields->parent_id == $subset->id)
                    <option value="{{$subset->id}}" selected >{{$subset->title}}</option>
                    @else
                    <option value="{{$subset->id}}"  >{{$subset->title}}</option>
                    @endif
                    @else
                    <option value="{{$subset->id}}"  >{{$subset->title}}</option>
                    @endif
                    <?php
                }
            }
            ?>
        </select>
    </div>

    <span>نام گروه:</span>
    <input type="text" name="title" value="{{isset($fields) ? $fields->title : ''}}" placeholder="نام گروه را وارد نمائید" style=" padding:8px;width:300px;height:35px;margin-left: 12px;">
    <input type="text" name="desc" value="{{isset($fields) ? $fields->desc : ''}}" placeholder="توضیحات گروه" style=" padding:8px;width:300px;height:35px;margin-left: 5px;;">
    <input type="text" name="sort" value="{{isset($fields) ? $fields->sort : ''}}" placeholder="مرتب سازی" style=" padding:8px;width:300px;height:35px;margin-left: 5px;;">
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
<script>
    $('#submit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('new-food-category-form','<?php echo url()?>/admin/add-food-category',true,'ReportDialog');
        setTimeout("responder('food-category')",1500);
        setTimeout("$('#loading').hide()",1600);
    });
</script>








