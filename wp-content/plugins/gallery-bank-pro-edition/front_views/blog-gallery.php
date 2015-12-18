<!--suppress ALL -->
<style>
	#blog_gallery<?php echo $unique_id;?> > a {
		text-decoration: none !important;
	}

	#blog_gallery<?php echo $unique_id;?> {
		width: <?php echo 700 + ($thumbnails_border_size * 2);?>px;
	}
</style>
<div id="blog_gallery<?php echo $unique_id; ?>" align="center">
	<?php
	$class_gb = ($lightbox_type == "GB_lightbox" ? "gb".$unique_id : "");
	for ($flag = 0;$flag < count($pics);$flag++)
	{
		$class = strtoupper(str_replace(" ", "-", $pics[$flag]->tags));
		$image_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
		$image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
		$photoswipe_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))) : "";
		$photoswipe_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ?  esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) : "";
		switch ($lightbox_type)
		{
			case "pretty_photo":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a rel="<?php echo $unique_id;?>prettyPhoto[gallery]" class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title); ?>">
					<?php
				}
			break;
			case "color_box":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a class="<?php echo str_replace(",", " ", $class); ?> colorbox<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>">
					<?php
				}
			break;
			case "photo_swipe":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description; ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>" >
					<?php
				}
			break;
			case "foo_box":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="<?php echo str_replace(",", " ", $class); ?> foobox" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a rel="foobox<?php echo $unique_id;?>" class="<?php echo str_replace(",", " ", $class); ?> foobox" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>">
					<?php
				}
			break;
			case "fancy_box":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="<?php echo str_replace(",", " ", $class); ?> fancybox-media<?php echo $unique_id;?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a rel="fancybox-button" data-fancybox-group="button" class="<?php echo str_replace(",", " ", $class); ?> fancybox-buttons<?php echo $unique_id;?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title); ?>">
					<?php
				}
			break;
			case "lightbox2":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if ($pics[$flag]->video == 1)
					{
						?>
						<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>">
						<?php
					}
					else
					{
						?>
						<a data-lightbox="gallery<?php echo $unique_id; ?>" class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" data-title="<?php echo esc_html($image_title . $image_description); ?>" id="ux_img_div_<?php echo $unique_id; ?>"> 
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class); ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $unique_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo esc_html($image_title); ?>"> 
					<?php
				}
			break;
			case "GB_lightbox":
				if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
				{
					if($pics[$flag]->video == 1)
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->pic_name; ?>" class="element <?php echo str_replace(","," ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
					else
					{
						?>
						<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" class="<?php echo str_replace(",", " ", $class)." ".$class_gb; ?>" href="javascript:void(0);" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
						<?php
					}
				}
				else
				{
					?>
					<a class="<?php echo str_replace(",", " ", $class)." ".$class_gb; ?>" href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>" target="<?php echo $url_redirect; ?>" data-title="<?php echo $photoswipe_title;?>" desc="<?php echo $photoswipe_description;?>" >
					<?php
				}
			break;
		}
			?><div class="blog_gallery margin_thumbs" id="blog_holder<?php echo $unique_id; ?>">
				<?php
				switch($effect[0])
				{
					case "grayscale":
						?><div class="gallery_grayscale opactiy_thumbs"><?php
					break;
					case "blur":
						?><div class="gallery_blur opactiy_thumbs"><?php
					break;
					case "sepia":
						?><div class="gallery_sepia opactiy_thumbs"><?php
					break;
					case "none":
						?><div class="opactiy_thumbs"><?php
					break;
				}
				if ($pics[$flag]->video == 1){
				?>
					<img class="dynamic_css" alt="<?php echo esc_html($image_title . $image_description); ?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_img_<?php echo $unique_id; ?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url); ?>" style="width:700px;"/>
				<?php
				} else {
				?>
					<img class="dynamic_css" alt="<?php echo esc_html($image_title . $image_description); ?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_img_<?php echo $unique_id; ?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>" style="width:700px"/>
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
				if ($img_title == "true") {
					$image_title = (($img_title == "true") ? html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title))) : "");
					$image_desc = (($img_desc == "true") ? html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description))) : "");
					$description = (strlen($image_desc) > $thumbnail_desc_length) ? substr($image_desc, 0, $thumbnail_desc_length) . "..." : $image_desc;
					$ImgTitle = (($image_title == "") ? "" : "<h5>" . $image_title . "</h5>");
					$image_description = (($image_desc == "") ? "" : "<p>" . $description . "</p>");
				?>
					<div class="blog_description" id="blog_description_div<?php echo $unique_id; ?>">
						<?php echo $ImgTitle . $image_description; ?>
					</div>
				<?php
				}
				if ($album_seperator == 1) {
					?>
					<div class="separator-doubled"></div>
					<?php
				}
				?>
			</div>
		</a>
		<?php
	}
	?>
</div>
<?php
if ($pagination_setting == 1)
{
	?><div class="holder" id="holder_<?php echo $unique_id; ?>"></div><?php
}
?>