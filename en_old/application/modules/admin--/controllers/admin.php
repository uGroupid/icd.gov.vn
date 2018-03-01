<?php
class Admin extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		// $loggedIn = $this->session->userdata('logged_in');
		// if($loggedIn == NULL){
			// return redirect('login');
		// }return true;		
	}
	
	public function index(){
		
		$data = array();
		$this->parser->parse('header_admin',$data);
	//	$this->parser->parse('index_admin',$data);
		$this->parser->parse('footer_admin',$data);
		
	}
	public function catelog(){
		
		//$loggedIn = $this->session->all_userdata();
			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_danhmuc');
			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản lý Danh Mục');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_vi','Tên Danh Mục VN')->label('name_en','Tên Danh Mục EN');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('keywords','keywords')->label('description','description');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('category_list','Loại Danh Mục')->label('subcate','Danh Mục Con');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('active_menu','Kiểu Menu')->label('active','active');
			/*Funtion Hkeanginc .VN*/	$xcrud->relation('category_list','tbl_category_list','id_category_list','name');
			/*Funtion Hkeanginc .VN*/	$xcrud->relation('subcate','tbl_danhmuc','id_danhmuc','name_vi');
			/*Funtion Hkeanginc .VN*/	$xcrud->relation('active_menu','tbl_active_menu','id_active_menu','name_active_menu');
			/*Funtion Hkeanginc .VN*/	$xcrud->relation('active','tbl_active','id_active','name');
			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_vi,name_en,keywords,description,category_list,subcate,active_menu,active');
			/*Funtion Hkeanginc .VN*/	$data['menu'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('index_admin',$data);
		$this->parser->parse('footer_admin',$data);
		
	}
	public function news(){
		
		//$loggedIn = $this->session->all_userdata();
			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_news');
			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản lý Tin Tức');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_en','Tiêu Đề Tin Tức')->label('keywords','keywords');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('description','description')->label('introduction','introduction');
			/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung')->label('img','Hình ảnh ');
			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img', 'image', '', array('width' => 1170, 'height' => 700,'img_content' => true));
			/*Funtion Hkeanginc .VN*/	$xcrud->label('timedate','Thời Gian Post');
			/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('description')->no_editor('keywords');
			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_en,introduction,keywords,keywords,description,content,img,timedate');
			/*Funtion Hkeanginc .VN*/	$data['menu'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('index_admin',$data);
		$this->parser->parse('footer_admin',$data);
		
	}
	public function manager_slideshow(){
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_slishowes');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Lý Slide');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Slide')->label('title','Tiêu Đề Slide')->label('img','Hình Ảnh 1170x700');
		/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img', 'image', '', array('width' => 1170, 'height' => 700,'img_content' => true));
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('title');
		/*Funtion Hkeanginc .VN*/	$xcrud->columns('title,img,content');
		/*Funtion Hkeanginc .VN*/	$data['slideshow'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('admin_slideshow',$data);
		$this->parser->parse('footer_admin',$data);
	}
	public function manager_products(){
		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_products');
		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Lý Products');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Slide')->label('name_products','Tên Sản Phẩm')->label('img','Hình Ảnh 1170x700');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('description','Description')->label('keywords','keywords')->label('introduction','Giới Thiệu Products');
		/*Funtion Hkeanginc .VN*/	$xcrud->label('details','Chi Tiết Products')->label('id_catelog','Danh Mục');
		/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img', 'image', '', array('width' => 370, 'height' => 300,'img_content' => true));
		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('description')->no_editor('keywords')->no_editor('introduction');
		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_catelog','tbl_danhmuc','id_danhmuc','name_vi','tbl_danhmuc.subcate = 2');
		/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_products,img,id_catelog,content,introduction,details,description,keywords');
		/*Funtion Hkeanginc .VN*/	$data['slideshow'] = $xcrud->render();
		
		$this->parser->parse('header_admin',$data);
		$this->parser->parse('admin_slideshow',$data);
		$this->parser->parse('footer_admin',$data);
	}
// public function config_footer(){
// 		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_configfooter');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Cuối Trang');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình Nội Dung Footer');

// 		/*Funtion Hkeanginc .VN*/	 $xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
	
// 		/*Funtion Hkeanginc .VN*/	$data['config_footer'] = $xcrud->render();

// 		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_configbanner');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung Banner');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình Nội Dung Banner');

