<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'Some Partners We Work With',
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill'
) );
