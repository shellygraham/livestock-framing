<?php global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Subscribe to our Newsletter",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "On The Front Porch is Clean Energy Works’ monthly communication filled with timely information and stories from your neighbors, as well as important news, tips and more.",
  'name' => 'section_intro',
  'label' => 'Content',
  'classes' => 'fill'
) );
