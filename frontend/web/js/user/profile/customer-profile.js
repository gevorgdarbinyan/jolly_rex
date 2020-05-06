$(document).ready(function () {

    $(document).on('click', '.change-password-btn', function () {
        $.ajax({
            url: App.base_path + 'profile/customer-ajax/load-change-password-template',
            type: 'POST',
            data: {
            },
            success: function (data) {
                $('.user-profile-page-content').html(data.html);
            }
        });
    });

    $(document).on('click', '.change_password_request', function () {
        var existingPassword = $('.existing_password').val(),
                newPassword = $('.new_password').val(),
                repeatedNewPassword = $('.repeat_new_password').val();

        removeErrors(existingPassword, newPassword, repeatedNewPassword);

        if (existingPassword && newPassword && repeatedNewPassword) {

            $.ajax({
                url: App.base_path + 'profile/customer-ajax/change-user-password',
                type: 'POST',
                data: {
                    existing_password: existingPassword,
                    new_password: newPassword,
                    repeat_new_password: repeatedNewPassword
                },
                success: function (data) {
                    if (data.success === true) {
                        $('#statusModalContent').html('');
                        $('#statusModalContent').html('<h1>Password has been successfully changed!</h1>');
                        $('#status-info-dialog').modal('show');
                    } else if (data.success === false) {
                        if (data.reason === 'same_password') {
                            $('.new_password').parent().addClass('has-error');
                            $('.new_password').next().html('Password matches with existing password');
                        }
                        if (data.reason === 'incorrect_existing_password') {
                            $('.existing_password').parent().addClass('has-error');
                            $('.existing_password').next().html('Existing password is incorrect');
                        }
                        if (data.reason === 'repeat_password_missmatch') {
                            $('.new_password').parent().addClass('has-error');
                            $('.new_password').next().html('Password must match together');

                            $('.repeat_new_password').parent().addClass('has-error');
                            $('.repeat_new_password').next().html('Password must match together');
                        }
                    }
                }
            });

        } else {
            if (!existingPassword) {
                $('.existing_password').parent().addClass('has-error');
                $('.existing_password').next().html('Existing password is required');
            } else if (!newPassword) {
                $('.new_password').parent().addClass('has-error');
                $('.new_password').next().html('New password is required');
            } else if (!repeatedNewPassword) {
                $('.repeat_new_password').parent().addClass('has-error');
                $('.repeat_new_password').next().html('Please repeat new password is required');
            }
        }

    });

    $(document).on('click', '.change-email-btn', function () {
        $.ajax({
            url: App.base_path + 'profile/customer-ajax/load-email-template',
            type: 'POST',
            data: {
            },
            success: function (data) {
                $('.user-profile-page-content').html(data.html);
            }
        });
    });

    $(document).on('click', '.change_email_request', function () {

        var newEmail = $('.new_email').val(),
                repeatNewEmail = $('.repeat_new_email').val();

        if (newEmail != repeatNewEmail) {
            $('.repeat_new_email').parent().addClass('has-error');
            $('.repeat_new_email').next().html('Email don\'t match!');
        } else if (newEmail == repeatNewEmail) {
            $('.repeat_new_email').parent().removeClass('has-error');
            $('.repeat_new_email').next().html('');

            $.ajax({
                url: App.base_path + 'profile/customer-ajax/change-user-email',
                type: 'POST',
                data: {
                    new_email: newEmail,
                    repeat_new_email: repeatNewEmail
                },
                success: function (data) {
                    if (data.success === true) {
                        $('.logged-in-user-email').html(newEmail + ' <span class="caret"></span>');
                        $('#statusModalContent').html('');
                        $('#statusModalContent').html('<h1>Email has been successfully changed!</h1>');
                        $('#status-info-dialog').modal('show');
                    }
                }
            });
        }


    });

    $(document).on('click', '.change-personal-info-btn', function () {
        $.ajax({
            url: App.base_path + 'profile/customer-ajax/load-personal-info-template',
            type: 'POST',
            data: {
            },
            success: function (data) {
                $('.user-profile-page-content').html(data.html);
            }
        });
    });

    $(document).on('submit', '#personal-data-update', (function (e) {
        e.preventDefault();

        updatePersonalInfo();
        $.ajax({
            url: App.base_path + 'profile/customer-ajax/update-user-photo',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                if (data.success === true) {
                    alert('ok');
                } else {
                    alert('not ok');
                }
            }
        });

    }));

    $(document).on('click', '#personal-details-link', function () {
        $('#user-personal-details-modal').modal('show');
    });

    $(document).on('click', '#my-orders-link', function () {
        $('#user-my-orders-modal').modal('show');
    });
    $(document).on('click', '#my-enquiries-link', function () {
        $('#user-my-enquiries-modal').modal('show');
    });

});

function removeErrors(existingPassword, newPassword, repeatedNewPassword) {
    if (existingPassword) {
        $('.existing_password').parent().removeClass('has-error');
        $('.existing_password').next().html('');
    }

    if (newPassword) {
        $('.new_password').parent().removeClass('has-error');
        $('.new_password').next().html('');
    }

    if (repeatedNewPassword) {
        $('.repeat_new_password').parent().removeClass('has-error');
        $('.repeat_new_password').next().html('');
    }
}

function updatePersonalInfo() {
    var postalCode = $('.new_postal_code').val(),
        address = $('.new_address').val(),
        phoneNumber = $('.new_phone_number').val();

    $.ajax({
        url: App.base_path + 'profile/customer-ajax/update-personal-info',
        type: 'POST',
        data: {
            postal_code: postalCode,
            address: address,
            phone_number: phoneNumber
        },
        success: function (data) {
            if (data.success === true) {
//                $('#statusModalContent').html('');
//                $('#statusModalContent').html('<h1>Personal Data has been successfully updated!</h1>');
//                $('#status-info-dialog').modal('show');
            }
        }
    });
}

$(document).on('click','.active-order-btn', function(){
    $.ajax({
        url: App.base_path + 'orders/get-pending-orders',
        type: 'POST',
        data: {
        },
        success: function (data) {
            $('.user-profile-page-content').html(data);
        }
    });
});


$(document).on('click','.historical-orders-btn', function(){
    $.ajax({
        url: App.base_path + 'orders/get-historical-orders',
        type: 'POST',
        data: {
        },
        success: function (data) {
            $('.user-profile-page-content').html(data);
        }
    });
});
