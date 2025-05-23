<?php
function mostrar_filtro_marcas() {
    global $wpdb;

    $consulta_marcas = "SELECT t.term_id, t.name, t.slug 
                        FROM wp_terms t 
                        JOIN wp_term_taxonomy tt ON tt.term_id = t.term_id 
                        WHERE tt.taxonomy = 'product_brand'";
    $marcas = $wpdb->get_results($consulta_marcas);

    if (empty($marcas)) {
        return '<p>No hay marcas disponibles.</p>';
    }

    $selected = isset($_GET['filtrar_marcas']) ? (array) $_GET['filtrar_marcas'] : [];

    $html_marcas = '<h4>Filtrar por Marca</h4>';
    foreach ($marcas as $marca) {
        $checked = in_array($marca->slug, $selected) ? 'checked' : '';
        $html_marcas .= '<label>';
        $html_marcas .= '<input type="checkbox" name="filtrar_marcas[]" value="' . esc_attr($marca->slug) . '" ' . $checked . '> ';
        $html_marcas .= esc_html($marca->name);
        $html_marcas .= '</label><br>';
    }

    return $html_marcas;
}
