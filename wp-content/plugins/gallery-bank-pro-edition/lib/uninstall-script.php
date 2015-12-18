<?php
global $wpdb,$current_user;
if (!is_user_logged_in()) {
	return;
}

$sql = "DROP TABLE " . gallery_bank_albums();
$wpdb->query($sql);

$sql = "DROP TABLE " . gallery_bank_pics();
$wpdb->query($sql);

$sql = "DROP TABLE " . gallery_bank_settings();
$wpdb->query($sql);

$sql = "DROP TABLE " . gallery_bank_licensing();
$wpdb->query($sql);
delete_option("gallery-bank-pro-edition");
delete_option("gallery-bank-updation-check-url");
delete_option("gallery-bank-activation");
delete_option("allow_tracking_gb");
?>