<section id="carrito-desplegable" class="carrito-desplegable oculto">
    <button id="cerrar-carrito" class="cerrar-carrito">✖</button>
    <h3>Tu carrito</h3>

    <div class="contenido-carrito">
        <?php
        if ( WC()->cart->is_empty() ) {
            echo '<p>Tu carrito está vacío.</p>';
        } else {
            echo '<ul class="lista-carrito">';
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $producto = $cart_item['data'];
                $cantidad = $cart_item['quantity'];
                echo '<li data-cart-item-key="' . esc_attr($cart_item_key) . '">';
                echo $producto->get_image( [50, 50] );
                echo '<span>' . esc_html( $producto->get_name() ) . '</span>';
                echo ' × ' . $cantidad;
                echo ' <button class="quitar-item" data-cart-item-key="' . esc_attr($cart_item_key) . '">✖</button>';
                echo '</li>';
            }
            echo '</ul>';

            echo '<button id="vaciar-carrito" class="vaciar-carrito-btn">Vaciar carrito</button>';
        }
        ?>
    </div>

    <p><button id="volver-carrito" class="volver-menu">← Volver</button></p>
</section>
