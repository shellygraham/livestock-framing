<?php
/*
 Plugin Name: Gallery Bank Pro Edition
 Plugin URI: http://tech-banker.com
 Description: Gallery Bank is an interactive WordPress photo gallery plugin, best fit for creative and corporate portfolio websites.
 Author: Tech Banker
 Version: 3.8.7
 Author URI: http://tech-banker.com
*/
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   Define   Constants  ///////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!defined("GALLERY_FILE")) define("GALLERY_FILE","gallery-bank-pro-edition/gallery-bank.php");
if (!defined("GALLERY_MAIN_DIR")) define("GALLERY_MAIN_DIR", dirname(dirname(dirname(__FILE__)))."/gallery-bank");
if (!defined("GALLERY_MAIN_UPLOAD_DIR")) define("GALLERY_MAIN_UPLOAD_DIR", dirname(dirname(dirname(__FILE__)))."/gallery-bank/gallery-uploads/");
if (!defined("GALLERY_MAIN_THUMB_DIR")) define("GALLERY_MAIN_THUMB_DIR", dirname(dirname(dirname(__FILE__)))."/gallery-bank/thumbs/");
if (!defined("GALLERY_MAIN_ALB_THUMB_DIR")) define("GALLERY_MAIN_ALB_THUMB_DIR", dirname(dirname(dirname(__FILE__)))."/gallery-bank/album-thumbs/");
if (!defined("GALLERY_BK_PLUGIN_DIRNAME")) define("GALLERY_BK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if (!defined("GALLERY_BK_PLUGIN_DIR")) define("GALLERY_BK_PLUGIN_DIR",  plugin_dir_path( __FILE__ ));
if (!defined("GALLERY_BK_THUMB_URL")) define("GALLERY_BK_THUMB_URL", content_url()."/gallery-bank/gallery-uploads/");
if (!defined("GALLERY_BK_THUMB_SMALL_URL")) define("GALLERY_BK_THUMB_SMALL_URL", content_url()."/gallery-bank/thumbs/");
if (!defined("GALLERY_BK_ALBUM_THUMB_URL")) define("GALLERY_BK_ALBUM_THUMB_URL", content_url()."/gallery-bank/album-thumbs/");
if (!defined("GALLERY_BK_THUMB_WP_UPLOADS_URL")) define("GALLERY_BK_THUMB_WP_UPLOADS_URL", content_url());
if (!defined("GALLERY_BK_PLUGIN_BASENAME")) define("GALLERY_BK_PLUGIN_BASENAME", plugin_basename(__FILE__));
if (!defined("gallery_bank")) define("gallery_bank", "gallery-bank");
if (!defined("tech_bank")) define("tech_bank", "tech-banker");

if (!is_dir(GALLERY_MAIN_DIR))
{
	wp_mkdir_p(GALLERY_MAIN_DIR);
}
if (!is_dir(GALLERY_MAIN_UPLOAD_DIR))
{
	wp_mkdir_p(GALLERY_MAIN_UPLOAD_DIR);
}
if (!is_dir(GALLERY_MAIN_THUMB_DIR))
{
	wp_mkdir_p(GALLERY_MAIN_THUMB_DIR);
}
if (!is_dir(GALLERY_MAIN_ALB_THUMB_DIR))
{
	wp_mkdir_p(GALLERY_MAIN_ALB_THUMB_DIR);
}
require_once(GALLERY_BK_PLUGIN_DIR."/plugin-updates/plugin-update-checker.php");
$MyUpdateChecker = new PluginUpdateChecker(
    'http://tech-banker.com/wp-content/plugins/gallery-bank-pro-edition-3.1/lib/update-pro-edition.json',
    __FILE__,
    'gallery-bank-pro-edition'
);
/*************************************************************************************/
if (file_exists(GALLERY_BK_PLUGIN_DIR . "/lib/gallery-bank-class.php")) {
    require_once(GALLERY_BK_PLUGIN_DIR . "/lib/gallery-bank-class.php");
}
/*************************************************************************************/
function plugin_install_script_for_gallery_bank()
{
	global $wpdb;
	if (is_multisite())
	{
		$blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
		foreach($blog_ids as $blog_id)
		{
			switch_to_blog($blog_id);
			if(file_exists(GALLERY_BK_PLUGIN_DIR. "/lib/install-script.php"))
			{
				include GALLERY_BK_PLUGIN_DIR . "/lib/install-script.php";
			}
			restore_current_blog();
		}
	}
	else
	{
		if(file_exists(GALLERY_BK_PLUGIN_DIR. "/lib/install-script.php"))
		{
			include_once GALLERY_BK_PLUGIN_DIR . "/lib/install-script.php";
		}
	}
}

/*************************************************************************************/
function plugin_uninstall_script_for_gallery_bank()
{
	
}

/*************************************************************************************/
function gallery_bank_plugin_load_text_domain()
{
    if (function_exists("load_plugin_textdomain")) {
        load_plugin_textdomain(gallery_bank, false, GALLERY_BK_PLUGIN_DIRNAME . "/lang");
    }
}

function plugin_load_textdomain_for_tech_serices()
{
	if(function_exists( "load_plugin_textdomain" ))
	{
		load_plugin_textdomain(tech_bank, false, GALLERY_BK_PLUGIN_DIRNAME ."/tech-banker-services");
	}
}

/*************************************************************************************/
function add_gallery_bank_icon($meta = TRUE)
{
    global $wp_admin_bar;
    global $current_user, $wpdb;
    if (!is_user_logged_in()) {
        return;
    }
    if(is_super_admin())
    {
    	$gb_role = "administrator";
    }
    else
    {
    	$gb_role = $wpdb->prefix . "capabilities";
    	$current_user->role = array_keys($current_user->$gb_role);
    	$gb_role = $current_user->role[0];
    }

    include GALLERY_BK_PLUGIN_DIR . "/lib/include_roles_settings.php";
	$last_album_id = $wpdb->get_var
	(
		"SELECT album_id FROM " .gallery_bank_albums(). " order by album_id desc limit 1"
	);
	$id = count($last_album_id) == 0 ? 1 : $last_album_id + 1;
    switch ($gb_role) {
        case "administrator":
            if ($admin_full_control == "0" && $admin_read_control == "1" && $admin_write_control == "0") {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "our_services_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                    "title" => __("Our Other Services", gallery_bank))
                );
            } elseif ($admin_full_control == "0" && ($admin_read_control == "1" || $admin_write_control == "1")) {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            }
			elseif ($admin_full_control == "0" && $admin_read_control == "0" && $admin_write_control == "0")
			{
			}
			 else {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "global_settings_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=global_settings",
                    "title" => __("Global Settings", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                	"parent" => "gallery_bank_links",
                	"id" => "gallery_feature_request_links",
               		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_feature_request",
                	"title" => __("Feature Requests", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "system_status_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_system_status",
                    "title" => __("System Status", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "Licensing_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_licensing",
                    "title" => __("Licensing", gallery_bank))
                );

            }
            break;
        case "editor":
            if ($editor_full_control == "0" && $editor_read_control == "1" && $editor_write_control == "0") {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } elseif ($editor_full_control == "0" && ($editor_read_control == "1" || $editor_write_control == "1")) {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            }
			elseif ($editor_full_control == "0" && $editor_read_control == "0" && $editor_write_control == "0") {
			} else {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "global_settings_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=global_settings",
                    "title" => __("Global Settings", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "gallery_feature_request_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_feature_request",
                		"title" => __("Feature Requests", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "system_status_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_system_status",
                    "title" => __("System Status", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "Licensing_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_licensing",
                    "title" => __("Licensing", gallery_bank))
                );
            }
            break;
        case "author":
            if ($author_full_control == "0" && $author_read_control == "1" && $author_write_control == "0") {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } elseif ($author_full_control == "0" && ($author_read_control == "1" || $author_write_control == "1")) {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } 
			elseif ($author_full_control == "0" && $author_read_control == "0" && $author_write_control == "0") {
			} else {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "global_settings_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=global_settings",
                    "title" => __("Global Settings", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "gallery_feature_request_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_feature_request",
                		"title" => __("Feature Requests", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "system_status_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_system_status",
                    "title" => __("System Status", gallery_bank))
                );

               $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "Licensing_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_licensing",
                    "title" => __("Licensing", gallery_bank))
                );
            }
            break;
        case "contributor":
            if ($contributor_full_control == "0" && $contributor_read_control == "1" && $contributor_write_control == "0") {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } elseif ($contributor_full_control == "0" && ($contributor_read_control == "1" || $contributor_write_control == "1")) {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

               $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } 
			elseif ($contributor_full_control == "0" && $contributor_read_control == "0" && $contributor_write_control == "0") {
            } else {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "global_settings_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=global_settings",
                    "title" => __("Global Settings", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "gallery_feature_request_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_feature_request",
                		"title" => __("Feature Requests", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "system_status_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_system_status",
                    "title" => __("System Status", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "Licensing_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_licensing",
                    "title" => __("Licensing", gallery_bank))
                );
            }
            break;
        case "subscriber":
            if ($subscriber_full_control == "0" && $subscriber_read_control == "1" && $subscriber_write_control == "0") {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                	"parent" => "gallery_bank_links",
                	"id" => "our_services_links",
                	"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                	"title" => __("Our Other Services", gallery_bank))
                );
            } elseif ($subscriber_full_control == "0" && ($subscriber_read_control == "1" || $subscriber_write_control == "1")) {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

               $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );
            } 
			elseif ($subscriber_full_control == "0" && $subscriber_read_control == "0" && $subscriber_write_control == "0") {
			} else {
                $wp_admin_bar->add_menu(array(
                    "id" => "gallery_bank_links",
                    "title" => __("<img src=\"" . plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\"
                    height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Gallery Bank"),
                    "href" => __(site_url() . "/wp-admin/admin.php?page=gallery_bank"),
                ));

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "dashboard_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank",
                    "title" => __("Dashboard", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "add_new_album_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=save_album&album_id=".$id,
                    "title" => __("Add New Album", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "sorting_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_album_sorting",
                    "title" => __("Album Sorting", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "global_settings_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=global_settings",
                    "title" => __("Global Settings", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "gallery_feature_request_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_feature_request",
                		"title" => __("Feature Requests", gallery_bank))
                );
                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "system_status_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_system_status",
                    "title" => __("System Status", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "recommendation_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_recommended_plugins",
                    "title" => __("Recommendations", gallery_bank))
                );
                
                $wp_admin_bar->add_menu(array(
                		"parent" => "gallery_bank_links",
                		"id" => "our_services_links",
                		"href" => site_url() . "/wp-admin/admin.php?page=gallery_bank_other_services",
                		"title" => __("Our Other Services", gallery_bank))
                );

                $wp_admin_bar->add_menu(array(
                    "parent" => "gallery_bank_links",
                    "id" => "Licensing_links",
                    "href" => site_url() . "/wp-admin/admin.php?page=gallery_licensing",
                    "title" => __("Licensing", gallery_bank))
                );
            }
        break;
    }
}
function gallery_bank_custom_plugin_row($links,$file)
{
	if ($file == GALLERY_BK_PLUGIN_BASENAME)
	{
		$gallery_bank_row_meta = array(
				"docs"  => "<a href='".esc_url( apply_filters("gallery_bank_docs_url","http://tech-banker.com/products/wp-gallery-bank/knowledge-base/"))."' title='".esc_attr(__( "View Gallery Bank Documentation",gallery_bank))."'>".__("Docs",gallery_bank)."</a>",
		);
		return array_merge($links,$gallery_bank_row_meta);
	}
	return (array)$links;
}
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR PLUGIN UPDATE MESSAGE
//--------------------------------------------------------------------------------------------------------------//
if(!function_exists("gallery_bank_pro_plugin_update_message"))
{
	function gallery_bank_pro_plugin_update_message($args)
	{
		$response = wp_remote_get( "http://tech-banker.com/changelogs/readme-wp-gallery-bank.txt" );
		if ( ! is_wp_error( $response ) && ! empty( $response["body"] ) )
		{
			// Output Upgrade Notice
			$matches        = null;
			$regexp         = '~==\s*Changelog\s*==\s*=\s*[0-9.]+\s*=(.*)(=\s*' . preg_quote($args['Version']) . '\s*=|$)~Uis';
			$upgrade_notice = '';
			if ( preg_match( $regexp, $response["body"], $matches ) ) {
				$changelog = (array) preg_split('~[\r\n]+~', trim($matches[1]));
				$upgrade_notice .= "<div class=\"gallery_plugin_message\">";
				foreach ( $changelog as $index => $line ) {
					$upgrade_notice .= "<p>".$line."</p>";
				}
				$upgrade_notice .= "</div> ";
				echo $upgrade_notice;
			}
		}
	}
}
/*************************************************************************************/
$version = get_option("gallery-bank-pro-edition");
if($version == "" || $version != "")
{
	add_action("admin_init", "plugin_install_script_for_gallery_bank");
} 
add_action("admin_bar_menu", "add_gallery_bank_icon", 100);
add_filter("plugin_row_meta","gallery_bank_custom_plugin_row", 10, 2 );
add_action("plugins_loaded", "plugin_load_textdomain_for_tech_serices");
add_action("plugins_loaded", "gallery_bank_plugin_load_text_domain");
register_activation_hook(__FILE__, "plugin_install_script_for_gallery_bank");
register_uninstall_hook(__FILE__, "plugin_uninstall_script_for_gallery_bank");
add_action("in_plugin_update_message-".GALLERY_FILE,"gallery_bank_pro_plugin_update_message" );
/*************************************************************************************/
?>