<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />

<div class="row">
    <div class="col-lg-10">
        <?php if (!empty($error)): ?>
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="fa fa-times"></i>
                </button>
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <section class="panel">
            <header class="panel-heading">
                <?php echo!empty($director_id) ? 'Update : ' . (!empty($team_list->name) ? $team_list->name : "") : 'Add New Management Member'; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="col-lg-2 col-sm-2 control-label">Name<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="name" value="<?php echo!empty($team_id) ? $team_list->name : set_value('name'); ?>" placeholder="Name" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Type<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <select name="type" class="form-control">
                                <option value="director" <?php echo!empty($team_id && $team_list->type == 'director') ? 'selected' : ''; ?>>Board of Directors</option>
                                <option value="member" <?php echo!empty($team_id && $team_list->type == 'member') ? 'selected' : ''; ?>>Top Management</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Designation<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="designation" value="<?php echo!empty($team_id) ? $team_list->designation : set_value('designation'); ?>" placeholder="Designation" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Education</label>
                        <div class="col-lg-10">
                            <input type="text" name="education" value="<?php echo!empty($team_id) ? $team_list->education : set_value('education'); ?>" placeholder="Education" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Description</label>
                        <div class="col-lg-10">
                            <textarea name="description" placeholder="Description" class="form-control mceEditor"><?php echo!empty($team_id) ? $team_list->description : set_value('description'); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Facebook ID</label>
                        <div class="col-lg-10">
                            <input type="text" name="facebook" value="<?php echo!empty($team_id) ? $team_list->facebook : set_value('facebook'); ?>" placeholder="Facebook ID" class="form-control mceEditor" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Twitter ID</label>
                        <div class="col-lg-10">
                            <input type="text" name="twitter" value="<?php echo!empty($team_id) ? $team_list->twitter : set_value('twitter'); ?>" placeholder="Twitter ID" class="form-control mceEditor" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Google ID</label>
                        <div class="col-lg-10">
                            <input type="text" name="google" value="<?php echo!empty($team_id) ? $team_list->google : set_value('google'); ?>" placeholder="Google ID" class="form-control mceEditor" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Skype ID</label>
                        <div class="col-lg-10">
                            <input type="text" name="skype" value="<?php echo!empty($team_id) ? $team_list->skype : set_value('skype'); ?>" placeholder="Skype ID" class="form-control mceEditor" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Linkedin ID</label>
                        <div class="col-lg-10">
                            <input type="text" name="linkedin" value="<?php echo!empty($team_id) ? $team_list->linkedin : set_value('linkedin'); ?>" placeholder="Linkedin ID" class="form-control mceEditor" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Image<span class="req">*</span></label>
                        <?php
                        $teamImage = !empty($team_id) ? getMediaUrl('managementteam', 'original', $team_list->image_name) : 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
                        ?>
                        <div class="col-md-10">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="<?php echo $teamImage; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="team_image" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <br>
                                <span class="label label-danger">NOTE!</span><br><span> For best view please choose image size w: 1000px X h: 1100px.</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-lg-10">
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="active" <?php echo!empty($team_id) && $team_list->status == 'active' ? 'checked' : set_radio('status', 'active'); ?>> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($team_id) && $team_list->status == 'inactive' ? 'checked' : set_radio('status', 'inactive'); ?>> Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-block" name="submit" value="1"><?php echo isset($team_id) && !empty($team_list) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>




