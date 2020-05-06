$(document).ready(function () {
    var customerID = Number($('.customer-id-class').val());
    //console.log(customerID);
    //console.log(typeof customerID);
    if(!(typeof customerID != 'undefined' && customerID > 0)){
        $('#login-signup-links-modal').modal('show');
    }
    //console.log("test");
    $(document).on('click', '.panel-title', function () {
        var This = $(this);
        var expanded = This.find('a');
        if (expanded.hasClass('collapsed')) {
            This.find('a').find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            This.find('a').find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });

    //$(".fc-other-month .fc-day-number").hide();
    //$('.fc-other-month').html('');

    $(document).on('click', '.choose-date-class', function() {
        var startTime = $('.start-time').val();
        var endTime = $('.end-time').val();
        var entertainersCount = $('.entertainers-count-class').val();

        var timeString = '<strong>'+startTime+'-'+endTime+'</strong>';
        var entertainersCountString = '<strong>'+entertainersCount+'</strong>';
        $('.start-time-class').val(startTime);
        $('.end-time-class').val(endTime);
        $('.entertainers-count').val(entertainersCount);
        $('#event-time').html(timeString);
        $('#entertainers-count-raw').html(entertainersCountString);

        $('#date-time-container').show();
        $('#make-booking-container').show();


        $("#modal-schedule-content").modal('hide');
    });

    $(document).on('click', '.book-entertainer-for-event', function () {
        var entertainerID = $(this).attr('rel');
        var partyTypeID = $('.party-type-class').val();
        var themeServiceID = $('.party-theme-class').val();
        var additionalServiceID = $('.additional-services-class').val();
        var customerID = $('.customer-id-class').attr('rel');
        var eventDate = $('.selected-date-class').val();
        var startTime = $('.start-time-class').val();
        var endTime = $('.end-time-class').val();
        var totalPrice = $('.total-price').html();
        var specialRequest = $('.special-request-class').val();
        var hostChildAge = $('.host-child-age-class').val();
        var hostChildGender = $('.host-child-gender-class input[type="radio"]:checked').val();
        var hostChildName = $('.host-child-name-class').val();
        var telephoneNumber = $('.telephone-number-class').val();
        var themeTableTrObj = $('.theme-service-price-class:checked').parent().parent();
        var additionalServicesTable = $('.additional-services-price-class').parent().parent();
        var extraGuestsCount = themeTableTrObj.find('.extra-guest-count').get().map(function(item){
            return $(item).val();
        });
        console.log(extraGuestsCount);
        var themeServiceValues = themeTableTrObj.find('.theme-service-id-class').get().map(function(item){
            return $(item).val();
        });
        console.log(themeServiceValues);
        var themeServices = [];
        for(index in extraGuestsCount){
            themeServices.push({
                extra_guests_count: extraGuestsCount[index],
                price_setup_id: themeServiceValues[index],
                type: 'theme'
            });
        }

        console.log(themeServices);
        var additionalServiceID = $('.additional-services-class').val();
        var priceServiceID = additionalServicesTable.find('.additional-service-id-class').val();
        var additionalServices = {price_setup_id: priceServiceID,type:'additional_service'};
        console.log(additionalServiceID);
        console.log(additionalServices);
        console.log(JSON.stringify(additionalServices));
        
        var priceType = $('.price-type-class').val();
        var entertainerPackageID = $('.package-price-class').val();
        var entertainersCount = Number($('#entertainers-count-raw strong').html());
        $.ajax({
            url: App.base_path + 'entertainers/book-process',
            type: 'POST',
             data: {
                entertainer_id: entertainerID,
                customer_id: customerID,
                party_type_id: partyTypeID,
                theme_service_id: themeServiceID,
                additional_service_id: additionalServiceID,
                event_date: eventDate,
                start_time: startTime,
                end_time: endTime,
                total_price: totalPrice,
                special_request: specialRequest,
                theme_services: JSON.stringify(themeServices),
                additional_services: JSON.stringify(additionalServices),
                host_child_age: hostChildAge,
                host_child_gender: hostChildGender,
                host_child_name: hostChildName,
                telephone_number: telephoneNumber,
                price_type: priceType,
                package_id : entertainerPackageID,
                entertainers_count : entertainersCount,
            },
            success: function(orderID) {
                 if(orderID){
                    $('.venue-selection-container').show();
                    $('.venue-manually-fill-go-basket').attr('rel',orderID);
                 }
            }
        });
    });

    $(document).on('click', '.venue-manually-fill-go-basket', function(){
        var orderID = $(this).attr('rel');
        var venueAddress = $('.venue-address-class').val();
        var postCode = $('.post-code-class').val();
        var city = $('.city-class').val();
        $.ajax({
            url: App.base_path + 'entertainers/update-venue-manually-in-order',
            type: 'POST',
             data: {
                id: orderID,
                venue_address: venueAddress,
                post_code: postCode,
                city: city
            },
            success: function(data) {
                 if(data == '1'){
                    window.location.href = 'http://jolly-rex.front/orders/basket/';
                 }
            }
        });
        return false;
    });

    $(document).on('click', '.give-feedback-for-review', function() {
        var comment = $('.review-comment').val();
        var entertainerID = $(this).attr('rel');
        $.ajax({
            url: App.base_path + 'entertainers/give-feedback-entertainer',
            type: 'POST',
             data: { comment: comment, entertainer_id: entertainerID},
             success: function(data) {
                if(data === '1') {
                    $('#feedback-container').html('<span class="feedback-message">Thanks for feedback!</span>');
                }
             }
        });
    });

    $(document).on('change', '.theme-service-price-class', function(){
        var total = countThemeServicePriceSum();
        $('.total-price').html(total);
    });

    $(document).on('change', '.additional-services-price-class', function(){
        var total = countAdditionalServicePriceSum();
        $('.total-price').html(total);
    });

    $(document).on('change', '.package-price-class', function() {
        var $totalPrice = $('.total-price');
        if($(this).is(':checked')){
            $('.package-price-class').not($(this)).prop('checked', false);
            $totalPrice.html($(this).parent().prev().html());
        }else{
            $totalPrice.html('');
        }
    });

    function countThemeServicePriceSum(){
        var sum = 0;
        $.each($('.theme-service-price-class'), function(item){
            var price = Number($(this).parent().prev().find('.price-text').html());
            if($(this).is(':checked')){
                sum += price;
            }
        });
        return sum;
    }

    function countAdditionalServicePriceSum(){
        var sum = 0;
        $.each($('.additional-services-price-class'), function(item){
            var price = Number($(this).parent().prev().find('.price-text').html());
            if($(this).is(':checked')){
                sum += price;
            }
        });
        return sum;
    }

    $(document).on('click', '.detailed-info', function(){
        $('#modal-calendar').modal('show');
    });

    $('.make-a-booking-class').click(function(){
        var $italic = $(this).find('i');
        if($italic.hasClass('glyphicon-chevron-down')){
            $italic.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }else if($italic.hasClass('glyphicon-chevron-up')) {
            $italic.removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        }
    });

    $(document).on('change','.price-type-class', function(){
        var type = $(this).val();
        var entertainerID = $('.entertainer-id-class').val();
        $.ajax({
            url: App.base_path + 'entertainers/get-price-table-by-type',
            type: 'POST',
            data: {
                type: type,
                entertainer_id: entertainerID
            },
            dataType: "json",
            success: function(data) {
                var tableHtml = data.table_html;
                var description = data.description_html;
                $('.price-table').html(tableHtml);
                $('#priceDescriptionBlock .panel-body').html(description);
            }
        });
    });

    $(document).on('click','.venue-yes',function(){
        $('.venue-address-input').show();
    });
    $(document).on('click','.venue-no',function(){
        $('.venue-address-input').hide();
        $('#venue-search-options-modal').modal('show');
    });

    $(document).on('change','.party-theme-class', function(){
        var partyThemeID = $(this).val();
        var entertainerID = $('.entertainer-id-class').val();
        $.ajax({
            url: App.base_path + 'entertainers/get-price-table-by-theme',
            type: 'POST',
            data: {
                party_theme_id: partyThemeID,
                entertainer_id: entertainerID
            },
            dataType: "json",
            success: function(data) {
                var tableHtml = data.table_html;
                var description = data.description_html;
                $('.price-theme-table').html(tableHtml);
                $('#priceDescriptionBlock .panel-body').html(description);
            }
        });
    });

    $(document).on('change','.additional-services-class', function(){
        var partyThemeID = $(this).val();
        var entertainerID = $('.entertainer-id-class').val();
        $.ajax({
            url: App.base_path + 'entertainers/get-price-table-by-additional-service',
            type: 'POST',
            data: {
                party_theme_id: partyThemeID,
                entertainer_id: entertainerID
            },
            dataType: "json",
            success: function(data) {
                var tableHtml = data.table_html;
                $('.price-additional-services-table').html(tableHtml);
            }
        });
    });

    $(document).on('change','.additional-services-duration', function(){
        var entertainerID = $('.entertainer-id-class').val();
        var duration = $(this).val();
        var guests = $(this).parent().next().find('select').val();
        var serviceID = $(this).parent().prev().find('.service-id-class').val();
        var me = $(this);
        $.ajax({
            url: App.base_path + 'entertainers/get-additional-service-price-table-by-options',
            type: 'POST',
            data: {
                entertainer_id: entertainerID,
                duration: duration,
                guests: guests,
                service_id: serviceID
            },
            dataType: "json",
            success: function(data) {
                var priceStatement = (data.price) ? data.price : '';
                me.parent().next().next().find('span').html(priceStatement);
            }
        });
    });

    $(document).on('change','.additional-services-count-of-guests', function(){
        var entertainerID = $('.entertainer-id-class').val();
        var guests = $(this).val();
        var duration = $(this).parent().prev().find('select').val();
        var me = $(this);
        $.ajax({
            url: App.base_path + 'entertainers/get-additional-service-price-table-by-options',
            type: 'POST',
            data: {
                entertainer_id: entertainerID,
                duration: duration,
                guests: guests
            },
            dataType: "json",
            success: function(data) {
                var priceStatement = (data.price) ? data.price : '';
                me.parent().next().find('span').html(priceStatement);
            }
        });
    });

    $(document).on('blur', '.extra-guest-count',function(){
        var me = $(this);
        var price = Number(me.parent().next().find('.price-class').val());
        if(me.val() == '') {
            totalPrice = price;
        }else {
            var extraBaseCount = Number(me.val());
            var extraBasePrice =  Number(me.next('.base-extra-price-class').val());
            var totalExtra = extraBaseCount * extraBasePrice;
            console.log(totalExtra);
            console.log(price);
            var totalPrice = price + totalExtra;
        }
        me.parent().next().find('.price-text').html(totalPrice);
    });

    $(document).on('change','.already-have-venue-checkbox-classs', function(){
        if($(this).is(':checked')) {
            $('.manually-venue-container-save').show();
            $('.search-venue-container-save').hide();
        }else {
            $('.manually-venue-container-save').hide();
            $('.search-venue-container-save').show();
        }
    });

    $(document).on('click','.save-order-class',function(){
        var orderID = $('.order-id-class').val();
        var entertainerID = $(this).attr('rel');
        var partyTypeID = $('.party-type-class').val();
        var themeServiceID = $('.party-theme-class').val();
        var additionalServiceID = $('.additional-services-class').val();
        var customerID = $('.customer-id-class').attr('rel');
        var eventDate = $('.selected-date-class').val();
        var startTime = $('.start-time-class').val();
        var endTime = $('.end-time-class').val();
        var totalPrice = $('.total-price').html();
        var specialRequest = $('.special-request-class').val();
        var hostChildAge = $('.host-child-age-class').val();
        var hostChildGender = $('.host-child-gender-class input[type="radio"]:checked').val();
        var hostChildName = $('.host-child-name-class').val();
        var telephoneNumber = $('.telephone-number-class').val();
        var themeTableTrObj = $('.theme-service-price-class:checked').parent().parent();
        var additionalServicesTable = $('.additional-services-price-class').parent().parent();
        var extraGuestsCount = themeTableTrObj.find('.extra-guest-count').get().map(function(item){
            return $(item).val();
        });
        var themeServiceValues = themeTableTrObj.find('.theme-service-id-class').get().map(function(item){
            return $(item).val();
        });
        var themeServices = [];
        for(index in extraGuestsCount){
            themeServices.push({
                extra_guests_count: extraGuestsCount[index],
                price_setup_id: themeServiceValues[index],
                type: 'theme'
            });
        }

        var additionalServiceID = $('.additional-services-class').val();
        var priceServiceID = additionalServicesTable.find('.additional-service-id-class').val();
        var additionalServices = {price_setup_id: priceServiceID,type:'additional_service'};
        
        var priceType = $('.price-type-class').val();
        var entertainerPackageID = $('.package-price-class').val();
        var entertainersCount = Number($('.entertainers-count').val());
        console.log(entertainersCount);
        $.ajax({
            url: App.base_path + 'entertainers/save-order',
            type: 'POST',
             data: {
                order_id: orderID,
                entertainer_id: entertainerID,
                customer_id: customerID,
                party_type_id: partyTypeID,
                theme_service_id: themeServiceID,
                additional_service_id: additionalServiceID,
                event_date: eventDate,
                start_time: startTime,
                end_time: endTime,
                total_price: totalPrice,
                special_request: specialRequest,
                theme_services: JSON.stringify(themeServices),
                additional_services: JSON.stringify(additionalServices),
                host_child_age: hostChildAge,
                host_child_gender: hostChildGender,
                host_child_name: hostChildName,
                telephone_number: telephoneNumber,
                price_type: priceType,
                package_id : entertainerPackageID,
                entertainers_count : entertainersCount,
            },
            success: function(data) {
                console.log(data);
            }
        });
    });

    $(document).on('click','.not-ready-search-venue-class', function(){
        console.log(1);
        var entertainerID = $('.entertainer-id-class').val();
        $.ajax({
            url: App.base_path + 'entertainers/get-geo-areas',
            type: 'POST',
            data: {
                entertainer_id: entertainerID
            },
            dataType: "json",
            success: function(data) {
                if(data) {
                    //open popup
                    var postalCodeDirections = [], str, postalCodeDirectionsString;
                    for(var index in data) {
                        postalCodeDirections.push(data[index]['postal_code_direction']);
                    }

                    postalCodeDirectionsString = postalCodeDirections.join(', ');
                    str = '<div>';
                        str += '<div style="color:red;font-size:21px;">';
                            str += 'Important info!';
                        str += '</div>';
                        str += '<div>';
                            str += '<strong>Areas covered by the chosen entertainer: </strong>' + postalCodeDirectionsString;
                        str += '</div>';
                    str += '</div>';
                    $('#entertainer-geo-locations').html(str);
                }
            }
        });
    });
});