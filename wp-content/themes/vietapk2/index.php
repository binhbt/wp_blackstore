<?php get_header(); ?>
<div class="bentrai">
<div id="Blog1">
<div class="nav"><i class="fa fa-refresh fa-spin"></i> Game mới</div>
 <?php $i = 1 ; ?>
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php if ($i == 1): ?>
<div class="labelfirstposts">
<div class="imagebv">
<a href="<?php the_permalink();?>" title="<?php the_title();?>">
<img width="70" height="70" src="<?php echo my_image_display(); ?>" class="thumb wp-post-image" alt="<?php the_title();?>" title="<?php the_title();?>" /></a></div>
<div class="tenbaiviet"><h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2></div>
<div class="game-title" style="margin-top: 5px;"><span class="item">
	Hỗ trợ: <?php if(get_post_meta($post->ID, 'z_hotroandroid', true)): ?>
<i class="fa fa-android" style="color:#86c620"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotroios', true)): ?>
<i class="fa fa-apple" style="color:#040505"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotrojava', true)): ?>
<i class="fa fa-java" style="color:#86c620"></i>
<?php endif; ?>																		</span>		
<?php if(get_post_meta($post->ID, 'z_link_download', true)): ?>
<a href="<?php echo get_post_meta($post->ID, 'z_link_download', true); ?>" rel="nofollow" class="re_download">&nbsp;</a>
<?php endif; ?>
</div>
<div class="benduoi">
<span class="column">
<?php if(get_post_meta($post->ID, 'z_kichthuoc', true)): ?>
<span class="ico-app-size"></span>  <span class="info_items_val"><?php echo get_post_meta($post->ID, 'z_kichthuoc', true); ?></span>
<?php endif; ?> - <span class="ico-app-down"></span> <span class="info_items_val"><?php echo getPostViews(get_the_ID()); ?></span></span>
</div>
		<div class="clear"></div>
				</div>
<?php else: ?>
<div class="vvip" style="padding: 3px;">
					 <h2> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				</div>
<?php endif; ?>
<?php $i++; endwhile; endif; ?>
<?php if(function_exists("hals_page")) {hals_page();} ?>
</div>
<?php chia_cat(1); ?>
<?php chia_cat(2); ?>
<?php chia_cat(3); ?>
</div><!--./End Blog1 -->
</div><!--./End bentrai -->
<?php get_sidebar(); ?>
<!--./End benphai -->
<?php get_footer(); ?>