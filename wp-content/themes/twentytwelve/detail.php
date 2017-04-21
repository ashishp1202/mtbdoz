<?php
/**
 * Template Name: DETAIL
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
<style>
img.size-full, img.size-large, img.header-image, img.wp-post-image {
    height: 150px;
    max-width: 100%;
    width: 100%;
}
.slider-inner ul {
  padding: 31% !important;
}
.slider-inner a {
  background-size: 100% 100% !important;
  border-radius: 6px;
  box-shadow: none !important;
}

.inner ul li {
  border-radius: 6px;
  width: 106px !important;
}
.inner ul li a {
  border-radius: 6px;
}
#thumbnail-slider .thumb {
  background-size: 100% 100% !important;
}
::-webkit-input-placeholder {
   color: #000 !important;
}

:-moz-placeholder { /* Firefox 18- */
   color: #000 !important;
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #000 !important;
}

:-ms-input-placeholder {
   color: #000 !important;
}
.description-block ul li{
	list-style: inside disc;

}
.description-block ol li {
  list-style: inside disc;
}
.clear-block{
	clear:both;
}
</style>



<script type="text/javascript">

(function( $ ) {
	$(document).ready(function(){
		$("#select_ride").click(function(){
		var participants = parseInt($("#nparticipants").val());
			if(participants < 1){
				participants = 1;
			}
			if(isNaN(participants)){
				participants = 1;
			}

			var newprice = $(".updateprice.original").html();
			newprice = parseFloat(newprice);
			var finalprice = participants * newprice;
			$(".updateprice.popup").html(finalprice);
			$("#sendamount").val(finalprice);
		$("#myModal").modal('show');
		});
	});
 })(jQuery);
</script>


<script type="text/javascript">

(function( $ ) {
	$(document).ready(function(){
		$("#select_ride1").click(function(){
		$("#myModal1").modal('show');
		});
	});
 })(jQuery);
</script>


<div id="primary" class="site-content">
	<div id="content" role="main">
	<!--search-->
	<section id="services" class="emerald banner-section position-ie" style="position: relative; padding:0px;">
			<div class="container">
				<form  method="get" name="searchform" id="searchform" action="<?php echo site_url();?>/search">
			<input type="hidden" name="pageNum" value="0" />
					<div class="row">
						<h3 style="margin: 9px 0; color:#818C92;">SELECT YOUR RIDE 123</h3>
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
									<img src ="<?php bloginfo( 'template_url' ); ?>/img/icon2.png" alt="Date">
								</div>
								<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
								<script>
  $(function() {
    $( "#endPoint" ).autocomplete({
      source: '<?php echo bloginfo('template_url');?>/autosuggest.php'
    });
  });
  </script>
								<div class="media-body">
								<label for="endPoint" style="display:none;"></label>
									<input style="color:#fff;" type="text" name="endPoint"  id="endPoint" value="<?php echo $_REQUEST['endPoint'];  ?>" class="banr-input select-btn" placeholder="Destination"/>
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
	<!--search-->

<?php

require_once get_template_directory().'/inc/tourlib.php';
global $wp_query;
$tourname = $wp_query->query_vars['tourname'];
$saptime = $wp_query->query_vars['saptime'];

