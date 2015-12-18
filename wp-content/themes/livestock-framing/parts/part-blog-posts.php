<?php
/**
 *
 * Blogroll
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>

<section id="" class="blog blog-blogroll">
  <div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php echo ( $wp_query->current_post == 0 || $wp_query->current_post % 2 == 0 ? '<div class="row">' : null ); ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 post">
          <?php if ( has_post_thumbnail() ) : $img_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
          <a class="thumb" href="<?php the_permalink(); ?>">
            <img src="<?php echo get_bloginfo( 'template_directory' ) . '/mk_thumb.php?w=1024&h=512&src=' . $img_url; ?>" />
          </a>
          <?php endif; ?>
          <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <div class="post-meta">
            Posted on
            <span class="post-date"><?php echo get_the_date(); ?></span>
            by
            <span class="post-author"><?php echo get_the_author(); ?></span>
          </div>
          <div class="post-excerpt hidden-xs">
            <?php the_excerpt(); ?>
          </div>
        </div>
      <?php echo ( ( $wp_query->current_post + 1 ) >=  $wp_query->post_count || $wp_query->current_post % 2 == 1 ? '</div>' : null ); ?>
    <?php endwhile; endif; ?>

    <div class="blog-navigation">
      <?php previous_posts_link( '&laquo; Previous Page' ); ?>
      <?php next_posts_link( 'Next Page &raquo;' ); ?>
    </div>
  </div>
</section>