<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>
<style type="text/css">
    .close{color:white;}
</style>

<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_receipt') ?></h1>
            <small><?php echo display('add_new_purchase') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('receipt') ?></a></li>
                <li class="active"><?php echo display('add_receipt') ?></li>
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
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('purchase_order') ?></h4>
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('Creceipt/insert_receipt',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
                        
                        <div class="row">
                            <div class="col-sm-5">
                                
                            </div>
                            <div class="col-sm-7">
                                <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('receipt_order_number') ?> 
                                </label>
                                :
                                <?php echo  $purchase_id = date('YmdHis');?>
                                <input type="hidden" name="receipt_id" value="<?php echo $purchase_id?>">
                            </div>
                        </div> 
                        <br/><br/>       
                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('supplier') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                        <select name="supplier_id" id="supplier_sss" class="form-control " required=""  tabindex='1' onchange="getSupplierNameAddress(this.value)"> 
                                            <option value=" "><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/all_supplier}
                                        </select>
                                    </div>

                                    <!--<div class="col-sm-3">
                                        <a href="<?php //echo base_url('Csupplier'); ?>"><?php //echo display('add_supplier') ?></a>
                                    </div>-->
                                </div> 

                                 <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div>
                                            <span><b>Vendor Name: </b></span>
                                            <span id="vendor_name"></span>
                                        </div>
                                        <div>
                                            <span><b>Vendor Address: </b></span>
                                            <span id="vendor_address"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--new modification by rizwan -->
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('customer') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                       <select name="customer_id" id="customer_sss" class="form-control " required=""  tabindex='1' onchange="getCustomerNameAddress(this.value)"> 
                                            <option value=" "><?php echo display('select_one') ?></option>
                                            {all_customer}
                                            <option value="{customer_id}">{customer_name}</option>
                                            {/all_customer}
                                        </select>
                                    </div>
                                   <!-- <div class="col-sm-2">
                                        <a href="<?php //echo base_url('Ccustomer'); ?>"><?php //echo display('add_customer') ?></a>
                                    </div>-->
                                </div>
                               <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div>
                                            <span><b>Customer Name: </b></span>
                                            <span id="customer_name"></span>
                                        </div>
                                        <div>
                                            <span><b>Ship To: </b></span>
                                            <span id="customer_address"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="receipt_details" value="">
                            <!-- new modification by rizwan -->
                              <?php /*<div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('purchase_date') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="purchase_date" value="<?php echo $date; ?>" id="date" required  tabindex='2'/>
                                    </div>
                                </div>
                            </div> */?>
                        </div>

                        <div class="row table-responsive">
                             <table class="table">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Ship Date</th>
                                <th>Customer PO</th>
                                <th>Ship Method</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                    <?php $date = date('Y-m-d'); ?>
                                        <input type="text" tabindex="2" class="form-control datepicker" name="receipt_date" value="<?php echo $date; ?>" id="receipt_date" required  tabindex='2'/>
                                    </td>
                                <td>
                                    <input type="text" tabindex="2" class="form-control datepicker" name="ship_date" value="<?php echo $date; ?>" id="ship_date" required  tabindex='2'/>
                                </td>
                                <td>
                                     <input type="text" tabindex="2" class="form-control" name="customer_po" value="" id="customer_po" required  tabindex='2'/>
                                </td>
                                <td>
                                   <!-- <input type="text" tabindex="2" class="form-control" name="ship_method" value="" id="ship_method" required  tabindex='2'/>-->
								   
								    <select name="ship_method[]" id="ship_method" class="form-control " required="true"  tabindex='1'  multiple="multiple"> 
                                            <option value=""><?php echo display('select_one') ?></option>
                                            {all_shipping}
                                            <option value="{id}">{shipping_name}</option>
                                            {/all_shipping}
                                        </select>
                                </td>
                                </tr>
                            </tbody>
                          </table>
                            
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                       <!-- <th class="text-center"><?php echo display('stock_ctn') ?></th>-->
                                        <!--<th class="text-center"><?php echo display('cartoon') ?> <i class="text-danger">*</i></th>-->
                                       <!-- <th class="text-center"><?php echo display('item_cartoon') ?> </th>-->

                                        <th class="text-center"><?php echo display('description') ?> </th>
                                        <th class="text-center"><?php echo display('quantity') ?> </th>
                                        <th class="text-center"><?php echo display('rate') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier">
                                            <?php echo display('please_select_supplier') ?>
                                            <!-- <select class="form-control supplier"></select> -->
                                        </td>

                                        <!--<td>
                                            <input type="text" id="" class="form-control text-right stock_ctn_1" placeholder="<?php echo display('stock_ctn') ?>" readonly/>
                                        </td>

                                        <td class="text-right">
                                            <input type="text" name="cartoon[]"  required  id="qty_item_1" class="form-control text-right qty_calculate" placeholder="0.00" value="" min="0" tabindex="6"/>
                                        </td>

                                        <td class="text-right">   
                                            <input type="text" name="cartoon_item[]" value="" readonly="readonly" id="ctnqntt_1" class="form-control ctnqntt1 text-right" placeholder="<?php echo display('item_cartoon') ?>"/>
                                        </td>-->
                                             <input type="hidden" name="cartoon_item[]" value="" readonly="readonly" id="ctnqntt_1" class="form-control ctnqntt1 text-right" placeholder="<?php echo display('item_cartoon') ?>"/>
                                         <input type="hidden" name="cartoon[]"  required  id="qty_item_1" class="form-control text-right qty_calculate" placeholder="0.00" value="" min="0" tabindex="6"/>
                                     
                                        <td class="text-right">
                                               <input type="text" name="description[]" value="" readonly="readonly" id="description_1" class="form-control description1 text-right" placeholder="<?php echo display('description') ?>"/> 
                                        </td>

                                        <td class="text-right">
                                            <input type="text" name="product_quantity[]" id="total_qntt_1" class="form-control qty_calculator text-right" placeholder="0.00" />
                                        </td>
                                        <td class="">
                                            <input type="text" name="product_rate[]"   readonly="readonly" onkeyup="quantity_calculate(1);" onchange="quantity_calculate(1);" id="price_item_1" class="form-control price_item1 text-right" placeholder="0.00" value="" min="0" tabindex="7"/>
                                        </td>
                                        <td class="text-right">
                                            <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" tabindex="-1" readonly="readonly" />
                                        </td>
                                        <td>
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addPurchaseInputField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>" tabindex="9"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="3"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="-1" class="text-right form-control" name="grand_total_price" tabindex="-1" value="0.00" readonly="readonly" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-receipt" class="btn btn-primary btn-large" name="add-receipt" value="<?php echo display('submit') ?>" tabindex="10"/>
                                <input type="submit" value="<?php echo display('submit_and_add_another') ?>" name="add-receipt-another" class="btn btn-large btn-success" id="add-receipt-another" tabindex="11">
                            </div>
                        </div>
                    <?php echo form_close()?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Purchase Report End -->

