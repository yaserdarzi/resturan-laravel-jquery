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
            <a class="submit jtimerange" style="position: absolute; top: 15px; z-index: 99; width: 120px;    padding: 1.5px 10px;
" href="#" id="add">افزودن</a>
            <div  style="margin-top: -40px;">
                <table id="datazagrot" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th >ردیف</th>
                        <th >نام دسته</th>
                        <th >نام رستوران</th>
                        <th >توضیحات</th>
                        <th >عکس دسته</th>
                        <th >تم دسته</th>
                        <th >مرتب سازی</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th >ردیف</th>
                        <th >نام دسته</th>
                        <th >نام رستوران</th>
                        <th >توضیحات</th>
                        <th >عکس دسته</th>
                        <th >تم دسته</th>
                        <th >مرتب سازی</th>
                        <th class="jaction">عملیات</th>
                    </tr>
                    </tfoot>
                    <tbody>
<?php
if (isset($foodcat)){
    $i=1;
    foreach($foodcat as $foodcats){
        ?>
        <tr >
            <td ><?php echo $i;?></td>
            <td ><?php echo $foodcats->title;?></td>
            <?php
            $resname="";
            foreach($subsets as $subset) {
                if($subset->id == $foodcats->parent_id)
                    $resname=$subset->title;
            }
            ?>
            <td ><?php echo $resname;?></td>
            <td ><?php echo $foodcats->desc;?></td>
            <td ><img src="<?php echo url().$foodcats->image;?>" style="width:50px;height:50px;position: absolute"></td>
            <td ><img src="<?php echo url().$foodcats->thumb;?>" style="width:50px;height:50px;position: absolute"></td>
            <td ><?php echo $foodcats->sort;?></td>
            <td>
                <a href="javascript:void(0);" title="ویرایش" onclick="editcoupon('{{$foodcats->id}}')"><i class="fa fa-pencil"></i></a>
                <a href="javascript:;" onclick="showphoto('{{$foodcats->id}}')"><i class="fa fa-files-o"></i></a>
            </td>
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

<div id="ReportDialog" style="display: none;padding:8px;"></div>
<script>
    $(function(){
        $('#add').on('click',function(){
            ajaxRequest('<?php echo url()?>/admin/add-food-cat','ReportDialog');
            setDialog('ReportDialog',600,400);
        });
    });


    function showphoto(id){
        window.open('<?php echo url()?>/admin/food-category-photo/'+id);
    }

    function editcoupon(id){
        ajaxRequest('<?php echo url()?>/admin/edt-food-cat/'+id,'ReportDialog');
        setDialog('ReportDialog',600,400);
    }
</script>