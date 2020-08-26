<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo 'Add Aisle'; ?></h1>
            <small><?php echo "Add Aisle Information" ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo 'Add Aisle' ?></li>
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
                            <h4><?php echo display('add_aisle_location') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Caislelocation/insert_location', array('class' => 'form-vertical',)) ?>
                    <div class="panel-body">
						<div class="form-group row">
                            <label for="location_name" class="col-sm-3 col-form-label"><?php echo "Aisle Name" ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="location_name" id="location_name" placeholder="<?php echo "Aisle Name" ?>" required />
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Building<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="building_id" name="building_id" required="" required>
                                <option value=""><?php echo "Select Building" ?></option>
                                <?php
                                    if ($building_list) {
										foreach($building_list as $building):
                                ?>
                                
                                    <option value="<?php echo $building['id']?>"><?php echo $building['building_name']?></option>
                               
                                <?php
                                    endforeach;
									}
                                ?>
                                </select>
                            </div>
                        </div>
						
                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-location" class="btn btn-primary btn-large" name="add-location" value="<?php echo display('save') ?>"  />

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-location-another" class="btn btn-success" id="add-location-another" >
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



