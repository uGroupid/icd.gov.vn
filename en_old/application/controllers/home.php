<?php
class Home extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('home_model', 'callbuyMD');	
		$this->load->library('user_agent');
		 // $this->output->cache(5);
		 // $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		// $this->output->set_header("Cache-Control: post-check=0, pre-check=0");
		// $this->output->set_header("Pragma: no-cache");
	}
	

	public function index(){
		
		$title = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
		$description = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
		$keywords = "The Department International Cooperation of Ministry of of Culture, Tourism and Sport";
		$get_data_setion_images_home = $this->callbuyMD->get_data_setion_images_home();
		$get_data_home_sukienchungtoi = $this->callbuyMD->get_data_home_sukienchungtoi();
		$get_data_home_sukienchungtoi_vn = $this->callbuyMD->get_data_home_sukienchungtoi_vn();
		$get_data_home_sukienchungtoi_qt = $this->callbuyMD->get_data_home_sukienchungtoi_qt();
		$get_data_home_tinanh = $this->callbuyMD->get_data_home_tinanh();
		$task_hot_news = $this->callbuyMD->list_task_content_hot_news();
		$data_link_lienkettrang = $this->callbuyMD->data_link_lienkettrang();
		$data_video_a = $this->callbuyMD->detdata_index_video();
		$data_video_b = $this->callbuyMD->detdata_index_videos();
		$get_data_home_cultural_news = $this->callbuyMD->get_data_home_cultural_news();
		$get_data_home_family_news = $this->callbuyMD->get_data_home_family_news();
		$get_data_home_sports_news = $this->callbuyMD->get_data_home_sports_news();
		$get_data_home_travel_news = $this->callbuyMD->get_data_home_travel_news();
		
		foreach($data_video_b as $value_data_video_b){}
		foreach($data_video_a as $value_data_video_a){}
		$time_day = time();
		$year_time_calendar = date("Y",$time_day);
		$month_time_calendar = date("m",$time_day);
		$calendar = $this->calendar($year_time_calendar,$month_time_calendar);
		$data = array(
		'title' => $title,
		'description' => $description,
		'get_data_setion_images_home' => $get_data_setion_images_home,
		'get_data_home_sukienchungtoi' => $get_data_home_sukienchungtoi,
		'get_data_home_sukienchungtoi_vn' => $get_data_home_sukienchungtoi_vn,
		'get_data_home_sukienchungtoi_qt' => $get_data_home_sukienchungtoi_qt,
		'get_data_home_tinanh' => $get_data_home_tinanh,
		'data_video_a' => $this->youtube_url($value_data_video_a['linkyoutube']),
		'data_video_b' => $this->youtube_url($value_data_video_b['linkyoutube']),
		'data_task_hotnews' => $task_hot_news,
		'data_link_lienkettrang' => $data_link_lienkettrang,
		'get_data_home_cultural_news' => $get_data_home_cultural_news,
		'get_data_home_family_news' => $get_data_home_family_news,
		'get_data_home_sports_news' => $get_data_home_sports_news,
		'get_data_home_travel_news' => $get_data_home_travel_news,
		'calendar' => $calendar,
		'keywords' => $keywords,
		);
		$this->parser->parse('header',$data);
		if($this->agent->is_mobile())
		{
			$this->parser->parse('slide_mobile',$data);
			$this->parser->parse('index_home_mobile',$data);
		}else{
			$this->parser->parse('slide',$data);
			$this->parser->parse('index_home',$data);
		}
		$this->parser->parse('footer',$data);
		
	}
	
	public function ads(){
		$data = array();
		$this->parser->parse('header_data',$data);
	}
	
	public function youtube_url($string_url){
		$urlscs = parse_url($string_url);
		parse_str($urlscs['query'], $query);
			return $query['v'];
	}
	 function url_sub($str) {
		  $str = trim(mb_strtolower($str));
			$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
			$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
			$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
			$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
			$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
			$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
			$str = preg_replace('/(đ)/', 'd', $str);
			$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
			$str = preg_replace('/([\s]+)/', '-', $str);
				return $str;
	} 
	
	public function calendar($year_time_calendar,$month_time_calendar){
		
		$config_calendar = array(
			'start_day' => 'monday',
			'show_next_prev' => TRUE,// FALSE
			'day_type'     => 'short',
			'next_prev_url' => base_url().'home/operations',
		);
		$config_calendar['template'] = '

			{table_open}<table class="table" >{/table_open}

			{heading_row_start}<tr>{/heading_row_start}

			{heading_previous_cell}<th><a style="color: rgb(217, 2, 2);" href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a style="color: rgb(217, 2, 2);" href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

			{heading_row_end}</tr>{/heading_row_end}

			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<th>{week_day}</th>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}

			{cal_row_start}<tr>{/cal_row_start}
			{cal_cell_start}<td class="day_tables" >{/cal_cell_start}
			{cal_cell_start_today}<td >{/cal_cell_start_today}
			{cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

			{cal_cell_content}<a  class="day_tables_highlight" href="{content}">{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="highlight"><a  href="{content}">{day}</a></div>{/cal_cell_content_today}

			{cal_cell_no_content}{day}{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

			{cal_cell_blank}&nbsp;{/cal_cell_blank}

			{cal_cell_other}{day}{cal_cel_other}

			{cal_cell_end}</td>{/cal_cell_end}
			{cal_cell_end_today}</td>{/cal_cell_end_today}
			{cal_cell_end_other}</td>{/cal_cell_end_other}
			{cal_row_end}</tr>{/cal_row_end}

			{table_close}</table>{/table_close}
	';
		if($this->load->library('calendar',$config_calendar) == true){
			$time_day = time();
			$month_day = date('Y-m',$time_day);
			$getdata_lichsukien = $this->callbuyMD->getdata_lichsukien($month_day);
			$data = $this->query_caclua($getdata_lichsukien);
			return $this->calendar->generate($year_time_calendar,$month_time_calendar,$data);
		}
		
		
	}
	//////////////////
	public function operations($year,$month){
		$title = "Operations calendar International Cooperation Department the Ministry of Culture Sports and Tourism";
		$description = "Operations calendar International Cooperation Department the Ministry of Culture Sports and Tourism";
		$keywords = "Operations calendar International Cooperation Department the Ministry of Culture Sports and Tourism";
		
		$data = array(
			'title' => $title,
			'description' => $description,
			'keywords' => $keywords,
			'calendar' => $this->operations_icd($year,$month),
		);
		$this->parser->parse('header',$data);
		$this->parser->parse('calendar',$data);
		$this->parser->parse('footer',$data);
	}
	
	public function operations_icd($year,$month){
		
		$config_calendar = array(
			'start_day' => 'monday',
			'show_next_prev' => TRUE,// FALSE
			'day_type'     => 'short',
			'next_prev_url' => base_url().'home/operations',
		);
		$config_calendar['template'] = '
			{table_open}<table class="calendar">{/table_open}
			{week_day_cell}<th class="day_header">{week_day}</th>{/week_day_cell}
			{cal_cell_content}<span class="day_listing">{day}</span> <a target="_blank" href="{content}"> {content}</a>&nbsp;{/cal_cell_content}
			{cal_cell_content_today}<div class="today"><span class="day_listing">{day}</span><a target="_blank" href="{content}">  {content}</a></div>{/cal_cell_content_today}
			{cal_cell_no_content}<span class="day_listing">{day}</span>&nbsp;{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="today"><span class="day_listing">{day}</span></div>{/cal_cell_no_content_today}
		'; 
		if($this->load->library('calendar',$config_calendar) == true){
			$time_day = time();
			$month_day = $year."-".$month;
			$getdata_lichsukien = $this->callbuyMD->getdata_lichsukien($month_day);
			$data = $this->query_caclua($getdata_lichsukien);
			return $this->calendar->generate($year,$month,$data);
		}
		
		
	}
	
	function query_caclua($query_calendar){
		$gdata_calendar = array();
		foreach($query_calendar as $row){
			//$day = ltrim(substr($row->datelichsukien,8,2));
			$day = ltrim(substr($row->datelichsukien,8,2), '0'); 
			$url = $this->url_sub($row->title_lichsukien_vi);
			$gdata_calendar[ltrim($day)] = base_url().'calendar/dic/'.$url .'/'.$row->datelichsukien .'.icd';
		}
		return $gdata_calendar;
	} 
	

	
	
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>