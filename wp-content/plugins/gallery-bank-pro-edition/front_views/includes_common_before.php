<?php

global $wpdb;
$tags_array = array();
$unique_id = rand(100, 10000);
$effect = explode("-", $special_effect);
$album_css = $wpdb->get_results
(
	"SELECT * FROM " . gallery_bank_settings()
);
if (count($album_css) != 0) {
	$setting_keys = array();
	for ($flag = 0; $flag < count($album_css); $flag++) {
		array_push($setting_keys, $album_css[$flag]->setting_key);
	}
}

if (!function_exists("lightboxHex2rgb")) {
	function lightboxHex2rgb($hex)
	{
		$hex = str_replace("#", "", $hex);
		if (strlen($hex) == 3) {
			$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
		} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		$rgb = array($r, $g, $b);
		return $rgb;
	}
}
switch ($album_type) {
	case "images":
		$album = $wpdb->get_var
		(
			$wpdb->prepare
			(
				"SELECT album_name FROM " . gallery_bank_albums() . " where album_id = %d",
				$album_id
			)
		);
		
		if($display == "all" || $display == "")
		{
			switch($sort_by)
			{
				case "random":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY RAND()",
							$album_id
						)
					);
				break;
				case "pic_id":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY pic_id asc",
							$album_id
						)
					);
				break;
				case "pic_name":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY pic_name asc",
							$album_id
						)
					);
				break;
				case "title":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY title asc",
							$album_id
						)
					);
				break;
				case "date":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY date asc",
							$album_id
						)
					);
				break;
				default:
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
							$album_id
						)
					);
				break;
			}
		}
		else 
		{
			switch($sort_by)
			{
				case "random":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY RAND() LIMIT $no_of_images",
							$album_id
						)
					);
				break;
				case "pic_id":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY pic_id asc LIMIT $no_of_images",
							$album_id
						)
					);
				break;
				case "pic_name":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY pic_name asc LIMIT $no_of_images",
							$album_id
						)
					);
				break;
				case "title":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY title asc LIMIT $no_of_images",
							$album_id
						)
					);
				break;
				case "date":
					$pics = $wpdb->get_results
					(
						$wpdb->prepare
						(
							"SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d ORDER BY date asc LIMIT $no_of_images",
							$album_id
						)
					);
				break;
			}
		}
	break;
	case "individual":
		if (isset($widget)) {
			$galleryWidget = $widget;
		} else {
			$galleryWidget = "";
		}
		if ($img_in_row == "") {
			$img_in_row = 0;
		}
		$album = $wpdb->get_row
		(
			$wpdb->prepare
			(
				"SELECT * FROM " . gallery_bank_albums() . " WHERE album_id = %d",
				$album_id
			)
		);
		$albumCover = $wpdb->get_row
		(
			$wpdb->prepare
			(
				"SELECT album_cover,thumbnail_url,video FROM " . gallery_bank_pics() . " WHERE album_cover=1 and album_id = %d",
				$album_id
			)
		);
	break;
	case "grid" || "list":
		if (isset($widget)) {
			$galleryWidget = $widget;
		} else {
			$galleryWidget = "";
		}
		if ($img_in_row == "") {
			$img_in_row = 0;
		}
		if($show_albums == "all" || $show_albums == "")
		{
			$album = $wpdb->get_results
			(
				"SELECT * FROM " . gallery_bank_albums() . " order by album_order asc"
			);
		}
		else
		{
			if(preg_match("/^\d+(?:,\d+)*$/", $show_albums))
			{
				$album = $wpdb->get_results
				(
					"SELECT * FROM " . gallery_bank_albums() . " where album_id in ($show_albums) order by album_order asc"
				);
			}
		}
	break;
}
/** Switch for global settings **/
switch ($album_type) {
	case "images":
		$index = array_search("thumbnails_width", $setting_keys);
		if($widget == "true")
		{
			$thumbnails_width = intval($thumb_width);
		}
		else
		{
			$thumbnails_width = intval($album_css[$index]->setting_value);
		}

		$index = array_search("thumbnails_height", $setting_keys);
		if($widget  == "true")
		{
			$thumbnails_height = intval($thumb_height);
		}
		else
		{
			 $thumbnails_height = intval($album_css[$index]->setting_value);
		}

		$index = array_search("thumbnails_opacity", $setting_keys);
		$thumbnails_opacity = doubleval($album_css[$index]->setting_value);

		$index = array_search("thumbnails_border_size", $setting_keys);
		$thumbnails_border_size = intval($album_css[$index]->setting_value);

		$index = array_search("thumbnails_border_radius", $setting_keys);
		$thumbnails_border_radius = intval($album_css[$index]->setting_value);

		$index = array_search("thumbnails_border_color", $setting_keys);
		$thumbnails_border_color = $album_css[$index]->setting_value;

		$index = array_search("margin_btw_thumbnails", $setting_keys);
		$margin_btw_thumbnails = intval($album_css[$index]->setting_value);
		$newMargin = $margin_btw_thumbnails * 2;

		$perspective_margin_right = $margin_btw_thumbnails + 20;
		$perspective_margin_bottom = $margin_btw_thumbnails + 50;

		$index = array_search("thumbnail_text_color", $setting_keys);
		$thumbnail_text_color = $album_css[$index]->setting_value;

		$index = array_search("thumbnail_text_align", $setting_keys);
		$thumbnail_text_align = $album_css[$index]->setting_value;

		$index = array_search("thumbnail_font_family", $setting_keys);
		$thumbnail_font_family = $album_css[$index]->setting_value;

		$index = array_search("heading_font_size", $setting_keys);
		$heading_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("text_font_size", $setting_keys);
		$text_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("thumbnail_desc_length", $setting_keys);
		$thumbnail_desc_length = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_type", $setting_keys);
		$lightbox_type = $album_css[$index]->setting_value;

		$index = array_search("lightbox_overlay_opacity", $setting_keys);
		$lightbox_overlay_opacity = doubleval($album_css[$index]->setting_value);

		$index = array_search("lightbox_overlay_border_size", $setting_keys);
		$lightbox_overlay_border_size = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_overlay_border_radius", $setting_keys);
		$lightbox_overlay_border_radius = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_text_color", $setting_keys);
		$lightbox_text_color = $album_css[$index]->setting_value;

		$index = array_search("lightbox_overlay_border_color", $setting_keys);
		$lightbox_overlay_border_color = $album_css[$index]->setting_value;
		$lightbox_border_color_value = $lightbox_overlay_border_size . "px solid " . $lightbox_overlay_border_color;

		$index = array_search("lightbox_inline_bg_color", $setting_keys);
		$lightbox_inline_bg_color = $album_css[$index]->setting_value;

		$index = array_search("lightbox_overlay_bg_color", $setting_keys);
		$lightbox_overlay_bg_color = $album_css[$index]->setting_value;
		$lightbox_overlay_color = lightboxHex2rgb($lightbox_overlay_bg_color);
		$rgb_overlay_bg_color = implode(",", $lightbox_overlay_color);

		$index = array_search("lightbox_fade_in_time", $setting_keys);
		$lightbox_fade_in_time = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_fade_out_time", $setting_keys);
		$lightbox_fade_out_time = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_text_align", $setting_keys);
		$lightbox_text_align = $album_css[$index]->setting_value;

		$index = array_search("lightbox_font_family", $setting_keys);
		$lightbox_font_family = $album_css[$index]->setting_value;

		$index = array_search("lightbox_heading_font_size", $setting_keys);
		$lightbox_heading_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("lightbox_text_font_size", $setting_keys);
		$lightbox_text_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("facebook_comments", $setting_keys);
		$facebook_comments = intval($album_css[$index]->setting_value);

		$index = array_search("social_sharing", $setting_keys);
		$social_sharing = intval($album_css[$index]->setting_value);

		$index = array_search("image_title_setting", $setting_keys);
		$image_title_setting = intval($album_css[$index]->setting_value);

		$index = array_search("image_desc_setting", $setting_keys);
		$image_desc_setting = intval($album_css[$index]->setting_value);

		$index = array_search("autoplay_setting", $setting_keys);
		$autoplay_setting = intval($album_css[$index]->setting_value);
		$autoplay = ($autoplay_setting == 1) ? "true" : "false";

		$index = array_search("slide_interval", $setting_keys);
		$slide_interval = intval($album_css[$index]->setting_value);

		$index = array_search("pagination_setting", $setting_keys);
		$pagination_setting = intval($album_css[$index]->setting_value);

		$index = array_search("images_per_page", $setting_keys);
		$images_per_page = intval($album_css[$index]->setting_value);

		$index = array_search("filters_setting", $setting_keys);
		$filters_setting = intval($album_css[$index]->setting_value);

		$index = array_search("filters_color", $setting_keys);
		$filters_color = $album_css[$index]->setting_value;

		$index = array_search("filter_font_family", $setting_keys);
		$filter_font_family = $album_css[$index]->setting_value;

		$index = array_search("filter_font_size", $setting_keys);
		$filter_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("filters_text_color", $setting_keys);
		$filters_text_color = $album_css[$index]->setting_value;

		$index = array_search("album_seperator", $setting_keys);
		$album_seperator = intval($album_css[$index]->setting_value);

		$index = array_search("language_direction", $setting_keys);
		$lang_dir_setting = $album_css[$index]->setting_value;
		
		$index = array_search("url_to_redirect", $setting_keys);
		$url_to_redirect = $album_css[$index]->setting_value;
		
		$url_redirect = $url_to_redirect == 1 ? "_blank" : "";
	break;
	case "grid" || "list" || "individual":
		$index = array_search("cover_thumbnail_width", $setting_keys);
		$cover_thumbnail_width = $album_css[$index]->setting_value;

		$index = array_search("cover_thumbnail_height", $setting_keys);
		$cover_thumbnail_height = $album_css[$index]->setting_value;

		$index = array_search("cover_thumbnail_opacity", $setting_keys);
		$cover_thumbnail_opacity = $album_css[$index]->setting_value;

		$index = array_search("cover_thumbnail_border_size", $setting_keys);
		$cover_thumbnail_border_size = $album_css[$index]->setting_value;

		$index = array_search("cover_thumbnail_border_radius", $setting_keys);
		$cover_thumbnail_border_radius = $album_css[$index]->setting_value;

		$index = array_search("cover_thumbnail_border_color", $setting_keys);
		$cover_thumbnail_border_color = $album_css[$index]->setting_value;

		$index = array_search("margin_btw_cover_thumbnails", $setting_keys);
		$margin_btw_cover_thumbnails = $album_css[$index]->setting_value;
		$margin = $margin_btw_cover_thumbnails + 10;

		$index = array_search("album_text_align", $setting_keys);
		$album_text_align = $album_css[$index]->setting_value;

		$index = array_search("album_font_family", $setting_keys);
		$album_font_family = $album_css[$index]->setting_value;

		$index = array_search("album_heading_font_size", $setting_keys);
		$album_heading_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("album_text_font_size", $setting_keys);
		$album_text_font_size = intval($album_css[$index]->setting_value);

		$index = array_search("album_click_text", $setting_keys);
		$album_click_text = $album_css[$index]->setting_value;

		$index = array_search("album_text_color", $setting_keys);
		$album_text_color = $album_css[$index]->setting_value;

		$index = array_search("album_desc_length", $setting_keys);
		$album_desc_length = $album_css[$index]->setting_value;

		$index = array_search("back_button_text", $setting_keys);
		$back_button_text = $album_css[$index]->setting_value;

		$index = array_search("button_color", $setting_keys);
		$button_color = $album_css[$index]->setting_value;

		$index = array_search("button_text_color", $setting_keys);
		$button_text_color = $album_css[$index]->setting_value;

		$index = array_search("album_seperator", $setting_keys);
		$album_seperator = intval($album_css[$index]->setting_value);

		$index = array_search("language_direction", $setting_keys);
		$lang_dir_setting = $album_css[$index]->setting_value;
		
		$index = array_search("responsive_albums", $setting_keys);
		$responsive_albums = $album_css[$index]->setting_value;

		if ($gallery_type == "slideshow") {
			$index = array_search("lightbox_type", $setting_keys);
			$lightbox_type = $album_css[$index]->setting_value;
		
			$index = array_search("lightbox_overlay_opacity", $setting_keys);
			$lightbox_overlay_opacity = doubleval($album_css[$index]->setting_value);
			
			$index = array_search("lightbox_overlay_border_size", $setting_keys);
			$lightbox_overlay_border_size = intval($album_css[$index]->setting_value);

			$index = array_search("lightbox_overlay_border_radius", $setting_keys);
			$lightbox_overlay_border_radius = intval($album_css[$index]->setting_value);

			$index = array_search("lightbox_text_color", $setting_keys);
			$lightbox_text_color = $album_css[$index]->setting_value;

			$index = array_search("lightbox_overlay_border_color", $setting_keys);
			$lightbox_overlay_border_color = $album_css[$index]->setting_value;
			$lightbox_border_color_value = $lightbox_overlay_border_size . "px solid " . $lightbox_overlay_border_color;

			$index = array_search("lightbox_inline_bg_color", $setting_keys);
			$lightbox_inline_bg_color = $album_css[$index]->setting_value;

			$index = array_search("lightbox_overlay_bg_color", $setting_keys);
			$lightbox_overlay_bg_color = $album_css[$index]->setting_value;
			$lightbox_overlay_color = lightboxHex2rgb($lightbox_overlay_bg_color);
			$rgb_overlay_bg_color = implode(",", $lightbox_overlay_color);

			$index = array_search("lightbox_fade_in_time", $setting_keys);
			$lightbox_fade_in_time = intval($album_css[$index]->setting_value);

			$index = array_search("lightbox_fade_out_time", $setting_keys);
			$lightbox_fade_out_time = intval($album_css[$index]->setting_value);

			$index = array_search("lightbox_text_align", $setting_keys);
			$lightbox_text_align = $album_css[$index]->setting_value;

			$index = array_search("lightbox_font_family", $setting_keys);
			$lightbox_font_family = $album_css[$index]->setting_value;

			$index = array_search("lightbox_heading_font_size", $setting_keys);
			$lightbox_heading_font_size = intval($album_css[$index]->setting_value);

			$index = array_search("lightbox_text_font_size", $setting_keys);
			$lightbox_text_font_size = intval($album_css[$index]->setting_value);

			$index = array_search("facebook_comments", $setting_keys);
			$facebook_comments = intval($album_css[$index]->setting_value);

			$index = array_search("social_sharing", $setting_keys);
			$social_sharing = intval($album_css[$index]->setting_value);

			$index = array_search("image_title_setting", $setting_keys);
			$image_title_setting = intval($album_css[$index]->setting_value);

			$index = array_search("image_desc_setting", $setting_keys);
			$image_desc_setting = intval($album_css[$index]->setting_value);

			$index = array_search("autoplay_setting", $setting_keys);
			$autoplay_setting = intval($album_css[$index]->setting_value);
			$autoplay = ($autoplay_setting == 1) ? "true" : "false";

			$index = array_search("slide_interval", $setting_keys);
			$slide_interval = intval($album_css[$index]->setting_value);
		}
	break;
}
?>
	<!-- Switch for global css  -->
