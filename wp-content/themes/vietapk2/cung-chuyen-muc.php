<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
 <!--TRAIS-->
	</div>
<div class="benphai">
		<div class="PopularPosts">
			<div class="widget-content">
				<ul>
				 <div class="nav" style="margin-top: 10px;"><i class="fa fa-list-alt"></i> Cùng Chuyên Mục</div>
<?php
    $categories = get_the_category($post->ID);
    if ($categories) 
    {
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
 
        $args=array(
        'category__in' => $category_ids,
        'post__not_in' => array($post->ID),
        'showposts'=>10, // Số bài viết bạn muốn hiển thị.
        'caller_get_posts'=>1
        );
        $my_query = new wp_query($args);
        if( $my_query->have_posts() ) 
        {
            echo '<ul>';
            while ($my_query->have_posts())
            {
                $my_query->the_post();
                ?>
	<li style="background: #fff;">
					<div class="item-thumbnail-only">
					<div class="item-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<img width="70" height="70" src="<?php echo my_image_display(); ?>" class="thumb_view wp-post-image" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />					</a>
					</div>
					<div class="item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
					</div>

<div class="game-title" style="margin-top: 5px;">  Hỗ trợ: 
									<span class="item">
																		<?php if(get_post_meta($post->ID, 'z_hotroandroid', true)): ?>
<i class="fa fa-android" style="color:#86c620"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotroios', true)): ?>
<i class="fa fa-apple" style="color:#040505"></i>
<?php endif; ?>
<?php if(get_post_meta($post->ID, 'z_hotrojava', true)): ?>
<i class="fa fa-java" style="color:#86c620"></i>
<?php endif; ?>																			</span>		
								</div>

					<div style="clear: both;"></div>
					</li>	
                <?php
            }
            echo '</ul>';
        }
    }
?>	</div>
				</ul>
			</div>
		</div>
	</div><!--phai-->
</div><!--end-->
	<?php endif; ?>