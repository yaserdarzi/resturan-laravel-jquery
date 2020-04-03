<?php

function jalali_to_gregorian($jy,$jm,$jd,$mod=''){
    $gy=($jy<=979)?621:1600;
    $jy-=($jy<=979)?0:979;
    $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4))
        +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
    $gy+=400*((int)($days/146097));
    $days%=146097;
    if($days > 36524){
        $gy+=100*((int)(--$days/36524));
        $days%=36524;
        if($days >= 365)$days++;
    }
    $gy+=4*((int)(($days)/1461));
    $days%=1461;
    $gy+=(int)(($days-1)/365);
    if($days > 365)$days=($days-1)%365;
    $gd=$days+1;
    foreach(array(0,31,(($gy%4==0 and $gy%100!=0) or ($gy%400==0))?29:28
            ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
        if($gd<=$v)break;
        $gd-=$v;
    }
    return($mod=='')?array($gy,$gm,$gd):$gy.$mod.$gm.$mod.$gd;
}

function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
    $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
    $jy=($gy<=1600)?0:979;
    $gy-=($gy<=1600)?621:1600;
    $gy2=($gm>2)?($gy+1):$gy;
    $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100))
        +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
    $jy+=33*((int)($days/12053));
    $days%=12053;
    $jy+=4*((int)($days/1461));
    $days%=1461;
    $jy+=(int)(($days-1)/365);
    if($days > 365)$days=($days-1)%365;
    $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
    $jd=1+(($days < 186)?($days%31):(($days-186)%30));
    return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
}

function getCurrentDate(){
    $date = date('Y-m-d');
    return $date;
}

function getCurrentJalaliDate(){
    $currentDate = getCurrentDate();
    $currentDate = explode('-',$currentDate);
    $currentJalaliDate = gregorian_to_jalali($currentDate[0],$currentDate[1],$currentDate[2],'/');
    return $currentJalaliDate;
}

function chart($title,$data,$type,$id,$bizierCurve=true,$dataSetFill=true){
    ob_start();
    ?>
    <canvas style="display: block;margin: 0 auto;width:100%;height:auto;padding-bottom:10px;" id="<?php echo $id?>" ></canvas>
    <script>
        $(function(){
            var ctx = $('#<?php echo $id?>').get(0).getContext('2d');
            var barChartData = {
                labels : <?php echo json_encode($title) ?>,
                datasets : [
                    {
                        fillColor : "rgba(28, 175, 154, 1)",
                        highlightFill : "rgba(43, 54, 67, 1)",
                        strokeColor: "rgba(54, 65, 80, 1)",
                        highlightStroke: "rgba(43, 54, 67, 1)",
                        data : <?php echo json_encode($data) ?>
                    }
                ]
            };
            var pieChart = new Chart(ctx).<?php echo $type?>(barChartData,{
                bezierCurve: <?php echo $bizierCurve?>,
                datasetFill : <?php echo $dataSetFill?>
            });
            var height = $('#<?php echo $id?>').prop('height');
            $('#<?php echo $id?>').closest('.jreportchart').css('height',height);
            $('#<?php echo $id?>').closest('.jreportchartdiv').css('height',height);
            $('#<?php echo $id?>').on('resize',function(){
                var h = $('#<?php echo $id?>').prop('height');
                $(this).closest('.jreportchart').css('height',h);
                $(this).closest('.jreportchartdiv').css('height',h);
            });
        });
    </script>
    <?php
    $view = ob_get_clean();
    return $view;
}

