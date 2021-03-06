
<!DOCTYPE html>
<html lang="fa-ir">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $siteInfo->site_title?></title>
  <link rel="stylesheet" href="{{URL::asset('assets/css/k2.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/modal.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/font-awesome.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/normalize.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/layout.css')}}" type="text/css" />
  <!--link rel="stylesheet" href="{{URL::asset('assets/css/joomla.css')}}" type="text/css" /-->
  <link rel="stylesheet" href="{{URL::asset('assets/css/system.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/template.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/menu.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/gk.stuff.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/style1.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/admin/menu.css')}}" type="text/css" />
  <link href="{{URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{URL::asset('assets/css/typography.style1.css')}}" type="text/css" />
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/tooltip/tooltipster.css')}}" />

  <style type="text/css">
    .childcontent .gkcol { width: 200px; }
    body,
    button,
    .button,
    input[type="submit"],
    input[type="button"],
    select,
    textarea,
    input[type="text"],
    input[type="password"],
    input[type="url"],
    input[type="email"],
    .box.border1 .header,
    .box.border2 .header,
    .box.newsletter .header,
    .one-page-layout h2,
    .one-page-layout h3,
    article header h1,
    article header h2,
    .category .itemView h2,
    .itemView h1,
    .itemComments h3,
    dl#tabs dt.tabs span h3,
    dl.tabs dt.tabs span h3,
    .pane-sliders .panel h3,
    #article-index h3,
    .contact-form .gkCols h3,
    .gk-menu .gkCols h3,
    .item-content h1,
    .item-content h2,
    .item-content h3,
    .item-content h4,
    .item-content h5,
    .item-content h6 { font-family: BYekan, segoe UI, tahoma; }

    #gkLogo,
    h1,h2,h3,h4,h5,h6,
    .one-page-layout .header,
    blockquote:before,
    blockquote p:after { font-family: BMitraBold, segoe UI, tahoma; }

    #gkHeaderMod h2,
    .big-icon,
    .newsletter .header small,
    .bigtitle .header small { font-family: BMitraBold, segoe UI, tahoma; }

    .blank { font-family: BYekan, segoe UI, tahoma; }

    @media screen and (max-width: 780px) {
      #k2Container .itemsContainer { width: 100%!important; }
      .cols-2 .column-1,
      .cols-2 .column-2,
      .cols-3 .column-1,
      .cols-3 .column-2,
      .cols-3 .column-3,
      .demo-typo-col2,
      .demo-typo-col3,
      .demo-typo-col4 {width: 100%; }
    }
    #gkContent { width: 100%; }

    #gkContentWrap { width: 100%; }

    .gkPage, #gkHeaderNav .gkPage, #gkMainbody .content, .one-page-wide-layout .item-content { max-width: 1230px; }

    .narrow-page .gkPage { max-width: 861px; }

    #menu1054 > div,
    #menu1054 > div > .childcontent-inner { width: 200px; }

    #menu263 > div,
    #menu263 > div > .childcontent-inner { width: 200px; }

    #menu1053 > div,
    #menu1053 > div > .childcontent-inner { width: 400px; }

    #menu414 > div,
    #menu414 > div > .childcontent-inner { width: 200px; }

    #menu1057 > div,
    #menu1057 > div > .childcontent-inner { width: 200px; }

    #menu443 > div,
    #menu443 > div > .childcontent-inner { width: 200px; }

    #menu1042 > div,
    #menu1042 > div > .childcontent-inner { width: 200px; }

  </style>
  <script src="{{URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/mootools-core.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/jquery-noconflict.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/jquery-migrate.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/core.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/sitemap.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/mootools-more.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/modal.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/modernizr.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/gk.scripts.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/gk.menu.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/kalendae.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/scrollreveal.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/bPopup.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript">

    jQuery(function($) {
      SqueezeBox.initialize({});
      SqueezeBox.assign($('a.modal').get(), {
        parse: 'rel'
      });
    });
    $GKMenu = { height:true, width:false, duration: 250 };
  </script>
  <link rel="stylesheet" href="{{URL::asset('assets/css/small.desktop.css')}}" media="(max-width: 1230px)" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/tablet.css')}}" media="(max-width: 1040px)" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/small.tablet.css')}}" media="(max-width: 840px)" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/mobile.css')}}" media="(max-width: 640px)" />

  <!--[if IE 9]>
  <link rel="stylesheet" href="{{URL::asset('assets/css/ie9.css')}}" type="text/css" />
  <![endif]-->

  <!--[if IE 8]>
  <link rel="stylesheet" href="{{URL::asset('assets/css/ie8.css')}}" type="text/css" />
  <![endif]-->

  <!--[if lte IE 7]>
  <link rel="stylesheet" href="{{URL::asset('assets/css/ie7.css')}}" type="text/css" />
  <![endif]-->

  <!--[if lte IE 9]>
  <script type="text/javascript" src="{{URL::asset('assets/js/ie.js')}}"></script>
  <![endif]-->

  <!--[if (gte IE 6)&(lte IE 8)]>
  <script type="text/javascript" src="{{URL::asset('assets/js/respond.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('assets/js/selectivizr.js')}}"></script>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->	 <link rel="stylesheet" href="{{URL::asset('assets/css/chosen.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}" type="text/css" />
  <link rel="stylesheet" href="{{URL::asset('assets/css/css.css')}}" type="text/css" />
  <script src="{{URL::asset('assets/js/chosen.jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/js/js.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{URL::asset('assets/food/jquery.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/jquery.tooltipster.min.js')}}" type="text/javascript"></script>

  <script type="text/javascript">

    jQuery(document).ready(function (){
      jQuery('select').chosen({"disable_search_threshold":10,"allow_single_deselect":true,"placeholder_text_multiple":"\u06af\u0632\u06cc\u0646\u0647 \u0627\u06cc \u0627\u0646\u062a\u062e\u0627\u0628 \u06a9\u0646\u06cc\u062f","placeholder_text_single":"\u06cc\u06a9 \u06af\u0632\u06cc\u0646\u0647 \u0631\u0627 \u0627\u0646\u062a\u062e\u0627\u0628 \u06a9\u0646\u06cc\u062f","no_results_text":"\u0647\u06cc\u0686 \u0646\u062a\u06cc\u062c\u0647 \u0627\u06cc \u0646\u062f\u0627\u0634\u062a"});
    });

    window.setInterval(function(){var r;try{r=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}if(r){r.open("GET","./",true);r.send(null)}},3600000);
    jQuery(document).ready(function() {
      var hid = jQuery(".hidtoken input").attr("name");
      var link = jQuery("#adminForm").attr("action").split("or&view");
      if(link[1]){var get = "&";}
      else {var get = "?";}
      jQuery.post(window.location+get+hid+"=1", {hits: 1});});
  </script>
