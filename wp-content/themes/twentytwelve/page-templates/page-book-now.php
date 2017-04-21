<?php
/**
 * Template Name: Page: Book Now
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
	//ob_clean();
	include get_template_directory_uri().'/inc/tourlib.php';

	// Set sandbox (test mode) to true/false.
	$sandbox = get_option( 'paypal_sandbox' ) > 0 ? TRUE : FALSE;

	// Set PayPal API version and credentials.
	$api_version = '85.0';
	$api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';
	$api_username = get_option( 'paypal_username' );
	$api_password = get_option( 'paypal_password' );
	$api_signature = get_option( 'paypal_signature');
	$paypal_email =get_option('paypal_email');

	$paypalURL = $sandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
	$paypalID = get_option( 'paypal_email' );

	if( isset( $_REQUEST['pay_now'] ) && $_REQUEST['pay_now'] == "Pay Now" ) {

		$d = explode( '-', $_REQUEST['t_p'] );

		$tour_id = $d[1];
		$total_participant = $d[0];

		$t_tourObj = new tourLibrary();
		$t_detail = $t_tourObj->getTourById($tour_id);

		$firstName = urlencode( $_POST['n'] );
		$creditCardType = urlencode( $_POST['creditCardType'] );
		$creditCardNumber = urlencode($_POST['creditCardNumber'] );
		$expDateMonth = urlencode( $_POST['expDateMonth'] );

		// Month must be padded with leading zero
		$padDateMonth = str_pad( $expDateMonth, 2, '0', STR_PAD_LEFT );

		$expDateYear =urlencode( $_POST['expDateYear'] );
		$cvv2Number = urlencode( $_POST['cvv2Number'] );
		$amount = urlencode( $_POST['amount'] );
		$currencyCode=urlencode( $_POST['currency'] );


		// Store request params in an array
		$request_params = array(
            'METHOD' => 'DoDirectPayment',
            'USER' => $api_username,
            'PWD' => $api_password,
            'SIGNATURE' => $api_signature,
            'VERSION' => $api_version,
            'PAYMENTACTION' => 'Sale',
            'IPADDRESS' => $_SERVER['REMOTE_ADDR'],
            'CREDITCARDTYPE' => $creditCardType,
            'ACCT' => $creditCardNumber,
            'EXPDATE' => $padDateMonth.$expDateYear,
            'CVV2' => $cvv2Number,
            'FIRSTNAME' => 'EYAL',
            'LASTNAME' => 'SADEH',
            'STREET' => $t_detail->data->tour->title,
            'CITY' => 'Houston',
            'STATE' => 'AK',
            'COUNTRYCODE' => 'IN',
            'ZIP' => '77001',
            'AMT' => $amount,
            'CURRENCYCODE' => $currencyCode,
            'DESC' => $t_detail->data->tour->title
        );

        // Loop through $request_params array to generate the NVP string.
		$nvp_string = '';
		foreach( $request_params as $var => $val ) {
		    $nvp_string .= '&'.$var.'='.urlencode( $val );
		}

		// Send NVP string to PayPal and store response
		$curl = curl_init();
        curl_setopt( $curl, CURLOPT_VERBOSE, 1 );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $curl, CURLOPT_TIMEOUT, 30 );
        curl_setopt( $curl, CURLOPT_URL, $api_endpoint );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $nvp_string );

		$result = curl_exec( $curl );
		curl_close( $curl );

		// Parse the API response
		$payment_response = NVPToArray( $result );

		// Function to convert NTP string to an array
		if( $payment_response['ACK'] == 'Success' ) { //Request successful
      		$success_url = site_url().'/payment-success/?t_p='.$_REQUEST['t_p'].'&t='.$payment_response['TRANSACTIONID'];
      		echo '<script>window.location = '."'".$success_url."'".';</script>';
		} else if( $payment_response['ACK'] == 'Failure' ) { //Request failure
			$failure_url = site_url().'/payment-failure/?t_p='.$_REQUEST['t_p'].'&e='.$payment_response['L_ERRORCODE0'];
      		echo '<script>window.location = '."'".$failure_url."'".';</script>';
		}
	}

	// Function to convert NTP string to an array
	function NVPToArray( $NVPString ) {
	    $proArray = array();
	    while( strlen( $NVPString ) ) {
	        // name
	        $keypos= strpos( $NVPString, '=' );
	        $keyval = substr( $NVPString, 0, $keypos );
	        // value
	        $valuepos = strpos( $NVPString, '&' ) ? strpos( $NVPString, '&' ) : strlen( $NVPString );
	        $valval = substr( $NVPString, $keypos+1, $valuepos-$keypos-1 );
	        // decoding the respose
	        $proArray[ $keyval ] = urldecode( $valval );
	        $NVPString = substr( $NVPString, $valuepos+1, strlen( $NVPString ) );
	    }
	    return $proArray;
	}

	if( isset($_REQUEST['t_p']) && $_REQUEST['t_p'] != '' ) {
		global $wpdb;

		$d = explode( '-', $_REQUEST['t_p'] );
		$tour_id = $d[1];
		$total_participant = $d[0];

		$tourObj = new tourLibrary();
		$detail = $tourObj->getTourById($tour_id);
		$total_price = $_REQUEST['pr']*$total_participant;
		$symbolTable = array('USD' => '$', 'GBP' => '£', 'EUR' => '€');
		$currency = $symbolTable[$detail->data->tour->currency];

		$_SESSION['lead_name'] = $_REQUEST['n'];
                $_SESSION['booking_date'] = date('Y-m-d');
                $_SESSION['sap_date'] = $_REQUEST['d'];
                $_SESSION['lead_email'] = $_REQUEST['e'];
		$_SESSION['total_p'] = $total_participant;
		$_SESSION['t_price'] = $currency.$total_price;
                $_SESSION['only_price'] = $total_price;
                $_SESSION['single_price'] = $_REQUEST['pr'];
		$_SESSION['t_name'] = $detail->data->tour->title;
		$_SESSION['t_date'] = $detail->data->sap[0]->time;
                //echo "<pre>";print_r($_SESSION); exit();
?>
	<link rel="stylesheet" href="<?=get_template_directory_uri()?>/css/combine-files.css">
	<div id="main" class="wrapper">
		<div id="primary" class="site-content">
			<div id="content" role="main">
				<!--search-->
				<section id="services" class="emerald banner-section position-ie" style="position: relative; padding:0px;">
					<div class="container">
						<div class="row">
							<h3 style="margin: 9px 0; color:#818C92;">BOOK YOUR RIDE</h3>
						</div>
					</div>
				</section>

			  	<section id="contact-page" class="container">
			        <div class="row" style="margin-top: 52px;">
			            <div class="col-sm-12 col-lg-9">
			            	<h4 style="margin: 0px;"><strong>Tour details: </strong></h4>
			            	<table width=600>
								<tr>
									<td align=right><h5>Tour Name:</h5></td>
									<td><h5><?php echo $detail->data->tour->title; ?></h5></td>
								</tr>
								<tr>
									<td align=right><h5>Tour Date:</h5></td>
									<td><h5><?php echo $_REQUEST['d']; ?></h5></td>
								</tr>
								<tr>
									<td align=right><h5>Tour Price:</h5></td>
									<td><h5><?php echo $_REQUEST['pr']; ?></h5></td>
								</tr>
								<tr>
									<td align=right><h5>Total Participant:</h5></td>
									<td><h5><?php echo $total_participant; ?></h5></td>
								</tr>
								<tr>
									<td align=right><h5>Final Price:</h5></td>
									<td><h5><?php echo $currency.$_REQUEST['pr']; ?> x <?php echo $total_participant; ?> = <?php echo $currency.$total_price; ?></h5></td>
								</tr>
							</table>
			            	<br/>
			            	<hr/>
			            	<h2>Pay by : </h2>
			            	<label><input type="radio" name="payment_by" value="Paypal" id="paypal" class="payment_by">Paypal</label>&nbsp;&nbsp;
							<label><input type="radio" name="payment_by" value="CDCard" id="cd_card" class="payment_by">Credit/Debit Card</label>
			            	<br/>
			            	<hr/>
			            	<div id="Paypal" class="payment_form" style="display: none;">
			            		<form method="post" action="<?php echo $paypalURL; ?>">
			            			<input type="submit" name="submit" value="Pay using Paypal" class="btn btn-danger" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%; border: medium none rgb(77, 194, 255); padding: 7px; font-size: 23px;">
									<input name="cmd" value="_cart" type ="hidden">
									<input type="hidden" name="business" value="<?php echo $paypalID; ?>">

									<!-- Specify details about the item that buyers will purchase. -->
							        <input type="hidden" name="item_name_1" value="<?php echo $detail->data->tour->title; ?>">
							        <input type="hidden" name="amount_1" id="sendamount" value="<?php echo round( $total_price ) ; ?>">
							        <input type="hidden" name="currency_code" value="<?php echo $detail->data->tour->currency; ?>">
									<input name="upload" value="1" type ="hidden">
									<input name="quantity_1" value="1" type ="hidden">
									<input name="tax" value="0" type="hidden">
									<input type="hidden" name="bn" value="PP-BuyNowBF">
									<input type="hidden" name="return" value="<?php echo site_url().'/payment-success/?t_p='.$_REQUEST['t_p'].'&type=PayPal'; ?>">
									<input type="hidden" name="cancel_return" value="<?php echo site_url().'/payment-failure/?t_p='.$_REQUEST['t_p']; ?>">
				                </form>
			            	</div>
			            	<div id="CDCard" class="payment_form" style="display: none;">
				            	<h4 style="margin: 0px;"><strong>Payment details: </strong></h4>
				            	<form method="POST" name="DoDirectPaymentForm" onsubmit="return checkPaymentForm();">
					            	<input type=hidden name=paymentType value="Sale" />
					            	<input type=hidden name=amount value="<?php echo round( $total_price ); ?>">
					            	<input type=hidden name=currency value="<?php echo $detail->data->tour->currency; ?>">
									<table width=600>

										<tr>
											<td align=right>Card Type:</td>
											<td align=left>
												<select name=creditCardType id="creditCardType">
													<option value=Visa selected>Visa</option>
													<option value=MasterCard>MasterCard</option>
													<option value=Discover>Discover</option>
													<option value=Amex>American Express</option>
												</select>
											</td>
										</tr>
										<tr>
											<td align=right>Card Number:</td>
											<td align=left><input type=text size=16 maxlength=16 name=creditCardNumber id="creditCardNumber"></td>
										</tr>
										<tr>
											<td align=right>Expiration Date:</td>
											<td align=left><p>
												<select name=expDateMonth id="expDateMonth">
													<?php
														for ($i=1; $i <= 12 ; $i++) {
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													?>
												</select>
												<select name=expDateYear id="expDateYear">
													<?php
														for ($i=date('Y'); $i<=2035; $i++) {
															echo '<option value="'.$i.'">'.$i.'</option>';
														}
													?>
												</select>
											</p></td>
										</tr>
										<tr>
											<td align=right>Card Verification Number:</td>
											<td align=left><input type=text size=3 maxlength=4 name=cvv2Number id="cvv2Number"></td>
										</tr>
										<tr>
											<td/>
											<td><input type=Submit name="pay_now" value="Pay Now" class="btn btn-primary" style="background: rgb(77, 194, 255) none repeat scroll 0% 0%;border: medium none rgb(77, 194, 255);height: 40px;font-size: 13px;color: white;"></td>
										</tr>
									</table>
								</form>
							</div>
			            </div>
			        </div>
			    </section>
			</div>
		</div>
	</div>
	<script language="javascript">
		jQuery(document).ready( function(){
			jQuery('.payment_by').on('change', function() {
			   var payment_by = jQuery('input[name=payment_by]:checked').val();
			   jQuery( '.payment_form' ).hide();
			   jQuery( '#'+payment_by ).show();
			});
		});
		function checkPaymentForm(){
			var creditCardNumber = jQuery("#creditCardNumber").val();
			var creditCardType = jQuery("#creditCardType").val();
			var expDateMonth = jQuery("#expDateMonth").val();
			var expDateYear = jQuery("#expDateYear").val();
			var cvv2Number = jQuery("#cvv2Number").val();
			var flag = 0;
			if($.trim(creditCardNumber).length == 0){
				flag = 1;
				alert('Please enter card number.');
				return false;
			} else if($.trim(creditCardType).length == 0){
				flag = 1;
				alert('Please select card type.');
				return false;
			} else if($.trim(expDateMonth) < 0){
				flag = 1;
				alert('Please select expiry month.');
				return false;
			} else if($.trim(expDateYear) < 0){
				flag = 1;
				alert('Please select expiry year.');
				return false;
			} else if($.trim(cvv2Number) < 0){
				flag = 1;
				alert('Please enter cvv number.');
				return false;
			}

			if( flag == 0 ) {
				return true;
			} else {
				return false;
			}
		}
	</script>
<?php
	} else {
		wp_redirect( site_url() );
		exit();
	}
?>
<?php get_footer(); ?>

