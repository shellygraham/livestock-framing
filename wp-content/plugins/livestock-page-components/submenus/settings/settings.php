<?php
  global $cewip;
?>
<div class="wrap">
  <div id="icon-tools" class="icon32"></div>
  <h2>Components settings</h2>

  <form class="work_form" action="options.php" method="post">
		<?php settings_fields( 'gb-work-settings-group' ); ?>

    <fieldset>
      <h3>Component Usage Audit</h3>
      <?php
        $components = $cewip->get_components();
        $component_count = count( $components );
      ?>

      <?php foreach( $components as $key => $component ) : ?>
      <div class="block">
        <div class="inner">
          <strong>
            <?php echo $component['name']; ?>
          </strong>
          <?php $pages = get_pages( array( 'parent' => 0, 'sort_column' => 'menu_order', 'sort_order' => 'ASC' ) ); ?>
          <?php
            foreach( $pages as $page ) {
              $custom = get_post_custom( $page->ID );
              $sections = unserialize( $custom['sections'][0] );

              if ( $sections != '' && count( $sections ) > 0 && in_array( 'component:' . $component['slug'], $sections ) ) {
                $used[] = '<a href="' . get_permalink( $page->ID ) . '">' . strip_tags( $page->post_title ) . '</a>';
              }

              unset( $sections );
            }

            if ( count( $used ) > 0 ) {
              echo implode( ', ', $used );
            }
            else {
              echo 'No pages currently use this component.';
            }
          ?>
        </div>
      </div>
      <?php unset( $used ); ?>
      <?php endforeach; ?>
    </fieldset>

    <fieldset style="margin-top: 15px;">
  		<button type="submit" class="button button-primary"><?php _e( 'Save Settings' , 'CEW Post Settings' ); ?></button>
  	</fieldset>
  </form>
</div>

<style>

  section{
    width: 100%;
  }

  .row{
    display: block;
    margin: 0 -10px 10px; padding: 0;
    width: 100%;
    float: left; clear: both;
  }

  .block{
    display: inline-block;
    margin-bottom: 10px;
    width: 100%;
    float: left; clear: none;

    box-sizing: border-box;
  }
</style>

<script>


</script>
