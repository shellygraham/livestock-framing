<?php
switch ($album_type) {
	case "images":
		if ($album_seperator == 1 && $gallery_type != "blog") {
			?>
			<div class="separator-doubled"></div>
			<?php
		} else {
			if ($pagination_setting == 1 && $album_seperator == 1) {
				?>
				<div class="separator-doubled"></div>
				<?php
			}
		}
		?>
		<script type="text/javascript">
			<?php
			switch($gallery_type)
			{
				case "masonry":
					?>
					jQuery("#masonry-gallery-thumbnails_<?php echo $unique_id;?> > a > div.dynamic_css").addClass("animated <?php echo $animation_effect;?>");
					var $container1_<?php echo $unique_id;?> = jQuery("#masonry-gallery-thumbnails_<?php echo $unique_id;?>");
					$container1_<?php echo $unique_id;?>.imagesLoaded( function() {
						$container1_<?php echo $unique_id;?>.isotope({
							itemSelector: ".element",
							layoutMode : "masonry",
							itemPositionDataEnabled: true,
							resizable: false,
							resizesContainer: true,
							isAnimated: true,
							animationOptions: {
								duration: 750,
								easing: "linear",
								queue: false
							},
							masonry : {
								columnWidth: ".gallery-sizer<?php echo $unique_id;?>"
							}
						});
					});
					jQuery(window).smartresize(function(){
						$container1_<?php echo $unique_id;?>.isotope({
							// update columnWidth to a percentage of container width
							masonry: {
								columnWidth: ".gallery-sizer<?php echo $unique_id;?>"
							}
						});
					});
					var $optionSets = jQuery("#bank_filters_<?php echo $unique_id;?>"),
					$optionLinks = $optionSets.find("a");
					$optionLinks.click(function()
					{
						var selector_<?php echo $unique_id;?> = jQuery(this).attr("data-filter");
						$container1_<?php echo $unique_id;?>.isotope({ filter: selector_<?php echo $unique_id;?> });
						return false;
					});
					jQuery("#bank_filters_<?php echo $unique_id;?> a").on("click", function()
					{
						jQuery("#bank_filters_<?php echo $unique_id;?>").find(".act").removeClass("act");
						jQuery(this).addClass("act");
					});
					<?php
				break;
				case "filmstrip":
					?>
					var imageFullPath = "<?php echo GALLERY_BK_THUMB_URL; ?>";
					jQuery(function () {
						<?php
						if($pics[0]->video == 1)
						{
							?>
							DisplayVideo("<?php echo $pics[0]->pic_name; ?>",<?php echo $unique_id;?>);
							<?php
						}
						?>
						jQuery(".imgFilmstripFill").imgLiquid({fill: true});
						jQuery("div#holder_<?php echo $unique_id;?>").jPages
						({
							containerID: "thumb_<?php echo $unique_id;?>",
							perPage: <?php echo $img_in_row;?>,
							previous: "#prv_<?php echo $unique_id;?>",
							next: "#nxt_<?php echo $unique_id;?>",
							links: "blank",
							direction: "auto",
							animation: "<?php echo $animation_effect;?>"
						});
						jQuery("ul#thumb_<?php echo $unique_id;?> #li_<?php echo $unique_id;?>").click(function () {
							jQuery(this).addClass("selected").siblings().removeClass("selected");
							jQuery(this).children().children().addClass("dynamic_css");
							var thumbpath = jQuery(this).find("img").attr("picPath");
							var img = jQuery(this).children().children().clone().addClass("animated <?php echo $animation_effect;?>").css("display", "").attr("src",imageFullPath+thumbpath);
							var div = document.createElement("div");
							var desc = jQuery(div).addClass("filmstrip_description_black animated <?php echo $animation_effect;?>").html(jQuery(img).attr("data-title")+jQuery(img).attr("data-desc"));
							var type = jQuery(img).attr("type");
							if (type == "video") {
								var path = jQuery(img).attr("imgpath");
								jQuery("div#image<?php echo $unique_id;?> > img").css("display", "none");
								jQuery("div#image<?php echo $unique_id;?> > .filmstrip_description_black").css("display", "none");
								DisplayVideo(path, <?php echo $unique_id;?>);
							} else {
								jQuery("div#image<?php echo $unique_id;?>").html(img);
								if ((jQuery(img).attr("data-title") != "") || jQuery(img).attr("data-desc") != "")
								{
									jQuery("div#image<?php echo $unique_id;?>").append(desc);
								}
							}
						});
					});
					if (typeof(DisplayVideo) != "function") {
						function DisplayVideo(path, frameid)
						{
							var src;
							if (path.match(/youtube\.com\/watch/i)) {
								src = "http://www.youtube.com/embed/" + path.split("v=")[1];
								video(src, frameid);
							} else if (path.match(/youtu\.be\//i)) {
								src = "http://www.youtube.com/embed/" + path.split(".be/")[1];
								video(src, frameid);
							} else if (path.match(/(?:vimeo(?:pro)?.com)\/(?:[^\d]+)?(\d+)(?:.*)/)) {
								src = "http://player.vimeo.com/video/" + path.split("/")[3];
								video(src, frameid);
							} else if (path.match(/dailymotion\.com/i)) {
								src = "http://dailymotion.com/embed/video/" + path.split(/[_]/)[0].split("/")[4];
								video(src, frameid);
							} else if (path.match(/metacafe\.com\/watch/i)) {
								src = "http://www.metacafe.com/fplayer/" + path.split("/")[4] + "/.swf?playerVars";
								video(src, frameid);
							} else if (path.match(/facebook\.com/i)) {
								src = "https://www.facebook.com/video/embed?video_id=" + path.split("v=")[1];
								video(src, frameid);
							} else if (path.match(/flickr\.com(?!.+\/show\/)/i)) {
								src = "http://www.flickr.com/apps/video/stewart.swf?photo_id=" + path.split("/")[5];
								video(src, frameid);
							} else if (path.match(/tudou\.com/i)) {
								src = "http://www.tudou.com/v/" + path.split("/")[5];
								video(src, frameid);
							} else {
								src = "Wrong url";
								video(src, frameid);
							}
						}
					}
					if (typeof(video) != "function") {
						function video(videoSrc, id) {
							var iframe = jQuery("<iframe class=\"dynamic_css\" style=\"margin:0px;max-height:300px;max-width:<?php echo $image_width;?>px;\" width=\" <?php echo $image_width;?>px\" height=\"300px\" src=\"" + videoSrc + "\" ></iframe>").attr("src", videoSrc).addClass("animated <?php echo $animation_effect;?>");
							jQuery("div#image"+id).html(iframe);
						}
					}
					<?php
				break;
				case "blog":
					?>
					jQuery(function () {
						jQuery("#blog_gallery<?php echo $unique_id;?> > a > div.blog_gallery").addClass("animated <?php echo $animation_effect;?>");
						<?php
						if($pagination_setting == 1)
						{
							?>
							jQuery("#holder_<?php echo $unique_id;?>").jPages({containerID: "blog_gallery<?php echo $unique_id;?>", perPage:<?php echo $images_per_page ?>, animation: "<?php echo $animation_effect;?>"});
							<?php
						}
						?>
					});
					<?php
					if($filters_setting != 0 && $widget == "")
					{
						?>
						var $optionSets = jQuery("#bank_filters_<?php echo $unique_id;?>"),
						$optionLinks = $optionSets.find("a");
						$optionLinks.click(function ()
						{
							var selector_<?php echo $unique_id;?> = jQuery(this).attr("data-filter");
							if (selector_<?php echo $unique_id;?> != "*") {
								jQuery("#blog_gallery<?php echo $unique_id;?> > a > div.blog_gallery").addClass("jp-hidden");
								jQuery("#blog_gallery<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.blog_gallery").removeClass("jp-hidden");
								jQuery("#blog_gallery<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.blog_gallery").removeClass("animated <?php echo $animation_effect;?>");
								jQuery("#blog_gallery<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.blog_gallery").css("display", "");
							}
							else {
								jQuery("#blog_gallery<?php echo $unique_id;?> > a > div.blog_gallery").removeClass("jp-hidden");
								jQuery("#blog_gallery<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.blog_gallery").removeClass("animated <?php echo $animation_effect;?>");
								jQuery("#blog_gallery<?php echo $unique_id;?> > a > div.blog_gallery").css("display", "");
							}
							<?php
							if($pagination_setting == 1)
							{
								?>
								jQuery("#holder_<?php echo $unique_id;?>").jPages({containerID: "blog_gallery<?php echo $unique_id;?>", perPage:<?php echo $images_per_page ?>,animation:"<?php echo $animation_effect;?>"});
								<?php
							}
							else
							{
								?>
								jQuery("#blog_gallery<?php echo $unique_id;?> > a > div.blog_gallery").addClass("animated <?php echo $animation_effect;?>");
								<?php
							}
							?>
							return false;
						});
						jQuery("#bank_filters_<?php echo $unique_id;?> a").on("click", function () {
							jQuery("#bank_filters_<?php echo $unique_id;?>").find(".act").removeClass("act");
							jQuery(this).addClass("act");
						});
						<?php
					}
				break;
				case "thumbnail":
					?>
						jQuery(function () {
							<?php
							if($img_title == "true" || $img_desc == "true")
							{
								?>
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.gb_overlay").addClass("animated <?php echo $animation_effect;?>");
								<?php
							}
							?>
							jQuery(".imgLiquidFill").imgLiquid({fill: true});
							<?php
							if($pagination_setting == 1 &&  $widget == "")
							{
								?>
								jQuery("#holder_<?php echo $unique_id;?>").jPages({containerID: "gallery-bank-thumbnails_<?php echo $unique_id;?>", perPage:<?php echo $images_per_page ?>,animation:"<?php echo $animation_effect;?>"});
								<?php
							}
							?>
						});
						<?php
						if($filters_setting != 0 && $widget == "")
						{
							?>
							var $optionSets = jQuery("#bank_filters_<?php echo $unique_id;?>"),
							$optionLinks = $optionSets.find("a");
							$optionLinks.click(function () {
							var selector_<?php echo $unique_id;?> = jQuery(this).attr("data-filter");
							if (selector_<?php echo $unique_id;?> != "*") {
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.margin_thumbs").addClass("jp-hidden");
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.margin_thumbs").removeClass("jp-hidden");
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.margin_thumbs").css("display", "");
							}
							else {
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.margin_thumbs").removeClass("jp-hidden");
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a" + selector_<?php echo $unique_id;?> + " > div.margin_thumbs").removeClass("animated <?php echo $animation_effect;?>");
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.margin_thumbs").css("display", "");
							}
							<?php
							if($pagination_setting == 1 && $widget == "")
							{
								?>
								jQuery("#holder_<?php echo $unique_id;?>").jPages({containerID: "gallery-bank-thumbnails_<?php echo $unique_id;?>", perPage:<?php echo $images_per_page ?>,animation:"<?php echo $animation_effect;?>"});
								<?php
							}
							else
							{
								?>
								jQuery("#gallery-bank-thumbnails_<?php echo $unique_id;?> > a > div.margin_thumbs").addClass("animated <?php echo $animation_effect;?>");
								<?php
							}
							?>
							return false;
						});
						jQuery("#bank_filters_<?php echo $unique_id;?> a").on("click", function () {
							jQuery("#bank_filters_<?php echo $unique_id;?>").find(".act").removeClass("act");
							jQuery(this).addClass("act");
						});
						<?php
					}
				break;
			}
			?>
		</script>
		<?php
	break;
	case "grid" || "list" || "individual":
		?>
		<script type="text/javascript">
			jQuery(function () {
				jQuery(".imgLiquid").imgLiquid({fill: true});
			});
			var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";
			<?php
			if($album_type == "grid")
			{
				if($gallery_type !="slideshow")
				{
					?>
					if (typeof(view_album_images<?php echo $unique_id;?>) != "function") {
						function view_album_images<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var filmstrip_width = "<?php echo $image_width; ?>";
							var isResponsive = "<?php echo $responsive;?>";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery(".albums-in-row_" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#bank_album_images_div" + unique_id).css("display", "block");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
								"&isResponsive="+isResponsive+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
								jQuery("#back_button" + unique_id).css("display", "block");
								jQuery("#seperator" + unique_id).css("display", "block");
								jQuery("#seperator1" + unique_id).css("display", "none");
								jQuery("#show_bank_album_images" + unique_id).html(data);
							});
						}
					}
					if (typeof(view_albums<?php echo $unique_id;?>) != "function") {
						function view_albums<?php echo $unique_id;?>(unique_id) {
							jQuery(".albums-in-row_" + unique_id).css("display", "block");
							jQuery("#bank_album_images_div" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#show_bank_album_images" + unique_id).html("");
							<?php
							if($album_seperator == 1)
							{
								?>
								jQuery("#seperator1" + unique_id).css("display", "block");
								<?php
							}
							?>
						}
					}
				<?php
				}
				else
				{
					?>
					if (typeof(getalbum_id<?php echo $unique_id;?>) != "function") {
						function getalbum_id<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var isResponsive = "<?php echo $responsive;?>";
							var postback = "grid";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery("#bank_slideshow_images_div" + unique_id).html("");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&show_album_title=" + show_album_title + "&postback=" + postback +"&isResponsive="+isResponsive+
								"&unique_id="+unique_id+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=get_album_pics&action=front_view_all_albums_library", function (data) {
								jQuery("#bank_slideshow_images_div" + unique_id).html(data);
								<?php
								switch ($lightbox_type) {
									case "GB_lightbox":
										?>
										var class_gb = "gb"+unique_id;
										jQuery("a."+class_gb+":first").trigger("click");
										<?php
									break;
									default:
										?>
										jQuery("a.imgLiquidFill:first").trigger("click");
										<?php
									break;
								}
								?>
							});
						}
					}
					<?php
				}
			}
			elseif($album_type == "list")
			{
				if($gallery_type !="slideshow")
				{
					?>
					if (typeof(view_listed_album_images<?php echo $unique_id;?>) != "function") {
						function view_listed_album_images<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var filmstrip_width = "<?php echo $image_width; ?>";
							var isResponsive = "<?php echo $responsive;?>";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery("#view_gallery_bank_albums_" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#bank_album_images_div" + unique_id).css("display", "block");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
								"&isResponsive="+isResponsive+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
								jQuery("#back_button" + unique_id).css("display", "block");
								jQuery("#seperator" + unique_id).css("display", "block");
								jQuery("#seperator1" + unique_id).css("display", "none");
								jQuery("#show_bank_album_images" + unique_id).html(data);
							});
						}
					}
					if (typeof(view_list_albums<?php echo $unique_id;?>) != "function") {
						function view_list_albums<?php echo $unique_id;?>(unique_id) {
							jQuery("#view_gallery_bank_albums_" + unique_id).css("display", "block");
							jQuery("#bank_album_images_div" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#show_bank_album_images" + unique_id).html("");
							<?php
							if($album_seperator == 1)
							{
								?>
								jQuery("#seperator1" + unique_id).css("display", "block");
								<?php
							}
						?>
						}
					}
					<?php
				}
				else
				{
					?>
					if (typeof(view_listed_slideshow_images<?php echo $unique_id;?>) != "function") {
						function view_listed_slideshow_images<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var postback = "list";
							var isResponsive = "<?php echo $responsive;?>";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery("#list_slideshow_images_div" + unique_id).html("");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&show_album_title=" + show_album_title + "&postback="+postback+"&isResponsive="+isResponsive+
								"&unique_id="+unique_id+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=get_album_pics&action=front_view_all_albums_library", function (data) {
								jQuery("#list_slideshow_images_div" + unique_id).html(data);
								<?php
								switch ($lightbox_type) {
									case "GB_lightbox":
										?>
										var class_gb = "gb"+unique_id;
										jQuery("a."+class_gb+":first").trigger("click");
										<?php
									break;
									default:
										?>
										jQuery("a.imgLiquidFill:first").trigger("click");
										<?php
									break;
								}
							?>
							});
						}
					}
					<?php
				}
			}
			else
			{
				if($gallery_type !="slideshow")
				{
					?>
					if (typeof(view_individual_album_images<?php echo $unique_id;?>) != "function") {
						function view_individual_album_images<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var filmstrip_width = "<?php echo $image_width; ?>";
							var isResponsive = "<?php echo $responsive;?>";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery("#ux_individual_main_div" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#bank_album_images_div" + unique_id).css("display", "block");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&filmstrip_width=" + filmstrip_width + "&show_album_title=" + show_album_title +
								"&isResponsive="+isResponsive+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=show_album_gallery&action=front_view_all_albums_library", function (data) {
								jQuery("#back_button" + unique_id).css("display", "block");
								jQuery("#seperator" + unique_id).css("display", "block");
								jQuery("#seperator1" + unique_id).css("display", "none");
								jQuery("#show_bank_album_images" + unique_id).html(data);
							});
						}
					}
					if (typeof(view_individual_albums<?php echo $unique_id;?>) != "function") {
						function view_individual_albums<?php echo $unique_id;?>(unique_id) {
							jQuery("#ux_individual_main_div" + unique_id).css("display", "inline-block");
							jQuery("#bank_album_images_div" + unique_id).css("display", "none");
							jQuery("#back_button" + unique_id).css("display", "none");
							jQuery("#seperator" + unique_id).css("display", "none");
							jQuery("#show_bank_album_images" + unique_id).html("");
							<?php
							if($album_seperator == 1)
							{
								?>
								jQuery("#seperator1" + unique_id).css("display", "block");
								<?php
							}
							?>
						}
					}
					<?php
				}
				else
				{
					?>
					if (typeof(view_individual_slideshow_images<?php echo $unique_id;?>) != "function") {
						function view_individual_slideshow_images<?php echo $unique_id;?>(album_id, unique_id) {
							var isImageDesc = "<?php echo $img_desc ;?>";
							var isImageTitle = "<?php echo $img_title; ?>";
							var gallery_format = "<?php echo $gallery_type; ?>";
							var images_in_row = "<?php echo $img_in_row; ?>";
							var iswidget = "<?php echo $galleryWidget; ?>";
							var special_effects = "<?php echo $special_effect; ?>";
							var animation_effects = "<?php echo $animation_effect; ?>";
							var show_album_title = "<?php echo $album_title; ?>";
							var postback = "individual";
							var isResponsive = "<?php echo $responsive;?>";
							var display = "<?php echo $display;?>";
							var sort_order = "<?php echo $sort_by;?>";
							var display_no_of_images = "<?php echo $no_of_images;?>";
							jQuery("#show_bank_slideshow_images").html("");
							jQuery.post(ajaxurl, "album_id=" + album_id + "&isImageDesc=" + isImageDesc +
								"&isImageTitle=" + isImageTitle + "&gallery_format=" + gallery_format +
								"&images_in_row=" + images_in_row + "&iswidget=" + iswidget +
								"&special_effects=" + special_effects + "&animation_effects=" + animation_effects +
								"&show_album_title=" + show_album_title + "&postback=" + postback+"&isResponsive="+isResponsive+
								"&unique_id="+unique_id+"&display="+display+"&no_of_images="+display_no_of_images+"&sort_by="+sort_order+
								"&param=get_album_pics&action=front_view_all_albums_library", function (data) {
								jQuery("#show_bank_slideshow_images").html(data);
								<?php
								switch ($lightbox_type) {
									case "GB_lightbox":
										?>
										var class_gb = "gb"+unique_id;
										jQuery("a."+class_gb+":first").trigger("click");
										<?php
									break;
									default:
										?>
										jQuery("a.imgLiquidFill:first").trigger("click");
										<?php
									break;
								}
								?>
							});
						}
					}
					<?php
				}
			}
			?>
		</script>
		<?php
	break;
}
if($album_type == "images" || isset($postback))
{
?>
	<script type="text/javascript">
		<?php
			switch($lightbox_type)
			{
				case "pretty_photo":
					?>
					jQuery(document).ready(function () {
						jQuery("a[rel^=\"<?php echo $unique_id;?>prettyPhoto\"]").prettyPhoto
						({
							animation_speed: <?php echo $lightbox_fade_in_time;?>, /* fast/slow/normal */
							slideshow: <?php echo $slide_interval * 1000; ?>, /* false OR interval time in ms */
							autoplay_slideshow: <?php echo $autoplay;?>, /* true/false */
							opacity: 0.80, /* Value between 0 and 1 */
							show_title: false, /* true/false */
							allow_resize: true,
							changepicturecallback: onPictureChanged
						});
					});
					function onPictureChanged() 
					{
						jQuery('.pp_social').append('<g:plusone data-action="share" href="'+ encodeURIComponent(location.href.replace(location.hash,"")) +'" width="160px" style="margin-left:5px; display:inline-block;"></g:plusone>');
						jQuery('.pp_social').append("<script type='text/javascript'> \
						(function() {\
						var po = document.createElement('script');\
						po.type = 'text/javascript';\
						po.async = true; \
						po.src = 'https://apis.google.com/js/plusone.js';\
						var s = document.getElementsByTagName('script')[0];\
						s.parentNode.insertBefore(po, s);\
						})(); <" + "/" +  "script>");
					}
					<?php
				break;
				case "color_box":
					?>
					jQuery(document).ready(function () {
						//var addthis_config = {"data_track_addressbar":true};
						jQuery(".colorbox<?php echo $unique_id;?>").colorbox
						({
							rel: "colorbox<?php echo $unique_id;?>",
							maxHeight: "95%",
							transition: "elastic",
							slideshow: true,
							slideshowAuto: <?php echo $autoplay;?>,
							slideshowSpeed:<?php echo $slide_interval * 1000; ?>,
							dynamicid:<?php echo $unique_id;?>
						});
					});
					<?php
				break;
				case "photo_swipe":
					switch($gallery_type)
					{
						case "blog":
							?>
							jQuery(document).ready(function(){
								document.addEventListener("DOMContentLoaded", function () {
								//noinspection CommaExpressionJS
									Code.photoSwipe("a","#blog_gallery<?php echo $unique_id;?>"),
									{
										enableMouseWheel: false,
										enableKeyboard: true,
										fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
										fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
										slideSpeed: <?php echo $slide_interval * 1000; ?>,
										swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
									};
								}, false);
							}(window, window.jQuery, window.Code.PhotoSwipe)); 
							<?php
						break;
						case "slideshow":
							switch($postback)
							{
								case "grid":
									?>
									document.addEventListener("DOMContentLoaded", function () {
										Code.photoSwipe("a", "#bank_slideshow_images_div<?php echo $unique_id; ?>"),
										{
											enableMouseWheel: false,
											enableKeyboard: true,
											fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
											fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
											slideSpeed: <?php echo $slide_interval * 1000; ?>,
											swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
										};
									}, false);
									<?php
								break;
								case "list":
									?>
									document.addEventListener("DOMContentLoaded", function () {
										Code.photoSwipe("a", "show_bank_album_images<?php echo $unique_id; ?>"),
										{
											enableMouseWheel: false,
											enableKeyboard: true,
											fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
											fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
											slideSpeed: <?php echo $slide_interval * 1000; ?>,
											swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
										};
									}, false);
									<?php
								break;
								case "individual":
									?>
									document.addEventListener("DOMContentLoaded", function () {
										Code.photoSwipe("a", "#show_bank_slideshow_images<?php echo $unique_id; ?>"),
										{
											enableMouseWheel: false,
											enableKeyboard: true,
											fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
											fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
											slideSpeed: <?php echo $slide_interval * 1000; ?>,
											swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
										};
									}, false);
									<?php
								break;
							}
						break;
						case "masonry":
							?>
							document.addEventListener("DOMContentLoaded", function () {
								//noinspection CommaExpressionJS
								Code.photoSwipe("a", "#masonry-gallery-thumbnails_<?php echo $unique_id;?>"),
								{
									enableMouseWheel: false,
									enableKeyboard: true,
									fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
									fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
									slideSpeed: <?php echo $slide_interval * 1000; ?>,
									swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
								};
							}, false);
							<?php
						break;
						case "thumbnail":
							?>
							document.addEventListener("DOMContentLoaded", function () {
								//noinspection CommaExpressionJS
								Code.photoSwipe("a", "#gallery-bank-thumbnails_<?php echo $unique_id;?>"),
								{
									enableMouseWheel: false,
									enableKeyboard: true,
									fadeInSpeed: <?php echo $lightbox_fade_in_time;?>,
									fadeOutSpeed: <?php echo $lightbox_fade_out_time;?>,
									slideSpeed: <?php echo $slide_interval * 1000; ?>,
									swipeTimeThreshold: <?php echo $lightbox_fade_out_time;?>
								};
							}, false);
						<?php
						break;
					}
				break;
				case "foo_box":
					?>
					jQuery(document).ready(function ()
					{
						(function (FOOBOX, $, undefined) {
							FOOBOX.init = function () {
								$(".foobox").foobox(FOOBOX.o);
							};
						}(window.FOOBOX = window.FOOBOX || {}, jQuery));
						jQuery(function ($) {
							FOOBOX.init();
						});
					});
					<?php
				break;
				case "fancy_box":
					?>
					jQuery(document).ready(function () {
						jQuery(".fancybox-buttons<?php echo $unique_id;?>").fancybox
						({
							openEffect: "fade",
							openSpeed: <?php echo $lightbox_fade_in_time;?>,
							closeEffect: "fade",
							closeSpeed: <?php echo $lightbox_fade_out_time;?>,
							prevEffect: "elastic",
							nextEffect: "elastic",
							closeBtn: false,
							autoPlay:<?php echo $autoplay;?>,
							playSpeed:<?php echo $slide_interval * 1000; ?>,
							helpers: {
								title: {
									type: "over"
								},
								buttons: {
									position: "bottom"
								}
							}
						});
						jQuery(".fancybox-media<?php echo $unique_id;?>").attr("rel", "media-gallery").fancybox
						({
							openEffect: "fade",
							openSpeed: <?php echo $lightbox_fade_in_time;?>,
							closeEffect: "fade",
							closeSpeed: <?php echo $lightbox_fade_out_time;?>,
							prevEffect: "elastic",
							nextEffect: "elastic",
							autoPlay:<?php echo $autoplay;?>,
							playSpeed:<?php echo $slide_interval * 1000; ?>,
							arrows: true,
							helpers: {
							title: {
								type: "over"
							},
							media: {},
								buttons: {
									position: "bottom"
								}
							}
						});
					});
					<?php
				break;
				case "GB_lightbox":
					if($gallery_type !="filmstrip")
					{
						$language = get_locale();
						?>
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/<?php echo $language;?>/all.js#xfbml=1";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, "script", "facebook-jssdk"));
						var imageFullPath = "<?php echo GALLERY_BK_THUMB_URL; ?>";
						var fb_settings = <?php echo $facebook_comments;?> ;
						var social_sharing = <?php echo $social_sharing;?>;
						var title_settings = <?php echo $image_title_setting;?>;
						var description_settings = <?php echo $image_desc_setting;?>;
						jQuery(".<?php echo $class_gb;?>").live("click",function()
						{
							var type = jQuery(this).find("img").attr("type");
							var imageId = parseInt(jQuery(this).find("img").attr("imageid"));
							if(type == "video")
							{
								ShowVideo(imageId);
								jQuery("#gb_lightbox_overlay_div").css("display","block");
								jQuery("#gb_lightbox_container_div").fadeIn(<?php echo $lightbox_fade_in_time; ?>);
							}
							else
							{
								ShowImage(imageId);
								jQuery("#gb_lightbox_overlay_div").css("display","block");
								jQuery("#gb_lightbox_container_div").fadeIn(<?php echo $lightbox_fade_in_time; ?>);
							}
						});
						<?php
					}
				break;
			}
		?>
	</script>
<?php
}
?>