<?php
/**
 * Template Name: Calendar
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
 //echo "<pre>"; print_r($_SESSION['setUserTourId']); exit();
if(empty($_SESSION['rideTourUserData'])){
	wp_safe_redirect( site_url() );
	
}

require_once get_template_directory().'/inc/calendar.class.php'; 

require_once get_template_directory().'/inc/tourlib.php';
$currentUrl = site_url().'/schedule-tours';
$tourObj = new tourLibrary();
$userdata = $_SESSION['rideTourUserData'];
$operatorId = $userdata->detail->id;

$selMonth = null;
if(!empty($_REQUEST['y']) && !empty($_REQUEST['month']) ){
	$selMonth = $_REQUEST['y'].'-'.$_REQUEST['month'];
}

$selMonth = empty($selMonth) ? date('Y').'-'.date('m') : $selMonth;
$sapMonthly = $tourObj->getSapSelectedMonth($selMonth);
$tourlist = $tourObj->getToursByOperatorId();
$tourlist = $tourlist->data->tours;
$userTours = array();
if(!empty($tourlist)){
	foreach($tourlist as $tour){
		if($operatorId == $tour->tour->operatorId){
			$userTours[] = array('tour_id' => $tour->tour->id, 'title' => $tour->tour->name );
		}
	}
}
if(empty($_SESSION['setUserTourId'])){
	$_SESSION['setUserTourId'] = $userTours[0]['tour_id'];
}
get_header(); ?>
<div id="primary" class="site-content" style="background:#FFF;">
	<div id="content" role="main">
		  <section id="contact-page" class="container-fluid" style="padding: 0px;">
        <div class="row">
            <div class="col-sm-1" style="background: rgb(233, 233, 233) none repeat scroll 0% 0%; height: 700px; padding: 0 0 0 15px">
				<ul class="left-ul provider-left-menu" style="list-style: outside none none; padding: 0px;">
                    
                    <li style="border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url();?>/operator-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/stting-info-1.png">-->Provider info</a></li>
                    <li style="border-left: 6px solid rgb(255, 117, 117);"><a href="<?php echo site_url();?>/tour-list-info"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/setting-icon.png">-->Add / Edit Tours</a></li>
                    <li style="border-left: 6px solid rgb(187, 226, 104); background: rgb(187, 226, 104) none repeat scroll 0% 0%;"><a href="<?php echo site_url(); ?>/schedule-tours/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Scheduler</a></li>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
					<?php $is_admin = $tourObj->checkIsAdmin();
if($is_admin == 'success'){?>
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/operator-listing/">Operator Listing</a></li>
<?php }?>
                </ul>
			</div>
		<form method="post" action="<?php site_url(); ?>?option=1&task=updateSap">	
        <div class="col-lg-6">
			
					<h1>SCHEDULE TOURS</h1>
					<div class="form-group">
						<select name="tour_id" class="select-class" id="cTourId">
						<?php if(!empty($userTours)): 
							foreach($userTours as $item):
						?>
						  <option <?php echo ($item['tour_id'] == $_SESSION['setUserTourId']) ? 'selected="selected"' : ''; ?> value="<?php echo $item['tour_id']; ?>"><?php echo $item['title']; ?></option>
						<?php endforeach; 
						else:
						?>
							<option value="">No Tours</option>
						<?php endif; ?>
						</select>
					</div>
			<style>
			.header a {
			  color: inherit;
			  text-decoration: none;
			}
			.header{
				background: rgb(230, 231, 231) none repeat scroll 0 0;
			border-radius: 5px;
			float: left;
			width: 100%;
			}
			.header h4, .dates li h4{
				margin-bottom: 10px;
				margin-top: 10px;
			}
			#calendar .label-calendar .title {
			  display: inline-block;
			  float: left;
			  font-size: 18px;
			  position: relative;
			  text-align: center;
			  width: 14.2857%;
			  font-weight:bold;
			}
			.dates li {
			  float: left;
			  list-style: outside none none;
			  text-align: center;
			  width: 14.2857%;
			  min-height: 92px;
			  font-size:18px;
			  font-weight:bold;
			  cursor:pointer;
			  border:1px #000000 solid;
			}
			.box-inner {
			  height: 70px;
			  width: 100px;
			}
			.box1 {
			  border: 1px solid #eafec0;
			  border-radius: 5px;
			  float: left;
			  height: 47%;
			  margin: 3px;
			  width: 43%;
			}
			.box2 {
			  border: 1px solid #eafec0;
			  border-radius: 5px;
			  float: left;
			  height: 47%;
			  margin: 1px;
			  width: 47%;
			}
			.dates .no-border{
				border:none !important;
			}
			.disable-block{
				background: #e8e8e8;
				  border: 1px solid #f1f1f1;
				  height: 98px !important;
			}
			.calendar-select{ padding-right:10px;}
			</style>
			
			<?php 

			$monthlydata = array();
			$calendar = new Calendar($currentUrl, $sapMonthly);
			 
			echo $calendar->show();
			
			?>
			
			</div>		
			<div class="col-sm-3">
				<div class="col-sm-12 aplly-schedule">
					<h4>APPLY TO ALL CHECKED CELLS <i class="fa fa-check" aria-hidden="true"></i></h4>
					<h5>Start here:</h5>
					<div class="form-group">
						<input type="text" id="scheduleNumber" class="form-control"  placeholder="Enter Number:6">
					</div>
					<div class="form-group">
						<input type="text" id="schedulePrice" class="form-control"  placeholder="Enter Price:$100">
					</div>
					<div class="form-group" style="width:100%;">
						<button type="button" id="applyschedule" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);width:100%;">APPLY</button>
					</div>
					<h5 >* Non selected dates will be deleted from the db</h5>
				</div>
				
				<div class="form-group col-lg-12 text-center" style="float: left; margin-top:20px;">
					<button type="submit" class="btn btn-primary btn-lg" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">SUBMIT</button>
				</div><!--/.col-sm-4-->
				<input type="hidden" name="cmonth" value="<?php echo $selMonth; ?>"/>
			</div>	
			
			
		</form>
        </div>
    </section><!--/#contact-page-->

	</div>
</div>
<script>
(function( $ ) {
  $(function() {
	var siteUrl = '<?php echo site_url();  ?>';  
 	$('#applyschedule').click(function(){
		var currentDate = new Date();
		var createDate = new Date(currentDate.getFullYear(),currentDate.getMonth(), currentDate.getDate());

		var schnum = $('#scheduleNumber').val();
		var schprice = $('#schedulePrice').val();
		var parentId = '#calendar .dates .calendar-select.calc-active';

		$(parentId).each(function(index, obj){
			var parentId = $(this).parent();
			var parentLi = parentId.attr('id');
			var selectedDate = parentLi.replace('li-','');
			var calendarDate = new Date(selectedDate);
			if((calendarDate.getTime() > createDate.getTime() ) || calendarDate.getTime() == createDate.getTime() ){

				$('#'+parentLi+' .all-price').html(schprice);
				$('#'+parentLi+' .all-price-val').val(schprice);
			}
		});
		$('#calendar .dates .calendar-select').attr('data-price',schprice);

	});
	$('.calendar-select').click(function(){
		var currentDate = new Date();
		var createDate = new Date(currentDate.getFullYear(),currentDate.getMonth(), currentDate.getDate());





		var parentId = $(this).parent();
		var parentLi = parentId.attr('id');
		var selectedDate = parentLi.replace('li-','');
		var calendarDate = new Date(selectedDate);
		if((calendarDate.getTime() > createDate.getTime() ) || calendarDate.getTime() == createDate.getTime() ){

		} else {
			return false;
		}
		if($(this).hasClass('calc-active')){
			$(this).removeClass('calc-active');			
			$('#'+parentLi+' .newlink').removeClass('fa-check');
			//$('#'+parentLi+' .check-ele').val('');
		} else {
			$(this).addClass('calc-active');
			$('#'+parentLi+' .newlink').addClass('fa-check');
			var checkTour = $('#'+parentLi+' .check-ele').attr('data-cur-mnth');
			$('#'+parentLi+' .check-ele').val(checkTour);
		}
		var schnum = $(this).attr('data-number');
		var schprice = $(this).attr('data-price');
		$('#scheduleNumber').val(schnum);
		$('#schedulePrice').val(schprice);
	});
	$('#cTourId').change(function(){
		var cId = $(this).val();
		window.location = siteUrl +'?option=1&task=setUserTour&tour_id='+cId;
	});
  });
})(jQuery);
</script>

<?php get_footer(); ?>
