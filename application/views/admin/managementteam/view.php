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
                <table class="table">
                    <colgroup>
                        <col width="20%">
                        <col width="3%">
                        <col width="70%">
                    </colgroup>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td> : </td>
                            <td> <?php echo $get_info->name; ?>  </td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td> : </td>
                            <td>
                                <?php
                                if ($get_info->type == 'director') {
                                    echo 'Director';
                                } else {
                                    echo 'Member';
                                }
                                ?>  
                            </td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td> : </td>
                            <td> <?php echo $get_info->designation; ?>  </td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td> : </td>
                            <td> <?php echo $get_info->description; ?>  </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td> : </td>
                            <td><?php echo statusCheck($get_info->status); ?> </td>
                        </tr> 
                        <tr>
                            <td>Created Date</td>
                            <td> : </td>
                            <td> <?php echo!empty($get_info->created_datetime) ? longDateHuman($get_info->created_datetime, 'full') : ""; ?>  </td>
                        </tr>
                        <tr>
                            <td>Last Modified Date</td>
                            <td> : </td>
                            <td> <?php
                                if ($get_info->modified_datetime != '0000-00-00 00:00:00' && (!empty($get_info->modified_datetime))) {
                                    echo longDateHuman($get_info->modified_datetime, 'full');
                                } else {
                                    echo 'Not yet';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                $image = !empty($get_info->image_name) ? getMediaUrl('managementteam', 'thumbs', $get_info->image_name) : "";
                ?>
                <div class="gallery photo_preview">
                    <div class="thumbview">
                        <ul class="catPhotoSortable">
                            <li style="width: 27%">
                                <div class='thumb' style="width: 75%">
                                    <a title="" class="fancybox" href="<?php echo $image; ?>" data-fancybox-group="gallery">
                                        <img src='<?php echo $image; ?>' style="width: 200px; height: 150px;">
                                    </a>
                                </div><!--thumb-->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>