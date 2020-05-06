$(document).ready(function () {
    $(document).on('click', '.panel-title', function () {
        var This = $(this);
        var expanded = This.find('a');
        if (expanded.hasClass('collapsed')) {
            This.find('a').find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            This.find('a').find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });

    $(document).on('click', '.choose-date-class', function() {
        var startTime = $('.start-time').val();
        var endTime = $('.end-time').val();
        var timeString = '<strong>'+startTime+'-'+endTime+'</strong>';
        console.log(startTime);
        console.log(endTime);
        var startTimeSplitted = startTime.split(":");
        var endTimeSplitted = endTime.split(":");
        var startHours = Number(startTimeSplitted[0]);
        var startMinutes = Number(startTimeSplitted[1]);

        var endHours = Number(endTimeSplitted[0]);
        var endMinutes = Number(endTimeSplitted[1]);

        console.log("startHour:"+startHours);
        console.log("startMinute:"+startMinutes);

        console.log("startHour:"+endHours);
        console.log("startMinute:"+endMinutes);

        var hours = endHours - startHours;
        var minutes = endMinutes - startMinutes;

        var duration  = (minutes === 0) ? hours + ' hour'  : hours + ' hour ' + minutes + ' minutes ';


        $('.start-time-class').val(startTime);
        $('.end-time-class').val(endTime);
        $('#event-time').html(timeString);

        $('#duration').html(duration);
        $('.hours-class').val(hours);
        $('.minutes-class').val(minutes);

        $("#modal-schedule-content").modal('hide');
    });

    $(document).on('change', '.venue-rooms', function(){
        var room = $(this).val();
        var venueID = $('.venue-id-class').val();
        var hour = $('.hours-class').val();
        $.ajax({
            url: App.base_path + 'venue/get-price',
            type: 'POST',
             data: {
                room: room,
                venue_id: venueID,
                hour: hour
            },
            success: function(data) {
                if(data) {
                    $('#total-price').html(data);
                    $('.total-class').val(data);
                }
            }
        });
    });

    $(document).on('click', '.reserve-venue', function(){
        var eventDate = $('.selected-date-class').val();
        var startTime = $('.start-time-class').val();
        var endTime = $('.end-time-class').val();
        var venueID = $('.venue-id-class').val();
        var orderID = $('.order-id-class').val();
        var price = $('.total-class').val();
        var supportInstantBooking = $('.support-instant-booking-class').val();
        $.ajax({
            url: App.base_path + 'venue/reserve',
            type: 'POST',
             data: {
                event_date: eventDate,
                start_time: startTime,
                end_time: endTime,
                venue_id: venueID,
                order_id: orderID,
                price: price,
                support_instant_booking: supportInstantBooking
            },
            success: function(data) {
                if(data == "enquiry"){
                    window.location.href = 'http://jolly-rex.front/venue/enquiry-confirmation/';
                }else{
                    $('#venue-block').html(data);
                }
            }
        });
    });

});