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
	
	$last_album_id = $wpdb->get_var
	(
		"SELECT album_id FROM " .gallery_bank_albums(). " order by album_id desc limit 1"
	);
	$id = count($last_album_id) == 0 ? 1 : $last_album_id + 1;
	
	
	$album = $wpdb->get_results
	(
		"SELECT * FROM ".gallery_bank_albums()." order by album_order asc "
	);
	$album_css = $wpdb->get_results
	(
		"SELECT * FROM ".gallery_bank_settings()
	);
	if(count($album_css) != 0)
	{
		$setting_keys= array();
		for($flag=0;$flag<count($album_css);$flag++)
		{
			array_push($setting_keys,$album_css[$flag]->setting_key);
		}
		$index = array_search("cover_thumbnail_width", $setting_keys);
		$cover_thumbnail_width = $album_css[$index]->setting_value;
		
		$index = array_search("cover_thumbnail_height", $setting_keys);
		$cover_thumbnail_height = $album_css[$index]->setting_value;
		
		$index = array_search("cover_thumbnail_opacity", $setting_keys);
		$cover_thumbnail_opacity = $album_css[$index]->setting_value;
		
		$index = array_search("cover_thumbnail_border_size", $setting_keys);
		$cover_thumbnail_border_size = $album_css[$index]->setting_value;
		
		$index = array_search("cover_thumbnail_border_radius", $setting_keys);
		$cover_thumbnail_border_radius = $album_css[$index]->setting_value;
		
		$index = array_search("cover_thumbnail_border_color", $setting_keys);
		$cover_thumbnail_border_color = $album_css[$index]->setting_value;
		
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
	}
?>
<!--suppress ALL -->
        <style type="text/css">
	.dynamic_cover_css{
		border:<?php echo $cover_thumbnail_border_size;?>px solid <?php echo $cover_thumbnail_border_color;?> ;
		-moz-border-radius:<?php echo $cover_thumbnail_border_radius; ?>px;
		-webkit-border-radius:<?php echo $cover_thumbnail_border_radius; ?>px;
		-khtml-border-radius:<?php echo $cover_thumbnail_border_radius; ?>px;
		-o-border-radius:<?php echo $cover_thumbnail_border_radius; ?>px;
		border-radius:<?php echo $cover_thumbnail_border_radius;?>px;
		opacity:<?php echo $cover_thumbnail_opacity;?>;
		-moz-opacity:<?php echo $cover_thumbnail_opacity;?>;
		-khtml-opacity:<?php echo $cover_thumbnail_opacity;?>;
	}
	.imgLiquidFill
		{
			width:<?php echo $cover_thumbnail_width;?>px;
			height:<?php echo $cover_thumbnail_height;?>px;
		}
</style>
<div id="outdated_message" class="custom-message red" style="display: none;"> 
	<span>
		<strong>
			<?php _e("Attention! A new vesion of Gallery Bank is available for download.", gallery_bank); ?>
			<?php _e("Click", gallery_bank); ?> <a style="text-decoration:underline !important;" href="plugins.php#gallery-bank-pro-edition"><?php _e("here", gallery_bank); ?></a>
			<?php _e("to upgrade your version of Gallery Bank.", gallery_bank); ?>
	    </strong>
	</span>
