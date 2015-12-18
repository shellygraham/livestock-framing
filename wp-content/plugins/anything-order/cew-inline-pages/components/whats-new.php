<?php
global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => 5,
  'name' => 'news_posts',
  'label' => 'How many recent news posts to display?',
  'classes' => 'small'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => '',
  'available_options' => array(
    '1' => 'Yes',
    '0' => 'No'
  ),
  'name' => 'display_newsletter',
  'label' => 'Display Newsletter?',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Subscribe to our Newsletter",
  'name' => 'newsletter_title',
  'label' => 'Newsletter Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "On The Front Porch is Clean Energy Works’ monthly communication filled with timely information and stories from your neighbors, as well as important news, tips and more.",
  'name' => 'newsletter_intro',
  'label' => 'Newsletter Intro',
  'classes' => 'fill'
) );
