<h1>Các Mẫu Template Yahoo </h1>

<h4> Mẫu 300x250</h4>

<div class="mau350x250" style="width: 300px; height: 270px; border-radius: 4px; border: 1px solid rgb(50, 100, 137) ! important; background: #086F1F;">
	<div class="content_hitek_ads_v350x250" style="margin-top: -35px;">
	
	<?php 
	$keywords = "saigon";
	$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$keywords.'&maxCount=30&keywordCharEnc=utf8&outputCharEnc=utf8&affilData=ip%113.190.247.20%26ua%3DMozilla%252F5.0%2B%2528Windows%2BNT%2B6.1%253B%2BTrident%252F7.0%253B%2Brv%253A11.0%2529%2Blike%2BGecko&serveUrl=http%3A%2F%2Fwww.news.com.vn%2F');
		$xml   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
			 
			if($xml->ResultSet->Listing != ''){
				foreach($xml->ResultSet->Listing as $value){ } 
					$url= $value->ClickUrl;
					echo '</br>';
					echo '<div class="qcnew" style="width: 300px;padding-top: 10px; position: absolute; visibility: visible;top: 195px;">';
					echo '<p><span style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;"><a style=" text-decoration: none;" target="_bank" href="'.$url.'" style="font-size:120%;"><b style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;">'.$value['title'].'</b></a></span></p>';
			
					echo '</div>';
					echo '</br>';
			?>
	</div>
		<div class="images_hitek_ads_v350x250" style="width: 300px; height: 250px; background: transparent url("http://cdn.onlineincometeacher.com/wp-content/uploads/2011/11/Submit-Your-Site-To-Bing-and-Yahoo.jpg?b6fad9") repeat scroll 0% 0%;">
		<?php 
		$keywords = "dulich";
		$jsonimages = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=2.0&start=4&imgsz=small&imgtype=photo&as_filetype=png&as_sitesearch=google.com&safe=active&q='.$keywords.'');
			$dataimages = json_decode($jsonimages);
			//print_r($dataimages);
			foreach ($dataimages->responseData->results as $result) { }
					$images = $result->unescapedUrl;
					//echo $images;
					$tbWidth = $result->tbWidth;
					$tbHeight = $result->tbHeight; ?>
					<a href="<?php echo $url; ?>" target="_blank"><img  src="<?php echo $images; ?>" width="300px" height="250px"/></a>
		<span style="font-size: 10px;float: right;"><a href="http://it.vn" target="_blank" style="color: rgb(246, 246, 246); margin-right: 10px;">Ads by IT.VN</a></span>	 
		</div>
		<?php } ?>
</div>

</hr>
</br>

<h4> Mẫu 336x280</h4>

<div class="mau350x250" style="width: 336px; height: 280px; border-radius: 4px; border: 1px solid rgb(50, 100, 137) ! important; background: #086F1F;">
	<div class="content_hitek_ads_v350x250" style="margin-top: -35px;">
	
	<?php 
	$keywords = "saigon";
	$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$keywords.'&maxCount=30&keywordCharEnc=utf8&outputCharEnc=utf8&affilData=ip%113.190.247.20%26ua%3DMozilla%252F5.0%2B%2528Windows%2BNT%2B6.1%253B%2BTrident%252F7.0%253B%2Brv%253A11.0%2529%2Blike%2BGecko&serveUrl=http%3A%2F%2Fwww.news.com.vn%2F');
		$xml   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
			 
			if($xml->ResultSet->Listing != ''){
				foreach($xml->ResultSet->Listing as $value){ } 
					$url= $value->ClickUrl;
					echo '</br>';
					echo '<div class="qcnew" style="width: 336px;padding-top: 10px; position: absolute; visibility: visible;top: 195px;">';
					echo '<p><span style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;"><a style=" text-decoration: none;" target="_bank" href="'.$url.'" style="font-size:120%;"><b style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;">'.$value['title'].'</b></a></span></p>';
			
					echo '</div>';
					echo '</br>';
			?>
	</div>
		<div class="images_hitek_ads_v350x250" style="width: 336px; height: 260px; background: transparent url("http://cdn.onlineincometeacher.com/wp-content/uploads/2011/11/Submit-Your-Site-To-Bing-and-Yahoo.jpg?b6fad9") repeat scroll 0% 0%;">
		<?php 
		$keywords = "dulich";
		$jsonimages = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=2.0&start=4&imgsz=medium&imgtype=photo&as_filetype=png&as_sitesearch=google.com&safe=active&q='.$keywords.'');
			$dataimages = json_decode($jsonimages);
			//print_r($dataimages);
			foreach ($dataimages->responseData->results as $result) { }
					$images = $result->unescapedUrl;
					//echo $images;
					$tbWidth = $result->tbWidth;
					$tbHeight = $result->tbHeight; ?>
					<a href="<?php echo $url; ?>" target="_blank"><img  src="<?php echo $images; ?>" width="336px" height="260px"/></a>
		<span style="font-size: 10px;float: right;"><a href="http://it.vn" target="_blank" style="color: rgb(246, 246, 246); margin-right: 10px;">Ads by IT.VN</a></span>	 
		</div>
		<?php } ?>
