<style type="text/css">
	<?php
	if($widget != "true")
	{
	?>
		.width_thumb
		{
			width:<?php echo $thumbnails_width+1;?>px !important;
			border-radius:0px !important;
			display: block !important;
			box-sizing: border-box !important;
			max-width: 100% !important;
		}
	<?php
	}
	else
	{
		?>
		.widget_width_thumb<?php echo $unique_id;?>
		{
			width:<?php echo $thumbnails_width+1;?>px !important;
			border-radius:0px !important;
			display: block !important;
			box-sizing: border-box !important;
			max-width: 100% !important;
		}
		<?php
	}
	?>
	.gallery-sizer<?php echo $unique_id;?> { width:<?php echo $thumbnails_width + 10;?>px !important; }
	@media screen and (min-width: 720px) {
		.gallery-sizer<?php echo $unique_id;?> { width:<?php echo $thumbnails_width + 10;?>px !important; } 
	}
</style>
<div class="<?php echo $class_images_in_row;?>"  id="masonry-gallery-thumbnails_<?php echo $unique_id;?>" >
<?php
	$class_gb = ($lightbox_type == "GB_lightbox" ? "gb".$unique_id : "");
	$css_class = $widget == "true" ? "widget_width_thumb". $unique_id : "width_thumb ";
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
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>">
					<?php
				}
			break;
			case "color_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?> colorbox<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title.$image_description);?>">
					<?php
				}
			break;
			case "photo_swipe":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>">
					<?php
				}
			break;
			case "foo_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?> foobox" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?> foobox" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>">
					<?php
				}
			break;
			case "fancy_box":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?> fancybox-media<?php echo $unique_id;?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?> fancybox-buttons<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>">
					<?php
				}
			break;
			case "lightbox2":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
					else
					{
						?>
						<a data-lightbox="gallery<?php echo $unique_id;?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL.$pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title.$image_description);?>" id="ux_img_div_<?php echo $unique_id;?>">
						<?php
					}
				}
				else 
				{
					?>
					<a class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id;?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title);?>">
					<?php
				}
			break;
			case "GB_lightbox":
				if( $pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->pic_name; ?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
					else
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
				}
				else 
				{
					?>
					<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="element gallery-sizer<?php echo $unique_id;?> <?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" >
					<?php
				}
			break;
		}
		if($img_title == "true" || $img_desc == "true")
		{
			?>
			<div class="widget_margin_thumbs<?php echo $unique_id;?> opactiy_thumbs margin_thumbs dynamic_css gb_overlay">
				<div class= "overlay_text">
					<h5><?php echo stripcslashes(htmlspecialchars_decode($pics[$flag]->title));?></h5>
					<?php
					if($img_desc == "true")
					{
						?>
						<p>
							<?php
							$string = stripcslashes(htmlspecialchars_decode($pics[$flag]->description));
							$description = (strlen($string) > $thumbnail_desc_length) ? substr($string,0,$thumbnail_desc_length)."..." : $string;
							echo $description;
							?>
						</p>
						<?php
					}
					?>
				</div>
				<?php
					if($pics[$flag]->video == 1)
					{
						?>
						<img alt="<?php echo esc_html($image_title.$image_description);?>" class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>" imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
						<?php
					}
					else
					{
						?>
						<img alt="<?php echo esc_html($image_title.$image_description);?>" class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>" imageid="<?php echo $pics[$flag]->pic_id;?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
						<?php
					}
				?>
			</div>
		<?php
		}
		else
		{
			switch($effect[0])
			{
				case "grayscale":
					?>
					<div class="gallery_grayscale opactiy_thumbs dynamic_css widget_margin_thumbs<?php echo $unique_id;?> margin_thumbs">
					<?php
				break;
				case "blur":
					?>
					<div class="gallery_blur dynamic_css opactiy_thumbs widget_margin_thumbs<?php echo $unique_id;?> margin_thumbs">
					<?php
				break;
				case "sepia":
					?>
					<div class="gallery_sepia dynamic_css opactiy_thumbs widget_margin_thumbs<?php echo $unique_id;?> margin_thumbs">
					<?php
				break;
				case "none":
					?>
					<div class="margin_thumbs dynamic_css opactiy_thumbs widget_margin_thumbs<?php echo $unique_id;?>">
					<?php
				break;
			}
			?>
				<?php
				if($pics[$flag]->video == 1)
				{
					?>
					<img alt="<?php echo esc_html($image_title.$image_description);?>" class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>" imageid="<?php echo $pics[$flag]->pic_id;?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
					<?php
				}
				else
				{
					?>
					<img alt="<?php echo esc_html($image_title.$image_description);?>" class="<?php echo $css_class;?>" id="ux_gb_img_<?php echo $unique_id;?>" imageid="<?php echo $pics[$flag]->pic_id;?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
					<?php
				}
				switch($effect[0])
				{
					case "grayscale":
						?></div><?php
					break;
					case "blur":
						?></div><?php
					break;
					case "sepia":
						?></div><?php
					break;
					case "none":
						?></div><?php
					break;
				}
				?>
			<?php
		}
		?>
		</a>
	<?php
	}
?>
</div>