$(document).ready(function () {

//Step Movement JQuery START   --

    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');


    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled'))  {
            navListItems.removeClass('btn-success-circle').addClass('btn-default');
            $item.addClass('btn-success-circle');
            allWells.hide();
            $target.fadeIn();
            
        }

    });
    

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url'],input[type='file'],.select,.textarea"),
            prog_step = $("a.btn-default"),
            isValid = true;

        $(curInputs).removeClass("error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).addClass("error");

                
            }
        }
   
        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
    });


    $('div.setup-panel div a.btn-success-circle').trigger('click');
    //Step Movement JQuery END  --



    




    // step 1 Functions START...
    var error_title = false;
    var error_subtitle = false;
    var error_category = false;
    var error_img = false;
    var error_gig_address = false;
    var error_goal = false;
    var error_checkbox = false;
    var error_gig_date = false;
    var error_launch_date = false;

    
    $("#title").focusout(function(){
                check_title();
             });
    function check_title(){
        var pattern = /^[a-zA-Z]*$/;
        var title = $("#title").val();
        if (pattern.test(title) && title !== ""){
             $("#title").removeClass("error").addClass("good");
            } else {
            $("#title").addClass("error");
            error_title = true;
            }
        }

    $("#sub-title").focusout(function(){
                check_sub_title();
            });
    function check_sub_title(){
        var subtitle = $("#sub-title").val();
        if (subtitle == ''){
            $("#sub-title").addClass("error");
        } if (subtitle !== ''){
            $("#sub-title").removeClass("error").addClass("good");
            error_subtitle = true;
        }
    }

    $("#gig-address").focusout(function(){
                check_gig_address();
            });
    function check_gig_address(){
        var gig_address = $("#gig-address").val();
        if (gig_address == ''){
            $("#gig-address").addClass("error");
        } if (gig_address !== ''){
            $("#gig-address").removeClass("error").addClass("good");
            error_gig_address = true;
        }
    }

    $("#goal").focusout(function(){
                check_goal();
            });
    function check_goal(){
        var goal = $("#goal").val();
        if (goal == ''){
            $("#goal").addClass("error");
        } if (goal !== ''){
            $("#goal").removeClass("error").addClass("good");
            error_goal = true;
        }
    }

    $("#category").focusout(function(){
                check_category();
            });
    function check_category(){
        var category = $("#category").val();
        if (category == ''){
            $("#category").addClass("error").removeClass("good");
        } else{
            $("#category").removeClass("error").addClass("good");
            error_category = true;
        }
    }

    $("#gig_date").focusout(function(){
                check_gig_date();
            });
    function check_gig_date(){
    var gig_date = $("#gig_date").val();
    if (gig_date == '') {
        $("#gig_date").addClass("error").removeClass("good");
    } if (gig_date !== '') {
        $("#gig_date").removeClass("error").addClass("good");
        error_gig_date = true;
    }
   }
   $("#launch_date").focusout(function(){
                check_launch_date();
            });
    function check_launch_date(){
    var launch_date = $("#launch_date").val();
    if (launch_date == '') {
        $("#launch_date").addClass("error").removeClass("good");
    } if (launch_date !== '') {
        $("#launch_date").removeClass("error").addClass("good");
        error_launch_date = true;
    }
   }


    $("#img_gig").focusout(function(){
                check_img_gig();
            });
    function check_img_gig(){
        var img_gig = $("#my-file").val();
        if (img_gig == ''){
            $("#img").addClass("error");
        } else{
            $("#img").removeClass("error").addClass("good");
            error_img = true;
        }
    }
    // step 1 Functions END...

    // step 2 Functions START...
    var error_tier_price = false;
    var error_number_tickets = false;
    var error_bundling = false;

    $("#tier_price").focusout(function(){
                check_tier_price();
            });
    function check_tier_price(){
        var tier_price = $("#tier_price").val();
        if (tier_price == ''){
            $("#tier_price").addClass("error").removeClass("good");
        } if (tier_price !== ''){
            $("#tier_price").removeClass("error").addClass("good");
            error_tier_price = true;
        }
    }

    $("#number_tickets").focusout(function(){
                check_number_tickets();
            });
    function check_number_tickets(){
        var number_tickets = $("#number_tickets").val();
        if (number_tickets == ''){
            $("#number_tickets").addClass("error").removeClass("good");
        } if (number_tickets !== ''){
            $("#gig-address").removeClass("error").addClass("good");
            error_number_tickets = true;
        }
    }
    $("#bundling").focusout(function(){
                check_bundling();
            });
    function check_bundling(){
        var bundling = $("#bundling").val();
        if (bundling == ''){
            $("#bundling").addClass("error").removeClass("good");
        } if (bundling !== ''){
            $("#gig-address").removeClass("error").addClass("good");
            error_bundling = true;
        }
    }
    // step 2 Functions END...


    // step 3 Functions START...
    var error_gig_poster = false;
    var error_full_name = false;
    var error_bio = false;
    var error_website = false;
    var error_location = false;
    var error_social_url = false;
    var error_stripe_integration = false;

    $("#my-file2").focusout(function(){
                check_my_file2();
            });
    function check_my_file2(){
        var gig_poster = $("#my-file2").val();
        if (gig_poster == ''){
            $("#my-file2").addClass("error").removeClass("good");
        } if (gig_poster !== ''){
            $("#my-file2").removeClass("error").addClass("good");
            error_gig_poster = true;
        }
    }
    $("#full_name").focusout(function(){
                check_full_name();
            });
    function check_full_name(){
        var full_name = $("#full_name").val();
        if (full_name == ''){
            $("#full_name").addClass("error").removeClass("good");
        } if (full_name !== ''){
            $("#full_name").removeClass("error").addClass("good");
            error_full_name = true;
        }
    }
    $("#bio").focusout(function(){
                check_bio();
            });
    function check_bio(){
        var bio = $("#bio").val();
        if (bio == ''){
            $("#bio").addClass("error").removeClass("good");
        } if (bio !== ''){
            $("#bio").removeClass("error").addClass("good");
            error_bio = true;
        }
    }
    $("#website").focusout(function(){
                check_website();
            });
    function check_website(){
        var website = $("#website").val();
        if (website == ''){
            $("#website").addClass("error").removeClass("good");
        } if (website !== ''){
            $("#website").removeClass("error").addClass("good");
            error_website = true;
        }
    }
    $("#location").focusout(function(){
                check_location();
            });
    function check_location(){
        var location = $("#location").val();
        if (location == ''){
            $("#location").addClass("error").removeClass("good");
        } if (location !== ''){
            $("#location").removeClass("error").addClass("good");
            error_location = true;
        }
    }
    $("#social_url").focusout(function(){
                check_social_url();
            });
    function check_social_url(){
        var social_url = $("#social_url").val();
        if (social_url == ''){
            $("#social_url").addClass("error").removeClass("good");
        } if (social_url !== ''){
            $("#social_url").removeClass("error").addClass("good");
            error_social_url = true;
        }
    }
    $("#stripe_integration").focusout(function(){
                check_stripe_integration();
            });
    function check_stripe_integration(){
        var stripe_integration = $("#stripe_integration").val();
        if (stripe_integration == ''){
            $("#stripe_integration").addClass("error").removeClass("good");
        } if (stripe_integration !== ''){
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

    $("#meeting_platform").focusout(function(){
                check_meeting_platform();
            });
    function check_meeting_platform(){
        var meeting_platform = $("#meeting_platform").val();
        if (meeting_platform == ''){
            $("#meeting_platform").addClass("error").removeClass("good");
        } if (meeting_platform !== ''){
            $("#meeting_platform").removeClass("error").addClass("good");
            error_meeting_platform = true;
        }
    }
    $("#meeting_url").focusout(function(){
                check_meeting_url();
            });
    function check_meeting_url(){
        var meeting_url = $("#meeting_url").val();
        if (meeting_url == ''){
            $("#meeting_url").addClass("error").removeClass("good");
        } if (meeting_url !== ''){
            $("#meeting_url").removeClass("error").addClass("good");
            error_meeting_url = true;
        }
    }
    $("#first_name").focusout(function(){
                check_first_name();
            });
    function check_first_name(){
        var first_name = $("#first_name").val();
        if (first_name == ''){
            $("#first_name").addClass("error").removeClass("good");
        } if (first_name !== ''){
            $("#first_name").removeClass("error").addClass("good");
            error_first_name = true;
        }
    }
    $("#last_name").focusout(function(){
                check_last_name();
            });
    function check_last_name(){
        var last_name = $("#last_name").val();
        if (last_name == ''){
            $("#last_name").addClass("error").removeClass("good");
        } if (last_name !== ''){
            $("#last_name").removeClass("error").addClass("good");
            error_last_name = true;
        }
    }
    $("#ticket_tier").focusout(function(){
                check_ticket_tier();
            });
    function check_ticket_tier(){
        var ticket_tier = $("#ticket_tier").val();
        if (ticket_tier == ''){
            $("#ticket_tier").addClass("error").removeClass("good");
        } if (ticket_tier !== ''){
            $("#ticket_tier").removeClass("error").addClass("good");
            error_ticket_tier = true;
        }
    }
    $("#sold_price").focusout(function(){
                check_sold_price();
            });
    function check_sold_price(){
        var sold_price = $("#sold_price").val();
        if (sold_price == ''){
            $("#sold_price").addClass("error").removeClass("good");
        } if (sold_price !== ''){
            $("#sold_price").removeClass("error").addClass("good");
            error_sold_price = true;
        }
    }
    $("#purchase_date").focusout(function(){
                check_purchase_date();
            });
    function check_purchase_date(){
        var purchase_date = $("#purchase_date").val();
        if (purchase_date == ''){
            $("#purchase_date").addClass("error").removeClass("good");
        } if (purchase_date !== ''){
            $("#purchase_date").removeClass("error").addClass("good");
            error_purchase_date = true;
        }
    }

    
    // step 4 Functions END...

});

