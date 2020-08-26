<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_level') ?></h1>
            <small><?php echo 'Add New Level	' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_level') ?></li>
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
                            <h4><?php echo display('add_level') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Clocation/insert_level', array('class' => 'form-vertical')) ?>
                    <div class="panel-body">
						<div class="form-group row">
                            <label for="level_name" class="col-sm-3 col-form-label"><?php echo display('level_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="level_name" id="level_name" placeholder="<?php echo display('level_name') ?>" required/>
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
                                
                                    <option value="<?php echo $building['id']."###".$building['aisle_id']."###".$building['building_id']?>"><?php echo $building['slot_name']?></option>
                               
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
                                <input type="submit" id="add-level" class="btn btn-primary btn-large" name="add-level" value="<?php echo display('save') ?>"  />

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-level-another" class="btn btn-success" id="add-level-another" tabindex="7">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>



