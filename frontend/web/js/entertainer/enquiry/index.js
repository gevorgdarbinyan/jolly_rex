$(document).ready(function () {
    var customerID = Number($('.customer-id-class').val());
    if(!(typeof customerID != 'undefined' && customerID > 0)){
        $('#login-signup-links-modal').modal('show');
    }
    $(document).on('click', '.panel-title', function () {
        var This = $(this);
        var expanded = This.find('a');
        if (expanded.hasClass('collapsed')) {
            This.find('a').find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            This.find('a').find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });

    $(document).on('click', '.make-entertainer-enquiry', function () {
        var entertainerID = $(this).attr('rel');
        var supportInstantBooking = $('.support-instant-booking-class').val();
        var partyTypeID = $('.party-type-class').val();
        var themeServiceID = $('.party-theme-class').val();
        var additionalServiceID = $('.additional-services-class').val();
        var customerID = $('.customer-id-class').attr('rel');

        var option1Date = $('.option1-date-class').val();
        var option1StartTime = $('.option1-start-time').val();
        var option1EndTime = $('.option1-end-time').val();

        var option2Date = $('.option2-date-class').val();
        var option2StartTime = $('.option2-start-time').val();
        var option2EndTime = $('.option2-end-time').val();

        var option3Date = $('.option3-date-class').val();
        var option3StartTime = $('.option3-start-time').val();
        var option3EndTime = $('.option3-end-time').val();
        
        var specialRequests = $('.special-requests-class').val();
        var hostChildAge = $('.host-child-age-class').val();
        var hostChildGender = $('.host-child-gender-class input[type="radio"]:checked').val();
        var hostChildName = $('.host-child-name-class').val();
        var telephoneNumber = $('.phone-number-class').val();
        var mobileNumber = $('.mobile-number-class').val();
        var themeTableTrObj = $('.theme-service-price-class:checked').parent().parent();
        var additionalServicesTable = $('.additional-services-price-class').parent().parent();
        var extraThemeTableTrObj = $('.extra-service-price-class:checked').parent().parent();
        var additionalProductsServicesTable = $('.additional-products-service-id-class').parent().parent();
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

        //extra theme services begin
        var extraOption = $('.extra-theme-class').val();
        var extraThemeExtraGuestsCount = extraThemeTableTrObj.find('.extra-theme-extra-guest-count').get().map(function(item){
            return $(item).val();
        });
        var extraThemeServiceValues = extraThemeTableTrObj.find('.extra-theme-service-id-class').get().map(function(item){
            return $(item).val();
        });
        var extraThemeServices = [];
        for(index in extraThemeExtraGuestsCount){
            extraThemeServices.push({
                extra_guests_count: extraThemeExtraGuestsCount[index],
                price_setup_id: extraThemeServiceValues[index],
                type: 'extra_theme'
            });
        }
        console.log(extraThemeServices);
        //extra theme services end

        var additionalServiceID = $('.additional-services-class').val();
        var priceServiceID = additionalServicesTable.find('.additional-service-id-class').val();
        var additionalServices = {price_setup_id: priceServiceID,type:'additional_service'};

        //additional products services begin
        var additionalProductsServiceValues = additionalProductsServicesTable.find('.additional-products-service-id-class').get().map(function(item){
            return $(item).val();
        });
        var additionalProducts = [];
        for(index in additionalProductsServiceValues){
            additionalProducts.push({
                price_setup_id: additionalProductsServiceValues[index],
                type: 'additional_product'
            });
        }
        console.log(additionalProducts);
        //additional products services end

        console.log(themeServices);
        console.log(additionalServices);
        var totalPrice = Number($('.total-price').html());
        var entertainersCount = Number($('.entertainers-count-class').val());
        var firstLineAddress = $('.first-line-address-class').val();
        var postCode = $('.post-code-class').val();
        var area = $('.area-class').val();
        var city = $('.city-class').val();
        var title = $('.title-class').val();
        var name = $('.name-class').val();
        var email = $('.email-class').val();
        var youngestAge = $('.youngest-age-class').val();
        var oldestAge = $('.oldest-age-class').val();

        var price = Number($('.total-price').html());
        $.ajax({
            url: App.base_path + 'entertainers/enquiry-process',
            type: 'POST',
             data: {
                entertainer_id: entertainerID,
                support_instant_booking: supportInstantBooking,
                customer_id: customerID,
                option1_date : option1Date,
                option1_start_time : option1StartTime,
                option1_end_time : option1EndTime,
                option2_date : option2Date,
                option2_start_time : option2StartTime,
                option2_end_time : option2EndTime,
                option3_date : option3Date,
                option3_start_time : option3StartTime,
                option3_end_time : option3EndTime,
                party_type_id: partyTypeID,
                theme_service_id: themeServiceID,
                extra_option: extraOption,
                additional_service_id: additionalServiceID,
                total_price: totalPrice,
                special_requests: specialRequests,
                theme_services: JSON.stringify(themeServices),
                extra_theme_services: JSON.stringify(extraThemeServices),
                additional_services: JSON.stringify(additionalServices),
                additional_products: JSON.stringify(additionalProducts),
                host_child_age: hostChildAge,
                host_child_gender: hostChildGender,
                host_child_name: hostChildName,
                title: title,
                name: name,
                email: email,
                telephone_number: telephoneNumber,
                mobile_number: mobileNumber,
                entertainers_count: entertainersCount,
                first_line_address: firstLineAddress,
                post_code: postCode,
                area: area,
                city: city,
                youngest_age: youngestAge,
                oldest_age: oldestAge,
                price: price
            },
            success: function(data) {
                if(data) {
                    alert('Thanks for your enquiry, we will contact you shortly');
                }
            }
        });
    });

    $(document).on('change', '.theme-service-price-class', function(){
        $('.theme-service-price-class').not($(this)).prop('checked', false);
        var total = calculateTotal();
        $('.total-price').html(total);
    });

    $(document).on('change', '.extra-service-price-class', function(){
        var extraThemeOptions = Number($('.extra-theme-class').val());
        var checkedExtras = Number($('.extra-service-price-class:checked').get().length);
        if(extraThemeOptions === 0){
            alert('Please choose how many extra?');
            return false;
        }
        if(extraThemeOptions != checkedExtras) {
            alert('Please select the number of extras equal to the number of extras chosen above');
            return false;
        }
        var total = calculateTotal();
        $('.total-price').html(total);
    });

    $(document).on('change', '.additional-services-price-class', function(){
        var total = calculateTotal();
        $('.total-price').html(total);
    });

    $(document).on('change', '.additional-products-price-class', function(){
        var total = calculateTotal();
        $('.total-price').html(total);
    });

    function calculateTotal() {
        var mileageTotal = getMileageTotal();
        console.log(mileageTotal);
        var themeServiceTotal = calculateThemeServiceTotal();
        var extraServiceTotal = calculateExtraServiceTotal();
        var additionalServiceTotal = calculateAdditionalServiceTotal();
        var additionalProductTotal = calcaulateAdditionalProductTotal();
        var total = mileageTotal + themeServiceTotal + extraServiceTotal + additionalServiceTotal + additionalProductTotal;
        return total;
    }

    function getMileageTotal(){
        return ($('.mileage-total-class').length > 0 &&  $('.mileage-total-class').val() > 0) ? Number(Number($('.mileage-total-class').val()).toFixed(2)) : 0;
    }

    function calculateThemeServiceTotal(){
        return ($('.theme-service-price-class:checked').length > 0) ? Number($('.theme-service-price-class:checked').parent().prev().find('.price-text').html()) : 0;
    }
    
    function calculateExtraServiceTotal(){
        var sum = 0;
        $.each($('.extra-service-price-class'), function(key, item){
            var checked = $(item).is(':checked');
            if(checked) {
                var price = Number($(item).parent().prev().find('.price-text').html());
                if(checked){
                    sum += price;
                }
            }
        });
        return sum;
    }

    function calculateAdditionalServiceTotal() {
        return ($('.additional-services-price-class:checked').length > 0) ? Number($('.additional-services-price-class:checked').parent().prev().find('.price-text').html()) : 0;
    }

    function calcaulateAdditionalProductTotal() {
        var sum = 0;
        $.each($('.additional-products-price-class'), function(key, item){
            var checked = $(item).is(':checked');
            if(checked) {
                var price = Number($(item).parent().prev().find('.price-text').html());
                if(checked){
                    sum += price;
                }
            }
        });
        return sum;
    }

    $(document).on('change', '.package-price-class', function() {
        var $totalPrice = $('.total-price');
        if($(this).is(':checked')){
            $('.package-price-class').not($(this)).prop('checked', false);
            $totalPrice.html($(this).parent().prev().html());
        }else{
            $totalPrice.html('');
        }
    });

    $('.make-a-booking-class').click(function(){
        var $italic = $(this).find('i');
        if($italic.hasClass('glyphicon-chevron-down')){
            $italic.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        }else if($italic.hasClass('glyphicon-chevron-up')) {
            $italic.removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        }
    });

    $(document).on('change','.party-theme-class', function(){
        var partyThemeID = Number($(this).val());
        var entertainerID = Number($('.entertainer-id-class').val());
        var entertainersCount = Number($('.entertainers-count-class').val());
        if(partyThemeID > 0 && entertainerID > 0 && entertainersCount > 0 ) {
            getPartyThemeTable(entertainerID, partyThemeID, entertainersCount);
        }
    });

    $('.entertainers-count-class').keyup(function() {
        var partyThemeID = Number($('.party-theme-class').val());
        var entertainerID = Number($('.entertainer-id-class').val());
        var entertainersCount = Number($(this).val());
        if(partyThemeID > 0 && entertainerID > 0 && entertainersCount > 0 ) {
            getPartyThemeTable(entertainerID, partyThemeID, entertainersCount);
        }
    });

    function getPartyThemeTable(entertainerID, partyThemeID, entertainersCount) {
        $('.total-price').html(0);
        $.ajax({
            url: App.base_path + 'entertainers/get-price-table-by-theme',
            type: 'POST',
            data: {
                party_theme_id: partyThemeID,
                entertainer_id: entertainerID,
                entertainers_count: entertainersCount
            },
            dataType: "json",
            success: function(data) {
                var tableHtml = data.table_html;
                var description = data.description_html;
                $('.price-theme-table').html(tableHtml);
                $('#priceDescriptionBlock .panel-body').html(description);
            }
        });
    }

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
        var value = Number(me.val());

        var extraGuestsCount = Number(me.closest('tr').find('td .theme-service-extra-guest-count-class').val());
        var entertainersCount = Number(me.closest('tr').find('td .theme-service-entertainers-count-class').val());
        var guestsCount = me.closest('tr').find('td:nth-child(3)').html();
        var splittedGuestsCount = guestsCount.split('-');
        var theRightRange = Number(splittedGuestsCount[1]);
        var totalGuests = theRightRange + extraGuestsCount;

        var flag = false;
        if(extraGuestsCount > 0 && entertainersCount > 0 && value >= extraGuestsCount) {
            var warningText = 'If the number of children is above '+totalGuests+', '+entertainersCount+' entertainers are required.Please amend the number of entertainers chosen.';
            if(value > extraGuestsCount) {
                $('#entertainer-count-via-extra-guest-count-modal-content').html(warningText);
                $('#entertainer-count-via-extra-guest-count-modal').modal('show');
                $(this).val('');
                flag = true;
            }
        }
        if(!flag) {
            var price = Number(me.parent().next().find('.price-class').val());
            if(value == '') {
                totalPrice = price;
            }else {
                var extraBaseCount = Number(me.val());
                var extraBasePrice =  Number(me.next('.base-extra-price-class').val());
                var totalExtra = extraBaseCount * extraBasePrice;
                var totalPrice = price + totalExtra;
            }
            me.parent().next().find('.price-text').html(totalPrice);
            var total = calculateTotal();
            $('.total-price').html(total);
        }
    });

    $(document).on('blur', '.extra-theme-extra-guest-count',function(){
        var me = $(this);
        var value = Number(me.val());

        var extraGuestsCount = Number(me.closest('tr').find('td .extra-theme-extra-guest-count-class').val());
        var entertainersCount = Number(me.closest('tr').find('td .extra-theme-entertainers-count-class').val());
        var guestsCount = me.closest('tr').find('td:nth-child(3)').html();
        var splittedGuestsCount = guestsCount.split('-');
        var theRightRange = Number(splittedGuestsCount[1]);
        var totalGuests = theRightRange + extraGuestsCount;

        var flag = false;
        if(extraGuestsCount > 0 && entertainersCount > 0 && value >= extraGuestsCount) {
            var warningText = 'If the number of children is above '+totalGuests+', '+entertainersCount+' entertainers are required.Please amend the number of entertainers chosen.';
            if(value > extraGuestsCount) {
                $('#entertainer-count-via-extra-guest-count-extra-theme-modal-content').html(warningText);
                $('#entertainer-count-via-extra-guest-count-extra-theme-modal').modal('show');
                $(this).val('');
                flag = true;
            }
        }
        if(!flag) {
            var price = Number(me.parent().next().find('.price-class').val());
            if(value == '') {
                totalPrice = price;
            }else {
                var extraBaseCount = Number(me.val());
                var extraBasePrice =  Number(me.next('.extra-theme-base-extra-price-class').val());
                var totalExtra = extraBaseCount * extraBasePrice;
                var totalPrice = price + totalExtra;
            }
            me.parent().next().find('.price-text').html(totalPrice);
            var total = calculateTotal();
            $('.total-price').html(total);
        }
    });

    //sidebar hide/show
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        if ($('.calendar_class').hasClass('col-lg-6')) {
            $('.calendar_class').removeClass('col-lg-6 col-md-6').addClass('col-lg-2 col-md-2');
            $('#sidebar').css({'max-width' : '250px'});
            $('.calendar_class').hide();
            $('#sidebar').hide();
        } else if ($('.calendar_class').hasClass('col-lg-2')) {
            $('.calendar_class').removeClass('col-lg-2 col-md-2').addClass('col-lg-6 col-md-6');
            $('#sidebar').show();
            $('.calendar_class').show();
            $('#sidebar').removeAttr('style');
        }
        
        if ($('.info_class').hasClass('col-lg-6')) {
            $('.info_class').removeClass('col-lg-6 col-md-6').addClass('col-lg-10 col-md-10');
            $('.info_class').removeClass('col-sm-6 col-xs-6').addClass('col-sm-12 col-xs-12');
        } else if ($('.info_class').hasClass('col-lg-10')) {
            $('.info_class').removeClass('col-lg-10 col-md-10').addClass('col-lg-6 col-md-6');
            $('.info_class').removeClass('col-sm-12 col-xs-12').addClass('col-sm-6 col-xs-6');
        }
        
    });

    $(document).on('change','.party-venue-sorted-option-class',function(){
        var value = $(this).val();
        if(value == 1){
            $('.sorted-venue-address-input').show();
            $('#warning-venue-message').hide();
        }else{
            $('.sorted-venue-address-input').hide();
            $('#warning-venue-message').show();
        }
    });

    $(document).on('click', '.calculate-distance', function(){
        var origin = $('.origin-post-code-class').val();
        var distance = $('.distance-post-code-class').val();
        console.log(origin);
        console.log(distance);
        $.ajax({
            url: App.base_path + 'entertainers/get-distance',
            type: 'POST',
            data: {
                origin: origin,
                distance: distance,
                entertainer_mileage_price: $('.entertainer-mileage-price-class').val()
            },
            //dataType: "json",
            success: function(data) {
                $('#mileage-result-container').html(data);
                var total = calculateTotal();
                $('.total-price').html(total);
            }
        });
    });

    $(document).on('click', '.calculate-distance_', function(){
        var origin = $('#origin').val();
        var distance = $('#distance').val();
        $.ajax({
            url: 'https://postcodes.io/postcodes',
            type: 'POST',
            data: {
                "postcodes": [origin, distance]
            },
            //dataType: "json",
            success: function(data) {
                console.log(data);
                var fromLat  = data.result[0].result.latitude;
                var fromLong  = data.result[0].result.longitude;

                var toLat  = data.result[1].result.latitude;
                var toLong  = data.result[1].result.longitude;
                console.log(fromLat);
                console.log(fromLong);
                console.log(toLat);
                console.log(toLong);
                var distance = computeDistance(fromLat, fromLong, toLat,  toLong,'N');

                console.log(distance);

            }
        });
    });
    
});