<?php
/**
 * Template Name: ABOUT_US
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
<style>
.about-us-img{
	max-width:100%;
}
</style>
<div id="primary" class="site-content">
	<div id="content" role="main">
		  <section id="contact-page" class="container">
        <div class="row">
				<div class="conatct-text"><h2>ABOUT US</h2></div>
            <div class="col-sm-6">
				<div id="main-contact-form" class="contact-form" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;font-size:17px;line-height:23px;">
				
                <div class="status alert alert-success" style="display: none"></div>
               <p>MTBDoz is founded by bike enthusiasts that want to consolidate and aggregate the best bike rides into one user-friendly website.
				In today’s Online Travel Agents (OTAs) ecosystem, travelers have an excellent selection and review process in which to find the best accommodation or dining, but finding the best spot for a mountain biking holiday is a difficult task.
				MTBDoz, lead by Doron Zohar, a Hi-Tech professional, with extensive Travel and cycling experience, provides cyclists a website they can book the perfect vacation from.</p>
			<br>
			<p>Alongside Doron, MTBDoz hosts other entrepreneurs and Travel/Hi Tech professional with the joint goal to build an easy-to-use bike tour site that has the widest range of bike rides and tours worldwide.
 </p>
				</div>
            </div><!--/.col-sm-8-->
            <div class="col-sm-6 text-right">
				<img class="about-us-img" src="<?php bloginfo( 'template_url' ); ?>/img/add-1-new.png">
            </div><!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->

	</div>
</div>

<?php get_footer(); ?>