</div>


</hr>
</br>

<h4> Mẫu 160x600</h4>

<div class="mau350x250" style="width: 160px; height: 600px; border-radius: 4px; border: 1px solid rgb(50, 100, 137) ! important; background: #086F1F;">
	<div class="content_hitek_ads_v350x250" style="margin-top: -35px;">
	
	<?php 
	$keywords = "saigon";
	$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$keywords.'&maxCount=30&keywordCharEnc=utf8&outputCharEnc=utf8&affilData=ip%113.190.247.20%26ua%3DMozilla%252F5.0%2B%2528Windows%2BNT%2B6.1%253B%2BTrident%252F7.0%253B%2Brv%253A11.0%2529%2Blike%2BGecko&serveUrl=http%3A%2F%2Fwww.news.com.vn%2F');
		$xml   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
			 
			if($xml->ResultSet->Listing != ''){
				foreach($xml->ResultSet->Listing as $value){ } 
					$url= $value->ClickUrl;
					echo '</br>';
					echo '<div class="qcnew" style="width: 100%;padding-top: 10px; position: absolute; visibility: visible;top: 195px;">';
					echo '<p><span style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;"><a style=" text-decoration: none;" target="_bank" href="'.$url.'" style="font-size:120%;"><b style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;">'.$value['title'].'</b></a></span></p>';
			
					echo '</div>';
					echo '</br>';
			?>
	</div>
		<div class="images_hitek_ads_v350x250" style="width: 160px; height: 580px; background: transparent url("http://cdn.onlineincometeacher.com/wp-content/uploads/2011/11/Submit-Your-Site-To-Bing-and-Yahoo.jpg?b6fad9") repeat scroll 0% 0%;">
		<?php 
		$keywords = "dulich";
		$jsonimages = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=2.0&start=4&imgsz=large&imgtype=photo&as_filetype=png&as_sitesearch=google.com&safe=active&q='.$keywords.'');
			$dataimages = json_decode($jsonimages);
			//print_r($dataimages);
			foreach ($dataimages->responseData->results as $result) { }
					$images = $result->unescapedUrl;
					//echo $images;
					$tbWidth = $result->tbWidth;
					$tbHeight = $result->tbHeight; ?>
					<a href="<?php echo $url; ?>" target="_blank"><img  src="<?php echo $images; ?>" width="160px" height="580px"/></a>
		<span style="font-size: 10px;float: right;"><a href="http://it.vn" target="_blank" style="color: rgb(246, 246, 246); margin-right: 10px;">Ads by IT.VN</a></span>	 
		</div>
		<?php } ?>
</div>

</hr>
</br>

<h4> Mẫu 970x90</h4>

