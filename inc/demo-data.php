<?php
/* Create Demo Data */
if(!function_exists('techrona_enable_export_mode')){
	add_filter('kng_ie_export_mode', 'techrona_enable_export_mode');
	function techrona_enable_export_mode() {
	    return false;
	}
}

add_action( 'kng-ie-import-finish', 'techrona_update_el_default_kit_option' );
function techrona_update_el_default_kit_option(){
	$kit_id = techrona_get_id_by_slug('default-kit', 'elementor_library'); 
	if(!empty($kit_id))
		update_option( 'elementor_active_kit', $kit_id, 'yes' );
}