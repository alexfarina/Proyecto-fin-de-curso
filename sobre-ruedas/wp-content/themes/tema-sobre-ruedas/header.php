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
        <h4 class="logo"><a href="<?php echo home_url(); ?>" style="text-decoration:none; color:white;">Logo</a></h4>
        <nav class="nav">Menú</nav>
    </header>
    <section class="section">
