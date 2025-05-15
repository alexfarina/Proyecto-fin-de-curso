jQuery(document).ready(function($) {
    // Abrir carrito al pulsar botón
    $('#boton-carrito').on('click', function(e) {
        e.preventDefault();
        $('#carrito-desplegable').addClass('abierto').removeClass('oculto');
    });
    console.log("Carrito");

    // Cerrar carrito al pulsar botón cerrar
    $('#cerrar-carrito').on('click', function() {
        $('#carrito-desplegable').removeClass('abierto').addClass('oculto');
    });
});

jQuery(document).ready(function($) {
    // Asegurarnos que el formulario no se envíe automáticamente
    $('form.cart').on('submit', function(e) {
        e.preventDefault();
    });

    // Aquí estamos escuchando el click del botón "Añadir al carrito"
    $('.single_add_to_cart_button').on('click', function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del botón

        var form = $(this).closest('form.cart');
        var product_id = form.find('input[name="product_id"]').val();
        var quantity = form.find('input[name="quantity"]').val() || 1;

        console.log("ID del producto:", product_id, "Cantidad:", quantity);

        // Llamada AJAX para añadir el producto al carrito
        $.ajax({
            url: miTemaVars.ajax_url, 
            type: 'POST',  
            data: {
                action: 'woocommerce_ajax_add_to_cart',  // Acción 
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    alert("Producto añadido al carrito.");
                } else {
                    alert("Hubo un problema al añadir el producto al carrito.");
                }
            },
            error: function() {
                alert("Error en la solicitud AJAX.");
            }
        });
    });
});

jQuery(document).ready(function($) {
    // Cerrar sidebar
    $('#volver-carrito, #cerrar-carrito').on('click', function() {
        $('#carrito-desplegable').removeClass('abierto').addClass('oculto');
    });

    // Quitar producto individualmente
  $('.quitar-item').on('click', function() {
    const cartItemKey = $(this).data('cart-item-key');
    console.log('Quitar item con key:', cartItemKey); 

    $.ajax({
        url: miTemaVars.ajax_url,
        type: 'POST',
        data: {
            action: 'quitar_item_carrito',
            cart_item_key: cartItemKey
        },
        success: function(response) {
            console.log('Respuesta AJAX:', response);
            location.reload(); // Refresca visualmente
        },
        error: function(error) {
            console.error('Error AJAX:', error);
        }
    });
});


    // Vaciar carrito
    $('#vaciar-carrito').on('click', function() {
        $.ajax({
            url: miTemaVars.ajax_url,
            type: 'POST',
            data: {
                action: 'vaciar_carrito'
            },
            success: function() {
                location.reload();
            }
        });
    });
});

jQuery(document).ready(function($) {
    $('#vaciar-carrito').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: miTemaVars.ajax_url,
            type: 'POST',
            data: {
                action: 'vaciar_todo_el_carrito'
            },
            success: function(response) {
                if (response.success) {
                    alert('Carrito vaciado.');
                    location.reload(); 
                } else {
                    alert('Error al vaciar el carrito.');
                }
            },
            error: function() {
                alert('Fallo la solicitud AJAX.');
            }
        });
    });
});