<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>

<!-- JS -->
<script type="text/javascript">
   $('body').on('change','#supplier_sss',function(event){
        event.preventDefault(); 
        var supplier_id=$('#supplier_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax({
            url: '<?php echo base_url('Creceipt/product_search_by_supplier')?>',
            type: 'post',
            data: {supplier_id:supplier_id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                $(".supplier").html(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
    });
    //Product select by ajax end

   // Product selection start
    $('body').on('change', '.productSelection', function(){
        var product_id = $(this).val();  
        var base_url = $('.baseUrl').val(); 
        var target = $(this).parent().parent().children().next().next().next().children();
        console.log(target);
        var item_description = $(this).parent().next().next().next().children();
        var item_description1 = $(this).parent().next().next().next().next().next().children();
        var stock = $(this).parent().next().children();
        var thisone = $(this);
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cinvoice/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
                //console.log(obj);
                //target.val(obj.supplier_price);
                //rate.val(obj.supplier_price);
                //console.log(thisone.parent().parent().children().html());
                //stock.val(obj.supplier_price);
                item_description1.val(obj.supplier_price);
                item_description.val(obj.product_information.product_details);
                //alert(obj.total_product);
                //stock.val(obj.total_product);

                //var cartoon = $('.qty_calculate').val();
                //var item = $('.qty_calculate').parent().next().children().val();

                //console.log(cartoon);
                //console.log(item);
                // set quantity
                //$(this).find('.qty_calculate').val(cartoon * item);
                //alert($(this).find('.qty_calculate').val());
                //$('.qty_calculate').parent().next().next().children().val(cartoon * item);
                //$('.qty_calculate').parent().next().next().children().val(obj.product_information.product_details);

                ///var rate = $('.qty_calculate').val();
                //alert(rate);
                //set total
                ///$('.qty_calculate').parent().next().next().next().next().children().val(rate * cartoon * item);
               // calculateSum();
            } 
        });
    });
    //Product selection end
</script>


