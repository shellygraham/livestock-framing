<script>
var properties = {
  'target'         : window.location.hash,
  'url'            : '//<?php echo $_SERVER["SERVER_NAME"]; ?>',
  'path'           : '/js-include',
  'container_class': 'marketing-site-content',
  'loading_message': 'Loading&hellip;'
}
if ( ! window.jQuery ) { document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"><\/script>'); }
document.write( '<div class="livestock-framing"><div class="' + properties.container_class + '"></div><script src="' + properties.url + properties.path + '/script.min.js"><\/script></div>' );
</script>