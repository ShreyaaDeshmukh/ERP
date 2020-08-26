<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_bin') ?></h1>
            <small><?php echo 'Add New Bin' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_bin') ?></li>
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
                            <h4><?php echo display('add_bin') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Clocation/insert_bin', array('class' => 'form-vertical')) ?>
                    <div class="panel-body">
						<div class="form-group row">
                            <label for="bin_name" class="col-sm-3 col-form-label"><?php echo display('bin_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="bin_name" id="bin_name" placeholder="<?php echo display('bin_name') ?>" required/>
                            </div>
                        </div>

						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Level<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="level_id" name="level_id" required="" required>
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                    if ($level_list) {
										foreach($level_list as $building):
                                ?>
                                
                                    <option value="<?php echo $building['id']."###".$building['slot_id']."###".$building['aisle_id']."###".$building['building_id']?>"><?php echo $building['level_name']?></option>
                               
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
                                <input type="submit" id="add-bin" class="btn btn-primary btn-large" name="add-bin" value="<?php echo display('save') ?>"/>

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-bin-another" class="btn btn-success" id="add-bin-another">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>



