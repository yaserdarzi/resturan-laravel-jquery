<form id="registerForm">
    @if(isset($user_fields) && $user_fields!="")
    <input type="hidden" value="{{$user_fields->id}}" name="edit">
    @endif
    <label for="field_type">نوع فیلد:</label>
    <select id="field_type" name="field_type" style="width:140px;padding:4px;" required>
        <?php
        if (isset($fields)){
            foreach($fields as $field){
                ?>
                @if(isset($user_fields))
                @if($user_fields->field_type_id == $field->id)
                <option value="<?php echo $field->id?>" selected><?php echo $field->title?></option>
                @else
                <option value="<?php echo $field->id?>"><?php echo $field->title?></option>
                @endif
                @else
                <option value="<?php echo $field->id?>"><?php echo $field->title?></option>
                @endif
                <?php
            }
        }
        ?>
    </select><br>
    <label for="en_name">نام انگلیسی:</label>
    <input type="text" name="en_name" id="en_name" value="{{$user_fields->en_name}}"  style="width:200px;padding:4px;margin:4px;"><br>
    <label for="fa_title">نام فارسی:</label>
    <input type="text" name="title" id="fa_title" value="{{$user_fields->title}}" style="width:200px;padding:4px;margin:4px;"><br>
    <?php if($user_fields->field_type_id==3){ ?>
    <div id="specific">
        <label for="def_value">مقدار پیش فرض:</label>
        <input type="text" name="defvalue" id="defvalue"
               style="display: none; width:200px;padding:4px;margin:4px;"><br>
    </div>
    <input type="checkbox" name="required" style="padding:4px;margin:4px;">اجباری<br>
        <div id="dropdown" style="display:block">

            <?php
            $str = $user_fields->default_value;
            if (strpos($str,'|')!==false){
                $defualtValue = explode('|',$user_fields->default_value);
                foreach($defualtValue as $df){
                    if ($df == ""){
                        continue;
                    }
                    ?>
                    <input type="text" name="dropdownValue[]" value="<?=$df?>" style="width:200px;padding:4px;margin:4px;" placeholder="عنوان">
                    <?php
                }
            }else{ ?>
                <input type="text" name="dropdownValue[]" value="<?=$user_field->default_value ?>" style="width:200px;padding:4px;margin:4px;" placeholder="عنوان">
            <?php }
            ?>





            <i class="fa fa-plus" style="cursor: pointer;" id="newDdValue">&nbsp;</i>
        </div>
        <?php
        }
        else
         { ?>
        <div id="specific">
            <label for="def_value">مقدار پیش فرض:</label>
            <input type="text" name="defvalue" value="{{$user_fields->default_value}}" id="defvalue" style="width:200px;padding:4px;margin:4px;"><br>
        </div>
        <input type="checkbox" name="required"  style="padding:4px;margin:4px;">اجباری<br>
        <div id="dropdown" style="display:none">
            <input type="text" name="dropdownValue[]" style="width:200px;padding:4px;margin:4px;" placeholder="عنوان">
            <i class="fa fa-plus" style="cursor: pointer;" id="newDdValue">&nbsp;</i>
        </div>
    <?php
    }
    ?>

</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
<script>
    $('#submit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('registerForm','<?php echo url()?>/admin/edit-reg-field',true,'ReportDialog');
        setTimeout("responder('register-fields')",1500);
        setTimeout("$('#loading').hide()",1600);
    });
    $('#field_type').on('change',function(){
        var val = $(this).find(":selected").text();
        if (val== "منوی کشویی"){
            $('#specific').css('display','none');
            $('#dropdown').css('display','block');
        }else{
            $('#specific').css('display','block');
            $('#dropdown').css('display','none');
        }
    });
    $('#newDdValue').on('click',function(){
       $('#dropdown').append('<br><input type="text" name="dropdownValue[]" style="width:200px;padding:4px;margin:4px;" placeholder="عنوان">');
    });
</script>