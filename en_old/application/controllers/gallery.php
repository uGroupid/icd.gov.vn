<?php
class Gallery extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
				error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	
	}
	
	
	public function index(){
			$data_getcontent_gallery = $this->callbuyMD->data_getcontent_gallery();
			if($data_getcontent_gallery == NULL ){
				$title = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$description = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$keywords = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$data = array(
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords,
				);
				$this->parser->parse('header',$data);
				$this->parser->parse('warring',$data);
				$this->parser->parse('footer',$data);
			}else{
				
				$title = "Picture library  The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$description = "Picture library The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$keywords = "Picture library  The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
				$data = array(
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords,
					'data_task_hotnews' => $task_hot_news,
					'task_even_calendar' => $task_even_calendar,
					'datacontent' => $data_getcontent_gallery,
					
				);
				$this->parser->parse('header',$data);
				//$this->parser->parse('slide',$data);
				$this->parser->parse('content/gallery',$data);
				$this->parser->parse('footer',$data);
			}
	}
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>