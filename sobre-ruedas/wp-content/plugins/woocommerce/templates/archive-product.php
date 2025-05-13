<?php
/*
<main class="main">
    <section class="section">
        <?php
        // Verificamos si WooCommerce está activo
        if ( class_exists( 'WooCommerce' ) ) :

            // Si estamos en una categoría de producto
            if ( is_product_category() ) :
                // Obtenemos el objeto del término de la categoría actual
                $term = get_queried_object();
                
                // Verificamos si el slug existe
                if ( ! isset($term->slug) ) {
                    echo 'No se ha encontrado el slug de la categoría.';
                } else {
                    // Mostramos el slug de la categoría actual
                    echo 'Slug de la categoría: ' . $term->slug;
                }

                // Obtenemos el número de la página actual
                $pagina_actual = max( 1, get_query_var('paged') );

                // Argumentos para mostrar productos de la categoría actual
                $args = array(
                    'post_type'      => 'product', // Tipo de post: producto
                    'posts_per_page' => 9, // Número de productos por página
                    'post_status'    => 'publish', // Solo productos publicados
                    'tax_query'      => array( // Filtro por taxonomía
                        array(
                            'taxonomy' => 'product_cat', // Taxonomía: categoría de producto
                            'field'    => 'slug', // Usamos el slug para filtrar
                            'terms'    => $term->slug, // El slug de la categoría actual
                            'operator' => 'IN', // Operador lógico
                        ),
                    ),
                );

            else :
                // Si no es una categoría, mostrar todos los productos
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 9,
                    'post_status'    => 'publish',
                    'paged'          => $pagina_actual // Incluimos paginación
                );
            endif;

            // Ejecutamos la consulta personalizada
            $loop = new WP_Query( $args );

            // Si hay productos en la consulta
            if ( $loop->have_posts() ) :
                echo '<ul class="products">'; // Inicio del contenedor de productos

                // Bucle de productos
                while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
                    ?>
                    <li class="product <?php if ( ! $product->is_in_stock() ) echo 'outofstock'; ?>"> 
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="producto-imagen">
                                    <?php the_post_thumbnail( 'medium' ); // Imagen del producto ?>
                                </div>
                            <?php endif; ?>
                            <div class="producto-info">
                                <h2 class="producto-titulo"><?php the_title(); // Título del producto ?></h2>
                                <p class="producto-precio">
                                    <?php echo $product->get_price_html(); // Precio del producto ?>
                                </p>
                            </div>
                        </a>
                    </li>
                    <?php
                endwhile;
                echo '</ul>'; // Fin del contenedor de productos

                // Paginación
                echo '<div class="paginacion">';
                echo paginate_links( array(
                    'total' => $loop->max_num_pages, // Número total de páginas
                ) );
                echo '</div>';

            else :
                // Mensaje si no hay productos
                echo '<p>No hay productos disponibles en esta categoría.</p>';
            endif;

            // Reseteamos los datos del post
            wp_reset_postdata();
        endif;
        ?>
    </section>
</main>
*/
?>
