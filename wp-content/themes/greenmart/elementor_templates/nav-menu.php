<?php 
/**
 * Templates Name: Elementor
 * Widget: Menu Nav
 */

$settings = $this->get_active_settings();

extract( $settings );

$active_ajax = false;
$header_type = 'builder';

$available_menus = $this->get_available_menus();

if (!$available_menus || empty($menu) || !is_nav_menu($menu) ) {
	return;
}

$_id = greenmart_tbay_random_key();

$args = [
	'echo'        => false, 
	'menu'        => $menu,
	'container_class' => 'collapse navbar-collapse',
	'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $_id,
	'walker'      => new Greenmart_Tbay_Nav_Menu(),
	'fallback_cb' => '__return_empty_string',
	'container'   => '',
	'items_wrap'  => '<ul id="%1$s" class="%2$s" data-id="'. $menu .'">%3$s</ul>',
];  

$args['menu_class'] = greenmart_nav_menu_get_menu_class($layout, $header_type);

$args_canvas = [
	'echo'        => false,
	'menu'        => $settings['menu'],
	'menu_class'  => 'nav-menu--canvas',
	'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
	'fallback_cb' => '__return_empty_string',
	'container'   => '',
];


// General Menu.
$menu_html = wp_nav_menu($args);

// Dropdown Menu.
$args['menu_id'] = 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id();

if (empty($menu_html)) {
	return;
}

$this->add_render_attribute(
    'main-menu',
    [ 
        'class' => [  
			'elementor-nav-menu--main',
			'elementor-nav-menu__container',
			'elementor-nav-menu--layout-' . $layout,
			'tbay-'.$layout,
		],   
		'data-id' => $menu
    ]
);

if( $layout === 'vertical' || $layout === 'treeview' ) {
	$this->add_render_attribute('main-menu', 'class', 'tbay-treevertical-lv1' );
}
 
if( $type_menu === 'toggle' ) {
	$this->add_render_attribute('wrapper', 'class', 'category-inside' );
}


if( $layout === 'vertical' ) {
	if( isset($toggle_vertical_submenu_align) && empty($toggle_vertical_submenu_align) ) {
		$toggle_vertical_submenu_align = 'left';
	}
	
	if( $type_menu === 'canvas' ) {

		if( $toggle_canvas_content_align === 'left' ) {
			$toggle_vertical_submenu_align = 'right';
		} else {
			$toggle_vertical_submenu_align = 'left';
		}
	}

	$this->add_render_attribute('main-menu', 'class', 'vertical-submenu-'.$toggle_vertical_submenu_align );
}

if( $show_content_menu === 'yes' && greenmart_tbay_is_home_page() ) {
	$this->add_render_attribute('wrapper', 'class', ['open' ,'setting-open'] );
}

if( $type_menu === 'toggle' ) {
	$content_class = $this->add_render_attribute('content-class', 'class', 'category-inside-content' );

	if( $toggle_content_menu === 'yes' && $ajax_toggle === 'yes' ) {
        $this->add_render_attribute('wrapper', 'class', ['element-menu-ajax', 'ajax-active']);
        $active_ajax = true;
	}
} else if( $type_menu === 'canvas' ) {
	$this->add_render_attribute('wrapper', 'class', 'element-menu-canvas' );
	$content_class = $this->add_render_attribute('content-class', 'class', 'menu-canvas-content' );

	if (isset($ajax_canvas) && $ajax_canvas === 'yes') {
        $this->add_render_attribute('wrapper', 'class', ['element-menu-ajax', 'ajax-active']);  
        $active_ajax = true;
    }  
}

$this->add_render_attribute( 
	'wrapper',
	[
		'data-wrapper' => wp_json_encode( [
			'layout' => $layout,
			'type_menu' => $type_menu,
			'header_type' =>  $header_type,
		] ),
	]
);

?>
<div <?php echo trim($this->get_render_attribute_string('wrapper')); ?>>
	<?php echo trim($this->render_get_toggle_menu()); ?>
	
	<?php echo trim($this->render_canvas_button_menu()); ?>

	<?php if ( isset($type_menu) && $type_menu !== 'none' ) echo '<div '. trim($this->get_render_attribute_string('content-class')) .' >'; ?>
		<?php echo trim($this->render_get_toggle_canvas_menu()); ?>
		<nav <?php echo trim($this->get_render_attribute_string('main-menu')); ?>>
			<?php 
				if( !$active_ajax ) {
					echo trim($menu_html); 
				}
			?>
		</nav>
	<?php if ( isset($type_menu) && $type_menu !== 'none' ) echo '</div>'; ?>

</div>