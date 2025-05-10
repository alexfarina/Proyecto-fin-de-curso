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
        <h4 class="logo"><a href="<?php echo home_url(); ?>" style="text-decoration:none; color:white;"><img></img></a></h4>
        <nav class="nav">
        <?php mostrar_menu_de_productos() ?>
        </nav>
    </header>
    <section class="section">
