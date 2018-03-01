<?php
class Login extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Login_model', 'loginMD');	
		$loggedIn = $this->session->userdata('logged_in');
		if(!$loggedIn == NULL){
			//return redirect('pages');
		}return true;
	}	
	public function index()
	{	
		$data= array('');
		//print_r( $this->input->request_headers());
		$this->parser->parse('header',$data);
		$this->parser->parse('login_index',$data);
		//$this->parser->parse('footer',$data);
	}
/********************************************************************************/
/*****************Function Xcrud*************************************************/
	public function CheckLogin(){
		$Pusername = $this->input->post('username');
		$Ppassword = $this->input->post('password');
		$Rpass = md5($Ppassword);
		$CheckData = $this->loginMD->login($Pusername,$Rpass);
		$Data = $this->loginMD->Getuser($Pusername);
		foreach($Data as $row){}
		if($CheckData==true){
			$newdata = array(
				'idUser' 	 		 => $row['idUser'],
				'emailUser'    		 => $row['emailUser'],
				'nameUser'			 => $row['nameUser'],
				'idPremission'      => $row['idPremission'],
				'logged_in'		 => TRUE
			);
			$this->session->set_userdata($newdata);
			return $Data = true;
				echo json_encode($Data);
		}else{
			return $Data = 1;
				echo json_encode($Data);
		}
	}
	
/********************************************************************************/
/*****************END Class User*************************************************/
}
?>