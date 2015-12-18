<?php
  global $cewip;
?>
<div class="wrap">
  <div id="icon-tools" class="icon32"></div>
  <h2>Socials</h2>
  <p>Define socials profile links</p>

  <form class="work_form" action="options.php" method="post">
		<?php settings_fields( 'livestock-socials-group' ); ?>

    <fieldset>
      <div class="block">
        <label>Twitter</label>
        <input type="text" name="social_twitter" value="<?php echo esc_url( get_option( 'social_twitter' ) ); ?>" />   
      </div>
      <div class="block">
        <label>Facebook</label>
        <input type="text" name="social_facebook" value="<?php echo esc_url(  get_option( 'social_facebook' ) ); ?>" />   
      </div>
      <div class="block">
        <label>Instagram</label>
        <input type="text" name="social_instagram" value="<?php echo esc_url(  get_option( 'social_instagram' ) ); ?>" />   
      </div>
      <div class="block">
        <label>YouTube</label>
        <input type="text" name="social_youtube" value="<?php echo esc_url(  get_option( 'social_youtube' ) ); ?>" />   
      </div>
      <div class="block">
        <label>LinkedIn</label>
        <input type="text" name="social_linkedin" value="<?php echo esc_url(  get_option( 'social_linkedin' ) ); ?>" />   
      </div>
    </fieldset>

    <fieldset style="margin-top: 15px;">
  		<button type="submit" class="button button-primary"><?php _e( 'Save' , 'Livestock Socials' ); ?></button>
  	</fieldset>
  </form>
</div>