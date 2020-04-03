<html>
<head>
  <meta charset="UTF-8">
  <title>پنل مدیریت</title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/admin-panel.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/css/tooltip/tooltipster.css')}}" type="text/css">
  <link rel="stylesheet" href="{{URL::asset('assets/css/font-awesome.css')}}" type="text/css">
  <script src="{{URL::asset('assets/js/jquery.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/jquery.tooltipster.min.js')}}"></script>
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
</head>
<body>
<div class="header">
  <div class="fr">
    <a href="<?php echo url();?>" target="_blank"><img src="{{URL::asset('assets/images/logo.png')}}" class="logo"></a>
  </div>
  <div class="fl">
    <img src="{{URL::asset('assets/images/profile.png')}}" class="profile tooltip" id="profile">
  </div>
</div>
<div class="sideBar">
  <div class="cssmenu">
    <ul>
      <li><a href="#"><span>داشبورد</span></a></li>
      <li><a href="#"><span class="arrow">تنظیمات</span><span class="fa fa-arrow-circle-down fl"></span></a>
      <ul>
      <li><a href="#"><span>Home</span></a></li>
      <li><a href="#"><span>Menu</span></a></li>
      <li><a href="#"><span>Products</span></a></li>
      </ul>
      </li>
      <li><a href="#"><span>Company</span><span class="fa fa-arrow-circle-down fl"></span></a>
      <ul>
      <li><a href="#"><span>Zagrot</span></a></li>
      <li><a href="#"><span>Zagrit</span></a></li>
    </ul>
      </li>
      </ul>
  </div>

</div>
<div class="content"></div>
</body>
</html>
<script>
  $(function(){
    $('#profile').tooltipster({
      content:$('<div style="margin-bottom:8px;direction:rtl;text-align:center"><span class="fa fa-cog" style="margin-left: 8px;"></span><a href="#" style="text-decoration: none;color:#000;padding:5px;">تنظیمات</a></div><hr><div style="margin:8px 8px;direction:rtl;text-align:center"><span class="fa fa-globe" style="margin-left: 8px;"></span><a href="<?php echo url();?>" target="_blank" style="text-decoration: none;color:#000;">نمایش سایت</a></div><hr><div style="margin-top:8px;direction:rtl;text-align:center"><span class="fa fa-times" style="margin-left: 8px;"></span><a href="<?php echo url()?>/admin/logout" style="text-decoration: none;color:#000;margin-bottom:5px;padding:8px;">خروج</a></div>'),
      animation:'fade',
      contentCloning: false,
      multiple: true,
      interactive: true,
      position: 'bottom',
      trigger: 'click'
    });
    $('.cssmenu > ul > li > a').click(function() {
      var checkElement = $(this).next();
      $('.cssmenu li').removeClass('active');
      $(this).closest('li').addClass('active');

      if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
        $(this).closest('li').removeClass('active');
        checkElement.slideUp('normal');
      }
      if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
        $('.cssmenu ul ul:visible').slideUp('normal');
        checkElement.slideDown('normal');
      }

      if($(this).closest('li').find('ul').children().length == 0) {
        return true;
      } else {
        return false;
      }

    });
  });
</script>