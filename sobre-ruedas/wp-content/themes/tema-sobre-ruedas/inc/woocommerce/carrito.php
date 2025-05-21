<?php
add_action('wp_ajax_quitar_item_carrito', 'quitar_item_carrito');
add_action('wp_ajax_nopriv_quitar_item_carrito', 'quitar_item_carrito');
function quitar_item_carrito() {
    if (isset($_POST['cart_item_key'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        WC()->cart->remove_cart_item($cart_item_key);
        WC()->cart->set_session();
        WC()->cart->calculate_totals();
                $contenido_carrito = renderizar_carrito_desplegable();

        wp_send_json_success([
            'html_carrito' => $contenido_carrito,
            'mensaje' => 'Producto eliminado del carrito'
        ]);
    } else {
        wp_send_json_error(['mensaje' => 'No se recibió el cart_item_key']);
    }
}

add_action('wp_ajax_vaciar_todo_el_carrito', 'vaciar_todo_el_carrito');
add_action('wp_ajax_nopriv_vaciar_todo_el_carrito', 'vaciar_todo_el_carrito');

function vaciar_todo_el_carrito() {
    WC()->cart->empty_cart();
    // Recalcular los totales después de vaciar el carrito
    WC()->cart->calculate_totals();
    // Establecer la sesión del carrito
    WC()->cart->set_session();

    // Generamos el HTML del carrito vacío
    $contenido_carrito = renderizar_carrito_desplegable();

    wp_send_json_success([
        'html_carrito' => $contenido_carrito,
        'mensaje' => 'Carrito vaciado.'
    ]);
}


