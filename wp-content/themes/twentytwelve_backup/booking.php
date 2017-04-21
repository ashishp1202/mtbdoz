<?php
/*
Template Name: Booking Details
*/
get_header();
?>
<div id="primary" class="site-content sign_bg">
<div id="content">
<div class="container">
<?php 
$bookpost = urldecode(stripslashes($_REQUEST['custom']));
$status = strtolower($_REQUEST['payment_status']);

#$status = "completed";
#$bookpost = '{"user_name": "test458","lead_email": "dsds@yopmail.com","tour_id":"220","currency":"USD","participants":"1","message":"dsdsds"}';
if($status == 'completed'){
	
	 $bookpost = json_decode($bookpost,true);
	 require_once get_template_directory().'/inc/tourlib.php';
	$tourObj = new tourLibrary();
	$tour_det = $tourObj->getTourById($bookpost['tour_id']);
	$tour_data = $tour_det->data;
	//echo "<pre>";print_r($tour_data->sap);exit();
	//echo $tour_data->sap[0]->id; exit();
	//echo "<pre>";print_r($tour_det);exit();
	//print_r($bookpost);
	 $full_name = $bookpost['user_name'];
	 $transaction_id = $_REQUEST['txn_id'];
	 $transaction_date = $bookpost['tourdate'];
	 $status = $_REQUEST['payment_status'];
	$amount = $_REQUEST['payment_gross'];
	 $email = $bookpost['lead_email'];
	 $tour_number = $bookpost['tour_id'];
	 $participants = $bookpost['participants'];
	 $sapId = $tour_data->sap[0]->id;
	$sql = "INSERT INTO payment (name, transaction_id, date, status, amount, participants, email, tour_number)
VALUES ('$full_name', '$transaction_id', '$transaction_date','$status','$amount','$participants','$email','$tour_number');";
$result = mysql_query($sql);
	
?>
<h3>Please wait while processing...</h3>
<form id="confirmbooking" method="post" enctype="multipart/form-data" action="<?php site_url(); ?>?option=1&task=bookPost">
<input type="hidden" name="user_name" value="<?php echo $bookpost['user_name']; ?>" >
<input type="hidden" name="currency" value="<?php echo $bookpost['currency']; ?>" >
<input type="hidden" name="lead_email" value="<?php echo $bookpost['lead_email']; ?>" >
<input type="hidden" name="tour_id" value="<?php echo $bookpost['tour_id']; ?>" >
<input type="hidden" name="tourname" value="<?php echo $bookpost['tourname']; ?>" >
<input type="hidden" name="tourdate" value="<?php echo $bookpost['tourdate']; ?>" >
<input type="hidden" name="sapid" value="<?php echo $sapId; ?>" >
<input type="submit" style="display:none;" />
</form>
<script>
window.onload = function(){
	
	document.getElementById('confirmbooking').submit();
};
</script>
<?php	
} else {
	?>
	<h3>Payment is not successfull. Please try again.</h3>
	
	<?php 	
}
?>
</div>
</div>
</div>
<?php 
get_footer();
?>