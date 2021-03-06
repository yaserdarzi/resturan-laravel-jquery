<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.4
Version: 4.0.1
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>پنل مدیریت</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<meta content="" name="description"/>
	<meta content="" name="author"/>
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="{{URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
	<link href="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/plugins/fullcalendar/fullcalendar.min.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL PLUGIN STYLES -->
	<!-- BEGIN PAGE STYLES -->
	<link href="{{URL::asset('assets/admin/pages/css/tasks-rtl.css')}}" rel="stylesheet" type="text/css"/>
	<!-- END PAGE STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="{{URL::asset('assets/global/css/components-rtl.css')}}" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/global/css/plugins-rtl.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/admin/layout/css/layout-rtl.css')}}" rel="stylesheet" type="text/css"/>
	<link href="{{URL::asset('assets/admin/layout/css/themes/darkblue-rtl.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="{{URL::asset('assets/admin/layout/css/custom-rtl.css')}}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{URL::asset('assets/css/admin/font.css')}}" type="text/css">
	<link rel="stylesheet" href="{{URL::asset('assets/date/jquery-ui-1.8.14.css')}}" type="text/css">
	<link rel="stylesheet" href="{{URL::asset('assets/js/admin/jquery.timepicker.css')}}" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/tooltip/tooltipster.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/blink.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/popup/magnific-popup.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('assets/css/admin/bootstrap-multiselect.css')}}" />
	<script src="{{URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>

<script src="{{URL::asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/layout/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}" type="text/javascript"></script>
<link href="{{URL::asset('assets/admin/layout/scrollbar/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet" type="text/css"/>

	<link href="{{URL::asset('assets/datatable/css/style.css')}}" rel="stylesheet" type="text/css"/>

	<script type="text/javascript" language="javascript"
			src="{{URL::asset('assets/datatable/js/jquery.dataTables.min.js')}}">
	</script>
	<script type="text/javascript" language="javascript"
			src="{{URL::asset('assets/datatable/js/dataTables.bootstrap.min.js')}}">
	</script>
	
	<!-- END THEME STYLES -->
	<link rel="icon" type="image/png" href="{{URL::asset('assets/images/favicon.png')}}">

	<script>
    (function($){
        $(window).load(function(){
            $(".content").mCustomScrollbar();
        });
    })(jQuery);
</script>
	<style>
		*{
			font-family:IRANSans;
		}
	</style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body  class="page-header-fixed page-quick-sidebar-over-content page-sidebar-closed-hide-logo page-container-bg-solid">
<!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">


		<!-- BEGIN TOP NAVIGATION MENU -->
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<!-- END TODO DROPDOWN -->
				<!-- BEGIN USER LOGIN DROPDOWN -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
				<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				</a>
				<!-- END RESPONSIVE MENU TOGGLER -->

				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>

				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
							<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" id="searchElement" class="form-control" placeholder="جستجو ...">

						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>




				<li class="dropdown dropdown-user" style="margin-right: 8px;">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="username"><i class="fa fa-briefcase" style="font-size: 20px;float: left;"></i>
					</span>
					</a>
					<ul class="dropdown-menu dropdown-menu-default jsup-ul jbox-shadow jtools">
						<li>
							<a href="#" onclick="popuper()">
								<i class="icon-calculator"></i>&nbsp;ماشین حساب</a>
						</li>
						<li>
							<a href="#" onclick="responder('phonebook',this)">
								<i class="icon-notebook"></i>&nbsp;دفترچه تلفن</a>
						</li>
						<li>
							<a href="#">
								<i class="fa fa-paper-plane"></i>&nbsp;پیامک فوری</a>
						</li>
						<li>
							<a href="#" onclick="mPop()">
								<i class="icon-note"></i>&nbsp;یادداشت</a>
						</li>
					</ul>
				</li>


				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-hover="dropdown" data-close-others="true">
					<span class="username"><i class="icon-drawer" style="font-size: 20px;float: left;"></i>

					<span class="jnotif-count"><?php echo count($notifications);?></span>

					</span>

					</a>
					<ul class="dropdown-menu dropdown-menu-default jsup-ul jbox-shadow mCustomScrollbar" data-mcs-theme="rounded-dots">

						<?php
						if (isset($notifications)){
							$j=0;
							foreach($notifications as $ntfc){
								echo "<li class='".$class[$j]."'>$ntfc</li>";
								$j++;
							}
						} else {
							?> <li class="jnotif">موردی وجود ندارد</li> <?php
						}

						?>


					</ul>
				</li>



				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-hover="dropdown" data-close-others="true">
					<span class="username"><i class="fa fa-usd" style="font-size: 20px;float: left;"></i>

					<span class="jnotif-count"><?php echo count($loans) + count($salaries);?></span>

					</span>

					</a>
					<ul class="dropdown-menu dropdown-menu-default jsup-ul jbox-shadow mCustomScrollbar" data-mcs-theme="rounded-dots">

						<?php
						if (isset($loans)){
							$j=0;
							foreach($loans as $loan){
								echo "<li class='".$class[$j]."'>$loan</li>";
								$j++;
							}
						} else {
							?> <li class="jnotif">موردی وجود ندارد</li> <?php
						}
						if (isset($salaries)){
							$j=0;
							foreach($salaries as $salary){
								echo "<li class='".$class[$j]."'>$salary</li>";
								$j++;
							}
						}
						?>


					</ul>
				</li>









				<li class="dropdown dropdown-user jfleft" style="margin: 0 10px;">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

					<span class="username"><i class="fa fa-user" style="font-size: 20px;float: left;"></i>



					</span>


					</a>
					<ul class="dropdown-menu dropdown-menu-default jsup-ul pull-right jtools">

						<li style="padding: 8px 14px;color: #f6f6f6;font-size: 14px;font-weight: 300;">

							<i class="icon-user"></i>&nbsp;<?php echo Session::get('admin_name')?>
						</li>

						<li>
							<a href="#" onclick="responder('admin-account-settings',this)">
								<i class="icon-settings"></i>&nbsp;تنظیمات حساب کاربری</a>
						</li>

						<li>
							<a href="<?php echo url();?>/admin/logout">
								<i class="icon-logout"></i>&nbsp;خروج از حساب کاربری</a>
						</li>

					</ul>
				</li>



				<li class="jtoday jfleft">
					امروز : <?php echo getCurrentJalaliDate()?>
				</li>



				<!-- END USER LOGIN DROPDOWN -->
				<!-- BEGIN QUICK SIDEBAR TOGGLER -->
				<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->


				<!-- END QUICK SIDEBAR TOGGLER -->
			</ul>
		</div>




		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- <div class="clearfix">
