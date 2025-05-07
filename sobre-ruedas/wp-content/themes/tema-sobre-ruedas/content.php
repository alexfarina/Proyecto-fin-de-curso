<main class="main">
<section class="section">
 
<?php
if ( class_exists( 'WooCommerce' ) ) :

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
    );

    $loop = new WP_Query( $args );

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
        echo '<p>No hay productos disponibles.</p>';
    endif;

    wp_reset_postdata();
endif;
?>


</section>
