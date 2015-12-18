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
	include GALLERY_BK_PLUGIN_DIR . "/lib/include_roles_settings.php";
?>
	<div id="welcome-panel" class="welcome-panel" style="padding:0px !important;background-color: #f9f9f9 !important">
		<div class="welcome-panel-content">
			<img src="<?php echo plugins_url("/assets/images/gallery-bank.png" , dirname(__FILE__)); ?>" />
			<div class="welcome-panel-column-container">
				<div class="welcome-panel-column" style="width:240px !important;">
					<h4 class="welcome-screen-margin">
						<?php _e("Get Started", gallery_bank); ?>
					</h4>
						<a class="button button-primary button-hero" target="_blank" href="http://vimeo.com/92378296">
							<?php _e("Watch Gallery Video!", gallery_bank); ?>
						</a>
						<p>or, 
							<a target="_blank" href="http://tech-banker.com/products/wp-gallery-bank/knowledge-base/">
								<?php _e("read documentation here", gallery_bank); ?>
							</a>
						</p>
				</div>
				<div class="welcome-panel-column" style="width:250px !important;">
					<h4 class="welcome-screen-margin"><?php _e("Premium Editions", gallery_bank); ?></h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/products/wp-gallery-bank/" target="_blank" class="welcome-icon">
								<?php _e("Features", gallery_bank); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-gallery-bank/demo/" target="_blank" class="welcome-icon">
								<?php _e("Online Demos", gallery_bank); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/" target="_blank" class="welcome-icon">
								<?php _e("Our Other Products", gallery_bank); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="welcome-panel-column" style="width:240px !important;">
					<h4 class="welcome-screen-margin">
						<?php _e("Knowledge Base", gallery_bank); ?>
					</h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/forums/forum/gallery-bank-support/" target="_blank" class="welcome-icon">
								<?php _e("Support Forum", gallery_bank); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-gallery-bank/knowledge-base/" target="_blank" class="welcome-icon">
								<?php _e("FAQ's", gallery_bank); ?>
							</a>
						</li>
						<li>
							<a href="http://tech-banker.com/products/wp-gallery-bank/" target="_blank" class="welcome-icon">
								<?php _e("Detailed Features", gallery_bank); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class="welcome-panel-column welcome-panel-last" style="width:250px !important;">
					<h4 class="welcome-screen-margin"><?php _e("More Actions", gallery_bank); ?></h4>
					<ul>
						<li>
							<a href="http://tech-banker.com/shop/plugin-customization/order-customization-wp-gallery-bank/" target="_blank" class="welcome-icon">
								<?php _e("Order Customization", gallery_bank); ?>
							</a>
						</li>
						<li>
							<?php 
							switch ($gb_role) 
							{
								case "administrator":
									if ($admin_full_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
									elseif ($admin_write_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
								break;
								case "editor":
									if ($editor_full_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
									elseif ($editor_write_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
								break;
								case "author":
									if ($author_full_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
									elseif ($author_write_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
								break;
								case "contributor":
									if ($contributor_full_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
									elseif ($contributor_write_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
								break;
								case "subscriber":
									if ($subscriber_full_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
									elseif ($subscriber_write_control == "1")
									{
										?>
										<a href="admin.php?page=gallery_bank_recommended_plugins" class="welcome-icon">
											<?php _e("Recommendations", gallery_bank); ?>
										</a>
										<?php 
									}
								break;
							}
							?>
							
						</li>
						<li>
							<a href="admin.php?page=gallery_bank_other_services" class="welcome-icon">
								<?php _e("Our Other Services", gallery_bank); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php 
	switch ($gb_role) {
		case "administrator":
			if ($admin_full_control == "0" && $admin_read_control == "1" && $admin_write_control == "0") {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			} elseif ($admin_full_control == "0" && ($admin_read_control == "1" || $admin_write_control == "1")) {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			elseif($admin_full_control == "0" && $admin_read_control == "0" && $admin_write_control == "0")
			{
			}
			else {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			break;
		case "editor":
			if ($editor_full_control == "0" && $editor_read_control == "1" && $editor_write_control == "0") {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			} elseif ($editor_full_control == "0" && ($editor_read_control == "1" || $editor_write_control == "1")) {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			elseif ($editor_full_control == "0" && $editor_read_control == "0" && $editor_write_control == "0")
			{}
			else {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			break;
		case "author":
			if ($author_full_control == "0" && $author_read_control == "1" && $author_write_control == "0") {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			} elseif ($author_full_control == "0" && ($author_read_control == "1" || $author_write_control == "1")) {
				
			}
			elseif ($author_full_control == "0" && $author_read_control == "0" && $author_write_control == "0")
			{}
			else {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			break;
		case "contributor":
			if ($contributor_full_control == "0" && $contributor_read_control == "1" && $contributor_write_control == "0") {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			} elseif ($contributor_full_control == "0" && ($contributor_read_control == "1" || $contributor_write_control == "1")) {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			elseif ($contributor_full_control == "0" && $contributor_read_control == "0" && $contributor_write_control == "0")
			{
			}
			else {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			break;
		case "subscriber":
			if ($subscriber_full_control == "0" && $subscriber_read_control == "1" && $subscriber_write_control == "0") {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			} elseif ($subscriber_full_control == "0" && ($subscriber_read_control == "1" || $subscriber_write_control == "1")) {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			elseif ($subscriber_full_control == "0" && $subscriber_read_control == "0" && $subscriber_write_control == "0")
			{}
			else {
				?>
				<h2 class="nav-tab-wrapper">
					<a class="nav-tab " id="gallery_bank" href="admin.php?page=gallery_bank"><?php _e("Dashboard", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_album_sorting" href="admin.php?page=gallery_album_sorting"><?php _e("Album Sorting", gallery_bank);?></a>
					<a class="nav-tab " id="global_settings" href="admin.php?page=global_settings"><?php _e("Global Settings", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_system_status" href="admin.php?page=gallery_bank_system_status"><?php _e("System Status", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_recommended_plugins" href="admin.php?page=gallery_bank_recommended_plugins"><?php _e("Recommendations", gallery_bank);?></a>
					<a class="nav-tab " id="gallery_bank_other_services" href="admin.php?page=gallery_bank_other_services"><?php _e("Our Other Services", gallery_bank);?></a>
				</h2>
				<?php 
			}
			break;
	}
	if($_REQUEST["page"] != "gallery_bank_feature_request")
	{
		?>
		<div class="custom-message green" style="display: block;margin-top:30px">
			<div style="padding: 4px 0;">
				<p style="font:12px/1.0em Arial !important;font-weight:bold;">If you don't find any features you were looking for in this Plugin, 
					please write us <a target="_self" href="admin.php?page=gallery_bank_feature_request">here</a> and we shall try to implement this for you as soon as possible! We are looking forward for your valuable <a target="_self" href="admin.php?page=gallery_bank_feature_request">Feedback</a></p>
			</div>
		</div>
		<?php
	}
	?>
	<script type="text/javascript">
	jQuery(document).ready(function()
	{
		jQuery(".nav-tab-wrapper > a#<?php echo $_REQUEST["page"];?>").addClass("nav-tab-active");
	});
	</script>
<?php 
}
?>