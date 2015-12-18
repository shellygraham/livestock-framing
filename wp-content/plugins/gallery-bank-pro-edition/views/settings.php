<?php
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
	global $foobox;
	
	if (class_exists("fooboxV2"))
	{
	   $foobox = "yes";
	}
	elseif(class_exists("Foobox_Free"))
	{
		$foobox = "Foobox Free Edition";
	}
	
	$album_css = $wpdb->get_results
	(
	    "SELECT * FROM " . gallery_bank_settings()
	);
	if (count($album_css) != 0) {
	    $setting_keys = array();
	    for ($flag = 0; $flag < count($album_css); $flag++) {
	        array_push($setting_keys, $album_css[$flag]->setting_key);
	    }
	    $index = array_search("thumbnails_custom_enable", $setting_keys);
	    $thumbnails_custom_enable = intval($album_css[$index]->setting_value);
	
	    $index = array_search("thumbnails_width", $setting_keys);
	    $thumbnails_width = intval($album_css[$index]->setting_value);
	
	    $index = array_search("thumbnails_height", $setting_keys);
	    $thumbnails_height = intval($album_css[$index]->setting_value);
	
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
	
	    $index = array_search("cover_custom_enable", $setting_keys);
	    $cover_custom_enable = intval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_width", $setting_keys);
	    $cover_thumbnail_width = intval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_height", $setting_keys);
	    $cover_thumbnail_height = intval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_opacity", $setting_keys);
	    $cover_thumbnail_opacity = doubleval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_border_size", $setting_keys);
	    $cover_thumbnail_border_size = intval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_border_radius", $setting_keys);
	    $cover_thumbnail_border_radius = intval($album_css[$index]->setting_value);
	
	    $index = array_search("cover_thumbnail_border_color", $setting_keys);
	    $cover_thumbnail_border_color = $album_css[$index]->setting_value;
	
	    $index = array_search("margin_btw_cover_thumbnails", $setting_keys);
	    $margin_btw_cover_thumbnails = intval($album_css[$index]->setting_value);
	
	    $index = array_search("album_text_align", $setting_keys);
	    $album_text_align = $album_css[$index]->setting_value;
	
	    $index = array_search("album_font_family", $setting_keys);
	    $album_font_family = $album_css[$index]->setting_value;
	
	    $index = array_search("album_heading_font_size", $setting_keys);
	    $album_heading_font_size = intval($album_css[$index]->setting_value);
	
	    $index = array_search("album_text_font_size", $setting_keys);
	    $album_text_font_size = intval($album_css[$index]->setting_value);
	
	    $index = array_search("album_desc_length", $setting_keys);
	    $album_desc_length = $album_css[$index]->setting_value;
	
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
	
	    $index = array_search("lightbox_inline_bg_color", $setting_keys);
	    $lightbox_inline_bg_color = $album_css[$index]->setting_value;
	
	    $index = array_search("lightbox_overlay_bg_color", $setting_keys);
	    $lightbox_overlay_bg_color = $album_css[$index]->setting_value;
	
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
	
	    $index = array_search("slide_interval", $setting_keys);
	    $slide_interval = intval($album_css[$index]->setting_value);
	
	    $index = array_search("pagination_setting", $setting_keys);
	    $pagination_setting = intval($album_css[$index]->setting_value);
	
	    $index = array_search("images_per_page", $setting_keys);
	    $images_per_page = intval($album_css[$index]->setting_value);
	
	    $index = array_search("filters_setting", $setting_keys);
	    $filters_setting = intval($album_css[$index]->setting_value);
	
	    $index = array_search("filter_font_family", $setting_keys);
	    $filter_font_family = $album_css[$index]->setting_value;
	
	    $index = array_search("filter_font_size", $setting_keys);
	    $filter_font_size = intval($album_css[$index]->setting_value);
	
	    $index = array_search("back_button_text", $setting_keys);
	    $back_button_text = $album_css[$index]->setting_value;
	
	    $index = array_search("album_click_text", $setting_keys);
	    $album_click_text = $album_css[$index]->setting_value;
	
	    $index = array_search("album_text_color", $setting_keys);
	    $album_text_color = $album_css[$index]->setting_value;
	
	    $index = array_search("button_color", $setting_keys);
	    $button_color = $album_css[$index]->setting_value;
	
	    $index = array_search("button_text_color", $setting_keys);
	    $button_text_color = $album_css[$index]->setting_value;
	
	    $index = array_search("filters_color", $setting_keys);
	    $filters_color = $album_css[$index]->setting_value;
	
	    $index = array_search("filters_text_color", $setting_keys);
	    $filters_text_color = $album_css[$index]->setting_value;
	
	    $index = array_search("album_seperator", $setting_keys);
	    $album_seperator = intval($album_css[$index]->setting_value);
	
	    $index = array_search("back_button_font_family", $setting_keys);
	    $back_button_font_family = $album_css[$index]->setting_value;
	
	    $index = array_search("back_button_font_size", $setting_keys);
	    $back_button_font_size = intval($album_css[$index]->setting_value);
	
	    $index = array_search("admin_full_control", $setting_keys);
	    $admin_full_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("admin_read_control", $setting_keys);
	    $admin_read_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("admin_write_control", $setting_keys);
	    $admin_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("editor_full_control", $setting_keys);
	    $editor_full_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("editor_read_control", $setting_keys);
	    $editor_read_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("editor_write_control", $setting_keys);
	    $editor_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("author_full_control", $setting_keys);
	    $author_full_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("author_read_control", $setting_keys);
	    $author_read_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("author_write_control", $setting_keys);
	    $author_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("contributor_full_control", $setting_keys);
	    $contributor_full_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("contributor_read_control", $setting_keys);
	    $contributor_read_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("contributor_write_control", $setting_keys);
	    $contributor_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("subscriber_full_control", $setting_keys);
	    $subscriber_full_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("subscriber_read_control", $setting_keys);
	    $subscriber_read_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("subscriber_write_control", $setting_keys);
	    $subscriber_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("subscriber_write_control", $setting_keys);
	    $subscriber_write_control = intval($album_css[$index]->setting_value);
	
	    $index = array_search("language_direction", $setting_keys);
	    $lang_dir_setting = $album_css[$index]->setting_value;
		
		$index = array_search("change_image_name", $setting_keys);
	    $change_image_name = $album_css[$index]->setting_value;
		
		$index = array_search("image_uploader", $setting_keys);
	    $image_uploader = $album_css[$index]->setting_value;
		
		$index = array_search("responsive_albums", $setting_keys);
	    $responsive_albums = $album_css[$index]->setting_value;
		
		$index = array_search("url_to_redirect", $setting_keys);
	    $url_to_redirect = $album_css[$index]->setting_value;
	    ?>
	    <!--suppress ALL -->
		<form id="frm_global_settings" class="layout-form" method="post">
			<div class="fluid-layout">
				<div class="layout-span12">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home"></i>
							<a href="admin.php?page=gallery_bank"><?php _e("Gallery Bank", gallery_bank); ?></a>
							<span class="divider">/</span>
							<a href="#"><?php _e("Global Settings", gallery_bank); ?></a>
						</li>
					</ul>
					<div class="widget-layout">
						<div class="widget-layout-title">
							<h4>
								<i class="icon-plus"></i>
								<?php _e("Global Settings", gallery_bank); ?>
							</h4>
						</div>
						<div class="widget-layout-body">
							<a class="btn btn-inverse" href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
							<a class="btn btn-danger" onclick="restore_factory();"><?php _e("Restore Settings", gallery_bank); ?></a>
							<button type="submit" class="btn btn-info" style="float:right"><?php _e("Update Settings", gallery_bank); ?></button>
							<div class="separator-doubled"></div>
							<div id="settings_success_message" class="custom-message green" style="display: none;">
								<span>
									<strong><?php _e("Settings has been updated.", gallery_bank); ?></strong>
								</span>
							</div>
							<div class="custom-message green" id="restore_success_message" style="display: none;">
								<span>
									<strong><?php _e("Success! Settings have been restored.", gallery_bank); ?></strong>
								</span>
							</div>
							<div class="fluid-layout">
								<div class="layout-span6">
									<div class="widget-layout">
										<div class="widget-layout-title">
											<h4><?php _e("Thumbnail Settings", gallery_bank); ?></h4>
											<span class="tools">
												<a data-target="#thumbnail_settings" data-toggle="collapse">
													<i class="icon-chevron-down"></i>
												</a>
											</span>
										</div>
										<div id="thumbnail_settings" class="collapse in">
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Thumbnail Size", gallery_bank); ?> : </label>
													<div class="layout-controls-radio">
														<?php
														if ($thumbnails_custom_enable == 1) {
															?>
															<input type="radio" name="ux_thumbnail" value="1" checked="checked"
															onclick="check_thumbnail_settings();"/> <label
															style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
															<input type="radio" style="margin-left: 10px;" name="ux_thumbnail" value="0"
															onclick="check_thumbnail_settings();"/><label style="vertical-align: baseline;">
															<?php _e("Custom", gallery_bank); ?> </label>
															<?php
														} else {
															?>
															<input type="radio" name="ux_thumbnail" value="1" onclick="check_thumbnail_settings();"/>
															<label style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
															<input type="radio" style="margin-left: 10px;" name="ux_thumbnail" checked="checked"
															value="0" onclick="check_thumbnail_settings();"/> <label style="vertical-align: baseline;">
															<?php _e("Custom", gallery_bank); ?></label>
															<?php
														}
														?>
													</div>
												</div>
											</div>
											<div class="widget-layout-body" id="image_width">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Width", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" id="ux_image_width" name="ux_image_width"
															onkeypress="return OnlyNumbers(event)" value="<?php echo $thumbnails_width; ?>"/>
															<span style="padding-top:3px;">(px)</span>
													</div>
												</div>
											</div>
											<div class="widget-layout-body" id="image_height">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Height", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" id="ux_image_height" name="ux_image_height"
														onkeypress="return OnlyNumbers(event)" class="layout-span10"
														value="<?php echo $thumbnails_height; ?>">
														<span style="padding-top:3px;">(px)</span>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"
													id="ux_label_thumb_opacity"><?php _e("Opacity", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" id="ux_image_opacity_val"
															onkeyup="set_value('thumb_opacity')" onblur="set_value('thumb_opacity')"
															name="ux_image_opacity_val" onkeypress="return OnlyNumbers(event)"
															value="<?php echo $thumbnails_opacity * 100; ?>"/>
															<span style="padding-top:3px;">(%)</span>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Border Size", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" id="ux_image_border_val" name="ux_image_border_val"
															onblur="set_value('thumb_border_size');" onkeyup="set_value('thumb_border_size');"
															onkeypress="return OnlyNumbers(event);" value="<?php echo $thumbnails_border_size; ?>"/>
														<span style="padding-top:3px;">(0 - 20)</span>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Border Radius", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" id="ux_image_radius_val" name="ux_image_radius_val"
															onblur="set_value('thumb_border_radius')" onkeyup="set_value('thumb_border_radius')"
															onkeypress="return OnlyNumbers(event)" value="<?php echo $thumbnails_border_radius; ?>"/>
															<span style="padding-top:3px;">(0 - 20)</span>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Border Color", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" name="ux_border_color" id="ux_border_color"
															onclick="ux_clr_border_color();"
															style="background-color: <?php echo $thumbnails_border_color; ?>;"
															value="<?php echo $thumbnails_border_color; ?>"/>
															<img onclick="ux_clr_border_color();" style="vertical-align: middle;margin-left: 5px;"
															src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
														<div id="clr_border_color"></div>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
							 					<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Margin Between Images", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" name="ux_images_margin" id="ux_images_margin"
															onkeypress="return OnlyNumbers(event)" value="<?php echo $margin_btw_thumbnails; ?>"/>
														(px)
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Text Color", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<input type="text" class="layout-span10" onclick="ux_clr_thumb_text_color();"
															name="ux_thumb_text_color" id="ux_thumb_text_color"
															style="background-color:<?php echo $thumbnail_text_color; ?>; "
															value="<?php echo $thumbnail_text_color; ?>"/>
															<img onclick="ux_clr_thumb_text_color();" style="vertical-align: middle;margin-left: 5px;"
															src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
															<div id="clr_thumb_text_color"></div>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Text-Align", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<select id="ux_thumb_text_align" class="layout-span10" name="ux_thumb_text_align">
															<option value="center">Center</option>
															<option value="inherit">Inherit</option>
															<option value="justify">Justify</option>
															<option value="left">Left</option>
															<option value="right">Right</option>
														</select>
													</div>
												</div>
											</div>
											<div class="widget-layout-body">
												<div class="layout-control-group">
													<label class="layout-control-label"><?php _e("Font-Family", gallery_bank); ?> : </label>
													<div class="layout-controls">
														<select id="ux_thumb_font_family" class="layout-span10" name="ux_thumb_font_family">
															<option value="Arial">Arial</option>
															<option value="Courier">Courier</option>
															<option value="Courier New">Courier New</option>
															<option value="Geneva">Geneva</option>
															<option value="Helvetica">Helvetica</option>
															<option value="inherit">inherit</option>
															<option value="Lucida Grande">Lucida Grande</option>
															<option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
															<option value="Monospace">Monospace</option>
															<option value="Sans-serif">Sans-serif</option>
															<option value="Tahoma">Tahoma</option>
															<option value="Times">Times</option>
															<option value="Times New Roman">Times New Roman</option>
															<option value="Verdana">Verdana</option>
														</select>
													</div>
												</div>
											</div>
								            <div class="widget-layout-body">
								                <div class="layout-control-group">
								                    <label class="layout-control-label"><?php _e("Heading Font-Size", gallery_bank); ?> : </label>
								                    <div class="layout-controls">
								                        <select id="ux_heading_font_size" class="layout-span10" name="ux_heading_font_size">
								                            <?php
								                            for ($heading_font = 8; $heading_font <= 24; $heading_font++) {
								                                ?>
								                                <option <?php if ($heading_font == $heading_font_size) echo "selected=\"selected\"" ?>
								                                    value="<?php echo $heading_font; ?>"><?php echo $heading_font; ?></option>
								                            <?php
								                            }
								                            ?>
								                        </select> (px)
								                    </div>
								                </div>
								            </div>
								            <div class="widget-layout-body">
								                <div class="layout-control-group">
								                    <label class="layout-control-label"><?php _e("Text Font-Size", gallery_bank); ?> : </label>
								                    <div class="layout-controls">
								                        <select id="ux_text_font_size" class="layout-span10" name="ux_text_font_size">
								                            <?php
								                            for ($font = 8; $font <= 15; $font++) {
								                                ?>
								                                <option <?php if ($font == $text_font_size) echo "selected=\"selected\"" ?>
								                                    value="<?php echo $font; ?>"><?php echo $font; ?></option>
								                            <?php
								                            }
								                            ?>
								                        </select> (px)
								                    </div>
								                </div>
								            </div>
								            <div class="widget-layout-body">
								                <div class="layout-control-group">
								                    <label class="layout-control-label"><?php _e("Description Length", gallery_bank); ?> : </label>
								                    <div class="layout-controls">
								                        <input type="text" id="ux_thumb_desc_length" class="layout-span10"
								                               onkeypress="return OnlyNumbers(event)" name="ux_thumb_desc_length"
								                               value="<?php echo $thumbnail_desc_length; ?>"/><label> (chars)</label>
								                    </div>
								                </div>
								            </div>
										</div>
									</div>
									<div class="widget-layout">
										<div class="widget-layout-title">
											<h4><?php _e("Album Cover Settings", gallery_bank); ?></h4>
											<span class="tools">
												<a data-target="#album_cover_settings" data-toggle="collapse">
													<i class="icon-chevron-down"></i>
												 </a>
											</span>
										</div>
									<div id="album_cover_settings" class="collapse in">
										<div class="widget-layout-body">
											<div class="layout-control-group">
												<label class="layout-control-label"><?php _e("Cover Size", gallery_bank); ?> : </label>
												<div class="layout-controls-radio">
													<?php
													if ($cover_custom_enable == 1) {
													?>
														<input type="radio" name="ux_cover_size" value="1" checked="checked"
															onclick="check_cover_settings();"/> <label
															style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
														<input type="radio" style="margin-left: 10px;" name="ux_cover_size" value="0"
															onclick="check_cover_settings();"/> <label
															style="vertical-align: baseline;"><?php _e("Custom", gallery_bank); ?></label>
													<?php
													} else {
														?>
														<input type="radio" name="ux_cover_size" value="1" onclick="check_cover_settings();"/>
														<label style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
														<input type="radio" style="margin-left: 10px;" name="ux_cover_size" checked="checked"
															value="0" onclick="check_cover_settings();"/> <label
															style="vertical-align: baseline;"><?php _e("Custom", gallery_bank); ?></label>
														<?php
													}
													?>
												</div>
											</div>
										</div>
							            <div class="widget-layout-body" id="cover_width">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Width", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_cover_width" name="ux_cover_width"
							                               onkeypress="return OnlyNumbers(event)" value="<?php echo $cover_thumbnail_width; ?>"/>
							                        <span style="padding-top:3px;">(px)</span>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body" id="cover_height">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Height", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" id="ux_cover_height" name="ux_cover_height"
						                               onkeypress="return OnlyNumbers(event)" class="layout-span10"
						                               value="<?php echo $cover_thumbnail_height; ?>">
							                        <span style="padding-top:3px;">(px)</span>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label" id="ux_label_cover_opacity"><?php _e("Opacity", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_cover_opacity_val" name="ux_cover_opacity_val"
							                               onblur="set_value('cover_opacity')" onkeyup="set_value('cover_opacity')"
							                               onkeypress="return OnlyNumbers(event)"
							                               value="<?php echo $cover_thumbnail_opacity * 100; ?>"/>
							                        <span style="padding-top:3px;">(%)</span>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Border Size", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_cover_border_val" name="ux_cover_border_val"
						                               onblur="set_value('cover_border_size')" onkeyup="set_value('cover_border_size')"
						                               onkeypress="return OnlyNumbers(event)"
						                               value="<?php echo $cover_thumbnail_border_size; ?>"/>
							                        <span style="padding-top:3px;">(0 - 20)</span>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Border Radius", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_cover_radius_val" name="ux_cover_radius_val"
						                               onblur="set_value('cover_border_radius')" onkeyup="set_value('cover_border_radius')"
						                               onkeypress="return OnlyNumbers(event)"
						                               value="<?php echo $cover_thumbnail_border_radius; ?>"/>
							                        <span style="padding-top:3px;">(0 - 20)</span>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Border Color", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" onclick="ux_clr_cover_border_color();"
							                               name="ux_cover_border_color" id="ux_cover_border_color"
							                               style="background-color:<?php echo $cover_thumbnail_border_color; ?>; "
							                               value="<?php echo $cover_thumbnail_border_color; ?>"/><img
							                            onclick="ux_clr_cover_border_color();" style="vertical-align: middle;margin-left: 5px;"
							                            src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
							                        <div id="clr_cover_border_color"></div>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Show Albums", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <?php
													if ($responsive_albums == 1) {
													?>
														<input type="radio" name="ux_responsive_albums" value="1" checked="checked" /> 
														<label style="vertical-align: baseline;"><?php _e("Responsive", gallery_bank); ?></label>
														<input type="radio" style="margin-left: 10px;" name="ux_responsive_albums" value="0"/> 
														<label
															style="vertical-align: baseline;"><?php _e("With Albums in Row", gallery_bank); ?></label>
													<?php
													} else {
														?>
														<input type="radio" name="ux_responsive_albums" value="1"/>
														<label style="vertical-align: baseline;"><?php _e("Responsive", gallery_bank); ?></label>
														<input type="radio" style="margin-left: 10px;" name="ux_responsive_albums" checked="checked"
															value="0"/> <label style="vertical-align: baseline;"><?php _e("With Albums in Row", gallery_bank); ?></label>
														<?php
													}
													?>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Margin Between Albums", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" name="ux_album_margin" id="ux_album_margin"
						                               onkeypress="return OnlyNumbers(event)"
						                               value="<?php echo $margin_btw_cover_thumbnails; ?>"/> (px)
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Text for Album Click", gallery_bank); ?> : </label>
							
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_album_view" name="ux_album_view"
							                               value="<?php echo $album_click_text; ?>"/>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Text Color", gallery_bank); ?> : </label>
							
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_album_text_color" name="ux_album_text_color"
							                               onclick="ux_clr_album_font_color();"
							                               style="background-color: <?php echo $album_text_color; ?>;"
							                               value="<?php echo $album_text_color; ?>"/><img onclick="ux_clr_album_font_color();"
							                                                                              style="vertical-align: middle;margin-left: 5px;"
							                                                                              src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
							
							                        <div id="clr_album_text_color"></div>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Text-Align", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_album_text_align" class="layout-span10" name="ux_album_text_align">
							                            <option value="center">Center</option>
							                            <option value="inherit">Inherit</option>
							                            <option value="justify">Justify</option>
							                            <option value="left">Left</option>
							                            <option value="right">Right</option>
							                        </select>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Font-Family", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_album_font_family" class="layout-span10" name="ux_album_font_family">
							                            <option value="Arial">Arial</option>
							                            <option value="Courier">Courier</option>
							                            <option value="Courier New">Courier New</option>
							                            <option value="Geneva">Geneva</option>
							                            <option value="Helvetica">Helvetica</option>
							                            <option value="inherit">inherit</option>
							                            <option value="Lucida Grande">Lucida Grande</option>
							                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
							                            <option value="Monospace">Monospace</option>
							                            <option value="Sans-serif">Sans-serif</option>
							                            <option value="Tahoma">Tahoma</option>
							                            <option value="Times">Times</option>
							                            <option value="Times New Roman">Times New Roman</option>
							                            <option value="Verdana">Verdana</option>
							                        </select>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Heading Font-Size", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_album_heading_font_size" class="layout-span10" name="ux_album_heading_font_size">
							                            <?php
							                            for ($album_heading = 8; $album_heading <= 24; $album_heading++) {
							                                ?>
							                                <option <?php if ($album_heading == $album_heading_font_size) echo "selected=\"selected\"" ?>
							                                    value="<?php echo $album_heading; ?>"><?php echo $album_heading; ?></option>
							                            <?php
							                            }
							                            ?>
							                        </select> (px)
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Text Font-Size", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_album_text_font_size" class="layout-span10" name="ux_album_text_font_size">
							                            <?php
							                            for ($albumfont = 8; $albumfont <= 15; $albumfont++) {
							                                ?>
							                                <option <?php if ($albumfont == $album_text_font_size) echo "selected=\"selected\"" ?>
							                                    value="<?php echo $albumfont; ?>"><?php echo $albumfont; ?></option>
							                            <?php
							                            }
							                            ?>
							                        </select> (px)
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Description Length", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" id="ux_album_desc_length" class="layout-span10"
						                               onkeypress="return OnlyNumbers(event)" name="ux_album_desc_length"
						                               value="<?php echo $album_desc_length; ?>"/><label> (chars)</label>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
		    					<div class="widget-layout">
		        					<div class="widget-layout-title">
		           						 <h4><?php _e("Filter Settings", gallery_bank); ?></h4>
										<span class="tools">
											<a data-target="#filter_settings" data-toggle="collapse">
		                                        <i class="icon-chevron-down"></i>
		                                    </a>
										</span>
		   							</div>
									<div id="filter_settings" class="collapse">
		            					<div class="widget-layout-body">
						                	<div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Filters", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($filters_setting == 1) {
							                            ?>
							                            <input type="radio" onclick="show_filter_page();" name="ux_image_filters" value="1"
							                                   checked="checked"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" onclick="show_filter_page();" style="margin-left: 10px;"
							                                   name="ux_image_filters" value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" onclick="show_filter_page();" name="ux_image_filters" value="1"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" onclick="show_filter_page();" style="margin-left: 10px;"
							                                   name="ux_image_filters" value="0" checked="checked"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
		            					<div id="ux_filter_setting_div" style="display:none;">
		                					<div class="widget-layout-body">
							                    <div class="layout-control-group">
							                        <label class="layout-control-label"><?php _e("Filter Color", gallery_bank); ?> : </label>
							                        <div class="layout-controls">
							                            <input type="text" class="layout-span10" id="ux_filter_color" name="ux_filter_color"
						                                   onclick="ux_clr_filter_color();"
						                                   style="background-color: <?php echo $filters_color; ?>;"
						                                   value="<?php echo $filters_color; ?>"/>
						                                   <img onclick="ux_clr_filter_color();" style="vertical-align: middle;margin-left: 5px;"
						                                    	src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
							                            <div id="clr_filter_color"></div>
							                        </div>
							                    </div>
							                </div>
							                <div class="widget-layout-body">
							                    <div class="layout-control-group">
							                        <label class="layout-control-label"><?php _e("Filter Text Color", gallery_bank); ?> : </label>
							                        <div class="layout-controls">
							                            <input type="text" class="layout-span10" id="ux_filter_text_color"
						                                   name="ux_filter_text_color" onclick="ux_clr_filter_text_color();"
						                                   style="background-color: <?php echo $filters_text_color; ?>;"
						                                   value="<?php echo $filters_text_color; ?>"/>
						                                   <img onclick="ux_clr_filter_text_color();" style="vertical-align: middle;margin-left: 5px;"
															src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
														<div id="clr_filter_text_color"></div>
							                        </div>
							                    </div>
							                </div>
							                <div class="widget-layout-body">
							                    <div class="layout-control-group">
							                        <label class="layout-control-label"><?php _e("Font-Family", gallery_bank); ?> : </label>
							                        <div class="layout-controls">
							                            <select id="ux_filter_font_family" class="layout-span10" name="ux_filter_font_family">
							                                <option value="Arial">Arial</option>
								                            <option value="Courier">Courier</option>
								                            <option value="Courier New">Courier New</option>
								                            <option value="Geneva">Geneva</option>
								                            <option value="Helvetica">Helvetica</option>
								                            <option value="inherit">inherit</option>
								                            <option value="Lucida Grande">Lucida Grande</option>
								                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
								                            <option value="Monospace">Monospace</option>
								                            <option value="Sans-serif">Sans-serif</option>
								                            <option value="Tahoma">Tahoma</option>
								                            <option value="Times">Times</option>
								                            <option value="Times New Roman">Times New Roman</option>
								                            <option value="Verdana">Verdana</option>
							                            </select>
							                        </div>
							                    </div>
							                </div>
							                <div class="widget-layout-body">
							                    <div class="layout-control-group">
							                        <label class="layout-control-label"><?php _e("Font-Size", gallery_bank); ?> : </label>
							                        <div class="layout-controls">
							                            <select id="ux_filter_font_size" class="layout-span10" name="ux_filter_font_size">
							                                <?php
							                                for ($filterfont = 8; $filterfont <= 15; $filterfont++) {
							                                    ?>
							                                    <option <?php if ($filterfont == $filter_font_size) echo "selected=\"selected\"" ?>
							                                        value="<?php echo $filterfont; ?>"><?php echo $filterfont; ?></option>
							                                <?php
							                                }
							                                ?>
							                            </select> (px)
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
		    					<div class="widget-layout">
							        <div class="widget-layout-title">
							            <h4><?php _e("Roles & Capabilities", gallery_bank); ?></h4>
											<span class="tools">
												<a data-target="#capabilities_settings" data-toggle="collapse">
			                                        <i class="icon-chevron-down"></i>
			                                    </a>
											</span>
							        </div>
				        			<div id="capabilities_settings" class="collapse">
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Privileges for Admin", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <input type="checkbox" id="ux_full_control_to_admin" onclick="disable_admin_checkbox(this);"
							                               name="ux_full_control_to_admin" value="1"/><label
							                            style="vertical-align: baseline;"><?php _e("Full Control", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_read_control_to_admin" name="ux_read_control_to_admin" value="1"
							                               style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Read", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_write_control_to_admin" name="ux_write_control_to_admin" value="1"
							                               style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Write", gallery_bank); ?></label>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Privileges for Editor", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <input type="checkbox" id="ux_full_control_to_editor" onclick="disable_admin_checkbox(this);"
							                               name="ux_full_control_to_editor" value="1"/><label
							                            style="vertical-align: baseline;"><?php _e("Full Control", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_read_control_to_editor" name="ux_read_control_to_editor" value="1"
							                               style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Read", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_write_control_to_editor" name="ux_write_control_to_editor"
							                               value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Write", gallery_bank); ?></label>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Privileges for Author", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <input type="checkbox" id="ux_full_control_to_author" onclick="disable_admin_checkbox(this);"
							                               name="ux_full_control_to_author" value="1"/><label
							                            style="vertical-align: baseline;"><?php _e("Full Control", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_read_control_to_author" name="ux_read_control_to_author" value="1"
							                               style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Read", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_write_control_to_author" name="ux_write_control_to_author"
							                               value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Write", gallery_bank); ?></label>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Privileges for Contributor", gallery_bank); ?>
							                        : </label>
							                    <div class="layout-controls-radio">
							                        <input type="checkbox" id="ux_full_control_to_contributor"
							                               onclick="disable_admin_checkbox(this);" name="ux_full_control_to_contributor" value="1"/><label
							                            style="vertical-align: baseline;"><?php _e("Full Control", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_read_control_to_contributor" name="ux_read_control_to_contributor"
							                               value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Read", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_write_control_to_contributor"
							                               name="ux_write_control_to_contributor" value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Write", gallery_bank); ?></label>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Privileges for Subscriber", gallery_bank); ?>
							                        : </label>
							                    <div class="layout-controls-radio">
							                        <input type="checkbox" id="ux_full_control_to_subscriber"
							                               onclick="disable_admin_checkbox(this);" name="ux_full_control_to_subscriber"
							                               value="1"/><label
							                            style="vertical-align: baseline;"><?php _e("Full Control", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_read_control_to_subscriber" name="ux_read_control_to_subscriber"
							                               value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Read", gallery_bank); ?></label>
							                        <input type="checkbox" id="ux_write_control_to_subscriber" name="ux_write_control_to_subscriber"
							                               value="1" style="margin-left: 10px;"/><label
							                            style="vertical-align: baseline;"><?php _e("Write", gallery_bank); ?></label>
							                    </div>
							                </div>
							            </div>
							        </div>
								</div>
							</div>
							<div class="layout-span6">
								<div class="widget-layout">
									<div class="widget-layout-title">
										<h4><?php _e("Lightbox Settings", gallery_bank); ?></h4>
											<span class="tools">
												<a data-target="#lightbox_settings" data-toggle="collapse">
		                                            <i class="icon-chevron-down"></i>
		                                        </a>
											</span>
									</div>
									<div id="lightbox_settings" class="collapse in">
										<div class="widget-layout-body">
											<div class="layout-control-group">
												<label class="layout-control-label"><?php _e("Lightbox Type", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <select class="layout-span10" id="ux_lightbox_type" name="ux_lightbox_type">
									                    <option value="pretty_photo">
									                        Pretty Photo
									                    </option>
									                    <option value="color_box">
									                        Color Box
									                    </option>
									                    <option value="photo_swipe">
									                        Photo Swipe
									                    </option>
									                    <?php
								                    	if($foobox == "yes")
														{
															?>
															<option value="foo_box" >
																Foo Box 
															</option>
															<?php
														}
														elseif($foobox == "Foobox Free Edition")
														{
															?>
															<option value="foo_box" >
																<?php
																echo $foobox;
																?>
															</option>
															<?php
														}
														else
														{
															?>
															<option disabled="disabled" value="foo_box" style="color: #FF0000;">
																Foo Box (Purchase FooBox Plugin seperately)
															</option>
															<?php
														}
								                    	?>
									                    <option value="fancy_box">
									                        Fancy Box
									                    </option>
									                    <option value="lightbox2">
									                        Lightbox 2
									                    </option>
									                    <option value="GB_lightbox">
									                        GB Lightbox
									                    </option>
									                </select>
									            </div>
											</div>
										</div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Opacity", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" id="ux_lightbox_opacity_val" name="ux_lightbox_opacity_val"
								                       onblur="set_value('lightbox_opacity')" onkeyup="set_value('lightbox_opacity')"
								                       onkeypress="return OnlyNumbers(event)" value="<?php echo $lightbox_overlay_opacity * 100; ?>"/>
									                <span style="padding-top:3px;">(%)</span>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Border Size", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" id="ux_lightbox_border_val" name="ux_lightbox_border_val"
									                       onblur="set_value('lightbox_border')" onkeyup="set_value('lightbox_border')"
									                       onkeypress="return OnlyNumbers(event)" value="<?php echo $lightbox_overlay_border_size; ?>"/>
									                <span style="padding-top:3px;">(0 - 20)</span>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Border Radius", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" id="ux_lightbox_radius_val" name="ux_lightbox_radius_val"
									                       onblur="set_value('lightbox_radius');" onkeyup="set_value('lightbox_radius');"
									                       onkeypress="return OnlyNumbers(event);" value="<?php echo $lightbox_overlay_border_radius; ?>"/>
									                <span style="padding-top:3px;">(0 - 20)</span>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Text Color", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_lightbox_text_color" id="ux_lightbox_text_color"
									                   onclick="ux_clr_lightbox_text_color();"
									                   style="background-color: <?php echo $lightbox_text_color; ?>;"
									                   value="<?php echo $lightbox_text_color; ?>"/>
									                   <img onclick="ux_clr_lightbox_text_color();" style="vertical-align: middle;margin-left: 5px;"
									                     src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
									                <div id="clr_lightbox_text_color"></div>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Border Color", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_overlay_border_color"
									                       onclick="ux_clr_overlay_border_color();" id="ux_overlay_border_color"
									                       style="background-color: <?php echo $lightbox_overlay_border_color; ?>"
									                       value="<?php echo $lightbox_overlay_border_color; ?>"/><img
									                    onclick="ux_clr_overlay_border_color();" style="vertical-align: middle;margin-left: 5px;"
									                    src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
									                <div id="clr_overlay_border_color"></div>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Inline Background", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_inline_overlay_color" id="ux_inline_overlay_color"
								                       onclick="ux_clr_inline_overlay_color();"
								                       style="background-color: <?php echo $lightbox_inline_bg_color; ?>;"
								                       value="<?php echo $lightbox_inline_bg_color; ?>"/>
								                       <img onclick="ux_clr_inline_overlay_color();" style="vertical-align: middle;margin-left: 5px;"
								                         src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
									                <div id="clr_inline_overlay_color"></div>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Overlay Background", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_overlay_bg_color" id="ux_overlay_bg_color"
									                   onclick="ux_clr_overlay_bg_color();"
									                   style="background-color: <?php echo $lightbox_overlay_bg_color; ?>;"
									                   value="<?php echo $lightbox_overlay_bg_color; ?>"/>
									                   <img onclick="ux_clr_overlay_bg_color();"  style="vertical-align: middle;margin-left: 5px;"
									                    src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
									            	<div id="clr_overlay_bg_color"></div>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Fade In Time", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_fade_in_time" id="ux_fade_in_time"
									                  onkeypress="return OnlyNumbers(event)" value="<?php echo $lightbox_fade_in_time; ?>"/>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Fade Out Time", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <input type="text" class="layout-span10" name="ux_fade_out_time" id="ux_fade_out_time"
									                  onkeypress="return OnlyNumbers(event)" value="<?php echo $lightbox_fade_out_time; ?>"/>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Text-Align", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <select id="ux_lightbox_text_align" class="layout-span10" name="ux_lightbox_text_align">
									                    <option value="center">Center</option>
									                    <option value="inherit">Inherit</option>
									                    <option value="justify">Justify</option>
									                    <option value="left">Left</option>
									                    <option value="right">Right</option>
									                </select>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Font-Family", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <select id="ux_lightbox_font_family" class="layout-span10" name="ux_lightbox_font_family">
									                    <option value="Arial">Arial</option>
							                            <option value="Courier">Courier</option>
							                            <option value="Courier New">Courier New</option>
							                            <option value="Geneva">Geneva</option>
							                            <option value="Helvetica">Helvetica</option>
							                            <option value="inherit">inherit</option>
							                            <option value="Lucida Grande">Lucida Grande</option>
							                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
							                            <option value="Monospace">Monospace</option>
							                            <option value="Sans-serif">Sans-serif</option>
							                            <option value="Tahoma">Tahoma</option>
							                            <option value="Times">Times</option>
							                            <option value="Times New Roman">Times New Roman</option>
							                            <option value="Verdana">Verdana</option>
									                </select>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Heading Font-Size", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <select id="ux_lightbox_heading_font_size" class="layout-span10" name="ux_lightbox_heading_font_size">
									                    <?php
									                    for ($lightbox_heading_font = 8; $lightbox_heading_font <= 24; $lightbox_heading_font++) {
									                        ?>
									                        <option <?php if ($lightbox_heading_font == $lightbox_heading_font_size) echo "selected=\"selected\"" ?>
									                            value="<?php echo $lightbox_heading_font; ?>"><?php echo $lightbox_heading_font; ?></option>
									                    <?php
									                    }
									                    ?>
									                </select> (px)
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Text Font-Size", gallery_bank); ?> : </label>
									            <div class="layout-controls">
									                <select id="ux_lightbox_text_font_size" class="layout-span10" name="ux_lightbox_text_font_size">
									                    <?php
									                    for ($lightboxfont = 8; $lightboxfont <= 15; $lightboxfont++) {
									                        ?>
									                        <option <?php if ($lightboxfont == $lightbox_text_font_size) echo "selected=\"selected\"" ?>
									                            value="<?php echo $lightboxfont; ?>"><?php echo $lightboxfont; ?></option>
									                    <?php
									                    }
									                    ?>
									                </select> (px)
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Facebook Comments", gallery_bank); ?> : </label>
									            <div class="layout-controls-radio">
									                <?php
									                if ($facebook_comments == 1) {
									                    ?>
									                    <input type="radio" name="ux_facebook" value="1" checked="checked"
									                           onclick="disable_lightbox_type();"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_facebook"
									                           onclick="disable_lightbox_type();" value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                } else {
									                    ?>
									                    <input type="radio" name="ux_facebook" value="1" onclick="disable_lightbox_type();"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_facebook"
									                           onclick="disable_lightbox_type();" checked="checked" value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                }
									                ?>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Social Sharing", gallery_bank); ?> : </label>
									            <div class="layout-controls-radio">
									                <?php
									                if ($social_sharing == 1) {
									                    ?>
									                    <input onclick="disable_lightbox();" type="radio" name="ux_social_sharing" value="1" checked="checked"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input onclick="disable_lightbox();" type="radio" style="margin-left: 10px;" name="ux_social_sharing" value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                } else {
									                    ?>
									                    <input onclick="disable_lightbox();" type="radio" name="ux_social_sharing" value="1"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input onclick="disable_lightbox();" type="radio" style="margin-left: 10px;" name="ux_social_sharing" checked="checked"
									                           value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                }
									                ?>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Image Title", gallery_bank); ?> : </label>
									            <div class="layout-controls-radio">
									                <?php
									                if ($image_title_setting == 1) {
									                    ?>
									                    <input type="radio" name="ux_image_title" value="1" checked="checked"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_image_title" value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                } else {
									                    ?>
									                    <input type="radio" name="ux_image_title" value="1"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_image_title" checked="checked" value="0"/>
									                    <label style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                }
									                ?>
									            </div>
									        </div>
									    </div>
									    <div class="widget-layout-body">
									        <div class="layout-control-group">
									            <label class="layout-control-label"><?php _e("Image Description", gallery_bank); ?> : </label>
									            <div class="layout-controls-radio">
									                <?php
									                if ($image_desc_setting == 1) {
									                    ?>
									                    <input type="radio" name="ux_image_desc" value="1" checked="checked"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_image_desc" value="0"/> <label
									                        style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                } else {
									                    ?>
									                    <input type="radio" name="ux_image_desc" value="1"/> <label
									                        style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
									                    <input type="radio" style="margin-left: 10px;" name="ux_image_desc" checked="checked" value="0"/>
									                    <label style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
									                <?php
									                }
									                ?>
									            </div>
									        </div>
									    </div>
									</div>
								</div>
								<div class="widget-layout">
							        <div class="widget-layout-title">
							            <h4><?php _e("Image Uploader Settings", gallery_bank); ?></h4>
										<span class="tools">
											<a data-target="#img_uploader_settings" data-toggle="collapse">
		                                        <i class="icon-chevron-down"></i>
		                                    </a>
										</span>
							        </div>
							        <div id="img_uploader_settings" class="collapse in">
							           <div class="widget-layout-body" >
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Uploader for Images", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($image_uploader == 1) {
							                            ?>
							                            <input type="radio" name="ux_uploader" id="ux_pl_uploader" value="1" checked="checked" onclick="change_image_name();" /> 
							                            	<label style="vertical-align: baseline;"><?php _e("Gallery Bank", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;"  name="ux_uploader" id="ux_wp_uploader" value="0" onclick="change_image_name();" />
							                            	<label style="vertical-align: baseline;"><?php _e("WP Media", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_uploader" id="ux_pl_uploader" value="1" onclick="change_image_name();"/> <label
							                                style="vertical-align: baseline;"><?php _e("Gallery Bank", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" id="ux_wp_uploader" name="ux_uploader" checked="checked"
							                                   value="0" onclick="change_image_name();"/> <label
							                                style="vertical-align: baseline;"><?php _e("WP Media", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body" id="display_image_name_div">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Change Uploading Image Name", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($change_image_name == 1) {
							                            ?>
							                            <input type="radio" name="ux_upload_image" value="1" checked="checked" /> 
							                            	<label style="vertical-align: baseline;"><?php _e("Default", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_upload_image" value="0" />
							                            	<label style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_upload_image" value="1"/> <label
							                                style="vertical-align: baseline;"><?php _e("Default", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_upload_image" checked="checked"
							                                   value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Original", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							           </div>
							        </div>
		    					</div>
		    					<div class="widget-layout">
									<div class="widget-layout-title">
										<h4><?php _e("Front - End Layout Settings", gallery_bank); ?></h4>
											<span class="tools">
												<a data-target="#frontend_settings" data-toggle="collapse">
		                                            <i class="icon-chevron-down"></i>
		                                        </a>
											</span>
									</div>
		        					<div id="frontend_settings" class="collapse">
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Text for Back Button", gallery_bank); ?> : </label>
							
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_back_button" name="ux_back_button"
							                               value="<?php echo $back_button_text; ?>"/>
							                    </div>
							                </div>
							            </div>
		            					<div class="widget-layout-body">
		                					<div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Button Color", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_button_color" name="ux_button_color"
						                               onclick="ux_clr_button_color();" style="background-color: <?php echo $button_color; ?>;"
						                               value="<?php echo $button_color; ?>"/>
						                               <img onclick="ux_clr_button_color();" style="vertical-align: middle;margin-left: 5px;"
						                                 src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
													<div id="clr_button_color"></div>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Button Text Color", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_button_text_color" name="ux_button_text_color"
						                               onclick="ux_clr_button_text_color();"
						                               style="background-color: <?php echo $button_text_color; ?>;"
						                               value="<?php echo $button_text_color; ?>"/>
						                               <img onclick="ux_clr_button_text_color();" style="vertical-align: middle;margin-left: 5px;"
							                            src="<?php echo plugins_url("/assets/images/color.png",dirname(__FILE__)) ?>"/>
							                        <div id="clr_button_text_color"></div>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Font-Family", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_button_font_family" class="layout-span10" name="ux_button_font_family">
							                            <option value="Arial">Arial</option>
							                            <option value="Courier">Courier</option>
							                            <option value="Courier New">Courier New</option>
							                            <option value="Geneva">Geneva</option>
							                            <option value="Helvetica">Helvetica</option>
							                            <option value="inherit">inherit</option>
							                            <option value="Lucida Grande">Lucida Grande</option>
							                            <option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
							                            <option value="Monospace">Monospace</option>
							                            <option value="Sans-serif">Sans-serif</option>
							                            <option value="Tahoma">Tahoma</option>
							                            <option value="Times">Times</option>
							                            <option value="Times New Roman">Times New Roman</option>
							                            <option value="Verdana">Verdana</option>
							                        </select>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Font-Size", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <select id="ux_button_font_size" class="layout-span10" name="ux_button_font_size">
							                            <?php
							                            for ($buttonfont = 8; $buttonfont <= 15; $buttonfont++) {
							                                ?>
							                                <option <?php if ($buttonfont == $back_button_font_size) echo "selected=\"selected\"" ?>
							                                    value="<?php echo $buttonfont; ?>"><?php echo $buttonfont; ?></option>
							                            <?php
							                            }
							                            ?>
							                        </select> (px)
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Album Seperator", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($album_seperator == 1) {
							                            ?>
							                            <input type="radio" name="ux_seperator" value="1" checked="checked"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_seperator" value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_seperator" value="1"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_seperator" checked="checked"
							                                   value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Image url location", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($url_to_redirect == 1) {
							                            ?>
							                            <input type="radio" name="ux_url_redirect" value="1" checked="checked"/> <label
							                                style="vertical-align: baseline;"><?php _e("Open in New Window", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_url_redirect" value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Same Window", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_url_redirect" value="1"/> <label
							                                style="vertical-align: baseline;"><?php _e("Open in New Window", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_url_redirect" checked="checked"
							                                   value="0"/> <label
							                                style="vertical-align: baseline;"><?php _e("Same Window", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
		        					</div>
		    					</div>
		    					<div class="widget-layout">
							        <div class="widget-layout-title">
							            <h4><?php _e("Pagination Settings for Images", gallery_bank); ?></h4>
										<span class="tools">
											<a data-target="#pagination_settings" data-toggle="collapse">
		                                        <i class="icon-chevron-down"></i>
		                                    </a>
										</span>
							        </div>
							        <div id="pagination_settings" class="collapse">
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Paging", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($pagination_setting == 1) {
							                            ?>
							                            <input type="radio" name="ux_images_paging" value="1" checked="checked"
							                                   onclick="show_images_per_page()"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_images_paging" value="0"
							                                   onclick="show_images_per_page()"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_images_paging" value="1" onclick="show_images_per_page()"/>
							                            <label style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_images_paging" value="0"
							                                   checked="checked" onclick="show_images_per_page()"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body" id="ux_images_per_page_div" style="display: none;">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("No. of Images Per Page ", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_images_per_page_val"
						                               name="ux_images_per_page_val" onblur="set_value('images_per_page')"
						                               onkeypress="return OnlyNumbers(event)" value="<?php echo $images_per_page; ?>"/>
							                    </div>
							                </div>
							            </div>
							        </div>
		    					</div>
		    					<div class="widget-layout">
							        <div class="widget-layout-title">
							            <h4><?php _e("Slide Show Settings", gallery_bank); ?></h4>
										<span class="tools">
											<a data-target="#slideshow_settings" data-toggle="collapse">
				                                <i class="icon-chevron-down"></i>
				                            </a>
										</span>
							        </div>
							        <div id="slideshow_settings" class="collapse">
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Auto Play", gallery_bank); ?> : </label>
							                    <div class="layout-controls-radio">
							                        <?php
							                        if ($autoplay_setting == 1) {
							                            ?>
							                            <input type="radio" name="ux_slideshow" value="1" checked="checked"
							                                   onclick="show_slide_interval();"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_slideshow" value="0"
							                                   onclick="show_slide_interval();"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        } else {
							                            ?>
							                            <input type="radio" name="ux_slideshow" value="1" onclick="show_slide_interval();"/> <label
							                                style="vertical-align: baseline;"><?php _e("Enable", gallery_bank); ?></label>
							                            <input type="radio" style="margin-left: 10px;" name="ux_slideshow" checked="checked"
							                                   value="0" onclick="show_slide_interval();"/> <label
							                                style="vertical-align: baseline;"><?php _e("Disable", gallery_bank); ?></label>
							                        <?php
							                        }
							                        ?>
							                    </div>
							                </div>
							            </div>
							            <div class="widget-layout-body" id="ux_slide_interval_div">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Interval", gallery_bank); ?> : </label>
							                    <div class="layout-controls">
							                        <input type="text" class="layout-span10" id="ux_slide_val" name="ux_slide_val"
						                               onblur="set_value('slide');" onkeyup="set_value('slide');"
						                               onkeypress="return OnlyNumbers(event);" value="<?php echo $slide_interval; ?>"/>
							                        <span style="padding-top:3px;">(0 - 15)</span>
							                    </div>
							                </div>
							            </div>
							        </div>
							    </div>
		    					<div class="widget-layout">
							        <div class="widget-layout-title">
							            <h4><?php _e("Language Direction Settings", gallery_bank); ?></h4>
										<span class="tools">
											<a data-target="#lang_dir_settings" data-toggle="collapse">
		                                        <i class="icon-chevron-down"></i>
		                                    </a>
										</span>
							        </div>
							        <div id="lang_dir_settings" class="collapse">
							            <div class="widget-layout-body">
							                <div class="layout-control-group">
							                    <label class="layout-control-label"><?php _e("Language Direction", gallery_bank); ?> : </label>
							                    <select id="ux_lang_dir" class="layout-span8" name="ux_lang_dir">
							                        <option value="inherit">Default</option>
							                        <option value="rtl">Right to Left</option>
							                        <option value="ltr">Left to Right</option>
							                    </select>
							                </div>
							            </div>
							        </div>
		    					</div>
		    				</div>
		    			</div>
		    			<div class="separator-doubled"></div>
		    			<button type="submit" class="btn btn-info" style="float:right;margin-top: 20px; "><?php _e("Update Settings", gallery_bank); ?></button>
		    			<a class="btn btn-inverse" href="admin.php?page=gallery_bank"
							style="margin-top: 20px;"><?php _e("Back to Albums", gallery_bank); ?></a>
						</div>
	    			</div>
	    		</div>
	    	</div>
	    </form>
	    <script type="text/javascript">
	    var settings_array = [];
	    jQuery(document).ready(function () {
	        check_thumbnail_settings();
	        check_cover_settings();
	        show_slide_interval();
	        disable_lightbox_type();
	        disable_lightbox();
	        show_albums_per_page();
	        show_images_per_page();
	        show_filter_page();
	        change_image_name();
	        <?php
	        if($wp_version <= 3.5)
			{
				?>
				jQuery("#ux_wp_uploader").attr("disabled", "disabled");
				<?php
			}
	        if($admin_full_control == 1)
	        {
	            ?>
			        jQuery("#ux_full_control_to_admin").prop("checked", "checked");
			        jQuery("#ux_read_control_to_admin").prop("checked", "checked");
			        jQuery("#ux_read_control_to_admin").attr("disabled", "disabled");
			        jQuery("#ux_write_control_to_admin").prop("checked", "checked");
			        jQuery("#ux_write_control_to_admin").attr("disabled", "disabled");
			        <?php
	    	}
		    if($admin_read_control == 1)
		    {
		        ?>
		        jQuery("#ux_read_control_to_admin").prop("checked", "checked");
		        <?php
		    }
		    if($admin_write_control == 1)
		    {
		        ?>
		        jQuery("#ux_write_control_to_admin").prop("checked", "checked");
		        <?php
		    }
		    if($editor_full_control == 1)
		    {
		        ?>
		        jQuery("#ux_full_control_to_editor").prop("checked", "checked");
		        jQuery("#ux_read_control_to_editor").prop("checked", "checked");
		        jQuery("#ux_read_control_to_editor").attr("disabled", "disabled");
		        jQuery("#ux_write_control_to_editor").prop("checked", "checked");
		        jQuery("#ux_write_control_to_editor").attr("disabled", "disabled");
		        <?php
		    }
		    if($editor_read_control == 1)
		    {
		        ?>
		        jQuery("#ux_read_control_to_editor").prop("checked", "checked");
		        <?php
		    }
		    if($editor_write_control == 1)
		    {
		        ?>
		        jQuery("#ux_write_control_to_editor").prop("checked", "checked");
		        <?php
		    }
		    if($author_full_control == 1)
		    {
		        ?>
		        jQuery("#ux_full_control_to_author").prop("checked", "checked");
		        jQuery("#ux_read_control_to_author").prop("checked", "checked");
		        jQuery("#ux_read_control_to_author").attr("disabled", "disabled");
		        jQuery("#ux_write_control_to_author").prop("checked", "checked");
		        jQuery("#ux_write_control_to_author").attr("disabled", "disabled");
		        <?php
		    }
		    if($author_read_control == 1)
		    {
		        ?>
		        jQuery("#ux_read_control_to_author").prop("checked", "checked");
		        <?php
		    }
		    if($author_write_control == 1)
		    {
		        ?>
		        jQuery("#ux_write_control_to_author").prop("checked", "checked");
		        <?php
		    }
		    if($contributor_full_control == 1)
		    {
		        ?>
		        jQuery("#ux_full_control_to_contributor").prop("checked", "checked");
		        jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
		        jQuery("#ux_read_control_to_contributor").attr("disabled", "disabled");
		        jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
		        jQuery("#ux_write_control_to_contributor").attr("disabled", "disabled");
		        <?php
		    }
		    if($contributor_read_control == 1)
		    {
		        ?>
		        jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
		        <?php
		    }
		    if($contributor_write_control == 1)
		    {
		        ?>
		        jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
		        <?php
		    }
		    if($subscriber_full_control == 1)
		    {
		        ?>
		        jQuery("#ux_full_control_to_subscriber").prop("checked", "checked");
		        jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
		        jQuery("#ux_read_control_to_subscriber").attr("disabled", "disabled");
		        jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
		        jQuery("#ux_write_control_to_subscriber").attr("disabled", "disabled");
		        <?php
		    }
		    if($subscriber_read_control == 1)
		    {
		        ?>
		        jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
		        <?php
		    }
		    if($subscriber_write_control == 1)
		    {
		        ?>
		        jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
		        <?php
		    }
		    ?>
		        jQuery("#ux_lightbox_type").val("<?php echo $lightbox_type;?>");
		        jQuery("#ux_thumb_text_align").val("<?php echo $thumbnail_text_align;?>");
		        jQuery("#ux_thumb_font_family").val("<?php echo $thumbnail_font_family;?>");
		        jQuery("#ux_album_text_align").val("<?php echo $album_text_align;?>");
		        jQuery("#ux_album_font_family").val("<?php echo $album_font_family;?>");
		        jQuery("#ux_filter_font_family").val("<?php echo $filter_font_family;?>");
		        jQuery("#ux_button_font_family").val("<?php echo $back_button_font_family;?>");
		        jQuery("#ux_lightbox_text_align").val("<?php echo $lightbox_text_align;?>");
		        jQuery("#ux_lightbox_font_family").val("<?php echo $lightbox_font_family;?>");
		        jQuery("#ux_lang_dir").val("<?php echo $lang_dir_setting;?>");
		});
		
		function change_image_name()
	    {
	    	var uploader = jQuery("input:radio[name=ux_uploader]:checked").val();
	        if (uploader == 1) {
	            jQuery("#display_image_name_div").css("display", "block");
	        } else {
	            jQuery("#display_image_name_div").css("display", "none");
	        }
	    }
		
	    function disable_admin_checkbox(control) {
	        var controlId = jQuery(control).attr("id");
	        var full_control = "";
	        switch (controlId) {
	            case "ux_full_control_to_admin":
	
	                full_control = jQuery("#ux_full_control_to_admin").prop("checked");
	                if (full_control == true) {
	                    jQuery("#ux_read_control_to_admin").prop("checked", "checked");
	                    jQuery("#ux_read_control_to_admin").attr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_admin").prop("checked", "checked");
	                    jQuery("#ux_write_control_to_admin").attr("disabled", "disabled");
	                }
	                else {
	                    jQuery("#ux_read_control_to_admin").prop("checked", false);
	                    jQuery("#ux_read_control_to_admin").removeAttr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_admin").prop("checked", false);
	                    jQuery("#ux_write_control_to_admin").removeAttr("disabled", "disabled");
	                }
	
	                break;
	            case "ux_full_control_to_editor":
	
	                full_control = jQuery("#ux_full_control_to_editor").prop("checked");
	                if (full_control == true) {
	                    jQuery("#ux_read_control_to_editor").prop("checked", "checked");
	                    jQuery("#ux_read_control_to_editor").attr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_editor").prop("checked", "checked");
	                    jQuery("#ux_write_control_to_editor").attr("disabled", "disabled");
	                }
	                else {
	                    jQuery("#ux_read_control_to_editor").prop("checked", false);
	                    jQuery("#ux_read_control_to_editor").removeAttr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_editor").prop("checked", false);
	                    jQuery("#ux_write_control_to_editor").removeAttr("disabled", "disabled");
	                }
	
	                break;
	            case "ux_full_control_to_author":
	
	                full_control = jQuery("#ux_full_control_to_author").prop("checked");
	                if (full_control == true) {
	                    jQuery("#ux_read_control_to_author").prop("checked", "checked");
	                    jQuery("#ux_read_control_to_author").attr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_author").prop("checked", "checked");
	                    jQuery("#ux_write_control_to_author").attr("disabled", "disabled");
	                }
	                else {
	                    jQuery("#ux_read_control_to_author").prop("checked", false);
	                    jQuery("#ux_read_control_to_author").removeAttr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_author").prop("checked", false);
	                    jQuery("#ux_write_control_to_author").removeAttr("disabled", "disabled");
	                }
	
	                break;
	            case "ux_full_control_to_contributor":
	
	                full_control = jQuery("#ux_full_control_to_contributor").prop("checked");
	                if (full_control == true) {
	                    jQuery("#ux_read_control_to_contributor").prop("checked", "checked");
	                    jQuery("#ux_read_control_to_contributor").attr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_contributor").prop("checked", "checked");
	                    jQuery("#ux_write_control_to_contributor").attr("disabled", "disabled");
	                }
	                else {
	                    jQuery("#ux_read_control_to_contributor").prop("checked", false);
	                    jQuery("#ux_read_control_to_contributor").removeAttr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_contributor").prop("checked", false);
	                    jQuery("#ux_write_control_to_contributor").removeAttr("disabled", "disabled");
	                }
	
	                break;
	            case "ux_full_control_to_subscriber":
	
	                full_control = jQuery("#ux_full_control_to_subscriber").prop("checked");
	                if (full_control == true) {
	                    jQuery("#ux_read_control_to_subscriber").prop("checked", "checked");
	                    jQuery("#ux_read_control_to_subscriber").attr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_subscriber").prop("checked", "checked");
	                    jQuery("#ux_write_control_to_subscriber").attr("disabled", "disabled");
	                }
	                else {
	                    jQuery("#ux_read_control_to_subscriber").prop("checked", false);
	                    jQuery("#ux_read_control_to_subscriber").removeAttr("disabled", "disabled");
	                    jQuery("#ux_write_control_to_subscriber").prop("checked", false);
	                    jQuery("#ux_write_control_to_subscriber").removeAttr("disabled", "disabled");
	                }
	
	                break;
	        }
	    }
	    function check_thumbnail_settings() {
	        var thumb_setting = jQuery("input:radio[name=ux_thumbnail]:checked").val();
	        if (thumb_setting != 0) {
	            jQuery("#image_width").css("display", "none");
	            jQuery("#image_height").css("display", "none");
	        } else {
	            jQuery("#image_width").css("display", "block");
	            jQuery("#image_height").css("display", "block");
	        }
	    }
	    function show_albums_per_page() {
	        var album_paging = jQuery("input:radio[name=ux_album_paging]:checked").val();
	        if (album_paging != 1) {
	            jQuery("#ux_album_per_page_div").css("display", "none");
	        } else {
	            jQuery("#ux_album_per_page_div").css("display", "block");
	        }
	    }
	    function show_images_per_page() {
	        var images_paging = jQuery("input:radio[name=ux_images_paging]:checked").val();
	        if (images_paging == 1) {
	            jQuery("#ux_images_per_page_div").css("display", "block");
	        }
	        else {
	            jQuery("#ux_images_per_page_div").css("display", "none");
	        }
	    }
	    function check_cover_settings() {
	        var cover_setting = jQuery("input:radio[name=ux_cover_size]:checked").val();
	        if (cover_setting == 0) {
	            jQuery("#cover_width").css("display", "block");
	            jQuery("#cover_height").css("display", "block");
	        }
	        else {
	            jQuery("#cover_width").css("display", "none");
	            jQuery("#cover_height").css("display", "none");
	        }
	    }
	    function disable_lightbox_type() {
	        var facebook_enable = jQuery("input:radio[name=ux_facebook]:checked").val();
	        if (facebook_enable != 1 ) {
	            jQuery("#ux_lightbox_type").removeAttr("disabled", "disabled");
	        } else {
	            jQuery("#ux_lightbox_type").val("GB_lightbox");
	            jQuery("#ux_lightbox_type").attr("disabled", "disabled");
	        }
	    }
	    function disable_lightbox() {
	        var social_enable = jQuery("input:radio[name=ux_social_sharing]:checked").val();
	        if (social_enable != 1 ) {
	            jQuery("#ux_lightbox_type").removeAttr("disabled", "disabled");
	        } else {
	            jQuery("#ux_lightbox_type").val("GB_lightbox");
	            jQuery("#ux_lightbox_type").attr("disabled", "disabled");
	        }
	    }
	    function show_slide_interval() {
	        var slideshow_enable = jQuery("input:radio[name=ux_slideshow]:checked").val();
	        if (slideshow_enable != 1) {
	            jQuery("#ux_slide_interval_div").css("display", "none");
	        } else {
	            jQuery("#ux_slide_interval_div").css("display", "block");
	        }
	    }
	    function show_filter_page() {
	        var filter_enable = jQuery("input:radio[name=ux_image_filters]:checked").val();
	        if (filter_enable != 1) {
	            jQuery("#ux_filter_setting_div").css("display", "none");
	        } else {
	            jQuery("#ux_filter_setting_div").css("display", "block");
	        }
	    }
	    function restore_factory() {
	        var r = confirm("<?php _e("Are you sure you want to restore settings?", gallery_bank ); ?>");
	        if (r == true) {
	            jQuery.post(ajaxurl, "&param=restore_settings&action=settings_gallery_library", function (data) {
	                jQuery("#restore_success_message").css("display", "block");
	                setTimeout(function () {
	                    jQuery("#restore_success_message").css("display", "none");
	                    window.location.href = "admin.php?page=global_settings";
	                }, 2000);
	            });
	        }
	    }
	    /**
	     * @return {boolean}
	     */
	    function OnlyNumbers(evt) {
	        var charCode = (evt.which) ? evt.which : event.keyCode;
	        return (charCode > 47 && charCode < 58) || charCode == 127 || charCode == 8;
	    }
	    function set_value(text_type) {
	        var val = "";
	        switch (text_type) {
	            case  "thumb_opacity":
	
	                val = jQuery("#ux_image_opacity_val").val();
	                if (val <= 100) {
	                    if (val > 0) {
	                        jQuery("#ux_image_opacity_val").val(jQuery("#ux_image_opacity_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_image_opacity_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_image_opacity_val").val(100);
	                }
	
	                break;
	            case "thumb_border_size":
	
	                val = jQuery("#ux_image_border_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_image_border_val").val(jQuery("#ux_image_border_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_image_border_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_image_border_val").val(20);
	                }
	
	                break;
	            case "thumb_border_radius":
	
	                val = jQuery("#ux_image_radius_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_image_radius_val").val(jQuery("#ux_image_radius_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_image_radius_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_image_radius_val").val(20);
	                }
	
	                break;
	            case "cover_opacity":
	
	                val = jQuery("#ux_cover_opacity_val").val();
	                if (val <= 100) {
	                    if (val > 0) {
	                        jQuery("#ux_cover_opacity_val").val(jQuery("#ux_cover_opacity_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_cover_opacity_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_cover_opacity_val").val(100);
	                }
	
	                break;
	            case "cover_border_size":
	
	                val = jQuery("#ux_cover_border_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_cover_border_val").val(jQuery("#ux_cover_border_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_cover_border_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_cover_border_val").val(20);
	                }
	                break;
	            case "cover_border_radius":
	
	                val = jQuery("#ux_cover_radius_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_cover_radius_val").val(jQuery("#ux_cover_radius_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_cover_radius_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_cover_radius_val").val(20);
	                }
	
	                break;
	            case "lightbox_opacity":
	
	                val = jQuery("#ux_lightbox_opacity_val").val();
	                if (val > 100) {
	                    jQuery("#ux_lightbox_opacity_val").val(100);
	                }
	                else if (val > 0) {
	                    jQuery("#ux_lightbox_opacity_val").val(jQuery("#ux_lightbox_opacity_val").val().replace(/^0+/, ""));
	                }
	                else if (val == "") {
	                    jQuery("#ux_lightbox_opacity_val").val(0);
	                }
	
	                break;
	            case "lightbox_border":
	
	                val = jQuery("#ux_lightbox_border_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_lightbox_border_val").val(jQuery("#ux_lightbox_border_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_lightbox_border_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_lightbox_border_val").val(20);
	                }
	
	                break;
	            case "lightbox_radius":
	
	                val = jQuery("#ux_lightbox_radius_val").val();
	                if (val <= 20) {
	                    if (val > 0) {
	                        jQuery("#ux_lightbox_radius_val").val(jQuery("#ux_lightbox_radius_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_lightbox_radius_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_lightbox_radius_val").val(20);
	                }
	
	                break;
	            case "slide":
	
	                val = jQuery("#ux_slide_val").val();
	                if (val <= 15) {
	                    if (val > 0) {
	                        jQuery("#ux_slide_val").val(jQuery("#ux_slide_val").val().replace(/^0+/, ""));
	                    }
	                    else if (val == "") {
	                        jQuery("#ux_slide_val").val(0);
	                    }
	                } else {
	                    jQuery("#ux_slide_val").val(15);
	                }
	
	                break;
	            case "albums_per_page":
	
	                val = jQuery("#ux_albums_per_page_val").val();
	                if (val < 1) {
	                    jQuery("#ux_albums_per_page_val").val(1);
	                }
	
	                break;
	            case "images_per_page":
	
	                val = jQuery("#ux_images_per_page_val").val();
	                if (val < 1) {
	                    jQuery("#ux_images_per_page_val").val(1);
	                }
	                break;
	        }
	    }
	
	    jQuery("#frm_global_settings").validate
	    ({
	        rules: {
	            ux_image_width: {
	                required: true,
	                digits: true
	            },
	            ux_image_height: {
	                required: true,
	                digits: true
	            },
	            ux_cover_width: {
	                required: true,
	                digits: true
	            },
	            ux_cover_height: {
	                required: true,
	                digits: true
	            }
	        },
	        submitHandler: function () {
	            jQuery("body,html").animate({
	                scrollTop: jQuery("body,html").position().top}, "slow");
	            jQuery("#settings_success_message").css("display", "block");
	
	            settings_array.push({"thumbnails_custom_enable": jQuery("input[type=radio][name=ux_thumbnail]:checked").val()});
	            jQuery("input[type=radio][name=ux_thumbnail]:checked").val() == 1 ? settings_array.push({"thumbnails_width": "160"}) : settings_array.push({"thumbnails_width": jQuery("#ux_image_width").val()});
	            jQuery("input[type=radio][name=ux_thumbnail]:checked").val() == 1 ? settings_array.push({"thumbnails_height": "120"}) : settings_array.push({"thumbnails_height": jQuery("#ux_image_height").val()});
	            settings_array.push({"thumbnails_opacity": jQuery("#ux_image_opacity_val").val() / 100});
	            settings_array.push({"thumbnails_border_size": jQuery("#ux_image_border_val").val()});
	            settings_array.push({"thumbnails_border_radius": jQuery("#ux_image_radius_val").val()});
	            settings_array.push({"thumbnails_border_color": jQuery("#ux_border_color").val()});
	            settings_array.push({"margin_btw_thumbnails": jQuery("#ux_images_margin").val()});
	            settings_array.push({"thumbnail_text_color": jQuery("#ux_thumb_text_color").val()});
	            settings_array.push({"thumbnail_text_align": jQuery("#ux_thumb_text_align").val()});
	            settings_array.push({"thumbnail_font_family": jQuery("#ux_thumb_font_family").val()});
	            settings_array.push({"heading_font_size": jQuery("#ux_heading_font_size").val()});
	            settings_array.push({"text_font_size": jQuery("#ux_text_font_size").val()});
	            settings_array.push({"thumbnail_desc_length": jQuery("#ux_thumb_desc_length").val()});
	
	            settings_array.push({"cover_custom_enable": jQuery("input[type=radio][name=ux_cover_size]:checked").val()});
	            jQuery("input[type=radio][name=ux_cover_size]:checked").val() == 1 ? settings_array.push({"cover_thumbnail_width": "160"}) : settings_array.push({"cover_thumbnail_width": jQuery("#ux_cover_width").val()});
	            jQuery("input[type=radio][name=ux_cover_size]:checked").val() == 1 ? settings_array.push({"cover_thumbnail_height": "120"}) : settings_array.push({"cover_thumbnail_height": jQuery("#ux_cover_height").val()});
	            settings_array.push({"cover_thumbnail_opacity": jQuery("#ux_cover_opacity_val").val() / 100});
	            settings_array.push({"cover_thumbnail_border_size": jQuery("#ux_cover_border_val").val()});
	            settings_array.push({"cover_thumbnail_border_radius": jQuery("#ux_cover_radius_val").val()});
	            settings_array.push({"cover_thumbnail_border_color": jQuery("#ux_cover_border_color").val()});
	            settings_array.push({"responsive_albums": jQuery("input[type=radio][name=ux_responsive_albums]:checked").val()});
	            settings_array.push({"margin_btw_cover_thumbnails": jQuery("#ux_album_margin").val()});
	            settings_array.push({"album_text_align": jQuery("#ux_album_text_align").val()});
	            settings_array.push({"album_font_family": jQuery("#ux_album_font_family").val()});
	            settings_array.push({"album_heading_font_size": jQuery("#ux_album_heading_font_size").val()});
	            settings_array.push({"album_text_font_size": jQuery("#ux_album_text_font_size").val()});
	            settings_array.push({"album_desc_length": jQuery("#ux_album_desc_length").val()});
	
	            settings_array.push({"lightbox_type": jQuery("#ux_lightbox_type").val()});
	            settings_array.push({"lightbox_overlay_opacity": jQuery("#ux_lightbox_opacity_val").val() / 100});
	            settings_array.push({"lightbox_overlay_border_size": jQuery("#ux_lightbox_border_val").val()});
	            settings_array.push({"lightbox_overlay_border_radius": jQuery("#ux_lightbox_radius_val").val()});
	            settings_array.push({"lightbox_text_color": jQuery("#ux_lightbox_text_color").val()});
	            settings_array.push({"lightbox_overlay_border_color": jQuery("#ux_overlay_border_color").val()});
	            settings_array.push({"lightbox_inline_bg_color": jQuery("#ux_inline_overlay_color").val()});
	            settings_array.push({"lightbox_overlay_bg_color": jQuery("#ux_overlay_bg_color").val()});
	            settings_array.push({"lightbox_fade_in_time": jQuery("#ux_fade_in_time").val()});
	            settings_array.push({"lightbox_fade_out_time": jQuery("#ux_fade_out_time").val()});
	            settings_array.push({"lightbox_text_align": jQuery("#ux_lightbox_text_align").val()});
	            settings_array.push({"lightbox_font_family": jQuery("#ux_lightbox_font_family").val()});
	            settings_array.push({"lightbox_heading_font_size": jQuery("#ux_lightbox_heading_font_size").val()});
	            settings_array.push({"lightbox_text_font_size": jQuery("#ux_lightbox_text_font_size").val()});
	            settings_array.push({"facebook_comments": jQuery("input[type=radio][name=ux_facebook]:checked").val()});
	            settings_array.push({"social_sharing": jQuery("input[type=radio][name=ux_social_sharing]:checked").val()});
	            settings_array.push({"image_title_setting": jQuery("input[type=radio][name=ux_image_title]:checked").val()});
	            settings_array.push({"image_desc_setting": jQuery("input[type=radio][name=ux_image_desc]:checked").val()});
	
	            settings_array.push({"autoplay_setting": jQuery("input[type=radio][name=ux_slideshow]:checked").val()});
	            settings_array.push({"slide_interval": jQuery("#ux_slide_val").val()});
	
	            settings_array.push({"pagination_setting": jQuery("input[type=radio][name=ux_images_paging]:checked").val()});
	            settings_array.push({"images_per_page": jQuery("#ux_images_per_page_val").val()});
	
	            settings_array.push({"filters_setting": jQuery("input[type=radio][name=ux_image_filters]:checked").val()});
	            settings_array.push({"filter_font_family": jQuery("#ux_filter_font_family").val()});
	            settings_array.push({"filter_font_size": jQuery("#ux_filter_font_size").val()});
	
	            settings_array.push({"back_button_text": jQuery("#ux_back_button").val()});
	            settings_array.push({"album_click_text": jQuery("#ux_album_view").val()});
	            settings_array.push({"album_text_color": jQuery("#ux_album_text_color").val()});
	            settings_array.push({"button_color": jQuery("#ux_button_color").val()});
	            settings_array.push({"button_text_color": jQuery("#ux_button_text_color").val()});
	            settings_array.push({"filters_color": jQuery("#ux_filter_color").val()});
	            settings_array.push({"filters_text_color": jQuery("#ux_filter_text_color").val()});
	            settings_array.push({"album_seperator": jQuery("input[type=radio][name=ux_seperator]:checked").val()});
	            settings_array.push({"back_button_font_family": jQuery("#ux_button_font_family").val()});
	            settings_array.push({"back_button_font_size": jQuery("#ux_button_font_size").val()});
	
	            settings_array.push({"language_direction": jQuery("#ux_lang_dir").val()});
	            
	            settings_array.push({"image_uploader": jQuery("input[type=radio][name=ux_uploader]:checked").val()});
	            settings_array.push({"change_image_name": jQuery("input[type=radio][name=ux_upload_image]:checked").val()});
	            settings_array.push({"url_to_redirect": jQuery("input[type=radio][name=ux_url_redirect]:checked").val()});
	
	            jQuery("input[type=checkbox][name=ux_full_control_to_admin]:checked").val() == undefined ? settings_array.push({"admin_full_control": "0"}) : settings_array.push({"admin_full_control": "1"});
	            jQuery("input[type=checkbox][name=ux_read_control_to_admin]:checked").val() == undefined ? settings_array.push({"admin_read_control": "0"}) : settings_array.push({"admin_read_control": "1"});
	            jQuery("input[type=checkbox][name=ux_write_control_to_admin]:checked").val() == undefined ? settings_array.push({"admin_write_control": "0"}) : settings_array.push({"admin_write_control": "1"});
	            jQuery("input[type=checkbox][name=ux_full_control_to_editor]:checked").val() == undefined ? settings_array.push({"editor_full_control": "0"}) : settings_array.push({"editor_full_control": "1"});
	            jQuery("input[type=checkbox][name=ux_read_control_to_editor]:checked").val() == undefined ? settings_array.push({"editor_read_control": "0"}) : settings_array.push({"editor_read_control": "1"});
	            jQuery("input[type=checkbox][name=ux_write_control_to_editor]:checked").val() == undefined ? settings_array.push({"editor_write_control": "0"}) : settings_array.push({"editor_write_control": "1"});
	            jQuery("input[type=checkbox][name=ux_full_control_to_author]:checked").val() == undefined ? settings_array.push({"author_full_control": "0"}) : settings_array.push({"author_full_control": "1"});
	            jQuery("input[type=checkbox][name=ux_read_control_to_author]:checked").val() == undefined ? settings_array.push({"author_read_control": "0"}) : settings_array.push({"author_read_control": "1"});
	            jQuery("input[type=checkbox][name=ux_write_control_to_author]:checked").val() == undefined ? settings_array.push({"author_write_control": "0"}) : settings_array.push({"author_write_control": "1"});
	            jQuery("input[type=checkbox][name=ux_full_control_to_contributor]:checked").val() == undefined ? settings_array.push({"contributor_full_control": "0"}) : settings_array.push({"contributor_full_control": "1"});
	            jQuery("input[type=checkbox][name=ux_read_control_to_contributor]:checked").val() == undefined ? settings_array.push({"contributor_read_control": "0"}) : settings_array.push({"contributor_read_control": "1"});
	            jQuery("input[type=checkbox][name=ux_write_control_to_contributor]:checked").val() == undefined ? settings_array.push({"contributor_write_control": "0"}) : settings_array.push({"contributor_write_control": "1"});
	            jQuery("input[type=checkbox][name=ux_full_control_to_subscriber]:checked").val() == undefined ? settings_array.push({"subscriber_full_control": "0"}) : settings_array.push({"subscriber_full_control": "1"});
	            jQuery("input[type=checkbox][name=ux_read_control_to_subscriber]:checked").val() == undefined ? settings_array.push({"subscriber_read_control": "0"}) : settings_array.push({"subscriber_read_control": "1"});
	            jQuery("input[type=checkbox][name=ux_write_control_to_subscriber]:checked").val() == undefined ? settings_array.push({"subscriber_write_control": "0"}) : settings_array.push({"subscriber_write_control": "1"});
	            
	            var thumb_width = jQuery("#ux_image_width").val();
	            var thumb_height = jQuery("#ux_image_height").val();
	            var cover_width = jQuery("#ux_cover_width").val();
	            var cover_height = jQuery("#ux_cover_height").val();
	
	            jQuery.post(ajaxurl, "settings_array=" + encodeURIComponent(JSON.stringify(settings_array)) +
	                "&thumb_width=" + thumb_width + "&thumb_height=" + thumb_height + "&cover_width=" + cover_width +
	                "&cover_height=" + cover_height +
	                "&param=update_global_settings&action=settings_gallery_library", function () {
	                setTimeout(function () {
	                        jQuery("#settings_success_message").css("display", "none");
	                        window.location.href = "admin.php?page=global_settings";
	                    },
	                    2000);
	            });
	        }
	    });
	    function ux_clr_inline_overlay_color() {
	        jQuery("#clr_inline_overlay_color").farbtastic("#ux_inline_overlay_color");
	        jQuery("#clr_inline_overlay_color").slideDown();
	        jQuery("#ux_inline_overlay_color").focus();
	    }
	    function ux_clr_overlay_bg_color() {
	        jQuery("#clr_overlay_bg_color").farbtastic("#ux_overlay_bg_color");
	        jQuery("#clr_overlay_bg_color").slideDown();
	        jQuery("#ux_overlay_bg_color").focus();
	    }
	    function ux_clr_album_font_color() {
	        jQuery("#clr_album_text_color").farbtastic("#ux_album_text_color");
	        jQuery("#clr_album_text_color").slideDown();
	        jQuery("#ux_album_text_color").focus();
	    }
	    function ux_clr_overlay_border_color() {
	        jQuery("#clr_overlay_border_color").farbtastic("#ux_overlay_border_color");
	        jQuery("#clr_overlay_border_color").slideDown();
	        jQuery("#ux_overlay_border_color").focus();
	    }
	    function ux_clr_lightbox_text_color() {
	        jQuery("#clr_lightbox_text_color").farbtastic("#ux_lightbox_text_color");
	        jQuery("#clr_lightbox_text_color").slideDown();
	        jQuery("#ux_lightbox_text_color").focus();
	    }
	    function ux_clr_cover_border_color() {
	        jQuery("#clr_cover_border_color").farbtastic("#ux_cover_border_color");
	        jQuery("#clr_cover_border_color").slideDown();
	        jQuery("#ux_cover_border_color").focus();
	    }
	    function ux_clr_border_color() {
	        jQuery("#clr_border_color").farbtastic("#ux_border_color");
	        jQuery("#clr_border_color").slideDown();
	        jQuery("#ux_border_color").focus();
	    }
	    function ux_clr_thumb_text_color() {
	        jQuery("#clr_thumb_text_color").farbtastic("#ux_thumb_text_color");
	        jQuery("#clr_thumb_text_color").slideDown();
	        jQuery("#ux_thumb_text_color").focus();
	    }
	    function ux_clr_button_color() {
	        jQuery("#clr_button_color").farbtastic("#ux_button_color");
	        jQuery("#clr_button_color").slideDown();
	        jQuery("#ux_button_color").focus();
	    }
	    function ux_clr_button_text_color() {
	        jQuery("#clr_button_text_color").farbtastic("#ux_button_text_color");
	        jQuery("#clr_button_text_color").slideDown();
	        jQuery("#ux_button_text_color").focus();
	    }
	    function ux_clr_filter_color() {
	        jQuery("#clr_filter_color").farbtastic("#ux_filter_color");
	        jQuery("#clr_filter_color").slideDown();
	        jQuery("#ux_filter_color").focus();
	    }
	    function ux_clr_filter_text_color() {
	        jQuery("#clr_filter_text_color").farbtastic("#ux_filter_text_color");
	        jQuery("#clr_filter_text_color").slideDown();
	        jQuery("#ux_filter_text_color").focus();
	    }
	
	    jQuery("#ux_inline_overlay_color").blur(function () {
	        jQuery("#clr_inline_overlay_color").slideUp()
	    });
	    jQuery("#ux_overlay_bg_color").blur(function () {
	        jQuery("#clr_overlay_bg_color").slideUp()
	    });
	    jQuery("#ux_album_text_color").blur(function () {
	        jQuery("#clr_album_text_color").slideUp()
	    });
	    jQuery("#ux_overlay_border_color").blur(function () {
	        jQuery("#clr_overlay_border_color").slideUp()
	    });
	    jQuery("#ux_lightbox_text_color").blur(function () {
	        jQuery("#clr_lightbox_text_color").slideUp()
	    });
	    jQuery("#ux_cover_border_color").blur(function () {
	        jQuery("#clr_cover_border_color").slideUp()
	    });
	    jQuery("#ux_border_color").blur(function () {
	        jQuery("#clr_border_color").slideUp()
	    });
	    jQuery("#ux_thumb_text_color").blur(function () {
	        jQuery("#clr_thumb_text_color").slideUp()
	    });
	    jQuery("#ux_button_color").blur(function () {
	        jQuery("#clr_button_color").slideUp()
	    });
	    jQuery("#ux_button_text_color").blur(function () {
	        jQuery("#clr_button_text_color").slideUp()
	    });
	    jQuery("#ux_filter_color").blur(function () {
	        jQuery("#clr_filter_color").slideUp()
	    });
	    jQuery("#ux_filter_text_color").blur(function () {
	        jQuery("#clr_filter_text_color").slideUp()
	    });
	    </script>
	<?php
	}
}
?>