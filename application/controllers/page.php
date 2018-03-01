<?php
class Page extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		//$this->output->cache(5);
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");		
	}
	public  function to_slug($str) {
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
	}
	public function url(){
		$string = "Quyết Định Số 366/QĐ-BVHTTDL Ngày 25/02: Bảo Tàng Lịch Sử Quốc Gia Tổ Chức Trưng Bày Triển Lãm “Văn Hóa Đông Sơn” Tại Malaysia";
		$name = $this->to_slug($string);
		echo $name;
	}
	public function profile_department_for_international_cooperation(){
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
				$title = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$description = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$keywords = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$data_profiles_icd = $this->callbuyMD->data_profiles_icd();
				$data = array(
					'title' => $title,
					'description' => $description,
					'nametitle' => $title,
					'keywords' => $keywords,
					'data_task_hotnews' => $task_hot_news,
					'task_even_calendar' => $task_even_calendar,
					'datacontent' => $data_profiles_icd,
				);
				$this->parser->parse('header',$data);
			//	$this->parser->parse('slide',$data);
				$this->parser->parse('content/profile_department_for_international_cooperation',$data);
				$this->parser->parse('footer',$data);
	}
	public function ho_so_lanh_dao_cuc($id,$title){
				
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
				$title = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$description = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$keywords = "HỒ SƠ CỤC HỢP TÁC QUỐC TẾ ";
				$data_profiles_icd = $this->callbuyMD->ho_so_lanh_dao_cuc($id);
				$get_data_profiles_icd = $this->callbuyMD->get_data_profiles_icd($id);
				$img = "http://www3.icd.gov.vn/images/logo.png";
				foreach($get_data_profiles_icd as $value_get_data_profiles_icd){}
				$data = array(
					'title' => $title,
					'img' => $img,
					'description' => $description,
					'nametitle' => $value_get_data_profiles_icd['name_phongban'],
					'keywords' => $keywords,
					'data_task_hotnews' => $task_hot_news,
					'task_even_calendar' => $task_even_calendar,
					'datacontent' => $data_profiles_icd,
				);
				$this->parser->parse('header',$data);
			//	$this->parser->parse('slide',$data);
				$this->parser->parse('content/ho_so_lanh_dao_cuc',$data);
				$this->parser->parse('footer',$data);
	}
	public function gioi_thieu($idcontent,$nametitle,$title,$idmenu){
		if($idmenu == NULL && $idcontent == NULL){redirect("home","localtion");}else{
			$data_item_menu_header = $this->callbuyMD->get_headersub_contrc($idmenu);
			$data_getcontent_details = $this->callbuyMD->data_getcontent_details($idcontent);
			if($data_item_menu_header == NULL && $data_getcontent_details == NULL ){
				$title = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$description = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$keywords = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$img = "http://www3.icd.gov.vn/images/logo.png";
				$data = array(
					'title' => $title,
					'img' => $img,
					'description' => $description,
					'keywords' => $keywords,
				);
				$this->parser->parse('header',$data);
				$this->parser->parse('warring',$data);
				$this->parser->parse('footer',$data);
			}else{
				foreach($data_item_menu_header as $value_header_data_item){}
				$nametitle = $value_header_data_item['name_vi'];
				foreach($data_getcontent_details as $value_data_getcontent_details){}
				$titles = $value_data_getcontent_details['title_conent_vi'];
				$description = $value_data_getcontent_details['description'];
				$keywords = $value_data_getcontent_details['keywords'];
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
				$img = "http://www3.icd.gov.vn/images/logo.png";
				$data = array(
					'title' => $titles,
					'img' => $img,
					'description' => $description,
					'nametitle' => $nametitle,
					'keywords' => $keywords,
					'data_task_hotnews' => $task_hot_news,
					'task_even_calendar' => $task_even_calendar,
					'iddanhmuc' => $idmenu,
					'datacontent' => $data_getcontent_details,
					
				);
				$this->parser->parse('header',$data);
				//$this->parser->parse('slide',$data);
				$this->parser->parse('content/gioi_thieu',$data);
				$this->parser->parse('footer',$data);
			}
		}
	}
	public function content($title,$idmenu){
		if($idmenu == NULL){redirect("home","localtion");}else{
			$data_item_menu_header = $this->callbuyMD->get_headersub_contrc($idmenu);
			if($data_item_menu_header == NULL){
				$title = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$description = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$keywords = "Cục Hợp tác quốc tế của Bộ Văn hóa Du lịch và Thể thao";
				$img = "http://www3.icd.gov.vn/images/logo.png";
				$data = array(
					'title' => $title,
					'img' => $img,
					'description' => $description,
					'keywords' => $keywords,
				);
				$this->parser->parse('header',$data);
				$this->parser->parse('warring',$data);
				$this->parser->parse('footer',$data);
			}else{
				foreach($data_item_menu_header as $value_header_data_item){}
				$datacontent = $this->callbuyMD->tbl_getcontent($value_header_data_item['id_danhmuc']);
				$title = $value_header_data_item['name_vi'];
				$description = $value_header_data_item['description'];
				$keywords = $value_header_data_item['keywords'];
				$contresurt = $this->callbuyMD->tbl_countcontent($value_header_data_item['id_danhmuc']);
				$display = 5;
				$start = 0;
				$page = ceil($contresurt/$display); // tổng số trang.
				$img = "http://www3.icd.gov.vn/images/logo.png";
					$data = array(
						'title' => $title,
						'img' => $img,
						'description' => $description,
						'keywords' => $keywords,
						'iddanhmuc' => $idmenu, 
						'datacontent' => $datacontent,
						'datacount' => $page,
					);
				$this->parser->parse('header',$data);
				//$this->parser->parse('slide',$data);
				$this->parser->parse('content/list',$data);
				$this->parser->parse('footer',$data);
			}
		}
	}
	
	public function contents($idmenu,$title,$start){

			
				$this->load->helper("url");
				$this->load->library("pagination");
				$config['base_url'] = base_url('index.php/page/contents/6'); 
				$config['total_rows'] = $this->callbuyMD->tbl_countcontentse($idmenu); 
				$config['per_page'] = 5; 
				$config['uri_segment'] = 6; 
				$this->pagination->initialize($config); 
				$data['data'] = $this->callbuyMD->tbl_getcontentse($idmenu,$start);
			
		  
			
				
					// $data = array(
						// 'title' => $title,
						// 'description' => $description,
						// 'keywords' => $keywords,
						
						// 'datacontent' => $datacontent,
						// 'datacount' => $page,
					// );
				// $this->parser->parse('header',$data);
				// $this->parser->parse('slide',$data);
				$this->parser->parse('content/test',$data);
				// $this->parser->parse('footer',$data);
			
	}
	
	function intro(){
		$this->parser->parse('header',$data);
		$this->parser->parse('content/intro',$data);
		$this->parser->parse('footer',$data);
	}
	
	public function jyahoo(){
		$data = array('');
		$this->parser->parse('jdata_yahoo',$data);
	}
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>