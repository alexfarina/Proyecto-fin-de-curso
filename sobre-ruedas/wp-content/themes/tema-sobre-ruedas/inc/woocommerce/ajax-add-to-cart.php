<?php
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'handle_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'handle_ajax_add_to_cart');
function handle_ajax_add_to_cart() {
    if (isset($_POST['product_id'], $_POST['quantity'])) {
        $product_id = intval($_POST['product_id']);
        $quantity = intval($_POST['quantity']);
        $product = wc_get_product($product_id);

        if (!$product || !$product->is_purchasable()) {
            wp_send_json_error(['message' => 'Producto no válido o no disponible.']);
        }

        $anadir = WC()->cart->add_to_cart($product_id, $quantity);
        if ($anadir) {
            wp_send_json_success();
        } else {
            wp_send_json_error(['message' => 'No se pudo añadir el producto al carrito.']);
        }
    } else {
        wp_send_json_error(['message' => 'Faltan datos en la solicitud.']);
    }
}
