<!-- Manage Purchase Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_receipt') ?></h1>
	        <small><?php echo display('manage_your_receipt') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('receipt') ?></a></li>
	            <li class="active"><?php echo display('manage_receipt') ?></li>
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

                        <a style="float:right;"href="<?php echo base_url('Creceipt')?>"><input type="button" id="add-category" class="btn btn-success btn-large" name="add-category" value="Add Receipt"></a>	            
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
		                    <h4><?php echo display('manage_receipt') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<!--<th><?php //echo display('invoice_no') ?></th>-->
										<th><?php echo display('supplier_name') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('receipt_date') ?></th>
										<th><?php echo display('total_ammount') ?></th>
										<th><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($receipt_list) {
								?>
								{receipt_list}
									<tr>
										<td>{sl}</td>
										<!--<td>
											<a href="<?php //echo base_url().'Cpurchase/purchase_details_data/{purchase_id}'; ?>">
												{chalan_no}
											</a>
										</td>-->
										<td>
											<a href="<?php echo base_url().'Csupplier/supplier_details/{supplier_id}'; ?>">
												{supplier_name}
											</a>
										</td>
										<td>
											<a href="<?php echo base_url().'Ccustomer/customerledger/{customer_id}'; ?>">
												{customer_name}
											</a>
										</td>
										<td>{final_date}</td>
										<td style="text-align: right;"><?php echo (($position==0)?"$currency {grand_total_amount}":"{grand_total_amount} $currency") ?></td>
										<td>
											<center>
											<?php echo form_open()?>
												<a href="<?php echo base_url().'Creceipt/receipt_update_form/{receipt_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a href="" class="deletePurchase btn btn-danger btn-sm" name="{receipt_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											</center>
											<?php echo form_close()?>
										</td>
									</tr>
								{/receipt_list}
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
	$(".deletePurchase").click(function()
	{	
		var purchase_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure you want to delete? ");
		if (x==true){
		$.ajax
	   ({
			type: "POST",
			url: '<?php echo base_url('Creceipt/receipt_delete')?>',
			data: {purchase_id:purchase_id,csrf_test_name:csrf_test_name},
			cache: false,
			success: function(datas)
			{
			} 
		});
		}else{			return false;		}
	});
</script>