<style type="text/css">
	<?php
	switch($album_type)
	{
		case "images":
			if($gallery_type != "slideshow")
			{
				?>
				/*noinspection ALL*/
				.dynamic_css {
					border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?> !important;
					border-radius: <?php echo $thumbnails_border_radius;?>px !important;
					-moz-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
					-o-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
				}
				p:empty {
					margin :0px !important;
				}
				.dynamic_css img {
					margin: 0 !important;
					padding: 0 !important;
					border: 0 !important;
				}
				.dynamic_css p
				{
					margin :0px !important;
				}
				.thumbnail_width<?php echo $unique_id;?>
				{
					width: <?php echo $thumbnails_width;?>px !important;
					height: <?php echo $thumbnails_height;?>px !important;
					box-sizing: border-box !important;
				}
				.images-in-row_<?php echo $unique_id;?> a, 
				.widget-images-in-row_<?php echo $unique_id;?> a
				{
					border-bottom: none !important;
				}
				.images-in-row_<?php echo $unique_id;?> p, 
				.widget-images-in-row_<?php echo $unique_id;?> p
				{
					margin :0px !important;
				}
				/*noinspection ALL*/
				<?php
				if($widget != "true")
				{
				?>
					.imgLiquidFill {
						<?php
						if($effect[0] == "")
						{
							?>width: <?php echo $thumbnails_width + ($thumbnails_border_size * 2) ;?>px !important;
							box-sizing: border-box !important;
							<?php
						}
						else
						{
							?>width: <?php echo $thumbnails_width;?>px !important;
								box-sizing: border-box !important;
							<?php
						}
						?>
						height: <?php echo $thumbnails_height;?>px !important;
					}
					<?php
					if($gallery_type != "blog" && $responsive != "true")
					{
						?>
						.images-in-row_<?php echo $unique_id;?>
						{
							<?php
							if($gallery_type != "masonry")
							{
								if($pagination_setting == 1)
								{
									?>height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil($images_per_page / $img_in_row) + 20 ;?>px !important;
									<?php
								}
								else
								{
									?>height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil(count($pics) / $img_in_row) + 20 ;?>px !important;
									<?php
								}
								if($effect[0] != "")
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + 10) * $img_in_row ;?>px !important;
									<?php
								}
								else
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
									<?php
								}
							}
							else if($gallery_type == "masonry")
							{
								if($effect[0] != "")
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2) + 10) * $img_in_row ;?>px !important;
									<?php
								}
								else
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2)) * $img_in_row ;?>px !important;
									<?php
								}
							}
							?>clear: both;
						}
						<?php
					}
					?>
					.images-in-row_<?php echo $unique_id;?> a
					{
						text-decoration:none !important;
					}
					.margin_thumbs {
						margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
						margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
					}
					.gallery-bank-filter-categories a {
						text-decoration: none !important;
						font-family: <?php echo $filter_font_family;?> !important;
						font-size: <?php echo $filter_font_size;?>px !important;
					}
					.gallery-bank-filter .gallery-bank-filter-categories a.act:first-child {
						background-color: <?php echo $filters_color;?> !important;
						color: <?php echo $filters_text_color;?> !important;
						font-family: <?php echo $filter_font_family;?> !important;
						font-size: <?php echo $filter_font_size;?>px !important;
					}
					.gallery-bank-filter .gallery-bank-filter-categories a.act {
						background-color: <?php echo $filters_color;?> !important;
						color: <?php echo $filters_text_color;?> !important;
						font-family: <?php echo $filter_font_family;?> !important;;
						font-size: <?php echo $filter_font_size;?>px !important;
					}
					.gallery-bank-filter .gallery-bank-filter-categories a.act:last-child {
						background-color: <?php echo $filters_color;?> !important;
						color: <?php echo $filters_text_color;?> !important;
						font-family: <?php echo $filter_font_family;?> !important;
						font-size: <?php echo $filter_font_size;?>px !important;
					}
					.gallery-bank-filter-categories a:hover {
						color: <?php echo $filters_color;?> !important;
					}
					<?php
				}
				else
				{
					?>
					.widgetImgLiquidFill<?php echo $unique_id;?> {
						<?php
						if($effect[0] == "")
						{
							?>width: <?php echo $thumbnails_width + ($thumbnails_border_size * 2) ;?>px !important;
								box-sizing: border-box !important;
							<?php
						}
						else
						{
							?>width: <?php echo $thumbnails_width;?>px !important;
								box-sizing: border-box !important;
							<?php
						}
						?>
						height: <?php echo $thumbnails_height;?>px !important;
					}
					.widget-images-in-row_<?php echo $unique_id;?> a
					{
						text-decoration: none !important;
					}
					<?php
					if($responsive != "true")
					{
						?>
						.widget-images-in-row_<?php echo $unique_id;?>
						{
							<?php
							if($gallery_type != "masonry")
							{
								?>height: <?php echo ($thumbnails_height + $margin_btw_thumbnails) * ceil(count($pics) / $img_in_row) + 20 ;?>px !important;
								<?php
								if($effect[0] != "")
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + 10) * $img_in_row ;?>px !important;
									<?php
								}
								else
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)) * $img_in_row ;?>px !important;
									<?php
								}
							}
							else if($gallery_type == "masonry")
							{
								if($effect[0] != "")
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2) + 10) * $img_in_row ;?>px !important;
									<?php
								}
								else
								{
									?>width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2) + ($thumbnails_border_size * 2)) * $img_in_row ;?>px !important;
									<?php
								}
							}
							?>clear: both;
						}
					<?php
					}
					?>
					.widget_margin_thumbs<?php echo $unique_id;?> {
						margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
						margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
					}
					<?php
				}
				if($gallery_type == "filmstrip")
				{
					?>
					/*noinspection ALL*/
					.imgFilmstripFill {
						width: 90px;
						height: 75px;
					}
					ul#thumb_<?php echo $unique_id; ?> {
						list-style: none !important;
						padding: 0 !important;
						margin: 10px 0 0 !important;
						display: inline-block;
						width: <?php echo (100 * $img_in_row)+110;?>px !important;
					}
					div.img<?php echo $unique_id; ?> img {
						width: <?php echo $image_width;?>px !important;
						box-sizing: border-box !important;
					}
					div.img<?php echo $unique_id; ?> > div.filmstrip_description_black {
						width: <?php echo $image_width - ($thumbnails_border_size * 2) ;?>px !important;
						bottom : <?php echo $thumbnails_border_size + 5;?>px !important;
						margin-left : <?php echo $thumbnails_border_size;?>px !important;
					}
					div.img<?php echo $unique_id; ?> > div.filmstrip_description_black > h5 {
						padding: 5px !important;
						margin: 5px !important;
						margin-left:<?php echo $thumbnails_border_size;?>px !important;
						line-height: 1.5em !important;
						direction: <?php echo $lang_dir_setting; ?>;
						text-align: <?php echo $thumbnail_text_align;?> !important;
						font-family: <?php echo $thumbnail_font_family;?> !important;
						color: <?php echo $thumbnail_text_color?> !important;
						font-size: <?php echo $heading_font_size;?>px !important;
					}
					div.img<?php echo $unique_id; ?> > div.filmstrip_description_black > p {
						<?php
						if($img_title == "false")
						{
							?>padding: 10px 10px 0 10px !important;
							<?php
						}
						else
						{
							?>padding: 0 10px 0 6px !important;
							<?php
						}
						?>
						margin-left:<?php echo $thumbnails_border_size;?>px !important;
						margin-bottom:<?php echo $thumbnails_border_size;?>px !important;
						line-height: 1.5em !important;
						direction: <?php echo $lang_dir_setting; ?>;
						text-align: <?php echo $thumbnail_text_align;?> !important;
						font-family: <?php echo $thumbnail_font_family;?> !important;
						color: <?php echo $thumbnail_text_color?> !important;
						font-size: <?php echo $text_font_size;?>px !important;
					}
					<?php
				}
				if($gallery_type == "blog")
				{
					?>
					#blog_description_div<?php echo $unique_id;?>
					{
						width 100% !important;
						/*display:inline-block !important;*/
					}
					#blog_description_div<?php echo $unique_id;?> > h5, #blog_description_div<?php echo $unique_id;?> > p
					{
						direction: <?php echo $lang_dir_setting; ?> !important;
						text-align: <?php echo $thumbnail_text_align;?> !important;
					}
					#blog_description_div<?php echo $unique_id;?> > h5 {
						line-height: 1.5em !important;
						font-family: <?php echo $thumbnail_font_family;?> !important;
						direction: <?php echo $lang_dir_setting; ?> !important;
						text-align: <?php echo $thumbnail_text_align;?> !important;
						margin: 10px 0px !important;
						<?php
						if($thumbnail_text_color == "#ffffff")
						{
							?>color: #000000 !important;
							<?php
						}
						else
						{
							?>color: <?php echo $thumbnail_text_color?> !important;
							<?php
						}
						?>font-size: <?php echo $heading_font_size;?>px !important;
					}
					#blog_description_div<?php echo $unique_id;?> > p {
						line-height: 1.5em !important;
						direction: <?php echo $lang_dir_setting; ?> !important;
						text-align: <?php echo $thumbnail_text_align;?> !important;
						font-family: <?php echo $thumbnail_font_family;?> !important;
						margin: 10px 0px !important;
						<?php
						if($thumbnail_text_color == "#ffffff")
						{
							?> color: #000000 !important;
							<?php
						}
						else
						{
							?> color: <?php echo $thumbnail_text_color?> !important;
							<?php
						}
						?> font-size: <?php echo $text_font_size?>px !important;
					}
					<?php
				}
				?>
				/*noinspection ALL*/
				.opactiy_thumbs {
					opacity: <?php echo $thumbnails_opacity;?> !important;
					-moz-opacity: <?php echo $thumbnails_opacity; ?> !important;
					-khtml-opacity: <?php echo $thumbnails_opacity; ?> !important;
				}
				/*noinspection ALL*/
				.shutter-gb-img-wrap {
					margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
					margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
				}
				.overlay_text > h5 {
					margin-top:10px !important;
					padding: 0 10px 0 10px !important;
					line-height: 1.5em !important;
					direction: <?php echo $lang_dir_setting; ?> !important;
					text-align: <?php echo $thumbnail_text_align;?> !important;
					font-family: <?php echo $thumbnail_font_family;?> !important;
					color: <?php echo $thumbnail_text_color?> !important;
					font-size: <?php echo $heading_font_size;?>px !important;
				}
				.overlay_text > p {
					padding: 10px 10px 0 10px !important;
					line-height: 1.5em !important;
					direction: <?php echo $lang_dir_setting; ?> !important;
					text-align: <?php echo $thumbnail_text_align;?> !important;
					font-family: <?php echo $thumbnail_font_family;?> !important;
					color: <?php echo $thumbnail_text_color?> !important;
					font-size: <?php echo $text_font_size?>px !important;
				}
			<?php
			}
		break;
		case "grid" || "list" || "individual":
			?>
			p:empty
			{
				margin :0px !important;
			}
			.dynamic_cover_css {
				border: <?php echo $cover_thumbnail_border_size;?>px solid <?php echo $cover_thumbnail_border_color;?> !important;
				-moz-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
				-webkit-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
				-khtml-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
				-o-border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
				border-radius: <?php echo $cover_thumbnail_border_radius; ?>px !important;
				opacity: <?php echo $cover_thumbnail_opacity;?> !important;
				-moz-opacity: <?php echo $cover_thumbnail_opacity;?> !important;
				-khtml-opacity: <?php echo $cover_thumbnail_opacity;?> !important;
			}
			.dynamic_cover_css img {
				margin: 0 !important;
				padding: 0 !important;
				border: 0 !important;
			}
			.imgLiquid {
				width: <?php echo $cover_thumbnail_width;?>px !important;
				height: <?php echo $cover_thumbnail_height;?>px !important;
				display: inline-block;
				box-sizing: border-box !important;
			}
			.album_back_btn {
				margin-top: 10px !important;
				border-radius: 8px !important;
				padding: 10px 10px !important;
				border: none !important;
				clear: both;
				cursor: pointer !important;
				background: <?php echo $button_color;?> linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -webkit-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -moz-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -o-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -ms-linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -webkit-gradient(linear, left bottom, left top, color-stop(0%, rgba(0, 0, 0, 0.1)), color-stop(100%, rgba(255, 255, 255, 0))) !important;
			}
			.album_back_btn:hover {
				cursor: pointer !important;
				background: <?php echo $button_color;?> linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -webkit-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -moz-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -o-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -ms-linear-gradient(to top, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) !important;
				background: <?php echo $button_color;?> -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0.1)), color-stop(100%, rgba(255, 255, 255, 0))) !important;
			}
			#view_gallery_bank_albums_<?php echo $unique_id;?> {
				<?php
				if($album_seperator == 1)
				{
					?>clear: both;
					<?php
				}
				else
				{
					?>margin-bottom: 20px !important;
					<?php
				}
				?>
			}
			<?php
			if($album_type == "grid")
			{
				?>
				/*********** For Grid Albums ********/
				.albums-in-row_<?php echo $unique_id;?> {
					<?php
					if($responsive_albums == 0)
					{
						?>width: <?php echo ($cover_thumbnail_width + ($margin_btw_cover_thumbnails * 2)) * $albums_in_row ;?>px !important;
						<?php
					}
					if($album_seperator == 1)
					{
						?>clear: both;
						<?php
					}
					else
					{
						?>margin-bottom: 20px !important;
						<?php
					}
					?>
				}
				.albums_margin {
					margin-right: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
					margin-bottom: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
					display: inline-block !important;
					width: <?php echo $cover_thumbnail_width;?>px !important;
					vertical-align: text-top !important;
					cursor: pointer;
				}
			.album_holder {
				display: inline-block !important;
				width: <?php echo $cover_thumbnail_width;?>px !important;
			}
			.album_holder h5 {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_heading_font_size;?>px !important;
				cursor: pointer;
				margin: 10px 0 0 0 !important;
				padding: 0 !important;
				line-height: 1.5em !important;
			}
			.album_holder p {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				cursor: pointer;
				margin: 10px 0 0 0 !important;
				padding: 0 !important;
				line-height: 1.5em !important;
			}
			.album_holder > div.album_link {
				direction: <?php echo $lang_dir_setting; ?> !important;
				margin: 10px 0 0 0 !important;
				text-align: <?php echo $album_text_align;?> !important;
				cursor: pointer;
			}
			div.album_link a {
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				font-family: <?php echo $album_font_family;?> !important;
			}
			<?php
		}
		if($album_type == "individual")
		{
			?>
			/*********** For Single Albums ********/
			.album_content_holder {
				display: inline-block !important;
				width: 300px !important;
				vertical-align: top !important;
			}
			.album_content_div<?php echo $unique_id;?> {
				cursor: pointer;
				width: 100% !important;
				<?php
				if($album_seperator == 1)
				{
					?>clear: both;
					<?php
				}
				else
				{
					?>margin-bottom: 20px !important;
					<?php
				}
				?>display: inline-block;
			}
			.album_content_holder h5 {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_heading_font_size;?>px !important;
				cursor: pointer;
				line-height: 1.5em !important;
				margin: 0 0 10px 10px !important;
				padding: 0 !important;
			}
			.album_content_holder p {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				cursor: pointer;
				margin: 0 0 0 10px !important;
				padding: 0 !important;
				line-height: 1.5em !important;
			}
			.album_content_holder div.album_view_link {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				margin: 10px 0 0 10px !important;
				padding: 0 !important;
				cursor: pointer;
			}
			div.album_view_link a {
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				font-family: <?php echo $album_font_family;?> !important;
			}
		<?php
		}
		if($album_type == "list")
		{
			?>
			/*********** For Listed Albums ********/
			.content_holder {
				display: inline-block !important;
				width: 300px !important;
				vertical-align: top !important;
			}
			.list_album_content_div<?php echo $unique_id;?> {
				margin-bottom: <?php echo $margin_btw_cover_thumbnails; ?>px !important;
				cursor: pointer;
				width: 100% !important;
				display: inline-block;
			}
			.content_holder h5 {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_heading_font_size;?>px !important;
				cursor: pointer;
				margin: 0 0 10px 10px !important;
				padding: 0 !important;
				line-height: 1.5em !important;
			}
			.content_holder p {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				font-family: <?php echo $album_font_family;?> !important;
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				cursor: pointer;
				margin: 0 0 0 10px !important;
				padding: 0 !important;
				line-height: 1.5em !important;
			}
			.content_holder div.view_link {
				direction: <?php echo $lang_dir_setting; ?> !important;
				text-align: <?php echo $album_text_align;?> !important;
				margin: 10px 0 0 10px !important;
				padding: 0 !important;
				cursor: pointer;
			}
			div.view_link a {
				color: <?php echo $album_text_color?> !important;
				font-size: <?php echo $album_text_font_size?>px !important;
				font-family: <?php echo $album_font_family;?> !important;
			}
			<?php
		}
		break;
	}
	if($album_type == "images" || $gallery_type == "slideshow")
	{
		switch($lightbox_type)
		{
			case "pretty_photo":
				?>
				.pp_pic_holder.pp_default {
					background-color: #ffffff;
				}
				div.pp_overlay {
					background-color: <?php echo $lightbox_overlay_bg_color;?> !important;
					opacity: <?php echo $lightbox_overlay_opacity;?> !important;
					-moz-opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
					filter: alpha(opacity=<?php echo $lightbox_overlay_opacity; ?>);
				}
				.pp_description p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				.pp_description h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
				}
				.ppt {
					display: none !important;
				}
				div.pp_pic_holder {
					border: <?php echo $lightbox_border_color_value;?> !important;
					border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
				}
				<?php
			break;
			case "color_box":
				?>
				#cboxOverlay {
					background: <?php echo $lightbox_overlay_bg_color;?> !important;
					opacity: <?php echo $lightbox_overlay_opacity;?> !important;
					-moz-opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
					filter: alpha(opacity=<?php echo $lightbox_overlay_opacity; ?>);
				}
				#cboxTitle p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				#cboxTitle h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
				}
				#cboxMiddleLeft {
					width: 10px;
					background-color: #ffffff;
				}
				#cboxMiddleRight {
					width: 9px;
					background-color: #ffffff;
				}
				#cboxTopCenter {
					height: 11px;
					background-color: #ffffff;
				}
				#cboxBottomCenter {
					height: 21px;
					background-color: #ffffff;
				}
				#cboxWrapper {
					background-color: #ffffff;
				}
				#colorbox {
					border: <?php echo $lightbox_border_color_value;?> !important;
					border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
				}
				#cboxContent {
					background-color: #ffffff;
				}
				<?php
			break;
			case "photo_swipe":
				?>
				div.ps-viewport {
					background-color: rgba(<?php echo $rgb_overlay_bg_color.",".$lightbox_overlay_opacity?>) !important;
					cursor: pointer;
				}
				.ps-caption-content div p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				.ps-caption-content div h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
				}
				<?php
			break;
			case "foo_box":
				?>
				.fbx-light .fbx-caption-title > h5, .fbx-light .fbx-caption-title > p{
					color: <?php echo $lightbox_text_color;?> !important;
				}
				.fbx-light .fbx-inner, .fbx-rounded.fbx-light .fbx-close, .fbx-rounded.fbx-light .fbx-play, .fbx-rounded.fbx-light .fbx-pause, .fbx-rounded.fbx-light .fbx-fullscreen-toggle {
					border: <?php echo $lightbox_border_color_value; ?> !important;
				}
				.fbx-rounded .fbx-inner {
					border: <?php echo $lightbox_border_color_value; ?> !important;
					border-radius: <?php echo $lightbox_overlay_border_radius;?>px;
					-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
				}
				.fbx-light {
					background-color: rgba(<?php echo $rgb_overlay_bg_color.",".$lightbox_overlay_opacity?>);
				}
				.fbx-caption-title h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
					margin-bottom:10px !important;
					margin-top:5px !important;
				}
				.fbx-caption-title p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				<?php
			break;
			case "fancy_box":
				?>
				.fancybox-skin {
					background: #ffffff !important;
					border: <?php echo $lightbox_border_color_value;?> !important;
					border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
				}
				.fancybox-overlay {
					background-color: rgba(<?php echo $rgb_overlay_bg_color.",".$lightbox_overlay_opacity?>) !important;
				}
				.fancybox-title.fancybox-title-over-wrap p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				.fancybox-title.fancybox-title-over-wrap h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
				}
				<?php
			break;
			case "lightbox2":
				?>
				.lightboxOverlay {
					background: <?php echo $lightbox_overlay_bg_color;?> !important;
					opacity: <?php echo $lightbox_overlay_opacity;?> !important;
					-moz-opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
					filter: alpha(opacity=<?php echo $lightbox_overlay_opacity; ?>);
				}
				.lb-container {
					background-color: #ffffff;
				}
				.lb-outerContainer {
					border: <?php echo $lightbox_border_color_value;?> !important;
					border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
					-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
				}
				.lb-caption p {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_text_font_size;?>px !important;
				}
				.lb-caption h5 {
					direction: <?php echo $lang_dir_setting; ?> !important;
					color: <?php echo $lightbox_text_color;?> !important;
					text-align: <?php echo $lightbox_text_align;?> !important;
					font-family: <?php echo $lightbox_font_family;?> !important;
					font-size: <?php echo $lightbox_heading_font_size;?>px !important;
				}
				<?php
			break;
			case "GB_lightbox":
				$text_color = ($lightbox_text_color == "#ffffff")? "#000000" : $lightbox_text_color;
				?>
					.gb_container {
						border: <?php echo $lightbox_border_color_value;?> !important;
						border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
						-moz-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
						-webkit-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
						-khtml-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
						-o-border-radius: <?php echo $lightbox_overlay_border_radius;?>px !important;
						background-color: <?php echo $lightbox_inline_bg_color;?> !important;
					}
					.gb_content_holder p {
						direction: <?php echo $lang_dir_setting; ?> !important;
						color: <?php echo $text_color;?> !important;
						text-align: <?php echo $lightbox_text_align;?> !important;
						font-family: <?php echo $lightbox_font_family;?> !important;
						font-size: <?php echo $lightbox_text_font_size;?>px !important;
					}
					a.gb_lightbox_prev {
						left: -<?php echo 43 + $lightbox_overlay_border_size; ?>px !important;
					}
					.gb_close_lightbox
					{
						top: -<?php echo 22 + ($lightbox_overlay_border_size/2) ;?>px !important;;
						right: -<?php echo 22 + ($lightbox_overlay_border_size/2) ;?>px !important;;
					}
					a.gb_lightbox_next {
						right: -<?php echo (43 + $lightbox_overlay_border_size); ?>px !important;;
					}
					.gb_content_holder h5
					{
						margin:0 0 10px 0  !important;
						direction: <?php echo $lang_dir_setting; ?> !important;
						color: <?php echo $text_color;?> !important;
						text-align: <?php echo $lightbox_text_align;?> !important;
						font-family: <?php echo $lightbox_font_family;?> !important;
						font-size: <?php echo $lightbox_heading_font_size;?>px !important;
					}
					.gb_lightbox_overlay
					{
						background-color: <?php echo $lightbox_overlay_bg_color;?> !important;
						-moz-opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
						opacity: <?php echo $lightbox_overlay_opacity; ?> !important;
						filter: alpha(opacity=<?php echo $lightbox_overlay_opacity; ?>);
					}
				<?php
			break;
		}
	}
	 $class_images_in_row = $widget == "true" ? "widget-images-in-row_".$unique_id : "images-in-row_".$unique_id;
	?>
