<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2>Photo Gallery</h2>
                    <ul class="list-inline">
                        <li><a href="<?php echo site_url() ?>">Home</a></li>
                        <li><a href="<?php echo site_url('gallery') ?>">Gallery</a></li>
                        <li class="active">Gallery View</li>
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
            <h2><?php echo $galleryDetails ? $galleryDetails->title : 'N/A' ?></h2>
            <p></p>
        </div>
        <div class="project-slider project-list">
            <div class="row">

                <?php
                if (!empty($galleryDetails)) {

//                    $imgList = getMediaAll('media', $galleryDetails->gallery_id);
                    $imgList = getAllMedia('media', $galleryDetails->gallery_id, 'gallery');
                    
                    if (count($imgList)) {
                        foreach ($imgList as $img) {
                            ?>
                            <div class="col-md-3">
                                <article class="gallery-item">
                                    <a data-fancybox="gallery" class="image-popup" href="<?php echo base_url('assets/media/gallery/large/') . $img->images ?>">  
                                        <div class="gallery-thumb">
                                            <img src="<?php echo base_url('assets/media/gallery/small/') . $img->images ?>" alt="">
                                            <span class="gallery-hover"><i class="fa fa-search-plus" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="gallery-info">
                                            <h3><?php echo $img->title ?></h3>
                                        </div>
                                    </a>    
                                </article> 
                            </div>
                            <?php
                        }
                    }
                }
                ?>
            </div>
        </div>

    </div>    
</section>
<!--End project section-->