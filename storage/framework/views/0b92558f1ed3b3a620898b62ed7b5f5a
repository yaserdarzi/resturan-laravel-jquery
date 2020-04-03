<form id="registerForm">
    <label for="field_type">نوع فیلد:</label>
    <select id="field_type" name="field_type" style="width:140px;padding:4px;" required>
        <?php
        if (isset($fields)){
            foreach($fields as $field){
                ?>
                <option value="<?php echo $field->id;?>"><?php echo $field->title?></option>
                <?php
            }
        }
        ?>
    </select><br>
    <label for="en_name">نام انگلیسی:</label>
    <input type="text" name="en_name" id="en_name" style="width:200px;padding:4px;margin:4px;"><br>
    <label for="fa_title">نام فارسی:</label>
    <input type="text" name="title" id="fa_title" style="width:200px;padding:4px;margin:4px;"><br>
    <div id="specific">
        <label for="def_value">مقدار پیش فرض:</label>
        <input type="text" name="defvalue" id="defvalue" style="width:200px;padding:4px;margin:4px;"><br>
    </div>
    <input type="checkbox" name="required" style="padding:4px;margin:4px;">اجباری<br>
    <div id="dropdown" style="display:none">
        <input type="text" name="dropdownValue[]" style="width:200px;padding:4px;margin:4px;" placeholder="عنوان">
        <i class="fa fa-plus" style="cursor: pointer;" id="newDdValue">&nbsp;</i>
    </div>
</form>
<a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
<script>
    $('#submit').on('click',function(){
        $('#loading').show();
        ajaxyFormData('registerForm','<?php echo url()?>/admin/add-reg-field',true,'ReportDialog');
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