<!--Start Slider area-->  
<section class="pag-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="pag-home text-center">
                    <h2>Our Project</h2>
                    <ul class="list-inline">
                        <li><a href="#">Home</a></li>
                        <li class="active">Project List</li>
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
            <h2>Our Project</h2>
            <p></p>
        </div>
        <div class="project-slider project-list">
            <div class="row">


                <?php
                if (!empty($allProject) && (count($allProject))) {
                    foreach ($allProject as $project) {
                        $projectImage = !empty($project->project_logo) ? getMediaUrl('projects', 'logo', $project->project_logo) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                        ?>
                        <div class="col-md-3">
                            <article class="slide-item">
                                <a href="<?php echo site_url('project-details/' . $project->project_id) ?>"> 
                                    <div class="slide-image">
                                        <figure>
                                            <img src="<?php echo $projectImage ?>" alt="">
                                            <div class="overlay">
                                                <div class="slide-content">
                                                    <p class="text">
                                                        <?php echo substr($project->project_description, 0, 180); ?>
                                                    </p>
                                                    <span class="read-more"><i class="fa fa-angle-double-right" aria-hidden="true"></i> read more</span>
                                                </div>
                                            </div>
                                        </figure>
                                    </div>
                                    <div class="info-box" style="height: 65px;">
                                        <h3><?php echo substr($project->project_title, 0, 33).'..' ?></h3>
                                    </div>
                                </a>    
                            </article> 
                        </div> 
                        <?php
                    }
                }
                ?>
            </div>
        </div>

    </div>    
</section>
<!--End project section-->