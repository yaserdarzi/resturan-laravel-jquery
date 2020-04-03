<form id="materialForm">
<label for="name">نام</label>
<input id="id" name="id" type="hidden" style="width:200px;padding:8px;margin:4px;color:#2f2f2f" value="<?php echo $materials->id?>">
<input id="matTitle" name="matTitle" style="width:200px;padding:8px;margin:4px;color:#2f2f2f" value="<?php echo $materials->name?>">
<label for="count">مقدار</label>
<input id="count" name="count" style="width:200px;padding:8px;margin:4px;color:#2f2f2f" value="<?php echo $materials->amount?>"><br><br>
<select id="grouping" name="grouping" style="width:120px;">
  @if (isset($allGroups))
    @foreach($allGroups as $allGroup)
      @if($materials->cat_id == $allGroup->id)
        <option value="{{$allGroup->id}}" selected>{{$allGroup->title}}</option>
      @else
        <option value="{{$allGroup->id}}">{{$allGroup->title}}</option>
      @endif
    @endforeach
  @endif
</select>
<select id="uniting" name="uniting" style="width:120px;">
  @if (isset($allUnits))
    @foreach($allUnits as $allUnit){
    @if ($materials->unit_id == $allUnit->id)
      <option value="{{$allUnit->id}}" selected>{{$allUnit->title}}</option>
    @else
      <option value="{{$allUnit->id}}">{{$allUnit->title}}</option>
    @endif
    @endforeach
  @endif
</select>
<label for="exp_date">تاریخ انقضا:</label>
<input id="exp_date0" name="exp_date0" style="width:200px;padding:4px;" value="{{g2j($materials->exp_date)}}">
  </form>

<a href="#" class="jsubmit" id="mySubmit"><i class="fa fa-check"></i></a>
<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $(function(){
    $('#mySubmit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('materialForm','<?php echo url()?>/admin/update-material',true,'ReportDialog');
      setTimeout("responder('add-mat')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
  
  $('#exp_date0').datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat:'yy/mm/dd'
  });
</script>