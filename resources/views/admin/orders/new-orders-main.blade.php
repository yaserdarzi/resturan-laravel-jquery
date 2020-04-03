<form class="orderpageform">
<div>
    <a href="#" id="add">ثبت سفارش</a>
</div>
<div>
    <form action="#" method="post">
        <?php
        if (isset($status)) {
            foreach ($status as $statuss) {
                $checked="";
                if($statuss->isdefault==1)
                    $checked="checked";
                ?>
                <input type="checkbox" id="checkstatus[]" name="checkstatus[]" onclick="refreshorder()" <?=$checked?>  value="<?=$statuss->id?>"><?=$statuss->title?>
                <br/>
                <?php
            }
        }
        ?>
    </form>
    <input style="width:300px;padding:8px;" id="factor" autocomplete="off" name="factor" onchange="refreshorder()" placeholder="فیلتر بر اساس شماره پیگیری">&nbsp;&nbsp;
    <label>فیلتر بر اساس تاریخ</label>
    <input style="width:200px;height:35px;padding: 8px;direction: rtl;text-align:right;" onchange="refreshorder()" value="<?=g2j(date('Y-m-d'));?>" id="datepicker0" type="text" placeholder=" از تارخ">
    <input style="width:200px;height:35px;padding:8px;direction: rtl;text-align:right" onchange="refreshorder()" id="datepicker1" type="text" placeholder="تا تاریخ">
</div>
<script>
    window.isPaused=false;
    window.intervalTime=30000;
</script>
<div >
    <label for="intervalTime">تایمر:</label>
    <input type="text" id="intervalTime" style="width:120px;padding:4px;margin:12px;display:inline-block;" value="30">ثانیه
    <img id="refreshIndicator" src="<?php echo url()?>/assets/images/play.png" style="display:inline-block;width:50px;height:50px;cursor:pointer;padding:4px;margin:4px;">
    <img id="refreshList" src="<?php echo url()?>/assets/images/refresh.png" style="display:inline-block;width:40px;height:40px;cursor:pointer;padding:4px;margin:4px;">
    <label id="secondsTimer">00</label>
    <script>
        if (!window.isPaused){
            $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/pause.png')
        }else{
            $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/play.png')
        }
    </script>
</div>
</form>

            <div id="contentContainer" >

            </div>

<div id="Dialog" style="display: none; padding:8px;"></div>
<script>
    refreshorder();
    $(function(){
        $('#add').on('click',function(){
            ajaxRequest('<?php echo url()?>/admin/new-save-order-route','Dialog');
            setDialog('Dialog',600,400);
        });
    });

    function changestatus(id) {
        ajaxRequest('<?php echo url()?>/admin/change-status-order/'+id,'Dialog');
        setDialog('Dialog',600,400);
    }

    function  refreshorder(){
        var checkboxes = document.getElementsByName('checkstatus[]');
        var vals = "";
        for (var i=0, n=checkboxes.length;i<n;i++)
        {
            if (checkboxes[i].checked)
            {
                vals += ","+checkboxes[i].value;
            }
        }
        if (vals) vals = vals.substring(1);
        var valstatus = vals;
        var date = document.getElementById("datepicker0").value ;
        var date1 = document.getElementById("datepicker1").value ;
        var factor= document.getElementById("factor").value ;
        var valdate1 = "0";
        if(date1!="")
            var valdate1 = date1;
        ajaxSendData('contentContainer',{
            itemId:0,
            status:valstatus,
            date1:date,
            date2:valdate1,
            refid:factor
        },'<?php echo url()?>/admin/fill-new-orders');
    }
</script>
<script>
    $(function(){
        var minutes = document.getElementById('secondsTimer');
        var totalSeconds = 0;

        if (!window.isPaused){
            var timerInterval = setInterval(setTime,1000);
        }


        $('#refreshIndicator').on('click',function(){
            window.isPaused = !window.isPaused;
            if (!window.isPaused){
                window.isPaused = false;
                refreshorder();
                $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/pause.png');
            }else{
                $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/play.png');
                window.isPaused = true;
            }
        });

        function setTime(){
            if(!window.isPaused){
                if (totalSeconds >= window.intervalTime/1000){
                    totalSeconds=0;
                }
                ++totalSeconds;
                minutes.innerHTML = pad(totalSeconds%60);
                if(minutes.innerHTML ==(window.intervalTime/1000) )
                    refreshorder();
            }
        }

        function pad(val){
            var valString  = val+"";
            if (valString.length < 2){
                return 0+valString;
            }else{
                return valString;
            }
        }

        $('#intervalTime').on('change',function(){
            var val = $(this).val();
            window.intervalTime =val*1000;
        });

        $('#refreshList').on('click',function(){
            refreshorder();
        });

    });

</script>
<script>
    $(function(){
        $('#datepicker0').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy/mm/dd'
        });
        $('#datepicker1').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat:'yy/mm/dd'
        });
    });
</script>


