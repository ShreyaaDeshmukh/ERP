<!-- Edit User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo 'Level Edit' ?></h1>
            <small><?php echo 'Level Edit' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo 'Level Edit' ?></li>
            </ol>
        </div>
    </section>

    <section class="content">

        <!-- Alert Message -->
        <?php
        $message = $this->session->userdata('message');
        if (isset($message)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('message');
        }
        $error_message = $this->session->userdata('error_message');
        if (isset($error_message)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error_message ?>                    
            </div>
            <?php
            $this->session->unset_userdata('error_message');
        }
        ?>

        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo 'Level Edit' ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Clocation/level_update', array('class' => 'form-vertical', 'name' => 'ef')) ?>

                    <div class="panel-body">
					    <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('level_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="level_name" value="<?php echo $locdata['level_name']; ?>"  placeholder="<?php echo display('level_name') ?>" required />
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Slot<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="slot_id" name="slot_id" required="" required>
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                    if ($slot_list) {
										foreach($slot_list as $building):
                                ?>
                                
                                    <option <?php if($building['id']==$locdata['slot_id']){?> selected="selected" <?php }?> value="<?php echo $building['id']."###".$building['aisle_id']."###".$building['building_id']?>"><?php echo $building['slot_name']?></option>
                               
                                <?php
                                    endforeach;
									}
                                ?>
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="level_id" value="<?php echo $locdata['id']; ?>" />

               


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-level" class="btn btn-success btn-large" name="add-level" value="<?php echo display('save_changes') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit user end -->

<script>
    document.forms['ef'].elements['status'].value = "<?php echo $status ?>";
</script>



