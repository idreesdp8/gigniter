<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    #original_image {
        width: 500px;
    }
    #original_image img {
        width: inherit;
    }
    </style>
</head>

<body>
    <input type="file" onchange="readURL(this)">
    <div id="original_image">
    </div>
    <div id="resized_image">
    </div>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var div = document.getElementById('original_image');
                    var img_tag = document.createElement('img');
                    img_tag.setAttribute('src', e.target.result);
                    // hiddenInput.setAttribute('name', 'stripe-token');
                    // hiddenInput.setAttribute('value', token.id);
                    div.appendChild(img_tag);
                    // console.log(div);
                    // $('.image_div img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>