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
            WC()->cart->calculate_totals(); // Asegura que los totales se actualicen correctamente

            // Generamos el html de mi carrito
            $contenido_carrito = renderizar_carrito_desplegable();

            wp_send_json_success([
                'html_carrito' => $contenido_carrito,
                'message' => 'Producto añadido al carrito.'
            ]);
        } else {
            wp_send_json_error(['message' => 'No se pudo añadir el producto al carrito.']);
        }
    } else {
        wp_send_json_error(['message' => 'Faltan datos en la solicitud.']);
    }
}

function renderizar_carrito_desplegable() {
    ob_start();

    if ( WC()->cart->is_empty() ) {
        echo '<p>Tu carrito está vacío.</p>';
    } else {
        echo '<ul class="lista-carrito">';
        foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
            $producto = $cart_item['data'];
            $cantidad = $cart_item['quantity'];

            echo '<li data-cart-item-key="' . esc_attr($cart_item_key) . '">';
            echo $producto->get_image([50, 50]);
            echo '<span>' . esc_html($producto->get_name()) . '</span>';
            echo ' × ' . $cantidad;
            echo ' <button class="quitar-item" data-cart-item-key="' . esc_attr($cart_item_key) . '">✖</button>';
            echo '</li>';
        }
        echo '</ul>';
        echo '<button id="vaciar-carrito" class="vaciar-carrito-btn">Vaciar carrito</button>';
    }

    return ob_get_clean();
}

