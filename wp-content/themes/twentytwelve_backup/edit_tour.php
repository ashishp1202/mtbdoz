<?php 
/*Template Name: Edit tour*/

if(empty($_SESSION['rideTourUserData'])){
	wp_safe_redirect( site_url('login') );
	
}
require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$tourId = $_REQUEST['id'];
$_SESSION['setUserTourId']  = $tourId;
$tourdetail = $tourObj->getTourById($tourId);
$tourdetail = $tourdetail->data;
//echo "<pre>"; print_r($tourdetail); exit();
get_header();
$detect = new Mobile_Detect;
?>
<div id="primary" class="site-content sign_bg">
<div id="content" role="main">
<?php
if(isset( $_SESSION['tourEditMessage'])){
	$tourMessage = $_SESSION['tourEditMessage'];
	unset($_SESSION['tourEditMessage']);
}
if($tourMessage){ ?>
<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">X</a><strong></strong> <?php echo $tourMessage; ?></div>
<?php 
		
} ?>
<?php
if(isset( $_SESSION['tourDefaultImageMessage'])){
	$defaultImageMsg = $_SESSION['tourDefaultImageMessage'];
	unset($_SESSION['tourDefaultImageMessage']);
}
if($defaultImageMsg){ ?>
<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">X</a><strong></strong> <?php echo $defaultImageMsg; ?></div>
<?php 
		
} ?>


<script src="<?php echo get_template_directory_uri(); ?>/js/filestyle.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/mediaelement.js"></script>
<link  href="<?php echo get_template_directory_uri(); ?>/css/mediaelement.css" rel="Stylesheet" />
 <div class="col-sm-1" style="background: rgb(233, 233, 233) none repeat scroll 0% 0%; height: 700px; padding: 0 0 0 15px">
	<ul class="left-ul provider-left-menu" style="list-style: outside none none; padding: 0px;">                    
		<li style="border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url();?>/operator-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
		<li style="border-left: 6px solid rgb(255, 117, 117);  background: rgb(255, 117, 117) none repeat scroll 0% 0%;"><a href="<?php echo site_url();?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
		<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url(); ?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
		<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
	</ul>
</div>
<div class="col-lg-8">
<div class="container" style="padding:0;">
<div class=""><h2>Edit TOUR: <?php echo $tourdetail->tour->name; ?></h2></div>
<ul class="nav container nav-tabs">
  <li class="active"><a data-toggle="tab" href="#tourDetails">Tour Detail</a></li>
  <li><a data-toggle="tab" href="#tourImages">Tour Images</a></li>
  <li><a data-toggle="tab" id="showvideos" href="#tourVideos">Tour Videos</a></li>
</ul>
</div>
<form method="post" enctype="multipart/form-data" action="<?php site_url(); ?>?option=1&task=editTour">
<div class="tab-content container">

<div id="tourDetails" class="tab-pane fade in active">

