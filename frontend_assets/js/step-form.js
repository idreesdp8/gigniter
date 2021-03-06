var validForm = false;
var errorElems = [];
var indexError = -1;
var steps = $('.setup-content');
var nextButton = $('.nextBtn');
var navListItems = $('div.setup-panel div a')
var _URL = window.URL || window.webkitURL;
var img = new Image();
const minImgHeight = 354; //minimum poster height accepted 
const minImgWidth = 360; //minimum poster width accepted
var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/; //Regex for email


navListItems.click(function (e) {
    e.preventDefault();
    var $target = $($(this).attr('href')),
        $item = $(this);

    if (!$item.hasClass('disabled')) {
        navListItems.removeClass('btn-success-circle').addClass('btn-default');
        $item.addClass('btn-success-circle');
        steps.hide();
        $target.fadeIn();
    }
});

function runValidationOn(formStep) {
    console.log($('#' + formStep).find('input,select'));
    if (formStep == 'step-1') {
        //check field for the first tab
        if (!checkTitle()) {
            if (!errorElems.includes('#title')) {
                errorElems.push('#title');
            }
        } else {
            indexError = errorElems.indexOf('#title');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkSubTitle()) {
            if (!errorElems.includes('#subtitle')) {
                errorElems.push('#subtitle');
            }
        } else {
            indexError = errorElems.indexOf('#subtitle');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkCategory()) {
            if (!errorElems.includes('#category')) {
                errorElems.push('#category');
            }
        } else {
            indexError = errorElems.indexOf('#category');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkGenre()) {
            if (!errorElems.includes('#genre')) {
                errorElems.push('#genre');
            }
        } else {
            indexError = errorElems.indexOf('#genre');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        checkPoster()
        if (!checkGoal()) {
            if (!errorElems.includes('#goal')) {
                errorElems.push('#goal');
            }
        } else {
            indexError = errorElems.indexOf('#goal');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkThreshold()) {
            if (!errorElems.includes('#threshold')) {
                errorElems.push('#threshold');
            }
        } else {
            indexError = errorElems.indexOf('#threshold');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkGoalAmount()) {
            if (!errorElems.includes('#goal_amount')) {
                errorElems.push('#goal_amount');
            }
        } else {
            indexError = errorElems.indexOf('#goal_amount');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkCampaignDate()) {
            if (!errorElems.includes('#campaign_date')) {
                errorElems.push('#campaign_date');
            }
        } else {
            indexError = errorElems.indexOf('#campaign_date');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkGigDate()) {
            if (!errorElems.includes('#gig_date')) {
                errorElems.push('#gig_date');
            }
        } else {
            indexError = errorElems.indexOf('#gig_date');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkStartTime()) {
            if (!errorElems.includes('#start_time')) {
                errorElems.push('#start_time');
            }
        } else {
            indexError = errorElems.indexOf('#start_time');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkEndTime()) {
            if (!errorElems.includes('#end_time')) {
                errorElems.push('#end_time');
            }
        } else {
            indexError = errorElems.indexOf('#end_time');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }

    }
    if (formStep == 'step-3') {
        //check fields for the 3rd tab
        if (!checkFirstName()) {
            if (!errorElems.includes('#fname')) {
                errorElems.push('#fname');
            }
        } else {
            indexError = errorElems.indexOf('#fname');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkLastName()) {
            if (!errorElems.includes('#lname')) {
                errorElems.push('#lname');
            }
        } else {
            indexError = errorElems.indexOf('#lname');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        //if user is not logged in then we have to create his/her account so email, password should be checked
        //else email is not editable
        if (!user_id) {
            console.log('User does not Exist')
            checkEmail()
            if (!checkPassword()) {
                if (!errorElems.includes('#password')) {
                    errorElems.push('#password');
                }
            } else {
                indexError = errorElems.indexOf('#password');
                if (indexError > -1) {
                    errorElems.splice(indexError, 1);
                }
            }
        }
        if (!checkStripeId()) {
            if (!errorElems.includes('#stripe')) {
                errorElems.push('#stripe');
            }
        } else {
            indexError = errorElems.indexOf('#stripe');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
    }
    if (formStep == 'step-4') {
        //check fields for the 3rd tab
        if (!checkMeetingPlatform()) {
            if (!errorElems.includes('#meeting_platform')) {
                errorElems.push('#meeting_platform');
            }
        } else {
            indexError = errorElems.indexOf('#meeting_platform');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
        if (!checkMeetingURL()) {
            if (!errorElems.includes('#meeting_url')) {
                errorElems.push('#meeting_url');
            }
        } else {
            indexError = errorElems.indexOf('#meeting_url');
            if (indexError > -1) {
                errorElems.splice(indexError, 1);
            }
        }
    }
    // console.log(errorElems);
    if (errorElems.length) {
        if (errorElems[0] == '#file-input') {
            var scrollPos = $('#div_image').find('.file-preview-thumbnails').offset().top - $('.header-section').outerHeight(true) - $('#div_image p').outerHeight(true);
            $(window).scrollTop(scrollPos);
        }
        $(errorElems[0]).focus();
    } else {
        var nextStepWizard = $('div.setup-panel div a[href="#' + formStep + '"]').parent().next().children("a");
        nextStepWizard.removeClass('disabled').trigger('click');
        $(window).scrollTop('0');
        validForm = true;
    }
}
$(document).ready(function () {
    steps.not('#step-1').hide(); //hide all tabs except first one

    nextButton.click(function () { //when click on the save & continue button validation will be checked for that tab
        // console.log($(this).parents('.setup-content').attr('id'));
        var formStep = $(this).parents('.setup-content').attr('id')
        runValidationOn(formStep);
    })
    $('.step-form-buttons > button').click(function(e){
        if(!validForm) {
            e.preventDefault();
            var error = '';
            $('.setup-content').each(function(){
                runValidationOn($(this).attr('id'));
            })
            console.log(errorElems)
            $.each(errorElems, function(index, value){
                // console.log(value)
                value = value.slice(1,value.length)
                error += value+', ';
            })
            alert('Complete these fields\n'+ error)
        } else {
            if($('#is_draft').val() == '2') {
                e.preventDefault();
            }
            $('#basic_info_form').submit();
        }
    })
    //When fields are changed, validation will be checked
    $("#title").focusout(function () {
        checkTitle();
    });
    $("#subtitle").focusout(function () {
        checkSubTitle();
    });
    $("#category").change(function () {
        checkCategory();
    });
    $("#genre").change(function () {
        checkGenre();
    });
    $("#file-input").change(function () {
        checkPoster();
    });
    $("#goal").change(function () {
        checkGoal();
    });
    $("#threshold").change(function () {
        checkThreshold();
    });
    $("#goal_amount").change(function () {
        checkGoalAmount();
    });
    $("#campaign_date").change(function () {
        checkCampaignDate();
    });
    $("#gig_date").change(function () {
        checkGigDate();
    });
    $("#start_time").change(function () {
        checkStartTime();
    });
    $("#end_time").change(function () {
        checkEndTime();
    });
    $("#fname").change(function () {
        checkFirstName();
    });
    $("#lname").change(function () {
        checkLastName();
    });
    $("#email").change(function () {
        checkEmail();
    });
    $("#password").change(function () {
        checkPassword();
    });
    $("#stripe").change(function () {
        checkStripeId();
    });
    $("#meeting_platform").change(function () {
        checkMeetingPlatform();
    });
    $("#meeting_url").change(function () {
        checkMeetingURL();
    });
});
function checkMeetingPlatform() {
    var val = $("#meeting_platform").val();
    if (val !== '') {
        $("#meeting_platform").removeClass("error").addClass("good");
        return true;
    } else {
        $("#meeting_platform").removeClass("good").addClass("error");
        return false;
    }
}
function checkMeetingURL() {
    var val = $("#meeting_url").val();
    if (val !== '') {
        $("#meeting_url").removeClass("error").addClass("good");
        return true;
    } else {
        $("#meeting_url").removeClass("good").addClass("error");
        return false;
    }
}
function checkFirstName() {
    var val = $("#fname").val();
    if (val !== '') {
        $("#fname").removeClass("error").addClass("good");
        return true;
    } else {
        $("#fname").removeClass("good").addClass("error");
        return false;
    }
}
function checkLastName() {
    var val = $("#lname").val();
    if (val !== '') {
        $("#lname").removeClass("error").addClass("good");
        return true;
    } else {
        $("#lname").removeClass("good").addClass("error");
        return false;
    }
}
function checkEmail() {
    var val = $("#email").val();
    if (val == '') {
        $("#email").addClass("error").removeClass("good");
        if (!errorElems.includes('#email')) {
            errorElems.push('#email');
        }
    }
    if (val !== '' && emailRegex.test(val)) {
        $.ajax({
            url: base_url + 'account/check_email',
            data: {
                email: val
            },
            method: 'POST',
            success: function (resp) {
                if (resp == '1') {
                    $("#email").addClass("error").removeClass("good");
                    $("#email").parent().find('.email_error').empty();
                    $("#email").parent().find('.email_error').html('Email already registered!')
                    if (!errorElems.includes('#email')) {
                        errorElems.push('#email');
                    }
                } else {
                    $("#email").removeClass("error").addClass("good");
                    $("#email").parent().find('.email_error').empty();
                    indexError = errorElems.indexOf('#email');
                    if (indexError > -1) {
                        errorElems.splice(indexError, 1);
                    }
                }
            }
        })
    }
}
function checkPassword() {
    var val = $("#password").val();
    if (val !== '') {
        $("#password").removeClass("error").addClass("good");
        return true;
    } else {
        $("#password").removeClass("good").addClass("error");
        return false;
    }
}
function checkStripeId() {
    var val = $("#stripe").val();
    if (val !== '' && emailRegex.test(val)) {
        $("#stripe").removeClass("error").addClass("good");
        return true;
    } else {
        $("#stripe").removeClass("good").addClass("error");
        return false;
    }
}
function checkTitle() {
    var val = $("#title").val();
    if (val !== '') {
        $("#title").removeClass("error").addClass("good");
        return true;
    } else {
        $("#title").removeClass("good").addClass("error");
        return false;
    }
}
function checkSubTitle() {
    var val = $("#subtitle").val();
    if (val !== '') {
        $("#subtitle").removeClass("error").addClass("good");
        return true;
    } else {
        $("#subtitle").removeClass("good").addClass("error");
        return false;
    }
}
function checkCategory() {
    var val = $("#category").val();
    if (val !== '') {
        $("#category").removeClass("error").addClass("good");
        return true;
    } else {
        $("#category").removeClass("good").addClass("error");
        return false;
    }
}
function checkGenre() {
    var val = $("#genre").val();
    if (val !== '') {
        $("#genre").removeClass("error").addClass("good");
        return true;
    } else {
        $("#genre").removeClass("good").addClass("error");
        return false;
    }
}
function checkGoal() {
    var val = $("#goal").val();
    if (val !== '') {
        $("#goal").removeClass("error").addClass("good");
        return true;
    } else {
        $("#goal").removeClass("good").addClass("error");
        return false;
    }
}
function checkThreshold() {
    var val = $("#threshold").val();
    var goal = $("#goal").val();
    if (val !== '' && parseInt(val) <= parseInt(goal)) {
        $("#threshold").removeClass("error").addClass("good");
        return true;
    } else {
        $("#threshold").removeClass("good").addClass("error");
        return false;
    }
}
function checkGoalAmount() {
    var val = $("#goal_amount").val();
    if (val !== '') {
        $("#goal_amount").removeClass("error").addClass("good");
        return true;
    } else {
        $("#goal_amount").removeClass("good").addClass("error");
        return false;
    }
}
function checkCampaignDate() {
    var val = $("#campaign_date").val();
    if (val !== '') {
        $("#campaign_date").removeClass("error").addClass("good");
        return true;
    } else {
        $("#campaign_date").removeClass("good").addClass("error");
        return false;
    }
}
function checkGigDate() {
    var val = $("#gig_date").val();
    var campaign_date = new Date($('#campaign_date').val());
    var gig_date = new Date($('#gig_date').val());
    if (val !== '' && campaign_date < gig_date) {
        $("#gig_date").removeClass("error").addClass("good");
        return true;
    } else {
        $("#gig_date").removeClass("good").addClass("error");
        return false;
    }
}
function checkStartTime() {
    var val = $("#start_time").val();
    if (val !== '') {
        $("#start_time").removeClass("error").addClass("good");
        return true;
    } else {
        $("#start_time").removeClass("good").addClass("error");
        return false;
    }
}
function checkEndTime() {
    var val = $("#end_time").val();
    if (val !== '') {
        $("#end_time").removeClass("error").addClass("good");
        return true;
    } else {
        $("#end_time").removeClass("good").addClass("error");
        return false;
    }
}
function checkPoster() {
    var elem = document.getElementById('file-input');
    var file = $(elem)[0].files[0];
    var imageDiv = $('#div_image')
    var imgHeight = 0;
    var imgWidth = 0;
    var fileName = '';
    if (elem.files[0]) {
        fileName += elem.files[0].name;
    }
    if (fileName == '') {
        imageDiv.find('.file-preview-thumbnails').addClass('error').removeClass('good');
        if (!errorElems.includes('#file-input')) {
            errorElems.push('#file-input');
        }
    } else {
        img.src = _URL.createObjectURL(file);
        img.onload = function () {
            imgHeight = this.height;
            imgWidth = this.width;
            // console.log(imgWidth + ' ' + imgHeight)
            if (imgHeight < minImgHeight || imgWidth < minImgWidth) {
                imageDiv.find('.file-preview-thumbnails').addClass('error').removeClass('good');
                if (!errorElems.includes('#file-input')) {
                    errorElems.push('#file-input');
                }
            } else {
                imageDiv.find('.file-preview-thumbnails').addClass('good').removeClass('error');
                indexError = errorElems.indexOf('#file-input');
                if (indexError > -1) {
                    errorElems.splice(indexError, 1);
                }
            }
        }
    }
}