<?php
/**
 * Template Name: My Account
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
$userdata = $_SESSION['rideTourUserData'];
$userdetail = $userdata->detail;
print_R($userdetails);
?>
<style>
.myaccount-label {
  font-weight: bold;
  margin-right: 2%;
}
.myaccount-list{
	margin:0 auto;
	float:none;
}
</style>
<div id="primary" class="site-content">
	<div id="content" role="main">
	<?php if(!empty($userdetail)): ?>
	<div class="container">
	
	 <ul class="list-group col-md-8 myaccount-list">
	   <li class="list-group-item"><a href="<?php echo site_url().'/create-tour'; ?>" class="btn btn-success">Create Tour</a></li>
	   <li class="list-group-item"><label class="myaccount-label">Name</label> <?php echo $userdetail->name ?></li>
	   <li class="list-group-item"><label class="myaccount-label">City</label> <?php echo $userdetail->city ?></li>
	   <li class="list-group-item"><label class="myaccount-label">State</label> <?php echo $userdetail->state ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Country</label> <?php echo $userdetail->country ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Point of Contact</label> <?php echo $userdetail->poc ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Website</label> <?php echo $userdetail->website ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Phone</label> <?php echo $userdetail->phone ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Mobile</label> <?php echo $userdetail->mobile ?></li>
	   <li class="list-group-item"><label class="myaccount-label">Email</label> <?php echo $userdetail->email ?></li>	 
	</ul>
	</div>
	<?php endif; ?>
	</div>
</div>	
<?php get_footer(); ?>