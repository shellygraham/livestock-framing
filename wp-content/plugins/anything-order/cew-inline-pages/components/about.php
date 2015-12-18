<?php global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "It’s what we know and who we know.",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => "When you work with Clean Energy works, you have a huge network of professional partners, an extensive knowledge of all things home performance-related and access to a wide variety of rebates and financing, all at your disposal. The thought of home upgrades can be freak-out inducing, but you can relax knowing that we’ve done all the vetting for you. We only work with real pros.",
  'name' => 'section_content',
  'label' => 'Content',
  'classes' => 'fill'
) );
