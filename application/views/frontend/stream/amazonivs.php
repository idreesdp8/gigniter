<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://player.live-video.net/1.2.0/amazon-ivs-player.min.js"></script>
</head>

<body>
    <video id="video-player" playsinline></video>
    <script>
        if (IVSPlayer.isPlayerSupported) {
            const player = IVSPlayer.create();
            player.attachHTMLVideoElement(document.getElementById('video-player'));
            player.load('https://8549aae23beb.us-east-1.playback.live-video.net/api/video/v1/us-east-1.305842570590.channel.YdcRatUHOYg1.m3u8');
            player.play();
        }
    </script>
</body>

</html>