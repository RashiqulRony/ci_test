<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Doreen Power Generations and Systems Limited</title>
        <!-- responsive meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">	
        <!-- master stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/jquery.fancybox.min.css') ?>">        
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/style.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/custom.css') ?>">
        <!-- responsive stylesheet -->
        <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/responsive.css') ?>">
        <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
        <script> var base = "<?= base_url(); ?>";</script>
        <?php if ($tabActive != 'contactus') { ?>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
        <?php }
        ?>

        <?php if ($tabActive == 'contactus') { ?>
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <?php }
        ?>

    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader"></div>
        <!-- Main Header-->
        <header class="main-header">
            <!--Header-Lower-->
            <div class="header-lower">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-8 col-md-2">
                            <div class="logo">
                                <a href="<?php echo site_url() ?>"><img src="<?php echo base_url('assets/frontend/img/logo.png') ?>" alt="" title=""></a>
                            </div>
                        </div>   
                        <div class="col-md-10 text-right">
                            <div class="nav-outer clearfix">
                                <!-- Main Menu -->
                                <nav class="main-menu">
                                    <div class="navbar-header">
                                        <!-- Toggle Button -->      
                                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>

                                    <div class="navbar-collapse collapse clearfix">
                                        <ul class="navigation clearfix">
                                            <li class="<?php echo $tabActive == 'home' ? 'current' : '' ?>"><a href="<?php echo site_url() ?>">Home</a></li>
                                            <li class="submenu <?php echo $tabActive == 'about' ? 'current' : '' ?>"><a href="<?php echo site_url('about') ?>">About Us</a>
                                                <ul>
                                                    <li><a href="<?php echo site_url('about') ?>">Vission & Mission</a></li>
                                                    <li><a href="<?php echo site_url('management') ?>">Board of Directors </a></li>
                                                </ul>
                                            </li>
                                            <li class="<?php echo $tabActive == 'project' ? 'current' : '' ?>"><a href="<?php echo site_url('project') ?>">Projects</a></li>
                                            <li class="<?php echo $tabActive == 'management' ? 'current' : '' ?>">
                                                <a href="<?php echo site_url('management') ?>">Management</a>
                                            </li>
                                            <li class="<?php echo $tabActive == 'gallery' ? 'current' : '' ?>"><a href="<?php echo site_url('gallery') ?>">Gallery</a></li>
                                            <li class="<?php echo $tabActive == 'contactus' ? 'current' : '' ?>"><a href="<?php echo site_url('contactus') ?>">Contact</a></li>
                                        </ul>
                                    </div>
                                </nav><!-- Main Menu End-->

                            </div>
                        </div>     
                    </div>    
                </div>
            </div>

        </header>
        <!--End Main Header -->