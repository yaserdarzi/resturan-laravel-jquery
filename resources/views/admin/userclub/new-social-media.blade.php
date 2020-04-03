  <form id="socialForm">
    @if(isset($socialmedia) && $socialmedia!="")
    <input type="hidden" value="{{$socialmedia->id}}" name="edit">
    @endif
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="title" value="{{isset($socialmedia->title) ? $socialmedia->title : ''}}" placeholder="عنوان">
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="icon" value="{{isset($socialmedia->icon) ? $socialmedia->icon : ''}}" placeholder="آیکون">
    <input type="text" style="width:200px;padding:4px;margin:4px;" name="url" value="{{isset($socialmedia->url) ? $socialmedia->url : ''}}" placeholder="آدرس صفحه">
  </form>

<a href="#" id="Submit">ثبت</a>
<script>
  $(function(){
    $('#Submit').on('click',function(){
      $('#loading').show();
      ajaxyFormData('socialForm','<?php echo url()?>/admin/addSocialMediaAddress',true,'ReportDialog');
      setTimeout("responder('social-medias')",1500);
      setTimeout("$('#loading').hide()",1600);
    });
  });
</script>