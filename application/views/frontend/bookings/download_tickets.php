<style>


	* {
		margin: 0;
		padding: 0;
		border: 0;
		box-sizing: border-box
	}

	body {
		background-color: #fff;
		/* font-family: arial */
	}

	.fl-left {
		float: left
	}

	.fl-right {
		float: right
	}

	.container {
		width: 80%;
		margin: 100px auto
	}

	h1 {
		font-weight: 600;
		font-size: 40px;
	}

	h3,
	h4,
	h5 {
		color: #989898;
		font-weight: 500;
	}

	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		/* font-family: 'Oswald', sans-serif; */
		text-transform: uppercase;
	}

	.row {
		overflow: hidden
	}

	.card {
		display: block;
		width: 100%;
		background: linear-gradient(45deg, #58b9c3, #f5f5fb);
		color: #585858;
		margin-bottom: 10px;
		/* font-family: 'Oswald', sans-serif; */
		text-transform: uppercase;
		border-radius: 4px;
		position: relative
	}

	.card+.card {
		margin-left: 2%
	}

	.date {
		/*display: table-cell;*/
		width: 25%;
		position: relative;
		text-align: center;
		border-right: 2px dashed #ffffff
	}

	.date:before,
	.date:after {
		content: "";
		display: block;
		width: 30px;
		height: 30px;
		background-color: #ffffff;
		position: absolute;
		top: -15px;
		right: -15px;
		z-index: 1;
		border-radius: 50%
	}

	.date:after {
		top: auto;
		bottom: -15px
	}

	.date time {
		display: block;
		position: absolute;
		/*top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%); */
	}

	.date time span {
		display: block
	}

	.date time span:first-child {
		color: #2b2b2b;
		font-weight: 600;
		/*font-size: 250%*/
	}

	.date time span:last-child {
		text-transform: uppercase;
		font-weight: 600;
		margin-top: -10px
	}

	.card-cont {
		/*display: table-cell;*/
		width: 75%;
		font-size: 85%;
		padding: 10px 10px 30px 50px
	}

	.card-cont h3 {
		color: #3C3C3C;
		font-size: 130%
	}

	/*.row:last-child .card:last-of-type .card-cont h3 {
		text-decoration: line-through
	}

	.card-cont>div {
		display: table-row
	}*/

	.card-cont .even-date i,
	.card-cont .even-info i,
	.card-cont .even-date time,
	.card-cont .even-info p {
		/*display: table-cell*/
	}

	.card-cont .even-date i,
	.card-cont .even-info i {
		padding: 5% 5% 0 0;
	}

	.card-cont .even-info p {
		padding: 30px 50px 0 0;
	}

	.card-cont .even-date time span {
		display: block;
	}

	/*.card-cont a {
		display: block;
		text-decoration: none;
		height: 30px;
		color: #fff;
		text-align: center;
		line-height: 30px;
		border-radius: 2px;
		position: absolute;
		right: 10px;
		bottom: 10px;
		padding: 0px 1rem;
	} */

	.row:last-child .card:last-child .card-cont a {
		background-color: #F8504C
	}

	.qr_code {
		width: 90px;
		height: 90px;
		position: absolute;
		top: 10px;
		right: 10px;
	}

	.qr_code img {
		width: inherit;
		height: inherit;
	}
</style>
<?php
$sr = 1;
if (isset($tickets)) {
	foreach ($tickets as $ticket) { ?>
		<div class="container">
			<div style="background: #fff; padding: 15px; border-radius: 4px; position: relative; border: 1px solid #ccc;">
				<table>
					<tr>
						<td>
							<div style="text-align: center; padding: 0 30px;">
								<h1><?php echo date('d', strtotime($ticket->gig_date)); ?></h1>
								<h3><?php echo date('M', strtotime($ticket->gig_date)); ?></h3>
							</div>
						</td>
						<td>
							<div style="margin-left: 35px;">
								<h5><?php echo $ticket->fname . ' ' . $ticket->lname;  ?></h5>
								<div style="text-transform: uppercase; font-size:large;"><?php echo $ticket->title ?></div>
								<h3><?php echo date('D d M, Y', strtotime($ticket->gig_date)); ?></h3>
								<h4><?php echo date('H:i A', strtotime($ticket->start_time)) . ' to ' . date('H:i A', strtotime($ticket->end_time)); ?></h4>
								<h5 style="margin-top: 30px;"><?php echo $ticket->address; ?></h5>
								<img src="<?php echo qrcode_url().'ticket_' . $ticket->qr_token . '.png' ?>" style="position: absolute;top: 0;width: 70px;right: 10px;" />
								<button type="button" style="position: absolute; bottom: 10px; right: 15px; padding: 5px 25px; color: #fff; background: #d8dde0; font-size: medium; text-transform: uppercase; border-radius: 2px;">
									Tickets
								</button>
							</div>
						</td>
					</tr>
				</table>
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