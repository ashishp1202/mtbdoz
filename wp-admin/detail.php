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

get_header(); ?>
<style>
img.size-full, img.size-large, img.header-image, img.wp-post-image {
    height: 150px;
    max-width: 100%;
    width: 100%;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<script type="text/javascript">
	$(document).ready(function(){
		$("#select_ride").click(function(){
		$("#myModal").modal('show');
		});
	});
</script>


<div id="primary" class="site-content">
	<div id="content" role="main">
<?php
	
require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$detail = $tourObj->tour_detail();
//$detail = $detail->tours;
//print_r($detail);
?>
	<?php 
	if($_SESSION['tourMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong>Success!</strong> Tour created succesfully</div>
	<?php 
			unset($_SESSION['tourMessage']);
	} ?>
	<?php 
	if($_SESSION['tourbookMessage']){ ?>
	<div class="alert alert-success fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $_SESSION['tourbookMessage']; ?></div>
	<?php 
			unset($_SESSION['tourbookMessage']);
	} ?>
		  <section id="contact-page" class="container">
        <div class="row">
            <div class="col-sm-8">
				<div class="col-lg-12">
				
				<!--banner start-->
							
		    <script type="text/javascript" src="<?php bloginfo( 'template_url' ); ?>/js/jssor.slider-21.1.5.min.js"></script>
    <!-- use jssor.slider-21.1.5.debug.js instead for debug -->
    <script>
        jssor_1_slider_init = function() {
            
            var jssor_1_options = {
              $AutoPlay: true,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Cols: 4,
                $SpacingX: 4,
                $SpacingY: 4,
                $Orientation: 2,
                $Align: 0,
				$Loop: 0 
              }
            };
            
            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            
            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 810);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>

    <style>
        
       
        .jssora02l, .jssora02r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 55px;
            height: 55px;
            cursor: pointer;
            background: url('img/a02.png') no-repeat;
            overflow: hidden;
        }
        .jssora02l { background-position: -3px -33px; }
        .jssora02r { background-position: -63px -33px; }
        .jssora02l:hover { background-position: -123px -33px; }
        .jssora02r:hover { background-position: -183px -33px; }
        .jssora02l.jssora02ldn { background-position: -3px -33px; }
        .jssora02r.jssora02rdn { background-position: -63px -33px; }
