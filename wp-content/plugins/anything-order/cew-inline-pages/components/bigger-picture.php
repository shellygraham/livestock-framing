<?php global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Transforming homes, transforming communities.",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => "Upgrading performance in one home can create a chain reaction of benefits that strengthens the entire community.",
  'name' => 'section_content',
  'label' => 'Content',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'checkbox',
  'value' => '1',
  'available_options' => array(
    '1' => 'Display Video',
  ),
  'name' => 'display_video',
  'label' => '',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'video_poster',
  'label' => 'Video Poster',
  'classes' => 'med',
  'helptext' => '',
  'dependency' => array( 'video_display', '1' )
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'url',
  'value' => "https://www.youtube.com/watch?v=xzCUIOkdZHM",
  'name' => 'video_url',
  'label' => 'Video Link',
  'classes' => 'fill',
  'helptext' => '',
  'dependency' => array( 'video_display', '1' )
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'checkbox',
  'value' => '',
  'available_options' => array(
    '1' => 'Display Stats',
  ),
  'name' => 'display_stats',
  'label' => '',
  'classes' => 'fill'
) );

echo '<div class="notice">Stats are not editable in WordPress</div>';
