<?php
add_action('wp_ajax_quitar_item_carrito', 'quitar_item_carrito');
add_action('wp_ajax_nopriv_quitar_item_carrito', 'quitar_item_carrito');
function quitar_item_carrito() {
    if (isset($_POST['cart_item_key'])) {
        $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
        WC()->cart->remove_cart_item($cart_item_key);
        WC()->cart->set_session();
        WC()->cart->calculate_totals();
        wp_send_json_success(['mensaje' => 'Producto eliminado del carrito']);
    } else {
        wp_send_json_error(['mensaje' => 'No se recibió el cart_item_key']);
    }
}

add_action('wp_ajax_vaciar_todo_el_carrito', 'vaciar_todo_el_carrito');
add_action('wp_ajax_nopriv_vaciar_todo_el_carrito', 'vaciar_todo_el_carrito');
function vaciar_todo_el_carrito() {
    WC()->cart->empty_cart();
    wp_send_json_success(['mensaje' => 'Carrito vaciado']);
}

add_action('init', function() {
    if (isset($_GET['prueba_quitar'], $_GET['key'])) {
        WC()->cart->remove_cart_item(sanitize_text_field($_GET['key']));
        WC()->cart->calculate_totals();
        WC()->cart->set_session();
        echo 'Prueba eliminar: OK';
        exit;
    }
});
