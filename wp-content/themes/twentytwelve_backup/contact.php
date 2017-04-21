<?php
/**
 * Template Name: CONTACT
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

get_header(); ?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		  <section id="contact-page" class="container">
        <div class="row">
				<div class="conatct-text"><h2>Contact Us</h2></div>
            <div class="col-sm-8">
				<div id="main-contact-form" class="contact-form" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
				
                <div class="status alert alert-success" style="display: none"></div>
               <?php echo do_shortcode('[contact-form-7 id="32" title="MTB FORM"]');?>
				</div>
            </div><!--/.col-sm-8-->
            <div class="col-sm-4 text-right disply-none">
				<!-- img src="<?php //bloginfo( 'template_url' ); ?>/img/add-1.png"-->
            </div><!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->

	</div>
</div>

<?php get_footer(); ?>
