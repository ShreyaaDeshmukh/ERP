<!-- Add Product Start -->
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
                    <?php echo form_open_multipart('Cproduct/insert_product',array('class' => 'form-vertical', 'id' => 'insert_product','name' => 'insert_product', 'onsubmit' => 'return checkValidation()'))?>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="product_name" class="col-sm-4 col-form-label"><?php echo display('product_name') ?> <i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <input class="form-control" name="product_name" type="text" id="product_name" placeholder="<?php echo display('product_name') ?>" required  tabindex='1'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                               <div class="form-group row">
                                    <label for="description" class="col-sm-4 col-form-label"><?php echo display('details') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="description" id="description" rows="3"  required="" placeholder="<?php echo display('details') ?>" tabindex='2'></textarea>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-4 col-form-label"><?php echo display('category') ?><i class="text-danger">*</i></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="category_id" name="category_id"  required="" tabindex='3'>
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
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <!--<th class="text-center"><?php echo display('innercart_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('cartoon_quantity') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('pallet_quantity') ?> <i class="text-danger">*</i></th>-->
                                        <th class="text-center"><?php echo display('sell_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('supplier_price') ?> <i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('model') ?> </th>
                                       
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
                                        <td class="">
                                            <input class="form-control text-right" name="price" type="number" required="" placeholder="<?php echo display('sell_price') ?>" tabindex="6" min="0">
                                        </td>
                                        <td class="">
                                            <input type="number" tabindex="7" class="form-control text-right" name="supplier_price" placeholder="<?php echo display('supplier_price') ?>"  required  min="0"/>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" tabindex="8" class="form-control" name="model" placeholder="<?php echo display('model') ?>"  />
                                        </td>
                                        
                                        <td class="text-right">
                                            <select name="supplier_id" class="form-control" required="" tabindex='9'>
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
                            </table>
                        </div>
						<div class="row">
							<div class="col-md-2">
								<label><?php echo display("lot_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input type="checkbox" name="lot_flag" value="1">
								  <span class="slider round"></span>
								</label>
							</div>
							
							<div class="col-md-2">
								<label><?php echo display("expiry_flag");?></label>
							</div>
							<div class="col-md-2">
								<label class="switch">
								  <input type="checkbox" name="expiry_flag"  value="1">
								  <span class="slider round"></span>
								</label>
							</div>
						</div>
						<div class="row unitcontainer">
						<fieldset><legend>Unit Management Per Quantity</legend>
						<?php //$unitarr = array(array("IC", "EA"), array("CR", "EA"), array("CR", "IC"), array("PL", "CR"));
						//$i = 0;
						//foreach($unitarr as $unit){ 
						?>
						<div class="row">
							<div class="unitbunch">
							<div class="col-md-3 form-group">
								<select name="perFrom[]" class="form-control dont-select-me firstdd" required>
									<option value="">Select</option>
									<option value="INNER_CART">Inner-Carton</option>
									<option value="CARTON">Carton</option>
									<option value="PALLET">Pallet</option>
									
								</select>
							</div>	
							<div class="col-md-2 form-group hide">
								<input type="hidden" value="1" name="perFromQty[]" class="form-control" readonly="true" required>
							</div>
							<div class="col-md-3 form-group">
								<select name="perTo[]" class="form-control dont-select-me seconddd" required>
									<option value="">Select</option>
									<option value="EACH">Each</option>	
									<option value="INNER_CART">Inner-Carton</option>
									<option value="PALLET">Carton</option>
									
								</select>
							</div>
							<div class="col-md-4 form-group">
								<input type="number" value="0" min="0" name="perToQty[]" class="form-control" required="true" required>
							</div>
							</div>
							<div class="col-md-2">
								<span class="glyphicon glyphicon-plus plusicon"></span>
							</div>	
						</div>
						<?php //$i++;}?>
						<div class="addmore"></div>
						<div class="errorhandler"></div>
						</fieldset>
						</div>
						<div class="form-group row">
                            <div class="col-sm-6">
                                <input type="submit" id="add-product" class="btn btn-primary btn-large" name="add-product" value="<?php echo display('save') ?>"  tabindex='10'/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-product-another" class="btn btn-large btn-success" id="add-product-another" tabindex='11'>
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
	return true;
	
}
$(document).ready(function(){

	$('.plusicon').click(function(){
		var html = '<div class="newhtml">';
		html += $('.unitbunch').html();
		html += '<div class="col-md-2"><span class="glyphicon glyphicon-minus minusicon"></span></div></div>';
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
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';		
		}
		$(this).parent().parent().children().next().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	})
	})
	
	$('.minusicon').click(function(){
		alert('111');
	})
	
	$('.firstdd').change(function(){
		var selectedValue = $(this).val();
		console.log(selectedValue);
		var html = '';
		if(selectedValue=="INNER_CART"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
		}else if(selectedValue=="CARTON"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
		}else if(selectedValue=="PALLET"){
				html = '';
				html += '<option value="">Select</option>';	
				html += '<option value="EACH">EACH</option>';	
				html += '<option value="INNER_CART">INNER-CART</option>';	
				html += '<option value="CARTON">CARTON</option>';	
		}
		$(this).parent().parent().children().next().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	})
})

</script>
<!-- Add Product End -->



