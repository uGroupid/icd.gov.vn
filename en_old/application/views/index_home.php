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
.spand_content_v1_home{margin: auto;text-align: left;}
.spak_lang_home{padding-left:5px;}
.task_list_home_news_packing{margin-top:10px;}
.task_list_home_news_packing a{margin-left:3px;}
.spak_lang_home a:first-child{color: rgb(255, 255, 255);
    line-height: 16px;
    position: relative;
    top: 10px;
    text-align: left;}
</style>
  <div class="container">

      <div class="row">
	  <div class="span4">
	  <center style="margin-top: 15px; margin-bottom: 12px;">
          <a href="<?php echo base_url();?>">
			<img src="http://www3.icd.gov.vn/images/logo.png" width="180px"  alt="INTERNATIONAL COOPERATION DEPARTMENT Ministry of Culture, Sports and Tourism of Viet Nam " /> 
			
			</a>
	  </center>
		<h3 class="home_logo_title_vi" style="margin-bottom: 25px;margin-top:0;">	<span>CỤC HỢP TÁC QUỐC TẾ</span> </h3>
		 <h5 class="home_logo_title_en" style="margin-bottom: 20px; margin-top: -23px;">
			<span >INTERNATIONAL COOPERATION DEPARTMENT</span>
		  </h5>
		<center>
			 <div class="email_dowload_index_value">
                    <a style="width: 48%; float: left; background: rgb(183, 0, 0) none repeat scroll 0% 0%; height: 40px;"target="_blank" href="https://mail.chinhphu.vn/owa/auth/logon.aspx">
					<img style="width: 60px; height: auto;" src="http://www3.icd.gov.vn/images/mail-icon.png"><span style="font-size: 14px;font-weight: bold;color: #FFF;">Email</span></a>
                    <a style="width: 48%; float: left; background: rgb(183, 0, 0) none repeat scroll 0% 0%; height: 40px;margin-left: 10px;" href="<?php echo base_url();?>share/"><img style="width: 30px; height: auto; margin-top: 5px;" src="<?php echo base_url();?>images/icon-download.png"><span style="font-size: 14px;font-weight: bold;color: #FFF;margin-left: 10px;"> <span>Download </span></span></a>
            </div>
		</center>
        </div>
        <div class="span4">
			<div class="vsub_text_headering_homeindex" style="margin-bottom: 0;">
			  <a href="<?php echo base_url();?>category/dic/su-kien-cua-chung-toi/10.icd"><h3 class="text_headering_homeindex" >
          OUR EVENTS
			  </h3>
        </a>
			  <?php 
				foreach($get_data_home_sukienchungtoi as $value_get_data_home_sukienchungtoi){} 
			  ?>
			  <?php $url = to_slug($value_get_data_home_sukienchungtoi['title_conent_en']);?>
			 
			  <div class="content_v1_home">
				<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_sukienchungtoi['id_content']; ?>/su-kien-cua-chung-toi/<?php echo $url; ?>/<?php echo $value_get_data_home_sukienchungtoi['sub_menu']; ?>.icd" title="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>"> 
					<img src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_sukienchungtoi['img']; ?>"  style="width: 100%; height: 290px;" alt="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>" /> 
				</a>
					<div class="content_v1_home_introduction">
					 <div class="title_v1_home">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_sukienchungtoi['id_content']; ?>/su-kien-cua-chung-toi/<?php echo $url; ?>/<?php echo $value_get_data_home_sukienchungtoi['sub_menu']; ?>.icd" title="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>"> 
							<h5 class="title_home_center_layout3"><?php echo mb_substr($value_get_data_home_sukienchungtoi['title_conent_en'].$value_get_data_home_sukienchungtoi['title_conent_en'].$value_get_data_home_sukienchungtoi['title_conent_en'],0,45,'UTF-8');?>...</h5>
						</a>
					  </div>
						<span>
							<?php echo mb_substr($value_get_data_home_sukienchungtoi['introduction_en'],0,190,'UTF-8');?>
						</span>
					</div>
			  </div>
			</div>
		</div>
        <div class="span4">
          <h3 class="text_headering_subhome">BREAKING NEWS</h3>
			<ul class="list_v1_home_subhome">
				<?php foreach($data_task_hotnews as $value_hot_news){ ?>
				<?php $url_task = to_slug($value_hot_news['title_conent_en']);?>
					<li class="li_data_task_hotnews_subhome">
						<a style="color: #2d2c2c; text-decoration: none; font-family: Arial,sans-serif;" href="<?php echo base_url();?>details/dic/<?php echo $value_hot_news['id_content']; ?>/tin-noi-bat/<?php echo $url_task; ?>/<?php echo $value_hot_news['sub_menu']; ?>.icd" title="<?php echo $value_hot_news['title_conent_en']; ?>">
							<span> <?php echo $value_hot_news['title_conent_en'];?></span>
						</a>
					</li>
				<?php } ?>
			</ul>
		
		</div>
        
      </div>
		<br>
      
