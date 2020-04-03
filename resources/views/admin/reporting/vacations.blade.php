<div id="vacationReport">
    <?php
    if (!isset($orderType)){$orderType = "title-desc";}
    if (!isset($orderField)){$orderField = "z_vacation.to_date";}
    if (isset($fields) && count($fields) > 0){
        $i=1;
        foreach ($fields as $field) {
            $values[] = [$i,$field->name,g2j($field->from_date),g2j($field->to_date),$field->from_time,$field->to_time];
            $i++;
        }
        $titles = ['ردیف','نام','از تاریخ','تا تاریخ','از ساعت','تا ساعت'];
        $tableFields = ['','z_staff.name','z_vacation.from_date','z_vacation.to_date','z_vacation.from_time','z_vacation.to_time'];
        echo zTable($titles,$values,'titleli','titleul','rowli','rowul',$tableFields,$orderType,$orderField,url().'/admin/filterVacationReports','vacationReport');
    }else{
    $titles = ['ردیف','نام','از تاریخ','تا تاریخ','از ساعت','تا ساعت'];
    echo zTable($titles,array(),'titleli','titleul','rowli','rowul',null,$orderType,$orderField,'','');
    ?>
    <ul class="rowul">
        <li class="titleli" style="border-left:1px solid #e0e0e0;">موردی یافت نشد.</li>
    </ul>
<?php
}
?>