<?php
$product_id = get_the_ID();
global $wpdb;

$query = $wpdb->prepare(
    "SELECT p.ID, p.post_title, p.post_content AS descripcion_larga, p.post_excerpt AS descripcion_corta, 
            p.post_date, p.post_status,
            t.name AS marca_nombre
     FROM {$wpdb->posts} p
     JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
     JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
     JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
     WHERE p.ID = %d AND tt.taxonomy = 'product_brand'",
    $product_id
);

$producto = $wpdb->get_row($query);

if ($producto) :
    echo "<h2>¡Producto encontrado!</h2>"; // Asegúrate de que el producto se recupera
    // Aquí va el código de tu producto...
else :
    echo "<h2>No se encontró el producto.</h2>";
endif;
