<html>
<head>
  <title>منو و سفارش آنلاین غذا</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="{{URL::asset('assets/food/style.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/food/font.css')}}">
  <link href="{{URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
  <link rel="stylesheet" href="{{URL::asset('assets/popup/magnific-popup.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/popup/prettyPhoto.css')}}">
  <link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/tooltip/tooltipster.css')}}" />
  <link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">
  <script type="text/javascript" src="{{URL::asset('assets/food/jquery.min.js')}}"></script>
  <script src="{{URL::asset('assets/popup/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{URL::asset('assets/js/jquery.tooltipster.min.js')}}" type="text/javascript"></script>
  <script src="{{URL::asset('assets/popup/jquery.prettyPhoto.js')}}"></script>
  <script src="http://demo.phpgang.com/lazy-loading-images-jquery/jquery.devrama.lazyload.min-0.9.3.js"></script>
</head>
<?php
if (isset($site_offline) && $site_offline!=""){
  echo "<div style='margin:50px auto;'><p>متاسفانه فعلا امکان سفارش گیری آنلاین وجود ندارد. بعدا تلاش فرمائید.</p></div>";
  exit;
}
?>
<?php
$currentTime = getActuallyCurrentTime();
if ($services->end_time == "00:00:00"){
  $services->end_time = "23:59:59";
}
$startTime = explode(':',$services->start_time);
$startTime = implode('',$startTime);
$endTime = explode(':',$services->end_time);
$endTime = implode('',$endTime);
if ($currentTime < $startTime|| $currentTime >$endTime){
  $onclick = "alert('ساعات سفارش گیری بین $services->start_time و $services->end_time می باشد.')";
}else{
  $onclick = "submitOrder()";
}
?>
<body>

<div class="header jflex">
  <ul class="menu-entry">
    <?php
    if (isset($menu)){
      foreach($menu as $m){
        ?>
        <li><a href="#<?php echo str_replace(" ","-" ,$m->title);?>" class="landing"><?php echo $m->title;?></a></li>
        <?php
      }
    }
    ?>
  </ul>
</div>



<div class="content">
  <div class="fl">
  <div class="flcontainer">
    <?php
    foreach($menu as $men){
      ?>
      <div class="menucat">
	  <h2 id="<?php echo str_replace(" ","-" ,$men->title);?>" ><?php echo $men->title;?></h2>
	  <h4><?php echo $men->desc;?></h4>
	  </div>
      <?php
      foreach ($foods as $food) {
        foreach ($food as $foo) {
          if ($foo->cat_id == $men->id) {
            ?>
            <div class="menu-card jflex">
			
			
                <a class="foodimagelink" href="<?php echo url()."/uploads/food_images/".$foo->image;?>" rel="prettyPhoto[gallery1]" >
					<div class="foodimage" data-lazy-src="<?php echo url()."/uploads/food_thumb/".$foo->thumb;?>" style="background:url('<?php echo url()."/uploads/food_thumb/".$foo->thumb;?>')"></div>
                </a>
				
				<div class="foodtitle">
				<a id="<?php echo $foo->title;?>" onclick="addToList('<?php echo $foo->title;?>')">
					<div class="foodname"><?php echo $foo->title;?></div>
					<div class="fooddesc"><?php echo $foo->desc;?></div>
				</a>	
				</div>
				
				<div class="foodtime">
				<a id="<?php echo $foo->title;?>" onclick="addToList('<?php echo $foo->title;?>')">
					<i class="fa fa-clock-o"></i>
					<span><?php echo $foo->cook_time?> دقیقه</span>
				</a>	
				</div>
				<div class="foodprice">
				<a id="<?php echo $foo->title;?>" onclick="addToList('<?php echo $foo->title;?>')">
					<?php echo $foo->price?> ت
				</a>	
				</div>
				<div class="foodadtocart">
				<a class="add" id="<?php echo $foo->title;?>" onclick="addToList('<?php echo $foo->title;?>')">
					<i class="fa fa-angle-left"></i>
				</a>
				</div>
            </div>
            <?php
          }
        }
      }
      ?>
      <?php
    }
    ?>
  </div>
  </div>
  <div class="fr" id="fr">
  <div class="logodiv">
  <img src="../../public/assets/images/logo.png" alt="logo" class="logo-default">
  <div class="yourorder">سفارش شما</div>
  </div>
    
    <div id="orderList"></div>
    <div id="total">
      <div class="totalamount"><span>جمع کل :</span>
      <span id="totalPan">0</span> تومان
	  </div>
	  <div>
      <span class="button" id="submit" onclick="<?php echo $onclick?>">ثبت سفارش</span>
	  </div>
    </div>
  </div>
