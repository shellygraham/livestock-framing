<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'Get Started',
  'name' => 'button_text',
  'label' => 'Button Text',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '/get-started',
  'name' => 'button_link',
  'label' => 'Button Link',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '(855) 870-0049',
  'name' => 'phone_number',
  'label' => 'Phone Number',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'to talk to our Customer Care team',
  'name' => 'note',
  'label' => 'Note',
  'classes' => 'fill',
  'helptext' => 'Optional. This will be displayed between the phone number and hours.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 'MON-FRI, 9:00AM-5:00PM',
  'name' => 'hours',
  'label' => 'Hours',
  'classes' => 'fill',
  'helptext' => 'Optional.'
) );
