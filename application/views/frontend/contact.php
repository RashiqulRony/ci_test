<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2>Contact Us</h2>
                    <ul class="list-inline">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <li class="active">Contact us</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Slider area-->

<!--Start blog-content area-->
<section class="contact_area sec-pdd-90">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 ">
                <div id="map" style="width: 100%; height:550px; position: relative; overflow: hidden;"></div>
                <div class="address_info itm-mgn-bot">
                    <div class="office_address">
                        <h2>Corporate Office</h2>
                        <?php if (count($address)) { ?>

                            <p>
                                <?php
                                echo implode('<br>', $address);
                                ?>
                            </p>

                        <?php }
                        ?>
                    </div>
                    <div class="contact_info">
                        <h2>Contact Info </h2> 
                        <p>
                            <span>Call Us : </span>
                            <?php
                            if (count($phone)) {
                                echo implode(', ', $phone);
                            }
                            ?>
                        </p>
                        <p><span>Mail Us : </span>
                            <?php
                            if (count($email)) {
                                echo implode(', ', $email);
                            }
                            ?>
                        </p>
                        <!--<p><span>Fax No : </span>+88-02-8614645</p>-->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">                
                <form action="" class="rsp-m-t" id="sendContactRequest" method="POST">
                    <div class="contact-area">
                        <h2>Leave your <span>message</span> here</h2>
                        <div id="showResult"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" class="form-control first_name"  placeholder="First name *">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="last_name" id="last_name" class="form-control last_name" placeholder="Last name *">
                            </div>
                            <div class="col-md-12 col-sm-12 col-md-xs-12">
                                <input type="text" name="email" id="email" class="form-control your_email"  placeholder="Your email *">
                            </div>
                            <div class="col-md-12 col-sm-12 col-md-xs-12">
                                <input type="text" name="phone" id="phone" class="form-control your_email"  placeholder="Phone">
                            </div>
                            <div class="col-md-12 col-sm-12 col-md-xs-12">
                                <input type="text" name="message" id="message" class="form-control your_message"  placeholder="your message">
                            </div>
                        </div>
                        <div class="submit-button">
                            <button type="submit" class="theme-btn normal-btn skew-btn" data-loading-text="Please wait..."><a><span class="btn-text">Send Message</span></a></button>
                        </div>
                    </div>
                </form>
            </div>
        </div> 
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        // validate reservation form on keyup and submit
        $("#sendContactRequest").validate({
            rules: {
                name: "required",
                last_name: "required",
                subject: "required",
                message: "required",
                phone: "required",
                email: {
                    required: true,
                    email: true
                },
            },
            submitHandler: function (form) {
                sendContactRequestAJAX(form);
                return false; // required to block normal submit since you used ajax
            }
        });
    });

</script>
<script type="text/javascript">
    var locations = [
<?php
if (!empty($getContact) && count($getContact) > 0) {
    getMapLocations($getContact);
}
?>
    ];
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 7,
//        center: new google.maps.LatLng(-33.865143, 151.209900),
        center: new google.maps.LatLng(-37.814, 144.96332),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow()
    var marker, i;
    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
</script>