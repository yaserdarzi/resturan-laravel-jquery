<form id="wareHouseForm">
  @if(isset($store) && $store!="")
  <input type="hidden" value="{{$store->id}}" name="edit">
  @endif
  <label for="parentWareHouse">انبار مادر:</label>
  <select id="parentWareHouse" name="parentWareHouse" style="width: 140px;">
    <option value="0">زیرمجموعه انباری نیست.</option>
    <?php
    if (isset($substore)){
      foreach($substore as $substores){
        ?>
        @if(isset($store))
        @if($store->parent_id == $substores->id)
        <option value="<?php echo $substores->id?>" selected><?php echo $substores->title?></option>
        @else
        <option value="<?php echo $substores->id?>" ><?php echo $substores->title?></option>
        @endif
        @else
        <option value="<?php echo $substores->id?>" ><?php echo $substores->title?></option>
        @endif
        <?php
      }
    }
    ?>

  </select><br>
  <label for="wTitle">نام انبار:</label>
  <input id="wTitle" name="wTitle" style="width: 40%;padding:6px;" value="{{isset($store->title) ? $store->title : ''}}">
</form>

<a href="#" class="jsubmit" id="storeSubmit"><i class="fa fa-check"></i></a>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#storeSubmit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('wareHouseForm','<?php echo url()?>/admin/submitwarehouse-warehouses',true,'ReportDialog');
      setTimeout("responder('storages')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>