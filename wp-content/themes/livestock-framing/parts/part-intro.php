<?php
/**
 * 
 * Component Name: Intro
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>
<section class="intro mobile-only">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        <div class="tagline"><?php echo $section_options['tagline']; ?></div>
        <?php echo wpautop( $section_options['section_intro'] ); ?>
        <p class="cta"><a class="btn btn-white" href="#howitworks" onclick="_gaq.push([ '_trackEvent', 'Intro Section', 'Learn More' ]); "><?php echo $section_options['button_text']; ?></a><?php echo $section_options['alt_text']; ?></p>
      </div>
    </div>
  </div>
  <div class="darken" style="background: rgba( 0, 0, 0, <?php echo ( (int)$section_options['darken_background'] * 0.01 ) ; ?> );"></div>
  <div class="photo" style="background-image: url( <?php echo $section_options['background_image']; ?> )"></div>
</section>
<?php masterslider(2); ?>