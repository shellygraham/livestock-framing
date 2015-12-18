<?php
/**
 *
 * Component Name: Prices
 * Component Description:
 *
 * @package WordPress
 * @subpackage Livestock Framing Theme
 * @since 1.0
 */

	$show_nav = true;
	$cols = 3;
	$max = -1;
	$prices = array(
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/10x12.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/10x12.jpg'
			),
			'price' => 75,
			'sizes' => array(
				'print'	=> '6x8"',
				'frame'	=> '10x12"'
			)
		),
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/13x16.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/13x16.jpg'
			),
			'price' => 100,
			'sizes' => array(
				'print'	=> '9x12"',
				'frame'	=> '13x16"'
			)
		),
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/18x22.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/18x22.jpg'
			),
			'price' => 150,
			'sizes' => array(
				'print'	=> '12x16"',
				'frame'	=> '18x22"'
			)
		),
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/24x30.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/24x30.jpg'
			),
			'price' => 250,
			'sizes' => array(
				'print'	=> '18x24"',
				'frame'	=> '24x30"'
			)
		),
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/32x40.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/32x40.jpg'
			),
			'price' => 350,
			'sizes' => array(
				'print'	=> '24x32"',
				'frame'	=> '32x40"'
			)
		),
		array(
			'imgs' => array( 
				'sm' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/40x50.jpg',
				'lg' => get_bloginfo( 'template_directory' ) . '/assets/img/frame-sizes/40x50.jpg'
			),
			'price' => 550,
			'sizes' => array(
				'print'	=> '30x40"',
				'frame'	=> '40x50"'
			)
		)
	);
?>

<section id="prices" class="prices">
<a class="close" href="#" onclick="_gaq.push([ '_trackEvent', 'Prices Section', 'Close Scaled View' ]);">
    		<i class="fa fa-times"></i>
    		<span>Return to grid view</span>
    	</a>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 section-header">
        <h2 class="wow"><?php echo $section_options['section_title']; ?></h2>
        <?php if ( $section_options['section_subtitle'] != '' ) : ?><p class="wow" data-wow-delay="0.2s"><?php echo $section_options['section_subtitle']; ?></p><?php endif; ?>
      </div>
    </div>
    <?php if ( $section_options['section_content'] != '' ) : ?>
    <div class="row">
		<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2 content-area">
			<?php echo wpautop( $section_options['section_content'] ); ?>
    	</div>
    </div>
	<?php endif; ?>
    <div class="prices-grid">
    	<div class="prices-navigation">
			<a class="prices-navigation-item prices-navigation-prev" data-direction="prev" href="#prev" onclick="_gaq.push([ '_trackEvent', 'Prices Section', 'Scaled View Navigation', 'Previous' ]);"><i class="fa fa-chevron-left"></i> <span>Previous</span></a>
			<a class="prices-navigation-item prices-navigation-next" data-direction="next" href="#next" onclick="_gaq.push([ '_trackEvent', 'Prices Section', 'Scaled View Navigation', 'Next' ]);"><span>Next</span> <i class="fa fa-chevron-right"></i></a>
		</div>
		<div class="row">
		<?php foreach ( $prices as $index => $frame ) : ?>
	    <?php // echo ( $index == 0 || $index % $cols == 0 ? '<div class="row">' : null ); ?>
		    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 item" data-index="<?php echo $index; ?>" data-img-lg="<?php echo $frame['imgs']['lg']; ?>" onclick="_gaq.push([ '_trackEvent', 'Prices Section', 'Open Scaled View', '<?php echo str_replace( '"', '', $frame['sizes']['frame'] ); ?>', ]);">
		    	<div class="inner">
			    	<div class="item-img">
			    		<img class="img-thumb" src="<?php echo get_bloginfo( 'template_directory' ) . '/mk_thumb.php?w=676&h=450&src=' . $frame['imgs']['sm']; ?>" />
			    	</div>
			    	<div class="item-meta">
			    		<div class="item-price">$<?php echo $frame['price']; ?></div>
			    		<div class="item-sizes">
				    		<div class="print-size"><span>Print size</span><?php echo $frame['sizes']['print']; ?></div>
				    		<div class="frame-size"><span>Frame size</span><?php echo $frame['sizes']['frame']; ?></div>
			    		</div>
			    	</div>
			    </div>
		    </div>
	    <?php // echo ( $index == count( $prices ) || $index % $cols == $cols-1 ? '</div>' : null ); ?>
		<?php endforeach; ?>
		</div>
	</div>
  </div>
</section>