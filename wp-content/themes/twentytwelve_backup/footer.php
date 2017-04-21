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
        
            <div class="row" style="padding: 0 15px;">
				<div class="col-sm-6">
                    <ul class="pull-left dis">
						<?php echo do_shortcode('[do_widget id=nav_menu-2]'); ?> 
                    </ul>
					&nbsp;&nbsp; <a href="<?php echo site_url(); ?>/contact-us/" style="color:#3c97c7; margin-left: -7px;">Become an affiliate</a><!--#gototop-->
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
	<link href="<?php bloginfo( 'template_url' ); ?>/css/combine-files.css" rel="stylesheet">
	 <link href="<?php bloginfo( 'template_url' ); ?>/style.css" rel="stylesheet">
	 <!--link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/jscrollpane.css"-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css">
	<?php if(!is_front_page()): ?>
	<link href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php bloginfo( 'template_url' ); ?>/css/animate.css" rel="stylesheet">
	<?php endif; ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.min.css">
	
	<!--link href="<?php bloginfo( 'template_url' ); ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"-->
	
<?php wp_footer(); ?>
</body>
</html>