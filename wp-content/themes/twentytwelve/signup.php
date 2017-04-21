<?php
/**
 * Template Name: SIGN-UP
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
session_start();
?>
<div id="primary" class="site-content sign_bg">
	<div id="content" role="main">
<?php
					if(isset($_POST['submit']))
					{
					require_once get_template_directory().'/inc/tourlib.php';
					$tourObj = new tourLibrary();
					$detail = $tourObj->createuser();
					if($detail){
						$detail= $detail->object;
					}
					$test = $detail->id;
						if(!empty($test))
						{
				         $_SESSION['operator'] = $detail; 
					?>
		<script>
			window.location='<?php echo site_url().'/operator-info/'; ?>';
		</script>
			<?php die; ?>
			<div class="alert alert-success">
				<h5 style="text-align: left;">REGISTERED SUCCESSFULLY YOUR USER ID : <?php echo $test; ?></h5>
			</div>
					<?php	
						}
						else
						{
						?>
			<div class="alert alert-danger">
				<h5 style="text-align: left;">REGISTERATION FAILED</h5>
			</div>
					<?php	
						}
					}
				?>
		  <section id="contact-page" class="container" style="padding: 0px;">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center">
				
				<div class="col-sm-12">
					<h1 style="color:#fff;">SIGN-UP HERE</h1>
					<form   method="post" action="">
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
								<div class="form-group">
					<input type="text" name="user_name" class="form-control" required="required" placeholder="Name">
								
								</div>
								
								<div class="form-group">
					<input type="text" name="city" class="form-control" required="required" placeholder="City">
								</div>
								
								<div class="form-group">
					<input type="text" name="state" class="form-control" placeholder="State">
								</div>
								
								<div class="form-group">
					<input type="text" name="country" class="form-control" required="required" placeholder="Country">
								</div>
								
								<div class="form-group">
					<input type="text" name="poc" class="form-control" required="required" placeholder="Point of contact">
								</div>
								
								<div class="form-group">
					<input type="text" name="website" class="form-control" required="required" placeholder="Website">
								</div>
								
								<div class="form-group">
					<input type="text" name="phone" class="form-control" required="required" placeholder="Phone">
								</div>
								
								<div class="form-group">
					<input type="text" name="mobile" class="form-control" required="required" placeholder="Mobile">
								</div>
								
								<div class="form-group">
					<input name="user_email" type="email" class="form-control" required="required" placeholder="Email">
								</div>
								
								<div class="form-group">
					<input type="password" name="user_password" class="form-control" required="required" placeholder="Password">
								</div>
								<input type="submit" name="submit" value="Register" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">
								
								
							</div>
						</div>
					</form>
				</div>
            </div>
			<div class="col-sm-4"></div>
            
			
        </div>
    </section><!--/#contact-page-->
		</div>
		</div>
<?php get_footer(); ?> 
