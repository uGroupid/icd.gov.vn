
	<div class="container-wrap">
		<div class="main-content container-boxed max offset">
			<div class="row">
				<div class="noo-main col-md-8 right-sidebar" role="main">
					<article id="post-6605" class="property">
					<?php foreach($detail as $value_detail){}?>
					<h1 class="property-title">
					 <span class="property-category"><?php echo $value_detail['name_products'];?></span>
					</h1>
					<div class="property-share clearfix">
						<a href="#share" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" class="noo-social-facebook" title="Share on Facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo base_url().uri_string();?>','popupFacebook','width=650,height=270,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
						</a>
						<a href="#share" class="noo-social-twitter" title="Share on Twitter" onclick="window.open('https://twitter.com/intent/tweet?text=The+Helux&amp;url=<?php echo base_url().uri_string();?>','popupTwitter','width=500,height=370,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
						</a>
						<a href="#share" class="noo-social-googleplus" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url().uri_string();?>','popupGooglePlus','width=650,height=226,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
						</a>
					</div>
					<div class="property-featured clearfix">
						<div class="images">
							<div class="caroufredsel-wrap">
								<ul>
									<li>
									<a class="noo-lightbox-item" data-lightbox-gallery="gallert_6605" href="<?php echo base_url().uri_string();?>"><img width="800" height="450" src="<?php echo base_url(); ?>assets/uploads/<?php echo $value_detail['img'];?>" class="attachment-property-image wp-post-image" alt="<?php echo $value_detail['keywords'];?>"/></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
						<div class="property-feature">
						<h4 class="property-feature-title">Property Products</h4>
						<div class="property-feature-content">
							<?php echo $value_detail['details'];?>
						</div>
					</div>
					<div class="property-feature">
						<h4 class="property-feature-title">Product details</h4>
						<div class="property-feature-content">
							<?php echo $value_detail['content'];?>
						</div>
					</div>
					</article>
					<div class="agent-property">
						<div class="agent-property-title">
							<h3>Contact Agent</h3>
						</div>
						<div class="agents grid">
							<div class="post-6280 noo_agent type-noo_agent status-publish has-post-thumbnail hentry has-featured">
								<div class="agent-featured">
									
								</div>
								<div class="agent-wrap">
									<div class="agent-summary">
										<div class="agent-info">
											<div class="agent-phone">
												<i class="fa fa-phone"></i>&nbsp;(+84)0902028689
											</div>
											<div class="agent-mobile">
												<i class="fa fa-tablet"></i>&nbsp;(+84)0981907109 
											</div>
											<div class="agent-email">
												<i class="fa fa-envelope-square"></i><a class="__cf_email__" href="#" data-cfemail=""> duckhanh123@gmail.com</a>
												
											</div>
											<div class="agent-skype">
												<i class="fa fa-skype"></i>&nbsp;quatcn
											</div>
										</div>
										
									</div>
								</div>
							</div>
							<div class="conact-agent">
								<form role="form" id=""  method="post" action="<?php echo base_url();?>page/customer_contact">
									<div style="display: none;">
										<input type="hidden" name="action" value="noo_contact_agent_property">
										<input type="hidden" name="agent_id" value="6280">
										<input type="hidden" name="property_id" value="6605">
										<input type="hidden" name="security" value="0f17b649d5">
									</div>
									<div class="form-group">
										<input type="text" name="fullname" class="form-control" placeholder="Your Name *">
									</div>
									<div class="form-group">
										<input type="email" name="email" class="form-control" placeholder="Your Email *">
									</div>
									<div class="form-group">
										<textarea name="message" class="form-control" rows="5" placeholder="Message *"></textarea>
									</div>
									<div class="form-action col-md-12 col-sm-12">
										<img class="ajax-loader" src="../../wp-content/themes/noo-citilights/assets/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
										<button type="submit" class="btn btn-default">Send a Message</button>
									</div>
								</form>
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
								<?php $products_dsiteners = $this->callbuyMD->get_detail_list_productes($value_detail['id_catelog']);
								foreach($products_dsiteners as $products_dsitensers){
								?>
									<li>
										<div class="featured-image">
											<a href="<?php echo base_url();?>page/detail/<?php echo $products_dsitensers['id_products'];?>"><img width="190" height="160" src="<?php echo base_url();?>assets/uploads/<?php echo $products_dsitensers['img'];?>" class="attachment-property-infobox wp-post-image" alt="<?php echo  $products_dsitensers['name_products']?>"/></a>
										</div>
											<h4><a href="<?php echo base_url();?>page/detail/<?php echo $products_dsitensers['id_products'];?>"><?php echo  $products_dsitensers['name_products']?></a></h4>
									</li>
								<?php } ?>	
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
		
	