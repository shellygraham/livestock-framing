<?php
/**
 *
 * Component Name: The Print
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>
<section id="theprint" class="the-print" style="background-image: url( <?php echo $section_options['background_image']; ?> )">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow"><?php echo $section_options['section_title']; ?></h2>
        <?php if ( $section_options['section_subtitle'] != '' ) : ?><p class="wow" data-wow-delay="0.2s"><?php echo $section_options['section_subtitle']; ?></p><?php endif; ?>
      </div>
    </div>
    <div class="row frame-detail">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
        <?php echo wpautop( $section_options['section_content'] ); ?>
      </div>
    </div>
  </div>
</section>