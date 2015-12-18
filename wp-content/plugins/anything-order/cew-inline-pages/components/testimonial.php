<?php
  global $cewip;
  global $cew_testimonials;
  $testimonials = $cew_testimonials->get_testimonials();

  foreach( $testimonials as $testimonial ) {
    $select_options.= '<option value="' . $testimonial['id'] . '" ' . ( $options[$index]['testimonial'] == $testimonial['id'] ? 'selected' : null ) . '>' . $testimonial['testimonial'] . '</option>';
  }

  // echo '<pre>' . print_r( $options, 1 ) . '</pre>';
?>

Choose the testimonial to display.
<div class="field">
  <select class="testimonial_select" name="options[<?php echo $index; ?>][testimonial]">
    <?php echo $select_options; ?>
  </select>
</div>
