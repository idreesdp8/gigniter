    function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

           
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img2').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }

           
        }