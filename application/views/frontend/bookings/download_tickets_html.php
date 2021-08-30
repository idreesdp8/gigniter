<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div style="height: 25em; border: .15em solid black; border-radius: 4.5em; display: flex; width: 100%; position: relative;">
        <div style="border-radius: 4em; overflow: hidden; height: -webkit-fill-available;">
            <img src="<?php echo downloads_url() ?>gig8.jpg" alt="" style="width: 25em; height: 25em; object-fit: cover; border-radius: 4em;">
        </div>
        <div>
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div>
                    <div style="font-size: 3em;text-transform: uppercase;">Title of concert</div>
                    <div style="font-size: 1.5em;text-transform: capitalize;">subtitle</div>
                    <div style="font-size: 1.5em;text-transform: capitalize;">from <span style="font-weight: 600;text-transform: uppercase;">02:00 pm</span> to <span style="font-weight: 600;text-transform: uppercase;">04:00 pm</span></div>
                </div>
                <div>
                    <div style="font-size: 2em;text-transform: uppercase;font-weight: 600;">name of purchaser</div>
                    <div style="font-size: 2em;text-transform: capitalize;font-weight: 600;">paid: <span>$38.76</span></div>
                </div>
                <div>
                    <div style="font-size: 1.5em;text-transform: capitalize;">Venue: <span>ABCD Street</span></div>
                </div>
            </div>
            <div style="position: absolute; right: 10%; top: 50%; transform: translate(0, -50%); text-align: center;">
                <div style="width: 13em;height: 10em;border: .25em solid black;position: flex;display: flex;justify-content: center;align-items: center;flex-direction: column;">
                    <div style="font-size: 1.5em;">September</div>
                    <div style="font-size: 2.5em; font-weight: 700;">01</div>
                    <div style="font-size: 1.5em;">2021</div>
                </div>
                <div>
                    <img src="<?php echo downloads_url() ?>ticket_6123940874306.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>