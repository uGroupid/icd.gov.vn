<?php
class Calendar extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
				
	}
	
	public function dic($nametitle,$idmenu){
		if($idmenu == NULL){redirect("home","localtion");}else{
			$data_calendar = $this->callbuyMD->get_calendar_view($idmenu);
		
			foreach($data_calendar as $value_data_calendar){}
			$titles = $value_data_calendar['title_lichsukien_vi'];
			$description = $value_data_calendar['title_lichsukien_vi'];
			$keywords = $value_data_calendar['title_lichsukien_vi'];
			$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
			$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
			$get_calendar_view_def = $this->callbuyMD->get_calendar_view_def();
			$data = array(
				'img' => '',
				'title' => $titles,
				'description' => $description,
				'nametitle' => $nametitle,
				'keywords' => $keywords,
				'data_task_hotnews' => $task_hot_news,
				'task_even_calendar' => $task_even_calendar,
				'datacontent' => $data_calendar,
				'get_calendar_view_def' => $get_calendar_view_def,
				
			);
			$this->parser->parse('header',$data);
			$this->parser->parse('slide',$data);
			$this->parser->parse('content/calendar_list',$data);
			$this->parser->parse('footer',$data);
		
		}
	}
	
	public function details($nametitle,$idmenu){
		if($idmenu == NULL){redirect("home","localtion");}else{
			$data_calendar = $this->callbuyMD->get_calendar_view_details($idmenu);
			foreach($data_calendar as $value_data_calendar){}
			$titles = $value_data_calendar['title_lichsukien_vi'];
			$description = $value_data_calendar['title_lichsukien_vi'];
			$keywords = $value_data_calendar['title_lichsukien_vi'];
			$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
			$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
			$get_calendar_view_def = $this->callbuyMD->get_calendar_view_def($idmenu);
			$data = array(
				'img' => '',
				'title' => $titles,
				'description' => $description,
				'nametitle' => $nametitle,
				'keywords' => $keywords,
				'data_task_hotnews' => $task_hot_news,
				'task_even_calendar' => $task_even_calendar,
				'datacontent' => $data_calendar,
				'get_calendar_view_def' => $get_calendar_view_def,
				
			);
			$this->parser->parse('header',$data);
			$this->parser->parse('slide',$data);
			$this->parser->parse('content/calendar',$data);
			$this->parser->parse('footer',$data);
		
		}
	}
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>