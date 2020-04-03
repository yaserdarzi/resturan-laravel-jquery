<ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
    <li style="display: inline-block;padding:10px 8px;width:50px;">شناسه</li>
    <li style="display: inline-block;padding:10px 8px;width:150px;">نام</li>
    <?php
    if (isset($fields)){
        foreach($fields as $field){
            ?>
            <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $field->title?></li>
            <?php
        }
    }
    ?>
</ul>
<?php
if (isset($users)) {
    $j=0;
    for ($i=0;$i<count($users);$i++){
        ?>
        <ul style="display: flex;justify-content: space-between;background-color:#eee;align-items: center;max-width: 800px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
            <li style="display: inline-block;padding:10px 8px;width:50px;"><?php echo $users[$i]->id?></li>
            <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $users[$i]->name?></li>
            <?php
            header('Content-Type: text/html; charset=utf-8');
            foreach($fields as $field){
                    ?>
                    <li style="display: inline-block;padding:10px 8px;width:150px;">
                        <?php
                        $hossein = DB::table('z_user_fields_map')->whereUserId($users[$i]->id)->whereUserFieldsId($field->id)->orderBy('id','desc')->first();
                        if (isset($hossein)){
                            echo $hossein->value;
                        }else{
                            echo "---";
                        }
                        ?>
                    </li>
                    <?php
                }
            ?>
        </ul>
        <?php
    }
}
?>