$(document).ready(function(){
    
    $(document).on('click', '.search_food_items_checkbox', function () {
        
        $.ajax({
            url: App.base_path + 'food/load-all-food-items',
            type: 'POST',
            data: {
            },
            success: function (data) {
                $('.food-provider-block').html(data);
                $('.search_food_pattern').show(400);
            }
        });
        
    });
    
    $(document).on('keyup', '.search_food_pattern', function () {

        $.ajax({
            url: App.base_path + 'food/load-all-food-items',
            type: 'POST',
            data: {
                search_pattern: $('.search_food_pattern').val()
            },
            success: function (data) {
                $('.food-provider-block').html(data);
            }
        });
        
    });
    
});