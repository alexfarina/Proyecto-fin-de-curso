//Mostrar/ocultar el popup de filtros.

document.addEventListener('DOMContentLoaded', function() {
  const linkFiltros = document.getElementById('link-menu-filtros');
  const popup = document.getElementById('div_filtros');
  const btnCerrar = popup.querySelector('.cerrar-popup');
  const items = popup.querySelectorAll('.filtro-item');
  const contenidos = popup.querySelectorAll('.contenido-filtro');

    linkFiltros.addEventListener('click', function(e) {
      e.preventDefault();
      popup.classList.remove('oculto');
    });

    btnCerrar.addEventListener('click', function() {
      popup.classList.add('oculto');
      contenidos.forEach(c => c.classList.add('oculto')); 
    });

    items.forEach(item => {
      item.addEventListener('click', function() {
        const targetId = 'filtro-' + item.dataset.target;

        contenidos.forEach(c => {
          if (c.id === targetId) {
            c.classList.remove('oculto');
          } else {
            c.classList.add('oculto');
          }
        });
      });
    });
});


//Actualizar el valor de la barra para filtrar por precio
document.addEventListener('DOMContentLoaded', function() {
  const sliderMin = document.getElementById('precio_min');
  const sliderMax = document.getElementById('precio_max');
  const minVal = document.getElementById('min_val');
  const maxVal = document.getElementById('max_val');

  if (sliderMin && minVal) {
    sliderMin.addEventListener('input', function() {
      minVal.textContent = this.value;
    });
  }

  if (sliderMax && maxVal) {
    sliderMax.addEventListener('input', function() {
      maxVal.textContent = this.value;
    });
  }
});


document.addEventListener('DOMContentLoaded', function () {
  const botonesFiltro = document.querySelectorAll('.filtro-item');  
  const botonAplicar = document.querySelector('.boton-filtros');
  const botonMenu = document.querySelector('.cerrar-popup'); 

  // Al clicar  marcas o precio  muestra el  botón de aplicar filtros
  botonesFiltro.forEach(boton => {
    boton.addEventListener('click', () => {
      botonAplicar.style.display = 'inline-block';
    });
  });

  // Al clicar en botón menú ocultar botón aplicar filtros
  botonMenu.addEventListener('click', () => {
    botonAplicar.style.display = 'none';
  });
});
