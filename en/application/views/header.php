<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
		 <link rel="shortcut icon" href="<?php echo base_url() ?>images/favicon.ico">
		<title><?php echo $title; ?> </title>
		<meta name="generator" content="<?php echo $keywords; ?>"/>
		<meta name="description" content="<?php echo $description; ?>" />
		<meta name="keywords" content="<?php echo $keywords; ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
		<meta name="googlebot" content="<?php echo $keywords; ?>" />
		<meta name="robots" content="index, follow" />
		<link rel="alternate" title="<?php echo $title; ?>" hreflang="VN" href="<?php echo base_url().uri_string();?>" />
		<link rel="alternate" type="application/rss+xml" title="<?php echo $keywords; ?>" href="<?php echo base_url() ?>"/>
		<link rel="alternate" type="application/rss+xml" title="<?php echo $keywords; ?>" href="<?php echo base_url() ?>"/>
		<link rel="alternate" type="application/rss+xml" title="<?php echo $keywords; ?>" href="<?php echo base_url() ?>"/>
		<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "WebSite",
		  "url": "<?php echo base_url() ?>",
		  "potentialAction": {
			"@type": "SearchAction",
			"target": "https://www.google.com/#q={search_term_string}",
			"query-input": "required name=search_term_string"
		  }
		}
		</script>
		<!-- script Bootstap-->
		<!--<script type='text/javascript' src="<?php echo base_url() ?>bootstrap/v2.2/jquery.js"></script>-->
		 <script src="<?php echo base_url() ?>bootstrap/v2.2/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>bootstrap/v2.2/bootstrap.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Arimo:400,400italic,700,700italic' rel="stylesheet" type="text/css">
		 <script src="<?php echo base_url() ?>iatek/jquery.share.js"></script>
     		<link rel="stylesheet" href="<?php echo base_url() ?>iatek/jquery.share.css" type="text/css" media='screen'/>
		<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/v2.2/bootstrap.css" type="text/css" media='screen'/>
		<link rel="stylesheet" href="http://icd.gov.vn/css/system.css" type="text/css" media='screen'/>
	
		<link rel="stylesheet" href="<?php echo base_url() ?>bootstrap/v2.2/bootstrap-responsive.css" type="text/css" media='screen'/>
		
		<link rel="EditURI" type="application/rsd+xml" title="<?php echo $title; ?>" href="<?php echo base_url().uri_string();?>"/>
		<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo base_url().uri_string();?>"/>
		<link rel='canonical' title="<?php echo $title; ?>" href="<?php echo base_url().uri_string();?>"/>
		<link rel='shortlink' title="<?php echo $title; ?>" href="<?php echo base_url().uri_string();?>"/>
		<style>
			a{text-decoration:none}
			ul.nav li.dropdown:hover > ul.dropdown-menu {
				display: block;
			}
		</style>
	</head>
