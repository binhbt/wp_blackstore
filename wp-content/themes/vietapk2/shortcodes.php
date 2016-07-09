<?php
//////////////////////////////////////////////////////////////////
// Raw Shortcode
//////////////////////////////////////////////////////////////////
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);


// Tabs shortcode
add_shortcode('tabs', 'shortcode_tabs');
	function shortcode_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));

	$out .= '<div class="download"><div class="dl_menu">Tải về</div>';
	
	foreach ($atts as $key => $tab) {
	}
	
	$out .= do_shortcode($content) .'</div>';
	
	return $out;
}

add_shortcode('tab', 'shortcode_tab');
	function shortcode_tab( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out .= '<ul>[raw]<li id="tab' . $atts['id'] . '" class="item">[/raw]' . do_shortcode($content) .'</li></ul>';
	
	return $out;
}

// Download button
add_shortcode('download', 'shortcode_download');
	function shortcode_download($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'title' => 'title',
				'link' => 'link',
			), $atts);
		
			return '<div><a href="' . $atts['link'] . '" class="downloadfree">' . $atts['title'] . '</a></div><br clear="all">';
	}

// Youtube shortcode
add_shortcode('youtube', 'shortcode_youtube');
	function shortcode_youtube($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
			), $atts);
		
			return '<div class="video-item"><iframe class="image-ratio" src="http://www.youtube.com/embed/' . $atts['id'] . '" ></iframe></div>';
	}

// Vimeo shortcode
add_shortcode('vimeo', 'shortcode_vimeo');
	function shortcode_vimeo($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
			), $atts);
		
			return '<div class="video-item"><iframe class="image-ratio" src="http://player.vimeo.com/video/' . $atts['id'] . '" ></iframe></div>';
	}

// Phan trang
add_shortcode('pnv', 'shortcode_pnv');
	function shortcode_pnv($atts, $content = null) {
		
			return '<!--nextpage-->';
	}

//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button');  
   }  
}  

function register_button($buttons) {  
   array_push($buttons, "youtube", "vimeo", "download", "pnv", "tabs");  
   return $buttons;  
}  

function add_plugin($plugin_array) {  
   $plugin_array['youtube'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['vimeo'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['download'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['pnv'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/tinymce/customcodes.js';
   return $plugin_array;  
}  