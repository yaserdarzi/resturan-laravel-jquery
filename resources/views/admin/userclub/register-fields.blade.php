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
                        <th >ردیف</th>
                        <th >عنوان</th>
                        <th >نوع</th>
                        <th >مقدار پیش فرض</th>
                        <th >اجباری</th>
                        <th >وضعیت</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th >ردیف</th>
                        <th >عنوان</th>
                        <th >نوع</th>
                        <th >مقدار پیش فرض</th>
                        <th >اجباری</th>
                        <th >وضعیت</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>
    <?php
        if (isset($user_fields)){
            $i=0;
            $value="";
            foreach($user_fields as $user_field){
                $str = $user_field->default_value;
                    if (strpos($str,'|')!==false){
                    $defualtValue = explode('|',$user_field->default_value);
                        foreach($defualtValue as $df){
                            if ($df == ""){
                                continue;
                            }
                            $value .=$df.',';
                        }
                }else{
                        $value = $user_field->default_value;
                }
                if ($user_field->required == 1){
                    $required = "بله";
                }else{
                    $required = "خیر";
                }
                ?>
                <tr>
                    <td ><?php echo $i+1;?></td>
                    <td><?php echo $user_field->title?></td>
                    <td><?php echo $field_types[$i]->title;?></td>
                    <td><?php echo $value?></td>
                    <td><?php echo $required?></td>
                    <td>
                        <?php
                        if ($user_field->enabled == 1){
                            ?>
                            <span>فعال</span>
                            <a href="#" onclick="deactivateField('<?php echo $user_field->id?>')"> / غیرفعال کردن</a>
                            <?php
                        }else{
                            ?>
                            <span>غیر فعال</span>
                            <a href="#" onclick="activateField('<?php echo $user_field->id?>')"> / فعال کردن</a>
                            <?php
                        }
                        ?>
                    </td>
                    <td>
                        <a href="#" title="ویرایش" onclick="editregisterfields('<?php echo $user_field->id?>')"><i class="fa fa-pencil"></i></a>
                    </td>
                </tr>
                <?php
                $i++;
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
<script>
    $(function(){
        $('#add').on('click',function(){
            ajaxRequest('<?php echo url()?>/admin/new-register-fields','ReportDialog');
            setDialog('ReportDialog',600,400);
        });
    });

    function editregisterfields(id){
        ajaxRequest('<?php echo url()?>/admin/edit-register-fields/'+id,'ReportDialog');
        setDialog('ReportDialog',600,400);
    }

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
    function deactivateField(itemId){
        $('#loading').show();
        ajaxSendData('ReportDialog',{
            id:itemId
        },'<?php echo url()?>/admin/deactive-field');
        setTimeout("responder('register-fields')",1500);
        setTimeout("$('#loading').hide()",1600);
    }
    function activateField(itemId){
        $('#loading').show();
        ajaxSendData('ReportDialog',{
            id:itemId
        },'<?php echo url()?>/admin/active-field');
        setTimeout("responder('register-fields')",1500);
        setTimeout("$('#loading').hide()",1600);
    }
</script>