//Registramos el ajax del boton para busquedas con mis filtros esta vez usando js en vexz de jquery
const linkFiltros = document.getElementById('link-menu-filtros');

linkFiltros.addEventListener('click', function(e) {
    alert('Has hecho click');
  e.preventDefault(); 


  const datos = new FormData();
  datos.append('action', 'mi_funcion_ajax'); 

  fetch('/wp-admin/admin-ajax.php', {
    method: 'POST',
    body: datos,
  })
  .then(response => response.json())
  .then(data => {
    console.log('Respuesta AJAX:', data);
  })
  .catch(error => console.error('Error en AJAX:', error));
});
