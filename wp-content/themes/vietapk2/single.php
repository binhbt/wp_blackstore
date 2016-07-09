<?php get_header(); ?>
<div class="breadcrumb breadcrumbs"><?php dimox_breadcrumbs(); ?></div>
<div id="Blog1">



<div class="app_head">
					<ul class="u_table u_table_top">
						<li>
							<span class="icon">
								<img width="70" height="70" src="<?php echo my_image_display(); ?>" class="icon_img wp-post-image" alt="<?php the_title();?>" title="<?php the_title();?>" />							</span>
						</li>
						<li style="width:100%;">
							<h1 class="app_name"><?php the_title();?></h1>
							
					<?php if(get_post_meta($post->ID, 'z_kichthuoc', true)): ?>
<span class="ico-app-size"></span>  <span class="info_items_val"><?php echo get_post_meta($post->ID, 'z_kichthuoc', true); ?></span>
<?php endif; ?>
					  					| <span class="ico-app-down"></span> <span class="info_items_val"><?php echo getPostViews(get_the_ID()); ?></span>  

							<div class="game-title">
												<span class="item">
																								Hỗ trợ: <?php if(get_post_meta($post->ID, 'z_hotroandroid', true)): ?>
<i class="fa fa-android" style="color:#86c620"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotroios', true)): ?>
<i class="fa fa-apple" style="color:#040505"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotrojava', true)): ?>
<i class="fa fa-java" style="color:#86c620"></i>
<?php endif; ?>
												
																								</span>		
											</div>
<?php if(get_post_meta($post->ID, 'z_qr_code', true)): ?>
<li><img width="70" height="70" src="<?php echo get_post_meta($post->ID, 'z_qr_code', true); ?>" alt="qrcode" /></li><?php endif; ?>						</li>
					</ul>



<?php if(get_post_meta($post->ID, 'z_link_download', true)): ?>
<a rel="nofollow" href="<?php echo get_post_meta($post->ID, 'z_link_download', true); ?>" title="<?php the_title();?>">
										<button class="download_btn" id="blockTop" style="position: relative;  top: 0px;  -webkit-box-shadow: none;"><i class="fa fa-cloud-download"></i> Download</button>
									</a> <?php endif; ?>
				</div>



<!--<div class="NavBar">
<?php dimox_breadcrumbs(); ?></div>-->
<!-- Tiêu đề -->
<?php setPostViews(get_the_ID()); ?>
    <?php if (have_posts()) { ?>
        <?php the_post(); ?>
<div id="article">
					<div class="content" id="content">
<?php if (function_exists('wp_pagenavi')) wp_pagenavi(array('type' => 'multipart')); ?>
			<?php the_content(); ?>
<?php if (function_exists('wp_pagenavi')) wp_pagenavi(array('type' => 'multipart')); ?>

			<?php } ?>
</div>
<div class="thongtin" style="border-top: 1px solid #ccc;">
<i class="fa fa-info-circle" style="font-size: 17px;margin: 10px 15px;"> Thông tin khác</i>

<ul style="margin: 0 0 5px 5px;">
<p><i class="fa fa-check-circle-o"></i> Đăng bởi: <?php the_author_meta( 'display_name' ); ?><p>

<p><i class="fa fa-check-circle-o"></i> Ngày đăng: <span class="post_time" itemprop="datePublished" content="16/04/2015"><?php the_time('d/m/Y') ?></span><p>
<?php if(get_post_meta($post->ID, 'z_phienban', true)): ?>
<p>
					<i class="fa fa-check-circle-o"></i> <span class="info_items_val">Phiên bản: <?php echo get_post_meta($post->ID, 'z_phienban', true); ?></span></p>
<?php endif; ?>					 
<?php if(get_post_meta($post->ID, 'z_kichthuoc', true)): ?>
<p>
					<i class="fa fa-check-circle-o"></i> <span class="info_items_val">Dung lượng: <?php echo get_post_meta($post->ID, 'z_kichthuoc', true); ?></span></p>
<?php endif; ?>					
<?php if(get_post_meta($post->ID, 'z_yeucau', true)): ?>
<p>
					<i class="fa fa-check-circle-o"></i> <span class="info_items_val">Yêu cầu: <?php echo get_post_meta($post->ID, 'z_yeucau', true); ?></span></p>
<?php endif; ?>					
					 
</ul>
</div>

					<div class="tukhoabv">Từ khóa: <?php the_tags('', ', '); ?></div>
<div class="widget">
	<div class="nav"><i class="fa fa-comments-o"></i> Gửi bình luận</div>
				<div class="list1">
<div class="fb-comments" data-href="<?php the_permalink();?>" data-width="100%" data-numposts="20" data-colorscheme="light"></div>
				</div>
</div>
</div></div>
<?php include (TEMPLATEPATH . '/cung-chuyen-muc.php' ); ?>
<?php get_footer(); ?>