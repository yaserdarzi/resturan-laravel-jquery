<form id="form" action="<?php echo url()?>/admin/ordersNew" method="post">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <?php
  if (isset($foods)) {
    foreach($menu as $bar){
      ?>
      <span class="menuName" style="background-color:#f80;color:#fff;box-shadow: 1px 1px 1px #2f2f2f;display: block;direction: rtl;text-align: right;padding:12px;"><?php echo $bar->title?></span>
      <?php
      foreach ($foods as $food) {
        foreach ($food as $foo) {
          if ($foo->cat_id == $bar->id) {
            ?>
            <ul style="direction: rtl;display:flex;padding:8px;margin-right:25px;text-align:center;justify-content:flex-start;">
              <li style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foo->title;?></li>
              <div class="contentContainer">
                <input style="padding:8px; width:120px;color:#000;" class="price" id="price<?php echo $foo->id;?>" onkeyup="costCalc('price<?php echo $foo->id;?>','totalCost<?php echo $foo->id;?>','<?php echo $foo->price?>')"  name="<?php echo $foo->title;?>" value="0">
                <li style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foo->price;?></li>
                <div style="display: inline-block">
                  <span id="totalCost<?php echo $foo->id;?>"  name="<?php echo $foo->id?>" style=";margin-right:180px;"></span>
                </div>
              </div>
            </ul>
            <?php
          }
        }
      }
    }
    ?>
    <hr style="width:100%;">
    <span id="finalCost">جمع کل:</span><br><br>
    <input type="hidden" name="total" id="hidden">
    <div class="orders">
      <div class="fr">
        <span>کداشتراک:</span>
        <input type="text" name="sbscode" autocomplete="off" id="sbscode" onkeyup="validator()" style="height:35px;width:200px;padding:8px;color:#000;">
        <span id="sbsname" style="color:#f40;font-weight:bold;">&nbsp</span>
        <input type="hidden" name="cname" id="cname"><br><br><br>
        <label>شماره میز</label>
        <input id="tableNo" name="tableNo" type="text" style="color:#000">
      </div><br><br>
      <span id="submit" class="submitBtn" style="color:#000;cursor: pointer;background-color:#f80;padding:16px;margin: 12px;">ثبت و بستن</span>
      <!--span id="newSubmit" class="submitBtn" style="color:#000;cursor: pointer;background-color:#f80;padding:16px;margin: 12px;">ثبت و جدید</span>
      <!--a href="#" id="print" class="submitBtn" style="color:#000;background-color:#f80;padding:12px;margin: 12px;">پرینت</a-->
    </div>
    <?php
  }
  ?>
</form>
<script>
  $(function(){
    $('#submit').on('click',function(){
      var data = $('#form').serialize();
      $.post('<?php echo url()?>/admin/ordersNew',data);
      $('#dialog-modal').dialog('close');
      $('#dialog-modal').dialog('destroy');
    });
    $('#newSubmit').on('click',function(){
      console.log('enteredB');
      var data = $('#form').serialize();
      $.post('<?php echo url()?>/admin/ordersNew',data);
      $('#dialog-modal').dialog('close');
      $('#dialog-modal').dialog("open");
    });
    /*$('#print').on('click',function(){
      var printContents = document.getElementById('dialog-modal').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    });*/
  });
</script>
<script>
  function validator(){
    var value = $('#sbscode').val();
    $.ajax('<?php echo url();?>/admin/ordersNewLoadSbs',{
      dataType:'json',
      data:{
        content:value
      },
      success:function(data){
        $('#sbsname').text(data.name);
        $('#cname').val(data.name);
      }
    })
  }
</script>
<script>
  var array=new Object();
  function costCalc(id,name,cost){
    var input = document.getElementById(id);
    var inputValue = input.value;
    var newSign= inputValue*cost;
    if (name in array){
      delete array[name];
    }
    array[name]=newSign;
    var global=0;
    for(var key in array){
      global +=array[key];
    }
    document.getElementById(name).textContent=""+newSign;
    document.getElementById('finalCost').textContent="جمع کل: "+global;
    document.getElementById('hidden').value=global;
  }
</script>