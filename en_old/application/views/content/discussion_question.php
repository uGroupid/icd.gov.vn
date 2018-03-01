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
							
							<h3 class="details_title_heading_wp_list_container_left">
								<img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> 
								<a href="#" /> EXCHANGE & FAQs </a></h3>
						</div>
					</div>
					
					<div class="details_content_data">
						<div class="span7">
							<div class="details_content_li_list_wp_list_container_left">
									<div class="details_content_list_content_pages">
									  <h1 class="details_text_headering_home_list" >
										<span ></span>
									  </h1>
									  <div class="details_title_v1_home">
										
											<h4> Posted FAQ</h4>
											<form>
											  <div class="form-group">
												<label for="email_questions">Email: </label>
												<input type="email" class="form-control" id="email_questions" placeholder="example@icd.com">
											  </div>
											  <div class="form-group">
												<label for="Questions">Your question title: </label>
												<textarea id="your_questions_title" class="span6 form-control" rows="2" placeholder="(Vui Lòng Nhập Câu hỏi Của Bạn ở đây..)"></textarea>
											  </div>
											  <div class="form-group">
												<label for="Questions">Your Questions Content: </label>
												<textarea id="your_questions_content" class="span6 form-control" rows="4" placeholder="(Vui Lòng Nhập Chi Tiết ý Câu hỏi Của Bạn ở đây..)"></textarea>
											  </div>
											  <button id="int_your_questions" type="submit" class="btn btn-default"> Posted Questions</button>
											</form>
										
									  </div>
									</div>
									<div class="details_images_list_content_pages" >
									
									
										<div class="details_content_v1_home" style="padding-bottom: 20px;">
										
											<ol>
											<?php foreach($datacontent as $value_content_details){ ?>
												<li>
												
												 <h3 class="details_text_headering_home_list_que" >
													<span data-toggle="collapse" data-target="#demo<?php echo  $value_content_details['id']; ?>" ><?php echo  $value_content_details['title']; ?></span>
												  </h3>
												  <div id="demo<?php echo  $value_content_details['id']; ?>" class="collapse">
													<i>
														<blockquote>
															<span class="blockquote_details_text_headering_home_list"> Posted By: <?php echo  $value_content_details['user_post']; ?> - <?php echo  $value_content_details['date_contact']; ?></span>
															<p class="details_title_home_center_layout3"> 
																""
																	<?php echo  $value_content_details['introduction']; ?>
																""
															</p>
														</blockquote>
														<textarea class="span6 form-control" rows="4"></textarea>
														 <button type="submit" class="btn btn-default">Leave a comment</button>
														 <hr>
														<p  class="blockquote-reverse">
														
																""
																	No comments yet
																""
														
														</p >
													</i>
												  </div>
												</li>
											<?php } ?>
											</ol>
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
				<div class="wp_list_container_right">
					
					<ul class="list_v1_home">

          <h2 class="top-stories-promo__title">News Event</h2>
          <?php foreach($task_even_calendar as $value_task_even_calendar){ ?>
        
					<?php $url_task = to_slug($value_task_even_calendar['title_conent_vi']);?>
						<li class="li_data_task_hotnews">
							<a href="<?php echo base_url();?>details/dic/<?php echo $value_task_even_calendar['id_content']; ?>/tin-su-kien/<?php echo $url_task; ?>/<?php echo $value_task_even_calendar['sub_menu']; ?>.icd" title="<?php echo $value_task_even_calendar['title_conent_vi']; ?>">
								    <strong class="top-stories-promo-story__title"><?php echo $value_task_even_calendar['title_conent_vi'];?></strong>
                   <p class="top-stories-promo-story__summary ">
                        <?php echo $value_task_even_calendar['introduction'];?>
                  </p>
              <div class="dates" >
                  <?php echo $value_task_even_calendar['date_upload'];?></div>
              </a>
              
						</li>
					<?php } ?>
          <h2 class="features-and-analysis__title"> The Angle & categories</h2>
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
<script>
$( document ).ready(function() {
	$( "#int_your_questions" ).click(function() {
		
		var email_questions = 	$( "#email_questions" ).val();
		var your_questions_content = 	$( "#your_questions_content" ).val();
		var your_questions_title = 	$( "#your_questions_title" ).val();
		if(email_questions == '' || your_questions_content == ''|| your_questions_title == ''){
			alert("Please do not leave blank");
		}else{
		 $.ajax({
		  method: "POST",
		  url:'<?php echo base_url(); ?>discussion_question/question_int',
		  data: { email_questions: email_questions, your_questions_content: your_questions_content, your_questions_title: your_questions_title}
			})
		  .done(function( msg ) {
			
			if(msg == 1){
				alert("Your request has been sent successfully we will contact administrator");
			}
		  });
		}	
	}); 		
});
</script>