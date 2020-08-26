<!-- Edit User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo 'Slot Edit' ?></h1>
            <small><?php echo 'Slot Edit' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo 'Slot Edit' ?></li>
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
                            <h4><?php echo 'Slot Edit' ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Clocation/slot_update', array('class' => 'form-vertical', 'name' => 'ef')) ?>

                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label"><?php echo display('slot_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="slot_name" value="<?php echo $locdata['slot_name']; ?>"  placeholder="<?php echo display('slot_name') ?>" required />
                            </div>
                        </div>

						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Aisle Location<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="aisle_id" name="aisle_id" required="" required>
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                    if ($aisle_list) {
										foreach($aisle_list as $aisle):
                                ?>
                                
                                    <option <?php if($aisle['id']==$locdata['aisle_id']){?> selected="selected" <?php }?> value="<?php echo $aisle['id']."###".$aisle['building_id']?>"><?php echo $aisle['location_name']?></option>
                               
                                <?php
                                    endforeach;
									}
                                ?>
                                </select>
                            </div>
                        </div>
                        

                        <input type="hidden" name="slot_id" value="<?php echo $locdata['id']; ?>" />

               


                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-slot" class="btn btn-success btn-large" name="add-slot" value="<?php echo display('save_changes') ?>" />
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



