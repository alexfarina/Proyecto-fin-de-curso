<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header" class="header">
        <div class="header-top">
            <div class="logo">
            <h2 class="logo">Sobre Ruedas</h2>
            <a href="<?php echo home_url(); ?>" style="text-decoration:none; color:white; display:flex; align-items:center; gap:10px;">
                <img src="http://localhost/sobre-ruedas/wp-content/uploads/2025/05/skateboard-logo2.png" alt="Sobre Ruedas" style="height:30px;">
            </a>
            </div>

            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <label>
                    <span class="screen-reader-text">Buscar productos:</span>
                    <input type="search" class="search-field" placeholder="Buscar productos…" value="<?php echo get_search_query(); ?>" name="s" />
                </label>
                <input type="hidden" name="post_type" value="product" />
                <button type="submit" class="search-submit">🔍</button>
            </form>

            <div class="paginas-estaticas">
                <a href="http://localhost/sobre-ruedas/contacto/">Contacto</a>
                <a href="http://localhost/sobre-ruedas/blog/">Blog</a>
                <a href="http://localhost/sobre-ruedas/sobre-nosotros/">Sobre Nosotros</a>
                <a href="#" id="boton-carrito">
                    <img src="http://localhost/sobre-ruedas/wp-content/uploads/2025/05/shopping-cart.png" alt="Carrito de compras" style="height:30px;" />
                </a>

                 <a href="#"><img src="http://localhost/sobre-ruedas/wp-content/uploads/2025/05/tel-logo.png" alt="Teléfono"  style="height:30px;" /></a>
            </div>
        </div>

        <div class="header-bot">
            <nav class="nav">
                <?php mostrar_menu_de_productos() ?>
            </nav>
        </div>
    </header>
    <section class="section">
