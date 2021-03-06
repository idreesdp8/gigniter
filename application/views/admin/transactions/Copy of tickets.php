<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('admin/layout/meta_tags'); ?>
	<title>Tickets</title>
	<style>
		input[type='text'] {
			border: 0px;
			padding: 0px;
		}
	</style>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Oswald');
		
		.fl-left{float: left}
		
		.fl-right{float: right} 
		
		.row{overflow: hidden}
		
		.card
		{
		  display: table-row;
		  width: 49%;
		  background-color: #fff;
		  color: #989898;
		  margin-bottom: 10px;
		  font-family: 'Oswald', sans-serif;
		  text-transform: uppercase;
		  border-radius: 4px;
		  position: relative
		}
		
		.card + .card{margin-left: 2%}
		
		.date
		{
		  display: table-cell;
		  width: 25%;
		  position: relative;
		  text-align: center;
		  border-right: 2px dashed #dadde6
		}
		
		.date:before,
		.date:after
		{
		  content: "";
		  display: block;
		  width: 30px;
		  height: 30px;
		  background-color: #DADDE6;
		  position: absolute;
		  top: -15px ;
		  right: -15px;
		  z-index: 1;
		  border-radius: 50%
		}
		
		.date:after
		{
		  top: auto;
		  bottom: -15px
		}
		
		.date time
		{
		  display: block;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  -webkit-transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%)
		}
		
		.date time span{display: block}
		
		.date time span:first-child
		{
		  color: #2b2b2b;
		  font-weight: 600;
		  font-size: 250%
		}
		
		.date time span:last-child
		{
		  text-transform: uppercase;
		  font-weight: 600;
		  margin-top: -10px
		}
		
		.card-cont
		{
		  display: table-cell;
		  width: 75%;
		  font-size: 85%;
		  padding: 10px 10px 30px 50px
		}
		
		.card-cont h3
		{
		  color: #3C3C3C;
		  font-size: 130%
		}
		
		.row:last-child .card:last-of-type .card-cont h3
		{
		  text-decoration: line-through
		}
		
		.card-cont > div
		{
		  display: table-row
		}
		
		.card-cont .even-date i,
		.card-cont .even-info i,
		.card-cont .even-date time,
		.card-cont .even-info p
		{
		  display: table-cell
		}
		
		.card-cont .even-date i,
		.card-cont .even-info i
		{
		  padding: 5% 5% 0 0
		}
		
		.card-cont .even-info p
		{
		  padding: 30px 50px 0 0
		}
		
		.card-cont .even-date time span
		{
		  display: block
		}
		
		.card-cont a
		{
		  display: block;
		  text-decoration: none;
		  width: 80px;
		  height: 30px;
		  background-color: #D8DDE0;
		  color: #fff;
		  text-align: center;
		  line-height: 30px;
		  border-radius: 2px;
		  position: absolute;
		  right: 10px;
		  bottom: 10px
		}
		
		.row:last-child .card:first-child .card-cont a
		{
		  background-color: #037FDD
		}
		
		.row:last-child .card:last-child .card-cont a
		{
		  background-color: #F8504C
		}
		
		@media screen and (max-width: 860px)
		{
		  .card
		  {
			display: block;
			float: none;
			width: 100%;
			margin-bottom: 10px
		  }
		  
		  .card + .card{margin-left: 0}
		  
		  .card-cont .even-date,
		  .card-cont .even-info
		  {
			font-size: 75%
		  }
		}
 </style>
</head>

