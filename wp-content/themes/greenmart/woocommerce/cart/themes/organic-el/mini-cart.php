<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce;
?>

<?php do_action('woocommerce_before_mini_cart'); ?>

<div class="mini_cart_content">
	<div class="mini_cart_inner">
		<div class="mcart-border">
			<?php if(sizeof(WC()->cart->get_cart()) > 0) : ?>
				<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
					<?php
					foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product     = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id   = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_gallery_thumbnail'), $cart_item, $cart_item_key );
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li id="mcitem-<?php echo esc_attr($cart_item_key); ?>">

								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo trim($thumbnail);  ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo trim($thumbnail);  ?>
									</a>
								<?php endif; ?>

								<div class="product-details">  
									<?php
										echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="%s">x</a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'greenmart' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() ),
											esc_attr( $cart_item_key )
										), $cart_item_key );
									?>

									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo wp_kses_post( $product_name ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo wp_kses_post( $product_name ) . '&nbsp;'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									<?php endif; ?>
									
									<span class="quantity">
										<?php esc_html_e('Qty', 'greenmart'); ?>: <?php echo apply_filters('woocommerce_widget_cart_item_quantity',  sprintf('%s', $cart_item['quantity']) , $cart_item, $cart_item_key); ?>
									</span>
									
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
									<?php echo apply_filters('woocommerce_widget_cart_item_quantity',  sprintf('%s', $product_price) , $cart_item, $cart_item_key); ?>
								</div>
							</li>
							<?php
						}
					}

					do_action( 'woocommerce_mini_cart_contents' );
					?>
				</ul><!-- end product list -->
			<?php else: ?>
				<ul class="cart_empty <?php echo esc_attr($args['list_class']); ?>">
					<li><?php esc_html_e('You have no items in your shopping cart', 'greenmart'); ?></li>
					<li class="total"><?php esc_html_e('Subtotal', 'greenmart'); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></li>
				</ul>
			<?php endif; ?>

			<?php if(sizeof(WC()->cart->get_cart()) > 0) : ?>

				<p class="total"><?php esc_html_e('Subtotal', 'greenmart'); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></p>

				<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

				<p class="buttons">
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward view-cart"><?php esc_html_e('VIEW CART', 'greenmart'); ?><i class="fas fa-arrow-right"></i></a>
					<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="button checkout wc-forward"><?php esc_html_e('CHECKOUT', 'greenmart'); ?><i class="fas fa-arrow-right"></i></a>	
				</p>

			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	</div>
</div>

<?php do_action('woocommerce_after_mini_cart'); ?>