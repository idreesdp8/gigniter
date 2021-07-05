<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('frontend/layout/meta_tags'); ?>
	<title>Gigniter - Online Ticket Booking Service</title>
	<style>
		.exlpore-title,
		.explore-subtitle {
			text-transform: uppercase;
		}

		.card {
			background-color: #11326f;
			/* box-shadow: 0 4px 8px 0 #061332ab; */
		}

		.ticket_info {
			display: flex;
			justify-content: space-between;
		}

		.bundle-pill {
			padding: 3px 8px;
			background: #f1c40c;
			margin: 2px;
			border-radius: .75rem;
			color: #0e1e5e;
			font-weight: 600;
		}

		.bundle_image {
			border-radius: 50%;
		}

		tr td {
			vertical-align: middle;
		}
	</style>
	
	<style>
		@import url('https://fonts.googleapis.com/css?family=Oswald');

		.fl-left {
			float: left
		}

		.fl-right {
			float: right
		}

		.row {
			overflow: hidden
		}

		article.card {
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

		article.card+article.card {
			margin-left: 2%
		}

		.date {
			display: table-cell;
			width: 25%;
			position: relative;
			text-align: center;
			border-right: 2px dashed #dadde6
		}

		.date:before,
		.date:after {
			content: "";
			display: block;
			width: 30px;
			height: 30px;
			background-color: #f5f5f5;
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
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%)
		}

		.date time span {
			display: block
		}

		.date time span:first-child {
			color: #2b2b2b;
			font-weight: 600;
			font-size: 250%
		}

		.date time span:last-child {
			text-transform: uppercase;
			font-weight: 600;
			margin-top: -10px
		}

		.card-cont {
			display: table-cell;
			width: 75%;
			font-size: 85%;
			padding: 10px 10px 30px 50px
		}

		.card-cont h3 {
			color: #3C3C3C;
			font-size: 130%
		}

		.row:last-child .card:last-of-type .card-cont h3 {
			text-decoration: line-through
		}

		.card-cont>div {
			display: table-row
		}

		.card-cont .even-date i,
		.card-cont .even-info i,
		.card-cont .even-date time,
		.card-cont .even-info p {
			display: table-cell
		}

		.card-cont .even-date i,
		.card-cont .even-info i {
			padding: 5% 5% 0 0
		}

		.card-cont .even-info p {
			padding: 30px 50px 0 0
		}

		.card-cont .even-date time span {
			display: block
		}

		.card-cont a {
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

		.row:last-child .card:first-child .card-cont a {
			background-color: #037FDD
		}

		.row:last-child .card:last-child .card-cont a {
			background-color: #F8504C
		}

		@media screen and (max-width: 860px) {
			.card {
				display: block;
				float: none;
				width: 100%;
				margin-bottom: 10px
			}

			.card+.card {
				margin-left: 0
			}

			.card-cont .even-date,
			.card-cont .even-info {
				font-size: 75%
			}
		}
	</style>
</head>

<body>
	<?php $this->load->view('frontend/layout/preloader'); ?>
	<?php $this->load->view('frontend/layout/header'); ?>
	<!-- Page content -->
	<!-- ==========Banner-Section========== -->
	<section class="explore-banner-section bg_img" data-background="<?php echo user_asset_url(); ?>images/banner/banner-3.png">
		<div class="container">
			<div class="text-box text-center">
				<h2 class="exlpore-title">Tickets</h2>
				<h5 class="explore-subtitle">Gig Title: <?php echo $gig->title ?? '' ?></h5>
			</div>
		</div>
	</section> 
	<!-- ==========Banner-Section========== -->

	<!-- ==========Explore-content-Section========== -->
	<div class="event-facility padding-bottom padding-top">
		<div class="container">
			<?php $this->load->view('alert/alert'); ?>
			<div class="row">
				<div class="col-lg-12">
					<div class="checkout-widget checkout-contact">
						
						<div class="row">
							<?php
							$sr_no = 1;
							if (isset($tickets_rows)) {
								foreach ($tickets_rows as $tickets_row) { ?>
									<article class="card fl-left">
										<section class="date">
											<time datetime="<?php echo date('jS M, Y', strtotime($tickets_row->gig_date)); ?>">
												<span><?php echo date('d', strtotime($tickets_row->gig_date)); ?></span><span><?php echo date('M, y', strtotime($tickets_row->gig_date)); ?></span>
											</time>
										</section>
										<section class="card-cont">
											<small><?php echo $tickets_row->ticket_no; ?></small>
											<h3><?php echo $tickets_row->title; ?></h3>
											<div class="even-date">
												<i class="fa fa-calendar"></i>
												<time>
													<span><?php echo date('M d, Y', strtotime($tickets_row->gig_date)); ?></span>
													<span><?php echo date('H:i A', strtotime($tickets_row->start_time)) . ' to ' . date('H:i A', strtotime($tickets_row->end_time)) ?></span>
												</time>
											</div>
											<div class="even-info">
												<i class="fa fa-map-marker"></i>
												<p>
													<?php echo "Price: " .  ' $ ' . number_format($tickets_row->price, 2, ".", ","); ?> <br />
													<?php echo "Category: " . $tickets_row->category; ?> <br />
													<?php echo "Address: " . $tickets_row->address; ?> <br />
													<?php echo "Name: " . $tickets_row->fname . ' ' . $tickets_row->lname; ?> <br />
													<?php echo "Email: " . $tickets_row->email; ?> <br />

													<?php if ($tickets_row->is_paid == 1) {
														echo "Paid:  Yes <br />";
													} else if ($tickets_row->is_paid == 0) {
														echo "Paid:  No <br />";
													} ?>


												</p>
											</div>
											<?php
											$venues_txt = $tickets_row->venues;
											$venues_arrs = explode(',', $venues_txt);

											if (in_array('Physical', $venues_arrs)) { ?>
												<button type="button" class="btn btn-primary" id="send_ticket" data-ticket_id="<?php echo $tickets_row->ticket_id; ?>">Send Ticket</button>
											<?php } else {
												echo 'N/A';
											} ?>
										</section>

										<section class="card-cont">
											<div class="even-date">
												<?php
												if (strlen($tickets_row->qr_token) > 0) {
													$qr_code_url = qrcode_url() . "ticket_" . $tickets_row->qr_token . ".png"; ?>
													<img src="<?php echo $qr_code_url; ?>" style="width:80px; height:80px;">
												<?php
												}  ?>
											</div>
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
						
					
					
					
						<div class="row">
							<?php
							$sr_no = 1;
							if (isset($tickets_rows)) {
								foreach ($tickets_rows as $tickets_row) {
							?>
									<div class="col-md-6">
										<article class="card fl-left">
											<section class="date">
												<time datetime="<?php echo date('jS M, Y', strtotime($tickets_row->gig_date)); ?>">
													<span><?php echo date('d', strtotime($tickets_row->gig_date)); ?></span><span><?php echo date('M, y', strtotime($tickets_row->gig_date)); ?></span>
												</time>
											</section>
											<section class="card-cont">
												<small><?php echo $tickets_row->ticket_no; ?></small>
												<h3><?php echo $tickets_row->title; ?></h3>
												<div class="even-date">
													<i class="fa fa-calendar"></i>
													<time>
														<span><?php echo date('M d, Y', strtotime($tickets_row->gig_date)); ?></span>
														<span><?php echo date('H:i A', strtotime($tickets_row->start_time)) . ' to ' . date('H:i A', strtotime($tickets_row->end_time)) ?></span>
													</time>
												</div>
												<div class="even-info">
													<i class="fa fa-map-marker"></i>
													<p>
														<?php echo "Price: " .  ' $ ' . number_format($tickets_row->price, 2, ".", ","); ?> <br />
														<?php echo "Category: " . $tickets_row->category; ?> <br />
														<?php echo "Address: " . $tickets_row->address; ?> <br />
														<?php echo "Name: " . $tickets_row->fname . ' ' . $tickets_row->lname; ?> <br />
														<?php echo "Email: " . $tickets_row->email; ?> <br />

														<?php if ($tickets_row->is_paid == 1) {
															echo "Paid:  Yes <br />";
														} else if ($tickets_row->is_paid == 0) {
															echo "Paid:  No <br />";
														} ?>
														<?php if ($tickets_row->is_validated == 1) {
															echo "Validated:  Yes <br />";
														} else if ($tickets_row->is_validated == 0) {
															echo "Validated:  No <br />";
														} ?>


													</p>
												</div>
												<?php
												$venues_txt = $tickets_row->venues;
												$venues_arrs = explode(',', $venues_txt);

												if (in_array('Physical', $venues_arrs)) { ?>
													<div class="d-flex justify-content-between">
														<form action="<?php echo user_base_url() ?>validate/validate_ticket" method="post">
															<input type="hidden" name="ticket_token" value="<?php echo $tickets_row->qr_token; ?>">
															<button type="submit" class="btn btn-theme-primary validate_ticket">Validate Ticket</button>
														</form>
														<button type="button" class="btn btn-theme-primary send_ticket" data-ticket_token="<?php echo $tickets_row->qr_token; ?>">Send Ticket</button>
													</div>
												<?php } else {
													echo 'N/A';
												} ?>
											</section>

											<section class="card-cont">
												<div class="even-date">
													<?php
													if (strlen($tickets_row->qr_token) > 0) {
														$qr_code_url = qrcode_url() . "ticket_" . $tickets_row->qr_token . ".png"; ?>
														<img src="<?php echo $qr_code_url; ?>" style="width:80px; height:80px;">
													<?php
													}  ?>
												</div>
											</section>
										</article>
									</div>
								<?php
									echo ($sr_no % 2 == 0) ? '</div> <div class="row">' : '';
									$sr_no++;
								}
							}

							if ($sr_no == 1) {  ?>
								<strong>No record found!</strong>
							<?php } ?>
						</div>
						<!-- <div class="row">
							<div class="col-lg-12">
								<div class="card">
									<div class="card-body">
										<table class="table text-white table-striped">
											<thead>
												<tr>
													<th>Sr #</th>
													<th>Ticket #</th>
													<th>Gig</th>
													<th>Price ($)</th>
													<th>Category</th>
													<th>Address</th>
													<th>User</th>
													<th>User Email</th>
													<th>Purchase Date</th>
													<th>QR Code</th>
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
															<td><?php echo $tickets_row->title . ' ' . $tickets_row->subtitle; ?> </td>
															<td><?php echo '$ ' . number_format($tickets_row->price, 2, ".", ","); ?> </td>
															<td><?php echo $tickets_row->category; ?> </td>
															<td><?php echo $tickets_row->address; ?> </td>
															<td><?php echo $tickets_row->fname . ' ' . $tickets_row->lname; ?> </td>
															<td><?php echo $tickets_row->email; ?> </td>
															<td><?php echo date('M d, Y H:i A', strtotime($tickets_row->created_on)) ?></td>
															<td>
																<?php
																if (strlen($tickets_row->qr_token) > 0) {
																	$qr_code_url = '';
																	if ($_SERVER['HTTP_HOST'] == "localhost") {
																		$qr_code_url = "http://" . $_SERVER["HTTP_HOST"] . "/gigniter/downloads/tickets_qr_code_imgs/ticket_" . $tickets_row->qr_token . ".png";
																	} else {
																		$qr_code_url = "http://" . $_SERVER["HTTP_HOST"] . "/downloads/tickets_qr_code_imgs/ticket_" . $tickets_row->qr_token . ".png";
																	} ?>
																	<img src="<?php echo $qr_code_url; ?>" style="width:60px; height:60px;">
																<?php
																} else {
																	echo "N/A";
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
						</div> -->
					</div>
					<div class="d-flex float-right">
						<a type="button" class="btn btn-secondary ml-2" href="<?php echo user_base_url() . 'transactions'; ?>">Back</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- ==========Explore-content-Section========== -->
	<!-- /page content -->

	<?php $this->load->view('frontend/layout/footer'); ?>
	<?php $this->load->view('frontend/layout/scripts'); ?>
	<script>
		$(document).ready(function() {
			$('.send_ticket').click(function() {
				var ticket_token = $(this).data('ticket_token')
				$.ajax({
					url: base_url + 'transactions/send_ticket',
					data: {
						ticket_token: ticket_token
					},
					method: 'post',
					dataType: 'json',
					success: function(resp) {
						if (resp.status) {
							swal({
								icon: 'success',
								title: resp.message,
							});
						} else {
							swal({
								icon: 'error',
								title: resp.message,
							});
						}
					}
				})
			})
			// $('.validate_ticket').click(function() {
			// 	var ticket_token = $(this).data('ticket_token')
			// 	$.ajax({
			// 		url: base_url + 'validate/validate_ticket',
			// 		data: {
			// 			ticket_token: ticket_token
			// 		},
			// 		method: 'post',
			// 		dataType: 'json',
			// 		success: function(resp) {
			// 			if (resp.status) {
			// 				swal({
			// 					icon: 'success',
			// 					title: resp.message,
			// 				});
			// 			} else {
			// 				swal({
			// 					icon: 'error',
			// 					title: resp.message,
			// 				});
			// 			}
			// 		}
			// 	})
			// })
		})
	</script>
</body>

</html>