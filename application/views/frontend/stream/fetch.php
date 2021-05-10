<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title> Videos </title>
</head>

<br /> <br />
<?php if ($video_url != '') { ?>
    <video controls width="786">
        <source src="<?php echo $video_url; ?>" type="video/mp4">
    </video>
<?php } else {
    echo "No video found!";
} ?>
<br /><br />

</body>

</html>