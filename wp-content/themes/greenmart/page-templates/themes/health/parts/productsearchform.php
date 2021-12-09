<?php if ( greenmart_tbay_get_config('show_searchform') ): ?>
	<?php 
		$is_category = apply_filters( 'greenmart_woo_search_category', 10,2 );

		$class_is_cate = ($is_category) ? 'is-category' : '';
	?>
	<div class="tbay-search-form <?php echo esc_attr( $class_is_cate ); ?>">
		<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" data-appendto=".result-desktop">
			<div class="form-group">
				<div class="input-group">
					<?php if ( greenmart_tbay_get_config('search_type') != 'all' && $is_category ): ?>
						<div class="select-category input-group-addon">
							<?php if ( greenmart_is_woocommerce_activated() && greenmart_tbay_get_config('search_type') == 'product' ):
								$args = array(
								    'show_option_none' => esc_html__( 'All categories', 'greenmart' ),
								    'show_counts' => false,
								    'hierarchical' => true,
								    'show_uncategorized' => 0
								);
							?>
							    <?php wc_product_dropdown_categories( $args ); ?>

							<?php elseif ( greenmart_tbay_get_config('search_type') == 'post' ):
								$args = array(
									'show_option_all' => esc_html__( 'All categories', 'greenmart' ),
								    'show_counts' => false,
								    'hierarchical' => true,
								    'show_uncategorized' => 0,
								    'name' => 'category',
									'id' => 'search-category',
									'class' => 'postform dropdown_product_cat',
								);
							?>
								<?php wp_dropdown_categories( $args ); ?>
							<?php endif; ?>
					  	</div> 
				  	<?php endif; ?>
				  		<input type="text" placeholder="<?php esc_attr_e( 'Search for...', 'greenmart' ); ?>" name="s" required oninvalid="this.setCustomValidity('<?php esc_html_e('Enter at least 2 characters', 'greenmart'); ?>')" oninput="setCustomValidity('')"  class="tbay-search form-control input-sm"/>
						<div class="tbay-preloader"></div>
						<div class="button-group input-group-addon">
							<button type="submit" class="button-search btn btn-sm"><i class="<?php echo greenmart_get_icon('icon_search'); ?>"></i></button>
						</div>

						<div class="tbay-search-result result-desktop"></div>
					<?php if ( greenmart_tbay_get_config('search_type') != 'all' ): ?>
						<input type="hidden" name="post_type" value="<?php echo greenmart_tbay_get_config('search_type'); ?>" class="post_type" />
					<?php endif; ?>
				</div>
				
			</div>
		</form>
	</div>

<?php endif; ?>