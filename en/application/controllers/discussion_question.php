<?php
class Discussion_question extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
				error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	
	}
	
	
	public function index($idcontent,$nametitle,$title,$idmenu){

	
		foreach($data_getcontent_details as $value_data_getcontent_details){}
		$titles = $value_data_getcontent_details['title_conent_en'];
		$description = $value_data_getcontent_details['description'];
		$keywords = $value_data_getcontent_details['keywords'];
		$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
		$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
		$get_discussion_question = $this->callbuyMD->get_discussion_question();
		
		$data = array(
			'title' => $titles,
			'description' => $description,
			'nametitle' => $nametitle,
			'keywords' => $keywords,
			'data_task_hotnews' => $task_hot_news,
			'task_even_calendar' => $task_even_calendar,
			'datacontent' => $get_discussion_question,
			
		);
		$this->parser->parse('header',$data);
		//$this->parser->parse('slide',$data);
		$this->parser->parse('content/discussion_question',$data);
		$this->parser->parse('footer',$data);
	}
	public function question_int(){
		$email_questions = $this->input->post('email_questions');
		$your_questions_content = $this->input->post('your_questions_content');
		$your_questions_title = $this->input->post('your_questions_title');
		$time = time();
		$date_contact = date("Y-m-d H:s:i",$time);
		$data = array(
			'title' => $your_questions_title ,
			'keywords' => $your_questions_title ,
			'description' => $your_questions_title ,
			'introduction' => $your_questions_content ,
			'date_contact' => $date_contact ,
			'user_post' => $email_questions ,
			'active' => 0 ,
		);
		$in_db = $this->db->insert('tbl_discussion_question', $data); 
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