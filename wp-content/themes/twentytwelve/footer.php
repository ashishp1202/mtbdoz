<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	</div><!-- #main .wrapper -->
	
</div><!-- #page -->
 <footer id="footer" class="midnight-blue">
        <?php $userdata = empty($_SESSION['rideTourUserData']) ? null : $_SESSION['rideTourUserData']; ?>
		<?php $clientdata = empty($_SESSION['clientUserData']) ? null : $_SESSION['clientUserData']; ?>
            <div class="row" style="padding: 0 15px;">
				<div class="col-sm-6">
                    <ul class="pull-left dis">
						<?php echo do_shortcode('[do_widget id=nav_menu-2]'); ?>
						<?php if(empty($userdata->token) && empty($clientdata->token)): ?>
					<a href="<?php echo site_url();  ?>/login">SUPPLIER LOGIN</a> | 
					<a style="margin-left:1px;" href="<?php echo site_url(); ?>/sign-up">SUPPLIER SIGN UP</a>
					<?php endif; ?>
                    </ul>
					&nbsp;&nbsp;
					<!--<a href="<?php //echo site_url(); ?>/contact-us/" style="color:#3c97c7; margin-left: -7px;">Become an affiliate</a><!--#gototop-->
                </div>
                <div class="col-sm-6" style="text-align:right; padding-left: 0;">
                    Copyright &copy <?php echo date('Y'); ?> MTBdoz | All Rights Reserved.
                </div>
                
            </div>
        
    </footer><!--/#footer-->
	<script>
	jQuery("#selectCurrency").change(function(){
	var currencyText = jQuery(this).val();
	window.location.href = '<?php echo site_url().'?option=1&task=setcurrency&currency='; ?>'+currencyText;
	});
	</script>

	
    <!--script src="<?php bloginfo( 'template_url' ); ?>/js/jquery.js"></script-->
    
	<?php if(!is_front_page()): ?>
	<script async src="<?php bloginfo( 'template_url' ); ?>/js/bootstrap.min.js"></script>
    <script async src="<?php bloginfo( 'template_url' ); ?>/js/jquery.prettyPhoto.js"></script>
	<?php endif; ?>
    <!--<script async src="<?php bloginfo( 'template_url' ); ?>/js/main.js"></script>-->
	<!--link href="<?php bloginfo( 'template_url' ); ?>/css/bootstrap.min.css" rel="stylesheet">	
	<link href="<?php bloginfo( 'template_url' ); ?>/css/main.css" rel="stylesheet"-->
	
	
	<!--link href="<?php bloginfo( 'template_url' ); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"-->
	
<?php wp_footer(); ?>
</body>
</html>