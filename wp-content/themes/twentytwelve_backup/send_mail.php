<?php
/**
 * Template Name: SEND_EMAIL
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

get_header();


?>
<div id="primary" class="site-content">
	<div id="content" role="main">
<?php
require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$detail = $tourObj->book();
print_r($detail);


?>


	</div>
</div>
<?php get_footer(); ?>