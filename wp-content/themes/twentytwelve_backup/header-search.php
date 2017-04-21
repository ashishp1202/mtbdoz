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
?>
<!DOCTYPE html>


<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


	
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Flat Theme</title>
    <link href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/main.css" rel="stylesheet">
	<link href="<?php bloginfo( 'template_url' ); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
   

<?php wp_head(); ?>
</head>

<body <?php body_class();?>>
<div id="page" class="">
	 <header class="navbar  navbar-fixed-top wet-asphalt" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/img/logo.png" alt="logo"></a>
            </div>
            <div class="collapse navbar-collapse">
              
                  <nav id="site-navigation" class="main-navigation nav navbar-nav navbar-right" role="navigation">
			<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->	
               
				<div style="float:right; margin:22px 0;">
<a href="<?php echo site_url();  ?>/login"><button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">LOGIN</button></a>
					<a href="<?php echo site_url(); ?>/sign-up"><button class="btn btn-danger1" type="button">SIGN UP</button></a>
					<button class="btn btn-danger" type="button" style="background: rgba(0, 0, 0, 0.3) none repeat scroll 0% 0%; border: medium none rgb(0, 0, 0);">USD <i class="fa fa-sort-desc" aria-hidden="true"></i></button>
				</div>
            </div>
        </div>
    </header><!--/header-->

	<div id="main" class="wrapper">