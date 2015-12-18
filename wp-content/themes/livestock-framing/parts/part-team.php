<?php
/**
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>
<div class="team">
  <?php foreach( $team as $post ) : setup_postdata( $post ); ?>
  <div class="row team-member">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 team-name">
          <h3><?php echo $post->post_title; ?></h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 team-thumb">
          <img src="<?php echo $post->photo; ?>" class="thumb" />
        </div>
        <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 team-description">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>