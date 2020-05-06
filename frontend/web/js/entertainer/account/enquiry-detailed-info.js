$(document).ready(function(){
    $(document).on('change','.option-date-radio-class', function(){
        var optionDateCheckedRadioObj = $('.option-date-radio-class:checked');
        var value = optionDateCheckedRadioObj.val();
        if(value === 'other'){
            $('.enquiry-comment-class').show();
        }else{
            $('.enquiry-comment-class').hide();
        }
    });

    $(document).on('click', '.enquiry-choose-date-time-option-btn-class', function() {
        var enquiryID = $('.entertainer-enquiry-id-class').val();
        var optionDateCheckedRadioObj = $('.option-date-radio-class:checked');
        var value = optionDateCheckedRadioObj.val();
        var flag = false;
        console.log(value);
        if(value === 'other'){
            var comment = $('.enquiry-comment-class').val();
            var data = {
                id: enquiryID,
                comment: comment
            }
        }else{
            var date = optionDateCheckedRadioObj.data('date');
            var startTime = optionDateCheckedRadioObj.data('start-time');
            var endTime = optionDateCheckedRadioObj.data('end-time');
            var data = {
                id: enquiryID,
                date: date,
                start_time: startTime,
                end_time: endTime,
                flag: 'entertainer_confirms'
            }
            flag = true;
        }
        if(flag) {
            if(confirm('Are you sure you want to confirm the enquiry? After pressing Confirm button this enquiry will turn into an order, which can be found in the Orders List.')) {
                $.ajax({
                    url: App.base_path + 'entertainers/enquiry-choose-date',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        
                    }
                });
            }
        }else{
            $.ajax({
                url: App.base_path + 'entertainers/enquiry-choose-date',
                type: 'POST',
                data: data,
                success: function(data) {
                    
                }
            });
        }
    });

    $(document).on('click','.send-notification-btn-class', function(){
        var enquiryID = $('.entertainer-enquiry-id-class').val();
        var notificationMessage = $('.notification-message-class').val();
        console.log(enquiryID);

        $.ajax({
            url: App.base_path + 'entertainers/send-message-to-customer',
            type: 'POST',
            data: {
                enquiry_id: enquiryID,
                note: notificationMessage
            },
            success: function(data) {
                $('.notification-message-class').val('');
                alert('Message has been sent');
            }
        });
    })
});