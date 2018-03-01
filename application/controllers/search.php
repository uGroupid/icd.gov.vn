<?php
class Search extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
			$this->output->cache(5);
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	


	public function index(){  
    $KeywordSearch = $_REQUEST['q'];
	if($KeywordSearch==null){
		$dataKeyworksSearch = $this->callbuyMD->search_keyworks($KeywordSearch);
      if( $dataKeyworksSearch != ''){
			$title = "Tìm Kiếm";
			$description = "Tìm Kiếm";
			$keywords = "Tìm Kiếm";
			$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
			$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
			$data = array(
				'title' => $title,
				'description' => $description,
				'img' => 'http://www3.icd.gov.vn/images/logo.png',
				'keywords' => $keywords,
				'data_task_hotnews' => $task_hot_news,
				'task_even_calendar' => $task_even_calendar,
				'data_getcontent_category' => $dataKeyworksSearch,
				'datacontent' => $dataKeyworksSearch,
			);
			$this->parser->parse('header',$data);
			$this->parser->parse('content/search',$data);
			$this->parser->parse('footer',$data);
      }else{
          redirect("http://icd.gov.vn/","localtion");
      }
	}else{
          redirect("http://icd.gov.vn/","localtion");
      }
      
  }
	

	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>