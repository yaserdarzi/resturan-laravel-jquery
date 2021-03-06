<?php
    $salaryPerHour = $staff->salary / $staff->work_hours;
    if ($vacation_times > $staff->max_vacation){
        $invalidVacation = $vacation_times-$staff->max_vacation;
    }else {
        $invalidVacation = 0;
    }
    $sallary= DB::table('z_salary')->where('staff_id',$staff->id)->orderBy('date','desc')->get();
    if($sallary==null)
    {
        $firstyear=date("y",strtotime(j2g($staff->bg_date)));
        $noewyear=date("y");
        $fristmount=date("m",strtotime(j2g($staff->bg_date)));
        $nowmount=date("m");
        $less=($noewyear.$nowmount)-($firstyear.$fristmount);
        if($less>=12)
            $less-=(88*($noewyear-$firstyear));
        for ($i=1;$i<$less;$i++)
        {
            $fristmount=$fristmount+1;
            $fromMonth =  date('Y-'.$fristmount.'-'.$staff->payday);
            $toMonth =  date('Y-'.($fristmount+1).'-'.$staff->payday);
            $data['vacations1'] = DB::table('z_vacation')->whereStaffId($staff->id)->whereCondition(2)->whereBetween('from_date',array($fromMonth,$toMonth))->get();
            $interval=0;
            foreach($data['vacations1'] as $vacation){
                $date1 = new \DateTime($vacation->from_date.' '.$vacation->from_time);
                $date2 = new \DateTime($vacation->to_date.' '.$vacation->to_time);
                $int =date_diff($date1,$date2);
                if($int->d!=0)
                    $interval += ($int->d*8);
                else
                    $interval += $int->h;
            }
            DB::table('z_salary')->insert(['staff_id'=>$staff->id,'cash'=>$staff->salary,'trans_id'=>0,'vacation'=>$interval,'date'=>$fromMonth,'time'=>getCurrentTime()]);
            ?>
            <script>
                var value = <?php echo $staff->id;?>;
                ajaxSendData('staffSalary',{
                    itemId:value
                },'<?php echo url()?>/admin/st-salary');
            </script>
            <?php
        }
    }
    else{
        foreach($sallary as $sallarys){
            $firstyear =date("y",strtotime($sallarys->date));
            $noewyear=date("y");
            $fristmount=date("m",strtotime($sallarys->date));
            $nowmount=date("m");
            $less=($noewyear.$nowmount)-($firstyear.$fristmount);
            if($less>=12)
                $less-=(88*($noewyear-$firstyear));
            for ($i=1;$i<$less;$i++)
            {
                $fristmount=$fristmount+1;
                $fromMonth =  date('Y-'.$fristmount.'-'.$staff->payday);
                $toMonth =  date('Y-'.($fristmount+1).'-'.$staff->payday);
                $data['vacations1'] = DB::table('z_vacation')->whereStaffId($staff->id)->whereCondition(2)->whereBetween('from_date',array($fromMonth,$toMonth))->get();
                $interval=0;
                foreach($data['vacations1'] as $vacation){
                    $date1 = new \DateTime($vacation->from_date.' '.$vacation->from_time);
                    $date2 = new \DateTime($vacation->to_date.' '.$vacation->to_time);
                    $int =date_diff($date1,$date2);
                    if($int->d!=0)
                        $interval += ($int->d*8);
                    else
                        $interval += $int->h;
                }
                DB::table('z_salary')->insert(['staff_id'=>$staff->id,'cash'=>$staff->salary,'trans_id'=>0,'vacation'=>$interval,'date'=>$fromMonth,'time'=>getCurrentTime()]);
                ?>
                <script>
                    var value = <?php echo $staff->id;?>;
                    ajaxSendData('staffSalary',{
                        itemId:value
                    },'<?php echo url()?>/admin/st-salary');
                </script>
                <?php
            }
            break;
        }
    }
?>
<div style="margin:20px auto;display: block;">
    <p>نام کارمند : <?php echo $staff->name?></p>
    <p>حقوق دریافتی: <?php echo $staff->salary?> تومان</p>
    <p>مجموع ساعات کاری در ماه: <?php echo $staff->work_hours?></p>
    <p>حقوق به ازای هرساعت : <?php echo round($salaryPerHour,2)?> تومان</p>
    <p>میزان مجاز ساعات مرخصی در ماه: <?php echo $staff->max_vacation?> ساعت</p>
    <?php $salary = $staff->work_hours-$invalidVacation?>
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
                <div  style="margin-top: -40px;">
                    <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th >مبلغ</th>
                            <th >ساعت مرخصی در ماه</th>
                            <th >تاریخ پرداخت</th>
                            <th >زمان پرداخت</th>
                            <th >شماره تراکنش</th>
                            <th class="jaction">عملیات</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ردیف</th>
                            <th >مبلغ</th>
                            <th >ساعت مرخصی در ماه</th>
                            <th >تاریخ پرداخت</th>
                            <th >زمان پرداخت</th>
                            <th >شماره تراکنش</th>
                            <th class="jaction">عملیات</th>
                        </tr>
                        </tfoot>
                        <tbody>
    <?php
    if (isset($salarygrid)){
        $i=1;
        foreach($salarygrid as $salarygrids){
            ?>
            <tr >
                <td><?php echo $i;?></td>
                <td ><?php echo $salarygrids->cash;?></td>
                <td ><?php echo $salarygrids->vacation;?></td>
                <td ><?php echo g2j($salarygrids->date);?></td>
                <td ><?php echo $salarygrids->time;?></td>
                <td ><?php echo $salarygrids->trans_id;?></td>
                <?php if ($salarygrids->trans_id == 0){ ?>
                    <td ><img id="indicator" src="<?php echo url()?>/assets/images/reject.png" style="width: 20px;height:20px;margin:6px;cursor:pointer;" onclick="payed('{{$salarygrids->id}}')"></td>
                    <?php  } if ($salarygrids->trans_id != 0){ ?>
                <td ><img id="indicator" src="<?php echo url()?>/assets/images/accept.png" style="width: 20px;height:20px;margin:6px;cursor:pointer;" onclick="nopayed('{{$salarygrids->id}}')"></td>
                <?php }?>
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
</div>
<div id="sallaryDialog" style="display: none; padding:8px;"></div>
<script>
    function nopayed(id){
        $('#loading').show();
        ajaxSendDataWithOutBack({
            itemId:id
        },'<?php echo url()?>/admin/sallary-nopay');
        setTimeout("responder('pay-salary')",1500);
        setTimeout("$('#loading').hide()",1600);
    }

    function payed(id){
        ajaxRequest('<?php echo url()?>/admin/sallary-payed/'+id,'sallaryDialog');
        setDialog('sallaryDialog',600,400);
    }
</script>