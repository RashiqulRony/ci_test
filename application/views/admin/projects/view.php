<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                <?php echo $pageTitle; ?>
                <span class="tools pull-right">
                    <a class="iconlink btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <?php
                $image = !empty($get_info->project_logo) ? getMediaUrl('projects', 'logo', $get_info->project_logo) : "";
                ?>
                <table class="table">
                    <colgroup>
                        <col width="20%">
                        <col width="3%">
                        <col width="70%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>Logo</td>
                            <td> : </td>
                            <td> <img src='<?php echo $image; ?>' style="height: 200px;width: 200px;"> </td>
                        </tr>
                        <tr>
                            <td>Title</td>
                            <td> : </td>
                            <td> <?php echo!empty($get_info->project_title) ? $get_info->project_title : "n/a"; ?>  </td>
                        </tr>

                        <tr>
                            <td>Description</td>
                            <td> : </td>
                            <td> <?php echo!empty($get_info->project_description) ? $get_info->project_description : "n/a"; ?>  </td>
                        </tr>

                        <tr>
                            <td>Status</td>
                            <td> : </td>
                            <td> <?php echo statusCheck($get_info->project_status); ?>  </td>
                        </tr>

                        <tr>
                            <td>Created</td>
                            <td> : </td>
                            <td> <?php echo longDateHuman($get_info->created_at, 'full'); ?>  </td>
                        </tr>

                        <tr>
                            <td>Modified</td>
                            <td> : </td>
                            <td>
                                <?php
                                if ($get_info->modified_at == '0000-00-00 00:00:00') {
                                    echo 'Not updated yet';
                                } else {
                                    echo longDateHuman($get_info->modified_at, 'full');
                                }
                                ?>  
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                $photos = getAllMedia('media', $get_info->project_id, $this->_module);
                if (!empty($photos)) {
                    ?>
                    <h4>Project Images</h4>
                    <div class="gallery photo_preview">
                        <div class="thumbview">
                            <ul class="catPhotoSortable">                                    
                                <?php foreach ($photos as $key => $photo) { ?>
                                    <li style="width: 15%">
                                        <div class='thumb' style="width: 100%">
                                            <a title="" class="fancybox" href="<?php echo base_url($this->_moduleImagePath . 'original/' . $photo->images); ?>" data-fancybox-group="gallery">
                                                <img src='<?php echo base_url($this->_moduleImagePath . 'thumbs/' . $photo->images); ?>' style="height: auto">
                                            </a>
                                        </div><!--thumb-->
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>
</div>