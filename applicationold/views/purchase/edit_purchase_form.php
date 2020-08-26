<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>
<style type="text/css">
    .close{color:white;}
	.hide1{
		display:none;
	}
	.hide2{
		display:none;
	}
	.hide3{
		display:none;
	}
</style>

<?php  $r_id = $this->session->r_id ?>
<!-- Edit Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('purchase_edit') ?></h1>
            <small><?php echo display('purchase_edit') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('purchase') ?></a></li>
                <li class="active"><?php echo display('purchase_edit') ?></li>
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

        <!-- Purchase report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('purchase_edit') ?></h4>
                        </div>
                    </div>
                   <?php echo form_open_multipart('Cpurchase/purchase_update/'.$r_id,array('class' => 'form-vertical', 'id' => 'purchase_update', 'onsubmit' => 'return checkAllValues()'))?>
                    <div class="panel-body">
						<div class="row">
							<div class="col-sm-3">
								<label style="width:10em;">Purchase Order</label>
								{purchase_id}
							</div>
						</div>

						<br/>
                        <div class="row">
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('supplier') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="supplier_name" value="{supplier_name}" class="form-control supplierSelection" placeholder='Type your Supplier Name' id="supplier_name" required >
                                        <input type="hidden" class="supplier_hidden_value" name="supplier_id" value="{supplier_id}" id="suppluerHiddenId" />
                                    </div>
								
                                   <!-- <div class="col-sm-3">
                                        <a href="<?php echo base_url('Csupplier'); ?>"><?php echo display('add_supplier') ?></a>
                                    </div>-->
                                </div> 
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('customer') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5" style="width: 250px;">
                                        <input type="text" name="customer_name" value="{customer_name}" class="form-control customerSelection" placeholder='Type your customer Name' id="customer_name" required >
                                        <input type="hidden" class="customer_hidden_value" name="customer_id" value="{customer_id}" id="customerHiddenId" />
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <a href="<?php echo base_url('Ccustomer'); ?>"><?php echo display('add_customer') ?></a>
                                    </div>-->
                                </div>
                            </div>
                        </div>

                       <?php /* <div class="row">
                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-3 col-form-label"><?php echo display('invoice_no') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-9">
                                        <input type="text" tabindex="3" class="form-control" name="chalan_no" placeholder="<?php echo display('invoice_no') ?>" required value="{chalan_no}" />
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="adress" class="col-sm-4 col-form-label"><?php echo display('details') ?></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" tabindex="4" id="adress" name="purchase_details" placeholder=" <?php echo display('details') ?>">{purchase_details}</textarea>
                                    </div>
                                </div> 
                            </div>
                        </div> */ ?>

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
                                    <?php //$date = date('Y-m-d'); ?>
                                        <input type="text" class="form-control datepicker" name="purchase_date" value="{purchase_date}" id="purchase_date" required   readonly="true"/>
                                    </td>
                                <td>
                                    <input type="text" class="form-control datepicker" name="ship_date" value="{ship_date}" id="ship_date" required   readonly="true" />
                                </td>
                                <td>
                                     <input type="text"  class="form-control" name="customer_po" value="{customer_po}" id="customer_po" required  />
                                </td>
                                <td>
                                    <!--<input type="text" tabindex="2" class="form-control" name="ship_method" value="{ship_method}" id="ship_method" required  tabindex='2'/>-->
										
									 <select name="ship_method[]" id="ship_method" class="form-control " required="true"   multiple="multiple"> 
                                            <option value=""><?php echo display('select_one') ?></option>
                                            
											<?php $shiparr = explode(",", $ship_method); foreach($all_shipping as $shipping):?>
											<option <?php if(in_array($shipping['id'], $shiparr)){?> selected="selected" <?php }?> value="<?php echo $shipping['id']?>"><?php echo $shipping['shipping_name']?></option>
                                            <?php endforeach;?>
                                        </select>
										
                                </td>
                                </tr>
                            </tbody>
                          </table>
                            
                        </div>

                        <div class="table-responsive" style="margin-top: 10px">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?><i class="text-danger">*</i></th>
                                        <!--<th class="text-center"><?php echo display('cartoon') ?> </th>
                                        <th class="text-center"><?php echo display('item_cartoon') ?> </th>-->
                                        <th  style="width:200px;" class="text-center"><?php echo display('description') ?> </th>
										<th class="text-center"><?php echo display('quantity') ?><i class="text-danger">*</i> </th>
										<th class="text-center"><?php echo display('unit') ?><i class="text-danger">*</i> </th>
                                        
									    <th class="text-center"><?php echo display('cost') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('total') ?></th>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>

                				<tbody id="addPurchaseItem">
								<?php $i = 0;	?>
								<?php foreach($purchase_info as $purchase):  ?><tr><td style="width: 200px;text-align: center;">
  
	<select class="form-control productSelection dont-select-me" name="product_id[]">
		<option value="">Select Product</option>
		<?php foreach($all_product as $allprods):?>
		<option value="<?php echo $allprods['product_id'];?>" <?php if($purchase['product_id']==$allprods['product_id']){?> selected="selected" <?php }?>><?php echo $allprods['product_name'];?></option>
		<?php endforeach;?>
	</select>
