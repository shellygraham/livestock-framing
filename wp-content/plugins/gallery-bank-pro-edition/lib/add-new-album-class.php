<?php
global $wpdb,$current_user,$user_role_permission;
$dynamicArray = array();
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
	    if ($_REQUEST["param"] == "add_new_dynamic_row_for_image") {
	        $img_path = esc_attr($_REQUEST["img_path"]);
	        $img_name = esc_attr($_REQUEST["img_name"]);
	        $img_width = intval($_REQUEST["image_width"]);
	        $img_height = intval($_REQUEST["image_height"]);
			$uploader_type = intval($_REQUEST["uploader_type"]);
			$picid = intval($_REQUEST["picid"]);
			
			if($uploader_type == 1)
			{
				process_image_upload($img_path, $img_width, $img_height);
				$image_src = GALLERY_BK_THUMB_SMALL_URL . $img_path;
			}
			else
			{
				$image_src = GALLERY_BK_THUMB_SMALL_URL . $img_name;
				$src = get_attached_file($img_path);
				$destination = GALLERY_MAIN_UPLOAD_DIR.$img_name;
				
				/*
				 * To copy the image from uploads to gallery-bank folder
				 */
				
				if(!(file_exists($destination)))
				{
					if (PHP_VERSION > 5)
					{
						copy($src, $destination);
					}
					else
	                {
	                    $content = file_get_contents($src);
	                    $fp = fopen($destination, "w");
	                    fwrite($fp, $content);
	                    fclose($fp);
	                }
				}
				process_image_upload($img_name, $img_width, $img_height);
			}
	
	        $column1 = "<input type=\"checkbox\" id=\"ux_grp_select_items_" . $picid . "\" name=\"ux_grp_select_items_" . $picid . "\" value=\"" . $picid . "\" />";
	        array_push($dynamicArray, $column1);
	
	        $column2 = "<a  href=\"javascript:void(0);\" title=\"" . $img_name . "\" >
					<img type=\"image\" imgPath=\"" . $img_path . "\"  src=\"" . $image_src . "\" id=\"ux_gb_img\" name=\"ux_gb_img\" class=\"img dynamic_css\" imageid=\"" . $picid . "\" width=\"" . $img_width . "\"/></a><br/>
					<label><strong>" . $img_name . "</strong></label><br/><label>" . date("F j, Y") . "</label><br/>
					<input type=\"radio\" style=\"cursor: pointer;\" id=\"ux_rdl_cover\" name=\"ux_album_cover\" onclick=\"select_one_radio(this);\" /><label>" . __(" Set as Album Cover", gallery_bank) . "</label>
					<br/><a id=\"ux_rotate_image\" href=\"javascript:;\"  onclick=\"rotate_image(this);\">" . __(" Rotate Image", gallery_bank) . "</a>";
	        array_push($dynamicArray, $column2);
	
	        $column3 = "<input placeholder=\"" . __("Enter your Title", gallery_bank) . "\" class=\"layout-span12\" type=\"text\" name=\"ux_img_title_" . $picid . "\" id=\"ux_img_title_" . $picid . "\" />
					<textarea placeholder=\"" . __("Enter your Description ", gallery_bank) . "\" style=\"margin-top:20px\" rows=\"5\" class=\"layout-span12\" name=\"ux_txt_desc_" . $picid . "\"  id=\"ux_txt_desc_" . $picid . "\"></textarea>";
	        array_push($dynamicArray, $column3);
	        $column4 = "<input placeholder=\"" . __("Enter your Tags", gallery_bank) . "\" class=\"layout-span12\" type=\"text\" onkeypress=\"return preventDot(event);\" name=\"ux_txt_tags_" . $picid . "\" id=\"ux_txt_tags_" . $picid . "\" />";
	        array_push($dynamicArray, $column4);
	        $column5 = "<input value=\"http://\" type=\"text\" id=\"ux_txt_url_" . $picid . "\" name=\"ux_txt_url_" . $picid . "\" class=\"layout-span12\" />";
	        array_push($dynamicArray, $column5);
	        $column6 = "<a class=\"btn hovertip\" id=\"ux_btn_delete\" style=\"cursor: pointer;\" data-original-title=\"" . __("Delete Image", gallery_bank) . "\" onclick=\"deleteImage(this);\" controlId = \"" . $picid . "\"><i class=\"icon-trash\"></i></a>";
	        array_push($dynamicArray, $column6);
	        echo json_encode($dynamicArray);
	        die();
	    } 
	    else if ($_REQUEST["param"] == "add_new_dyanmic_row_for_video") {
	        $img_width = intval($_REQUEST["image_width"]);
	        $img_height = intval($_REQUEST["image_height"]);
	        $videoUrl = esc_attr(html_entity_decode($_REQUEST["videoUrl"]));
			$picid = intval($_REQUEST["picid"]);
			$video_thumbnail_path = esc_attr(html_entity_decode($_REQUEST["video_thumbnail_path"]));
			
	        $column1 = "
					<input type=\"checkbox\" id=\"ux_grp_select_items_" . $picid . "\" name=\"ux_grp_select_items_" . $picid . "\" value=\"" . $picid . "\" />";
	        array_push($dynamicArray, $column1);
	
	        $column2 = "<a href=\"javascript:void(0);\" title=\"" . $videoUrl . "\" >
					<img imageId=\"" . $picid . "\" type=\"video\" imgpath=\"" . $video_thumbnail_path . "\"  src=\"" . $video_thumbnail_path . "\" style=\"width:" . $img_width . "px;\"  id=\"ux_gb_img\" name=\"ux_gb_img\" class=\"img dynamic_css\"/></a><br/>
					<label><strong>Video</strong></label><br/><label>" . date("F j, Y") . "</label><br>
					<input type=\"radio\" style=\"cursor: pointer;\" id=\"ux_rdl_cover\" name=\"ux_album_cover\" onclick=\"select_one_radio(this);\" /><label>" . __(" Set as Album Cover", gallery_bank) . "</label>";
	        array_push($dynamicArray, $column2);
	
	        $column3 = "<input placeholder=\"" . __("Enter your Title", gallery_bank) . "\" class=\"layout-span12\" type=\"text\" name=\"ux_video_title_" . $picid . "\" id=\"ux_video_title_" . $picid . "\" />
					<textarea placeholder=\"" . __("Enter your Description ", gallery_bank) . "\" style=\"margin-top:20px\" rows=\"5\" class=\"layout-span12\" name=\"ux_txt_desc_" . $picid . "\"  id=\"ux_txt_desc_" . $picid . "\"></textarea>";
	        array_push($dynamicArray, $column3);
	        $column4 = "<input placeholder=\"" . __("Enter your Tags", gallery_bank) . "\" class=\"layout-span12\" type=\"text\" onkeypress=\"return preventDot(event);\" name=\"ux_txt_tags_" . $picid . "\" id=\"ux_txt_tags_" . $picid . "\" />";
	        array_push($dynamicArray, $column4);
	        $column5 = "<a class=\"btn hovertip\" id=\"ux_btn_delete\" style=\"cursor: pointer;\" data-original-title=\"" . __("Delete Video", gallery_bank) . "\" onclick=\"deleteImage(this);\" controlId = \"" . $picid . "\"><i class=\"icon-trash\"></i></a>";
	        array_push($dynamicArray, $column5);
	        echo json_encode($dynamicArray);
	        die();
	    } 
	    else if ($_REQUEST["param"] == "add_pic") {
	        $ux_albumid = intval($_REQUEST["album_id"]);
	        $ux_controlType = esc_attr($_REQUEST["controlType"]);
	        $ux_img_name = esc_attr(html_entity_decode($_REQUEST["imagename"]));
	        $img_gb_path = esc_attr($_REQUEST["img_gb_path"]);
	        
	        if ($ux_controlType == "image") {
	            
                $wpdb->query
                    (
                        $wpdb->prepare
                            (
                                "INSERT INTO " . gallery_bank_pics() . " (album_id,thumbnail_url,title,description,url,video,date,tags,pic_name,album_cover)
							VALUES(%d,%s,%s,%s,%s,%d,CURDATE(),%s,%s,%d)",
                                $ux_albumid,
                                $img_gb_path,
                                "",
                                "",
                                "http://",
                                0,
                                "",
                                $ux_img_name,
                                0
                            )
                    );
	            echo $pic_id = $wpdb->insert_id;
	            $wpdb->query
	                (
	                    $wpdb->prepare
	                        (
	                            "UPDATE " . gallery_bank_pics() . " SET sorting_order = %d WHERE pic_id = %d",
	                            $pic_id,
	                            $pic_id
	                        )
	                );
	        }
	        else
	        {
	        	if(preg_match("/youtube\.com\/watch/i",$ux_img_name))
				{
					$id = explode("v=",$ux_img_name);
					$new_id = explode("&",$id[1]);
					$video_thumbnail_path = "http://img.youtube.com/vi/".$new_id[0]."/mqdefault.jpg";
				}
				elseif(preg_match("/youtu\.be\//i", $ux_img_name))
				{
					$id = explode(".be/",$ux_img_name);
					$video_thumbnail_path = "http://img.youtube.com/vi/".$id[1]."/mqdefault.jpg";
				}
				elseif(preg_match("/(?:vimeo(?:pro)?.com)\/(?:[^\d]+)?(\d+)(?:.*)/", $ux_img_name))
				{
					$path = explode("/",$ux_img_name);
					$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$path[3].php"));
					$video_thumbnail_path = $hash[0]["thumbnail_medium"];
				}
				elseif(preg_match("/dailymotion\.com/i", $ux_img_name))
				{
					$path = explode("/[_]/",$ux_img_name);
					$id = explode("/",$path[0]);
					$video_thumbnail_path = "http://www.dailymotion.com/thumbnail/video/".$id[4];
				}
				elseif(preg_match("/metacafe\.com\/watch/i", $ux_img_name))
				{
					$path = explode("/",$ux_img_name);
					$video_thumbnail_path = "http://s4.mcstatic.com/thumb/".$path[4]."/0/6/videos/0/6/".$path[5].".jpg";
				}
				elseif(preg_match("/facebook\.com/i", $ux_img_name))
				{
					$id = explode("v=",$ux_img_name);
					$path = explode("&",$id[1]);
					$video_thumbnail_path = "https://graph.facebook.com/".$path[0]."/picture";
				}
				elseif($ux_img_name != "")
				{
					$video_thumbnail_path = plugins_url("/assets/images/video.jpg",dirname(__FILE__)); 
				}
	            $wpdb->query
	                (
	                    $wpdb->prepare
	                        (
	                            "INSERT INTO " . gallery_bank_pics() . " (album_id,thumbnail_url,title,description,url,video,date,tags,pic_name,album_cover)
							VALUES(%d,%s,%s,%s,%s,%d,CURDATE(),%s,%s,%d)",
	                            $ux_albumid,
	                            $video_thumbnail_path,
	                            "",
	                            "",
	                            "http://",
	                            1,
	                            "",
	                            $ux_img_name,
	                            0
	                        )
	                );
	            $pic_id = $wpdb->insert_id;
	            $wpdb->query
	                (
	                    $wpdb->prepare
	                        (
	                            "UPDATE " . gallery_bank_pics() . " SET sorting_order = %d WHERE pic_id = %d",
	                            $pic_id,
	                            $pic_id
	                        )
	                );
	               echo $data = $pic_id.",".$video_thumbnail_path;
	        }
	        die();
	    }
	    else if ($_REQUEST["param"] == "update_album")
	    {
	        $albumId = intval($_REQUEST["albumid"]);
	        $ux_edit_album_name1 = htmlspecialchars(esc_attr($_REQUEST["edit_album_name"]));
	        $ux_edit_album_name = ($ux_edit_album_name1 == "") ? "Untitled Album" : $ux_edit_album_name1;
	        $ux_edit_description = html_entity_decode($_REQUEST["uxEditDescription"]);
	        $wpdb->query
	            (
	                $wpdb->prepare
	                    (
	                        "UPDATE " . gallery_bank_albums() . " SET album_name = %s, description = %s WHERE album_id = %d",
	                        $ux_edit_album_name,
	                        $ux_edit_description,
	                        $albumId
	                    )
	            );
	        die();
	    }
	    else if ($_REQUEST["param"] == "update_pic")
	    {
	        $album_data = json_decode(stripcslashes($_REQUEST["album_data"]),true);
	        foreach($album_data as $field)
			{
			
		        if ($field[0] == "image") {
		            if ($field[3] == "checked") {
		                $wpdb->query
		                    (
		                        $wpdb->prepare
		                            (
		                                "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, url = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
		                                htmlspecialchars($field[4]),
		                                htmlspecialchars($field[5]),
		                                $field[7],
		                                htmlspecialchars($field[6]),
		                                1,
		                                $field[1]
		                            )
		                    );
		                process_album_upload($field[2], $field[8], $field[9]);
		            } else {
		                $wpdb->query
		                    (
		                        $wpdb->prepare
		                            (
		                                "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, url = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
		                                htmlspecialchars($field[4]),
		                                htmlspecialchars($field[5]),
		                                $field[7],
		                                htmlspecialchars($field[6]),
		                                0,
		                                $field[1]
		                            )
		                    );
		            }
		        } else {
		        	if ($field[3] == "checked")
		        	{
		        		$wpdb->query
		                (
		                    $wpdb->prepare
		                        (
		                            "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
		                            htmlspecialchars($field[4]),
		                            htmlspecialchars($field[5]),
		                            htmlspecialchars($field[6]),
		                            1,
		                            $field[1]
		                        )
		                );
					}
					else 
					{
						$wpdb->query
		                (
		                    $wpdb->prepare
		                        (
		                            "UPDATE " . gallery_bank_pics() . " SET title = %s, description = %s, date = CURDATE(), tags = %s, album_cover = %d WHERE pic_id = %d",
		                            htmlspecialchars($field[4]),
		                            htmlspecialchars($field[5]),
		                            htmlspecialchars($field[6]),
		                            0,
		                            $field[1]
		                        )
		                );
					}
		            
		        }
		    }
	        die();
	    }
	    else if ($_REQUEST["param"] == "delete_pic")
	    {
	        $delete_array = (html_entity_decode($_REQUEST["delete_array"]));
	        $albumId = intval($_REQUEST["albumid"]);
	
	        $wpdb->query
	        (
				"DELETE FROM " . gallery_bank_pics() . " WHERE pic_id in ($delete_array)"
	        );
	        die();
	    }
	    else if ($_REQUEST["param"] == "reorderControls")
	    {
	        $updateRecordsArray = $_REQUEST["sortOrder"];
	        $listingCounter = 1;
	        foreach ($updateRecordsArray as $recordIDValue) {
	            $wpdb->query
	                (
	                    $wpdb->prepare
	                        (
	                            "UPDATE " . gallery_bank_pics() . " SET sorting_order = %d WHERE pic_id = %d",
	                            $listingCounter,
	                            $recordIDValue
	                        )
	                );
	            $listingCounter = $listingCounter + 1;
	        }
	        die();
	    }
	    else if ($_REQUEST["param"] == "Delete_album")
	    {
	        $album_id = intval($_REQUEST["album_id"]);
	        $wpdb->query
	        (
	            $wpdb->prepare
	                (
	                    "DELETE FROM " . gallery_bank_pics() . " WHERE album_id = %d",
	                    $album_id
	                )
	        );
	        $wpdb->query
	        (
	            $wpdb->prepare
	                (
	                    "DELETE FROM " . gallery_bank_albums() . " WHERE album_id = %d",
	                    $album_id
	                )
	        );
	        die();
	    }
	    elseif ($_REQUEST["param"] == "reorderAlbums")
	    {
	        $updateRecordsArray = $_REQUEST["sortOrder"];
	        $listingCounter = 1;
	        foreach ($updateRecordsArray as $recordIDValue) {
	            $wpdb->query
	                (
	                    $wpdb->prepare
	                        (
	                            "UPDATE " . gallery_bank_albums() . " SET album_order = %d WHERE album_id = %d",
	                            $listingCounter,
	                            $recordIDValue
	                        )
	                );
	            $listingCounter = $listingCounter + 1;
	        }
	        die();
	    }
	    elseif ($_REQUEST["param"] == "delete_all_albums")
	    {
	        $album = $wpdb->get_results
            (
                "SELECT * FROM " . gallery_bank_albums()
            );
	        for ($flag = 0; $flag < count($album); $flag++)
	        {
	            $wpdb->query
	            (
	                $wpdb->prepare
	                (
	                    "DELETE FROM " . gallery_bank_pics() . " WHERE album_id = %d",
	                    $album[$flag]->album_id
	                )
	            );
	            $wpdb->query
	            (
	                $wpdb->prepare
	                    (
	                        "DELETE FROM " . gallery_bank_albums() . " WHERE album_id = %d",
	                        $album[$flag]->album_id
	                    )
	            );
	        }
	        die();
	    }
	    elseif ($_REQUEST["param"] == "purge_all_images")
	    {
	        $pics = $wpdb->get_col
	        (
	            "SELECT thumbnail_url FROM " . gallery_bank_pics()
	        );
	        $album_cover = $wpdb->get_col
	        (
	            $wpdb->prepare
	                (
	                    "SELECT thumbnail_url FROM " . gallery_bank_pics() . " WHERE album_cover = %d ",
	                    1
	                )
	        );
	        $purged_images = array();
	        $images = array();
	        if (is_dir(GALLERY_MAIN_UPLOAD_DIR)) {
	            if ($dir = opendir(GALLERY_MAIN_UPLOAD_DIR)) {
	                $uploaded_images = array();
	
	                while (($file = readdir($dir)) !== false) {
	                    if (!is_dir(GALLERY_MAIN_UPLOAD_DIR . $file)) {
	                        $uploaded_images[] = $file;
	                    }
	                }
	                closedir($dir);
	            }
	        }
	        $images = array_diff($uploaded_images, $pics);
	        foreach ($images AS $File)
	        {
	            array_push($purged_images, $File);
	        }
	
	        for ($flag = 0; $flag < count($purged_images); $flag++) {
	
	            $img_to_delete = GALLERY_MAIN_UPLOAD_DIR . $purged_images[$flag];
	            $thumb_to_delete = GALLERY_MAIN_THUMB_DIR . $purged_images[$flag];
	            $album_thumb_to_delete = GALLERY_MAIN_ALB_THUMB_DIR . $purged_images[$flag];
	            if (file_exists($img_to_delete))
	            {
	                if ($purged_images[$flag] != "video.jpg")
	                {
	                    unlink($img_to_delete);
	                }
	            }
	            if (file_exists($thumb_to_delete))
	            {
	            	
	                unlink($thumb_to_delete);
	            }
	
	            if (file_exists($album_thumb_to_delete))
	            {
	                unlink($album_thumb_to_delete);
	            }
	        }
	        die();
	    }
	    elseif ($_REQUEST["param"] == "restore_factory_settings")
		{
			include GALLERY_BK_PLUGIN_DIR . "/lib/restore_factory_settings.php";
			die();
		}
		elseif($_REQUEST["param"] == "rotate_image")
		{
			$image_name = esc_attr($_REQUEST["image_name"]);
			$img_width = intval($_REQUEST["image_width"]);
			$img_height = intval($_REQUEST["image_height"]);
			$uploaded_image_path = GALLERY_MAIN_UPLOAD_DIR . $image_name;
			$thumbnail_image_path = GALLERY_MAIN_THUMB_DIR . $image_name;
			
			rotate_image($uploaded_image_path,$thumbnail_image_path,$img_width,$img_height);
			die();
		}
	}
}
function process_image_upload($image, $width, $height)
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
    
    $result = generate_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