.jssort11 .p {    position: absolute;    top: 0;    left: 0;    width: 200px;    height: 69px;    background: #181818;}.jssort11 .tp {    position: absolute;    top: 0;    left: 0;    width: 100%;    height: 100%;    border: none;}.jssort11 .i, .jssort11 .pav:hover .i {    position: absolute;    top: 3px;    left: 3px;    width: 192px;    height: 62px;    border: white 1px dashed;}* html .jssort11 .i {    width /**/: 62px;    height /**/: 32px;}.jssort11 .pav .i {    border: white 1px solid;}.jssort11 .t, .jssort11 .pav:hover .t {    position: absolute;    top: 3px;    left: 68px;    width: 129px;    height: 32px;    line-height: 32px;    text-align: center;    color: #fc9835;    font-size: 13px;    font-weight: 700;}.jssort11 .pav .t, .jssort11 .p:hover .t {    color: #fff;}.jssort11 .c, .jssort11 .pav:hover .c {    position: absolute;    top: 38px;    left: 3px;    width: 194px;    height: 32px;    line-height: 32px;    color: #fff;    font-size: 11px;    font-weight: 400;    overflow: hidden;}.jssort11 .pav .c, .jssort11 .p:hover .c {    color: #fc9835;}.jssort11 .t, .jssort11 .c {    transition: color 2s;    -moz-transition: color 2s;    -webkit-transition: color 2s;    -o-transition: color 2s;}.jssort11 .p:hover .t, .jssort11 .pav:hover .t, .jssort11 .p:hover .c, .jssort11 .pav:hover .c {    transition: none;    -moz-transition: none;    -webkit-transition: none;    -o-transition: none;}.jssort11 .p:hover, .jssort11 .pav:hover {    background: #333;}.jssort11 .pav, .jssort11 .p.pdn {    background: #462300;}
        
    </style>


    <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 810px; height: 300px; overflow: hidden; visibility: hidden; background-color: #000000;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 600px; height: 300px; overflow: hidden;">
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?php bloginfo( 'template_url' ); ?>/img/banner4.png" />
                <div data-u="thumb">
                    <img class="i" src="<?php bloginfo( 'template_url' ); ?>/img/banner4.png" />
                   
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?php bloginfo( 'template_url' ); ?>/img/banner.png" />
                <div data-u="thumb">
                    <img class="i" src="<?php bloginfo( 'template_url' ); ?>/img/banner.png" />
                    
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?php bloginfo( 'template_url' ); ?>/img/banner1.png" />
                <div data-u="thumb">
                    <img class="i" src="<?php bloginfo( 'template_url' ); ?>/img/banner1.png" />
                   
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?php bloginfo( 'template_url' ); ?>/img/banner2.png" />
                <div data-u="thumb">
                    <img class="i" src="<?php bloginfo( 'template_url' ); ?>/img/banner2.png" />
                </div>
            </div>
            <div data-p="112.50" style="display: none;">
                <img data-u="image" src="<?php bloginfo( 'template_url' ); ?>/img/banner3.png" />
                <div data-u="thumb">
                    <img class="i" src="<?php bloginfo( 'template_url' ); ?>/img/banner3.png" />
                </div>
            </div>
            <a data-u="add" href="http://www.jssor.com/demos/list-slider.slider" style="display:none">List Slider</a>
        
        </div>
        <!-- Thumbnail Navigator -->
        <div data-u="thumbnavigator" class="jssort11" style="position:absolute;right:5px;top:0px;font-family:Arial, Helvetica, sans-serif;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;user-select:none;width:200px;height:300px;" data-autocenter="2">
            <!-- Thumbnail Item Skin Begin -->
            <div data-u="slides" style="cursor: default;">
                <div data-u="prototype" class="p">
                    <div data-u="thumbnailtemplate" class="tp"></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora02l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora02r" style="top:0px;right:218px;width:55px;height:55px;" data-autocenter="2"></span>
		
    </div>
    <script>
        jssor_1_slider_init();
    </script>

				<!--banner end-->
					
					
				</div>
				
				
				<div class="col-sm-12" style="float: left; padding: 20px 0; z-index: 999;">
					
					<div class="col-sm-8">
						
						
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Date</strong></h4>
							<h5 style="margin-top: 0px;"><?php echo $detail->sap[0]->time; ?></h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Ride Type</strong></h4>
							<h5 style="margin-top: 0px;"><?php echo $detail->tour->tourType; ?></h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin-bottom: 0px;"><strong>Duration</strong></h4>
							<h5 style="margin-top: 0px;"><?php echo $detail->tour->days; ?>days</h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin: 0px;"><strong>Rating</strong></h4>
							<h5 style="margin-top: 0px;"><?php 
								
								$rate = $detail->tour->ratedPeople;
								if($rate == 0)
								{
								echo "NO RATING";
								}
								else
								{
								for($i=1; $i<=$rate; $i++)
								{
								echo"*";
								}
								}
								
								
								?></h5>
						</div>
						<div class="col-sm-4" style="padding: 0px 6px;">
							<h4 style="margin: 0px;"><strong>Destination</strong></h4>
							<h5 style="margin-top: 0px; margin-bottom: 0px;"><?php echo $detail->tour->endPoint; ?></h5>
						</div>
					</div>
					<div class="col-sm-4 text-right">
						<div class="col-sm-5 text-right">
				<h4 style="margin: 0px; color: rgb(255, 77, 77);"><?php echo $detail->tour->currency.' '.$detail->tour->price; ?></h1>
							<h5 style="margin: 0px;">per ride</h5>
						</div>
						<div class="col-sm-7 text-right">
							<button type="submit" id="select_ride" class="btn btn-primary btn-lg">SELECT<br/>RIDE</button>
						</div>
					</div>
                
				</div>
				
				<div class="col-sm-12" style="float: left; padding: 20px 0; z-index: 999;">
					<h4 style="margin: 0px;"><strong><?php echo $detail->tour->title; ?></strong></h4>
					<p><?php echo $detail->tour->description; ?></p>
				</div>
				
				
            </div><!--/.col-sm-8-->
            <div class="col-sm-4">
				<div class="col-sm-12" style="background: rgb(241, 241, 241) none repeat scroll 0% 0%; border-radius: 5px; padding: 0; padding: 9px 0;">
					<h4 style="padding-left: 15px;">TOP RIDES IN THE REGION</h4>
	<?php //$args = array( 'posts_per_page' => 4, 'category' => 4 );
				$args = array('orderType' => 'ratingSum', 'order' => 'desc', 'startAt' => 1, 'endAt' => 5);
				$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
				$topRides = $tourObj->topRides($args);
				
				//$myposts = get_posts( $args );
//foreach ( $myposts as $post ) : setup_postdata( $post ); 
				foreach($topRides->data->tours as $ride):	
				
?>				
					<div class="col-lg-12" style="margin-bottom: 10px;">
						<a href="<?php echo site_url().'?detail='.$ride->tour->id; ?>">
						<?php if(empty($ride->images[0])): ?>
							<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php bloginfo( 'template_url' ); ?>/img/img-tmp.png">
						<?php else: ?>
							<img class="attachment-post-thumbnail size-post-thumbnail wp-post-image" src="<?php echo $ride->images[0]; ?>">
						<?php endif; ?>
						
						</a>
						<div class="side-bar">
							<div class="col-lg-12 text-right">
								<img src="<?php bloginfo( 'template_url' ); ?>/img/icon.png">
								<h5><?php echo $ride->tour->ratingSum; ?></h5>
							</div>
							<div class="col-lg-12 text-right">
								<h1 style="margin: 0px;font-size:25px;"><?php echo $symbolTable[$ride->tour->currency].''.$ride->tour->price; ?></h1>
								<h5 style="margin: 0px;">per ride</h5>
							</div>
							<div class="col-lg-6" >
								<h5 style="margin-bottom: 0px;"><strong><?php echo ucfirst($ride->tour->title); ?></strong></h5>
								<h5 style="margin-top: 0px;"><?php echo $ride->tour->description;  ?></h5>
							</div>
							<div class="col-lg-6 text-right">
						<a href="<?php echo site_url().'?detail='.$ride->tour->id; ?>"><button type="button" class="btn btn-primary btn-lg" style="background: #4bc2ff; border: 0px none; padding: 9px;font-size:11px;font-weight:bold;">VIEW<br/> RIDE</button></a>
						
							</div>
						</div>
					</div>
					<?php endforeach; 
//wp_reset_postdata();?>								
					
					<div class="col-lg-12 text-right">
						<a href="#"><h4 style="color:#34495E;"></h4></a>
					</div>
				</div>
				
				<img src ="<?php bloginfo( 'template_url' ); ?>/img/add3.png" style="width: 100%; padding-top: 20px;">
				
            </div>
			
			<!--/.col-sm-4-->
        </div>
    </section><!--/#contact-page-->


	</div>
</div>


<!--modal-->
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">BOOK</h4>
            </div>
            <div class="modal-body">
				<section id="contact-page" class="container">
	<div class="col-sm-12" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(204, 204, 204); padding: 20px;">
				
                <div class="status alert alert-success" style="display: none"></div>
                <form  name="form1" method="get" action="<?php echo site_url(); ?>">
					<h1>BOOK:<?php echo $detail->tour->title; ?></h1>
                    <div class="row">
                        <div class="col-sm-9" >
							<input type="hidden" name="option" value="1"/>
							<input type="hidden" name="task" value="bookPost"/>
                            <div class="form-group">
                                <input type="text" name="user_name" class="form-control" required="required" placeholder="Lead Name" style="width:100%;">
                            </div>
                            <div class="form-group">
							<input type="email" name="lead_email" class="form-control" required="required" placeholder="Lead  Email address">
								<input type="hidden" name="currency" value="<?php echo $detail->tour->currency; ?>">
								<input type="hidden" name="tour_id" value="<?php echo $detail->tour->id; ?>">
                            </div>
                            <div class="form-group">
					<input type="text" name="participants" class="form-control" placeholder="Number of participants" style="width:100%;">
                                
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
								<div style="text-align: center; border: 1px solid rgb(189, 195, 199); border-radius: 5px; padding: 13px;"> <?php echo $detail->sap[0]->time; ?> </div>
                            </div>
							<?php } ?>
							<div class="text-center" style="background: transparent url(<?php bloginfo( 'template_url' ); ?>/img/push_icon.png) no-repeat scroll 0% 0% / 100% 100%; height: 120px; padding-top: 42px;">
								<h1 style="margin: 0px; color: rgb(255, 77, 77);"><?php echo $detail->tour->currency; ?> <?php echo empty($detail->sap[0]->price) ? $detail->tour->price : $detail->sap[0]->price; ?></h1>
								<h5 style="margin: 0px;">per ride</h5>
							</div>
							
						</div>
                    </div>
					<input type="submit" name="submit" value="SEND" class="btn btn-danger" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 7px; font-size: 23px;">
                </form>
            </div>
</section>

                
            </div>
        </div>
    </div>
</div>

<!--modal-->


<?php get_footer(); ?>
