<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>
<style type="text/css">
    .close{color:white;}
	.hide1{
		display:none!important;
	}
	.hide2{
		display:none!important;
	}
	.hide3{
		display:none!important;
	}
</style>
<?php $r_id = $this->session->r_id;?>
<!-- Add New Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_purchase') ?></h1>
            <small><?php echo display('add_new_purchase') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('add_purchase') ?></li>
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
                    <?php echo form_open_multipart('Cpurchase/insert_purchase/',array('class' => 'form-vertical', 'id' => 'insert_purchase','name' => 'insert_purchase'))?>
						
                        <div class="row">
                            <div class="col-md-6"></div>
							<div class="col-md-4"></div>
                            <div class="col-md-4" hidden>
                                <label for="supplier_sss" class="col-form-label" style="width:10em;"><?php echo 'Purchase Order' ?> 
                                </label>
                                :
                                <?php //echo  $purchase_id = "PO".date('mdHis');?>
                                <?php echo  $purchase_id = "PO".rand(1000,9999);?>
                                <input type="hidden" name="purchase_id" value="<?php echo $purchase_id?>">
                            </div>
							<div class="col-md-2">
									<a href="<?php echo base_url('Cproduct');?>"><big><b>Add Product</b></big></a>
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
                                        <select  name="supplier_id" id="supplier_sss" class="form-control" required="true" onchange="getSupplierNameAddress(this.value)"> 
                                            <option tabindex="0" value=""><?php echo display('select_one') ?></option>
                                            {all_supplier}
                                            <option value="{supplier_id}">{supplier_name}</option>
                                            {/all_supplier}
                                        </select>
                                    </div>

                                  <!--  <div class="col-sm-3">
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
                                       <select name="customer_id" id="customer_sss" class="form-control" required="true"  onchange="getCustomerNameAddress(this.value)"> 
                                            <option  tabindex="1" value=""><?php echo display('select_one') ?></option>
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
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8" style="margin-left:89px;">
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
                            <input type="hidden" name="purchase_details" value="">
                           
                        </div>

                        <div class="row table-responsive">
                             <table class="table">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Ship Date</th>
                                <th>Customer PO<i class="text-danger">*</i></th>
                                <th>Ship Method<i class="text-danger">*</i></th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>
                                    <?php $date = date('Y-m-d'); ?>
                                        <input type="text"  class="form-control datepicker" name="purchase_date" value="<?php echo $date; ?>" id="purchase_date" required  readonly="true" />
                                    </td>
                                <td>
                                    <input type="text" class="form-control datepicker" name="ship_date" value="<?php echo $date; ?>" id="ship_date" required    readonly="true"/>
                                </td>
                                <td>
                                     <input type="text" class="form-control" name="customer_po" value="" id="customer_po" required onkeyup="checkCustomePO(this.value)"/>
                                     <div class="col-sm-3"><div class="errorhandler1"></div>
                                </td>
                                <td>
                                   <!-- <input type="text" tabindex="2" class="form-control" name="ship_method" value="" id="ship_method" required  tabindex='2'/>-->
								   
								    <select name="ship_method[]" id="ship_method" class="form-control" required="true"  multiple="multiple"> 
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
                                       
                                        <th class="text-center"><?php echo display('description') ?> </th>
                                        <th class="text-center"><?php echo display('quantity') ?><i class="text-danger">*</i> </th>
                                        <th class="text-center"><?php echo display('unit') ?><i class="text-danger">*</i> </th>
                                       
                                        <th class="text-center"><?php echo display('cost') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td class="span3 supplier">
                                            <?php //echo display('please_select_supplier') ?>
                                            <!-- <select class="form-control supplier"></select> -->
											<select class="form-control productSelection dont-select-me" required="true">
												<option value="">Select Product</option>
												<?php foreach($all_product as $allprods):?>
												<option value="<?php echo $allprods['product_id'];?>"><?php echo $allprods['product_name'];?></option>
												<?php endforeach;?>
											</select>
                                        </td>


                                             <input type="hidden" name="cartoon_item[]" value="" readonly="readonly" id="ctnqntt_1" class="form-control ctnqntt1 text-right" placeholder="<?php echo display('item_cartoon') ?>"/>
                                         <input type="hidden" name="cartoon[]"  required  id="qty_item_1" class="form-control text-right qty_calculate" placeholder="0.00" value="" min="0"/>
                                        
                                        <td><textarea placeholder="<?php echo display('description') ?>" rows="4" cols="20" name="description[]"  readonly="readonly" id="description_1" >
						
                            </textarea></td>
                            
                            <td class="text-right">
                                            <input type="number" name="product_quantity[]" min="1" id="total_qntt_1" class="form-control qty_calculator text-right" placeholder="0.00" step="1" required/>
                                             
                                        </td>


                                       <td class="unitselect">
											<select name="unit[]" required="" class="form-control unitquantity dont-select-me" onchange="setPrice(this.value, this)" >
                                                <option value="">Select</option>
                                                <option value="EACH">EACH</option>
                                                <option value="INNER_CART">INNER CART</option>
                                                <option value="CARTON">CARTON</option>
                                                <option value="PALLET">PALLET</option>
                                            </select>
                                            <input type="hidden" class="prdt_prcie" value="">
											<input type="hidden" class="productJson" value="">
											<input type="hidden" class="totalProduct" value="">
											
                                        </td>
		
                                        
                                   
                                        <td class="">
                                            <input type="number" name="product_rate[]"  id="price_item_1" class="form-control price_item1 text-right" placeholder="0.00" value="" min="1" required />
                                        </td>
                                        <td class="text-right">
                                            <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" />
                                        </td>
                                        <td>
                                            <button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display('delete')?>" onclick="deleteRow(this)"><?php echo display('delete')?></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="1">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addPurchaseInputField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
                                        <td style="text-align:right;" colspan="4"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="text-right form-control" name="grand_total_price" value="0.00" readonly="readonly" />
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
						
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="submit"  id="add-purchase" class="btn btn-primary btn-large" name="add-purchase" value="<?php echo display('submit') ?>" onclick="return checkAllValues();"/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-purchase-another" class="btn btn-large btn-success" id="add-purchase-another">
                            </div>
							<div class="col-sm-3"><div class="errorhandler"></div></div>
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

	function setPrice(value, ths){
		console.log(value);
		console.log(ths);
		var array = value.split("###");
		console.log(array);
		var totalItems = array[1];
		var sell_price = array[2];
		var vendor_price = array[3];
		$(ths).parent().find('.prdt_prcie').val(vendor_price);
		$(ths).parent().find('.totalProduct').val(totalItems);
		console.log($(ths).parent().html());
		$(ths).parent().parent().find('.price_item1').val(vendor_price);
		$(ths).parent().parent().find('.price_item1').trigger("blur");
		console.log($(ths).parent().parent().children().next().html());
		console.log($(ths).parent().parent().children().next().val());
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
	function selectNextValue(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer1(value, jsonobject);
		$(json).parent().children().next().next().next().next().removeClass("hide1");
		$(json).parent().children().next().next().next().next().html(html1);
		
	}
	
	function selectNextToNextValue(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject);
		//$(".inner-per").html(html1);
		//$(json).parent().find(".inner-per").html(html1);
		$(json).parent().children().next().next().next().next().next().html(html1);
		$(json).parent().children().next().next().next().next().next().removeClass("hide2");
	}
	function selectNextToNextValue1(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject);
		//$(".inner-per2").html(html1);
		//$(json).parent().find(".inner-per2").html(html1);
		$(json).parent().children().next().next().next().next().next().next().html(html1);
		$(json).parent().children().next().next().next().next().next().next().removeClass("hide3");
	}
    var unitHTML = '<select name="unit[]" required="" class="form-control unitquantity">';
                                               unitHTML +='<option>Select</option>';
                                               unitHTML +='<option value="INNER_CART">INNER CART</option>';
                                               unitHTML +='<option value="CARTON">CARTON</option>';
                                               unitHTML +='<option value="PALLET">PALLET</option>';
                                               unitHTML +='</select>';
   $('body').on('change','#supplier_sss',function(event){
        event.preventDefault(); 
        var supplier_id=$('#supplier_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax({
            url: '<?php echo base_url('Cpurchase/product_search_by_supplier')?>',
            type: 'post',
            data: {supplier_id:supplier_id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                if($(".productSelection").val()!=""){
					var previousproduct = $(".productSelection").val();
					$(".supplier").html(msg);
					$('.supplier option[value="'+previousproduct+'"]').attr('selected','selected');
					$(".supplier").trigger("change");
				}else{
					$(".supplier").html(msg);
				}
				
				
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
        var item_description = $(this).parent().next().next().next().children();
        var item_description1 = $(this).parent().next().next().next().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
        var stock = $(this).parent().next().children();
        var thisone = $(this);
		console.log(target.val());
		console.log(item_description.html());
		console.log(item_description1.html());
		console.log(item_description2.html());
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cinvoice/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
				console.log(obj);
				if($("#supplier_sss").val()==""){
					$('#supplier_sss option[value="'+obj.supplier_id+'"]').attr('selected','selected');
					$("#supplier_sss").trigger("change");
				}
				console.log(obj.product_information.unit_values);
				if(obj.product_information.unit_values!=''){
					var resultjson = JSON.parse(obj.product_information.unit_values);
				}else{
					var resultjson =[];
				}
                
				var selectoptionsunit = "<option value=''>Select</option>";
				$.each(resultjson,function(i, value){
					var str="";
					var optionvalue = "";
					var mul=1;
					var pricedata = '';
					$.each( value, function( key, valueInter ) {
						if($.isNumeric(valueInter)){
							if(key!="Select" && key!="sell_price" && key!="vendor_price"){
								mul=mul*valueInter;
								str=str+valueInter+key+"-";
							}
							pricedata = value.sell_price+"###"+value.vendor_price;
						}
					});
					str = str.slice(0,-1);
					optionvalue = str+"###"+mul+"###"+pricedata;
					selectoptionsunit += "<option value='"+optionvalue+"'>"+str+"</option>";
				});
                console.log(item_description1.html());
                console.log(item_description2.parent().find('.prdt_prcie').val(obj.supplier_price));
                item_description2.parent().find('.productJson').val(obj.product_information.unit_values);
				item_description2.html(selectoptionsunit);
				
                item_description1.val(obj.supplier_price);
				item_description1.trigger("blur");
				console.log(obj.product_information.product_details);
				console.log(123123123);
                item_description.val(obj.product_information.product_details);
				
            } 
        });
    });
    //Product selection end
	
	function checkAllValues(flag){
		var flag1 = 0;
		var flag2 = 0;
		var flag3 = 0;
		var flag4 = 0;
		
		$('.unitquantity').each(function(i, value){
			if($(value).val()=='Select'){
				flag4 = 1;
			}	
		});
		
		$('.per').each(function(i, value){
			if($(value).val()=='Select'){
				flag1 = 1;
			}	
		});
		$('.inner-per').each(function(i, value){
			if($(value).val()=='Select'){
				flag2 = 1;
			}	
		});	
		$('.inner-per2').each(function(i, value){
			if($(value).val()=='Select'){
				flag3 = 1;
			}	
		});
		if(flag1==0 && flag2==0 && flag3==0 && flag4==0){
			//
			 /*$("#insert_purchase").valid();
			var data = $('form#insert_purchase').serialize();
			$.ajax
				({
					url: "<?php echo base_url('Cpurchase/insert_purchase')?>",
					data: data,
					type: "post",
					success: function(data)
					{
						var obj = JSON.parse(data);
						if(obj.status==false){
							$(".errorhandler").text(obj.msg);
							$(".errorhandler").css("width","365px");
							$(".errorhandler").css("color","red");
							return false;
						}else{
							if(flag==1){
								window.location.href = "<?php echo base_url('Cpurchase/manage_purchase')?>";
							}else{
								window.location.href = "<?php echo base_url('Cpurchase')?>";
							}
						}
					} 
				});*/
				return true;
		
		
		}else{
			$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Values. (Unit Values must be in each at last.)</div><div></div>	');
			$(".error").show();
			return false;
		}
		
	}
	
	function checkCustomePO(value){
		console.log(value);
		$.ajax
				({
					url: "<?php echo base_url('Cpurchase/checkCustomePO')?>",
					data: {customer_po:value},
					type: "post",
					success: function(data)
					{
						var obj = JSON.parse(data);
						if(obj.status==false){
							$(".errorhandler1").text(obj.msg);
							$(".errorhandler1").css("width","365px");
							$(".errorhandler1").css("color","red");
							$("#add-purchase").attr("disabled", "disabled");
							$("#add-purchase-another").attr("disabled", "disabled");
							return false;
						}else{
							$(".errorhandler1").text("");
							$("#add-purchase").removeAttr("disabled");
							$("#add-purchase-another").removeAttr("disabled");
							return true;
						}
					} 
				});
	}
</script>


