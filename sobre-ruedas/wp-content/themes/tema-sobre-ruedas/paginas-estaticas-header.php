<?php
/* Template Name: Páginas Estáticas Personalizadas para el Header */
get_header();
?>

<main class="pagina-estatica-centrado">
    <div class="contenedor-pagina-estatica">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <div class="contenido-pagina">
                    <h1><?php the_title(); ?></h1>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="imagen-destacada">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="contenido">
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php
            endwhile;
        else :
            echo '<p>Contenido no disponible.</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
?>
