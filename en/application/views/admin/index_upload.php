<!-- BEGIN PAGE -->
		<div id="main-content">
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title" style="background: none repeat scroll 0% 0% rgb(16, 63, 21); color: white; font-weight: bold; font-size: 217%;">
							</h3>
						<!-- BEGIN SQUARE STATISTIC BLOCKS-->
                   
                    <!-- END SQUARE STATISTIC BLOCKS-->
						
						<div class="navicat_exprnt" style="background: none repeat scroll 0% 0% rgb(16, 63, 21); color: white; font-weight: bold; font-size: 217%;"></div>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div id="page" class="dashboard">
					<div class="row-fluid">
						<div class="span12">
							<div class="widget">
								<div class="widget-body">
										<h2> Upload Thư Viện Hình Ảnh</h2>
										<hr>
										<?php echo form_open_multipart('quantri/doupload');?>
										<input name="userfile[]" id="userfile" type="file" multiple="" />
										<input type="submit" value="upload" />
										<?php echo form_close() ?>
									<div class="space7"></div>
								</div>	
								<div class="widget-body">
									<style> img{float: left; width: auto; height: 98px; border: 2px solid rgb(255, 255, 255); transition: transform 0.15s ease 0s; position: relative; } </style>
										<?php 
										$datacontent = $this->callbuyMD->data_getcontent_gallery();
										foreach($datacontent as $value_content_details){ ?>
								
											<?php 
											//echo $value_content_details['img'];
											$images_lib = explode(",",$value_content_details['img']); ?>
											 <?php foreach($images_lib as $values_imageslib){ ?>
												<a href="#" class="big">
													<img src="<?php echo base_url();?>assets/uploads/gallery/<?php echo $values_imageslib ?>" alt="" title="OUR GALLERY INTERNATIONAL COOPERATION DEPARTMENT <?php echo $value_content_details['date_upload']?>" />
												</a>
											
											<?php } ?>
											<div class="clear"></div>
										<?php } ?>
									<div class="space7"></div>
								</div>
							</div>
						</div>
					</div>	
				</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- END JAVASCRIPTS -->
</div>