</style>
	<!-- Global Styling  -->
	<!-- Global Scripting  -->
<?php
if (($album_type == "images" || $gallery_type == "slideshow"))
{
	if($lightbox_type == "GB_lightbox")
	{
	?>
		<div class="gb_container" id="gb_lightbox_container_div">
			<a class="gb_close_lightbox" onclick="CloseLightbox(<?php echo $lightbox_fade_out_time; ?>);"></a>
			<a class="gb_lightbox_prev" id="gallery_prev"></a>
			<a class="gb_lightbox_next" id="gallery_next"></a>
			<?php
			if($social_sharing == 1 && $facebook_comments == 0 && $image_title_setting == 0 && $image_desc_setting == 0)
			{
				?>
				<div class="gb_social_icons_holder" id="contentHolderDiv" style="max-width:660px;max-height: 62px;padding: 0px 10px 10px 10px !important;">
					<div id="social_div" style="margin-left: -10px !important;max-width: 270px;max-height: 62px;">
						<div id="gb-facebook-share" style="display:inline-block;" >
							<div id="ux_fb_share" class="fb-share-button" data-href="" data-type="button_count"></div>
						</div>
						<div style="display:inline-block;" class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
						<br>
						<a style="text-decoration: none!important;float:left; padding-top:4px;margin-right: 5px;" id="ux_linked_in" href="" target="_blank">
							<img src="<?php echo plugins_url("/assets/images/icons/linkedIn.png",dirname(__FILE__)); ?>"  alt="Share on LinkedIn" title="Share on LinkedIn" style="height:20px;" />
						</a>
						<a style="text-decoration: none!important;padding-top:4px;margin-right: 5px;" id="ux_tweeter" href="" target="_blank">
							<img  src="<?php echo plugins_url("/assets/images/icons/tweet.png",dirname(__FILE__)); ?>" style="height:20px;" alt="Share on Twitter" title="Share on Twitter" />
						</a>
						<div id="ux_google_plus" style="display:inline-block; padding-top:4px;width:75px;">
							<html>
								<head>
									<link rel="canonical" href="" />
									<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
								</head>
								<body>
									<g:plusone size="medium"></g:plusone>
								</body>
							</html>
						</div>
					</div>
				</div>
				<div class="gb_image_holder" id="image_holder_div"></div>
				<?php
			}
			else
			{
			?>
				<div class="gb_image_holder" id="image_holder_div"></div>
				<div class="gb_content_holder" id="contentHolderDiv">
					<h5></h5>
					<p></p>
					<ul class="gb_social_div">
						<div id="social_div" style="margin-left: 0px !important;">
							<div id="gb-facebook-share" style="display:inline-block;" >
								<div id="ux_fb_share" class="fb-share-button" data-href="" data-type="button_count"></div>
							</div>
							<div style="display:inline-block;" class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
							<br>
							<a style="text-decoration: none!important;float:left; padding-top:4px;margin-right: 5px;" id="ux_linked_in" href="" target="_blank">
								<img src="<?php echo plugins_url("/assets/images/icons/linkedIn.png",dirname(__FILE__)); ?>"  alt="Share on LinkedIn" title="Share on LinkedIn" style="height:20px;" />
							</a>
							<a style="text-decoration: none!important;padding-top:4px;margin-right: 5px;" id="ux_tweeter" href="" target="_blank">
								<img  src="<?php echo plugins_url("/assets/images/icons/tweet.png",dirname(__FILE__)); ?>" style="height:20px;" alt="Share on Twitter" title="Share on Twitter" />
							</a>
							<div id="ux_google_plus" style="display:inline-block; padding-top:4px;width:75px;">
								<html>
									<head>
										<link rel="canonical" href="" />
										<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
									</head>
									<body>
										<g:plusone size="medium"></g:plusone>
									</body>
								</html>
							</div>
						</div>
					</ul>
					<div class="gb-facebook-comments" >
						<div id="gb-facebook-comments">
							<div id="fb-root"></div>
							<div class="fb-comments" data-href="" data-num-posts="3" data-width="328" fb-xfbml-state="rendered">
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
		<div class="gb_lightbox_overlay" id="gb_lightbox_overlay_div" onclick="CloseLightbox(<?php echo $lightbox_fade_out_time; ?>);"></div>
	<?php
	}
}
switch ($album_type) {
	case "images":
		if ($gallery_type != "filmstrip") {
			?>
			<script type="text/javascript">
				<?php
				if($filters_setting == 1 && $widget =="" )
				{
					for($flag1 = 0; $flag1< count($pics); $flag1++)
					{
						if($pics[$flag1]->tags != "" && $filters_setting != 0)
						{
							$tags_array = array_merge($tags_array, explode(",", $pics[$flag1]->tags));
						}
					}
				}
				?>
			</script>
		<?php
		}
		if($album != "Untitled Album")
		{
			if ($album_title == "true" && $gallery_type != "slideshow") {
				if ($gallery_type == "blog" || $gallery_type == "filmstrip") {
					?>
					<h3 align="center"><?php echo stripcslashes(htmlspecialchars_decode($album)); ?></h3>
				<?php
				} else {
					?>
					<h3><?php echo stripcslashes(htmlspecialchars_decode($album)); ?></h3>
				<?php
				}
			}
		}
		if (!empty($tags_array) && $filters_setting == 1 && $widget == "" && $gallery_type != "slideshow") {
			$tags = array_iunique($tags_array);
			?>
			<div class="thumbs-fluid-layout">
				<div class="gallery-bank-filter" style="margin-bottom: 60px;">
					<div class="gallery-bank-filter-categories" id="bank_filters_<?php echo $unique_id; ?>">
						<a href="#" id="gallery_filter_<?php echo $unique_id; ?>" class="act" data-filter="*"><?php _e("VIEW ALL", gallery_bank); ?></a><?php
						foreach ($tags as $key => $value) {
							$Filterclass = strtoupper(str_replace(" ", "-", $value));
							?><a href="#" id="gallery_filter" data-filter=".<?php echo $Filterclass; ?>"><?php echo strtoupper($value); ?></a><?php
						}
						?>
					</div>
				</div>
			</div>
		<?php
		}
	break;
}
?>