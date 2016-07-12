<?php
/**
 * ----------------------------------------------------
 * WordPress
 * @author VIP
 * @version 1.0
 */
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<?php

if (substr_count ( $_SERVER ['HTTP_ACCEPT_ENCODING'], 'gzip' )) {
} else {
	ob_start ();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta
	content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no"
	name="viewport" />
<meta http-equiv="Content-Type"
	content="application/xhtml+xml; charset=<?php bloginfo('charset'); ?>" />
<meta name="author" content="blackstore@gmail.com" />
<title> <?php if ( is_home() ) { ?><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?><?php } ?> <?php if ( is_search() ) { ?>Search Results for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); echo $key; _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?><?php } ?> <?php if ( is_404() ) { ?><?php bloginfo('name'); ?> | 404 Nothing Found<?php } ?> <?php if ( is_author() ) { ?><?php bloginfo('name'); ?> | Author Archives<?php } ?> <?php if ( is_single() ) { ?><?php wp_title(''); ?> | <?php $category = get_the_category(); echo $category[0]->cat_name; ?> | <?php bloginfo('name'); ?><?php } ?> <?php if ( is_page() ) { ?><?php bloginfo('name'); ?> | <?php $category = get_the_category(); echo $category[0]->cat_name; ?>|<?php wp_title(''); ?><?php } ?> <?php if ( is_category() ) { ?><?php single_cat_title(); ?> | <?php $category = get_the_category(); echo $category[0]->category_description; ?> | <?php bloginfo('name'); ?><?php } ?> <?php if ( is_month() ) { ?><?php bloginfo('name'); ?> | Archive | <?php the_time('F, Y'); ?><?php } ?> <?php if ( is_day() ) { ?><?php bloginfo('name'); ?> | Archive | <?php the_time('F j, Y'); ?><?php } ?> <?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><?php single_tag_title("", true); } } ?> | <?php bloginfo('name'); ?> </title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet"
	href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
<link href="<?php bloginfo('template_url'); ?>/favicon.ico"
	rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet"
	href="<?php bloginfo('template_url'); ?>/style.css" type="text/css"
	media="all" />

<style type="text/css">
img.wp-smiley, img.emoji {
	display: inline !important;
	border: none !important;
	box-shadow: none !important;
	height: 1em !important;
	width: 1em !important;
	margin: 0 .07em !important;
	vertical-align: -0.1em !important;
	background: none !important;
	padding: 0 !important;
}
</style>
		<?php wp_head(); ?>
    </head>
