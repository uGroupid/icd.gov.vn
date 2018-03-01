<?php

class Home_model extends CI_Model{
		function __construct(){
			parent::__construct();
				$this->load->driver('cache');
	}
	public function search_keyworks($name_keyword){
    $this->db->select('*');
		$this->db->limit(100);
		$this->db->like('title_conent_vi',$name_keyword);
		$this->db->or_like('keywords',$name_keyword);
		$this->db->or_like('description',$name_keyword);
		$this->db->or_like('title_conent_en',$name_keyword);
		$this->db->or_like('introduction',$name_keyword);
		$this->db->or_like('content_vi',$name_keyword);
		$this->db->or_like('content_en',$name_keyword);
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
  }
	function get_data_home_cultural_news(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->where('active',1);
		$this->db->where('sub_menu',11);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
	}
	function get_data_home_family_news(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->where('active',1);
		$this->db->where('sub_menu',20);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
	}
	function get_data_home_sports_news(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->where('active',1);
		$this->db->where('sub_menu',12);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
	}

  function GetdataContentTin_Lien_Quan($sub_menu,$idcontent){
		$this->db->select('*');
		$this->db->limit(6);
		$this->db->where('id_content !=',$idcontent);
		$this->db->where('sub_menu',$sub_menu);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
	}
  
	function get_data_home_travel_news(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->where('active',1);
		$this->db->where('sub_menu',13);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
				return $query->result_array();
	}
	
	function getdata_lichsukien($date_month){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->like('datelichsukien', $date_month);
		$this->db->from('tbl_lichsukien');
			$query = $this->db->get();
				return $query->result();
	}
	function data_config_footer(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_config_footer');
			$query = $this->db->get();
				return $query->result_array();
	}
	function data_icon_index_a(){
		$this->db->select('*');
		$this->db->where('id',1);
		$this->db->from('tbl_icon_index');
			$query = $this->db->get();
				return $query->result_array();
	}
	function data_link_lienkettrang(){
		$this->db->select('*');
		$this->db->from('tbl_site_link');
			$query = $this->db->get();
				return $query->result_array();
	}
	function data_icon_index_b(){
		$this->db->select('*');
		$this->db->where('id',2);
		$this->db->from('tbl_icon_index');
			$query = $this->db->get();
				return $query->result_array();
	}
	
	function data_profiles_icd(){
		$this->db->select('*');
		$this->db->from('tbl_phongban');
			$query = $this->db->get();
				return $query->result_array();
	}
	function get_data_profiles_icd($id){
		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('tbl_phongban');
			$query = $this->db->get();
				return $query->result_array();
	}
	function ho_so_lanh_dao_cuc($id){
		$this->db->select('*');
		$this->db->where('name_phongban',$id);
		$this->db->from('tbl_nhansu_phongban');
			$query = $this->db->get();
				return $query->result_array();
	}
	function detdata_index_video(){
		$this->db->select('*');
		$this->db->where('id_menu',22);
		$this->db->where('tin_hot_category',1);
		$this->db->limit(1);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_video');
			$query = $this->db->get();
				return $query->result_array();
	}
	
	function detdata_index_videos(){
		$this->db->select('*');
		$this->db->where('id_menu',23);
		$this->db->where('tin_hot_category',1);
		$this->db->limit(1);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_video');
			$query = $this->db->get();
				return $query->result_array();
	}
	