</div>
<div class="fluid-layout">
	<div class="layout-span12">
		<div class="widget-layout">
			<div class="widget-layout-title">
				<h4><?php _e( "Dashboard - Gallery Bank", gallery_bank ); ?></h4>
			</div>
			<div class="widget-layout-body">
				<?php
				switch($gb_role)
				{
					case "administrator":
						if($admin_write_control == "1" && $admin_read_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
						elseif($admin_write_control == "1" || $admin_full_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
					break;
					case "editor":
						if($editor_write_control == "1" && $editor_read_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
						elseif($editor_full_control == "1" || $editor_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
					break;
					case "author":
						if($author_read_control == "1" && $author_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
						elseif($author_full_control == "1" || $author_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
					break;
					case "contributor":
						if($contributor_read_control == "1" && $contributor_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
						elseif($contributor_full_control == "1" || $contributor_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
					break;
					case "subscriber":
						if($subscriber_read_control == "1" && $subscriber_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
						elseif($subscriber_full_control == "1" || $subscriber_write_control == "1")
						{
							?>
							<a class="btn btn-info" href="admin.php?page=save_album&album_id=<?php echo $id; ?>"><?php _e("Add New Album", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="delete_all_albums();"><?php _e("Delete All Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="purge_all_images();"><?php _e("Purge Images & Albums", gallery_bank);?></a>
							<a class="btn btn-danger" href="#" onclick="restore_factory_settings();"><?php _e("Restore Factory Settings", gallery_bank);?></a>
							<?php
						}
					break;
				}
				?>
				<div class="separator-doubled"></div>
				<div class="fluid-layout">
					<div class="layout-span12">
						<div class="widget-layout">
							<div class="widget-layout-title">
								<h4><?php _e( "Existing Albums Overview", gallery_bank ); ?></h4>
							</div>
							<div class="widget-layout-body">
								<table class="table table-striped " id="data-table-album">
									<thead>
										<tr>
											<th style="width:24%"><?php _e( "Thumbnail", gallery_bank ); ?></th>
											<th style="width:10%"><?php _e( "Album Id", gallery_bank ); ?></th>
											<th style="width:12%"><?php _e( "Album Title", gallery_bank ); ?></th>
											<th style="width:11%"><?php _e( "Total Images", gallery_bank ); ?></th>
											<th style="width:14%"><?php _e( "Date of Creation", gallery_bank ); ?></th>
											<th style="width:27%"></th>
										</tr>
									</thead>
									<tbody>
										<?php
										for($flag=0; $flag <count($album); $flag++)
										{
											$count_pic = $wpdb->get_var
											(
												$wpdb->prepare
												(
													"SELECT count(".gallery_bank_albums().".album_id) FROM ".gallery_bank_albums()." join ".gallery_bank_pics()." on ".gallery_bank_albums().".album_id =  ".gallery_bank_pics().".album_id where ".gallery_bank_albums().".album_id = %d ",
													$album[$flag]->album_id
												)
											);
											$albumCover = $wpdb->get_row
											(
												$wpdb->prepare
												(
													"SELECT album_cover,thumbnail_url,video FROM ".gallery_bank_pics()." WHERE album_cover=1 and album_id = %d",
													$album[$flag]->album_id
												)
											);
											?>
												<tr>
													<td>
														<?php
														switch($gb_role)
														{
															case "administrator":
																if($admin_full_control == "0" && $admin_read_control == "1" && $admin_write_control == "0")
																{
																	?>
																	<a href="#" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
																else
																{
																	?>
																	<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
															break;
															case "editor":
																if($editor_full_control == "0" && $editor_read_control == "1" && $editor_write_control == "0")
																{
																	?>
																	<a href="#" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
																else
																{
																	?>
																	<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
															break;
															case "author":
																if($author_full_control == "0" && $author_read_control == "1" && $author_write_control == "0")
																{
																	?>
																	<a href="#" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
																else
																{
																	?>
																	<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
															break;
															case "contributor":
																if($contributor_full_control == "0" && $contributor_read_control == "1" && $contributor_write_control == "0")
																{
																	?>
																	<a href="#" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
																else
																{
																	?>
																	<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
															break;
															case "subscriber":
																if($subscriber_full_control == "0" && $subscriber_read_control == "1" && $subscriber_write_control == "0")
																{
																	?>
																	<a href="#" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
																else
																{
																	?>
																	<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" title="<?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?>" >
																	<?php
																}
															break;
														}
														?>
														<div class="imgLiquidFill dynamic_cover_css">
														<?php
														if(count($albumCover) != 0)
														{
															if($albumCover->album_cover == 0)
															{
																?>
																<img src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>"  />
																<?php
															}
															elseif($albumCover->album_cover == 1 && $albumCover->video == 1)
															{
																?> 
																<img src="<?php echo stripcslashes($albumCover->thumbnail_url); ?>"   />
																<?php
															}
															else
															{
																?> 
																<img src="<?php echo stripcslashes(GALLERY_BK_ALBUM_THUMB_URL.$albumCover->thumbnail_url); ?>"   />
																<?php
															}
														}
														else 
														{
															?> 
															<img src="<?php echo stripcslashes(plugins_url("/assets/images/album-cover.png",dirname(__FILE__))); ?>"   />	
															<?php
														}
														?>
														</div>
														</a>
													</td>
													<td><?php echo $album[$flag]->album_id;?></td>
													<td><?php echo stripcslashes(htmlspecialchars_decode($album[$flag] -> album_name));?></td>
													<td><?php echo $count_pic;?></td>
													<td><?php echo date("d-M-Y", strtotime($album[$flag] -> album_date));?></td>
													<td>
														<ul class="layout-table-controls">
															<?php
															switch($gb_role)
															{
																case "administrator":
																	if($admin_full_control == "0" && $admin_read_control == "1" && $admin_write_control == "0")
																	{
																		?>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<?php
																	}
																	else
																	{
																		?>
																		<li>
																			<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Edit Album", gallery_bank ); ?>">
																				<i class="icon-pencil" ></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=images_sorting&album_id=<?php echo $album[$flag]->album_id;?>&row=3" class="btn hovertip" data-original-title="<?php _e( "Re-Order Images", gallery_bank ); ?>">
																				<i class="icon-th"></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<li>
																			<a class="btn hovertip "  style="cursor: pointer;" data-original-title="<?php _e( "Delete Album", gallery_bank)?>" onclick="delete_album(<?php echo $album[$flag]->album_id;?>);" >
																				<i class="icon-trash"></i>
																			</a>
																		</li>
																		<?php
																	}
																break;
																case "editor":
																	if($editor_full_control == "0" && $editor_read_control == "1" && $editor_write_control == "0")
																	{
																		?>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<?php
																	}
																	else
																	{
																		?>
																		<li>
																			<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Edit Album", gallery_bank ); ?>">
																				<i class="icon-pencil" ></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=images_sorting&album_id=<?php echo $album[$flag]->album_id;?>&row=3" class="btn hovertip" data-original-title="<?php _e( "Re-Order Images", gallery_bank ); ?>">
																				<i class="icon-th"></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<li>
																			<a class="btn hovertip "  style="cursor: pointer;" data-original-title="<?php _e( "Delete Album", gallery_bank)?>" onclick="delete_album(<?php echo $album[$flag]->album_id;?>);" >
																				<i class="icon-trash"></i>
																			</a>
																		</li>
																		<?php
																	}
																break;
																case "author":
																	if($author_full_control == "0" && $author_read_control == "1" && $author_write_control == "0")
																	{
																		?>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<?php
																	}
																	else
																	{
																		?>
																		<li>
																			<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Edit Album", gallery_bank ); ?>">
																				<i class="icon-pencil" ></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=images_sorting&album_id=<?php echo $album[$flag]->album_id;?>&row=3" class="btn hovertip" data-original-title="<?php _e( "Re-Order Images", gallery_bank ); ?>">
																				<i class="icon-th"></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<li>
																			<a class="btn hovertip " style="cursor: pointer;" data-original-title="<?php _e( "Delete Album", gallery_bank)?>" onclick="delete_album(<?php echo $album[$flag]->album_id;?>);" >
																				<i class="icon-trash"></i>
																			</a>
																		</li>
																		<?php
																	}
																break;
																case "contributor":
																	if($contributor_full_control == "0" && $contributor_read_control == "1" && $contributor_write_control == "0")
																	{
																		?>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<?php
																	}
																	else
																	{
																		?>
																		<li>
																			<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Edit Album", gallery_bank ); ?>">
																				<i class="icon-pencil" ></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=images_sorting&album_id=<?php echo $album[$flag]->album_id;?>&row=3" class="btn hovertip" data-original-title="<?php _e( "Re-Order Images", gallery_bank ); ?>">
																				<i class="icon-th"></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<li>
																			<a class="btn hovertip "  style="cursor: pointer;" data-original-title="<?php _e( "Delete Album", gallery_bank)?>" onclick="delete_album(<?php echo $album[$flag]->album_id;?>);" >
																				<i class="icon-trash"></i>
																			</a>
																		</li>
																		<?php
																	}
																break;
																case "subscriber":
																	if($subscriber_full_control == "0" && $subscriber_read_control == "1" && $subscriber_write_control == "0")
																	{
																		?>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<?php
																	}
																	else
																	{
																		?>
																		<li>
																			<a href="admin.php?page=save_album&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Edit Album", gallery_bank ); ?>">
																				<i class="icon-pencil" ></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=images_sorting&album_id=<?php echo $album[$flag]->album_id;?>&row=3" class="btn hovertip" data-original-title="<?php _e( "Re-Order Images", gallery_bank ); ?>">
																				<i class="icon-th"></i>
																			</a>
																		</li>
																		<li>
																			<a href="admin.php?page=album_preview&album_id=<?php echo $album[$flag]->album_id;?>" class="btn hovertip" data-original-title="<?php _e( "Preview Album", gallery_bank ); ?>">
																				<i class="icon-eye-open"></i>
																			</a>
																		</li>
																		<li>
																			<a class="btn hovertip "  style="cursor: pointer;" data-original-title="<?php _e( "Delete Album", gallery_bank)?>" onclick="delete_album(<?php echo $album[$flag]->album_id;?>);" >
																				<i class="icon-trash"></i>
																			</a>
																		</li>
																		<?php
																	}
																break;
															}
															?>
														</ul>
													</td>
												</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(".hovertip").tooltip();
jQuery(document).ready(function() 
{
	jQuery(".imgLiquidFill").imgLiquid({fill:true});
	var oTable = jQuery("#data-table-album").dataTable
	({
		"bJQueryUI": false,
		"bAutoWidth": true,
		"sPaginationType": "full_numbers",
		"sDom": '<"datatable-header"fl>t<"datatable-footer"ip>',
		"oLanguage": 
		{
			"sLengthMenu": "<span>Show entries:</span> _MENU_"
		},
		"aaSorting": [[ 0, "asc" ]],
		"aoColumnDefs": [{ "bSortable": false, "aTargets": [5] }]
	});
	<?php
	switch($gb_role)
	{
		case "administrator":
			if($admin_full_control == "1")
			{
				?>
					get_plugin_update();
				<?php
			}
		break;
		case "editor":
			if($editor_full_control == "1")
			{
				?>
				get_plugin_update();
			<?php
			}
		break;
		case "author":
			if($author_full_control == "1")
			{
				?>
				get_plugin_update();
			<?php
			}
		break;
		case "contributor":
			if($contributor_full_control == "1")
			{
				?>
				get_plugin_update();
				<?php
			}
		break;
		case "subscriber":
			if($subscriber_full_control == "1")
			{
				?>
				get_plugin_update();
				<?php
			}
		break;
	}
	?>
});
	function get_plugin_update()
	{
		jQuery.post("http://tech-banker.com/wp-admin/admin-ajax.php?param=check_update&action=license_validator", function (data)
		{
			<?php
			$checkVersion = get_option("gallery-bank-pro-edition");
			?>
			if(data != "<?php echo $checkVersion;?>")
			{
				jQuery("#outdated_message").css("display","block");
			}
		});
	}
	function delete_album(album_id) 
	{
		var r = confirm("<?php _e( "Are you sure you want to delete this Album?", gallery_bank ); ?>");
		if(r == true)
		{
			//noinspection JSUnresolvedVariable
            jQuery.post(ajaxurl, "album_id="+album_id+"&param=Delete_album&action=add_new_album_library", function()
			{
				var check_page = "<?php echo $_REQUEST["page"]; ?>";
				window.location.href = "admin.php?page="+check_page;
			});
		}
	}
	function delete_all_albums()
	{
		var r = confirm("<?php _e( "Are you sure you want to delete all Albums?", gallery_bank ); ?>");
		if(r == true)
		{
			jQuery.post(ajaxurl, "&param=delete_all_albums&action=add_new_album_library", function()
			{
				var check_page = "<?php echo $_REQUEST["page"]; ?>";
				window.location.href = "admin.php?page="+check_page;
			});
		}
	}
	function restore_factory_settings()
	{
		var r = confirm("<?php _e( "Are you sure you want to Restore Factory Settings?", gallery_bank ); ?>");
		if(r == true)
		{
			//noinspection JSUnresolvedVariable
            jQuery.post(ajaxurl, "&param=restore_factory_settings&action=add_new_album_library", function(data)
			{
				jQuery.post(ajaxurl, "&param=purge_all_images&action=add_new_album_library", function()
				{
					var check_page = "<?php echo $_REQUEST["page"]; ?>";
					window.location.href = "admin.php?page="+check_page;
				});
			});
		}
	}
	function purge_all_images()
	{
		var r = confirm("<?php _e( "Are you sure you want to Purge all Images & Albums?", gallery_bank ); ?>");
		if(r == true)
		{
			//noinspection JSUnresolvedVariable
            jQuery.post(ajaxurl, "&param=purge_all_images&action=add_new_album_library", function()
			{
				var check_page = "<?php echo $_REQUEST["page"]; ?>";
				window.location.href = "admin.php?page="+check_page;
			});
		}
	}
</script>
<?php 
}
?>