<section id="contact-page" class="container" style="padding: 0px;">
        <div class="row">
			<div style="border: 1px solid rgb(204, 204, 204); float: left;border-top:0;">
            <div class="col-sm-6">
				<div class="col-sm-12">
					
									
						<div class="row">

							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;  padding: 20px;">
							<div class="col-lg-12" style="float:left;padding:0;">
								<div class="form-group" style="float: left; width: 49%;">
									<label>Tour Name</label>
									<input type="hidden" name="tourname" value="<?php echo $tourdetail->tour->name; ?>"  class="form-control" required="required">
									<input type="text"  value="<?php echo $tourdetail->tour->endPoint; ?>" name="end_point" class="form-control" required="required">

								</div>
								<div class="form-group" style="float: right; width: 49%;">
								<label>Tour Type</label>
								<?php $custom_tourType = array();
								foreach($tourdetail->tour->tourTypes as $tours_type){
									array_push($custom_tourType,$tours_type->name);
								}
								//echo "<pre>"; print_r($custom_tourType); exit();?>
									<!--<select name="tour_type[]" multiple class="select-class">
									  <option value="" disabled>Tour Type</option>
									  <option <?php echo ( in_array('CROSS_COUNTRY',$custom_tourType)) ? 'selected="selected"' : '' ?> value="CROSS_COUNTRY">Cross Country</option>
									  <option <?php echo (in_array('ALL_MOUNTAIN',$custom_tourType)) ? 'selected="selected"' : '' ?>value="ALL_MOUNTAIN">All Mountain</option>
									  <option <?php echo (in_array('DOWNHILL',$custom_tourType)) ? 'selected="selected"' : '' ?>value="DOWNHILL">Downhill</option>
									</select>-->
									<?php //echo "<pre>";print_r($custom_tourType);exit();?>
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
									<input name="city" value="<?php echo $tourdetail->tour->city; ?>" type="text" class="form-control" required="required" >
								</div>
								<div class="form-group" style="float: right; width: 49%;">
								<label>Tour State</label>
									<input type="text" value="<?php echo $tourdetail->tour->state; ?>" name="state" class="form-control" >
								</div>
								
								<div class="form-group" style="float: left; width: 49%;">
								<label>Tour Country</label>
									<input type="text" value="<?php echo $tourdetail->tour->country; ?>" name="country" class="form-control" required="required" >
								</div>
								<div class="form-group" style="float: right; width: 49%;">
								<label>Currency</label>
									<select name="currency" required="required" class="select-class">
									  <option value="">Currency</option>
									  <option <?php echo ($tourdetail->tour->currency == 'USD') ? 'selected="selected"' : '' ?> value="USD">USD</option>
									  <option <?php echo ($tourdetail->tour->currency == 'EUR') ? 'selected="selected"' : '' ?> value="EUR">EUR</option>
									  <option <?php echo ($tourdetail->tour->currency == 'GBP') ? 'selected="selected"' : '' ?> value="GBP">GBP</option>
									</select>
								</div>
								<div class="form-group" style="display:none;float: right; width: 49%;">
								<label>Price</label>
									<input type="hidden" value="<?php echo $tourdetail->tour->price; ?>" name="price" class="form-control" required="required" >
								</div>
								
								<div class="form-group" style="clear:both;">
								<label>Short description[140 characters]</label>
									<input type="text"  value="<?php echo $tourdetail->tour->title; ?>" name="description" class="form-control" required="required" >
								</div>




							</div>
						</div>
					<script>


						</script>
				</div>
            </div><!--/.col-sm-8-->
            <div class="col-sm-6">
				<div class="col-sm-12" style="">
					
						<div class="row">
							<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%;  padding: 20px;">
							<div class="form-group" style="display:none;float: left; width: 49%;">
							<label>Min partic.</label>
									<input type="hidden"  value="<?php echo $tourdetail->tour->participantsMin; ?>" name="min_participates"class="form-control" required="required" >
								</div>
								<div class="form-group" style="display:none;float: right; width: 49%;">
								<label>Max partic.</label>
									<input type="hidden"  value="<?php echo $tourdetail->tour->participantsMax; ?>" name="max_participates" class="form-control" required="required" >
								</div>
								
								<div class="form-group" style="display:none;float: left; width: 49%;">
								<label>Length Type</label>
									<select name="length_type" required="required" class="select-class">
									  <option value="">Length Type</option>
									  <option <?php echo ($tourdetail->tour->lengthType == 'KM') ? 'selected="selected"' : '' ?> value="KM">KM</option>
									  <option <?php echo ($tourdetail->tour->lengthType == 'MILES') ? 'selected="selected"' : '' ?> value="MILES">MILES</option>								 
									</select>
								</div>
								<div class="form-group" style="display:none;float: right; width: 49%;">
								<label>Length Value</label>
									<input type="hidden"  value="<?php echo $tourdetail->tour->lengthValue; ?>" name="length_value" class="form-control" required="required" >
								</div>
								
								
								
								<div class="form-group" style="display:none;float: left; width: 49%;">
								<label>Min Age</label>
									<input type="hidden"  value="<?php echo $tourdetail->tour->minAge; ?>" name="minage" class="form-control" required="required">
								</div>
								<div class="form-group" style="float: right; width: 49%;">
									<label>Difficulty level</label>
									<select name="level" required="required" class="select-class">
									  <option value="">Difficulty level</option>
									  <option <?php echo ($tourdetail->tour->difficultyLevel == 'EASY') ? 'selected="selected"' : '' ?> value="EASY">EASY</option>
									  <option <?php echo ($tourdetail->tour->difficultyLevel == 'MEDIUM') ? 'selected="selected"' : '' ?> value="MEDIUM">MEDIUM</option>							 
									  <option <?php echo ($tourdetail->tour->difficultyLevel == 'DIFFICULT') ? 'selected="selected"' : '' ?> value="DIFFICULT">DIFFICULT</option>								 
									</select>
								</div>
								
								<div class="form-group" style="float: left; width: 49%;">
								<label>Hired Bikes</label>
								<?php $custom_hiredBikes = array();$custom_hiredBikes[] = $tourdetail->tour->hiredBikes;?>
									<select name="hired_bikes" required="required" class="select-class">
									  <option value="" disabled>Hired Bikes</option>
									  <option <?php echo (in_array('ANY',$custom_hiredBikes)) ? 'selected="selected"' : '' ?> value="ANY">Any</option>
									  <option <?php echo (in_array('HIRED',$custom_hiredBikes)) ? 'selected="selected"' : '' ?> value="HIRED">Hired</option>				 
									  <option <?php echo (in_array('OWN',$custom_hiredBikes)) ? 'selected="selected"' : '' ?> value="OWN">Own</option>			 
									</select>
								</div>

								<div class="form-group" style="clear:both;">
								<label>Starting point</label>
									<input type="text"  value="<?php echo $tourdetail->tour->startPoint; ?>" name="start_point" class="form-control" required="required" >
								</div>


								<div class="form-group">
								<label>Meal Plan</label>
									<input type="text"  value="<?php echo $tourdetail->tour->mealPlan; ?>" name="meal_plan" class="form-control" required="required" >
								</div>
								
								
								<div class="form-group">
								<label>Days Duration</label>
									<input type="text"  value="<?php echo $tourdetail->tour->days; ?>" name="days" class="form-control" required="required" >
								</div>
								<div class="form-group">
								<label>Guided</label>
									<select name="guided[]" multiple required="required" class="select-class">
									  <option <?php echo ($tourdetail->tour->guidedTour == 'GUIDED' || $tourdetail->tour->guidedTour == 'GUIDED_AND_NOT_GUIDED') ? 'selected="selected"' : '' ?> value="GUIDED">GUIDED</option>
									  <option <?php echo ($tourdetail->tour->guidedTour == 'NOT_GUIDED' || $tourdetail->tour->guidedTour == 'GUIDED_AND_NOT_GUIDED') ? 'selected="selected"' : '' ?> value="NOT_GUIDED">NOT GUIDED</option>
									  <!--option <?php echo ($tourdetail->tour->guidedTour == 'GUIDED_AND_NOT_GUIDED') ? 'selected="selected"' : '' ?> value="GUIDED_AND_NOT_GUIDED">GUIDED AND NOT GUIDED</option-->
									</select>
								</div>
								<div class="form-group col-lg-12 text-left" style="padding:0;">
								<input type="hidden" name="tourId" value="<?php echo $tourdetail->tour->id; ?>"/>
								<input type="hidden" name="tourfullname" value="<?php echo $tourdetail->tour->name; ?>"/>


								</div>
							</div>
						</div>
					
				</div>
            </div>	
			</div>					<div class="form-group col-lg-12" style="border: 1px solid rgb(204, 204, 204); float: left; width: 100%;">
									<!--textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Long description"><?php echo $tourdetail->tour->description; ?></textarea-->
									<?php wp_editor( $tourdetail->tour->description, 'message', array('quicktags' =>false)); ?>
								</div>
								<input type="submit" class="submit-field" name="submit" value="Submit">

        </div>
    </section>

