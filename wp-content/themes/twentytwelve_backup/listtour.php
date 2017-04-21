<?php
/**
 * Template Name: List Tours
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
require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$tours = $tourObj->tourlist();
$tours = $tours->tours;



?>
<table class="table">
<tr><th>Id</th><th>Name</th><th>City</th><th>Country</th></tr>
<?php if(!empty($tours)): 
	foreach($tours as $tour):
	
?>
<tr><td><?php echo $tour->tour->id ?></td><td><?php echo $tour->tour->name ?></td><td><?php echo $tour->tour->city ?></td><td><?php echo $tour->tour->country ?></td></tr>
<?php endforeach;
 endif; ?>
</table>
<?php get_footer(); ?>