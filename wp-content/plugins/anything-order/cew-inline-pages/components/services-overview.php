<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'Services',
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => '',
  'name' => 'section_intro',
  'label' => 'Intro',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => '',
  'name' => 'background_url',
  'label' => 'Background Image',
  'classes' => 'med'
) );