</div>
<div id="tourImages" class="tab-pane container fade">
<h3>Tour Images</h3>
<div class="col-lg-12 form-group">
<!--label style="float:left;font-size:16px;">Add Images</label-->
	<div class="col-lg-3"><input type="file" id="tourImage" name="tour_image[]" multiple /></div> <div class="col-lg-3"><input style="margin-right: 0px ! important; margin-left: 0px ! important; margin-bottom: 20px; margin-top: 4px ! important;" type="submit" class="submit-field" name="submit" value="Submit"></div>
</div>
<ul class="list-group col-lg-12">
<?php $tourObj = new tourLibrary();
	$detail = $tourObj->getTourImages($tourdetail->tour->id);

	if($detail->status == true){
	if(!empty($detail->data->images)){
		foreach($detail->data->images as $img){
			$tourImage = $img->imagePath;
			$thumbTourImage = 'null';
			$thumbTourImage = $img->thumbnailImagePath;
			if(!empty($thumbTourImage)){
				$thumbTourImage = end(explode('/', $thumbTourImage));

			}
			if($thumbTourImage != 'null'){
				$tourImage = $img->thumbnailImagePath;
			}
			
			 if($detect->isMobile()): ?>
			 <li class="list-group-item col-lg-12" style="float:left;"><div class="col-lg-4"><img style="width:140px;height:100px;" src="<?php echo $img->thumbnailImagePath; ?>" /></div><div class="col-lg-4"><input type="radio" name="defaultTourImage" class="set-default-tour-image" style="text-align: left;width: 7%;" data-tour-id="<?php echo $detail->data->tourId; ?>" data-tour-imageid="<?php echo $img->imageId; ?>" href="javascript:void(0);" <?php echo ($img->isDefaultImage==true)?'checked':'';?>>Set Tour default Image</div><div class="col-lg-4"><a class="delete-tour-image btn btn-danger btn-sm" data-tour-id="<?php echo $detail->data->tourId; ?>" data-tour-imageid="<?php echo $img->imageId; ?>" href="javascript:void(0);">Delete</a></div></li>

			 <?php else: ?>
			<li class="list-group-item col-lg-12" style="float:left;"><div class="col-lg-4"><img style="width:140px;height:100px;" src="<?php echo $tourImage; ?>" /></div><div class="col-lg-4"><input type="radio" style="text-align: left;width: 7%;" name="defaultTourImage" class="set-default-tour-image" data-tour-id="<?php echo $detail->data->tourId; ?>" data-tour-imageid="<?php echo $img->imageId; ?>" href="javascript:void(0);" <?php echo ($img->isDefaultImage==true)?'checked':'';?>>Set Tour default Image</div><div class="col-lg-4"><a class="delete-tour-image btn btn-danger btn-sm" data-tour-id="<?php echo $detail->data->tourId; ?>" data-tour-imageid="<?php echo $img->imageId; ?>" href="javascript:void(0);">Delete</a></div></li>
			<?php 
			endif;
		}
	}
	}
