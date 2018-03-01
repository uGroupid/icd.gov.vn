
	<div class="container-wrap">
		<div class="main-content container-boxed max offset">
			<div class="row">
				<div class="noo-main col-md-8 right-sidebar noo-page" role="main">
					<div class="noo-vc-row row " style="">
						<div class="noo-vc-col col-md-12 ">
							<div class="recent-properties">
								<div class="properties grid">
									<div class="properties-header">
										<h1 class="page-title">
										<?php foreach($get_danhmuc as $value_danhmuc_get){} echo "<u>All Products ".$value_danhmuc_get['name_en']."</u></a>";?>
										</h1>
										<div class="properties-toolbar">
											<a class="selected" data-mode="grid" href="<?php echo base_url();?>?mode=grid" title="Grid"><i class="fa fa-th-large"></i></a>
											<a class="" data-mode="list" href="<?php echo base_url();?>?mode=list" title="List"><i class="fa fa-list"></i></a>
										</div>
									</div>
									<div class="properties-content">
										<?php foreach($get_list_product as $value_listproducts){ ?>
										<article id="property-5939" class="post-5939 noo_property type-noo_property status-publish has-post-thumbnail hentry has-featured">
										<div class="property-featured">
										
											<a class="content-thumb" href="<?php echo base_url();?>page/detail/<?php echo $value_listproducts['id_products'];?>">
											<img width="370" height="300px" src="<?php echo base_url();?>assets/uploads/<?php echo $value_listproducts['img'];?>" class="attachment-property-thumb wp-post-image" alt="<?php echo $value_listproducts['name_products'];?>"/></a>
											<span class="property-category"><a href="<?php echo base_url();?>page/detail/<?php echo $value_listproducts['id_products'];?>" rel="tag"><?php echo $value_listproducts['name_products'];?></a></span>
										</div>
										<div class="property-wrap">
											<h2 class="property-title">
											<a target="_bank" href="<?php echo base_url();?>page/detail/<?php echo $value_listproducts['id_products'];?>" title="<?php echo $value_listproducts['name_products'];?>"><?php echo mb_substr($value_listproducts['name_products'],0,39,'UTF-8');?></a>
											</h2>
											<div class="property-excerpt">
												
												<p class="property-fullwidth-excerpt">
													<?php echo mb_substr($value_listproducts['introduction'],0,390,'UTF-8');?>
												</p>
											</div>
											<div class="property-summary">
												
												<div class="property-info">
													<div class="property-price">
														<a class="button" href="#popup1">Download Catalogue <i class="fa fa-arrow-circle-o-right"></i></a>
													</div>
													<div class="property-action">
														<a href="<?php echo base_url();?>page/detail/<?php echo $value_listproducts['id_products'];?>">More Details</a>
													</div>
												</div>
												
											</div>
										</div>
										<div class="property-action property-fullwidth-action">
											<a href="../properties/ava-high-line/index.html">More Details</a>
										</div>
										</article>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class=" noo-sidebar col-md-4">
					<div class="noo-sidebar-wrapper">
						
						<div id="noo_property_featured-3" class="widget smk_sidebar_2131 widget_noo_property_featured">
							<h3 class="widget-title">Other products</h3>
							
							<div class="property-featured">
								<ul>
								<?php $products_dsitener = $this->callbuyMD->get_detail_list_products($value_listproducts['id_catelog']);
								foreach($products_dsitener as $products_dsiteners){
								?>
									<li>
										<div class="featured-image">
											<a href="<?php echo base_url();?>page/detail/<?php echo $products_dsiteners['id_products'];?>"><img width="190" height="160" src="<?php echo base_url();?>assets/uploads/<?php echo $products_dsiteners['img'];?>" class="attachment-property-infobox wp-post-image" alt="<?php echo  $products_dsiteners['name_products']?>"/></a>
										</div>
											<h4><a href="<?php echo base_url();?>page/detail/<?php echo $products_dsiteners['id_products'];?>"><?php echo  $products_dsiteners['name_products']?></a></h4>
									</li>
								<?php } ?>	
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="popup1" class="overlay">
			<div class="popup">
				<h2>Please Enter Information To Download</h2>
				<a class="close" href="#">×</a>
				<div class="content">
					<form id="inputdownload"  method="post" action="<?php echo base_url();?>page/customer_contact">
						<br>
						  <input class="inputdowload" id="fullname" name="fullname" type="text" value="" placeholder="Full Name">
							<br>
						  <input class="inputdowload" id="email" name="email" type="email" value="" placeholder="example@quatgiocongnghiep.com.vn">
							<br>
						  <input class="inputdowload" id="phone" name="phone" type="phone" value="" placeholder="(+84)0981907109">
							<br>
						  <button id="buttondownload" name="submit" type="submit" value=""/>Download Now</button>
					</form>
				</div>
			</div>
		</div>
<style>

#buttondownload {
    width: 100%;
    height: 59px;
    margin-top: 15px;
    border-radius: 8px;
    border: none;
	background: #1FA52A;
	font-size: 27px;
color: #fff;
font-weight: bold;
}
.inputdowload{
    width: 100%;
    height: 43px;
    border: 1px slo;
    border-radius: 4px;
    margin-top: 20px;
}
#buttondownload:hover {
    width: 100%;
    height: 59px;
    margin-top: 15px;
    border-radius: 8px;
    border: none;
	background: #224872;
	font-size: 27px;
color: #fff;
font-weight: bold;
}
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
margin: 200px auto;
padding: 20px;
background: #FFF none repeat scroll 0% 0%;
border-radius: 5px;
width: 52%;
position: relative;
transition: all 5s ease-in-out 0s;
}

.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: orange;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}
</style>
	</div>
