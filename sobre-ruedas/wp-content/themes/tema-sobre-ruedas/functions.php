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

// Cambiar el número de columnas en las páginas de categorías de WooCommerce
add_filter('loop_shop_columns', 'cambiar_columnas_categoria', 999);

function cambiar_columnas_categoria() {
    return 3;
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_filter( 'woocommerce_enqueue_styles', 'quitar_estilos_visuales_woo' );
function quitar_estilos_visuales_woo( $styles ) {
    unset( $styles['woocommerce-general'] ); 
    return $styles;
}

function tema_sobre_ruedas_enqueue_styles() {
    wp_enqueue_style('tema-sobre-ruedas-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'tema_sobre_ruedas_enqueue_styles');


add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Eliminar el texto "¡Oferta!" de los productos con descuento
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


function desactivar_estilos_woocommerce_enlaces() {
    // Desactiva los estilos de enlaces predeterminados de WooCommerce
    wp_dequeue_style( 'woocommerce-general' ); // Desactiva el estilo general de WooCommerce
    wp_dequeue_style( 'woocommerce-layout' );   // Desactiva el estilo de layout de WooCommerce
}

add_action( 'wp_enqueue_scripts', 'desactivar_estilos_woocommerce_enlaces', 99 );
