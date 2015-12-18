<?php
if ($gallery_type != "slideshow") {
	?>
	<!------   Code for Back Button ------->
	<button class="album_back_btn" id="back_button<?php echo $unique_id; ?>" onclick="view_individual_albums<?php echo $unique_id; ?>(<?php echo $unique_id; ?>);" style="display: none;"><span style="color: <?php echo $button_text_color; ?>;"> <?php echo $back_button_text; ?></span></button>
	<div id="seperator<?php echo $unique_id; ?>" class="separator-doubled" style="display: none"></div>
<?php
}
?>
<div class="album_content_div<?php echo $unique_id; ?>" id="ux_individual_main_div<?php echo $unique_id; ?>">
	<div class="gallery-bank-hover-details">
		<?php
		if ($gallery_type == "slideshow")
		{
			?>
			<div class="imgLiquid dynamic_cover_css" id="<?php echo $unique_id; ?>" onclick="view_individual_slideshow_images<?php echo $unique_id; ?>(<?php echo $album->album_id; ?>,<?php echo $unique_id; ?>)">
			<?php
		}
		else
		{
			?>
			<div class="imgLiquid dynamic_cover_css" id="<?php echo $unique_id; ?>" onclick="view_individual_album_images<?php echo $unique_id; ?>(<?php echo $album->album_id; ?>,<?php echo $unique_id; ?>)">
			<?php
		}
				if (count($albumCover) != 0)
				{
					if ($albumCover->album_cover == 0) {
						?>
						<img id="album_img<?php echo $album->album_id; ?>" src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>" style=" height: <?php echo $cover_thumbnail_height; ?>px;"/>
						<?php
					}
					elseif($albumCover->album_cover == 1 && $albumCover->video == 1)
					{
						?> 
						<img id="album_img<?php echo $album->album_id; ?>" src="<?php echo stripcslashes($albumCover->thumbnail_url); ?>"   />
						<?php
					}
					else {
						?>
						<img id="album_img<?php echo $album->album_id; ?>" src="<?php echo stripcslashes(GALLERY_BK_ALBUM_THUMB_URL . $albumCover->thumbnail_url); ?>"/>
					<?php
					}
				} else {
					?>
					<img id="album_img<?php echo $album->album_id; ?>" src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>" style=" height: <?php echo $cover_thumbnail_height; ?>px;"/>
				<?php
				}
				?>
			<div class="gallery-bank-album-detail"></div>
		</div>
	</div>
	<div class="album_content_holder">
		<?php
		if ($album->album_name != "Untitled Album" && $img_title == "true") {
			?>
			<h5>
				<?php echo stripcslashes(htmlspecialchars_decode($album->album_name)); ?>
			</h5>
		<?php
		}
		if ($img_desc == "true") {
			$string = stripcslashes(htmlspecialchars_decode($album->description));
			$description = (strlen($string) > $album_desc_length) ? substr($string, 0, $album_desc_length) . "..." : $string;
			?>
			<p>
				<?php echo $description; ?>
			</p>
		<?php
		}
		if ($gallery_type != "slideshow") {
			?>
			<div class="album_view_link">
				<a onclick="view_individual_album_images<?php echo $unique_id; ?>(<?php echo $album->album_id; ?>,<?php echo $unique_id; ?>)">
					<?php echo $album_click_text; ?>
				</a>
			</div>
		<?php
		} else {
			?>
			<div class="album_view_link">
				<a onclick="view_individual_slideshow_images<?php echo $unique_id; ?>(<?php echo $album->album_id; ?>,<?php echo $unique_id; ?>)">
					<?php echo $album_click_text; ?>
				</a>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php
if ($album_seperator == 1) {
	?>
	<div id="seperator1<?php echo $unique_id; ?>" class="separator-doubled" style="clear:both;"></div>
<?php
}
?>
<?php
if ($gallery_type != "slideshow") {
	?>
	<div id="bank_album_images_div<?php echo $unique_id; ?>" style="display: none;" class="bank-album-images">
		<?php
		if ($gallery_type == "filmstrip")
		{
			?>
			<div id="show_bank_album_images<?php echo $unique_id; ?>" style="margin-top: 5px;text-align: center;"></div>
			<?php
		}
		else
		{
			?>
			<div id="show_bank_album_images<?php echo $unique_id; ?>" style="margin-top: 5px;"></div>
			<?php
		}
		?>
		
	</div>
<?php
} else {
	?>
	<div id="show_bank_slideshow_images" style="display:none;"></div>
<?php
}
?>