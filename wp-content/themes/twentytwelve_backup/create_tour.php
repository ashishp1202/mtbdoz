<?php
/**
 * Template Name: create_tour
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
 
if(empty($_SESSION['rideTourUserData'])){
	wp_safe_redirect( site_url('login') );
	
}
get_header();


?>
<script src="<?php echo get_template_directory_uri(); ?>/js/filestyle.js"></script>
<div id="primary" class="site-content sign_bg">
	<div id="content" role="main">
<form method="post" enctype="multipart/form-data" action="<?php site_url(); ?>?option=1&task=createTour">
<section id="contact-page" class="" style="padding: 0px;">
        <div class="row">
		   <div class="col-sm-1" style="background: rgb(233, 233, 233) none repeat scroll 0% 0%; height: 700px; padding: 0 0 0 15px">
				<ul class="left-ul provider-left-menu" style="list-style: outside none none; padding: 0px;">                    
                    <li style="border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url(); ?>/operator-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
                    <li style="border-left: 6px solid rgb(255, 117, 117);  background: rgb(255, 117, 117) none repeat scroll 0% 0%;"><a href="<?php echo site_url();?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
                    <li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url(); ?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
                </ul>
			</div>
			<div class="col-sm-10">	
            <div class="col-sm-7">
				<div class="col-sm-12">
					<h1>ADD TOUR</h1>
					<?php 
					if($_SESSION['tourMessage'] && $_SESSION['tourMessage']->status == false){
					?>
					<div class="alert alert-danger fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">x—</a><strong>Warning!</strong> <?php echo $_SESSION['tourMessage']->data; ?></div>
					<?php 
							unset($_SESSION['tourMessage']);
					} ?>
					
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
							<div class="col-lg-12" style="float:left;padding:0;">
								<div class="form-group" style="float: left; width: 49%;">
									<label>Tour Name</label>
									<input type="text" name="tourname" class="form-control" required="required">
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<!--<label>Tour Type</label>
									<select name="tour_type[]" multiple class="select-class">
									  <option value="" disabled>Tour Type</option>
									  <option value="CROSS_COUNTRY">Cross Country</option>
									  <option value="ALL_MOUNTAIN">All Mountain</option>
									  <option value="DOWNHILL">Downhill</option>
									</select>-->
									<br/>
									<input type='radio' name='CROSS_COUNTRY' value="CROSS_COUNTRY" style="width:30px;" <?php echo ( in_array('CROSS_COUNTRY',$custom_tourType)) ? 'checked ' : '' ?> <?php echo ( in_array('CROSS_COUNTRY',$custom_tourType)) ? 'class="imChecked"' : '' ?>>Cross Country
									<br/>
									<input type='radio' name='ALL_MOUNTAIN' value="ALL_MOUNTAIN" style="width:30px;" <?php echo ( in_array('ALL_MOUNTAIN',$custom_tourType)) ? 'checked ' : '' ?> <?php echo ( in_array('ALL_MOUNTAIN',$custom_tourType)) ? 'class="imChecked"' : '' ?>>All Mountain
									<br/>
									<input type='radio' name='DOWNHILL' value="DOWNHILL" style="width:30px;" <?php echo ( in_array('DOWNHILL',$custom_tourType)) ? 'checked ' : '' ?> <?php echo ( in_array('DOWNHILL',$custom_tourType)) ? 'class="imChecked"' : '' ?>>Downhill
								</div>
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
								
								<div class="form-group" style="float: left; width: 49%;">
									<label>Tour City</label>
									<input name="city" type="text" class="form-control" required="required">
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<label>Tour State</label>
									<input type="text" name="state" class="form-control">
								</div>
								
								<div class="form-group" style="float: left; width: 49%;">
									<label>Tour Country</label>
									<input type="text" name="country" class="form-control" required="required">
								</div>
								<!--div class="form-group" style="float: right; width: 49%;">
									<input type="text" name="price" class="form-control" required="required"placeholder="Tour Price">
								</div-->
								
								<div class="form-group" style="clear:both;">
									<label>Short description[140 characters]</label>
									<input type="text" name="description" class="form-control" required="required" >
								</div>
								
								<div class="form-group">
									<!--textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Long description"></textarea-->
									<?php wp_editor( "", 'message', array('quicktags' =>false)); ?>
								</div>
								
								<div class="form-group text-right">
								<!--label style="float:left;font-size:16px;">Add Image</label-->
									<input type="file" id="tourImage" name="tour_image[]" multiple />
								</div>
								<div class="form-group text-right">
								<!--label style="float:left;font-size:16px;">Add Video</label-->
									<input type="file" id="tourVideo" name="tour_video[]" multiple />
								</div>
							</div>
						</div>
						<script>
						jQuery('#tourImage').filestyle({
						 input : false,
						 buttonName : 'btn-primary',
						 iconName : 'fa fa-upload',
						 buttonText: 'Add Images'
						});    
						jQuery('#tourVideo').filestyle({
						 input : false,
						 buttonName : 'btn-primary',
						 iconName : 'fa fa-upload',
						 buttonText: 'Add Videos'
						}); 						
									 
						</script>
				</div>
            </div><!--/.col-sm-8-->
            <div class="col-sm-5">
				<div class="col-sm-12" style="margin-top: 40px;">
					
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
								<!--div class="form-group">
									<select class="select-class">
									  <option value="volvo">Board base</option>
									  <option value="saab">Saab</option>
									  <option value="opel">Opel</option>
									  <option value="audi">Audi</option>
									</select>
								</div-->
								<div class="form-group" style="float: left; width: 49%;">
									<label>Min partic.</label>
									<input type="text" name="min_participates"class="form-control" required="required">
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<label>Max partic.</label>
									<input type="text" name="max_participates" class="form-control" required="required">
								</div>
								
								<!---div class="form-group" style="float: left; width: 49%;">
									<!--input type="text" name="length_type" class="form-control" required="required" placeholder="Length Type">
									<select name="length_type" required="required" class="select-class">
									  <option value="">Length Type</option>
									  <option value="KM">KM</option>
									  <option value="MILES">MILES</option>									 
									</select>
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<input type="text" name="length_value" class="form-control" required="required" placeholder="Length Value">
								</div-->
								
								
								
								<div class="form-group" style="float: left; width: 49%;">
									<label>Min Age</label>
									<input type="text" name="minage" class="form-control" required="required">
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<label>Difficulty level</label>
									<!--input type="text" name="level" class="form-control" required="required" placeholder="Difficulty level"-->
									<select name="level"  required="required" class="select-class">
									  <option value="">Difficulty level</option>
									  <option value="EASY">Easy</option>
									  <option value="MEDIUM">Medium</option>
									  <option value="DIFFICULT">Difficult</option>
									</select>
								</div>
								
								<div class="form-group" style="float: left; width: 49%;">
									<label>Hired Bikes</label>
									<!--input type="text" name="operator_id" class="form-control" required="required" placeholder="Operator id"-->
									<select name="hired_bikes" required="required" class="select-class">
									  <option value="" disabled>Hired Bikes</option>
									  <option value="ANY">Any</option>
									  <option value="HIRED">Hired</option>				 
									  <option value="OWN">Own</option>			 
									</select>
								</div>
								<!--div class="form-group" style="float: right; width: 49%;">
									<!--input type="text" name="currency" class="form-control" required="required" placeholder="CurrencyÂ­ Enum">
									<select name="currency" required="required" class="select-class">
									  <option value="">Currency</option>
									  <option value="USD">USD</option>
									  <option value="EUR">EUR</option>				 
									  <option value="GBP">GBP</option>				 
									</select>
								</div-->
								
								
								
								<div class="form-group" style="clear:both;">
									<label>Starting point</label>
									<input type="text" name="start_point" class="form-control" required="required">
								</div>
								<div class="form-group">
									<label>Finish point</label>
									<input type="text" name="end_point" class="form-control" required="required">
								</div>
								
								<div class="form-group">
									<label>Meal Plan</label>
									<input type="text" name="meal_plan" class="form-control" required="required">
								</div>
								
								
								<div class="form-group">
									<label>Days Duration</label>
									<input type="text" name="days" class="form-control" required="required">
								</div>
								<div class="form-group">
									<!--input type="text" name="guided" class="form-control" required="required" placeholder="Guided"-->
									<select name="guided[]" multiple required="required" class="select-class">
									  <option value="GUIDED">Guided</option>
									  <option value="NOT_GUIDED">Not Guided</option>
									  <!--option value="GUIDED_AND_NOT_GUIDED">Guided and not Guided</option-->
									</select>
								</div>
								
								
								<!--div class="form-group text-right">
									<button type="submit" class="btn btn-primary btn-lg" style="background: #1e4b62; border: medium none rgb(77, 194, 255);">LOAD GPS TRACKS</button>
								</div-->
								<div class="form-group col-lg-12 text-left" style="padding:0;">
									<input type="submit" class="submit-field" name="submit" value="Submit">
							
								</div>
							</div>
						</div>
					
				</div>
            </div>
			</div>
			
			<!--/.col-sm-4-->
			
			
        </div>
</form>
</div>
</div>
<?php get_footer(); ?>