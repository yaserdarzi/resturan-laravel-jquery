<form id="foodorderstaffpageform">
<form>

  <input type="radio" name="radio" id="inside" value="داخل رستوران"  style="margin:6px;">داخل رستوران
  <br>
  <input type="radio"  name="radio" id="outside" value="ااز بیرون"style="margin:6px;">ااز بیرون
  <br>
  <input type="radio" name="radio" id="store" value="موجودی انبار"style="margin:6px;">موجودی انبار
  <br>
</form>
<form id="form1" style="display: none">
  <select name="foodId">
    <?php
      if (isset($foods)){
      foreach($foods as $food){
        ?>
        <option value="<?php echo $food->id?>"><?php echo $food->title;?></option>
        <?php
      }
      }
    ?>
  </select><br>
  <br>
  <label for="count1">تعداد:</label>
  <input id="count1" type="text" name="count" style="width:200px;padding:4px;margin:4px;"><br>
  <a href="#" id="submit1">ثبت</a>
</form>
<form id="form2" style="display: none">
  <label for="foodname">نام غذا</label>
  <input type="text" style="width:200px;padding:4px;margin:4px;" name="foodname" id="foodname"><br>
  <label for="count2">تعداد</label>
  <input type="text" name="count2" id="count2" style="width:200px;margin:4px;padding:4px;"><br>
  <label for="cost">هزینه:</label>
  <input type="text" id="cost" name="cost" style="width: 200px;padding:4px;margin:4px;"><br>
  <select name="account_id">
    <?php
    if (isset($accounts)){
      foreach($accounts as $account){
          if ($account->name == "انبار"){continue;}
        ?>
        <option value="<?php echo $account->id?>"><?php echo $account->name;?></option>
        <?php
      }
    }
    ?>
  </select><br>
  <a href="#" id="submit2">ثبت</a>
</form>
<form id="form3" style="display: none">
  <select id="group" name="group[]" style="width:140px;">
    <?php
    if (isset($materials)){
      foreach($materials as $material){
        ?>
        <option value="<?php echo $material->name?>"><?php echo $material->name?></option>
        <?php
      }
    }
    ?>
  </select><br>
  <br>
  &nbsp;&nbsp;&nbsp;
  <label for="count[]">مقدار</label>
  <input type="text" id="count[]" name="count[]" style="width: 200px;padding:4px;margin:4px;" required>
  <i class="fa fa-plus" style="cursor: pointer;" id="newGroup">&nbsp;</i>
  <a href="#" id="submit3">ثبت</a>
</form>

</form>
<div style="margin-top: 50px;">
  <link href="{{URL::asset('assets/datatable/css/style.css')}}" rel="stylesheet" type="text/css"/>

  <script type="text/javascript" language="javascript"
          src="{{URL::asset('assets/datatable/js/jquery.dataTables.min.js')}}">
  </script>
  <script type="text/javascript" language="javascript"
          src="{{URL::asset('assets/datatable/js/dataTables.bootstrap.min.js')}}">
  </script>
  <div class="row jfirst-child">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

      <div class=" portlet light jform">
        <div  style="margin-top: -40px;">
          <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
              <th ">ردیف</th>
              <th >نام غذا</th>
              <th >تعداد</th>
              <th >هزینه</th>
              <th >نوع سفارش</th>
              <th >تاریخ</th>
              <th >زمان</th>
              <th >شماره تراکنش</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
              <th ">ردیف</th>
              <th >نام غذا</th>
              <th >تعداد</th>
              <th >هزینه</th>
              <th >نوع سفارش</th>
              <th >تاریخ</th>
              <th >زمان</th>
              <th >شماره تراکنش</th>
            </tr>
            </tfoot>
            <tbody>
  <?php
  if (isset($staff_orders)){
    $i=1;
    foreach($staff_orders as $staff_order){
      ?>
      <tr>
        <td "><?php echo $i;?></li>
        <td ><?php echo $staff_order->food_name;?></td>
        <td ><?php echo $staff_order->count;?></td>
        <td ><?php echo $staff_order->cost;?></td>
        <?php
          $type="";
          if ($staff_order->type==1)
            $type="منوی رستوران";
          else if ($staff_order->type==2)
            $type="موجودی انبار";
          else if ($staff_order->type==3)
            $type="سفارش از بیرون";
        ?>
        <td ><?php echo $type;?></td>
        <td ><?php echo g2j($staff_order->date);?></td>
        <td ><?php echo $staff_order->time;?></td>
        <td ><?php echo $staff_order->trans_id;?></td>
      </tr>
      <?php
      $i++;
    }
  }
  ?>

  </tbody>
  </table>
</div>
</div>
</div>
</div>

</div>
<script>
  $(function(){
    $('#inside').on('click',function(){
      if (document.getElementById('inside').checked){
        $('#form1').css('display','block');
        $('#form2').css('display','none');
        $('#form3').css('display','none');
      }else{
        $('#form1').css('display','none');
      }
    });
    $('#outside').on('click',function(){
      if (document.getElementById('outside').checked){
        $('#form2').css('display','block');
        $('#form1').css('display','none');
        $('#form3').css('display','none');
      }else{
        $('#form2').css('display','none');
      }
    });
    $('#store').on('click',function(){
      if (document.getElementById('store').checked){
        $('#form3').css('display','block');
        $('#form2').css('display','none');
        $('#form1').css('display','none');
      }else{
        $('#form3').css('display','none');
      }
    });
    $('#submit1').on('click',function(){
      ajaxyFormData('form1','<?php echo url()?>/admin/staff-order-1',false);
      cleanForm('form1');
    });
    $('#submit2').on('click',function(){
      ajaxyFormData('form2','<?php echo url()?>/admin/staff-order-2',false);
      cleanForm('form2');
    });
    $('#submit3').on('click',function(){
      ajaxyFormData('form3','<?php echo url()?>/admin/staff-order-3',false);
      cleanForm('form3');
    });
    $('#newGroup').on('click',function(){
      $('#form3').append('<br><br><select id="'+i+'" name="group[]" style="width:140px;"><?php foreach($materials as $material){?><option value="<?php echo $material->name?>"><?php echo $material->name?></option><?php }?></select><input type="text" id="count[]" name="count[]" style="width: 200px;padding:4px;margin-right:50px;">');
    });
  });
</script>