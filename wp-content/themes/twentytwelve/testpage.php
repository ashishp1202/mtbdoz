<?php
/**
 * Template Name: test
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
require_once get_template_directory().'/inc/tourlib.php';
?>
<div id="primary" class="site-content sign_bg">
	<div id="content" role="main">
		
		<?php 
		if(isset($_POST['delete']))
		{
		
			$tourObj = new tourLibrary();
			$detail = $tourObj->delete_tour();
		
		}
		
		
		
		?>
		<form action="" method="post">
			<input type="text" name="userhash" placeholder="userhash">
			<input type="text" name="id" placeholder="tour_id">
			<input type="submit" name="delete" value="deletetour">
		</form>
		
		<br>
		
		<hr>
		<br>
		
		<?php 

		if(isset($_POST['deleteop']))
		{
			
		require_once get_template_directory().'/inc/tourlib.php';
			$tourObj = new tourLibrary();
			$detail = $tourObj->delete_operator();
		} ?>
		<form action="" method="post">
			<input type="text" name="userhash" placeholder="userhash">
	
			<input type="submit" name="deleteop" value="delete operator">
		</form>
		
		<br/>
		<br/>
		<h2>Upload Image</h2>
		<?php if($_SESSION['tourImageMessage']){ 
			if(is_object($_SESSION['tourImageMessage'])){
				$message = "Image uploaded successfully";
			} else {
				$message = $_SESSION['tourImageMessage'];
			}
		?>
			<div class="alert alert-info fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $message; ?></div>
		<?php 
			unset($_SESSION['tourImageMessage']);
		} ?>
		
		<form action="<?php echo site_url().'?option=1&task=uploadTourImage'; ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="tour_image" />
			<input type="text" name="id" placeholder="tour_id">	
			<input type="submit" name="addimage" value="Add Image">
		</form>
		
		<h2>Delete tour Image</h2>
		<?php if($_SESSION['tourImageDeleteMessage']){ 
			if(is_object($_SESSION['tourImageDeleteMessage'])){
				$message = "Image deleted successfully";
			} else {
				$message = $_SESSION['tourImageDeleteMessage'];
			}
		?>
			<div class="alert alert-info fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $message; ?></div>
		<?php 
			unset($_SESSION['tourImageDeleteMessage']);
		} ?>
		<ul class="list-group">
		<?php $tourObj = new tourLibrary();
			$detail = $tourObj->getTourImages(189);
			if($detail->status == true){
				foreach($detail->data->images as $img){
					?>
					<li class="list-group-item" style="width:150px;height:150px;"><img style="max-width:100%;width:100%;" src="<?php echo $img->imagePath; ?>" /><a class="btn btn-danger" href="<?php echo site_url().'?option=1&task=deleteTourImage&tourId='.$detail->data->tourId.'&imageId='.$img->imageId; ?>">Delete</a></li>
					<?php 
				}
			}
		?>
		</ul>
		<br/>
		<br/>
			<h2>Upload Video</h2>
		<?php if($_SESSION['tourVideoMessage']){ 
			if(is_object($_SESSION['tourVideoMessage'])){
				$message = "Video uploaded successfully";
			} else {
				$message = $_SESSION['tourVideoMessage'];
			}
		?>
			<div class="alert alert-info fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $message; ?></div>
		<?php 
			unset($_SESSION['tourVideoMessage']);
		} ?>
		
		<form action="<?php echo site_url().'?option=1&task=uploadTourVideo'; ?>" method="post" enctype="multipart/form-data">
			<input type="file" name="tour_video" />
			<input type="text" name="id" placeholder="tour_id">	
			<input type="submit" name="addimage" value="Add Video">
		</form>
		
		<h2>Delete tour Video</h2>
		<?php if($_SESSION['tourVideoDeleteMessage']){ 
			if(is_object($_SESSION['tourVideoDeleteMessage'])){
				$message = "Video deleted successfully";
			} else {
				$message = $_SESSION['tourVideoDeleteMessage'];
			}
		?>
			<div class="alert alert-info fade in"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><strong></strong> <?php echo $message; ?></div>
		<?php 
			unset($_SESSION['tourVideoDeleteMessage']);
		} ?>
		<ul class="list-group">
		<?php 
			$tourObj = new tourLibrary();
			$detail = $tourObj->getTourVideos(189);
			if($detail->status == true){
				foreach($detail->data->videos as $vid){
					?>
					<li class="list-group-item" style="width:150px;height:150px;">
				
					
						<a href="<?php echo $vid->videoPath; ?>" target="_blank"> View video-<?php echo $vid->videoId; ?> </a>
					
					<a class="btn btn-danger" href="<?php echo site_url().'?option=1&task=deleteTourVideo&tourId='.$detail->data->tourId.'&videoId='.$vid->videoId; ?>">Delete</a></li>
					<?php 
				}
			}
		?>
		</ul>
		<h2>Add Sap to tour</h2>
		<form action="<?php echo site_url().'?option=1&task=createSap'; ?>" method="post">
		<input type="text" name="sap[0][day]" value="" />
		<input type="text" name="sap[0][cost]" value="" />
		<input type="text" name="tourId" value="189" />
		<input type="submit" value="Add Sap" />
		</form>
		
 	</div>
</div>
<?php get_footer(); ?> 
