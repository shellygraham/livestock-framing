<?php global $livestock_components;

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_subtitle',
  'label' => 'Section Subtitle',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "Watch the Video",
  'name' => 'section_video_text',
  'label' => 'Video Link Text',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'section_video',
  'label' => 'Video Source',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'textarea',
  'value' => "",
  'name' => 'section_content',
  'label' => 'Content',
  'classes' => 'fill'
) );

echo '<div class="block"><div class="block-title">Step 1</div>';

//
// Step 1
//

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'step1_image',
  'label' => 'Image',
  'classes' => '',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step1_title',
  'label' => 'Title',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step1_detail',
  'label' => 'Detail',
  'classes' => 'fill',
  'helptext' => ''
) );

echo '</div><div class="block"><div class="block-title">Step 2</div>';

//
// Step 2
//

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'step2_image',
  'label' => 'Image',
  'classes' => '',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step2_title',
  'label' => 'Title',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step2_detail',
  'label' => 'Detail',
  'classes' => 'fill',
  'helptext' => ''
) );

echo '</div><div class="block"><div class="block-title">Step 3</div>';

//
// Step 3
//

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'upload',
  'value' => "",
  'name' => 'step3_image',
  'label' => 'Image',
  'classes' => '',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step3_title',
  'label' => 'Title',
  'classes' => 'fill',
  'helptext' => ''
) );

$livestock_components->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "",
  'name' => 'step3_detail',
  'label' => 'Detail',
  'classes' => 'fill',
  'helptext' => ''
) );

echo '</div>';