<?php   
	global $woocommerce; 
	$_id = greenmart_tbay_random_key();
?>
<div class="tbay-topcart">
 <div id="cart" class="cart-dropdown cart-popup dropdown version-1">
        <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php esc_attr_e('View your shopping cart', 'greenmart'); ?>">
            
	        <span class="text-skin cart-icon">
				<i class="icon-handbag"></i>
				<span class="mini-cart-items">
				   <?php echo sprintf( '%d', $woocommerce->cart->cart_contents_count );?>
				</span>
			</span>

			<span class="mini-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal();?></span>
            
        </a>            
        <div class="dropdown-menu"><div class="widget_shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div></div>
    </div>
</div>    