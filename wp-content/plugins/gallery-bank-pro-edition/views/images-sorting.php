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
	$unique_id = rand(100, 10000);
	$album_id = intval($_REQUEST["album_id"]);
	$img_in_row = intval($_REQUEST["row"]);
	if (isset($_REQUEST["order_id"])) {
	    switch ($_REQUEST["order_id"]) {
	        case "unsort":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d",
	                            $album_id
	                        )
	                );
	            break;
	        case "picId":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id",
	                            $album_id
	                        )
	                );
	            break;
	        case "name":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_name asc",
	                            $album_id
	                        )
	                );
	            break;
	        case "title":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by title asc",
	                            $album_id
	                        )
	                );
	            break;
	        case "date":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by date asc",
	                            $album_id
	                        )
	                );
	            break;
	        case "asc":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id asc",
	                            $album_id
	                        )
	                );
	            break;
	        case "desc":
	            $pics_order = $wpdb->get_results
	                (
	                    $wpdb->prepare
	                        (
	                            "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by pic_id desc",
	                            $album_id
	                        )
	                );
	            break;
	    }
	} else {
	    $pics_order = $wpdb->get_results
	        (
	            $wpdb->prepare
	                (
	                    "SELECT * FROM " . gallery_bank_pics() . " WHERE album_id = %d order by sorting_order asc",
	                    $album_id
	                )
	        );
	}
	
	$album = $wpdb->get_row
	    (
	        $wpdb->prepare
	            (
	                "SELECT * FROM " . gallery_bank_albums() . " where album_id = %d",
	                $album_id
	            )
	    );
	$album_css = $wpdb->get_results
	(
	    "SELECT * FROM " . gallery_bank_settings()
	);
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
	    $new_thumb_width = $thumbnails_width + ($thumbnails_border_size * 4);
	
	    $index = array_search("thumbnails_border_radius", $setting_keys);
	    $thumbnails_border_radius = $album_css[$index]->setting_value;
	
	    $index = array_search("thumbnails_border_color", $setting_keys);
	    $thumbnails_border_color = $album_css[$index]->setting_value;
	
	    $index = array_search("margin_btw_thumbnails", $setting_keys);
	    $margin_btw_thumbnails = $album_css[$index]->setting_value;
	
	    ?>
	    <!--suppress ALL -->
	    <style type="text/css">
	        .dynamic_css {
	            border: <?php echo $thumbnails_border_size;?>px solid <?php echo $thumbnails_border_color;?>;
	            border-radius: <?php echo $thumbnails_border_radius;?>px;
	            -moz-border-radius: <?php echo $thumbnails_border_radius;?>px;
	            -webkit-border-radius: <?php echo $thumbnails_border_radius;?>px;
	            -khtml-border-radius: <?php echo $thumbnails_border_radius;?>px;
	            -o-border-radius: <?php echo $thumbnails_border_radius;?>px;
	            opacity: <?php echo $thumbnails_opacity;?>;
	            -moz-opacity: <?php echo $thumbnails_opacity; ?>;
	            -khtml-opacity: <?php echo $thumbnails_opacity; ?>;
	            margin-right: <?php echo $margin_btw_thumbnails;?>px;
	            margin-bottom: <?php echo $margin_btw_thumbnails;?>px;
	        }
	        <?php
	        if(isset($_REQUEST["order_id"]))
			{
				?>
				.layout-controls > a#<?php echo $_REQUEST["order_id"];?>
		        {
		            color: #000000 !important;
		            font-weight: bold !important;
		        }
				<?php
			}
	        ?>
	
	        .imgLiquidFill {
	            width: <?php echo $thumbnails_width;?>px;
	            height: <?php echo $thumbnails_height;?>px;
	            cursor: move;
	            display: inline-block;
	        }
	
	        .sort {
	            padding: 6px;
	            clear: both;
	            margin-top: 1%;
	            width: <?php echo ($new_thumb_width + $margin_btw_thumbnails * 2) * $img_in_row ;?>px;
	        }
	    </style>
	<?php
	}
	?>
	<form id="reodering_images" class="layout-form" method="post">
	    <div class="fluid-layout">
	        <div class="layout-span12">
	            <ul class="breadcrumb">
	                <li>
	                    <i class="icon-home"></i>
	                    <a href="admin.php?page=gallery_bank"><?php _e("Gallery Bank", gallery_bank); ?></a>
	                    <span class="divider">/</span>
	                    <a href="#"><?php _e("Re-Order Images", gallery_bank); ?></a>
	                </li>
	            </ul>
	            <div class="widget-layout">
	                <div class="widget-layout-title">
	                    <h4>
	                        <i class="icon-plus"></i>
	                        <?php _e("Re-Order Images", gallery_bank); ?>
	                    </h4>
	                </div>
	                <div class="widget-layout-body">
	                    <a class="btn btn-inverse"
	                       href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
	                    <button type="submit" class="btn btn-info"
	                            style="float:right"><?php _e("Update Order", gallery_bank); ?></button>
	                    <div id="sort_order_message" class="custom-message green" style="display: none;">
							<span>
								<strong><?php _e("Sorting Order has been updated.", gallery_bank); ?></strong>
							</span>
	                    </div>
	                    <div class="separator-doubled"></div>
	                    <div class="fluid-layout">
	                        <div class="layout-span12">
	                            <div class="widget-layout">
	                                <div class="widget-layout-title">
	                                    <h4><?php echo stripcslashes(htmlspecialchars_decode($album->album_name)); ?></h4>
	                                </div>
	                                <div class="widget-layout-body">
	                                    <div class="layout-control-group">
	                                        <ul class="breadcrumb">
	                                            <li>
	                                                <label class="layout-control-label"><strong>Presort :</strong></label>
	                                                <div class="layout-controls" style="margin-top: 8px;">
	                                                    <a id="unsort" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=unsort">Unsorted</a>
	                                                    |
	                                                    <a id="picId" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=picId">Image ID</a>
	                                                    |
	                                                    <a id="name" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=name">File Name</a>
	                                                    |
	                                                    <a id="title" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=title">Title Text</a>
	                                                    |
	                                                    <a id="date" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=date">Date</a>
	                                                    |
	                                                    <a id="asc" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=asc">Ascending</a>
	                                                    |
	                                                    <a id="desc" href="admin.php?page=images_sorting&album_id=<?php echo $album_id ?>&row=<?php echo $img_in_row ?>&order_id=desc">Descending</a>
	                                                </div>
	                                                <br>
	                                                <label class="layout-control-label">
	                                                    <strong>
	                                                        <?php _e("Images in Row", gallery_bank); ?> :
	                                                    </strong>
	                                                </label>
	                                                <select id="ux_ddl_img_in_Row" name="ux_ddl_img_in_Row" class="layout-span2" style="margin-left: 16px;" onchange="img_in_row();">
	                                                    <option id="" value=""><?php _e("Please Choose", gallery_bank); ?></option>
	                                                    <?php
	                                                    for ($i = 1; $i <= 10; $i++):
	                                                        ?>
	                                                        <option <?php if ($i == $img_in_row) echo "selected=\"selected\"" ?>
	                                                            value="<?php echo $i ?>"><?php echo $i; ?></option>
	                                                    <?php
	                                                    endfor;
	                                                    ?>
	                                                </select>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                    <div id="images_sort" class="sort">
	                                        <?php
	                                        for ($flag = 0; $flag < count($pics_order); $flag++) {
	                                            ?>
	                                            <div id="sortOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
	                                                 class="imgLiquidFill dynamic_css">
	                                                <?php
	                                                if ($pics_order[$flag]->video == 1) {
	                                                    ?>
	                                                    <img id="imgOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
	                                                         src="<?php echo $pics_order[$flag]->thumbnail_url; ?>"/>
	                                                <?php
	                                                } else {
	                                                    ?>
	                                                    <img id="imgOrder_<?php echo $pics_order[$flag]->pic_id; ?>"
	                                                         src="<?php echo GALLERY_BK_THUMB_SMALL_URL . $pics_order[$flag]->thumbnail_url; ?>"/>
	                                                <?php
	                                                }
	                                                ?>
	                                            </div>
	                                        <?php
	                                        }
	                                        ?>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</form>
	<script type="text/javascript">
	    var pic_ids = [];
	    jQuery(document).ready(function () {
	        jQuery(".sort").sortable
	        ({
	            opacity: 0.6,
	            cursor: "move",
	            connectWith: ".sort"
	        });
	    });
	    jQuery(".imgLiquidFill").imgLiquid({fill: true});
	    jQuery("#reodering_images").validate
	    ({
	        submitHandler: function () {
	            jQuery.post(ajaxurl, jQuery("#images_sort").sortable("serialize") + "&param=reorderControls&action=add_new_album_library", function () {
	                jQuery("#sort_order_message").css("display", "block");
	                setTimeout(function () {
	                    jQuery("#sort_order_message").css("display", "none");
	                    window.location.href = "admin.php?page=images_sorting&album_id=<?php echo $album_id;?>&row=<?php echo $img_in_row;?>";
	                }, 2000);
	            });
	        }
	    });
	    function img_in_row() {
	        var row = jQuery("#ux_ddl_img_in_Row").val();
	        window.location.href = "<?php echo site_url();?>/wp-admin/admin.php?page=images_sorting&album_id=<?php echo $album_id;?>&row=" + row;
	    }
	</script>
<?php 
}
?>