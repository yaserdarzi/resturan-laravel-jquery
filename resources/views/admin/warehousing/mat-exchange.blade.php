<form id="echangematerialForm">
<label for="firstWarehouse">از انبار:</label>
<select id="firstWarehouse" name="firstWarehouse" style="width:140px;">
    <option selected></option>
    @foreach($storages as $storage)
        <option value="{{$storage->id}}">{{$storage->title}}</option>
    @endforeach
</select>
<div id="forFirstWareHouse">
    @section('firstMaterials')
        <select id="firstMaterials" name="firstMaterials" style="width:140px;">
            @if(isset($materials))
            @foreach($materials as $material)
                <option value="{{$material->mat_ref}}">{{$material->name}}</option>
            @endforeach
            @endif
        </select>
    @show
</div>

<label for="secondWarehouse">به انبار:</label>
<select id="secondWarehouse" name="secondWarehouse" style="width:140px;">
    <option selected></option>
    @foreach($storages as $storage)
        <option value="{{$storage->id}}">{{$storage->title}}</option>
    @endforeach
</select>
<label for="amount">میزان:</label>
<input type="text" id="amount" name="amount" style="width:200px;">
    </form>


<a href="#" class="jsubmit" id="begin"><i class="fa fa-check"></i></a>

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
    $('#firstWarehouse').on('change',function(){
        var val = $(this).val();
        ajaxSendData('forFirstWareHouse',{
            id:val,
            target:'first'
        },'<?php echo url()?>/admin/loadMaterials');
    });

    $(function(){
        $('#begin').on('click',function(){
            $('#loading').show();
            ajaxyFormData('echangematerialForm','<?php echo url()?>/admin/exchangeMaterials',true,'ReportDialog');
            setTimeout("responder('warehouse-inventory')",1500);
            setTimeout("$('#loading').hide()",1600);
        });
    });
</script>

<a href="javascript:void(0);" id=""></a>