function pieChart($title,$data,$id){
    ob_start();
    ?>
    <canvas style="display: block;margin: 0 auto;width:100%;height:auto;padding-bottom:10px;" id="<?php echo $id?>"></canvas>
    <script>
        $(function(){
            var ctx = $('#<?php echo $id?>').get(0).getContext('2d');
            var barChartData = [
                <?php
                $i=0;
                if (count($data)<12){
                    $padding="4px;";
                }else{
                $padding = "0px;";
                }
                  foreach($data as $dd){
				  if (count($i) % 3 == 1 && $i>2 && $i % 3 == 0){
                   $r = floor(('0.'.rand(6,9))*200);
                    $g = floor(('0.'.rand(0,3))*220);
                    $b = floor(('0.'.rand(6,9))*200);
                  } else if ($i % 3 == 0){
                     $r = floor(('0.'.rand(6,9))*200);
                    $g = floor(('0.'.rand(0,3))*220);
                    $b = floor(('0.'.rand(0,3))*220);
                  }else if ($i % 3 == 1){
                     $r = floor(('0.'.rand(0,3))*220);
                    $g = floor(('0.'.rand(6,9))*200);
                    $b = floor(('0.'.rand(0,3))*220);;
                  }else if ($i % 3 == 2){
                   $r = floor(('0.'.rand(0,3))*220);
                    $g = floor(('0.'.rand(0,3))*220);
                    $b = floor(('0.'.rand(6,9))*200);
                  }
                  ?>
                {
                    value:<?php echo $dd?>,
                    color: 'rgba(<?php echo $r?>,<?php echo $g?>,<?php echo $b?>,1)',
                    highlight: 'rgba(<?php echo $r>100?($r+(rand(floor((255-$r)/2),255-$r))):$r;?>,<?php echo $g>100?($g+(rand(floor((255-$g)/2),255-$g))):$g;?>,<?php echo $b>100?($b+(rand(floor((255-$b)/2),255-$b))):$b;?>,1)',
                    label: "<?php echo $title[$i];$i++;?>"
                },
                <?php
                  }
                ?>
            ];
            var options = {
                animateRotate: true,
                animateScale: false,
                responsive:true,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li style=\"list-style: none;padding:<?php echo $padding?>\"><span style=\"background-color:<%=segments[i].fillColor%>;margin: 8px;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
            }
            var pieChart = new Chart(ctx).Pie(barChartData,options);
            $('#legend').html(pieChart.generateLegend());
            var height = $('#<?php echo $id?>').prop('height');
            $('#<?php echo $id?>').closest('.jreportchart').css('height',height);
            $('#<?php echo $id?>').closest('.jreportchartdiv').css('height',height);
            $('#<?php echo $id?>').on('resize',function(){
                var h = $('#<?php echo $id?>').prop('height');
                $(this).closest('.jreportchart').css('height',h);
                $(this).closest('.jreportchartdiv').css('height',h);
            });
        });
    </script>
    <?php
    $view = ob_get_clean();
    return $view;
}

function highCharts($title,$labelX,$labelY,$id,$type='column',$data,$showLegend){
    ob_start();
    ?>
    <script>
        var chart;
        var newh = $("#<?php echo $id?>").closest('.jreportchart').height();
        $(window).resize(function() {
            newh = $("#<?php echo $id?>").closest('.jreportchart').height();
            chart.redraw();
            chart.reflow();
        });

        chart = new Highcharts.Chart({
           chart:{
			   renderTo: '<?php echo $id?>',
               type:'<?php echo $type?>',
               zoomType: 'x'
           },
            title:{
                text:'<?php echo $title?>'
            },
            xAxis:{
                categories:<?php echo json_encode($labelX)?>
            },
            yAxis:{
                title: {
                    text: '<?php echo $labelY?>'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} درصد',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                    <?php if ($showLegend){?>
                    ,
                    showInLegend: true
                    <?php } ?>
                },
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
            legend: {
                <?php if ($showLegend){?>
                    enabled:true,
                <?php }else{ ?>
                    enabled:false,
                <?php } ?>
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'middle',
                floating: true,
                backgroundColor: '#FFFFFF'
            },
			lang: {
					contextButtonTitle: "عملیات خروجی",
					decimalPoint: ".",
					downloadPNG: 'دانلود PNG',
					downloadJPEG: 'دانلود JPEG',
					downloadPDF: 'دانلود فایل PDF',
					downloadSVG: 'دانلود وکتور SVG',
					drillUpText: "بازگشت به {series.name}",
					invalidDate: '',
					loading: "در حال بارگزاری ...",
					months: [ "January" , "February" , "March" , "April" , "May" , "June" , "July" , "August" , "September" , "October" , "November" , "December"],
					noData: "اطلاعاتی جهت نمایش وجود ندارد",
					numericSymbols: [ "k" , "M" , "G" , "T" , "P" , "E"],
					printChart: "چاپ نمودار",
					resetZoom: "بزرگنمایی پیش فرض",
					resetZoomTitle: "سطح بزرگنمایی پیش فرض 1:1",
					shortMonths: [ "Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Oct" , "Nov" , "Dec"],
					weekdays: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

            },

			tooltip: {

				},

            series:[{
                    name: '<?php echo $labelY?>',
                <?php
                    if ($type == "pie"){
                        ?>
                data:[
                        <?php
                        $i=0;
                        foreach($data as $info){
                            ?>
                                {
                                    name:'<?php echo $labelX[$i]?>',
                                    y:<?php echo $info?>
                                },
                            <?php
                            $i++;
                        }
                        ?>]<?php
                    }else{
                        ?>
                        data: [<?php echo join($data,',')?>]
                        <?php
                    }
                ?>
            }]
        });
        var height = $('#<?php echo $id?>').css('height');
        $('#<?php echo $id?>').closest('.jreportchart').css('height',height);
        $('#<?php echo $id?>').closest('.jreportchartdiv').css('height',height);
        $('#<?php echo $id?>').on('resize',function(){
          var h = $('#<?php echo $id?>').prop('height');
          $(this).closest('.jreportchart').css('height',h);
          $(this).closest('.jreportchartdiv').css('height',h);
        });
    </script>
    <?php
    $view = ob_get_clean();
    return $view;
}

