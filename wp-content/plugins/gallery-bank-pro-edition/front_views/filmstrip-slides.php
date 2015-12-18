<div class="gallery-bank" style="text-align:center">
	<div class="img<?php echo $unique_id; ?> bottom_overlay" id="image<?php echo $unique_id; ?>">
		<?php
		if ($pics[0]->video != 1) {
			?>
			<img class="dynamic_css animated <?php echo $animation_effect;?>" src="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[0]->thumbnail_url); ?>">
		<?php
		}
		?>
		<div class="filmstrip_description_black animated <?php echo $animation_effect;?>">
			<?php
			echo $image_title = ($img_title == "true" ? (($pics[0]->title != "")? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[0]->title)))) . "</h5>" : "" ): "");
			echo $image_description = $img_desc == "true" ? (($pics[0]->description != "") ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[0]->description)))) . "</p>": "" ): "";
			?>
		</div>
	</div>
	<ul class="thumbs clearfix" id="thumb_<?php echo $unique_id; ?>">
		<li class="btns">
			<span id="prv_<?php echo $unique_id; ?>" class="filmstrip_prev"></span>
		</li>
		<a style="text-decoration: none !important;">
			<?php
			for ($flag = 0; $flag < count($pics); $flag++)
			{
				if ($flag == 0) {
					?>
					<li id="li_<?php echo $unique_id; ?>" class="selected">
					<?php
				} else {
					?>
					<li id="li_<?php echo $unique_id; ?>">
					<?php
				}
				?>
				<div class="imgFilmstripFill opactiy_thumbs">
					<?php
					$image_title = ($img_title == "true" ? (($pics[$flag]->title != "")? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))) . "</h5>" : "" ): "");
					$image_description = $img_desc == "true" ? (($pics[$flag]->description != "") ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) . "</p>": "" ): "";
					if ($pics[$flag]->video == 1) {
						?>
						<img data-desc="<?php echo esc_html($image_description); ?>" data-title="<?php echo esc_html($image_title); ?>" picPath="" imgpath="<?php echo $pics[$flag]->pic_name; ?>" type="video" src="<?php echo stripcslashes($pics[$flag]->thumbnail_url); ?>"/>
						<?php
					} else {
						?>
						<img type="image" data-desc="<?php echo esc_html($image_description); ?>" picPath="<?php echo $pics[$flag]->thumbnail_url;?>" data-title="<?php echo esc_html($image_title); ?>" id="ux_img_div_<?php echo $unique_id; ?>" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL . $pics[$flag]->thumbnail_url); ?>"/>
						<?php
					}
					?>
				</div>
			</li>
			<?php
			}
			?>
		</a>
		<li class="btns"><span id="nxt_<?php echo $unique_id; ?>" class="filmstrip_next"></span></li>
	</ul>
	<div id="holder_<?php echo $unique_id; ?>" class="holder" style="display:none !important;"></div>
</div>