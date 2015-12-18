<?php
  $nonce = wp_create_nonce( 'livestock_componenets_get_section' );
  $link = admin_url( 'admin-ajax.php?action=livestock_components_get_section&post_id='.$post->ID.'&nonce='.$nonce );
?>

<div class="livestock_components">

  <?php
    global $livestock_components;

    $livestock_components->the_component_field( array(
      'index' => 'x',
      'post_id' => $post->ID,
      'type' => 'checkbox',
      'value' => 0,
      'available_options' => array(
        '1' => 'Hide default page content'
      ),
      'name' => 'default_page_content',
      'label' => '',
      'classes' => 'inline'
    ) );
  ?>

  <p>Select page and components that should be displayed on this page.</p>

  <ul class="sections">
  </ul>
  <a class="button button-add-section" href="<?php echo $link; ?>">Add Section</a>
</div>


<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
