<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" name="s" aria-label="<?php esc_attr_e( 'Search for', 'siteorigin-corp' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'siteorigin-corp' ); ?>" value="<?php echo get_search_query(); ?>" />
	<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'siteorigin-corp' ); ?>">
		<?php siteorigin_corp_display_icon( 'search' ); ?>
	</button>
</form>
