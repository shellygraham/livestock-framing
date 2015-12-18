<?php
if ($effect[0] != "none" && $effect[0] != "pulse" && $effect[0] != "grayscale" && $effect[0] != "sepia" && $effect[0] != "blur") {
	$effect_color = $effect[1];
}
switch ($effect[0]) {
	//tested in all browsers successfully.
	case "hover_rotation":
		$rotation = $effect[1];
		?>
		<div class="hover_rotation dynamic_css margin_thumbs thumbnail_width<?php echo $unique_id;?>">
			<div class="hover_rotation_<?php echo $rotation ?> opactiy_thumbs">
		<?php
	break;
	case "overlay_fade":
		?>
		<div class="dynamic_css margin_thumbs overlay_fade thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
				<div class="overlay_zoom zoom_<?php echo $effect_color; ?>"></div>
		<?php
	break;
	case "overlay_slide":
		?>
		<div class="dynamic_css margin_thumbs overlay_slide thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
				<div class="overlay_zoom zoom_<?php echo $effect_color; ?>"></div>
		<?php
	break;
	case "overlay_split":
		$split1 = (($effect[2] == "left_right") ? "left" : "top");
		$split2 = (($effect[2] == "left_right") ? "right" : "bottom");
		?>
		<div class="dynamic_css margin_thumbs overlay_split thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
				<div class="overlay_split_<?php echo $split1; ?> split_<?php echo $effect_color; ?>"></div>
					<div class="overlay_split_<?php echo $split2; ?> split_<?php echo $effect_color; ?>"></div>
		<?php
	break;
	case "overlay_join":
		$split1 = (($effect[2] == "left_right") ? "left" : "top");
		$split2 = (($effect[2] == "left_right") ? "right" : "bottom");
		?>
		<div class="dynamic_css margin_thumbs overlay_join thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
				<div class="overlay_join_<?php echo $split1; ?> join_<?php echo $effect_color; ?>">
					<span class="join_zoom"></span>
				</div>
				<div class="overlay_join_<?php echo $split2; ?> join_<?php echo $effect_color; ?>">
					<span class="join_favorite"></span>
				</div>
		<?php
	break;
	case "corner_ribbons":
		?>
		<div class="dynamic_css margin_thumbs corner_ribbon thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
				<div class="corner_ribbon_<?php echo $effect[2] . "_" . $effect_color; ?>">
					<span class="corner_zoom"></span>
				</div>
		<?php
	break;
	case "levitation_shadow":
		?>
		<div class="levitation_shadow margin_thumbs thumbnail_width<?php echo $unique_id;?>">
			<div class="bottom_shadow"></div>
				<div class="opactiy_thumbs dynamic_css imgLiquidFill  levitation_<?php echo $effect[1]; ?>">
		<?php
	break;
	case "lomo_effect":
		$effect_on = (($effect[2] == "hover_out") ? "_reversed" : "");
		?>
		<div class="lomo_<?php echo $effect_color . $effect_on; ?> margin_thumbs dynamic_css thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill opactiy_thumbs">
		<?php
	break;
	case "rounded_images":
		$hover_effect = (($effect[1] == "rounded") ? "squared" : "rounded");
		?>
		<div class="rounded_image dynamic_css margin_thumbs" style="border: none !important;">
			<div class="imgLiquidFill <?php echo $hover_effect; ?>_img opactiy_thumbs">
		<?php
	break;
	case "perspective_images":
		?>
		<div class="perspective margin_thumbs thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill dynamic_css opactiy_thumbs perspective_<?php echo $effect[1]; ?>">
		<?php
	break;
	case "pulse":
		?>
		<div class="special_pulse margin_thumbs thumbnail_width<?php echo $unique_id;?>">
			<div class="imgLiquidFill dynamic_css opactiy_thumbs">
		<?php
	break;
	case "grayscale":
		?>
		<div class="gallery_grayscale widgetImgLiquidFill<?php echo $unique_id;?> imgLiquidFill dynamic_css opactiy_thumbs thumbnail_width<?php echo $unique_id;?> margin_thumbs widget_margin_thumbs<?php echo $unique_id;?>">
		<?php
	break;
	case "sepia":
		?>
		<div class="gallery_sepia widgetImgLiquidFill<?php echo $unique_id;?> imgLiquidFill dynamic_css opactiy_thumbs margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?>">
		<?php
	break;
	case "blur":
		?>
		<div class="gallery_blur widgetImgLiquidFill<?php echo $unique_id;?> imgLiquidFill dynamic_css opactiy_thumbs margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?>">
		<?php
	break;
	case "none":
		?>
		<div class="imgLiquidFill widgetImgLiquidFill<?php echo $unique_id;?> shutter-gb-img-wrap opactiy_thumbs dynamic_css margin_thumbs thumbnail_width<?php echo $unique_id;?> widget_margin_thumbs<?php echo $unique_id;?>" >
		<?php
	break;
}
if ($pics[$flag]->video == 1) {
	?>
	<img alt="<?php echo esc_html($image_title.$image_description);?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_gb_img_<?php echo $unique_id; ?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url); ?>" style="height:<?php echo $thumbnails_height; ?>px;"/>
<?php
} else {
	if ($effect[0] == "hover_rotation") {
		?>
		<img alt="<?php echo esc_html($image_title.$image_description);?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_gb_img_<?php echo $unique_id; ?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"/>
	<?php
	} else {
		?>
		<img alt="<?php echo esc_html($image_title.$image_description);?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_gb_img_<?php echo $unique_id; ?>" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL . $pics[$flag]->thumbnail_url); ?>"/>
	<?php
	}
}
switch ($effect[0]) {
	//tested in all browsers successfully.
	case "hover_rotation":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.hover_rotation").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "overlay_fade":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.overlay_fade").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "overlay_slide":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.overlay_slide").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "overlay_split":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.overlay_split").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "overlay_join":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
			?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.overlay_join").addClass("animated <?php echo $animation_effect;?>");
			</script>
			<?php
		}
	break;
	case "corner_ribbons":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.corner_ribbon").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "levitation_shadow":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.levitation_shadow").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "lomo_effect":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.margin_thumbs").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "rounded_images":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.rounded_image").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "perspective_images":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.perspective").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "pulse":
		?></div></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.special_pulse").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "grayscale":
		?>
		</div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.gallery_grayscale").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "sepia":
		?></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.gallery_sepia").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "blur":
		?></div>
		<?php
		if ($pagination_setting == 0)
		{
		?>
			<script type="text/javascript">
				jQuery("div.gallery_blur").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
	case "none":
		?></div>
		<?php
		if ($pagination_setting == 0) {
			?>
			<script type="text/javascript">
				jQuery("div.shutter-gb-img-wrap").addClass("animated <?php echo $animation_effect;?>");
			</script>
		<?php
		}
	break;
}
?>