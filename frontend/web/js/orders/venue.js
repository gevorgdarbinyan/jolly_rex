$(document).ready(function () {

    $(document).on('click', '.choose_venue_btn', function () {
        var orderID = $(this).closest('tr').attr('order-id');
        $('.order-id-val-for-venue').val(orderID);
        $.ajax({
            url: App.base_path + 'ajax/load-venue-list',
            type: 'POST',
            data: {
            },
            success: function (data) {
                $('.venue-list-area').html(data.venue_data_list);
                $('#modal-venue-content').modal('show');
            }
        });
    });

//    $(document).on('click', '.venue-dialog-search-button', function () {
    $(document).on('keyup', '.venue-dialog-search', function () {
//        var venueName = $('.venue-dialog-search').val();
//        $.ajax({
//            url: App.base_path + 'ajax/load-venue-list',
//            type: 'POST',
//            data: {
//                venue_name: venueName
//            },
//            success: function (data) {
//                $('.venue-list-area').html(data.venue_data_list);
//                $('#modal-venue-content').modal('show');
//            }
//        });
    });

    $(document).on('click', '.add_venue_to_event', function () {
        var venueID = $(this).attr('rel');
        var orderID = $('.order-id-val-for-venue').val();

        $.ajax({
            url: App.base_path + 'ajax/add-venue-to-order',
            type: 'POST',
            data: {
                venue_id: venueID,
                order_id: orderID
            },
            success: function (data) {
                if (data.success === true) {
                    $('tr[order-id="' + orderID + '"]').find('.selected-venue-class').html(data.venueName);
                    $('#modal-venue-content').modal('hide');
                }
            }
        });
    });

});