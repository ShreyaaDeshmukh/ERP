<!-- Manage Purchase Start -->
<?php $r_id = $this->session->r_id; ?>
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_ticket') ?></h1>
	        <small><?php echo display('manage_your_receipt') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('ticket') ?></a></li>
	            <li class="active"><?php echo display('manage_ticket') ?></li>
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

                        <a style="float:right;"href="<?php echo base_url('Cticket')?>"><input type="button" id="add-category" class="btn btn-success btn-large" name="add-category" value="Add Ticket"></a>	            
                    </div>
                </div>
            </div>
        </div>
		
		<!-- start of filter -->
		<div class="row">
			<?php echo form_open_multipart('Cticket/manage_ticket/'.$r_id,array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
			<div class="col-md-12">	
			<div class="panel panel-default">
                <div class="panel-body"> 
				<!-- <div class="col-sm-2">
					
					<select name="supplier_id" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Vendor" ?></option>
						<?php foreach($all_supplier as $allsupplier):?>
						<option <?php if(@$post['supplier_id']==$allsupplier['supplier_id']){?> selected="selected "<?php }?> value="<?php echo $allsupplier['supplier_id']?>"><?php echo $allsupplier['supplier_name']?></option>
						<?php endforeach;?>
						
					</select>
				</div> -->
				
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
	
		<!-- end of filter -->
		<!-- Manage Purchase report -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_ticket') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('ticket'). " Id" ?></th>
										<!-- <th><?php echo display('ship_to') ?></th> -->
										<th><?php echo display('product_name') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th>Customer PO</th>
										<th><?php echo display('ticket_date') ?></th>
										<th><?php echo display('required_picking_quantity') ?></th>
										<th><?php echo display('total_picked_quantity') ?></th>
										<!--<th><?php echo display('total_ammount') ?></th>-->
										<th style="width:139px;"><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($receipt_list) {
										$i = 0;
								foreach($receipt_list as $receiopt):
								?>
								
									<tr>
										<td><?php echo $receiopt['sl']?></td>
										<td>
												<?php echo $receiopt['ticket_id']?>
										</td>
										<!-- <td>
											<?php echo join(",", json_decode($receiopt['ship_to']));?>
											
										</td> -->
										<td>
											<?php echo $receiopt['product_name'];?>
											
										</td>
										<td>
											<a href="<?php echo base_url().'Ccustomer/customerledger/'.$receiopt['customer_id']; ?>">
												
												<?php echo $receiopt['customer_name']?>
											</a>
										</td>
										<td><?php echo $receiopt['customer_po']?></td>
										<td><?php echo $receiopt['final_date']?></td>
										<td><?php echo $receiopt['quantity']?></td>
										<td><?php if($receiopt['totalpicked_quantity']  > 0){ echo $receiopt['totalpicked_quantity']; }else{ echo "0"; }?></td>
										<!--<td style="text-align: right;"><?php echo (($position==0)?"$currency {grand_total_amount}":"{grand_total_amount} $currency") ?></td>-->
										<td>
											<center>

											
											<?php echo form_open()?>

											<a href="<?php echo base_url().'Cticket/ticket_details_data/'.$receiopt['ticket_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('print') ?>"><i class="fa fa-print" aria-hidden="true"></i></a>

											<a href="<?php echo base_url().'Cticket/picking_details/'.$receiopt['ticket_id']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="Picking Details"><i class="fa fa-get-pocket" aria-hidden="true"></i></a>

									
										  <a href="<?php echo base_url().'Cticket/ticket_update_form/'.$receiopt['ticket_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="View Ticket"><i class="fa fa-eye" aria-hidden="true"></i></a>

										<a href="" class="deleteTicket btn btn-danger btn-sm" name="<?php echo $receiopt['ticket_id']?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</center>
											<?php echo form_close()?>
										</td>
									</tr>
									<?php $i++; endforeach;?>
								
								<?php
									}
								?>
								</tbody>
		                    </table>
		                </div>
		                <div class="text-right"><?php echo $links?></div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Purchase End -->

<!-- Delete Purchase ajax code -->
<script type="text/javascript">
	//Delete Purchase Item 
	$(".deleteTicket").click(function()
	{	
		var purchase_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are You Sure Want to Delete this?");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Cticket/ticket_delete')?>',
			data: {ticket_id:purchase_id,csrf_test_name:csrf_test_name},
			success: function(datas)
			{
				console.log(datas);
				return false;
			} 
		});
		}else{			return false;		}
	});
	
	
	function resetForm(){
		$("#vendor_search option[value='']").attr("selected", "selected");
		$("#product_sss option[value='']").attr("selected", "selected");
		$("#customer_po").val("");
		
		$("#purchase_update").submit();
	}
	
</script>