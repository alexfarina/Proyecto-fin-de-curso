<?php
defined( 'ABSPATH' ) || exit;

get_header();

// Obtener el ID del producto clicado
$product_id = get_the_ID(); // Esto obtiene el ID del producto actual (el que está siendo visualizado)

global $wpdb;

// Consulta combinada para obtener los datos del producto y la marca usando JOIN
$query = $wpdb->prepare(
    "SELECT p.ID, p.post_title, p.post_content AS long_description, p.post_excerpt AS short_description, 
            p.post_date, p.post_status,
            t.name AS brand_name
     FROM {$wpdb->posts} p
     JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
     JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
     JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
     WHERE p.ID = %d AND tt.taxonomy = 'product_brand'",
    $product_id
);

// Ejecutar la consulta
$product_data = $wpdb->get_row($query);

// Verificar si hay datos del producto
if ($product_data) :
?>

<main class="main">
    <section class="section">
        <article <?php post_class(); ?>>

            <!-- Título del producto -->
            <div class="product-title">
                <h1><?php echo esc_html($product_data->post_title); ?></h1>
            </div>

            <!-- Detalles del producto -->
            <div class="product-details">

                <!-- Imagen del producto -->
                <div class="product-image">
                    <img src="<?php echo get_the_post_thumbnail_url( $product_id, 'full' ); ?>" alt="Imagen del producto">
                </div>

                <!-- Descripción corta (HTML) -->
                <div class="product-short-description">
                    <h2>Descripción corta</h2>
                    <p><?php echo wp_kses_post($product_data->short_description); ?></p>
                </div>

                <!-- Descripción larga (HTML) -->
                <div class="product-long-description">
                    <h2>Descripción larga</h2>
                    <?php echo wp_kses_post($product_data->long_description); ?>
                </div>

                <!-- Fecha de publicación -->
                <div class="product-publish-date">
                    <p><strong>Publicado en:</strong> <?php echo esc_html($product_data->post_date); ?></p>
                </div>

                <!-- Estado del producto -->
                <div class="product-status">
                    <p><strong>Estado:</strong> <?php echo esc_html($product_data->post_status); ?></p>
                </div>

                <!-- Precio (este es solo un ejemplo de cómo obtenerlo de WooCommerce) -->
                <div class="product-price">
                    <?php 
                    // Suponiendo que $product es un objeto de producto de WooCommerce
                    $product = wc_get_product( $product_id ); 
                    echo '<p>' . $product->get_price_html() . '</p>';
                    ?>
                </div>

                <!-- Categorías del producto -->
                <div class="product-categories">
                    <p><strong>Categorías:</strong> <?php echo wc_get_product_category_list( $product_id ); ?></p>
                </div>

                <!-- Etiquetas del producto -->
                <div class="product-tags">
                    <p><strong>Etiquetas:</strong> <?php the_terms( $product_id, 'product_tag', '', ', ' ); ?></p>
                </div>

                <!-- Marca del producto (solo si está disponible) -->
                <div class="product-brand">
                    <?php if ($product_data->brand_name) : ?>
                        <p><strong>Marca:</strong> <?php echo esc_html($product_data->brand_name); ?></p>
                    <?php else : ?>
                        <p><strong>Marca:</strong> No disponible</p>
                    <?php endif; ?>
                </div>

                <!-- Botón para añadir al carrito -->
                <div class="add-to-cart">
                    <?php woocommerce_template_single_add_to_cart(); ?>
                </div>

            </div>

        </article>
    </section>
</main>

<?php
else :
    echo 'Producto no encontrado';
endif;

get_footer();
?>
