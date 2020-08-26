<!--Edit customer start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('account_edit') ?></h1>
            <small><?php echo display('account_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('account') ?></a></li>
                <li class="active"><?php echo display('account_edit') ?></li>
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

        <!-- New account -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('edit_account') ?></h4>
                        </div>
                    </div>
                  <?php echo form_open('Account_Controller/account_update',array('class' => 'form-vertical', 'id' => 'add_account'))?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label"><?php echo display('account_name') ?><i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="account_name" id="account_name" type="text" placeholder="Account Name"  required="" value="{account_name}">
                            </div>
                           
                        </div>
                       
                       <div class="form-group row">
                            <label for="parent_id" class="col-sm-3 col-form-label"><?php echo display('root_account') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-9">
                                <input class="form-control" name ="parent_id" id="parent_id" type="text" placeholder="Parent Name"  value="{parent_id}">
                            </div>
                            </div>
                            
                    
                        <input type="hidden" value="{account_id}" name="account_id">

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-Account" class="btn btn-success btn-large" name="add-Account" value="<?php echo display('save_changes') ?>" />
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit customer end -->



