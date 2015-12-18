<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'Sign Up',
  'name' => 'section_title',
  'label' => 'Title',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '',
  'name' => 'section_intro',
  'label' => 'Subheadline',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => '',
  'name' => 'body',
  'label' => 'Copy above button',
  'classes' => 'fill'
) );


$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '',
  'name' => 'button_text',
  'label' => 'Sign Up Button Text',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'link',
  'value' => '',
  'name' => 'button_link',
  'label' => 'Sign Up Button Link',
  'classes' => 'fill'
) );
