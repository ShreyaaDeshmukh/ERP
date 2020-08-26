<!-- Supplier Ledger Start -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('supplier_actual_ledger') ?></h1>
	        
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('supplier') ?></a></li>
	            <li class="active"><?php echo display('supplier_actual_ledger') ?></li>
	        </ol>
	    </div>
	</section>

	<!-- Supplier information -->
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
		            	<?php echo form_open('Csupplier/supplier_actual_ledger_rpt/',array('class' => 'form-inline', ))?>
		            		<?php $today = date('d-m-Y'); ?>
		            		
		            		
              <div class="form-group row">
                            <label  class="col-sm-2">Select Supplier</label>
                            <div class="col-sm-3">
                          <select name="supplier_id"  class="form-control"><option value=""><?php echo display('select_supplier')?> 
                                                </option>
                                            <?php
                                                if ($supplier){
                                            ?>
                                            {supplier}
                                                <option value="{supplier_id}">{supplier_name} 
                                                </option>
                                            {/supplier}
                                            <?php
                                                }
                                            ?>

                                             <?php 
                                    if(!empty($supplier_id)){
                                ?>
                                        <option value="{supplier_id}" selected>{supplier_name}</option>
                                <?php } ?>
                                            </select>
                               
                            </div>
                            <label  class="col-sm-2">Select Report <i class="text-danger"></i></label>
                            <div class="col-sm-3">
                           <select name="cat" class="form-control"  id='purpose'>
    <option value="0">select Report</option>
    <option value="all"><?php echo display('all') ?></option>
	<option value="1"><?php echo display('supplier_actual_ledger') ?></option>
	<option value="2"><?php echo display('supplier_details')?></option>
	<option value="3"><?php echo display('supplier_sales_summary')?></option>
	<option value="4"><?php echo display('supplier_payment_actual')?></option>
</select>
                               
                            </div>
                              <div class="col-sm-2 text-right"><button type="submit" class="btn btn-primary"><i class="fa fa-search-plus" aria-hidden="true"></i>
 <?php echo display('generate') ?></button></div>
                            
                        </div>  
                         <div class="form-group row" id="datebetween" style="display:none;padding-top: 10px;padding-left: 10px">
                            <label class="select col-sm-2"><?php echo display('search_by_date') ?>: <?php echo display('from') ?></label>
                            <div class="col-sm-4">
                          <input type="text" name="from_date"  value="<?php echo $today; ?>" class="datepicker form-control"/>
                                </div>
                           <label class="select col-sm-2"><?php echo display('to') ?></label>
                            <div class="col-sm-4">
                          <input type="text" name="to_date" value="<?php echo $today; ?>" class="datepicker form-control"/>
                               
                            </div>
                           
                             

                        </div>                                    

 
                                   
							
							
							
	                       
							
						<?php echo form_close()?>            
		            </div>
		        </div>
		    </div>
	    </div>

		<!-- Supplier ledger -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('supplier_actual_ledger') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <div class="text-center">
		                	<h4>{supplier_name}</h4>
							<h5><?php echo display('address')?>:{address}</h5>
							</div>

		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center"><?php echo display('date') ?></th>
										<th class="text-center"><?php echo display('description') ?></th>
										<th class="text-center"><?php echo display('total_sale_ctn') ?></th>
										<th class="text-center"><?php echo display('deposite_id') ?></th>
										<th class="text-center"><?php echo display('debit') ?></th>
										<th class="text-center"><?php echo display('credit') ?></th>
										<th class="text-center"><?php echo display('balance') ?></th>
									</tr>
									<tr>
										<td  colspan="4" align="center"><?php echo display('previous_balance') ?></td><td align="right"><?php echo (($position==0)?"$currency ":" $currency");
                             echo  number_format($previous_debit, 2, '.', ',');

									?></td><td align="right"><?php echo (($position==0)?"$currency ":" $currency");
                             echo  number_format($previous_credit, 2, '.', ',');

									?></td>
									<td align="right"><?php echo (($position==0)?"$currency ":" $currency");
                             echo  number_format($prveious_balance, 2, '.', ',');

									?></td>
								</tr>
								</thead>
								<tbody>
								<?php
									if ($ledger) {
								?>
								
								<?php foreach ($ledger as  $ledger) {
								
								 ?>
									<tr>
										<td><?php echo $ledger['date'] ?></td>
										<td><?php echo $ledger['description'] ?></td>
										<td align="right"><?php echo $ledger['total_cartoon'] ?></td>
										<td></td>
										<td></td>
										<td align="right"><?php if(!empty($ledger['total_taka']))echo (($position==0)?"$currency ":" $currency");
										echo $ledger['total_taka']; ?></td>
										<td align="right"><?php if(!empty($ledger['total_amount'])) echo (($position==0)?"$currency ":" $currency");
										//echo $ledger['total_amount'];
                             echo   number_format($ledger['total_amount'], 2, '.', ',')
										 ?></td>
									</tr>
								<?php }?>
								<?php
									}
								?>

								<?php
									if ($summary) {
								?>
							
								<?php foreach ($summary as  $value) {
									?>
								
									<tr>
										<td><?php echo $value['ledger_date']?></td>
										<td><?php echo $value['description']?></td>
										<td></td>
										<td><?php echo $value['deposit_no']?></td>
										<td align="right"><?php echo (($position==0)?"$currency ":'');
										echo $value['total_debit']; ?></td>
										<td></td>
										<td align="right"><?php echo (($position==0)?"$currency ":"");
										echo $value['total_debit']; ?></td>
									</tr>
								
								 <?php }?>
								<?php
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4" align="right"><b><?php echo display('grand_total')?>:</b></td>
										<td align="right"><b><?php echo (($position==0)?"$currency {SubTotal_debit}":"{SubTotal_debit} $currency") ?></b></td>
										<td align="right"><b><?php echo (($position==0)?"$currency {SubTotal_credit}":"{SubTotal_credit} $currency") ?></b></td>
										<td align="right"><b><?php echo (($position==0)?"$currency {total_amount}":"{total_amount} $currency") ?></b></td>
									</tr>
								</tfoot>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Supplier Ledger End  -->
<script type="text/javascript">
$('#purpose').on('change', function () {
	var x=0;
    if(this.value > x){
        $("#datebetween").show();
    } else {
        $("#datebetween").hide();
    }
   

});	



</script>