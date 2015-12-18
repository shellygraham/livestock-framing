<?php
global $wpdb;
$api_key = $wpdb->get_var
(
	"SELECT api_key FROM " . gallery_bank_licensing()
);
$album_css = $wpdb->get_results
(
	"SELECT * FROM " . gallery_bank_settings()
);

$gb_activation_status = get_option("gallery-bank-activation");
$activation_status = ($gb_activation_status == "" ? "404" : $gb_activation_status);
if (count($album_css) != 0)
{
	$setting_keys = array();
	for ($flag = 0; $flag < count($album_css); $flag++)
	{
		array_push($setting_keys, $album_css[$flag]->setting_key);
	}
	$index = array_search("admin_full_control", $setting_keys);
	$admin_full_control = intval($album_css[$index]->setting_value);

	$index = array_search("admin_read_control", $setting_keys);
	$admin_read_control = intval($album_css[$index]->setting_value);

	$index = array_search("admin_write_control", $setting_keys);
	$admin_write_control = intval($album_css[$index]->setting_value);

	$index = array_search("editor_full_control", $setting_keys);
	$editor_full_control = intval($album_css[$index]->setting_value);

	$index = array_search("editor_read_control", $setting_keys);
	$editor_read_control = intval($album_css[$index]->setting_value);

	$index = array_search("editor_write_control", $setting_keys);
	$editor_write_control = intval($album_css[$index]->setting_value);

	$index = array_search("author_full_control", $setting_keys);
	$author_full_control = intval($album_css[$index]->setting_value);

	$index = array_search("author_read_control", $setting_keys);
	$author_read_control = intval($album_css[$index]->setting_value);

	$index = array_search("author_write_control", $setting_keys);
	$author_write_control = intval($album_css[$index]->setting_value);

	$index = array_search("contributor_full_control", $setting_keys);
	$contributor_full_control = intval($album_css[$index]->setting_value);

	$index = array_search("contributor_read_control", $setting_keys);
	$contributor_read_control = intval($album_css[$index]->setting_value);
	
	$index = array_search("contributor_write_control", $setting_keys);
	$contributor_write_control = intval($album_css[$index]->setting_value);

	$index = array_search("subscriber_full_control", $setting_keys);
	$subscriber_full_control = intval($album_css[$index]->setting_value);

	$index = array_search("subscriber_read_control", $setting_keys);
	$subscriber_read_control = intval($album_css[$index]->setting_value);

	$index = array_search("subscriber_write_control", $setting_keys);
	$subscriber_write_control = intval($album_css[$index]->setting_value);
}
?>