$(document).ready(function(){
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