$(document).ready(function(){
    $(document).on('click','.complete-payment', function() {
        var orderID = Number($('.order-id-class').val());
        console.log(orderID);
        $.ajax({
            url: App.base_path + 'orders/complete-payment',
            type: 'POST',
            data: {
                order_id: orderID
            },
            success: function (data) {
                window.location.href = "/orders/confirmation";
            }
        });
    });
});