<body>
	<?php $this->load->view('admin/layout/header'); ?>
	<!-- Page content -->
	<div class="page-content">
		<?php $this->load->view('admin/layout/sidebar'); ?>
		<!-- Main content -->
		<div class="content-wrapper">
			<!-- Page header -->
			<div class="page-header page-header-light">
				<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo admin_base_url(); ?>dashboard" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
							<span class="breadcrumb-item active">Dashboard</span>
						</div>

						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>
				</div>
			</div>
			<!-- /page header -->
			<!-- Content area -->
	<div class="content">
		<div class="cardss">
			<div class="card-header header-elements-inline">
				<h6 class="card-title">Tickets Detail </h6>
				<div class="header-elements">
					<!-- <div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
						<a class="list-icons-item" data-action="reload"></a>
						<a class="list-icons-item" data-action="remove"></a>
					</div> -->
				</div>
			</div>

			<div class="card-body"> 
				
			<div class="row">  
			<?php
				$sr_no = 1;
				if (isset($tickets_rows)) {
					foreach ($tickets_rows as $tickets_row) { ?>
						<article class="card fl-left">
						  <section class="date">
							<time datetime="<?php echo date('jS M, Y', strtotime($tickets_row->created_on)); ?>">
							  <span><?php echo date('d', strtotime($tickets_row->created_on)); ?></span><span><?php echo date('M, y', strtotime($tickets_row->created_on)); ?></span>
							</time>
						  </section>
						  <section class="card-cont">
							<small><?php echo $tickets_row->ticket_no; ?></small>
							<h3><?php echo $tickets_row->title; ?></h3>
							<div class="even-date">
							 <i class="fa fa-calendar"></i>
							 <time>
							   <span><?php echo date('M d, Y H:i A', strtotime($tickets_row->created_on)); ?></span>
							   <!--<span>08:55pm to 12:00 am</span>-->
							 </time>
							</div>
							<div class="even-info">
							  <i class="fa fa-map-marker"></i>
							  <span><?php echo '$ ' . number_format($tickets_row->price, 2, ".", ","); ?></span>
							  <p>
								<!--  <?php echo $tickets_row->category; ?>  -->
								<?php echo $tickets_row->address; ?> <br />
								<?php echo $tickets_row->fname . ' ' . $tickets_row->lname; ?> <br />
								<?php echo $tickets_row->email; ?> <br /> 
							  </p>
							</div>
							<!--<a href="#">tickets</a>--> 
							<?php
								$venues_txt = $tickets_row->venues;
								$venues_arrs = explode(',', $venues_txt);
				
								if (in_array('Physical', $venues_arrs)) { ?>
									<button type="button" class="btn btn-primary" id="send_ticket" data-ticket_id="<?php echo $tickets_row->ticket_id; ?>">Send Ticket</button>
								<?php } else {
									echo 'N/A';
								} ?>
						  </section>
						</article> 
					<?php
					echo ($sr_no % 2 == 0) ? '</div> <div class="row">' : ''; 
					$sr_no++;
					
					}
				}
			
			if ($sr_no == 1) {  ?>  
			 <strong>No record found!</strong>  
			<?php } ?> 	 
			</div>
			  
				<div class="row" style="display:none">
					<div class="table-responsive">
						<table class="table table-striped datatable-basic">
							<thead>
								<tr>
									<th>Sr #</th>
									<th>Ticket #</th>
									<th>Gig</th>
									<!-- <th>Price ($)</th> -->
									<!-- <th>Category</th> -->
									<th>Address</th>
									<th>User</th>
									<th>User Email</th>
									<th>Purchase Date</th>
									<th>Ticket</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sr_no = 1;
								if (isset($tickets_rows)) {
									foreach ($tickets_rows as $tickets_row) { ?>
										<tr>
											<td><?php echo $sr_no; ?> </td>
											<td><?php echo $tickets_row->ticket_no; ?> </td>
											<td><?php echo $tickets_row->title ?> </td>
											<!-- <td><?php echo '$ ' . number_format($tickets_row->price, 2, ".", ","); ?> </td> -->
											<!-- <td><?php echo $tickets_row->category; ?> </td> -->
											<td><?php echo $tickets_row->address; ?> </td>
											<td><?php echo $tickets_row->fname . ' ' . $tickets_row->lname; ?> </td>
											<td><?php echo $tickets_row->email; ?> </td>
											<td><?php echo date('M d, Y H:i A', strtotime($tickets_row->created_on)) ?></td>
											<td>
												<?php
												/* if(strlen($tickets_row->qr_token)>0){
												$qr_code_url = ''; 
												if($_SERVER['HTTP_HOST'] == "localhost"){  
													$qr_code_url = qrcode_url()."ticket_".$tickets_row->qr_token.".png";		
												}else{
													$qr_code_url = qrcode_url()."ticket_".$tickets_row->qr_token.".png"; 
												} ?> <img src="<?php echo $qr_code_url; ?>" style="width:60px; height:60px;">
												<?php   
												}else{
													echo "N/A";
												} */
	
												$venues_txt = $tickets_row->venues;
												$venues_arrs = explode(',', $venues_txt);
	
												if (in_array('Physical', $venues_arrs)) { ?>
													<button type="button" class="btn btn-primary" id="send_ticket" data-ticket_id="<?php echo $tickets_row->ticket_id; ?>">Send Ticket</button>
												<?php } else {
													echo 'N/A';
												} ?>
											</td>
										</tr>
									<?php
										$sr_no++;
									}
								}
	
								if ($sr_no == 1) {  ?>
									<tr>
										<td colspan="9" style="text-align:center"><strong>No record found!</strong></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
					</div>
				</div>
			</div>
			<!-- /content area -->

			<?php $this->load->view('admin/layout/footer'); ?>

		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->

	<script>
		$(document).ready(function() {
			$('#sidebar_transaction').addClass('nav-item-open');
			$('#sidebar_transaction ul').first().css('display', 'block');
			$('#sidebar_transaction_tickets a').addClass('active');

			$('#send_ticket').click(function(){
				var ticket_id = $(this).data('ticket_id')
				$.ajax({
					url: base_url + 'transactions/resend_qr_code',
					data: {
						ticket_id: ticket_id
					},
					method: 'post',
					success: function(resp) {

					}
				})
			})
		});
	</script>
</body>

</html>