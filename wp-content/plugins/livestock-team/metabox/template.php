<div class="block">
	<label>Photo</label>
	<input class="text" id="photo" name="photo" value="<?php echo ( $data['photo'] != '' ? esc_url( $data['photo'] ) : '' ); ?>" />
	<a class="button button-upload" href="#" data-uploader-title="Upload Photo" data-uploader-button-text="Insert" data-input-field="photo">Upload / Select</a>
</div>

<div class="block subhead">
	<label class="">Role</label>
	<input class="text" id="role" name="role" value="<?php echo ( $data['role'] != '' ? esc_attr( $data['role'] ) : '' ); ?>" />
</div>

<div class="clear clearfix"></div>
