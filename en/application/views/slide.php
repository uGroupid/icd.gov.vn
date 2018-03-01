<style>
.carousel .item{position:relative;}
.carousel .item .description{
	position: absolute;
    top: 0;
    right: 16px;
    color: #fff;
    /* opacity: 1; */
    z-index: 99;
}
</style>
<script>
	$(document).ready(function(){
		$(".carousel .item .description").width($(".carousel-caption").width());
	});
	$(window).resize(function(){
		$(".carousel .item .description").width($(".carousel-caption").width());
	});
</script>
<div class="container">
		<div id="myCarousel" class="carousel slide">
		  <div class="carousel-inner">
			<?php 
				$datalideshows = $this->callbuyMD->tbl_get_home_slideshows(); //echo "<pre>"; var_dump($datalideshows);
				foreach($datalideshows as $value_data_slideshows){
			?>
			<div class="item active">
			  <img src="http://www3.icd.gov.vn/assets/uploads/slideshow/<?php echo $value_data_slideshows['img'];?>" alt="<?php echo $value_data_slideshows['title_slideshow_vi'];?>">
				<div class="description orange-overlay">
					<div class="views-field-title">
						<span class="field-content">
						<a class="title_slideshow_a" href="#">
							<span class="field-content" style="font-size: 27px;text-transform: capitalize;font-weight: bold;">
								<?php echo $value_data_slideshows['title_slideshow_en'];?>
							</span></a>
						</span>
					</div>
					<div class="views-field-field-body">
						<div class="field-content">
							<a href="#">
							<div class="field-content">
								
									<?php echo $value_data_slideshows['introduction_en'];?>
								
							</div>
							</a>
						</div>
					</div>
					<div class="views-field-field-link">
						<div class="field-content">
							<div>
								<!--<a href="#">Đọc tiếp</a>-->
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-caption">
				
				</div>
			</div>
			<?php } ?>
			<?php 
			$datalideshow = $this->callbuyMD->tbl_get_home_slideshow($value_data_slideshows['id_slideshow']); 
			foreach($datalideshow as $value_data_slideshow){
			?>
			<div class="item">
			  <img src="http://www3.icd.gov.vn/assets/uploads/slideshow/<?php echo $value_data_slideshow['img'];?>" alt="<?php echo $value_data_slideshow['title_slideshow_vi'];?>">
				<div class="description orange-overlay">
					<div class="views-field-title">
						<span class="field-content">
						<a class="title_slideshow_a" href="#">
							<span class="field-content" style="font-size: 27px;text-transform: capitalize;font-weight: bold;">
								<?php echo $value_data_slideshow['title_slideshow_en'];?>
							</span></a>
						</span>
						
					</div>
					<div class="views-field-field-body">
						<div class="field-content">
							<a href="#">
							<div class="field-content" >
								
									<?php echo $value_data_slideshow['introduction_en'];?>
								
							</div>
							</a>
						</div>
					</div>
					<div class="views-field-field-link">
						<div class="field-content">
							<div>
								<!--<a href="#">Đọc tiếp</a>-->
							</div>
						</div>
					</div>
				</div>
				<div class="carousel-caption">
				 
				</div>
			</div>
			
			<?php } ?>
		  </div>
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
		</div><!-- /.carousel -->
</div>