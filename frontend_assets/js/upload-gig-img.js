// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();
//         reader.onload = function (e) {
//             $('#img').attr('src', e.target.result);
//         };
//         reader.readAsDataURL(input.files[0]);
//     }
// }

function read_bundle_image(input) {
    // console.log(input);
    // var x = input.parentElement;
    // console.log(x);
    // console.log(x.getElementsByTagName("img")[0]);
    var element = input.parentElement.getElementsByTagName("img")[0];
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