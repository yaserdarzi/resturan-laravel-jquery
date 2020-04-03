<form id="materialForm">
<label for="name">نام</label>
<input id="name" name="name" style="padding:4px;margin:4px;width:200px;">
<label for="amount">مقدار</label>
<input id="amount" name="amount" style="padding:4px;margin:4px;width:200px;">
<label for="group">دسته بندی</label>
<select style="width:120px;margin:8px;" name="group"  id="group">
  @if(isset($fields))
  @foreach($fields as $field)
  <option value="{{$field->id}}">{{$field->title}}</option>
  @endforeach
  @endif
</select>
<label for="storage">انبار</label>
<select style="width:120px;margin:8px;" name="storage" id="storage">
  @if(isset($storages))
  @foreach($storages as $storage)
  <option value="{{$storage->id}}">{{$storage->title}}</option>
  @endforeach
  @endif
</select>
<label for="account">حساب</label>
<select style="width:120px;margin:8px;" name="account" id="account">
  @if(isset($accounts))
  @foreach($accounts as $account)
  <option value="{{$account->id}}">{{$account->name}}</option>
  @endforeach
  @endif
</select>
<label for="unit">واحد</label>
<select style="width:120px;margin:8px;" name="unit" id="unit">
  @if(isset($units))
  @foreach($units as $unit)
  <option value="{{$unit->id}}">{{$unit->title}}</option>
  @endforeach
  @endif
</select>
<label for="exp_date">تاریخ انقضا:</label>
<input id="exp_date" name="exp_date" style="width:100px;padding:4px;"><span>&nbsp;روز</span>
<label for="priceForUnit">قیمت واحد:</label>
<input type="text" name="priceForUnit" id="priceForUnit" style="width:100px;padding:4px;">
<label for="totalPrice">مبلغ:</label>
<input type="text" name="totalPrice" id="totalPrice" style="width:100px;padding:4px;">
<label for="productId">شناسه کالا</label>
<input type="text" name="productId" id="productId" style="width:100px;padding:4px;">
</form>
<a href="#" class="jsubmit" id="Submit"><i class="fa fa-check"></i></a>
<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
  $('#priceForUnit').on('keyup',function(){
    var priceForUnit =$('#priceForUnit').val();
    var amount =$('#amount').val();
    var price = priceForUnit*amount;
    $('#totalPrice').val(price);
  });

  $(function(){
    $('#Submit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('materialForm','<?php echo url()?>/admin/new-material',true,'ReportDialog');
      setTimeout("responder('add-mat')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>