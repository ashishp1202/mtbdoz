<?php
/**
 * Template Name: HOME
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
<script async src="<?php bloginfo( 'template_url' ); ?>/js/jscrollpane-home.js"></script>


<script>
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
});
</script>

<style>
img.size-full, img.size-large, img.header-image, img.wp-post-image {
    height: auto;
    max-width: 100%;
    width: 100%;
}
.ui-datepicker{
	font-size:18px !important;
}
.homepage-video {
    position: relative;
    padding-bottom: 52%;
    padding-top: 30px; height: 0;
}

.homepage-video iframe,
.homepage-video object,
.homepage-video embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
.pading{
	padding:0 4px !important;
}
.tp-leftarrow.round {
  display: none;
}
.tp-rightarrow.round {
  display: none;
}
.home-text-region
{
	margin-top:40% !important;
}
</style>

<section id="main-slider" class="no-margin">
	<div class="carousel slide wet-asphalt">          
		<div class="carousel-inner homepage-video">				
			<div id="ytplayer"> <?php echo do_shortcode('[rev_slider rev_slider]');?>  </div>
		</div><!--/.carousel-inner-->
	</div><!--/.carousel-->
</section><!--/#main-slider-->


    <section id="services" class="emerald banner-section">
        <div class="container">
           <form  method="get" action="<?php echo site_url();?>/search">
		   <input type="hidden" name="pageNum" value="0" />
				<div class="row">
					<h3>YOUR DREAM STARTS HERE</h3>
					<div class="col-md-2 col-sm-12 background-color">
					   
						<div class="media">
							<div class="pull-left">
								<div id="icon-date"></div>
							</div>
							
						
							<div class="media-body">
								<input type="text" name="date" class="banr-input select-btn datepicker" value="<?php echo(strftime("%b %e %Y")); ?>"/>
							</div>
						</div>
						<script async src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
						<script>
						  (function( $ ) {
						  $( function() {
							var newdate = new Date();
							$( ".datepicker" ).datepicker({
								dateFormat: "M d yy",
								beforeShowDay: function(prevdate){
									console.log("works");
									if(newdate > prevdate ){
										return [true, "disableevent", ''];
									} else {
										return [true, '', ''];
									}
								},
								onSelect: function(dateText, inst){
									var dateVal = inst.currentYear+'-'+ (inst.currentMonth + 1) +'-'+inst.currentDay;
									$("#selecteddate").val(dateVal);
									//$("#icon-date").html(inst.currentDay);									
								}
							});
							//$('.scroll-pane-tours').jScrollPane({wheelSpeed: 50});
						  } );
						   })(jQuery);
						</script>
						<input type="hidden" name="selecteddate" value="<?php echo date('Y-m-d'); ?>" id="selecteddate" />
					</div>
					<div class="col-md-5 col-sm-12 background-color">
						<div class="media">
							<div class="pull-left">
								<img src ="<?php bloginfo( 'template_url' ); ?>/img/icon2.png">
							</div>
							<div class="media-body">
								<input style="color:#fff;" type="text" name="endPoint" class="banr-input select-btn" placeholder="Destination"/>
							</div>
						</div>
					</div><!--/.col-md-4-->
					<div class="col-md-3 col-sm-12 pading">
						<div class="">
							
							<div class="">
								<!-- <input class="banr-input" placeholder="Destination"/> -->
								
								<!--select class="guidetour-select ridetour selectpicker" name="tourType">
									<option value="">Ride type</option>
									<option value="">All</option>	
									<option value="ALL_MOUNTAIN">All Mountain</option>
									<option value="CROSS_COUNTRY">Cross Country</option>
									<option value="DOWNHILL">Downhill</option>
								</select>
							
							</div-->
							<div class="btn-group bootstrap-select guidetour-select block1 ridetour">
								<button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" role="button" title="Ride type"><span class="filter-option pull-left">Ride type</span>&nbsp;<span class="bs-caret"><span class="caret"></span></span>
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
									<option value="ALL_MOUNTAIN">All Mountain</option>
									<option value="CROSS_COUNTRY">Cross Country</option>
									<option value="DOWNHILL">Downhill</option>
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
					</div><!--/.col-md-4-->

				
				
				</div>
				<div class="col-md-1 col-sm-12" style="padding:8px 22px;">
						<!--button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">GO</button-->
						<input type="submit" value="GO" class="btn btn-danger button-go-1" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 10px; font-size: 19px; color:#000;border-radius:4px;font-weight:400;">
						
						
						
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
					<div class="col-md-1 col-sm-12" style="padding:8px 22px;">
						<input type="submit" name="submit" value="GO" class="btn btn-danger button-go-2" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 10px; font-size: 19px; color:#000; display:none; border-radius:4px; font-weight:400;">
					</div>
				
				</div>
			</form>
				
			<div class="col-md-12 col-sm-12" style="padding: 9px 0px;">
				<div class="advance">
					<h5 style="font-weight: normal; font-size: 17px; cursor:pointer;">Advanced <i class="fa fa-plus" id="down" aria-hidden="true"></i> <i class="fa fa-plus" aria-hidden="true" id="up" style="display:none;"></i> </h5>
				</div>
				<div class="advance2" style="display:none;">
					<h5 style="font-weight: normal; font-size: 17px;cursor:pointer;">Advanced <i class="fa fa-minus" aria-hidden="true" id="up"></i> </h5>
				</div>

			</div>
		
        </div>
    </section><!--/#services-->
	
	<script>
	(function($){
		/* 	var element = $('.banner-section'),
			originalY = element.offset().top;
		
			$(window).on('scroll', function(event) {
			var scrollTop = $(window).scrollTop();
			//console.log(scrollTop);
			if(scrollTop > 20){
				
				element.css('top', '15%');
			} else {
				
				element.css('top', '55%');
			}			
			}); */
		})(jQuery);
		
	
	</script>
	<style>
	.scroll-pane-tours .jspVerticalBar{
		display:none;
	}
	.scroll-pane-tours .jspHorizontalBar .jspDrag{
		background:rgba(0, 0, 0, 0.2);
	}
	.scroll-pane-tours .jspHorizontalBar .jspDrag {
	  background: rgba(0, 0, 0, 0.2) none repeat scroll 0 0;
	  border-radius: 9px;
	  height: 10px;
	  margin-top: 4px;
	}
	.scroll-pane-tours .jspHorizontalBar{
		background:none;
		
	}
	.scroll-pane-tours .jspTrack{
		background:#FFF;
		padding-left:3px;
	}
	.scroll-pane-tours{
		padding:0 3px !important;
	}
	#recent-works{
		background:#FFF;
	}
	.top-rides button {
	  font-size: 14px;
	}
	</style>
    <section id="recent-works">
        <div class="col-lg-12">
			<h2 style="text-align: center; color: rgb(0, 0, 0); margin-bottom: 35px;margin-top: 0;"><i class="icon-angle-down"></i> TOP RIDES</h2>
            <div class="row scroll-pane-tours"  style="height: auto; overflow-y: hidden; overflow-x: scroll; white-space: nowrap;">
				
               <?php //$args = array( 'posts_per_page' => 8, 'category' => 4 );
				//$myposts = get_posts( $args );
				require_once get_template_directory().'/inc/tourlib.php';
				$tourObj = new tourLibrary();
				$args = array('orderType' => 'id', 'order' => 'desc', 'startAt' => 1, 'endAt' => 9);
				$topRides = $tourObj->topRides($args);
				$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
				foreach($topRides->data->tours as $ride):
				$saptime = empty($ride->sap[0]->time) ? date('Y-m-d') : $ride->sap[0]->time;
					if(!empty($ride->sap[0]->price))
					{
						if(!empty($ride->defaultImage->image) && !empty($ride->defaultImage->thumbnail)){
							$ride->images[0] = $ride->defaultImage->image;
							$ride->thumbnails[0] = $ride->defaultImage->thumbnail;
						}
				?>
				<div class="top-rides" style="margin-bottom: 0px; padding:1px">
					<a href="<?php echo site_url().'/detail/'.$ride->tour->name.'/'.$ride->tour->id.'/'.$saptime; ?>">
					<?php if(empty($ride->images[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png" style="width:300px; height:259px;">
					<?php else: ?>
					<?php if($detect->isMobile()):
						if(empty($ride->thumbnails[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png" style="width:300px; height:259px;">
					<?php else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width:300px; height:259px;" src="<?php echo $ride->thumbnails[0]; ?>">
						<?php endif;
						else: ?>
						<?php if(empty($ride->thumbnails[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width:300px; height:259px;" src="<?php echo $ride->thumbnails[0]; ?>">
						<?php else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" style="width:300px; height:259px;" src="<?php echo $ride->thumbnails[0]; ?>">
						<?php endif; ?>
					<?php endif; ?>
					<?php endif; ?>

					<div class="side-bar" style="width:300px;">
						<!--div class="col-lg-12 text-right">
							<img src="<?php bloginfo( 'template_url' ); ?>/img/icon.png">
								<h5><!--?php 
							$rating = 0;
							$ratingSum = $ride->tour->ratingSum;
							$ratedPeople = $ride->tour->ratedPeople;
							if($ratingSum > 0 && $ratedPeople > 0 ){
								$rating = $ratingSum/$ratedPeople;
							}
							$rating = empty($rating) ? '0' : $rating;
							echo $rating; ?></h5>
						</div-->
						<div class="col-lg-12 text-right" style="margin-top:2%">

						
							<h1 style="margin: 0px;"><?php echo $symbolTable[$ride->tour->currency].''.$rideprice = $ride->sap[0]->price; $rideprice = ($rideprice < 0) ? 0 : $rideprice;  
							//echo  $symbolTable[$srch->tour->currency].''.round($rideprice); ?></h1>
							<h5 style="margin: 0px;">per ride</h5>
						</div>
						<div class="col-lg-7 col-xs-7 home-text-region" >
							<h5 style="margin-bottom: 0px;"><strong><?php echo ucfirst(substr($ride->tour->title,0,10)); ?></strong></h5>
							<h5 style="margin-top: 0px;"><?php echo substr($ride->tour->description,0,40); ?></h5>
						</div>
						<div class="col-lg-5 col-xs-5 text-right" style="padding-top: 66px;">
							<button type="button" class="btn btn-primary btn-lg" style="border: 0px none; padding: 9px; background: rgb(45, 115, 151) none repeat scroll 0% 0%;margin-top:60% !important;">VIEW<br/>RIDE</button>
						</div>
					</div>
					</a>
				</div>
				
					<?php }endforeach; wp_reset_postdata();?>

            </div><!--/.row-->
        </div>
    </section><!--/#recent-works-->



    <!--section id="bottom" class="wet-asphalt">
        
		<div class="row" style="padding: 55px 25px;">
			<div class="col-lg-3">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/cycle.png" style="width: 100%;">
			</div>
			<div class="col-lg-9">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/add.png" style="width: 100%; height:147px;">
			</div>
		</div>
	
    </section--><!--/#bottom-->
<?php get_footer(); ?>