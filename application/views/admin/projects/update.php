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
                Edit 
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Manage</span></a>
                </span>
            </header>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">

                    <div class="clearfix"></div>

                    <div class="form-group col-lg-12">
                        <label class="control-label col-md-2">Logo Image<span class="req">*</span></label>
                        <?php
                        $imageLogo = !empty($allData->project_logo) ? getMediaUrl('projects', 'logo', $allData->project_logo) : "";
                        ?>
                        <div class="col-md-10">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                    <img src="<?php echo $imageLogo; ?>" alt="" />
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div>
                                    <span class="btn btn-white btn-file">
                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select Image</span>
                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                        <input type="file" class="default" name="project_logo"/>
                                    </span>
                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                </div>
                                <br>
                                <span class="label label-danger">NOTE!</span><br><span> For best view please choose image size w: 1000px X h: 1100px.</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-2 col-sm-2 control-label">Project Title<span class="req"> * </span></label>
                        <div class="col-lg-10">
                            <input type="text" name="project_title" value="<?php echo set_value('project_title', $allData->project_title); ?>" placeholder="Project Title" class="form-control" />
                        </div>
                    </div>
                    
                    <div class="form-group col-lg-12">
                        <label class="col-lg-2 col-sm-2 control-label">Project Description<span class="req"> * </span></label>
                        <div class="col-lg-10">
                            <textarea name="project_description" placeholder="Project Description" class="form-control mceEditor"><?php echo set_value('project_description', $allData->project_description); ?></textarea>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label class="col-lg-2 col-sm-2 control-label">Status</label>
                        <div class="col-lg-6">
                            <?php
                            $options = array(
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            );
                            echo form_dropdown('project_status', $options, set_value('project_status', $allData->project_status), array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Product Images (Multiple)<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="file" style="border:0px; height:auto; padding:0; background-color:unset; margin-bottom: 10px" name="project_images[]" value="" id="" multiple="multiple" onchange="readMultipleURL(this)">
                            <span class="label label-danger">NOTE!</span><span> For best view please upload image 1920px X 1200px.</span>
                            <br>
                            <div class="gallery photo_preview">
                                <div class="thumbview">
                                    <ul id="imageList"> </ul> 
                                    <?php
                                    if (!empty($allData)) {
                                        $photos = getAllMedia('media', $allData->project_id, $this->_module);
                                        ?>
                                        <?php if (!empty($photos)) { ?>
                                            <ul id="old_imageList" class="catPhotoSortable">                                    
                                                <?php foreach ($photos as $key => $photo) { ?>
                                                    <li id="order_<?php echo $photo->id; ?>" style="float:none; display: block; width: 100%;">
                                                        <div class="col-md-2" style="overflow: hidden; background: #fff; margin-bottom:10px;">
                                                            <div class='thumb' style="width:160px; overflow: hidden;float: left; background: #fff; padding: 5px; margin-right: 12px;">
                                                                <img src='<?php echo base_url($this->_moduleImagePath . 'small/' . $photo->images); ?>'>
                                                                <a class="delete_info" style="position: absolute;bottom: 6px; left: 5px;" href="<?php echo admin_url($this->_module . '/delete_photo/' . $photo->id . '/' . $photo->type_id); ?>" onclick="return confirm('Are you Sure??\nYou want to removed this photo!');">
                                                                    <span class="btn btn-danger btn-xs" title="Delete this photo"><i class="glyphicon glyphicon-remove"></i></span></a>
                                                                <p class="make_cover"><input type="radio" name='is_home' value='<?php echo $photo->id; ?>' <?php echo ($photo->is_home == 1) ? 'checked="checked"' : ''; ?>> Make Baner</p>
                                                            </div><!--thumb-->
                                                        </div>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="clear0"></div>
                                </div><!--gridview-->
                            </div>
                        </div>

                    </div>

                    <div class="form-group col-lg-12">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-danger" name="submit" value="1">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </section>
    </div>
</div>

<script type="text/javascript">

    var baseurl = "<?php echo base_url(); ?>";
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
                reader.onload = function (e) {
                    var html = "<div class='col-md-2' style='overflow: hidden; background: #fff; margin-bottom:10px;'>";
                    html += "<div class ='thumb' style='width:100%; overflow: hidden;float: left; background: #fff; padding: 5px; margin-right: 12px;'>";
                    html += "<img width='148' height='107' src=' " + e.target.result + " '>";
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


<script type="text/javascript">

    $(document).ready(function () {

        /*$("#address").blur(function() {
         address = $('#address').val();
         getAddress(address);
         });*/

        $("#address").keyup(function () {
            var address = $('#address').val();
            getAddress(address);
        });
    });
    function getAddress(address) {

        $('.show_loader').show(); // show loader

        $('#lat').val('');
        $("#lon").val('');
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: baseUrl + "doreenadmin/projects/getLatLongByAddress", // replace with your php file or class method
            data: {
                address: address
            },
            success: function (data) {

                if (data.status == 1) {
                    $('.show_loader').hide(); // hide loader
                    $('.ajax_err').hide(); // hide error

                    $('#lat').val(data.latitude);
                    $("#lon").val(data.longitude);
                } else {

                    $('.show_loader').hide(); // hide loader
                    //$('.ajax_err').hide(); // hide error

                    $('#lat').val('');
                    $("#lon").val('');
                    var errMsg = errorMsg(data.message);
                    $(".ajax_err").html(errMsg);
                }
            },
            error: function (data) {
                $('.show_loader').hide(); // hide loader
                //var errMsg = errorMsg("Unable get Lat or Long.");
                $(".ajax_err").html(data.message);
            }
        });
    }

    function errorMsg(message) {
        return '<span class="label label-danger">' + message + '</span>';
    }

</script>