</div>

<div class="home_task_container_video_callbuy" style="background: #fff;    margin-bottom: 20px;">
	<div class="container">
		<div class="sub_container_home_task_container_video_callbuy">
			<div class="row">
				<div class="span4">
				  <h3 class="text_headering_home_index">EVENTS CALENDAR</h3>
					<div class="calendar_home" style="height: 179px ! important; float: left; width: 100%;">
						<?php echo $calendar;?>
					</div>
				</div>
			<div class="span4">
			<h3 class="fix_text_headering_home" style="float: left; height: 20px; width: 100%;"></h3>
			<ul style="margin: 0px auto;">
				<?php foreach($get_data_home_cultural_news as $value_get_data_home_cultural_news){}?>
				<li style="float: left; height: 170px; width: 175px; margin-right: 10px;">
					  <?php $vname_value_get_data_home_cultural_news = to_slug($value_get_data_home_cultural_news['title_conent_en']);?>
					<div class="spand_content_v1_home">
					  <div class="content_v1_home_index">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_cultural_news['id_content'];?>/van-hoa/<?php echo $vname_value_get_data_home_cultural_news;?>/<?php echo $value_get_data_home_cultural_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_cultural_news['title_conent_en'];?> "> 
							<img class="iconsetion_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_cultural_news['img'];?>" width="100%" height="350px" alt="<?php echo $value_get_data_home_cultural_news['title_conent_en'];?>" /> 
						</a>
					  </div>
						<div class="spak_lang_home">
							<a  href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_cultural_news['id_content'];?>/van-hoa/<?php echo $vname_value_get_data_home_cultural_news;?>/<?php echo $value_get_data_home_cultural_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_cultural_news['title_conent_en'];?> "> 
								
								<?php echo mb_substr($value_get_data_home_cultural_news['title_conent_en'],0,50,'UTF-8');?>
							</a>
							<div class="task_list_home_news_packing"  task_list_home_news_packing> <span> </span><a href="<?php echo base_url();?>category/dic/van-hoa/11.icd">CULTURE </a></div>
						</div>
					</div>
				</li>
				<?php foreach($get_data_home_sports_news as $value_get_data_home_sports_news){}?>
				<li style="float: left; height: 170px; width: 175px; margin-right: 10px;">
					  <?php $vname_value_get_data_home_sports_news = to_slug($value_get_data_home_sports_news['title_conent_en']);?>
					<div class="spand_content_v1_home" >
					  <div class="content_v1_home_index">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_sports_news['id_content'];?>/the-thao/<?php echo $vname_value_get_data_home_sports_news;?>/<?php echo $value_get_data_home_sports_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_sports_news['title_conent_en'];?> "> 
							<img class="iconsetion_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_sports_news['img'];?>" width="100%" height="350px" alt="<?php echo $value_get_data_home_sports_news['title_conent_en'];?>" /> 
						</a>
					  </div>
						<div class="spak_lang_home">
							<a  href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_sports_news['id_content'];?>/the-thao/<?php echo $vname_value_get_data_home_sports_news;?>/<?php echo $value_get_data_home_sports_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_sports_news['title_conent_en'];?> "> 
								
								<?php echo mb_substr($value_get_data_home_sports_news['title_conent_en'],0,50,'UTF-8');?>
							</a>
							<div class="task_list_home_news_packing" > <span> </span><a href="<?php echo base_url();?>category/dic/the-thao/12.icd">SPORTS</a></div>
						</div>
					</div>
				</li>
				<?php foreach($get_data_home_travel_news as $value_get_data_home_travel_news){}?>
				<li style="float: left; height: 180px; width: 175px; margin-right: 10px;">
					  <?php $vname_value_get_data_home_travel_news = to_slug($value_get_data_home_travel_news['title_conent_en']);?>
					<div class="spand_content_v1_home" >
					  <div class="content_v1_home_index">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_travel_news['id_content'];?>/du-lich/<?php echo $vname_value_get_data_home_travel_news;?>/<?php echo $value_get_data_home_travel_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_travel_news['title_conent_en'];?> "> 
							<img class="iconsetion_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_travel_news['img'];?>" width="100%" height="350px" alt="<?php echo $value_get_data_home_travel_news['title_conent_en'];?>" /> 
						</a>
					  </div>
						<div class="spak_lang_home">
							<a  href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_travel_news['id_content'];?>/du-lich/<?php echo $vname_value_get_data_home_travel_news;?>/<?php echo $value_get_data_home_travel_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_travel_news['title_conent_en'];?> "> 
								
								<?php echo mb_substr($value_get_data_home_travel_news['title_conent_en'],0,50,'UTF-8');?>
							</a>
							<div class="task_list_home_news_packing"> <span> </span><a href="<?php echo base_url();?>category/dic/du-lich/13.icd">TRAVEL</a></div>
						</div>
					</div>
				</li>
				<?php foreach($get_data_home_family_news as $value_get_data_home_family_news){}?>
				<li style="float: left; height: 180px; width: 175px; margin-right: 10px;">
					  <?php $vname_value_get_data_home_family_news = to_slug($value_get_data_home_family_news['title_conent_en']);?>
					<div class="spand_content_v1_home">
					  <div class="content_v1_home_index">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_family_news['id_content'];?>/gia-dinh/<?php echo $vname_value_get_data_home_family_news;?>/<?php echo $value_get_data_home_family_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_family_news['title_conent_en'];?> "> 
							<img class="iconsetion_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_family_news['img'];?>" width="100%" height="350px" alt="<?php echo $value_get_data_home_family_news['title_conent_en'];?>" /> 
						</a>
					  </div>
						<div class="spak_lang_home">
							<a  href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_family_news['id_content'];?>/gia-dinh/<?php echo $vname_value_get_data_home_family_news;?>/<?php echo $value_get_data_home_family_news['sub_menu'];?>.icd" title=" <?php echo $value_get_data_home_family_news['title_conent_en'];?> "> 
							
								<?php echo mb_substr($value_get_data_home_family_news['title_conent_en'],0,50,'UTF-8');?>
							</a>
							<div class="task_list_home_news_packing"> <span> </span><a href="<?php echo base_url();?>category/dic/du-lich/20.icd"> </a></div>
						</div>
					</div>
				</li>
			
			</ul>
		</div>
      
      
				<div class="span4">
					<h3 class="text_headering_home_index"><a href="<?php echo base_url();?>category/dic/tin-anh/31.icd">NEWS IMAGES</a></h3>
					<?php foreach($get_data_home_tinanh as $value_tinanh_home){}?>
					<?php $url_value_tinanh_home = to_slug($value_tinanh_home['title_conent_en']);?>
					<div class="tabsk_right_image_home">
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_tinanh_home['id_content']; ?>/tin-anh/<?php echo $url_value_tinanh_home;?>/<?php echo $value_tinanh_home['sub_menu']; ?>.icd" title="<?php echo $value_tinanh_home['title_conent_en']; ?>">
							<img src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_tinanh_home['img']; ?>" style="width: 100%; height: 324px;"/>
						
						<div class="content_v1_home_introductions">
							<span style="font-size: 12px; font-family: arial; line-height: 18px;">
								<?php echo mb_substr($value_tinanh_home['introduction_en'],0,190,'UTF-8');?>
							</span>
						</div>
          </a>
					</div>
				</div>
			</div>
		</div>
	</div>