$tourObj = new tourLibrary();
$detail = $tourObj->tour_detail($tourname);
$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
$totalImages = count($detail->images);
$cols_slider = empty($totalImages) ? 1 : $totalImages;
//$detail = $detail->tours;
/* echo "<pre>";
print_r($detail);
echo "</pre>"; */
$sapDates = array();
$sapPrices = array();
$sapPricesList = array();
if(!empty($detail->sap)){
foreach($detail->sap as $item){
	$sapPrices[] = $item->price;
	$sapPricesList[$item->time] = $item->price;
	$sapDates[]= $item->time;
}
}
$currentSapPrice = 0;
if(!empty($sapPricesList)){

	$currentSapPrice = $sapPricesList[$saptime];
}
$thumbnailTour = $detail->thumbnails;
$thumbnailTable = array();
if(!empty($thumbnailTour)){
	foreach($thumbnailTour as $key => $thumbTour){
		$getthumbName = explode('-',$thumbTour);
		$thumbnailTable[$key] = $getthumbName[1];
	}
}
?>
	<?php
	if($_SESSION['tourbookMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $_SESSION['tourbookMessage']; ?></div>
	<?php
			unset($_SESSION['tourbookMessage']);
	} ?>
		  <section id="contact-page" class="container">

        <div class="row" style="margin-top: 52px;">
            <div class="col-sm-12 col-lg-9">
				<div id="remove-text" style="color: transparent;">
				<div class="col-lg-12">

				<!--banner start-->
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- Reference to html5gallery.js -->
<script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/html5gallery/html5gallery.js"></script>

				<!--banner start-->
		<div style="text-align:center;">

    <!-- Define the Div for Gallery -->
    <!-- 1. Add class html5gallery to the Div -->
    <!-- 2. Define parameters with HTML5 data tags -->
	<div id="custom-html5-slider" style="display:none;margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="400" data-height="225" data-resizemode="fill" data-autoslide="true" data-slideshowinterval="6000"
	data-autoplayvideo="true" data-html5player="true">

	    <!-- Add images to Gallery -->
		<?php
					if(!empty($detail->images)){
					foreach($detail->images as $img){
		?>
		<a href="<?php echo $img;?>"><img src="<?php echo $img;?>" alt="<?php echo $detail->tour->name; ?>" title="<?php echo $detail->tour->name; ?>"></a>
					<?php }}
					else { ?>
					<a href="<?php bloginfo( 'template_url' ); ?>/img/banner.png"><img src="<?php bloginfo( 'template_url' ); ?>/img/banner.png" alt="<?php echo $detail->tour->name; ?>" title="<?php echo $detail->tour->name; ?>"></a>
					<?php } ?>
		<!-- Add videos to Gallery -->


		<!-- Add Youtube video to Gallery -->
		<?php
					if(!empty($detail->videos)){
					foreach($detail->videos as $vdo){
						$video_id = explode("?v=", $vdo);
						$video_id = $video_id[1];
						//print_r($video_id);
						//echo $vdo;

		?>
		<a href="<?php echo $vdo;?>" title="<?php echo $detail->tour->endPoint; ?>"><img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/default.jpg" alt="<?php echo $detail->tour->endPoint; ?>"></a>
		<?php }} ?>

	</div>

</div>

<style type="text/css">
.html5gallery-timer-0
{
	display:none !important;
}
.html5gallery-pause-0{
	display:none !important;
}
.html5gallery-elem-image-0 {
  width: 100% !important;
  height:400px !important;
   left:0 !important;
  top:0px !important;
  border-radius:10px;
}
.html5gallery-elem-img-0 {
  width: 100% !important;
  height:400px !important;
   border-radius:10px;

}
.html5gallery-elem-0 {
  display: block;
  height: 400px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100% !important;
}
.html5gallery-container-0 {
  background: transparent none repeat scroll 0 0;
  display: block;
  height: 400px !important;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
.html5gallery-box-0 {
  display: block;
  height: 400px !important;
  position: absolute;
  text-align: center;
  top: 12px;
  width: 650px;
}

.html5gallery {
  width: 100% !important;
  height:400px !important;

}

.html5gallery-car-0 {
  display: block;
  height: 400px !important;
  left: 100%;
  overflow: hidden;
  position: absolute;
  top: 12px;
  width: 95px;
}
.html5gallery-tn-img-0 {
  display: block;
  float: left;
  height: 70px;
  margin-left: 0;
  margin-top: 0;
  overflow: hidden;
  width: 106px;
}
.html5gallery-tn-img-0 div {
  width: 106px !important;
  height:70px !important;
}
.html5gallery-tn-selected-0 {
  background: transparent none repeat scroll 0 0;
  border: 0 solid #444444;
  cursor: pointer;
  display: block;
  height: 70px;
  margin-bottom: 2px;
  overflow: hidden;
  text-align: center;
  width: 106px;
}
.html5gallery-car-mask-0 {
  display: block;
  height: 400px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 106px;
}
.html5gallery-car-list-0 {
  display: block;
  height: 400px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 95px;
}
.html5gallery-car-0 {
  display: block;
  height: 270px;
  left: 82%;
  overflow: hidden;
  position: absolute;
  top: 12px;
  width: 95px;
}
.html5gallery-tn-image-0 {
  width: 100% !important;
}
.html5gallery-right-0 {

  cursor: pointer;
  display: none;
  height: 48px;
  left: 565px !important;
  position: absolute;
  top: 174px !important;
  width: 48px;
}
.html5gallery-left-0 {

  cursor: pointer;
  display: none;
  height: 48px;
  left: 20px;
  position: absolute;
  top: 174px !important;
  width: 48px;
}
.html5gallery-lightbox-0 {
  display: none !important;
}
.html5gallery-play-0 {
  display: none !important;
}
embed, iframe, object, video {
  height: 400px !important;
  width: 100% !important;
}
@media screen and (min-device-width: 320px) and (max-device-width: 768px)
{
.html5gallery-car-0 {
  display: none;
  height: 270px;
  left: 82%;
  overflow: hidden;
  position: absolute;
  top: 12px;
  width: 82px;
}
}

@media screen and (min-device-width: 320px) and (max-device-width: 400px) {
.html5gallery-elem-image-0 {
  width: 100% !important;
  height:200px !important;
   left:0 !important;
  top:0px !important;
}
.html5gallery-elem-img-0 {
  width: 100% !important;
  height:200px !important;

}
.html5gallery-elem-0 {
  display: block;
  height: 200px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 300px !important;
}
.html5gallery-container-0 {
  background: transparent none repeat scroll 0 0;
  display: block;
  height: 200px !important;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
.html5gallery-box-0 {
  display: block;
  height: 200px !important;
  position: absolute;
  left:0px !important;
  text-align: center;
  top: 12px;
  width: 100% important;
}

.html5gallery {
  width: 100% !important;
  height:200px !important;

}
.html5gallery-right-0 {
  cursor: pointer;
  display: none;
  height: 48px;
  left: 228px !important;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
.html5gallery-left-0 {
  cursor: pointer;
  display: none;
  height: 48px;
  left: 20px;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
embed, iframe, object, video {
  height: 201px !important;
  width: 100% !important;
}
}
@media screen and (min-device-width: 400px) and (max-device-width: 480px) {
	.html5gallery-elem-image-0 {
  width: 100% !important;
  height:255px !important;
   left:0 !important;
  top:-27px !important;
}
.html5gallery-elem-img-0 {
  width: 100% !important;
  height:255px !important;

}
.html5gallery-elem-0 {
  display: block;
  height: 255px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100% !important;
}
.html5gallery-container-0 {
  background: transparent none repeat scroll 0 0;
  display: block;
  height: 255px !important;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
.html5gallery-box-0 {
  display: block;
  height: 255px !important;
  position: absolute;
  text-align: center;
  top: 12px;
  width: 90%;
}

.html5gallery {
  width: 100% !important;
  height:255px !important;

}
.html5gallery-right-0 {

  cursor: pointer;
  display: none;
  height: 48px;
  left: 290px !important;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
.html5gallery-left-0 {
  cursor: pointer;
  display: none;
  height: 48px;
  left: 20px;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
embed, iframe, object, video {
  height: 201px !important;
  width: 100% !important;
}
}
@media screen and (min-device-width: 480px) and (max-device-width: 600px) {
	.html5gallery-elem-image-0 {
  width: 100% !important;
  height:299px !important;
   left:0 !important;
  top:-27px !important;
}
.html5gallery-elem-img-0 {
  width: 100% !important;
  height:299px !important;

}
.html5gallery-elem-0 {
  display: block;
  height: 299px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100% !important;
}
.html5gallery-container-0 {
  background: transparent none repeat scroll 0 0;
  display: block;
  height: 299px !important;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
.html5gallery-box-0 {
  display: block;
  height: 299px !important;
  position: absolute;
  text-align: center;
  top: 12px;
  width: 405px;
}

.html5gallery {
  width: 100% !important;
  height:299px !important;

}
.html5gallery-right-0 {

  cursor: pointer;
  display: none;
  height: 48px;
  left: 228px !important;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
.html5gallery-left-0 {

  cursor: pointer;
  display: none;
  height: 48px;
  left: 20px;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
embed, iframe, object, video {
  height: 299px !important;
  width: 100% !important;
}
}
@media screen and (min-device-width: 600px) and (max-device-width: 650px) {
	.html5gallery-elem-image-0 {
  width: 100% !important;
  height:377px !important;
   left:0 !important;
  top:-27px !important;
}
.html5gallery-elem-img-0 {
  width: 100% !important;
  height:377px !important;

}
.html5gallery-elem-0 {
  display: block;
  height: 377px !important;
  left: 0;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 100% !important;
}
.html5gallery-container-0 {
  background: transparent none repeat scroll 0 0;
  display: block;
  height: 377px !important;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
.html5gallery-box-0 {
  display: block;
  height: 377px !important;
  position: absolute;
  text-align: center;
  top: 12px;
  width: 560px;
}

.html5gallery {
  width: 100% !important;
  height:377px !important;

}
.html5gallery-right-0 {
  cursor: pointer;
  display: none;
  height: 48px;
  left: 472px !important;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
.html5gallery-left-0 {
  cursor: pointer;
  display: none;
  height: 48px;
  left: 20px;
  position: absolute;
  top: 100px !important;
  width: 48px;
}
embed, iframe, object, video {
  height: 299px !important;
  width: 100% !important;
}
}
<!-- @media screen and (min-device-width: 650px) and (max-device-width: 700px) {
	#ninja-slider {
  box-sizing: border-box;
  height: auto;
  margin: 0 auto;
  overflow: hidden;
  padding: 0;
  width: 680px;
}
} -->
.html5gallery-car-slider-bar-0 {
  display: none;
  height: 385px;
  left: 77px;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 14px;
}
.html5gallery-car-slider-bar-middle-0 {

  display: none;
  height: 355px;
  left: 0;
  position: absolute;
  top: 16px;
  width: 14px;
}
.html5gallery-car-slider-0 {
  cursor: pointer;
  display: none;
  height: 54px;
  left: 76px;
  overflow: hidden;
  position: absolute;
  top: 0;
  width: 16px;
}
.html5gallery-car-left-0
{
	background: #000 none repeat scroll 0 0 !important;
    height: 29px !important;
    opacity: 0.58 !important;
}
.html5gallery-car-right-0 {
 background: #000 none repeat scroll 0 0 !important;
    height: 29px !important;
    opacity: 0.58 !important;
}
.html5gallery-tn-image-0 {
  height: 70px !important;
  width: 106px !important;
}
.html5gallery-tn-0 {
  background: #292c31 -moz-linear-gradient(center top , #494f54, #292c31) no-repeat scroll 0 0;
  border: 1px solid #666666;
  border-radius: 6px;
  cursor: pointer;
  display: block;
  height: 70px;
  margin-bottom: 2px;
  overflow: hidden;
  text-align: center;
  width: 94px;
}
.html5gallery-thumbs-0 {
  width: 106px;
}
</style>




				<!--banner end-->


				</div>
				</div>

				<div class="col-sm-12" style="float: left; margin: 20px 0; z-index: 999; width:100%;">

					<div class="col-sm-8" style="float: left;">


						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Date</strong><span id="addEventDate" href="javascript:void(0);"><i class="caret"></i></span></h4>
							<h5 style="margin-top: 0px;" class="detail-date"><?php echo (empty($saptime)) ? $detail->sap[0]->time : $saptime; ?></h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Ride Type</strong></h4>
							<h5 style="margin-top: 0px;"><?php //echo str_replace('_',' ',$detail->tour->tourType);
								if(empty($detail->tour->tourTypes)){
									$RideType = str_replace('_',' ',strtolower($detail->tour->tourType));
									echo ucwords($RideType);
								}
								else{
									$tourTy = '';
									$count = count($detail->tour->tourTypes);
									$j=1;
									foreach($detail->tour->tourTypes as $tourType)
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
								}							?></h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Duration</strong></h4>
							<h5 style="margin-top: 0px;"><?php echo $detail->tour->days; ?>days</h5>
						</div>
						<div id="hiddensap" style="float:left;" ></div>
						<div class="col-sm-4" id="rating-block" style="padding: 0px 6px;">
							<h4 style="margin: 0px;"><strong>Rating</strong></h4>
							<h5 style="margin-top: 0px;"><!--?php

								$rate = $detail->tour->ratedPeople;
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

								$rate = $detail->tour->ratedPeople;
								$rateSum = $detail->tour->ratingSum;
								if(!empty($rate) && !empty($rateSum)){
									$rating = $rateSum/$rate;
									echo number_format($rating,2,'.','');
								}

								?>
								</h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin: 0px;"><strong>Destination</strong></h4>
							<h5 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $detail->tour->endPoint; ?></h5>
						</div>
					</div>
					<div class="col-sm-4 text-right" style="float: right;">
						<div class="col-sm-5 text-right">
				<h4 style="margin: 0px; color: rgb(255, 77, 77);font-size:25px;"><?php $rideprice = empty($detail->sap[0]->price) ? $detail->tour->price : $detail->sap[0]->price; $rideprice = (empty($currentSapPrice)) ? $rideprice : $currentSapPrice; echo $symbolTable[$detail->tour->currency].'<span class="updateprice original">'.round($rideprice).'</span>'; ?></h1>
							<h5 style="margin: 0px;">per ride</h5>
						</div>
						<div class="col-sm-7">
							<button type="submit" id="select_ride" class="detail_select_ride btn btn-primary btn-lg"style="background:#30769A; float:inherit;">Book it</button>
							<button type="submit" id="select_ride1" class="detail_select_ride btn btn-primary btn-lg"style="background:#30769A; margin-top:3px;">Request more details</button>
						</div>
					</div>

				</div>


				<div class="col-sm-12 description-block" style="float: left; padding: 20px; z-index: 999;font-size:15px;">
					<h4 style="margin: 0px;"><strong><?php echo $detail->tour->title; ?></strong></h4>
					<p><?php echo nl2br($detail->tour->description); ?></p>
				</div>


            </div><!--/.col-sm-8-->
            <div class="col-sm-3 top-rides-bar2">
				<div class="col-sm-12" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; border-radius: 5px; padding: 0; padding: 9px 0;">
					<h4 style="padding-left: 15px;">TOP RIDES IN YOUR REGION</h4>
	<?php //$args = array( 'posts_per_page' => 4, 'category' => 4 );
				$args = array('currencyCode' => $_SESSION['currentCurrency'], /* 'orderType' => 'ratingSum', 'order' => 'desc', */ 'startAt' => 1, 'endAt' => 10, 'date' => $saptime);
			/* 	if(!empty($detail->tour->country)){
					$args['country'] = $detail->tour->country;
				}
				 */
				$topRides = $tourObj->topRides($args);

				//$myposts = get_posts( $args );
//foreach ( $myposts as $post ) : setup_postdata( $post );
			$rd =1;
				foreach($topRides->data->tours as $ride):
				if(!empty($ride->defaultImage->image) && !empty($ride->defaultImage->thumbnail)){
							$ride->images[0] = $ride->defaultImage->image;
							$ride->thumbnails[0] = $ride->defaultImage->thumbnail;
						}
?>
				<div class="col-lg-12" style="margin-bottom: 10px;">
						<a href="<?php echo site_url();?>/detail/<?php echo $ride->tour->name; ?>/<?php echo $ride->tour->id ?>/<?php echo $ride->sap[0]->time; ?>">
				<?php if(empty($ride->thumbnails[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-size" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png">
				<?php else: ?>
				<?php if($detect->isMobile() && !$detect->isTablet()):
						if(empty($ride->thumbnails[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-size" alt="<?php echo $ride->tour->name; ?>" title="<?php echo $ride->tour->name; ?>" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png" style="width:300px">
					<?php else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-size" alt="<?php echo $ride->tour->name; ?>" title="<?php echo $ride->tour->name; ?>" style="width:300px" src="<?php echo $ride->thumbnails[0]; ?>">
						<?php endif;
						else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-size" alt="<?php echo $ride->tour->name; ?>" title="<?php echo $ride->tour->name; ?>" style="width:300px" src="<?php echo $ride->thumbnails[0]; ?>">
					<?php endif; ?>
				<?php endif; ?>



						<div class="side-bar">
							<div class="col-lg-12 text-right detail_star">
								<!--img src="<!--?php bloginfo( 'template_url' ); ?>/img/icon.png"-->
								<!--h5><!--?php
								$rating = 0;
								$ratingSum = $ride->tour->ratingSum;
								$ratedPeople = $ride->tour->ratedPeople;
								if($ratingSum > 0 && $ratedPeople > 0 ){
									$rating = $ratingSum/$ratedPeople;
								}
								$rating = empty($rating) ? '0' : $rating;
								echo $rating; ?></h5-->
							</div>
							<div class="col-lg-12 text-right detail_price">
								<h1 style="margin: 0px;font-size:25px;"><?php echo $symbolTable[$ride->tour->currency].''.round($ride->sap[0]->price); ?></h1>
								<h5 style="margin: 0px;">per ride</h5>
							</div>
							<div class="col-lg-6" >
								<h5 style="margin-bottom: 0px;margin-top:30%;"><strong><?php echo ucfirst(substr($ride->tour->title,0,40)); ?></strong></h5>
								<!--h5 style="margin-top: 0px;"><!--?php echo substr($ride->tour->description,0,40);  ?></h5-->
							</div>
							<div class="col-lg-6 text-right detail_view_ride">
						<button type="button" class="btn btn-primary btn-lg" style="background: #30769A; border: 0px none; padding: 9px;font-size:11px;font-weight:bold;margin-top:60% !important;">VIEW</button>

							</div>
						</div>
						</a>
					</div>
					<?php
					if($rd == 4){
						break;
					}
					$rd++;
					endforeach;
//wp_reset_postdata();?>

					<div class="col-lg-12 text-right">
						<a href="#"><h4 style="color:#34495E;"></h4></a>
					</div>
				</div>

				<!--img src ="<?php bloginfo( 'template_url' ); ?>/img/add3.png" style="width: 100%; padding-top: 20px;"-->

            </div>


			<div class="col-lg-12 top-rides-bar">
			<h2 style="text-align: center; color: rgb(120, 120, 120); margin-bottom: 35px;"><i class="icon-angle-down"></i> TOP RIDES IN YOUR REGION</h2>
            <div class="row scroll-pane-tours"  style="height: 269px; overflow-y: hidden; overflow-x: scroll; white-space: nowrap;">

               <?php //$args = array( 'posts_per_page' => 8, 'category' => 4 );
				//$myposts = get_posts( $args );
			/* 	require_once get_template_directory().'/inc/tourlib.php';
				$tourObj = new tourLibrary();
				$args = array('orderType' => 'ratedPeople', 'order' => 'desc', 'startAt' => 1, 'endAt' => 9);
				$topRides = $tourObj->topRides($args); */
				$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
				$rd = 1;
				foreach($topRides->data->tours as $ride):

				?>
				<div class="top-rides" style="margin-bottom: 0px; padding:1px">
					<a href="<?php echo site_url().'/detail/'.$ride->tour->name.'/'.$ride->tour->id.'/'.$ride->sap[0]->time; ?>">
					<?php if(empty($ride->thumbnails[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" title="<?php echo $detail->tour->name; ?>" alt="<?php echo $detail->tour->name; ?>"   src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png" style="width:300px; height:259px;">
					<?php else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image showimg2" alt="<?php echo $detail->tour->name; ?>" title="<?php echo $detail->tour->name; ?>" src="<?php echo $ride->thumbnails[0]; ?>" style="width:300px; height:259px;">
					<?php endif; ?>
					</a>
					<div class="side-bar" style="width:300px;">
						<div class="col-lg-12 text-right">
							<img src="<?php bloginfo( 'template_url' ); ?>/img/icon.png">
								<h5><?php
							$rating = 0;
							$ratingSum = $ride->tour->ratingSum;
							$ratedPeople = $ride->tour->ratedPeople;
							if($ratingSum > 0 && $ratedPeople > 0 ){
								$rating = $ratingSum/$ratedPeople;
							}
							$rating = empty($rating) ? '0' : $rating;
							echo $rating; ?></h5>
						</div>
						<div class="col-lg-12 text-right" style="margin-top: 55px;">
							<h1 style="margin: 0px;"><?php echo $symbolTable[$ride->tour->currency].''.round($ride->sap[0]->price); ?></h1>
							<h5 style="margin: 0px;">per ride</h5>
						</div>
						<div class="col-lg-7 col-xs-7" style="margin-top: 39px;">
							<h5 style="margin-bottom: 0px;"><strong><?php echo ucfirst(substr($ride->tour->title,0,40)); ?></strong></h5>
							<h5 style="margin-top: 0px;"><?php echo substr($ride->tour->description,0,40); ?></h5>
						</div>
						<div class="col-lg-5 col-xs-5 text-right" style="padding-top: 15px;">
							<a href="<?php echo site_url().'/detail/'.$ride->tour->name.'/'.$ride->tour->id; ?>"><button type="submit" class="btn btn-primary btn-lg" style="border: 0px none; padding: 9px; background: rgb(45, 115, 151) none repeat scroll 0% 0%;">VIEW<br/>RIDE</button></a>
						</div>
					</div>
				</div>
				<?php
				if($rd == 4){
						break;
					}
					$rd++;
				endforeach; //wp_reset_postdata();?>

            </div><!--/.row-->
        </div>





			<!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->


	</div>
</div>

<?php
$paypalURL = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; //Test PayPal API URL
$paypalID = 'jj.templatic-facilitator@gmail.com'; //Business Email
?>

<!--modal-->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="modal-body">
				<section id="contact-page" class="container" style="padding: 0px;">
					<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 4px solid rgb(0, 0, 0); padding: 20px;">

		                <div class="status alert alert-success" style="display: none"></div>
		                <form method="post">
							<h1>BOOK:<?php echo substr($detail->tour->title,0,40); echo (strlen($detail->tour->title) > 40) ? '...' : ''; ?></h1>
		                    <div class="row">
		                        <div class="col-sm-9" >
									<input type="hidden" name="option" value="1"/>
									<input type="hidden" name="task" value="bookPost"/>
		                            <div class="form-group">
		                                <input type="text" name="user_name" id="user_name" class="form-control" required="required" placeholder="Lead Name" style="width:100%;">
		                            </div>
		                            <div class="form-group">
									<input type="email" name="lead_email" id="lead_email" class="form-control" required="required" placeholder="Lead  Email address">
										<input type="hidden" id="currency" name="currency" value="<?php echo $detail->tour->currency; ?>">
										<input type="hidden" id="tour_id" name="tour_id" value="<?php echo $detail->tour->id; ?>">
		                            </div>
		                            <div class="form-group">
							<input type="text" name="participants" id="nparticipants" class="form-control" placeholder="Number of participants" style="width:100%;">

		                            </div>

									<div class="form-group">
										<textarea name="message" id="message" class="form-control" rows="8" placeholder="Note/Special requests "></textarea>
									</div>


		                        </div>
								<div class="col-lg-3">
									<div class="form-group" style="margin-bottom:5px;">
										<?php $date = $detail->sap[0]->time;

										if(!empty($date))
										{
										?>
										<div class="detail-date" style="text-align: center; border: 1px solid rgb(189, 195, 199); border-radius: 5px; padding: 13px;">
										<?php echo (empty($saptime)) ? $detail->sap[0]->time : $saptime; ?>
										<!--?php echo $detail->sap[0]->time; ?-->
										</div>
		                            </div>
									<?php } ?>
									<div class="text-center" style="background: transparent url(<?php bloginfo( 'template_url' ); ?>/img/push_icon.png) no-repeat scroll 0% 0% / 100% 100%; height: 120px; padding-top: 42px;">
										<h3 style="margin: 0px; color: rgb(255, 77, 77);"><b><?php echo $symbolTable[$detail->tour->currency]; ?> <?php $price_detail = empty($detail->sap[0]->price) ? $detail->tour->price : $detail->sap[0]->price;
										$price_detail = (empty($currentSapPrice)) ? $price_detail : $currentSapPrice;
										echo '<span class="updateprice popup">'.round($price_detail).'</span>';?></b></h3>
										<h5 style="margin: 0px;">per ride</h5>
										<input type="hidden" id="t_price_v" value="<?php echo base64_encode(round($price_detail)); ?>">
									</div>

								</div>
		                    </div>

							<input type="button" name="book_now" value="SEND" class="btn btn-danger" onclick="sendBookNow('<?php echo $detail->tour->id; ?>')" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 7px; font-size: 23px;">

		                </form>
				    </div>
				</section>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="slider-counter" value="1" />
<style>
.ui-datepicker{
	font-size:18px !important;
}
.html5gallery-car-left-0,.html5gallery-car-right-0 {
  background: #CCC none repeat scroll 0 0;
  height: 10px;
  position: absolute;
  width: 100px;
  top:0;
}
.html5gallery-car-right-0 {
	background: #CCC none repeat scroll 0 0;
  height: 10px;
  position: absolute;
  width: 100px;
	margin-top: 375px;
}
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.min.css">
<script async src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
<!--modal-->
<script>
function sendBookNow(tour_id) {
	var newhtml = '';
	var user_name = jQuery("#user_name").val();
	var lead_email = jQuery("#lead_email").val();
	var participants = jQuery("#nparticipants").val();
	var t_prc = jQuery("#t_price_v").val();
	var flag = 0;
        var date= jQuery('.detail-date').html();
        var singleprice = jQuery('.updateprice.original').html();
	if($.trim(user_name).length == 0){
		flag = 1;
		alert('Please enter lead person name.');
		return false;
	} else if($.trim(lead_email).length == 0){
		flag = 1;
		alert('Please enter lead person email address.');
		return false;
	} else if($.trim(participants) < 0){
		flag = 1;
		alert('Please enter total participants.');
		return false;
	}

	if(flag == 0){
		var book_now_url = participants+'-'+tour_id;
		window.location.href = '<?php echo site_url(); ?>/book-now/?t_p='+book_now_url+'&a='+t_prc+'&n='+user_name+'&e='+lead_email+'&pr='+singleprice+'&d='+date;
	}
}

(function( $ ) {
	$( function() {
		// An array of dates
	var selectedDays = ["<?php echo implode('","',$sapDates) ?>"];


	var selectedPrice = [<?php echo implode(',',$sapPrices) ?>];
		$('#hiddensap').datepicker({
			dateFormat: 'yy-mm-dd',
			onSelect: function(value,data){
				var priceIndex = selectedDays.indexOf(value);
				if(priceIndex > -1){
					var newprice = selectedPrice[priceIndex];
					$('.updateprice').html(newprice);
					$('.detail-date').html(value);
					$('.detail-date-input').val(value);

				}
				$('#hiddensap').hide();
				$('#rating-block').toggleClass('clear-block');
			},
			beforeShowDay: function(date){
				var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
				m = parseInt(m)+1;
				m = (m < 10) ? '0'+m : m;
				d = (d < 10) ? '0'+d : d;
				var highlight = y+'-'+m+'-'+d;
				if ($.inArray( highlight, selectedDays ) > -1) {

					 return [true, "event", highlight];
				} else {
					 return [true, '', ''];
				}
			}
		}).hide();
		$('#addEventDate').click(function(){
			$('#hiddensap').toggle();
			$('#rating-block').toggleClass('clear-block');
		});
		$("#nparticipants").change(function(){
			var participants = parseInt($(this).val());
			if(participants < 1){
				participants = 1;
			}
			var newprice = $(".updateprice.original").html();
			newprice = parseFloat(newprice);
			var finalprice = participants * newprice;
			$("#sendamount").val(finalprice);
			$(".updateprice.popup").html(finalprice);


		});
	});
	$("#custom-html5-slider").on("click",".html5gallery-car-left-0",function(){
	var setMargin = $("#slider-counter").val();
	$("#custom-html5-slider .html5gallery-thumbs-0").css({"margin-top": setMargin+"px"});
	setMargin = parseInt(setMargin) + 20;
	if(setMargin > 25){
		setMargin = 25;
	}
	$("#slider-counter").val(setMargin);
	});
	$("#custom-html5-slider").on("click",".html5gallery-car-right-0",function(){

	var setMargin = $("#slider-counter").val();
	setMargin = parseInt(setMargin) -10;
	var setheight = jQuery(".html5gallery-thumbs-0").height();
	console.log(setheight);
	$("#custom-html5-slider .html5gallery-thumbs-0").css({"margin-top": setMargin+"px"});

			if(setheight == ""){
				setheight = -10;
			}
			else{
				setheight = -setheight;
			}
	if(setMargin < setheight){
		setMargin = setheight;
	}
	$("#slider-counter").val(setMargin);
	});
})(jQuery);
function sendBookingdata(){
	var newhtml = '';
	var user_name = jQuery("#user_name").val();
	var lead_email = jQuery("#lead_email").val();
	var tour_id = jQuery("#tour_id").val();
	var currency = jQuery("#currency").val();
	var participants = jQuery("#nparticipants").val();
	var messagedata = jQuery("#message").val();
	var tourname = jQuery(".detail-tourname-input").val();
	var tourdate = jQuery(".detail-date-input").val();
	newhtml = '{"user_name": "'+user_name+'","lead_email": "'+lead_email+'","tour_id":"'+tour_id+'","currency":"'+currency+'","participants":"'+participants+'","message":"'+messagedata+'","tourname":"'+tourname+'","tourdate":"'+tourdate+'"}';

	jQuery("#customfield").val(newhtml);

}
$(window).bind("load", function() { 
    $('.ytp-mute-button').click();
});
</script>
<style>
.event a {
    background-color: #42B373 !important;
    background-image :none !important;
    color: #ffffff !important;
}
</style>
<?php
if (isset($_POST['request_detail']))
{
	//print_r($_REQUEST);
	$to = "doron@mtbdoz.com,heena.smartwinz@gmail.com,meravdoron@gmail.com";
		$subject = "contact us";
		$txt = "Hello Sir ".$_REQUEST['username']." want to ask ".$_REQUEST['message']."\r\n my email address is : ".$_REQUEST['useremail']." \r\n my phone number is : ".$_REQUEST['phone']."\r\n please reply to my email. tour details are as \r\n TOUR NAME: ".$_REQUEST[tourname]."\r\n TOUR ID: ".$_REQUEST[tourid];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers = "From: dev.smartwinzsolutions.com" . "\r\n" .
		"CC: heena.smartwinz@gmail.com";

		mail($to,$subject,$txt,$headers);
	 $url = site_url().'/detail/'.$_REQUEST[tourname].'/'.$_REQUEST[tourid].'/'.$_REQUEST[tourtime];
		wp_redirect( $url );

}

			?>

<div id="myModal1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <div class="modal-body">
				<section id="contact-page" class="container" style="padding: 0px;">
	<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 4px solid rgb(0, 0, 0); padding: 20px;">

                <div class="status alert alert-success" style="display: none"></div>
<form  method="post" action="">
					<h1>Contact Us:<?php echo substr($detail->tour->title,0,40); echo (strlen($detail->tour->title) > 40) ? '...' : ''; ?></h1>
					<h3> Tour Id:<?php echo $detail->tour->id; ?> </h3>
                 <input type="text" name="username" id="username" placeholder="Enter Your Name" style="width:100%;">
                 <input type="email" name="useremail" id="useremail" placeholder="Enter Your Email" style="width:100%;">
                 <input type="text" name="phone" id="phone" placeholder="Enter Your phone number" style="width:100%;">
				 <textarea name="message" id="message" class="form-control" rows="8" placeholder="Enter your message here"></textarea>
                  <input type="hidden" name="tourid" value="<?php echo $detail->tour->id; ?>">
                  <input type="hidden" name="tourname" value="<?php echo $detail->tour->name; ?>">
                  <input type="hidden" name="tourtime" value="<?php echo $detail->sap[0]->time; ?>">

					<input type="submit" name="request_detail" value="SEND" class="btn btn-danger">

                </form>
            </div>
</section>


            </div>
        </div>
    </div>
</div>




<?php get_footer(); ?>
