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
<?php if($idcontent == 23){ ?>
<style>
	.boxright1{border:1px solid #ccc;    padding-right: 10px;}
	.boxright1 h2{margin-left:23px;margin-bottom: 20px;font-size: 20px;}
	.boxright1 ul{    list-style-type: square !important;    margin-left: 40px;}
	
	.boxright1 p.title-parent{    margin-bottom: 0;}
	.boxright1 .title-child{padding-left:15px;}
	.boxright1 ul.title-child{    list-style-type: decimal !important;padding-left:0;}
	.boxright1 a{display:block;color:#000}
	.boxright1 a.dropdown{background:url(/images/ar2.png) no-repeat 0 3px;padding-left:20px;}
	.boxright1 a:hover{display:block;color: hsl(0, 98%, 43%);}
	.boxright1 .fade-ul{display:none;}
	.boxright1 .hide-fade{display:none;background:url(/images/ar3.png) no-repeat 0 0 !important;}
	.boxright1 .show-fade{background:url(/images/ar2.png) no-repeat 0 3px;}
</style>
<script>
	$(document).ready(function(){
		$(".show-fade").click(function(){
			$(".hide-fade").show();
			$(this).hide();
			$(".fade-ul").animate({
				height: 'show'
			});
		});
		$(".hide-fade").click(function(){
			$(".show-fade").show();
			$(this).hide();
			$(".fade-ul").animate({
				height: 'hide'
			});
		});
	});
</script>		
<?php } ?>
<div class="container">
	<div class="wp_list_container">
		<div class="row">
			
			<div class="span8">
				<div class="wp_list_container_left">
					<div class="span" id="heading_wp_list_container_left">
						<div class="heading_wp_list_container_left">
							
							<h3 class="details_title_heading_wp_list_container_left">
								<img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> 
								<?php $nametitles = to_slug($nametitle); ?>
								<a href="<?php echo base_url();?>category/dic/<?php echo $nametitles;?>/<?php echo $iddanhmuc;?>.icd" /> <?php echo $nametitle; ?> </a></h3>
						</div>
					</div>
					<?php foreach($datacontent as $value_content_details){} ?>
					<div class="details_content_data">
						<div class="span7">
							<div class="details_content_li_list_wp_list_container_left">
									<div class="details_content_list_content_pages">
									  <h1 class="details_text_headering_home_list" style="line-height: 25px;">
										<span ><?php echo $value_content_details['title_conent_en']; ?></span>
									  </h1>
									  <div class="details_title_v1_home">
										
											<i><h5 class="details_title_home_center_layout3"> 
												<?php echo $value_content_details['introduction_en']; ?> </h5>
											</i>
										
									  </div>
									</div>
									<div class="details_images_list_content_pages" >
										<div class="details_content_v1_home" style="padding-bottom: 20px;">
										<a href="#" title="<?php echo $value_content_details['title_conent_en']; ?>"> 
											<img class="details_img_content_v1_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_content_details['img']; ?>"  alt="<?php echo $value_content_details['title_conent_en']; ?>" /> 
										</a>
										</div>
									</div>
									<div class="details_content_pages">
										<?php echo $value_content_details['content_en']; ?>
									</div>
							</div>
						</div>
              <hr> 
            <div class="span7">
               <div class="group__header">
                   <span style="float: left; margin-right: 20px;" class="share__title share__title--lightweight">
                    Share  
                    </span>
                    <div style="float: left; margin-top: 10px;" class="addthis_native_toolbox"></div>
                 </div>
               <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-570c8017a57c6f90"></script>
            </div> 
            <div class="span7">
            <div class="group__header"> <h2 class="group__title">Related news</h2> </div>
            <ul class="units-list ">
                  <?php foreach($task_Tin_Lien_Quan as $value_tin_lien_quan){ ?>
                      <li class="unit unit--regular" data-entityid="more-on-this-story#1"> 
                        <a href="<?php echo base_url();?>details/dic/<?php echo $value_tin_lien_quan['id_content']; ?>/tin-su-kien/<?php echo to_slug($value_tin_lien_quan['title_conent_en']); ?>/<?php echo $value_tin_lien_quan['sub_menu']; ?>.icd" title="<?php echo $value_tin_lien_quan['title_conent_en']; ?>">
                              <div class="unit__body">
                              <div class="unit__header">  
                                  <div class="unit__title">    
                                      <span class="cta"> 
                                          <?php echo $value_tin_lien_quan['title_conent_en'];?>
                                      </span> 
                                  </div>  
                              <div class="unit__meta"> 
                                <div class="relative-time" >
                                    <?php echo $value_tin_lien_quan['date_upload'];?>
                                </div> 
                              </div>  
                              </div> 
                              </div>
                        </a> 
                      </li>
                  <?php } ?>
              </ul>
            </div>
					</div>
					
					
				</div>
			</div>
		
			<div class="span4">
				<?php if($idcontent == 23){ ?>
				<div class="boxright1">
					<h2 class="top-stories-promo__title">Ministry of Culture, Sports and Tourism</h2>
					<ul>
						<li><a href="/en/category/dic/ho-so-lanh-dao-bo/7.icd" title="Lãnh Đạo Bộ Văn hoá, Thể thao và Du lịch">Leadership Ministry of Culture, Sports and Tourism</a></li>
						<li><a href="/en/details/dic/23/co-cau-bo-van-hoa-the-thao-va-du-lich/gioi-thieu-chuc-nang-nhiem-vu---co-cau-to-chuc-bo-van-hoa-the-thao-va-du-lich/6.icd" title="Cơ Cấu Tổ Chức">Organizational structure</a></li>
						
					</ul>
					<div style="height:1px;border-bottom:1px dotted #ccc;    margin: 0 20px;"></div>
					<h2 class="top-stories-promo__title">Department of international cooperation</h2>
					<ul>
						<li><a href="/en/page/gioi_thieu/1/cuc-hop-tac-quoc-te/cuc-hop-tac-quoc-te/5.icd" title="Chức năng nhiệm vụ của Cục Hợp Tác Quốc Tế">Functions and tasks of the Department of International Cooperation</a></li>
						<li><p class="title-parent">Organizational structure</p>
							<div class="title-child">
								<a class="dropdown" href="/en/page/ho_so_lanh_dao_cuc/1/lanh-dao-cuc-hop-tac-quoc-te.icd" title="Lãnh đạo Cục Hợp Tác Quốc Tế">Leaders of International Cooperation Department</a>
							
								<a class="dropdown hide-fade" href="javascript:void(0);" title="Các phòng nghiệp vụ, chuyên môn">The provision, expertise</a>
								<ul class="title-child fade-ul">
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/2/van-phong.icd" title="Văn phòng">Office structure</a></li>
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/3/phong-ke-toan-tai-chinh.icd" title="Phòng Kế toán Tài chính">Finance and Accounting Department</a></li>
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/1/lanh-dao-cuc-hop-tac-quoc-te.icd" title="Phòng Châu Âu">European Department</a></li>
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/5/phong-chau-my---chau-phi.icd" title="Phòng Châu Mỹ - Châu Phi">Americas - Africa Department</a></li>
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/6/phong-chau-a---thai-binh-duong.icd" title="Phòng Châu Á - Thái Bình Dương">Asia - Pacific Department</a></li>
									<li><a  href="/en/page/ho_so_lanh_dao_cuc/7/trung-tam-quang-ba-van-hoa-the-thao-va-du-lich.icd" title="Trung tâm Quảng bá Văn hoá, Thể thao và Du lịch">Centre for Promotion of Culture, Sports and Tourism</a></li>
								</ul>
							</div>
						</li>
						
					</ul>
				</div>
				<?php } ?>
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