<br>
</div>

<div class="container">
	<div class="row">
  	<div class="span4">
				  <h3 class="text_headering_home_index">UPCOMING EVENTS</h3>
					<div class="vsub_text_headering_homeindex">
					  <?php 
						foreach($get_data_home_sukienchungtoi_qt as $value_get_data_home_sukienchungtoi){} 
					  ?>
					  <?php $url = to_slug($value_get_data_home_sukienchungtoi['title_conent_en']);?>
						<a href="<?php echo base_url();?>details/dic/<?php echo $value_get_data_home_sukienchungtoi['id_content']; ?>/su-kien-cua-chung-toi/<?php echo $url; ?>/<?php echo $value_get_data_home_sukienchungtoi['sub_menu']; ?>.icd" title="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>"> 
							<img src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_get_data_home_sukienchungtoi['img']; ?>"  style="width: 100%; height: 320px;" alt="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>" /> 
              
          
						<div class="content_v1_home_introductions">
							<span>
								<?php echo mb_substr($value_get_data_home_sukienchungtoi['introduction_en'],0,190,'UTF-8');?>
							</span>
						</div>
          </a>
					</div>
					
				</div>
		
		<div class="span4">
			<h3 class="text_headering_home_index"><a href="<?php echo base_url();?>video/dic/video-chung-toi/22.icd" style=""> OUR VIDEOS</a></h3>
			<div class="vsub_text_headering_homeindex">
				<iframe width="100%" height="320" src="//www.youtube.com/embed/<?php echo $data_video_a;?>" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>
		<div class="span4">
					<h3 class="text_headering_home_index"><a href="<?php echo base_url();?>gallery" style="">
