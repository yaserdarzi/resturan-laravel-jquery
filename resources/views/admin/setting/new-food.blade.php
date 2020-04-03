<ul class="nav nav-tabs">
  <li class="nav active"><a href="#addFood" data-toggle="tab" id="add-food">ثبت غذا</a></li>
  <li class="nav"><a href="#addMaterial" data-toggle="tab" id="add-material">انبارداری</a></li>
</ul>
<form action="<?php echo url()?>/admin/insert-new-food" method="post" enctype="multipart/form-data">
  <div id="addFood" style="direction: rtl">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <span>نام گروه:</span>
    <select style="width:120px;" name="menu">
      <?php
      foreach($menus as $menu){
        ?>
        <option value="<?php echo $menu->title;?>"><?php echo $menu->title;?></option>
        <?php
      }
      ?>
    </select><br>
    <div id="menu">
      <span>مشخصات غذا:</span>
      <input type="text" id="1" name="food[]" required style="width: 300px;height:35px;margin:12px;padding:8px;" placeholder="نام غذا">
      <input type="text" id="2" name="price[]" required style="width: 300px;height:35px;margin:12px;padding:8px;" placeholder="قیمت"><br>
      <input type="text" id="4" name="desc[]" required style="width: 300px;height:35px;margin:12px;margin-right:78px;padding:8px;" placeholder="توضیحات غذا">
      <input type="text" id="5" name="makeup[]" required style="width: 300px;height:35px;margin:12px;padding:8px;" placeholder="زمان آماده سازی"><br>
      <input type="file" id="3[]" name="3[]" required style="width: 300px;height:35px;margin:12px;padding:8px;">
    </div>
    <button type="submit" class="jsubmit" style="width:100px;height:25px;"><i class="fa fa-check"></i></button>
  </div>
  <div id="addMaterial" style="display: none">

    <select id="group" name="group[]" style="width:140px;">
      @section('mats')
        @if(isset($materials))
          @foreach($materials as $material)
            <option value="{{$material->mat_ref}}">{{$material->name.'-'.$material->storageName}}</option>
        @endforeach
        @endif
      @show
    </select>
    &nbsp;&nbsp;&nbsp;
    <label for="count[]">مقدار</label>
    <input type="text" id="count[]" name="count[]" style="width: 200px;padding:4px;margin:4px;" required>
    <i class="fa fa-plus" style="cursor: pointer;" id="newGroup">&nbsp;</i>
  </div>
</form>
<script>
  $(document).ready(function(){
    var intputElements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < intputElements.length; i++) {
      intputElements[i].oninvalid = function (e) {
        e.target.setCustomValidity("");
        if (!e.target.validity.valid) {
          e.target.setCustomValidity("این فیلد نباید خالی باشد.");
        }
      };
    }
  });
</script>
<script>
  $(function(){
    $('#add-food').on('click',function(){
      $('#addFood').css('display','block');
      $('#addMaterial').css('display','none');
    });
    $('#add-material').on('click',function(){
      $('#addMaterial').css('display','block');
      $('#addFood').css('display','none');
    });
  });
</script>
<script>
  $(function(){
    var i=0;
    $('#newGroup').on('click',function(){
      //$('#addMaterial').append('<br><br><select id="'+i+'" name="storage[]" style="width:140px;"><?php if(isset($storages)){foreach($storages as $storage){?><option value="<?php echo $storage->id?>"><?php echo $storage->title?></option><?php }}?></select>');
      $('#addMaterial').append('<br><br><select id="'+i+'" name="group[]" style="width:140px;"><?php if(isset($materials)){foreach($materials as $material){?><option value="<?php echo $material->mat_ref?>"><?php echo $material->name.'-'.$material->storageName?></option><?php }}?></select><input type="text" id="count[]" name="count[]" style="width: 200px;padding:4px;margin-right:50px;">');
    });
  });

  $('select[name^=storage]').on('change',function(){
    var val = $(this).val();
    ajaxSendData('group',{
      id:val
    },'<?php echo url()?>/admin/loadMat');
  });
</script>