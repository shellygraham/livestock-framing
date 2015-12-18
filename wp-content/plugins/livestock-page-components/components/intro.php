<?php global $livestock_components;

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'tagline',
  'label' => 'Tagline',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_intro',
  'label' => 'Intro copy',
  'classes' => 'fill',
  'helptext' => 'Keep it short'
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'button_text',
  'label' => 'Button Text',
  'classes' => 'fill'
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'alt_text',
  'label' => 'Small text below button',
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

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "0",
  'name' => 'background_blur',
  'label' => 'Background Blur',
  'classes' => 'fill',
  'helptext' => 'Enter a number. Higher the number, the blurier it gets.'
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "0",
  'name' => 'darken_background',
  'label' => 'Darken Background',
  'classes' => 'fill',
  'helptext' => 'Enter a number from 0 - 100. Higher the number, the darker it gets.'
) );