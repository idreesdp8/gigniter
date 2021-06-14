<!-- ==========Header-Section========== -->
<header class="header-section">
    <div class="container">
        <div class="header-wrapper">
            <div class="logo">
                <a href="<?php echo user_base_url() ?>">
                    <img src="<?php echo user_asset_url(); ?>images/logo/logo.png" alt="logo">
                </a>
            </div>
            <ul class="menu">
                <li>
                    <a href="<?php echo user_base_url() ?>gigs/add" id="start_gig_menu">Start a gig</a>
                </li>
                <li>
                    <a href="<?php echo user_base_url() ?>gigs/explore" id="explore_menu">Explore</a>
                </li>
                <li>
                    <div class="searchbar">
                        <input class="search_input h-auto" type="text" name="" placeholder="Search">
                        <a href="#" class="search_icon ml-5"><img src="<?php echo user_asset_url(); ?>images/icons/search.png"></a>
                    </div>
                </li>
                <?php
                $vs_id = $this->session->userdata('us_id');
                $vs_full_name = $this->session->userdata('us_fullname');
                if (!$vs_id) :
                ?>
                    <li class="header-button pr-0">
                        <a href="<?php echo user_base_url() ?>signup">Sign Up</a>
                    </li>
                    <li class="header-button2 pr-0">
                        <a href="<?php echo user_base_url() ?>signin" id="signin_menu">Signin</a>
                    </li>
                <?php
                else :
                ?>
                    <li>
                        <a href="#0">
                            <span class="signed-welcome">Welcome</span>
                            <p class="user-name"><?php echo $vs_full_name !== '' ? $vs_full_name : 'User' ?> <span class="name-divider">|</span> My account</p>
                        </a>
                        <ul class="submenu signed-user-menu">
                            <li>
                                <a href="<?php echo user_base_url().'account/profile/'.$vs_id ?>">My Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo user_base_url() ?>gigs/add">Create Gig</a>
                            </li>
                            <li>
                                <a href="<?php echo user_base_url() ?>my_gigs">My Gigs</a>
                            </li>
                            <li>
                                <a href="<?php echo user_base_url() ?>bookings">My Bookings</a>
                            </li>
                            <li>
                                <a href="<?php echo user_base_url() ?>live/my_shows">My Shows</a>
                            </li>
                            <li>
                                <a href="<?php echo user_base_url() ?>account/logoff">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php
                endif;
                $cart_items = $this->cart->total_items();
                ?>
                <li>
                    <a href="<?php echo user_base_url() ?>cart/checkout" id="cart_menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#e9eeff">
                            <path d="M16.53 7l-.564 2h-15.127l-.839-2h16.53zm-14.013 6h12.319l.564-2h-13.722l.839 2zm5.983 5c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm11.305-15l-3.432 12h-13.017l.839 2h13.659l3.474-12h1.929l.743-2h-4.195zm-6.305 15c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5z" />
                        </svg>
                        <?php if ($cart_items) : ?>
                            <!--  -->
                            <span class="badge badge-warning cart-badge"><?php echo $cart_items; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
            <div class="header-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
<!-- ==========Header-Section========== -->