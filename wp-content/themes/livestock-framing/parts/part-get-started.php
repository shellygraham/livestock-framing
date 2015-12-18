<?php
/**
 * 
 * Component Name: Get Started
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>
<section id="getstarted" class="get-started">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow"><?php echo $section_options['section_title']; ?></h2>
        <?php if ( $section_options['section_subtitle'] != '' ) : ?><p class="wow"><?php echo $section_options['section_subtitle']; ?></p><?php endif; ?>
      	<p class="wow"><a class="btn btn-white btn-lg" href="https://order.livestockframing.com/" targer="_blank" onclick="_gaq.push([ '_trackEvent', 'Get Started Section', 'Get Started' ]);"><?php echo $section_options['button_text'] ?>!</a></p>
      </div>
    </div>
  </div>
</section>