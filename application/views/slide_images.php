<div class="wp_container_slideshow">
	 <div class="span4">
		<div id="myCarouselimages" class="carousel slide">
		  <div class="carousel-inner">
			<?php 
				$datalideshows = $this->callbuyMD->tbl_get_home_album_slideshows(); 
				foreach($datalideshows as $value_data_slideshows){
			?>
			<div class="item active">
			  <img style="height: 330px ! important;" src="http://www3.icd.gov.vn/assets/uploads/gallery/<?php echo $value_data_slideshows['img'];?>" alt="<?php echo $value_data_slideshows['title_album_images'];?>">
			
			</div>
			<?php } ?>
			<?php 
			$datalideshow = $this->callbuyMD->tbl_get_home_album_slideshow(); 
			foreach($datalideshow as $value_data_slideshow){
			?>
			<div class="item">
			  <img style="height: 330px ! important;" src="http://www3.icd.gov.vn/assets/uploads/gallery/<?php echo $value_data_slideshow['img'];?>" alt="<?php echo $value_data_slideshow['title_album_images'];?>">
		   
			</div>
			
			<?php } ?>
		  </div>
		  <a class="left carousel-control" href="#myCarouselimages" data-slide="prev">&lsaquo;</a>
		  <a class="right carousel-control" href="#myCarouselimages" data-slide="next">&rsaquo;</a>
		</div><!-- /.carousel -->
	</div>
</div>