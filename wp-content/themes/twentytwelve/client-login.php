<?php
/**
 * Template Name: Client Login
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#forgot").click(function(){
        $("#login_form").hide();
    });
    $("#forgot").click(function(){
        $("#forgot_form").show();
    });
});
</script>

<div id="primary" class="site-content sign_bg">
	<div id="content" role="main">
<?php
			
				if(isset($_POST['submit']))
				{
				 $email=$_REQUEST['email'];
				 $password=$_REQUEST['password'];
				
				require_once get_template_directory().'/inc/tourlib.php';
				$tourObj = new tourLibrary();
				$tour_login = $tourObj->clientLogin();
				//$tour_login = tour_login;
					//print_r($tour_login);
					
				$token = $tour_login->data['data']->token;
								if(!empty($token))
								{
								?>
						<div class="alert alert-success">
								<h4 style="text-align: left;">USER LOGGED IN SUCCESSFULLY </h4>
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
								
								<?php
								}
					
					
					
				}
	
			
				if(isset($_POST['forgot']))
				{
				
			    $email=$_REQUEST['email'];
				require_once get_template_directory().'/inc/tourlib.php';
				$tourObj = new tourLibrary();
				$forgot_pass = $tourObj->forgotpassword();
					//print_r($forgot_pass);
					$frgt = $forgot_pass->object;
					if($frgt == 'Success')
					{
					?>
					<div class="alert alert-success">
						<h5 style="text-align: left;">EMAIL HAS BEEN SENT SUCCESSFULLY PLEASE CHECK YOUR PASSWORD</h5>
					</div>
					<?php
					}
					else
					{?>
		<div class="alert alert-danger">
					<h5 style="text-align: left;"><?php echo $frgt ?></h5>
			</div>
					
				<?php	}
					
				}
			     ?>
		  <section id="contact-page" class="container" style="padding: 0px;">
        <div class="row">
			
            <div class="col-sm-4"></div>
            <div class="col-sm-4 text-center" id="login_form">
			<?php if($_SESSION['clientUserDataMsg']): ?>
			<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $_SESSION['clientUserDataMsg']; ?></div>
			<?php 
			unset($_SESSION['clientUserDataMsg']);
			endif; ?>
				<div class="col-sm-12">
					<h1 style="color:#fff;">LOGIN HERE</h1>
					
					<form  method="post" action="" >
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
								
								<div class="form-group">
									<input type="email" name="email" class="form-control"  placeholder="Email" required>
								
								</div>
								
								<div class="form-group">
						<input type="password" name="password" class="form-control"  placeholder="Password" required>
								</div>
								
								<div class="form-group" style="text-align:left;">
									<div id="forgot"> FORGOT PASSWORD </div>
								</div>
								<input type="submit" name="submit" value="submit" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); width: 100px; color: rgb(255, 255, 255);">
								
							</div>
						</div>
					</form>
				</div>
            </div>
			
			
				<!--forgot_form-->
			
				 <div class="col-sm-4 text-center" id="forgot_form" style="display:none";>
				

				<div class="col-sm-12">
					<h1 style="color:#fff;">Reset password</h1>
					<form  method="post" action="" >
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
							
								<div class="form-group">
									<input type="email" name="email" class="form-control"  placeholder="Email">
								
								</div>
			
								<input type="submit" name="forgot" value="submit" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); width: 100px; color: rgb(255, 255, 255);">
								
							</div>
						</div>
					</form>
				</div>
            </div>
				
			<!--forgot_form close-->
			
			
			
			<div class="col-sm-4"></div>
            
			
        </div>
    </section><!--/#contact-page-->

		</div>
		</div>
<?php get_footer(); ?> 
