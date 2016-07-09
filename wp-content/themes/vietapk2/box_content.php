<?php 
class Av_Box_Content extends WP_Widget
{
    function Av_Box_Content(){
			parent::WP_Widget('Av_Box_Content', 
					'PH Box', 
            array('description' => 'Hiển thị bài của chuyên mục.'));
    }
 
  //Displays the Widget in the front-end 
    function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? 'Recent From ' : $instance['title']);
		$posts_number = empty($instance['posts_number']) ? '' : (int) $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];

		echo $before_widget;
		if ( $title )
			echo $before_title .''. $title . $after_title;
		$args1 = array(
						'posts_per_page' => $posts_number,
						'paged' => 1,
						'cat'=> $blog_category,
						'tax_query'   => array(
							array(
							'taxonomy' => 'category', 
							'field'    => 'id', 
							'terms'    => my_get_highest_parent($blog_category) //id cua category can lay

							)
						)
				);
			$my_query = new WP_Query($args1);
			echo '<div class="phdrbox"><div class="content_block">';
			while ($my_query->have_posts()): 
				$my_query->the_post();
				$do_not_duplicate = $post->ID;
				?>
				<div class="tenbai">
						<img src="<?php bloginfo('template_url'); ?>/images/item.png" alt="+" />
						<a title="<?php echo strip_shortcodes(the_title()); ?>" href="<?php the_permalink() ?>"><?php echo strip_shortcodes(the_title()); ?></a>
				<div class="clear"></div>
				</div>
				<?php
			endwhile;
		?>
		</div></div>
		<div class="shadow"></div>
	<?php
		echo $after_widget;
    }
 
  //Saves the settings. 
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['posts_number'] = (int) $new_instance['posts_number'];
		$instance['blog_category'] = (int) $new_instance['blog_category'];
		return $instance;
    }
 
  //Creates the form for the widget in the back-end. 
    function form($instance){
		//Defaults
    $instance = wp_parse_args( (array) $instance, array('title'=>'Tên Chuyên Mục', 'posts_number'=>'5', 'blog_category'=>'') );
 
    $title = esc_attr($instance['title']);
    $posts_number = (int) $instance['posts_number'];
    $blog_category = (int) $instance['blog_category'];
 
    # Title
    echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
    # Number Of Posts
    echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Số lượng hiển thị:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
    # Category ?>
    <?php 
			$args = array(
				'echo'               => 0,
				'hierarchical'       => 1, 
				'taxonomy'           => 'category',
			);
		$cats_array = get_categories($args);
    ?>
    <p>
        <label for="<?php echo $this->get_field_id('blog_category'); ?>">Category</label>
        <select name="<?php echo $this->get_field_name('blog_category'); ?>" id="<?php echo $this->get_field_id('blog_category'); ?>" class="widefat">
            <?php foreach( $cats_array as $category ) { ?>
                <option value="<?php echo $category->cat_ID; ?>"<?php selected( $instance['blog_category'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>
            <?php } ?>
        </select>
    </p> 
    <?php
    }
 
} // end bcdonline_fromcategorieswidget class
 
function Av_Box_ContentInit() {
  register_widget('Av_Box_Content');
}
add_action('widgets_init', 'Av_Box_ContentInit');
?>