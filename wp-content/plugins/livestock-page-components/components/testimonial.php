<?php global $livestock_components;

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'testimonial_testimonial',
  'label' => 'Testimonial',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'testimonial_author',
  'label' => 'Author',
  'classes' => 'fill',
  'helptext' => ''
) );