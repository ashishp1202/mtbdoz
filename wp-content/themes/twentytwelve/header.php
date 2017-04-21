<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
session_start();
require_once get_template_directory().'/inc/mobile_detect.php';
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?> style="color:transparent;">
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php 
if($_SESSION['clientUserData']){
	$data = $_SESSION['clientUserData']->detail;
}?>
	
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	
	
	
	
	<noscript id="deferred-styles">	</noscript>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
<style>
	body {
  background-color: #fff;
}
	.currency-select{
	width:75px !important;
	color: #fff !important;
}
.currency-select .dropdown-menu{
	background: rgba(0, 0, 0, 0.9) none repeat scroll 0 0 !important;
}
.currency-select button {
  background: rgba(0, 0, 0, 0.9) none repeat scroll 0 0 !important;
  border: medium none;
  padding: 10px;
  width: 73px !important;
}
.currency-select span {
  color: #fff !important;
  border-color:#fff transparent !important;
  font-size: 14px;
}
.guidetour-select button{
	background: #222 none repeat scroll 0 0;
	padding:11px;
	border: 1px solid #777777
}
.guidetour-select .dropdown-menu, .guidetour-select .dropdown-toggle {
  background: #222 none repeat scroll 0 0 !important;
  padding: 13px;
  
}
.guidetour-select{
	margin:8px 2px;
	width:100% !important;
}
.guidetour-select span{
	color: #fff !important;
	border-color:#fff transparent !important;
	 
}
.guidetour-select.ridetour .filter-option {
float: right;
margin-left: 18px;
width: auto !important;
}

.guidetour-select .dropdown-menu.inner{
	max-height:100%;
}
.dropdown-menu.inner li{
	border-bottom: 2px solid #000;
}
.bootstrap-select .dropdown-menu.open{
	padding:0;
}

</style>

    <link href="<?php bloginfo( 'template_url' ); ?>/css/combine-files.css" rel="stylesheet">
	 <link href="<?php bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet">
	 <!--link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/jscrollpane.css"-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css">
	<?php if(!is_front_page()): ?>
	<link href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/animate.css" rel="stylesheet">
	<?php endif; ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.min.css">

	
<script>
  var loadDeferredStyles = function() {
	var addStylesNode = document.getElementById("deferred-styles");
	
	var replacement = document.createElement("div");
	replacement.innerHTML = addStylesNode.textContent;
	window.onload = function() {
		//document.getElementById('loadCustomCss').appendChild(replacement);		
		$('head').append(replacement.innerHTML)
		addStylesNode.parentElement.removeChild(addStylesNode);
	}
  };
  var raf = requestAnimationFrame || mozRequestAnimationFrame ||
	  webkitRequestAnimationFrame || msRequestAnimationFrame;
  if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
  else window.addEventListener('load', loadDeferredStyles);
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90660581-1', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_head(); ?>

</head>

