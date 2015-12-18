<style>
	#TB_ajaxContent { width: 752px !important; overflow-x: hidden;}
</style>
<div id="my-gallery-content-id" style="display:none;">
	<div class="layout-span10" style="padding:15px 15px 0 0;width:752px;">
		<div class="layout-control-group">
			<label class="custom-layout-label" for="ux_gallery"><?php _e("Gallery Type", gallery_bank); ?> : </label>
			<input type="radio" name="ux_gallery" value="1" onclick="check_gallery_type();"/>
			<label><?php _e("Albums with Images", gallery_bank); ?></label>
			<input type="radio" style="margin-left: 10px;" checked="checked" name="ux_gallery" value="0" onclick="check_gallery_type();"/> <label><?php _e("Only Images", gallery_bank); ?> </label>
		</div>
		<div class="layout-control-group" id="album_format" style="display: none;">
			<label class="custom-layout-label" for="ux_album_format"><?php _e("Album Format", gallery_bank); ?> : </label>
			<select id="ux_album_format" class="layout-span3" onclick="check_gallery_type();" onchange="select_album();">
				<option value="grid">Grid Albums</option>
				<option value="list">List Albums</option>
				<option value="individual">Individual Album</option>
			</select>
			<div id="ux_show_multiple_albums" style="display: none;margin-left:10px;">
				<label class="custom-layout-label"><?php _e("Choose Type", gallery_bank); ?> : </label>
				<select id="ddl_show_albums" class="layout-span3" onchange="show_gallery_albums();" onchange="select_album();">
					<option value="all">All Albums</option>
					<option value="selected">Only Selected Albums</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="ux_select_multiple_albums" style="display: none;">
			<label class="custom-layout-label"><?php _e("Choose Albums", gallery_bank); ?> : </label>
			<select id="ddl_add_multi_album" class="layout-span7" multiple="multiple" style="width: 578px;">
				<?php
				global $wpdb;
				$albums = $wpdb->get_results
				(
					"SELECT * FROM ".gallery_bank_albums()." order by album_order asc "
				);
				for ($flag = 0; $flag < count($albums); $flag++)
				{
					?>
					<option value="<?php echo intval($albums[$flag]->album_id); ?>"><?php echo esc_html($albums[$flag]->album_name) ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="layout-control-group" id="ux_select_album" style="display: block;">
			<label class="custom-layout-label"><?php _e("choose Album", gallery_bank); ?> : </label>
			<select id="ddl_add_album_id" class="layout-span7" style="width: 578px;">
				<?php
				global $wpdb;
				$albums = $wpdb->get_results
				(
					"SELECT * FROM ".gallery_bank_albums()." order by album_order asc "
				);
				for ($flag = 0; $flag < count($albums); $flag++) {
					?>
					<option value="<?php echo intval($albums[$flag]->album_id); ?>"><?php echo esc_html($albums[$flag]->album_name) ?></option>
				<?php
				}
				?>
			</select>
		</div>
		<div class="layout-control-group">
			<label class="custom-layout-label"><?php _e("Gallery Format", gallery_bank); ?> : </label>
			<select id="ux_gallery_format" class="layout-span3" onchange="select_images_in_row();">
				<option value="masonry">Masonry Gallery</option>
				<option value="filmstrip">Filmstrip Gallery</option>
				<option value="blog">Blog Style Gallery</option>
				<option id="slide_show" value="slideshow">Slideshow Gallery</option>
				<option value="thumbnail">Thumbnail Gallery</option>
			</select>
			<div id="gb_gallery_format" style="display: inline-block;margin-left: 10px;">
				<label class="custom-layout-label"><?php _e("Text Format", gallery_bank); ?> : </label>
				<select id="ux_text_format" class="layout-span3" onchange="show_special_effect();">
					<option value="title_only">With Title only</option>
					<option value="title_desc">With Title and Description</option>
					<option value="no_text">Without Title and Description</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="div_img_in_row" style="display: none;">
			<label class="custom-layout-label"><?php _e("Images in Row", gallery_bank); ?> : </label>
			<input type="text" class="layout-span3" name="ux_img_in_row" id="ux_img_in_row" onkeyup="set_text_value(\"img_in_row\");" onkeypress="return OnlyNumbers(event);" value="3"/>
			<div id="div_img_width" style="display: none; margin-left:10px;">
				<label class="custom-layout-label"><?php _e("Image Width", gallery_bank); ?> : </label>
				<input type="text" class="layout-span3" name="ux_img_width" id="ux_img_width" onkeypress="return OnlyNumbers(event);" value="600"/>
			</div>
		</div>
		<div class="layout-control-group" id="div_albums_in_row" style="display: none;">
			<label class="custom-layout-label"><?php _e("Albums in Row", gallery_bank); ?> : </label>
			<input type="text" class="layout-span3" name="ux_album_in_row" id="ux_album_in_row" onkeyup="set_text_value(\"album_in_row\");" onkeypress="return OnlyNumbers(event);" value="3"/>
		</div>
		<div class="layout-control-group" id="div_animation_effects">
			<label class="custom-layout-label"><?php _e("Animation Effects", gallery_bank); ?> : </label>
			<select id="ux_animation_effects" class="layout-span3">
				<optgroup label="Attention Seekers">
					<option value="bounce">Bounce</option>
					<option value="flash">Flash</option>
					<option value="pulse">Pulse</option>
					<option value="shake">Shake</option>
					<option value="swing">Swing</option>
					<option value="tada">Tada</option>
					<option value="wobble">Wobble</option>
					<option value="lightSpeedIn">Light Speed-In</option>
					<option value="rollIn">Roll-In</option>
				</optgroup>
				<optgroup label="Bouncing Entrances">
					<option value="bounceIn">Bounce-In</option>
					<option value="bounceInDown">Bounce-In Down</option>
					<option value="bounceInLeft">Bounce-In Left</option>
					<option value="bounceInRight">Bounce-In Right</option>
					<option value="bounceInUp">Bounce-In Up</option>
				</optgroup>
				<optgroup label="Fading Entrances">
					<option value="fadeIn">Fade-In</option>
					<option value="fadeInDown">Fade-In Down</option>
					<option value="fadeInDownBig">Fade-In Down (Big)</option>
					<option value="fadeInLeft">Fade-In Left</option>
					<option value="fadeInLeftBig">Fade-In Left (Big)</option>
					<option value="fadeInRight">Fade-In Right</option>
					<option value="fadeInRightBig">Fade-In Right (Big)</option>
					<option value="fadeInUp">Fade-In Up</option>
					<option value="fadeInUpBig">Fade-In Up (Big)</option>
				</optgroup>
				<optgroup label="Flippers">
					<option value="flip">Flip</option>
					<option value="flipInX">Flip-In X</option>
					<option value="flipInY">Flip-In Y</option>
				</optgroup>
				<optgroup label="Rotating Entrances">
					<option value="rotateIn">Rotate-In</option>
					<option value="rotateInDownLeft">Rotate-In Down Left</option>
					<option value="rotateInDownRight">Rotate-In Down Right</option>
					<option value="rotateInUpLeft">Rotate-In Up Left</option>
					<option value="rotateInUpRight">Rotate-In Up Right</option>
				</optgroup>
				<optgroup label="Sliders">
					<option value="slideInDown">Slide-In Down</option>
					<option value="slideInLeft">Slide-In Left</option>
					<option value="slideInRight">Slide-In Right</option>
				</optgroup>
			</select>
			<div id="div_special_effects" style="display: inline-block;margin-left:10px;">
				<label class="custom-layout-label"><?php _e("Special Effects", gallery_bank); ?> : </label>
				<select id="ux_special_effects" class="layout-span3" onchange="effects_settings();">
					<option id="option_cornor_ribbons" value="corner_ribbons">Corner Ribbons</option>
					<option id="option_hover_rotation" value="hover_rotation">Hover Rotation</option>
					<option id="option_levitation_shadow" value="levitation_shadow">Levitation Shadow</option>
					<option id="option_lomo_effect" value="lomo_effect">Lomo Effect</option>
					<option id="option_overlay_fade" value="overlay_fade" selected="selected">Overlay Fade</option>
					<option id="option_overlay_join" value="overlay_join">Overlay Join</option>
					<option id="option_overlay_slide" value="overlay_slide">Overlay Slide</option>
					<option id="option_overlay_split" value="overlay_split">Overlay Split</option>
					<option id="option_perspective_images" value="perspective_images">Perspective Images</option>
					<option id="option_pulse" value="pulse">Pulse</option>
					<option id="option_rounded_images" value="rounded_images">Rounded Images</option>
					<option value="blur">Blur</option>
					<option value="grayscale">Grayscale</option>
					<option value="sepia">Sepia</option>
					<option value="none">None</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="rotation_setting" style="display: none;">
			<label class="custom-layout-label">Hover Rotation : </label>
			<select id="ux_rotation" class="layout-span3">
				<option value="left">Left</option>
				<option value="right">Right</option>
			</select>
		</div>
		<div class="layout-control-group" id="overlay_color" style="display: none;">
			<label class="custom-layout-label">Overlay Color : </label>
			<select id="ux_overlay_color" class="layout-span3">
				<option value="white">White</option>
				<option value="black">Black</option>
			</select>
		</div>
		<div class="layout-control-group" id="overlay_color_with_direction" style="display: none;">
			<label class="custom-layout-label">Overlay Color : </label>
			<select id="ux_overlay_color_with_dir" class="layout-span3">
				<option value="white">White</option>
				<option value="black">Black</option>
			</select>
			<div style="display: inline-block;margin-left:10px;">
				<label class="custom-layout-label">From</label>
				<select id="ux_overlay_dir" class="layout-span3">
					<option value="left_right">Left-Right</option>
					<option value="top_bottom">Top-Bottom</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="ribbon_color_with_direction" style="display: none;">
			<label class="custom-layout-label">Ribbon Color : </label>
			<select id="ux_ribbon_color" class="layout-span3">
				<option value="white">White</option>
				<option value="black">Black</option>
			</select>
			<div style="display: inline-block;margin-left:10px;">
				<label class="custom-layout-label">From</label>
				<select id="ux_ribbon_dir" class="layout-span3">
					<option value="top_left">Top-Left</option>
					<option value="top_right">Top-Right</option>
					<option value="bottom_left">Bottom-Left</option>
					<option value="bottom_right">Bottom-Right</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="levitation_shadow_div" style="display: none;">
			<label class="custom-layout-label">Shadow : </label>
			<select id="ux_shadow" class="layout-span3">
				<option value="small">Small</option>
				<option value="large">Large</option>
			</select>
		</div>
		<div class="layout-control-group" id="lomo_effect_div" style="display: none;">
			<label class="custom-layout-label">Effect Color : </label>
			<select id="ux_lomo_color" class="layout-span3">
				<option value="white">White</option>
				<option value="black">Black</option>
			</select>
			<div style="display: inline-block;margin-left:10px;">
				<label class="custom-layout-label">Effect On : </label>
				<select id="ux_lomo_dir" class="layout-span3">
					<option value="hover_in">Hover-In</option>
					<option value="hover_out">Hover-Out</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="rounded_images_div" style="display: none;">
			<label class="custom-layout-label">Image Effect : </label>
			<select id="ux_rounded_images" class="layout-span3">
				<option value="rounded">Round on Hover</option>
				<option value="squared">Square on Hover</option>
			</select>
		</div>
		
		<div class="layout-control-group">
			<label class="custom-layout-label"><?php _e("Display Images", gallery_bank); ?> : </label>
			<select name="ddl_display_images" onchange="gb_display_images();" id="ddl_display_images" class="layout-span3">
				<option value="all">All</option>
				<option value="selected">Selected</option>
			</select>
			<div style="display: inline-block;margin-left: 10px;">
				<label class="custom-layout-label"><?php _e("Sort By", gallery_bank); ?> : </label>
				<select name="ddl_sort_order" id="ddl_sort_order" class="layout-span3">
					<option value="random">Random</option>
					<option value="pic_id">Image Id</option>
					<option value="pic_name">File Name</option>
					<option value="title">Title Text</option>
					<option value="date">Date</option>
				</select>
			</div>
		</div>
		<div class="layout-control-group" id="div_no_of_images" style="display: none;">
			<label class="custom-layout-label"><?php _e("No. of Images", gallery_bank); ?> : </label>
			<input type="text" class="layout-span3" onkeypress="return OnlyNumbers(event);" name="ux_show_no_of_images" id="ux_show_no_of_images" value="10" />
		</div>
		<div class="layout-control-group">
			<label class="custom-layout-label"><?php _e("Show Responsive Gallery", gallery_bank); ?> : </label>
			<input type="checkbox" checked="checked" onclick="show_images_in_row();" name="ux_responsive_gallery" id="ux_responsive_gallery"/>
			<label class="custom-layout-label" style="margin-left:7%;"><?php _e("Show Album Title", gallery_bank); ?> : </label>
			<input type="checkbox" checked="checked" name="ux_album_title" id="ux_album_title" style="vertical-align: -webkit-baseline-middle;"/>
		</div>
		<div class="layout-control-group">
			<label class="custom-layout-label"></label>
			<input type="button" class="button-primary" value="<?php _e("Insert Album", gallery_bank); ?>"
				   onclick="InsertGallery();"/>&nbsp;&nbsp;&nbsp;
			<a class="button" style="color:#bbb;" href="#"
			   onclick="tb_remove(); return false;"><?php _e("Cancel", gallery_bank); ?></a>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function () {
	check_gallery_type();
	select_images_in_row();
	effects_settings();
	show_special_effect();
	show_images_in_row();
	gb_display_images();
});
function gb_display_images()
{
	var show_images = jQuery("#ddl_display_images").val();
	if(show_images == "selected")
	{
		jQuery("#div_no_of_images").css("display","block");
	}
	else
	{
		jQuery("#div_no_of_images").css("display","none");
	}
}
function show_images_in_row()
{
	var responsive = jQuery("#ux_responsive_gallery").prop("checked");
	var gallery_format = jQuery("#ux_gallery_format").val();
	if(responsive == true && (gallery_format == "thumbnail" || gallery_format == "masonry" || gallery_format == "slideshow" ))
	{
		jQuery("#div_img_in_row").css("display","none");
	}
	else if(gallery_format != "blog" && gallery_format != "slideshow")
	{
		jQuery("#div_img_in_row").css("display","block");
	}
}
function select_images_in_row() {
	var gallery_format = jQuery("#ux_gallery_format").val();
	switch(gallery_format)
	{
		case "thumbnail":
			jQuery("#div_img_in_row").css("display", "block");
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_width").css("display", "none");
			jQuery("#div_special_effects").css("display", "inline-block");
			jQuery("#div_animation_effects").css("display", "block");
			jQuery("#option_cornor_ribbons").removeAttr("disabled");
			jQuery("#option_hover_rotation").removeAttr("disabled");
			jQuery("#option_levitation_shadow").removeAttr("disabled");
			jQuery("#option_lomo_effect").removeAttr("disabled");
			jQuery("#option_overlay_fade").removeAttr("disabled");
			jQuery("#option_overlay_join").removeAttr("disabled");
			jQuery("#option_overlay_slide").removeAttr("disabled");
			jQuery("#option_overlay_split").removeAttr("disabled");
			jQuery("#option_perspective_images").removeAttr("disabled");
			jQuery("#option_rounded_images").removeAttr("disabled");
			jQuery("#option_pulse").removeAttr("disabled");
		break;
		case "filmstrip":
			jQuery("#div_img_in_row").css("display", "block");
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_width").css("display", "inline-block");
			jQuery("#div_special_effects").css("display", "none");
			jQuery("#div_animation_effects").css("display", "block");
		break;
		case "masonry":
			jQuery("#div_img_in_row").css("display", "block");
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_width").css("display", "none");
			jQuery("#div_special_effects").css("display", "inline-block");
			jQuery("#div_animation_effects").css("display", "block");
			jQuery("#ux_special_effects").val("grayscale");
			jQuery("#option_cornor_ribbons").attr("disabled", "disabled");
			jQuery("#option_hover_rotation").attr("disabled", "disabled");
			jQuery("#option_levitation_shadow").attr("disabled", "disabled");
			jQuery("#option_lomo_effect").attr("disabled", "disabled");
			jQuery("#option_overlay_fade").attr("disabled", "disabled");
			jQuery("#option_overlay_join").attr("disabled", "disabled");
			jQuery("#option_overlay_slide").attr("disabled", "disabled");
			jQuery("#option_overlay_split").attr("disabled", "disabled");
			jQuery("#option_perspective_images").attr("disabled", "disabled");
			jQuery("#option_rounded_images").attr("disabled", "disabled");
			jQuery("#option_pulse").attr("disabled", "disabled");
		break;
		case "slideshow":
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_in_row").css("display", "none");
			jQuery("#div_img_width").css("display", "none");
			jQuery("#div_special_effects").css("display", "none");
			jQuery("#div_animation_effects").css("display", "none");
		break;
		case "blog":
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_in_row").css("display", "none");
			jQuery("#div_img_width").css("display", "none");
			jQuery("#div_special_effects").css("display", "inline-block");
			jQuery("#div_animation_effects").css("display", "block");
			jQuery("#ux_special_effects").val("grayscale");
			jQuery("#option_cornor_ribbons").attr("disabled", "disabled");
			jQuery("#option_hover_rotation").attr("disabled", "disabled");
			jQuery("#option_levitation_shadow").attr("disabled", "disabled");
			jQuery("#option_lomo_effect").attr("disabled", "disabled");
			jQuery("#option_overlay_fade").attr("disabled", "disabled");
			jQuery("#option_overlay_join").attr("disabled", "disabled");
			jQuery("#option_overlay_slide").attr("disabled", "disabled");
			jQuery("#option_overlay_split").attr("disabled", "disabled");
			jQuery("#option_perspective_images").attr("disabled", "disabled");
			jQuery("#option_rounded_images").attr("disabled", "disabled");
			jQuery("#option_pulse").attr("disabled", "disabled");
		break;
		default:
			jQuery("#gb_gallery_format").css("display", "inline-block");
			jQuery("#div_img_in_row").css("display", "none");
			jQuery("#div_img_width").css("display", "none");
			jQuery("#div_special_effects").css("display", "inline-block");
			jQuery("#div_animation_effects").css("display", "block");
			jQuery("#option_cornor_ribbons").removeAttr("disabled");
			jQuery("#option_hover_rotation").removeAttr("disabled");
			jQuery("#option_levitation_shadow").removeAttr("disabled");
			jQuery("#option_lomo_effect").removeAttr("disabled");
			jQuery("#option_overlay_fade").removeAttr("disabled");
			jQuery("#option_overlay_join").removeAttr("disabled");
			jQuery("#option_overlay_slide").removeAttr("disabled");
			jQuery("#option_overlay_split").removeAttr("disabled");
			jQuery("#option_perspective_images").removeAttr("disabled");
			jQuery("#option_rounded_images").removeAttr("disabled");
			jQuery("#option_pulse").removeAttr("disabled");
		break;
	}
	show_images_in_row();
}
function effects_settings() {
	var special_effects = jQuery("#ux_special_effects").val();
	switch (special_effects) {
		case "hover_rotation":
			jQuery("#rotation_setting").css("display", "block");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "overlay_fade":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "block");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "overlay_slide":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "block");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "overlay_split":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "block");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "overlay_join":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "block");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "corner_ribbons":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "block");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "levitation_shadow":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "block");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "lomo_effect":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "block");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		case "rounded_images":
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "block");
			break;
		case "perspective_images":
			jQuery("#rotation_setting").css("display", "block");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
		default:
			jQuery("#rotation_setting").css("display", "none");
			jQuery("#overlay_color").css("display", "none");
			jQuery("#overlay_color_with_direction").css("display", "none");
			jQuery("#ribbon_color_with_direction").css("display", "none");
			jQuery("#levitation_shadow_div").css("display", "none");
			jQuery("#lomo_effect_div").css("display", "none");
			jQuery("#rounded_images_div").css("display", "none");
			break;
	}
}
function show_special_effect() {
	var text_format = jQuery("#ux_text_format").val();
	var gallery_format = jQuery("#ux_gallery_format").val();
	if (text_format == "no_text" && (gallery_format != "slideshow" && gallery_format != "filmstrip" )) {
		jQuery("#div_special_effects").css("display", "inline-block");
		effects_settings();
	}
	else if(gallery_format == "blog")
	{
		jQuery("#div_special_effects").css("display", "inline-block");
	}
	else {
		jQuery("#div_special_effects").css("display", "none");
		jQuery("#rotation_setting").css("display", "none");
		jQuery("#overlay_color").css("display", "none");
		jQuery("#overlay_color_with_direction").css("display", "none");
		jQuery("#ribbon_color_with_direction").css("display", "none");
		jQuery("#levitation_shadow_div").css("display", "none");
		jQuery("#lomo_effect_div").css("display", "none");
		jQuery("#rounded_images_div").css("display", "none");
	}
}
function show_gallery_albums()
{
	var show_albums = jQuery("#ddl_show_albums").val();
	if(show_albums == "all")
	{
		jQuery("#ux_select_multiple_albums").css("display", "none");
	}
	else
	{
		jQuery("#ux_select_multiple_albums").css("display", "block");
	}
}
function check_gallery_type() {
	var gallery_type = jQuery("input:radio[name=ux_gallery]:checked").val();
	var album_format = jQuery("#ux_album_format").val();
	if (gallery_type == 0) {
		jQuery("#album_format").css("display", "none");
		jQuery("#div_albums_in_row").css("display", "none");
		jQuery("#ux_select_album").css("display", "block");
		jQuery("#slide_show").css("display", "none");
		jQuery("#ux_show_multiple_albums").css("display", "none");
		jQuery("#ux_select_multiple_albums").css("display", "none");
	}
	else {
		jQuery("#album_format").css("display", "block");
		if (album_format != "individual") {
			jQuery("#ux_select_album").css("display", "none");
			if (album_format == "grid") {
				jQuery("#div_albums_in_row").css("display", "block");
				jQuery("#slide_show").css("display", "block");
				jQuery("#ux_show_multiple_albums").css("display", "inline-block");
			}
			else {
				jQuery("#div_albums_in_row").css("display", "none");
				jQuery("#slide_show").css("display", "block");
				jQuery("#ux_show_multiple_albums").css("display", "inline-block");
			}
			show_gallery_albums();
		}
		else {
			jQuery("#div_albums_in_row").css("display", "none");
			jQuery("#slide_show").css("display", "block");
			jQuery("#ux_show_multiple_albums").css("display", "none");
			jQuery("#ux_select_multiple_albums").css("display", "none");
		}
	}
}
function select_album() {
	var album_format = jQuery("#ux_album_format").val();
	if (album_format == "individual") {
		jQuery("#ux_select_album").css("display", "block");
	}
	else {
		jQuery("#ux_select_album").css("display", "none");
	}
}
function InsertGallery() {
	var gallery_effect;
	var album_id = jQuery("#ddl_add_album_id").val();
	var album_format = jQuery("#ux_album_format").val();
	var gallery_format = jQuery("#ux_gallery_format").val();
	var text_format = jQuery("#ux_text_format").val();
	var images_in_row = jQuery("#ux_img_in_row").val();
	var album_in_row = jQuery("#ux_album_in_row").val();
	var filmstrip_width = jQuery("#ux_img_width").val();
	var gallery_type = jQuery("input:radio[name=ux_gallery]:checked").val();
	var album_type = jQuery("#ddl_show_albums").val();
	var selected_albums = jQuery("#ddl_add_multi_album").val();
	var display_images = jQuery("#ddl_display_images").val();
	var no_of_images = jQuery("#ux_show_no_of_images").val();
	var sort_order = jQuery("#ddl_sort_order").val();

	var special_effect = jQuery("#ux_special_effects").val();
	var rotation = jQuery("#ux_rotation").val();
	var overlay_color = jQuery("#ux_overlay_color").val();
	var overlay_color_with_dir = jQuery("#ux_overlay_color_with_dir").val();
	var overlay_dir = jQuery("#ux_overlay_dir").val();
	var ribbon_color = jQuery("#ux_ribbon_color").val();
	var ribbon_dir = jQuery("#ux_ribbon_dir").val();
	var shadow = jQuery("#ux_shadow").val();
	var lomo_color = jQuery("#ux_lomo_color").val();
	var lomo_dir = jQuery("#ux_lomo_dir").val();
	var rounded_images = jQuery("#ux_rounded_images").val();
	var animation_effects = jQuery("#ux_animation_effects").val();
	var displayAlbumTitle = jQuery("#ux_album_title").prop("checked");
	var responsiveGallery = jQuery("#ux_responsive_gallery").prop("checked");
	var responsive;

	if(no_of_images == "")
	{
		alert("<?php _e("Enter number of images you want to display.", gallery_bank) ?>");
		return;
	}
	
	if(responsiveGallery == true)
	{
		responsive = "responsive=\""+ responsiveGallery+"\"";
	}
	else
	{
		responsive = "img_in_row=\""+ images_in_row+"\"";
	}
	
	if(album_type == "all")
	{
		var display_selected_albums = "show_albums=\"all\"";
	}
	else
	{
		var display_selected_albums = "show_albums=\""+ encodeURIComponent(selected_albums)+"\"";
	}

	if(display_images == "all")
	{
		var show_no_of_images = "display=\"all\" sort_by=\""+sort_order+"\"";
	}
	else
	{
		var show_no_of_images = "display=\"selected\" no_of_images=\""+no_of_images+"\" sort_by=\""+sort_order+"\"";
	}
	
	switch (special_effect) {
		case "hover_rotation":
			gallery_effect = "hover_rotation-" + rotation;
		break;
		case "overlay_fade":
			gallery_effect = "overlay_fade-" + overlay_color;
		break;
		case "overlay_slide":
			gallery_effect = "overlay_slide-" + overlay_color;
		break;
		case "overlay_split":
			gallery_effect = "overlay_split-" + overlay_color_with_dir + "-" + overlay_dir;
		break;
		case "overlay_join":
			gallery_effect = "overlay_join-" + overlay_color_with_dir + "-" + overlay_dir;
		break;
		case "corner_ribbons":
			gallery_effect = "corner_ribbons-" + ribbon_color + "-" + ribbon_dir;
		break;
		case "levitation_shadow":
			gallery_effect = "levitation_shadow-" + shadow;
		break;
		case "lomo_effect":
			gallery_effect = "lomo_effect-" + lomo_color + "-" + lomo_dir;
		break;
		case "rounded_images":
			gallery_effect = "rounded_images-" + rounded_images;
		break;
		case "perspective_images":
			gallery_effect = "perspective_images-" + rotation;
		break;
		case "pulse":
			gallery_effect = "pulse";
		break;
		case "grayscale":
			gallery_effect = "grayscale";
		break;
		case "sepia":
			gallery_effect = "sepia";
		break;
		case "blur":
			gallery_effect = "blur";
		break;
		case "none":
			gallery_effect = "none";
		break;
	}
	
	if (gallery_type == 1) {
		if (album_format == "individual") {
			if (gallery_format == "thumbnail" || gallery_format == "masonry") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
			}
			else if (gallery_format == "filmstrip") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_id=\"" + album_id + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_id=\"" + album_id + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_id=\"" + album_id + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "slideshow") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
			}
			else if (gallery_format == "blog") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
				}
			}
		}
		else if (album_format == "grid") {
			if (gallery_format == "thumbnail" || gallery_format == "masonry") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" "+responsive+" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" "+responsive+" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" "+responsive+" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "slideshow") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" "+show_no_of_images+" albums_in_row=\"" + album_in_row + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "filmstrip") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" img_in_row=\"" + images_in_row + "\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" img_in_row=\"" + images_in_row + "\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" img_in_row=\"" + images_in_row + "\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "blog") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" albums_in_row=\"" + album_in_row + "\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
		}
		else {
			if (gallery_format == "thumbnail" || gallery_format == "masonry") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" "+responsive+" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "slideshow") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" "+show_no_of_images+" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "filmstrip") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
			else if (gallery_format == "blog") {
				if (text_format == "title_only") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "title_desc") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"true\" desc=\"true\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
				else if (text_format == "no_text") {
					window.send_to_editor("[gallery_bank type=\"" + album_format + "\" format=\"" + gallery_format + "\" "+display_selected_albums+" title=\"false\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\"]");
				}
			}
		}
	}
	else {
		if (gallery_format == "thumbnail" || gallery_format == "masonry") {
			if (text_format == "title_only") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "title_desc") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+responsive+" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "no_text") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+responsive+" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
		}
		else if (gallery_format == "filmstrip") {
			if (text_format == "title_only") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "title_desc") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "no_text") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" img_in_row=\"" + images_in_row + "\" "+show_no_of_images+" animation_effect=\"" + animation_effects + "\" image_width=\"" + filmstrip_width + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
		}
		else if (gallery_format == "blog") {
			if (text_format == "title_only") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "title_desc") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"true\" desc=\"true\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
			else if (text_format == "no_text") {
				window.send_to_editor("[gallery_bank type=\"images\" format=\"" + gallery_format + "\" title=\"false\" desc=\"false\" "+show_no_of_images+" special_effect=\"" + gallery_effect + "\" animation_effect=\"" + animation_effects + "\" album_title=\"" + displayAlbumTitle + "\" album_id=\"" + album_id + "\"]");
			}
		}
	}
}
/**
 * @return {boolean}
 */
function OnlyNumbers(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode;
	return (charCode > 47 && charCode < 58) || charCode == 127 || charCode == 8;
}
function set_text_value(text_type) {
	var val = "";
	switch (text_type) {
		case "img_in_row":
			val = jQuery("#ux_img_in_row").val();
			if (val < 1)
				jQuery("#ux_img_in_row").val(1);
		break;
		case  "album_in_row":
			val = jQuery("#ux_album_in_row").val();
			if (val < 1)
				jQuery("#ux_album_in_row").val(1);
		break;
	}
}
</script>