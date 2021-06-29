<!DOCTYPE html>
<html>
<head>
<title>Tickets</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta http-equiv="content-type" content="text-html; charset=utf-8"> 
 <style>
	@import url('https://fonts.googleapis.com/css?family=Oswald'); 
	* {
		margin: 0;
		padding: 0;
		border: 0;
		box-sizing: border-box;
	} 
	body {
		background-color: #fff;
		font-family: arial;
	} 
	.fl-left {
		float: left;
	}

	.fl-right {
		float: right;
	} 
	.container {
		width: 80%;
		margin: 100px auto;
	} 
	h1 {
		text-transform: uppercase;
		font-weight: 900;
		border-left: 10px solid #fec500;
		padding-left: 10px;
		margin-bottom: 30px;
	} 
	.row {
		overflow: hidden;
	} 
	.card {
		display: block;
		width: 100%;
		background: linear-gradient(45deg, #58b9c3, #f5f5fb);
		color: #585858;
		margin-bottom: 10px;
		font-family: 'Oswald', sans-serif;
		text-transform: uppercase;
		border-radius: 4px;
		position: relative;
	} 
	.card+.card {
		margin-left: 2%;
	} 
	.date {
		/*display: table-cell;*/
		width: 25%;
		position: relative;
		text-align: center;
		border-right: 2px dashed #ffffff;
	} 
	.date:before,
	.date:after {
		content: '';
		display: block;
		width: 30px;
		height: 30px;
		background-color: #ffffff;
		position: absolute;
		top: -15px;
		right: -15px;
		z-index: 1;
		border-radius: 50%;
	}

	.date:after {
		top: auto;
		bottom: -15px;
	} 
	.date time {
		display: block;
		position: absolute;
		top: 50%;
		left: 50%;
		-webkit-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	} 
	.date time span {
		display: block;
	} 
	.date time span:first-child {
		color: #2b2b2b;
		font-weight: 600;
		font-size: 250%;
	} 
	.date time span:last-child {
		text-transform: uppercase;
		font-weight: 600;
		margin-top: -10px;
	} 
	.card-cont {
		/*display: table-cell;*/
		width: 75%;
		font-size: 85%;
		padding: 10px 10px 30px 50px;
	}

	.card-cont h3 {
		color: #3C3C3C;
		font-size: 130%;
	} 
	.row:last-child .card:last-of-type .card-cont h3 {
		text-decoration: line-through;
	}  
	.card-cont>div {
		/*display: table-row*/
	} 
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
	.card-cont a {
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
	}  
	.row:last-child .card:last-child .card-cont a {
		background-color: #F8504C;
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
</head>
<body>
<?php
if(isset($tickets)){ 
    foreach($tickets as $ticket) { ?>
		<section class="container">
		  <article class="card">
			<section class="date">
			  <time datetime="<?php echo date('d M', strtotime($ticket->gig->gig_date)); ?>"> <span><?php echo date('d', strtotime($ticket->gig->gig_date)); ?></span> <span><?php echo date('M', strtotime($ticket->gig->gig_date)); ?></span> </time>
			</section>
			<section class="card-cont"> <small><?php echo $ticket->gig_owner->fname . ' ' . $ticket->gig_owner->lname;  ?></small>
			  <h3><?php echo $ticket->gig->title ?></h3>
			  <div class="even-date"> <i class="fa fa-calendar"></i>
				<time> <span><?php echo date('D d M, Y', strtotime($ticket->gig->gig_date)); ?></span> <span><?php echo date('H:i A', strtotime($ticket->gig->start_time)) . ' to ' . date('H:i A', strtotime($ticket->gig->end_time)); ?></span> </time>
			  </div>
			  <div class="even-info"> <i class="fa fa-map-marker"></i>
				<p> <?php echo $ticket->gig->address; ?> </p>
			  </div>
			  <div class="qr_code"> <img src="<?php echo qrcode_url() . 'ticket_' . $ticket->qr_token . '.png'; ?>" alt="<?php echo $ticket->qr_token; ?>" title="<?php echo $ticket->qr_token; ?>">
				<div> <?php echo $ticket->ticket_no; ?> </div>
			  </div>
			  <?php 
				  if ($ticket->is_validated){ ?>
					<a href="#" style="background-color:#037FDD;">Validated</a>
				  <?php 
				  }else{  ?>
					<a href="#" style="background-color:#D8DDE0;">Not Validated</a>
			  <?php } ?>
			</section>
		  </article>
		</section>
	<?php
		}
	} ?>
	<script> 
        //window.print(); 
    </script>
</body>
</html>