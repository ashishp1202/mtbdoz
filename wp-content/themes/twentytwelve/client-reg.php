<?php
/**
 * Template Name: Client Registration
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
					$detail = $tourObj->clientRegistration();
					$test = $detail->id;
						if(!empty($test))
						{
							$tour_login = $tourObj->clientLogin();
				//$tour_login = tour_login;
					//print_r($tour_login);
					
								$token = $tour_login->data['data']->token;
								if(!empty($token))
								{
								?>
								<div class="alert alert-success">
								<!--<h4 style="text-align: left;">USER LOGGED IN SUCCESSFULLY </h4>-->
								<!--h5 style="text-align: left;"><?php //echo $tour_login->data['data']->token; ?> </h5-->
								<script>window.location = '<?php echo site_url(); ?>'; </script>
								</div>
								<?php
								}
								else
								{ ?> 	
									<div class="alert alert-danger">
										<h5 style="text-align: left;">WRONG EMAIL PASSWORD</h5>
									</div>
									<script>window.location = '<?php echo site_url(); ?>/client-login/'; </script>
								
								<?php
								}
					?>
					
						<?php die; ?>
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
					<input type="text" name="first_name" class="form-control" required="required" placeholder="First name">
								
								</div>
								
								<div class="form-group">
					<input type="text" name="last_name" class="form-control" required="required" placeholder="Last name">
								
								</div>
								
								<div class="form-group">
					<input name="email" type="email" class="form-control" required="required" placeholder="Valid Email address">
								</div>
								
								<div class="form-group">
					<input type="password" name="password" class="form-control" required="required" placeholder="Password">
								</div>
								
								<div class="form-group">
					<input type="text" name="phone" class="form-control" placeholder="Phone number">
								</div>
								<div class="form-group">
					<input type="text" name="mobile" class="form-control" placeholder="Mobile number">
								</div>
								<div class="form-group">
					<input type="text" name="address" class="form-control" placeholder="Home address">
								</div>
								
								<div class="form-group" style="text-align:left;">
									<label>Preferred ride type</label>
									<br/>
									<input type='radio' name='CROSS_COUNTRY' value="CROSS_COUNTRY" style="width:30px;" >Cross Country
									<br/>
									<input type='radio' name='ALL_MOUNTAIN' value="ALL_MOUNTAIN" style="width:30px;" >All Mountain
									<br/>
									<input type='radio' name='DOWNHILL' value="DOWNHILL" style="width:30px;" >Downhill
									<script>
									jQuery(document).on("click", "input[name='CROSS_COUNTRY'], input[name='ALL_MOUNTAIN'], input[name='DOWNHILL']", function(){
										thisRadio = jQuery(this);
										if (thisRadio.hasClass("imChecked")) {
											thisRadio.removeClass("imChecked");
											thisRadio.prop('checked', false);
										} else { 
											thisRadio.prop('checked', true);
											thisRadio.addClass("imChecked");
										};
									})
								</script>
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
