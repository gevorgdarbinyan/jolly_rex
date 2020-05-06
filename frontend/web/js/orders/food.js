$(document).ready(function () {

    $(document).on('click', '.choose_food_btn', function () {
        var orderID = $(this).closest('tr').attr('order-id');
        $.ajax({
            url: App.base_path + 'ajax/load-food-list',
            type: 'POST',
            data: {
                order_id_val: orderID
            },
            success: function (data) {
                $('.food-list-area').html(data.food_data_list);
                $('#modal-food-content').modal('show');
            }
        });
    });
    
    $(document).on('click', '.food-item-list-block', function (e) {
        if ($(e.target).is('span')) return;
        if ($(e.target).is('input')) return;
        var order_id = $('.order_id_val_for_food').val();
        var food_item_id = $(this).attr('food-item-id');
        var food_provider_id = $(this).attr('food-provider-id');
        var food_item_count = $(this).find('.food-item-count').val();
        var selected_food_items = $('.selected_food_items').val();
        var jsonVariables = {};
        var existingFoodItemsArray = [];
        
        if (selected_food_items) {
            var json_string_object = JSON.parse(selected_food_items);
            
            $.each(json_string_object, function(key, item) {
                existingFoodItemsArray.push(key);
            });
            
            if ($.inArray(food_item_id, existingFoodItemsArray) !== -1) {
                delete json_string_object[food_item_id];
            } else {
                json_string_object[food_item_id] = {food_provider_id: food_provider_id, food_item_id: food_item_id, order_id: order_id, food_item_count: food_item_count};
            }
            
            $('.selected_food_items').val(JSON.stringify(json_string_object));
        } else {
            jsonVariables[food_item_id] = {food_provider_id: food_provider_id, food_item_id: food_item_id, order_id: order_id, food_item_count: food_item_count};
            $('.selected_food_items').val(JSON.stringify(jsonVariables));
        }

        if ($('.selected_food_items').val()) {
            $('.select_food_items').attr('disabled', false);
        } else {
            $('.select_food_items').attr('disabled', true);
        }

        if (isEmpty(JSON.parse($('.selected_food_items').val()))) {
            $('.select_food_items').attr('disabled', true);
        }

        if (rgb2hex($(this).css('background-color')) === '#31708f') {
            $(this).css('background-color', '');
        } else {
            $(this).css('background-color', '#31708f');
        }
    });
    
    $(document).on('click', '.select_food_items', function () {
        
        var selected_food_items = $('.selected_food_items').val();
        
        $.ajax({
            url: App.base_path + 'ajax/get-selected-food-items',
            type: 'POST',
            data: {
                selected_food_items: selected_food_items
            },
            success: function (data) {
                $('.food-list-area').html('');
                $('#modal-food-content').modal('hide');
            }
        });
        
    });
    
    $(document).on('click', '.input-number-increment', function () {
        var $input = $(this).parent().find('.food-item-count');
        var val = parseInt($input.val());
        $input.val(val + 1);
    });

    $(document).on('click', '.input-number-decrement', function () {
        var $input = $(this).parent().find('.food-item-count');
        var val = parseInt($input.val(), 10);
        if (val > 1) {
            $input.val(val - 1);
        } else {
            $input.val(1);
        }
    });
    
});