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
							
							<h3 class="title_heading_wp_list_container_left"><img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> EVENTS CALENDAR </h3>
						</div>
					</div>
					
					<ul>
						<?php foreach($datacontent as $value_content_list){ ?>
						<?php $urls = to_slug($value_content_list['title_lichsukien_vi']);?>
						<li class="li_list_wp_list_container_left">
							<div class="span7">
								<div class="content_li_list_wp_list_container_left">
									<div class="images_list_content_pages">
										<div class="content_v1_home">
										<a href="<?php echo base_url();?>calendar/details/<?php echo $urls; ?>/<?php echo $value_content_list['id_lichsukien']; ?>.icd" title="<?php echo $value_content_list['title_lichsukien_vi']; ?>"> 
											<img class="img_content_v1_home" src="http://www3.icd.gov.vn/assets/uploads/lichsukien/<?php echo $value_content_list['img']; ?>"  alt="<?php echo $value_content_list['title_lichsukien_vi']; ?>" /> 
										</a>
										</div>
									</div>
									<div class="content_list_content_pages">
									  <h3 class="text_headering_home_list" style="line-height: 24px ! important;" >
										<a href="<?php echo base_url();?>calendar/details/<?php echo $urls; ?>/<?php echo $value_content_list['id_lichsukien']; ?>.icd" title="<?php echo $value_content_list['title_lichsukien_vi']; ?>">
											<span ><?php echo $value_content_list['title_lichsukien_vi']; ?></span> 
										</a>
									  </h3>
									  <div class="title_v1_home">
										<h5 class="title_home_center_layout3"> <?php echo $value_content_list['introduction_vi']; ?>... </h5>
										
									  </div>
									</div>
								</div>
							</div>	
						</li>
						<?php } ?>
						
					</ul>
					<?php 
						
						
					?>
					
					
				</div>
			</div>
		
			<div class="span4">
				<div class="wp_list_container_right">
					<h3 class="text_headering_home">TIN SỰ KIỆN</h3>
					<ul class="list_v1_home">
					<?php foreach($task_even_calendar as $value_task_even_calendar){ ?>
					<?php $url_task = to_slug($value_task_even_calendar['title_conent_vi']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_task_even_calendar['id_content']; ?>/tin-su-kien/<?php echo $url_task; ?>/<?php echo $value_task_even_calendar['sub_menu']; ?>.icd" title="<?php echo $value_task_even_calendar['title_conent_vi']; ?>">
								 <?php echo $value_task_even_calendar['title_conent_vi'];?>
							</a>
						</li>
					<?php } ?>
					</ul>
					
				</div>
				<div class="fix_div_task_bar">
				</div>
				<div class="wp_list_container_right">
					<h3 class="text_headering_home">TIN NỔI BẬT</h3>
					<ul class="list_v1_home">
					<?php foreach($data_task_hotnews as $value_hot_news){ ?>
					<?php $url_task = to_slug($value_hot_news['title_conent_vi']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_vi']; ?>">
								<span> <?php echo $value_hot_news['title_conent_vi'];?></span>
							</a>
						</li>
					<?php } ?>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</div>
