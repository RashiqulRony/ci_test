<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2><?php echo $boardOfDirectors->name; ?></h2>
                    <ul class="list-inline">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <li><a href="<?php echo site_url('management') ?>">Management</a></li>
                        <li class="active">Profile Details</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Slider area-->

<!-- Section engineers-details -->
<section class="engineers-details sec-pdd-90">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-8 col-sm-7 col-xs-12  ">
                    <div>
                        <h3>
                            <?php echo $boardOfDirectors->name; ?>
                        </h3>
                        <h5 class="text-thm"><?php echo $boardOfDirectors->designation; ?></h5>
                        <?php if (!empty($boardOfDirectors->education))  ?>
                        <h5 class="text-thm"><?php echo $boardOfDirectors->education; ?></h5>

                        <p style="text-align: justify"><?php echo $boardOfDirectors->description; ?></p>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5 col-sx-12">

                    <?php
                    $profileImage = !empty($boardOfDirectors->image_name) ? getMediaUrl('managementteam', 'original', $boardOfDirectors->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>
                    <div class="doctor-thumb">
                        <img class="img-responsive" src="<?php echo $profileImage ?>" alt="">
                    </div>
                    <ul class="social-icon icon-thm text-center">
                        <li><a href="<?php echo $boardOfDirectors->facebook ?>"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?php echo $boardOfDirectors->twitter ?>"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?php echo $boardOfDirectors->google ?>"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="<?php echo $boardOfDirectors->skype ?>"><i class="fa fa-skype"></i></a></li>
                        <li><a href="<?php echo $boardOfDirectors->linkedin ?>"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>