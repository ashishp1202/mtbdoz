<?php
/**
 * Template Name: Client Dashboard
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
 session_start();
 //echo "<pre>"; print_r($_SESSION['clientUserData']); exit();
 if(empty($_SESSION['clientUserData'])){
	wp_safe_redirect( site_url('client-login') );
	
}
get_header(); 


$data = $_SESSION['user'];
//print_r($data);
if($_SESSION['clientUserData']){
	$data = $_SESSION['clientUserData']->detail;
}

?>
<div id="primary" class="site-content">
	<div id="content" role="main">
	<?php
	if($_SESSION['updateOptMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">X</a><strong></strong> <?php echo $_SESSION['updateOptMessage']; ?></div>
	<?php
		unset($_SESSION['updateOptMessage']);
	} ?>
		 <section id="contact-page" class="container-fluid" style="padding: 0px;">
        <div class="row">
            
            <div class="col-sm-12">
            <div class="col-sm-12">
				
                
            </div><!--/.col-sm-8-->
            </div><!--/.col-sm-8-->
			
		<!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->

	</div>
</div>
<?php get_footer(); ?>