<body <?php body_class();?>>
<div id="loadCustomCss"></div>
<div id="page" class="">
	 <header class="navbar  navbar-fixed-top wet-asphalt" role="banner">
        <div class="container header-block-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!--<a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/logo_new1.png" width="150" height="50" alt="logo"></a>-->
				<a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
              
                <nav id="site-navigation" class="main-navigation nav navbar-nav navbar-right" role="navigation">
					<button class="menu-toggle " id="submenu-link"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
					<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu submenu-block' ) ); ?>
				</nav><!-- #site-navigation -->	
               <?php $clientdata = empty($_SESSION['clientUserData']) ? null : $_SESSION['clientUserData']; ?>
			   <?php $userdata = empty($_SESSION['rideTourUserData']) ? null : $_SESSION['rideTourUserData']; 
			   //echo "<pre>"; print_r($_SESSION); exit();?>
				<div style="float:right; margin:9px 0;">
				<?php if(empty($clientdata->token) && empty($userdata->token)): ?>
					<a href="<?php echo site_url();  ?>/client-login"><button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); height: 40px; font-size: 13px;">LOGIN</button></a>
					<a style="margin-left:1px;" href="<?php echo site_url(); ?>/client-registration/"><button class="btn btn-danger1" type="button" style="height: 40px; font-size: 13px;">SIGN UP</button></a>
				<?php else: 
					if(!empty($clientdata->token)){?>
					<a href="<?php echo site_url().'?option=1&task=clientlogOut';  ?>"><button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">LOGOUT</button></a>
					<a><?php echo "Welcome ".$data->firstName;?></a>
					<?php }?>
					
					
					<?php endif; ?>	
					<?php if(!empty($userdata->token)){?>
					<a href="<?php echo site_url().'?option=1&task=logOut';  ?>"><button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">LOGOUT</button></a>
					<a style="margin-left:1px;" href="<?php echo site_url(); ?>/operator-info"><button class="btn btn-danger1" type="button">My Account</button></a>					
					<?php }?>
					
					<!--button class="btn btn-danger" type="button" style="background: rgba(0, 0, 0, 0.3) none repeat scroll 0% 0%; border: medium none rgb(0, 0, 0);">USD <i class="fa fa-sort-desc" aria-hidden="true"></i></button-->
					<?php 
					if(!empty($userdata->token) && empty($clientdata->token)): 
					$currencyTable = array('USD','EUR','GBP'); 
					$selectedCurrency = empty($_SESSION['currentCurrency']) ? 'USD' : $_SESSION['currentCurrency'];
					?>
					<div class="btn-group bootstrap-select currency-select block1">	
					<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" data-id="selectCurrency" title="USD"><span class="filter-option pull-left"><?php echo $selectedCurrency; ?></span>&nbsp;<span class="bs-caret"><span class="caret"></span></span></button>
					<div class="dropdown-menu open" role="combobox" style="max-height: 324.8px; overflow: hidden; min-height: 0px;">		
					<ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 322.8px; overflow-y: auto; min-height: 0px;">
							<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">USD</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
							</li>
							<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">EUR</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
							</li>
							<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">GBP</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
							</li>
						</ul>
					</div>
					<select id="selectCurrency" class="currency-select " style="background: rgba(0, 0, 0, 0.2) none repeat scroll 0% 0%; border: medium none rgb(0, 0, 0); width: auto; color: #fff; margin-bottom:0;padding-top:7px;padding-bottom:8px; margin-left:20px; height: 40px;font-size: 13px;">
					<?php foreach($currencyTable as $cur): ?>
						<option <?php echo ($cur == $selectedCurrency) ? 'selected="selected"' : ''; ?> value="<?php echo $cur; ?>"><?php echo $cur; ?></option>
					<?php endforeach; ?>						
					</select>
					</div>
					<?php endif;?>
					<script>
						/* 	$('.bootstrap-select.selectCurrency-select.block1  button').click(function(){
								$(".bootstrap-select.selectCurrency-select.block1").toggleClass('open');								
							}); */
							$(".bootstrap-select.currency-select.block1 .dropdown-menu.inner li").click(function(){
								$(".bootstrap-select.currency-select.block1 .dropdown-menu .inner").removeClass('selected');
								$(this).addClass('selected');
								var textdata = $(this).find('.text').html();	
								$('.bootstrap-select.currency-select.block1 span.filter-option').html(textdata);
								$('.bootstrap-select.currency-select.block1').removeClass('open');
								var selIndex = $(this).attr('data-original-index');	
								$('#selectCurrency option')[selIndex].selected = true;
								var currencyText = $('#selectCurrency').val();
								window.location.href = '<?php echo site_url().'?option=1&task=setcurrency&currency='; ?>'+currencyText;
							});
					</script>
					
				</div>
            </div>
        </div>
    </header><!--/header-->
<script>
jQuery('#submenu-link').click(function(){
	jQuery(this).toggleClass('toggled-on');
	jQuery(".submenu-block").toggleClass('toggled-on');
});
</script>
	<div id="main" class="wrapper">