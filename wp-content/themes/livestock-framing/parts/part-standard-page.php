<?php
/**
 *
 * Basic page template
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
global $livestock_page_properties;
if ( have_posts() ) : while ( have_posts() ) : the_post();
$custom = $livestock_page_properties->get_page_custom();
$subhead = $custom['subhead'];
?>
<section id="" class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow fadeInUp"><?php the_title(); ?></h2>
        <?php if ( $subhead != '' ) : ?><p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo $subhead; ?></p><?php endif; ?>
      </div>
    </div>
</section>
<section id="page" class="standard-page">
  <div class="container">
    <div class="row frame-detail">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>