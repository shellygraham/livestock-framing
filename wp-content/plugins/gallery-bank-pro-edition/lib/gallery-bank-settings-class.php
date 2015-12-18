<?php
global $wpdb,$current_user,$user_role_permission;
if(is_super_admin())
{
	$gb_role = "administrator";
}
else
{
	$gb_role = $wpdb->prefix . "capabilities";
	$current_user->role = array_keys($current_user->$gb_role);
	$gb_role = $current_user->role[0];
}
	switch($gb_role)
	{
		case "administrator":
			$user_role_permission = "manage_options";
		break;
		case "editor":
			$user_role_permission = "publish_pages";
		break;
		case "author":
			$user_role_permission = "publish_posts";
		break;
		case "contributor":
			$user_role_permission = "edit_posts";
		break;
		case "subscriber":
			$user_role_permission = "read";
		break;
	}

if (!current_user_can($user_role_permission))
{
	return;
}
else
{
	if (isset($_REQUEST["param"])) {
	    if ($_REQUEST["param"] == "update_global_settings") {
	        $settings_array = json_decode(stripcslashes(html_entity_decode($_REQUEST["settings_array"])));
	        $thumb_width = intval($_REQUEST["thumb_width"]);
	        $thumb_height = intval($_REQUEST["thumb_height"]);
	        $cover_width = intval($_REQUEST["cover_width"]);
	        $cover_height = intval($_REQUEST["cover_height"]);
	
	        foreach ($settings_array as $val => $innerKey) {
	            $wpdb->query
	            (
	                $wpdb->prepare
	                (
	                    "UPDATE " . gallery_bank_settings() . " SET setting_value = %s WHERE setting_key = %s",
	                    (string)current($innerKey),
	                    key($innerKey)
	                )
	            );
	        }
	
	        ////////////CODE FOR CREATING THUMBNAILS///////////
	        $album_pics = $wpdb->get_results
	        (
	            "SELECT * FROM " . gallery_bank_pics() . " order by sorting_order asc"
	        );
	        $album_covers = $wpdb->get_results
	        (
	            "SELECT * FROM " . gallery_bank_pics() . " where album_cover = 1 order by sorting_order asc"
	        );
	
	        for ($flag = 0; $flag < count($album_pics); $flag++) {
	            if ($album_pics[$flag]->video != 1) {
	                processing_uploaded_image($album_pics[$flag]->thumbnail_url, $thumb_width, $thumb_height);
	            }
	        }
	        for ($flag1 = 0; $flag1 < count($album_covers); $flag1++) {
	            if ($album_covers[$flag1]->thumbnail_url != "") {
	                processing_uploaded_album($album_covers[$flag1]->thumbnail_url, $cover_width, $cover_height);
	            }
	        }
	        die();
	    } else if ($_REQUEST["param"] == "restore_settings")
	    {
	        $sql = "TRUNCATE TABLE " . gallery_bank_settings();
	        $wpdb->query($sql);
	
	        include (GALLERY_BK_PLUGIN_DIR . "/lib/include_settings.php");
	        die();
	    }
	    else if ($_REQUEST["param"] == "update_licensing_settings")
	    {
			$api_key = esc_attr($_REQUEST["ux_api_key"]);
	        $order_id = esc_attr($_REQUEST["ux_order_id"]);
	        $wpdb->query
	        (
	            $wpdb->prepare
	            (
	                "UPDATE " . gallery_bank_licensing() . " SET api_key = %s, order_id = %s ",
	                $api_key,
	                $order_id
	            )
	        );
			update_option("gallery-bank-activation", $api_key);
	        die();
	    }
	}
}
function processing_uploaded_image($image, $width, $height)
{
    $temp_image_path = GALLERY_MAIN_UPLOAD_DIR . $image;
    $temp_image_name = $image;
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
    $uploaded_image_path = GALLERY_MAIN_UPLOAD_DIR . $temp_image_name;
    move_uploaded_file($temp_image_path, $uploaded_image_path);
    $type = explode(".", $image);
    $thumbnail_image_path = GALLERY_MAIN_THUMB_DIR . preg_replace("{\\.[^\\.]+$}", ".".$type[1], $temp_image_name);
				
    $result = processing_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

/******************************************Code for Album cover thumbs Creation**********************/
function processing_uploaded_album($album_image, $width, $height)
{
    $temp_image_path = GALLERY_MAIN_UPLOAD_DIR . $album_image;
    $temp_image_name = $album_image;
    list(, , $temp_image_type) = getimagesize($temp_image_path);
    if ($temp_image_type === NULL) {
        return false;
    }
	$uploaded_image_path = GALLERY_MAIN_UPLOAD_DIR . $temp_image_name;
    move_uploaded_file($temp_image_path, $uploaded_image_path);
    $type = explode(".", $album_image);
    $thumbnail_image_path = GALLERY_MAIN_ALB_THUMB_DIR . preg_replace("{\\.[^\\.]+$}", ".".$type[1], $temp_image_name);
    
    $result = processing_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

function processing_thumbnail($source_image_path, $thumbnail_image_path, $imageWidth, $imageHeight)
{
	ini_set("memory_limit", "256M");
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
    $source_gd_image = false;
    switch ($source_image_type) {
        case IMAGETYPE_GIF:
            $source_gd_image = imagecreatefromgif($source_image_path);
            break;
        case IMAGETYPE_JPEG:
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG:
            $source_gd_image = imagecreatefrompng($source_image_path);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    $source_aspect_ratio = $source_image_width / $source_image_height;
    if ($source_image_width > $source_image_height) {
        $real_height = $imageHeight;
        $real_width = $imageHeight * $source_aspect_ratio;
    } else if ($source_image_height > $source_image_width) {
        $real_height = $imageWidth / $source_aspect_ratio;
        $real_width = $imageWidth;

    } else {

        $real_height = $imageHeight > $imageWidth ? $imageHeight : $imageWidth;
        $real_width = $imageWidth > $imageHeight ? $imageWidth : $imageHeight;
    }


    $thumbnail_gd_image = imagecreatetruecolor($real_width, $real_height);
	
	if(($source_image_type == 1) || ($source_image_type==3)){
		imagealphablending($thumbnail_gd_image, false);
		imagesavealpha($thumbnail_gd_image, true);
		$transparent = imagecolorallocatealpha($thumbnail_gd_image, 255, 255, 255, 127);
		imagecolortransparent($thumbnail_gd_image, $transparent);
		imagefilledrectangle($thumbnail_gd_image, 0, 0, $real_width, $real_height, $transparent);
 	}
	else
	{
		$bg_color = imagecolorallocate($thumbnail_gd_image, 255, 255, 255);
		imagefilledrectangle($thumbnail_gd_image, 0, 0, $real_width, $real_height, $bg_color);
	}
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $real_width, $real_height, $source_image_width, $source_image_height);
	switch ($source_image_type)
	{
		case IMAGETYPE_GIF:
			imagepng($thumbnail_gd_image, $thumbnail_image_path, 9 );
		break;
		case IMAGETYPE_JPEG:
			imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 100);
		break;
		case IMAGETYPE_PNG:
			imagepng($thumbnail_gd_image, $thumbnail_image_path, 9 );
		break;
	}
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}

?>