<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Add Mobile User</h1>
            <small><?php echo display('add_new_user_information') ?></small>
            <ol class="breadcrumb">
                <li><a href="/"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active">Add Mobile User</li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $data_msg = $this->session->userdata('data_msg');
        if (isset($data_msg)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $data_msg ?>                    
            </div>
            <?php } ?>
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
                            <h4>Add Mobile User</h4>
                         
                        </div>
                    </div>
                    <?php echo form_open_multipart('User/insert_user', array('class' => 'form-vertical','onSubmit' => 'return CheckValidation()')) ?>
                    <div class="panel-body">
                 
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="1" class="form-control" name="first_name" id="first_name" placeholder="<?php echo display('first_name') ?>" maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label"><?php echo display('last_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="2" class="form-control" name="last_name" id="last_name" placeholder="<?php echo display('last_name') ?>"  maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="email" tabindex="3" class="form-control" name="email" id="email" placeholder="<?php echo display('email') ?>" onkeyup="return ValidateEmail(this.value)" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label">Mobile <i class="text-danger">* eg. 111-111-2222</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="4" class="form-control" name="mobile" id="mobile" maxlength="10" placeholder="mobile" required="" minlength="10" />
                            </div>
                        </div>
                        <!--<div class="form-group row">-->
                        <!--    <label for="lic_key" class="col-sm-3 col-form-label">Lic key <i class="text-danger">*</i></label>-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <input type="number" tabindex="3" class="form-control" name="lic_key" id="lic_key" placeholder="Lic key " exact_length="12" required/>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">* Enter atleast 6 characters</i></label>
                            <div class="col-sm-6">
                                <input type="password" tabindex="5" class="form-control" id="password" pattern=".{6,10}" name="password" placeholder="<?php echo display('password') ?>" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="platform" class="col-sm-3 col-form-label">Platform<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="platform" id="platform" tabindex="5" required>
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="Web">Web</option>
                                    <option value="iOS">iOS</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div><script>	function CheckValidation(){			}		function ValidateEmail 	{	 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))	  {		$("#add-customer").removeAttr("disabled");		$("#add-customer-another").removeAttr("disabled");		return true;	  }		$("#add-customer").attr("disabled", "disabled");		$("#add-customer-another").attr("disabled", "disabled");		return (false)	}</script>
<!-- Edit user end -->

