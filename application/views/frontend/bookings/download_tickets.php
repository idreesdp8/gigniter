<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            font-family:'Roboto', sans-serif;
        }
    </style>
<!-- </head>
<body> -->
<?php
$sr = 1;
if (isset($tickets)) {
	foreach ($tickets as $ticket) { ?>
    <div style="border: .15em solid black;border-radius:10px;  width: 100%; position: relative; margin-bottom:20px; ">
            <div style="display:inline-block; width:100%;">
                <div style="width:35%;float: left;">
                    <img src="<?php echo downloads_url() ?>gig8.jpg" alt="" style="width: 100%; margin: 5px;">
                </div>
                <div style="width: 45%; margin-left:20px; float: left;">
                        <div>
                            <div style="font-size: 1.5em;text-transform: uppercase;"><?php echo  $ticket->title ?></div>
                            <div style="font-size: 0.75em;text-transform: capitalize;"><?php echo  $ticket->subtitle ?></div>
                            <div style="font-size: 0.75em;text-transform: capitalize;">from 
                                <span style="font-weight: 600;text-transform: uppercase;"><?php echo date('H:i A', strtotime($ticket->start_time)) ?></span> to 
                                <span style="font-weight: 600;text-transform: uppercase;"><?php echo date('H:i A', strtotime($ticket->end_time)) ?></span>
                            </div>
                         </div>  
                         <div style="margin-top:35px;">
                            <div style="font-size: 1.25em;text-transform: uppercase;font-weight: 600;"><?php echo $ticket->fname.' '.$ticket->lname ?></div>
                             <div style="font-size: 1.25em;text-transform: capitalize;font-weight: 600;">paid: <span><?php echo '$'.number_format($ticket->ticket_price, 2, '.', ',') ?></span></div>
                            
                                <div style="font-size: 0.75em;text-transform: capitalize;">Venue: <span><?php echo $ticket->address ?></span></div>
                         </div>
                 </div>
                           

                <div style="width:15%;float: right;margin:5px 10px 0px 10px">
                <div style=" text-align: center;">
                <div style="width: 7em;height: 5em;border: 2px solid black;position: flex;display: flex;justify-content: center;align-items: center;flex-direction: column;">
                    <div style="font-size: 1em;"><?php echo date('M', strtotime($ticket->gig_date)) ?></div>
                    <div style="font-size: 1.5em; font-weight: 700;"><?php echo date('d', strtotime($ticket->gig_date)) ?></div>
                    <div style="font-size: 1em;"><?php echo date('Y', strtotime($ticket->gig_date)) ?></div>
                </div>
                <div>
                    <img src="<?php echo qrcode_url(). 'ticket_' . $ticket->qr_token . '.png' ?>" alt="">
                </div>
            </div>
                </div>


            </div>
            
    </div>
	<?php
		$sr++;
	}
} else { ?>
	<tr>
		<td colspan="3" style="text-align:center"> <strong> No ticket found! </strong> </td>
	</tr>
<?php } ?>
    
<!-- </body>
</html> -->