</div> -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
			<!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
			<!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
			<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
			<!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
			<!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->

			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php echo url();?>">
					<img src="{{URL::asset('assets/images/logo.png')}}" alt="logo" class="logo-default" />
				</a>
				<!-- <div class="menu-toggler sidebar-toggler hide">
                </div> -->
			</div>
			<!-- END LOGO -->

			<ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->


				<li class="start active open sao">
					<a href="<?php echo url()?>/admin/dashboard">
						<i class="icon-home"></i>
						<span class="title">داشبورد</span>
						<span class="selected"></span>
					</a>
				</li>
				<?php
				use Illuminate\Support\Facades\Session;
				$data = Session::get('access_level');
				if (isset($data['سفارشات']) || isset($data['all'])){?>
					<li class="sao">
						<a href="#" onclick="responder('neworders',this)">
							<i class="fa fa-cutlery"></i>
							<span class="title">سفارشات جدید</span>
						</a>
					</li>
					<?php
				}
				?>
				<?php
				if (isset($data['گزارش گیری']) || isset($data['all'])){
					?>
					<li class="sao">
						<a href="javascript:;">
							<i class="fa fa-line-chart"></i>
							<span class="title">گزارش گیری</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php
							if (isset($data['سفارشات'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reportOrder',this)">سفارشات</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['غذاها'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reportingFoods',this)">غذاها</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['روش های پرداخت'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-order-pay',this)">روش های پرداخت</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['روش های تحویل'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-order-delivery',this)">روش های تحویل</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['تراکنش ها'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-transactions',this)">تراکنش ها</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['هزینه ها'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-costs',this)">هزینه ها</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['حقوق'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-salary',this)">حقوق</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['درآمد جانبی'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-side-income',this)">درآمد جانبی</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['باشگاه مشتریان'])|| isset($data['all'])){
								?>
								<li class="sao">
									<a class="searchLi" href="#" onclick="responder('reporting-club-users',this)">باشگاه مشتریان</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['فیلدهای ثبت نام کاربر'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('user-field-report',this)">فیلدهای ثبت نام کاربر</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['گزارش مصرف پرسنل'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('report-personel-food',this)">گزارش مصرف پرسنل</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['انبارگردانی'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('storage-report',this)">انبارگردانی</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['وام'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('loan-report',this)">وام</a>
								</li>
								<?php
							}
							?>
								<?php
								if (isset($data['گزارش مرخصی'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('vacation-report',this)">گزارش مرخصی</a>
								</li>
								<?php
								}
								?>
						</ul>
					</li>
					<?php
				}
				?>
				<?php
				if (isset($data['حسابداری'])|| isset($data['all'])){
					?>
					<li class="sao">
						<a href="javascript:;">
							<i class="fa fa-usd"></i>
							<span class="title">حسابداری</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php
							if (isset($data['ثبت حساب'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('add-account',this)">ثبت حساب</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['تعریف نوع هزینه'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('add-cost-type',this)">تعریف نوع هزینه</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['تعریف نوع درآمد'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('add-money-type',this)">تعریف نوع درآمد</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['ثبت هزینه'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('accounting-add-cost',this)">ثبت هزینه</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['ثبت درآمد'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('accounting-add-income',this)">ثبت درآمد</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['پرداخت حقوق'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('pay-salary',this)">پرداخت حقوق</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['انتقال وجه بین حسابها'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('account-transaction',this)">انتقال وجه بین حسابها</a>
								</li>
								<?php
							}
							?>
						</ul>
					</li>
					<?php
				}
				?>
				<?php
				if (isset($data['مدیریت منابع انسانی'])|| isset($data['all'])){
					?>
					<li class="sao">
						<a href="javascript:;">
							<i class="icon-user-following"></i>
							<span class="title">مدیریت منابع انسانی</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php
							if (isset($data['لیست پرسنل'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('personelList',this)">لیست پرسنل</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['ثبت مصرف پرسنل'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('personel-food',this)">ثبت مصرف پرسنل</a>
								</li>
								<?php
							}
							?>


							<?php
							if (isset($data['مرخصی'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('new-leave',this)">مرخصی</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['تسهیلات'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('new-loan',this)">تسهیلات</a>
								</li>
								<?php
							}
							?>
						</ul>
					</li>
					<?php
				}
				?>



				<?php
				if (isset($data['انبار داری'])|| isset($data['all'])){
					?>
					<li class="sao">
						<a href="javascript:;">
							<i class="icon-drawer"></i>
							<span class="title">انبارداری</span>
							<span class="arrow "></span>
						</a>
						<ul class="sub-menu">
							<?php
							if (isset($data['انبارها'])|| isset($data['all'])){
							?>
							<li  class="sao">
								<a  class="searchLi" href="#" onclick="responder('storages',this)">انبارها</a>
							</li>
							<?php } ?>
							<?php
							if (isset($data['دسته بندی'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a  class="searchLi" href="#" onclick="responder('mat-cat',this)">دسته بندی</a>
								</li>
								<?php
							}
							?>
							<?php
							if (isset($data['ثبت مواد'])|| isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('add-mat',this)">ثبت مواد</a>
								</li>
								<?php
							}
							?>
							<?php if (isset($data['موجودی انبار']) || isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('warehouse-inventory',this)">موجودی انبار</a>
								</li>
								<?php
							}?>
							<?php
							if (isset($data['تعریف واحد']) || isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" onclick="responder('add-unit',this)">تعریف واحد</a>
								</li>
								<?php
							}
							?>
						</ul>
					</li>
					<?php
				}
				?>
				<?php
				if (isset($data['باشگاه مشتریان'])|| isset($data['all'])){
				?>
				<li class="sao">
					<a href="javascript:;">
						<i class="icon-users"></i>
						<span class="title">باشگاه مشتریان</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php
						if (isset($data['ثبت کاربر جدید']) || isset($data['all'])){
						?>
						 <li  class="sao">
							<a class="searchLi" href="#" onclick="responder('customers',this)">مشتریان
							</a>
						</li> 
						<?php } ?>
						<?php
						if (isset($data['تعریف کوپن']) || isset($data['all'])){
						?>
						<li  class="sao">
							<a class="searchLi" href="#" onclick="responder('coupon',this)">تعریف کوپن
							</a>
						</li>
						<?php } ?>
						<?php
						if (isset($data['کوپن هنگام / بعد از خرید']) || isset($data['all'])){
						?>
						<li  class="sao">
							<a class="searchLi" href="#" onclick="responder('c-coupon',this)">کوپن هنگام / بعد از خرید
							</a>
						</li>
						<?php } ?>
							<?php
							if (isset($data['فیلدهای ثبت نام کاربر']) || isset($data['all'])){
							?>
						<li  class="sao">
							<a class="searchLi" href="#" onclick="responder('register-fields',this)">
								فیلدهای ثبت نام کاربر
							</a>
						</li>
						<?php } ?>
							<?php
							if (isset($data['گزارش نظرسنجی']) || isset($data['all'])){
								?>
								<li  class="sao">
									<a class="searchLi" href="#" id="add-menu" onclick="responder('votes-report',this)">نظرسنجی</a>
								</li>
								<?php
							}
							?>

					</ul>
				</li>
				<?php } ?>

				<?php
				if (isset($data['تنظیمات'])|| isset($data['all'])){
				?>
				<li class="sao">
					<a href="javascript:;">
						<i class="fa fa-cogs"></i>
						<span class="title">تنظیمات</span>
						<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<?php
							if (isset($data['ایجاد کاربر برای پنل مدیریت'])|| isset($data['all'])){
						?>
						<li class="sao">
							<a class="searchLi" href="#" onclick="responder('new-user',this)">ایجاد کاربر برای پنل مدیریت</a>
						</li>
						<?php } ?>
						<?php
							if (isset($data['اطلاعات وبسایت'])|| isset($data['all'])){
						?>
						<li class="sao">
							<a class="searchLi" href="#" onclick="responder('website-info',this)">اطلاعات وبسایت</a>
						</li>
							<?php } ?>
							<?php
							if (isset($data['تنظیمات سفارش'])|| isset($data['all'])){
							?>
						<li class="sao">
							<a class="searchLi" href="#" onclick="responder('order-settings',this)">تنظیمات سفارش</a>
						</li>
							<?php } ?>
							<?php
							if (isset($data['تنظیمات سرویس دهی'])|| isset($data['all'])){
							?>
						<li class="sao">
							<a class="searchLi" href="#" onclick="responder('service-settings',this)">تنظیمات سرویس دهی</a>
						</li>
							<?php } ?>
							<?php
							if (isset($data['نقشه گوگل'])|| isset($data['all'])){
							?>
						<li class="sao">
							<a class="searchLi" href="#" onclick="responder('google-map',this)">نقشه گوگل</a>
						</li>
							<?php } ?>
							<?php
							if (isset($data['زیرمجموعه های رستوران'])|| isset($data['all'])){
							?>
						<li  class="sao">
							<a class="searchLi" href="#" id="add-menu" onclick="responder('subsets',this)">زیرمجموعه های رستوران</a>
						</li>
							<?php } ?>
							<?php
							if (isset($data['دسته بندی غذا'])|| isset($data['all'])){
							?>
						<li  class="sao">
							<a class="searchLi" href="#" id="add-menu" onclick="responder('food-category',this)">دسته بندی غذا</a>
						</li>
							<?php } ?>
						<?php
						if (isset($data['غذا'])|| isset($data['all'])){
							?>
							<li  class="sao">
								<a class="searchLi" href="#" id="add-menu" onclick="responder('insert-new-food',this)">غذا</a>
							</li>
							<?php
						}
						?>
						<?php
						if (isset($data['تنظیمات دسترسی']) || isset($data['all'])){
							?>
							<li  class="sao">
								<a class="searchLi" href="#" onclick="responder('access-group',this)">تنظیمات دسترسی</a>
							</li>
							<?php
						}
						?>
							<?php
						if (isset($data['تنظیمات پیام کوتاه']) || isset($data['all'])){
							?>
							<li class="sao">
								<a href="javascript:;">تنظیمات پیام کوتاه</a>
							</li>
						<?php } ?>
						<?php
						if (isset($data['بازگشت حساب']) || isset($data['all'])){
							?>
							<li class="sao">
								<a class="searchLi" href="#" onclick="responder('back-accounting',this)">بازگشت حساب</a>
							</li>
						<?php } ?>
						<?php
						if (isset($data['بازگشت نوع هزینه']) || isset($data['all'])){
							?>
							<li class="sao">
								<a class="searchLi" href="#" onclick="responder('back-cost-type',this)">بازگشت نوع هزینه</a>
							</li>
						<?php } ?>
						<?php
						if (isset($data['بازگشت نوع در آمد']) || isset($data['all'])){
							?>
							<li class="sao">
								<a class="searchLi" href="#" onclick="responder('back-money-type',this)">بازگشت نوع در آمد</a>
							</li>
						<?php } ?>
						<?php
						if (isset($data['شبکه های اجتماعی']) || isset($data['all'])){
							?>
							<li  class="sao">
								<a class="searchLi" href="#" onclick="responder('social-medias',this)">
									شبکه های اجتماعی
								</a>
							</li>
						<?php } ?>
					</ul>
					</li>
				<?php } ?>
					<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content" id="page-content">

			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
							</li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
							</li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
							</li>
							<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Theme Style </span>
						<select class="layout-style-option form-control input-sm">
							<option value="square" selected="selected">Square corners</option>
							<option value="rounded">Rounded corners</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-sm">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-sm">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Top Menu Dropdown</span>
						<select class="page-header-top-dropdown-style-option form-control input-sm">
							<option value="light" selected="selected">Light</option>
							<option value="dark">Dark</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Mode</span>
						<select class="sidebar-option form-control input-sm">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-sm">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Style </span>
						<select class="sidebar-style-option form-control input-sm">
							<option value="default" selected="selected">Default</option>
							<option value="light">Light</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-sm">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-sm">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->

			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<!-- END DASHBOARD STATS -->
			<!-- <div class="clearfix">
			</div> -->

			<div class="row jfirst-child">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">فروش هفته</span>
							</div>
						</div>
						<div class="portlet-body" style="">
							<?php
							$persianFirstWeek = date('w',strtotime(getCurrentDate()));
							if ($persianFirstWeek == 6){
								$days['شنبه'] = date('Y-m-d',strtotime('saturday this week'));
								$days['یکشنبه'] =date('Y-m-d',strtotime('sunday this week'));
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
							}else if ($persianFirstWeek == 0){
								$days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
								$days['یکشنبه'] =getCurrentDate();
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
							}else{
								$days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
								$days['یکشنبه'] = date('Y-m-d',strtotime('last sunday'));
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday this week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday this week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday this week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday this week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday this week'));
							}
							$i=0;
							foreach ($days as $day) {
								$datatable = DB::table('z_orders')->where('date', $day)->get();
								$total[$i]=0;
								$foodcount[$i]=0;
								foreach ($datatable as $totalsales)
								{
									$total[$i]+=$totalsales->total_fee;
									$foods = DB::table('z_food_orders')->where('order_id', $totalsales->id)->get();
									foreach ($foods as $food)
										$foodcount[$i] +=$food->foodcount;
								}
								$countsales[$i] = count($datatable);
								$customer = DB::table('z_users')->DISTINCT()->select('z_users.id')->leftJoin('z_orders','z_users.id','=','z_orders.user_id')->where('date', $day)->get();
								$customerzero = DB::table('z_orders')->where('date', $day)->where('user_id',0)->get();
								$countcustomer[$i]=count($customerzero)+count($customer);
								$i++;
							}
							?>
							<div id="saleschart" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
							<script>
								$(function () {

									$('#saleschart').highcharts({
										chart: {
											type: 'column',
											height: 250
										},
										title: {
											text: ' '
										},
										xAxis: {
											categories: [
												'شنبه',
												'یکشنبه',
												'دوشنبه',
												'سه شنبه',
												'چهارشنبه',
												'پنجشنبه',
												'جمعه'
											],
											crosshair: false
										},
										yAxis: [{
											min: 0,
											title: {
												text: ' '
											}
										}, {
											title: {
												text: ' '
											},
											opposite: true
										}],
										tooltip: {
											headerFormat: '<span style="font-size:10px; float: right;">{point.key}</span><table style=" direction: rtl; text-align: right;">',
											pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
											'<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
											footerFormat: '</table>',
											shared: true,
											useHTML: true
										},
										plotOptions: {
											column: {
												pointPadding: 0.2,
												borderWidth: 0
											}
										},navigation: {
											buttonOptions: {
												enabled: false
											}
										},
										series: [{
											name: 'تعداد فروش',
											data: [<?=$countsales[0]?>, <?=$countsales[1]?>, <?=$countsales[2]?>, <?=$countsales[3]?>, <?=$countsales[4]?>, <?=$countsales[5]?>, <?=$countsales[6]?>]

										}, {
											name: 'میزان فروش',
											data: [<?=$total[0]?>, <?=$total[1]?>, <?=$total[2]?>, <?=$total[3]?>, <?=$total[4]?>, <?=$total[5]?>, <?=$total[6]?>],
											yAxis:1

										}, {
											name: 'تعداد غذا',
											data: [<?=$foodcount[0]?>, <?=$foodcount[1]?>, <?=$foodcount[2]?>, <?=$foodcount[3]?>, <?=$foodcount[4]?>, <?=$foodcount[5]?>, <?=$foodcount[6]?>]

										}, {
											name: 'تعداد مشتری',
											data: [<?=$countcustomer[0]?>, <?=$countcustomer[1]?>, <?=$countcustomer[2]?>, <?=$countcustomer[3]?>, <?=$countcustomer[4]?>, <?=$countcustomer[5]?>, <?=$countcustomer[6]?>]

										}]
									});
								});
							</script>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<!-- BEGIN PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">هزینه های هفته</span>
							</div>
						</div>
						<div class="portlet-body">
							<?php
							$persianFirstWeek = date('w',strtotime(getCurrentDate()));
							if ($persianFirstWeek == 6){
								$days['شنبه'] = date('Y-m-d',strtotime('saturday this week'));
								$days['یکشنبه'] =date('Y-m-d',strtotime('sunday this week'));
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
							}else if ($persianFirstWeek == 0){
								$days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
								$days['یکشنبه'] =getCurrentDate();
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday next week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday next week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday next week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday next week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday next week'));
							}else{
								$days['شنبه'] = date('Y-m-d',strtotime('last saturday'));
								$days['یکشنبه'] = date('Y-m-d',strtotime('last sunday'));
								$days['دوشنبه'] = date('Y-m-d',strtotime('monday this week'));
								$days['سه شنبه'] = date('Y-m-d',strtotime('tuesday this week'));
								$days['چهارشنبه'] = date('Y-m-d',strtotime('wednesday this week'));
								$days['پنجشنبه'] = date('Y-m-d',strtotime('thursday this week'));
								$days['جمعه'] = date('Y-m-d',strtotime('friday this week'));
							}
							$i=0;
							foreach ($days as $day) {
								$staffsalary = DB::table('z_salary')->where('date', $day)->where('trans_id','!=','0')->get();
								$salarystaf[$i]=0;
								foreach ($staffsalary as $sallary)
									$salarystaf[$i]+=$sallary->cash;
								$costs = DB::table('z_transactions')
									->leftJoin('z_trans_sub_type','z_transactions.type','=','z_trans_sub_type.id')
									->leftJoin('z_bank_account','z_transactions.account_id','=','z_bank_account.id')
									->select('z_transactions.id','z_transactions.cash','z_transactions.desc','z_transactions.date',
										'z_transactions.time','z_trans_sub_type.title',
										'z_bank_account.name as account_name')
									->where('z_trans_sub_type.parent_id',1)->where('z_transactions.date', $day)
									->get();
								$costcount[$i]=0;
								foreach ($costs as $cost)
									$costcount[$i]+=$cost->cash;
								$stafforder = DB::table('z_staff_orders')->where('date', $day)->get();
								$staffordercount[$i]=0;
								foreach ($stafforder as $stafforders)
									$staffordercount[$i] += ($stafforders->cost * $stafforders->count);

								$mat = DB::table('z_transactions')->where('date', $day)->where('type','7')->get();
								$matcount[$i]=0;
								foreach ($mat as $mats)
									$matcount[$i] += $mats->cash;
								$i++;
							}
							?>
							<div id="costchart" style="min-width: 310px; height: 250px; margin: 0 auto"></div>
							<script>
								$(function () {

									$('#costchart').highcharts({
										chart: {
											type: 'column',
											height: 250
										},
										title: {
											text: ' '
										},
										xAxis: {
											categories: [
												'شنبه',
												'یکشنبه',
												'دوشنبه',
												'سه شنبه',
												'چهارشنبه',
												'پنجشنبه',
												'جمعه'
											],
											crosshair: false
										},
										yAxis: [{
											min: 0,
											title: {
												text: ' '
											}
										}, {
											title: {
												text: ' '
											},
											opposite: true
										}],
										tooltip: {
											headerFormat: '<span style="font-size:10px; float: right;">{point.key}</span><table style=" direction: rtl; text-align: right;">',
											pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
											'<td style="padding:0"><b>{point.y:,.0f}</b></td></tr>',
											footerFormat: '</table>',
											shared: true,
											useHTML: true
										},
										plotOptions: {
											column: {
												pointPadding: 0.2,
												borderWidth: 0
											}
										},navigation: {
											buttonOptions: {
												enabled: false
											}
										},
										series: [{
											name: 'پرداخت حقوق',
											data: [<?=$salarystaf[0]?>, <?=$salarystaf[1]?>, <?=$salarystaf[2]?>, <?=$salarystaf[3]?>, <?=$salarystaf[4]?>, <?=$salarystaf[5]?>, <?=$salarystaf[6]?>],
											yAxis:1

										}, {
											name: 'هزینه',
											data: [<?=$costcount[0]?>, <?=$costcount[1]?>, <?=$costcount[2]?>, <?=$costcount[3]?>, <?=$costcount[4]?>, <?=$costcount[5]?>, <?=$costcount[6]?>]

										}, {
											name: 'مصرف پرسنل',
											data: [<?=$staffordercount[0]?>, <?=$staffordercount[1]?>, <?=$staffordercount[2]?>, <?=$staffordercount[3]?>, <?=$staffordercount[4]?>, <?=$staffordercount[5]?>, <?=$staffordercount[6]?>]

										}, {
											name: 'مواد',
											data: [<?=$matcount[0]?>, <?=$matcount[1]?>, <?=$matcount[2]?>, <?=$matcount[3]?>, <?=$matcount[4]?>, <?=$matcount[5]?>, <?=$matcount[6]?>]

										}]
									});
								});
							</script>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
			<!-- <div class="clearfix">
			</div> -->


			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">مرخصی های اخیر</span>
							</div>
						</div>
						<div class="portlet-body">
							<table id="datazagrotdashboard" class="table table-striped table-bordered taledashboard" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th class="jaction">نام</th>
									<th class="jaction">تاریخ شروع</th>
									<th class="jaction">تاریخ پایان</th>
									<th class="jaction">ساعت شروع</th>
									<th class="jaction">ساعت پایان</th>
									<th class="jaction">وضعیت</th>
								</tr>
								</thead>
								<tbody>
							<?php
							if (isset($vacations)){
								$i=0;
								foreach($vacations as $field){
									$date = explode('-',$field->from_date);
									$jDate = gregorian_to_jalali($date[0],$date[1],$date[2],'/');
									$toDate = explode('-',$field->to_date);
									$toJdate = gregorian_to_jalali($toDate[0],$toDate[1],$toDate[2],'/');
								if (isset($staff_name[$i])){
									?>
									<tr >
										<td ><?php echo $staff_name[$i]->name?></td>
										<td ><?php echo $jDate?></td>
										<td ><?php echo $toJdate?></td>
										<td ><?php echo $field->from_time?></td>
										<td ><?php echo $field->to_time?></td>
										<td>
											<?php
											if ($condition[$i]->title=="ثبت شده")
											{
												?>
												<span class="status"  title="ثبت نشده"><i class="fa fa-info"></i></span>
												<?php
											}
											?>
											<?php
											if ($condition[$i]->title=="تایید شده")
											{
												?>
												<span class="status"  title="تایید شده" ><i class="fa fa-check"></i></span>
												<?php
											}
											?>
											<?php
											if ($condition[$i]->title=="تایید نشده")
											{
												?>

												<span class="status"  title="تایید نشده" ><i class="fa fa-times"></i></span>
												<?php
											}
											?>
										</td>
									</tr>
									<?php
							}
									$i++;
								}
							}
							?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="portlet light tasks-widget">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">مصرف پرسنل</span>
							</div>
						</div>
						<div class="portlet-body">
							<table id="datazagrotdashboard" class="table table-striped table-bordered taledashboard" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th class="jaction">ردیف</th>
									<th class="jaction">نام غذا</th>
									<th class="jaction">تعداد</th>
									<th class="jaction">تاریخ</th>
									<th class="jaction">هزینه</th>
								</tr>
								</thead>
								<tbody>
							<?php
							if (isset($staffOrders)){
								$i=1;
								$j=0;
								$title=array();
								$data=array();
								foreach($staffOrders as $order){
									?>
									<tr>
										<td ><?php echo $i;?></td>
										<?php if ($order->type == 0){
											?>
											<td><?php echo $foodNames[$j]->title;?></td>
											<?php
										}else {
											?>
											<td><?php echo $order->food_name;?></td>
											<?php
										}
										?>
										<td ><?php echo $order->count;?></td>
										<td ><?php echo $dates[$j];?></td>
										<?php if ($order->type == 0){
											?>
											<td >داخلی رستوران</td>
											<?php
										}else{
											?>
											<td ><?php echo $order->cost?></td>
											<?php
										}?>
										</td>
									</tr>
									<?php
									if (isset($foodNames[$j]->title)) {
										$title[] = $foodNames[$j]->title;
									}else{
										$title[] = $order->food_name;
									}
									$data[] =$order->count;
									$i++;
									$j++;
									if($j==5)
										break;
								}
							}
							?>
								</tbody>
								</table>
						</div>
					</div>
				</div>
			</div>


			<!-- <div class="clearfix">
			</div> -->
			<div class="row jlast-child">
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN REGIONAL STATS PORTLET-->
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">ثبت نام های اخیر</span>
							</div>
						</div>
						<div class="portlet-body">
							<table id="datazagrotdashboard" class="table table-striped table-bordered taledashboard" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th class="jaction">ردیف</th>
									<th class="jaction">نام</th>
									<th class="jaction">شماره تلف</th>
									<th class="jaction">آخرین بازدید</th>
								</tr>
								</thead>
								<tbody>
							<?php
							if (isset($clubUsers)){
								$i=1;
								foreach($clubUsers as $clUser){
									$lastVisit = explode('-',$clUser->last_visit);
									$jLastVisit = gregorian_to_jalali($lastVisit[0],$lastVisit[1],$lastVisit[2],'-');
									?>
									<tr>
										<td ><?php echo $i;?></td>
										<td ><?php echo $clUser->name;?></td>
										<td><?php echo $clUser->phone;?></td>
										<td ><?php echo $jLastVisit;?></td>
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
					<!-- END REGIONAL STATS PORTLET-->
				</div>
				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<span class="caption-subject font-green-sharp bold uppercase">کوپن های مصرف شده اخیر</span>
							</div>
						</div>
						<div class="portlet-body">
							<table id="datazagrotdashboard" class="table table-striped table-bordered taledashboard" cellspacing="0" width="100%">
								<thead>
								<tr>
									<th class="jaction">ردیف</th>
									<th class="jaction">شماره کوپن</th>
									<th class="jaction">میزان تخفیف</th>
									<th class="jaction">تاریخ انقضا</th>
									<th class="jaction">وضعیت</th>
								</tr>
								</thead>
								<tbody>
							<?php
							if (isset($lastCoopens)){
								$j=0;
								foreach($lastCoopens as $field){
									?>
									<tr>
										<td ><?php echo $j+1;?></td>
										<td><?php echo $field->coopen_id;;?></td>
										<td >
											<?php
											if ($field->type == 0){
												echo $field->discount;?> درصد<?php
											}else{
												echo $field->discount;?> تومان<?php
											}
											?>
										</td>
										<td ><?php echo $dates[$j];?></td>
										<td >
											<?php
											if ($field->enabled == 1){
												echo "فعال";
											}else{
												echo "غیر فعال";
											}
											?>
										</td>
									</tr>
									<?php
									$j++;
								}
							}
							?>
								</tbody>
								</table>
						</div>
					</div>
				</div>
				<!-- <div class="clearfix">
                </div> -->
			</div>

			<!-- END CONTENT -->
			<!-- BEGIN QUICK SIDEBAR -->
			<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
			<div class="page-quick-sidebar-wrapper">
				<div class="page-quick-sidebar">
					<div class="nav-justified">
						<ul class="nav nav-tabs nav-justified">
							<li class="active">
								<a href="#quick_sidebar_tab_1" data-toggle="tab">
									Users <span class="badge badge-danger">2</span>
								</a>
							</li>
							<li>
								<a href="#quick_sidebar_tab_2" data-toggle="tab">
									Alerts <span class="badge badge-success">7</span>
								</a>
							</li>
							<li class="dropdown">
								<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
									More<i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu pull-right" role="menu">
									<li>
										<a href="#quick_sidebar_tab_3" data-toggle="tab">
											<i class="icon-bell"></i> Alerts </a>
									</li>
									<li>
										<a href="#quick_sidebar_tab_3" data-toggle="tab">
											<i class="icon-info"></i> Notifications </a>
									</li>
									<li>
										<a href="#quick_sidebar_tab_3" data-toggle="tab">
											<i class="icon-speech"></i> Activities </a>
									</li>
									<li class="divider">
									</li>
									<li>
										<a href="#quick_sidebar_tab_3" data-toggle="tab">
											<i class="icon-settings"></i> Settings </a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END QUICK SIDEBAR -->
		</div>
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div id="noteDialog" style="display: none;padding:8px;overflow: scroll">
		<form id="noteForm">
			<label for="noteTitle">عنوان:</label>
			<input id="noteTitle" name="noteTitle" style="width:200px;padding:4px;margin:4px;"><br><br>
			<label for="noteContent">یادداشت:</label>
			<textarea name="noteContent" id="noteContent"></textarea>
		</form><br><br>
		<a href="#" onclick="submitNote()">ثبت</a>
	</div>
	<div class="page-footer">
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
		<div class="page-footer-inner">
			طراحی و توسعه توسط <a href="http://zagrot.com" target="_blank">زاگرت</a>
		</div>

	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="../../assets/global/plugins/respond.min.js"></script>
	<script src="../../assets/global/plugins/excanvas.min.js"></script>
	<![endif]-->

	<script src="{{URL::asset('assets/global/plugins/jquery-migrate.min.js')}}" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="{{URL::asset('assets/global/plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/moment.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
	<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
	<script src="{{URL::asset('assets/global/plugins/fullcalendar/fullcalendar.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/global/plugins/jquery.sparkline.min.js')}}" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="{{URL::asset('assets/global/scripts/metronic.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/layout/scripts/layout.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/layout/scripts/quick-sidebar.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/layout/scripts/demo.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/pages/scripts/index.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/admin/pages/scripts/tasks.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/js/jquery.tooltipster.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/js/admin/jquery.timepicker.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/js/jquery.ui.datepicker-cc.all.min.js')}}" type="text/javascript"></script>

	<script src="{{URL::asset('assets/chart/Chart.min.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/chart/highcharts.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/chart/highcharts-3d.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/chart/exporting.js')}}" type="text/javascript"></script>

	<script src="{{URL::asset('assets/js/html2canvas.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/js/admin/core.js?v104')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/popup/jquery.magnific-popup.min.js')}}" type="text/javascript"></script>

	<script src="{{URL::asset('assets/js/admin/bootstrap-multiselect.js')}}" type="text/javascript"></script>
	<script src="{{URL::asset('assets/js/admin/bootstrap-multiselect-collapsible-groups.js')}}" type="text/javascript"></script>


	<script>
		function responder(id,element){
			$.ajax("<?php echo url()?>/admin/ajaxCore", {
				dataType: 'json',
				data:{
					elementId:id
				},
				success: function (data) {
					if (data.content === "expired"){
						window.location.href = '<?php echo url()?>/admin/z.admin';
					}
					$('.sao').removeClass('active');
					$('.open').addClass("active open");
					//$('.start').removeClass('start active open');
					$(element).parent().addClass('active');
					$('#page-content').html(data.content);
				}
			})
		}

		function refreshner(id){
			$.ajax("<?php echo url()?>/admin/ajaxCore", {
				dataType: 'json',
				data:{
					elementId:id
				},
				success: function (data) {
					$('#page-content').html(data.content);
				}
			});
		}
	</script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<script>
		jQuery(document).ready(function() {
			Metronic.init(); // init metronic core componets
			Layout.init(); // init layout
			QuickSidebar.init(); // init quick sidebar
			Demo.init(); // init demo features
			Index.init();
			Index.initDashboardDaterange();
			Index.initCalendar(); // init index page's custom scripts
			Index.initCharts(); // init index page's custom scripts
			Index.initChat();
			Index.initMiniCharts();
			Tasks.initDashboardWidget();
		});
	</script>
	<script>
		function popuper(){
			window.open("<?php echo url()?>/admin/calc", "", "width=300, height=410");
		}
		$('#searchElement').on('keyup', function(){
			var matcher = new RegExp($(this).val(), 'gi');
			var value = $(this).val();
			if (value.length < 2){
				var mt = new RegExp($("").val(), 'gi');
				$('.sao').show().not(function(){
					return mt.test($(this).find('.title, .searchLi').text())
				}).hide();
				$('.sao').removeClass('active open');
				$('.sub-menu').removeClass('block-important');
			}else{
				$('.sao').show().not(function(){
					return matcher.test($(this).find('.title, .searchLi').text())
				}).hide();
				if ($('.sao').is(':visible')){
					$('.sao').addClass('active open');
					$('.sub-menu').addClass('block-important');
				}
			}
		});
		function mPop(){
			setDialog('noteDialog',400,400);
		}
		function submitNote(){
			ajaxyFormData('noteForm','<?php echo url()?>/admin/submit-note',true,'noteDialog');
		}
	</script>


		<img id="loading" src="{{URL::asset('assets/images/loading.gif')}}" style="display: none; position: absolute; left: 40%; top: 30%;   " >


	<!-- END JAVASCRIPTS -->
	</div>
</body>
<!-- END BODY -->
</html>