<body>
	<div class="fullwidth" id="header">
		<div class="pagewidth">
			<ul class="htable" style="height: 62px;">
				<li class="logo"><a href="<?php bloginfo('wpurl'); ?>"
					title="Black Store"> <img alt="Android Black Store"
						src="<?php bloginfo('template_url'); ?>/images/logo.png">
				</a>
					<h1>
						<span>Tải game Android Cr@ck hay</span>
					</h1></li>
				<li style="padding-left: 20px; white-space: nowrap;">
					<form action="#" class="searchbox" method="get">
						<input class="input" name="s"
							placeholder="Nhập từ khóa tìm kiếm..." type="text">
						<button class="submit" type="submit"></button>
					</form>
				</li>
			</ul>
		</div>
	</div>
	<div class="fullwidth" id="nav">
		<div class="pagewidth">
			<ul class="htable">
				<li class="link"><a class="link_title"
					href="<?php bloginfo('wpurl'); ?>" title="Home"><img alt="Home"
						src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-home.png">
				</a></li>
				<li class="link2"><a class="link_title" href="<?php bloginfo('wpurl'); ?>/category/game/"
					title="Android"><img alt="Blogger"
						src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-android.png">
						Game</a>
					<ul class="sub-menu">
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/category/game/game-online/"
							title="Game online">Game online</a></li>
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/category/game/game-offline/"
							title="Game offline">Game offline</a></li>
					</ul></li>
				<li class="link2"><a class="link_title" href="<?php bloginfo('wpurl'); ?>/category/app/" title="Blogger"><img
						alt="app"
						src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-ios.png">
						App</a>
						<!-- 
					<ul class="sub-menu">
					
						<li class="menu-item"><a href="/ios/online-ios-games/"
							title="Game Online iOS">Online iOS Games</a></li>
						<li class="menu-item"><a href="/ios/offline-ios-games/"
							title="Game Offline iOS">Offline iOS Games</a></li>
						<li class="menu-item"><a href="/ios/ios-apps/"
							title="á»¨ng dá»¥ng iOS">iOS Apps </a></li>
							
					</ul></li>
					-->
				<li class="link2"><a class="link_title" href="<?php bloginfo('wpurl'); ?>/category/underground-app/"
					title="Underground App"><img alt="Underground App"
						src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-hand.png">
						Underground App</a>
						<!-- 
					<ul class="sub-menu">
						<li class="menu-item"><a
							href="/hinh-nen-mobile/hinh-nen-thu-phap/"
							title="HÃ¬nh ná»�n thÆ° phÃ¡p">HÃ¬nh ná»�n thÆ° phÃ¡p</a></li>
						<li class="menu-item"><a href="/hinh-nen-mobile/hinh-nen-android/"
							title="HÃ¬nh ná»�n Android">HÃ¬nh ná»�n Android</a></li>
						<li class="menu-item"><a href="/hinh-nen-mobile/hinh-nen-hoa/"
							title="HÃ¬nh ná»�n hoa">HÃ¬nh ná»�n hoa</a></li>
						<li class="menu-item"><a href="/hinh-nen-mobile/hinh-nen-sieu-xe/"
							title="HÃ¬nh ná»�n siÃªu xe">HÃ¬nh ná»�n siÃªu xe</a></li>
						<li class="menu-item"><a
							href="/hinh-nen-mobile/hinh-nen-tinh-yeu/" title="Template-Share">HÃ¬nh
								ná»�n tÃ¬nh yÃªu</a></li>
						<li class="menu-item"><a href="/hinh-nen-mobile/hinh-girl-xinh/"
							title="HÃ¬nh ná»�n girl xinh">HÃ¬nh ná»�n girl xinh</a></li>
					</ul></li>
					-->
				<li class="link2"><a class="link_title" href="<?php bloginfo('wpurl'); ?>/category/thu-thuat/"
					title="Blog VietAPK"><img alt="Blog VietAPK"
						src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-news.png">
						Thủ thuật & Tiện ích</a>
					<ul class="sub-menu">
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/category/thu-thuat/mod-android/"
							title="Mod Android">Mod Android</a></li>
						<li class="menu-item"><a href="/category/thu-thuat/thu-thuat-game/"
							title="Thủ thuật game">Thủ thuật game</a></li>
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/category/thu-thuat/hinh-nen-icon"
							title="Hình nền & Icon">Hình nền & Icon</a></li>
					</ul></li>
				<li class="link">
					<p aria-haspopup="true" class="link_title" onmouseover="">
						<img alt="App"
							src="<?php bloginfo('template_url'); ?>/images/vietapk.vn-menu.png">
						Thông tin
					</p>
					<ul class="sub-menu">
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/yeu-cau-gameapp/"
							title="Yêu cầu Game/Apps">Yêu cầu Game/Apps</a></li>
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/lien-he/" title="Liên hệ">Liên hệ</a></li>
						<li class="menu-item"><a href="<?php bloginfo('wpurl'); ?>/dieu-khoan/"
							title="Điều khoản">Điều khoản</a></li>
					</ul>
				</li>
				<li style="text-align: right; width: 100%;"></li>
			</ul>
		</div>
	</div>
	<div class="fullwidth" id="main-container">
		<div class="pagewidth" style="margin-top: 10px;">
			<div class="bentrai">