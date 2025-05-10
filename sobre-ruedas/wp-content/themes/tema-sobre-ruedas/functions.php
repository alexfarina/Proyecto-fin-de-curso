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

