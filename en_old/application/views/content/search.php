<?php
 function to_slug($str) {
		  $str = trim(mb_strtolower($str));
			$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
			$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
			$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
			$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
			$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
			$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
			$str = preg_replace('/(đ)/', 'd', $str);
			$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
			$str = preg_replace('/([\s]+)/', '-', $str);
				return $str;
} ?>

<div class="container">
	<div class="wp_list_container">
		<div class="row">
			
			<div class="span8">
				<div class="wp_list_container_left">
					<div class="span" id="heading_wp_list_container_left">
						<div class="heading_wp_list_container_left">
							
							<h3 class="title_heading_wp_list_container_left">

            <img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> Search </h3>
						</div>
					</div>
				
					<?php foreach($data_getcontent_category as $value_data_getcontent_category){}?>
								 <?php $url = to_slug($value_data_getcontent_category['title_conent_en']);?>
								 <?php $titlecs = to_slug($title);?>
								 <?php $iddanhmuc = $value_data_getcontent_category['sub_menu'];?>
			
				
					<div class="news_active_category_list_pages">
					<?php foreach($datacontent as $value_content_list){?>
								 <?php $urlvalue_content_list = to_slug($value_content_list['title_conent_en']);?>
								 <?php $titlevalue_content_list = to_slug($title);?>
						<div class="span">
							<div class="news_hot_catelogy_list_pages" style="margin-bottom: 34px; width: 100%; float: left; border-bottom: 2px solid rgb(233, 233, 233) ! important;">
						
								
								<div class="img_news_hot_catelogy_list_pages"> 
									<div class="span3">
										<a href="<?php echo base_url();?>details/dic/<?php echo $value_content_list['id_content']; ?>/<?php echo $titlevalue_content_list; ?>/<?php echo $urlvalue_content_list; ?>/<?php echo $iddanhmuc; ?>.icd" title="<?php echo $value_content_list['title_conent_en']; ?>"> 
											<img style="width: 100% ! important; width: 100% ! important;float: left;width: 60%;height: auto; margin-bottom: 20px;"class="img_content_news_hot_catelogy_list_pages" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_content_list['img']; ?>"  alt="<?php echo $value_content_list['title_conent_en']; ?>" /> 
										</a>
									</div>
									<div class="div_calss_anh">
										<a href="<?php echo base_url();?>details/dic/<?php echo $value_content_list['id_content']; ?>/<?php echo $titlevalue_content_list; ?>/<?php echo $urlvalue_content_list; ?>/<?php echo $iddanhmuc; ?>.icd" title="<?php echo $value_content_list['title_conent_en']; ?>"> <h3 class="news_hot_catelogy_list_pages_h3">	
										<?php echo $value_content_list['title_conent_en']; ?> </h3></a>
										<div class="content_news_hot_catelogy_list_pages" style="width: 100%; float: left; padding-bottom: 20px; padding-top: 17px;">
											<?php echo $value_content_list['introduction']; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					
					
				</div>
			</div>
		
			
			<div class="span4">
				<div class="wp_list_container_right">
					
					<ul class="list_v1_home">

          <h2 class="top-stories-promo__title">News Event</h2>
          <?php foreach($task_even_calendar as $value_task_even_calendar){ ?>
        
					<?php $url_task = to_slug($value_task_even_calendar['title_conent_en']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_task_even_calendar['id_content']; ?>/tin-su-kien/<?php echo $url_task; ?>/<?php echo $value_task_even_calendar['sub_menu']; ?>.icd" title="<?php echo $value_task_even_calendar['title_conent_en']; ?>">
								    <strong class="top-stories-promo-story__title"><?php echo $value_task_even_calendar['title_conent_en'];?></strong>
                   <p class="top-stories-promo-story__summary ">
                        <?php echo $value_task_even_calendar['introduction_en'];?>
                  </p>
              <div class="dates" >
                  <?php echo $value_task_even_calendar['date_upload'];?></div>
              </a>
              
						</li>
					<?php } ?>
          <h2 class="features-and-analysis__title"> The Angle & categories</h2>
					<?php foreach($data_task_hotnews as $value_hot_news){ ?>
					<?php $url_task = to_slug($value_hot_news['title_conent_en']);?>
						<li class="li_data_task_hotnews">

              	<a href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_en']; ?>"> 
                  <img src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_hot_news['img'];?>"  title="<?php echo $value_hot_news['title_conent_en'];?>"/> 
              </a>
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_en']; ?>">
								 <h3 class="bold-image-promo__title"><?php echo $value_hot_news['title_conent_en'];?></h3>
							</a>
						</li>
					<?php } ?>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</div>
