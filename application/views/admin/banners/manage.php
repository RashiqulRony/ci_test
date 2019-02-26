<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-sm-7">

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
                Manage <?php echo $this->_moduleName; ?>
            </header>
            <div class="panel-body">
                <div class="adv-table">
                    <table class="display table table-bordered" id="hidden-table-info">
                        <thead>
                            <tr>
                                <th class="text-center" width="15%">Image</th>
                                <th width="15%">Title</th>                                
                                <th width="15%">Sub Title</th>                                
                                <th>Description</th>                             
                                <th class="text-center" width="10%">Status</th>
                                <th class="text-center" width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            if (!empty($allData) && count($allData)) {
                                foreach ($allData as $key => $data) {

                                    $originalImage = !empty($data->image_name) ? getMediaUrl($this->_module . 's', 'original', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                    $thumbsImage = !empty($data->image_name) ? getMediaUrl($this->_module . 's', 'thumbs', $data->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                                    ?>
                                    <tr class="">
                                        <td class="text-center">
                                            <a class="fancybox" title="<?php echo!empty($data->title) ? $data->title : ""; ?>" href="<?php echo $originalImage; ?>" data-fancybox-group="gallery">
                                                <img src="<?php echo $thumbsImage; ?>" class="img-rounded thumb" height="50" />
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo $data->title; ?></a>
                                        </td>

                                        <td>
                                            <?php echo!empty($data->sub_title) ? limit_text($data->sub_title, 50) : ""; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo!empty($data->description) ? limit_text($data->description, 50) : ""; ?>
                                        </td>

                                        <td class="text-center">
                                            <?php echo statusCheck($data->status); ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-default btn-xs" title="Update" href="<?php echo admin_url($this->_module . '/' . 'index/' . $data->id) ?>"><i class="fa fa-pencil-square-o"></i></a>
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
    <div class="col-lg-5">

        <?php if (!empty($error)): ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <section class="panel">
            <header class="panel-heading"><?php echo isset($banner_id) && !empty($banner) ? 'Update : ' . (!empty($banner->title) ? $banner->title : "") : 'Add New Banner'; ?></header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="col-lg-2 col-sm-2 control-label">Title<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="title" value="<?php echo!empty($banner) ? $banner->title : set_value('title'); ?>" placeholder="Banner Title" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 col-sm-2 control-label">Sub Title<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="sub_title" value="<?php echo!empty($banner) ? $banner->sub_title : set_value('sub_title'); ?>" placeholder="Banner Sub Title" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Description</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="description" placeholder="Description" rows="4"><?php echo!empty($banner) ? $banner->description : set_value('description'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Image<span class="req">*</span></label>
                        <?php
                        $bannerImage = !empty($banner) ? getMediaUrl('banners', 'original', $banner->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                        ?>
                        <div class="col-md-10">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="<?php echo $bannerImage; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="banner_image" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <br>
                                <span class="label label-danger">NOTE!</span><br><span> For best view please choose image size w: 2250px X h: 1500px.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-lg-10">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($banner) && $banner->status == 'active' ? 'checked' : set_radio('status', 'active'); ?>> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($banner) && $banner->status == 'inactive' ? 'checked' : set_radio('status', 'inactive'); ?>> Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-block" name="submit" value="1"><?php echo isset($banner_id) && !empty($banner) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>




