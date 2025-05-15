<?php
// Eliminar estilos por defecto de WooCommerce que no usas
add_filter('woocommerce_enqueue_styles', function($styles) {
    unset($styles['woocommerce-general']);
    unset($styles['woocommerce-layout']);
    return $styles;
});

// Cambiar columnas tienda a 3
add_filter('loop_shop_columns', function() {
    return 3;
}, 999);

// Quitar botones "Añadir al carrito" y texto "¡Oferta!" del loop de productos
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

