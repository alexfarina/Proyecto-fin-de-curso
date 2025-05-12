<?php
get_header();

// Obtener término de búsqueda
$search_term = get_search_query();

echo '<h1>Resultados de búsqueda para: <mark>' . esc_html($search_term) . '</mark></h1>';

// Consulta personalizada solo para productos
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => 9, 
    's'              => $search_term,
);

$product_query = new WP_Query($args);

echo '<main class="main">'; 
echo '<section class="section">'; 

if ($product_query->have_posts()) :

    echo '<ul class="products">'; // Contenedor principal para productos
    
    while ($product_query->have_posts()) : $product_query->the_post();
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
else :
    echo '<p>No se encontraron productos relacionados.</p>';
endif;

echo '</section>';
echo '</main>';

wp_reset_postdata();

get_footer();
?>
