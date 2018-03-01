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
							
							<h3 class="title_heading_wp_list_container_left"><img style="margin-top: -8px;" src="<?php echo base_url();?>images/icon_list.png" /> <?php echo $title; ?> </h3>
						</div>
					</div>
				
					<div class="news_active_category_list_pages">
						<div class="span">
              <div class="search_document">
                <div class="Sub-page-right-column">
                  <form name="vanban" method="post" action="http://icd.gov.vn/document/search" id="vanban">
                    <h4 class="Search-form-heading">Tra cứu văn bản</h4>
                    <table style="width: 100%;" border="0" cellspacing="0" cellpadding="3">
                    <tbody>
                    <tr style="float: left;width: 100%;">
                      <td style="float: left;width: 50%;">
                        <span class="Search-form-label">Từ khóa liên quan</span></br>
                        <span class="Search-form-label"></span></br>
                        
                        <input name="keywords" type="text" id="" class="Search-form-input" style="width:100%;"><br>
                        <span class="Search-form-comment"></span>
                      </td>
                    
                      <td style="float: left;width: 30%;">
                        <span class="Search-form-label">Loại văn bản</span><br>
                           <span class="Search-form-label"></span></br>
                        <select name="loaivanban" id="" class="Search-form-input" style="width:100%;">
                          <option selected="selected" value="0">Tất Cả Tài Liệu</option>
                          <?php 
                            $select_data = $this->callbuyMD->select_box_document();
                              foreach( $select_data as $value_select_document){
                          ?>
                          <option value="<?php echo $value_select_document['id_danhmuc'];?>"><?php echo $value_select_document['name_vi'];?></option>
                         <?php } ?>
                        </select>
                        <br>
                        <span class="Search-form-comment">&nbsp;</span>
                      </td>
                      <td>
                         <span class="Search-form-label"></span><br>
                           <span class="Search-form-label"></span></br>
                        <input class="btn btn-danger" value="Tìm Kiếm" type="submit" name="vanban"><br>
                         <span class="Search-form-comment">&nbsp;</span>
                      </td>
                    </tr>
                    </tbody>
                    </table>
                  </form>
                </div>
              </div>
							<div class="news_hot_catelogy_list_pages" style="margin-bottom: 34px; width: 100%; float: left; ">
                <ul style="margin:0px;">
                    <?php foreach($datacontent as $value_datacontent){;?>
                    <li class="fix_bar_document">
                        
                      <a  href="<?php echo base_url().'document/files/'.to_slug($value_datacontent['title_vi']).'/'.$value_datacontent['id'].'.icd'; ?>"> <?php echo  $value_datacontent['title_vi']; ?></a>
                      <div class="Info"> <span class="Number">Số: <?php echo  $value_datacontent['number_symbol']; ?></span>&nbsp;&nbsp; <span class="Label">Ngày ban hành: </span><span class="Value"><?php echo  $value_datacontent['date_issued']; ?></span>&nbsp;&nbsp;<span class="Value"></span>&nbsp;&nbsp; <span class="Label">Loại văn bản: </span><span class="Value">
                        <?php 
                          $data_document_type = $this->callbuyMD->getdocument_submenu($value_datacontent['sub_menu']);
                            foreach($data_document_type as $value_document){
                             echo  $value_document['name_vi'];
                            }
                        ?>
                      </span></div>
                    
                    </li>
                    <?php } ?>
                    
                </ul>
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
