<form id="Formorder">
  <?php
  if (isset($menu)) {
    foreach ($menu as $menus) {
      ?>
      <span class="menuName" style="background-color:#f80;color:#fff;box-shadow: 1px 1px 1px #2f2f2f;display: block;direction: rtl;text-align: right;padding:12px;"><?php echo $menus->title?></span>
      <?php
      $food = DB::table('z_foods')->where('cat_id',$menus->id)->get();
      foreach ($food as $foodsmenu) {
        ?>
        <ul style="direction: rtl;display:flex;padding:8px;margin-right:25px;text-align:center;justify-content:flex-start;">
          <li style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foodsmenu->title;?></li>
          <div class="contentContainer">
            <input style="padding:8px; width:120px;color:#000;" class="price" id="price<?php echo $foodsmenu->id;?>" onkeyup="costCalc('price<?php echo $foodsmenu->id;?>','totalCost<?php echo $foodsmenu->id;?>','<?php echo $foodsmenu->price?>')"  name="price<?php echo $foodsmenu->id;?>" value="0">
            <li style="width:200px;margin-right: 15px;text-align: center;display: inline-block;padding:12px 5px;list-style: none;"><?php echo $foodsmenu->price;?></li>
            <div style="display: inline-block">
              <span id="totalCost<?php echo $foodsmenu->id;?>"  name="<?php echo $foodsmenu->id?>" style=";margin-right:180px;"></span>
            </div>
          </div>
        </ul>
        <?php
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



</form>
<a href="#" class="jsubmit" id="Submit"><i class="fa fa-check"></i></a>
<script>
  $(function(){
    $('#Submit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('Formorder','<?php echo url()?>/admin/submit-order-new',true,'Dialog');
      refreshorder();
      setTimeout("$('#loading').hide()",1600);
    });
  });
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
