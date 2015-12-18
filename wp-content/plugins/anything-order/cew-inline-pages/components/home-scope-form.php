<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'checkbox',
  'value' => '1',
  'available_options' => array(
    '1' => 'Display header',
  ),
  'name' => 'display_header',
  'label' => '',
  'classes' => 'fill',
  'helptext' => 'The header includes the section title and description if provided.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'Home Scope',
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '',
  'name' => 'section_intro',
  'label' => 'Intro',
  'classes' => 'fill'
) );
