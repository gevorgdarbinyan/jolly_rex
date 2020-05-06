$(document).ready(function(){
    $(document).on('click','.schedule-calendar-class', function(){
        $('#entertainer-staff-block-modal').modal('show');
    });
    
    $(document).on('click','.acknowledge-order', function(){
        var orderID = Number($('.order-id-class').val());
        var message = $('.message-class').val();
        var staff = [];
        $('.entertainer-staff-member-class').each(function() {
            staff.push($(this).val());
        });
    
        $.ajax({
            url: App.base_path + "entertainers/acknowledge-order",
            type: "POST",
            data: {
                order_id: orderID,
                staff: JSON.stringify(staff),
                message: message
            },
            success: function (data) {
                if(data == '1') {
                    alert('Acknowledged!');
                }
            }
        });
    });

    $(document).on('click','.cancel-order', function(){
        var orderID = Number($('.order-id-class').val());
        var message = $('.message-class').val();
        var staff = [];
        $('.entertainer-staff-member-class').each(function() {
            staff.push($(this).val());
        });
    
        $.ajax({
            url: App.base_path + "entertainers/cancel-order",
            type: "POST",
            data: {
                order_id: orderID,
                staff: JSON.stringify(staff),
                message: message
            },
            success: function (data) {
                if(data == '1') {
                    alert('Cancelled!');
                }
            }
        });
    });

    $(document).on('click', '.save-note', function(){
        var orderID = Number($('.order-id-class').val());
        var note = $('.entertainer-note-class').val();
        console.log(orderID);
        console.log(note);
        $.ajax({
            url: App.base_path + "entertainers/save-order-note",
            type: "POST",
            data: {
                order_id: orderID,
                note: note
            },
            success: function (data) {
                console.log(data);
                if(data == 1){
                    alert('Note has been saved!');
                    window.location.reload();
                }
            }
        });
    });

    $(document).on('click','.print-button', function(){
        printDiv();
    });

    $(document).on('click', '.update-entertainers', function() {
        console.log("update entertainers");
        var orderID = Number($(this).data('order-id'));
        var staff = [];
        $('.entertainer-staff:checked').each(function() {
            staff.push($(this).val());
        });
        console.log(orderID);
        console.log(staff);
    
        $.ajax({
            url: App.base_path + "entertainers/update-entertainer-order-staff-list",
            type: "POST",
            data: {
                order_id: orderID,
                staff: JSON.stringify(staff),
            },
            success: function (data) {
                console.log(data);
                if(data == 1){
                    alert("Updated!");
                    window.location.reload();
                }
            }
        });
    });

    $(document).on('click','.send-notification-class', function(){
        console.log("send notification");
        var message = $('.message-class').val();
        var entertainerOrderID = $('.entertainer-order-id-class').val();
        var entertainerID = $('.entertainer-id-class').val();
        var customerID = $('.customer-id-class').val();
        $.ajax({
            url: App.base_path + "entertainers/send-notification-to-customer",
            type: "POST",
            data: {
                entertainer_id: entertainerID,
                customer_id: customerID,
                entertainer_order_id: entertainerOrderID,
                message: message,
            },
            success: function (data) {
                console.log(data);
                if(data == 1){
                    alert("Notification Sent!");
                    window.location.reload();
                }
            }
        });
    });
});



function printDiv() {
    var divToPrint=document.getElementById('order-details-modal-content');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},10);
  }
  
  function nl2br (str, is_xhtml) {
      if (typeof str === 'undefined' || str === null) {
          return '';
      }
      var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
      return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
  }
  
  function getReason(reason) {
      switch(reason){
          case 2:
              return 'Unavailable time';
          case 3:
              return 'Blocked for Jolly Rex client';
          case 4:
              return 'Blocked for extrenal client' 
      }
  }