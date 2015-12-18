<script type="text/javascript">
    jQuery(function () {
        jQuery(".imgLiquidFill").imgLiquid({fill: true});
        <?php
        if($pagination_setting == 1)
        {
        ?>
        jQuery("#holder").jPages({containerID: "gallery_bank_container", perPage:<?php echo $images_per_page ?>});
        <?php
        }
        ?>
    });
    <?php
        switch($lightbox_type)
        {
            case "pretty_photo":
                ?>
			    jQuery(document).ready(function () {
			        jQuery("a[rel^=\"prettyPhoto\"]").prettyPhoto
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

					jQuery('.pp_social').append('<div style="margin-left:5px; display:inline-block;"><g:plusone data-action="share" href="'+ encodeURIComponent(location.href.replace(location.hash,"")) +'" width="160px" ></g:plusone></div>');

					jQuery('.pp_social').append("<script type='text/javascript'> \
					(function() { \
					var po = document.createElement('script'); \
					po.type = 'text/javascript'; \
					po.async = true; \
					po.src = 'https://apis.google.com/js/plusone.js'; \
					var s = document.getElementsByTagName('script')[0]; \
					s.parentNode.insertBefore(po, s); \
					})(); <" + "/" +  "script>");

				}
			<?php
			break;
			case "color_box":
				?>
			    jQuery(document).ready(function () {
			        jQuery(".colorbox").colorbox
			        ({
			            rel: "colorbox",
			            maxHeight: "95%",
			            transition: "elastic",
			            slideshow: true,
			            slideshowAuto: <?php echo $autoplay;?>,
			            slideshowSpeed:<?php echo $slide_interval * 1000; ?>,
			            fadeOut:<?php echo $lightbox_fade_out_time;?>,
			            speed: <?php echo $lightbox_fade_in_time;?>
			        });
			    });
				<?php
			break;
			case "photo_swipe":
			    ?>
			    document.addEventListener("DOMContentLoaded", function () {
			        Code.photoSwipe("a", "#gallery_bank_container"),
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
			        jQuery(".fancybox-buttons").fancybox
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
			        jQuery(".fancybox-media").attr("rel", "media-gallery").fancybox
			        ({
			            openEffect: "fade",
			            openSpeed: <?php echo $lightbox_fade_in_time;?>,
			            closeEffect: "fade",
			            closeSpeed: <?php echo $lightbox_fade_out_time;?>,
			            prevEffect: "elastic",
			            nextEffect: "elastic",
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
			break;
		}
		?>
</script>