<?php

global $cewip;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '',
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'h2',
  'available_options' => array(
    'h1' => 'h1',
    'h2' => 'h2',
    'h3' => 'h3',
    'h4' => 'h4',
    'h5' => 'h5',
    'h6' => 'h6'
  ),
  'name' => 'title_hnum',
  'label' => null,
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'headline-bottom-border-no',
  'available_options' => array(
    'headline-bottom-border-no' => 'No',
    'headline-bottom-border-yes' => 'Yes'
  ),
  'name' => 'headline_bottom_border',
  'label' => 'Border below title?',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => '',
  'name' => 'section_body',
  'label' => 'Body Copy',
  'classes' => 'fill',
  'helptext' => null
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'text-size-normal',
  'available_options' => array(
    'text-size-normal' => 'Normal',
    'text-size-large' => 'Large'
  ),
  'name' => 'text_size',
  'label' => 'Text Size',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'text-position-center',
  'available_options' => array(
    'text-position-left' => 'Left',
    'text-position-right' => 'Right',
    'text-position-center' => 'Center'
  ),
  'name' => 'text_position',
  'label' => 'Text Container Position',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'text-width-two-thirds',
  'available_options' => array(
    'text-width-quarter' => 'Quarter',
    'text-width-third' => 'Third',
    'text-width-half' => 'Half',
    'text-width-two-thirds' => 'Two Thirds',
    'text-width-three-quarters' => 'Three Quarters',
    'text-width-fill' => 'Full'
  ),
  'name' => 'text_width',
  'label' => 'Text Container Width',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'text-align-center',
  'available_options' => array(
    'text-align-left' => 'Left',
    'text-align-right' => 'Right',
    'text-align-center' => 'Center'
  ),
  'name' => 'text_alignment',
  'label' => 'Text Alignment',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-lightness-dark',
  'available_options' => array(
    'bg-lightness-dark' => 'Light',
    'bg-lightness-light' => 'Dark'
  ),
  'name' => 'background_lightness',
  'label' => 'Text Color',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'no-text-backgroun',
  'available_options' => array(
    'text-has-background' => 'Yes',
    'no-text-background' => 'No'
  ),
  'name' => 'text_bg',
  'label' => 'Display a background behind the text',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => '',
  'name' => 'container_background_url',
  'label' => 'Text Container Background Image',
  'classes' => 'med',
  'helptext' => 'Optional. If no image is defined, but container background is enabled a color will be used.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-position-middle-center',
  'available_options' => array(
    'bg-position-top-left' => 'Top left',
    'bg-position-top-right' => 'Top right',
    'bg-position-top-center' => 'Top center',
    'bg-position-bottom-left' => 'Bottom left',
    'bg-position-bottom-right' => 'Bottom right',
    'bg-position-bottom-center' => 'Bottom center',
    'bg-position-middle-left' => 'Middle left',
    'bg-position-middle-right' => 'Middle right',
    'bg-position-middle-center' => 'Middle center',
  ),
  'name' => 'container_background_position',
  'label' => 'Text Container Background Image Position',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-size-cover',
  'available_options' => array(
    'bg-size-cover' => 'Scale image proportionally, filling container',
    'bg-size-normal' => 'Normal'
  ),
  'name' => 'container_background_size',
  'label' => 'Text Container Background Image Size',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-no-repeat',
  'available_options' => array(
    'bg-no-repeat' => 'Do Not Repeat',
    'bg-repeat' => 'Repeat',
    'bg-repeat-x' => 'Repeat horizontally',
    'bg-repeat-y' => 'Repeat vertically'
  ),
  'name' => 'container_background_repeat',
  'label' => 'Text Container Background Image Repeat',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'container-no',
  'available_options' => array(
    'container-yes' => 'Yes',
    'container-no' => 'No'
  ),
  'name' => 'text_container',
  'label' => 'Restrict text area to breakpoint container?',
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

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => '',
  'name' => 'background_color',
  'label' => 'Background Color',
  'classes' => 'med',
  'helptext' => 'Color behind/beyond background image. Must be defined as hex value.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-position-middle-center',
  'available_options' => array(
    'bg-position-top-left' => 'Top left',
    'bg-position-top-right' => 'Top right',
    'bg-position-top-center' => 'Top center',
    'bg-position-bottom-left' => 'Bottom left',
    'bg-position-bottom-right' => 'Bottom right',
    'bg-position-bottom-center' => 'Bottom center',
    'bg-position-middle-left' => 'Middle left',
    'bg-position-middle-right' => 'Middle right',
    'bg-position-middle-center' => 'Middle center',
  ),
  'name' => 'background_position',
  'label' => 'Background Image Position',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-size-cover',
  'available_options' => array(
    'bg-size-cover' => 'Scale image proportionally, filling container',
    'bg-size-normal' => 'Normal'
  ),
  'name' => 'background_size',
  'label' => 'Background Image Size',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'radio',
  'value' => 'bg-no-repeat',
  'available_options' => array(
    'bg-no-repeat' => 'Do Not Repeat',
    'bg-repeat' => 'Repeat',
    'bg-repeat-x' => 'Repeat horizontally',
    'bg-repeat-y' => 'Repeat vertically'
  ),
  'name' => 'background_repeat',
  'label' => 'Background Image Repeat',
  'classes' => 'fill'
) );
