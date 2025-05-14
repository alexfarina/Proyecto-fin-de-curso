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
