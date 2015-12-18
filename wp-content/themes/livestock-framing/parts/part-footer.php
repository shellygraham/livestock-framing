<!--
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<!--
	          <form class="form-newsletter" data-reactid=".1.3.0.0.1.0">
		          <label class="label-newsletter" for="input-newsletter">Newsletter</label>
		          <input id="input-newsletter" class="input-newsletter" type="email" placeholder="Email:">
		          <input value="> Submit" disabled="" class="submit-newsletter" type="submit">
		      </form>
-->

<!-- Begin MailChimp Signup Form -->

<!--
<form action="//livestockframing.us9.list-manage.com/subscribe/post?u=dcfda63c193f6481b935161b3&amp;id=aff17823d5" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate form-newsletter" novalidate>
    <label for="mce-EMAIL" class="label-newsletter">Newsletter</label>
    <input type="email" value="" name="EMAIL" class="email input-newsletter" id="mce-EMAIL input-newsletter" placeholder="Email:" required>
    <input type="submit" value="> Submit" name="subscribe" id="mc-embedded-subscribe" class="button submit-newsletter">
</form>

<!--End mc_embed_signup-->
<!--

          </div>
        </div>
      </div>
    </div>
-->
    <footer class="">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <p class="c-right">&copy; <? echo date( 'Y' ) ?> Livestock Framing</p>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <?php
              wp_nav_menu( array( 
                'theme_location' => 'footer', 
                'depth' => 1, 
                'menu_class' => 'nav-footer nav', 
                'walker' => new Walker_Bootstrap
              ) );
            ?>
          </div>
          <?php if ( class_exists( 'Livestock_Socials' ) ) : $livestock_socials = new Livestock_Socials(); $socials = $livestock_socials->get_socials(); ?>
          <?php if ( count( $socials ) > 0 ) : ?>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <p class="socials">
              <?php foreach( $socials as $network => $url ) : ?>
              <a href="<?php echo $url; ?>" class="social social-<?php echo $network; ?>" target="_blank" onclick="_gaq.push([ '_trackEvent', 'Footer Socials', 'Clicked', '<?php echo $network; ?>' ]);"><i class="fa fa-<?php echo $network; ?>"></i></a>
              <?php endforeach; ?>
            </p>
          </div>
          <?php endif; endif; ?>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
    <script type="text/javascript" src="//ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "19bc0296-ab17-4748-8dba-79492da8381d", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
  </body>
</html>
