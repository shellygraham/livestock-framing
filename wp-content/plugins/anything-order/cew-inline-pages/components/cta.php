<?php global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => "",
  'name' => 'section_content',
  'label' => 'Content',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'image',
  'label' => 'Image',
  'classes' => 'med',
  'helptext' => 'Optional. If no image is defined the content area will fill the available area.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'url',
  'value' => "",
  'name' => 'image_link',
  'label' => 'Image Link',
  'classes' => 'fill',
  'helptext' => 'Optional.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'checkbox',
  'value' => '1',
  'available_options' => array(
    '1' => 'Display Button',
  ),
  'name' => 'display_button',
  'label' => '',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'button_text',
  'label' => 'Button Text',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'url',
  'value' => "",
  'name' => 'button_link',
  'label' => 'Button Link',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'button_event_tag',
  'label' => 'Button Event Tag',
  'classes' => 'fill',
  'helptext' => 'Optional. If undefined the button text will be used.'
) );
