<?php
get_header();
$search_template='
<h1 class="searchtitle">Este el el archivo principal que usa wordpress para mostrar búsquedas por formularios</h1>
<p>Los resultados de la búsqueda  <mark>%s</mark> son:</p>';
//get_header('secundario');
//include TEMPLATEPATH . '/content.php';
printf($search_template, get_search_query());
get_template_part('content');
get_sidebar();
get_footer();
?>

   
