<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
 <!--TRAIS-->
</div>
<div class="benphai">
		<div class="nav"><i class="fa fa-list-alt"></i> Chuyên mục</div>
		<div class="widget-content">
			<ul>
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
		</div></div>
	</div><!--phai-->
</div><!--end-->
	<?php endif; ?>