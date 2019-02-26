<!--Start slider-->     
<section class="home-section">
    <div id="slider1" class="rev_slider"  data-version="5.0">
        <ul>
            <?php
            if (count($banners)) {
                foreach ($banners as $banner) {
//                    stdClass Object
//                    (
//                        [id] => 1
//                        [title] => Power is the capacity of energy
//                        [sub_title] => While energy is 'joules', power is 'joules per second'. Well, in another words Power is 'watt' and Energy is 'watt-hour'. Another difference is that energy can be stored whereas power cannot be stored.
//                        [description] => Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage.
//                        [image_name] => 1534402758.jpg
//                        [status] => active
//                        [created] => 2018-07-19 17:57:46
//                        [modified] => 2018-08-16 12:59:19
//                    )
                    ?>
                    <li data-transition="fade">
                        <img src="<?php echo base_url('assets/media/banners/original/') . $banner->image_name ?>"  alt="" width="1920" height="1020" data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1" >

                        <div class="tp-caption tp-resizeme factory-founder"
                             data-x="left" data-hoffset="0" 
                             data-y="top" data-voffset="200" 
                             data-transform_idle="o:1;"         
                             data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
                             data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
                             data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" 
                             data-splitin="none" 
                             data-splitout="none"  
                             data-start="500">
                            <h2><?php echo $banner->title; ?></h2>
                        </div>
                        <div class="tp-caption tp-resizeme factory-founder"
                             data-x="left" data-hoffset="0" 
                             data-y="top" data-voffset="238"  
                             data-transform_idle="o:1;"                         
                             data-transform_in="x:[175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;" 
                             data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" 
                             data-mask_in="x:[-100%];y:0;s:inherit;e:inherit;" 
                             data-splitin="none" 
                             data-splitout="none" 
                             data-responsive_offset="on"
                             data-start="1500">
                            <h4><?php echo wordwrap($banner->sub_title, 80, "<br>\n"); ?></h4>
                            <div class="border"></div>
                        </div>
                        <div class="tp-caption tp-resizeme factory-founder" 
                             data-x="left" data-hoffset="0" 
                             data-y="top" data-voffset="360"  
                             data-transform_idle="o:1;"                         
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                             data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                             data-splitin="none" 
                             data-splitout="none" 
                             data-responsive_offset="on"
                             data-start="2000">
                            <p><?php echo wordwrap($banner->description, 200, "<br>\n"); ?></p>
                        </div>
                        <div class="tp-caption tp-resizeme factory-founder" 
                             data-x="left" data-hoffset="0" 
                             data-y="top" data-voffset="465"  
                             data-transform_idle="o:1;"                         
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                             data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                             data-splitin="none" 
                             data-splitout="none" 
                             data-responsive_offset="on"
                             data-start="3000">
                            <div><a class="button-1" href="<?php echo site_url('about') ?>">Know More</a></div>
                        </div>
                        <div class="tp-caption tp-resizeme factory-founder" 
                             data-x="left" data-hoffset="165" 
                             data-y="top" data-voffset="465"  
                             data-transform_idle="o:1;"                         
                             data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" 
                             data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"                     
                             data-splitin="none" 
                             data-splitout="none" 
                             data-responsive_offset="on"
                             data-start="3000">
                        </div>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</section>
<!--End slider -->

<!--Start service section-->  
<section class="service-section sec-pdd-90">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-2 col-md-xs-12"></div>            
            <div class="col-md-8 col-sm-8 col-md-xs-12">         
                <div class="service-title-2">
                    <h2>OUR PROJECT</h2>
                    <p><span class="border_dot"></span>What We Do For You<span  class="border_dot_right"></span></p>
                </div>
            </div>   
        </div>   

        <div class="row">
            <?php
            if (!empty($getProjectHome) && (count($getProjectHome))) {
                foreach ($getProjectHome as $project) {
                    $image = !empty($project->project_logo) ? getMediaUrl('projects', 'logo', $project->project_logo) : "";
                    ?>
                    <div class="col-md-4 col-sm-6 col-md-xs-12">
                        <div class="service-column item-margin-bot-60">
                            <div class="service-columnbox">
                                <img src="<?php echo $image ?>" alt="" width="370" height="300">
                                <div class="overlay" style="width: 370px;">
                                    <a href="<?php echo site_url('project-details/') . $project->project_id ?>">
                                        <h4 style="height: 42px;">
                                            <?php echo $project->project_title ?>
                                        </h4>
                                    </a>
                                    <p><?php echo substr($project->project_description, 0, 180) . '<a href="' . site_url('project-details/') . $project->project_id . '">show more..</a>' ?></p>
                                </div>
                            </div>
                            <div class="details"><a href="<?php echo site_url('project-details/') . $project->project_id ?>" class="theme-btn skew-btn"><span class="btn-text">View Details</span></a></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</section>   
<!--End service section--> 

<!--Start call to action section--> 
<section class="call-to-action">
    <div class="container-fluid ">
        <div class="row">
            <div class="col-md-6 joinr">
                <div class="fluid-img">
                    <img src="<?php echo base_url('assets/frontend/img/join/1.jpg') ?>" alt="">
                </div> 
            </div>
            <div class="col-md-6 col-sm-12 col-md-xs-12">
                <div class="free-consulting"> 
                    <div class="inner-content">
                        <div class="content">
                            <div class="about-us">
                                <h2>Doreen <span>Power  </span>Generations</h2>
                                <div class="border"></div>
                                <p class="margin-bot-30">consectetur adipiscing elit. Nulla convallis egestas rhoncus. Donec facilisis fermentum sem, ac viverra ante luctus vel. Lorem ipsum dolor sit amet.</p>
                                <div class="column row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="about-content item-margin-bot-20">
                                            <div class="icon-box flaticon-engineer"></div>
                                            <div class="box-content">
                                                <h4>Best Engineer</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="about-content item-margin-bot-30">
                                            <div class="icon-box flaticon-drawing-architecture-project-of-a-house"></div>
                                            <div class="box-content">
                                                <h4>Latest project</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="about-content item-margin-bot-30">
                                            <div class="icon-box flaticon-people-1"></div>
                                            <div class="box-content">
                                                <h4>quality service</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="about-content item-margin-bot-30">
                                            <div class="icon-box flaticon-mechanic"></div>
                                            <div class="box-content">
                                                <h4>Best worker</h4>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="view-button"><a class="button-1 margin-rit-30 mgn-rit-10" href="<?php echo site_url('about') ?>">Know More</a></div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</section>
<!--End Start call to action section-->

<!--Start team section-->
<section class="team-section-2 sec-pdd-90">
    <div class="container">
        <div class="section-title">
            <h2>Board of Directors </h2>
        </div>
        <div class="row">

            <?php
            if (!empty($boardOfDirectors) && (count($boardOfDirectors))) {
                foreach ($boardOfDirectors as $director) {

                    $directorImage = !empty($director->image_name) ? getMediaUrl('managementteam', 'thumbs', $director->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>

                    <!--Startsingle-team-member -->
                    <div class = "col-md-3 col-sm-6 col-xs-12 ">
                        <div class = "single-team-member itm-mgn-bot">
                            <div class = "img-holder">
                                <img src = "<?php echo $directorImage ?>" alt = "" class = "person-image">
                                <div class = "social-icons">
                                    <ul class = "list-inline">
                                        <li><a href = "<?php echo $director->facebook ?>"><i class = "fa fa-facebook"></i></a></li>
                                        <li><a href = "<?php echo $director->twitter ?>"><i class = "fa fa-twitter"></i></a></li>
                                        <li><a href = "<?php echo $director->google ?>"><i class = "fa fa-google-plus"></i></a></li>
                                        <li><a href = "<?php echo $director->skype ?>"><i class = "fa fa-skype"></i></a></li>
                                        <li><a href = "<?php echo $director->linkedin ?>"><i class = "fa fa-linkedin"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class = "content" style="height: 93px;">
                                <a href = "<?php echo site_url('profile/') . $director->id ?>">
                                    <h3 class = ""><?php echo $director->name ?></h3>
                                    <span><?php echo $director->designation ?></span>
                                </a>
                            </div>
                        </div> 
                    </div>
                    <!-- End single-team-member -->
                    <?php
                }
            }
            ?>
        </div>   
    </div>   
</section>  
<!--End team section-->

<!--Start contact section-->
<section class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 ">
                <div class="contact-image">
                    <figure><img src="<?php echo base_url('assets/frontend/img/resources/c1.png') ?>" alt=""></figure>
                </div>
            </div>  
            
            <div class="col-md-6 col-sm-12 col-xs-12 itm-mgn-bot-110">
               
                <form action="" method="POST" class="margin-top-100 rsp-m-t" id="sendContactRequest">
                    <div class="contact-area">
                        <h2>Send Message Us</h2>
                         <div id="showResult"></div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" class="form-control first_name"  placeholder="First name *">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="last_name" id="last_name" class="form-control last_name" placeholder="Last name *">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" name="email" id="email" class="form-control your_email"  placeholder="Your email *">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <input type="text" name="phone" id="phone" class="form-control your_email"  placeholder="Phone">
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
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
<!--End contact section-->

<script type="text/javascript">
    $(document).ready(function () {
        // validate reservation form on keyup and submit
        $("#sendContactRequest").validate({
            rules: {
                name: "required",
                last_name: "required",
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