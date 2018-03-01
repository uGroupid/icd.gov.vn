<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imageupload extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		$this->load->helper(array('form', 'url'));		
	}
	public function rest(){
		$string = "aa2.jpg";
		print_r (explode(",",$string));
	}
	public function index()
	{
	    $data = array();
		$this->load->view('admin/imageupload_view', $data);
	}
	public function doupload() {
		$name_array = array();
		$count = count($_FILES['userfile']['size']);
		foreach($_FILES as $key=>$value)
			for($s=0; $s<=$count-1; $s++) {
				$_FILES['userfile']['name']=$value['name'][$s];
				$_FILES['userfile']['type']    = $value['type'][$s];
				$_FILES['userfile']['tmp_name'] = $value['tmp_name'][$s];
				$_FILES['userfile']['error']       = $value['error'][$s];
				$_FILES['userfile']['size']    = $value['size'][$s];  
				$config['upload_path'] = 'assets/uploads/gallery/';
				$config['allowed_types'] = 'gif|jpg|png';
				$this->load->library('upload', $config);
				$this->upload->do_upload();
				$data = $this->upload->data();
				$name_array[] = $data['file_name'];
			}
			$names= implode(',', $name_array);
			$time_upload = time();
			$date_upload = date('Y-m-d',$time_upload);
				
				$data = array(
				'date_upload'=> $date_upload,
				'img'=> $names,
				);
				$this->load->database();
				$this->db->insert('tbl_album_images', $data); 
				
			//print_r($names);
	}
}