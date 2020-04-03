<form id="Form">
    <input type="hidden" id="id" name="id" value="<?php echo $filed->id?>">
    <?php
    if (isset($status)) {
        foreach ($status as $statuss) {
            if ($statuss->id == $filed->status) {
                $strstatus = $statuss->title;
            }
        }
    }
    ?>
    <label for="salaryThisMonth">از قسمت  : <?=$strstatus?></label>

    <label>انتقال به قسمت : </label>
    <select id="status" name="status" style="width:120px;">
        <?php

            if (isset($status)){
                foreach($status as $statuss) {
                    if ($statuss->id != $filed->status) {
                        ?>
                        <option value="<?php echo $statuss->id ?>"><?php echo $statuss->title ?></option>
                        <?php
                    }
                }
            }
        ?>
    </select>
    </form>
<a href="#" id="Submit">انتقال</a>
<script>
    $(function(){
        $('#Submit').on('click',function(){
            $('#loading').show();
            ajaxyFormData('Form','<?php echo url()?>/admin/submit-change-order',true,'Dialog');
            refreshorder();
            setTimeout("$('#loading').hide()",1600);
        });
    });
</script>