$(document).ready(function(){

    $(document).on('click', '.view-details', function(){
        console.log("aaaa");
        str = 1;
        $('#entertainer-order-details-modal-content').html(str);
        $('#entertainer-order-details-modal').modal('show');
    });

    $(document).on('click', '.change-status-class', function(){
        $('.entertainer-order-id-class').val($(this).data('entertainer-order-id'));
        $('#entertainer-order-status-change-modal').modal('show');
    });

    $(document).on('click', '.approve-status-change-class', function(){
        var entertainerOrderID = $('.entertainer-order-id-class').val();
        var status = $('.status-class').val();
        console.log(App.base_path);
        $.ajax({
            url: App.base_path + 'entertainer-orders/approve-status',
            type: 'POST',
            data: {
                entertainer_order_id: entertainerOrderID,
                status: status
            },
            success: function(data) {
                window.location.href = data;
            }
        });
    });
    

})