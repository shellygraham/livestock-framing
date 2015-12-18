<?php
/**
 * 
 * Blog Single
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<section id="blog" class="blog blog-single">
  <?php
    $bg_img = null;
    if ( has_post_thumbnail() ) {
      $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
      $bg_img = get_bloginfo( 'template_directory' ) . '/mk_thumb.php?w=1600&h=800&src=' . $img_url;
    }
  ?>
  <div class="row post-header" style="background-image: url( <?php echo $bg_img ?> );">
    <div class="container">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="wow fadeInUp"><?php the_title(); ?></h1>
        <div class="post-meta">
          Posted on
          <span class="post-date"><?php the_date(); ?></span>
          by
          <span class="post-author"><?php the_author(); ?></span>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row post-content">
      <div class="col-xs-12">
        <?php the_content(); ?>
        <div class="social-sharing">
          <span class="title">Share:</span> 
          <span class='st_facebook_large' displayText='Facebook'></span>
          <span class='st_twitter_large' displayText='Tweet'></span>
          <span class='st_pinterest_large' displayText='Pinterest'></span>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>