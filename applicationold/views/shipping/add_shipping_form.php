<!-- Add User start -->
<?php $r_id = $this->session->r_id; ?> 
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_shipping') ?></h1>
            <small><?php echo display('add_new_location_information') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_shipping') ?></li>
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
                            <h4><?php echo display('add_shipping') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cshipping/insert_shipping/'.$r_id, array('class' => 'form-vertical',)) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="shipping_name" class="col-sm-3 col-form-label"><?php echo display('shipping_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="1" class="form-control" name="shipping_name" id="shipping_name" placeholder="<?php echo display('shipping_name') ?>" required />
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-location" class="btn btn-primary btn-large" name="add-location" value="<?php echo display('save') ?>"  tabindex="6"/>

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-location-another" class="btn btn-success" id="add-location-another" tabindex="7">
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



