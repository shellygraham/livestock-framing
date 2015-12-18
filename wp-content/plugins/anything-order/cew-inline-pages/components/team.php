<?php global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Non-profit. Pro-people.",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "We make home performance personal. From our leadership, to our Home Performance Advisors, to our members of the board, these are the folks you want on your side.",
  'name' => 'section_intro',
  'label' => 'Content',
  'classes' => 'fill'
) );
