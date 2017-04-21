<?php
/**
 * Template Name: Operator Listing
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



require_once get_template_directory().'/inc/tourlib.php';
$tourObj = new tourLibrary();
$is_admin = $tourObj->checkIsAdmin();
if($is_admin == 'error'){
	wp_safe_redirect( site_url('operator-info') );
}
$operator_details = $tourObj->getOperatorList();


//echo "<pre>"; print_r($operator_details->object); exit();
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
					<li style="border-left: 6px solid rgb(187, 226, 104);"><a href="<?php echo site_url();?>/tour-booking-info/"><!--<img src="<?php //bloginfo( 'template_url' ); ?>/img/calendar-icon-1.png">-->Bookings</a></li>
					<?php 
if($is_admin == 'success'){?>
					<li style="background: rgb(100, 163, 196) none repeat scroll 0% 0%; border-left: 5px solid rgb(100, 163, 196);"><a href="<?php echo site_url();?>/operator-listing/">Operator Listing</a></li>
<?php }?>
                </ul>
			</div>
            
            <div class="col-sm-8">
			<?php if(!empty($operator_details)){?>
				<table class="booking-listing">
					<tbody>
						<tr><th>#</th><th>Operator Name</th><th>Operator Email</th><th>Operator Status</th></tr>
						<?php $i=1;
						
						
						foreach($operator_details->object as $operator_detail){
							//echo "<pre>";print_r($operator_detail);exit();
								
								$class='';
								if($i%2!=0)
								{
									$class="dark";
								}
						?>
						<tr class="<?php echo $class;?>"><td><?php echo $i;?></td><td><?php echo $operator_detail->name;?></td><td><?php echo $operator_detail->email;?></td>
						<td>
							<select name="op_status" class="op_status" data-op-id="<?php echo $operator_detail->id;?>">
							<option <?php if($operator_detail->status == 'ACTIVE') echo "selected";?> value="ACTIVE">Active</option>
							<option <?php if($operator_detail->status == 'INACTIVE') echo "selected";?> value="INACTIVE">Inactive</option>
							</select>
						</td></tr>
							<?php $i++;
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
jQuery('.op_status').change(function(){
	var opId = jQuery(this).attr('data-op-id');
	var status = jQuery(this).val();
	var response = confirm("Are you sure! you want to "+ status +" this user?");
	if (response == true) {
		window.location = '<?php echo site_url();?>?option=1&task=updateOperatorStatus&operatorID='+opId+'&status='+status;
	} 
	
});

</script>

<?php get_footer(); ?>
