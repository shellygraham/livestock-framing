<?php
/**
 * 
 * Component Name: How it Works
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */

?>
 <section id="howitworks" class="how-it-works">

  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow"><?php echo $section_options['section_title']; ?></h2>
        <?php if ( isset( $section_options['section_subtitle'] ) && $section_options['section_subtitle'] != '' ) : ?><p class="wow" data-wow-delay="0.2s"><?php echo $section_options['section_subtitle']; ?></p><?php endif; ?>
        <?php if ( isset( $section_options['section_video'] ) && $section_options['section_video'] != '' ) : ?>
          <p class="wow" data-wow-delay="0.2s"><a class="iframe-modal" href="<?php echo esc_url( $section_options['section_video'] ); ?>" style="font-size: 90%;"><i class="fa fa-play"></i> <?php echo $section_options['section_video_text']; ?></a></p>
        <?php endif; ?>
      </div>
    </div>
    <?php if ( isset( $section_options['section_content'] ) && $section_options['section_content'] != '' ) : ?>
    <div class="row" style="margin-bottom: 30px;">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lgoffset-2 col-md-offset-2">
        <?php echo wpautop( $section_options['section_content'] ); ?>
      </div>
    </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item">
        <div class="icon">
          <img class="img-circle  wow" data-wow-delay="" src="<?php bloginfo( 'template_directory' ); ?>/mk_thumb.php?h=360&w=360&src=<?php echo $section_options['step1_image']; ?>" />
        </div>
        <div class="excerpt wow" data-wow-delay="0.15s">
          <h3><?php echo $section_options['step1_title']; ?></h3>
          <p><?php echo $section_options['step1_detail']; ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item">
        <div class="icon">
          <img class="img-circle wow" data-wow-delay="" src="<?php bloginfo( 'template_directory' ); ?>/mk_thumb.php?h=360&w=360&src=<?php echo $section_options['step2_image']; ?>" />
        </div>
        <div class="excerpt wow" data-wow-delay="0.15s">
          <h3><?php echo $section_options['step2_title']; ?></h3>
          <p><?php echo $section_options['step2_detail']; ?></p>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 item">
        <div class="icon">
          <img class="img-circle wow" data-wow-delay="" src="<?php bloginfo( 'template_directory' ); ?>/mk_thumb.php?h=360&w=360&src=<?php echo $section_options['step3_image']; ?>" />
        </div>
        <div class="excerpt wow" data-wow-delay="0.15s">
          <h3><?php echo $section_options['step3_title']; ?></h3>
          <p><?php echo $section_options['step3_detail']; ?></p>
        </div>
      </div>
    </div>
  </div>
</section>