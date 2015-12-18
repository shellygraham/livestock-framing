<style>
<?php
if($widget != "true")
{
?>
	.overlay_slide,
	.overlay_fade,
	.hover_rotation,
	.levitation_shadow,
	.continuous_slide,
	.overlay_split,
	.overlay_join,
	.corner_ribbon,
	.corner_ribbon .corner_zoom,
	.lomo_black,
	.lomo_white,
	.lomo_black_reversed,
	.lomo_white_reversed,
	.rounded_image
	.gb_overlay
	{
		width:<?php echo $thumbnails_width;?>px !important;
		height:<?php echo $thumbnails_height;?>px !important;
	}
	<?php
	switch($effect[0])
	{
		case "hover_rotation":
			?>
			.hover_rotation div
			{
				width:<?php echo $thumbnails_width + 200;?>px !important;
				height:<?php echo $thumbnails_height + 150;?>px !important;
				margin-top:-<?php echo ($thumbnails_height/2) + 50 ?>px !important;
				margin-left:-<?php echo ($thumbnails_width/2) + 50 ?>px !important;
			}
			<?php
		break;
		case "corner_ribbons":
			?>
			.corner_ribbon .corner_ribbon_top_left_white,
			.corner_ribbon .corner_ribbon_top_left_black {
				top:-<?php echo $thumbnails_height;?>px !important;
				left:-<?php echo $thumbnails_width;?>px !important;
				border-right: <?php echo $thumbnails_width;?>px solid transparent !important;
			}
			.corner_ribbon .corner_ribbon_top_left_white {
				border-top: <?php echo $thumbnails_height;?>px solid rgba(255, 255, 255, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_top_left_black {
				border-top: <?php echo $thumbnails_height;?>px solid rgba(0, 0, 0, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_top_left_white .corner_zoom,
			.corner_ribbon .corner_ribbon_top_left_black .corner_zoom {
				top:-<?php echo (($thumbnails_height^2)+(($thumbnails_width)^2))/2;?>px !important;
				left:-30px;
			}
			.corner_ribbon .corner_ribbon_bottom_left_white,
			.corner_ribbon .corner_ribbon_bottom_left_black {
				bottom:-<?php echo $thumbnails_height;?>px !important;
				left:-<?php echo $thumbnails_width;?>px !important;
				border-right: <?php echo $thumbnails_height;?>px solid transparent !important;
			}
			.corner_ribbon .corner_ribbon_bottom_left_white {
				border-bottom: <?php echo $thumbnails_height;?>px solid rgba(255, 255, 255, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_bottom_left_black {
				border-bottom: <?php echo $thumbnails_height;?>px solid rgba(0, 0, 0, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_bottom_left_white .corner_zoom,
			.corner_ribbon .corner_ribbon_bottom_left_black .corner_zoom {
				bottom:-<?php echo (($thumbnails_height^2)+(($thumbnails_width)^2))/2;?>px !important;
				left:-30px;
			}
			.corner_ribbon .corner_ribbon_top_right_white,
			.corner_ribbon .corner_ribbon_top_right_black {
				top:-<?php echo $thumbnails_height;?>px !important;
				right:-<?php echo $thumbnails_width;?>px !important;
				border-left: <?php echo $thumbnails_width;?>px solid transparent !important;
			}
			.corner_ribbon .corner_ribbon_top_right_white {
				border-top: <?php echo $thumbnails_height;?>px solid rgba(255, 255, 255, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_top_right_black {
				border-top: <?php echo $thumbnails_height;?>px solid rgba(0, 0, 0, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_top_right_white .corner_zoom,
			.corner_ribbon .corner_ribbon_top_right_black .corner_zoom {
				top:-<?php echo (($thumbnails_height^2)+(($thumbnails_width)^2))/2;?>px !important;
				right:-30px;
			}
			.corner_ribbon .corner_ribbon_bottom_right_white,
			.corner_ribbon .corner_ribbon_bottom_right_black {
				bottom:-<?php echo $thumbnails_height;?>px !important;
				right:-<?php echo $thumbnails_width;?>px !important;
				border-left: <?php echo $thumbnails_width;?>px solid transparent !important;
			}
			.corner_ribbon .corner_ribbon_bottom_right_white {
				border-bottom: <?php echo $thumbnails_height;?>px solid rgba(255, 255, 255, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_bottom_right_black {
				border-bottom: <?php echo $thumbnails_height;?>px solid rgba(0, 0, 0, 0.7) !important;
			}
			.corner_ribbon .corner_ribbon_bottom_right_white .corner_zoom,
			.corner_ribbon .corner_ribbon_bottom_right_black .corner_zoom {
				bottom:-<?php echo (($thumbnails_height^2)+(($thumbnails_width)^2))/2;?>px !important;
				right:-20px;
			}
			<?php
		break;
		case "rounded_images":
			?>
			.rounded_image div.rounded_img,
			.rounded_image div.squared_img 
			{
				border:<?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?> !important ;
			}
			.rounded_image
			{
				margin-right:<?php echo $newMargin;?>px !important;
				margin-bottom:<?php echo $newMargin;?>px !important;
			}
			<?php
		break;
		case "levitation_shadow":
			?>
			.levitation_shadow .bottom_shadow {
				/* Adjust sizes and position according to your needs */
				position:absolute;
				left:50%;
				margin:<?php echo $thumbnails_height - 10;?>px 0 0 -<?php echo $thumbnails_width - ($thumbnails_width / 2) - 5 ;?>px !important;
				width:<?php echo $thumbnails_width;?>px !important;
				height:10px;
				/* Shadow */
				-webkit-border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				-moz-border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				-o-border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				-ms-border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				-khtml-border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				border-radius:<?php echo $thumbnails_width - 100 ;?>px / 8px !important;
				-webkit-box-shadow:0 10px 10px #000;
				-moz-box-shadow:0 10px 10px #000;
				box-shadow:0 10px 10px #000;
			}
			<?php
		break;
		case "perspective_images":
			?>
			.perspective
			{
				width:<?php echo $thumbnails_width;?>px !important;
				height:<?php echo $thumbnails_height;?>px !important;
				margin-right:<?php echo $perspective_margin_right;?>px !important; 
				margin-bottom:<?php echo $perspective_margin_bottom;?>px !important;
				border: none;
			}
			<?php
		break;
		case "overlay_slide":
			?>
			.overlay_slide .overlay_zoom
			{
				top:-<?php echo $thumbnails_height;?>px ;
			}
			<?php
		break;
	}
}
?>
</style>
<div class="<?php echo $class_images_in_row;?>" id="gallery-bank-thumbnails_<?php echo $unique_id;?>">
<?php
	$class_gb = ($lightbox_type == "GB_lightbox" ? "gb".$unique_id : "");
	for($flag = 0; $flag< count($pics); $flag++) 
	{
		$class = strtoupper(str_replace(" ", "-", $pics[$flag]->tags));
		$image_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
		$image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
		$photoswipe_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))) : "";
		$photoswipe_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ?  esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) : "";
		switch ($lightbox_type)
		{
			case "pretty_photo":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
				}
				else 
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>"><?php
				}
			break;
			case "color_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a class="<?php echo str_replace(","," ", $class); ?> colorbox<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" id="ux_img_div_<?php echo $unique_id;?>" data-title="<?php echo esc_html($image_title.$image_description);?>"><?php
					}
				}
				else 
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title.$image_description);?>"><?php
				}
			break;
			case "photo_swipe":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					
				}
				else 
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>"><?php
				}
			break;
			case "foo_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="<?php echo str_replace(","," ", $class); ?> foobox" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="<?php echo str_replace(","," ", $class); ?> foobox" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>"><?php
				}
			break;
			case "fancy_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="<?php echo str_replace(","," ", $class); ?> fancybox-media<?php echo $unique_id;?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="<?php echo str_replace(","," ", $class); ?> fancybox-buttons<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
				}
				else 
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>"><?php
				}
			break;
			case "lightbox2":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
					else
					{
						?>
						<a data-lightbox="gallery<?php echo $unique_id;?>" class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>"><?php
					}
				}
				else 
				{
					?>
					<a class="<?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>"><?php
				}
			break;
			case "GB_lightbox":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->pic_name; ?>" class="<?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc = "<?php echo $photoswipe_description; ?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id;?>"><?php
					}
					else
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="<?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc = "<?php echo $photoswipe_description; ?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id;?>"><?php
					}
				}
				else 
				{
					?>
					<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="<?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo $photoswipe_title;?>" desc = "<?php echo $photoswipe_description; ?>"><?php
				}
			break;
		}
		if($img_title == "true" || $img_desc == "true")
		{
			?><div class="dynamic_css margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?> gb_overlay">
				<div class="widgetImgLiquidFill<?php echo $unique_id;?> imgLiquidFill opactiy_thumbs">
					<div class="overlay_text">
						<h5><?php echo stripcslashes(htmlspecialchars_decode($pics[$flag]->title));?></h5>
						<?php
						if($img_desc == "true")
						{
							?><p>
								<?php
								$string = stripcslashes(htmlspecialchars_decode($pics[$flag]->description));
								$description = (strlen($string) > $thumbnail_desc_length) ? substr($string,0,$thumbnail_desc_length)."..." : $string;
								echo $description;
								?>
							</p><?php
						}
						?></div>
					<?php
						if($pics[$flag]->video == 1)
						{
							?><img alt="<?php echo esc_html($image_title.$image_description);?>" imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $pics[$flag]->pic_id;?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/><?php
						}
						else
						{
							?><img alt="<?php echo esc_html($image_title.$image_description);?>" imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/><?php
						}
					?></div>
			</div><?php
		}
		else
		{
			include GALLERY_BK_PLUGIN_DIR."/front_views/special_effects.php";
		}
			?></a><?php
	}
?></div><?php
if($pagination_setting == 1 && $widget != "true")
{
	?>
	<div class="holder" id ="holder_<?php echo $unique_id;?>"></div>
	<?php
}
?>