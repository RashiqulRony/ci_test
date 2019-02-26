<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2><?php echo substr($projectDetails->project_title, 0, 30) . '..' ?></h2>
                    <ul class="list-inline">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <li><a href="<?php echo site_url('project') ?>">Project</a></li>
                        <li class="active">Project Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Slider area-->

<!--Start blog-content area-->
<section class="inner-project event_list_page sec-pdd-90">
    <div class="container">
        <div class="service-title-2">
            <h2><?php echo $projectDetails->project_title ?></h2>
            <p></p>
        </div>
        <?php
        $projectImage = getCoverPhoto($projectDetails->project_id, 'featured');

        if (empty($projectImage)) {
            $projectImage = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
        }
        ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Start single-item -->
                <div class="single-project">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12"></div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="event_img_holder">
                                <img src="<?php echo $projectImage ?>" alt="Images" width="801" height="422">
                            </div> 
                        </div>
                    </div> 
                    <div class="project-content thousandevent_single sm-margin-bot">
                        <h4><?php echo $projectDetails->project_title ?></h4>
<!--                        <div class="icon_text_box">
                            <p class="Collins">Power Energy</p>
                        </div>-->
                        <p>
                            <?php echo $projectDetails->project_description ?>
                        </p>
                        <div class="thousandevent_single_border"></div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>       
<!--End blog-content area-->


<!--<script src="<?php // echo base_url('assets/frontend/plugin/jquery/jquery-1.12.5.js')     ?>"></script>-->
<!-- bootstrap js -->
<script src="<?php echo base_url('assets/frontend/plugin/bootstrap/js/bootstrap.min.js') ?>"></script>
<!-- bx slider -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.bxslider.min.js') ?>"></script>
<!-- count to -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.countTo.js') ?>"></script>
<!-- owl carousel js -->
<script src="<?php echo base_url('assets/frontend/plugin/owl.carousel-2/owl.carousel.min.js') ?>"></script>
<!-- validate -->
<script src="<?php echo base_url('assets/frontend/plugin/validate.js') ?>"></script>
<!-- mixit up -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.mixitup.min.js') ?>"></script>
<!-- fancybox -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.fancybox.pack.js') ?>"></script>
<!-- easing -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.easing.min.js') ?>"></script>
<!-- gmap script -->
<script src="<?php echo base_url('assets/frontend/plugin/maplace.html') ?>"></script>
<!-- gmap script -->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<!-- google map script -->    
<script src="<?php echo base_url('assets/frontend/plugin/gmaps.js') ?>"></script>
<!-- google map helper -->  
<script src="<?php echo base_url('assets/frontend/plugin/map-helper.js') ?>"></script>
<!-- video responsive script -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.fitvids.js') ?>"></script>
<!-- menuzord script -->
<script src="<?php echo base_url('assets/frontend/plugin/js/menuzord.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.scrollUp.js') ?>"></script>

<!-- thm custom script -->
<script src="<?php echo base_url('assets/frontend/js/custom.js') ?>"></script>