</head>
<body class="frontpage top1-colorbg"  data-tablet-width="1040" data-mobile-width="640" data-zoom-size="150">

<div id="gkBg">


  <header id="gkHeader" style="background:url('<?php echo url()?>/uploads/info/<?php echo $siteInfo->header?>')">
    <div id="gkHeaderNav">
      <div class="gkPage">

        <a href="<?php echo url()?>" id="gkLogoSmall" class="cssLogo">Steak House</a>

        <div id="gkMainMenu" class="gkMenuClassic">
          <div id="gkMainMenuLeft">
            <nav class="gkMainMenu gkMenu">
              <ul class="gkmenu level0"><li  class="first active"><a href="<?php echo url()?>"  class=" first active" id="menu640" title=" Home Menu Item" >Home</a></li><li ><a href="<?php echo $_SERVER['REQUEST_URI'];?>/index.php/menu"  id="menu1028"  >Menu</a></li><li ><a href="<?php echo $_SERVER['REQUEST_URI'];?>/index.php/gallery"  id="menu1030"  >Gallery</a></li><li ><a href="<?php echo $_SERVER['REQUEST_URI']?>/index.php/reservation"  id="menu1027"  >Reservation</a></li><li ><a href="#restaurant"  id="menu663"  >About</a></li><li  class="last"><a href="<?php echo $_SERVER['REQUEST_URI']?>/index.php/yrprice"  class=" last" id="menu1069"  >YRPrice</a></li></ul>
            </nav>	                 	</div>

          <div id="gkMainMenuRight">
            <nav class="gkMainMenu gkMenu">
                <ul>
                    <?php
                      if (isset($username) && isset($user_id)){
                        ?>
                        <li style="display:inline-block"><img style="width:50px;height:50px;cursor:pointer;margin-top:10px;" src="{{URL::asset('assets/images/profile.png')}}" id="tool" onclick="showPopup('tool')" class="tool"></li>
                        <?php
                      }else{
                        ?>
                        <li><a style="color:#f80;text-decoration: none;display:inline-block" href="<?php echo url()?>/user/login">ورود</a></li>
                        <?php
                      }
                    ?>
                </ul>
            </nav>
          </div>
        </div>

        <div id="gkMobileMenu" class="gkPage">
          <i id="static-aside-menu-toggler" class="fa fa-bars"></i>
        </div>
      </div>
    </div>

    <div id="gkHeaderMod">
      <div class="gkPage">

        <a href="<?php echo url() ?>" id="gkLogo" class="cssLogo" style="background: url('<?php echo url().'/uploads/info/'. $siteInfo->logo;?>') no-repeat center center;">Steak House</a>


        <div class="custom ">
          <h1 data-scroll-reveal="enter top over .5s after 0s"><?php echo $siteInfo->site_name?></h1>
          <h2 data-scroll-reveal="enter bottom over .5s after .15s"><?php echo $siteInfo->slogan?></h2>
          <p><a class="btn" href="<?php echo url();?>/food/menu" data-scroll-reveal="enter bottom over .5s after .25s"><i class="gk-icon-dinner-set" style="font-size: 32px; line-height: 60px; float: left; margin-right: 7px;">  </i>منو و سفارش آنلاین</a> </p>
          <ul class="gk-short-menu">
            <li data-scroll-reveal="enter bottom over .5s after .25s"><a href="#menu"><i class="gk-icon-coffee-solid">  </i><br />صفحه اصلی</a></li>
            <li data-scroll-reveal="enter bottom over .5s after 1s"><a href="#restaurant"><i class="gk-icon-cutlery-solid">  </i><br /><?php echo $siteInfo->site_name?></a></li>
            <li data-scroll-reveal="enter bottom over .5s after .75s"><a href="#special"> <i class="gk-icon-gallery-solid">  </i><br /> گالری تصاویر </a></li>
            <li data-scroll-reveal="enter bottom over .5s after 1.25s"><a href="#menu"><i class="icon-user">  </i><br /><br />ثبت نام و یا ورود به سیستم</a></li>
            <li data-scroll-reveal="enter bottom over .5s after 1.25s"><a href="#gMap"><i class="gk-icon-map-path-solid">  </i><br />اطلاعات تماس</a></li>
          </ul>
        </div>

      </div>
    </div>
  </header>


  <div id="gkPageContent">


    <div>

      <div>
        <div id="gkContent">
          <div id="gkContentWrap">


            <section id="gkMainbody">
              <div id="restaurant">
                <div class="box bigtitle gk-description"><div class="box-wrap"><h3 class="header"><span><?php echo $siteInfo->site_name?></span><small>درباره <?php echo $siteInfo->site_name?></small></h3><div class="content">

                      <div class="custom bigtitle gk-description">

                        <p><?php echo $siteInfo->desc?></p>
                        <p class="gk-avatar"> مدیریت رستوران</p>
                        <p><img class="gk-description-left-img" src="<?php echo  asset('assets/images/design/about-left.jpg')?>" alt="" width="494" height="401" data-scroll-reveal="enter left over .5s" /> <img class="gk-description-right-img" src="<?php echo asset('assets/images/design/about-right.jpg');?>" alt="" width="500" height="241" data-scroll-reveal="enter right over .5s after .25s" /></p>
                      </div>
                    </div></div></div>
              </div>
            </section>

          </div>

        </div>

      </div>
    </div>
  </div>

  <section id="gkBottom1">
    <div  id="specials">
      <div class="box parallax gkmod-1" style="background-image: url('<?php echo url()?>/uploads/info/<?php echo $siteInfo->area?>');" ><div class="box-wrap"><div class="content gkPage">

            <div class="custom parallax">


            </div>
          </div></div></div>
    </div>
  </section>

  <section id="gkBottom2">
    <div  id="menu">
      <div class="box gk-menu bigtitle gkmod-1"><div class="box-wrap"><h3 class="header gkPage"><span>منو و سفارش آنلاین</span><small>تنها با چند کلیک غذا در درب منزل شماست</small></h3><div class="content gkPage">
            <br>
            <div class="notes">
              <p>در صورتی که عضو باشگاه مشتریان نیستید با چند کلیک <a href="<?php echo url();?>/user/login" target="_blank">ثبت نام کنید</a></p>
              <p><a href="<?php echo url();?>/user/forget">کد اشتراک خود را فراموش کردم</a></p><br>
                <?php
                if (isset($questions) && isset($answers)){
                  $i=0;
                  foreach($questions as $question){
                    if ($flags[$i] == 1){
                      $i++;
                      continue;
                    }
                    $i++;
                    ?>
              <div id="container<?php echo $question->id?>" style="background-color:#eee;display: inline-block;margin:6px;padding:8px;box-shadow:1px 1px 5px rgba(1,1,1,0.5);">
              <form id="form<?php echo $question->id?>">
                      <input type="hidden" name="user_id" value="<?php echo $user_id?>">
                      <input type="hidden" name="q_id" value="<?php echo $question->id?>">
                      <div>
                        <p><?php echo $question->title?></p>
                        <?php
                         foreach($answers as $answer){
                           foreach($answer as $ans){
                             if ($question->id == $ans->q_id){
                               ?>
                               <label for="<?php echo $ans->id?>"><?php echo $ans->title?></label>
                               <input type="radio" name="answer" value="<?php echo $ans->id?>" style="padding:4px;margin:4px;"><br>
                               <?php
                             }
                           }
                         }
                        ?>
                        <a href="#" onclick="sendVote('form<?php echo $question->id?>','container<?php echo $question->id?>')">ثبت نظر</a>
                      </div>
                    </form>
              </div>
                    <?php
                  }
                }
                ?>
            </div>
          </div></div></div>

    </div>
  </section>



  <section id="gkBottom5">
    <div >
      <div class="box big-icon gkmod-1"><div class="box-wrap"><div class="content gkPage">

            <div class="custom big-icon">


            </div>
          </div></div></div>
    </div>
  </section>

  <section id="gkBottom6">
    <div  id="gMap" style="width:100%;height:500px;">

    </div>
  </section>