<!-- 
	<td><input type="text" name="description[]" id = "description_<?php echo $purchase['sl']?>" value="<?php echo $purchase['description']?>"  class='form-control text-right description'></td>										 -->


	<td><textarea style="text-align: left;" name="description[]" id="description_<?php echo $purchase['sl']?>" value="<?php echo $purchase['description']?>" class="form-control text-right description" cols="10" rows="2" readonly><?php echo $purchase['description']?></textarea></td>



<input type="hidden" name="purchase_id" value="<?php echo $purchase['purchase_id']?>">

<input type="hidden" name="cartoon[]" onkeyup="quantity_calculate(<?php echo $purchase['sl']?>);" onchange="quantity_calculate(<?php echo $purchase['sl']?>);" value="<?php echo $purchase['cartoon_quantity']?>" required  id="qty_item_<?php echo $purchase['sl']?>" class="form-control text-right" min="1" step="1"/>

<input type="hidden" name="cartoon_item[]" value="<?php echo $purchase['cartoon_quantity']?>" readonly="readonly" id="ctnqntt_<?php echo $purchase['sl']?>" class="ctnqntt<?php echo $purchase['sl']?> form-control text-right" />

<td class="text-right">
    <input type="number"  min="1" name="product_quantity[]" value="<?php echo $purchase['requested_quantity']?>" 
	required="true" id="total_qntt_<?php echo $purchase['sl']?>" class="form-control qty_calculator text-right" />
</td>


<td class="text-right unittd_<?php echo $purchase['sl']?>">

<?php 

$unitsarr = json_decode($purchase['unit_values']);


?> 
	<select name="unit[]" required class="form-control unitquantity dont-select-me unitquantity_<?php echo $i;?>"  onchange="setPrice(this.value, this)" >
	
                                                <option value="Select">Select</option>
                                                <?php 
												$option = "";
												$mul = 1;
												$pricedata= "";
												foreach($unitsarr as $uunit){
													#print_r($uunit);
													$uunit =  (array) $uunit;
													$keyss = array_keys($uunit);
													$valss = array_values($uunit);
													#print_r($keyss);
													#print_r($valss);
													$str = "";
													$optionValue = "";
													$y = 0;
													for($z=0;$z<sizeof($keyss);$z++){
														#print_r($keyss[$z]);
														#print_r($valss[$z]);
														
														if($keyss[$z]!="sell_price" && $keyss[$z]!="vendor_price"){
															$mul=$mul*$valss[$z];
															$str .= $valss[$z].$keyss[$z];
															$str .= "-";
															
														}
														$pricedata = $uunit["sell_price"]."###".$uunit["vendor_price"];
													?>
													
												
													<?php $y++;}
													$str = str_replace("EACH-","EACH",$str);
													$optionValue = $str."###".$mul."###".$pricedata;
													$optionValue1 = $str;#."###".$mul."###".$pricedata;
													#echo $str;
													
													?>
													<option <?php if($purchase['unit']==$optionValue1){?> selected="selected" <?php }?> value="<?php echo $optionValue;?>" required><?php echo $str;?></option>
													<?php }?>
                                            </select>
											<?php #if($purchase_info[$i]['unit']!=''){ ?> 
											<script>
											/*setTimeout(function(){
											selectNextValue('{unit}', "unitquantity_<?php echo $i;?>", '{per}','{per2}','{per3}', '{sl}');
											},1000);*/
											
											</script>
											<?php 
											
											#}?>	
											<input type="hidden" class="prdt_prcie" value="<?php echo $purchase['price']?>">
											<input type="hidden" class="productJson" value=<?php echo $purchase['unit_values']?>>
											<input type="hidden" class="totalProduct" value="">
											<?php #echo "<pre>";print_r($purchase_info["{sl}"]["unit_values"]);
											#getSelect2($purchase['unit'], $purchase['unit_values']);
											?>
											
											
											