</div>
</body>
</html>
<script>
  $(function(){
    $.DrLazyload();
    $('.tooltip').tooltipster();
  });
</script>
<script>
  $(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({
      social_tools: false
    });
  });
</script>
<script>
  var name = "";
  var count = "";
  var price = "";
  function submitOrder(){
    var fname = document.getElementsByClassName('fname');
    var total = $('#totalPan').text();
    if (fname.length < 1){
      return;
    }
    for (var i=0;i<fname.length;i++){
      var counts = document.getElementsByClassName('count');
      var prices = document.getElementsByClassName('price');
      for (i=0;i<counts.length;i++){
        name += '|'+fname[i].innerHTML+'|';
        count += '|'+counts[i].innerHTML+'|';
      }
      for (var j=0;j<prices.length;j++){
        price += '|'+prices[j].innerHTML+'|';
      }
    }
    $.ajax('<?php echo url();?>/food/preorder',{
      dataType:'json',
      data:{
        foods:name,
        counts:count,
        prci:price,
        totalfee:total
      },
      success:function(data){
        console.log(data.redirect);
        window.location.href = data.redirect;
      }
    })
  }
</script>
<script>
  var newTotal=0;
  var orders = new Object();
  function addToList(id){
    var count='count';
    $.ajax('<?php echo url();?>/food/addlist',{
      dataType:'json',
      data:{
        food:id
      },
      success:function(data){
        if ($('#orderList #'+data.id).length){
          var newId = "count"+data.id;
          var value = $('#orderList #'+data.id+' #'+newId).text();
          var numValue = parseInt(value);
          var newValue = numValue+1;
          var total = $('#totalPan').text();
          var numTotal = parseInt(total);
          var price = parseInt(data.price);
          newTotal = price+numTotal;
          $('#totalPan').text(newTotal);
          $('#orderList #'+data.id+' #'+newId).text(newValue);
        }else{
          var newId = "count"+data.id;
          var newPrice = parseInt(data.price);
          $('#orderList').append('<div class="menuItem" id="'+data.id+'"><div class="zagrottrash" onclick="removefood('+data.id+','+newPrice+')" style="background-color: red; height: 100px; width: 100px;"></div><div class="tContainer"><span class="fname">'+data.foodname+'</span><div class="pContainer"><span class="price">'+data.price+'</span><span class="tomantext">تومان</span></div></div><div class="nContainer"><div class="dContainer"><span class="count" id="'+newId+'">'+1+'</span><span class="numbertext">عدد</span></span></div><div class="rContainer"><span class="fa fa-angle-up up" id="up" onclick="plusRefelctor('+data.id+','+newPrice+')"></span><span class="fa fa-angle-down down" id="down" onclick="minusRefelctor('+data.id+','+newPrice+')"></span></div></div></div>');
          var total = $('#totalPan').text();
          var numTotal = parseInt(total);
          if (isNaN(numTotal) || numTotal==0){
            newTotal =data.price;
          }else{
            var price = parseInt(data.price);
            newTotal = price+numTotal;
          }
          $('#totalPan').text(newTotal);
        }
      }
    })
  }
</script>
<script>
  function plusRefelctor(id,price){
    var value = $("#count"+id).text();
    var numValue=parseInt(value);
    var newValue=numValue+1;
    var total = $('#totalPan').text();
    var numTotal = parseInt(total);
    var finalPrice = numTotal+price;
    $('#totalPan').text(finalPrice);
    $("#count"+id).text(""+newValue);
  }
  function minusRefelctor(id,price){
    var value = $("#count"+id).text();
    var numValue=parseInt(value);
    var newValue=numValue-1;
    if (newValue==0){
      $('#'+id).remove();
    }
    var total = $('#totalPan').text();
    var numTotal = parseInt(total);
    var finalPrice = numTotal-price;
    $('#totalPan').text(finalPrice);
    $("#count"+id).text(""+newValue);
  }

  function removefood(id,price){
    var value = $("#count"+id).text();
    var total = $('#totalPan').text();
    var numValue=parseInt(value);
    var numTotal = parseInt(total);
    var finalPrice = numTotal-(price*numValue);
    $('#totalPan').text(finalPrice);
    $('#'+id).remove();
  }

</script>
<script>
  $(function() {
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 1000);
          return false;
        }
      }
    });
  });
</script>
<script>
    function showTooltip(id,content){
      $('#'+id).tooltipster({
        animation: 'grow',
        contentAsHTML: true,
        interactive: true,
        multiple:true,
        content: $("<span>"+content+"</span>")
      });
    }
</script>