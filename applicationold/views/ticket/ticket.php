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
										<th><?php echo display('ship_to') ?></th>
										<th><?php echo display('product_name') ?></th>
										<th><?php echo display('customer_name') ?></th>
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
										<td>
											<?php echo join(",", json_decode($receiopt['ship_to']));?>
											
										</td>
										<td>
											<?php echo $receiopt['product_name'];?>
											
										</td>
										<td>
											<a href="<?php echo base_url().'Ccustomer/customerledger/'.$receiopt['customer_id']; ?>">
												
												<?php echo $receiopt['customer_name']?>
											</a>
										</td>
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