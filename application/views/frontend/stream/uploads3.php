<!DOCTYPE html>
<html>

<head>
    <title>
        AWS S3 File Upload
    </title>
    <!-- recommended -->
    <script src="https://www.WebRTC-Experiment.com/RecordRTC.js"></script>

    <!-- use 5.5.5 or any other version on cdnjs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/RecordRTC/5.5.5/RecordRTC.js"></script>

    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.1.12.min.js">
    </script>
</head>

<body>
    <!-- 1. Include action buttons play/stop -->
    <button id="btn-start-recording">Start Recording</button>
    <button id="btn-stop-recording" disabled="disabled">Stop Recording</button>

    <!--
    2. Include a video element that will display the current video stream
    and as well to show the recorded video at the end.
 -->
    <hr>
    <p id="percentage">
    </p>
    <div id="results">
    </div>

    <!-- 
3. Include the RecordRTC library and the latest adapter.
Note that you may want to host these scripts in your own server
-->
    <!-- <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
<script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->

    <!-- 4. Initialize and prepare the video recorder logic -->
    <script>
        /*  AWS.config.region = 'us-east-2'; // 1. Enter your region

            AWS.config.credentials = new AWS.CognitoIdentityCredentials({
                IdentityPoolId: 'us-east-2:a110fb4b-0768-4c9a-96e9-23c1a51c0977' // 2. Enter your identity pool
            });

            AWS.config.credentials.get(function(err) {
                if (err) alert(err);
                console.log(AWS.config.credentials);
            });

            var bucketName = 'appmaistersupload'; // Enter your bucket name+

            var bucket = new AWS.S3({
                params: {
                    Bucket: bucketName
                }
            });

            var fileChooser = document.getElementById('file-chooser');
            var button = document.getElementById('upload-button');
            var results = document.getElementById('results');
            var percentage = document.getElementById('percentage');*/
    </script>
    <input id="file-chooser" type="file" />
    <button id="upload-button">
        Upload to S3
    </button>

    <button id="cancel-button">
        Cancel Upload
    </button>
    <p id="percentage">
    </p>
    <div id="results">
    </div>
    <script type="text/javascript">
        AWS.config.region = 'us-east-1'; // 1. Enter your region

        AWS.config.credentials = new AWS.CognitoIdentityCredentials({
            IdentityPoolId: 'us-east-1:a5fa8f41-d372-4e8a-8a5d-6955c9a7deeb' // 2. Enter your identity pool
        });

        AWS.config.credentials.get(function(err) {
            if (err) alert(err);
            console.log(AWS.config.credentials);
        });

        var bucketName = 'gigniter-bucket-122'; // Enter your bucket name
        var bucket = new AWS.S3({
            params: {
                Bucket: bucketName
            }
        });

        var fileChooser = document.getElementById('file-chooser');
        var button = document.getElementById('upload-button');
        var results = document.getElementById('results');
        var percentage = document.getElementById('percentage');
        var cancelUpload = document.getElementById('cancel-button');

        listObjs();

        button.addEventListener('click', function() {

            var file = fileChooser.files[0];

            if (file) {

                results.innerHTML = '';
                var objKey = 'testing/' + file.name;
                var params = {
                    Key: objKey,
                    ContentType: file.type,
                    Body: file,
                    ACL: 'public-read'
                };

                // bucket.putObject(params, function(err, data) {
                //     if (err) {
                //         results.innerHTML = 'ERROR: ' + err;
                //     } else {
                //         listObjs();
                //     }
                // });
                var request = bucket.putObject(params);



                request.on('httpUploadProgress', function(progress) {
                    percentage.innerHTML = parseInt((progress.loaded * 100) / progress.total) + '%';
                    console.log("Uploaded :: " + parseInt((progress.loaded * 100) / progress.total) + '%');



                    // console.log(progress.loaded + " of " + progress.total + " bytes");
                }).send(function(err, data) {
                    percentage.innerHTML = "File has been uploaded successfully.";
                    listObjs();
                });


                cancelUpload.addEventListener('click', function() {
                    if (request.abort()) {
                        percentage.innerHTML = "Uploading has been canceled.";
                    }
                });

            } else {
                results.innerHTML = 'Nothing to upload.';
            }
        }, false);

        function listObjs() {
            var prefix = 'testing';
            bucket.listObjects({
                Prefix: prefix
            }, function(err, data) {
                if (err) {
                    results.innerHTML = 'ERROR: ' + err;
                } else {
                    var objKeys = "";
                    data.Contents.forEach(function(obj) {
                        objKeys += obj.Key + "<br>";
                    });
                    results.innerHTML = objKeys;
                }
            });
        }
    </script>
</body>

</html>