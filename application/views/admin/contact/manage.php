<!--dynamic table-->
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_page.css'); ?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/admin/advanced-datatable/media/css/demo_table.css'); ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('assets/admin/jquery-ui/jquery-ui-1.9.2.custom.min.js'); ?>"></script>
<style>
    tbody.sortable tr{
        cursor: move;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <?php if ($this->session->flashdata('success_msg')) { ?>
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <?php echo $this->session->flashdata('success_msg'); ?>
            </div>
        <?php } ?>
        <section class="panel">

            <header class="panel-heading">
                Manage <?php echo $this->_module_name; ?>
                <span class="tools pull-right">
                    <a class="btn btn-info" href="<?php echo admin_url($this->_module); ?>"><span>Add New</span></a>
                </span>
            </header>

            <div class="panel-body">
                <div class="adv-table">
                    <table class="table table-bordered" id="hidden-table-infos">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">Type</th>
                                <th width="15%">Title</th>
                                <th width="20%">Address</th>
                                <th width="10%">Phone</th>
                                <th width="10%">E-mail</th>
                                <th width="5%">Lat</th>
                                <th width="5%">Lon</th>
                                <th width="10%">Status</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <?php
                            if (!empty($allData)) {
                                foreach ($allData as $key => $data) {
                                    ?>
                                    <tr class="gradeX">
                                        <td class="">
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo $key + 1; ?></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo!empty($data->office_type) ? $data->office_type : ""; ?></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><?php echo!empty($data->contact_title) ? $data->contact_title : ""; ?></a>
                                        </td>
                                        <td><?php echo!empty($data->contact_address) ? $data->contact_address : ""; ?></td>
                                        <td><?php echo!empty($data->phone) ? $data->phone : ""; ?></a></td>
                                        <td><?php echo!empty($data->email) ? $data->email : ""; ?></td>
                                        <td><?php echo!empty($data->lat) ? $data->lat : ""; ?></td>
                                        <td><?php echo!empty($data->lon) ? $data->lon : ""; ?></td>
                                        <td class="">
                                            <?php echo statusCheck($data->status); ?>
                                        </td>
                                        <td class="">
                                            <a class="btn btn-primary btn-xs" href="<?php echo admin_url($this->_module . '/index/' . $data->id) ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-danger btn-xs" onclick="return confirm('Do you really want to delete this item?!');" href="<?php echo admin_url($this->_module . '/delete/' . $data->id) ?>">
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
        </section>
    </div>
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
            <header class="panel-heading"><?php echo isset($contact_id) && !empty($contact) ? 'Modify' : 'Add'; ?> Contact</header>
            <div class="panel-body">

                <form class="form-horizontal" role="form" action="" method="post" enctype="multipart/form-data">


                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Title<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="contact_title" value="<?php echo!empty($contact) ? $contact->contact_title : set_value('contact_title'); ?>" placeholder="Enter Contact Title" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group" style="display: none;">
                        <label class="col-lg-2 col-sm-2 control-label">Type<span class="req">*</span></label>
                        <div class="col-lg-10">

                            <?php
                            $type = array(
                                'Corporate' => 'Corporate Office',
                                'Branch' => 'Branch Office',
                            );

                            echo form_dropdown('office_type', $type, !empty($contact) ? $contact->office_type : set_value('office_type'), array('class' => 'form-control'));
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Address<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="contact_address" id="contact_address" rows="6"><?php echo!empty($contact) ? $contact->contact_address : set_value('contact_address'); ?></textarea>
                        </div>
                        <div class="col-lg-3">
                            <div class="ajax_err"></div>
                        </div>
                    </div>                    

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Latitude<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="lat" id="lat" value="<?php echo!empty($contact) ? $contact->lat : set_value('lat'); ?>" placeholder="Latitude" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Longitude<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="lon" id="lon" value="<?php echo!empty($contact) ? $contact->lon : set_value('lon'); ?>" placeholder="Longitude" class="form-control" />
                        </div>
                    </div>                

                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Phone<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="phone" value="<?php echo!empty($contact) ? $contact->phone : set_value('phone'); ?>" placeholder="Enter Phone (Comma Separate)" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-2 col-sm-2 control-label">Email<span class="req">*</span></label>
                        <div class="col-lg-10">
                            <input type="text" name="email" value="<?php echo!empty($contact) ? $contact->email : set_value('email'); ?>" placeholder="Enter Email (Comma Separate)" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Status</label>
                        <div class="col-lg-10">
                            <label class="checkbox-inline">
                                <input checked="checked" type="radio" name="status" value="active" <?php echo!empty($contact) && $contact->status == 'active' ? 'checked' : set_radio('status', 'active'); ?>> Active
                            </label>
                            <label class="checkbox-inline">
                                <input type="radio" name="status" value="inactive" <?php echo!empty($contact) && $contact->status == 'inactive' ? 'checked' : set_radio('status', 'inactive'); ?>> Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-danger" name="submit" value="1"><?php echo isset($contact_id) && !empty($contact) ? 'Update' : 'Save'; ?></button>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </div>
</div>


<script type="text/javascript">

    $(document).ready(function () {

        /*$("#address").blur(function() {
         var address = $('#address').val();
         getAddress(address);
         });*/

        $("#contact_address").keyup(function () {
            var address = $('#contact_address').val();
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
            url: baseUrl + "raadmin/contact/getLatLongByAddress", // replace with your php file or class method
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