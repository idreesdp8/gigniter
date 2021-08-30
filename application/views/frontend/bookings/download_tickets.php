<style>
	* {
		margin: 0;
		padding: 0;
		border: 0;
		box-sizing: border-box
	}
</style>
<?php
$sr = 1;
if (isset($tickets)) {
	foreach ($tickets as $ticket) { ?>
		<div style="height: 25em; border: .15em solid black; border-radius: 4.5em; display: flex; width: 100%; position: relative;">
			<div style="border-radius: 4em; overflow: hidden; height: -webkit-fill-available;">
				<img src="<?php echo poster_url().$ticket->poster ?>" alt="" style="width: 25em; height: 25em; object-fit: cover; border-radius: 4em;">
			</div>
			<div>
				<div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
					<div>
						<div style="font-size: 3em;text-transform: uppercase;"><?php echo  $ticket->title ?></div>
						<div style="font-size: 1.5em;text-transform: capitalize;"><?php echo  $ticket->subtitle ?></div>
						<div style="font-size: 1.5em;text-transform: capitalize;">from 
							<span style="font-weight: 600;text-transform: uppercase;"><?php echo date('H:i A', strtotime($ticket->start_time)) ?></span> to 
							<span style="font-weight: 600;text-transform: uppercase;"><?php echo date('H:i A', strtotime($ticket->end_time)) ?></span>
						</div>
					</div>
					<div>
						<div style="font-size: 2em;text-transform: uppercase;font-weight: 600;"><?php echo $ticket->fname.' '.$ticket->lname ?></div>
						<div style="font-size: 2em;text-transform: capitalize;font-weight: 600;">paid: <span><?php echo number_format($ticket->ticket_price, 2, '.', ',') ?></span></div>
					</div>
					<div>
						<div style="font-size: 1.5em;text-transform: capitalize;">Venue: <span><?php echo $ticket->address ?></span></div>
					</div>
				</div>
				<div style="position: absolute; right: 10%; top: 50%; transform: translate(0, -50%); text-align: center;">
					<div style="width: 13em;height: 10em;border: .25em solid black;position: flex;display: flex;justify-content: center;align-items: center;flex-direction: column;">
						<div style="font-size: 1.5em;"><?php echo date('M', strtotime($ticket->gig_date)) ?></div>
						<div style="font-size: 2.5em; font-weight: 700;"><?php echo date('d', strtotime($ticket->gig_date)) ?></div>
						<div style="font-size: 1.5em;"><?php echo date('Y', strtotime($ticket->gig_date)) ?></div>
					</div>
					<div>
						<img src="<?php echo qrcode_url(). 'ticket_' . $ticket->qr_token . '.png' ?>" alt="">
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