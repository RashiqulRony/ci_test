<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/bootstrap-fileupload/bootstrap-fileupload.css'); ?>" />
<div class="row">
    <div class="col-lg-12">
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
                Add <?php echo $this->_moduleName; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-12 col-sm-12 control-label">Project Title<span class="req"> * </span></label>
                        <div class="col-lg-9">
                            <input type="text" name="project_title" value="<?php echo set_value('project_title'); ?>" placeholder="Project Title" class="form-control" />
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-12 col-sm-12 control-label">Project Description<span class="req"> * </span></label>
                        <div class="col-lg-9">
                            <textarea name="project_description" placeholder="Project Description"  class="form-control mceEditor"><?php echo set_value('project_description'); ?></textarea>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-12 col-sm-12 control-label">Logo<span class="req">*</span></label>
                        <?php
                        $bannerImage = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
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
                                        <input type="file" class="default" name="project_logo" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <br>
                                <span class="label label-danger">NOTE!</span><br><span> For best view please choose image size w: 500px X h: 600px.</span>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group col-lg-12">
                        <label class="col-lg-12 col-sm-12 control-label"><strong>Project Images (Multiple) <span class="req">*</span></strong></label>
                        <div class="col-lg-12">
                            <br>
                            <input type="file" style="border:0px; height:auto; padding:0; background-color:unset; margin-bottom: 10px" name="project_images[]" multiple="multiple" value="" id="" onchange="readMultipleURL(this)">
                            <span class="label label-danger">NOTE!</span><span> For best view please upload image 1920px X 1200px.</span>
                            <br>
                            <div class="gallery photo_preview">
                                <div class="thumbview">
                                    <br>
                                    <ul id="imageList"> </ul> 
                                    <div class="clear0"></div>
                                </div><!--gridview-->
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-lg-12">
                        <div class="col-lg-12 ">
                            <button type="submit" class="btn btn-danger" name="submit" value="1">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">
//For Multiple Image upload
                                function readMultipleURL(input) {
                                // show the loader
                                $('#loader').show();
                                var j = 0;
                                // removed the existing li
                                $('#imageList li').remove();
                                        for (var i = 0; i < input.files.length; i++) {
                                        if (input.files && input.files[i]) {
                                        var reader = new FileReader();
                                 reader.onload = function(e) {
                                var html = "<div class='col-md-2' style='overflow: hidden; background: #fff; margin-bottom : 10px;'>";
                                html += "<div class ='thumb' style='width:100%; overflow: hidden;float: left; background: #fff; padding: 5px; margin-right: 12px;'>";
                                html += "<img width='148' height='107' src=' " + e.target.result + " '>";
                                    html += "<p class='add_make_cover'><input type='radio' name='is_home' value='" + j + "'> Make Banner</p>";
                                        html += "</div><!--thumb-->";
                html += "</div>";
                $('#imageList').append(html);

                j++;
            };
            reader.readAsDataURL(input.files[i]);
        }
    }

    $('#loader').show(0).delay(2000).hide(0);

}
</script>