<body>
<?php
 function to_slugs($str) {
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
	<div class="row">
		<div class="span5">
			<!--
			<div class="header_idont_like_box_languge_vn">
				<a href="<?php echo base_url();?>"> <img class="icon_home_deaser_active_vn" src="<?php echo base_url(); ?>images/icon_vn.png"> </a>
				<a href="http://icd.gov.vn/en"> <img class="icon_home_deaser_active_vn" src="<?php echo base_url(); ?>images/icon_en.png"></a>
			</div>
			-->
		</div>
		<div class="span7">
			
			<div class="header_idont_like_box_search_box">
		
		
        	<form action="<?php echo base_url();?>search" method="$_POST">
				<table style="width: 100%; margin: auto;">
					<tr style="float: right;">
						<td>
							<ul class="header_ul_very" > 
								<li class="header_li_very"> <a style="font-weight: bold;" href="<?php echo base_url();?>contact.icd">Contact Us |</a>  </li>
								<li  class="header_li_very"> <a style="font-weight: bold;" href="<?php echo base_url();?>discussion_question.icd"> FAQs  | </a> </li>
								<li  class="header_li_very"> <a style="font-weight: bold;" href="http://icd.gov.vn"> Tiếng Việt | </a> </li>
								<li  class="header_li_very"><a style="font-weight: bold;" href="http://icd.gov.vn/en">  English  </a> </li>
							</ul>
								<style> 
								.header_li_very{
									    float: left;
										padding-left: 10px;
								}
								.header_li_very a{
									   
									font-weight: bold;
									font-family: Arial,sans-serif;
									font-size: 14px;
									color: #000;
								}
								.header_li_very a:hover{
									   
									font-weight: bold;
									font-family: Arial,sans-serif;
									font-size: 14px;
									color: #9f0000;
								}
								.header_ul_very{
									       padding-bottom: 14px;
										margin-right: 4px;
										text-align: center;
								}
								.ul_headrer_nava{
									padding-left:5px;
									padding-right:5px;
								}
								
								</style>
							<input type="text"  name="q"  class="span4" id="search_index" placeholder="Search..">
						</td>
					<td>
						<input type="submit"  id="btn_search" value="" style="float:left; margin-top: 15px;"/>
					</td>
					</tr>
				</table>
        </form>
			</div>
		</div>
	</div>
</div>
<div class="container"> 


		  <!-- Fixed navbar -->
  

        <nav class="navbar navbar-inverse" role = "navigation">
          <div class="navbar-inner">
            <button style="float: left;" type="button" class="btn btn-navbar" aria-expanded="false" data-toggle="collapse" data-target=".nav-collapse" aria-controls="navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="collapse nav-collapse">
              <ul class="nav navbar-nav">
                <li class="ul_headrer_nava"><a href="<?php echo base_url();?>"><span> <img class="icon_home_deaser_active" src="<?php echo base_url(); ?>images/icon_home.png"></span>Home</a></li>
                <li class="ul_headrer_nava">
                  <a style="font-weight: bold;" href="#" class="dropdown-toggle" data-toggle="dropdown" onclick="location.href='<?php echo base_url();?>page/gioi_thieu/1/cuc-hop-tac-quoc-te/cuc-hop-tac-quoc-te/5.icd';">About Us<b class=""></b></a>
                  
                </li>
				<li class="ul_headrer_nava"><a style="font-weight: bold;" href="<?php echo base_url();?>category/dic/su-kien-cua-chung-toi/10.icd">Events</a></li>
				<?php $tbl_get_header_danhmuc = $this->callbuyMD->tbl_get_header_danhmuc();
				
				foreach($tbl_get_header_danhmuc as $value_tbl_get_header_danhmuc){
					
				?>
				 <li class="dropdown ul_headrer_nava">
                  <a href="#" style="font-weight: bold;" class="dropdown-toggle" data-toggle="dropdown"><?php echo $value_tbl_get_header_danhmuc['name_en'] ; ?><b class="caret"></b></a>
                  <ul class="dropdown-menu">
					<?php $data_menu_sub_header = $this->callbuyMD->tbl_get_header_danhmuc_sub($value_tbl_get_header_danhmuc['id_danhmuc']);
						
						foreach($data_menu_sub_header as $value_data_menu_sub_header){
						
						$idmenu = $value_data_menu_sub_header['id_danhmuc'];
						
						$title_url_gioithieu = strtolower(trim($value_data_menu_sub_header['name_en']));
						
						
					?>
					<?php $url = to_slugs($title_url_gioithieu);?>
                    <li>
						<a href="<?php echo base_url();?>category/dic/<?php echo $url;?>/<?php echo $idmenu;?>.icd" title="<?php echo $value_data_menu_sub_header['name_en']; ?>" alt="<?php echo $value_data_menu_sub_header['name_en']; ?>"><?php echo $value_data_menu_sub_header['name_en']; ?></a></li>
					<?php } ?>
                  </ul>
                </li> 
				<?php } ?>
            <li class="ul_headrer_nava"> <a href="<?php echo base_url();?>document" style="font-weight: bold;" >Documents </a> </li>
            <li class="dropdown ul_headrer_nava">
                  <a href="#" style="font-weight: bold;" class="dropdown-toggle" data-toggle="dropdown">Photos <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url();?>category/dic/tin-anh/31.icd">News</a></li>
                    <li><a href="<?php echo base_url();?>gallery">Library</a></li>
                    <!--<li><a href="#">Người Việt bốn phương</a></li>-->
                  </ul>
                </li>
				
				<li class="dropdown ul_headrer_nava">
                  <a href="#" style="font-weight: bold;" class="dropdown-toggle" data-toggle="dropdown">Video  <b class="caret"></b></a>
                  <ul class="dropdown-menu">
						<?php 
						$get_header_video = $this->callbuyMD->get_header_video();
						foreach($get_header_video  as $value_header_video){
						$url_video = to_slugs($value_header_video['name_en']);
						?>
					 <li><a href="<?php echo base_url();?>video/dic/<?php echo $url_video;?>/<?php echo $value_header_video['id_danhmuc']; ?>.icd"><?php echo $value_header_video['name_en']; ?></a></li>
					 <?php } ?>
                  </ul>
                </li>
				<li class="ul_headrer_nava"> <a style="font-weight: bold;" href="<?php echo base_url();?>category/dic/viet-nam-cultural-centers-abroad/27.icd">Viet Nam Cultural Centers Abroad</a></li>
				<li class="ul_headrer_nava"><a style="font-weight: bold;" href="<?php echo base_url();?>category/dic/the-gioi-voi-viet-nam/25.icd">Viet Nam and the World </a></li>
				<!--<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hộp thư và Tải về <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a target="_blank" href="http://mail.icd.gov.vn">Hộp thư </a></li>
                    <li><a href="#">Tải về </a></li>
                  </ul>
                </li> 
                <li><a style="font-weight: bold;" href="#">Trao đổi & Hỏi đáp</a></li>
                <li><a style="font-weight: bold;" href="#">Liên hệ</a></li>
				-->
				</ul>
            </div><!--/.nav-collapse -->
          </div><!-- /.navbar-inner -->
        </nav><!-- /.navbar -->
		
	
	</div> 



	
