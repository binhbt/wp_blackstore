<?php get_header(); ?>
<?php dimox_breadcrumbs(); ?>
<div class="phdr"> Báo Lỗi</div>
<div class="list1">
Xin Lỗi! Trang bạn truy cập không còn tồn tại!<br />
Đã bị xóa khỏi website hoặc link không đúng<br />
Bạn vui long quay lại <a href="/">Trang Chủ</a> hoặc tham khảo các bài viết phía dưới
</div>

<!--Bài ngẫu nhiên-->
<div class="share"><h2>Có thể bạn quan tâm ^^!</h2></div>
				
	<div class="content_block">
	<?php $posts = get_posts('orderby=rand&numberposts=10'); foreach($posts as $post) { ?> 
		<div class="tenbai">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</div>

<?php } ?> 
</div>

<?php get_footer(); ?>