<main class="main">
    <section class="section">
        <?php
        if ( class_exists( 'WooCommerce' ) ) :
            // Verificar si estamos en una página de categoría de producto
            if ( is_product_category() ) :
                // Obtener el término de la categoría actual
                $term = get_queried_object();
                

                // Asegurarnos de que el término tenga un slug
                if ( ! isset($term->slug) ) {
                    echo 'No se ha encontrado el slug de la categoría.';
                } else {
                    echo 'Slug de la categoría: ' . $term->slug;
                }

                // Crear los argumentos para WP_Query filtrando por la categoría actual
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 9,
                    'post_status'    => 'publish',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'slug',
                            'terms'    => $term->slug, // Usamos el slug de la categoría actual
                            'operator' => 'IN',
                        ),
                    ),
                );

            else :
                // Si no estamos en una categoría, mostrar todos los productos
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 9,
                    'post_status'    => 'publish',
                );
            endif;

            // Ejecutar WP_Query para obtener los productos
            $loop = new WP_Query( $args );

            // Verificar si hay productos disponibles
            if ( $loop->have_posts() ) :
                echo '<div class="productos-grid">';
                while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
                    ?>
                    <div class="producto-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="producto-imagen">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="producto-info">
                                <h2><?php the_title(); ?></h2>
                                <p class="producto-precio">
                                    <?php echo $product->get_price_html(); ?>
                                </p>
                            </div>
                        </a>
                    </div>
                    <?php
                endwhile;
                echo '</div>';
            else :
                echo '<p>No hay productos disponibles en esta categoría.</p>';
            endif;

            wp_reset_postdata();
        endif;
        ?>
    </section>
</main>
