<?php
class Video extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
			//$this->output->cache(5);
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	

	public function dic($title,$idmenu){
		if($idmenu == NULL){redirect("home","localtion");}else{
			$data_item_menu_header = $this->callbuyMD->get_headersub_contr_video($idmenu);
			
			if($data_item_menu_header == NULL){
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
				$title = $value_header_data_item['name_en'];
				$description = $value_header_data_item['description'];
				$keywords = $value_header_data_item['keywords'];
				$datacontent 	= $this->callbuyMD->tbl_getcontent_video($value_header_data_item['id_danhmuc']);
				$hot_video 		= $this->callbuyMD->tbl_get_videohot($value_header_data_item['id_danhmuc']);
				
				$data_getcontent_category = $this->callbuyMD->tbl_getcontent_category_video($value_header_data_item['id_danhmuc']);
					
				if($data_getcontent_category == NULL){
					redirect("home","localtion");
				}else{
					$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
					$task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
					$data = array(
						'title' 					=> $title,
						'description' 				=> $description,
						'keywords' 					=> $keywords,
						'iddanhmuc' 				=> $idmenu, 
						'data_task_hotnews' 		=> $task_hot_news,
						'datacontent' 				=> $datacontent,
						'task_even_calendar' 		=> $task_even_calendar,
						'data_getcontent_category' 	=> $data_getcontent_category,
						'hot_video'					=> $hot_video,
					);
					//echo "<pre>";var_dump($hot_video);die;
					$this->parser->parse('header',$data);
					//$this->parser->parse('slide',$data);
					$this->parser->parse('content/list_video',$data);
					$this->parser->parse('footer',$data);
				}
				
			}
		}
	}
	
	

	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>