<?php
/**
 * Template Name: Logtest
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
if(isset($_POST['submit']))
{
 $email=$_REQUEST['email'];
 $password=$_REQUEST['password'];

require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$tour_login = $tourObj->login();
//$tour_login = tour_login;
	print_r($tour_login);
	die;

}


?>

<form method="post" action="">
<table>
	<tr>
		<td>Email </td> <td> <input type="email" name="email"> </td> 
	</tr>
	<tr>
		<td>Password </td> <td> <input type="password" name="password"> </td> 
	</tr>
	<tr>
		<td colspan="2"> <input type="submit" name="submit" value="submit"> </td> 
	</tr>



<tr>	</tr>
</table>
</form>
	</div>
</div>
<?php get_footer(); ?>