	<div class="container-wrap">
		<div class="main-content container-fullwidth">
			<div class="row">
				<div class="noo-main col-md-12" role="main">
					<div class="noo-vc-row row " style=" padding-top: 0px; padding-bottom: 50px;">
						<div class="noo-vc-col col-md-12 ">
							<div class=" property-slider">
								<div id="noo-slider-1" class="noo-slider noo-property-slide-wrap">
									<ul class="sliders">
										<?php $getslide = $this->callbuyMD->get_slide(); foreach( $getslide as $valueslide){ ?>
										<li class="slide-item noo-property-slide"><img width="1170" height="700" src="<?php echo base_url() ?>assets/uploads/<?php echo $valueslide['img'];?>" class="attachment-property-slider wp-post-image" alt="<?php echo $valueslide['title'];?>"/>
										<div class="slide-caption">
											<div class="slide-caption-info">
												<h3><a href="#">WWW.QUATGIOCONGNGHIEP.COM.VN</a><small><?php echo $valueslide['title'];?></small></h3>
												
											</div>
										</div>
										</li>
										<?php }  ?>
									</ul>
									<div class="clearfix">
									</div>
									<div id="noo-slider-1-pagination" class="slider-indicators">
									</div>
									<a id="noo-slider-1-prev" class="slider-control prev-btn" role="button" href="#"><span class="slider-icon-prev"></span></a>
									<a id="noo-slider-1-next" class="slider-control next-btn" role="button" href="#"><span class="slider-icon-next"></span></a>
								</div>
							</div>
							<script>
jQuery('document').ready(function ($) {
  $('#noo-slider-1 .sliders').carouFredSel({
    infinite: true,
    circular: true,
    responsive: true,
    debug : false,
    scroll: {
      items: 1,
      duration: 1000,
      pauseOnHover: "resume",
      fx: "scroll"
    },
    auto: {
      timeoutDuration: 2000,
      play: true
    },
    prev: {
      button: "#noo-slider-1-prev"
    },
    next: {
      button: "#noo-slider-1-next"
    },
    pagination: {
      container: "#noo-slider-1-pagination"
    },
    swipe: {
      onTouch: true,
      onMouse: true
    }
  });
});
							</script>
							<style>
#noo-slider-1.noo-slider .caroufredsel_wrapper .sliders .slide-item.noo-property-slide{max-height:700px;}
							</style>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>