?>
</ul>	
</div>
<div id="tourVideos" class="tab-pane container fade">
<h3>Tour Videos</h3>
<div class="form-group col-lg-12">
<!--label style="float:left;font-size:16px;">Add Videos</label-->
	<div class="col-lg-6">
	<p style="font-size: 14px;padding: 6px;">You can upload video here by entering you tube URL </p>
	<!--input type="text" id="tourVideo" name="tour_video[]" multiple /-->
	<input type="text" id="tourVideo" name="tour_youtube_video" />
	</div>
	<div class="col-lg-3"><input style="margin-right: 0px ! important; margin-left: 0px ! important; margin-bottom: 20px; margin-top: 35px ! important;" type="submit" class="submit-field" name="submit" value="Submit"/></div>
</div>
<ul class="list-group">
<?php 
	$tourObj = new tourLibrary();
	$detail = $tourObj->getTourVideos($tourdetail->tour->id);
	if($detail->status == true){
		if(!empty($detail->data->videos)){
			$videoScript = "";
			foreach($detail->data->videos as $key => $vid){
				?>
				<li class="list-group-item col-lg-12" style="float:left;">
			
				<div class="col-lg-6">
					<a href="<?php echo $vid->videoPath; ?>" target="_blank"> View video-<?php echo $vid->videoId; ?> </a>
					<div style="width:200px;height:200px;float:right;">
					<?php if (strpos($vid->videoPath, 'youtube') > 0): ?>
					<video class="youtubevid" width="200" height="200" id="player<?php echo $key; ?>" preload="none">
						<source src="<?php echo $vid->videoPath; ?>" type="video/youtube">
					</video>
						<?php $videoScript = "var player$key = new MediaElementPlayer('#player$key');"; ?>
					<?php else: ?>
					<video width="200" height="200" style="float:right;" id="player<?php echo $key; ?>">
						<source src="<?php echo $vid->videoPath; ?>" type="video/mp4">
					</video>
					<?php endif; ?>
					</div>

				</div>
				<div class="col-lg-6">
				<a class="delete-tour-video btn btn-danger btn-sm" data-tour-id="<?php echo $detail->data->tourId; ?>" data-tour-videoid="<?php echo $vid->videoId; ?>" href="javascript:void(0);">Delete</a>
				</div>
				</li>
				<?php 
			}
		}
	}
