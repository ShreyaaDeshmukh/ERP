<!-- Add Prerson start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('loan_edit') ?></h1>
            <small><?php echo display('loan_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('personal_loan') ?></a></li>
                <li class="active"><?php echo display('loan_edit') ?></li>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('loan_edit') ?> </h4>
                        </div>
                    </div>
                   <?php echo form_open_multipart('Csettings/update_loan/{per_loan_id}',array('class' => 'form-vertical','id' => 'inflow_entry' ))?>
                   <input type="hidden" name="per_loan_id" value="{per_loan_id}">
                    <div class="panel-body">

                    	   <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label"><?php echo display('name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="person_id" id="name">
                                   
                                    {person_id}
                                    <option value="{person_id}">{person_name}</option>
                                    {/person_id}
                                     <?php 
                                   if($seleceted_person_id){
                                ?>
                                        <option value="{seleceted_person_id}" selected>{per_loan_name}</option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label"><?php echo display('date') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control datepicker" name="date" id="date"   value="{date}" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="debit" class="col-sm-3 col-form-label"><?php echo display('debit') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                               <input type="number" class="form-control" name="debit" id="debit"  placeholder="<?php echo display('debit') ?>" value={debit} min="0"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="credit" class="col-sm-3 col-form-label"><?php echo display('credit') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                               <input type="text" class="form-control" name="credit" id="credit"  value="{credit}" placeholder="<?php echo display('date') ?>"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"><?php echo display('details') ?> <i class="text-danger"></i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="details" id="details" >{details}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                               
                                <input type="submit" id="add-deposit" class="btn btn-success" name="add-deposit" value="<?php echo display('save_change') ?>"/>
                            </div>
                        </div>

                       
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add Prerson end -->



