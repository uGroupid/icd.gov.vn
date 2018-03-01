<style>
.foter_container p{margin-bottom:0;}
h3.ten-cuc{font-size:34px;margin:20px 0 0;}
h3.truc-thuoc{font-size:8px;float:right;text-transform: uppercase;margin-top:8px;}
@media (min-width: 1200px){
.span10 {
    width: 1050px;
}	
}
@media (max-width: 500px){
h3.ten-cuc{font-size:25px;}	
h3.truc-thuoc{margin-top:2px;}
}
</style>
<div class="foter_container" >
<div class="container">  

	
			<!--
			<div class="span4">
					<div class="panel_pane">
						<h2 class="pane_title">Bản Đồ</h2>
						<div class="pane-content">
						
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.3176592268246!2d105.853585!3d21.019972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abed46ce258d%3A0x649c3afc209aa6ea!2zNTEgTmfDtCBRdXnhu4FuLCBIw6BuZyBCw6BpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1437655910055" width="100%" height="235" frameborder="0" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
			</div>
			<div class="span4">
					<div class="panel_pane">
						<h2 class="pane_title">Địa Chỉ</h2>
						<div class="pane_content">
							<p>
								Cục Hợp Tác Quốc Tế </br>
								Bộ Văn Hóa Thể Thao và Du Lịch</br>
								Số 51 Ngô Quyền - Quận Hoàn Kiếm<br>
								Hà Nội - Việt Nam.
							</p>
							<p style="margin-bottom:0;">
								Phone: <span class="skype_c2c_print_container notranslate">
								(84)-(04)-3.943.4217 or </span>(84)-(04)-3.943.4217</span>
								<br>
								Fax: (84)-(04)-3.943.7101
							</p>
						</div>
					</div>
			</div>
			<div class="span4">
					<div class="panel_pane">
						<h2 class="pane_title">Thời Gian Làm Việc</h2>
						<div class="pane_content">
							<h3><a href="#">Lịch Làm Việc Hành Chính</a></h3>
							<p>
								Thứ hai - Thứ sáu - 7:30am-5:30pm
							</p>
							<p>
								Thứ bảy, Chủ nhật - Đóng
							</p>
						<div class="social-links">
								<h3>Kết Nối Với Chúng Tôi</h3>
								
								<div class="clear">
								</div>
								<a href="https://www.facebook.com/ICD.Mocst" target="_blank" title="Cuc Hop Tac Quoc Te"><img class="icon-library" src="<?php echo base_url();?>images/footer/N-YHS_Facebook.png" alt="Cuc Hop Tac Quoc Te"></a>
								<a href="#" target="_blank" title="Cuc Hop Tac Quoc Te"><img class="icon-library" src="<?php echo base_url();?>images/footer/icon-twitter.png" alt="Cuc Hop Tac Quoc Te"></a>
								<a href="https://www.youtube.com/channel/UCmHPE1ihUcdm2LbY4TPIwlA" target="_blank" title="Cuc Hop Tac Quoc Te"><img class="icon-library" src="<?php echo base_url();?>images/footer/icon-youtube.png" alt="Cuc Hop Tac Quoc Te"></a>
								<a href="#" target="_blank" title="Cuc Hop Tac Quoc Te"><img class="icon-library" src="<?php echo base_url();?>images/footer/icon-itunes.png" alt="Cuc Hop Tac Quoc Te"></a>
								<div class="clear">
								</div>
							</div>
						</div>
						
					</div>
			</div> -->
			
<!-- </div> -->
	
  <div class="row" style="padding:20px;">
	<div class="span5" style="margin-top: 0; float:left;">
		<div style="float:left;">
			<img src="http://www3.icd.gov.vn/images/logo.png" style="width:80px;" />
		</div>
		<div style="float:right;">
			<h3 class="ten-cuc" style="    font-size: 20px;">International Cooperation Department </h3>
			<h3  class="truc-thuoc" style="">Ministry of of Culture, Sports and Tourism</h3>
		</div>
	  
    </div>
    <div class="span6" style="float:right;" >
      <?php 
			$data_footer = $this->callbuyMD->data_config_footer();
				foreach($data_footer as $value_data_footer){}
					echo  $value_data_footer['name_eng'];
			?>
    </div>

    
  </div>
</div>
</div>
</body>
</html>