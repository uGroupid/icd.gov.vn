<?php
class Details extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
				error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));	
			//$this->output->cache(5);
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	
	
	public function dic($idcontent,$nametitle,$title,$idmenu){
		if($idmenu == NULL && $idcontent == NULL){redirect("home","localtion");}else{
			$data_item_menu_header = $this->callbuyMD->get_headersub_contrc($idmenu);
			$data_getcontent_details = $this->callbuyMD->data_getcontent_details($idcontent);
			if($data_item_menu_header == NULL && $data_getcontent_details == NULL ){
				$title = "International Cooperation Department ";
				$description = "International Cooperation Department ";
				$keywords = "International Cooperation Department ";
				$data = array(
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords,
				);
				$this->parser->parse('header',$data);
				$this->parser->parse('warring',$data);
				$this->parser->parse('footer',$data);
			}else{
				foreach($data_item_menu_header as $value_header_data_item){}
				$nametitle = $value_header_data_item['name_en'];
				foreach($data_getcontent_details as $value_data_getcontent_details){}
				$titles = $value_data_getcontent_details['title_conent_en'];
				$description = $value_data_getcontent_details['description'];
				$keywords = $value_data_getcontent_details['keywords'];
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
        $task_Tin_Lien_Quan = $this->callbuyMD->GetdataContentTin_Lien_Quan($idmenu,$idcontent);
       // print_r($task_Tin_Lien_Quan);
				$data = array(
					'title' => $titles,
					'description' => $description,
					'nametitle' => $nametitle,
					'keywords' => $keywords,
					'data_task_hotnews' => $task_hot_news,
					'task_even_calendar' => $task_even_calendar,
					'iddanhmuc' => $idmenu,
					'datacontent' => $data_getcontent_details,
					'task_Tin_Lien_Quan' => $task_Tin_Lien_Quan,
					'idcontent'			=> $idcontent,
				);
				$this->parser->parse('header',$data);
				//$this->parser->parse('slide',$data);
				$this->parser->parse('content/details',$data);
				$this->parser->parse('footer',$data);
			}
		}
	}
	public function video($idcontent,$title,$idmenu){
		
		if($idmenu == NULL && $idcontent == NULL){redirect("home","localtion");}else{
			$data_item_menu_header = $this->callbuyMD->get_headersub_contr_video($idmenu);
			$data_getcontent_details = $this->callbuyMD->data_getcontent_details_video($idcontent);
			if($data_item_menu_header == NULL && $data_getcontent_details == NULL ){
				$title = "International Cooperation Department ";
				$description = "International Cooperation Department ";
				$keywords = "International Cooperation Department ";
				$data = array(
					'title' => $title,
					'description' => $description,
					'keywords' => $keywords,
				);
				$this->parser->parse('header',$data);
				$this->parser->parse('warring',$data);
				$this->parser->parse('footer',$data);
			}else{
				//echo "<pre>"; var_dump($data_item_menu_header);die;
				foreach($data_item_menu_header as $value_header_data_item){}
				$nametitle = $value_header_data_item['name_en'];
				foreach($data_getcontent_details as $value_data_getcontent_details){}
				$titles = $value_data_getcontent_details['title_video'];
				$description = $value_data_getcontent_details['description'];
				$keywords = $value_data_getcontent_details['keywords'];
				$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
				$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
				$data = array(
					'title' => $titles,
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
				$this->parser->parse('content/details_video',$data);
				$this->parser->parse('footer',$data);
			}
		}
	}
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>