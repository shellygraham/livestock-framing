<?php global $livestock_components;

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_subtitle',
  'label' => 'Section Subtitle',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => "",
  'name' => 'section_content',
  'label' => 'Content',
  'classes' => 'fill'
) );


$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'background_image',
  'label' => 'Background Image',
  'classes' => ''
) );
