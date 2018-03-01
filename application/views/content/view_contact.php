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
	<ol class = "breadcrumb">
	   <li><a href = "http://icd.gov.vn/">Trang chủ</a></li>
	   <li class = "active">Liên hệ</li>
	   
	</ol>
</div>
<div class="container">
	<div class="wp_list_container">
		<div class="row">
			
			<div class="span8">
				<div class="wp_list_container_left">
					<div class="span" id="heading_wp_list_container_left">
						<div class="heading_wp_list_container_left">
							
							<h3 class="details_title_heading_wp_list_container_left">
								<img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> 
								<a href="#" /> liên hệ</a></h3>
						</div>
					</div>
					<?php foreach($datacontent as $value_content_details){} ?>
					<div class="details_content_data">
						<div class="span7">
							<div class="details_content_li_list_wp_list_container_left">
									<div class="span3">
										<div class="details_content_list_content_pages">
										<form class="form-horizontal" role="form" method="post" action="index.php">
												<div class="form-group">
													<label for="name"> Họ và tên: </label>
												   <input type="text" class="form-control" id="name" name="name" placeholder=" họ và tên" value="">
													
												</div>
												<div class="form-group">
													<label for="email" >Thư điện tử :</label>
													<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="">
												</div>
												<div class="form-group">
													<label for="message" >Ý kiến đóng góp: </label>
													<textarea id="message" class="form-control" rows="4" name="message"></textarea>
												</div>
												<div class="form-group">
													<div class="col-sm-10 col-sm-offset-2">
														<input id="button_contact" name="submit" type="submit" value=" Ý kiến đóng góp" class="btn btn-primary">
													</div>
												</div>
											</form>
										  </div>
										</div>
									</div>
									<script>
										$( document ).ready(function() {
											$( "#button_contact" ).click(function() {
												
												var name = 	$( "#name" ).val();
												var email = 	$( "#email" ).val();
												var message = 	$( "#message" ).val();
												if(name == '' || email == '' || message == ''){
													alert("Vui lòng không để trống");
												}else{
												 $.ajax({
												  method: "POST",
												  url:'<?php echo base_url(); ?>contact/contact_int',
												  data: { name: name, email: email, message: message}
													})
												  .done(function( msg ) {
													 
													if(msg == 1){
														alert(" Yêu cầu của bạn đã gửi đi thành công chúng tôi sẽ liên lạc với quản trị viên");
													}
												  });
												}	
											}); 		
										});
										</script>
									<style>
									.form-group{
										    margin-bottom: 12px;
									}
									</style>
									<div class="span3">
										<div class="details_images_list_content_pages" >
											<div class="details_content_v1_home" style="padding-bottom: 20px;">
											<h1 style="line-height: 19px; font-size: 18px; text-transform: uppercase; font-family: Arial,sans-serif; color: rgb(203, 30, 30); "> <?php echo $value_content_details['title']; ?></h5></h1>
											<i><h5 class="details_title_home_center_layout3"> 
													<?php echo $value_content_details['contact']; ?></h5>
												</i>
											</div>
										</div>
									</div>
									<div class="span7">
									<div class="details_content_pages">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3176592268246!2d105.853585!3d21.019972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abed46ce258d%3A0x649c3afc209aa6ea!2zNTEgTmfDtCBRdXnhu4FuLCBIw6BuZyBCw6BpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1437655910055" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
							
											
										
									</div>
									</div>
							</div>
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