/******************************************Code for Album cover thumbs Creation**********************/
function process_album_upload($album_image, $width, $height)
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
    
    $result = generate_thumbnail($uploaded_image_path, $thumbnail_image_path, $width, $height);
    return $result ? array($uploaded_image_path, $thumbnail_image_path) : false;
}

function generate_thumbnail($source_image_path, $thumbnail_image_path, $imageWidth, $imageHeight)
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
function rotate_image($source_image_path, $thumbnail_image_path, $imageWidth, $imageHeight)
{
	ini_set("memory_limit", "256M");
	$degrees = 90;
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
		//header('Content-type: image/png');
		$source = imagecreatefrompng($source_image_path);
		$source1 = imagecreatefrompng($thumbnail_image_path);
		
		$bgColor = imagecolorallocatealpha($source, 255, 255, 255, 127);
		// Rotate
		$rotate = imagerotate($source, $degrees, $bgColor); //For uploaded Image
		$rotate1 = imagerotate($source1, $degrees, $bgColor); //For Thumbnail Image
		imagesavealpha($rotate, true);
		imagesavealpha($rotate1, true);
 	}
	else
	{
		//header('Content-type: image/jpeg');
		$source = imagecreatefromjpeg($source_image_path);
		$source1 = imagecreatefromjpeg($thumbnail_image_path);
		// Rotate
		$rotate = imagerotate($source, $degrees, 0);
		$rotate1 = imagerotate($source1, $degrees, 0);
	}
	imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $real_width, $real_height, $source_image_width, $source_image_height);
	switch ($source_image_type)
	{
		case IMAGETYPE_GIF:
			imagepng($rotate,$source_image_path,9);
			imagepng($rotate1,$thumbnail_image_path,9);
		break;
		case IMAGETYPE_JPEG:
			imagejpeg($rotate,$source_image_path,100);
			imagejpeg($rotate1,$thumbnail_image_path,100);
		break;
		case IMAGETYPE_PNG:
			imagepng($rotate,$source_image_path,9);
			imagepng($rotate1,$thumbnail_image_path,9);
		break;
	}
	imagedestroy($source_gd_image);
	imagedestroy($thumbnail_gd_image);
	return true;
}
?>
