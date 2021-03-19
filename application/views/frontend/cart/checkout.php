<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('frontend/layout/meta_tags'); ?>
    <title>Gigniter - Online Ticket Booking Website HTML Template</title>
    <style>
        .exlpore-title,
        .explore-subtitle {
            text-transform: uppercase;
        }

        input[type="text"],
        input[type="number"] {
            color: black;
            padding: 5px !important;
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
                <h2 class="exlpore-title">Check Out</h2>
                <!-- <h5 class="explore-subtitle"><?php echo $gig->address ?? 'Test Address' ?></h5> -->
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->

    <!-- ==========Explore-content-Section========== -->
    <form method="post" action="<?php echo user_base_url() ?>cart/checkout" id="datas_form">
        <div class="event-facility padding-bottom padding-top">
            <div class="container">
                <?php $this->load->view('alert/alert'); ?>
                <div class="row">
                    <div class="col-lg-8">
                        <?php
                        if (!$user) :
                        ?>
                            <!-- <input type="hidden" value="<?php echo $uri ?>"> -->
                            <div class="checkout-widget d-flex flex-wrap align-items-center justify-cotent-between">
                                <div class="title-area">
                                    <h5 class="title">Already a Gigniter Member?</h5>
                                    <p>Sign in to proceed</p>
                                </div>
                                <a href="<?php echo user_base_url(); ?>login" class="sign-in-area">
                                    <i class="fas fa-user"></i><span>Sign in</span>
                                </a>
                            </div>
                        <?php
                        endif;
                        ?>
                        <!-- <form class="checkout-contact-form"> -->
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Share your Contact Details </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="user_fname" placeholder="First Name" value="<?php echo $user->fname ?? '' ?>" data-error="#user_fname1" required>
                                        <span id="user_fname1" class="text-danger"><?php echo form_error('user_fname'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="user_lname" placeholder="Last Name" value="<?php echo $user->lname ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter your Mail" name="user_email" value="<?php echo $user->email ?? '' ?>" data-error="#user_email1" required>
                                        <span id="user_email1" class="text-danger">
                                            <?php
                                            echo form_error('user_email');
                                            echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter your Phone Number" name="phone_no" value="<?php echo $user->phone_no ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <?php
                            // if ($user) :
                            ?>
                            <!-- <div class="form-group">
                                        <input type="submit" value="Continue" class="custom-button">
                                    </div> -->
                            <?php
                            // endif;
                            ?>
                        </div>
                        <div class="checkout-widget checkout-contact">
                            <h5 class="title">Share your Card details </h5>
                            <!-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="card_number" placeholder="4242 4242 4242 4242" value="4242424242424242" data-stripe="number" data-error="#card_number1" required>
                                            <span id="card_number1" class="text-danger"><?php echo form_error('card_number'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="cvc" placeholder="123" value="123" data-stripe="cvc" data-error="#cvc1" required>
                                            <span id="cvc1" class="text-danger"><?php echo form_error('cvc'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="02" name="exp_month" value="02" data-stripe="exp-month" data-error="#exp_month1" required>
                                            <span id="exp_month1" class="text-danger"><?php echo form_error('exp_month'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="2022" name="exp_year" value="2022" data-stripe="exp-year" data-error="#exp_year1" required>
                                            <span id="exp_year1" class="text-danger"><?php echo form_error('exp_year'); ?></span>
                                        </div>
                                    </div>
                                </div> -->
                            <div class="form-group">
                                <!-- <label for="card-element">Card</label> -->
                                <div id="card-element"></div>
                            </div>
                            <?php
                            // if ($user) :
                            ?>
                            <!-- <div class="form-group">
                                        <input type="submit" value="Continue" class="custom-button">
                                    </div> -->
                            <?php
                            // endif;
                            ?>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="col-lg-4">
                        <div class="booking-summery bg-one">
                            <h4 class="title">booking summary</h4>
                            <ul>
                                <!-- <li>
                                    <h6 class="subtitle">Venues</h6>
                                    <?php
                                    if ($gig && $gig->venues) :
                                        foreach ($gig->venues as $venue) :
                                    ?>
                                            <span class="info"><?php echo $venue ?></span>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </li> -->
                                <?php
                                foreach ($cart_items as $item) :
                                ?>
                                    <li>
                                        <h6 class="subtitle">
                                            <input type="hidden" class="rowid" value="<?php echo $item['rowid'] ?>">
                                            <div class="d-flex w-100 justify-content-between">
                                                <span><?php echo $item['name'] ?></span>
                                                <span class="text-danger mt-auto mb-auto cursor-pointer remove_item"><i class="fas fa-times"></i></span>
                                            </div>
                                            <div class="w-100"><input type="number" class="qty h-auto" min="1" value="<?php echo $item['qty'] ?>"></div>
                                        </h6>
                                        <div class="info"><span><?php echo date('d M D', strtotime($item['created_on'])) ?>, <?php echo date('H:i A', strtotime($item['created_on'])) ?></span> <span>Tickets</span></div>
                                        <div class="info"><span>Tickets Price</span> <span class="item_subtotal">$<?php echo $item['subtotal']; ?></span></div>
                                    </li>
                                    <!-- <li>
                                    <h6 class="subtitle mb-0"><span>Tickets Price</span><span>$<?php echo $item['subtotal']; ?></span></h6>
                                </li> -->
                                <?php
                                endforeach;
                                ?>
                            </ul>
                            <ul class="side-shape">
                                <li>
                                    <span class="info"><span>total price</span><span id="total_amount">$<?php echo $total_amount; ?></span></span>
                                    <span class="info"><span>vat</span><span>$0</span></span>
                                </li>
                            </ul>
                        </div>
                        <?php
                        // if ($user) :
                        ?>
                        <div class="proceed-area  text-center">
                            <h6 class="subtitle"><span>Amount Payable</span><span id="payable_amount">$<?php echo $total_amount; ?></span></h6>
                            <button type="submit" class="custom-button back-button">proceed</button>
                        </div>
                        <?php
                        // endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- ==========Explore-content-Section========== -->
    <!-- /page content -->

    <?php $this->load->view('frontend/layout/footer'); ?>
    <?php $this->load->view('frontend/layout/scripts'); ?>
    <?php $this->load->view('frontend/layout/stripe_init') ?>
    <script>
        $(document).ready(function() {
            const base_url = '<?php echo user_base_url(); ?>';
            var validator = $('#datas_form').validate({
                rules: {
                    user_fname: {
                        required: true
                    },
                    user_email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    user_fname: {
                        required: "First name is required field"
                    },
                    user_email: {
                        required: "Email is required field",
                        email: "Please enter a valid Email address!"
                    },
                },
                errorPlacement: function(error, element) {
                    var placement = $(element).data('error');
                    if (placement) {
                        $(placement).append(error)
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function() {
                    // document.forms["datas_form"].submit();
                }
            });

            $('.remove_item').click(function(){
                var elem = $(this);
                var rowid = elem.parents('li').find('.rowid').val();
                // console.log(rowid);
                $.ajax({
                    url: base_url + 'cart/delete_item',
                    data: {
                        'rowid' : rowid
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(resp) {
                        alert(resp.message);
                        if(resp.status == 200) {
                            elem.parents('li').remove();
                            $('#total_amount').empty().html('$'+resp.total_amount);
                            $('#payable_amount').empty().html('$'+resp.total_amount);
                        }
                    }
                });
            });

            $('.qty').blur(function(){
                var elem = $(this);
                var rowid = elem.parents('li').find('.rowid').val();
                var qty = elem.val();
                // console.log(rowid);
                $.ajax({
                    url: base_url + 'cart/update_item',
                    data: {
                        'rowid' : rowid,
                        'qty' : qty
                    },
                    method: 'post',
                    dataType: 'json',
                    success: function(resp) {
                        alert(resp.message);
                        if(resp.status == 200) {
                            // elem.parents('li').remove();
                            elem.parents('li').find('.item_subtotal').empty().html('$'+resp.item_total);
                            $('#total_amount').empty().html('$'+resp.total_amount);
                            $('#payable_amount').empty().html('$'+resp.total_amount);
                        }
                    }
                });
            });


        });
    </script>
</body>

</html>