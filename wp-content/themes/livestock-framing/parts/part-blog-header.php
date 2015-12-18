<?php
/**
 *
 * Blog Page Header
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */

global $post, $livestock_page_properties;
// get blog page data
$blog_page_id = get_option( 'page_for_posts' );
$page = get_page( $blog_page_id );
if ( is_category() ) {
  $subhead = single_cat_title( 'Category: ', false );
  $content = category_description( get_cat_ID() );
}
else if ( is_tag() ) {
  $subhead = single_cat_title( 'Tag: ', false );
  $content = category_description( get_cat_ID() );
}
else if ( is_archive() ) {
  $subhead = 'Archives';
  $content = null;
}
else {
  setup_postdata( $blog_page );
  $custom = $livestock_page_properties->get_page_custom( $blog_page_id );
  $subhead = $custom['subhead'];
  $content = get_the_content();
}
?>

<section id="" class="blog blog-intro">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow fadeInUp"><?php echo $page->post_title ?></h2>
        <?php if ( $subhead != '' ) : ?><p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo $subhead; ?></p><?php endif; ?>
      </div>
    </div>
    <?php if ( $content ) : ?> 
    <div class="row page-content">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
        <?php echo do_shortcode( wpautop( $content ) );?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>
<?php wp_reset_postdata(); ?>