<div class="mau350x250" style="width: 970px; height: 90px; border-radius: 4px; border: 1px solid rgb(50, 100, 137) ! important; background: #086F1F;">
	<div class="content_hitek_ads_v350x250" style="margin-top: -35px;">
	
	<?php 
	$keywords = "saigon";
	$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$keywords.'&maxCount=30&keywordCharEnc=utf8&outputCharEnc=utf8&affilData=ip%113.190.247.20%26ua%3DMozilla%252F5.0%2B%2528Windows%2BNT%2B6.1%253B%2BTrident%252F7.0%253B%2Brv%253A11.0%2529%2Blike%2BGecko&serveUrl=http%3A%2F%2Fwww.news.com.vn%2F');
		$xml   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
			 
			if($xml->ResultSet->Listing != ''){
				foreach($xml->ResultSet->Listing as $value){ } 
					$url= $value->ClickUrl;
					echo '</br>';
					echo '<div class="qcnew" style="width: 100%;padding-top: 10px; position: absolute; visibility: visible;top: 195px;">';
					echo '<p><span style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;"><a style=" text-decoration: none;" target="_bank" href="'.$url.'" style="font-size:120%;"><b style="color: black; transition: none 0s ease 0s ; text-decoration: none; padding-left: 19px; padding-bottom: 29px;">'.$value['title'].'</b></a></span></p>';
			
					echo '</div>';
					echo '</br>';
			?>
	</div>
		<div class="images_hitek_ads_v350x250" style="width: 970px; height: 70px; background: transparent url("http://cdn.onlineincometeacher.com/wp-content/uploads/2011/11/Submit-Your-Site-To-Bing-and-Yahoo.jpg?b6fad9") repeat scroll 0% 0%;">
		<?php 
		$keywords = "dulich";
		$jsonimages = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=2.0&start=4&imgsz=huge&imgtype=photo&as_filetype=png&as_sitesearch=google.com&safe=active&q='.$keywords.'');
			$dataimages = json_decode($jsonimages);
			//print_r($dataimages);
			foreach ($dataimages->responseData->results as $result) { }
					$images = $result->unescapedUrl;
					$tbWidth = $result->tbWidth;
					$tbHeight = $result->tbHeight; ?>
					<a href="<?php echo $url; ?>" target="_blank"><img  src="<?php echo $images; ?>" width="970px" height="70px"/></a>
		<span style="font-size: 10px;float: right;"><a href="http://it.vn" target="_blank" style="color: rgb(246, 246, 246); margin-right: 10px;">Ads by IT.VN</a></span>	 
		</div>
		<?php } ?>
</div>


</hr>
</br>
</hr>
</br>
</hr>
</br>


<?php 
$datakeyword = array('hotels','travels','hanoi','vietnam','dalat','nhatrang','khanhhoa','dulich','danang');
foreach($datakeyword as $keywords){}
$feed = file_get_contents('https://xml-apac-ss.ysm.yahoo.com/d/search/p/standard/xml/sea/vn/?mkt=sg&Partner=dotvn_vn_news_en_ss&type=trafficsource_A&termFilters=dotvn_sea&Keywords='.$keywords.'&maxCount=4&keywordCharEnc=utf8&outputCharEnc=utf8&affilData=ip%113.190.247.20%26ua%3DMozilla%252F5.0%2B%2528Windows%2BNT%2B6.1%253B%2BTrident%252F7.0%253B%2Brv%253A11.0%2529%2Blike%2BGecko&serveUrl=http%3A%2F%2Fwww.news.com.vn%2F');
$xml   = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
// echo "<pre>";
// print_r($xml->ResultSet->Listing[0]->ClickUrl);
// echo "</pre>";


if($xml->ResultSet->Listing != ''){

$jsonimages = file_get_contents('http://ajax.googleapis.com/ajax/services/search/images?v=2.0&start=4&imgsz=medium&imgtype=photo&as_filetype=jpg&as_sitesearch=google.com&safe=active&q='.$keywords.'');
$dataimages = json_decode($jsonimages);	

?>
<script type="text/javascript">
// Banner Rotation Script by Bloggerism
var ban = new Array();
var link = new Array();
var index = 0;
ban[0] = new Image();
ban[0].src = "<?php echo $dataimages->responseData->results[1]->unescapedUrl; ?>";
link[0] = "<?php echo $xml->ResultSet->Listing[1]->ClickUrl; ?>";
ban[1] = new Image();
ban[1].src = "<?php echo $dataimages->responseData->results[2]->unescapedUrl; ?>";
link[1] = "<?php echo $xml->ResultSet->Listing[2]->ClickUrl; ?>";
ban[2] = new Image();
ban[2].src = "<?php echo $dataimages->responseData->results[3]->unescapedUrl; ?>";
link[2] = "<?php echo $xml->ResultSet->Listing[3]->ClickUrl; ?>";
index = Math.random() * (ban.length);
index = Math.floor(index);
function rotator()
{if (index == ban.length) index = 0;
if (document.images) {
document.images.rotation.src = ban[index].src;
}
else {
document.getElementById('rotation').src=ban[index].src;
}
index++;
setTimeout('rotator()',5000);
}
function go() {window.open(link[index-1]);}
</script>
<img id="rotation" width="300px" height="250px" style="cursor:pointer;" src="<?php echo $dataimages->responseData->results[0]->unescapedUrl; ?>" onclick="go();"/>
<script type="text/javascript">rotator();</script>	

<?php  } ?>	
