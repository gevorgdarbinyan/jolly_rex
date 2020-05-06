$(document).ready(function () {

    $(document).on('click', '.change-password-btn', function () {
        $('#change-password-modal').modal('show');
    });
    
    $(document).on('click', '.change_password_request', function () {
        var existingPassword = $('.existing_password').val(),
        newPassword = $('.new_password').val(),
        repeatedNewPassword = $('.repeat_new_password').val();

        removeErrors(existingPassword, newPassword, repeatedNewPassword);

        if (existingPassword && newPassword && repeatedNewPassword) {
            
            $.ajax({
                url: App.base_path + 'ajax/change-user-password',
                type: 'POST',
                data: {
                    existing_password: existingPassword,
                    new_password: newPassword,
                    repeat_new_password: repeatedNewPassword
                },
                success: function (data) {
                    if (data.success === true) {
                        $('#changePasswordContent').html('');
                        $('#changePasswordContent').html('<h1>Password has been successfully changed!</h1>');
                        $('#change-password-modal').modal('hide');
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
        $('#change-email-dialog').modal('show');
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
                url: App.base_path + 'ajax/change-user-email',
                type: 'POST',
                data: {
                    new_email: newEmail,
                    repeat_new_email: repeatNewEmail
                },
                success: function (data) {
                    if (data.success === true) {
                        $('.logged-in-user-email').html(newEmail + ' <span class="caret"></span>');
                        $('#changeEmailContent').html('');
                        $('#changeEmailContent').html('<h1>Email has been successfully changed!</h1>');
                        $('#change-email-dialog').modal('hide');
                    }
                }
            });
        }
        
        
    });
    
    $(document).on('click', '.change-personal-info-btn', function () {
        $('#change-personal-info-dialog').modal('show');
    });
    
    $(document).on('click', '.change_personal_info_request', function () {
        var postalCode = $('.new_postal_code').val(),
            address = $('.new_address').val(),
            phoneNumber = $('.new_phone_number').val();
            
        $.ajax({
            url: App.base_path + 'ajax/update-personal-info',
            type: 'POST',
            data: {
                postal_code: postalCode,
                address: address,
                phone_number: phoneNumber
            },
            success: function (data) {
                if (data.success === true) {
                    $('#changePersonalInfoContent').html('');
                    $('#changePersonalInfoContent').html('<h1>Personal Data has been successfully updated!</h1>');
                    $('#change-personal-info-dialog').modal('hide');
                }
            }
        });
            
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