	function get_discussion_question(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->order_by("date_contact", "desc"); 
		$this->db->from('tbl_discussion_question');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	
	function get_data_contact(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_config_contact');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	
	function get_data_setion_images_home(){
		$this->db->select('*');
		$this->db->limit(5);
		$this->db->order_by("stt", "asc"); 
		$this->db->from('tbl_section_homeimages');
			$query = $this->db->get();
				return $query->result_array();
	}
	function get_calendar_view($date){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->like('datelichsukien',$date);
		$this->db->order_by("id_lichsukien", "desc"); 
		$this->db->from('tbl_lichsukien');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function get_calendar_view_details($iddanhmuc){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('id_lichsukien',$iddanhmuc);
		$this->db->order_by("id_lichsukien", "desc"); 
		$this->db->from('tbl_lichsukien');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function data_getcontent_gallery(){
		$this->db->select('*');
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_album_images');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function get_calendar_view_def(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->limit(5);
		$this->db->order_by("datelichsukien", "desc"); 
		$this->db->from('tbl_lichsukien');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function get_data_home_sukienchungtoi(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',2);
		$this->db->limit(1);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function get_data_home_tinanh(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',30);
		$this->db->limit(1);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function get_data_home_sukienchungtoi_vn(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',2);
		$this->db->where('sub_menu',10);
		$this->db->limit(1);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
		
	}	
	function get_data_home_sukienchungtoi_qt(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',2);
		$this->db->where('sub_menu',9);
		$this->db->limit(1);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
		
	}
	function list_task_content_hot_news(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',3);
		$this->db->limit(5);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
	}
	
	function list_task_content_hot_even_calendar(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('mem_subche',2);
		$this->db->limit(5);
		$this->db->order_by("id_content", "desc"); 
		$this->db->from('tbl_content');
			$query = $this->db->get();
			return $query->result_array();
	}
	function get_headersub_contrc($idmenu){
		$this->db->select('*');
		//$this->db->where('active',1);
		$this->db->where('id_danhmuc',$idmenu);
		$this->db->from('tbl_danhmuc');
			$query = $this->db->get();
				return $query->result_array();
	}
	function get_headersub_contr_video($idmenu){
		$this->db->select('*');
		$this->db->where('id_danhmuc',$idmenu);
		$this->db->from('tbl_danhmuc');
			$query = $this->db->get();
				return $query->result_array();
	}
	
	function tbl_get_header_danhmuc_sub($id_danhmuc){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('subcate',$id_danhmuc);
		$this->db->from('tbl_danhmuc');
			$query = $this->db->get();
				return $query->result_array();	
	}
	
	
	function tbl_get_header_danhmuc(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('subcate',0);
		$this->db->from('tbl_danhmuc');
			$query = $this->db->get();
			return $query->result_array();
	}
	
	
	function tbl_get_home_slideshow($id){
		$this->db->select('*');
		$this->db->where('id_slideshow !=',$id);
		$this->db->where('active',1);
		$this->db->limit(15);
		$this->db->order_by("id_slideshow", "desc"); 
		$this->db->from('tbl_slideshow');
		
			$query = $this->db->get();
			return $query->result_array();
	}
	function tbl_get_home_slideshows(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->limit(1);
		$this->db->order_by("id_slideshow", "desc"); 
		$this->db->from('tbl_slideshow');
			$query = $this->db->get();
			return $query->result_array();
	}
	function tbl_get_home_album_slideshows(){
		$this->db->select('*');
		$this->db->limit(1);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_album_images');
			$query = $this->db->get();
			return $query->result_array();
	}
		function tbl_get_home_album_slideshow(){
		$this->db->select('*');
		$this->db->limit(15);
		$this->db->order_by("id", "desc"); 
		$this->db->from('tbl_album_images');
		
			$query = $this->db->get();
			return $query->result_array();
	}
	
	
	function tbl_get_home_lichsukien(){
		$time = time();
		$dateday = date('Y-m-d',$time);
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->where('datelichsukien >=',$dateday);
		$this->db->limit(10);
		$this->db->order_by("datelichsukien", "asc"); 
		$this->db->from('tbl_lichsukien');
			$query = $this->db->get();
			return $query->result_array();
	}
	
	
	function tbl_get_home_diemden(){
		$this->db->select('*');
		$this->db->where('active',1);
		$this->db->limit(7);
		$this->db->order_by("id_diadiemdulich", "asc"); 
		$this->db->from('tbl_diadiemdulich');
			$query = $this->db->get();
			return $query->result_array();
	}
	
	function tbl_getcontent($sub_menu){
			$this->db->select('*');
			$this->db->where('tin_hot_category !=',1);
			$this->db->where('active',1);
			$this->db->where('sub_menu',$sub_menu);
			$this->db->limit(10);
			$this->db->order_by("id_content", "desc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->result_array();
	}
	
	function tbl_getcontent_video($sub_menu){
			$this->db->select('*');
			$this->db->where('tin_hot_category !=',1);
			$this->db->where('active',1);
			$this->db->where('id_menu',$sub_menu);
			$this->db->limit(10);
			$this->db->order_by("id", "desc"); 
			$this->db->from('tbl_video');
				$query = $this->db->get();
					return $query->result_array();
	}
	
	function get_header_video(){
			$this->db->select('*');
			$this->db->where('subcate',21);
			$this->db->from('tbl_danhmuc');
				$query = $this->db->get();
				return $query->result_array();
	}  
	

	
	function tbl_getcontent_category($sub_menu){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('sub_menu',$sub_menu);
			$this->db->where('tin_hot_category', 1);
			$this->db->limit(1);
			$this->db->order_by("id_content", "desc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->result_array();
	}
	function tbl_getcontent_category_video($sub_menu){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('id_menu',$sub_menu);
			$this->db->where('tin_hot_category', 1);
			$this->db->limit(1);
			$this->db->order_by("id", "desc"); 
			$this->db->from('tbl_video');
				$query = $this->db->get();
				return $query->result_array();
	}
	function tbl_countcontent($sub_menu){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('sub_menu',$sub_menu);
			$this->db->order_by("id_content", "desc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->num_rows();
	}
	
	function data_getcontent_details($idcontent){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('id_content',$idcontent);
			$this->db->limit(1);
			$this->db->order_by("id_content", "asc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->result_array();
	}
	
	
	function data_getcontent_details_video($idcontent){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('id',$idcontent);
			$this->db->limit(1);
			$this->db->order_by("id", "asc"); 
			$this->db->from('tbl_video');
				$query = $this->db->get();
				return $query->result_array();
	}
	////////////////////
	
	
	function tbl_getcontentse($idmenu,$start){
			$this->db->select('id_content,title_conent_vi');
			$this->db->where('active',1);
			$this->db->where('sub_menu',$idmenu);
			$this->db->limit(5,$start);
			$this->db->order_by("id_content", "asc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->result_array();
	}
	function tbl_countcontentse($sub_menu){
			$this->db->select('*');
			$this->db->where('active',1);
			$this->db->where('sub_menu',$sub_menu);
			$this->db->order_by("id_content", "desc"); 
			$this->db->from('tbl_content');
				$query = $this->db->get();
				return $query->num_rows();
	}
	
/////////////////// End Noi dung ////////////

}
?>