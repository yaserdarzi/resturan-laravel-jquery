<form class="salarypageform">
    <select id="stf" style="width: 120px;">
    <?php
        if (isset($staffs)){
            ?>
            <option selected></option>
            <?php
            foreach($staffs as $staff){
                ?>
                    <option value="<?php echo $staff->id?>"><?php echo $staff->name?></option>
                <?php
            }
        }
    ?>
</select>
</form>
<div id="staffSalary">

</div>
<script>
    $('#stf').on('change',function(){
       var value = $(this).val();
        ajaxSendData('staffSalary',{
            itemId:value
        },'<?php echo url()?>/admin/st-salary');
    });
</script>