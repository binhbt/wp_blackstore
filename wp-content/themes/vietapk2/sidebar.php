<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
 <!--TRAIS-->
<div class="benphai">

<div class="social">

<iframe src="https://www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fandroidblackstore&amp;width&amp;height=258&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false&amp;appId=1444164382485740" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:258px;" allowTransparency="true"></iframe>

</div>

		<div class="PopularPosts">
		<div class="nav" style="margin-top: 10px;">
			<i class="fa fa-bar-chart"></i> <h2>Xem nhieu</h2>
		</div>
			<div class="widget-content">
				<ul>

<?php query_posts('post_type=post&meta_key=post_views_count&posts_per_page=10&orderby=meta_value_num&order=DESC'); 
			while (have_posts()): the_post(); ?>
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
			endwhile;
			wp_reset_query();?>	
				</ul>
			</div>
		</div>


		
		<div class="widget-content">
		<div class="nav" style="margin-top: 10px;"><i class="fa fa-list-alt"></i> Chuyên mục</div>
<?php
//list terms in a given taxonomy using wp_list_categories (also useful as a widget if using a PHP Code plugin)

$taxonomy     = 'genre';
$orderby      = 'name';
$show_count   = 1;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';
$child_of     = 1;
$args = array(

  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title
);
?>
<ul>
<?php foreach(get_categories("orderby=name&show_count=1&orderby=count&order=DESC&hide_empty=0") as $category) {echo '			<li><a href="'.get_category_link($category->cat_ID).'" >'.$category->cat_name.'</a></li>';} ?>
</ul>
		</div>
	</div><!--phai-->
</div><!--end-->
	<?php endif; ?>