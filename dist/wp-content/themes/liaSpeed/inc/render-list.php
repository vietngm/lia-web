<?php
add_action('acf/render_field/name=noteTopping', 'render_note_topping_list_readonly', 10, 1);
function render_note_topping_list_readonly($field) {
	echo '<style>#acf-' . esc_attr($field['key']) . ' { display: none !important; }</style>';
	$json = $field['value'];
	$items = json_decode($json, true);

	if (!empty($items) && is_array($items)) {
		echo '<div class="note-topping">';
		echo '<ul class="note-topping-list">';
		foreach ($items as $item) {
			echo '<li class="note-topping-item">';
			echo '<div class="note-topping-line"><strong>Nhóm:</strong> ' . esc_html($item['group']).'</div>';
			echo '<div class="note-topping-line"><strong>Tên:</strong> ' . esc_html($item['name']).'</div>';
			echo '<div class="note-topping-line"><strong>Giá:</strong> ' . number_format($item['price']) . ' VND</div>';
			echo '</li>';
		}
		echo '</ul>';
		echo '</div>';
	} else {
			echo '<p><em>Không có topping.</em></p>';
	}
}