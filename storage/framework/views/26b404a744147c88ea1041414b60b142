<script>
    window.isPaused=false;
    window.intervalTime=30000;
</script>
<div id="heads">
  <span>فیلتر:</span><br>
  <input style="width:300px;padding:8px;" id="factor" autocomplete="off" name="factor" placeholder="فیلتر بر اساس شماره پیگیری">&nbsp;&nbsp;
  <select id="sort" style="width:100px;">
    <option id="upper">صعودی</option>
    <option id="downer">نزولی</option>
  </select>&nbsp;&nbsp;&nbsp;
  <label>ترتیب براساس</label>
  <select id="for" style="width:120px;">
    <option id="date">تاریخ ثبت</option>
    <option id="make">زمان آماده سازی</option>
  </select>
  <a href="#" onclick="showDialog()">ثبت سفارش</a>
  <br><br><br>
  <label>فیلتر بر اساس تاریخ</label>
  <input style="width:200px;height:35px;padding: 8px;direction: rtl;text-align:right" id="datepicker0" type="text" placeholder="از تاریخ">&nbsp;&nbsp;
  <input style="width:200px;height:35px;padding:8px;direction: rtl;text-align:right" id="datepicker1" type="text" placeholder="تا تاریخ">
  <a href="#" style="text-decoration: none;color:#f80;" id="filterDate" style="width:80px;height:30px;">فیلتر</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <a href="#" id="dayFilter" style="color:#f80;margin-right:100px;margin-left: 12px;text-decoration:none;">امروز</a>
  <a href="#" id="past" style="color:#f80;margin-left: 12px;text-decoration:none;">دیروز</a>
  <a href="#" id="thisWeek" style="color:#f80;margin-left: 12px;text-decoration:none;">هفته جاری</a>
  <a href="#" id="preWeek" style="color:#f80;margin-left: 12px;text-decoration:none;">هفته قبل</a>
  <br><br>
  <div style="margin:10px auto;text-align:center;width:500px;background-color:#aaa;">
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
  <ul style="display: flex;justify-content: space-between;background-color:#ff006f;align-items: center;max-width: 900px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
    <li style="display: inline-block;bopadding:10px 8px;width:35px;">ردیف</li>
    <li style="display: inline-block;bopadding:10px 8px;width:200px;">نام</li>
    <li style="display: inline-block;bopadding:10px 8px;width:300px;">سفارشات</li>
    <li style="display: inline-block;padding:10px 8px;width:350px;">نوع تحویل</li>
    <li style="display: inline-block;padding:10px 8px;width:150px;">نوع پرداخت</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">مبلغ کل</li>
    <li style="display: inline-block;padding:10px 8px;width:150px;">تاریخ ثبت</li>
    <li style="display: inline-block;padding:10px 8px;width:100px;">ساعت ثبت</li>
    <li style="display: inline-block;padding:10px 8px;width:200px;">توضیحات</li>
    <li style="display: inline-block;padding:10px 8px;width:50px;">&nbsp;</li>
  </ul>
</div>
<div id="contentContainer">
  <?php
  $factorIds =array();
  $i=1;
  if (isset($fields)) {
    foreach ($fields as $field) {
      $foods = DB::table('z_food_orders')->whereFactorId($field->refid)->get();
      if (!isset($factorIds[$field->refid])){
        $factorIds[$field->refid]=$field->refid;
      }else{
        continue;
      }
      ?>
      <ul style="display: flex;justify-content: space-between;background-color:#eee;align-items: center;max-width: 900px;text-align:center;margin: 0 auto;color:#2f2f2f;min-width:500px;">
        <li style="display: inline-block;padding:10px 8px;width:35px;"><?php echo $i?></li>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->username?></li>
        <li style="display: inline-block;padding:10px 8px;width:300px;">
          <?php
          $food_names="";
          foreach($foods as $food){
            $foodname = DB::table('z_foods')->whereId($food->food_id)->first();
            $food_names .=' '.$foodname->title.' ('.$food->foodcount.') ';
          }
          echo $food_names;
          ?>
        </li>
        <li style="display: inline-block;padding:10px 8px;width:350px;"><?php echo $field->orderType." ".$field->order_set?></li>
        <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo $field->paymentType?></li>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->totalFee?></li>
        <li style="display: inline-block;padding:10px 8px;width:150px;"><?php echo g2j($field->date)?></li>
        <li style="display: inline-block;padding:10px 8px;width:100px;"><?php echo $field->time?></li>
        <li style="display: inline-block;padding:10px 8px;width:200px;"><?php echo $field->note?></li>
        <li style="display: inline-block;padding:10px 8px;width:50px;"><a href="<?php echo url()?>/admin/print/<?php echo $field->or_id?>" target="_blank">پرینت</a></li>
      </ul>
      <?php
      $i++;
    }
  }
  ?>
</div>

