<?php
class Contact extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
				error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	
	}
	
	
	public function index(){
		
		$data_contact_config = $this->callbuyMD->get_data_contact();

		foreach($data_contact_config as $value_data_contact_config){}

		$titles = $value_data_contact_config['title_conent_en'];
		$description = $value_data_contact_config['description'];
		$keywords = $value_data_contact_config['keywords'];
		$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
		$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
		$data = array(
			'title' => $titles,
			'description' => $description,
			'nametitle' => $nametitle,
			'keywords' => $keywords,
			'data_task_hotnews' => $task_hot_news,
			'task_even_calendar' => $task_even_calendar,
			'datacontent' => $data_contact_config,
			
		);
		$this->parser->parse('header',$data);
		//$this->parser->parse('slide',$data);
		$this->parser->parse('content/view_contact',$data);
		$this->parser->parse('footer',$data);
	}
	
	public function contact_int(){
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$message = $this->input->post('message');
		$time = time();
		$date_contact = date("Y-m-d H:s:i",$time);
		$data = array(
			'name' => $name ,
			'email' => $email ,
			'message' => $message ,
			'date_contact' => $date_contact ,
		);
		$in_db = $this->db->insert('tbl_contact', $data); 
		if($in_db == true){
			echo 1;
		}else{
			echo 0;
		}
	}
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>