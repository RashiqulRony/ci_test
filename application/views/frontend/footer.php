<!--Start footer area-->
<section class="footer_area">
    <div class="container">
        <div class="row">

            <!--start widget-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="footer-widget">
                    <div class="footer-logo"><a href="<?php echo site_url() ?>"><img src="<?php echo base_url('assets/frontend/img/foot_logo.png') ?>" alt=""></a></div>
                    <div class="widget-content">
                        <p>We have built an enviable reputation in the consumer goods, heavy industry, high-tech, manufacturing, medical, recreational vehicle, and transportation sectors.</p>

                    </div>
                </div>
            </div>
            <!--end widget-->

            <!--start widget-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="footer-widget services_contact">
                    <div class="widget-title">
                        <h2>Menu</h2>
                        <div class="title-border"></div>
                    </div>
                    <div class="widget-content">
                        <div class="widget-service-menu">
                            <ul>
                                <li><a href="<?php echo site_url('about') ?>">About Us</a></li>
                                <!--<li><a href="">Vission & Mission</a></li>-->
                                <li><a href="<?php echo site_url('management') ?>">Board of Directors </a></li>
                                <li><a href="<?php echo site_url('project') ?>">Projects</a></li>
                                <!--<li><a href="#">Management</a></li>-->
                                <li><a href="<?php echo site_url('gallery') ?>">Gallery</a></li>
                                <li><a href="<?php echo site_url('contactus') ?>">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end widget-->

            <!--start widget-->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="footer-widget services_contact">
                    <div class="widget-title">
                        <h2>Office Address</h2>
                        <div class="title-border"></div>
                    </div>
                    <div class="widget-content">
                        <?php
                        $contactDetails = $this->global_model->get('contacts');
                        $address = array();
                        if (count($contactDetails)) {
                            foreach ($contactDetails as $contact) {
                                if ($contact->contact_address) {
                                    $address[] = $contact->contact_address;
                                }
                            }
                        }
                        if(count($address)){
                            echo "<p>".implode('<br>', $address)."</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!--end widget-->


        </div>
    </div>
</section> 
<!--End footer area-->  

<!--Start footer bottom area-->
<section class="footer_bottom_area">
    <div class="container"> 
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="footer_logo">
                    <p>Copyright &copy; <?php echo date('Y') ?> Doreen Power Generations and Systems Limited All Rights Reserved.</p>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="footer_bottom_right">
                    <p>Designed & Developed by <a class="hover-line" href="https://www.technobd.com/" target="_blank">Technobd</a></p>
                </div>
            </div>
        </div>
    </div>
</section> 
<!--End footer bottom area--> 


<script src="<?php echo base_url('assets/frontend/plugin/jquery/jquery-1.12.5.js') ?>"></script>
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
<!-- appear -->
<script src="<?php echo base_url('assets/frontend/js/jquery.appear.js') ?>"></script>
<!--concat -->
<script src="<?php echo base_url('assets/frontend/js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
<!-- mixit up -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.mixitup.min.js') ?>"></script>
<?php if ($tabActive != 'contactus') { ?>
    <!-- fancybox -->
    <script src="<?php echo base_url('assets/frontend/plugin/jquery.fancybox.pack.js') ?>"></script>
<?php }
?>
<!-- easing -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.easing.min.js') ?>"></script>
<!-- video responsive script -->
<script src="<?php echo base_url('assets/frontend/plugin/jquery.fitvids.js') ?>"></script>
<!-- fancybox -->
<!--<script src="<?php // echo base_url('assets/frontend/js/jquery.fancybox.min.js')   ?>"></script>--> 
<!-- menuzord script -->
<script src="<?php echo base_url('assets/frontend/plugin/js/menuzord.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.countdown.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/js/jquery.scrollUp.js') ?>"></script> 


<!-- revolution scripts -->
<script src="<?php echo base_url('assets/frontend/revolution/js/jquery.themepunch.tools.min.js') ?>"></script>
<script src="<?php echo base_url('assets/frontend/revolution/js/jquery.themepunch.revolution.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.actions.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.carousel.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.migration.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.navigation.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.parallax.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/frontend/revolution/js/extensions/revolution.extension.video.min.js') ?>"></script>
<!-- thm custom script -->
<script src="<?php echo base_url('assets/frontend/js/custom.js') ?>"></script>

</body>

</html>