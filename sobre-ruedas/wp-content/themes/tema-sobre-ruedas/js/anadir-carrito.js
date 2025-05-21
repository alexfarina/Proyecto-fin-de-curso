jQuery(document).ready(function($) {
    // Abrir y cerrar carrito
    $('#boton-carrito').on('click', function(e) {
        e.preventDefault();
        $('#carrito-desplegable').addClass('abierto').removeClass('oculto');
    });

    $('#cerrar-carrito, #volver-carrito').on('click', function() {
        $('#carrito-desplegable').removeClass('abierto').addClass('oculto');
    });

    // Añadir producto al carrito
    $('.single_add_to_cart_button').on('click', function(e) {
        e.preventDefault();
        var form = $(this).closest('form.cart');
        var product_id = form.find('input[name="product_id"]').val();
        var quantity = form.find('input[name="quantity"]').val() || 1;

        $.ajax({
            url: miTemaVars.ajax_url,
            type: 'POST',
            data: {
                action: 'woocommerce_ajax_add_to_cart',
                product_id: product_id,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    // Actualizar el HTML del carrito 
                    $('.contenido-carrito').html(response.data.html_carrito);
                    alert("Producto añadido al carrito.");
                } else {
                    alert("Producto sin existencias.");
                }
            },
            error: function() {
                alert("Error en la solicitud AJAX.");
            }
        });
    });

    // Quitar producto del carrito
    $(document).on('click', '.quitar-item', function() {
        const cartItemKey = $(this).data('cart-item-key');

        $.ajax({
            url: miTemaVars.ajax_url,
            type: 'POST',
            data: {
                action: 'quitar_item_carrito',
                cart_item_key: cartItemKey
            },
            success: function(response) {
                if (response.success) {
                    $('.contenido-carrito').html(response.data.html_carrito);
                    alert('Producto eliminado del carrito.');
                } else {
                    alert("Error al eliminar el producto.");
                }
            },
            error: function() {
                alert("Error en la solicitud AJAX.");
            }
        });
    });


    // Vaciar el carrito
jQuery(document).on('click', '#vaciar-carrito', function(e) {
    e.preventDefault();

    $.ajax({
        url: miTemaVars.ajax_url,
        type: 'POST',
        data: {
            action: 'vaciar_todo_el_carrito'
        },
        success: function(response) {
            if (response.success) {
                console.log('Carrito vacío:', response);  
                $('.contenido-carrito').html(response.data.html_carrito);
                alert('Carrito vaciado.');
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

