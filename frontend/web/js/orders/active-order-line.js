$(document).ready(function () {
    
    $(document).on('click', '.active-order-line-show-hide', function () {
        var This = $(this);

        if (This.parent().next().is(":visible")) {
            $('.order-line-block').hide(1000);
            This.find('.glyphicon').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        } else {
            $('.order-line-block').show(1000);
            This.find('.glyphicon').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }
    });

    $(document).on('click','.cancel-entertainer', function() {
        console.log($(this).attr('rel'));
        var entertainerID = $(this).attr('data-entertainer-id');
        var orderID = $(this).attr('data-order-id');
        var me = $(this);
        $.ajax({
            url: App.base_path + 'orders/cancel-entertainer',
            type: 'POST',
            data: {
                entertainer_id: entertainerID
            },
            dataType: "json",
            success: function(data) {
                
            }
        });
    });
    
});