<?php
defined( 'ABSPATH' ) || exit;

get_header();

// Obtener el ID del producto clicado
$product_id = get_the_ID();

global $wpdb;

// Consulta combinada para obtener los datos del producto y la marca
$query = $wpdb->prepare(
    "SELECT p.ID, p.post_title, p.post_content AS descripcion_larga, p.post_excerpt AS descripcion_corta, 
            p.post_date, p.post_status,
            t.name AS marca_nombre
     FROM {$wpdb->posts} p
     JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
     JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
     JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
     WHERE p.ID = %d AND tt.taxonomy = 'product_brand'",
    $product_id
);

$producto = $wpdb->get_row($query);

if ($producto) :
?>

<main class="main">
    <section class="section">
        <div class="contenedor-producto-individual">
            <article <?php post_class(); ?>>

                <!-- Título -->
                <div class="titulo-producto">
                    <h4><?php echo esc_html($producto->post_title); ?></h4>
                </div>

                <!-- Detalles -->
                <div class="detalles-producto">

                    <!-- Descripción corta -->
                    <div class="descripcion-corta">
                        <p><?php echo wp_kses_post($producto->descripcion_corta); ?></p>
                    </div>

                    <!-- Imagen -->
                     <div class="producto-alineacion-row">
                        <div class="imagen-producto">
                            <img src="<?php echo get_the_post_thumbnail_url( $product_id, 'full' ); ?>" alt="Imagen del producto">
                        </div>

                        <!-- Estado -->
                        <div class="producto-alineacion-col">
                            <div class="estado-producto">
                                <p><strong>Estado:</strong> <?php echo esc_html($producto->post_status); ?></p>
                            </div>

                            <!-- Precio -->
                            <div class="precio-producto">
                                <?php 
                                $producto_wc = wc_get_product( $product_id ); 
                                echo '<p>' . $producto_wc->get_price_html() . '</p>';
                                ?>
                            </div>

                            <!-- Categorías -->
                            <div class="categorias-producto">
                                <p><strong>Categorías:</strong> <?php echo wc_get_product_category_list( $product_id ); ?></p>
                            </div>

                            <!-- Etiquetas -->
                            <div class="etiquetas-producto">
                                <p><strong>Etiquetas:</strong> <?php the_terms( $product_id, 'product_tag', '', ', ' ); ?></p>
                            </div>

                            <!-- Marca -->
                            <div class="marca-producto">
                                    <p><strong>Marca:</strong> <?php echo esc_html($producto->marca_nombre); ?></p>
                            </div>
                        </div>

                        <div class="add-to-cart">
                            <?php
                            if ( $product = wc_get_product( $product_id ) ) :
                            ?>
                              <!-- Formulario para añadir al carrito -->
                            <form class="cart" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="product_id" value="<?php echo esc_attr( $product->get_id() ); ?>" />
                                <input type="hidden" name="quantity" value="1" />
                                <button type="button" class="single_add_to_cart_button">Añadir al carrito</button>
                            </form>
                            <?php else : ?>
                                <p>Producto no disponible</p>
                            <?php endif; ?>
                        </div>
                    </div>
                     <!-- Descripción larga -->
                    <div class="descripcion-larga">
                        <?php echo wp_kses_post($producto->descripcion_larga); ?>
                    </div>

                    <!-- Fecha de publicación -->
                    <div class="fecha-publicacion">
                        <p><strong>Publicado en:</strong> <?php echo esc_html($producto->post_date); ?></p>
                    </div>
                </div>

            </article>
        </div>
    </section>
</main>

<?php
else :
    echo 'Producto no encontrado';
endif;

get_footer();
?>
