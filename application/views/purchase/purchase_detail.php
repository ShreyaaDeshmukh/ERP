<!-- Barcode print js -->
<script type="text/javascript">
	function printDiv(divName) {

		var printContents = document.getElementById(divName).innerHTML;
	    var originalContents = document.body.innerHTML;
		printContents = '<html><head><style>img {-webkit-print-color-adjust: exact;}</style></head><body>'+printContents+'</body></html>';
		console.log(printContents);
	    document.body.innerHTML = printContents;
		// document.body.style.marginTop="-45px";
	    window.print();
	    document.body.innerHTML = originalContents;


		// var content = document.getElementById(divName).innerHTML;
		// console.log(content);
		// var mywindow = window.open('', '', '');
		// mywindow.document.write('<html><title>Print</title><style type="text/css">');
		// mywindow.document.write('body,td,th{font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;border:1px solid #000;} table{width:100%;border-collapse: collapse;}');
		// mywindow.document.write('</style></head><body style="padding:10px;">')
		// mywindow.document.write(content);
		// mywindow.document.write('</body></html>');
		// mywindow.document.close();
		// setTimeout(function(){
		// 	 mywindow.print();
		// 	return true;
		// }, 1000);
   
	}
</script>
<!-- Purchase Payment Ledger Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('purchase_ledger') ?></h1>
	        <small><?php echo display('purchase_ledger') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('purchase') ?></a></li>
	            <li class="active"><?php echo display('purchase_ledger') ?></li>
	        </ol>
	    </div>
	</section>

	<!-- Invoice information -->
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
	<div class="form-group row">
                            <div class="col-sm-6">
                                <input type="button" id="print" class="btn btn-success btn-large"  onclick="printDiv('printableArea')" value="<?php echo display('print') ?>" tabindex="8" />
                            </div>
							</div>	
	<div id="printableArea">
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4>Purchase Order</h4>
		                </div>
		            </div>
		            <div class="panel-body">
	  					<div style="float:left; width:50%">
							<th width="100%" colspan="5" style="font-weight:normal">
				        	{company_info}
							<img src='<?php echo base_url('my-assets/image/logo/ce7168f07924880099439a9cb3605b98.jpg')?>' style="width: 100px;" alt>
				        	<!-- <h5> <u> {company_name}</u> </h5>  -->
				        	<h5> <!-- <u> WM-Simplified</u> --> </h5> 
				        	{/company_info}
							<b><?php echo "Vendor Info"; ?></b><br>
							<?php echo display('supplier_name') ?> : &nbsp;<span style="font-weight:normal">{supplier_name}<br/>
							<!-- <?php echo display('address') ?> :&nbsp; {product_details}<br> -->
							<?php echo display('address') ?> :&nbsp; {address}<br>
							  
				            </th>
						</div>

						<div style="float:right; width:50%;margin-top: 2%">
							<th width="100%" colspan="5" style="font-weight:normal">
				        	
							<span style=""><b><?php echo display('purchase_order_number') ?> :&nbsp; {purchase_id}</b></span><br><br><br><br>
				        	
							
							<b><?php echo "Ship Info"; ?></b><br>
							 Customer Name:&nbsp; {customer_name}<br> 
							  
							  Ship To: {ship_to_name}<br>
							  Address:&nbsp; {customer_address}<br> 
							  {customer_city}&nbsp;&nbsp;{customer_state}&nbsp;&nbsp;{customer_zip} <br> 
							 
				            </th>
						</div>

		            </div>
		        </div>
		    </div>
		</div>

		<!-- Purchase Ledger -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    

		                     <table class="table table-bordered table-striped table-hover"> 
								<thead>
									<tr>
										<th>Customer PO</th>
										<th>Date</th>
										<th>Ship Date</th>
										
										<th>Ship Via</th>
										
								
									</tr>
								</thead>
								<tbody>
									<td >{customer_po}</td>
									<td >{created_at}</td>
									<td >{ship_date}</td>
									<td >{shipping_name}</td>
								</tbody>
							</table>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive" style="overflow:hidden;">
		                    <table class="table table-bordered table-striped table-hover"> 
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('product_name') ?></th>
										<th>Description</th>
										<th><?php echo display('unit') ?></th>
										
										<th><?php echo display('quantity') ?></th>
										<th><?php echo display('rate') ?></th>
										<th><?php echo display('total_ammount') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($purchase_all_data) {
								?>
								{purchase_all_data}
									<tr>
										<td>{sl}</td>
										<td>
											<!--<a href="<?php echo base_url().'Cproduct/product_details/{product_id}'; ?>">
											{product_name}
											</a>-->
											{product_name}
										</td>
										<td style="text-align: left">{product_details}</td>
										<td style="text-align: left">{unit}</td>
										
										<td style="text-align: left">{requested_quantity}</td>
										<td style="text-align: left;"><?php echo (($position==0)?"$currency {rate}":"{rate} $currency") ?></td>
										<td style="text-align:left;padding-right:20px !important;"><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></td>
									</tr>
								{/purchase_all_data}
								<?php
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td style="text-align:right" colspan="6"><b><?php echo display('grand_total') ?>:</b></td>
										<td  style="text-align:right;padding-right:20px !important;"><b><?php echo (($position==0)?"$currency {sub_total_amount}":"{sub_total_amount} $currency") ?></b></td>
									</tr>
								</tfoot>
		                    </table>
							
							
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		
		</div>
	</section>
</div>
<!-- Purchase ledger End  -->