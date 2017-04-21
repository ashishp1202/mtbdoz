<?php
/**
 * Template Name: list page icon
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
	wp_safe_redirect( site_url() );
	
}
get_header();
$detect = new Mobile_Detect;
require_once get_template_directory().'/inc/tourlib.php';
$selectedSort = $_REQUEST['sortby']; 
$tourObj = new tourLibrary();
$search = $tourObj->getToursByOperatorId();
$search = $search->data->tours;
$userdata = $_SESSION['rideTourUserData'];
$userdetail = $userdata->detail;


$locationTable = array();?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php 
	if($_SESSION['tourdeleteMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">x</a><strong></strong> <?php echo $_SESSION['tourdeleteMessage']; ?></div>
	<?php 
			unset($_SESSION['tourdeleteMessage']);
	} ?>
	
 <div class="col-sm-1" style="background: rgb(233, 233, 233) none repeat scroll 0% 0%; height: 700px; padding: 0 0 0 0">
				<ul class="left-ul provider-left-menu" style="list-style: outside none none; padding: 0px;">                    
                    <li style="border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url();?>/operator-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
                    <li style="border-left: 6px solid rgb(255, 117, 117);  background: rgb(255, 117, 117) none repeat scroll 0% 0%;"><a href="<?php echo site_url();?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
                    <li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url(); ?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
                </ul>
			</div>	
<div class="col-md-8 block-<?php echo $v++.$activeBlock; ?>">
<div class="col-lg-8"><h1>TOURS LIST</h1></div><div class="col-lg-4"><a style="float:right;" href="<?php echo site_url().'/create-tour'; ?>" class="btn btn-sm btn-success">Add Tour</a></div>
			<?php 
			$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
			if(!empty($userdata->token)):
			foreach($search as $srch): 
			if($userdetail->id == $srch->tour->operatorId):
			?>				
			<div class="col-sm-12 result img-block">
					<div class="col-sm-3" style="padding:0 10px;">
					<?php if(empty($srch->images[0])): ?>
						<img src="<?php bloginfo( 'template_url' ); ?>/img/img1.png">
					<?php else: ?>
					<?php if($detect->isMobile()): ?>
						<img style="width:140px;height:100px;" src="<?php echo $srch->thumbnails[0]; ?>">
					<?php else: ?>
						<img style="width:140px;height:100px;" src="<?php echo (empty($srch->thumbnails[0])) ? $srch->images[0] : $srch->thumbnails[0]; ?>">
					<?php endif; ?>	
					<?php endif; ?>
					</div>
					<div class="col-sm-6">
						<h4 style="margin-top: 0px;"><strong><?php echo $srch->tour->name; ?></strong></h4>
						
						<div class="col-sm-12" style="padding: 0px 6px;">
							<div class="col-sm-6" style="padding: 0px 6px;">
								<h5 style="margin-bottom: 0px;"><b>Destination</b></h5>
								<h5 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $srch->tour->endPoint ?></h5>
							</div>
							<div class="col-sm-6" style="padding: 0px 6px;">
								<h5 style="margin-bottom: 0px;"><b>Ride Type</b></h5><?php //echo "<pre>"; print_r($srch->tour->tourTypes);exit();?>
	<div style=" margin-top: 2px;">
								<?php 
								if(empty($srch->tour->tourTypes)){
									$RideType = str_replace('_',' ',strtolower($srch->tour->tourType));
									echo ucwords($RideType); 
								}
								else{
									$tourTy = '';
									$count = count($srch->tour->tourTypes);
									$j=1;
									foreach($srch->tour->tourTypes as $tourType)
									{
										if($tourType->name == 'ALL_MOUNTAIN') $type = 'All Mountain';
										if($tourType->name == 'CROSS_COUNTRY') $type = 'Cross Country';
										if($tourType->name == 'DOWNHILL') $type = 'Downhill';
										$tourTy .= $type;
										if($j<$count)
										$tourTy .= ', ';
										$j++;
									}
									echo $tourTy;
								}?></div>
							</div>
						</div>
						<div style="clear:both;"></div>
						<div class="col-sm-12" style="padding: 0px 6px;">
							<div class="col-sm-4" style="padding: 0px 6px;">
								<h5 style="margin-bottom: 0px;"><b>Date</b></h5>
								<h5 style="margin-top: 0px;"><?php echo $srch->sap[0]->time ?></h5>
							</div>
						
							<div class="col-sm-4" style="padding: 0px 6px;">
								<h5 style="margin-bottom: 0px;"><b>Duration</b></h5>
								<h5 style="margin-top: 0px;"><?php echo $srch->tour->days; ?> days</h5>
							</div>
							<div class="col-sm-4" style="padding: 0px 6px;">
								<h5 style="margin-bottom: 0px;"><b>Rating</b></h5>
								<h5 style="margin-top: 0px;">
									<?php
									$rate = $srch->tour->ratedPeople;
									$rateSum = $srch->tour->ratingSum;
									if(!empty($rate) && !empty($rateSum)){
										$rating = $rateSum/$rate;
										echo number_format($rating,2,'.','');
									}
									?>
								</h5>
							</div>
						</div>
					</div>
					<div class="col-sm-3 text-center">
				<!--h3 style="margin: 0px; color: rgb(255, 77, 77);"><?php $rideprice = (empty($srch->sap[0]->price)) ? $srch->tour->price : $srch->sap[0]->price; echo  $symbolTable[$srch->tour->currency].''.$rideprice; ?></h3>
						<h5 style="margin: 0px;">per ride</h5-->
<a class="btn btn-primary btn-sm edit-tour-info" href="<?php echo site_url();?>/edit-tour?id=<?php echo $srch->tour->id ?>">Edit RIDE</a>
<a class="btn btn-danger btn-sm delete-tour delete-tour-info" data-tour-name="<?php echo $srch->tour->name; ?>" data-tour-id="<?php echo $srch->tour->id ?>" href="javascript:void();">Delete Ride</a>
					</div>
                
				</div>
			
			
						<?php 
						endif;
						endforeach;
					endif;	
 					?>		
</div>					
		</div>
		</div>
<script>
jQuery('.delete-tour').click(function(){
	var tourid = jQuery(this).attr('data-tour-id');
	var tourname = jQuery(this).attr('data-tour-name');
	var response = confirm("Are you sure! you want to delete "+ tourname);
	if (response == true) {
		window.location = '<?php echo site_url();?>?option=1&task=deleteTour&id='+tourid;
	} 
	
});

</script>
<style>
	.edit-tour-info{
		margin-bottom: 5px;
		margin-left: -9px;
	}
	.delete-tour-info{
		margin-bottom:4px;
	}
	.img-block img{
		border-radius:3px;
	}
</style>
<?php get_footer(); ?>