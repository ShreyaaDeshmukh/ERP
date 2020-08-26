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
            <h1><?php echo display('add_ticket') ?></h1>
            <small><?php echo display('add_new_ticket') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('ticket') ?></a></li>
                <li class="active"><?php echo display('add_ticket') ?></li>
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
           // $this->session->unset_userdata('message');
            }
            $error_message = $this->session->userdata('error_message');
            if (isset($error_message)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $error_message ?>                    
        </div>
        <?php 
           // $this->session->unset_userdata('error_message');
            }
        ?>

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <!-- <h4><?php echo display('purchase_order') ?></h4> -->
                        </div>
                    </div>

                    <div class="panel-body">
                    <?php echo form_open_multipart('Cticket/insert_ticket',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase', 'onsubmit' => 'return checkAllValues()'))?>
                        
                        <div class="row" hidden>
                            <div class="col-sm-5">
								 <label style="width:10%;" for="supplier_sss" class="col-sm-3 col-form-label"><?php echo "PT";//display('ticket_order_number') ?> 
                                </label>
                                : 
                                <?php echo  $purchase_id = "PT".rand(1000,9999);?>
                                <input type="hidden" name="ticket_id" value="<?php echo $purchase_id?>">
                            </div>
                            <div class="col-sm-7">
                               
                            </div>
                        </div> 
                        <br/><br/>       
                        <div class="row">
                            
                            <!--new modification by rizwan -->
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('customer') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6">
                                       <select name="customer_id" id="customer_sss" class="form-control dont-select-me" onchange="getCustomerNameAddress(this.value,1)" required> 
                                            <option value=""><?php echo display('select_one') ?></option>
                                            {all_customer}
                                            <option value="{customer_id}">{customer_name}</option>
                                            {/all_customer}
                                        </select>
                                    </div>
                                   <!-- <div class="col-sm-2">
                                        <a href="<?php echo base_url('Ccustomer'); ?>"><?php echo display('add_customer') ?></a>
                                    </div>-->
                                </div>
                               <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6" style="margin-left:50px;">
                                        <!-- <div>
                                            <span><b>Customer Name: </b></span>
                                            <span id="customer_name"></span>
                                        </div>
                                        <div>
                                            <span><b>Ship To: </b></span>
                                            <span id="customer_address"></span>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
							
							<div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="supplier_sss" class="col-sm-3 col-form-label"><?php echo display('ship_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-6 shipTo">
                                       <div class="maintextarea">
									  
										<!-- <select name="multipleAddress" id="multipleAddress" multiple="multiple">
										  
										</select> -->
										
											
											<select name="ship_to[]" id="multipleAddress" class="form-control" required="true" onchange="getShipAddress(this.value)"  multiple="multiple"> 
                                           
                                        </select>
											 
									   <!-- <textarea cols="30" rows="2" id = "ship_id" name="ship_to[]" class="form-control" required placeholder="Write Ship To Address" style="display:none"></textarea>
										<span style="float:right;right:-20px;top:-30px;" id="addShipTo" class="glyphicon glyphicon-plus plusicon"></span> -->
										</div>
										<div>
                                            <span><b>Ship To Address: </b></span>
                                            <span name="ship_to" id="ship_to_address"></span>
                                            <input type="hidden" name="sub" id="sub" >
                                            <input type="hidden" name="totalAddress" id="totalAddress" >
											<input type="hidden" name="shipName" id="shipName" >
                                        </div>  
                                    </div>

                                    <div class="col-sm-3">
                                        
                                    </div>
                                </div> 

                                 <!--<div class="row">
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
                                </div>-->
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
                                <th>Customer PO <i class="text-danger">*</i></th>
                                <th>Ship Method <i class="text-danger">*</i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                    <?php $date = date('Y-m-d'); ?>
                                        <input type="text" class="form-control datepicker" name="ticket_date" value="<?php echo $date; ?>" id="ticket_date" required readonly="true" />
                                    </td>
                                <td>
                                    <input type="text" class="form-control datepicker" name="ship_date" value="<?php echo $date; ?>" id="ship_date"  readonly="true" required />
                                </td>
								<td>
                                     <!-- <input type="text" class="form-control" name="customer_po" value="" id="customer_po" required/> -->
									 <select name="customer_po" id="customer_po" class="form-control" required="true"  multiple="multiple">
                                </td>
                                <td>
                                    
									 <select name="ship_method[]" id="ship_method" class="form-control"  multiple="multiple" required> 
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
						
						<div class="row">
							<div class="col-md-2">
								<!-- <label>Customer or Stock</label> -->
							</div>
							<div class="col-md-4">
								
								
								<label class="radio-inline typeflag"><input id="stockflag" type="radio" name="optradio"   value="s" onchange="checkthetypeflag(this.value, this);">Stock</label>
								<label class="radio-inline typeflag"><input id="customerflag" type="radio" name="optradio"  value="c" checked onchange="checkthetypeflag(this.value, this);">Customer</label>
								
							</div>
						</div>
                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th> 
                                       <!-- <th class="text-center"><?php echo display('stock') ?></th> -->
										
                                        <th class="text-center"><?php echo display('description') ?> </th>
                                        
										<th class="text-center">Inventory Qty <i class="text-danger">*</i></th>
										
										<th class="text-center"><?php echo display('location') ?><i class="text-danger">*</i></th>
										
                                        <th class="text-center">Each Quantity <i class="text-danger">*</i> </th>
										 
                                        <!-- <th class="text-center"><?php echo display('unit') ?> <i class="text-danger">*</i> </th>
										<th class="text-center"> Each Quantity<i class="text-danger">*</i> </th>
                                        <!-- <th class="text-center">Total Quantity</th>
                                        -->
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addTicketItem">
                                    <tr>
                                        <td class="span3 supplier">
                                            <?php echo display('please_select_customer') ?>
                                            <!-- <select class="form-control supplier"></select> -->
                                        </td>

                                        <td><textarea placeholder="<?php echo display('description') ?>" rows="4" cols="20" name="description[]"  readonly="readonly" id="description_1"
                                        class="description1" >
						
                        </textarea></td>

                                     
										
                                        <!-- <td class="text-right">
                                               <input type="text" name="description[]" value="" readonly="readonly" id="description_1" class="form-control description1 text-right" placeholder="<?php echo display('description') ?>"/> 
                                        </td> -->
										
										<td>
											<input type="text" id="stock" class="stock form-control" value="" readonly="readonly" required/>
										</td>
											<input type="hidden" value="" class="product_total_quantity">
                                             <input type="hidden" name="cartoon_item[]" value="" readonly="readonly" id="ctnqntt_1" class="form-control ctnqntt1 text-right" placeholder="<?php echo display('item_cartoon') ?>"/>
                                         <input type="hidden" name="cartoon[]"  required  id="qty_item_1" class="form-control text-right qty_calculate" placeholder="0.00" value="" min="0" />
                                        
                                        
                                       <!-- <td class="">
                                            <input type="number" name="product_rate[]"  id="price_item_1" class="form-control price_item1 text-right" placeholder="0.00" value="" min="0" tabindex="7"/>
                                        </td>-->
										
										<td class="text-right">
                                            <select class="form-control locations dont-select-me btnSelect" name="locations[]" required onchange="checkExpiry(this.value);">
											<option value=''>Select Location</option>
											</select>
                                        </td>
										
										<td class="text-right" hidden>
                                            <input type="number" name="unit_quantity[]" min="1" 
											id="unit_quantity_1" class="form-control unit_quantity text-right" placeholder="0"   step="1"	/>
                                             
                                        </td>
                                        
                                        <td class="unitselect" hidden>
											<select name="unit[]" class="form-control unitquantity dont-select-me" >
                                                <!-- <option value="">Select</option> -->
                                                <option value="EACH">EACH</option>
                                                <option value="INNER_CART">INNER CART</option>
                                                <option value="CARTON">CARTON</option>
                                                <option value="PALLET">PALLET</option>
                                            </select>
										</td>	
										<td class="text-right">
                                            <input type="number" name="each_quantity[]" min="1" 
											 id="each_quantity_1" class="form-control each_quantity text-right" placeholder="0"  required step="1"	/>
                                             
                                        </td>


                                        
										<td class="text-right" hidden>
										<input type="number" name="total_quantity[]"   min="1" id="total_quantity_1" class="form-control total_quantity text-right" placeholder="0" step="1"	/>
                                            
                                        </td>
                                        <td>
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)" ><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addTicketInputField('addTicketItem');" value="<?php echo display('add_new_item') ?>"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <!--<td style="text-align:right;" colspan="3"><b><?php echo "Total Items" ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" tabindex="-1" class="text-right form-control" name="grand_total_price" tabindex="-1" value="0.00" readonly="readonly" />
                                        </td>-->
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
						<div class="form-group row">
                            <div class="col-sm-4">
                                <input type="submit" id="add-ticket" class="btn btn-primary btn-large" name="add-ticket" value="<?php echo display('submit') ?>" />
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-ticket-another" class="btn btn-large btn-success" id="add-ticket-another">
                            </div>
							<div class="col-sm-3">
								<div class="errorhandler"></div>
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



<script type="text/javascript">
function checkExpiryQty(thisval,value){
	console.log(value);
	console.log("value");
	console.log(thisval);
}



	function checkExpiry(value){
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		$.ajax({
            url: '<?php echo base_url('Cticket/checkExpiry')?>',
            type: 'post',
            data: {location:value,csrf_test_name:csrf_test_name, product_id:$("#product_id").val()}, 
            success: function (msg){
                //$(".supplier").html(msg);
				var result = JSON.parse(msg);
				console.log(result);
				if(result.status=="false"){
					console.log("result "+result);
					
					var r = confirm(result.msg);
					if (r == true) {
					  return true;
					} else {
					 return true;
					}
				}else{
					return true;
				}
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        }); 
	}
	function checkthetypeflag(value, thisone){
		
		$("#addTicketItem").load();
		$(".productSelection").val('');
		$(".description1").val('');
		$(".qty_calculator").val('');
		$(".unitquantity").val('');
		$(".locations").val('');
		console.log(value);
		
		console.log($(thisone).prop("checked"));
		var customer_id=$('#customer_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
		var fetchvalueflag = $("#fetchflag").prop("checked");
        $.ajax({
            url: '<?php echo base_url('Cticket/product_search_by_customer')?>',
            type: 'post',
            data: {customer_id:customer_id,csrf_test_name:csrf_test_name, fetchvalueflag:value}, 
            success: function (msg){
                $(".supplier").html(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        }); 
	}
	function createPer1(unittype, arrayUnits){


		var perOptions = '<option>Select</option>';

		if(unittype == "EACH"){

			perOptions = '<option>None</option>';

			$('#per2').html('<option>None</option>');
			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');
			
			//$("#add-purchase").removeAttr("disabled");
			//$("#add-purchase-anothe").removeAttr("disabled");
		
		}
		else if(unittype == "INNER_CART"){
			

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "INNER_CART"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}
			
			//$("#add-purchase").attr("disabled", "disabled");
			//$("#add-purchase-another").attr("disabled", "disabled");
			
			$('#per2').html('<option>None</option>');
			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}

		else if(unittype == "CARTON"){
			

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "CARTON"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}
			
			//$("#add-purchase").attr("disabled", "disabled");
			//$("#add-purchase-another").attr("disabled", "disabled");
			
			$('#per2').html('<option>None</option>');

			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}

		else if(unittype == "PALLET"){
			
		//$("#add-purchase").attr("disabled", "disabled");
		//$("#add-purchase-another").attr("disabled", "disabled");
		
		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "PALLET"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}

			$('#per2').html('<option>None</option>');

			$('#onPalletChange').html('<div class="one-half"><div class="store-input"><h6>In-Inner-Per</h6><select id="per3"><option>None</option></select></div></div><div class="one-half last-column"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}


		return perOptions;
		

	}
	
	function createPer2(unitstring, arrayUnits){

		
		
		var arr = unitstring.split('#');
		
		console.log(arr);
		console.log(arrayUnits);
		if(arr[2] == 'INNER_CART'){

		var perOptions = '<option>Select</option>';

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "INNER_CART" && arrayUnits[i].perTo == "EACH"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}
		//	$("#add-purchase").attr("disabled", "disabled");
		//	$("#add-purchase-another").attr("disabled", "disabled");
			return perOptions;


		}else if(arr[2] == 'CARTON'){
		
			
		var perOptions = '<option>Select</option>';

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "CARTON" && arrayUnits[i].perTo == "EACH"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}

				if(arrayUnits[i].perFrom == "CARTON" && arrayUnits[i].perTo == "INNER_CART"){
				
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}
	
		//	$("#add-purchase").attr("disabled", "disabled");
		//	$("#add-purchase-another").attr("disabled", "disabled");
			return perOptions;


		}


		if(arr[2] == 'EACH'){
		
		//$("#add-purchase").removeAttr("disabled");
		//$("#add-purchase-anothe").removeAttr("disabled");
		var perOptions = '<option>None</option>';

			return perOptions;


		}
	}
	/* function selectNextValue(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer1(value, jsonobject);
		console.log(html1);
		console.log($(json).siblings().html());
		$(json).parent().children().next().next().next().next().html(html1);
	}
	 */
	function selectNextToNextValue(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject);
		//$(".inner-per").html(html1);
		//$(json).parent().find(".inner-per").html(html1);
		$(json).parent().children().next().next().next().next().next().html(html1);
	}
	function selectNextToNextValue1(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject);
		//$(".inner-per2").html(html1);
		//$(json).parent().find(".inner-per2").html(html1);
		$(json).parent().children().next().next().next().next().next().next().html(html1);
	}
    var unitHTML = '<select name="unit[]" required="" class="form-control unitquantity">';
                                               unitHTML +='<option>Select</option>';
                                               unitHTML +='<option value="INNER_CART">INNER CART</option>';
                                               unitHTML +='<option value="CARTON">CARTON</option>';
                                               unitHTML +='<option value="PALLET">PALLET</option>';
                                               unitHTML +='</select>';
   $('body').on('change','#customer_sss',function(event){
        event.preventDefault(); 
        var customer_id=$('#customer_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
		
		// ---- 29-04-2019 comment by tapan
		/* var fetchvalueflag = $("#fetchflag").prop("checked"); */
		
		var fetchvalueflag = 'c';
		
        $.ajax({
            url: '<?php echo base_url('Cticket/product_search_by_customer')?>',
            type: 'post',
            data: {customer_id:customer_id,csrf_test_name:csrf_test_name, fetchvalueflag:fetchvalueflag}, 
            success: function (msg){
                $(".supplier").html(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
		//$(".typeflag input[value='s']").attr("checked", true);
		//$(".typeflag input[value='s']").attr("checked", "checked");
		
		// ---------------  29-04 -2019 commented by tapan -----------------------
		
		/* $("#stockflag").prop("checked", true);
		$("#stockflag").prop("checked", "checked");
		var value = 's'; */ 
 		
		$("#customerflag").prop("checked", true);
		
		$("#customerflag").prop("checked", "checked");
		
		
		var value = 'c';
		$("input[name=optradio][value=" + value + "]").prop('checked', 'checked');
    });
    //Product select by ajax end

   // Product selection start
    $('body').on('change', '.productSelection', function(){
		// console.log(3333333333);
        var product_id = $(this).val(); 

		
		
        var base_url = $('.baseUrl').val(); 
        var location = $(this).parent().parent().children().next().next().next().next().next().next();
        var target = $(this).parent().parent().children().next().next().next().next().next().next();
        
        var item_description = $(this).parent().parent().children().next().next();
		
		
		//console.log($(this).parent().parent().children().find('description1').html());
        var item_description1 = $(this).parent().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
		
		
        var stock = $(this).parent().parent().children().next();
		
		var product_record = $(this).parent().parent().children().closest(".product_total_quantity");
		var price = $(this).parent().parent().children().next().next().next().next().find('input.price_item1');
		console.log(price.html());

		
		var thisone = $(this);
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cticket/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
				console.log("serial_flag "+obj.serial_flag);
                var resultjson = JSON.parse(obj.product_information.unit_values);
					$.each(resultjson,function(i, value){
				});
				var locationhtml = '<option value="">Select Location</option>';
				$.each(obj.locations, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					/* locationhtml += value.location_unique_key + '('+value.totalquantity+')'; */
					/* locationhtml += value.location_unique_key + '('+value.total_quantity+')'; */
					locationhtml += value.location_unique_key + '('+value.totalquantity+')';
					locationhtml += '</option>';
				})
				//target.val(obj.supplier_price);
                //rate.val(obj.supplier_price);
                //console.log(thisone.parent().parent().children().html());
				console.log(obj.total_product);
				console.log(obj.product_information);
				
				console.log("product_information");
				console.log(typeof obj.product_information.unit_values);
				console.log(obj.product_information.unit_values);
				var arrayUnits = JSON.parse(obj.product_information.unit_values);
				
				var showalldefinedunits = '';
   
				/* $('#showalldefinedunits').html('<option value="">---- select packin type</option>'); */
				console.log("arrayUnits",arrayUnits);
				var a="<option value=''>---- select packin type</option>";
   				for(var i=0; i<arrayUnits.length; i++){
						var t= '';
						
						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
						}

						if("CARTON" in arrayUnits[i]){
							t = t+arrayUnits[i].CARTON+" CTN -> ";
						}

						if("INNER_CART" in arrayUnits[i]){
							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";
							
						}

						if("EACH" in arrayUnits[i]){
							console.log(arrayUnits[i].EACH);
							t = t+arrayUnits[i].EACH+" EA";
							
						}
						var myJSON = JSON.stringify(arrayUnits[i]);

						showalldefinedunits = showalldefinedunits+t;
						/* $('#showalldefinedunits').append("<option value = '"+myJSON+"'>"+t+"</option>"); */
						
						a += "<option value = '"+myJSON+"'>"+t+"</option>";
						if(arrayUnits.length == i+1){
							stock.find('.locationsQty').html(a);
						}
						
					}
					
				
				console.log(showalldefinedunits);
				
				/* var locationhtml = '<option value="">Unit</option>';
				$.each(obj.product_information.unit_values, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key + '('+value.totalquantity+')';
					locationhtml += '</option>';
				}) */
				
				
				
				
                stock.find('.stock ').val(obj.total_product);
                stock.find('.description1').val(obj.product_information.product_details);
                
                stock.find('.unitquantity').val(obj.product_information.unit_values);
                location.find('.locations').html(locationhtml);
                location.find('.locations').html(locationhtml);
				
				if(obj.serial_flag == 0){
					location.find('.unitquantity').html('<option value="">Select</option><option value="EACH">EACH</option><option value="INNER_CART">INNER CART</option><option value="CARTON">CARTON</option><option value="PALLET">PALLET</option>');
				}else{
					location.find('.unitquantity').html('<option value="">Select</option><option value="EACH">EACH</option>');
				}
				
				
                //console.log(item_description2.parent().find('.prdt_prcie').val(obj.supplier_price));
               // stock.parent().find('.productJson').val(obj.product_information.unit_values);
				console.log(item_description1.html());
                price.val(obj.supplier_price);
				
				product_record.val(obj.total_product);

				
				
				
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

	

	// calculate qty
	$('body').on('keyup', '.unit_quantity', function(){
		// alert("hahahaha");
	
        var product_id = $(this).val(); 

		
	
        var base_url = $('.baseUrl').val(); 
        var location = $(this).parent().parent().children().next().next().next().next().next().next();
        var target = $(this).parent().parent().children().next().next().next().next().next().next();
        
        var item_description = $(this).parent().parent().children().next().next();
		
		
		//console.log($(this).parent().parent().children().find('description1').html());
        var item_description1 = $(this).parent().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
		
		
        var stock = $(this).parent().parent().children().next();
		console.log(stock);
		
		var product_record = $(this).parent().parent().children().closest(".product_total_quantity");
		var price = $(this).parent().parent().children().next().next().next().next().find('input.price_item1');
		console.log(price.html());
		// var unitQuantity = stock.find('.unit_quantity').val();
        //      var eachQuantity = stock.find('.each_quantity').val();
		//       var total = unitQuantity;
		//       stock.find('.total_quantity').val(total);



		var unitQuantity = stock.find('.unit_quantity').val();

		if(stock.find('.unitquantity').val()==='Each')
		{
			 var eachQuantity = unitQuantity;
		     var total = unitQuantity;
			 stock.find('.each_quantity').val(eachQuantity);
		     stock.find('.total_quantity').val(total);

		}
		else{
			
		var unitQuantity = stock.find('.unit_quantity').val();
        var eachQuantity = stock.find('.each_quantity').val();
		var total = unitQuantity*eachQuantity;
		stock.find('.total_quantity').val(total);
		}

		//  stock.find('.description1').val(asdfasd);

		var thisone = $(this);
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cticket/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
				console.log("serial_flag "+obj.serial_flag);
                var resultjson = JSON.parse(obj.product_information.unit_values);
					$.each(resultjson,function(i, value){
				});
				var locationhtml = '<option value="">Select Location</option>';
				$.each(obj.locations, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key + '('+value.totalquantity+')';
					locationhtml += '</option>';
				})
				//target.val(obj.supplier_price);
                //rate.val(obj.supplier_price);
                //console.log(thisone.parent().parent().children().html());
				console.log(obj.total_product);
				console.log(obj.product_information);
				
				console.log("product_information");
				console.log(typeof obj.product_information.unit_values);
				console.log(obj.product_information.unit_values);
				console.log("lag gaye");
				var arrayUnits = JSON.parse(obj.product_information.unit_values);
				
				var showalldefinedunits = '';
   
				/* $('#showalldefinedunits').html('<option value="">---- select packin type</option>'); */
				console.log("arrayUnits",arrayUnits);
				var a="<option value=''>---- select packin type</option>";
   				for(var i=0; i<arrayUnits.length; i++){
						var t= '';
						
						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
						}

						if("CARTON" in arrayUnits[i]){
							t = t+arrayUnits[i].CARTON+" CTN -> ";
						}

						if("INNER_CART" in arrayUnits[i]){
							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";
							
						}

						if("EACH" in arrayUnits[i]){
							console.log(arrayUnits[i].EACH);
							t = t+arrayUnits[i].EACH+" EA";
							
						}
						var myJSON = JSON.stringify(arrayUnits[i]);

						showalldefinedunits = showalldefinedunits+t;
						/* $('#showalldefinedunits').append("<option value = '"+myJSON+"'>"+t+"</option>"); */
						
						a += "<option value = '"+myJSON+"'>"+t+"</option>";
						if(arrayUnits.length == i+1){
							stock.find('.locationsQty').html(a);
						}
						
					}
					
				
				console.log(showalldefinedunits);
				
				/* var locationhtml = '<option value="">Unit</option>';
				$.each(obj.product_information.unit_values, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key + '('+value.totalquantity+')';
					locationhtml += '</option>';
				}) */
				
				
				
				
                stock.find('.stock ').val(obj.total_product);
                stock.find('.description1').val(obj.product_information.product_details);
                
                stock.find('.unitquantity').val(obj.product_information.unit_values);
                location.find('.locations').html(locationhtml);
                location.find('.locations').html(locationhtml);
				
				if(obj.serial_flag == 0){
					location.find('.unitquantity').html('<option value="">Select</option><option value="EACH">EACH</option><option value="INNER_CART">INNER CART</option><option value="CARTON">CARTON</option><option value="PALLET">PALLET</option>');
				}else{
					location.find('.unitquantity').html('<option value="">Select</option><option value="EACH">EACH</option>');
				}
				
				
                //console.log(item_description2.parent().find('.prdt_prcie').val(obj.supplier_price));
               // stock.parent().find('.productJson').val(obj.product_information.unit_values);
				console.log(item_description1.html());
                price.val(obj.supplier_price);
				
				product_record.val(obj.total_product);

				
				
				
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


	
	function checkAllValues(){
			return true;	
	}
	
	
	
	 function addTicketInputField(e) { console.log("ssfdfs");
        var t = $("tbody#addTicketItem tr:first-child").html();
		console.log(t);
		var newhtml = $('<div></div>').append(t).find(".locations").html('');
		console.log(newhtml);
		count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addTicketItem").append("<tr>" + t + "</tr>");
    }
	/*function selectQuantityAndPrice(location_unique_key){
		var currentRow=$(this).closest("tr");
console.log(currentRow);			
		console.log(currentRow.find("td:eq(0)").text());
		var jsonvalue = $(this).parent().html();
		console.log(jsonvalue);
		return false;
		console.log(location_unique_key);
		var base_url = $('.baseUrl').val();
		var csrf_test_name=  $("[name=csrf_test_name]").val();		
		$.ajax
        ({
            url: base_url+"Cticket/retrieve_product_informations",
            data: {product_id:location_unique_key,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
				console.log(data);return false;
			}
		});	
	}
	*/
	$(document).ready(function(){
		 var url = window.location.href;
		 console.log(url);
		 var url = new URL(url);
		var venderid = url.searchParams.get("supplier_id");
		var product_id = url.searchParams.get("product_id");
		console.log(venderid);
		/* $('#customer_sss').val(customerid); */
		
		/* $.ajax
				({
					url: "<?php echo base_url('Cticket/checkCustomeID')?>",
					data: {venderid:venderid},
					type: "POST",
					success: function(data)
					{
						console.log(data);
						var obj = JSON.parse(data);
						console.log("Obj "+obj);
					} 
				});
				
				 */
				
				 $.ajax({
            url: '<?php echo base_url('Cticket/checkcustomeid')?>',
            type: 'post',
            data: {venderid:venderid}, 
            success: function (data){
                
				var obj = JSON.parse(data);
				/* console.log("Obj "+obj); */
				console.log(obj.msg);
				var datas = obj.msg;
				var customerid = datas[0]['customer_id'];
				
				$('#customer_sss').val(customerid);
				console.log("product_id "+product_id);
				/* $("input[type=select][name=product_id]").val(product_id); */
				getCustomerNameAddress(customerid,2);
				pt();
				productDesct(product_id);
				setTimeout(function(){ $('#product_id').val(product_id);   }, 1000);
				
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        }); 
		 
		// 
	
	// code to read selected table row cell data (values).
	$(".btnSelect").on('change',function(){
		 var currentRow=$(this).closest("td");
		 console.log(currentRow.parent().children().next().html());
		 //var col1=currentRow.find("td:eq(2) input").val();
		 //console.log(col1);
		 //console.log(col1.html().find('.qty_calculator').val());
	});
	
	$("#addShipTo").click(function(){
		console.log("faffas");
		var html = '<div class="addedTextarea"><textarea cols="35" rows="2" name="ship_to[]" class="form-control" required placeholder="Write Ship To Address"></textarea><span style="float:right;right:-20px;top:-30px;" class="glyphicon glyphicon-minus minusicon removeShipTo"></span></div>';
		$('.shipTo').append(html);
		$(".removeShipTo").click(function(){
			$(this).parent().remove();
		});
	
	
	});
	
	$(".removeShipTo").click(function(){
		$(this).parent().children().next().remove();
		$(this).remove();
	});
});

//Product selection end
	
	function checkAllValues(){
		var flag1 = 0;
		var flag2 = 0;
		var flag3 = 0;
		var flag4 = 0;
		var flag5 = 0;
		$('.productSelection').each(function(i, value){
			/*console.log($(this).parent().parent().children().next().html());
			console.log($(this).parent().parent().children().next().next().html());
			console.log($(this).parent().parent().children().next().next().next().html());
			console.log($(this).parent().parent().children().next().next().next().next().html());
			console.log($(this).parent().parent().children().next().next().next().next().next().html());*/
			
			var quantity = $(this).parent().parent().children().next().next().next().next().next().find('.qty_calculator').val();
			console.log(parseInt(quantity));
			console.log(parseInt($(this).parent().parent().children().next().val()));
			
			console.log(typeof parseInt(quantity));
			console.log(typeof parseInt($(this).parent().parent().children().next().val()));
			if(parseInt(quantity) > parseInt($(this).parent().parent().children().next().val())){
				flag5 = 1;
				$(value).css("border", "1px solid red");
			}
			if($(value).val()=='' || $(value).val()=='0'){
				flag1 = 1;
			}	
		});
		
		$('.qty_calculator').each(function(i, value){
			if($(value).val()=='' || $(value).val()=='0'){
				flag2 = 1;
			}	
		});
		$('.unitquantity').each(function(i, value){
			console.log($(this).parent().parent().children().next().html());
			return false;
			if($(value).val()==''){
				flag3 = 1;
			}	
		});	
		$('.locations').each(function(i, value){
			if($(value).val()==''){
				flag4 = 1;
			}	
		});
		if(flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0){
			return true;
		}else{
			if(flag1==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select product.</div><div></div>	');
				$(".error").show();
			return false;
			}else if(flag2==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Quantity.</div><div></div>	');
				$(".error").show();
			return false;	
			}else if(flag3==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Values.</div><div></div>	');
				$(".error").show();
			return false;
			}else if(flag4==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 	13px;font-weight:bold;">Please select locations.</div><div></div>	');
				$(".error").show();
			return false;
			}else if(flag5==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 	13px;font-weight:bold;">Quantity exceeds the existing stock.</div><div></div>	');
				$(".error").show();
			return false;
			}else{
				$(".errorhandler").html('');
				$(".error").hide();
			return true;
			}
			
		}
		
	}
	
	function checkCustomePO(value){
		console.log(value);
		$.ajax
				({
					url: "<?php echo base_url('Cticket/checkCustomePO')?>",
					data: {customer_po:value},
					type: "post",
					success: function(data)
					{
						var obj = JSON.parse(data);
						if(obj.status=="false"){
							$(".errorhandler").text(obj.msg);
							$(".errorhandler").css("width","365px");
							$(".errorhandler").css("color","red");
							$("#add-ticket").attr("disabled", "disabled");
							$("#add-ticket-another").attr("disabled", "disabled");
							return false;
						}else{
							$(".errorhandler").text("");
							$("#add-ticket").removeAttr("disabled");
							$("#add-ticket-another").removeAttr("disabled");
							return true;
						}
					} 
				});
	}
					
function multipleAddress(customer_id,addresszero){
	console.log(customer_id);
	
	
	var serverUrl = '<?php echo base_url('api/services.php?action=')?>'; 
	var formData = {
            apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
            data: {
                customer_id: customer_id,
				
            }
        }
	
        $.ajax({
            type: 'POST',
            data: JSON.stringify(formData),
            url: serverUrl+'multipleAddress',
            success: function (data) {
				console.log("multipleAddress",addresszero);
				var result = JSON.parse(data);
                  if (result.data.status == "false") {
                    swal("", "Please add address", "warning");
   				
   				  }else{
						 console.log("datadtatdatad",result.data.address)
					  $("#multipleAddress").html("<option value='"+addresszero+"'>"+addresszero+"</option>");
					 var address = result.data.address
					 addresszero
					 
					 for(var i =1; i< address.length; i++){
						 $("#multipleAddress").append("<option value='"+address[i]['address']+"'>"+address[i]['address']+"</option>");
					 }
				  }
				  
				
            },
            error: function (xhr) {
                console.log(xhr);
            }
        })
}

function pt(){
	 event.preventDefault(); 
        var customer_id=$('#customer_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
		
		// ---- 29-04-2019 comment by tapan
		/* var fetchvalueflag = $("#fetchflag").prop("checked"); */
		
		var fetchvalueflag = 'c';
		
        $.ajax({
            url: '<?php echo base_url('Cticket/product_search_by_customer')?>',
            type: 'post',
            data: {customer_id:customer_id,csrf_test_name:csrf_test_name, fetchvalueflag:fetchvalueflag}, 
            success: function (msg){
                $(".supplier").html(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
		//$(".typeflag input[value='s']").attr("checked", true);
		//$(".typeflag input[value='s']").attr("checked", "checked");
		
		// ---------------  29-04 -2019 commented by tapan -----------------------
		
		/* $("#stockflag").prop("checked", true);
		$("#stockflag").prop("checked", "checked");
		var value = 's'; */ 
 		
		$("#customerflag").prop("checked", true);
		
		$("#customerflag").prop("checked", "checked");
		
		
		var value = 'c';
		$("input[name=optradio][value=" + value + "]").prop('checked', 'checked');
}



function productDesct(product_id){
	 
		var fetchvalueflag = 'c';
		
        $.ajax({
            url: '<?php echo base_url('Cticket/product_search_by_customer_details')?>',
            type: 'post',
            data: {product_id:product_id}, 
            success: function (msg){
                var obj = JSON.parse(msg);
				/* console.log("Obj "+obj); */
				console.log(obj.msg);
				var datas = obj.msg;
				var product_details = datas[0]['product_details'];
				$('#description_1').val(product_details);
				showqty(product_id);
            },
            error: function (xhr, desc, err){
                // alert('failed');
            }
        });        
		
}



function productDesctAdd(product_id){
	 
		var fetchvalueflag = 'c';
		console.log(123123);
        $.ajax({
            url: '<?php echo base_url('Cticket/product_search_by_customer_details')?>',
            type: 'post',
            data: {product_id:product_id}, 
            success: function (msg){
                var obj = JSON.parse(msg);
				
				console.log(obj.msg);
				var datas = obj.msg;
				console.log("Obj "+datas);
				var product_details = datas[0]['product_details'];
				return product_details;
            },
            error: function (xhr, desc, err){
                // alert('failed');
            }
        });        
		
}




function showqty(product_id){
	var product_id = product_id ; // $(this).val();  
		
	    var base_url = $('.baseUrl').val(); 
        var location = $(this).parent().parent().children().next().next().next().next().next().next();
		console.log(location);
		
		
        var target = $(this).parent().parent().children().next().next().next().next().next().next();
        
        var item_description = $(this).parent().parent().children().next().next();
		
		
		//console.log($(this).parent().parent().children().find('description1').html());
        var item_description1 = $(this).parent().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
        var stock = $(this).parent().parent().children().next();
		
		var product_record = $(this).parent().parent().children().closest(".product_total_quantity");
		var price = $(this).parent().parent().children().next().next().next().next().find('input.price_item1');
		console.log(price.html());
		
		var thisone = $(this);
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cticket/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
				console.log(obj);
				console.log("location update");
				
                var resultjson = JSON.parse(obj.product_information.unit_values);
					$.each(resultjson,function(i, value){
				});
				var locationhtml = '<option value="">Select Location</option>';
				$.each(obj.locations, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key + '('+value.totalquantity+')';
					locationhtml += '</option>';
				})
				
				$('.locations').html(locationhtml);
				
				var arrayUnits = JSON.parse(obj.product_information.unit_values);
				console.log(arrayUnits);
				var showalldefinedunits = '';
   
				$('#showalldefinedunits').html('<option value="">---- select packin type</option>');
				console.log("arrayUnits",arrayUnits);
   				for(var i=0; i<arrayUnits.length; i++){
						var t= '';
						
						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
						}

						if("CARTON" in arrayUnits[i]){
							t = t+arrayUnits[i].CARTON+" CTN -> ";
						}

						if("INNER_CART" in arrayUnits[i]){
							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";
							
						}

						if("EACH" in arrayUnits[i]){
							console.log(arrayUnits[i].EACH);
							t = t+arrayUnits[i].EACH+" EA";
							
						}
						var myJSON = JSON.stringify(arrayUnits[i]);

						showalldefinedunits = showalldefinedunits+t;
						/* $('#showalldefinedunits').append("<option value = '"+myJSON+"'>"+t+"</option>"); */
						
						$('.locationsQty').append("<option value = '"+myJSON+"'>"+t+"</option>");
					}
					
				
				
				//target.val(obj.supplier_price);
                //rate.val(obj.supplier_price);
                //console.log(thisone.parent().parent().children().html());
				console.log(obj.total_product);
                stock.find('.stock ').val(obj.total_product);
                $('#stock').val(obj.total_product);
                location.find('.locations').html(locationhtml);
                //console.log(item_description2.parent().find('.prdt_prcie').val(obj.supplier_price));
                item_description2.parent().find('.productJson').val(obj.product_information.unit_values);
				console.log(item_description1.html());
                price.val(obj.supplier_price);
				
				product_record.val(obj.total_product);

				
				
                item_description.find('.description1').val(obj.product_information.product_details);
				
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
		
		
		
		
		
		
		
		
		
		
}
</script>



