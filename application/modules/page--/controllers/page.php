<?php
class Page extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		//$this->load->model('home_model', 'webvfMD');	
		// $loggedIn = $this->session->userdata('logged_in');
		// if($loggedIn == NULL){
			// return redirect('login');
		// }return true;		
	}
	
	public function index(){
		$title = "Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$keywords = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('index_page',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function warring(){
		$title = "Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$keywords = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('warring',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function contact(){
		$title = "Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$keywords = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('contact_us',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function news(){
		
	
		$title = "News Tin Tức Blog Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = "Tin Tức Blog Thông Tin Về Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$keywords = "Tin Tức Blog Thông Tin Về  Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('index_news',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function view_news($id){
		$view_news = $this->callbuyMD->get_view_news($id);
		foreach($view_news as $valueview_news){}
		if($view_news == NULL){
			redirect("/page/warring");
		}
		$title = $valueview_news['name_en']."News Tin Tức Blog Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = $valueview_news['description'];
		$keywords = $valueview_news['keywords'];
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		'view_news' => $view_news,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('index_news_detail',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function detail($id){
		$detail = $this->callbuyMD->get_detail_list_product($id);
		if($detail == NULL){
			redirect("/page/warring");
		}
		foreach($detail as $valuedetail){}
		$title = $valuedetail['name_products']." Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = $valuedetail['description'];
		$keywords = $valuedetail['keywords'];
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		'detail' => $detail,
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('index_detail',$data);
		$this->parser->parse('footer',$data);
		
	}
	public function customer_contact(){
		$fullname = $this->input->post('fullname');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$message = $this->input->post('message');
		$datetime = time();
		$timedate = date("d-m-Y H:i:s",$datetime);
		
		$data = array(
			'fullname'=> $fullname,
			'email'=> $email,
			'phone'=> $phone,
			'message'=> $message,
			'timedate'=> $timedate,
		
		);
		$install = $this->db->insert('tbl_customer_contact', $data); 
		if($install ==true){
			$title = "Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
			$description = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
			$keywords = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
			$data = array(
				'title' => $title,
				'description' => $description,
				'keywords' => $keywords,
				);
			$this->parser->parse('header',$data);
			$this->parser->parse('thankyou',$data);
			$this->parser->parse('footer',$data);
		}
		
	}
	public function product($id){
		$title = "Quạt Công Nghiệp | Quạt Gió Công Nghiệp | quatgiocongnghiep.com.vn";
		$description = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$keywords = "Quạt gió công nghiệp , quạt công nghiệp, hệ thống làm mát, quatgiocongnghiep, quatconnghiep";
		$get_list_product = $this->callbuyMD->get_list_product($id);
		if($get_list_product == NULL){
			redirect("/page/warring");
		}
		$get_danhmuc = $this->callbuyMD->get_danhmuc($id);
		
		$data = array(
		'title' => $title,
		'description' => $description,
		'keywords' => $keywords,
		'get_list_product' => $get_list_product,
		'get_danhmuc' => $get_danhmuc,
		);
		
		$this->parser->parse('header',$data);
		$this->parser->parse('index_list',$data);
		$this->parser->parse('footer',$data);
	}
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>