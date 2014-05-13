<form name="akismet_activate" action="https://akismet.com/get/" method="POST" target="_blank">
	<input type="hidden" name="passback_url" value="<? echo esc_url( Akismet_Admin::get_page_url() ); ?>"/>
	<input type="hidden" name="redirect" value="<? echo isset( $redirect ) ? $redirect : 'plugin-signup'; ?>"/>
	<input type="submit" class="<? echo isset( $classes ) && count( $classes ) > 0 ? implode( ' ', $classes ) : 'button button-primary';?>" value="<? echo esc_attr( $text ); ?>"/>
</form>