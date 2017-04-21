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

get_header(); ?> 
<script src="<?php bloginfo( 'template_url' ); ?>/js/jscrollpane.js"></script>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/jscrollpane.css">

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
    padding-bottom: 56.25%;
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
	padding:0 4px;
}
</style>

<section id="main-slider" class="no-margin">
	<div class="carousel slide wet-asphalt">          
		<div class="carousel-inner homepage-video">				
			<div id="ytplayer"></div>                
		</div><!--/.carousel-inner-->
	</div><!--/.carousel-->
</section><!--/#main-slider-->
<script>
// Loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/player_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  // Replaces the 'ytplayer' element with an <iframe> and
  // YouTube player after the API code downloads.
  var player;
  function onYouTubePlayerAPIReady() {
    player = new YT.Player('ytplayer', {
        height: '380',
        width: '640',
        videoId: 'Fk_466oP63k',
        playerVars: {
          autoplay: 1,
          controls: 0,
          disablekb: 1,
          hl: 'MTBDOZ',
          loop: 1,
          modestbranding: 1,
          showinfo: 0,
		  nologo: 1,
          autohide: 1,
          color: 'white',
          iv_load_policy: 3,
          theme: 'light',
          rel: 0,
		  fs: 0
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
  }
function onPlayerStateChange(event){
	//if(event.data == YT.PlayerState.PAUSED){
		player.playVideo();
	//}
}
function onPlayerReady(event){
    player.mute();
   
}
</script>

    <section id="services" class="emerald banner-section">
        <div class="container">
           <form  method="get" action="<?php echo site_url();?>/search">
				<div class="row">
					<h3>YOUR DREAM STARTS HERE</h3>
					<div class="col-md-2 col-sm-12 background-color">
					   
						<div class="media">
							<div class="pull-left">
								<div id="icon-date"></div>
							</div>
							<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.min.css">
						
							<div class="media-body">
								<input type="text" name="date" class="banr-input select-btn datepicker" value="<?php echo(strftime("%b %e %Y")); ?>"/>
							</div>
						</div>
						<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
						<script>
						  (function( $ ) {
						  $( function() {
							$( ".datepicker" ).datepicker({
								dateFormat: "M d yy",
								onSelect: function(dateText, inst){
									var dateVal = inst.currentYear+'-'+inst.currentMonth+'-'+inst.currentDay;
									$("#selecteddate").val(dateVal);
									//$("#icon-date").html(inst.currentDay);
								}
							});
							$('.scroll-pane-tours').jScrollPane();
						  } );
						   })(jQuery);
						</script>
						<input type="hidden" name="selecteddate" id="selecteddate" />
					</div>
					<div class="col-md-5 col-sm-12 background-color">
						<div class="media">
							<div class="pull-left">
								<img src ="<?php bloginfo( 'template_url' ); ?>/img/icon2.png">
							</div>
							<div class="media-body">
								<input type="text" name="endPoint" class="banr-input select-btn" placeholder="Destination"/>
							</div>
						</div>
					</div><!--/.col-md-4-->
					<div class="col-md-3 col-sm-12 pading">
						<div class="">
							
							<div class="">
								<!-- <input class="banr-input" placeholder="Destination"/> -->
								
								<select class="guidetour-select ridetour selectpicker" name="tourType">
									<option value="">Ride type</option>
									<option value="">All</option>	
									<option value="ALL_MOUNTAIN">All Mountain</option>
									<option value="CROSS_COUNTRY">Cross Country</option>
									<option value="DOWNHILL">Downhill</option>
								</select>
							
							</div>
						</div>
					</div><!--/.col-md-4-->
					<div class="col-md-1 col-sm-12" style="padding:8px 22px;">
						<!--button class="btn btn-danger" type="button" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255);">GO</button-->
						<input type="submit" name="submit" value="GO" class="btn btn-danger button-go-1" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 10px; font-size: 19px; color:#000;border-radius:4px;font-weight:400;">
						
						
						
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
								
								<select class="guidetour-select selectpicker" name="guidedTour" required> 
									<option> Guided </option>
									<option> Any</option>
									<option>Guided</option>
									<option> Self-guided</option>
								</select>
									
								
							</div>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-12 pading">
						<div class="">
							
							<div class="">
								<!-- <input class="banr-input" placeholder="Destination"/> -->
								<select class="guidetour-select selectpicker" name="days" required> 
									<option> Duration </option>
									<option> Any</option>
									<option>Single day</option>
									<option>1-7 days</option>
									<option>8 days and above</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-12 pading">
						<div class="">
							
							<div class="">
								<!-- <input class="banr-input" placeholder="Destination"/> -->
								<select class="guidetour-select selectpicker" name="difficultyLevel" required> 
									<option>Difficulty level</option>
									<option>Any</option>
									<option>Easy</option>
									<option>Medium</option>
									<option>Difficult</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="col-md-2 col-sm-12 pading">
						<div class="">
						   
							<div class="">
								<!-- <input class="banr-input" placeholder="Destination"/> -->
								<select class="guidetour-select selectpicker" name="hiredBikes" required> 
									<option> Hired bike </option>
									<option>Any</option>
									<option>Hired</option>
									<option>Own</option>
								</select>
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
		padding:0 25px !important;
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
			<h2 style="text-align: center; color: rgb(120, 120, 120); margin-bottom: 35px;"><i class="icon-angle-down"></i> TOP RIDES IN YOUR REGION</h2>
            <div class="row scroll-pane-tours"  style="height: auto; overflow-y: hidden; overflow-x: scroll; white-space: nowrap;">
				
               <?php //$args = array( 'posts_per_page' => 8, 'category' => 4 );
				//$myposts = get_posts( $args );
				require_once get_template_directory().'/inc/tourlib.php';
				$tourObj = new tourLibrary();
				$args = array('orderType' => 'ratedPeople', 'order' => 'desc', 'startAt' => 1, 'endAt' => 9);
				$topRides = $tourObj->topRides($args);
				$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
				foreach($topRides->data->tours as $ride):
				?>
				<div class="top-rides" style="margin-bottom: 0px; padding:1px">
					<a href="<?php echo site_url().'/detail?id='.$ride->tour->id; ?>">
					<?php if(empty($ride->images[0])): ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png" style="width:300px">
					<?php else: ?>
						<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $ride->images[0]; ?>">
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
							<h1 style="margin: 0px;"><?php echo $symbolTable[$ride->tour->currency].''.$ride->tour->price; ?></h1>
							<h5 style="margin: 0px;">per ride</h5>
						</div>
						<div class="col-lg-7" style="margin-top: 39px;">
							<h5 style="margin-bottom: 0px;"><strong><?php echo ucfirst($ride->tour->title); ?></strong></h5>
							<h5 style="margin-top: 0px;"><?php echo $ride->tour->description; ?></h5>
						</div>
						<div class="col-lg-5 text-right" style="padding-top: 15px;">
							<a href="<?php echo site_url().'/detail?id='.$ride->tour->id; ?>"><button type="submit" class="btn btn-primary btn-lg" style="border: 0px none; padding: 9px; background: rgb(45, 115, 151) none repeat scroll 0% 0%;">VIEW<br/>RIDE</button></a>
						</div>
					</div>
				</div>
				<?php endforeach; wp_reset_postdata();?>

            </div><!--/.row-->
        </div>
    </section><!--/#recent-works-->



    <section id="bottom" class="wet-asphalt">
        
		<div class="row" style="padding: 55px 25px;">
			<div class="col-lg-3">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/cycle.png" style="width: 100%;">
			</div>
			<div class="col-lg-9">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/add.png" style="width: 100%; height:147px;">
			</div>
		</div>
	
    </section><!--/#bottom-->
<?php get_footer(); ?>