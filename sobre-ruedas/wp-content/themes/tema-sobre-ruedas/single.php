<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>

<main class="main">
    <section class="section">
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class(); ?>>
                <!-- Título del producto -->
                <h1 class="product-title"><?php the_title(); ?></h1>

                <!-- Imagen destacada -->
                <div class="product-image">
                    <?php
                    if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'thumbnail' );
                    } 
                    ?>
                </div>
                <!-- Descripción larga -->
                <div class="product-long-description">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </section>
</main>

<?php get_footer(); ?>
