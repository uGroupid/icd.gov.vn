<?php
class Document extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		//$this->output->cache(5);
		 $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");		
	}
	
  public function index(){	
        $idmenu = 32;
        $data_item_menu_header = $this->callbuyMD->get_headersub_contrc($idmenu);
        foreach($data_item_menu_header as $value_header_data_item){}
        $title = $value_header_data_item['name_vi'];
        $description = $value_header_data_item['description'];
        $keywords = $value_header_data_item['keywords'];
        $datacontent = $this->callbuyMD->tbl_getdocument($value_header_data_item['id_danhmuc']);
        $contresurt = $this->callbuyMD->tbl_countcontent($value_header_data_item['id_danhmuc']);
        $data_getcontent_category = $this->callbuyMD->tbl_getcontent_category($value_header_data_item['id_danhmuc']);
        $img = "http://www3.icd.gov.vn/images/logo.png";
        $task_hot_news = $this->callbuyMD->list_task_content_hot_news();
        $task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
    
        $data = array(
						'title' => $title,
						'description' => $description,
						'img' => $img,
						'keywords' => $keywords,
						'iddanhmuc' => $idmenu, 
						'data_task_hotnews' => $task_hot_news,
						'datacontent' => $datacontent,
						'task_even_calendar' => $task_even_calendar,
						'data_getcontent_category' => $data_getcontent_category,
						'idmenu' => $idmenu,
					);
					$this->parser->parse('header',$data);
					$this->parser->parse('content/document',$data);
					$this->parser->parse('footer',$data);
    
    
  }
  public function files($name,$id){
    if($id != null){
        $datacontent = $this->callbuyMD->tbl_get_id_document($id);
      
        foreach($datacontent as $value_header_data_item){}
          $datacontentlist = $this->callbuyMD->tbl_get_id_documents($value_header_data_item['sub_menu'],$id);
           $idmenu = $value_header_data_item['sub_menu'];
        $title = $value_header_data_item['title_vi'];
        $description = $value_header_data_item['title_vi'];
        $keywords = $value_header_data_item['title_vi'];
		$img = "http://www3.icd.gov.vn/images/logo.png";
        $data_getcontent_category = $this->callbuyMD->tbl_getcontent_category($value_header_data_item['sub_menu']);
        $task_hot_news = $this->callbuyMD->list_task_content_hot_news();
        $task_even_calendar = $this->callbuyMD->list_task_content_hot_even_calendar();
    
        $data = array(
						'title' => $title,
						'description' => $description,
						'keywords' => $keywords,
						'iddanhmuc' => $idmenu, 
						'data_task_hotnews' => $task_hot_news,
						'datacontent' => $datacontent,
						'img' => $img,
						'datacontentlist' => $datacontentlist,
						'task_even_calendar' => $task_even_calendar,
						'data_getcontent_category' => $data_getcontent_category,
						'idmenu' => $idmenu,
					);
					$this->parser->parse('header',$data);
					$this->parser->parse('content/document_file',$data);
					$this->parser->parse('footer',$data);
    }
  }
  public function search(){
    //$keywords = $this->callbuyMD->UrlDecodesc("Về việc tăng cường");
    $loaivanban = $this->input->post('loaivanban');
    $keywords = $this->input->post('keywords');
    //$datasearch = $this->callbuyMD->SearchDataDocument($keywords);
   echo $keywords;
 //  print_r( $datasearch );
  }
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>