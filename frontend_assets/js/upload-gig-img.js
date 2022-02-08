function read_bundle_image(input) {
    console.log(input);
    var x = input.parentElement;
    console.log(x);
    var element = input.parentElement.getElementsByTagName("img")[0];
    console.log(element);
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function () {
            // this.parentElement.getElementsByTagName("img").attr('src', e.target.result);
            element.src = reader.result;
        };
        reader.readAsDataURL(input.files[0]);
        element.classList.remove("d-none");
    }
}

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img2').attr('src', e.target.result);
            $('#gig_user_iamge').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}