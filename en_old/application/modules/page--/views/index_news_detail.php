
	<div class="container-boxed max offset">
		<div class="row">
			<div class="noo-main col-md-8 right-sidebar" role="main">
				<?php foreach($view_news as $news){} ?>
				<article id="post-5882" class="post-5882 post type-post status-publish format-video hentry category-game has-featured">
				<div class="content-featured">
				<header class="content-header">
				
					<h1 class="content-title">
					<?php echo $news['name_en'];?></h1>
						<p class="content-meta">
								<span>
								Posted in <a href="<?php echo base_url().uri_string();?>" title="Quat Gio Cong Nghiep">Quat Gio Cong Nghiep</a></span>
								<span>
								on <time class="entry-date" datetime="<?php echo $news['timedate'];?> </time>">
								<?php echo $news['timedate'];?> </time>
								</span>
								<span><a href="<?php echo base_url().uri_string();?>" title="Quat Gio Cong Nghiep" class="meta-comments"><i class="nooicon-comments"></i></a></span>
						</header>
						<p> <?php echo $news['introduction'];?> </p>
					<div id="noo-video-container5882" class="noo-video-container 16-9-ratio">
						<div class="video-inner">
							<img src="<?php echo base_url();?>assets/uploads/<?php echo $news['img'];?>" width="500" height="281"></img>
							
							
							<div class="content-share">
								<div class="noo-social social-share">
									<a href="#share" data-toggle="tooltip" data-placement="bottom" data-trigger="hover" class="noo-share" title="Share on Facebook" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo base_url().uri_string();?>','popupFacebook','width=650,height=270,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
									<i class="nooicon-facebook"></i>
									</a>
									<a href="#share" class="noo-share" title="Share on Twitter" onclick="window.open(https://twitter.com/intent/tweet?text=<?php echo $news['name_en'];?>;url=<?php echo base_url().uri_string();?>','popupTwitter','width=500,height=370,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
									<i class="nooicon-twitter"></i></a>
									<a href="#share" class="noo-share" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=<?php echo base_url().uri_string();?>','popupGooglePlus','width=650,height=226,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
									<i class="nooicon-google-plus"></i></a>
									<a href="#share" class="noo-share" title="Share on Pinterest" onclick="window.open('http://pinterest.com/pin/create/button/?url=h<?php echo base_url().uri_string();?>','popupPinterest','width=750,height=265,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
									<i class="nooicon-pinterest"></i></a>
									<a href="#share" class="noo-share" title="Share on LinkedIn" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo base_url().uri_string();?>','popupLinkedIn','width=610,height=480,resizable=0, toolbar=0, menubar=0, status=0, location=0, scrollbars=0'); return false;">
									<i class="nooicon-linkedin"></i></a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="content-wrap">
					
					
						<div class="content">
						
							<p> <?php echo $news['content'];?> </p>
						</div>
					</div>
					
					</article>
					
				</div>
				<div class=" noo-sidebar col-md-4">
					<div class="noo-sidebar-wrapper">
						<div id="recent-posts-2" class="widget widget_recent_entries">
							<h4 class="widget-title">Recent Posts</h4>
							<ul>
							 <?php $get_list_news = $this->callbuyMD->get_list_news($news['id_news']);
							 foreach($get_list_news as $get_list_newsc){
							 ?>
								<li>
								<a href="<?php echo base_url();?>page/view_news/<?php echo $get_list_newsc['id_news'];?>" title="<?php echo $get_list_newsc['name_en'];?>"><?php echo $get_list_newsc['name_en'];?></a>
								</li>
							<?php } ?>
							</ul>
						</div>
					
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
	