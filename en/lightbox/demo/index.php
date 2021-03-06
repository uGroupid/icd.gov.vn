<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Simple Lightbox - Responsive touch friendly Image lightbox</title>
	<link href='http://fonts.googleapis.com/css?family=Slabo+27px' rel='stylesheet' type='text/css'>
	<link href='<?php echo base_url();?>/lightbox/dist/simplelightbox.min.css' rel='stylesheet' type='text/css'>
	<link href='<?php echo base_url();?>/lightbox/demo/demo.css' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<h1 class="align-center">Simple Lightbox Demo Page</h1>
		<div class="gallery">	
			<a href="<?php echo base_url();?>/lightbox/demo/images/image1.jpg" class="big"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb1.jpg" alt="" title="Beautiful Image" /></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image2.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb2.jpg" alt="" title=""/></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image3.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb3.jpg" alt="" title="Beautiful Image"/></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image4.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb4.jpg" alt="" title=""/></a>
			<div class="clear"></div>
			
			<a href="<?php echo base_url();?>/lightbox/demo/images/image5.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb5.jpg" alt="" title=""/></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image6.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb6.jpg" alt="" title=""/></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image7.jpg" class="big"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb7.jpg" alt="" title=""/></a>
			<a href="<?php echo base_url();?>/lightbox/demo/images/image8.jpg"><img src="<?php echo base_url();?>/lightbox/demo/images/thumbs/thumb8.jpg" alt="" title=""/></a>
			<div class="clear"></div>
			
			<a href="images/image9.jpg" class="big"><img src="images/thumbs/thumb9.jpg" alt="" title=""/></a>
			<a href="images/image10.jpg"><img src="images/thumbs/thumb10.jpg" alt="" title=""/></a>
			<a href="images/image11.jpg"><img src="images/thumbs/thumb11.jpg" alt="" title=""/></a>
			<a href="images/image12.jpg"><img src="images/thumbs/thumb12.jpg" alt="" title=""/></a>
			<div class="clear"></div>
			
		</div>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/lightbox/dist/simple-lightbox.js"></script>
<script>
	$(function(){
		var gallery = $('.gallery a').simpleLightbox();
	});
</script>
</body>
</html>	