// 		/*Funtion Hkeanginc .VN*/	 $xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
	
// 		/*Funtion Hkeanginc .VN*/	$data['tbl_configbanner'] = $xcrud->render();
		
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('tbl_configfooter',$data);
// 		$this->parser->parse('footer_admin',$data);
// 	}
// 	public function config_menu(){
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_menu');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình Nội Dung menu');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->columns('nameMenu,parent_id,idTypemenu');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('parent_id','tbl_menu','idMenu','nameMenu');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('idTypemenu','tbl_typemenu','idTypemenu','nameTypemenu');
// 		/*Funtion Hkeanginc .VN*/	$data['config_menu'] = $xcrud->render();
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_menu',$data);
// 		$this->parser->parse('footer_admin',$data);
// 	}
// 	public function config_content(){
// 		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_content');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->columns('idMenu,title_content,img_content,content,idMenusub,idMenusubs,idTypemenu');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('title_content')->validation_required('img_content');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('content')->validation_required('idMenu')->validation_required('idMenusub')->validation_required('idTypemenu');

			
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_content','Tiêu đề bài viết')->label('idMenusubs','Danh Mục con 2')->label('idMenusub','Danh Mục Con 1')->label('img_content','hình ảnh đại diện')->label('content','Nội dung bài viết')->label('idMenu','Danh Mục Bài Viết')->label('idTypemenu','Kiểu Bài Viết');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('idMenu','tbl_menu','idMenu','nameMenu','tbl_menu.parent_id = 0');
// 		/*Funtion Xcrud .VN*/ 		$xcrud->relation('idMenusub','tbl_menu','idMenu',array('nameMenu',),'','','',' ','','parent_id','idMenu');
// 		/*Funtion Xcrud .VN*/ 		$xcrud->relation('idMenusubs','tbl_menu','idMenu',array('nameMenu',),'','','',' ','','parent_id','idMenusub');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Nội Dung Bài Viết');
// 		/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img_content', 'image', '', array('width' => 222, 'height' => 230,'img_content' => true));
		
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('idTypemenu','tbl_typemenucontent','idTypemenu','nameTypemenu');
// 		/*Funtion Hkeanginc .VN*/	$data['config_content'] = $xcrud->render();
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_content',$data);
// 		$this->parser->parse('footer_admin',$data);
// 	}
// 	public function config_menuhome(){
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_listmenuhome');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình Danh Mục Bài Trang Chủ');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_listmenuhome,id_menuhome');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('name_listmenuhome','Tên Danh Mục Bài Viết')->label('id_menuhome','Khung Danh Mục');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_menuhome','tbl_menuhome','id_menuhome','name_menuhome');
// 		/*Funtion Hkeanginc .VN*/	$data['config_menuhome'] = $xcrud->render();
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_menuhome',$data);
// 		$this->parser->parse('footer_admin',$data);
// 	}
// 	public function content_homepage(){
// 		/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 		/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_contenthome');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Bài Viết Trang Chủ');
// 		/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('title_content');
// 		/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img_content', 'image', '', array('width' => 250, 'height' => 100,'img_content' => true));
			
// 		/*Funtion Hkeanginc .VN*/	$xcrud->columns('title_content,img_content,content,id_listmenuhome');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('title_content','Tiêu Đề Bài Viết')->label('img_content','Hình Ảnh');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->label('content','Nội Dung')->label('id_listmenuhome','Danh Mục Home');
// 		/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_listmenuhome','tbl_listmenuhome','id_listmenuhome','name_listmenuhome');
// 		/*Funtion Hkeanginc .VN*/	$data['content_homepage'] = $xcrud->render();
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('content_homepage',$data);
// 		$this->parser->parse('footer_admin',$data);
// 	}

// 	public function configall(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_lienkettrang');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('CẤU HÌNH LIÊN KẾT TRANG BẰNG ICON');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('img_lienkettrang', 'image', '', array('width' => 30, 'height' => 30,'images_small_products' => true));
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('img_lienkettrang','Icon Liên Kết')->label('link','Đường Dẫn Liên Kết Liên Kết');
// 			 /*Funtion Hkeanginc .VN*/	$xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('img_lienkettrang,link');
// 			/*Funtion Hkeanginc .VN*/	$data['tbl_lienkettrang'] = $xcrud->render();

// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_phone_holine');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình HOTLINE TOP');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('phone_hotline',' SỐ HOTLINE TRÊN TOP');
// 			 /*Funtion Hkeanginc .VN*/	$xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('phone_hotline');
// 			/*Funtion Hkeanginc .VN*/	$data['phone_hotline'] = $xcrud->render();

// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_configinfocontact');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('CẤU HÌNH THÔNG TIN TRONG LIÊN HỆ');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('link_maps','ĐỊA CHỈ TRÊN BẢN ĐỒ GOOGLE MAPS')->label('name_infocontact','THÔNG TIN CÔNG TY');
// 			 /*Funtion Hkeanginc .VN*/	$xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_infocontact,link_maps');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('link_maps');
// 			/*Funtion Hkeanginc .VN*/	$data['configinfocontact'] = $xcrud->render();


// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_phone_bootter');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu Hình Phone Footer');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('phone_bootter',' SỐ Điện Thoại Dưới Footer');
// 			 /*Funtion Hkeanginc .VN*/	$xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('phone_bootter');
// 			/*Funtion Hkeanginc .VN*/	$data['phone_bootter'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_configall',$data);
// 		$this->parser->parse('footer_admin',$data);
		
// 	}
// 	public function menu(){
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_menu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản lý Menu Chính');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_staturmenu','tbl_staturmenu','id_staturmenu','name_staturmenu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('name_statur','tbl_statur','id_statur','name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_menu')->validation_required('id_staturmenu')->validation_required('name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_menu','Tên Danh Mục')->label('name_access','Số thứ tự hiển thị');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('id_staturmenu','Loại danh mục')->label('name_statur','Tình Trạng');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_menu,name_access,id_staturmenu,name_statur');
// 			/*Funtion Hkeanginc .VN*/	$data['menu'] = $xcrud->render();

// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_submenu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản lý Menu Con');
// 			Funtion Hkeanginc .VN	$xcrud->relation('id_menu','tbl_menu','id_menu','name_menu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('name_statur','tbl_statur','id_statur','name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_menu','Tên Danh Mục Con')->label('name_access','Số thứ tự hiển thị');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu','Loại danh mục')->label('name_statur','Tình Trạng');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_menu')->validation_required('id_menu')->validation_required('name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_menu,name_access,id_menu,name_statur');
// 			/*Funtion Hkeanginc .VN*/	$data['sbmenu'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_menu',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}

// 	public function products(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_products');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản lý Sản Phẩm');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_menu','tbl_menu','id_menu','name_menu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('name_statur','tbl_statur','id_statur','name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('hienthitrangchu','tbl_confighome','id_confighome','name_confighone');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('images_small_products', 'image', '', array('width' => 222, 'height' => 230,'images_small_products' => true));
// 			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('images_large_products', 'image', '', array('width' => 666, 'height' => 690,'images_small_products' => true));
// 			/*Funtion Hkeanginc .VN*/ 	$xcrud->relation('id_submenu','tbl_submenu','id_submenu',array('name_menu',),'','','',' ','','id_menu','id_menu');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('title_products');
// 			/*Funtion Hkeanginc .VN*/ 	$xcrud->order_by('id_products','desc');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_products','Tên SP')->label('hienthitrangchu','Hiển Thị Trang Chủ')->label('title_products','Tiêu Đề SP')->label('content_products','Chi Tiết SP')->label('price_products','Giá SP')->label('so_luong_products','Số Lượng SP')->label('images_large_products','Hình Ảnh Lớn')->label('images_small_products','Hình Ảnh Nhỏ');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_products')->validation_required('title_products')->validation_required('content_products');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('price_products')->validation_required('so_luong_products')->validation_required('images_large_products');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('images_small_products');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_menu')->validation_required('id_menu')->validation_required('name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu','Loại danh mục Gốc')->label('name_statur','Tình Trạng')->label('id_submenu','Loại danh mục Con');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_products,title_products,content_products,price_products,so_luong_products,images_large_products,images_small_products,id_menu,id_submenu,name_statur,hienthitrangchu');
// 			/*Funtion Hkeanginc .VN*/	$data['products'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_products',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}
// 	public function slideshows(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_slideshows');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Cấu hình slideshows');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('name_statur','tbl_statur','id_statur','name_statur');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('images_large_products', 'image', '', array('width' => 500, 'height' => 500));
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_slideshows','Tên Slideshows')->label('title_slideshows','Tiêu Đề Slideshows');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('content_slideshows','Bài Viết Slideshows')->label('images_large_products','hình ảnh Slideshows')->label('name_statur','Tình Trạng');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('images_large_products')->validation_required('name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_slideshows')->validation_required('title_slideshows')->validation_required('content_slideshows');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu','Loại danh mục Gốc')->label('name_statur','Tình Trạng')->label('id_submenu','Loại danh mục Con');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_slideshows,title_slideshows,content_slideshows,images_large_products,name_statur');
// 			/*Funtion Hkeanginc .VN*/	$data['products'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_products',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}

