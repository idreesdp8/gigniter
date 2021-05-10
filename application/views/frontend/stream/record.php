<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <video id="player" controls></video>
    <a id="download">Download</a>
    <script>
        let shouldStop = false;
        let stopped = false;
        var player = document.getElementById('player');
        const downloadLink = document.getElementById('download');
        // const stopButton = document.getElementById('stop');

        // stopButton.addEventListener('click', function() {
        //     shouldStop = true;
        // })

        var handleSuccess = function(stream) {
            player.srcObject = stream;
            const options = {
                mimeType: 'video/webm'
            };
            const recordedChunks = [];
            const mediaRecorder = new MediaRecorder(stream, options);

            mediaRecorder.addEventListener('dataavailable', function(e) {
                if (e.data.size > 0) {
                    recordedChunks.push(e.data);
                }

                if (shouldStop === true && stopped === false) {
                    mediaRecorder.stop();
                    stopped = true;
                }
            });

            var i = 1;
            // setInterval(function() {
            //     downloadLink.href = URL.createObjectURL(new Blob(recordedChunks));
            //     downloadLink.download = 'acetest'+i+'.webm';
            //     downloadLink.click();
            //     i++;
            // }, 10*1000);

            // mediaRecorder.addEventListener('stop', function() {
            // });

            mediaRecorder.start();
        };

        navigator.mediaDevices.getUserMedia({
                audio: true,
                video: true
            })
            .then(handleSuccess);
    </script>
    <!-- <script>
        var player = document.getElementById('player');
        var devices;

        var handleSuccess = function(stream) {
            player.srcObject = stream;
        };
        // navigator.mediaDevices.enumerateDevices().then((devices) => {
        //     devices = devices.filter((d) => d.kind === 'videoinput');
        // });
        navigator.permissions.query({
            name: 'camera'
        }).then(function(result) {
            if (result.state == 'granted') {

            } else if (result.state == 'prompt') {

            } else if (result.state == 'denied') {

            }
            result.onchange = function() {

            };
        });
        // alert(devices);
        navigator.mediaDevices.getUserMedia({
                audio: true,
                video: true
            })
            .then(handleSuccess)
    </script> -->
</body>

</html>