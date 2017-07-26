<form role="search" method="get" class="search-form" action="<?php echo esc_url( site_url() ) ?>">
	<label for='s' class='screen-reader-text'><?php esc_html_e( 'Search for:', 'siteorigin-corp' ); ?></label>
	<input type="search" name="s" placeholder="<?php esc_attr_e( 'Search', 'siteorigin-corp') ?>" value="<?php echo get_search_query() ?>" />
	<button type="submit">
		<label class="screen-reader-text"><?php esc_html_e( 'Search', 'siteorigin-corp' ); ?></label>
		<?php siteorigin_corp_display_icon( 'search' ); ?>
	</button>
</form>
