<form id="form" style="padding:8px;">
<label for="name">نام</label>
<select name="name">
  <?php
    if (isset($fields)){
      foreach($fields as $field){
        ?>
            <option value="<?php echo $field->id?>"><?php echo $field->name?></option>
        <?php
      }
    }
  ?>
</select>
  <span class="blink" id="message" style="color:#f00;font-weight: bold;">&nbsp;</span>
  <br>
  <label for="fromDate">از تاریخ</label>
  <input id="fromDate" name="fromDate" style="width: 200px;padding:8px;margin:8px;color:#2f2f2f" required>
  <label for="toDate">تا تاریخ</label>
  <input id="toDate" name="toDate" style="width: 200px;padding:8px;margin:8px;color:#2f2f2f" required><br>
  <label for="fromTime">از ساعت</label>
  <input id="fromTime" name="fromTime" style="width: 200px;padding:8px;margin:8px;color:#2f2f2f">
  <label for="toTime">تا ساعت</label>
  <input id="toTime" name="toTime" style="width: 200px;padding:8px;margin:8px;color:#2f2f2f"><br>
  <label for="desc">توضیحات</label>
  <input id="desc" name="desc" style="width: 200px;padding:8px;margin:8px;color:#2f2f2f"><br>
  <a href="#" class="jsubmit" id="submit"><i class="fa fa-check"></i></a>
</form>
<script>
  $(function(){
    $('#fromDate').datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy/mm/dd'
    });
    $('#toDate').datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: 'yy/mm/dd'
    });
    $('#fromTime').timepicker({ 'timeFormat': 'H:i:s' });
    $('#toTime').timepicker({ 'timeFormat': 'H:i:s' });
    
    $('#submit').on('click',function(){
      $('#loading').show();
      var data = $('#form').serialize();
      $.get('<?php echo url()?>/admin/insert-leave',data);
      $('#dialog-parent').dialog('destroy');
      $.ajax("<?php echo url()?>/admin/ajaxCore", {
        dataType: 'json',
        data:{
          elementId:'new-leave'
        },
        success: function (data) {
          $('.open').addClass("active open");
          $('.start').removeClass("start active");
          $('#page-content').html(data.content);
        }
      });
      setTimeout("responder('new-leave')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>
<script>
  $(function(){
    $('#name').on('change',function(){
      var value = $('#name').val();
      $.ajax('<?php echo url()?>/admin/validate-staff',{
          dataType:'json',
          data:{
            satff_name: value
          },
        success:function(data){
          $('#message').html(data.content);
        }
      });
    });
  });
</script>