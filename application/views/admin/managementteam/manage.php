<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-12">

        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?>

        <section class="panel">
            <header class="panel-heading">
                 <?php echo $pageTitle; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module . '/update'); ?>"><span>Add New</span></a>
                </span>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th class="text-center" width="10%">Image</th>
                                <th width="20%">Name</th>                                
                                <th width="15%">Designation</th> 
                                <th width="10%">TYpe</th> 
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            if (!empty($allData) && count($allData)) {
                                foreach ($allData as $key => $data) {

                                    $originalImage = !empty($data->image_name) ? getMediaUrl($this->_module, 'original', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                    $thumbsImage = !empty($data->image_name) ? getMediaUrl($this->_module, 'thumbs', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                    ?>
                                    <tr class="">
                                        <td class="text-center">
                                            <a class="fancybox" title="<?php echo!empty($data->name) ? $data->name : ""; ?>" href="<?php echo $originalImage; ?>" data-fancybox-group="gallery">
                                                <img src="<?php echo $thumbsImage; ?>" class="img-rounded thumb" height="50" />
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo $data->name; ?></a>
                                        </td>
                                        <td>
                                            <?php echo $data->designation; ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($data->type == 'ceo') {
                                                echo 'CEO';
                                            } elseif ($data->type == 'senior_management') {
                                                echo 'Senior Management';
                                            } else {
                                                echo 'Team Member';
                                            }
                                            ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo statusCheck($data->status); ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-success btn-xs" href="<?php echo admin_url($this->_module . '/view/' . $data->id); ?>"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-default btn-xs" title="Update" href="<?php echo admin_url($this->_module . '/' . 'update/' . $data->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
                                            <a class="btn btn-danger btn-xs" title="Delete" onclick="return confirm('Do You Want To Delete this item!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pull-right">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </section>
    </div>
</div>




