<?php
if (isset($_REQUEST["param"])) {
	global $wpdb;
	if ($_REQUEST["param"] == "show_album_gallery") {
		$album_id = intval($_REQUEST["album_id"]);
		$img_desc = esc_attr($_REQUEST["isImageDesc"]);
		$gallery_type = esc_attr($_REQUEST["gallery_format"]);
		$img_title = esc_attr($_REQUEST["isImageTitle"]);
		$img_in_row = esc_attr($_REQUEST["images_in_row"]);
		$widget = esc_attr($_REQUEST["iswidget"]);
		$special_effect = esc_attr($_REQUEST["special_effects"]);
		$animation_effect = esc_attr($_REQUEST["animation_effects"]);
		$image_width = esc_attr($_REQUEST["filmstrip_width"]);
		$album_title = esc_attr($_REQUEST["show_album_title"]);
		$responsive = esc_attr($_REQUEST["isResponsive"]);
		$no_of_images = esc_attr($_REQUEST["no_of_images"]);
		$display = esc_attr($_REQUEST["display"]);
		$sort_by = esc_attr($_REQUEST["sort_by"]);

		$album_type = "images";
		include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_before.php";
		switch ($gallery_type) {
			case "masonry":
				include GALLERY_BK_PLUGIN_DIR . "/front_views/masonry-gallery.php";
			break;
			case "filmstrip":
				include GALLERY_BK_PLUGIN_DIR . "/front_views/filmstrip-slides.php";
			break;
			case "blog":
				include GALLERY_BK_PLUGIN_DIR . "/front_views/blog-gallery.php";
			break;
			case "thumbnail":
				include GALLERY_BK_PLUGIN_DIR . "/front_views/thumbnail-gallery.php";
			break;
		}
		include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_after.php";
		die();
	}
	if ($_REQUEST["param"] == "get_album_pics") {
		$album_id = intval($_REQUEST["album_id"]);
		$special_effect = esc_attr($_REQUEST["special_effects"]);
		$album_type = "images";
		$gallery_type = "slideshow";
		$img_desc = esc_attr($_REQUEST["isImageDesc"]);
		$img_title = esc_attr($_REQUEST["isImageTitle"]);
		$img_in_row = esc_attr($_REQUEST["images_in_row"]);
		$widget = esc_attr($_REQUEST["iswidget"]);
		$animation_effect = esc_attr($_REQUEST["animation_effects"]);
		$album_title = esc_attr($_REQUEST["show_album_title"]);
		$postback = esc_attr($_REQUEST["postback"]);
		$responsive = esc_attr($_REQUEST["isResponsive"]);
		$id = intval($_REQUEST["unique_id"]);
		$no_of_images = esc_attr($_REQUEST["no_of_images"]);
		$display = esc_attr($_REQUEST["display"]);
		$sort_by = esc_attr($_REQUEST["sort_by"]);
		include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_before.php";
		$class_gb = ($lightbox_type == "GB_lightbox" ? "gb".$id : "");
		for ($flag = 0; $flag < count($pics); $flag++)
		{
			$image_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
			$image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
			$photoswipe_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))) : "";
			$photoswipe_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) : "";
			switch ($lightbox_type) {
				case "pretty_photo":
					if ($pics[$flag]->video == 1) {
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="imgLiquidFill" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					} else {
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="imgLiquidFill" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
					break;
				case "color_box":
					if ($pics[$flag]->video != 1) {
						?>
						<a class="imgLiquidFill colorbox<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
					break;
				case "photo_swipe":
					if ($pics[$flag]->video != 1) {
						?>
						<a class="imgLiquidFill" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title; ?>" desc="<?php echo $image_desc; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
					break;
				case "foo_box":
					if ($pics[$flag]->video == 1) {
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="imgLiquidFill foobox" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					} else {
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="imgLiquidFill foobox" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
						if($pics[$flag]->video == 1)
						{
							?>
							<img alt="<?php echo $image_title . $image_description; ?>" imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
							<?php
						}
						else
						{
							?>
							<img alt="<?php echo $image_title . $image_description; ?>" imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
							<?php
						}
					
					break;
				case "fancy_box":
					if ($pics[$flag]->video == 1) {
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="imgLiquidFill fancybox-media<?php echo $unique_id;?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					} else {
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="imgLiquidFill fancybox-buttons<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
					break;
				case "lightbox2":
					if ($pics[$flag]->video != 1) {
						?>
						<a data-lightbox="gallery<?php echo $unique_id;?>" class="imgLiquidFill" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
					<?php
					}
					break;
				case "GB_lightbox":
					if ($pics[$flag]->video == 1)
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->pic_name; ?>" class="imgLiquidFill <?php echo $class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
					else
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="imgLiquidFill <?php echo $class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
						if($pics[$flag]->video == 1)
						{
							?>
							<img imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url);?>" style="height:<?php echo $thumbnails_height;?>px;"/>
							<?php
						}
						else
						{
							?>
							<img imageid="<?php echo $pics[$flag]->pic_id;?>" id="ux_gb_img_<?php echo $unique_id;?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL.$pics[$flag]->thumbnail_url);?>"/>
							<?php
						}
					break;
			}
			?>
			</a>
			<?php
		}
		include GALLERY_BK_PLUGIN_DIR . "/front_views/includes_common_after.php";
		die();
	}
}
?>