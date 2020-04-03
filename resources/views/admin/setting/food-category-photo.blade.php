<html>
<head>
    <title>عکس دسته بندی عذا</title>
    <meta charset="utf-8">
    <script type="text/javascript" src="{{URL::asset('assets/food/jquery.min.js')}}"></script>
    <script src="{{URL::asset('assets/popup/jquery.prettyPhoto.js')}}"></script>
    <link rel="stylesheet" href="{{URL::asset('assets/popup/prettyPhoto.css')}}">

</head>
<body>
<form method="post" action="{{url('/admin/addfoodcategoryphoto/'.$id)}}" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <input type="file" name="image">
    <input type="file" name="thumb">
    <button type="submit">ثبت</button>
</form>
@if(isset($images))
        <div style="width:200px;height:200px;display:inline-block;margin:8px;position: relative;text-align: center">
            <a href="{{url().$images->image}}" rel="prettyPhoto[gallery1]">
                <img src="{{url().$images->image}}" style="width:200px;height:200px;position: absolute">
            </a>
            <a href="{{url().$images->thumb}}" rel="prettyPhoto[gallery1]">
                <img src="{{url().$images->thumb}}" style="width:200px;height:200px;position: absolute">
            </a>
            <a href="{{url()}}/admin/deleteEve/{{$image->id}}" style="width:100%;z-index: 99;position: absolute;color:#f80;font-weight:bold;bottom: 0;margin: 5px auto;">حذف</a>
        </div>

@else
    <h3>تصویری پیدا نشد.</h3>
@endif
</body>
</html>
<script>
    $(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto({
            social_tools: false
        });
    });
</script>