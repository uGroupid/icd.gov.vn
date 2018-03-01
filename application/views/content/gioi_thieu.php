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
<div class="container">
	<ol class = "breadcrumb">
	   <li><a href = "http://icd.gov.vn/">Trang chủ</a></li>
	   <li class = "active">Giới thiệu</li>
	</ol>
</div>
<div class="container">
	<div class="wp_list_container">
		<div class="row">
			
			<div class="span8">
				<div class="wp_list_container_left">
					<div class="span" id="heading_wp_list_container_left">
						<div class="heading_wp_list_container_left">
							
							<h3 style="text-transform: uppercase; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; color: #D90202 !important; width: 100%;" class="details_title_heading_wp_list_container_left">
								<img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> 
								<?php $nametitles = to_slug($nametitle); ?>
								<a style="text-transform: uppercase; font-family: Helvetica Neue,Helvetica,Arial,sans-serif; color: #222 !important; width: 100%;" href="<?php echo base_url();?>/category/dic/<?php echo $nametitles;?>/<?php echo $iddanhmuc;?>.icd" /> <?php echo $nametitle; ?> </a></h3>
						</div>
					</div>
					<?php foreach($datacontent as $value_content_details){} ?>
					<div class="details_content_data">
						<div class="span7">
							<div class="details_content_li_list_wp_list_container_left">
									<div class="details_content_list_content_pages">
									  <h1 class="details_text_headering_home_list" >
										
									  </h1>
									  <div class="details_title_v1_home">
										
											<p style='color: rgb(51, 51, 51); font-family: Arial,sans-serif; font-size: 12px; line-height: 20px;' class="details_title_home_center_layout3"> 
												<?php echo $value_content_details['introduction']; ?></p>
											
										
									  </div>
									</div>
									<div class="details_images_list_content_pages" >
										<div class="details_content_v1_home" style="padding-bottom: 20px;">
										<a style=" font-family: Arial,sans-serif; color: rgb(217, 2, 2); width: 100%;" href="#" title="<?php echo $value_content_details['title_conent_vi']; ?>"> 
											<img style="width: 254px ! important; margin: auto;" class="details_img_content_v1_home" src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_content_details['img']; ?>"  alt="<?php echo $value_content_details['title_conent_vi']; ?>" /> 
										</a>
										</div>
									</div>
									<div class="details_content_pages">
										<?php echo $value_content_details['content_vi']; ?>
										
										<div class="source_website">
											<a href="<?php echo base_url(); ?>"> CTTĐT: (www.idc.gov.vn) </a>
										</div>
									</div>
							</div>
						</div>
					</div>
					
					
				</div>
			</div>
		
			<div class="span4">
				<div class="boxright1">
					<h2 class="top-stories-promo__titles">Bộ Văn Hóa, Thể Thao và Du Lịch</h2>
					<ul>
						<li><a href="/category/dic/ho-so-lanh-dao-bo/7.icd" title="Lãnh Đạo Bộ Văn hoá, Thể thao và Du lịch">Lãnh Đạo Bộ Văn hoá, Thể thao và Du lịch</a></li>
						<li><a href="/details/dic/23/co-cau-bo-van-hoa-the-thao-va-du-lich/gioi-thieu-chuc-nang-nhiem-vu---co-cau-to-chuc-bo-van-hoa-the-thao-va-du-lich/6.icd" title="Cơ Cấu Tổ Chức">Cơ Cấu Tổ Chức</a></li>
						
					</ul>
					<div style="height:1px;border-bottom:1px dotted #ccc;    margin: 0 20px;"></div>
					<h2 class="top-stories-promo__titles">Cục hợp tác quốc tế</h2>
					<ul>
						<li><a href="/page/gioi_thieu/1/cuc-hop-tac-quoc-te/cuc-hop-tac-quoc-te/5.icd" title="Chức năng nhiệm vụ của Cục Hợp Tác Quốc Tế">Chức năng nhiệm vụ của Cục Hợp Tác Quốc Tế</a></li>
						<li><p class="title-parent">Cơ cấu tổ chức</p>
							<div class="title-child">
								<a class="dropdown" href="/page/ho_so_lanh_dao_cuc/1/lanh-dao-cuc-hop-tac-quoc-te.icd" title="Lãnh đạo Cục Hợp Tác Quốc Tế">Lãnh đạo Cục Hợp Tác Quốc Tế</a>
								<a class="dropdown show-fade" href="javascript:void(0);" title="Các phòng nghiệp vụ, chuyên môn">Các phòng nghiệp vụ, chuyên môn</a>
								<a class="dropdown hide-fade" href="javascript:void(0);" title="Các phòng nghiệp vụ, chuyên môn">Các phòng nghiệp vụ, chuyên môn</a>
								<ul class="title-child fade-ul">
									<li><a  href="/page/ho_so_lanh_dao_cuc/2/van-phong.icd" title="Văn phòng">Văn phòng</a></li>
									<li><a  href="/page/ho_so_lanh_dao_cuc/3/phong-ke-toan-tai-chinh.icd" title="Phòng Kế toán Tài chính">Phòng Kế toán Tài chính</a></li>
									<li><a  href="/page/ho_so_lanh_dao_cuc/4/lanh-dao-cuc-hop-tac-quoc-te.icd" title="Phòng Châu Âu">Phòng Châu Âu</a></li>
									<li><a  href="/page/ho_so_lanh_dao_cuc/5/phong-chau-my---chau-phi.icd" title="Phòng Châu Mỹ - Châu Phi">Phòng Châu Mỹ - Châu Phi</a></li>
									<li><a  href="/page/ho_so_lanh_dao_cuc/6/phong-chau-a---thai-binh-duong.icd" title="Phòng Châu Á - Thái Bình Dương">Phòng Châu Á - Thái Bình Dương</a></li>
									<li><a  href="/page/ho_so_lanh_dao_cuc/7/trung-tam-quang-ba-van-hoa-the-thao-va-du-lich.icd" title="Trung tâm Quảng bá Văn hoá, Thể thao và Du lịch">Trung tâm Quảng bá Văn hoá, Thể thao và Du lịch</a></li>
								</ul>
							</div>
						</li>
						
					</ul>
				</div>
				<div class="wp_list_container_right">
					
					<ul class="list_v1_home">

          <h2 class="top-stories-promo__title">Tin sự kiện</h2>
          <?php foreach($task_even_calendar as $value_task_even_calendar){ ?>
        
					<?php $url_task = to_slug($value_task_even_calendar['title_conent_vi']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_task_even_calendar['id_content']; ?>/tin-su-kien/<?php echo $url_task; ?>/<?php echo $value_task_even_calendar['sub_menu']; ?>.icd" title="<?php echo $value_task_even_calendar['title_conent_vi']; ?>">
								    <strong class="top-stories-promo-story__title"><?php echo $value_task_even_calendar['title_conent_vi'];?></strong>
                   <p class="top-stories-promo-story__summary ">
                        
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
                  <img src="http://www3.icd.gov.vn/assets/uploads/content/<?php echo $value_hot_news['img'];?>"  title="<?php echo $value_hot_news['title_conent_vi'];?>"/> 
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
