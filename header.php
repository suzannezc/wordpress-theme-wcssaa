<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if (is_front_page()) { ?> 
        <title><?php bloginfo('name'); ?></title>
    <?php } else { ?>
        <title><?php wp_title(''); ?> (<?php bloginfo('name'); ?>)</title>
    <?php } ?>

    <link href="https://s3.amazonaws.com/wrdsb-ui-assets/1/master.css" rel="stylesheet" media="all">

    <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-60x60.png" rel="apple-touch-icon" />
    <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
    <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
    <link href="https://s3.amazonaws.com/wrdsb-ui-assets/<?php echo $GLOBALS['wrdsbvars']['asset_version']; ?>/images/icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <script src="https://s3.amazonaws.com/wrdsb-theme/js/addtohomescreen.min.js"></script>
    <script src="https://s3.amazonaws.com/wrdsb-theme/js/jquery.floatThead.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        $(document).ready(function(){
            $('table.table-fixed-head').floatThead({
                useAbsolutePositioning: false
            });
        });
        $("table").addClass("table table-striped table-bordered");
        $("table").wrap("<div class='table-responsive'></div>");
    </script>

    <?php wp_head(); ?>
</head>

<body id="top">

    <!-- header -->
    <div class="container container-top">
        <div class="header">
            <div class="row">
                <div class="col-md-10 col-sm-10">
                    <div id="logo" role="heading">
                        <a aria-labelledby="logo" href="<?php echo home_url(); ?>/"><span><?php echo get_bloginfo('name'); ?></span>
                            <p id="sitename"><?php echo get_bloginfo('name'); ?></p>
                            <?php if (get_bloginfo('description') != '') { ?>
                                <p id="sitedescription"><?php echo get_bloginfo('description'); ?></p>
                            <?php } ?>
                        </a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2">
                    <div class="staff-shortcuts" role="complementary" aria-labelledby="staff-shortcut-list">
                        <div id="staff-shortcut-list">
                            <div><a href="/safety">Player Safety</a></div>
                            <div><a href="/rules">Rules</a>
                            <div><a href="/volunteers">For Volunteers</a></div>
                            <div><a href="/about">About WCSSAA</a></div>
                            <div><a href="#address">Contact Info.</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar my-navbar" role="navigation" aria-labelledby="navbar-header"></div><!-- /.navbar -->
    </div><!-- /.container-top -->

    <?php if (is_front_page()) { ?>
        <?php if (function_exists('stswr_alerts_get_current_alert') && stswr_alerts_get_current_alert('id') !== '0') { ?>
            <div class="container" role="alert" aria-labelledby="alerts">
                <div id="alerts">
                    <h1><?php echo stswr_alerts_get_current_alert('title'); ?></h1>
                    <?php echo stswr_alerts_get_current_alert('body-html'); ?>
                </div>
            </div>
        <?php } elseif (get_header_image()) { ?>
            <div class="container" role="Img" aria_label="Header Image">
                <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
            </div>
        <?php } else { ?>
        <?php } ?>
    <?php } ?>
