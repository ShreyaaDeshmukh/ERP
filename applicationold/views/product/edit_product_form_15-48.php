<!-- Edit Product Start -->
<style>
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

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('product_edit') ?></h1>
            <small><?php echo display('edit_your_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('product_edit') ?></li>
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
                            <h4><?php echo display('product_edit') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Cproduct/product_update', array('class' => 'form-vertical', 'id' => 'product_update', 'name' => 'product_update', 'onsubmit' => 'return checkValidation()')) ?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" value="{product_name}" required tabindex='1'>

                                        <input type="hidden" name="product_id" value="{product_id}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label">Description <i class="text-danger"></i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="4" cols="20" required="true" tabindex='2'>{product_details}</textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('category') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <?php // echo '<pre>';                                print_r($category_selected); ?>
                                        <select name="category_id" class="form-control" tabindex='3'>
                                            <?php
                                            foreach ($category_list as $category) {
                                                if ($category_selected[0]['category_id'] == $category['category_id']) {
                                                    echo "<option selected value=" . $category['category_id'] . ">" . $category['category_name'] . "</option>";
                                                } else {
                                                    echo "<option value=" . $category['category_id'] . ">" . $category['category_name'] . "</option>";
                                                }
                                            }
                                            ?>
                                            <!--                                            {category_list}
                                                                                        <option value="{category_id}">{category_name} </option>
                                                                                        {/category_list}-->
                                            <?php
//                                            if ($category_selected) {
                                            ?>
                                            <!--                                                {category_selected}
                                                                                            <option selected value="{category_id}">{category_name} </option>-->
                                            {/category_selected}
                                            <?php
//                                            } else {
                                            ?>
                                            <!--<option selected value="0"><?php // echo display('category_not_selected') ?></option>-->
                                            <?php
//                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('image') ?></label>
                                    <div class="col-sm-8">
                                        <input type="file" name="image" class="form-control">
                                        <img class="img img-responsive text-center" src="{image}" height="80" width="80" style="padding: 5px;" tabindex='4'>
                                        <input type="hidden" value="{image}" name="old_image">
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
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('model') ?></th>-->
                                        <th class="text-center"><?php echo display('supplier') ?> <i class="text-danger">*</i></th>
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <tr class="">
										<!--<td class="">
                                            <input class="form-control text-right" name="innercart_quantity" type="number" value="{innercart_quantity}" required="" placeholder="<?php echo display('innercart_quantity') ?>" tabindex="3" min="0">
                                        </td>
                                        <td class="">
                                            <input class="form-control text-right" name="cartoon_quantity" type="number" value="{cartoon_quantity}" required="" placeholder="<?php echo display('cartoon_quantity') ?>" tabindex="3" min="0">
                                        </td> 
                                        <td class="">
                                            <input class="form-control text-right" name="pallet_quantity" type="number" value="{pallet_quantity}" required="" placeholder="<?php echo display('pallet_quantity') ?>" tabindex="3" min="0">
                                        </td>    -->         
                                        <!--<td class="">
                                            <input class="form-control text-right" name="price" type="number" value="{price}" required="" placeholder="<?php echo display('sell_price') ?>" tabindex="3" min="1">
                                        </td>
                                        <td class="text-right">
                                            <input type="number" tabindex="4" class="form-control text-right" value="{supplier_price}" name="supplier_price" placeholder="<?php echo display('supplier_price') ?>"  required min="1"/>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="5" class="form-control" value="{product_model}" name="model" placeholder="<?php echo display('model') ?>" />
                                        </td>-->

                                        <td class="text-right">
                                            <select name="supplier_id" class="form-control">
                                                {supplier_list}
                                                <option value="{supplier_id}">{supplier_name} </option>
                                                {/supplier_list}
                                                <?php
                                                if ($supplier_selected) {
                                                    ?>
                                                    {supplier_selected}
                                                    <option selected value="{supplier_id}">{supplier_name} </option>
                                                    {/supplier_selected}
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option selected value="0"><?php echo display('supplier_not_selected') ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>*/ ?>
                        </div>
						
						<div class="row">
							<div class="col-md-2">
								<label style="width:100%;"><?php echo display("lot_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								
								  <input  tabindex='5' type="checkbox"  value="1" name="lot_flag" <?php if($lot_flag==1){?> checked <?php }?> <?php if($lot_exp_serial_flag==1){?> disabled="disabled" <?php }?>>
								  <span class="slider round"></span>
								</label>
							</div>
							
							<div class="col-md-2">
								<label style="width:100%;"><?php echo display("expiry_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input tabindex='6' type="checkbox" value="1" name="expiry_flag"  <?php if($expiry_flag==1){?> checked <?php }?><?php if($lot_exp_serial_flag==1){?> disabled="disabled" <?php }?>>
								  <span class="slider round"></span>
								</label>
							</div>
							
							<div class="col-md-2">
								<label style="width:100%;"><?php echo "Serial Flag";?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input tabindex='7'  onclick="checkSerialFlag(this);" type="checkbox" value="1" name="serial_flag" id="serial_flag"  <?php if($serial_flag==1){?> checked <?php }?><?php if($lot_exp_serial_flag==1){?> disabled="disabled" <?php }?>>
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
								<select name="supplier_id" class="form-control" tabindex='8'>
                                                {supplier_list}
                                                <option value="{supplier_id}">{supplier_name} </option>
                                                {/supplier_list}
                                                <?php
                                                if ($supplier_selected) {
                                                    ?>
                                                    {supplier_selected}
                                                    <option selected value="{supplier_id}">{supplier_name} </option>
                                                    {/supplier_selected}
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option selected value="0"><?php echo display('supplier_not_selected') ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
							</div>
							
							
						</div>
						<br/>
						<div class="unitcontainer">
						<fieldset><legend>Unit Management Per Quantity</legend>
						<?php $i=0;if(!empty($unit_values)){
							
							foreach($unit_values as $key=>$unit){ 
						if(!empty($unit)){
							
						$arraykeys = array_keys($unit);
						$arrayvalues = array_values($unit);
						$arrayUnits["PALLET"] = array("Each"=>"EACH","Inner-Carton"=>"INNER_CART","Carton"=>"CARTON","Pallet"=>"PALLET"); 
						$arrayUnits["CARTON"] = array("Each"=>"EACH","Inner-Carton"=>"INNER_CART","Carton"=>"CARTON","Pallet"=>"PALLET"); 
						$arrayUnits["INNER_CART"] = array("Each"=>"EACH","Inner-Carton"=>"INNER_CART"); 
						$arrayUnits["EACH"] = array("Each"=>"EACH"); 
						#if($i==0){
						?>
						<div class="row">
							<?php if(!empty($unit) && @$unit['sell_price']!='' && @$unit['vendor_price']!=''){?>
							<div class="unitbunch">
									<div class="col-md-2 form-group">
										<div class="input-group">
										<select name="first[]" class="form-control dont-select-me firstdd perFrom" tabindex='9'>
										<?php if(!empty($arraykeys[0]) && $arraykeys[0]!="Select" && $arraykeys[0]!="sell_price" && $arraykeys[0]!="vendor_price" ){
											foreach($arrayUnits[$arraykeys[0]] as $keyys=>$valuess){	
												
											?>
											<option <?php if($arraykeys[0]==$valuess){?> selected="selected" <?php }else{ ?> disabled="true" <?php }?> value="<?php echo $valuess;?>"><?php echo $keyys;?></option>
											<?php }
											}else{?>
											<option value="Select">Select</option>	
											<?php }?>
										</select>
										<input type="text" value="<?php echo ((!empty($arraykeys[0]) && $arraykeys[0]!="Select" && $arraykeys[0]!="sell_price" && $arraykeys[0]!="vendor_price" ) ? $arrayvalues[0] : "1")?>" name="firstval[]" class="form-control pertoqty0" readonly="true" tabindex='10'>
										</div>
										<div class="vl"></div>
									</div>
									
									<div class="col-md-2 form-group">
										<div class="input-group">
										<select name="second[]" class="form-control dont-select-me seconddd perTo" tabindex='11'>
											
											
											<?php if(!empty($arraykeys[1]) && $arraykeys[1]!="Select" && $arraykeys[1]!="sell_price" && $arraykeys[1]!="vendor_price" ){
											foreach($arrayUnits[$arraykeys[1]] as $keyys=>$valuess){	
											?>
											<option <?php if($arraykeys[1]==$valuess){?> selected="selected" <?php }else{ ?> disabled="true" <?php }?> value="<?php echo $valuess;?>"><?php echo $keyys;?></option>
											<?php }
											}else{?>
											<option value="Select">Select</option>	
											<?php }?>
										</select>
										<input type="text" value="<?php echo ((!empty($arraykeys[1]) && $arraykeys[1]!="Select" && $arraykeys[1]!="sell_price" && $arraykeys[1]!="vendor_price" ) ? $arrayvalues[1] : "1")?>" name="secondval[]" class="form-control pertoqty" tabindex='12'>
										<div class="vl1"></div>
										</div>
									</div>
									<div class="col-md-2 form-group">
										<div class="input-group">
										<select name="third[]" class="form-control dont-select-me thirddd perTo1" tabindex='13'>
										
											
											<?php if($arraykeys[2]!="Select" && $arraykeys[2]!="sell_price" && $arraykeys[2]!="vendor_price" ){
											foreach($arrayUnits[$arraykeys[2]] as $keyys=>$valuess){	
											?>
											<option <?php if($arraykeys[2]==$valuess){?> selected="selected" <?php }else{ ?> disabled="true" <?php }?> value="<?php echo $valuess;?>"><?php echo $keyys;?></option>
											<?php }
											}else{?>
											<option value="Select">Select</option>	
											<?php }?>
										</select>
										<input type="text" value="<?php echo ((!empty($arraykeys[2]) && $arraykeys[2]!="Select" && $arraykeys[2]!="sell_price" && $arraykeys[2]!="vendor_price" ) ? $arrayvalues[2] : "1")?>" name="thirdval[]" class="form-control pertoqty1" tabindex='14'>
										<div class="vl1"></div>
										</div>
									</div>
									
									<div class="col-md-2 form-group">
										<div class="input-group">
										<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1" tabindex='15'>
											
											<?php if(!empty($arraykeys[3]) && $arraykeys[3]!="Select" && $arraykeys[3]!="sell_price" && $arraykeys[3]!="vendor_price" ){
											foreach($arrayUnits[$arraykeys[3]] as $keyys=>$valuess){	
											?>
											<option <?php if($arraykeys[3]==$valuess){?> selected="selected" <?php }else{ ?> disabled="true" <?php }?> value="<?php echo $valuess;?>"><?php echo $keyys;?></option>
											<?php }
											}else{?>
											<option value="Select">Select</option>	
											<?php }?>
											
										</select>
										
										<input type="text" value="<?php echo ((!empty($arraykeys[3]) && $arraykeys[3]!="Select" && $arraykeys[3]!="sell_price" && $arraykeys[3]!="vendor_price" ) ? $arrayvalues[3] : "1")?>" name="fourthval[]" class="form-control pertoqty2" tabindex='16'>
										<div class="vl1"></div>
										</div>
									</div>
									
									<div class="col-md-1 form-group" style="width:9%;">
										<div><b>Sell Price</b></div>
										<div><input type="number" value="<?php echo $unit['sell_price']?>" min="1" name="sell_price[]" class="form-control totals" tabindex='17' step=".01"></div>
									</div>
									
									<div class="col-md-1 form-group" style="width:12%;">
										<div><b>Vendor Price</b></div>
										<div><input type="number" value="<?php echo $unit['vendor_price']?>" min="1" name="vendor_price[]" class="form-control vendor_price" tabindex='18' step=".01"></div>
									</div>
								
								<div class="col-md-1">
									<span class="glyphicon glyphicon-plus plusicon"></span>
								</div>
								
							</div>
							<?php } ?>
							<?php if($i==0){?>
							
							<div class="unitbunch1" style="display:none;">
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="first[]" class="form-control dont-select-me firstdd1 perFrom" tabindex='9'>
										<option value="">Select</option>
										<option value="EACH">Each</option>
									</select>
									<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty01" readonly="true" tabindex='10'>
									</div>
									<div class="vl"></div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="second[]" class="form-control dont-select-me seconddd1 perTo" tabindex='11'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty1" tabindex='12' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="third[]" class="form-control dont-select-me thirddd1 perTo1" tabindex='13'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty11" tabindex='14' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="fourth[]" class="form-control dont-select-me fourthddd1 perTo1" tabindex='15'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty21" tabindex='16' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-1 form-group" style="width:9%;">
									<div><b>Sell Price</b></div>
									<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals1" required  tabindex='17' step="0.01"></div>
								</div>
								
								<div class="col-md-1 form-group" style="width:12%;">
									<div><b>Vendor Price</b></div>
									<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price1" required  tabindex='18' step="0.01"></div>
								</div>
								
								<!--<div class="col-md-1">
									<span class="glyphicon glyphicon-plus plusicon"></span>
								</div>-->
							
							</div> 
							
							
							
							
							<?php }?>
							

							<?php if($i==0 && $serial_flag==0){?>
							<div class="col-md-1">
								<span class="glyphicon glyphicon-plus plusicon"></span>
							</div>
							<?php } else{
								if($serial_flag==0){
								?>
							<div class="col-md-1">
								<span class="glyphicon glyphicon-minus minusicon"></span>
							</div>
							<?php }}?>
						</div>   
						<?php //}?>
						<?php 
						$i++;
						}}}else{?>
						
							<?php if($serial_flag==1){?>
							<div class="unitbunch1">
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="first[]" class="form-control dont-select-me firstdd perFrom" tabindex='9'>
										<option value="">Select</option>
										<option value="EACH">Each</option>
									</select>
									<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty01" readonly="true" tabindex='10'>
									</div>
									<div class="vl"></div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="second[]" class="form-control dont-select-me seconddd1 perTo" tabindex='11'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty1" tabindex='12' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="third[]" class="form-control dont-select-me thirddd1 perTo1" tabindex='13'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty11" tabindex='14' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="fourth[]" class="form-control dont-select-me fourthddd1 perTo1" tabindex='15'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty21" tabindex='16' disabled="disabled">
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-1 form-group" style="width:9%;">
									<div><b>Sell Price</b></div>
									<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals1" required  tabindex='17' step="0.01"></div>
								</div>
								
								<div class="col-md-1 form-group" style="width:12%;">
									<div><b>Vendor Price</b></div>
									<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price1" required  tabindex='18' step="0.01"></div>
								</div>
								
								<!--<div class="col-md-1">
									<span class="glyphicon glyphicon-plus plusicon"></span>
								</div>-->
							
							</div>
							<?php }else{?>
							
							<div class="row">
							
							<div class="unitbunch1">
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="first[]" class="form-control dont-select-me firstdd perFrom" tabindex='9'>
										<option value="">Select</option>
										<option value="EACH">Each</option>
										<option value="INNER_CART">Inner-Carton</option>
										<option value="CARTON">Carton</option>
										<option value="PALLET">Pallet</option>
									</select>
									<input type="number" value="1" min="1" name="firstval[]" class="form-control pertoqty01" readonly="true" tabindex='10'>
									</div>
									<div class="vl"></div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="second[]" class="form-control dont-select-me seconddd perTo" tabindex='11'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="secondval[]" class="form-control pertoqty1" tabindex='12'>
									<div class="vl1"></div>
									</div>
								</div>
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="third[]" class="form-control dont-select-me thirddd perTo1" tabindex='13'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="thirdval[]" class="form-control pertoqty11" tabindex='14' >
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-2 form-group">
									<div class="input-group">
									<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1" tabindex='15'>
										<option value="Select">Select</option>
										
									</select>
									<input type="number" value="1" min="1" name="fourthval[]" class="form-control pertoqty21" tabindex='16' >
									<div class="vl1"></div>
									</div>
								</div>
								
								<div class="col-md-1 form-group" style="width:9%;">
									<div><b>Sell Price</b></div>
									<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals1" required  tabindex='17' step="0.01"></div>
								</div>
								
								<div class="col-md-1 form-group" style="width:12%;">
									<div><b>Vendor Price</b></div>
									<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price1" required  tabindex='18' step="0.01"></div>
								</div>
								
								<!--<div class="col-md-1">
									<span class="glyphicon glyphicon-plus plusicon"></span>
								</div>-->
							
							</div>
							
						</div>
						<?php //$i++;}?>
						
						<?php }}?>
						<div class="addmore"></div>
						
						</fieldset>
						</div>
						
						
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <input type="submit" id="add-product" class="btn btn-success btn-large" name="add-product" value="<?php echo display('save_changes') ?>"  tabindex='19'/>
                            </div>
							<div class="col-sm-3">
								<div class="errorhandler"></div>
							</div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>

function checkSerialFlag(thisone){
	var checkprop = $(thisone).prop("checked");
	if(checkprop == undefined){
		var checkprop = $("#serial_flag").prop("checked");
	}
	if(checkprop==true){
		//$('.plusicon').hide();
		//$('.firstdd option[value="EACH"]').attr("selected", "selected");
		//$('.firstdd').trigger("change");
		$(".unitbunch1").show();
		$(".unitbunch").hide();
	}else{
		//$('.firstdd option[value=""]').attr("selected", "selected");
		//$('.firstdd').trigger("change");
		//$('.plusicon').show();
		$(".unitbunch").show();
		$(".unitbunch1").hide();
	}
	
}


function checkValidation(){
	/*var icea = $("#value2_0").val();
	var crea = $("#value2_1").val();
	var cric = $("#value2_2").val();
	var plcr = $("#value2_3").val();
	if(crea/cric==icea){
		return true;
	}else{
		$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please correct carton and inner-carton values.</div>');
		$('.handerror').show();
		$('#value2_0').css("border", "1px dotted red");
		$('#value2_1').css("border", "1px dotted red");
		$('#value2_2').css("border", "1px dotted red");
		return false;
	}*/
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
	
	
	console.log(flag1);
	console.log(flag2);
	console.log(flag3);
	console.log(flag4);
	console.log(flag5);
	console.log(flag6);
	console.log(flag7);
	console.log(flag8);
	console.log(flag10);
	console.log(flag11);
	
	if(flag1==0 && flag2==0 && flag3==0 && flag4==0 && flag5==0 && flag6==0 && flag7==0 && flag8==0 && flag10==0 && flag11==0){
		return true;
	}else{
		$(".errorhandler").html('<div class="error handerror" style="color: red;font-style: italic;font-size: 13px;font-weight:bold;">Please select Unit Management Values.</div>');
		$(".error").show();
		return false;
	}
	
	
}
$(document).ready(function(){

	$('.plusicon').click(function(){
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
		html += 		'<input type="text" value="1" name="firstval[]" class="form-control perfromqty" readonly="true">';
		html += 		'</div>';
		html += 		'<div class="vl"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="second[]" class="form-control dont-select-me seconddd perTo">';
											
											
		html += 		'<option value="">Select</option>';
		
		html += 		'</select>';
		html += 		'<input type="text" value="1" name="secondval[]" class="form-control pertoqty">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="third[]" class="form-control dont-select-me thirddd perTo1">';
										
											
		html += 		'<option value="">Select</option>';
		html += 		'</select>';
		html += 		'<input type="text" value="1" name="thirdval[]" class="form-control pertoqty1">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div class="input-group">';
		html += 		'<select name="fourth[]" class="form-control dont-select-me fourthddd perTo1">';
											
		html += 		'<option value="">Select</option>';
																						
		html += 		'</select>';
										
		html += 		'<input type="text" value="1" name="fourthval[]" class="form-control pertoqty2">';
		html += 		'<div class="vl1"></div>';
		html += 		'</div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-1 form-group">';
		html += 		'<div><b>Sell Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="sell_price[]" class="form-control totals"></div>';
		html += 		'</div>';
									
		html += 		'<div class="col-md-2 form-group">';
		html += 		'<div><b>Vendor Price</b></div>';
		html += 		'<div><input type="number" value="" min="1" name="vendor_price[]" class="form-control vendor_price"></div>';
		html += 		'</div>';
		//html += 		'<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
		//html += $('.unitbunch').html();
		html += '<div class="col-md-1"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="Select">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';
				$(this).parent().parent().parent().children().next().find('.pertoqty').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().find('.pertoqty1').removeAttr("readOnly");
				$(this).parent().parent().parent().children().next().next().next().find('.pertoqty2').removeAttr("readOnly");				
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="Select">Select</option>';	
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
							$(".errorhandler").text(obj.msg);
							$(".errorhandler").css("width","365px");
							$(".errorhandler").css("color","red");
							$("#add-product").attr("disabled", "disabled");
							$("#add-product-another").attr("disabled", "disabled");
							return false;
						}else{
							$(".errorhandler").text("");
							$("#add-product").removeAttr("disabled");
							$("#add-product-another").removeAttr("disabled");
							return true;
						}
					} 
				});
	}
	
	checkSerialFlag(this);
</script>


<!-- Edit Product End -->



