<!-- Customer js php -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Product invoice js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_invoice.js.php" ></script>
<!-- Invoice js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/invoice.js" type="text/javascript"></script>

<!-- Add new invoice start -->
<style>
    #bank_info_hide
    {
        display:none;
    }
    #payment_from_2
    {
        display:none;
    }
</style>

<!-- Customer type change by javascript start -->
<script type="text/javascript">
    function bank_info_show(payment_type)
    {
        if(payment_type.value=="1"){
            document.getElementById("bank_info_hide").style.display="none";
        }
        else{ 
            document.getElementById("bank_info_hide").style.display="block";  
        }
    }
        
    function active_customer(status)
    {
        if(status=="payment_from_2"){
            document.getElementById("payment_from_2").style.display="none";
            document.getElementById("payment_from_1").style.display="block";
            document.getElementById("myRadioButton_2").checked = false;
            document.getElementById("myRadioButton_1").checked = true;
        }
        else{
            document.getElementById("payment_from_1").style.display="none";
            document.getElementById("payment_from_2").style.display="block";
            document.getElementById("myRadioButton_2").checked = false;
            document.getElementById("myRadioButton_1").checked = true;
        }
    }
</script>
<!-- Customer type change by javascript end -->

<!-- Add New Invoice Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_invoice') ?></h1>
            <small><?php echo display('add_new_invoice') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('new_invoice') ?></li>
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
        <!--Add Invoice -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_invoice') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cinvoice/insert_invoice',array('class' => 'form-vertical', 'id' => '','name' => ''))?>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-8" id="payment_from_1">
                                <div class="form-group row">
                                    <label for="customer_name" class="col-sm-3 col-form-label"><?php echo
                                     display('customer_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                       <input type="text" size="100"  name="customer_name" class="customerSelection form-control" placeholder='<?php echo display('customer_name') ?>' id="customer_name" tabindex="1" />

                                        <input id="SchoolHiddenId" class="customer_hidden_value" type="hidden" name="customer_id">
                                    </div>
                                    <div  class=" col-sm-3">
                                        <input id="myRadioButton_1" type="button" onClick="active_customer('payment_from_1')" id="myRadioButton_1" class="btn btn-success checkbox_account" name="customer_confirm" checked="checked" value="<?php echo display('new_customer') ?>" tabindex="2">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8" id="payment_from_2">
                               <div class="form-group row">
                                    <label for="customer_name_others" class="col-sm-3 col-form-label"><?php echo display('payee_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                       <input  autofill="off" type="text"  size="100" name="customer_name_others" placeholder='<?php echo display('payee_name') ?>' id="customer_name_others" class="form-control" />
                                    </div>

                                    <div  class="col-sm-3">
                                        <input  onClick="active_customer('payment_from_2')" type="button" id="myRadioButton_2" class="checkbox_account btn btn-success" name="customer_confirm_others" value="<?php echo display('old_customer') ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="customer_name_others_address" class="col-sm-3 col-form-label"><?php echo display('address') ?> </label>
                                    <div class="col-sm-6">
                                       <input type="text"  size="100" name="customer_name_others_address" class=" form-control" placeholder='<?php echo display('address') ?>' id="customer_name_others_address" />
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('date') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                       <?php date_default_timezone_set("Asia/Dhaka"); $date = date('Y-m-d'); ?>
                                        <input class="datepicker form-control" type="text" size="50" name="invoice_date" id="date" required value="<?php echo $date; ?>" tabindex="3" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="normalinvoice">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('available_ctn') ?></th>
                                        <th class="text-center"><?php echo display('cartoon') ?></th>
                                        <th class="text-center"><?php echo display('item') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?></th>
                                        <th class="text-center"><?php echo display('rate') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('discount') ?> </th>
                                        <th class="text-center"><?php echo display('total') ?> 
                                        </th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addinvoiceItem">
                                    <tr>
                                        <td style="width: 220px">
                                            <input type="text" name="product_name" onkeypress="invoice_productList(1);" class="form-control productSelection" placeholder='<?php echo display('product_name') ?>' required="" id="product_name" tabindex="4">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1" name="product_id[]" id="SchoolHiddenId"/>

                                            <input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
                                        </td>
                                        <td>
                                            <input type="text" name="available_quantity[]" class="form-control text-right available_quantity_1" value="" readonly="" />
                                        </td>
                                        <td>
                                            <input type="text" name="cartoon[]" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" class="quantity_1 form-control text-right" value="" min="1" tabindex="5" placeholder="0.00" />
                                        </td>
                                        <td>
                                            <input type="text" name="" class="ctnqntt_1 form-control text-right" readonly="" />
                                        </td>
                                        <td>
                                            <input type="text" name="product_quantity[]" class="total_qntt_1 form-control text-right" readonly=""  placeholder="0.00"/>
                                        </td>
                                        <td style="width: 85px">
                                            <input type="text" name="product_rate[]" value="" id="price_item_1" class="price_item1 price_item form-control text-right" tabindex="6" required="" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);"/>
                                        </td>
                                        <!-- Discount -->
                                        <td>
                                            <input type="text" name="discount[]" onkeyup="quantity_calculate(1);"  onchange="quantity_calculate(1);" id="discount_1" class="form-control text-right" value="" min="0" tabindex="7" placeholder="0.00"/>
                                        </td>
                                       
                                        <td style="width: 100px">
                                            <input class="total_price form-control text-right" type="text" name="total_price[]" id="total_price_1" value="" tabindex="-1" readonly="readonly" />
                                        </td>

                                        <td>
                                            <!-- Tax calculate start-->
                                            <input type="hidden" id="total_tax_1" class="total_tax_1" />
                                            <input type="hidden" id="all_tax_1" class="total_tax"/>
                                            <!-- Tax calculate end -->

                                            <!-- Discount calculate start-->
                                            <input type="hidden" id="total_discount_1" class="total_tax_1" />
                                            <input type="hidden" id="all_discount_1" class="total_discount"/>
                                            <!-- Discount calculate end -->

                                            <button style="text-align: right;" class="btn btn-danger" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    
                                    <tr>
                                        <td style="text-align:right;" colspan="7"><b><?php echo display('total_discount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="total_discount_ammount" class="form-control text-right" name="total_discount" tabindex="" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7"  style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="" class="form-control text-right" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item"  onClick="addInputField('addinvoiceItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="6"><b><?php echo display('paid_ammount') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="paidAmount" 
                                            onkeyup="invoice_paidamount();" class="form-control text-right" name="paid_amount" value="" placeholder='0.00' tabindex=""/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="submit" id="add-invoice" class="btn btn-success" name="add-invoice" value="<?php echo display('submit') ?>" tabindex=""/>

                                            <input type="button" id="full_paid_tab" class="btn btn-warning" name="" value="<?php echo display('full_paid') ?>" tabindex="" onClick="full_paid();"/>
                                        </td>

                                        
                                      
                                        <td style="text-align:right;" colspan="6"><b><?php echo display('due') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="dueAmmount" class="form-control text-right" name="due_amount" value="0.00" readonly="readonly"/>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Invoice Report End -->