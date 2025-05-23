</section> <!-- Cierre del <section> que abrió en header.php -->
    <footer id="footer">
        <div class="footer-item">
            Pie de Página 
        </div>
    </footer>
    <?php wp_footer(); ?>
    <?php get_template_part('sidebar-carrito'); ?>

    <div id="div_filtros" class="oculto contenedor-filtros">
        <button class="cerrar-popup">x</button>
        <div class="filtros-contenedor">
            <div class="menu-filtros">
                <div class="filtro-item" data-target="marcas">Marcas <span>></span></div>
                <div class="filtro-item" data-target="precio">Precio <span>></span></div>
            </div>

            <form method="get" action="<?php echo esc_url(site_url('/sobre-ruedas/filtros/')); ?>" class="formulario-filtros">
                <div class="contenido-filtro" id="filtro-marcas">
                    <?php echo mostrar_filtro_marcas(); ?>
                </div>

                <div class="contenido-filtro" id="filtro-precio">
                    <?php echo mostrar_filtro_precio(); ?>
                </div>
                <button type="submit" class="boton-filtros oculto">Aplicar Filtros</button>
            </form>
        </div>
    </div>
</body>
</html>

