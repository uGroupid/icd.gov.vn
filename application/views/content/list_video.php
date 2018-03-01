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
<style>
.title-video{color:#252525;margin: 5px 0;display: inline-block;font-weight:bold;}
.title-video:hover{    color: #D90202;}
.vid{margin-bottom:30px;}
.vid-hot{text-align: center;margin-bottom:30px;}
.vid-hot .title-video span{font-size:18px;}
</style>
<div class="container">
	<ol class = "breadcrumb">
	   <li><a href = "http://icd.gov.vn/">Trang chủ</a></li>
	   <li class = "active">Video</li>
	   <li class = "active"><?php echo $title;?></li>
	</ol>
</div>
<div class="container">
	<div class="wp_list_container">
		<div class="row">
			
			<div class="span8">
				<div class="wp_list_container_left">
					<div class="span" id="heading_wp_list_container_left">
						<div class="heading_wp_list_container_left">
							
							<h3 class="title_heading_wp_list_container_left"><img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> <?php echo $title; ?> </h3>
						</div>
					</div>
					<div class="row">
						<?php $urls = to_slug($hot_video['title_video']);
							  $urlscs = parse_url($hot_video['linkyoutube']);
							  parse_str($urlscs['query'], $query);
						?>
						<div class="span8 vid-hot">
								<iframe width="100%" height="400" src="//www.youtube.com/embed/<?php echo $query['v']; ?>?autoplay=0" frameborder="0" allowfullscreen></iframe>
								<a class="title-video" href="<?php echo base_url();?>details/video/<?php echo $hot_video['id']; ?>/<?php echo $urls; ?>/<?php echo $iddanhmuc; ?>.icd" title="<?php echo $hot_video['title_video']; ?>"><span ><?php echo $hot_video['title_video']; ?></span> </a>
						</div>
					</div>
					<div class="row">
						<?php foreach($datacontent as $value_content_list): ?>
						<?php $urls = to_slug($value_content_list['title_video']);
							  $urlscs = parse_url($value_content_list['linkyoutube']);
							  parse_str($urlscs['query'], $query);
						?>
							<div class="span4 vid">
								<iframe width="100%" height="220" src="//www.youtube.com/embed/<?php echo $query['v']; ?>?autoplay=0" frameborder="0" allowfullscreen></iframe>
								<a class="title-video" href="<?php echo base_url();?>details/video/<?php echo $value_content_list['id']; ?>/<?php echo $urls; ?>/<?php echo $iddanhmuc; ?>.icd" title="<?php echo $value_content_list['title_video']; ?>"><span ><?php echo $value_content_list['title_video']; ?></span> </a>
							</div>
						
						<?php endforeach; ?>
					</div>
					
					
				</div>
			</div>
		
			<div class="span4">
				<div class="wp_list_container_right">
					
					<ul class="list_v1_home">

          <h2 class="top-stories-promo__title">Tin sự kiện</h2>
          <?php foreach($task_even_calendar as $value_task_even_calendar){ ?>
        
					<?php $url_task = to_slug($value_task_even_calendar['title_conent_vi']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_task_even_calendar['id_content']; ?>/tin-su-kien/<?php echo $url_task; ?>/<?php echo $value_task_even_calendar['sub_menu']; ?>.icd" title="<?php echo $value_task_even_calendar['title_conent_vi']; ?>">
								    <strong class="top-stories-promo-story__title"><?php echo $value_task_even_calendar['title_conent_vi'];?></strong>
                   <p class="top-stories-promo-story__summary ">
                        <?php //echo $value_task_even_calendar['introduction'];?>
                  </p>
              <div class="dates" >
                  <?php echo $value_task_even_calendar['date_upload'];?></div>
              </a>
              
						</li>
					<?php } ?>
          <h2 class="features-and-analysis__title"> Góc nhìn và chuyên mục</h2>
					<?php foreach($data_task_hotnews as $value_hot_news){ ?>
					<?php $url_task = to_slug($value_hot_news['title_conent_vi']);?>
						<li class="li_data_task_hotnews">

              	<a href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_vi']; ?>"> 
                  <img style="width: 425px;height: 250PX;" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_hot_news['img'];?>"  title="<?php echo $value_hot_news['title_conent_vi'];?>"/> 
              </a>
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_vi']; ?>">
								 <h3 class="bold-image-promo__title"><?php echo $value_hot_news['title_conent_vi'];?></h3>
							</a>
						</li>
					<?php } ?>
					</ul>
					
				</div>
			</div>
		</div>
	</div>
</div>
