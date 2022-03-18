var validForm = false;
var errorElems = [];
var ticketTierValues = [];
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
    // console.log($('#' + formStep).find('input,select'));
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
    if (formStep == 'step-2') {
        var inputs = document.querySelectorAll('input[name^="ticket_quantity"]')
        var ticketTierQty = 0;
        var goal = document.getElementById('goal').value;
        // console.log(inputs)
        for (var i = 0; i < inputs.length; i++) {
            // console.log(inputs[i])
            ticketTierQty += parseInt(inputs[i].value)
        }
        // console.log(ticketTierQty)
        if (ticketTierQty != goal) {
            $('input[name^="ticket_quantity"]').removeClass("good").addClass("error");
            errorElems.push('input[name^="ticket_quantity"]');
        } else {
            $('input[name^="ticket_quantity"]').removeClass("error").addClass("good");
            indexError = errorElems.indexOf('input[name^="ticket_quantity"]');
            errorElems.splice(indexError, 1);
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
            // console.log('User does not Exist')
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
    console.log(errorElems);
    if (errorElems.length) {
        if (errorElems[0] == '#file-input') {
            var scrollPos = $('#div_image').find('.file-preview-thumbnails').offset().top - $('.header-section').outerHeight(true) - $('#div_image p').outerHeight(true);
            $(window).scrollTop(scrollPos);
        }
        $(errorElems[0]).focus();
    } else {
        validForm = true;
        // var nextStepWizard = $('div.setup-panel div a[href="#' + formStep + '"]').parent().next().children("a");
        // // console.log(nextStepWizard);
        // nextStepWizard.removeClass('disabled').trigger('click');
        // $(window).scrollTop('0');
        if (formStep == 'step-1') {
            var form = new FormData($('#form_step_1')[0])
            saveGigData(form, formStep)
        }
        if (formStep == 'step-2') {
            var form = new FormData($('#form_step_2')[0])
            saveGigData(form, formStep)
        }
        if (formStep == 'step-3') {
            var form = new FormData($('#form_step_3')[0])
            saveGigData(form, formStep)
        }
    }
}
function saveGigData(form, step) {
    if (step === 'step-1') {
        var url = base_url + 'gigs/save_gig_data_step_one'
    }
    if (step === 'step-2') {
        var url = base_url + 'gigs/save_gig_data_step_two'
    }
    if (step === 'step-3') {
        var url = base_url + 'gigs/save_gig_data_step_three'
    }
    $.ajax({
        url: url,
        type: 'POST',
        data: form,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            // alert(res.message)
            swal({
                position: 'top-end',
                toast: true,
                icon: res.status === 1 ? 'success' : 'danger',
                title: res.message,
                showConfirmButton: false,
                timer: 1500
            })
            if (res.status === 1) {
                if (step === 'step-1') {
                    var gigIdElem = document.getElementById('step_2_gig_id')
                }
                if (step === 'step-2') {
                    var gigIdElem = document.getElementById('step_3_gig_id')
                }
                if (step === 'step-3') {
                    var gigIdElem = document.getElementById('step_4_gig_id')
                }
                var nextStepWizard = $('div.setup-panel div a[href="#' + step + '"]').parent().next().children("a");
                console.log(nextStepWizard);
                nextStepWizard.removeClass('disabled').trigger('click');
                $(window).scrollTop('0');
                gigIdElem.value = res.gig_id
            }
        }
    });
}
$(document).ready(function () {
    steps.not('#step-1').hide(); //hide all tabs except first one

    nextButton.click(function () { //when click on the save & continue button validation will be checked for that tab
        // console.log($(this).parents('.setup-content').attr('id'));
        var formStep = $(this).parents('.setup-content').attr('id')
        runValidationOn(formStep);
    })
    $('.step-form-buttons > button').click(function (e) {
        // $('#basic_info_form').submit();
        //complete gig
        $.ajax({
            url: base_url + '/gigs/save_gig_data_step_final',
            type: 'POST',
            data: {
                gig_id: $('#step_4_gig_id').val(),
                is_draft: $('#is_draft').val()
            },
            dataType: 'json',
            success: function (res) {
                if (res.status === 1) {
                    window.location.href = '/' + res.return_url
                } else {
                    alert(res.message)
                }
            }
        });
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
});
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
    // var campaign_date = new Date($('#campaign_date').val());
    var gig_date = new Date($('#gig_date').val());
    var gig_min_date = new Date($('#campaign_date').attr('min'));
    console.log(gig_min_date)
    console.log(gig_min_date <= gig_date)
    if (val !== '' && gig_min_date <= gig_date) {
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
    var minTime = $("#end_time").attr('min');
    // console.log(val <= minTime);
    // console.log(minTime);
    if (val !== '' && val > minTime) {
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