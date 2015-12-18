<?php
/**
 * 
 * Component Name: Frame Styles
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */
?>
<section id="framestyles" class="frame-styles" style="background-image: url( <?php echo $section_options['background_image']; ?> )">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow"><?php echo $section_options['section_title']; ?></h2>
        <?php if ( $section_options['section_subtitle'] != '' ) : ?><p class="wow" data-wow-delay="0.2s"><?php echo $section_options['section_subtitle']; ?></p><?php endif; ?>
      </div>
    </div>
    <?php if ( $section_options['section_content'] != '' ) : ?>
    <div class="row content-area-1">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
        <?php echo wpautop( $section_options['section_content'] ); ?>
      </div>
    </div>
    <?php endif; ?>
    <?php if ( $section_options['section_content2'] != '' ) : ?>
    <div class="row content-area-2">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo wpautop( $section_options['section_content2'] ); ?>
      </div>
    </div>
    <?php endif; ?>
  </div>


  <?php
    // $gallery_terms = get_terms( 'media_category', array( 'child_of' => 11 ) );

    // $data = array();
    // foreach( $gallery_terms as $term ) {
    //   $term_data = get_term( $term->term_id, 'media_category', ARRAY_A );

    //   $data[$term->term_id] = $term_data;

    //   $args = array(
    //     'posts_per_page'   => '-1',
    //     'offset'           => 0,
    //     'tax_query' => array(
    //       array(
    //         'taxonomy' => 'media_category',
    //         'field' => 'id',
    //         'terms' => $term,
    //         'include_children' => true
    //       )
    //     ),
    //     'orderby'          => 'menu_order',
    //     'order'            => 'DESC',
    //     'post_type'        => 'attachment',
    //     // 'post_status'      => 'publish',
    //     'suppress_filters' => true
    //   );

    //   $data[$term->term_id]['images'] = get_posts( $args );
    // }

    // echo '<pre>' . print_r( $data, 1 ) . '</pre>';

    // foreach( $gallery_posts as $gallery ) {
    //   $terms = wp_get_post_terms( $gallery->ID, 'media_category' );
    //   $gallery->terms = $terms;
    // }

    // echo '<pre>' . print_r( $gallery_posts, 1 ) . '</pre>';
  ?>


  <?php
    $gallery_path = '/assets/img/gallery/';
    $gallery = array(
      // white
      array(
        'thumb' => 'white-angle.jpg',
        'full'  => 'white-angle.jpg',
        'title' => 'White',
        'caption' => '',
        'hidden' => false
      ),
      array(
        'thumb' => 'white-corner.jpg',
        'full'  => 'white-corner.jpg',
        'title' => 'White',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'white-straight.jpg',
        'full'  => 'white-straight.jpg',
        'title' => 'White',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'white-stage.jpg',
        'full'  => 'white-stage.jpg',
        'title' => 'White',
        'caption' => '',
        'hidden' => true
      ),
      // black
      array(
        'thumb' => 'black-angle.jpg',
        'full'  => 'black-angle.jpg',
        'title' => 'Black',
        'caption' => '',
        'hidden' => false
      ),
      array(
        'thumb' => 'black-corner.jpg',
        'full'  => 'black-corner.jpg',
        'title' => 'Black',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'black-straight.jpg',
        'full'  => 'black-straight.jpg',
        'title' => 'Black',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'black-stage.jpg',
        'full'  => 'black-stage.jpg',
        'title' => 'Black',
        'caption' => '',
        'hidden' => true
      ),
      // walnut
      array(
        'thumb' => 'walnut-angle.jpg',
        'full'  => 'walnut-angle.jpg',
        'title' => 'Walnut',
        'caption' => '',
        'hidden' => false
      ),
      array(
        'thumb' => 'walnut-corner.jpg',
        'full'  => 'walnut-corner.jpg',
        'title' => 'Walnut',
        'title' => 'White',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'walnut-straight.jpg',
        'full'  => 'walnut-straight.jpg',
        'title' => 'Walnut',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'walnut-angle-alt.jpg',
        'full'  => 'walnut-angle-alt.jpg',
        'title' => 'Walnut',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'walnut-stage.jpg',
        'full'  => 'walnut-stage.jpg',
        'title' => 'Walnut',
        'caption' => '',
        'hidden' => true
      ),
      // silver
      array(
        'thumb' => 'silver-angle.jpg',
        'full'  => 'silver-angle.jpg',
        'title' => 'Silver',
        'caption' => '',
        'hidden' => false
      ),
      array(
        'thumb' => 'silver-corner.jpg',
        'full'  => 'silver-corner.jpg',
        'title' => 'Silver',
        'title' => 'White',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'silver-straight.jpg',
        'full'  => 'silver-straight.jpg',
        'title' => 'Silver',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'silver-stage.jpg',
        'full'  => 'silver-stage.jpg',
        'title' => 'Silver',
        'caption' => '',
        'hidden' => true
      ),
      // other
      array(
        'thumb' => 'other-grid.jpg',
        'full'  => 'other-grid.jpg',
        'title' => 'Other Materials',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'other-frame-corners.jpg',
        'full'  => 'other-frame-corners.jpg',
        'title' => 'Other Materials',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'other-materials.jpg',
        'full'  => 'other-materials.jpg',
        'title' => 'Other Materials',
        'caption' => '',
        'hidden' => true
      ),
      array(
        'thumb' => 'other-backing.jpg',
        'full'  => 'other-backing.jpg',
        'title' => 'Other Materials',
        'caption' => '',
        'hidden' => true
      )
    )
  ?>

  <div class="row frame-nav">
    <?php foreach( $gallery as $item ) : ?>
    <a class="frame-nav-item wow waves-effect frame-styles show-in-modal <?php echo ( $item['hidden'] ? 'hidden' : false ); ?>" data-wow-delay="" title="<?php echo $item['caption']; ?>" href="<?php echo get_bloginfo( 'template_directory' ) .  $gallery_path . $item['full']; ?>" onclick="_gaq.push([ '_trackEvent', 'Frame Styles Section', 'Open Gallery', '<?php echo $item['title']; ?>' ]); ">
      <img class="" src="<?php bloginfo( 'template_directory' ); ?>/mk_thumb.php?h=500&w=500&src=<?php echo $gallery_path . $item['thumb']; ?>" />
      <?php if ( $item['hidden'] == false ) : ?><div class="title black"><span><?php echo $item['title']; ?></span></div><?php endif; ?>
    </a>
    <?php endforeach; ?>
  </div>
</section>