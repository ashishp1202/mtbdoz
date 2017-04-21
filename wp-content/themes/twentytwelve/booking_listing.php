<?php
/**
 * Template Name: Tour Booking Info
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


$data = $_SESSION['operator'];
//print_r($data);
if($_SESSION['rideTourUserData']){
	$data = $_SESSION['rideTourUserData']->detail;
}
require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();

$userdata = $_SESSION['rideTourUserData'];
$operatorId = $userdata->detail->id;

/*get all tour listing for provider*/
$tourlist = $tourObj->getToursByOperatorId();
$tourlist = $tourlist->data->tours;
$userTours = array();
$bookingdata = array();
if(!empty($tourlist)){
	foreach($tourlist as $tour){
		if($operatorId == $tour->tour->operatorId){
			
			$booking = $tourObj->getBookingByTourId($tour->tour->id);
			if(!empty($booking->data->object))
			{
				array_push($bookingdata,$booking->data->object);
			}
			
		}
	}
}

//echo "<pre>"; print_r($bookingdata); exit();
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
                    
                    <li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url(); ?>/operator-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
                    <li style="border-left: 6px solid rgb(255, 117, 117);"><a href="<?php echo site_url(); ?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
                    <li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
					<li style="background: rgb(100, 163, 196) none repeat scroll 0% 0%; border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
					<?php $is_admin = $tourObj->checkIsAdmin();
if($is_admin == 'success'){?>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/operator-listing/">Operator Listing</a></li>
<?php }?>
                </ul>
			</div>
            
            <div class="col-sm-8">
			<?php if(!empty($bookingdata)){?>
				<table class="booking-listing">
					<tbody>
						<tr><th>Booking ID</th><th>Tour Start Date</th><th>Tour Duration</th><th>Tour Type</th><th>Lead Name</th><th>Number of paticipaints</th><th>Date Accepted</th><th>Status</th><th>Payable Amount</th><th>Currency</th><th>Special Notes</th></tr>
						<?php $i=1;
						
						
						foreach($bookingdata as $bookings){
							foreach($bookings as $booking){
								
								$tourDetail = $tourObj->tour_detail($booking->tourId);
								$tourTy = '';
								$count = count($tourDetail->tour->tourTypes);
								$j=1;
								foreach($tourDetail->tour->tourTypes as $tourType)
								{
									if($tourType->name == 'ALL_MOUNTAIN') $type = 'All Mountain';
									if($tourType->name == 'CROSS_COUNTRY') $type = 'Cross Country';
									if($tourType->name == 'DOWNHILL') $type = 'Downhill';
									$tourTy .= $type;
									if($j<$count)
									$tourTy .= ', ';
									$j++;
								}
								$class='';
								if($i%2!=0)
								{
									$class="dark";
								}
								//echo date("Y-m-d", substr("1451606400000", 0, 10));
						?>
						<tr class="<?php echo $class;?>"><td><?php echo $i;?></td><td><?php echo $booking->sapDate;?></td><td><?php echo $tourDetail->tour->days;?></td><td><?php echo $tourTy;?></td><td><?php echo $booking->leadName;?></td><td><?php echo $booking->numberOfParticipants;?></td><td><?php echo date("Y-m-d", substr($booking->bookingDate, 0, 10));?></td><td><?php echo $booking->status;?></td><td><?php echo $booking->sapCost;?></td><td><?php echo $booking->currency;?></td><td><?php echo $booking->note;?></td></tr>
							<?php $i++;}
						}?>
					</tbody>
				</table>
			<?php }
			else{
				echo "No record found";
			}?>
            </div><!--/.col-sm-8-->
            
			
		<!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->

	</div>
</div>
<script>
jQuery('#showPasswordFields').click(function(){
	$('.password-fields-block').toggle('slow');
});

</script>

<?php get_footer(); ?>
