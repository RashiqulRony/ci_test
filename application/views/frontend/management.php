<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2>Our Management</h2>
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li class="active">Our Management</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Slider area-->

<!--Start team section-->
<section class="team-section sec-pdd-90-50">
    <div class="container">
        <div class="section-title">
            <h2 class="color-00">Board of Directors</h2>
        </div>
        <div class="row">

            <?php
            if (!empty($boardOfDirectors) && (count($boardOfDirectors))) {
                foreach ($boardOfDirectors as $director) {

                    $directorImage = !empty($director->image_name) ? getMediaUrl('managementteam', 'thumbs', $director->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>
                    <!--Start single  item-->
                    <div class="col-md-6 col-sm-12 col-xs-12 ">
                        <div class="team-mamber item-margin-bot-60 rsp-pdd">
                            <div class="team-image">
                                <img src="<?php echo $directorImage ?>" alt="">
                            </div>
                            <div class="team-content">
                                <div class="team-text">
                                    <a href="<?php echo site_url('profile/') . $director->id ?>">
                                        <h2><?php echo $director->name ?></h2>
                                    </a>
                                    <h6><?php echo $director->designation ?></h6>
                                    <p style="text-align: justify"><?php echo substr($director->description, 0, 150) . '...' ?></p>
                                </div>
                                <div class="social-link">
                                    <ul>
                                        <?php if ($director->facebook != NULL && (!empty($director->facebook))) { ?>
                                            <li><a href="<?php echo $director->facebook ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <?php
                                        }
                                        ?>
                                        <?php if ($director->twitter != NULL && (!empty($director->twitter))) { ?>
                                            <li><a href="<?php echo $director->twitter ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <?php
                                        }
                                        ?>
                                        <?php if ($director->google != NULL && (!empty($director->google))) { ?>
                                            <li><a href="<?php echo $director->google ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                            <?php
                                        }
                                        ?>
                                        <?php if ($director->skype != NULL && (!empty($director->skype))) { ?>
                                            <li><a href="<?php echo $director->skype ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                            <?php
                                        }
                                        ?>
                                        <?php if ($director->linkedin != NULL && (!empty($director->linkedin))) { ?>
                                            <li><a href="<?php echo $director->linkedin ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                                <div class="team-button">
                                    <a href="<?php echo site_url('profile/') . $director->id ?>" class="theme-btn skew-btn"><span class="btn-text">View Details</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End single  item-->  
                    <?php
                }
            }
            ?>
        </div>    
    </div>
</section>       
<!--End Start team section-->

<!--Start team section-->
<section class="team-section-2 sec-pdd-90-50 management-list color-f7f7f7">
    <div class="container">
        <div class="section-title">
            <h2 class="color-00">Top Management</h2>
        </div>
        <div class="row">

            <?php
            if (!empty($topManagement) && (count($topManagement))) {
                foreach ($topManagement as $management) {
                    $managementImage = !empty($management->image_name) ? getMediaUrl('managementteam', 'thumbs', $management->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                    ?>

                    <!-- Startsingle-team-member -->
                    <div class="col-md-3 col-sm-6 col-xs-12 ">
                        <div class="single-team-member itm-mgn-bot">
                            <div class="img-holder">
                                <img src="<?php echo $managementImage ?>" alt="" class="person-image">


                                <?php
                                if ($management->facebook || $management->twitter || $management->google || $management->skype || $management->linkedin) {
                                    echo '<div class="social-icons">';
                                }
                                ?>

                                <ul class="list-inline">
                                    <?php if ($management->facebook != NULL && (!empty($management->facebook))) { ?>
                                        <li><a href="<?php echo $director->facebook ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if ($management->twitter != NULL && (!empty($management->twitter))) { ?>
                                        <li><a href="<?php echo $director->twitter ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if ($management->google != NULL && (!empty($management->google))) { ?>
                                        <li><a href="<?php echo $management->google ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if ($management->skype != NULL && (!empty($management->skype))) { ?>
                                        <li><a href="<?php echo $director->skype ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                    <?php if ($management->linkedin != NULL && (!empty($management->linkedin))) { ?>
                                        <li><a href="<?php echo $management->linkedin ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>

                                <?php
                                if ($management->facebook || $management->twitter || $management->google || $management->skype || $management->linkedin) {
                                    echo '</div>';
                                }
                                ?>

                            </div>
                            <div class="content" style="height: 140px;">
                                <?php if ($management->description != NULL && (!empty($management->description))) { ?>
                                    <a href="<?php echo site_url('profile/') . $management->id ?>">
                                    <?php } else { ?>
                                        <a href="javascript:void(0)">
                                        <?php } ?>
                                        <h3 class=""><?php echo $management->name ?></h3>
                                        <span>
                                            <?php echo $management->designation ?><br/>
                                            <?php echo $management->education ?>
                                        </span>
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