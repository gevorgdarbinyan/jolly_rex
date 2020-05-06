$(document).ready(function(){
    $(document).on('click','.block-details', function(){
        var busyScheduleID = Number($(this).data('busy-schedule-id'));
        console.log(busyScheduleID);
        $.ajax({
            url: App.base_path + 'entertainers/get-busy-schedule-by-id',
            type: 'POST',
             data: {
                busy_schedule_id: busyScheduleID
            },
            success: function(data) {
                $("#block-details-modal").modal("show").find("#block-details-modal-content").html(data);
                $(".busy-date-class").datepicker();
                $(".busy-start-time-class").timepicker();
                $(".busy-end-time-class").timepicker();
            }
        });
    });

    //  busy-schedule-table

    $(document).on('change', '.all-day', function () {
        var me = $(this);
        var timeContainer = $('.time-container');
        if (me.is(':checked')) {
            timeContainer.hide();
        } else {
            timeContainer.show();
        }

    });

    $(document).on('click', '.reserve-busy-schedule', function () {
        var blockReason = $('.block-reason').val();
        var entertainerID = Number($(this).attr('rel'));
        var entertainerStaff = $('.entertainer-staff-list-class').val();
        //console.log(entertainerStaff);return false;
        var entertainerStaffStringified = JSON.stringify(entertainerStaff);
        var dataObj;
        var allDayChecked = $('.all-day').is(':checked');
        
        if (allDayChecked) {
            dataObj = {
                busy_date: $('.busy-date-class').val(),
                entertainer_id: entertainerID,
                entertainer_staff: entertainerStaffStringified
            }
        } else {
            dataObj = {
                busy_date: $('.busy-date-class').val(),
                busy_start_time: $('.busy-start-time-class').val(),
                busy_end_time: $('.busy-end-time-class').val(),
                entertainer_id: entertainerID,
                entertainer_staff: entertainerStaffStringified
            }
        }
        dataObj['block_reason'] = blockReason;
        dataObj['all_day_checked'] = (allDayChecked) ? 1 : 0;
        $.ajax({
            url: App.base_path + "entertainers/reserve-schedule",
            type: "POST",
            data: dataObj,
            success: function (data) {
                alert("Date has been blocked!");
            }
        });
    });

    $(document).on('click','.view-blocked-schedule', function(){
        var me = $(this);
        var staffID = Number(me.data('staff-id'));
        var entertainerID = $('.entertainer-id-class').val();
        $.ajax({
            url: App.base_path + "entertainers/get-blocked-schedule-table",
            type: "POST",
            data: {
                entertainer_id: entertainerID,
                staff_id: staffID
            },
            success: function (data) {
                console.log(data);
                $('#unblock-details-modal-content').html(data);
                $('#unblock-details-modal').modal('show');
            }
        });
    });

    $(document).on('click', '.unblock-schedule-class', function(){
        var busyScheduleIDList = $('.blocked-schedule-class:checked').get().map(function(item){
            return $(item).val();
        });
        $.ajax({
            url: App.base_path + "entertainers/unblock-schedule",
            type: "POST",
            data: {
                busy_schedule_ids: JSON.stringify(busyScheduleIDList)
            },
            success: function (data) {
                if(data){
                    alert('Done!');
                    $('#unblock-details-modal').modal('hide');
                }
            }
        });
    });

    $(document).on('click','.pending-orders-class', function(){
        $('#pending-orders-modal').modal('show');
    });

    $(document).on('click', '.panel-heading span.clickable', function(e){
        var $this = $(this);
        if(!$this.hasClass('panel-collapsed')) {
            $this.closest('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            
        } else {
            $this.closest('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        }
    });

    $(document).on('click', '.block-button-class', function(e){
        var $this = $(this);
        if(!$this.hasClass('block-container-collapsed')) {
            $this.addClass('block-container-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            $("#block-container").slideDown();
        } else {
            $this.removeClass('block-container-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            $("#block-container").slideUp();
        }
    });

    $(document).on('click', '.filter-options-button-class', function(e){
        var $this = $(this);
        if(!$this.hasClass('filter-options-container-collapsed')) {
            $this.addClass('filter-options-container-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            $("#filter-options-container").slideDown();
        } else {
            $this.removeClass('filter-options-container-collapsed');
            $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            $("#filter-options-container").slideUp();
        }
    });

    $(document).on('click','.schedule-save-button-class', function(){
        console.log('form is submitted');
        $('#busy-schedule-form-id').submit();
        return false;
    });

    
    $(document).on('click','.close-block-container', function(){
        $("#block-container").hide();
    });

    $(document).on('change','.schedule-month-class', function(){
        var month = $(this).val();
        $.ajax({
            url: App.base_path + "ajax/get-weeks-by-month",
            type: "POST",
            data: {
                month: month
            },
            success: function (data) {
                $('.schedule-week-class').html(data);
            }
        });
    });

    $(document).on('change','.schedule-week-class', function(){
        var month = $('.schedule-month-class').val();
        var week = $(this).val();
        $.ajax({
            url: App.base_path + "ajax/get-days-by-week",
            type: "POST",
            data: {
                month: month,
                week: week
            },
            success: function (data) {
                $('.schedule-day-class').html(data);
            }
        });
    });

    //add reason for filtering
    $(document).on('click','.schedule-search-button', function(){
        var entertainerID = $('.entertainer-id-class').val();
        var month = $('.schedule-month-class').val();
        var week = $('.schedule-week-class').val();
        var day = $('.schedule-day-class').val();
        var entertainerStaff = $('.entertainer-filter-staff-class').val();
        console.log(entertainerStaff);

        $.ajax({
            url: App.base_path + "entertainers/schedule-search",
            type: "POST",
            data: {
                entertainer_id: entertainerID,
                month: month,
                week: week,
                day: day,
                staff: JSON.stringify(entertainerStaff)
            },
            success: function (data) {
                $('#schedule-content').html(data);
            }
        });
    });

    $(document).on('click', '.save-note', function(){
        console.log("clicked");
    });
});



