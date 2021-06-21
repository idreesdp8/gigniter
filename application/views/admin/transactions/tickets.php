<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/layout/meta_tags'); ?>
    <title>Bookings</title>
    <style>
        input[type='text'] {
            border: 0px;
            padding: 0px;
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
                <div class="card">
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
                            <div class="table-responsive"> 
								<table class="table table-striped datatable-basic">
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
									if(isset($tickets_rows)){  
										foreach ($tickets_rows as $tickets_row) { ?>
											<tr>
												<td><?php echo $sr_no; ?> </td>
												<td><?php echo $tickets_row->ticket_no; ?> </td>
												<td><?php echo $tickets_row->title.' '.$tickets_row->subtitle; ?> </td> 
												<td><?php echo '$ '.number_format($tickets_row->price,2, ".", ","); ?> </td>
												<td><?php echo $tickets_row->category; ?> </td>
												<td><?php echo $tickets_row->address; ?> </td>
												<td><?php echo $tickets_row->fname.' '.$tickets_row->lname; ?> </td>
												<td><?php echo $tickets_row->email; ?> </td>  
												<td><?php echo date('M d, Y H:i A', strtotime($tickets_row->created_on)) ?></td>
												<td> 
												<?php  
													if(strlen($tickets_row->qr_token)>0){
														$qr_code_url = ''; 
														if($_SERVER['HTTP_HOST'] == "localhost"){  
															$qr_code_url = "http://".$_SERVER["HTTP_HOST"]."/gigniter/downloads/tickets_qr_code_imgs/ticket_".$tickets_row->qr_token.".png";		
														}else{
															$qr_code_url = "http://".$_SERVER["HTTP_HOST"]."/downloads/tickets_qr_code_imgs/ticket_".$tickets_row->qr_token.".png"; 
														} ?> <img src="<?php echo $qr_code_url; ?>" style="width:60px; height:60px;">
														<?php   
														}else{
															echo "N/A";
														}
														
														$venues_txt = $tickets_row->venues;
														$venues_arrs = explode(',', $venues_txt);
														
														if(in_array('Physical', $venues_arrs)){ ?> 
															<a href="<?php echo admin_base_url().'transactions/resend_qr_code/'.$tickets_row->ticket_id; ?>">Send QR Code</a>
													<?php } ?>
												</td>
											</tr>
											<?php
												$sr_no++;
											}
										}
											
										if($sr_no == 1){  ?>
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
			
			// $('#sidebar_transaction a#sidebar_transaction_nav').addClass('active');
            // $('#sidebar_transaction #sidebar_transaction_tickets a').addClass('active');
        });
    </script>
</body>

</html>