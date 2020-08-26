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
	display:inline-block;
	white-space: pre-wrap;
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
<?php $r_id = $this->session->r_id; ?>
<div class="content-wrapper">


	<section class="content-header">

	    <div class="header-icon">

	        <i class="pe-7s-note2"></i>

	    </div>

	    <div class="header-title">

	        <h1><?php echo display('manage_purchase') ?></h1>

	        <small><?php echo display('manage_your_purchase') ?></small>

	        <ol class="breadcrumb">

	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

	            <li><a href="#"><?php echo display('purchase') ?></a></li>

	            <li class="active"><?php echo display('manage_purchase') ?></li>

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

                        <a style="float:right;"href="<?php echo base_url('Cpurchase')?>"><input type="button" id="add-purchase" class="btn btn-success btn-large" name="add-purchase" value="Add Purchase"></a>	            
                    </div>
                </div>
            </div>
        </div>
		
		<div class="row">
			<?php echo form_open_multipart('Cpurchase/manage_purchase/'.$r_id,array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
			<div class="col-md-12">	
			<div class="panel panel-default">
                <div class="panel-body"> 
				<div class="col-sm-2">
					
					<select name="supplier_id" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Vendor" ?></option>
						<?php foreach($all_supplier as $allsupplier):?>
						<option <?php if(@$post['supplier_id']==$allsupplier['supplier_id']){?> selected="selected "<?php }?> value="<?php echo $allsupplier['supplier_id']?>"><?php echo $allsupplier['supplier_name']?></option>
						<?php endforeach;?>
						
					</select>
				</div>
				
				<div class="col-sm-2">
					<select name="product_id" id="product_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Product" ?></option>
						<?php foreach($all_product as $allproduct):?>
						<option <?php if(@$post['product_id']==$allproduct['product_id']){?> selected="selected "<?php }?> value="<?php echo $allproduct['product_id']?>"><?php echo $allproduct['product_name']?></option>
						<?php endforeach;?>
					</select>
				</div>
				
				
				<div class="col-sm-3">
				    <select name="customer_po" id="po_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Customer PO" ?></option>
						<?php foreach($all_customerPO as $allcustomerPO):?>
						<option <?php if(@$post['customer_po']==$allcustomerPO['customer_po']){?> selected="selected "<?php }?> value="<?php echo $allcustomerPO['customer_po']?>"><?php echo $allcustomerPO['customer_po']?></option>
						<?php endforeach;?>
					</select>
					
				</div>
				
				<div class="col-sm-3" >
				<select name="customer_name" id="customer_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Customer" ?></option>
						<?php foreach($all_customer as $allcustomer):?>
						<option <?php if(@$post['customer_name']==$allcustomer['customer_name']){?> selected="selected "<?php }?> value="<?php echo $allcustomer['customer_name']?>"><?php echo $allcustomer['customer_name']?></option>
						<?php endforeach;?>
					</select>

					<!-- <input type="text" class="form-control" placeholder="Search By Customer Name" name="customer_name" id="customer_name" value="<?php echo @$_POST['customer_name']?>"> -->
				</div>
				
				
				<div class="col-sm-1">
					<button style="text-align: right;" class="btn btn-primary" type="Submit" value="Submit"><?php echo display('submit')?></button>
				</div>
				<div class="col-sm-1">
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

		                    <h4><?php echo display('manage_purchase') ?></h4>

		                </div>

		            </div>

		            <div class="panel-body" >

		                <div class="table-responsive">

		                    <table  id="dataTableExample3" class="table table-bordered table-striped table-hover">

								<thead>

									<tr>

										<th><?php echo display('sl') ?></th>

										<th><?php echo 'Purhase Order' ?></th>

										<th><?php echo display('supplier_name') ?></th>

										<th><?php echo display('customer_name') ?></th>
										<th>Customer PO</th>
										<th><?php echo display('purchase_date') ?></th>

										<th><?php echo display('product_count') ?></th>

										<th><?php echo display('total_ammount') ?></th>

										<th><?php echo display('action') ?></th>

									</tr>

								</thead>

								<tbody>

								<?php

									if ($purchases_list) {

								?>

								{purchases_list}

									<tr>

										<td>{sl}</td>

										<!--<td>

											<a href="<?php //echo base_url().'Cpurchase/purchase_details_data/{purchase_id}'; ?>">

												{chalan_no}

											</a>

										</td>-->
										<td>
											{purchase_id}
										</td>
										<td>

											
											{supplier_name}
										</td>

										
										<td style="width:50px;">

											
											{customer_name}
										</td>
										<td>{customer_po}</td>
										<td>{final_date}</td>
										
										<td style="width:50px;">
											<div>
												<div class="dot"><span style="margin: 8px;">
													<div class="tooltip">{productcount}<span class="tooltiptext">{productName}</span>
													
													</div>
												</span></div>
												
											</div>
										</td>

										<td style="width:20px;"><?php echo (($position==0)?"$currency {grand_total_amount}":"{grand_total_amount} $currency") ?></td>

										<td>

											<center>

											<?php echo form_open()?>
												
												<a href="<?php echo base_url() . 'Crecieving/?purchase_id={purchase_id}'; ?>" class="btn btn-warning btn-sm" title = "Receive Purchase" data-placement="left"><i class="fa fa-get-pocket" aria-hidden="true"></i></a>
												
												<a href="<?php echo base_url() . 'Cpurchase/purchase_details_data/{purchase_id}'; ?>" class="btn btn-warning btn-sm" title = "Print Purchase" data-placement="left"><i class="fa fa-print" aria-hidden="true"></i></a>
												
												
												
												<a href="<?php echo base_url().'Cpurchase/purchase_update_form/'.$r_id.'/{purchase_id}'; ?>" class="btn btn-info btn-sm" title = "Edit Purchase" data-placement="left"><i class="fa fa-pencil" aria-hidden="true"></i></a>



												<a class="deletePurchase btn btn-danger btn-sm" name="{purchase_id}" data-placement="right" title = "Delete Purchase"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
																
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
		$("#customer_sss option[value='']").attr("selected", "selected");
		$("#po_sss option[value='']").attr("selected", "selected");
		// $("#customer_po").val("");
		$("#customer_name").val("");
		$("#purchase_update").submit();
	}
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
