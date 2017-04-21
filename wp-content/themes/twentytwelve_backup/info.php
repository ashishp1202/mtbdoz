<?php
/**
 * Template Name: INFORMATION
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
 session_start();
 //echo "<pre>"; print_r($_SESSION['rideTourUserData']); exit();
 if(empty($_SESSION['rideTourUserData'])){
	wp_safe_redirect( site_url('login') );
	
}
get_header(); 


$data = $_SESSION['operator'];
//print_r($data);
if($_SESSION['rideTourUserData']){
	$data = $_SESSION['rideTourUserData']->detail;
}

?>
<div id="primary" class="site-content">
	<div id="content" role="main">
	<?php
	if($_SESSION['updateOptMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">X</a><strong></strong> <?php echo $_SESSION['updateOptMessage']; ?></div>
	<?php
		unset($_SESSION['updateOptMessage']);
	} ?>
		 <section id="contact-page" class="container-fluid" style="padding: 0px;">
        <div class="row">
            <div class="col-sm-1" style="background: rgb(233, 233, 233) none repeat scroll 0% 0%; height: 700px; padding: 0 0 0 15px">
				<ul class="left-ul provider-left-menu" style="list-style: outside none none; padding: 0px;">
                    
                    <li style="background: rgb(100, 163, 196) none repeat scroll 0% 0%; border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url(); ?>/operator-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
                    <li style="border-left: 6px solid rgb(255, 117, 117);"><a href="<?php echo site_url(); ?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
                    <li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
                </ul>
			</div>
            <div class="col-sm-6">
            <div class="col-sm-12">
				<h1>TOUR OPERATOR INFO</h1>
                <div class="status alert alert-success" style="display: none"></div>
				<form method="post" action="<?php site_url(); ?>?option=1&task=updateOperator">
				 <div class="row">
				 <div class="col-sm-12" style="float:left;background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
				 <div class="col-sm-6">
					     <div class="form-group">
                        Name:&nbsp <input type="text" class="form-control" required="required" placeholder="Name" name="operator[name]" value="<?php echo $data->name; ?>">
                            </div>
							<div class="form-group">
         Email:&nbsp  <input type="text" class="form-control" required="required" placeholder="Email address" name="operator[email]" value="<?php echo $data->email; ?>">
                            </div>
							<div class="form-group">
            Point of contact:&nbsp   <input type="text" class="form-control" required="required" name="operator[poc]" placeholder="Main PoC/Owner" value="<?php echo $data->poc; ?>">
					</div>
					<div class="form-group">
               Address:&nbsp   <input type="text" class="form-control"  placeholder="Street address" name="operator[address]"  value="<?php echo $data->address; ?>">
                            </div>
					<div class="form-group">
               City:&nbsp   <input type="text" class="form-control" required="required" placeholder="City" name="operator[city]"  value="<?php echo $data->city; ?>">
                            </div>
							<div class="form-group">
               State:&nbsp   <input type="text" class="form-control"  placeholder="State" name="operator[state]"  value="<?php echo $data->state; ?>">
                            </div>
							
							
							<div class="form-group">
               Country:&nbsp   <input type="text" class="form-control" required="required" placeholder="Country" name="operator[country]"  value="<?php echo $data->country; ?>">
                            </div>
							<div class="form-group">
               Zipcode:&nbsp   <input type="text" class="form-control"  placeholder="Zipcode" name="operator[zipcode]"  value="<?php echo $data->zipcode; ?>">
                            </div>
							<div class="form-group">
               Phone:&nbsp <input type="text" class="form-control" required="required" placeholder="Main phone number" name="operator[phone]"  value="<?php echo $data->phone; ?>">
                            </div>
							<div class="form-group">
                Website:&nbsp <input type="text" class="form-control" required="required" name="operator[website]"  placeholder="My website" value="<?php echo $data->website; ?>">
				</div>	
				</div>	
					<div class="col-sm-6">		
							<!--div class="form-group">
               Change Password:&nbsp <input type="text" class="form-control" name="operator[password]" required="required" placeholder="Main phone number" value="<?php echo $data->password; ?>">
                            </div-->
					<div class="form-group">
						<input type="button" class="btn btn-primary" value="Change Password" id="showPasswordFields" />
					</div>
					<div class="form-group password-fields-block" style="display:none;">
						 Old Password:&nbsp <input type="text" class="form-control custom-password-calss" name="operatoropt[oldpassword]"  placeholder="Old Password" value=""><br/>
						 New Password:&nbsp <input type="text" class="form-control custom-password-calss" name="operatoropt[newpassword]"  placeholder="New Password" value=""><br/>
						 Confirm Password:&nbsp <input type="text" class="form-control custom-password-calss" name="operatoropt[confirmpassword]" placeholder="Confirm Password" value=""><br/>
					</div>

				</div>
				 </div>
                    </div>
					<div class="form-group col-lg-12 text-center" style="float: left;">
						<button type="submit" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">SUBMIT</button>
					</div>
			</form>
				
            </div><!--/.col-sm-8-->
            </div><!--/.col-sm-8-->
            <div class="col-sm-4 text-right">
				
            </div>
			
		<!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->

	</div>
</div>
<script>
jQuery('#showPasswordFields').click(function(){
	$('.password-fields-block').toggle('slow');
	
	var attr = $('.custom-password-calss').attr('required');
	if (typeof attr !== typeof undefined && attr !== false) {
		$('.custom-password-calss').attr('required', false);
	}
	else{
		$('.custom-password-calss').attr('required', true);
	}
	
});

</script>

<?php get_footer(); ?>
