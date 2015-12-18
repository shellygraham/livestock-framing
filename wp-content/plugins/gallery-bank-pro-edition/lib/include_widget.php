<?php
class GalleryAllAlbumsWidget extends WP_Widget
{
    function GalleryAllAlbumsWidget()
    {
        $widget_ops = array("classname" => "GalleryAllAlbumsWidget", "description" => "Displays Gallery Images");
        $this->WP_Widget("GalleryAllAlbumsWidget", "Gallery Bank", $widget_ops);
    }

    function form($instance)
    {
        $instance = wp_parse_args((array)$instance, array("title" => "", "galleryid" => "0", "displayImages" => "", "galleryFormat" => "", 
       "numberOfImages" => "10", "sortBy" => "", "imgInRow" => "3", "responsive"=> TRUE, "textFormat" => "", 
        "specialEffect" => "grayscale", "thumbHeight" => "75", "thumbWidth" => "100", "animationEffect" => "bounce"));
        $title = $instance["title"];
        global $wpdb;
		$unique_id = rand(100, 10000);
        $albums = $wpdb->get_results
        (
            "SELECT * FROM " . gallery_bank_albums()
        );
        ?>
        <p>
        	<label for="<?php echo $this->get_field_id("title"); ?>"><?php _e("Title", gallery_bank); ?>: <input
                class="widefat" id="<?php echo $this->get_field_id("title"); ?>"
                name="<?php echo $this->get_field_name("title"); ?>" type="text"
                value="<?php echo esc_attr($title); ?>"/></label></p>
        <p>
        	<label for="<?php echo $this->get_field_id("galleryid"); ?>"><?php _e("Select Gallery", gallery_bank); ?>
                :</label>
            <select size="1" name="<?php echo $this->get_field_name("galleryid"); ?>"
                    id="<?php echo $this->get_field_id("galleryid"); ?>" class="widefat">
                <option value="0"><?php _e("Select Album", gallery_bank); ?></option>
                <?php
                if ($albums) {
                    foreach ($albums as $album) {
                        echo "<option value=\"" . $album->album_id . "\"";
                        if ($album->album_id == $instance["galleryid"]) echo "selected=\"selected\"";
                        echo ">" . stripslashes(html_entity_decode($album->album_name)) . "</option>" . "\n\t";
                    }
                }
                ?>
            </select>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id("displayImages"); ?>"><?php _e("Display Images", gallery_bank); ?>
                :</label>
            <select name="<?php echo $this->get_field_name("displayImages"); ?>" onchange="display_images<?php echo $unique_id;?>();" id="<?php echo $this->get_field_id("displayImages"); ?>" class="widefat">
                <option value="all">All</option>
				<option value="selected">Selected</option>
            </select>
        </p>
        <p id="ux_show_no_of_images<?php echo $unique_id;?>" style="display: none;">
        	<label for="<?php echo $this->get_field_id("numberOfImages"); ?>"><?php _e("No. of Images", gallery_bank); ?> 
                :</label>
            <input type="text" class="widefat" onkeypress="return OnlyNumbers(event);" name="<?php echo $this->get_field_name("numberOfImages"); ?>" id="<?php echo $this->get_field_id("numberOfImages"); ?>" 
            value="<?php echo intval($instance["numberOfImages"]);?>" />
        </p>
        <p id="ux_show_sort_by<?php echo $unique_id;?>" style="display: none;">
        	<label for="<?php echo $this->get_field_id("sortBy"); ?>"><?php _e("Sort By", gallery_bank); ?> 
                :</label>
            <select size="1" name="<?php echo $this->get_field_name("sortBy"); ?>" id="<?php echo $this->get_field_id("sortBy"); ?>" class="widefat">
				<option value="random">Random</option>
				<option value="pic_id">Image Id</option>
				<option value="pic_name">File Name</option>
				<option value="title">Title Text</option>
				<option value="date">Date</option>
            </select>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id("galleryFormat"); ?>"><?php _e("Gallery Format", gallery_bank); ?>
                :</label>
            <select name="<?php echo $this->get_field_name("galleryFormat"); ?>"
                    id="<?php echo $this->get_field_id("galleryFormat"); ?>" class="widefat">
                <option value="masonry">Masonry Gallery</option>
				<option value="thumbnail">Thumbnail Gallery</option>
            </select>
        </p>
        <p id="div_img_in_row<?php echo $unique_id;?>">
        	<label for="<?php echo $this->get_field_id("imgInRow"); ?>"><?php _e("Images In Row", gallery_bank); ?>
                :</label>
            <input type="text" class="widefat" name="<?php echo $this->get_field_name("imgInRow"); ?>" id="<?php echo $this->get_field_id("imgInRow"); ?>" 
            value="<?php echo intval($instance["imgInRow"]);?>" />
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id("textFormat"); ?>"><?php _e("Text Format", gallery_bank); ?>
                :</label>
            <select onchange="show_effects<?php echo $unique_id;?>();" size="1" name="<?php echo $this->get_field_name("textFormat"); ?>"
                    id="<?php echo $this->get_field_id("textFormat"); ?>" class="widefat">
                    <!-- <option value="0"><?php _e("Select Text Format", gallery_bank); ?></option> -->
                    <option value="title_only">With Title only</option>
                    <option value="title_desc">With Title and Description</option>
                    <option value="no_text">Without Title and Description</option>
            </select>
        </p>
        <p id="specialEffect<?php echo $unique_id;?>" style="display: none;">
        	<label for="<?php echo $this->get_field_id("specialEffect"); ?>"><?php _e("Special Effect", gallery_bank); ?>
                :</label>
            <select size="1" name="<?php echo $this->get_field_name("specialEffect"); ?>"
                    id="<?php echo $this->get_field_id("specialEffect"); ?>" class="widefat">
                    <!-- <option value="0"><?php _e("Select Special Effect", gallery_bank); ?></option> -->
                    <option value="blur">Blur</option>
			        <option value="grayscale">Grayscale</option>
			        <option value="sepia">Sepia</option>
					<option value="none">None</option>
            </select>
        </p>
        <p>
        	<label><?php _e("Width", gallery_bank); ?> x <?php _e("Height", gallery_bank); ?>
                :</label>
                <br>
                <input type="text" size="5" name="<?php echo $this->get_field_name("thumbWidth"); ?>" id="<?php echo $this->get_field_id("thumbWidth"); ?>" 
            value="<?php echo intval($instance["thumbWidth"]);?>" /> x 
            <input type="text" size="5" name="<?php echo $this->get_field_name("thumbHeight"); ?>" id="<?php echo $this->get_field_id("thumbHeight"); ?>" 
            value="<?php echo intval($instance["thumbHeight"]);?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id("animationEffect"); ?>"><?php _e("Animation Effect", gallery_bank); ?>
                :
                <select size="1" name="<?php echo $this->get_field_name("animationEffect"); ?>"
                    id="<?php echo $this->get_field_id("animationEffect"); ?>" class="widefat">
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
            </label>
        </p>
        <p>
        	<label for="<?php echo $this->get_field_id("responsive"); ?>"><?php _e("Responsive Gallery", gallery_bank); ?>
                :</label>
            <input type="checkbox" onclick="show_img_in_row<?php echo $unique_id;?>();" class="widefat" name="<?php echo $this->get_field_name("responsive"); ?>" 
            id="<?php echo $this->get_field_id("responsive"); ?>" value="1" <?php checked(TRUE, $instance["responsive"]); ?>/>
        </p>
        <script type="text/javascript">
        jQuery(document).ready(function () {
        	jQuery("#<?php echo $this->get_field_id("displayImages"); ?>").val("<?php echo $instance["displayImages"]; ?>");
        	jQuery("#<?php echo $this->get_field_id("sortBy"); ?>").val("<?php echo $instance["sortBy"]; ?>");
        	jQuery("#<?php echo $this->get_field_id("galleryFormat"); ?>").val("<?php echo $instance["galleryFormat"]; ?>");
        	jQuery("#<?php echo $this->get_field_id("textFormat"); ?>").val("<?php echo $instance["textFormat"]; ?>");
        	jQuery("#<?php echo $this->get_field_id("specialEffect"); ?>").val("<?php echo $instance["specialEffect"]; ?>");
        	jQuery("#<?php echo $this->get_field_id("animationEffect"); ?>").val("<?php echo $instance["animationEffect"]; ?>");
        	show_img_in_row<?php echo $unique_id;?>();
        	show_effects<?php echo $unique_id;?>();
        	display_images<?php echo $unique_id;?>();
        });
        function OnlyNumbers(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            return (charCode > 47 && charCode < 58) || charCode == 127 || charCode == 8;
        }
        function show_effects<?php echo $unique_id;?>()
        {
        	var gallery_type = jQuery("#<?php echo $this->get_field_id("textFormat"); ?>").val();
        	if(gallery_type == "no_text")
        	{
        		jQuery("#specialEffect<?php echo $unique_id;?>").css("display","block");
        	}
        	else
        	{
        		jQuery("#specialEffect<?php echo $unique_id;?>").css("display","none");
        	}
        }
        function show_img_in_row<?php echo $unique_id;?>()
        {
        	responsiveGallery = jQuery("#<?php echo $this->get_field_id("responsive"); ?>").prop("checked");
        	if(responsiveGallery == true)
        	{
        		jQuery("#div_img_in_row<?php echo $unique_id;?>").css("display","none");
        	}
        	else
        	{
        		jQuery("#div_img_in_row<?php echo $unique_id;?>").css("display","block");
        	}
        }
        function display_images<?php echo $unique_id;?>()
		{
			var show_images = jQuery("#<?php echo $this->get_field_id("displayImages"); ?>").val();
			if(show_images == "selected")
			{
				jQuery("#ux_show_no_of_images<?php echo $unique_id;?>").css("display","block");
				jQuery("#ux_show_sort_by<?php echo $unique_id;?>").css("display","block");
			}
			else
			{
				jQuery("#ux_show_no_of_images<?php echo $unique_id;?>").css("display","none");
				jQuery("#ux_show_sort_by<?php echo $unique_id;?>").css("display","none");
			}
		}
        </script>
    <?php
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance["title"] = $new_instance["title"];
        $instance["galleryid"] = (int)$new_instance["galleryid"];
		$instance["galleryFormat"] = $new_instance["galleryFormat"];
		$instance["displayImages"] = $new_instance["displayImages"];
		$instance["numberOfImages"] = $new_instance["numberOfImages"];
		$instance["sortBy"] = $new_instance["sortBy"];
		$instance["imgInRow"] = (int)$new_instance["imgInRow"];
		$instance["textFormat"] = $new_instance["textFormat"];
		$instance["specialEffect"] = $new_instance["specialEffect"];
		$instance["thumbWidth"] = (int)$new_instance["thumbWidth"];
		$instance["thumbHeight"] = (int)$new_instance["thumbHeight"];
        $instance["animationEffect"] = $new_instance["animationEffect"];
		$instance["responsive"] = (bool)$new_instance["responsive"];
        return $instance;
    }

