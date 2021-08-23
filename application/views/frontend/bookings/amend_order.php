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
            box-shadow: 0 4px 8px 0 #061332ab;
        }

        .ticket_info {
            display: flex;
            justify-content: space-between;
        }

        .modal-title {
            width: 100%;
        }

        .close {
            color: red;
            width: auto;
            text-shadow: none;
            opacity: 1;
        }

        .friend-input {
            margin: 10px;
        }

        .img-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-evenly;
        }

        .img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .img-wrapper>div {
            width: 120px;
            margin-bottom: 10px;
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
                <h2 class="exlpore-title">Amend Order</h2>
                <h5 class="explore-subtitle">Order #: <?php echo $booking->booking_no ?? '' ?></h5>
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
                        <h5 class="title">Amend Order
                        </h5>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <h6>Order #</h6>
                                        <p><?php echo $booking->booking_no ?></p>
                                    </div>
                                    <?php
                                    foreach ($cart_items as $item) :
                                    ?>
                                        <div class="col-lg-4" F>
                                            <h6>Ticket Tier</h6>
                                            <p><?php echo ($item->name ?? '') . ' (' . $item->quantity . ')'; ?></p>
                                        </div>
                                    <?php
                                    endforeach;
                                    ?>
                                </div>
                            </div>
                            <form method="post" action="<?php echo user_base_url() ?>bookings/amend_order" id="datas_form">
                                <input type="hidden" name="booking_id" value="<?php echo $booking->id; ?>" />
                                <div class="col-lg-12">
                                    <h6>Add Ticket Tier(s)</h6>
                                </div>
                                <br>
                                <?php
                                if ($tiers) :
                                    foreach ($tiers as $index => $value) :
                                ?>
                                        <div class="ticket--item">
                                            <input type="hidden" name="ticket_tier_id[]" value="<?php echo $value->id ?>" />
                                            <div class="ticket-content">
                                                <span class="ticket-title"><?php echo $value->name ?></span>
                                                <h2 class="amount"><sup>$</sup><?php echo $value->price ?></h2>
                                                <?php
                                                if ($value->bundles) :
                                                ?>
                                                    <div class="product-img">
                                                        <img src="<?php echo $value->image != '' ? bundle_url() . $value->image : user_asset_url() . 'images/cap.png' ?>" alt="Product image">
                                                    </div>
                                                    <div class="product-description">
                                                        <ul>
                                                            <?php
                                                            foreach ($value->bundles as $bundle) :
                                                            ?>
                                                                <li>*<?php echo $bundle->title ?></li>
                                                            <?php
                                                            endforeach;
                                                            ?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                endif;
                                                ?>
                                                <div class="cart-button event-cart">
                                                    <div class="cart-plus-minus mb-0">
                                                        <div class="dec qtybutton">-</div>
                                                        <div class="dec qtybutton">-</div>
                                                        <input class="cart-plus-minus-box" type="text" name="qty[]" value="<?php echo $index == 0 ? 1 : 0 ?>">
                                                        <div class="inc qtybutton">+</div>
                                                        <div class="inc qtybutton">+</div>
                                                    </div>
                                                </div>
                                                <!-- <div class="row justify-content-center mt-4">
                                                    <div class="book-now-button">
                                                        <button type="submit" class="custom-button">book tickets</button>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                        </div>
                    </div>
                    <div class="d-flex float-right">
                        <a type="button" class="btn btn-secondary ml-2" href="<?php echo user_base_url() . 'bookings'; ?>">Back</a>
                        <button type="submit" class="btn btn-primary ml-2">Amend</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form role="form" method="post" action="<?php echo user_base_url() ?>bookings/invite_friends" id="basic_info_form">
                    <input type="hidden" name="booking_id" value="<?php echo $booking->id ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Invite Friends</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Invite</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <script>
        function operate_booking_deletion(del_id) {
            $(document).ready(function() {
                swal({
                    title: "Do you want to Cancel this Booking?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        window.location = "<?php echo user_base_url() . 'bookings/cancel_booking/'; ?>" + del_id;
                    } else {
                        swal({
                            icon: 'info',
                            title: 'Your booking is safe!',
                        });
                    }
                });
            });
        }
        $(document).ready(function() {

            $('.open_modal').on('click', function() {
                var qty = $(this).data('value');
                var cart_id = $(this).data('cart_id');
                $('.modal-body').empty();
                $('.modal-body').append('<input type="hidden" name="cart_id" value="' + cart_id + '">');
                for (let index = 0; index < qty; index++) {
                    $('.modal-body').append('<div class="friend-input"><input type="email" name="email[]" class="form-control" required /></div>')
                }
                // console.log(qty);
                $('#exampleModal').modal('show');
            });
            // $('#basic_info_form').on('submit', function(e) {
            //     e.preventDefault();
            //     var form_data = new FormData(e[0]);
            //     console.log(form_data);
            //     $.ajax({
            //         url: $(this).attr('action'),
            //         method: $(this).attr('method'),
            //         data: form_data,
            //         contentType: false,
            //         processData: false,
            //         success: function(resp) {

            //         }
            //     });
            //     // console.log(data);
            // })
        })
    </script>
</body>

</html>