</td>


<td>
    <input type="text" name="product_rate[]"  value="<?php echo $purchase['rate']?>" onkeyup="quantity_calculate(<?php echo $purchase['sl']?>);" onchange="quantity_calculate(<?php echo $purchase['sl']?>);" id="price_item_<?php echo $purchase['sl']?>" class="form-control price_item1 text-right" min="0" />
</td>
<td class="text-right">
    <input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_<?php echo $purchase['sl']?>" value="<?php echo $purchase['total_amount']?>"  readonly="readonly" />
    <input type="hidden" name="purchase_detail_id[]" value="<?php echo $purchase['purchase_detail_id']?>"/>
	
</td>
 <td>
    <button style="text-align: right;" class="btn btn-danger" type="button" value="Delete" onclick="deleteRow(this, '<?php echo $purchase['purchase_detail_id']?>')"><?php echo display('delete')?></button>
	
</td> 

                                    </tr>
									<?php  $i++;
									endforeach;
									?>
								
        						</tbody>
        						<tfoot>
        							<tr>
        								<!--<td colspan="2">
                                            <?php echo display('if_you_update_purchase_first_select_supplier_then_product_and_then_cartoon')?>                        
                                        </td>-->
										
										<td colspan="4">
                                            <input type="button" id="add-invoice-item" class="btn btn-info" name="add-invoice-item" onClick="addPurchaseInputField('addPurchaseItem');" value="<?php echo display('add_new_item') ?>"/>

                                            <input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
                                        </td>
										
										
        								<input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
        								<td style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
        								<td class="text-right">
                                            <input type="text" id="grandTotal" value="{grand_total}" class="text-right form-control" name="grand_total_price" value="0.00" readonly="readonly" />
        								</td>
        							</tr>
        						</tfoot>
                            </table>
                        </div>
						
						
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="submit" id="add-purchase" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('save_changes') ?>"  />
                            </div>
							<div class="col-sm-3"><div class="errorhandler"></div></div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit Purchase End -->

<style type="text/css">
    .btn:focus {
      background-color: #6A5ACD;
    }
</style>

<?php function getSelect2($unit, $array){
	#echo $unit;
	#print_r($array);
	$array = json_decode($array);
	$perOptions = "<option>Select</option>";
	if($unit == "EACH"){
		$perOptions = "<option>None</option>";
	}elseif($unit == "INNER_CART"){
		foreach($array as $arr){
			if($arr['perFrom'] == 'INNER_CART'){
				$perOptions = $perOptions."<option values=".$arr['perFrom']."#".$arr."";
				#perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
			}
		}
	}
	
	return $perOptions;
}?>

