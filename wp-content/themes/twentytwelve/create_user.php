<?php
/**
 * Template Name: create_user
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
$detail = $tourObj->createuser();
print_r($detail);
?>
		
		
		

		
<form action="<?php echo site_url(); ?>/create-user" method="post">
<table>
	<tr> <td>NAME:</td> <td><input type="text" name="user_name" > </td> </tr>
	<tr> <td>CITY:</td> <td><input type="text" name="city" > </td> </tr>
	<tr> <td>STATE:</td> <td><input type="text" name="state" > </td> </tr>
	<tr> <td>COUNTRY:</td> <td><input type="text" name="country" > </td> </tr>
	<tr> <td>POC:</td> <td><input type="text" name="poc" > </td> </tr>
	<tr> <td>WEBSITE:</td> <td><input type="text" name="website" > </td> </tr>
	<tr> <td>PHONE:</td> <td><input type="text" name="phone" > </td> </tr>
	<tr> <td>MOBILE:</td> <td><input type="text" name="mobile" > </td> </tr>
	<tr> <td>EMAIL:</td> <td><input type="text" name="user_email" > </td> </tr>
	<tr> <td>PASSWORD:</td> <td><input type="text" name="user_password" > </td> </tr>
	<tr> <td colspan="2"> <input type="submit" name="submit" value="submit"> </td> </tr>	
</table>		
	</form>
	</div>
</div>
<?php get_footer(); ?>