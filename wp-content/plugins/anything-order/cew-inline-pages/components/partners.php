<?php

  $partner_terms = get_terms( 'cew_partners_categories', array( 'hide_empty' => false ) );

  foreach( $partner_terms as $key => $partner ) {
    $select_options.= '<option value="' . $partner->term_id . '" ' . ( $options[$index]['partners'] == $partner->term_id ? 'selected' : null ) . '>' . $partner->name . '</option>';
  }

  // echo '<pre>' . print_r( $select_options, 1 ) . '</pre>';
?>

Choose the partner type to display.
<div class="field">
  <select class="partner_select" name="options[<?php echo $index; ?>][partners]">
    <?php echo $select_options; ?>
  </select>
</div>