<!-- JS -->
<script type="text/javascript">

	function gotoProducEdit(thiss, productId){
		window.location.href = '<?php echo base_url();?>Cproduct/product_update_form/'+productId;
	}
	function createPer1(unittype, arrayUnits, per){
	
		console.log(unittype);
		console.log(arrayUnits);

		var perOptions = '<option>Select</option>';

		if(unittype == "EACH"){

			perOptions = '<option>None</option>';

			$('#per2').html('<option>None</option>');
			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}
		else if(unittype == "INNER_CART"){
			

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "INNER_CART"){
				/*var aaa = arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo;
					var selected = '';
					if(per == aaa){
						selected = 'selected="selected"';
					}*/
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}

			$('#per2').html('<option>None</option>');
			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}

		else if(unittype == "CARTON"){
			

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "CARTON"){
				/*var aaa = arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo;
					var selected = '';
					if(per == aaa){
						selected = 'selected="selected"';
					}*/
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';


				}
			}

			$('#per2').html('<option>None</option>');

			$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');

		}

		else if(unittype == "PALLET"){
			

		for(var i=0; i<arrayUnits.length; i++){


				if(arrayUnits[i].perFrom == "PALLET"){
					/*var aaa = arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo;
					var selected = '';
					if(per == aaa){
						selected = 'selected="selected"';
					}*/
				perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';

				console.log(perOptions);
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

			return perOptions;


		}


		if(arr[2] == 'EACH'){

		var perOptions = '<option>None</option>';

			return perOptions;


		}
	}
	function selectNextValue(value, json, per, per2, per3, count){
		var jjson = json;
		json = $('.'+json);
		var jsonvalue = $(json).parent().children().next().next().val();
		console.log(jsonvalue);
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer1(value, jsonobject, per);
		$(json).parent().children().next().next().next().next().removeClass("hide1");
		console.log($(json).parent().find('.unittd'+count).html());
		$(json).parent().children().next().next().next().next().html(html1);
		setTimeout(function(){
			 	$('#per option[value="'+per+'"]').attr("selected", "selecteds");
				selectNextToNextValue(per, json, per2, per3)
		}, 1000);
		

	}
	
	function selectNextToNextValue(value, json, per2, per3){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject, per2);
		//$(".inner-per").html(html1);
		//$(json).parent().find(".inner-per").html(html1);
		$(json).parent().children().next().next().next().next().next().html(html1);
		$(json).parent().children().next().next().next().next().next().removeClass("hide2");
		
		setTimeout(function(){
			console.log(per2);
			 	$('#inner_per option[value="'+per2+'"]').attr("selected", "selecteds");
				selectNextToNextValue1(per2, json, per3)
		}, 1000);
		
		
	}
	function selectNextToNextValue1(value, json, per3){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer2(value, jsonobject);
		//$(".inner-per2").html(html1);
		//$(json).parent().find(".inner-per2").html(html1);
		$(json).parent().children().next().next().next().next().next().next().html(html1);
		$(json).parent().children().next().next().next().next().next().next().removeClass("hide3");
		setTimeout(function(){
			console.log(per3);
			 	$('#inner_per2 option[value="'+per3+'"]').attr("selected", "selecteds");
				//selectNextToNextValue1(per2, json, per3)
		}, 1000);
	}
    //Product select by ajax start
    $('body').on('change','#supplier_sss',function(event){
        event.preventDefault(); 
        var supplier_id=$('#supplier_sss').val();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax({
            url: '<?php echo base_url('Cpurchase/product_search_by_supplier')?>',
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

    //Product selection start
   /* $('body').on('change', '.productSelection', function(){
        var product_id = $(this).val();  
        var base_url = $('.baseUrl').val(); 
        var target = $(this).parent().parent().children().next().next().next().next().children();
        var item_cartoon = $(this).parent().next().next().children();
        var csrf_test_name=  $("[name=csrf_test_name]").val();
        $.ajax
        ({
            url: base_url+"Cinvoice/retrieve_product_data",
            data: {product_id:product_id,csrf_test_name:csrf_test_name},
            type: "post",
            success: function(data)
            {
                obj = JSON.parse(data);
                target.val(obj.supplier_price);
                item_cartoon.val(obj.cartoon_quantity);

                // var cartoon = $('.qty_calculate').val();
                // var item = $('.qty_calculate').parent().next().children().val();

                // // set quantity
                // $('.qty_calculate').parent().next().next().children().val(cartoon * item);

                // var rate = $('.qty_calculate').parent().next().next().next().children().val();
                // //set total
                // $('.qty_calculate').parent().next().next().next().next().children().val(rate * cartoon * item);
                // calculateSum();
            } 
        });
    });*/
	
	$('body').on('change', '.productSelection', function(){
		var product_id = $(this).val();  
        var base_url = $('.baseUrl').val(); 
        var target = $(this).parent().parent().children().next().next().next().children();
        var item_description = $(this).parent().next().next().next().children();
        var item_description1 = $(this).parent().next().next().next().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().next().next().children();
        var stock = $(this).parent().next().children();
        var thisone = $(this);
		console.log("haha");
		console.log(stock.val());
		console.log(target.html());
		console.log(item_description.html());
		console.log(item_description.val());
		console.log(item_description1.html());
		console.log(item_description1.val());
		console.log(item_description2.html());
		console.log(item_description2.val());
		console.log("do not laugh");

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
				console.log("newly created");
				if($("#supplier_sss").val()==""){
					$('#supplier_sss option[value="'+obj.supplier_id+'"]').attr('selected','selected');
					$("#supplier_sss").trigger("change");
				}
                var resultjson = JSON.parse(obj.product_information.unit_values);
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
                item_description1.html(selectoptionsunit);
				stock.val(obj.product_information.product_details);
                item_description2.val(0);
				item_description2.trigger("blur");
				console.log("last one");
              
            } 
        });
    });
    //Product selection end
	
	function deleteRow(e, purchase_detail_id) { 
        var t = $("#purchaseTable > tbody > tr").length;
        if (1 == t) alert("There only one row you can't delete.");
        else {
            var a = e.parentNode.parentNode;
            a.parentNode.removeChild(a)
        }
        calculateSum();
		$('form').append('<input type="hidden" value="'+purchase_detail_id+'" name="removed_purchased_id[]">');
    }
	
	function checkAllValues(){
		var flag1 = 0;
		var flag2 = 0;
		var flag3 = 0;
		var flag4 = 0;
		var flag5 = 0;
		
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
		
		$('.price_item1').each(function(i, value){
			if($(value).val()=='' || $(value).val()<=0){
				flag5 = 1;
			}	
		});
		$('.qty_calculator').each(function(i, value){
			if($(value).val()=='' || $(value).val()<=0){
				flag3 = 1;
			}	
		});
		$('.unitquantity').each(function(i, value){
			if($(value).val()=='Select'){
				flag2 = 1;
			}				
		});
		console.log(flag1);
		console.log(flag2);
		console.log(flag3);
		console.log(flag4);
		console.log(typeof flag5);
		if(flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0){
			return true;
		}else{
			if(flag5==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Cost should be greater than 0.</div><div></div>');
				$(".error").show();
				return false;
			}else if(flag3 ==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Quantity should not be blank. </div><div></div>');
				$(".error").show();
				return false;
			}else if(flag2 ==1){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Unit should not be blank. </div><div></div>');
				$(".error").show();
				return false;
			}else{
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Values. (Unit Values must be in each at last.)</div><div></div>');
				$(".error").show();
				return false;
			}
			
		}
		
	}
	
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
		console.log("last");
		console.log($(ths).parent().parent().children().next().val());
	}
	
	
	/* function addPurchaseInputField_val(){
		count == limits ? alert("You have reached the limit of adding " + count + " inputs") : $("tbody#addPurchaseItem").append('<tr><td class="span3 supplier"><select class="form-control productSelection dont-select-me" required="true">	<option value="">Select Product</option>	<?php foreach($all_product as $allprods):?>	<option value="<?php echo $allprods["product_id"];?>"><?php echo $allprods["product_name"];?></option>	<?php endforeach;?></select></td><input type="hidden" name="cartoon_item[]" value="" readonly="readonly" id="ctnqntt_1" class="form-control ctnqntt1 text-right" placeholder="<?php echo display("item_cartoon") ?>"/><input type="hidden" name="cartoon[]"  required  id="qty_item_1" class="form-control text-right qty_calculate" placeholder="0.00" value="" min="0"/> <td><textarea placeholder="<?php echo display("description") ?>" rows="4" cols="20" name="description[]"  readonly="readonly" id="description_1" ></textarea></td><td class="text-right"><input type="number" name="product_quantity[]" min="1" id="total_qntt_1" class="form-control qty_calculator text-right" placeholder="0.00" step="1" required/></td><td class="unitselect"><select name="unit[]" required="" class="form-control unitquantity dont-select-me" onchange="setPrice(this.value, this)" >    <option value="">Select</option>    <option value="EACH">EACH</option>    <option value="INNER_CART">INNER CART</option>    <option value="CARTON">CARTON</option>    <option value="PALLET">PALLET</option></select><input type="hidden" class="prdt_prcie" value=""><input type="hidden" class="productJson" value=""><input type="hidden" class="totalProduct" value=""></td><td class=""><input type="number" name="product_rate[]"  id="price_item_1" class="form-control price_item1 text-right" placeholder="0.00" value="" min="1" required /></td><td class="text-right"><input class="form-control total_price text-right" type="text" name="total_price[]" id="total_price_1" value="0.00" readonly="readonly" /></td><td><button style="text-align: right;" class="btn btn-danger red" type="button" value="<?php echo display("delete")?>" onclick="deleteRow(this)"><?php echo display("delete")?></button></td></tr>');
	} */
</script>
