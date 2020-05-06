$(document).ready(function () {
    
    $(document).on('click', '.choose_product_btn', function () {
        var orderID = $(this).closest('tr').attr('order-id');
        $.ajax({
            url: App.base_path + 'ajax/load-product-list',
            type: 'POST',
            data: {
                order_id_val: orderID
            },
            success: function (data) {
                $('.product-list-area').html(data.product_data_list);
                $('#modal-product-content').modal('show');
            }
        });
    });
    
    $(document).on('click', '.product-item-list-block', function (e) {
        if ($(e.target).is('span')) return;
        if ($(e.target).is('input')) return;
        var order_id = $('.order_id_val_for_product').val();
        var product_item_id = $(this).attr('product-item-id');
        var product_provider_id = $(this).attr('product-provider-id');
        var product_item_count = $(this).find('.product-item-count').val();
        var selected_product_items = $('.selected_product_items').val();
        var jsonVariables = {};
        var existingProductItemsArray = [];
        
        if (selected_product_items) {
            var json_string_object = JSON.parse(selected_product_items);
            
            $.each(json_string_object, function(key, item) {
                existingProductItemsArray.push(key);
            });
            
            if ($.inArray(product_item_id, existingProductItemsArray) !== -1) {
                delete json_string_object[product_item_id];
            } else {
                json_string_object[product_item_id] = {product_provider_id: product_provider_id, product_item_id: product_item_id, order_id: order_id, product_item_count: product_item_count};
            }
            
            $('.selected_product_items').val(JSON.stringify(json_string_object));
        } else {
            jsonVariables[product_item_id] = {product_provider_id: product_provider_id, product_item_id: product_item_id, order_id: order_id, product_item_count: product_item_count};
            $('.selected_product_items').val(JSON.stringify(jsonVariables));
        }

        if ($('.selected_product_items').val()) {
            $('.select_product_items').attr('disabled', false);
        } else {
            $('.select_product_items').attr('disabled', true);
        }

        if (isEmpty(JSON.parse($('.selected_product_items').val()))) {
            $('.select_product_items').attr('disabled', true);
        }

        if (rgb2hex($(this).css('background-color')) === '#31708f') {
            $(this).css('background-color', '');
        } else {
            $(this).css('background-color', '#31708f');
        }
    });

    $(document).on('click', '.select_product_items', function () {

        var selected_product_items = $('.selected_product_items').val();

        $.ajax({
            url: App.base_path + 'ajax/get-selected-product-items',
            type: 'POST',
            data: {
                selected_product_items: selected_product_items
            },
            success: function (data) {
                $('.product-list-area').html('');
                $('#modal-product-content').modal('hide');
            }
        });

    });
    
    $(document).on('click', '.input-number-increment', function () {
        var $input = $(this).parent().find('.product-item-count');
        var val = parseInt($input.val());
        $input.val(val + 1);
    });

    $(document).on('click', '.input-number-decrement', function () {
        var $input = $(this).parent().find('.product-item-count');
        var val = parseInt($input.val(), 10);
        if (val > 1) {
            $input.val(val - 1);
        } else {
            $input.val(1);
        }
    });
    
});