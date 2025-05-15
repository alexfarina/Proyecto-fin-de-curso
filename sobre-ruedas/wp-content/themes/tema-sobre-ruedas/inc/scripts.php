<?php
function tema_sobre_ruedas_enqueue_scripts() {
    wp_enqueue_style('tema-sobre-ruedas-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'add-to-cart-ajax',
        get_template_directory_uri() . '/js/anadir-carrito.js',
        array('jquery'),
        '1.0',
        true
    );

    wp_localize_script('add-to-cart-ajax', 'miTemaVars', array(
        'ajax_url'    => admin_url('admin-ajax.php'),
        'carrito_url' => esc_url(get_permalink(get_page_by_path('carrito-desplegable')))
    ));
}
add_action('wp_enqueue_scripts', 'tema_sobre_ruedas_enqueue_scripts', 20);
