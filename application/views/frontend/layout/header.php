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
                    <a href="<?php echo user_base_url() ?>" id="start_gig_menu">Start a gig</a>
                </li>
                <li>
                    <a href="<?php echo user_base_url() ?>gig/explore" id="explore_menu">Explore</a>
                </li>
                <li>
                    <div class="searchbar">
                        <input class="search_input h-auto" type="text" name="" placeholder="Search">
                        <a href="#" class="search_icon ml-5"><img src="<?php echo user_asset_url(); ?>images/icons/search.png"></a>
                    </div>
                    <div class="mobile_search">
                        <input type="text" class="mobile_search_input" placeholder="Search...">
                        <div class="search_for_mobile"></div>
                    </div>
                </li>
                <?php
                $vs_id = $this->session->userdata('us_id');
                if (!$vs_id) :
                ?>
                    <li class="header-button pr-0">
                        <a href="#">Sign Up</a>
                    </li>
                    <li class="header-button2 pr-0">
                        <a href="#">Sign in</a>
                    </li>
                <?php
                else :
                ?>
                    <li>
                        <a href="#0">
                            <span class="signed-welcome">Welcome</span>
                            <p class="user-name">Shahid <span class="name-divider">|</span> My accounts</p>
                        </a>
                        <ul class="submenu signed-user-menu">
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="#">My Gigs</a>
                            </li>
                            <li>
                                <a href="#">Payment Histroy</a>
                            </li>
                            <li>
                                <a href="#">Logout</a>
                            </li>
                        </ul>
                    </li>
                <?php
                endif;
                ?>
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