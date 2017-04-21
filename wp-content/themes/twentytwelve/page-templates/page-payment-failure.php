<?php
/**
 * Template Name: Page: Payment Fail
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php
	include get_template_directory_uri().'/inc/tourlib.php';

	if( isset($_REQUEST['t_p']) && $_REQUEST['t_p'] != '' ) {
?>
	<link rel="stylesheet" href="<?=get_template_directory_uri()?>/css/combine-files.css">
	<div id="main" class="wrapper">
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<!--search-->
				<section id="services" class="emerald banner-section position-ie" style="position: relative; padding:0px;">
					<div class="container">
						<div class="row">
							<h3 style="margin: 9px 0; color:#818C92;">BOOK YOUR RIDE</h3>
						</div>
					</div>
				</section>
	
			  	<section id="contact-page" class="container">	  
			        <div class="row" style="margin-top: 52px;">
			            <div class="col-sm-12 col-lg-9 col-md-offset-2">
							<h1>Unfortunately the booking payment was not processed successfully.</h1>

							<h3>Please verify you have provided the correct payment parameters and try again.</h3>

							<h3>Mtbdoz</h3>
			            </div>
			    </section>
			</div>
		</div>
	</div>
<?php
		unset( $_SESSION['lead_name'] );
		unset( $_SESSION['total_p'] );
		unset( $_SESSION['t_price'] );
		unset( $_SESSION['t_name'] );
		unset( $_SESSION['t_date'] );
	} else {
		wp_redirect( site_url() );
		exit();
	}
?>
<?php get_footer(); ?>