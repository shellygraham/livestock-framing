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
  'type' => 'checkbox',
  'value' => '1',
  'available_options' => array(
    '1' => 'Display Contact Form',
  ),
  'name' => 'display_contact_form',
  'label' => '',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'checkbox',
  'value' => '1',
  'available_options' => array(
    '1' => 'Display contact information in right-sidebar',
  ),
  'name' => 'display_contact_info',
  'label' => '',
  'classes' => 'fill'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Clean Energy Works",
  'name' => 'contact_info_title',
  'label' => 'Contact Info Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "(855) 870-0049",
  'name' => 'contact_phone',
  'label' => 'Phone Number',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a phone number.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "MON-FRI, 9:00AM-5:00PM",
  'name' => 'contact_hours',
  'label' => 'Hours',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display hours.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "1733 NE 7th Ave, Portland, OR 97212",
  'name' => 'contact_address',
  'label' => 'Mailing Address',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display mailing address. If entered, this will link to google maps automatically.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "info@cewo.org",
  'name' => 'contact_email',
  'label' => 'Email Address',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display email address. This will be hyperlinked automatically.'
) );
