<?php
/**
 * Template Name: SEARCH
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
$detect = new Mobile_Detect;
?>

<!--script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.twbsPagination.min.js"></script-->
<!--script src="<?php bloginfo( 'template_url' ); ?>/js/jscrollpane.js"></script>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/jscrollpane.css"-->
<!--script async src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js"></script-->
<script>
(function($){
$(document).ready(function(){
    $(".advance").click(function(){
        $(".testab").show();
		 $('.advance2').show();
		 $('.button-go-1').hide();
		 $('.button-go-2').show();		
    	$('.advance').hide();
    });

    $(".advance2").click(function(){
		$(".testab").hide();
        $('.advance').show();
		$('.button-go-2').hide();
		 $('.button-go-1').show();
    	$('.advance2').hide();
    });
	//$('.search-result-block-outer').jScrollPane();
});
})(jQuery);
</script>
<div id="primary" class="site-content" style="margin:4.2rem 0 0;">
	<div id="content" role="main">
<?php
	
require_once get_template_directory().'/inc/tourlib.php';
$selectedSort = $_REQUEST['sortby']; 
$tourObj = new tourLibrary();
$search = $tourObj->searchTours();
$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
$search = $search->tours;
$locationTable = array();

if(!empty($search))
{
			//$totalTours = count($search);
			$totalTours = $_SESSION['totalResultSession'];

			$searchCollection = $search;//array_chunk($search, 10);

/* echo "<pre>";
print_r($searchCollection);
echo "</pre>"; */
$i = 0;

