<?php
/**
 * Template Name: Page: Payment Success
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<?php
	include get_template_directory_uri().'/inc/tourlib.php';

	if( isset($_REQUEST['t_p']) && $_REQUEST['t_p'] != '' ) {
		$d = explode( '-', $_REQUEST['t_p'] );
		$tour_id = $d[1];
		$total_participant = $d[0];

		$transaction_id = $_REQUEST['t'];

		$tourObj = new tourLibrary();
		$detail = $tourObj->getTourById($tour_id);
                //echo "<pre>"; print_r($detail);// exit();
                //echo "<pre>"; print_r($_SESSION); exit();
                foreach($detail->data->sap as $sap)
                {
                    if(($_SESSION['sap_date']==$sap->time) && ($_SESSION['single_price']==$sap->price) ){
                        $sapid = $sap->id;
                        $sapprice = $sap->price;
                        break;
                    }
                }
		//$total_price = $detail->data->sap[0]->price*$total_participant;
                //$total_price = $_SESSION['only_price'];
		$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
		$currency = $symbolTable[$detail->data->tour->currency];
                
                $tourid = $detail->data->tour->id;
                $sap_date = $_SESSION['sap_date'];
                $booking_date = $_SESSION['booking_date'];
                $total_price = $_SESSION['only_price'];
                $data = $tourObj->bookpostData($total_participant, $detail, $total_price, $_SESSION['lead_email'], $_SESSION['lead_name'],$sap_date ,$booking_date, $tourid, $sapid );
                //echo "<pre>"; print_r($data); exit();
?>
	<link rel="stylesheet" href="<?=get_template_directory_uri()?>/css/combine-files.css">
	<div id="main" class="wrapper">
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<!--search-->
				<section id="services" class="emerald banner-section position-ie" style="position: relative; padding:0px;">
					<div class="container">
						<div class="row">
							<h3 style="margin: 9px 0; color:#818C92;">PAYMENT SUCCESFULLY DONE</h3>
						</div>
					</div>
				</section>
	
			  	<section id="contact-page" class="container">	  
			        <div class="row" style="margin-top: 52px;">
			            <div class="col-sm-12 col-lg-9 col-md-offset-2">
			            	<h1>Thank you for booking with Mtbdoz. Your payment has been processed successfully.</h1>
			            	<h4>Here is your Booking details:</h4>
			            	<table width=600>
			            		<tr>
			            			<td><h5>Booking ID</h5></td>
			            			<td><h5><?php echo $_REQUEST['t']; ?></h5></td>
			            		</tr>
			            		<tr>
			            			<td><h5>Tour Name</h5></td>
			            			<td><h5><?php echo $_SESSION['t_name']; ?></h5></td>
			            		</tr>
			            		<tr>
			            			<td><h5>Tour Start date</h5></td>
			            			<td><h5><?php echo $_SESSION['t_date']; ?></h5></td>
			            		</tr>
			            		<tr>
			            			<td><h5>Lead name</h5></td>
			            			<td><h5><?php echo $_SESSION['lead_name']; ?></h5></td>
			            		</tr>
			            		<tr>
			            			<td><h5>Number of participants</h5></td>
			            			<td><h5><?php echo $_SESSION['total_p']; ?></h5></td>
			            		</tr>
			            		<tr>
			            			<td><h5>Payment received</h5></td>
			            			<td><h5><?php echo $_SESSION['t_price']; ?></h5></td>
			            		</tr>
			            	</table>
			            </div>
			    </section>
			</div>
		</div>
	</div>
<?php
		unset( $_SESSION['lead_name'] );
		unset( $_SESSION['total_p'] );
		unset( $_SESSION['t_price'] );
		unset( $_SESSION['t_name'] );
		unset( $_SESSION['t_date'] );
	} else {
		wp_redirect( site_url() );
		exit();
	}
?>
<?php get_footer(); ?>