function exportToExcel($view,$data){
    Excel::create('excelFile', function($excel) use($data,$view) {
        $excel->sheet('excelSheet', function($sheet) use($data,$view) {
            $sheet->loadView($view,$data);
        });
    })->download('xls');
}

function getCurrentTime(){
    return date('G:i');
}
function getActuallyCurrentTime(){
    return date('Gis');
}

/**
 * @param $id -> id of field
 * @param $type -> type of field like(input,textarea,...)
 * @param $defaultValue -> default value (only works for input , textarea)
 * @param $label -> text to be shown beside of element
 * @param $required -> is element required to fill ?
 * @param $name -> the name attribute for submit form
 * @return string
 */
function renderRegisterForm($id,$type,$defaultValue,$label,$required,$name){
    ($required == 1 ? $is_required='required' : $is_required='');
    if ($type == 'select') {
        $defaultValue = explode('|', $defaultValue);
        ob_start();
        ?>
        <select name="<?php echo $name?>"
                style="width:140px;padding:4px;margin:6px;direction: rtl;text-align:right"  <?php echo $is_required?>>
            <?php
            foreach ($defaultValue as $dValue) {
                if ($dValue == "") {
                    continue;
                }
                ?>
                <option value="<?php echo $dValue?>"><?php echo $dValue?></option>
                <?php
            }
            ?>
        </select><br>
        <?php
        $view = ob_get_clean();
        return $view;
    }else if($type == "option"){
        ?>
        <label style="color:#2f2f2f" for="field<?php echo $id?>"><?php echo $label?></label>
        <input id="field<?php echo $id?>" type="radio" name="<?php echo $name?>" <?php echo $is_required?>>
        <?php
    }else{
        ob_start();
        ($defaultValue !="" ? $value="value='$defaultValue'" : $value="");
        ($type == "textarea" ? $enclosingTag="</textarea>" : $enclosingTag="");
        ($type == "input" ? $class="class='inputer'" : $class="");
        ?>
        <label style="margin:6px;color:#2f2f2f;" for="<?php echo 'field'.$id?>"><?php echo $label?></label>
        <<?php echo $type;?> <?php echo $class?> name="<?php echo $name?>" id="<?php echo 'field'.$id?>" <?php echo $value?> <?php echo $is_required;?>><?php echo $enclosingTag;?>
        <br>
        <?php
        $view = ob_get_clean();
        return $view;
    }
}

function g2j($date,$format="/"){
    $date = explode('-',$date);
    return gregorian_to_jalali($date[0],$date[1],$date[2],$format);
}

function j2g($date,$delimiter='/',$format="-"){
    $date = explode($delimiter,$date);
    return jalali_to_gregorian($date[0],$date[1],$date[2],$format);
}

