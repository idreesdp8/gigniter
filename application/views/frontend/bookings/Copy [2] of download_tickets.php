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
		display: flex;
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

  .clipper:before, .clipper:after {
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
.clipper:after {
    top: auto;
    bottom: -15px;
}
</style>
</head>
<body>
<?php
if(isset($tickets)){
    foreach($tickets as $ticket) { ?>
  
    <table BORDER=0 CELLSPACING=0 style="width: 80%;margin: 100px auto;">
        <tr style="width: 100%;
    background: linear-gradient(45deg, #58b9c3, #f5f5fb);
    color: #585858;
    margin-bottom: 10px;
    font-family: 'Oswald', sans-serif;
    text-transform: uppercase;
    border-radius: 4px;
    position: relative;">
            <td class="clipper" colspan="2" style="display: table-cell;
    width: 25%;
    position: relative;
    text-align: center;
    border-right: 2px dashed #ffffff;">
                <time style="display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);" datetime="<?php echo date('d M', strtotime($ticket->gig_date)); ?>"> <span style="color: #2b2b2b;
    font-weight: 600;
    font-size: 250%;
    display: block;"><?php echo date('d', strtotime($ticket->gig_date)); ?></span> <span style="text-transform: uppercase;
    font-weight: 600;
    margin-top: -10px;"><?php echo date('M', strtotime($ticket->gig_date)); ?></span> </time>
            </td>
            <td style="width: 75%;
    font-size: 85%;
    padding: 10px 10px 30px 50px;
    position: relative;">

    <small><?php echo $ticket->fname . ' ' . $ticket->lname;  ?></small>
      <h3 style="color: #3C3C3C;
    font-size: 130%;"><?php echo $ticket->title; ?></h3>
       <i class="fa fa-calendar"></i>
      <span style="
    padding-top: 22px;
    display: block;
"><time> <span><?php echo date('D d M, Y', strtotime($ticket->gig_date)); ?></span><br />
        <span><?php echo date('H:i A', strtotime($ticket->start_time)) . ' to ' . date('H:i A', strtotime($ticket->end_time)); ?></span>
      </time></span>

       <i class="fa fa-map-marker"></i>
      <p style="margin-top: 50px;"> <?php echo $ticket->address; ?> </p>

    <span style="position: absolute;
    right: 15px;
    top: 15px;
    "><img src="<?php echo qrcode_url() . 'ticket_' . $ticket->qr_token . '.png'; ?>" style="width: 90px; height: 90px;" alt="<?php echo $ticket->qr_token; ?>" title="<?php echo $ticket->qr_token; ?>" />
       <?php echo $ticket->ticket_no; ?> </span>

    <span style="position: absolute;
    right: 15px;
    bottom: 15px;"><?php
        if ($ticket->is_validated){ ?>
        <a style="text-decoration: none;
    height: 30px;
    display: block;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    right: 10px;
    bottom: 10px;
    padding: 0px 1rem;" href="#" style="background-color:#037FDD;">Validated</a>
        <?php
        }else{  ?>
        <a style="text-decoration: none;
    height: 30px;
    display: block;
    background-color: #D8DDE0;
    color: #fff;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    right: 10px;
    bottom: 10px;
    padding: 0px 1rem;" href="#" style="background-color:#D8DDE0;">Not Validated</a>
      <?php } ?></span>
            </td>
        </tr>
    </table>
	<?php
		}
	} ?>
	<script>
        //window.print();
    </script>
</body>
</html>