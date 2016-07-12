<?php get_header();?>

<div class="breadcrumb breadcrumbs"><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb"><a href="/" rel="v:url" property="v:title">Home</a> » <strong class="breadcrumb_last"><?php single_cat_title(); ?></strong></span></span></div><div id="Blog1">
<?php if(have_posts()){ ?>
				<?php $i=1; ?>
				<?php while(have_posts()){ ?>
				<?php the_post(); ?>
			<div class="labelfirstposts">
<div class="imagebv">
<a href="<?php the_permalink();?>" title="<?php the_title();?>">
<img width="70" height="70" src="<?php echo my_image_display(); ?>" class="thumb wp-post-image" alt="<?php the_title();?>" title="<?php the_title();?>" /></a></div>
<div class="tenbaiviet"><h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2></div>
<div class="game-title" style="margin-top: 5px;"><span class="item">
	Hỗ trợ<?php if(get_post_meta($post->ID, 'z_hotroandroid', true)): ?>
<i class="fa fa-android" style="color:#86c620"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotroios', true)): ?>
<i class="fa fa-apple" style="color:#040505"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotrojava', true)): ?>
<i class="fa fa-java" style="color:#86c620"></i>
<?php endif; ?>																		</span>		
<?php if(get_post_meta($post->ID, 'z_link_download', true)): ?>
<a href="<?php echo get_post_meta($post->ID, 'z_link_download', true); ?>" rel="nofollow" class="re_download">&nbsp;</a>    <?php endif; ?>
</div>
<div class="benduoi">
<span class="column">
<?php if(get_post_meta($post->ID, 'z_kichthuoc', true)): ?>
<span class="ico-app-size"></span>  <span class="info_items_val"><?php echo get_post_meta($post->ID, 'z_kichthuoc', true); ?></span>
<?php endif; ?> - <span class="ico-app-down"></span> <span class="info_items_val"><?php echo getPostViews(get_the_ID()); ?></span></span>
</div></div>
<div class="clear"></div>

                    <?php $i++; ?>
					<?php }?>
<?php if(function_exists("hals_page")) {hals_page();} ?>
</div>
					<?php                $randPosts = new WP_Query();                $randPosts->query('showposts=8&orderby=rand');                while($randPosts->have_posts()) : $randPosts->the_post();?>
			<?php endwhile; ?>	
			<?php }else { ?>
					
			<?php } ?>
<?php include (TEMPLATEPATH . '/view-chuyen-muc.php' ); ?>
<?php get_footer(); ?>