function zTable($titles,$values,$titleliClassName,$titleUlClassName,$rowsliClassName,$rowUlClassName,$tableFields=null,$orderType,$orderField,$sortUrl,$sortContainer){
    ob_start();
    ?>
    <ul class="<?php echo $titleUlClassName?>">
    <?php
        $counter=0;
    foreach($titles as $title){
        if (isset($tableFields) && $orderField == $tableFields[$counter]){
            $class_name = "title-asc-desc";
            if ($orderType == "asc"){
                $class_name = "title-desc";
            }else if ($orderType == "desc"){
                $class_name = "title-asc";
            }if ($counter == 0){
                ?>
                <li class="<?php echo $titleliClassName?>"><?php echo $title?></li>
                <?php
            }else{
                ?>
                <li class="<?php echo $titleliClassName?>"><a href="#" data-filter="<?php echo $orderType?>" class="<?php echo $class_name?>" onclick="sortData(this,'<?php echo $tableFields[$counter]?>')"><?php echo $title?></a></li>
                <?php
            }
        }else{
            $class_name = "title-asc-desc";
            if ($counter == 0){
                ?>
                <li class="<?php echo $titleliClassName?>"><?php echo $title?></li>
                <?php
            }else {
                ?>
                <li class="<?php echo $titleliClassName?>"><a href="#" data-filter="" class="<?php echo $class_name?>" onclick="sortData(this,'<?php echo $tableFields[$counter]?>')"><?php echo $title?></a></li>
                <?php
            }
        }
        $counter++;
    }
    ?>
    </ul>
    <?php
    for($i=0;$i<count($values);$i++){
        ?>
        <ul class="<?php echo $rowUlClassName?>">
        <?php
            $j=0;
            foreach($values[$i] as $value){
            ?>
                <li class="<?php echo htmlentities($rowsliClassName,ENT_QUOTES,'UTF-8')?>"><?php echo htmlentities($value,ENT_QUOTES,'UTF-8')?></li>
            <?php
            $j++;
        }
        ?>
            </ul>
    <?php
    }
    ?>
    <script>
        function sortData(context,orderBy){
            var attr = $(context).attr('data-filter');

            var keys=[];
            var values = [];
            var inputs = document.querySelectorAll('input.zinput');

            for (var i=0;i<inputs.length;i++){
                keys.push($(inputs[i]).attr('data-filter'));
                values.push($(inputs[i]).val());
            }

            var selectsVal=[];
            var selects = document.querySelectorAll('select.multy');
            for (var j=0;j<selects.length;j++){
                selectsVal.push($(selects[j]).val());
            }

            if (attr == "asc"){
                $(context).attr('data-filter','asc');
            }else{
                $(context).attr('data-filter','desc');
            }
            ajaxSendData('<?php echo $sortContainer?>',{
                sortType:attr,
                orderBy:orderBy,
                inputsValue:values,
                selectsValue:selectsVal
            },'<?php echo $sortUrl?>');
        }
    </script>

    <?php
    $output = ob_get_clean();
    return $output;
}

function returnDates($fromdate, $todate) {
    $fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
    $todate = \DateTime::createFromFormat('Y-m-d', $todate);
    return new \DatePeriod(
        $fromdate,
        new \DateInterval('P1D'),
        $todate->modify('+1 day')
    );
}

function convertDateRangeToJalali($dates){
    $jDates=array();
    foreach($dates as $date){
        $jDates[] = g2j($date->format('Y-m-d'));
    }
    return $jDates;
}

function renderFilters($url,$container,$days=true,$weeks=true,$fromDateId,$toDateId){
    ob_start();
    if ($days){?>
            <a href="#" class="submit jtimerange" onclick="specificFilter('today')">امروز</a>
            <a href="#" class="submit jtimerange" onclick="specificFilter('yesterday')" >دیروز</a>
        <?php }?>
        <?php if ($weeks){?>
            <a href="#" class="submit jtimerange" onclick="specificFilter('thisWeek')" >هفته جاری</a>
            <a href="#" class="submit jtimerange" onclick="specificFilter('lastWeek')" >هفته قبل</a>
        <?php }?>
    <script>
        function specificFilter(day){
            var inputVals = [];
            var inputs = document.querySelectorAll('input.zinput');
            for (var i=0;i<inputs.length;i++){
                inputVals.push($(inputs[i]).val());
            }
            var selectsVal=[];
            var selects = document.querySelectorAll('select.multy');
            for (var j=0;j<selects.length;j++){
                selectsVal.push($(selects[j]).val());
            }

            $.ajax('<?php echo $url?>',{
               dataType:'json',
                data:{
                    date:day,
                    inputsValue:inputVals,
                    selectsValue:selectsVal
                },

                success:function(data){
                    $('#<?php echo $fromDateId?>').val(data.fromDate);
                    $('#<?php echo $toDateId?>').val(data.toDate);
                    $('#<?php echo $container?>').html(data.content);
                }
            });
        }
    </script>
    <?php
    $view = ob_get_clean();
    return $view;
}

