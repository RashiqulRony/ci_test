<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2>Photo Gallery</h2>
                    <ul class="list-inline">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <li class="active">Gallery List</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Slider area-->

<!--Start project section-->
<section class="project-section sec-pdd-90">
    <div class="container">
        <div class="service-title-2">
            <h2>Gallery</h2>
            <p></p>
        </div>
        <div class="project-slider project-list">
            <div class="row">

                <?php
                if (!empty($galleryList) && (count($galleryList))) {
                    foreach ($galleryList as $gallery) {
                        $coverImg = getGalleryCoverPhoto('gallery', 'small', $gallery->gallery_id);
                        ?>
                        <div class="col-md-3">
                            <article class="gallery-item">
                                <a href="<?php echo site_url('gallery-details/') . $gallery->gallery_id ?>"> 
                                    <div class="gallery-thumb">
                                        <img src="<?php echo $coverImg ?>" alt="">
                                        <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="gallery-info">
                                        <h3><?php echo $gallery->title ?> <span>(<?php echo sprintf("%02d", countAlbumPhoto($gallery->gallery_id)) ?>)</span></h3>
                                    </div>
                                </a>    
                            </article> 
                        </div>
                        <?php
                    }
                }
                ?>

                <div class="col-md-3">
                    <article class="gallery-item">
                        <a href="single-gallery.php"> 
                            <div class="gallery-thumb">
                                <img src="img/gallery/thumb/1.jpg" alt="">
                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                            </div>
                            <div class="gallery-info">
                                <h3>Power and Energy <span>(99)</span></h3>
                            </div>
                        </a>    
                    </article> 
                </div>


                <!--                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/2.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/3.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/4.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/5.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/6.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/7.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>
                                <div class="col-md-3">
                                    <article class="gallery-item">
                                        <a href="single-gallery.php"> 
                                            <div class="gallery-thumb">
                                                <img src="img/gallery/thumb/8.jpg" alt="">
                                                <span class="gallery-hover"><i class="fa fa-link" aria-hidden="true"></i></span>
                                            </div>
                                            <div class="gallery-info">
                                                <h3>Power and Energy <span>(99)</span></h3>
                                            </div>
                                        </a>    
                                    </article> 
                                </div>-->


            </div>
        </div>
    </div>    
</section>
<!--End project section-->