</div>

<footer id="gkFooter">
  <div class="gkPage">
    <div id="gkFooterNav">

      <ul class="menu">
        <li class="item-1034"><a href="#" >Home</a></li><li class="item-1035"><a href="#" >Menu</a></li><li class="item-1036"><a href="#" >Gallery</a></li><li class="item-1037"><a href="#" >Reservation</a></li><li class="item-1038"><a href="#" >Location</a></li><li class="item-1039"><a href="#" >About</a></li><li class="item-1040"><a href="#" >Contact</a></li></ul>

    </div>

    <div id="gkCopyrights">&copy; 2014 GavickPro. All rights reserved</div>

    <div id="gkStyleArea">
      <a href="#" id="gkColor1">Color I</a>
      <a href="#" id="gkColor2">Color II</a>
      <a href="#" id="gkColor3">Color III</a>
      <a href="#" id="gkColor4">Color IV</a>
      <a href="#" id="gkColor5">Color V</a>
    </div>

  </div>
</footer>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
  function initialize() {
    var myCenter=new google.maps.LatLng(<?php echo $map->lat?>,<?php echo $map->lang?>);
    var mapProp = {
      center:new google.maps.LatLng(<?php echo $map->lat?>,<?php echo $map->lang?>),
      zoom:17,
      mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    var map=new google.maps.Map(document.getElementById("gMap"),mapProp);
    var marker=new google.maps.Marker({
      position:myCenter
    });
    marker.setMap(map);
    map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true});
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>

