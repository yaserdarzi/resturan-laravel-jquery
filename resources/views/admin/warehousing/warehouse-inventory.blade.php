<form id="warehouseinventorypageform">
      <select id="storageFilter" style="width: 140px; ">
        <option value="0" selected>همه انبارها</option>
        @foreach($storages as $storage)
        <option value="{{$storage->id}}">{{$storage->title}}</option>
        @endforeach
      </select>

          <div id="contentContainer">

  </div>
</form>
<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $('#loading').show();
  ajaxSendData('contentContainer',{
    storage_id:0
  },'<?php echo url()?>/admin/filterMatByStorage');
  $('#loading').hide();
  $('#storageFilter').on('change',function(){
    $('#loading').show();
    var value = $(this).val();
    ajaxSendData('contentContainer',{
      storage_id:value
    },'<?php echo url()?>/admin/filterMatByStorage');
    $('#loading').hide();
  });
</script>