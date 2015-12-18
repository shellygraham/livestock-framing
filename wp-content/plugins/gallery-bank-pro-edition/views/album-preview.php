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
	include GALLERY_BK_PLUGIN_DIR . "/views/includes_common_before.php";
	?>
	<!--suppress ALL -->
	<form id="preview_album" class="layout-form" method="post">
		<div class="fluid-layout">
			<div class="layout-span12">
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="admin.php?page=gallery_bank"><?php _e("Gallery Bank", gallery_bank); ?></a>
						<span class="divider">/</span>
				 		<a href="#"><?php _e("Album Preview", gallery_bank); ?></a>
					</li>
				</ul>
				<div class="widget-layout">
					<div class="widget-layout-title">
						<h4>
							<i class="icon-plus"></i>
							<?php _e("Album Preview", gallery_bank); ?>
						</h4>
					</div>
					<div class="widget-layout-body">
						<a class="btn btn-inverse" href="admin.php?page=gallery_bank"><?php _e("Back to Albums", gallery_bank); ?></a>
						<div class="separator-doubled"></div>
						<div class="fluid-layout">
							<div class="layout-span12">
								<div class="widget-layout">
									<div class="widget-layout-title">
										<h4><?php echo stripcslashes(htmlspecialchars_decode($album)); ?></h4>
									</div>
									<div class="layout-control-group">
										<ul class="breadcrumb">
											<li>
												<label class="layout-control-label">
													<strong>
														<?php _e("Images in Row", gallery_bank); ?> :
													</strong>
												</label>
												<select id="ux_ddl_ImagesRow" class="layout-span3" style="margin-left: 16px;"
													onchange="select_imges_in_row();">
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
									<div class="widget-layout-body">
										<div id="gallery_bank_container" class="gallery_images">
											<?php
											$class_gb = ($lightbox_type == "GB_lightbox" ? "gb".$unique_id : "");
											for ($flag = 0;$flag < count($pics);$flag++)
											{
	                                            $image_title = $image_desc_setting == 1 && $pics[$flag]->title != "" ? "<h5>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))). "</h5>" : "";
	                                            $image_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? "<p>" . esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) ."</p>" : "";
	                                            $photoswipe_title = $image_title_setting == 1 && $pics[$flag]->title != "" ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->title)))) : "";
												$photoswipe_description = $image_desc_setting == 1 && $pics[$flag]->description != ""  ? esc_attr(html_entity_decode(stripcslashes(htmlspecialchars($pics[$flag]->description)))) : "";
	                                            switch ($lightbox_type)
												{
													case "pretty_photo":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a rel="prettyPhoto[gallery]" href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>"
																data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a rel="prettyPhoto[gallery]"
																	href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																	data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div" target="<?php echo $url_redirect;?>"
															data-title="<?php echo $image_title; ?>">
															<?php
														}
													break;
													case "color_box":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank"
																data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a class="colorbox"
																href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																data-title="<?php echo $image_title . $image_description; ?>" id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div" target="<?php echo $url_redirect;?>"
															data-title="<?php echo $image_title . $image_description; ?>">
															<?php
														}
													break;
													case "photo_swipe":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>" target="_blank"
																id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description; ?>"
																id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>"
															id="ux_img_div" target="<?php echo $url_redirect;?>">
															<?php
														}
													break;
													case "foo_box":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a rel="foobox" class="foobox"
																href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>"
																id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a rel="foobox" class="foobox"
																	href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																	id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>" id="ux_img_div"
															target="<?php echo $url_redirect;?>">
															<?php
														}
													break;
													case "fancy_box":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a rel="fancybox-button" data-fancybox-group="button"
																class="fancybox-buttons fancybox-media"
																href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>"
																data-title="<?php echo $image_title . $image_description; ?>"
																id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a rel="fancybox-button" data-fancybox-group="button"
																class="fancybox-buttons"
																href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																data-title="<?php echo $image_title . $image_description; ?>"
																id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>"
															id="ux_img_div" target="<?php echo $url_redirect;?>"
															data-title="<?php echo $image_title; ?>">
															<?php
														}
													break;
													case "lightbox2":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if ($pics[$flag]->video == 1)
															{
																?>
																<a href="<?php echo stripcslashes($pics[$flag]->pic_name); ?>"
																target="_blank"
																data-title="<?php echo $image_title . $image_description; ?>"
																id="ux_img_div">
																<?php
															}
															else
															{
																?>
																<a data-lightbox="gallery"
																href="<?php echo stripcslashes(GALLERY_BK_THUMB_URL . $pics[$flag]->thumbnail_url); ?>"
																data-title="<?php echo $image_title . $image_description; ?>"
																id="ux_img_div">
																<?php
															}
														}
														else
														{
															?>
															<a href="<?php echo $pics[$flag]->url; ?>"
															id="ux_img_div" target="<?php echo $url_redirect;?>"
															data-title="<?php echo $image_title; ?>">
															<?php
														}
													break;
													case "GB_lightbox":
														if ($pics[$flag]->url == "" || $pics[$flag]->url == "undefined" || $pics[$flag]->url == "http://")
														{
															if($pics[$flag]->video == 1)
															{
																?>
																<a imgpath="<?php echo $pics[$flag]->pic_name; ?>" href="javascript:void(0);" class="<?php echo $class_gb; ?>"
																data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description;?>"
																id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
																<?php
															}
															else
															{
																?>
																<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" href="javascript:void(0);" class="<?php echo $class_gb; ?>"
																data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description;?>"
																id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>">
																<?php
															}
														}
														else
														{
															?>
															<a imgpath="<?php echo $pics[$flag]->thumbnail_url; ?>" href="<?php echo $pics[$flag]->url; ?>"
															id="ux_img_div_<?php echo $pics[$flag]->pic_id; ?>" target="<?php echo $url_redirect;?>" class="<?php echo $class_gb; ?>"
															data-title="<?php echo $photoswipe_title; ?>" desc="<?php echo $photoswipe_description;?>">
															<?php
														}
													break;
												}
												?>
													<div class="imgLiquidFill dynamic_css">
														<?php
														if ($pics[$flag]->video == 1) {
															?>
															<img alt="<?php echo $image_title . $image_description; ?>" imageid="<?php echo $pics[$flag]->pic_id; ?>" id="ux_gb_img" type="video"
		                                                    src="<?php echo stripcslashes($pics[$flag]->thumbnail_url); ?>"/>
			                                            <?php
			                                            } else {
			                                                ?>
			                                                <img alt="<?php echo $image_title . $image_description; ?>" imageid="<?php echo $pics[$flag]->pic_id; ?>"
			                                                    id="ux_gb_img" type="image" src="<?php echo stripcslashes(GALLERY_BK_THUMB_SMALL_URL . $pics[$flag]->thumbnail_url); ?>"/>
			                                            <?php
			                                            }
			                                            ?>
												</div>
												</a>
		                                      <?php
											}
		                                    if ($pagination_setting == 1) {
		                                        ?>
		                                        <div class="holder"
		                                             id="holder"></div>
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
	
	<?php
	include GALLERY_BK_PLUGIN_DIR . "/views/includes_common_after.php";
	?>
	<script type="text/javascript">
	    function select_imges_in_row() {
	        var row = jQuery("#ux_ddl_ImagesRow").val();
	        window.location.href = "<?php echo site_url();?>/wp-admin/admin.php?page=album_preview&album_id=<?php echo $album_id;?>&row=" + row;
	    }
	</script>
<?php 
}
?>