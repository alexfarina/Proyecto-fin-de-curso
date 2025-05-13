<?php
/**
 * Template Name: Plantilla para páginas estáticas con productos
 * Description: Plantilla para mostrar páginas estáticas con productos si estamos en una categoría.
 */

defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="contact-page">
    <h1><?php the_title(); ?></h1>

    <div class="page-content">
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

                $pagina_actual = max( 1, get_query_var('paged') ); // Obtenemos la página actual

                // Crear los argumentos para WP_Query filtrando por la categoría actual
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 9,
                    'post_status'    => 'publish',
                    'paged'          => $pagina_actual,
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

            if ( $loop->have_posts() ) :
                echo '<ul class="products">'; 
                while ( $loop->have_posts() ) : $loop->the_post();
                    global $product;
                    ?>
                    <li class="product <?php if ( ! $product->is_in_stock() ) echo 'outofstock'; ?>"> 
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="producto-imagen">
                                    <?php the_post_thumbnail( 'medium' ); ?>
                                </div>
                            <?php endif; ?>
                            <div class="producto-info">
                                <h2 class="producto-titulo"><?php the_title(); ?></h2>
                                <p class="producto-precio">
                                    <?php echo $product->get_price_html(); ?>
                                </p>
                            </div>
                        </a>
                    </li>
                    <?php
                endwhile;
                echo '</ul>'; 
                 // Paginación para los productos del loop
                 echo '<div class="paginacion">';
                 echo paginate_links( array(
                     'total' => $loop->max_num_pages, 
                 ) );
                 echo '</div>';

            else :
                echo '<p>No hay productos disponibles en esta categoría.</p>';
            endif;
        
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