    function widget($args, $instance)
    {
        global $wpdb,$responsiveGallery;
        $albums = $wpdb->get_var
            (
                $wpdb->prepare
                    (
                        "SELECT count(*) FROM " . gallery_bank_albums() . " WHERE album_id = %d",
                        $instance["galleryid"]
                    )
            );
        extract($args, EXTR_SKIP);
        echo $before_widget;
        $title = empty($instance["title"]) ? " " : apply_filters("widget_title", $instance["title"]);
		if($instance["responsive"] == 1)
		{
			$responsiveGallery = "responsive = \"true\"";
		}
		else
		{
			$responsiveGallery = "img_in_row=\"".$instance["imgInRow"]."\"";
		}
		if ($albums > 0) {
			if ($instance["galleryid"] != 0) {
				echo $before_title . $title . $after_title;
				if($instance["displayImages"] == "all")
				{
					switch($instance["textFormat"])
					{
						case "title_only":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"true\" desc=\"false\" ".$responsiveGallery." 
							animation_effect=\"".$instance["animationEffect"]."\" thumb_width=\"".$instance["thumbWidth"]."\" 
							thumb_height=\"".$instance["thumbHeight"]."\" album_id=\"" . $instance["galleryid"] . "\" display=\"all\" widget=\"true\"]";
						break;
						case "title_desc":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"true\" desc=\"true\" ".$responsiveGallery." 
							thumb_width=\"".$instance["thumbWidth"]."\" thumb_height=\"".$instance["thumbHeight"]."\" 
							animation_effect=\"".$instance["animationEffect"]."\" album_id=\"" . $instance["galleryid"] . "\" display=\"all\" widget=\"true\"]";
						break;
						case "no_text":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"false\" desc=\"false\" ".$responsiveGallery." 
							thumb_width=\"".$instance["thumbWidth"]."\" thumb_height=\"".$instance["thumbHeight"]."\" 
							special_effect=\"".$instance["specialEffect"]."\" animation_effect=\"".$instance["animationEffect"]."\" 
							album_id=\"" . $instance["galleryid"] . "\" display=\"all\" widget=\"true\"]";
						break;
					}
				}
				else
				{
					switch($instance["textFormat"])
					{
						case "title_only":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"true\" desc=\"false\" ".$responsiveGallery." 
							animation_effect=\"".$instance["animationEffect"]."\" thumb_width=\"".$instance["thumbWidth"]."\" 
							thumb_height=\"".$instance["thumbHeight"]."\" album_id=\"" . $instance["galleryid"] . "\" display=\"selected\" 
							no_of_images=\"".$instance["numberOfImages"]."\" sort_by=\"".$instance["sortBy"]."\" widget=\"true\"]";
						break;
						case "title_desc":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"true\" desc=\"true\" ".$responsiveGallery." 
							thumb_width=\"".$instance["thumbWidth"]."\" thumb_height=\"".$instance["thumbHeight"]."\" 
							animation_effect=\"".$instance["animationEffect"]."\" album_id=\"" . $instance["galleryid"] . "\" display=\"selected\" 
							no_of_images=\"".$instance["numberOfImages"]."\" sort_by=\"".$instance["sortBy"]."\" widget=\"true\"]";
						break;
						case "no_text":
							$shortcode_for_albums = "[gallery_bank type=\"images\" format=\"" . $instance["galleryFormat"] . "\" 
							title=\"false\" desc=\"false\" ".$responsiveGallery." 
							thumb_width=\"".$instance["thumbWidth"]."\" thumb_height=\"".$instance["thumbHeight"]."\" 
							special_effect=\"".$instance["specialEffect"]."\" animation_effect=\"".$instance["animationEffect"]."\" 
							album_id=\"" . $instance["galleryid"] . "\" display=\"selected\" no_of_images=\"".$instance["numberOfImages"]."\" 
							sort_by=\"".$instance["sortBy"]."\" widget=\"true\"]";
						break;
					}
				}
				echo do_shortcode($shortcode_for_albums);
				echo $after_widget;
			}
		}
	}
}
?>