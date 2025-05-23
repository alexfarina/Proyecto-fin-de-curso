<?php
function mostrar_filtro_precio() {
    $precio_min = isset($_GET['precio_min']) ? intval($_GET['precio_min']) : 0;
    $precio_max = isset($_GET['precio_max']) ? intval($_GET['precio_max']) : 1000;

    $html_precio = '<h4>Filtrar por Precio</h4>';

    $html_precio .= '<label>Precio mínimo: <span id="min_val">' . $precio_min . '</span> €</label><br>';
    $html_precio .= '<input type="range" id="precio_min" name="precio_min" min="0" max="2000" step="10" value="' . $precio_min . '"><br>';

    $html_precio .= '<label>Precio máximo: <span id="max_val">' . $precio_max . '</span> €</label><br>';
    $html_precio .= '<input type="range" id="precio_max" name="precio_max" min="0" max="2000" step="10" value="' . $precio_max . '"><br>';

    return $html_precio;
}
