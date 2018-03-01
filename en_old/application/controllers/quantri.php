<?php
class Quantri extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		$this->load->library('session');
        $this->load->helper('url');
			$loggedIn = $this->session->userdata('logged_in');
			if($loggedIn == NULL){
				return redirect('http://www3.icd.gov.vn');
			}return true;	
	}
	
	public function youtube(){
		$params['apikey'] = 'AI39si63kj6Tvvbl0gB8gc48kqcqRPSLeQFkNYejxJO08TTH_NASlRudIVOLNEKtpYbitBxruitc-gtJ2pFhFdFEsrQKgEKMDg';

		 $this->load->library('Youtube', $params);
		
		$yotube = $this->youtube->getMostViewedVideoFeed(array('max-results'=>30));
		if($yotube ==true){
			echo "hi";
		}
	}
	
	
	public function index(){
		return redirect('http://www3.icd.gov.vn');
		// $data = array();
		// $this->parser->parse('admin/header_admin',$data);
		// $this->parser->parse('admin/home_gioithieu',$data);
		// $this->parser->parse('admin/footer_admin',$data);
		
	}
	public function report(){
		$data = array();
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/report_view',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	public function gallery(){
		$data = array();
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_upload',$data);
		$this->parser->parse('admin/footer_admin',$data);
	}
	
	
	public function doupload() {
		$name_array = array();
		$count = count($_FILES['userfile']['size']);
		foreach($_FILES as $key=>$value)
			for($s=0; $s<=$count-1; $s++) {
				$_FILES['userfile']['name']=$value['name'][$s];
				$_FILES['userfile']['type']    = $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']       = $value['error'][$s];
				$_FILES['userfile']['size']    = $value['size'][$s];  
				$config['upload_path'] = 'assets/uploads/gallery/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$data = $this->upload->data();
				$name_array[] = $data['file_name'];
			}
			$names= implode(',', $name_array);
			if($names == NULL){
				return redirect('quantri/gallery','location');
			}else{
				$time_upload = time();
				$date_upload = date('Y-m-d',$time_upload);
				$data = array(
				'date_upload'=> $date_upload,
				'img'=> $names,
				);
				$this->load->database();
				$check_install = $this->db->insert('tbl_album_images', $data); 
				if($check_install == true){
					return redirect('quantri/gallery','location');
				}
			}
			
			
	}
	public function generic_configuration(){
		$data = array();
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/home_gioithieu',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	

	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Home_section_homeimages	   		 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function section_homeimages(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_section_homeimages');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Hình Ảnh Icon Mục Trang Chủ');
		/*Funtion Hkeanginc .VN*/   $xcrud->unset_remove()->unset_view()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_title()->unset_sortable();
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_title');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img');
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_danhmuc','tbl_danhmuc','id_danhmuc','name_vi',"tbl_danhmuc.subcate != 0");
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('id_danhmuc');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('id_danhmuc','Thuộc Danh Mục');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array( 'path' => '../uploads/sections',));
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Images Lib Upload     	   		 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function upload_lib_images(){
			
		
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_album_images');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Hình Ảnh Icon Mục Trang Chủ');
		/*Funtion Hkeanginc .VN*/   $xcrud->unset_csv();
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('id');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('date_upload');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_album_images');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('date_upload','Ngày Upload Ảnh');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_album_images','Mô Tả Ảnh');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array( 'path' => '../uploads/gallery/',));
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Video Video	   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function manager_video(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_video');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Video');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_video','Tiêu Đề Video');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('introduction','Mô Tả Giới Thiệu Về Video');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('linkyoutube',' Link youtube');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu',' Danh Mục');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('active',' Tình trạng');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_video','Tiêu Đề Video');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá  seo');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Từ Khoá  seo');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('introduction','Mô Tả Giới Thiệu Về Video');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('linkyoutube',' Link Youtube (Example: https://www.youtube.com/watch?v=qXKd7uuehlw)');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('id_menu','Danh Mục Video');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_video');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('linkyoutube');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('id_menu');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('keywords,description,introduction');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('tin_hot_category','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('id_menu','tbl_danhmuc','id_danhmuc','name_vi');
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Lich report_contact		   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function report_contact(){
			
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_contact');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Báo cáo liên hệ');
		/*Funtion Hkeanginc .VN*/   $xcrud->unset_add()->unset_edit()->unset_csv()->unset_sortable();
		/*Funtion Hkeanginc .VN*/	$xcrud->label('name','Họ Và Tên Yêu Cầu');
		/*Funtion Hkeanginc .VN*/	$xcrud->order_by('date_contact','desc');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('message','Tin Thông Báo');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('date_contact','Ngày Liên Hệ');
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 config_contact   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function config_contact(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_config_contact');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Lý Cấu Hình Liên Hệ');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title','Tiêu Đề  Liên Hệ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('contact','Mô Tả Giới Thiệu Về  Liên Hệ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('linkmap',' Link Maps');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title','Tiêu Đề  Liên Hệ');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá  seo');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Từ Khoá  seo');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('contact','Mô Tả Giới Thiệu Về  Liên Hệ');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('linkmap',' Link Youtube (Example: https://www.map.google.com/watch?v=qXKd7uuehlw)');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('contact');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('linkmap');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('keywords,description');
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Lich Su Kien		   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function lichsukien(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_lichsukien');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Lịch Sự Kiện');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_lichsukien_vi','Tên Tiêu Đề LSK VN ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_lichsukien_en','Tên Tiêu Đề LSK ENG ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('introduction_vi','Mô Tả Thời gian Địa Điểm');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('introduction_en','Mô Tả Thời gian Địa Điểm');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_vi','Bài Viết Tiếng Việt');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_en','Bài Viết Tiếng Anh');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('active','Trạng Thái');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('datelichsukien','Ngày Diễn Ra Sự Kiện');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_vi','Tiêu Đề Lịch sự kiện Tiếng Việt Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_en','Tiêu Đề Lịch sự kiện Tiếng Anh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_vi','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_en','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('introduction_en','Tóm Tắt Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('introduction_vi','Tóm Tắt Nội Dung');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('introduction_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('datelichsukien');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array( 'path' => '../uploads/lichsukien',));
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('introduction_en,title_conent_vi,content_vi,content_en,introduction_vi,title_conent_en');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 Điểm Đến			   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function diadiemdulich(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_diadiemdulich');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Địa Điểm Du Lịch');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_diadiemdulich_vi','Tên Tiêu Đề  VI');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_diadiemdulich_en','Tên Tiêu Đề  EN');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_vi','Bài Viết Tiếng Việt');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_en','Bài Viết Tiếng Anh');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('img','Hình Ảnh Bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('active','Trạng Thái');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_diadiemdulich_vi','Tiêu Đề Điểm Đến Tiếng Việt Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_diadiemdulich_en','Tiêu Đề Đề Điểm Đến Tiếng Anh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('img','Hình Ảnh');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_vi','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_en','Nội Dung');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_diadiemdulich_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('description,keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array('path' => '../uploads/diemden',));
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 CONTENT			   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function manager_slideshow(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_slideshow');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị SlideShow Trang Chủ');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_slideshow_vi','Tên Tiêu Đề Slide Show VI');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_slideshow_en','Tên Tiêu Đề Slide Show EN');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('introduction','Mô Tả Bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_vi','Bài Viết Tiếng Việt');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_en','Bài Viết Tiếng Anh');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('img','Hình Ảnh Bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('active','Trạng Thái');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_vi','Tiêu Đề slideshow Tiếng Việt Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_en','Tiêu Đề slideshow Tiếng Anh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('img','Hình Ảnh');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_vi','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content_en','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('introduction','Tóm Tắt Nội Dung');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_conent_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('description,keywords,introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array('path' => '../uploads/slideshow',));
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	//                 CONTENT			   				 //
	//+++++++++++++++++++++++++++++++++++++++++++++++++++//
	
		public function manager_content(){
			
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_content');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Nội Dung Bài Viết ');
		/*Funtion Hkeanginc .VN*/	$xcrud->columns('title_conent_vi,introduction,mem_subche,sub_menu,active');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_conent_vi','Tên Bài Viết VI');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_conent_en','Tên Bài Viết EN');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords')->label('active','Trạng Thái');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description')->label('sub_menu','Danh Mục Con');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('introduction','Mô Tả Bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_vi','Bài Viết Tiếng Việt');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content_en','Bài Viết Tiếng Anh');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('img','Hình Ảnh Bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('mem_subche','Danh Mục Chính');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_vi','Tiêu Đề Bài Viết Tiếng Việt Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent_en','Tiêu Đề Bài Viết Tiếng Anh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('sub_menu','Danh Mục Con');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('mem_subche','Danh Mục Chính');
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active')->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords')->validation_required('introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_conent_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('img')->validation_required('mem_subche');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('description,keywords,introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array( 'path' => '../uploads/content',));
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('mem_subche','tbl_danhmuc','id_danhmuc','name_vi',"tbl_danhmuc.subcate = 0");
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('sub_menu','tbl_danhmuc','id_danhmuc',array('name_vi',),'','','',' ','','subcate','mem_subche');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('tin_hot_category','tbl_active_newscatelog','id','active');
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	  //_________________________________________________//
	 //                DANH MUC					   		//
	//_________________________________________________//
	public function config_danhmuc(){
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_danhmuc');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Danh Mục ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('name_vi','Tên Danh Mục VI');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('name_en','Tên Danh Mục EN');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords')->label('active','Trạng Thái');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description')->label('subcate','Danh Mục Con');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('name_vi','Tên Danh Tiếng Việt Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('name_en','Tên Danh Tiếng Anh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('subcate','Danh Mục Con');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active')->validation_required('description');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_en')->validation_required('name_vi');
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('subcate','tbl_danhmuc','id_danhmuc','name_vi',"tbl_danhmuc.subcate = 0");
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('active','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
									$this->parser->parse('admin/header_admin',$data);
									$this->parser->parse('admin/index_admin',$data);
									$this->parser->parse('admin/footer_admin',$data);
	}
	
	
	//__________________________________________________//
	
	public function config_abouts(){
		$data = array();
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/home_gioithieu',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	public function ngocanh(){
		$string = "'Cuộc chiến truyền thông' trước hội nghị 13";
		$name = strlen($string);
		echo $name;
	}
	public function discussion_question(){
			/*Funtion Hkeanginc .VN*/ $xcrud = Xcrud::get_instance();
			/*Funtion Hkeanginc .VN*/ $xcrud->table('tbl_discussion_question');
			/*Funtion Hkeanginc .VN*/ $xcrud->create_action('publish', 'publish_discussion_question'); // action callback, function publish_action() in functions.php
			/*Funtion Hkeanginc .VN*/ $xcrud->create_action('unpublish', 'unpublish_discussion_question');
			/*Funtion Hkeanginc .VN*/ $xcrud->button('#', 'unpublished', 'icon-close glyphicon glyphicon-remove', 'xcrud-action', 
										array(  // set action vars to the button
										'data-task' => 'action',
										'data-action' => 'publish',
										'data-primary' => '{id}'), 
										array(  // set condition ( when button must be shown)
										'active',
										'!=',
										'1')
										);
			/*Funtion Hkeanginc .VN*/ $xcrud->button('#', 'published', 'icon-checkmark glyphicon glyphicon-ok', 'xcrud-action', array(
										'data-task' => 'action',
										'data-action' => 'unpublish',
										'data-primary' => '{id}'), array(
										'active',
										'=',
										'1'));
			/*Funtion Hkeanginc .VN*/	 $xcrud->unset_add()->unset_edit()->unset_remove()->unset_csv()->unset_sortable();
			/*Funtion Hkeanginc .VN*/	$xcrud->label('title','Tiêu Đề Câu Hỏi')->label('introduction','Chi Tiết Câu Hỏi');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('active','Trạng Thái Đăng')->label('user_post','Người Đặt Câu Hỏi');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('date_contact','Ngày Đăng');
			
			/*Funtion Hkeanginc .VN*/	$xcrud->columns('title,introduction,user_post,date_contact,active');
			/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
					$this->parser->parse('admin/header_admin',$data);
					$this->parser->parse('admin/index_admin',$data);
					$this->parser->parse('admin/footer_admin',$data);
	}

	public function menugioithieu(){
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_menugiothieu');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Danh Mục Giới Thiệu');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('name_menugioithieu','Tên Danh Mục')->label('keywords','keywords')->label('active','Trạng Thái')->label('description','description')->label('review_content','Kiểu Trang');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('name_menugioithieu','Tên Danh Mục Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('review_content','Kiểu Trang');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active')->validation_required('description')->validation_required('review_content');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('keywords')->validation_required('name_menugioithieu')->validation_required('review_content');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('review_content','tbl_review_content','id_review_content','review_content');
		/*Funtion Hkeanginc .VN*/	
		
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	public function content_gioithieu(){
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_content_gioithieu');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Bài Viết Giới Thiệu');
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('keywords,description,introduction,introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('img','Hình Ảnh')->label('title_conent','Tên Bài Viết')->label('keywords','keywords')->label('introduction','Tóm Tắt bài Viết');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Bài Viết')->label('active','Trạng Thái')->label('description','description')->label('sub_menu','Kiểu Danh Mục');
		
		
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('title_conent','Tên Chứa Tiêu Đề Hiển Thị');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('keywords','Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('sub_menu','Kiểu Danh Mục');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('description','Nội Dung Từ Khoá Tìm Kiếm');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('introduction','Nội Dung Tóm Tắt');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('active','Trạng Thái Có Cho Phép hoạt Động Hay Không');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('img','Hình Ảnh Minh Hoạ');
		/*Funtion Hkeanginc .VN*/	$xcrud->field_tooltip('content','Nội Dung');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array('path' => '../uploads/gioithieu',));
		
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('active')->validation_required('description')->validation_required('review_content')->validation_required('img');
		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content')->validation_required('keywords')->validation_required('title_conent')->validation_required('sub_menu')->validation_required('introduction');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('active','tbl_active','id_active','name');
		/*Funtion Hkeanginc .VN*/	 $xcrud->relation('sub_menu','tbl_menugiothieu','id_menugioithieu','name_menugioithieu');
		/*Funtion Hkeanginc .VN*/	
		
		
		/*Funtion Hkeanginc .VN*/	$data['data_content'] = $xcrud->render();
		
		$this->parser->parse('admin/header_admin',$data);
		$this->parser->parse('admin/index_admin',$data);
		$this->parser->parse('admin/footer_admin',$data);
		
	}
	
	
	
	public function banner(){
		
		//$loggedIn = $this->session->all_userdata();
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_banner');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị banner Top');
		/*Funtion Hkeanginc .VN*/	$data['menu'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('index_admin',$data);
		$this->parser->parse('footer_admin',$data);
		
	}
	
	public function products(){
		
		//$loggedIn = $this->session->all_userdata();
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_products');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Sản Phẩm');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('name_products','Tên Sản Phẩm')->label('introduction','Mô Tả Sản Phẩm');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Chi Tiết')->label('img','Hình Ảnh Chính');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('img1','Hình Ảnh 1')->label('img2','Hình Ảnh 2')->label('img3','Hình Ảnh 3');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('preitem','Giá Sản Phẩm')->label('pre_oderitem','Giá Cũ');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu','Danh Mục Cha')->label('id_catelog','Danh Mục Con');
		
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('name_products,description,keywords,introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_products,description,keywords,introduction,content,img,preitem,pre_oderitem,id_menu,id_catelog');
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img', 'image', true, array('path' => '../uploads/products',));
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img1', 'image', true, array('path' => '../uploads/products',));
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img2', 'image', true, array('path' => '../uploads/products',));
		/*Funtion Hkeanginc .VN*/	$xcrud->change_type('img3', 'image', true, array('path' => '../uploads/products',));
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_menu','tbl_danhmuc','id_danhmuc','name_danhmuc',"tbl_danhmuc.subcate = 0");
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_catelog','tbl_danhmuc','id_danhmuc',array('name_danhmuc',),'','','',' ','','subcate','id_menu');	
		/*Funtion Hkeanginc .VN*/	$data['menu'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('index_admin',$data);
		$this->parser->parse('footer_admin',$data);
		
	}
	
	
}
?>