<?php
get_header();
printf('Este el el archivo principal que usa wordprres para mostras templates de paginas estaticas');
//get_header('secundario');
//include TEMPLATEPATH . '/content.php';
get_template_part('content');
get_sidebar();
get_footer();
?>

   
