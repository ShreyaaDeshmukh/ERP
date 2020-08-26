<!-- Manage Purchase Start -->
<style>
	.dot {
    height: 25px;
    width: 25px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
}
.tooltip {
    position: relative;
    display: inline-block;
   /* border-bottom: 1px dotted black;*/
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}

</style>
<?php $r_id = $this->session->r_id;  ?>
<div class="content-wrapper">


	<section class="content-header">

	    <div class="header-icon">

	        <i class="pe-7s-note2"></i>

	    </div>

	    <div class="header-title">

	        <h1><?php echo display('manage_recieving') ?></h1>

	        <small><?php echo display('manage_recieving') ?></small>

	        <ol class="breadcrumb">

	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

	            <li><a href="#"><?php echo 'Receiving' ?></a></li>

	            <li class="active"><?php echo display('manage_recieving') ?></li>

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


	<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 

                        <a style="float:right;"href="<?php echo base_url('Crecieving')?>"><input type="button" id="add-purchase" class="btn btn-success btn-large" name="add-purchase" value="Add Receiving"></a>	            
                    </div>
                </div>
            </div>
        </div>
		
		<div class="row">
			<?php echo form_open_multipart('Crecieving/manage_recieving/'.$r_id,array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
			<div class="col-md-12">	
			<div class="panel panel-default">
                <div class="panel-body" > 
				<div class="col-sm-2">
					
					<!-- <select name="supplier_id" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Vendor" ?></option>
						<?php foreach($all_supplier as $allsupplier):?>
						<option <?php if(@$post['supplier_id']==$allsupplier['supplier_id']){?> selected="selected "<?php }?> value="<?php echo $allsupplier['supplier_id']?>"><?php echo $allsupplier['supplier_name']?></option>
						<?php endforeach;?> -->

						<select name="supplier_id" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Vendor" ?></option>
						<?php foreach($all_supplier as $allsupplier):?>
						<option <?php if(@$_POST['supplier_id']==$allsupplier['supplier_id']){?> selected="selected "<?php }?> value="<?php echo $allsupplier['supplier_id']?>"><?php echo $allsupplier['supplier_name']?></option>
						<?php endforeach;?>
						
					</select>
						
					</select>
				</div>
				
				<div class="col-sm-2">
					<!-- <select name="product_id" id="product_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Product" ?></option>
						<?php foreach($all_product as $allproduct):?>
						<option <?php if(@$post['product_id']==$allproduct['product_id']){?> selected="selected "<?php }?> value="<?php echo $allproduct['product_id']?>"><?php echo $allproduct['product_name']?></option>
						<?php endforeach;?>
					</select> -->

					<select name="product_id" id="product_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Product" ?></option>
						<?php foreach($all_product as $allproduct):?>
						<option <?php if(@$_POST['product_id']==$allproduct['product_id']){?> selected="selected "<?php }?> value="<?php echo $allproduct['product_id']?>"><?php echo $allproduct['product_name']?></option>
						<?php endforeach;?>
					</select>

				</div>
				
				
				<div class="col-sm-2">
					 <select name="customer_po" id="po_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Customer PO" ?></option>
						<?php foreach($all_customerPO as $allcustomerPO):?>
						<option <?php if(@$post['customer_po']==$allcustomerPO['customer_po']){?> selected="selected "<?php }?> value="<?php echo $allcustomerPO['customer_po']?>"><?php echo $allcustomerPO['customer_po']?></option>
						<?php endforeach;?>
					</select>
				</div>
				
				<div class="col-sm-3">
				<!-- <select name="customer_name" id="customer_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Customer" ?></option>
						<?php foreach($all_customer as $allcustomer):?>
						<option <?php if(@$post['customer_name']==$allcustomer['customer_name']){?> selected="selected "<?php }?> value="<?php echo $allcustomer['customer_name']?>"><?php echo $allcustomer['customer_name']?></option>
						<?php endforeach;?>
					</select> -->

					<select name="customer_name" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Customer" ?></option>
						<?php foreach($all_customer as $allcustomer):?>
						<option <?php if(@$_POST['customer_name']==$allcustomer['customer_name']){?> selected="selected "<?php }?> value="<?php echo $allcustomer['customer_name']?>"><?php echo $allcustomer['customer_name']?></option>
						<?php endforeach;?>
						
					</select>


					<!-- <input type="text" class="form-control" placeholder="Search By customer name" name="customer_name" id="customer_name" value="<?php echo @$_POST['customer_name']?>"> -->
				</div>
				
				<div class="col-sm-3">
					<button style="text-align: right;" class="btn btn-primary" type="Submit" value="Submit"><?php echo display('submit')?></button>
					<button style="text-align: right;" class="btn btn-danger" type="reset" value="Reset" onclick="resetForm();"><?php echo display('reset')?></button>
				</div>
			
				</div>	
			</div>	
			</div>	
			<?php echo form_close()?>
        </div>

		<!-- Manage Purchase report -->

		<div class="row">

		    <div class="col-sm-12">

		        <div class="panel panel-bd lobidrag">

		            <div class="panel-heading">

		                <div class="panel-title">

		                    <h4><?php echo display('manage_recieving') ?></h4>

		                </div>

		            </div>

		            <div class="panel-body">

		                <div class="table-responsive">

		                    <table id="dataTableExample4" class="table table-bordered table-striped table-hover">

								<thead>

									<tr>

										
										<th><?php echo 'PO Id' ?></th>

										<th><?php echo display('product_name') ?></th>
										
										<th><?php echo 'Product Description' ?></th>
										<th><?php echo display('unit') ?></th>
										<th>Serial Number</th>
										<th><?php echo 'Qty of UnitId' ?></th>
										



										

										<!--<th><?php //echo display('quantity') ?></th>-->
										
										
										
										
										<th>Manage Receiving</th>

										<!--<th><?php echo 'serial_number' ?></th>-->
										
										
										
										
										<th><?php echo display('action') ?></th>

									</tr>

								</thead>

								<tbody>

								<?php

									if ($purchases_list) {
// print_r($purchases_list);die;
								?>

								{purchases_list}

									<tr>

										
										
										<td>
											{purchase_id}
										</td>
										<td>{product_name}</td>

										<td>{product_details}</td>

										<td>{unit}</td>
										<td>{serial_number}</td>

										<td>{cty_unit_id}</td>
										
										
									

										
										
										
										<!--<td>{quantity}</td>-->
										
										
										
										<td>{ship_date}</td>
										
										
										
										
										
										<td>

											<center>

											<?php echo form_open()?>
												
												
												<a href="<?php echo base_url() . 'Cbarcodepurchase/barcode_print_labnum/{purchase_id}/{product_id}/{datagrp}'; ?>" class="btn btn-warning btn-sm" title="Print Unitid" data-placement="left"><i class="fa fa-barcode" aria-hidden="true"></i></a>
												
												
																
											</center>

											<?php echo form_close()?>

										</td>

									</tr>

								{/purchases_list}

								<?php

									}

								?>

								</tbody>

		                    </table>

		                </div>

		                <!--<div class="text-right"><?php //echo $links?></div>-->

		            </div>

		        </div>

		    </div>

		</div>

	</section>

</div>

<!-- Manage Purchase End -->



<!-- Delete Purchase ajax code -->

<script type="text/javascript">


function resetForm(){
		$("#vendor_search option[value='']").attr("selected", "selected");
		$("#product_sss option[value='']").attr("selected", "selected");
		$("#customer_po").val("");
		$("#customer_name").val("");
		$("#purchase_update").submit();
	}
	


// $(document).ready(function() {
// 	setTimeout(function(){  $('#dataTableExample3').DataTable( {
//         "order": [[ 1, "desc" ]]
//     } ); }, 1000);

   
// } ); 

$(document).ready(function() {
    $('#dataTableExample4').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );


	//Delete Purchase Item 
	$( document ).tooltip();
	$(".deletePurchase").click(function()

	{	

		var purchase_id=$(this).attr('name');

		var csrf_test_name=  $("[name=csrf_test_name]").val();

		var x = confirm("Are you sure you want to delete? ");

		if (x==true){

		$.ajax

	   ({

			type: "POST",

			url: '<?php echo base_url('Cpurchase/purchase_delete')?>',

			data: {purchase_id:purchase_id,csrf_test_name:csrf_test_name},

			cache: false,

			success: function(datas)

			{
				window.location.reload();
			} 

		});

		}else{
			return false;
		}

	});

	

</script>
