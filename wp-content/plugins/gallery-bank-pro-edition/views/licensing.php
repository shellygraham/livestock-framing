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
	$wpdb->query
	(
		$wpdb->prepare
		(
			"UPDATE " . gallery_bank_licensing() . " SET version = %s, type = %s, url = %s ",
			"3.8.7",
			"Gallery Bank Pro Edition",
			"" . site_url() . ""
		)
	);
	$licensing = $wpdb->get_row
	(
	    "SELECT * FROM " . gallery_bank_licensing()
	);
	?>
	
	<!--suppress ALL -->
	<form id="gallery_bank_licensing" class="layout-form" method="post">
	    <div class="fluid-layout">
	        <div class="layout-span12">
	            <ul class="breadcrumb">
	                <li>
	                    <i class="icon-home"></i>
	                    <a href="admin.php?page=gallery_bank"><?php _e("Gallery Bank", gallery_bank); ?></a>
	                    <span class="divider">/</span>
	                    <a href="#"><?php _e("Gallery Bank Licensing Module", gallery_bank); ?></a>
	                </li>
	            </ul>
	            <div class="custom-message green" id="licensing_success_message" style="display: none;margin-bottom: 10px;">
					<span>
						<strong id="licensing_message"></strong>
					</span>
	            </div>
	            <div class="custom-message red" id="error_licensing_message" style="display: none;margin-bottom: 10px;">
					<span>
						<strong id="licensing_error_message"></strong>
					</span>
	            </div>
	            <div class="widget-layout">
	                <div class="widget-layout-title">
	                    <h4><?php _e("Gallery Bank Licensing Module", gallery_bank); ?></h4>
						<span class="tools">
							<a data-target="#licensing_div" data-toggle="collapse">
	                            <i class="icon-chevron-down"></i>
	                        </a>
						</span>
	                </div>
	                <div id="licensing_div" class="collapse in">
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <label class="layout-control-label">Version :</label>
	
	                            <div class="layout-controls">
	                            	<input type="text" class="layout-span12" readonly="readonly" name="ux_version"
	                                       id="ux_version" value="<?php echo $licensing->version; ?>"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <label class="layout-control-label">Type :</label>
	
	                            <div class="layout-controls">
	                            	<input type="text" class="layout-span12" readonly="readonly" name="ux_type"
	                                       id="ux_type" value="<?php echo $licensing->type; ?>"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <label class="layout-control-label">URL :</label>
	
	                            <div class="layout-controls">
	                                <input type="text" class="layout-span12" readonly="readonly" name="ux_site_url"
	                                       id="ux_site_url" value="<?php echo $licensing->url; ?>"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <label class="layout-control-label">API Key :</label>
	
	                            <div class="layout-controls">
	                                <input type="text" class="layout-span12" name="ux_api_key" id="ux_api_key"
	                                       value="<?php echo $licensing->api_key; ?>"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <label class="layout-control-label">Order ID :</label>
	
	                            <div class="layout-controls">
	                                <input type="text" class="layout-span12" onkeypress="return OnlyNumbers(event)" name="ux_order_id" id="ux_order_id"
	                                  onfocus="prevent_paste(this);" value="<?php echo $licensing->order_id; ?>"/>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="widget-layout-body">
	                        <div class="layout-control-group">
	                            <div class="layout-controls">
	                                <button type="submit" class="btn btn-info"><?php _e("Update", gallery_bank); ?></button>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</form>
	<script type="text/javascript">
	
	    jQuery("#gallery_bank_licensing").validate
	    ({
	        rules: {
	            ux_api_key: {
	                required: true
	
	            },
	            ux_order_id: {
	                required: true
	
	            }
	        },
	        submitHandler: function (form) {
	        	var domain_url = "<?php echo site_url();?>";
	            jQuery.post("http://tech-banker.com/wp-admin/admin-ajax.php", jQuery(form).serialize() +
	                "&ux_product_key=17130&ux_domain="+domain_url+"&param=license&action=license_validator", function (data) {
	               if(data == "")
	               {
	               		
	               		jQuery("#error_licensing_message").css("display", "none");
	               		jQuery("#licensing_message").html("<?php _e("Success! Settings have been updated.", gallery_bank); ?>");
	               		jQuery("#licensing_success_message").css("display", "block");
	               		jQuery.post(ajaxurl, jQuery(form).serialize() +"&param=update_licensing_settings&action=settings_gallery_library", function (data) 
					    {
							setTimeout(function () {
				                jQuery("#licensing_success_message").css("display", "none");
				                window.location.href = "admin.php?page=gallery_bank";
				            }, 2000);
							
			            });
	               }
	               else
	               {
	               		jQuery("#licensing_success_message").css("display", "none");
	               		jQuery("#licensing_error_message").html(data);
	               		jQuery("#error_licensing_message").css("display", "block");
	               		
	               }
	               
	            });
	        }
	    });
	    function prevent_paste(control)
		{
			 jQuery(control).live("paste",function(e)
			 {
			 	e.preventDefault();
			 });
		}
	    function OnlyNumbers(evt) {
	    	var regex = new RegExp("^[0-9\b]*$");
			  var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
			  if (regex.test(evt)) 
			  {
				   e.preventDefault();
				   return false;
			  }
			  return true;
	    }
	</script>
<?php 
}
?>