foreach ($search as $item) {
	if(empty($item->thumbnails[0]))
	{
		$thumb = site_url().'/wp-content/uploads/img1.png'; 
	} else
	{
		$thumb = $item->thumbnails[0];
	}
	$currency = $item->tour->currency;
	$currency = $symbolTable[$currency];
	$rideprice = $item->sap[0]->price;
	
	$name = substr($item->tour->title,0,40);
	$name .= (strlen($item->tour->title) > 40) ? '...' : '';
	$locationTable[$item->tour->id] = array('address' =>$item->tour->city.', '.$item->tour->country, 'name' => $name, 'link' => $item->tour->name,  'price' => $currency.''.round($rideprice), 'thumbnails' =>  $thumb,'show_date' => $item->sap[0]->time); 
	
    $i++;
    // if there are 15 $item[number] in this foreach, I want get the value : 15
}
}
$newlocations = array();
if(!empty($locationTable))
{
foreach($locationTable as $key =>  $item){
	$address = $item['address'];
if($address){	
	$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');
	$geo = json_decode($geo, true);		
		if ($geo['status'] = 'OK') {
			$status = true;
			$latitude = $geo['results'][0]['geometry']['location']['lat'];;
			$longitude =  $geo['results'][0]['geometry']['location']['lng'];
			if(!empty($latitude) && !empty($longitude)){
				$newlocations[] = (object) array('lat' => $latitude, 'lng' => $longitude, 'id' =>$key , 'title' =>$item['name'] , 'price' => $item['price'], 'thumbnails' => $item['thumbnails'], 'link' => $item['link'],'show_date' => $item['show_date']);
			}
		}
	}
}
}
?>

		
		

		<section id="services" class="emerald banner-section position-ie" style="position: relative; padding:0px;">
			<div class="container">
				<form  method="get" name="searchform" id="searchform" action="<?php echo site_url();?>/search">
			<input type="hidden" name="pageNum" value="0" />
					<div class="row">
						<h3 style="margin: 9px 0; color:#818C92;">SELECT YOUR RIDE </h3>
						<div class="col-md-2 col-sm-12 background-color">
						   
							<div class="media">
								<div class="pull-left">               
									<div id="icon-date">&nbsp;</div>
								</div>
								<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css"-->
								<div class="media-body">
									<input type="text" name="date" class="banr-input select-btn datepicker" value="<?php echo empty($_REQUEST['date']) ? (strftime("%b %e %Y")) : $_REQUEST['date']; ?>"/>
								</div>
							</div>
							<!--link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.min.css"-->
							<script async src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
							<script>
							  (function( $ ) {
							  $( function() {
								$( ".datepicker" ).datepicker({
									dateFormat: "M d yy",
									onSelect: function(dateText, inst){
										var dateVal = inst.currentYear+'-'+ (inst.currentMonth + 1) +'-'+inst.currentDay;
										$("#selecteddate").val(dateVal);
										//$("#icon-date").html(inst.currentDay);
									}
								});
								
							  }); 
							  
							   })(jQuery);
							</script>
					<?php $selecteddate = $_REQUEST['selecteddate']; ?>

					<input type="hidden" name="selecteddate" value="<?php echo (empty($selecteddate)) ? date('Y-m-d') : $selecteddate; ?>" id="selecteddate" />
						</div>
						<div class="col-md-5 col-sm-12 background-color">
							<div class="media">
								<div class="pull-left">
									<img src ="<?php bloginfo( 'template_url' ); ?>/img/icon2.png">
								</div>
								<div class="media-body">
									<input style="color:#fff;" type="text" name="endPoint" value="<?php echo $_REQUEST['endPoint'];  ?>" class="banr-input select-btn" placeholder="Destination"/>
								</div>
							</div>
						</div><!--/.col-md-4-->
						<div class="col-md-3 col-sm-12 pading">
							<div class="">                       
								<div class="">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									<?php $rideType = empty($_REQUEST['tourType']) ? 'All' : $_REQUEST['tourType']; ?>
									<div class="btn-group bootstrap-select guidetour-select block1 ridetour">
								<button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" role="button" title="Ride type"><span class="filter-option pull-left"><?php echo $rideType; ?></span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
								</button>
								<div class="dropdown-menu open" role="combobox">
									<ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
										<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Ride type</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">All</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">All Mountain</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Cross Country</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="4"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Downhill</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
									</ul>
								</div>
								<select class="guidetour-select ridetour" id="tourType" name="tourType" tabindex="-98">
										<option value="">Ride type</option>								
										<option value="">All</option>							
										<option <?php echo ($rideType == 'ALL_MOUNTAIN') ? 'selected="selected"' : ''; ?> value="ALL_MOUNTAIN">All Mountain</option>
										<option <?php echo ($rideType == 'CROSS_COUNTRY') ? 'selected="selected"' : ''; ?> value="CROSS_COUNTRY">Cross Country</option>
										<option <?php echo ($rideType == 'DOWNHILL') ? 'selected="selected"' : ''; ?> value="DOWNHILL">Downhill</option>
								</select>
							</div>

							<script>
						/* 	$('.bootstrap-select.guidetour-select.block1  button').click(function(){
								$(".bootstrap-select.guidetour-select.block1").addClass('opennew');								
							}); */
							$(".bootstrap-select.guidetour-select.block1 .dropdown-menu.inner li").click(function(){
								$(".bootstrap-select.guidetour-select.block1 .dropdown-menu .inner").removeClass('selected');
								$(this).addClass('selected');
								var textdata = $(this).find('.text').html();	
								$('.bootstrap-select.guidetour-select.block1 span.filter-option').html(textdata);
								$('.bootstrap-select.guidetour-select.block1').removeClass('open');
								var selIndex = $(this).attr('data-original-index');	
								$('#tourType option')[selIndex].selected = true;	
							});
							</script>								
								</div>
							</div>
						</div><!--/.col-md-4-->
						<div class="col-md-1 col-sm-12" style="padding:8px 22px;">
							<!--button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">GO</button-->
							<input type="submit" value="GO" class="btn btn-danger button-go-1" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 10px; font-size: 19px;color:#000; border-radius: 4px; font-weight:400;">
							
						</div>
						
					</div>
					<div class="row testab" style="display:none">
			
						<div class="col-md-2 col-sm-12 background-color" style="padding: 8px 10px;">
							<div class="media">
								
								<div class="media-body">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									<input type="text" class="banr-input" name="group" style="margin-bottom: -1px;" placeholder="Group size"/>
										<!--select class="select-btn" name="group" required> 
											<option> Group Size</option>
											<option>Any</option>
											<option>Min value is 1</option>
											<option> Max value is 99</option>
										</select-->
								</div>
							</div>
						</div>
				
						<div class="col-md-2 col-sm-12 pading">
							<div class="">
								
								<div class="">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									
									<!--select class="guidetour-select selectpicker" name="guidedTour" required> 
										<option> Guided </option>
										<option> Any</option>
										<option>Guided</option>
										<option> Self-guided</option>
									</select-->
															<div class="btn-group bootstrap-select guidetour-select block2">
								<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Guided"><span class="filter-option pull-left"> Guided </span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
								</button>
								<div class="dropdown-menu open" role="combobox">
									<ul class="dropdown-menu inner" role="listbox" aria-expanded="false">
										<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text"> Guided </span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text"> Any</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Guided</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
										<li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text"> Self-guided</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
										</li>
									</ul>
								</div>
								<select class="guidetour-select" id="guidedTour" name="guidedTour" required="" tabindex="-98">
									<option> Guided </option>
									<option> Any</option>
									<option>Guided</option>
									<option> Self-guided</option>
								</select>
							</div>
							<script>
						/* 	$('.bootstrap-select.selectCurrency-select.block2  button').click(function(){
								$(".bootstrap-select.selectCurrency-select.block2").toggleClass('open');								
							}); */
							$(".bootstrap-select.guidetour-select.block2 .dropdown-menu.inner li").click(function(){
								$(".bootstrap-select.guidetour-select.block2 .dropdown-menu .inner").removeClass('selected');
								$(this).addClass('selected');
								var textdata = $(this).find('.text').html();	
								$('.bootstrap-select.guidetour-select.block2 span.filter-option').html(textdata);
								$('.bootstrap-select.guidetour-select.block2').removeClass('open');
								var selIndex = $(this).attr('data-original-index');	
								$('#guidedTour option')[selIndex].selected = true;	
							});
							</script>	
									
								</div>
							</div>
						</div>
				
						<div class="col-md-2 col-sm-12 pading">
							<div class="">
								
								<div class="">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									<!--select class="guidetour-select selectpicker" name="days" required> 
										<option> Duration </option>
										<option> Any</option>
										<option>Single day</option>
										<option>1-7 days</option>
										<option>8 days and above</option>
									</select-->
								<div class="btn-group bootstrap-select guidetour-select block3">
									<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Duration"><span class="filter-option pull-left"> Duration </span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
									</button>
									<div class="dropdown-menu open" role="combobox" style="max-height: 235.95px; overflow: hidden; min-height: 79px;">
										<ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 233.95px; overflow-y: auto; min-height: 77px;">
											<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text"> Duration </span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text"> Any</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Single day</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">1-7 days</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="4"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">8 days and above</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
										</ul>
									</div>
									<select class="guidetour-select" id="duration" name="days" required="" tabindex="-98">
										<option> Duration </option>
										<option> Any</option>
										<option>Single day</option>
										<option>1-7 days</option>
										<option>8 days and above</option>
									</select>
								</div>
								<script>
								/* 	$('.bootstrap-select.selectCurrency-select.block1  button').click(function(){
										$(".bootstrap-select.selectCurrency-select.block1").toggleClass('open');								
									}); */
									$(".bootstrap-select.guidetour-select.block3 .dropdown-menu.inner li").click(function(){
										$(".bootstrap-select.guidetour-select.block3 .dropdown-menu .inner").removeClass('selected');
										$(this).addClass('selected');
										var textdata = $(this).find('.text').html();	
										$('.bootstrap-select.guidetour-select.block3 span.filter-option').html(textdata);
										$('.bootstrap-select.guidetour-select.block3').removeClass('open');
										var selIndex = $(this).attr('data-original-index');	
										$('#duration option')[selIndex].selected = true;	
									});
								</script>
								</div>
							</div>
						</div>
				
						<div class="col-md-2 col-sm-12 pading">
							<div class="">
								
								<div class="">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									<!--select class="guidetour-select selectpicker" name="difficultyLevel" required> 
										<option>Difficulty level</option>
										<option>Any</option>
										<option>Easy</option>
										<option>Medium</option>
										<option>Difficult</option>
									</select-->
									<div class="btn-group bootstrap-select guidetour-select block4">
									<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Difficulty level"><span class="filter-option pull-left">Difficulty level</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
									</button>
									<div class="dropdown-menu open" role="combobox" style="max-height: 235.95px; overflow: hidden; min-height: 79px;">
										<ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 233.95px; overflow-y: auto; min-height: 77px;">
											<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text">Difficulty level</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Any</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Easy</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Medium</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="4"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Difficult</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
										</ul>
									</div>
									<select class="guidetour-select selectpicker" name="difficultyLevel" required="" tabindex="-98">
										<option>Difficulty level</option>
										<option>Any</option>
										<option>Easy</option>
										<option>Medium</option>
										<option>Difficult</option>
									</select>
								</div>
								<script>
								/* 	$('.bootstrap-select.selectCurrency-select.block1  button').click(function(){
										$(".bootstrap-select.selectCurrency-select.block1").toggleClass('open');								
									}); */
									$(".bootstrap-select.guidetour-select.block4 .dropdown-menu.inner li").click(function(){
										$(".bootstrap-select.guidetour-select.block4 .dropdown-menu .inner").removeClass('selected');
										$(this).addClass('selected');
										var textdata = $(this).find('.text').html();	
										$('.bootstrap-select.guidetour-select.block4 span.filter-option').html(textdata);
										$('.bootstrap-select.guidetour-select.block4').removeClass('open');
										var selIndex = $(this).attr('data-original-index');	
										$('#duration option')[selIndex].selected = true;	
									});
								</script>
								</div>
							</div>
						</div>
				
						<div class="col-md-2 col-sm-12 pading">
							<div class="">
							   
								<div class="">
									<!-- <input class="banr-input" placeholder="Destination"/> -->
									<!--select class="guidetour-select selectpicker" name="hiredBikes" required> 
										<option> Hired bike </option>
										<option>Any</option>
										<option>Hired</option>
										<option>Own</option>
									</select-->
								<div class="btn-group bootstrap-select guidetour-select block5">
									<button type="button" class="btn dropdown-toggle btn-default" data-toggle="dropdown" role="button" title="Hired bike"><span class="filter-option pull-left"> Hired bike </span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
									</button>
									<div class="dropdown-menu open" role="combobox" style="max-height: 235.95px; overflow: hidden; min-height: 79px;">
										<ul class="dropdown-menu inner" role="listbox" aria-expanded="false" style="max-height: 233.95px; overflow-y: auto; min-height: 77px;">
											<li data-original-index="0" class="selected"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="true"><span class="text"> Hired bike </span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="1"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Any</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="2"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Hired</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
											<li data-original-index="3"><a tabindex="0" class="" style="" data-tokens="null" role="option" aria-disabled="false" aria-selected="false"><span class="text">Own</span><span class="glyphicon glyphicon-ok check-mark"></span></a>
											</li>
										</ul>
									</div>
									<select class="guidetour-select" id="hiredBikes" name="hiredBikes" required="" tabindex="-98">
										<option> Hired bike </option>
										<option>Any</option>
										<option>Hired</option>
										<option>Own</option>
									</select>
								</div>
								<script>
								/* 	$('.bootstrap-select.selectCurrency-select.block1  button').click(function(){
										$(".bootstrap-select.selectCurrency-select.block1").toggleClass('open');								
									}); */
									$(".bootstrap-select.guidetour-select.block5 .dropdown-menu.inner li").click(function(){
										$(".bootstrap-select.guidetour-select.block5 .dropdown-menu .inner").removeClass('selected');
										$(this).addClass('selected');
										var textdata = $(this).find('.text').html();	
										$('.bootstrap-select.guidetour-select.block5 span.filter-option').html(textdata);
										$('.bootstrap-select.guidetour-select.block5').removeClass('open');
										var selIndex = $(this).attr('data-original-index');	
										$('#hiredBikes option')[selIndex].selected = true;	
									});
								</script>
								</div>
							</div>
						</div>
						<input type="hidden" value="<?php echo $selectedSort; ?>" name="sortby" id="sortby" />
						<div class="col-md-1 col-sm-12" style="padding:8px 22px;">
							<input type="submit" name="search" value="GO" class="btn btn-danger button-go-2" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 10px; font-size: 19px; color:#000; display:none; border-radius:4px; font-weight:400;">
						</div>
			
					</div>
			   	</form>
				<div class="col-md-12 col-sm-12" style="padding: 0px;">
					<div class="advance" style="bottom: -40px;">
						<h5 style="font-weight: normal; font-size: 17px; cursor:pointer;">Advanced <i class="fa fa-plus" id="down" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true" id="up" style="display:none;"></i> </h5>
					</div>
					<div class="advance2" style="display:none; bottom: -40px;">
						<h5 style="font-weight: normal; font-size: 17px;cursor:pointer;">Advanced <i class="fa fa-minus" aria-hidden="true" id="up"></i> </h5>
					</div>
					
				</div>
			
			</div>
		</section><!--/#services-->

    
	
	
	
    <section id="contact-page" class="" style="padding:0">
        <div class="row">
			<div class="col-sm-6 col-xs-12 text-right" style="margin: 0px;">
				<?php 
				/*	 $address = $_REQUEST['endPoint'];
		if(!empty($address)){
						//Formatted address
						$formattedAddr = str_replace(' ','+',$address);
						//Send request and receive json data by address
						
						$geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($formattedAddr).'&sensor=false');
						$output = json_decode($geocodeFromAddr);						
						//Get latitude and longitute from json data
					 $data['latitude']  = $output->results[0]->geometry->location->lat; 
					 $data['longitude'] = $output->results[0]->geometry->location->lng;
						//Return latitude and longitude of the given address
					}	*/			
				?>
				
	<style>
		.pading {
  padding: 0 4px !important;
}
	  .ui-datepicker{
			font-size:18px !important;
		}
		
	.search-result-block-outer .jspVerticalBar .jspDrag{
		background:rgba(0, 0, 0, 0.2);
	}
	.search-result-block-outer .jspVerticalBar .jspDrag {
	  background: rgba(0, 0, 0, 0.2) none repeat scroll 0 0;
	  border-radius: 9px;
	  height: 10px;
	  margin-top: 4px;
	}
	.search-result-block-outer .jspVerticalBar{
		background:none;
		
	}
	.search-result-block-outer .jspTrack{
		background:none;
		padding-left:3px;
	}
	.search-result-block-outer{
		padding: 0 5px !important;
	}
	       
	.pagination li > a:hover {
  background: #e1e1e1 none repeat scroll 0 0 !important;
  border-radius : 100% !important;
}
.result {
  background: #f1f1f1 none repeat scroll 0 0;
  border: 1px solid transparent;
  border-radius: 5px;
  float: left;
  margin-bottom: 15px;
  padding: 15px 15px 0;
  width: 100%;
}
.guidetour-select.highest button {
  background: transparent none repeat scroll 0 0 !important;
  border: medium none transparent;
  margin-top: 5px;
}
.guidetour-select.highest button span {
  color: #444444 !important;
}
.guidetour-select.highest .dropdown-toggle .caret {
  margin-top: -2px;
  position: absolute;
  right: 12px;
  top: 50%;
  vertical-align: middle;
  border-color: #444 transparent !important;
}
.map-aro{
  background: #000 none repeat scroll 0 0;
  border-radius: 4px;
  color: #fff;
  height: 42px;
  padding: 14px 7px 0 2px;
  position: absolute;
  right: 3px;
  top: 164px;
}
.arrow_click{
  background: #000 none repeat scroll 0 0;
  border-radius: 4px;
  color: #fff;
  height: 42px;
  padding: 14px 7px 0 2px;
  position: absolute;
  left:0;
  top: 164px;
}
.hidemap
{
	display:none;
}
.search-right
{
	width:100%;
}
.col-sm-12.result:hover {
  border: 1px solid red;
}
.title_tour {
  color: #444;
} 
.col-sm-12.result {
  border: 1px solid transparent;
}
.gm-style-iw
{
left: 5px !important;
    position: absolute;
    top: 10px;
    width: 130px;	
}
.map_price {
  text-align: center;
  width:100%;
  font-weight: bold;
}
.map_title {
   text-align: center;
  width:100%;
  font-weight: bold;
 margin-top: 10px !important;
  
 
}
img.map_img {
    float: left;
	width: 100%;
   border-radius: 10px !important;
}
#map {height:500px !important; width:680px !important;}
  </style>


    <!--i class="fa fa-caret-left map-aro" style="z-index:999;" id="arrow_click"aria-hidden="true"></i--><div id="map" style="border-right:2px solid #000;"> </div>
	
    <script>

      function initMap() {
		  
        var myLatLng = {lat: <?php echo empty($newlocations[0]->lat) ? '34.341575' : $newlocations[0]->lat;//$data['latitude']; ?>, lng: <?php echo empty($newlocations[0]->lng) ? '108.93977' : $newlocations[0]->lng;//$data['longitude']; ?>};
		
		

        var map = new google.maps.Map(document.getElementById('map'), {
          //zoom: 1.5,
		  //minZoom:1.5,
          center: myLatLng
        });
		 var bounds = new google.maps.LatLngBounds();
		 map.setTilt(45);


		var markers = <?php echo json_encode($newlocations).';'; ?>
		var infowindow = new google.maps.InfoWindow();
		  jQuery(markers).each(function(index,glatlng){	 
			var newLatlng = new google.maps.LatLng(glatlng.lat,glatlng.lng);
			   bounds.extend(newLatlng);
			  marker = new google.maps.Marker({
			  position: newLatlng,
			  map: map      
			});	
			
			
			
			var contentString = '<div class="mouseover_text"><div class="map_title">' + glatlng.title + '</div><br/><div class="map_price"> Price:' + glatlng.price + '</div><br/><img src="'+glatlng.thumbnails+'" class="map_img"></div>';
			
		 
		
			 marker.addListener('click', function() {
				window.location = '<?php echo site_url();?>/detail/'+ glatlng.link +'/'+ glatlng.id +'/' + glatlng.show_date;
				});
				
			

			google.maps.event.addListener(marker,'mouseover', (function(marker,contentString,infowindow){
					
					return function() {
					   infowindow.close();
					   infowindow.setContent(contentString);
					   infowindow.open(map,marker);
					};
				})(marker,contentString,infowindow)); 
				
			



					});
					map.fitBounds(bounds);
					map.setCenter(bounds.getCenter());

		    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
				//this.setZoom(1.5);
				google.maps.event.removeListener(boundsListener);
			});
		  google.maps.event.addDomListener(window, "resize", function() {
			  //console.log(123);
		   var center = map.getCenter();
		   google.maps.event.trigger(map, "resize");
		   map.setCenter(center); 
		});
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjrdzheqwZmdr8HFIzg5hN42TKRSTsE-g&callback=initMap"
    async defer></script>			
				
			<!--img src="<?php bloginfo( 'template_url' ); ?>/img/map.png"-->
            </div>
			<script>
			
			$('#arrow_click').click(function(){
			$('#map').toggleClass('hidemap');	
			 if($('#arrow_click').hasClass('map-aro'))
			{
				$('#arrow_click').addClass('arrow_click');
				$('#arrow_click').removeClass('map-aro');
				$('#search-rightdiv').addClass('search-right');
				
			}
			 else
			{
				
				$('#arrow_click').addClass('map-aro');
				$('#arrow_click').removeClass('arrow_click');
				$('#search-rightdiv').removeClass('search-right');
			}		  
			});
			
			
			</script>
            <div class="col-sm-6" id="search-rightdiv" style="margin-top: 35px;">
				<div class="col-sm-3 col-xs-6" style="padding:0 7px;">
					<h3 style="border-right:1px solid #34495E;font-size: 20px;">Found <b><?php echo empty($i) ? '0' : $i; ?></b> tours</h3>
				</div>
				
				
				<div class="col-sm-6 col-xs-6" style="padding:0px;">
				<?php
					$tourPage = $_REQUEST['pageNum'];
					if($tourPage == 0 || $tourPage == 1){
						$nextLog = ($totalTours < 10) ? $totalTours : 10;
						$showing = '1 - '.$nextLog;
					} else {
						$nextLog = ($tourPage * 10);
						$prevLog = $nextLog - 10;
						$nextLog = ($nextLog > $totalTours) ? $totalTours : $nextLog;
						$showing = $prevLog.' - '.$nextLog;
					}
					if(!empty($totalTours)):
				 ?>
					<h5 style="padding: 15px 0px 0;"><span class="counter-page-block">Showing <?php echo $showing; ?> </span> [Out of <?php echo $totalTours; ?>]</h5>
				<?php endif;  ?>
				</div>
				<div class="col-sm-3" >
					<!--<h5 style="float:left;">Sort by <i class="fa fa-sort-desc" aria-hidden="true"></i></h5>-->
					<?php 
						$sortByTable = array('' => 'Sort by', 'ratingSum-desc' => 'Highest Rated', 'saps.cost-desc' => 'Price High to Low', 'saps.cost-asc' => 'Price Low to High'); 
						
					?>
					
					<select name="sortby_tmp" id="sortby_tmp" class="guidetour-select highest" style="margin-top: 13px;background: transparent; border:none; font-size:13px; width:56% !important; float:right;">
					
						<?php foreach($sortByTable as $key => $item): ?>
							<option <?php echo ($key == $selectedSort) ? 'selected="selected"' : '';?> value="<?php echo $key;?>"><?php echo ucfirst($item); ?></option>
						<?php endforeach; ?>
						
					</select>
					
					<script>
					(function( jQuery ) {
						jQuery(function() {
							jQuery('#sortby_tmp').on('change', function(){
								var cval = jQuery(this).find("option:selected").val();								
								jQuery("#sortby").val(cval);
								jQuery('#searchform').submit();
								  });
							  });
					})(jQuery);
					</script>
				</div>
				
				
				<?php
				if (empty($searchCollection))
				{ ?>	
				<div class="noresult_text col-lg-12"><p>Unfortunately we could not find any tours for the selected search. Please try again with different search parameters</p></div>
				<?php } ?>
				
				
				<style>
				/* .search-result-block{
						display:none;
					}
					.search-result-block.active{
						display:block;
				} */
					#pagination-search{
						background:rgba(0, 0, 0, 0.6) none repeat scroll 0 0;
					}
					.search-result-block-outer{
						overflow-y:scroll;
						height:450px;
						float:left;
					}
					.gm-style div div {
				border-radius: 10px !important;
						}
						.gm-style-iw div div
						{
							overflow: hidden;
						}
				</style>
				<!--ul id="pagination-search" class="pagination-sm"></ul-->
				<div class="">
