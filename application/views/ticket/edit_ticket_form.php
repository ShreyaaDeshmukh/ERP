<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/purchase.js" type="text/javascript"></script>


<!-- Edit Purchase Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <!-- <h1><?php echo display('ticket_edit') ?></h1>
            <small><?php echo display('ticket_edit') ?></small>
			-->
			<h1>Ticket View</h1>
            <small>Ticket View</small>
			
            
			<ol class="breadcrumb"> 
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('ticket') ?></a></li>
                <li class="active"><?php echo display('ticket_edit') ?></li>
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
                            <!-- <h4><?php echo display('ticket_edit') ?></h4> -->
                            <h4>Ticket View</h4>
							
                        </div>
                    </div>
                   <?php echo form_open_multipart('Cticket/ticket_update',array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
                    <div class="panel-body">


                        <div class="row">
                            <!--<div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label"><?php echo display('supplier') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="supplier_name" value="{supplier_name}" class="form-control supplierSelection" placeholder='Type your Supplier Name' id="supplier_name" >
                                        <input type="hidden" class="supplier_hidden_value" name="supplier_id" value="{supplier_id}" id="suppluerHiddenId"/>
                                    </div>
                                   
                                </div> 
                            </div>-->

                             <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('customer') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5">
                                        <input type="text" name="customer_name" value="{customer_name}" class="form-control customerSelection" placeholder='Type your customer Name' id="customer_name" >
                                        <input type="hidden" class="customer_hidden_value" name="customer_id" value="{customer_id}" id="customerHiddenId"/>
                                    </div>
                                    <!--<div class="col-sm-3">
                                        <a href="<?php echo base_url('Ccustomer'); ?>"><?php echo display('add_customer') ?></a>
                                    </div>-->
                                </div>
                            </div>
							
							 <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="date" class="col-sm-4 col-form-label"><?php echo display('ship_to') ?>
                                        <i class="text-danger">*</i>
                                    </label>
                                    <div class="col-sm-5 shipTo">
                                        <?php $address = json_decode($ship_to);
											foreach($address as $addr){
										?>
										<textarea cols="20" rows="2" name="ship_to[]"><?php echo $addr;?></textarea>
										<?php } ?>
                                    </div>
                                   <!--  <div class="col-sm-3">
                                        <a href="#" id="addShipTo"><?php echo "Add More" ?></a>
                                    </div> -->
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

                        <div class="row">
                             <table class="table" style="margin-left:15px;width:95%">
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
                                        <input type="text" class="form-control datepicker" name="ticket_date" value="{ticket_date}" id="ticket_date" required/>
                                    </td>
                                <td>
                                    <input type="text" class="form-control datepicker" name="ship_date" value="{ship_date}" id="ship_date" required  />
                                </td>
                                <td>
                                     <input type="text" class="form-control" name="customer_po" value="{customer_po}" id="customer_po" required  />
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="ship_method" value="{ship_method}" id="ship_method" required />
                                </td>
                                </tr>
                            </tbody>
                          </table>
                            
                        </div>

                        <div class="" style="margin-top: 10px">
                            <table class="table table-bordered table-hover" style="width:95%;">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('item_information') ?></th>
                                        <th class="text-center"><?php echo display('description') ?></th>
                                        <!--<th class="text-center"><?php echo display('price') ?></th>-->
                                        <th class="text-center"><?php echo display('quantity') ?> </th>
                                        <th class="text-center"><?php echo display('location') ?></th>
										<th class="text-center">Unit</th>
                                        <!--<th class="text-center"><?php echo display('action') ?></th>-->
                                    </tr>
                                </thead>

                				<tbody id="addPurchaseItem">
        						{purchase_info}
        			                <tr>

 <td style="width: 200px;text-align: center;">
    <input type="text" name="product_name" onclick="purchase_productList({sl});" value="{product_name}-({product_model})" required class="form-control productSelection" placeholder='Type your Product Name' id="product_name_{sl}" >
    <input type="hidden" class="product_id_{sl} autocomplete_hidden_value product_id_{sl}" name="product_id[]" value="{product_id}" id="SchoolHiddenId"/>
    <input type="hidden" class="baseUrl" value="<?php echo base_url();?>" />
</td>       



<td><textarea name="product_details[]" id="description_1" value="{product_details}"  cols="30" rows="4" class="description1" readonly="readonly">{product_details}</textarea></td>

<!-- <td class="text-right">
<input type="text" name="product_details[]" value="{product_details}" readonly="readonly" id="description_1"
class="form-control text-right"/></td> -->


<!--<td>
    <input type="text" name="product_rate[]"  value="{rate}" onkeyup="quantity_calculate({sl});" onchange="quantity_calculate({sl});" id="price_item_{sl}" class="form-control price_item{sl} text-right" min="0" />
</td>--->

<td class="text-right">
    <input type="text" name="product_quantity[]" value="{quantity}" readonly="readonly" id="total_qntt_{sl}" class="form-control text-right" />
</td>

<td class="text-right">
	<label>{location}</label>
     <!-- <select class="form-control locations dont-select-me btnSelect" name="locations[]" required></select>
	 <script>setTimeout(function(){
		 selectProductLocations('{product_id}', '{location}');
	 },1000)</script> -->
    <input type="hidden" name="ticket_detail_id[]" value="{ticket_detail_id}"/>
</td>
<td>

<input type="text" name="product_unit[]" value="{unit}" readonly="readonly" id="product_unit{sl}" class="form-control text-right" />

</td>
 <!-- <td>
    <button style="text-align: right;" class="btn btn-danger" type="button" value="Delete" onclick="deleteRow(this)"><?php echo display('delete')?></button>
</td> -->
<input type="hidden" name="ticket_id" value="{ticket_id}">
                                    </tr>
        						{/purchase_info}
        						</tbody>
        						<!--<tfoot>
        							<tr>
        								<td colspan="2">
                                            <?php echo display('if_you_update_purchase_first_select_supplier_then_product_and_then_cartoon')?>                        
                                        </td>
        								<td>
        									<input type="hidden" name="baseUrl" class="baseUrl" value="<?php echo base_url();?>"/>
        								</td>
        								<td style="text-align:right;"><b><?php echo display('grand_total') ?>:</b></td>
        								<td class="text-right">
                                            <input type="text" id="grandTotal" value="{grand_total}" tabindex="-1" class="text-right form-control" name="grand_total_price" tabindex="-1" value="0.00" readonly="readonly" />
        								</td>
        							</tr>
        						</tfoot>-->
                            </table>
                        </div>
                        <div class="form-group row">
                            <!-- <div class="col-sm-6">
                                <input type="submit" id="add-purchase" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('save_changes') ?>"/>
                            </div> -->
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


<!-- JS -->
<script type="text/javascript">
   function checkthetypeflag(value, thisone){
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
	function selectNextValue(value, json){
		var jsonvalue = $(json).parent().children().next().next().val();
		var jsonobject = JSON.parse(jsonvalue);
		var html1 = createPer1(value, jsonobject);
		console.log(html1);
		console.log($(json).siblings().html());
		$(json).parent().children().next().next().next().next().html(html1);
	}
	
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
		var fetchvalueflag = $("#fetchflag").prop("checked");
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
    });
    //Product select by ajax end

   // Product selection start
    $('body').on('change', '.productSelection', function(){
        var product_id = $(this).val();  
        var base_url = $('.baseUrl').val(); 
        var location = $(this).parent().parent().children().next().next().next().next().next().next();
        var target = $(this).parent().parent().children().next().next().next().next().next().next();
        
        var item_description = $(this).parent().next().next().next().children();
        var item_description1 = $(this).parent().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
        var stock = $(this).parent().parent().next().children();
		
		
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
                var resultjson = JSON.parse(obj.product_information.unit_values);
					$.each(resultjson,function(i, value){
				});
				var locationhtml = '';
				$.each(obj.locations, function(i, value){
					locationhtml += '<option value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key;
					locationhtml += '</option>';
				})
				//target.val(obj.supplier_price);
                //rate.val(obj.supplier_price);
                //console.log(thisone.parent().parent().children().html());
                //stock.val(obj.supplier_price);
                location.find('.locations').html(locationhtml);
                //console.log(item_description2.parent().find('.prdt_prcie').val(obj.supplier_price));
                item_description2.parent().find('.productJson').val(obj.product_information.unit_values);
				console.log(item_description1.html());
                price.val(obj.supplier_price);
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
	
	function checkAllValues(){
			return true;	
	}
	
	
	
	function selectProductLocations(product_id, location_id){
		var product_id = product_id;
console.log(product_id);		
		var base_url = $('.baseUrl').val(); 
        var location = $(this).parent().parent().children().next().next().next().next().next().next();
        console.log(location.html());
		var target = $(this).parent().parent().children().next().next().next().next().next().next();
        
        var item_description = $(this).parent().next().next().next().children();
        var item_description1 = $(this).parent().next().next().next().children();
        var item_description2 = $(this).parent().next().next().next().next().next().children();
        var stock = $(this).parent().parent().next().children();
		
		
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
                var resultjson = JSON.parse(obj.product_information.unit_values);
					$.each(resultjson,function(i, value){
				});
				var locationhtml = '';
				$.each(obj.locations, function(i, value){
					var selected = "";
					if(value.location_unique_key==location_id){
						 selected = 'selected="selected"';
					}
					locationhtml += '<option '+selected+' value='+value.location_unique_key+"###"+product_id+'>';
					locationhtml += value.location_unique_key;
					locationhtml += '</option>';
				})
				console.log(locationhtml);
				$('.locations').html(locationhtml);
                item_description2.parent().find('.productJson').val(obj.product_information.unit_values);
				console.log(item_description1.html());
                price.val(obj.supplier_price);
                stock.find('.description1').val(obj.product_information.product_details);
                // calculateSum();
            } 
        });
	}
	
	$(document).ready(function(){
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
		var html = '<textarea cols="30" rows="2" name="ship_to[]" required placeholder="Write Ship To Address"></textarea>';
		$('.shipTo').append(html);
	})
	
	
});
</script>
