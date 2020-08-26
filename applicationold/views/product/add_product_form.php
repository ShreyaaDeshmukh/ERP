<!-- Add Product Start -->
<style>
#error_handler{
	text-align:center;
}
.vl {
    border-left: 1px solid #45C203;
    height: 100px;
    position: inherit;
    left: 110%;
    margin-left: -3px;
    top: -80px;
}
.vl1 {
       border-left: 1px solid #45C203;
    height: 100px;
    position: absolute;
    left: 110%;
    margin-left: -3px;
    top: -12px;
}
form.cmxform label.error, label.error{
	color: red;
    font-style: italic;
    font-size: 13px;
     width: 10em;
}
</style>
<?php $r_id = $this->session->r_id; 
print_r($r_id); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('new_product') ?></h1>
            <small><?php echo display('add_new_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('new_product') ?></li>
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

        <!-- Add Product -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('new_product') ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cproduct/insert_product/'.$r_id,array('class' => 'form-vertical', 'id' => 'insert_product','name' => 'insert_product', 'onsubmit' => 'return checkValidation()'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required  tabindex='1' onkeyup="return checkProductName(this.value);">
                                    </div>
									<div class="col-sm-8">
								<div id="error_handler" style="width: 365px;color: rgb(255, 0, 0);float: left;text-align: right;"></div>
							</div>

                                </div>
                            </div>
						
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label">Description<i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="3"  required="" placeholder="Description" tabindex='2'></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control dont-select-me" id="category_id" name="category_id"  required="" tabindex='3'>
                                        <option value=""><?php echo display('select_one') ?></option>
                                        <?php
                                            if ($category_list) {
                                        ?>
                                        {category_list}
                                            <option value="{category_id}">{category_name}</option>
                                        {/category_list}
                                        <?php
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="image" class="col-sm-4 col-form-label"><?php echo display('image') ?> </label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control" id="image" tabindex='4'>
                                    </div>
                                </div> 
                            </div>
                        </div>
						
                        <div class="table-responsive" style="margin-top: 10px">
                            <?php /*<table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!--<th class="text-center"><?php echo display('innercart_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('cartoon_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('pallet_quantity') ?> <i class="text-danger">*</i></th>-->
                                        <!--<th class="text-center"><?php echo display('sell_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>-->
                                        <!--<th class="text-center"><?php //echo display('model') ?> </th>-->
                                       
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
										<!--<td class="">
                                            <input class="form-control text-right" name="innercart_quantity" type="number" required="" placeholder="<?php echo display('innercart_quantity') ?>" tabindex="5" min="0">
                                        </td>
                                        <td class="">
                                            <input class="form-control text-right" name="cartoon_quantity" type="number" required="" placeholder="<?php echo display('cartoon_quantity') ?>" tabindex="5" min="0">
                                        </td>  
                                        <td class="">
                                            <input class="form-control text-right" name="pallet_quantity" type="number" required="" placeholder="<?php echo display('pallet_quantity') ?>" tabindex="5" min="0">
                                        </td>  -->   
                                        <!--<td class="">
                                            <input class="form-control text-right" name="price" type="number" required="" placeholder="<?php echo display('sell_price') ?>" tabindex="6" min="1">
                                        </td>
                                        <td class="">
                                            <input type="number" tabindex="7" class="form-control text-right" name="supplier_price" placeholder="<?php echo display('supplier_price') ?>"  required  min="1"/>
                                        </td>-->
                                        <!--<td class="text-right">
                                            <input type="text" tabindex="8" class="form-control" name="model" placeholder="<?php echo display('model') ?>"  />
                                        </td>-->
                                        
                                        <td class="">
                                            <select name="supplier_id" class="form-control dont-select-me" required="" tabindex='9'>
                                            <?php
                                                if ($supplier){
                                            ?>
                                                <option value=""><?php echo display('select_one')?> 
                                                </option>
                                            {supplier}
                                                <option value="{supplier_id}">{supplier_name} 
                                                </option>
                                            {/supplier}
                                            <?php
                                                }
                                            ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table> */ ?>
                        </div>
						<div class="row">
							<div class="col-md-2">
								<label style="width:100%;"><?php echo display("lot_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input type="checkbox" name="lot_flag" value="1"   tabindex="5">
								  <span class="slider round"></span>
								</label>
							</div>
							
							<div class="col-md-2">
								<label style="width:100%;"><?php echo display("expiry_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input type="checkbox" name="expiry_flag"  value="1" tabindex="6">
								  <span class="slider round"></span>
								</label>
							</div>
							
							<div class="col-md-2">
								<label style="width:100%;"><?php echo "Serial Required"?></label>
							</div>
							<div class="col-md-2">
								<label class="switch" >
								  <input type="checkbox" name="serial_flag"  value="1" tabindex="7" id="serial_flag" onclick="checkSerialFlag(this);">
								  <span class="slider round"></span>
								</label>
							</div>
							
						</div>
						<br/>
						<div class="row">
							<div class="col-md-2">
								<label style="width:100%;"><?php echo display("supplier");?></label>
							</div>
							<div class="col-md-4">
								 <select name="supplier_id" class="form-control dont-select-me" required="" tabindex='8'>
                                            <?php
                                                if ($supplier){
                                            ?>
                                                <option value=""><?php echo display('select_one')?> 
                                                </option>
                                            {supplier}
                                                <option value="{supplier_id}">{supplier_name} 
                                                </option>
                                            {/supplier}
                                            <?php
                                                }
                                            ?>
                                            </select>
							</div>
							
							
						</div>
						
						<br/>
						<div class="row unitcontainer">
						<!--<fieldset><legend>-->
						<h4 style="margin-left:10px;">Unit Management Per Quantity</h4><br/>
						<!--</legend>-->
						<?php //$unitarr = array(array("IC", "EA"), array("CR", "EA"), array("CR", "IC"), array("PL", "CR"));
						//$i = 0;
						//foreach($unitarr as $unit){ 
						?>
						<div class="row" style="margin-left:20px;">
							<div class="unitbunch">
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="first[]" class="form-control dont-select-me firstdd perFrom" tabindex='9'>
										<option value="">Select</option>
										<option value="EACH">Each</option>
										<option value="INNER_CART">Inner-Carton</option>
										<option value="CARTON">Carton</option>
										<option value="PALLET">Pallet</option>
									</select>
									<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty0" readonly="true" tabindex='10'>
									</div>
									<div class="vl"></div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="second[]" class="form-control dont-select-me seconddd perTo" tabindex='11'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty" tabindex='12'>
									<div class="vl1"></div>
									</div>
								</div>
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="third[]" class="form-control dont-select-me thirddd perTo1" tabindex='13'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty1" tabindex='14'>
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1" tabindex='15'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty2" tabindex='16'>
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-1 form-group" style="width:9%;">
									<div><b>Sell Price</b></div>
									<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals" required  tabindex='17' step="0.01"></div>
								</div>
								
								<div class="col-md-1 form-group" style="width:12%;">
									<div><b>Vendor Price</b></div>
									<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price" required  tabindex='18' step="0.01"></div>
								</div>
								
								<div class="col-md-1">
									<span class="glyphicon glyphicon-plus plusicon"></span>
								</div>
							
							</div>
							
							<div class="unitbunch1" style="display:none;">
								
							</div>
								
						</div>
						<?php //$i++;}?>
						<div class="addmore" style="margin-left:35px;"></div>
						
						<!--</fieldset>-->
						</div>
						
						<div class="form-group row">
                            <div class="col-sm-3">
                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='19'/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex='20'>
                            </div>
							<div class="col-sm-3">
								<div class="errorhandler"></div>
							</div>
							
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
function checkSerialFlag(thisone){
	var checkprop = $(thisone).prop("checked");
	if(checkprop==true){
		//$('.plusicon').hide();
		//$('.firstdd option[value="EACH"]').attr("selected", "selected");
		//$('.firstdd').trigger("change");
		$(".unitbunch1").show();
		$(".addmore").hide();
		$(".addmore").html('');
		$(".unitbunch").html('');
		$(".unitbunch").hide();
		$(".unitbunch").attr("disabled", "disabled");
		$(".addmore").attr("disabled", "disabled");
		
var myvar = '<div class="col-md-2 form-group">'+
'									<div class="input-group">'+
'									<select name="first[]" class="form-control dont-select-me firstdd1 perFrom" tabindex=\'9\'>'+
'										<option value="">Select</option>'+
'										<option value="EACH">Each</option>'+
'									</select>'+
'									<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty01" readonly="true" tabindex=\'10\'>'+
'									</div>'+
'									<div class="vl"></div>'+
'								</div>'+
'								'+
'								<div class="col-md-2 form-group">'+
'									<div class="input-group">'+
'									<select name="second[]" class="form-control dont-select-me seconddd1 perTo" tabindex=\'11\'>'+
'										<option value="Select">Select</option>'+
'										'+
'									</select>'+
'									<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty1" tabindex=\'12\' disabled="disabled">'+
'									<div class="vl1"></div>'+
'									</div>'+
'								</div>'+
'								<div class="col-md-2 form-group">'+
'									<div class="input-group">'+
'									<select name="third[]" class="form-control dont-select-me thirddd1 perTo1" tabindex=\'13\'>'+
'										<option value="Select">Select</option>'+
'										'+
'									</select>'+
'									<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty11" tabindex=\'14\' disabled="disabled">'+
'									<div class="vl1"></div>'+
'									</div>'+
'								</div>'+
'								'+
'								<div class="col-md-2 form-group">'+
'									<div class="input-group">'+
'									<select name="fourth[]" class="form-control dont-select-me fourthddd1 perTo1" tabindex=\'15\'>'+
'										<option value="Select">Select</option>'+
'										'+
'									</select>'+
'									<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty21" tabindex=\'16\' disabled="disabled">'+
'									<div class="vl1"></div>'+
'									</div>'+
'								</div>'+
'								'+
'								<div class="col-md-1 form-group" style="width:9%;">'+
'									<div><b>Sell Price</b></div>'+
'									<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals1" required  tabindex=\'17\' step="0.01"></div>'+
'								</div>'+
'								'+
'								<div class="col-md-1 form-group" style="width:12%;">'+
'									<div><b>Vendor Price</b></div>'+
'									<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price1" required  tabindex=\'18\' step="0.01"></div>'+
'								</div>';
$(".unitbunch1").html(myvar);
	

	}else{
		//$('.firstdd option[value=""]').attr("selected", "selected");
		//$('.firstdd').trigger("change");
		//$('.plusicon').show();
		
		
		//var html = '<div class="newhtml row">';
		//html += $('.unitbunch').html();
		
		var html = '<div class="newhtml row">';
		html += '<div class="newhtml row">';
		html += 	'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="first[]" class="form-control dont-select-me firstdd perFrom">';
		html += 		'<option value="">Select</option>';
		html += 		'<option value="EACH">Each</option>';
		html += 		'<option value="INNER_CART">Inner-Carton</option>';
		html += 		'<option value="CARTON">Carton</option>';
		html += 		'<option value="PALLET">Pallet</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty0" readonly="true">';
		html += 		'</div>';
		html += 		'<div class="vl"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="second[]" class="form-control dont-select-me seconddd perTo">';
											
											
		html += 		'<option value="">Select</option>';
		
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="third[]" class="form-control dont-select-me thirddd perTo1">';
										
											
		html += 		'<option value="">Select</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty1">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1">';
											
		html += 		'<option value="">Select</option>';
																						
		html += 		'</select>';
										
		html += 		'<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty2">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:9%;">';
		html += 		'<div><b>Sell Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals" step=".01"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:12%;">';
		html += 		'<div><b>Vendor Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price" step=".01"></div>';
		html += 		'</div>';
		//html += 		'<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		//html += $('.unitbunch').html();
		html += '<div class="col-md-1"><span class="glyphicon glyphicon-plus plusicon" onclick = "return addrow();"></span></div></div>';
		
		//html += '<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		$('.unitbunch').append(html);
		
		
		
		
	
	
	
			
		$('.firstdd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';

				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().find('.pertoqty').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.seconddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.thirddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				//$(this).parent().parent().parent().children().next().find('.pertoqty').attr("disabled", "disabled");
				//$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("disabled", "disabled");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
		
		
		
		
		
		
		$(".unitbunch").show();
		$(".unitbunch1").html('');
		$(".unitbunch1").hide();
		$(".addmore").show();
		$(".unitbunch").removeAttr("disabled");
		$(".addmore").removeAttr("disabled");
		$(".unitbunch1").html('');
		
		
		
	}
	
}
function checkValidation(){
	var checkprop = $("#serial_flag").prop("checked");
	if(checkprop==true){
		var flag1 = 0;
		var flag2 = 0;
		var flag3 = 0;
		var flag4 = 0;
		var flag5 = 0;
		var flag6 = 0;
		var flag7 = 0;
		var flag8 = 0;
		var flag9 = 0;
		var flag10 = 0;
		var flag11 = 0;
		$('.firstdd1').each(function(i, value){
			console.log(i);
			console.log(value);
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				flag1 = 1;
				return false;
			}	
		});
		
		$('.seconddd1').each(function(i, value){
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag2 = 1;
				return false;
			}
		});
		
		$('.thirddd1').each(function(i, value){
			console.log($(this).val());
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag10 = 1;
				return false;
			}
		});
		
		
		
		$('.fourthddd1').each(function(i, value){
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag11 = 1;
				return false;
			}
		});
		
		
		
		
		$('.valuesss1').each(function(i, value){
		if($(this).val()=='' || $(this).val()==0){
				
				//return false;
				flag3 = 1;
				return false;
			}
		});
		
		$('.totals1').each(function(i, value){
		if($(this).val()=='' || $(this).val()==0){
				//return false;
				flag4 = 1;
				return false;
			}
		});
		
		$('.pertoqty01').each(function(i, value){
		if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag5 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty1').each(function(i, value){
		if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag6 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty11').each(function(i, value){
			if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag7 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty21').each(function(i, value){
			if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag8 = 1;
					return false;
				}
			}
		});
		console.log("flag1===>"+flag1);
		console.log("flag2===>"+flag2);
		console.log("flag3===>"+flag3);
		console.log("flag4===>"+flag4);
		console.log("flag5===>"+flag5);
		console.log("flag6===>"+flag6);
		console.log("flag7===>"+flag7);
		console.log("flag8===>"+flag8);
		console.log("flag10===>"+flag10);
		console.log("flag11===>"+flag11);
		if(flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0 && flag6==0 && flag7==0 && flag8==0 && flag10==0 && flag11==0){
			//return true;
			
			console.log("tesat ets asdaffd");
			var product_name = $("#product_name").val();
			var url = "Cproduct/checkProductname";
			$.ajax({

					url: url,

					type: 'post',

					success: function (data) {
						console.log(data);return false;
						if(data=="1"){
							$("#error_handler").text("This category name already exist, please try another");
							return false;
						}else{
							
							return false;
						}
					},

					data: {product_name:product_name}

				});
			
		}else{
			$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
			$(".error").show();
			return false;
		}
	}else{
		var flag1 = 0;
		var flag2 = 0;
		var flag3 = 0;
		var flag4 = 0;
		var flag5 = 0;
		var flag6 = 0;
		var flag7 = 0;
		var flag8 = 0;
		var flag9 = 0;
		var flag10 = 0;
		var flag11 = 0;
		$('.firstdd').each(function(i, value){
			console.log(i);
			console.log(value);
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				flag1 = 1;
				return false;
			}	
		});
		
		$('.seconddd').each(function(i, value){
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag2 = 1;
				return false;
			}
		});
		
		$('.thirddd').each(function(i, value){
			console.log($(this).val());
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag10 = 1;
				return false;
			}
		});
		
		
		
		$('.fourthddd').each(function(i, value){
			if($(this).val()==''){
				$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
				$(".error").show();
				
				flag11 = 1;
				return false;
			}
		});
		
		
		
		
		$('.valuesss').each(function(i, value){
		if($(this).val()=='' || $(this).val()==0){
				
				//return false;
				flag3 = 1;
				return false;
			}
		});
		
		$('.totals').each(function(i, value){
		if($(this).val()=='' || $(this).val()==0){
				//return false;
				flag4 = 1;
				return false;
			}
		});
		
		$('.pertoqty0').each(function(i, value){
		if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag5 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty').each(function(i, value){
		if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag6 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty1').each(function(i, value){
			if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag7 = 1;
					return false;
				}
			}
		});
		
		$('.pertoqty2').each(function(i, value){
			if($(this).prop("readOnly")==false){	
			if($(this).val()=='' || $(this).val()==0){
					//return false;
					flag8 = 1;
					return false;
				}
			}
		});
		console.log("flag1===>"+flag1);
		console.log("flag2===>"+flag2);
		console.log("flag3===>"+flag3);
		console.log("flag4===>"+flag4);
		console.log("flag5===>"+flag5);
		console.log("flag6===>"+flag6);
		console.log("flag7===>"+flag7);
		console.log("flag8===>"+flag8);
		console.log("flag10===>"+flag10);
		console.log("flag11===>"+flag11);
		if(flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0 && flag6==0 && flag7==0 && flag8==0 && flag10==0 && flag11==0){
			//return true;
			
			console.log("tesat ets asdaffd");
			var product_name = $("#product_name").val();
			var url = "Cproduct/checkProductname";
			$.ajax({

					url: url,

					type: 'post',

					success: function (data) {
						console.log(data);return false;
						if(data=="1"){
							$("#error_handler").text("This category name already exist, please try another");
							return false;
						}else{
							
							return false;
						}
					},

					data: {product_name:product_name}

				});
			
		}else{
			$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
			$(".error").show();
			return false;
		}
	}
	
	
}
$(document).ready(function(){

	$('.plusicon').click(function(){
		//var html = '<div class="newhtml row">';
		//html += $('.unitbunch').html();
		
		var html = '<div class="newhtml row">';
		html += '<div class="newhtml row">';
		html += 	'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="first[]" class="form-control dont-select-me firstdd perFrom">';
		html += 		'<option value="">Select</option>';
		html += 		'<option value="EACH">Each</option>';
		html += 		'<option value="INNER_CART">Inner-Carton</option>';
		html += 		'<option value="CARTON">Carton</option>';
		html += 		'<option value="PALLET">Pallet</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty0" readonly="true">';
		html += 		'</div>';
		html += 		'<div class="vl"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="second[]" class="form-control dont-select-me seconddd perTo">';
											
											
		html += 		'<option value="">Select</option>';
		
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="third[]" class="form-control dont-select-me thirddd perTo1">';
										
											
		html += 		'<option value="">Select</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty1">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1">';
											
		html += 		'<option value="">Select</option>';
																						
		html += 		'</select>';
										
		html += 		'<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty2">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:9%;">';
		html += 		'<div><b>Sell Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals" step=".01"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:12%;">';
		html += 		'<div><b>Vendor Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price" step=".01"></div>';
		html += 		'</div>';
		//html += 		'<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		//html += $('.unitbunch').html();
		html += '<div class="col-md-1"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		
		//html += '<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		$('.addmore').append(html);
		$('.minusicon').click(function(){
			$(this).parent().parent().children().remove();
		});
			
		$('.firstdd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';

				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().find('.pertoqty').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.seconddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.thirddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				//$(this).parent().parent().parent().children().next().find('.pertoqty').attr("disabled", "disabled");
				//$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("disabled", "disabled");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	})
	
	$('.minusicon').click(function(){
		$(this).parent().parent().remove();
	})
	
	$('.firstdd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';

				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.seconddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.thirddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				//$(this).parent().parent().parent().children().next().find('.pertoqty').attr("disabled", "disabled");
				//$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("disabled", "disabled");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
})

function checkProductName(value){
		console.log(value);
	
		$.ajax
				({
					url: "<?php echo base_url('Cproduct/checkProductnames')?>",
					data: {product_name:value},
					type: "post",
					success: function(data)
					{
						var obj = JSON.parse(data);
						if(obj.status=="false"){
							$("#error_handler").text(obj.msg);
							$("#error_handler").css("width","365px");
							$("#error_handler").css("color","red");
							$("#add-product").attr("disabled", "disabled");
							$("#add-product-another").attr("disabled", "disabled");
							return false;
						}else{
							$("#error_handler").text("");
							$("#add-product").removeAttr("disabled");
							$("#add-product-another").removeAttr("disabled");
							return true;
						}
					} 
				});
	}
	
	
	function addrow(){
		var html = '<div class="newhtml row">';
		html += '<div class="newhtml row">';
		html += 	'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="first[]" class="form-control dont-select-me firstdd perFrom">';
		html += 		'<option value="">Select</option>';
		html += 		'<option value="EACH">Each</option>';
		html += 		'<option value="INNER_CART">Inner-Carton</option>';
		html += 		'<option value="CARTON">Carton</option>';
		html += 		'<option value="PALLET">Pallet</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty0" readonly="true">';
		html += 		'</div>';
		html += 		'<div class="vl"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="second[]" class="form-control dont-select-me seconddd perTo">';
											
											
		html += 		'<option value="">Select</option>';
		
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="third[]" class="form-control dont-select-me thirddd perTo1">';
										
											
		html += 		'<option value="">Select</option>';
		html += 		'</select>';
		html += 		'<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty1">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1">';
											
		html += 		'<option value="">Select</option>';
																						
		html += 		'</select>';
										
		html += 		'<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty2">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:9%;">';
		html += 		'<div><b>Sell Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals" step=".01"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group" style="width:12%;">';
		html += 		'<div><b>Vendor Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price" step=".01"></div>';
		html += 		'</div>';
		//html += 		'<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		//html += $('.unitbunch').html();
		html += '<div class="col-md-1"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		
		//html += '<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		$('.addmore').append(html);
		$('.minusicon').click(function(){
			$(this).parent().parent().children().remove();
		});
			
		$('.firstdd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';

				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().find('.pertoqty').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.seconddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
				$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("readOnly", "true");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.thirddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	
	$('.thirddd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="EACH"){
				html = '';
				html += '<option value="Select">Select</option>';	
				//$(this).parent().parent().parent().children().next().find('.pertoqty').attr("disabled", "disabled");
				//$(this).parent().parent().parent().children().next().next().find('.pertoqty1').attr("disabled", "disabled");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').attr("readOnly", "true");
		}
		console.log(html);
		console.log($(this).parent().parent().parent().children().next().html());
		$(this).parent().parent().parent().children().next().find('.fourthddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	});
	}
</script>
<!-- Add Product End -->



