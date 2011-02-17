<div class="searchdiv">
	<form class="searchform" method="get" action="<?php echo home_url(); ?>">
		<div>
			<input type="text" name="s" id="s" size="15" title="<?php esc_attr_e( 'Enter a word to look up:', 'wallow' ); ?>" />
			<input type="submit" value="<?php esc_attr_e( 'Find', 'wallow' ); ?>!" title="<?php esc_attr_e( 'Find', 'wallow' ); ?>!" />
		</div>
	</form>
</div>