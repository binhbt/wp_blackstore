<?php
class z_metabox {
	
	public function __construct() {
	add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
	add_action('save_post', array($this, 'save_meta_boxes'));
	}
	
	public function add_meta_boxes() {
	$this->add_meta_box('form', 'Thông tin', 'post');
	}
	
	public function add_meta_box($id, $label, $post_type) {
	add_meta_box( 
	    'z_' . $id,
	    $label,
	    array($this, $id),
	    $post_type
	 );
	}
	
	public function save_meta_boxes($post_id)
	{
		if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}
		
		foreach($_POST as $key => $value) {
			if(strstr($key, 'z_')) {
				update_post_meta($post_id, $key, $value);
			}
		}
	}
	
	// Include form
	public function form() {
	include 'form.php';
	}
/* -------------------------------- Field Support --------------------------------- */	
	public function text($id, $label, $desc = '')
	{
		global $post;
		$html .= '<div class="z_metabox_field">';
			$html .= '<label for="z_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<input type="text" id="z_' . $id . '" name="z_' . $id . '" value="' . get_post_meta($post->ID, 'z_' . $id, true) . '" />';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}
	
	public function textarea($id, $label, $desc = '')
	{
		global $post;
		$html .= '<div class="z_metabox_field">';
			$html .= '<label for="z_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<textarea id="z_' . $id . '" name="z_' . $id . '" rows="5">' . get_post_meta($post->ID, 'z_' . $id, true) . '</textarea>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}	
	
	public function select($id, $label, $options, $desc = '')
	{
		global $post;
		$html .= '<div class="z_metabox_field">';
			$html .= '<label for="z_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				$html .= '<select id="z_' . $id . '" name="z_' . $id . '">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'z_' . $id, true) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}
					
					$html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
				}
				$html .= '</select>';
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}
	
	public function radio($id, $label, $options, $desc = '')
	{
		global $post;
		$html .= '<div class="z_metabox_field">';
			$html .= '<label for="z_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'z_' . $id, true) == $key) {
						$selected = 'selected="selected"';
					} else {
						$selected = '';
					}
					
					$html .= '<input ' . $selected . ' type="radio" name="' . $id . '" id="' . $key . '" value="' . $key . '" />
					<label class="radio" for="' . $key . '">' . $option . '</label><br>';
				}
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}	

	public function checkbox($id, $label, $options, $desc = '')
	{
		global $post;
		$html .= '<div class="z_metabox_field">';
			$html .= '<label for="z_' . $id . '">';
			$html .= $label;
			$html .= '</label>';
			$html .= '<div class="field">';
				foreach($options as $key => $option) {
					if(get_post_meta($post->ID, 'z_' . $id, true) == $key) {
						$selected = 'checked="checked"';
					} else {
						$selected = '';
					}
					
					$html .= '<input ' . $selected . ' type="checkbox" name="' . $id . '" id="' . $key . '" value="' . $key . '" />
					<label class="radio" for="' . $key . '">' . $option . '</label><br>';
				}
				if($desc) {
					$html .= '<p>' . $desc . '</p>';
				}
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
	}	
}

$metaboxes = new z_metabox;