// 	public function news(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_news');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('Quản Trị Tin Tức');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->no_editor('title_news');

// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('name_statur','tbl_statur','id_statur','name_statur');
// 			/*Funtion Hkeanginc .VN*/   $xcrud->change_type('images_new', 'image', '', array('width' => 500, 'height' => 500));
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('name_news','Tên Tin Tức')->label('title_news','Nội Dung Tin')->label('timeup','Thời Gian Đăng');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('images_new','hình ảnh Slideshows')->label('name_statur','Tình Trạng');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('images_new')->validation_required('name_statur');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('name_news')->validation_required('title_news')->validation_required('timeup');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('id_menu','Loại danh mục Gốc')->label('name_statur','Tình Trạng')->label('id_submenu','Loại danh mục Con');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('name_news,title_news,images_new,timeup,name_statur');
// 			/*Funtion Hkeanginc .VN*/	$data['news'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('index_news',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}
	
// 	public function aboutus(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_aboutus');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('CẤU HÌNH TRANG GIỚI THIỆU');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('content_aboutus','Nội Dung Giới Thiệu Trang');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('content_aboutus');
// 			/*Funtion Hkeanginc .VN*/    $xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$data['aboutus'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_aboutus',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}

// 	public function huongdanthanhtoan(){
// 			/*Funtion Hkeanginc .VN*/	Xcrud_config::$editor_url =  base_url().'assets/xcrud/ckeditor/ckeditor.js';
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_huongdanthanhtoan');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('bài Viết Hướng Dẫn Thanh Toán');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('content_huongdanthanhtoan','Nội Dung Giới Hướng Dẫn Thanh Toán');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('content_huongdanthanhtoan');
// 			/*Funtion Hkeanginc .VN*/    $xcrud->unset_add()->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$data['huongdanthanhtoan'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_huongdanthanhtoan',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}


// 	public function user(){
// 			$quenhanadmin = $this->session->userdata('id_permission');
// 			$id_user = $this->session->userdata('id_user');
// 			/*Funtion Hkeanginc .VN*/	$xcrud = Xcrud::get_instance();
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table('tbl_contact');
// 			if($quenhanadmin != 1){
// 			/*Funtion Hkeanginc .VN*/	$xcrud->where('id_user', $id_user);
// 			/*Funtion Hkeanginc .VN*/    $xcrud->unset_add();
// 			}
// 			/*Funtion Hkeanginc .VN*/	$xcrud->table_name('CẤU HÌNH TRANG GIỚI THIỆU');
// 			/*Funtion Hkeanginc .VN*/ 	$xcrud->fields('username,passwords,email_user,id_permission');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->relation('id_permission','tbl_premission','id_premission','username');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->label('username','Tên Đăng Nhập')->label('id_permission','Quyền Hạn')->label('email_user','Email')->label('passwords','Mật Khẩu');
// 			/*Funtion Hkeanginc .VN*/	$xcrud->validation_required('username')->validation_required('passwords')->validation_required('email_user')->validation_required('id_permission');
// 			/*Funtion Hkeanginc .VN*/ 	$xcrud->change_type('passwords', 'password', 'md5', array('maxlength'=>10,'placeholder'=>'Nhập Mật Khẩu Của Bạn'));
// 			/*Funtion Hkeanginc .VN*/	$xcrud->columns('username,email_user,id_permission');
// 			/*Funtion Hkeanginc .VN*/    $xcrud->unset_remove()->unset_csv()->unset_limitlist()->unset_numbers()->unset_pagination()->unset_print()->unset_search()->unset_sortable();
// 			/*Funtion Hkeanginc .VN*/	$data['user'] = $xcrud->render();
	
// 		$this->parser->parse('header_admin',$data);
// 		$this->parser->parse('admin_user',$data);
// 		$this->parser->parse('footer_admin',$data);

// 	}
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>