?>
</ul>
</div>
</div> <!--tab content-->
</form>
</div>
</div>
</div>
<script>
jQuery('.delete-tour-image').click(function(){
	var tourId = jQuery(this).attr('data-tour-id');
	var imageId = jQuery(this).attr('data-tour-imageid');
	var response = confirm("Are you sure! you want to delete image");
	if (response == true) {
		window.location = '<?php echo site_url();?>?option=1&task=deleteTourImage&tourId='+tourId+'&imageId='+imageId;
	} 
	
});
/*Set default tour image*/
jQuery('.set-default-tour-image').click(function(){
	var tourId = jQuery(this).attr('data-tour-id');
	var imageId = jQuery(this).attr('data-tour-imageid');
	var response = confirm("Are you sure! you want to set this image as tour default image");
	if (response == true) {
		window.location = '<?php echo site_url();?>?option=1&task=defaultTourImage&tourId='+tourId+'&imageId='+imageId;
	} 
	
});
jQuery('.delete-tour-video').click(function(){
	var tourId = jQuery(this).attr('data-tour-id');
	var videoId = jQuery(this).attr('data-tour-videoid');
	var response = confirm("Are you sure! you want to delete video");
	if (response == true) {
		window.location = '<?php echo site_url();?>?option=1&task=deleteTourVideo&tourId='+tourId+'&videoId='+videoId;
	} 
	
});
jQuery('#tourImage').filestyle({
 input : false,
 buttonName : 'btn-primary',
 iconName : 'fa fa-upload',
 buttonText: 'Add Images'
});
/* jQuery('#tourVideo').filestyle({
 input : false,
 buttonName : 'btn-primary',
 iconName : 'fa fa-upload',
 buttonText: 'Add Videos'
}); */
jQuery(document).ready(function($) {

	// declare object for video
	<?php //echo $videoScript; ?>

});
jQuery('#showvideos').click(function(){
	setTimeout(function(){
	<?php echo $videoScript; ?>
	},300);
});
</script>
<style>
#wp-message-wrap{
	float:left;
	width:100%;
}
</style>
<?php 		
get_footer();
?>