$(document).ready(function () {

//    alert('aaa');

//    $('#login-signup-links-modal').modal();

    var homepageQueryOffset = 0;

    $(document).on('click', '#sign_up', function () {
        $('#login-signup-links-modal').modal('hide');
        $('#sign-up-form-modal').modal();
    });

    $(document).on('click', '#log_in', function () {
        $('#login-signup-links-modal').modal('hide');
        $('#log-in-form-modal').modal();
    });

    $(document).on('click', '.refresh-captcha-image', function () {
        $('#loginform-verifycode-image').click();
    });

    $(document).on('submit', '#login-form', function () {

        var login = $('#loginform-email').val(),
                password = $('#loginform-password').val(),
                loginInput = $('#loginform-email'),
                loginForm = $(this);
        
        var validation = checkLoginndPassword(login, password, loginInput);
        
        if (validation === true) {
            return true;
        } else {
            return false;
        }
        

    });

    function checkLoginndPassword(login, password, loginInput) {
        var result;
        $.ajax({
            url: App.base_path + 'ajax/check-login-data',
            type: 'POST',
            async: false,
            data: {
                login: login,
                password: password
            },
            success: function (data) {
                if (data.success === true) {
                    loginInput.parent().removeClass('has-error').addClass('has-success');
                    loginInput.next().empty();
                    result = true;
                } else {
                    loginInput.parent().removeClass('has-success').addClass('has-error');
                    loginInput.next().html('Incorrect login or password');

                    result = false;
                }
                result = data.success;
            }

        });
        
        return result;
    }

    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            homepageQueryOffset += 2;
//            console.log(homepageQueryOffset);
            var lastDivClass = $('.homepage-search-list-block').last().attr('class');
            console.log(lastDivClass);
            if (!$('.search_type').hasClass('search_mode')) {
                $.ajax({
                    url: App.base_path + 'ajax/load-more-data',
                    type: 'POST',
                    data: {
                        offset: homepageQueryOffset,
                        last_div_class: lastDivClass
                    },
                    success: function (data) {
                        if (data.success === true) {
                            $('.homepage-data-container:last-child').append(data.loadedData);
                        }
                    }
                });
            }
        }
    });

    $(document).on('click', '.entertainer_accept_btn', function () {
        var order_id = $(this).attr('order_id');
        $.ajax({
            url: App.base_path + 'ajax/entertainer-order-accept',
            type: 'POST',
            data: {
                order_id: order_id
            },
            success: function (data) {
                if (data.success === true) {
                    alert('Order has been successfully approved!');
                }
            }
        });
    });

    $(document).on('click', '.entertainer_decline_btn', function () {
        var order_id = $(this).attr('order_id');
        $.ajax({
            url: App.base_path + 'ajax/entertainer-order-decline',
            type: 'POST',
            data: {
                order_id: order_id
            },
            success: function (data) {
                if (data.success === true) {
                    alert('Order has been declined!');
                }
            }
        });
    });

    if($('.ml6 .letters').length > 0){
        // Wrap every letter in a span
        $('.ml6 .letters').each(function(){
            $(this).html($(this).text().replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>"));
        });
  
        anime.timeline({loop: true})
            .add({
            targets: '.ml6 .letter',
            translateY: ["1.1em", 0],
            translateZ: 0,
            duration: 750,
            delay: function(el, i) {
                return 50 * i;
            }
            }).add({
            targets: '.ml6',
            opacity: 0,
            duration: 1000,
            easing: "easeOutExpo",
            delay: 1000
        });
    }
});