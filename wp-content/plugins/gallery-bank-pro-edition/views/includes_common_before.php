<?php

global $wpdb;
global $current_user;
$unique_id = rand(100, 10000);
if (isset($_REQUEST["row"])) {
    $img_in_row = intval($_REQUEST["row"]);
} else {
    $img_in_row = 3;
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
$album_id = intval($_REQUEST["album_id"]);
$album = $wpdb->get_var
(
    $wpdb->prepare
    (
        "SELECT album_name FROM " . gallery_bank_albums() . " WHERE album_id = %d",
        $album_id
    )
);
$album_css = $wpdb->get_results
(
    "SELECT * FROM " . gallery_bank_settings()
);
/***** Global Queries ******/

$pics = $wpdb->get_results
(
    $wpdb->prepare
    (
        "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
        $album_id
    )
);
/***** Global Settings ******/
if (count($album_css) != 0) {
    $setting_keys = array();
    for ($flag = 0; $flag < count($album_css); $flag++) {
        array_push($setting_keys, $album_css[$flag]->setting_key);
    }
    $index = array_search("thumbnails_width", $setting_keys);
    $thumbnails_width = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_height", $setting_keys);
    $thumbnails_height = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_opacity", $setting_keys);
    $thumbnails_opacity = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_size", $setting_keys);
    $thumbnails_border_size = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_radius", $setting_keys);
    $thumbnails_border_radius = $album_css[$index]->setting_value;

    $index = array_search("thumbnails_border_color", $setting_keys);
    $thumbnails_border_color = $album_css[$index]->setting_value;

    $index = array_search("margin_btw_thumbnails", $setting_keys);
    $margin_btw_thumbnails = $album_css[$index]->setting_value;
    $newMargin = $margin_btw_thumbnails * 3;

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
    $pagination_setting = $album_css[$index]->setting_value;

    $index = array_search("images_per_page", $setting_keys);
    $images_per_page = intval($album_css[$index]->setting_value);

    $index = array_search("language_direction", $setting_keys);
    $lang_dir_setting = $album_css[$index]->setting_value;
	
	$index = array_search("url_to_redirect", $setting_keys);
    $url_to_redirect = $album_css[$index]->setting_value;
	
	$url_redirect = $url_to_redirect == 1 ? "_blank" : "";


    /***** Global Settings ******/
    ?>
    <!-- Global Styling  -->
    <style type="text/css">
	    .dynamic_css {
	        border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?> !important;
	        border-radius: <?php echo $thumbnails_border_radius;?>px !important;
	        -moz-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
	        -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
	        -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
	        -o-border-radius: <?php echo $thumbnails_border_radius;?>px !important;
	        opacity: <?php echo $thumbnails_opacity;?> !important;
	        -moz-opacity: <?php echo $thumbnails_opacity; ?> !important;
	        -khtml-opacity: <?php echo $thumbnails_opacity; ?> !important;
	        margin-right: <?php echo $margin_btw_thumbnails;?>px !important;
	        margin-bottom: <?php echo $margin_btw_thumbnails;?>px !important;
	    }
	
	    .imgLiquidFill {
	        width: <?php echo $thumbnails_width;?>px !important;
	        height: <?php echo $thumbnails_height;?>px !important;
	        display: inline-block;
            box-sizing: border-box !important;
	    }
	
	    .gallery_images {
	        width: <?php echo ($thumbnails_width + ($margin_btw_thumbnails * 2)+5) * $img_in_row ;?>px !important;
	    }
		<?php
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
			
			    div.pp_default .pp_top .pp_middle {
			        background-color: #ffffff;
			    }
			
			    div.pp_default .pp_content_container .pp_left {
			        background-color: #ffffff;
			        padding-left: 16px;
			    }
			
			    div.pp_default .pp_content_container .pp_right {
			        background-color: #ffffff;
			        padding-right: 13px;
			    }
			
			    div.pp_default .pp_bottom .pp_middle {
			        background-color: #ffffff;
			    }
			
			    div.pp_default .pp_content, div.light_rounded .pp_content {
			        background-color: #ffffff;
			    }
			
			    .pp_details {
			        background-color: #ffffff;
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
				    .fbx-light .fbx-caption-title {
				        color: <?php echo $lightbox_text_color;?> !important;
				    }
				
				    /*noinspection ALL*/
				    .fbx-light .fbx-inner, .fbx-rounded.fbx-light .fbx-close, .fbx-rounded.fbx-light .fbx-play, .fbx-rounded.fbx-light .fbx-pause, .fbx-rounded.fbx-light .fbx-fullscreen-toggle {
				        border: <?php echo $lightbox_border_color_value; ?> !important;
				    }
				
				    /*noinspection ALL*/
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
		?>
	</style>
<?php
}
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
			<div class="gb_image_holder" id="image_holder_div">
			</div>
			<?php
		}
		else
		{
		?>
			<div class="gb_image_holder" id="image_holder_div">
			</div>
			<div class="gb_content_holder" id="contentHolderDiv">
				<h5></h5>
				<p></p>
				<ul class="gb_social_div">
					<div id="social_div" style="margin-left: -35px !important;">
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
?>