PICTURE LIBRARY </a></h3>
				<div class="vsub_text_headering_homeindex">
			
				
				<div class="wp_container_slideshow">
					
						<div style="margin: 0px !important;" id="myCarouselimages" class="carousel slide">
						  <div class="carousel-inner" style="height: 350px ! important;">
							<?php 
								$datalideshows = $this->callbuyMD->tbl_get_home_album_slideshows(); 
								
								foreach($datalideshows as $value_data_slideshows){
							?>
						
							
								<div class="item active">
								  
									<a target="_blank" href="<?php echo base_url();?>gallery">
									<img style="height: 320px ! important;" src="http://www3.icd.gov.vn/assets/uploads/gallery/<?php echo $value_data_slideshows['img'];?>">
									</a>
								
								</div>	
							
							<?php } ?>
							<?php 
							$datalideshow = $this->callbuyMD->tbl_get_home_album_slideshow(); 
							foreach($datalideshow as $value_data_slideshow){
							?>
								<div class="item">
								 <a target="_blank" href="<?php echo base_url();?>gallery"> <img style="height: 320px ! important;" src="http://www3.icd.gov.vn/assets/uploads/gallery/<?php echo $value_data_slideshow['img'];?>" alt="<?php //echo $value_data_slideshow['title_album_images'];?>"></a>
							   
								</div>
							<?php } ?>
						  </div>
						  <a class="left carousel-control" href="#myCarouselimages" data-slide="prev">&lsaquo;</a>
						  <a class="right carousel-control" href="#myCarouselimages" data-slide="next">&rsaquo;</a>
						</div><!-- /.carousel -->
					
				</div>
			</div>

		</div>
	</div>
</div>
<br>
<div class="container">
	<div class="row">
		<div class="span4">
			<h3 class="text_headering_home_index">LINKS</h3>
			<div class="vsub_text_headering_homeindex">
				 <ul style="margin: 0px auto;">
				 <?php foreach($data_link_lienkettrang as $value_lienkettrang){ ?>
					<a href="<?php echo $value_lienkettrang['link'];?>" target="_blank">
						<li class="linket_linkhome" style="background-size: 108px 100px;background-image: url(http://www3.icd.gov.vn/assets/uploads/lienketklink/<?php echo $value_lienkettrang['img']; ?>);">
							<span style="font-weight: bold; color: rgb(0, 0, 0);"></span></li></a>
				 <?php } ?>
				 </ul>
			</div>

		</div>
		
		<div class="span4">
			<h3 class="text_headering_home_index"><a href="<?php echo base_url();?>video/dic/video-tham-khao/23.icd" style=""> VIDEO REFERENCES</a></h3>
			<div class="vsub_text_headering_homeindex">
			
			 <iframe width="100%" height="320" src="//www.youtube.com/embed/<?php echo $data_video_b;?>" frameborder="0" allowfullscreen></iframe>
			</div>

		</div>
		<div class="span4">
			<h3 class="text_headering_home_index"><a href="<?php echo base_url();?>category/dic/the-gioi-voi-viet-nam/25.icd" style="">The Vietnamese cardinal & World on Vietnam</a></h3>
			<div class="vsub_text_headering_homeindex">
			  <?php 
				foreach($get_data_home_sukienchungtoi as $value_get_data_home_sukienchungtoi){} 
			  ?>
			  <?php $url = to_slug($value_get_data_home_sukienchungtoi['title_conent_en']);?>
				<a href="<?php echo base_url();?>category/dic/the-gioi-voi-viet-nam/25.icd" title="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>"> 
					<?php $data_icon_index_b = $this->callbuyMD->data_icon_index_b();
					foreach($data_icon_index_b as $value_icon_indexb){}
					?>
					<img src="http://www3.icd.gov.vn/assets/uploads/icon_index/<?php echo $value_icon_indexb['img'];?>"  style="width: 100%; height: 320px;" alt="<?php echo $value_get_data_home_sukienchungtoi['title_conent_en']; ?>" /> 
				</a>
				
			</div>

		</div>
	</div>
</div>
<br>
<!--
  <div class="container">
	<div class="ads_foooter_1200x90" style="margin-bottom: 15px;">
		<a href="<?php echo base_url();?>"> <img src="http://www3.icd.gov.vn/images/ads/ads.png"/></a>
	</div>
  </div>
-->
