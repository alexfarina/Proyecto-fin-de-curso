<aside id="aside-carrito" class="aside-carrito">
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
                echo '<li>';
                echo $producto->get_image( [50, 50] );
                echo '<span>' . esc_html( $producto->get_name() ) . '</span>';
                echo ' × ' . $cantidad;
                echo '</li>';
            }
            echo '</ul>';
            echo '<p><a href="' . wc_get_cart_url() . '" class="ver-carrito-btn">Ver carrito completo</a></p>';
        }
        ?>
    </div>

    <p><a href="<?php echo home_url(); ?>" class="volver-menu">← Volver al inicio</a></p>
</aside>