<?php 
$v = 1;
if(!empty($searchCollection))//echo "<pre>"; print_r($searchCollection); exit();
{
					/* foreach($searchCollection as $search):
						$activeBlock = ($v == 1) ? ' active' : ''; */
			$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
			?>
			
			<div class="outerdiv search-result-block block-<?php echo $v++.$activeBlock; ?>">
			<?php 
					foreach($searchCollection as $srch):
					if(!empty($srch->defaultImage->image) && !empty($srch->defaultImage->thumbnail)){
							$srch->images[0] = $srch->defaultImage->image;
							$srch->thumbnails[0] = $srch->defaultImage->thumbnail;
						}
	
?>				
				<div class="col-sm-12 result">
					<div class="col-sm-3" style="padding:0 1px;">
						<div class="col-xs-7" style="padding:0px;">
										<?php if($detect->isMobile()): ?>
										<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id; ?>/<?php echo $srch->sap[0]->time ?>">
										<?php if(!empty($srch->thumbnails[0])): ?>
											<img style="width:140px;height:85px;" src="<?php echo $srch->thumbnails[0]; ?>">
										<?php else: ?>
											<img style="width:100%;" src="<?php bloginfo( 'template_url' ); ?>/img/img1.png">
										<?php endif; ?>
										</a>
										<?php else: ?>
										<?php if(empty($srch->images[0])): ?>
											<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id; ?>/<?php echo $srch->sap[0]->time ?>"><img style="width:100%;" src="<?php bloginfo( 'template_url' ); ?>/img/img1.png"></a>
										<?php else: ?>
											<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id; ?>/<?php echo $srch->sap[0]->time ?>"><img style="width:160px;height:100px;" src="<?php echo (empty($srch->thumbnails[0])) ? $srch->images[0] : $srch->thumbnails[0]; ?>"></a>
										<?php endif; ?>
										<?php endif; ?>
									</div>
									<div class="col-xs-5 hed" style="padding:0px;">
										<a  class="title_tour" href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><h4 style="margin-top: 0px; text-transform: uppercase;"><strong><?php echo substr($srch->tour->title,0,40); echo (strlen($srch->tour->title) > 40) ? '...' : ''; ?></strong></h4></a>
								<div class="col-sm-2 text-center" style="float: right;">
									<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><h3 style="margin: 0px; color: rgb(255, 77, 77);font-weight:500;"><?php $rideprice = $srch->sap[0]->price;
									$rideprice = ($rideprice < 0) ? 0 : $rideprice;
									echo  $symbolTable[$srch->tour->currency].''.round($rideprice); ?></h3></a>
									<h5 style="margin: 0px;">per ride</h5><br/>
									<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><button style="background: rgb(50, 116, 151) none repeat scroll 0% 0%;font-size:16px;padding:9px 16px;" type="submit" class="btn btn-primary btn-lg">Book it</button></a>
					</div>
									</div>
							</div>
									<div class="col-sm-7" style="float: left;">
						<a  class="title_tour disply-none" href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><h4 style="margin-top: 0px; text-transform: uppercase;"><strong><?php echo substr($srch->tour->title,0,40); echo (strlen($srch->tour->title) > 40) ? '...' : ''; ?></strong></h4></a>
						<div class="col-sm-3 col-xs-6" style="padding: 0px;">
						<h5 style="margin-bottom: 0px;"><b>Destination</b></h5>
				<h5 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $srch->tour->endPoint ?></h5></br>
						
							<h5 style="margin-bottom: 0px;"><b>Date</b></h5>
							<h5 style="margin-top: 0px;"><?php echo $srch->sap[0]->time ?></h5>
						</div>
						
						<div class="col-sm-4 col-xs-6" style="padding: 0px 6px;">
							<h5 style="margin-bottom: 0px;"><b>Ride Type</b></h5>
<div style="margin-top: 2px; font-weight:300;font-family:open sans;"><?php 
//$tourtype= str_replace('_',' ',$srch->tour->tourType); $tourtype= ucwords(strtolower($tourtype)); echo $tourtype;
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
						<div class="col-sm-3 col-xs-6" style="padding: 0px 6px;">
							<h5 style="margin-bottom: 0px;"><b>Duration</b></h5>
							<h5 style="margin-top: 0px;"><?php echo $srch->tour->days; ?>days</h5>
						</div>
						<div class="col-sm-2 col-xs-6" style="padding: 0px 6px;">
							<h5 style="margin-bottom: 0px;"><b>Rating</b></h5>
							<h5 style="margin-top: 0px;">
								<!--?php
								$rate = $srch->tour->ratedPeople;
								if($rate == 0)
								{
								echo "";
								}
								else
								{
								for($i=1; $i<=$rate; $i++)
								{
								echo"*";
								}
								}
								?-->
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
					<div class="col-sm-2 text-center disply-none" style="float: right;">
				<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><h3 style="margin: 0px; color: rgb(255, 77, 77);font-weight:500;"><?php $rideprice = $srch->sap[0]->price; 
				$rideprice = ($rideprice < 0) ? 0 : $rideprice;
				echo  $symbolTable[$srch->tour->currency].''.round($rideprice); ?></h3></a>
						<h5 style="margin: 0px;">per ride</h5><br/>
<a href="<?php echo site_url();?>/detail/<?php echo $srch->tour->name; ?>/<?php echo $srch->tour->id ?>/<?php echo $srch->sap[0]->time; ?>"><button style="background: rgb(50, 116, 151) none repeat scroll 0% 0%;font-size:16px;padding:9px 16px;" type="submit" class="btn btn-primary btn-lg">Book it</button></a>
					</div>
                
				</div>
				
					<?php 
								if($v == 10)
						{
							break;
								}
								$v++;
							endforeach;
							?>
						</div>
					<?php
					//endforeach;
				} ?>

			</div>

			<div class="col-lg-12 text-center" style="padding:20px 0; float:left;">

			</div>
			<div class="container text-center">
				<div class="col-lg-3">
				
				</div>
				
				<div class="col-lg-6">
					<ul id="pagination-search" class=""></ul>
				</div>
				 
				<div class="col-lg-3">
				 
				</div>
				 </div>
				 <style>
				 #pagination-search .first, #pagination-search .last{
					 display:none;
				 }
				#pagination-search li{
					border: 1px solid #787878;
					background:none;
					border-radius: 100%;
					color: #787878;
					margin-right:5px;
					float:left;
					font-size:18px !important;
				 }
				 #pagination-search, #pagination-search li a, #pagination-search li:hover a, #pagination-search .active{
					 background:none;
					 color: #787878
				 }
				 .search-result-block img{
					 border-radius: 3px;
				 }
				 </style>
				 <script>
				/*(function( $ ) {
				 $('#pagination-search').twbsPagination({
					totalPages: <?php echo ceil($totalTours/10); ?>,
					visiblePages: 5,
					prev: '<i class="fa fa-arrow-left"></i>',
					next: '<i class="fa fa-arrow-right"></i>',
					onPageClick: function (event, page) {
						var selBlock = 'block-'+page;
						var offsetVal = 10;
						var totalResults = <?php echo $totalTours; ?>;
						var resultEnds = parseInt(page) * offsetVal;
						var resultStarts = parseInt(resultEnds) - offsetVal;
						resultStarts = (resultStarts < 1) ? 1 : resultStarts;
						resultEnds = (resultEnds > totalResults) ? totalResults : resultEnds;
						var counterblockdata = 'Showing '+resultStarts+' - '+resultEnds;
						$('.search-result-block').removeClass('active');
						$('.search-result-block.'+selBlock).addClass('active');
						$('.counter-page-block').html(counterblockdata);
						$("html, body").animate({ scrollTop: 0 }, "slow");
					}
				});
				})(jQuery);*/
				</script>
			<?php
			 $totalTours = $_SESSION['totalResultSession'];
			 $pagination = "";
			 $totalPages = ceil($totalTours/10);
			 $page = $_REQUEST['pageNum'];
			 if($page == 0){
				 $page = 1;
			 }
			 $prev_page = $page - 1;
			 $next_page = $page + 1;
			 $lastpage = $totalPages;
			 $lpm1 = $lastpage - 1;
			 $counter = 0;
			 $adjacents = 1;
			 #$requestUri = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			 parse_str($_SERVER['QUERY_STRING'], $query_string);





			unset($query_string['pageNum']);
			$rdr_str = http_build_query($query_string);

			$scriptName = site_url().'/search/?'.$rdr_str;

			 if ($lastpage > 1) {
				 if($page > 1){
					$pagination = '<li class="prev"><a href="'.$scriptName.'&pageNum='.$prev_page.'"><i class="fa fa-arrow-left"></i></a></li>';
				 } else {
					 $pagination = '<li class="prev disabled"><a href="#"><i class="fa fa-arrow-left"></i></a></li>';
				 }
				 # pages
				if ($lastpage < 7 + ($adjacents * 2)) { # not enough pages to bother breaking it up
					for ($counter = 1; $counter <= $lastpage; $counter++) {
						if ($counter == $page) {
							$pagination .= "<li class=\"page active pagination_current\"><a href=\"#\">$counter</a></li>";
						} else {
							$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$counter" . $extra . "\">$counter</a></li>";
						}
					}
				} elseif ($lastpage > 5 + ($adjacents * 2)) { # enough pages to hide some
					# close to beginning; only hide later pages
					if ($page < 1 + ($adjacents * 2)) {
						for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
							if ($counter == $page) {
								$pagination .= "<li class=\"page active pagination_current\"><a href=\"#\">$counter</a></li>";
							} else {
								$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$counter" . $extra . "\">$counter</a></li>";
							}
						}
						$pagination .= "...";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$lpm1" . $extra . "\">$lpm1</a></li>";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$lastpage" . $extra . "\">$lastpage</a></li>";
					} elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) { # in middle; hide some front and some back
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=1" . $extra . "\">1</a></li>";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=2" . $extra . "\">2</a></li>";
						$pagination .= "...";
						for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
							if ($counter == $page) {
								$pagination .= "<li class=\"page active pagination_current\"><a href=\"#\">$counter</a></li>";
							} else {
								$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$counter" . $extra . "\">$counter</a></li>";
							}
						}
						$pagination .= "...";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$lpm1" . $extra . "\">$lpm1</a></li>";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$lastpage" . $extra . "\">$lastpage</a></li>";
					} else { # close to end; only hide early pages
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=1" . $extra . "\">1</a></li>";
						$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=2" . $extra . "\">2</a><li>";
						$pagination .= "...";
						for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
							if ($counter == $page) {
								$pagination .= "<li class=\"page active pagination_current\"><a href=\"#\">$counte</a></li>";
							} else {
								$pagination .= "<li class='page'><a href=\"$scriptName&pageNum=$counter" . $extra . "\">$counter</a><li>";
							}
						}
					}
				}

				# next button
				if ($page < $counter - 1) {
					$pagination .= "<li class='next'><a href=\"$scriptName&pageNum=$next_page" . $extra . "\"><i class='fa fa-arrow-right'></i></a></li>";
				} else {
					$pagination .= "<li class=\" next pagination_disabled\"><a href=\"#\"><i class='fa fa-arrow-right'></i></a></li>";
				}
				$pagination .= "</div>\n";
			 }
			 ?>
			 <ul id="pagination-search" class="pagination">
			<?php  echo $pagination; ?>
			</ul>
				<!--div class="col-lg-12 text-center" style=" float:left;">
					<img src="<!--?php bloginfo( 'template_url' ); ?>/img/add-2.png">
				</div-->
            </div><!--/.col-sm-8-->
			
            <!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->


	</div>
</div>
<?php get_footer(); ?>