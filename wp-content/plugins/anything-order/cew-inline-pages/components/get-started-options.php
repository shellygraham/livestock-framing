<?php global $cewip;

// $cewip->the_component_field( array(
//   'index' => $index,
//   'post_id' => $post->ID,
//   'type' => 'checkbox',
//   'value' => '1',
//   'available_options' => array(
//     '1' => 'Require qualifiers before showing options',
//   ),
//   'name' => 'display_qualifiers',
//   'label' => '',
//   'classes' => 'fill'
// ) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "First Things First",
  'name' => 'qualifiers_section_title',
  'label' => 'Qualifiers Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Just answer 3 quick questions to find out if your home is a good fit",
  'name' => 'qualifiers_section_intro',
  'label' => 'Qualifiers Section Intro',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display intro text.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Just take me to my options",
  'name' => 'skip_qualifiers',
  'label' => 'Skip qualifiers link text',
  'classes' => 'fill',
  'helptext' => 'Displayed under qualifiers "test".'
) );

echo '<div class="notice">Qualifers are editable in the <a href="/wp-admin/edit.php?post_type=cew_qualifiers" target="_blank">Qualifiers Post Type</a>.</div>';

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Yes, your home’s a good match!",
  'name' => 'options_section_success_title',
  'label' => 'Options Section Title (Success)',
  'classes' => 'fill',
  'helptext' => 'Title to display above options if visitor passes qualifiers "test".'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Ready. Set. Update!",
  'name' => 'options_section_skipped_title',
  'label' => 'Options Section Title (Skipped)',
  'classes' => 'fill',
  'helptext' => 'Title to display above options if visitor skipped qualifiers.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Performance upgrades can give your home big benefits, let’s get you signed up.",
  'name' => 'options_section_skipped_intro',
  'label' => 'Options Section Intro',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display intro text.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Sign Me Up!",
  'name' => 'signup_button_text',
  'label' => 'Sign Up Button Text',
  'classes' => 'fill',
  'helptext' => ''
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Here we go! Your first step is this application. Once you submit it, your personal Home Performance Advisor will contact you to get the ball rolling.",
  'name' => 'signup_button_note',
  'label' => 'Sign Up Button Note',
  'classes' => 'fill',
  'helptext' => 'Optional. If entered this is displayed directly below Sign Up button'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Not quite ready? Explore the possibilities some more with these tools:",
  'name' => 'alt_options_title',
  'label' => 'Tools title text',
  'classes' => 'fill',
  'helptext' => 'Displayed above Home Scope, Evaluation and Tour links.'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Find out which upgrades and budget levels are the most popular near you.",
  'name' => 'homescope_intro',
  'label' => 'Homescope Link Intro',
  'classes' => 'fill',
  'helptext' => 'Displayed in link to Home Scope'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Learn more about your home: estimated energy use, best ways to reduce energy waste, and a comparison to homes in your area.",
  'name' => 'evaluation_intro',
  'label' => 'Evaluation Link Intro',
  'classes' => 'fill',
  'helptext' => 'Displayed in link to Evaulation'
) );

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Get an overview of what the performance upgrade process is like – what happens when. ",
  'name' => 'tour_intro',
  'label' => 'Tour Link Intro',
  'classes' => 'fill',
  'helptext' => 'Displayed in link to Tour'
) );
