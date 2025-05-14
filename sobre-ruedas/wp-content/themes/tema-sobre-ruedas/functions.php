<?php
function mostrar_menu_de_productos() {
    global $wpdb;
    // Categorias
    $consulta1 = "
    SELECT t.term_id, t.name, t.slug FROM {$wpdb->terms} t
    INNER JOIN {$wpdb->term_taxonomy} tt ON t.term_id = tt.term_id WHERE 
    tt.taxonomy = 'product_cat' AND tt.parent = 0 ORDER BY t.name ASC";

    $categorias_principales = $wpdb->get_results($consulta1);

    if ($categorias_principales) {
        echo '<ul class="menu-categorias">';

        foreach ($categorias_principales as $categoria) {
            if ($categoria->name === 'Uncategorized') continue;

            $categoria_url = 'http://localhost/sobre-ruedas/product-category/' . $categoria->slug . '/';
            
            echo '<li class="categoria" onclick="mostrarSubcategorias(this)">';
            echo '<a href="' . esc_url($categoria_url) . '" class="categoria-nombre">' . esc_html($categoria->name) . '</a>';

            // Subcategorías
            $query_subcategorias = "
            SELECT t.term_id, t.name, t.slug FROM {$wpdb->terms} t JOIN {$wpdb->term_taxonomy}
            tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'product_cat' AND 
            tt.parent = {$categoria->term_id} ORDER BY t.name ASC";

            $subcategorias = $wpdb->get_results($query_subcategorias);

            if ($subcategorias) {
                echo '<ul class="subcategorias">';
                foreach ($subcategorias as $subcategoria) {

                    $subcategoria_url = 'http://localhost/sobre-ruedas/product-category/' . $subcategoria->slug . '/';
                    
                    echo '<li><a href="' . esc_url($subcategoria_url) . '">' . esc_html($subcategoria->name) . '</a></li>';
                }
                echo '</ul>';
            }

            echo '</li>';
        }
        echo '</ul>';

    } else {
        echo 'No se han encontrado categorías de productos.';
    }
}



function tema_sobre_ruedas_enqueue_scripts() {

    wp_enqueue_style('tema-sobre-ruedas-style', get_stylesheet_uri());


    wp_enqueue_script('jquery');

    // Script personalizado para AJAX "añadir al carrito"
    wp_enqueue_script(
        'add-to-cart-ajax',
        get_template_directory_uri() . '/js/anadir-carrito.js',
        array('jquery'),
        '1.0',
        true
    );

    // Pasar datos de PHP a JS
    wp_localize_script('add-to-cart-ajax', 'miTemaVars', array(
        'ajax_url'    => admin_url('admin-ajax.php'),
        'carrito_url' => esc_url(get_permalink(get_page_by_path('carrito-desplegable')))
    ));
}
add_action('wp_enqueue_scripts', 'tema_sobre_ruedas_enqueue_scripts', 20);

// Eliminar estilos por defecto de WooCommerce que no se necesitan
add_filter('woocommerce_enqueue_styles', function($styles) {
    unset($styles['woocommerce-general']);
    unset($styles['woocommerce-layout']);
    return $styles;
});

// Cambiar a 3 columnas en tienda/categorías
add_filter('loop_shop_columns', function () {
    return 3;
}, 999);

// Quitar botón "añadir al carrito" del loop
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Quitar texto "¡Oferta!"
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

// Manejador AJAX para añadir productos al carrito
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
