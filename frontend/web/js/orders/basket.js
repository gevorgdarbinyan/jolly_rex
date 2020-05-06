$(document).ready(function () {
    
//    $(document).on('click', '.venue-dialog-search-button', function () {
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
//    });
    
//    $(document).on('click', '.add_venue_to_event', function () {
//        var venueID = $(this).attr('rel');
//        var orderID = $('.order-id-val-for-food').val();
//        
//        $.ajax({
//            url: App.base_path + 'ajax/add-venue-to-order',
//            type: 'POST',
//            data: {
//                venue_id: venueID,
//                order_id: orderID
//            },
//            success: function (data) {
//                if (data.success === true) {
//                    $('tr[order-id="' + orderID + '"]').find('.selected-venue-class').html(data.venueName);
//                    $('#modal-venue-content').modal('hide');
//                }
//            }
//        });
//    });


    $(document).on('click', '.amend-order', function () {
        var orderID = $(this).attr('rel');
        $.ajax({
            url: App.base_path + 'orders/amend-order',
            type: 'POST',
            data: {
              order_id: orderID  
            },
            success: function (data) {
                $('#order-amendment-panel').html(data);
                $('#order-amendment-container').css('display','block');
            }
        });
    });

    $(document).on('click', '.close-amend-order-panel', function () {
        $('#order-amendment-panel').html('');
        $('#order-amendment-container').css('display','none');
    });

    $(document).on('click', '.save-order-class', function(){
        var orderID = $('.order-id-class').val();
        var formData = $('#amend-form').serializeArray();
        $.ajax({
            url: App.base_path + 'orders/save-order',
            type: 'POST',
            data: {
              order_id: orderID,
              form_data: formData
            },
            success: function (data) {
                if(data == 1) {
                    $('#order-amendment-panel').html('');
                    $('#order-amendment-container').css('display','none');
                }
            }
        });
    });
});

$(document).on('change', '.add-price-class', function () {
    var partyThemeID = $(this).prev().val();
    $('input.party-theme-id-class[value="' + partyThemeID + '"]').next().not($(this)).prop('checked', false);
    var total = countSum();
    setPriceSetup();
    $('.total-price').html(total);
    $('.total-price-value').val(total);
});

function countSum(){
    var sum = 0;
    $.each($('.add-price-class'), function(item){
        var price = Number($(this).parent().prev().html());
        if($(this).is(':checked')){
            sum += price;
        }
    });
    return sum;
}

function setPriceSetup() {
    var ids = [], id;
    $.each($('.add-price-class'), function(item){
        if($(this).is(':checked')){
            id = Number($(this).closest('tr').find('td:nth-child(1)').find('.price-setup-id-class').val());
            ids.push(id);
        }
    });
    $('.price-setups').val(JSON.stringify(ids));
}

$(document).on('change', '.package-price-class', function() {
    var $totalPrice = $('.total-price');
    var me = $(this);
    if(me.is(':checked')){
        $('.package-price-class').not(me).prop('checked', false);
        $totalPrice.html(me.parent().prev().html());
        $('.entertainer-package-class').val(me.attr('rel'));
    }else{
        $totalPrice.html('');
    }
});

$(window).bind('beforeunload',function() {
    var orderAmendmentContent = $('#order-amendment-panel').html();
    if(orderAmendmentContent != '') {
        return 'Are you sure you want to leave?';
    }
});

var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");

//Function to convert rgb color to hex format
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}

function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}
 
function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
            return false;
    }

    return JSON.stringify(obj) === JSON.stringify({});
}