<div id="dialog-modal" style="display: none;overflow:scroll"></div>
<script>
  function showDialog(){
    $.ajax('<?php echo url()?>/admin/ordersNewLoadFood',{
      dataType:'json',
      cache: false,
      success:function(data){
        $('#dialog-modal').html(data.content);
        var dail = $('#dialog-modal').dialog({
        autoOpen: false,
          resizable: false,
          width:900,
          height:500,
          hide: function () {
            $(this).fadeOut();
          },
          show:  function () {
            $(this).fadeIn();
          },
          open: function() {
            $('#dialog-modal').empty();
            $.ajax('<?php echo url()?>/admin/ordersNewLoadFood',{
              dataType:'json',
              cache: false,
              success:function(data){
                $('#dialog-modal').html(data.content);
              }
            });
          }
        });
        dail.dialog('open');
      }
    });
  }
  $('#dialog-modal').on('dialogclose', function() {
    $.ajax("<?php echo url()?>/admin/addmenu", {
      dataType: 'json',
      data:{
        elementId:'orders'
      },
      success: function (data) {
        $('#page-content').html(data.content);
      }
    });
  });
</script>
<script>
  $(function(){
    $('#dayFilter').on('click',function(){
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          order:'dayFilter'
        },
        success:function(data){
          $('#datepicker0').val(data.jDate);
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
          $('#dayFilter').css();
        }
      })
    });
    $('#preWeek').on('click',function(){
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          order:'preWeek'
        },
        success:function(data){
          $('#datepicker0').val(data.firstWeek);
          $('#datepicker1').val(data.friday);
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
          $('#preWeek').css();
        }
      })
    });
    $('#past').on('click',function(){
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          order:'past'
        },
        success:function(data){
          $('#datepicker0').val(data.jDate);
          $('#datepicker1').val("");
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
          $('#past').css();
        }
      })
    });
    $('#thisWeek').on('click',function(){
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          order:'thisWeek'
        },
        success:function(data){
          $('#datepicker0').val(data.firstWeek);
          $('#datepicker1').val(data.nowTime);
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
          $('#thisWeek').css();
        }
      })
    });
  });
</script>
<script>
  $(function(){
    $('#orderType').on('change',function(){
      var id = $(this).find('option:selected').attr('id');
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          order:id
        },
        success:function(data){
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
        }
      })
    });
  });
</script>
<script>
  $(function(){
    $('#datepicker0').datepicker({
      changeMonth: true,
      changeYear: true
    });
    $('#datepicker1').datepicker({
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<script>
    $('#filterDate').on('click', function () {
      var fromDate = $('#datepicker0').val();
      var toDate = $('#datepicker1').val();
      $.ajax('<?php echo url()?>/admin/filterOrders', {
        dataType: 'json',
        data: {
          form: fromDate,
          to: toDate
        },
        success: function (data) {
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
        }
      })
    });
</script>
<script>
    $('#sort').on('change',function(){
      var id = $(this).find('option:selected').attr('id');
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          elementId:'orders',
          order:id
        },
        success:function(data){
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
        }
      })
    });
</script>
<script>
    $('#for').on('change',function(){
      var id = $(this).find('option:selected').attr('id');
      $.ajax('<?php echo url()?>/admin/filterOrders',{
        dataType:'json',
        data:{
          elementId:'orders',
          order:id
        },
        success:function(data){
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
        }
      })
    });
</script>
<script>
  function display(id,username,address){
    $('#'+id).tooltipster({
      animation: 'grow',
      contentAsHTML: true,
      content: $("<span>نام مشتری:"+username+"</span><br><span>آدرس:"+address+"</span>"),
      trigger: 'click'
    });
  }
</script>
<script>
    $('#factor').on('keyup',function(){
      var value =$(this).val();
      if (value.length < 1){
        $('#cs').css('visibility','visible');
      }else{
        $('#cs').css('visibility','hidden');
      }
      $.ajax('<?php echo url()?>/admin/ordersFactorFilter',{
        dataType:'json',
        data:{
          key:value
        },
        success:function(data){
          $('#contentContainer').html("");
          $('#contentContainer').html(data.content);
        }
      })
    });
</script>
<script>
  function ajaxGetAllOrders(){
    $.ajax('<?php echo url()?>/admin/ordersAutoGetNew',{
      dataType:'json',
      async: true,
      success:function(data){
        $('#contentContainer').html(data.content);
      }
    });
  }
</script>
<script>
  $(function(){
    var minutes = document.getElementById('secondsTimer');
    var totalSeconds = 0;

    if (!window.isPaused){
      //var interval = setInterval('ajaxGetAllOrders();',window.intervalTime);
     // ajaxGetAllOrders();
      var timerInterval = setInterval(setTime,1000);
    }

    $('#refreshIndicator').on('click',function(){
      window.isPaused = !window.isPaused;
      if (!window.isPaused){
        window.isPaused = false;
        interval = setInterval('ajaxGetAllOrders();',window.intervalTime);
        timerInterval = setInterval(setTime,1000);
        ajaxGetAllOrders();
        $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/pause.png');
      }else{
        window.isPaused = true;
        clearInterval(interval);
        clearInterval(timerInterval);
        $('#refreshIndicator').attr('src','<?php echo url()?>/assets/images/play.png');
      }
    });

    function setTime(){
      if (totalSeconds >= window.intervalTime/1000){
        totalSeconds=0;
      }
      ++totalSeconds;
      minutes.innerHTML = pad(totalSeconds%60);
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
      ajaxGetAllOrders();
    });

  });
</script>