<div class="container-wrap">
<div class="main-content container-boxed max offset">
	<div class="row">
		<div class="noo-main col-md-8 right-sidebar noo-page" role="main">
			<div class="noo-vc-row row " style=" padding-top: 20px; padding-bottom: 20px;">
				<div class="noo-vc-col col-md-12 ">
					<div class="noo-post-list">
					 <?php $newsget = $this->callbuyMD->news_get(); 
					 foreach($newsget as $news) {
					 ?>
					 
						<article id="post-5882" class="post-5882 post type-post status-publish format-video hentry category-game has-featured">
						<div class="content-wrap">
							<header class="content-header">
							<h2 class="content-title">
							<a href="<?php echo base_url();?>page/view_news/<?php echo $news['id_news'];?>" title="<?php echo $news['name_en'];?>"><?php echo $news['name_en'];?></a>
							</h2>
							<p class="content-meta">
								<span>
								Posted in <a href="<?php echo base_url().uri_string();?>" title="Quat Gio Cong Nghiep">Quat Gio Cong Nghiep</a></span>
								<span>
								on <time class="entry-date" datetime="<?php echo $news['timedate'];?> </time>">
								<?php echo $news['timedate'];?> </time>
								</span>
								<span><a href="<?php echo base_url().uri_string();?>" title="Quat Gio Cong Nghiep" class="meta-comments"><i class="nooicon-comments"></i></a></span>
								</header>
								<div class="content-featured">
									<div id="noo-video-container5882" class="noo-video-container 16-9-ratio">
										<div class="video-inner">
											<img src="<?php echo base_url();?>assets/uploads/<?php echo $news['img'];?>" width="500" height="281"></img>
										</div>
									</div>
								</div>
								<div class="content-excerpt">
									<p>
										<?php echo $news['introduction'];?>
									</p>
									<a href="<?php echo base_url();?>page/view_news/<?php echo $news['id_news'];?>" class="read-more">Read More <i class="fa fa-arrow-circle-o-right"></i></a>
								</div>
							</div>
							</article>
					 <?php  } ?>
					</div>
				</div>
			</div>
		</div>
		<div class=" noo-sidebar col-md-4">
			<div class="noo-sidebar-wrapper">
				
				<div id="recent-posts-2" class="widget widget_recent_entries">
					<h4 class="widget-title">Recent Posts</h4>
					<ul>
						<li>
						<a href="../news-from-nintendo/index.html">News from Nintendo</a>
						</li>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>