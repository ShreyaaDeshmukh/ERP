<!-- Edit Product Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Product Inventory Details</h1>
            <small>Product details</small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active">Product Details</li>
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
                            <h4>Product : <?php echo $products_list[0]['product_name'] ?> </h4>
                            <h4>Product Description : <?php echo $products_list[0]['product_details'] ?> </h4>
                        </div>
                    </div>
                    
						
						
						
						
                        <div class="table-responsive" style="margin-top: 10px">
                             <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                       
                                        <th class="text-center"> UnitID </th>
                                        <th class="text-center"> Location </th>
                                        <th class="text-center"> Stock </th>
                                        <th class="text-center"> Lot </th>
                                        <th class="text-center"> Serial </th>
                                        <th class="text-center"> Received Date </th>
                                        <th class="text-center"> Exp Date </th>
										
                                    </tr>
                                </thead>
                                <tbody id="form-actions">
                                    <?php 
                                    if($products_list){
                                    foreach ($products_list as $list) {
                       
                                    
                                    ?>
                                    <tr class="">
										     
                                        <td class="text-center">
                                          
                                            <?php echo $list['label']; ?>
                                        </td>
                                        <td class="text-center">
                                         
                                            <?php echo $list['location_unique_key']; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $list['total_quantity']; ?>
                                        </td>
										<td class="text-center">
                                            <?php echo $list['lot']; ?>
                                        </td>
										<td class="text-center">
                                            <?php echo $list['serial_number']; ?>
                                        </td>
										<td class="text-center">
                                            <?php echo $list['created_at']; ?>
                                        </td>
										
										<td class="text-center">
                                            <?php echo $list['expiry_date']; ?>
                                        </td>
										

                                    </tr>
                                    <?php 
                                        }}
                                        else{
                                        	?>
                                        	<tr class="">
										     
                                        <td class="text-center" colspan="3">
                                          
                                            Putaway is pending for this invetory!
                                        </td>
                                       

                                    </tr>
                                        	<?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
						
						
                    </div>
                    <?php echo form_close() ?>
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
	console.log(crea/cric);
	console.log(icea);
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
				html += '<option value="CARTON">CARTON</option>';	
		}
		$(this).parent().parent().children().next().next().find('.seconddd').html(html);
		//$(this).parent().parent().children().next().next().next().html(html);
	})
	})
	
	$('.minusicon').click(function(){
		$(this).parent().parent().children().remove();
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


<!-- Edit Product End -->



