$(document).ready(function () {


    //     //Step Movement JQuery START   --

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'), isValid = false, form = document.getElementById('basic_info_form');
    allNextBtn = $('.nextBtn');
    var img = new Image();


    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success-circle').addClass('btn-default');
            $item.addClass('btn-success-circle');
            allWells.hide();
            $target.fadeIn();

        }
    });


    allNextBtn.click(function (e) {
        // e.preventDefault();
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='number'],input[type='date'],input[type='time'],input[type='url'],input[name=poster],.select,.textarea"),
            prog_step = $("a.btn-default"),
            err_input = '';
        $(curInputs).removeClass("error");

        var old_uploaded_img = 0;
        if ($('input[name="old_poster"]').length) {
            var old_poster_val = $('input[name="old_poster"]').val();
            old_uploaded_img = 1;

            if (old_poster_val == "") {
                old_uploaded_img = 0;
            }
        }

        //alert($('input[name="old_poster"]').length);
        console.log(old_uploaded_img)
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                console.log($(curInputs[i]).attr('name'))
                if (err_input == '') {
                    err_input = curInputs[i];
                }
                isValid = false;
                $(curInputs[i]).addClass("error");
            }

            if ($(curInputs[i]).attr('name') == 'poster' && old_uploaded_img == 0) {
                var tag = curInputs[i];
                var fileName = '';
                if (tag.files[0]) {
                    fileName += tag.files[0].name;
                }
                console.log(fileName)
                var div_image = $(curInputs[i]).parents('#div_image')
                if (fileName == '') {
                    console.log('if');
                    isValid = false;
                    $('.error_poster').empty();
                    $('.error_poster').html('Gig Poster is required field');
                    div_image.find('.file-preview-thumbnails').addClass('error').removeClass('good');
                    var scrollPos = div_image.find('.file-preview-thumbnails').offset().top - $('.header-section').outerHeight(true) - $('#div_image p').outerHeight(true);
                    $(window).scrollTop(scrollPos);
                } else {
                    console.log('else');
                    var imgHeight = 0;
                    var imgWidth = 0;
                    img.onload = function () {
                        imgHeight = document.getElementById('file-input').height;
                        imgWidth = document.getElementById('file-input').width;
                        console.log($(curInputs[i]));
                        console.log(imgHeight);
                        console.log(imgWidth);
                        if (imgHeight < 354 || imgWidth < 360) {
                            isValid = false;
                            $('.error_poster').empty();
                            $('.error_poster').html('Gig Poster is required field');
                            div_image.find('.file-preview-thumbnails').addClass('error').removeClass('good');
                            var scrollPos = div_image.find('.file-preview-thumbnails').offset().top - $('.header-section').outerHeight(true) - $('#div_image p').outerHeight(true);
                            $(window).scrollTop(scrollPos);
                        }
                    }
                    isValid = true;
                    $('.error_poster').empty();
                    div_image.find('.file-preview-thumbnails').removeClass('error').addClass('good');
                }
            }


            // console.log($(curInputs[i]).attr('name'));
            if ($(curInputs[i]).attr('name') == 'email') {
                check_email();
                err_input = curInputs[i];
            }
        }
        if (err_input !== '') {
            err_input.focus();
        }
        console.log(isValid);
        console.log(err_input);
        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });


    $('div.setup-panel div a.btn-success-circle').trigger('click');
    //Step Movement JQuery END  --

    form.addEventListener('submit', function () {
        console.log(isValid);
        if (!isValid) {
            alert('Some fields values are incorrect!')
            event.preventDefault();
        }
    })








    // step 1 Functions START...
    var error_title = false;
    var error_subtitle = false;
    var error_category = false;
    var error_genre = false;
    // var error_poster = false;
    var error_gig_address = false;
    var error_goal = false;
    var error_threshold = false;
    var error_goal_amount = false;
    var error_gig_date = false;
    var error_campaign_date = false;
    var error_start_time = false;
    var error_end_time = false;


    $("#title").focusout(function () {
        check_title();
    });
    function check_title() {
        // var pattern = /^[a-zA-Z]*$/;
        var title = $("#title").val();
        if (/* pattern.test(title) && */ title !== '') {
            $("#title").removeClass("error").addClass("good");
        } else {
            $("#title").removeClass("good").addClass("error");
            error_title = true;
        }
    }

    $("#subtitle").focusout(function () {
        check_sub_title();
        $('#gig_subtitle').html($(this).val());
    });
    function check_sub_title() {
        var subtitle = $("#subtitle").val();
        if (subtitle == '') {
            $("#subtitle").removeClass("good").addClass("error");
        } if (subtitle !== '') {
            $("#subtitle").removeClass("error").addClass("good");
            error_subtitle = true;
        }
    }

    $('#myCheckbox-physical').change(function () {
        var is_checked = $(this).is(':checked');
        if (is_checked) {
            $('#gig_address').fadeIn();
            $('#address').attr('required', 'true')
        } else {
            $('#gig_address').hide();
            $('#address').val('');
            $('#address').removeAttr('required')
            $("#address").removeClass("error").removeClass("good");
            error_gig_address = true;
        }
    })

    $("#address").focusout(function () {
        if ($('#gig_address').css('display') != 'none') {
            check_gig_address();
        }
        // $('#gig_address').html($(this).val());
    });
    function check_gig_address() {
        var gig_address = $("#address").val();
        if (gig_address == '') {
            $("#address").removeClass("good").addClass("error");
        } if (gig_address !== '') {
            $("#address").removeClass("error").addClass("good");
            error_gig_address = true;
        }
    }

    $("#goal").focusout(function () {
        check_goal();
        $('#gig_goal').html($(this).val());
    });
    function check_goal() {
        // var pattern = /^[0-9]*$/;
        var goal = $("#goal").val();
        if (goal !== '') {
            $("#goal").removeClass("error").addClass("good");
        } else {
            $("#goal").removeClass("good").addClass("error");
            error_goal = true;
        }
    }
    $("#goal_amount").focusout(function () {
        check_goal_amount();
        $('#gig_goal_amount').html($(this).val());
    });
    function check_goal_amount() {
        // var pattern = /^[0-9]*$/;
        var goal_amount = $("#goal_amount").val();
        if (/* pattern.test(goal_amount) &&  */goal_amount !== '') {
            $("#goal_amount").removeClass("error").addClass("good");
        } else {
            $("#goal_amount").removeClass("good").addClass("error");
            error_goal_amount = true;
        }
    }
    $("#threshold").focusout(function () {
        check_threshold();
        $('#gig_threshold').html($(this).val());
    });
    function check_threshold() {
        // var pattern = /^[0-9]*$/;
        var threshold = $("#threshold").val();
        var goal = $("#goal").val();
        if (/* pattern.test(threshold) &&  */threshold !== '' && parseInt(threshold) <= parseInt(goal)) {
            $("#threshold").removeClass("error").addClass("good");
        } else {
            $("#threshold").removeClass("good").addClass("error");
            error_threshold = true;
        }
    }

    $("#category").change(function () {
        check_category();
        $('#gig_category').html($(this).val());
    });
    function check_category() {
        var category = $("#category").val();
        if (category == '') {
            $("#category").addClass("error").removeClass("good");
        } else {
            $("#category").removeClass("error").addClass("good");
            error_category = true;
        }
    }

    $("#genre").change(function () {
        check_genre();
        $('#gig_genre').html($(this).val());
    });
    function check_genre() {
        var genre = $("#genre").val();
        if (genre == '') {
            $("#genre").addClass("error").removeClass("good");
        } else {
            $("#genre").removeClass("error").addClass("good");
            error_genre = true;
        }
    }

    $("#gig_date").focusout(function () {
        check_gig_date();
        $('#gig_gig_date').html($(this).val());
    });
    function check_gig_date() {
        var gig_date = $("#gig_date").val();
        if (gig_date == '') {
            $("#gig_date").addClass("error").removeClass("good");
        } if (gig_date !== '') {
            $("#gig_date").removeClass("error").addClass("good");
            error_gig_date = true;
        }
    }

    $("#campaign_date").focusout(function () {
        check_campaign_date();
        $('#gig_campaign_date').html($(this).val());
    });
    function check_campaign_date() {
        var campaign_date = $("#campaign_date").val();
        if (campaign_date == '') {
            $("#campaign_date").addClass("error").removeClass("good");
        } if (campaign_date !== '') {
            $("#campaign_date").removeClass("error").addClass("good");
            error_campaign_date = true;
        }
    }

    $("#start_time").focusout(function () {
        check_start_time();
        $('#gig_start_time').html($(this).val());
    });
    function check_start_time() {
        var start_time = $("#start_time").val();
        if (start_time == '') {
            $("#start_time").addClass("error").removeClass("good");
        } if (start_time !== '') {
            $("#start_time").removeClass("error").addClass("good");
            error_start_time = true;
        }
    }
    $("#end_time").focusout(function () {
        check_end_time();
        $('#gig_end_time').html($(this).val());
    });
    function check_end_time() {
        var end_time = $("#end_time").val();
        var input = document.getElementById('end_time');
        if (end_time == '') {
            $("#end_time").addClass("error").removeClass("good");
        } if (end_time !== '') {
            // if (/* input.validity.valid && */ input.type === 'time') {
            $("#end_time").removeClass("error").addClass("good");
            error_end_time = true;
            // } else {
            //     $("#end_time").addClass("error").removeClass("good");
            // }
        }
    }


    // $("input[name=poster]").change(function () {
    //     check_poster();
    // });
    // function check_poster() {
    //     var poster = $("input[name=poster]").val();
    //     // console.log(poster)
    //     if (poster == '') {
    //         $("input[name=poster]").removeClass("good").addClass("error");
    //     } else {
    //         $("input[name=poster]").removeClass("error").addClass("good");
    //         error_poster = true;
    //     }
    // }
    // step 1 Functions END...

    // step 2 Functions START...
    // var error_tier_price = false;
    // var error_number_tickets = false;
    // var error_bundling = false;

    // $("#tier_price").focusout(function () {
    //     check_tier_price();
    // });
    // function check_tier_price() {
    //     var tier_price = $("#tier_price").val();
    //     if (tier_price == '') {
    //         $("#tier_price").addClass("error").removeClass("good");
    //     } if (tier_price !== '') {
    //         $("#tier_price").removeClass("error").addClass("good");
    //         error_tier_price = true;
    //     }
    // }

    // $("#number_tickets").focusout(function () {
    //     check_number_tickets();
    // });
    // function check_number_tickets() {
    //     var number_tickets = $("#number_tickets").val();
    //     if (number_tickets == '') {
    //         $("#number_tickets").addClass("error").removeClass("good");
    //     } if (number_tickets !== '') {
    //         $("#gig-address").removeClass("error").addClass("good");
    //         error_number_tickets = true;
    //     }
    // }
    // $("#bundling").focusout(function () {
    //     check_bundling();
    // });
    // function check_bundling() {
    //     var bundling = $("#bundling").val();
    //     if (bundling == '') {
    //         $("#bundling").addClass("error").removeClass("good");
    //     } if (bundling !== '') {
    //         $("#gig-address").removeClass("error").addClass("good");
    //         error_bundling = true;
    //     }
    // }
    // step 2 Functions END...


    // step 3 Functions START...
    // var error_gig_poster = false;
    var error_fname = false;
    var error_lname = false;
    var error_email = false;
    var error_user_address = false;
    var error_description = false;
    var error_country_id = false;
    var error_mail = false;
    var error_facebook = false;
    var error_instagram = false;
    var error_twitter = false;
    var error_stripe_integration = false;

    // $("#my-file2").focusout(function () {
    //     check_my_file2();
    // });
    // function check_my_file2() {
    //     var gig_poster = $("#my-file2").val();
    //     if (gig_poster == '') {
    //         $("#my-file2").addClass("error").removeClass("good");
    //     } if (gig_poster !== '') {
    //         $("#my-file2").removeClass("error").addClass("good");
    //         error_gig_poster = true;
    //     }
    // }
    $("#fname").focusout(function () {
        check_fname();
    });
    function check_fname() {
        var fname = $("#fname").val();
        if (fname == '') {
            $("#fname").addClass("error").removeClass("good");
        } if (fname !== '') {
            $("#fname").removeClass("error").addClass("good");
            error_fname = true;
        }
    }
    $("#lname").focusout(function () {
        check_lname();
    });
    function check_lname() {
        var lname = $("#lname").val();
        if (lname == '') {
            $("#lname").addClass("error").removeClass("good");
        } if (lname !== '') {
            $("#lname").removeClass("error").addClass("good");
            error_lname = true;
        }
    }
    $("#email").focusout(function () {
        check_email();
    });
    function check_email() {
        var email = $("#email").val();
        if (email == '') {
            $("#email").addClass("error").removeClass("good");
            error_email = false;
            isValid = false;
            return 0;
        } if (email !== '') {
            $.ajax({
                url: base_url + 'account/check_email',
                data: {
                    email: email
                },
                method: 'POST',
                success: function (resp) {
                    if (resp == '1') {
                        $("#email").addClass("error").removeClass("good");
                        $("#email").parent().find('.email_error').empty();
                        $("#email").parent().find('.email_error').html('Email already registered!')
                        error_email = false;
                        isValid = false;
                        return 0;
                    } else {
                        $("#email").removeClass("error").addClass("good");
                        $("#email").parent().find('.email_error').empty();
                        error_email = true;
                        isValid = true;
                        return 1;
                    }
                }
            })
        }

    }
    $("#error_user_address").focusout(function () {
        check_user_address();
    });
    function check_user_address() {
        var user_address = $("#user_address").val();
        if (user_address == '') {
            $("#user_address").addClass("error").removeClass("good");
        } if (user_address !== '') {
            $("#user_address").removeClass("error").addClass("good");
            error_user_address = true;
        }
    }
    $("#description").focusout(function () {
        check_description();
    });
    function check_description() {
        var description = $("#description").val();
        if (description == '') {
            $("#description").addClass("error").removeClass("good");
        } if (description !== '') {
            $("#description").removeClass("error").addClass("good");
            error_description = true;
        }
    }
    $("#mail").focusout(function () {
        check_mail();
    });
    function check_mail() {
        var mail = $("#mail").val();
        if (mail == '') {
            $("#mail").addClass("error").removeClass("good");
        } if (mail !== '') {
            $("#mail").removeClass("error").addClass("good");
            error_mail = true;
        }
    }
    $("#facebook").focusout(function () {
        check_facebook();
    });
    function check_facebook() {
        var facebook = $("#facebook").val();
        if (facebook == '') {
            $("#facebook").addClass("error").removeClass("good");
        } if (facebook !== '') {
            $("#facebook").removeClass("error").addClass("good");
            error_facebook = true;
        }
    }
    $("#instagram").focusout(function () {
        check_instagram();
    });
    function check_instagram() {
        var instagram = $("#instagram").val();
        if (instagram == '') {
            $("#instagram").addClass("error").removeClass("good");
        } if (instagram !== '') {
            $("#instagram").removeClass("error").addClass("good");
            error_instagram = true;
        }
    }
    $("#twitter").focusout(function () {
        check_twitter();
    });
    function check_twitter() {
        var twitter = $("#twitter").val();
        if (twitter == '') {
            $("#twitter").addClass("error").removeClass("good");
        } if (twitter !== '') {
            $("#twitter").removeClass("error").addClass("good");
            error_twitter = true;
        }
    }
    $("#country_id").focusout(function () {
        check_country_id();
    });
    function check_country_id() {
        var country_id = $("#country_id").val();
        if (country_id == '') {
            $("#country_id").addClass("error").removeClass("good");
        } if (country_id !== '') {
            $("#country_id").removeClass("error").addClass("good");
            error_country_id = true;
        }
    }
    $("#stripe_integration").focusout(function () {
        check_stripe_integration();
    });
    function check_stripe_integration() {
        var stripe_integration = $("#stripe_integration").val();
        if (stripe_integration == '') {
            $("#stripe_integration").addClass("error").removeClass("good");
        } if (stripe_integration !== '') {
            $("#stripe_integration").removeClass("error").addClass("good");
            error_stripe_integration = true;
        }
    }


    // step 3 Functions END...

    // step 4 Functions START...
    var error_meeting_platform = false;
    var error_meeting_url = false;
    var error_first_name = false;
    var error_last_name = false;
    var error_ticket_tier = false;
    var error_sold_price = false;
    var error_purchase_date = false;

    $("#meeting_platform").focusout(function () {
        check_meeting_platform();
    });
    function check_meeting_platform() {
        var meeting_platform = $("#meeting_platform").val();
        if (meeting_platform == '') {
            $("#meeting_platform").addClass("error").removeClass("good");
        } if (meeting_platform !== '') {
            $("#meeting_platform").removeClass("error").addClass("good");
            error_meeting_platform = true;
        }
    }
    $("#meeting_url").focusout(function () {
        check_meeting_url();
    });
    function check_meeting_url() {
        var meeting_url = $("#meeting_url").val();
        if (meeting_url == '') {
            $("#meeting_url").addClass("error").removeClass("good");
        } if (meeting_url !== '') {
            $("#meeting_url").removeClass("error").addClass("good");
            error_meeting_url = true;
        }
    }
    $("#first_name").focusout(function () {
        check_first_name();
    });
    function check_first_name() {
        var first_name = $("#first_name").val();
        if (first_name == '') {
            $("#first_name").addClass("error").removeClass("good");
        } if (first_name !== '') {
            $("#first_name").removeClass("error").addClass("good");
            error_first_name = true;
        }
    }
    $("#last_name").focusout(function () {
        check_last_name();
    });
    function check_last_name() {
        var last_name = $("#last_name").val();
        if (last_name == '') {
            $("#last_name").addClass("error").removeClass("good");
        } if (last_name !== '') {
            $("#last_name").removeClass("error").addClass("good");
            error_last_name = true;
        }
    }
    $("#ticket_tier").focusout(function () {
        check_ticket_tier();
    });
    function check_ticket_tier() {
        var ticket_tier = $("#ticket_tier").val();
        if (ticket_tier == '') {
            $("#ticket_tier").addClass("error").removeClass("good");
        } if (ticket_tier !== '') {
            $("#ticket_tier").removeClass("error").addClass("good");
            error_ticket_tier = true;
        }
    }
    $("#sold_price").focusout(function () {
        check_sold_price();
    });
    function check_sold_price() {
        var sold_price = $("#sold_price").val();
        if (sold_price == '') {
            $("#sold_price").addClass("error").removeClass("good");
        } if (sold_price !== '') {
            $("#sold_price").removeClass("error").addClass("good");
            error_sold_price = true;
        }
    }
    $("#purchase_date").focusout(function () {
        check_purchase_date();
    });
    function check_purchase_date() {
        var purchase_date = $("#purchase_date").val();
        if (purchase_date == '') {
            $("#purchase_date").addClass("error").removeClass("good");
        } if (purchase_date !== '') {
            $("#purchase_date").removeClass("error").addClass("good");
            error_purchase_date = true;
        }
    }


    //     // step 4 Functions END...

});

