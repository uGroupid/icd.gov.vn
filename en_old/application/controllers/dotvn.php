<?php
class Dotvn extends MY_Controller{
	function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));		
	}
	
	public function index(){
		
		$datakeyword =  $this->input->post('data_keywords');
 		$uas =   $this->input->post('data_ua');
		$ips =  $this->input->post('data_ip');
		$urls =   $this->input->post('data_url');
		$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$datakeyword.'&maxCount=1&keywordCharEnc=utf8&outputCharEnc=utf8&affilData='.$ips.$uas.'&serveUrl='.$urls);
		
		$xmls   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
		if($xmls->ResultSet->Listing != ''){
			echo '<div class="itvn_connect_ads" style="background: none ; float: left; width: 100%; height: 120px;"><div> ';
		
				 foreach($xmls->ResultSet->Listing as $values){ 
					if($xmls->ResultSet->Listing != ''){
							$url= $xmls->ResultSet->Listing->ClickUrl; 
							
			echo '					<div class="qcnew" style="width: 100%;"><div class="header_itvn_ads"><span>';
			echo '							<a target="_blank" href="'.$url.'" style="text-decoration: none ! important; color: rgb(113, 13, 13); font-size: 17px; width: 100%; float: left;" >';
			echo '								<b>'.$values['title'].'</b></a></span>';
			echo ' 								<a style="text-decoration: none ! important; " target="_blank" href="'.$url.'">';
			echo '							<b style="color: #1E7D83  !important; font-size: 14px;">'. $values['siteHost'].'</b><em style="color:#BCA1D2"> sponsored ad ($) </em></a></div><div class="description">';
			echo '							<a target="_blank" href="'. $url. '" style=" padding-bottom: 15px; text-decoration: none;color:#000;"><i style="font-size: 14px;">'.$values['description'];
			echo '								</i></a></div></div>';
							
					 } 
					} 
			echo '</div></div>';
		 }else{
			 echo 0;		 
		 }
			
			
		
	}
	
	public function test(){
		$servername = "113.190.247.20";
		$username = "c0infoen";
		$password = "2051991fF";
		$dbname = "c0infoen";
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * 
		FROM  jos_content 
		LIMIT 0 , 30";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["catid"]. " - Name: " . $row["parentid"]. "<br>";
			}
		} else {
			echo "0 results";
		}
	}
	
	
	
}
?>