<?php global $cewip, $cew_faq;

$cewip->the_component_field( array(
  'index' => $index,
  'post_id' => $post->ID,
  'type' => 'input',
  'value' => "FAQ",
  'name' => 'section_title',
  'label' => 'Section Title',
  'classes' => 'fill',
  'helptext' => 'Optional. Leave blank to not display a title.'
) );

$faq_terms = get_terms( 'cew_faq_categories', array( 'hide_empty' => false ) );
$faq_terms_count = count( $faq_terms );

if ( $faq_terms_count > 0 ) :
  $select_options = '<option value="" ' . ( $options[$index]['faq_category'] === null || $options[$index]['faq_category'] == '' ? 'selected' : null ) . '>All categories</option>';
  foreach( $faq_terms as $term ) { $select_options.= '<option value="' . $term->term_id . '" ' . ( $options[$index]['faq_category'] == $term->term_id ? 'selected' : null ) . '>' . $term->name . '</option>'; }

?>

<!-- Choose the FAQ category to display.
<div class="field">
  <select class="faq_select" name="options[<?php echo $index; ?>][faq_category]">
    <?php echo $select_options; ?>
  </select>
</div> -->

<?php endif; ?>
<?php unset( $faq_terms ); ?>
