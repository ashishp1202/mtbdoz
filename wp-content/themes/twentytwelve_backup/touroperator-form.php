<?php
/**
 * Template Name: Update tour info
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

//get_header();


?>
<div id="primary" class="site-content sign_bg">
	<div id="content" role="main">
<form enctype="multipart/form-data"  method="post" action="<?php echo site_url().'?option=1&task=saveinformation'; ?>" >
	<input type="text" name="operator_name"/>
	<input type="submit"/>
</form>
</div>
</div>
<?php //get_footer(); ?>