<?php
  if (isset($user_id)){?>
<script>
  function showPopup(id){
    $('.tool').tooltipster();
    var panel = "پنل کاربری";
    var logout = "خروج";
    $('#'+id).tooltipster({
      animation: 'grow',
      contentAsHTML: true,
      interactive:true,
      multiple:true,
      content: $("<div style='direction:rtl;'><a style='padding:8px;margin:8px;' target='_blank' href='<?php echo url()?>/user/profile/<?php echo $user_id;?>'>"+panel+"</a><br><br><a href='<?php echo url()?>/user/logout' style='padding:8px;margin:8px;'>"+logout+"</a></div>"),
      trigger: 'click'
    });
  }
</script>
<?php }?>
<script>
  if(window.getSize().x > 600) {
    document.getElements('.gkNspPM-GridNews figure').each(function(item, i) {
      if(item.hasClass('inverse')) {
        item.setProperty('data-scroll-reveal', 'enter right over .5s and wait '+(i * 0.25)+'s');
      } else {
        item.setProperty('data-scroll-reveal', 'enter left over .5s and wait '+(i * 0.25)+'s');
      }
    });

    window.scrollReveal = new scrollReveal();
  }
</script>
<script src="{{URL::asset('assets/js/admin/core.js')}}"></script>
<script>
  function sendVote(formId,containerId){
    ajaxyFormData(formId,'<?php echo url()?>/user/vote',false);
    //$('notes').removeChildAtIndexContainerID
    $('#'+containerId).remove();
  }
</script>
</body>
</html>