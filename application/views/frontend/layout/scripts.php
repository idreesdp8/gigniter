<script type="text/javascript" src="<?php echo user_asset_url(); ?>js/jquery-asPieProgress.js"></script>
<script type="text/javascript" src="<?php echo user_asset_url(); ?>js/circlebar.js"></script>
<script src="<?php echo user_asset_url(); ?>js/jquery-3.3.1.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/modernizr-3.6.0.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/plugins.js"></script>
<script src="<?php echo user_asset_url(); ?>js/popper.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/heandline.js"></script>
<script src="<?php echo user_asset_url(); ?>js/isotope.pkgd.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/magnific-popup.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/owl.carousel.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/wow.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/countdown.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/odometer.min.js"></script>
<script src="<?php echo user_asset_url(); ?>js/viewport.jquery.js"></script>
<script src="<?php echo user_asset_url(); ?>js/nice-select.js"></script>
<script src="<?php echo user_asset_url(); ?>js/main.js"></script>
<script src="<?php echo user_asset_url(); ?>js/jquery.validate.js"></script>
<script src="<?php echo user_asset_url(); ?>js/sweetalert.min.js"></script>
<script>
    const base_url = '<?php echo user_base_url() ?>';
    const user_id = '<?php echo $this->session->userdata('us_id') ?>';
    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    $('[data-toggle="tooltip"]').tooltip();
    dateWithTimeZone = (timeZone, dateTime) => {
        console.log(dateTime)
        let date = new Date(Date.UTC(dateTime));
        console.log(date)
        let options = {
            year: 'numeric',
            month: 'short',
            day: 'numeric',
            hour: 'numeric',
            minute: 'numeric',
            hour12: true,
        };
        options['timezone'] = 'UTC'
        console.log(options)
        let utcDate = new Date(date.toLocaleString('en-GB', options));
        console.log(utcDate)
        options['timezone'] = timeZone
        console.log(options)
        let tzDate = new Date(date.toLocaleString('en-GB', options));
        console.log(tzDate)
        let offset = utcDate.getTime() - tzDate.getTime();
        console.log(offset)
        date.setTime(date.getTime() + offset);
        console.log(date)
        return date;
    };
</script>