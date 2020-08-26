<?php
$r_id = $this->session->r_id;
$CI =& get_instance();
$CI->load->model('Purchases');
$all_supplier = $CI->Purchases->select_all_supplier($r_id);
$all_product = $CI->Purchases->all_product_list($r_id);
?>

<!-- Product Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/product_purchase.js.php" ></script>
<!-- Supplier Js -->
<script src="<?php echo base_url(); ?>my-assets/js/admin_js/json/supplier.js.php" ></script>
<!-- Purchase js -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/recieving.js" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css">

width: 509px !important;
    margin-left: 73px;
    margin-top: -18px;
    float: left;
    /* display: inline; */
    word-break: break-all;

		@media (min-width: 647px) {
      .myContainer {
				width: 509px !important;
       margin-left: 73px;
       margin-top: -18px;
       float: left;
      /* display: inline; */
       word-break: break-all;

      }
      .myleftBlock-should-collapse {
           float: none;
           width: 100%;
      }

 }
   .close{color:white;}
   .disabledTab{
   pointer-events: none;
   }
   .ponumberclass{
   margin-left:30px;
   color: #37a000;
   font-family: monospace;
   }
   .ponumberclass1{
    
   float: right;
   color: #37a000;
   font-family: monospace;
   }
   ponumberclass2{
   color: #37a000;
   font-family: monospace;
   }
   .myfontfamily{
   font-family: monospace;
   }
   .otherthaneach{
	   display:none;
   }
   h5{
	   padding-top:15px;
   }
   em{
		font-family: sans-serif;
		margin-left: 10%;
   }
   .bg-Blue-dark {
    background-color: #2abb67!important;
    color: #fff;
}
</style>
<!-- Add New Purchase Start -->
<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?php echo display('add_recieving') ?></h1>
         <small><?php echo display('add_new_recieving') ?></small>
         <ol class="breadcrumb">
            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
            <li><a href="#"><?php echo 'Receiving' ?></a></li>
            <li class="active"><?php echo display('add_recieving') ?></li>
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
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
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
			<?php echo form_open_multipart('/Crecieving/manage_recieving',array('class' => 'form-vertical', 'id' => 'purchase_update'))?>
			<div class="col-md-12">	
			<div class="panel panel-default">
                <div class="panel-body"> 
				<div class="col-sm-3">
					
					<select name="supplier_id" id="vendor_search" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search by Vendor" ?></option>
						<?php foreach($all_supplier as $allsupplier):?>
						<option <?php if(@$post['supplier_id']==$allsupplier['supplier_id']){?> selected="selected "<?php }?> value="<?php echo $allsupplier['supplier_id']?>"><?php echo $allsupplier['supplier_name']?></option>
						<?php endforeach;?>
						
					</select>
				</div>
				
				<div class="col-sm-3">
					<select name="product_id" id="product_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Product" ?></option>
						<?php foreach($all_product as $allproduct):?>
						<option <?php if(@$post['product_id']==$allproduct['product_id']){?> selected="selected "<?php }?> value="<?php echo $allproduct['product_id']?>"><?php echo $allproduct['product_name']?></option>
						<?php endforeach;?>
					</select>
				</div>
				
				<!--
				<div class="col-sm-2">
					<input type="text" class="form-control" placeholder="Search By Customer PO" name="customer_po" id="customer_po" value="<?php echo @$_POST['customer_po']?>">
				</div> -->
				
				<div class="col-sm-3">
				<select name="customer_name" id="customer_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Customer" ?></option>
						<?php foreach($all_customer as $allcustomer):?>
						<option <?php if(@$post['customer_name']==$allcustomer['customer_name']){?> selected="selected "<?php }?> value="<?php echo $allcustomer['customer_name']?>"><?php echo $allcustomer['customer_name']?></option>
						<?php endforeach;?>
					</select>


					<!-- <input type="text" class="form-control" placeholder="Search By customer name" name="customer_name" id="customer_name" value="<?php echo @$_POST['customer_name']?>"> -->
				</div>
				
				<div class="col-sm-3">
					<button style="text-align: right;" class="btn btn-primary" type="button" value="Search" onclick="searchPO()">Search</button>
					<button style="text-align: right;" class="btn btn-danger" type="reset" value="Reset" onclick="resetForm();"><?php echo display('reset')?></button>
				</div>
			
				</div>	
			</div>	
			</div>	
			<?php echo form_close()?>
        </div>
	  
	  
	  
	  
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
               <div class="panel-heading">
                  <div class="panel-title">
                     <h4><?php echo 'Receiving Order' ?></h4>
                  </div>
               </div>
               <div class="panel-body">
                  <?php echo form_open_multipart('',array('class' => 'form-vertical', 'id' => 'insert_recieving','name' => 'insert_recieving', 'onsubmit' => 'return checkAllValues()'))?>
				  <?php 
				//   print_r(checkAllValues());die;?>
                  <div class="row">
                     <ul class="nav nav-tabs">
                        <li class="active tabrecieving firstli"><a data-toggle="tab" href="#step1">Step 1</a></li>
                        <li class="disabledTab tabrecieving secondli"><a data-toggle="tab" href="#step2">Step 2</a></li>
                        <li class="disabledTab tabrecieving thirdli"><a data-toggle="tab" href="#step3">Step 3</a></li>
                        <!--<li class="disabledTab tabrecieving fourli"><a data-toggle="tab" href="#step4">Step 4</a></li>-->
                     </ul>
                  </div>
                  <div class="row">
                     <div class="tab-content">
                        <div id="step1" class="tab-pane fade in active row">
                           <div class="col-md-2"></div>
						   
						   <div class="col-sm-8">
                              <div class="form-group">
                                 <label for="date" class="col-sm-4 col-form-label"><?php echo "PO/RO Number" ?>
                                 <i class="text-danger">*</i>
                                 </label>
								 <?php if(isset($_GET['purchase_id'])) {
									 ?>
                                 <input style="text-transform: uppercase;" type="text" placeholder="Enter PO/RO Number" value=<?php echo $_GET['purchase_id']; ?> name="numb" id="numb" class="form-control" required>
								 <?php }
								 else{ ?>
								 <input style="text-transform: uppercase;" type="text" placeholder="Enter PO/RO Number"  name="numb" id="numb" class="form-control" required>
								 <?php } ?>
                              </div>
                              <div class="form-group">
                                 <input type="button"  id="sub" class="btn btn-success btn-large" name="add-purchase" value="<?php echo display('submit') ?>"/>
                              </div>
                           </div>
						   <div class="col-md-2"></div>
						   
                        </div>
                        <div id="step2" class="tab-pane fade disable row">
                           <div class="col-md-2"></div>
						   <div class="col-sm-8">
                              <div class="cart-costs large-costs full-bottom">
                                 <h5><strong>PO/RO Number</strong><b class="color-Blue-dark ponumberclass" id="ponumber"></b></h5>
                                 <h5><strong>Vendor Name</strong><b class="color-Blue-dark ponumberclass" id="vendorname"></b></h5>
                                 <h5><strong>Customer Name</strong><b class="color-Blue-dark ponumberclass" id="customername"></b></h5>
								 <h5><strong>Customer PO</strong><b class="color-Blue-dark ponumberclass" id="customerpo"></b></h5>
								 <h5><strong>Description</strong><b class="color-Blue-dark ponumberclass" id="productdes"></b></h5>
								 
                                 <div class="clear"></div>
                              </div>
                              <div class="store-input">
                                 <h4>Items</h4>
                                 <select id="itemList" onchange="return showdesc(this)"  class="form-control dont-select-me"></select>
                              </div>
                              <div class="decoration"></div>
                              <div style="margin-top:20px;"  class="form-group">
								<input type="button"  id="gobackRStep2" class="btn btn-normal" name="add-purchase" value="<?php echo 'Back' ?>"/>
                                 <input type="button" value="Go" name="add-purchase-another" class="btn btn-large btn-success" id="sub2" >
								 
                              </div>
                           </div>
						   <div class="col-md-2"></div>
                        </div>
                        <div id="step3" class="tab-pane fade disable row">
							<div class="content" style="text-align: left;font-family: roboto,sans-serif;text-transform: none;">
												<div id="receiving3_sub1">
												<h3>Item Information</h3>
												
												<div class="cart-costs large-costs full-bottom">
													<div class="row">
													
													<div class="col-md-2"><strong>PO/RO Number</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style="margin-left:-5%;"><em class="color-Blue-dark" id="ponumber3"></em></div>
													
													<div class="col-md-2"><strong>Item Number</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style="margin-left:-5%;"><em  id="itemnumber"></em></div>


													<div class="col-md-2"><strong>Line Item</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style="margin-left:-5%;"><em  id="itemSNumber"></em></div>
													
													
													<div class="col-md-2"><strong>Item Name</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style="margin-left:-5%;"><em  id="product_name"></em></div>
													
													<div class="col-md-2"><strong>Item Description</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style=" display: inline; margin-left:-5%;"><em  id="product_decriptionset3"></em></div>
													
													<div class="col-md-2"><strong>Quantity</strong></div>
													<div class="col-md-1">:</div>
													<div class="col-md-9" style="margin-left:-5%;"><em ><span class="color-Blue-dark" id="qtynunitrec"></span>/<span class="color-Blue-dark" id="qtynunit"></span><span id="unitassigned"></span></em></div>
													</div>
													<div class="clear"></div>

													<br/>
													<br/>
													<div class ="row" id="tapan">
													<div class="col-sm-1">
														<input type="button"  id="gobackR" class="btn btn-normal" name="add-purchase" value="<?php echo 'Back' ?>" onclick="onBackKeyDown();"/>
													</div>
													<div class="col-sm-1">
														<input type="button" value="Next" name="add-purchase-another" class="btn btn-large btn-success" id="rec3_sub1">
													 </div>
													 </div>
													
													<div class="clear"></div>

												</div>
												</div>
												<div class="decoration"></div> 
												<div id="receiving3_sub2">
												<!-- <h5><strong>PO/RO Number</strong><b class="color-Blue-dark ponumberclass" id="ponumber1"></b></h5> -->
												
												<h3>Defined Units</h3>
												
												<div class="cart-costs large-costs full-bottom" id="showalldefinedunits">

													

													<div class="clear"></div>
												</div>
												<!--<input type="button" value="Add" name="add-purchase-another" class="btn btn-large btn-normal" id="adddefinedunitsdata" tabindex="11">
												
												<div class="clear"></div>

												<input type="button" value="Next" name="add-purchase-another" class="btn btn-large btn-success" id="rec3_sub2" tabindex="11">-->
												
												
												
												<div class="form-group row">
													<div class="col-sm-3">
													<input type="button"  id="gobackR" class="btn btn-normal" name="add-purchase" value="<?php echo 'Back' ?>" onclick="onBackKeyDown1();" style="margin:5px;"/>
														<input type="button" value="Add" name="add-purchase-another" class="btn btn-large btn-primary" id="adddefinedunitsdata" style="margin:5px;">
														<input type="button" value="Next" name="add-purchase-another" class="btn btn-large btn-success" id="rec3_sub2" style="margin:5px;">
														
													</div>
													<div class="col-sm-3">
														<div class="errorhandler"></div>
													</div>
												</div>
						
						
												<div class="decoration"></div>
												</div>
												<div id="receiving3_sub3">
												<!-- <h5><strong>PO/RO Number</strong><b class="color-Blue-dark ponumberclass" id="ponumber2"></b></h5> -->
												<h3>Fill details</h3>
												
												<div class="cart-costs large-costs full-bottom">
												<h5 style="display: none"><strong>UnitID</strong><em style="font-size: 12px;" class="color-Blue-dark" id="label1"></em></h5>
													
												<br/>	
	
													<div class="clear"></div>

													<div class="container row">
														<div class="col-md-2">
															<strong>Selected Per</strong>
														</div>
														<div class="col-md-6">
															<div id="unittypeindexwithdetails"></div>
														</div>	
														<div class="clear"></div>
													</div>

													<div class="clear"></div>
													<br/>
													<div class = "otherthaneach row">
														<div  class="one-half">
															<div class="store-input">
															<h6>Per</h6>
																<select id="per1">
																	<option>None</option>
																	
																</select>
															</div>
														</div>
														
														
														<div class="one-half last-column">
															<div class="store-input">
																<h6>Inner-Per</h6>
																	<select id="per2">
																		<option>None</option>
																	</select>
															</div>
														</div>
													</div>



													<div class="clear"></div>
													<br/>
													<div id="onPalletChange row">
														<div class="one-half-responsive col-sm-2">
															<div class="store-input form-group">
																<p style="font-weight:bold;">Rec QTY</p>
																<input class="form-control" type="number" min="1" placeholder="QTY" name="qty1" id="qty1" required>
															</div>
														</div>
													</div>




													
													<div class="clear"></div>
													<div class="decoration"></div>
													<div class="row">
													<div class="col-sm-2">
													<div class="one-half">
														<div class="store-input form-group">
														<p style="font-weight:bold;">Lot</p>
															<input type="text" class="form-control" placeholder="LOT" name="lot" id="lot">
														</div>
													</div>
													</div>
													<div class="row">
													<div class="col-sm-2">
													<div class="one-half last-column">
														<div class="store-input form-group">
															<p style="font-weight:bold;">Exp Date</p>
															<input type="text" class="form-control datepicker" placeholder="Exp Date" style="vertical-align: middle;padding-top: 8%;" name="exp_date" id="exp_date" readonly="true">
														</div>
													</div>
													</div>
													
													
													<div class="clear"></div>

													
														<div class="col-sm-2">
															<div class="one-half-responsive">
																<div class="store-input form-group">
																	<p style="font-weight:bold;">Sell Date</p>
																	<input type="text" class="form-control datepicker" placeholder="Sell Date" style="vertical-align: middle;padding-top: 4%;" name="sell_date" id="sell_date" readonly="true">
																</div>
															</div>
														
													</div>
													</div>
													

													<div class="clear"></div>
												<br/>
												<br/>
												</div>
												
												<div class="decoration"></div>
												<!--<a href="#" id="sub3" class="button button-Blue button-full">Receive</a>-->
												<input type="button"  id="gobackR" class="btn btn-normal" name="add-purchase" value="<?php echo 'Back' ?>"  onclick="onBackKeyDown2();" style="margin-left:20px;"/>
												
												 <input type="button" value="Receive" name="add-purchase-another" class="btn btn-large btn-success" id="sub3">
												
												<input type="button" value="Cancel" name="add-purchase-another" class="btn btn-large btn-danger" id="calcelRecieving" >
												<a href="<?php echo base_url('');?>">
													<input type="button" value="Done" name="add-purchase-another" class="btn btn-large btn-primary" id="doneRecieving" >
												</a>
												
												<div class="clear"></div>
												<br/>
											<div class="decoration"></div>
											
											<div class="content">
												<div class="row">
													<div class="col-sm-12">
														<div class="one-half-responsive">
															<h4>Received Items</h4>
															<div class="col-md-12">
																<a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><?php echo display('print')?></a>
															</div>
															
															<div  style="width: 50px !important;"class="toggle store-history-toggle" id="appenddata">
															
															
															</div>
														
														</div>
														
														
														<!-- <div class="table-responsive" id="printableArea" >-->
														
														<div  id="printableArea" >
															<table class="table table-bordered table-striped table-hover">
																<tbody id ="lblprint">
																	
																</tbody>
															</table>
														</div>
														
													</div>
										</div>
									</div>
								</div>
                        </div>
						
						<div id="setunitsscreen" style="display:none">
									
											<div class="decoration decoration-margins"></div>
											<div class="content" style="text-align: left;font-family: roboto,sans-serif;text-transform: none;">


												<h5><strong>PO/RO Number</strong><b class="color-Blue-dark ponumberclass" id="ponumber1"></b></h5>
												
												<h3>Defined Units</h3>
												<p class="half-bottom">
												You can add the units.
												</p>
												<div class="cart-costs large-costs full-bottom" id="appendUnitsDivs">
													
													<div class="row">	
														
														<div class="one-half last-column col-md-3">
															<div class="store-input form-group">
														
																<select id="perfrom"class="form-control dont-select-me" >
																	<option value="">Select</option>
																	<option value="EACH">EACH</option>
																	<option value="INNER_CART">INNER CART</option>
																	<option value="CARTON">CARTON</option>
																	<option value="PALLET">PALLET</option>
																</select>
															</div>
														</div>
														
														<div class="one-half col-md-3">
															<div class="store-input form-group">
										
																

																<input class="form-control" type="number" value="1" readonly placeholder="QTY" name="perfromqty" id="perfromqty">
																


															</div>
														</div>
													</div>	
													
													<div class="row">	
														
														<div class="one-half last-column col-md-3">
															<div class="store-input form-group">
														
																<select id="inperfrom" class="form-control dont-select-me" >
																	<option value="">None</option>
																	
																</select>
															</div>
														</div>
														
														<div class="one-half col-md-3">
															<div class="store-input form-group">
										
																

																<input class="form-control" type="number" value="" placeholder="QTY" name="inperfromqty" id="inperfromqty" min="1">
																


															</div>
														</div>
													</div>

													<div class="row">

														
														<div class="one-half last-column col-md-3">
															<div class="store-input form-group">
														
																<select id="ininnerperfrom" class="form-control dont-select-me" >
																	<option value="">None</option>
																	
																</select>
															</div>
														</div>
														
														<div class="one-half col-md-3" >
															<div class="store-input form-group">
										
																

																<input class="form-control" type="number" value="" placeholder="QTY" name="ininnerperfromqty" id="ininnerperfromqty" min="1">
																


															</div>
														</div>
														
	
													</div>
													
													<div class="row">

														
														<div class="one-half last-column col-md-3">
															<div class="store-input form-group">
														
																<select id="lastininnerperfrom" class="form-control dont-select-me" >
																	<option value="">None</option>
																	
																</select>
															</div>
														</div>
													
													
													<div class="one-half col-md-3" >
															<div class="store-input form-group">
										
																

																<input type="number" class="form-control"  value="" placeholder="QTY" name="lastininnerperfromqty" id="lastininnerperfromqty" min="1">
																


															</div>
														</div>
													

												
												</div>
												
												
												
												
												
												<div class="decoration"></div>
												
												<!--<a href="#" id="setunits" class="button button-Blue button-full">Set</a>
												<a href="#" id="calcelunits" class="button button-Blue button-full">Cancel</a>-->
												
												<div class="form-group row">
													<div class="col-sm-3">
														<input type="button" value="Set" name="add-purchase-another" class="btn btn-large btn-primary" id="setunits">
														<input type="button" value="Cancel" name="add-purchase-another" class="btn btn-large btn-danger" id="calcelunits">
													</div>
													<div class="col-sm-3">
														<div class="errorhandler"></div>
													</div>
												</div>
											</div>
											<div class="clear"></div>
											

									
										</div>
										</div>
										
										
                        <div id="step4" class="tab-pane fade disable">
                           <h3>Menu 3</h3>
                           <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                        </div>
                        <!-- The Modal -->
                        <div id="myModal" class="modal fade" style="background-color:rgba(0,0,0,0.4);">
                           <!-- Modal content -->
						   <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <span class="close">&times;</span>
                                 <h2>Serial Number <span id="dynamicHeader">(1/2)</span></h2>
                              </div>
                              <div class="modal-body">
							  <div class="row">
								<div class="col-md-2"></div>
                                 <div class="one-half-responsive col-md-8">
                                    <div class="store-input form-group">
                                       <h6>Serial Number</h6>
                                       <input class="form-control" type="text" placeholder="Serial Number" name="serial" id="serial"><i class="ion-qr-scanner"></i>
                                    </div>

																		<!-- <p><span id='display'></span></p> -->
																 </div>
														 
								<div class="col-md-2"></div> 
								</div>
								<div>
								<p id="duplicate" style = "color:red; margin-left: 150px;"></p>
								</div>
								<div>						 
										<label>Serial Number: </label>
                                 <p><span id="displayt"></span></p>
											</div>	
                              </div>
                              <div class="modal-footer">
                                <!-- <a href="#" id="serialNext"  class="button button-Blue button-full">Next</a> -->
								  <input type="button"  id="serialNext" class="btn btn-success btn-large"  
									value="Next"
									/> 
								
                              </div>
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php echo form_close()?>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!-- Purchase Report End -->
<style type="text/css">
   .btn:focus {
   background-color: #6A5ACD;
   }
</style>

<script src="<?php echo base_url()?>my-assets/js/admin_js/juiBlock.js" type="text/javascript"></script>

<script>

var r_id = '<?php echo $r_id; ?>';
var arr =[];
var snoshowt='';
// document.getElementById("display").innerHTML = arr;






document.addEventListener("backbutton", onBackKeyDown, false);

function searchPO(){
	var vendor_search = $('#vendor_search').val();
	var product_sss = $('#product_sss').val();
	var customer_name = $('#customer_name').val();
	if(customer_name ==''){
		
	}

	var formData = {
		  apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
		  data: {
			  customer_name: customer_name,
			  product_sss: product_sss,
			  vendor_search:vendor_search,
			  status:'true',
			
		  }
	  }
	  
	 
	$.ajax({
	  type: 'POST',
	  data: JSON.stringify(formData),
	  url: serverUrl+'getItemPoList',
	  success: function (data) {
	
		var result = JSON.parse(data);
		if((result.data.data).length > 0){
			var availableTags = result.data.data;
			$("#numb").autocomplete({
				source: availableTags
			});
		}
			
		},error: function (xhr) {
			console.log(xhr);
        }
	});

	
}


$("#gobackR").click(function () {
		/* window.location.href = "Crecieving"; */
		$("#step1").removeClass("active");	
   					$("#step1").removeClass("in");	
   					$("#step1").addClass("disable");
   
   					$("#step2").addClass("in");	
   					$("#step2").addClass("active");	
   					$("#step2").removeClass("disable");
	});
	
	

	var serverUrl = '<?php echo base_url('api/services.php?action=')?>';
	
   var order_type = "purchase";
	var inner_cart_quantity = "0";



	var cartoon_quantity = "0";
	var pallet_quantity = "0";
	var flagICEA = 0;
	var flagCREA = 0;
	var flagCRIC = 0;
	var flagPLCR = 0;
	var arrayUnits = [];
	var arrayUnits1 = [];
	var stringSerialNumber = "";
	var countqty = 0;
	var serialDiv = 0;
	var totalQuantityInEach = 0;
	var lot_flag = 0;
	var expiry_flag = 0;
	var serial_flag = 0;
	var purchase_detail_id = 0;
	var productNumber = 0;
	var unitidIndex = 0;
	var unitStringForJson = "";
	var unitstringforReveving = "";
	var labelArru = [];
	var arrDes = [];
   // Get the modal
   		var modal = document.getElementById('myModal');
   
   
   		// Get the <span> element that closes the modal
   		var span = document.getElementsByClassName("close")[0];
   
   
   
   		// When the user clicks on <span> (x), close the modal
   		span.onclick = function() {
   		
	var unitStringForJson = "";
	var unitstringforReveving = "";
   			serialDiv = 0;
   			totalQuantityInEach = 0;
   
   			//modal.style.display = "none";
			$('#myModal').modal('hide');
   			
   		}
   
   
   $("#gobackRStep2").click(function () {
			var r_id=<?php echo $this->session->r_id?>;
			
			window.location.href = '<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
		});
		
   		// When the user clicks anywhere outside of the modal, close it
   
   $("#sub").click(function () {
   
 
 
          $('#resMsg').html('');
          
   
          if ($('#numb').val() == '') {
              $("#numb").focus();
              $("#numb").css("border-color", "#f16d6d");
              return false;
          }
       
   
          var formData = {
              apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
              data: {
                  po: $('#numb').val(),
				  r_id : r_id,
				  userid : localStorage.getItem("user_id")
			
              }
          }
   
          $('#ponumber').html($('#numb').val().toUpperCase());
          $('#headerReceiving').html($('#numb').val().toUpperCase());
   	
          $("#sub").prop('disabled', true);
          $('#sub').html('Wait...');
   
          $.ajax({
              type: 'POST',
              data: JSON.stringify(formData),
              url: serverUrl+'getItemByPoRoId',
              success: function (data) {
              
			   var result = JSON.parse(data);
			   
			   var res= result.datat;
			   var status=res.status;
		
			 

                  if (status == false || status == "false" || status === "false") {
                    $("#numb").css("border-color", "#f16d6d");
   					swal("", res.message, "warning");
   					$("#sub").prop('disabled', false);
                    $('#sub').html('Search');
   				
                  }
                  else {
					// alert(312);
                      //$('#resMsg').html(result.data.message);
   				
                      $("#sub").prop('disabled', false);
                      $('#sub').html('Search');
   						$("#receiving1").css("display", "none");
						$("#receiving2").css("display", "block");
					 
					//  console.log(12212);
                      var selectData = res.mydata;
                      order_type = result.datat.order_type;
        
                     
   
					  var optionString = '';
					
                      if (selectData.length > 0) {
   
                         
						
                          for (var i = 0; i < selectData.length; i++){
								var obj = {};
								obj.pid = selectData[i].product_id +'#' + selectData[i].purchase_detail_id;
								obj.product_details = selectData[i].product_details;
								arrDes.push(obj);
                              //alert(selectData[i].product_id);
                              //optionString = optionString + '<option value="' +[i+1]+'#'+ selectData[i].product_id +'#' + selectData[i].purchase_detail_id +'">'+selectData[i].product_name+'</option>';
                              optionString = optionString + '<option value="' +[i+1]+'#'+ selectData[i].product_id +'#' + selectData[i].purchase_detail_id +'">(Item-'+[i+1]+') '+selectData[i].product_name+'</option>';
                          }
   					$('#itemList').html(optionString);
   					$('#productdes').html(selectData[0].product_details);
   					$(".firstli").removeClass("active");
   					$(".firstli").addClass("disabledTab"); 
   					$("#step1").removeClass("active");	
   					$("#step1").removeClass("in");	
   					$("#step1").addClass("disable");
   
   					$("#step2").addClass("in");	
   					$("#step2").addClass("active");	
   					$("#step2").removeClass("disable");
   					
   					$(".secondli").addClass("active");
   					$(".secondli").trigger("click");
                      }
                      
                      $("#numb").css("border-color", "#ccc");
                    
   
				  }

				  
				  var alldata=res.mydata;
				 
				  $("#vendorname").html(alldata[0].supplier_name);	
				  $("#customername").html(alldata[0].customer_name);	
				  $("#customerpo").html(alldata[0].customer_po);
                  $("#sub").prop('disabled', false);
                  $('#sub').html('Search');
              },
              error: function (xhr) {
                  console.log(xhr);
              }
          });
		  $("#gobackR").click(function () {
				/* window.location.href = "Crecieving"; */
				
				$("#step1").removeClass("active");	
   					$(".firstli").removeClass("active");
   					$(".firstli").addClass("disabledTab");
					$("#step1").removeClass("active");	
   					$("#step1").removeClass("in");	
   					$("#step1").addClass("disable");
					$(".thirdli").removeClass("active");
   					$(".thirdli").addClass("disabledTab");
					$("#step3").removeClass("active");	
   					$("#step3").removeClass("in");	
   					$("#step3").addClass("disable");
					
   					$("#step2").addClass("in");	
   					$("#step2").addClass("active");	
   					$("#step2").removeClass("disable");
   					
   					$(".secondli").addClass("active");
   					$(".secondli").trigger("click");
					
					 $("#numb").css("border-color", "#ccc");
				
			});
      });
   
   
    $("#sub2").click(function () {
   
       $("#receiving3_sub1").css("display", "block");
   	$("#receiving3_sub2").css("display", "none");
	
	
   	$("#receiving3_sub3").css("display", "none");
   
          $('#resMsg').html('');
   
   
          if ($('#itemList').val() == '') {
              $("#itemList").focus();
              $("#itemList").css("border-color", "#f16d6d");
              return false;
          }
   
          var productArray = $('#itemList').val();
   
          var prDetails = productArray.split("#");
   
         

        purchase_detail_id = prDetails[2];
        productNumber = prDetails[1];
        var itemSNumber = prDetails[0];
   
          var formData = {
              apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
              data: {
                  product_id: productNumber,
                  purchase_detail_id: purchase_detail_id,
                  po: $('#ponumber').html(),
   			order_type: order_type,
		
              }
          }
   	var po = $('#ponumber').html();
   
   
          $('#ponumber3').html(po);
          $('#itemnumber').html(productNumber);
          $('#itemSNumber').html(itemSNumber);
          $("#sub2").prop('disabled', true);
          $('#sub2').html('Wait...');
   
          $.ajax({
              type: 'POST',
              data: JSON.stringify(formData),
              url: serverUrl + 'getItemDetail',
              success: function (data) {
                  var result = JSON.parse(data);
   			
   
   			
                  if (result.data.status == "false") {
                      $("#numb").css("border-color", "#f16d6d");
   
                      swal("", result.data.message, "warning");
   
   				
                  }
                  else {
					$(".secondli").removeClass("active");
   					$(".secondli").addClass("disabledTab"); 
   					$("#step2").removeClass("active");	
   					$("#step2").removeClass("in");	
   					$("#step2").addClass("disable");
   
   					$("#step3").addClass("in");	
   					$("#step3").addClass("active");	
   					$("#step3").removeClass("disable");
   					
   					$(".thirdli").addClass("active");
   					$(".thirdli").trigger("click");
   				var unitdata = JSON.parse(result.data.data[0].unit_values);
   				
   				localStorage.setItem("snoArray", JSON.stringify(result.data.data[0].arraySNO));
   				
   				arrayUnits = unitdata;
					arrayUnits1 = unitdata;

					for(var i = 0; i < arrayUnits1.length; i++) {
					    delete arrayUnits1[i]['sell_price'];
					    delete arrayUnits1[i]['vendor_price'];
					}

					
					
					arrayUnits = JSON.parse(result.data.data[0].unit_values);
					
   				var showalldefinedunits = '';
   
   
   				for(var i=0; i<arrayUnits.length; i++){
						if(i % 2 == 0){
							var t = '<label style="width:100%;"><input checked type="radio" name="unittypeselected" value="'+i+'">';
						}else{
							var t = '<label style="width:100%;"><input checked type="radio" name="unittypeselected" value="'+i+'">';
						}

						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
							// if(t==""){
							// 	t = arrayUnits[i].PALLET+" PLT -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].PALLET+" PLT -> ";
							// }
							
							
						}

						if("CARTON" in arrayUnits[i]){

							t = t+arrayUnits[i].CARTON+" CTN -> ";
						
							// if(t==""){
							// 	t = arrayUnits[i].CARTON+" CTN -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].CARTON+" CTN -> ";
							// }
							
						}

						if("INNER_CART" in arrayUnits[i]){

							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";

							// if(t==""){
							// 	t = arrayUnits[i].INNER_CART+" IN-CTN -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";
							// }
							
						}

						if("EACH" in arrayUnits[i]){

							t = t+arrayUnits[i].EACH+" EA";

							// if(t==""){
							// 	t = arrayUnits[i].EACH+" EA";
							// }
							// else{
							// 	t = t+arrayUnits[i].EACH+" EA";
							// }
							
						}
						

						showalldefinedunits = showalldefinedunits+t+"</label>";
					}
   				$("#showalldefinedunits").html(showalldefinedunits);
   		
   		
                      $("#sub2").prop('disabled', false);
                      $('#sub2').html('Go');
                      $("#receiving1").css("display", "none");
                      $("#receiving2").css("display", "none");
                      $("#receiving3").css("display", "block");
                      var getData = result.data.data;
					  
				
				
                      
   				$("#qty1").val('');
   				/*	
   				if((unitdata['ICEA'].isUpdated == undefined) || (unitdata['ICEA'].isUpdated == 0) || (unitdata['ICEA'].isUpdated == "0") ){
   					flagICEA = 0;
   					$('#unitEachInOneInnerCart').val(unitdata['ICEA'].EA);
   					$("#unitEachInOneInnerCart").prop('readonly', false);
   				}else{
   					flagICEA = unitdata['ICEA'].isUpdated;
   					$("#unitEachInOneInnerCart").val(unitdata['ICEA'].EA);
   					$("#unitEachInOneInnerCart").prop('readonly', true);
   				}
   				
   				if((unitdata['CREA'].isUpdated == undefined) || (unitdata['CREA'].isUpdated == 0) || (unitdata['CREA'].isUpdated == "0") ){
   					flagCREA = 0;
   					$('#unitEachInOneCarton').val(unitdata['CREA'].EA);
   					$("#unitEachInOneCarton").prop('readonly', false);
   				}else{
   					flagCREA = unitdata['CREA'].isUpdated;
   					$("#unitEachInOneCarton").val(unitdata['CREA'].EA);
   					$("#unitEachInOneCarton").prop('readonly', true);
   				}
   				
   				if((unitdata['CRIC'].isUpdated == undefined) || (unitdata['CRIC'].isUpdated == 0) || (unitdata['CRIC'].isUpdated == "0") ){
   					flagCRIC = 0;
   					$('#unitInnerCartInOneCarton').val(unitdata['CRIC'].IC);
   					$("#unitInnerCartInOneCarton").prop('readonly', false);
   				}else{
   					flagCRIC = unitdata['CRIC'].isUpdated;
   					$("#unitInnerCartInOneCarton").val(unitdata['CRIC'].IC);
   					$("#unitInnerCartInOneCarton").prop('readonly', true);
   				}
   				
   				if((unitdata['PLCR'].isUpdated == undefined) || (unitdata['PLCR'].isUpdated == 0) || (unitdata['PLCR'].isUpdated == "0") ){
   					flagPLCR = 0;
   					$('#unitCartonInOnePallet').val(unitdata['PLCR'].CR);
   					$("#unitCartonInOnePallet").prop('readonly', false);
   				}else{
   					flagPLCR = unitdata['PLCR'].isUpdated;
   					$("#unitCartonInOnePallet").val(unitdata['PLCR'].CR);
   					$("#unitCartonInOnePallet").prop('readonly', true);
   				}
   				
   
   				$("#eachpinnercart").html("<span style='color:Blue'>"+unitdata['ICEA'].EA+"</span> <span style='color:Blue'>EACH</span>");
   				$("#eachpcarton").html("<span style='color:Blue'>"+unitdata['CREA'].EA+"</span> <span style='color:Blue'>EACH</span>");
   				$("#innercartpcarton").html("<span style='color:Blue'>"+unitdata['CRIC'].IC+"</span> <span style='color:Blue'>INNER-CART</span>");
   				$("#cartonppallet").html("<span style='color:Blue'>"+unitdata['PLCR'].CR+"</span> <span style='color:Blue'>CARTON</span>");
   				*/
   
   				$("#label1").html(labran());
   
   				
   				$("#unitassigned").html('EACH');
   				
   				/*if(result.data.data[0].unit == "CARTON"){
   					$('#qtynunit').html(result.data.data[0].quantity * unitdata['CREA'].EA);
   				}
   				else if(result.data.data[0].unit == "INNER_CART"){
   					$('#qtynunit').html(result.data.data[0].quantity * unitdata['ICEA'].EA);
   				}
   				else if(result.data.data[0].unit == "PALLET"){
   					$('#qtynunit').html(result.data.data[0].quantity * unitdata['CREA'].EA * unitdata['PLCR'].CR);
   				}
   				else{
   					$('#qtynunit').html(result.data.data[0].quantity);
   				}
   			*/
   				$('#qtynunit').html(result.data.data[0].quantity);
   				$('#qtynunitrec').html(result.data.data[0].total_quantity_received);
   				$("#product_name").html(result.data.data[0].product_name);
   				$("#qtynunitrec").html();
   				$('#product_decriptionset3').html(result.data.data[0].product_details)
				
   				lot_flag = result.data.data[0].lot_flag;
   				expiry_flag = result.data.data[0].expiry_flag;
					serial_flag = result.data.data[0].serial_flag;
					if(serial_flag == 1){
						$("#adddefinedunitsdata").hide();
					}
					else{
						$("#adddefinedunitsdata").show();
					}
				

					var dt = new Date();

					var month = dt.getMonth()+1;
					var day = dt.getDate();

					var output = dt.getFullYear() + '-' +
					    ((''+month).length<2 ? '0' : '') + month + '-' +
					    ((''+day).length<2 ? '0' : '') + day;

					$('#sell_date').attr( 'min',output);    
					$('#exp_date').attr( 'min',output);    
   				$("#forunittype_each").click();
   				$("#sell_date").val('');
   				$("#exp_date").val('');
   				$("#serial").val('');
   				$("#appenddata").html('');
   				
   
                  }
   
                  $("#sub2").prop('disabled', false);
                  $('#sub2').html('Go');
              },
              error: function (xhr) {
                  console.log(xhr);
              }
          });
		  $("#gobackRStep2").click(function () {
			  var r_id=<?php echo $this->session->r_id?>;
		
			window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
		});
      });
   
   $("#rec3_sub1").click(function () {
   var qtyRece = $('#qtynunitrec').html();
		var qtynunitPO = $('#qtynunit').html();
		if(qtyRece == ''){
			qtyRece = 0;
		}else{
			qtyRece = parseInt(qtyRece);
		}
		
		if(qtynunitPO >= qtyRece){
			$("#receiving3_sub1").css("display", "block");
			$("#receiving3_sub2").css("display", "none");
			$("#receiving3_sub3").css("display", "block");
			$("#ponumber2").html($("#ponumber").text());
		}else{
			
			swal("Recevice quantity is more than PO quantity. Do you want to recevice more?", {
				  buttons: {
					cancel: "No",
					catch: {
					  text: "Yes",
					  value: "catch",
					}
				  },
				})
			.then((willDelete) => {
			  if (willDelete) {
					$("#serial").focus();
				$("#receiving3_sub1").css("display", "block");
					$("#receiving3_sub2").css("display", "block");
					$("#receiving3_sub3").css("display", "none");
					$("#ponumber1").html($("#ponumber").text());
			  } else {
				var r_id=<?php echo $this->session->r_id?>;
		       
				window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
			  }
			});
		}
   	});
   
   $("#rec3_sub2").click(function () {
		
		$("#receiving3_sub1").css("display", "block");
		$("#setunitsscreen").css("display", "none");
		$("#receiving3_sub2").css("display", "none");
		$("#receiving3_sub3").css("display", "block");
		$("#ponumber2").html($("#ponumber").text());

   		
   });
   
   
   function onBackKeyDown() {
		if(modal.style.display == "block"){
			return true;
		}else{
			/* window.location.href = "Crecieving"; */
			$("#step1").removeClass("active");	
						$("#step1").removeClass("in");	
						$("#step1").addClass("disable");
	   
						$("#step2").addClass("in");	
						$("#step2").addClass("active");	
						$("#step2").removeClass("disable");
						$("#step3").removeClass("in")
						$("#step3").addClass("disable");
						
		}
    }
	
	
	function onBackKeyDown1() {
		if(modal.style.display == "block"){
			
			return true;
		}else{
			/* window.location.href = "Crecieving"; */
			$("#setunitsscreen").css("display", "none");
			$("#gobackR").css("display", "block");
			$("#rec3_sub1").css("display", "block");
			$("#receiving3_sub1").css("display", "block");
			
			$("#receiving3_sub2").css("display", "none");
		}
    }
   
   function onBackKeyDown2() {
	
		if(modal.style.display == "block"){
			
			return true;
		}else{
			/* window.location.href = "Crecieving"; */
			
			$("#gobackR").css("display", "none");
   		$("#rec3_sub1").css("display", "none");
   		$("#receiving3_sub1").css("display", "block");
   		$("#receiving3_sub2").css("display", "block");
   		$("#receiving3_sub3").css("display", "none");
		$("#ponumber1").html($("#ponumber").text());
		}
		    // $("#printableArea").empty();
			// $("#appenddata").empty();
    }
   
   
   function ran(){
   	var d = new Date();
   	var n = 'SER'+d.getTime();
   	return n;
   }
   
   function labran(){
   	var d = new Date();
   	var n = d.getTime();
   	return n;
   }
   

   var slno = [];

   $("#sub3").click(function () {

   	slno =  JSON.parse(localStorage.getItem("snoArray"));

  
		 
		setTimeout(function(){
			$("#serial").focus();
		},1000);
		 
		 $("#duplicate").html();
	   var qtt = $("#qty1").val();
		snoshowt = '';
		$('#displayt').html(snoshowt);
	   if(qtt == ''){
		   swal("", "Please fill the quantity!", "warning");

	   }else{
		   	var qty1 = parseInt($("#qty1").val());
	
	  var qtyRece = $('#qtynunitrec').html();
		var qtynunitPO = $('#qtynunit').html();
		if(qtyRece == ''){
			qtyRece = 0;
		}else{
			qtyRece = parseInt(qtyRece);
		}
		if(qtynunitPO >= (qtyRece+qty1)){
			newsub3();
		}else{
			
			swal("Recevice quantity is more than PO quantity. Do you want to recevice more?", {
									  buttons: {
										cancel: "No",
										catch: {
										  text: "Yes",
										  value: "catch",
										}
									  },
									})
			.then((willDelete) => {
			  if (willDelete) {
				newsub3();
				$("#serial").focus();
			  } else {
				var r_id=<?php echo $this->session->r_id?>;
		        
				window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
			  }
			});
		}
	   }
   
   	});
	
	
   
		


      
    
	
	
	$(".modal-footer").click(function () {
		$('#duplicate').html('');
			if($(".modal-footer #serialNext").html() == undefined){
				
				if(($('#serial').val() == '') && (serial_flag == 1)){
					swal("", "Please select Serial Number!", "warning");
				}else{
					
				var serialval = $('#serial').val();
				
/* 
	arr.push(serialval);
	console.log(arr); */
	
	

					// if(stringSerialNumber == ''){
					// 	stringSerialNumber = $('#serial').val();
					// }else{
					// 	stringSerialNumber = stringSerialNumber+','+$('#serial').val();
					// }
					stringSerialNumber = $('#serial').val();
						


					//stringSerialNumber = $('#serial').val();

					
					
					var n = slno.includes(stringSerialNumber);

					
					
					if(n==true){
						
						 swal({
											title: "",
											text: "Duplicate Serial Number!",
											type: "warning"
									}).then(function(){
									  document.getElementById("serial").focus();
									});
						// $("#serial").focus();
						return false;
					}else{
						if(snoshowt ==''){
					snoshowt = serialval;
				}else{
					snoshowt += ','+serialval;
				}
				
				$('#displayt').html(snoshowt);
						slno.push(stringSerialNumber);
					}


					//modal.style.display = "none";
					$('#myModal').modal('hide');
					var timestamp_gropby = (new Date).getTime();
					
					
					var labelss = labran();
					labelArru.push(labelss);
					var formData = {
            apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
            data: {
                product_id: $('#itemnumber').html(),
                user_id: localStorage.getItem("user_id"),
                po: $('#ponumber3').html(),
				total_quantity: totalQuantityInEach,
				lot: $('#lot').val(),
				serial_number: stringSerialNumber,
				expiry_date: $('#exp_date').val(),
				sell_date: $('#sell_date').val(),
				order_type: order_type,
				timestamp_gropby: timestamp_gropby,
				itemquantity: [
				{	
				qty : 1,
				per : '',
				per2 : '',
				per3 : '',
				label : labelss,
				unit : unitStringForJson
				}
				],
				purchase_detail_id: purchase_detail_id,
				unit_values: JSON.stringify(arrayUnits),
				
            }
        }
		
		
						var po = $('#ponumber3').html();
					

						$('#ponumber4').html(po);
						$('#itemnumber4').html($('#itemnumber').html());
						$('#reqqtynunit4').html($('#qtynunit').html());
						$('#unitid').html($('#label1').html());
				
						$("#sub3").prop('disabled', true);
						$('#sub3').html('Wait...');

						$.ajax({
							type: 'POST',
							data: JSON.stringify(formData),
							async: false,
							url: serverUrl + 'updateItemPO',
							success: function (data) {
								
								var result = JSON.parse(data);
								if (result.data.status == "false") {
									$("#qty1").css("border-color", "#f16d6d");

									$('#resMsg').html(result.data.message);
								}
								else if(result.data.status == "duplicate")
								{
									$('#duplicate').html(result.data.message);
									
								}
								else {
									
									
									$('#duplicate').html('');
									$("#sub3").prop('disabled', false);
									$('#sub3').html('Receive');

									if($('#unitEachInOneInnerCart').val() > 0){
										$("#unitEachInOneInnerCart").prop('readonly', true);
									}
									
									if($('#unitEachInOneCarton').val() > 0){
										$("#unitEachInOneCarton").prop('readonly', true);
									}
									
									if($('#unitInnerCartInOneCarton').val() > 0){
										$("#unitInnerCartInOneCarton").prop('readonly', true);
									}
									
									if($('#unitCartonInOnePallet').val() > 0){
										$("#unitCartonInOnePallet").prop('readonly', true);
									}
									

									$('#qtynunitrec').html(result.data.totalQuantity);
									/* var qty = $('#qty1').val(); */
									$('#lblprint').append("<tr><td><center>"+result.data.label+"</center></td></tr>");
									
									
									
									swal("Receive Successfull. Do you want to recevice more?", {
									  buttons: {
										cancel: "No",
										catch: {
										  text: "Yes",
										  value: "catch",
										}
									  },
									})
									.then((value) => {
										$("#serial").focus();
										snoshowt = '';
										$('#displayt').html(snoshowt);
										
									  switch (value) {
									 
										case "catch":
										
										
										var qtyRece = $('#qtynunitrec').html();
											 if(qtyRece == ''){
											qtyRece = 0;
										}else{
											qtyRece = parseInt(qtyRece);
										}
										
										// var qtt = qtyRece+totalQuantityInEach; // comment by tapan 13-05-2019
										var qtt = qtyRece;
										$('#qtynunitrec').html(qtt);
											
										$("#appenddata").append('<a href="#" class="toggle-title"><strong class="bg-Blue-dark">'+$("#qty1").val()+'*'+unitstringforReveving+'</strong><p style="margin-left:20px; width: 549px; word-break: break-all; cursor: default;">'+labelArru.join()+'..'+'</p></a><br/>');
										$("#forunittype_each").click();
										$("#sell_date").val('');
										$("#serial").val('');
										$("#qty1").val('');	
										$("#lot").val('');	
										$("#exp_date").val('');
										$('#label1').html(labran());

										
										
											stringSerialNumber = "";
											countqty = 0;
											serialDiv = 0;
											totalQuantityInEach = 0;
											
											$(".modal-footer").html('<input type="button"  id="serialNext" class="btn btn-success btn-large" value="Next"/>');
										
										  break;
									 
										default:
										
										  window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
									  }
									});


								}

								$("#sub3").prop('disabled', false);
								$('#sub3').html('Receive');
							},
							error: function (xhr) {
								console.log(xhr);
							}
						});
					
   			}
   		}
   		else{
   			if(($('#serial').val() == '') && (serial_flag == 1)){
					swal("", "Please Enter Serial Number!", "warning");
				}else{
					
					if(stringSerialNumber == ''){
						stringSerialNumber = $('#serial').val();
					}else{
						stringSerialNumber = stringSerialNumber+','+$('#serial').val();
					}

				stringSerialNumber = $('#serial').val();


				stringSerialNumber = $('#serial').val();


					
					//stringSerialNumber = $('#serial').val();

					
					
					var n = slno.includes(stringSerialNumber);

					var serialval = $('#serial').val();
					
					if(n==true){
						
						// swal("", "Duplicate Serial Number!", "warning");
						             swal({
											title: "",
											text: "Duplicate Serial Number!",
											type: "warning"
									}).then(function(){
									  document.getElementById("serial").focus();
									});
						// $("#serial").focus();
						return false;
					}else{
						if(snoshowt ==''){
					snoshowt = serialval;
				}else{
					snoshowt += ','+serialval;
				}
				
				$('#displayt').html(snoshowt);
						slno.push(stringSerialNumber);
					}



				
				// var serialval = $('#serial').val();
				// if(snoshowt ==''){
				// 	snoshowt = serialval;
				// }else{
				// 	snoshowt += ','+serialval;
				// }
				// // alert(123123);
				
				// $('#displayt').html(snoshowt);
				
				var timestamp_gropby = (new Date).getTime();

					
					var formData = {
            apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
            data: {
                product_id: $('#itemnumber').html(),
                user_id: localStorage.getItem("user_id"),
                po: $('#ponumber3').html(),
				total_quantity: totalQuantityInEach,
				 timestamp_gropby: timestamp_gropby,
				lot: $('#lot').val(),
				serial_number: stringSerialNumber,
				expiry_date: $('#exp_date').val(),
				sell_date: $('#sell_date').val(),
				order_type: order_type,
				itemquantity: [
				{	
				qty : 1,
				per : '',
				per2 : '',
				per3 : '',
				label : labran(),
				unit : unitStringForJson
				}
				],
				purchase_detail_id: purchase_detail_id,
				unit_values: JSON.stringify(arrayUnits),
			
            }
        }
		
		


		
						var po = $('#ponumber3').html();
					

						$('#ponumber4').html(po);
						$('#itemnumber4').html($('#itemnumber').html());
						$('#reqqtynunit4').html($('#qtynunit').html());
						$('#unitid').html($('#label1').html());
				
						$("#sub3").prop('disabled', true);
						$('#sub3').html('Wait...');

						$.ajax({
							type: 'POST',
							data: JSON.stringify(formData),
							async: false,
							url: serverUrl + 'updateItemPO',
							success: function (data) {
								
								var result = JSON.parse(data);
								if (result.data.status == "false") {
									$("#qty1").css("border-color", "#f16d6d");

									$('#resMsg').html(result.data.message);
								}
								else if(result.data.status == "duplicate")
								{
									$('#duplicate').html(result.data.message)
									
								}
								else {
									/* alert(23); */
									$('#duplicate').html('');
									$('#lblprint').append("<tr><td><center>"+result.data.label+"</center></td></tr>");
									
									$("#sub3").prop('disabled', false);
									$('#sub3').html('Receive');

									if($('#unitEachInOneInnerCart').val() > 0){
										$("#unitEachInOneInnerCart").prop('readonly', true);
									}
									
									if($('#unitEachInOneCarton').val() > 0){
										$("#unitEachInOneCarton").prop('readonly', true);
									}
									
									if($('#unitInnerCartInOneCarton').val() > 0){
										$("#unitInnerCartInOneCarton").prop('readonly', true);
									}
									
									if($('#unitCartonInOnePallet').val() > 0){
										$("#unitCartonInOnePallet").prop('readonly', true);
									}
									

									$('#qtynunitrec').html(result.data.totalQuantity);
									
									
									
									swal({
											title: "",
											text: "Received 1 Qty!",
											type: "success"
									}).then(function(){
									  document.getElementById("serial").focus();
									});


									serialDiv++;
										$('#serial').val('');
										$("#dynamicHeader").html("("+serialDiv+"/"+countqty+")");
										
										if(serialDiv == countqty){
										$(".modal-footer").html('<input type="button"  id="serialSubmit" class="btn btn-success btn-large" value="Submit"/>');
										}

								}

							},
							error: function (xhr) {
								console.log(xhr);
							}
						});
						}
   		}
   
   	
   	
      });
   
   
   
   
   
   
      $("#main").click(function () {
   
         var r_id=<?php echo $this->session->r_id?>;
		
		 window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
   
      });
   
   $("#main1").click(function () {
   
         var r_id=<?php echo $this->session->r_id?>;
		   
		   window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
   
      });
   
   
   $("#backtoitems").click(function () {
   	
   	$('#resMsg').html('');
   	
   	$('#resMsg').css("color", "red");
   
          $("#receiving1").css("display", "none");
   	$("#receiving2").css("display", "block");
   	$("#receiving3").css("display", "none");
   	$("#receiving4").css("display", "none");
   	
   	
   	var po = $('#ponumber4').html();
   
   
          $('#ponumber').html(po);
   
   
      });
   
   
   
   
   $("#back4").click(function () {
   	
   	$('#resMsg').html('');
   	
   	$("#receiving1").css("display", "none");
   	$("#receiving2").css("display", "none");
   	$("#receiving3").css("display", "block");
   	$("#receiving4").css("display", "none");
   
   
          $('#ponumber3').html($('#ponumber4').html());
          $('#itemnumber').html($('#itemnumber4').html());
          $('#qtynunit').html($('#reqqtynunit4').html());
   
      });
   
   $("#back3").click(function () {
   	
   	$('#resMsg').html('');
   
          $("#receiving1").css("display", "none");
   	$("#receiving2").css("display", "block");
   	$("#receiving3").css("display", "none");
   	$("#receiving4").css("display", "none");
   	
   	
   	var po = $('#ponumber3').html();
   
   
          $('#ponumber').html(po);
   
   
      });
   
   $("#back2").click(function () {
   	
   	$('#resMsg').html('');
   
          $("#receiving1").css("display", "block");
   	$("#receiving2").css("display", "none");
   	$("#receiving3").css("display", "none");
   	$("#receiving4").css("display", "none");
   	
   	
   	var po = $('#ponumber').html();
   
   
          $('#numb').html(po);
   
   
      });
   
   
   
   
   $("input[name='unittype']").change(function () {
   
   		if( $("input[name='unittype']:checked"). val() == "EACH"){
   			$(".otherthaneach").css("display", "none");
   		}else{
   			$(".otherthaneach").css("display", "block");
   		}
   		createPer1($("input[name='unittype']:checked"). val());
   
   
   });
   
   
   function createPer1(unittype){
   
   
   	var perOptions = '<option>Select</option>';
   
   	if(unittype == "EACH"){
   
   		perOptions = '<option>None</option>';
   
   		$('#per2').html('<option>None</option>');
   		$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input class="form-control" type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');
   
   	}
   	else if(unittype == "INNER_CART"){
   		
   
   	for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "INNER_CART"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   		}
   
   		$('#per2').html('<option>None</option>');
   		$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input class="form-control" type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');
    
   	}
   
   	else if(unittype == "CARTON"){
   		
   
   	for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "CARTON"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   		}
   
   		$('#per2').html('<option>None</option>');
   
   		$('#onPalletChange').html('<div class="one-half-responsive"><div class="store-input"><h6>Rec QTY</h6><input class="form-control" type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');
   
   	}
   
   	else if(unittype == "PALLET"){
   		
   
   	for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "PALLET"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   		}
   
   		$('#per2').html('<option>None</option>');
   
   		$('#onPalletChange').html('<div class="one-half"><div class="store-input"><h6>In-Inner-Per</h6><select id="per3" class="form-control dont-select-me"><option>None</option></select></div></div><div class="one-half last-column"><div class="store-input"><h6>Rec QTY</h6><input class="form-control" type="number" placeholder="QTY" name="qty1" id="qty1"></div></div>');
   
   	}
   
   
   	$('#per1').html(perOptions);
   	
   
   }
   
   
   
   
   $("#per1").change(function () {
   
   
   		createPer2($("#per1"). val());
   
   
   });
   
   
   function createPer2(unitstring){
   
   
   	
   	var arr = unitstring.split('#');
   	if(arr[2] == 'INNER_CART'){
   
   	var perOptions = '<option>Select</option>';
   
   	for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "INNER_CART" && arrayUnits[i].perTo == "EACH"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   		}
   
   		$('#per2').html(perOptions);
   
   
   	}else if(arr[2] == 'CARTON'){
   
   	var perOptions = '<option>Select</option>';
   
   	for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "CARTON" && arrayUnits[i].perTo == "EACH"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   
   			if(arrayUnits[i].perFrom == "CARTON" && arrayUnits[i].perTo == "INNER_CART"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   		}
   
   		$('#per2').html(perOptions);
   
   
   	}
   
   
   	if(arr[2] == 'EACH'){
   
   	var perOptions = '<option>None</option>';
   
   		$('#per2').html(perOptions);
   
   
   	}
   }
   
   
   $("#per2").change(function () {
   
   
   	var unitstring = $("#per2"). val();
   
   	var arr = unitstring.split('#');
   
   	if(arr[2] == "EACH"){
   
   		$('#per3').html('<option>None</option>');
   
   	}
   	else if(arr[2] == 'INNER_CART'){
   
   		var perOptions = '<option>Select</option>';
   
   			for(var i=0; i<arrayUnits.length; i++){
   
   
   			if(arrayUnits[i].perFrom == "INNER_CART" && arrayUnits[i].perTo == "EACH"){
   			
   			perOptions = perOptions+'<option value="'+arrayUnits[i].perFrom+'#'+arrayUnits[i].perToQty+'#'+arrayUnits[i].perTo+'">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';
   
   
   			}
   
   		}
   
   		$('#per3').html(perOptions);
   	}
   
   
   
   });
   
   	/*$('#per1').on('change', function() {
   	  if( this.value == 'EACH' ){
   				
   	  }
   	  
   	  if( this.value == 'INNER_CART' ){
   
   	  	var filldetailsselectbox = '';
   
   			for(var i=0; i<arrayUnits.length; i++){
   
   			if(arrayUnits[i].perFrom == 'INNER_CART'){
   
   				filldetailsselectbox = filldetailsselectbox+'<option value="EACH">'+arrayUnits[i].perFrom+'('+arrayUnits[i].perToQty+' '+arrayUnits[i].perTo+')</option>';	
   
   			}	
   
   				
   		}
   
   
   		$("#per2").html(filldetailsselectbox);
   	  }
   	  
   	  if( this.value == 'CARTON' ){
   			$(".tbic").css("display", "block");
   			$(".tbc").css("display", "block");
   			$(".tbp").css("display", "none");
   	  }
   	  
   	  if( this.value == 'PALLET' ){
   			$(".tbic").css("display", "block");
   			$(".tbc").css("display", "block");
   			$(".tbp").css("display", "block");
   	  }
   	  
   	});
   	*/
   
   $("#resetdefinedunitsdata").click(function () {
   	$("#receiving3").css("display", "none");
   	$("#setunitsscreen").css("display", "block");
   });
   
	$("#setunits").click(function () {

		var jsonDataPush = {};
		var jsonDataPush1 = {};

		if($("#perfrom").val() == "PALLET"){

			if(($("#inperfrom").val() != "") && (($("#inperfromqty").val() != "") && ($("#inperfromqty").val() > 0))){

				jsonDataPush.PALLET = $("#perfromqty").val();
				jsonDataPush1.PALLET = $("#perfromqty").val();

				if($("#inperfrom").val() == "CARTON"){

					jsonDataPush.CARTON = $("#inperfromqty").val();
					jsonDataPush1.CARTON = $("#inperfromqty").val();

					if(($("#ininnerperfrom").val() != "") && (($("#ininnerperfromqty").val() != "") && ($("#ininnerperfromqty").val() > 0))){

							if($("#ininnerperfrom").val() == "INNER_CART"){

								jsonDataPush.INNER_CART = $("#ininnerperfromqty").val();
								jsonDataPush1.INNER_CART = $("#ininnerperfromqty").val();

								if(($("#lastininnerperfrom").val() != "") && (($("#lastininnerperfromqty").val() != "") && ($("#lastininnerperfromqty").val() > 0 ))){

									if($("#lastininnerperfrom").val() == "EACH"){

										jsonDataPush.EACH = $("#lastininnerperfromqty").val();
										jsonDataPush1.EACH = $("#lastininnerperfromqty").val();

									}

								}
								else{

									swal("", "Please fill the required fields.", "warning");
	
		 							return false;

								}

							}
							else if($("#ininnerperfrom").val() == "EACH"){

								jsonDataPush.EACH = $("#ininnerperfromqty").val();
								jsonDataPush1.EACH = $("#ininnerperfromqty").val();

							}


					}
					else{

						swal("", "Please fill the required fields.", "warning");
	
		 				return false;
					}
						
				}
				else if($("#inperfrom").val() == "INNER_CART"){

					jsonDataPush.INNER_CART = $("#inperfromqty").val();
					jsonDataPush1.INNER_CART = $("#inperfromqty").val();

					if(($("#ininnerperfrom").val() != "") && (($("#ininnerperfromqty").val() != "") && ($("#ininnerperfromqty").val() > 0))){

							if($("#ininnerperfrom").val() == "EACH"){

								jsonDataPush.EACH = $("#ininnerperfromqty").val();
								jsonDataPush1.EACH = $("#ininnerperfromqty").val();

									
							}

					}
						
				}
				else if($("#inperfrom").val() == "EACH"){

					jsonDataPush.EACH = $("#inperfromqty").val();
					jsonDataPush1.EACH = $("#inperfromqty").val();

						
				}
				else{

					swal("", "Please fill the required fields.", "warning");
	
		 		return false;
				}



			}
			else{
				swal("", "Please fill the required fields.", "warning");
	
		 		return false;
			}

		}	







		else if($("#perfrom").val() == "CARTON"){

			if(($("#inperfrom").val() != "") && (($("#inperfromqty").val() != "") && ($("#inperfromqty").val() > 0 ))){

				jsonDataPush.CARTON = $("#perfromqty").val();
				jsonDataPush1.CARTON = $("#perfromqty").val();

				if($("#inperfrom").val() == "INNER_CART"){

					jsonDataPush.INNER_CART = $("#inperfromqty").val();
					jsonDataPush1.INNER_CART = $("#inperfromqty").val();

					if(($("#ininnerperfrom").val() != "") && (($("#ininnerperfromqty").val() != "") && ($("#ininnerperfromqty").val() > 0))){

							if($("#ininnerperfrom").val() == "EACH"){

								jsonDataPush.EACH = $("#ininnerperfromqty").val();
								jsonDataPush1.EACH = $("#ininnerperfromqty").val();

								
								}
								else{

									swal("", "Please fill the required fields.", "warning");
	
		 							return false;

								}

							
							


					}
					else{

						swal("", "Please fill the required fields.", "warning");
	
		 				return false;
					}
						
				}
				
				else if($("#inperfrom").val() == "EACH"){

					jsonDataPush.EACH = $("#inperfromqty").val();
					jsonDataPush1.EACH = $("#inperfromqty").val();

						
				}
				else{

					swal("", "Please fill the required fields.", "warning");
	
		 		return false;
				}



			}
			else{
				swal("", "Please fill the required fields.", "warning");
	
		 		return false;
			}

		}





		else if($("#perfrom").val() == "INNER_CART"){

			if(($("#inperfrom").val() != "") && (($("#inperfromqty").val() != "") && ($("#inperfromqty").val() > 0))){

				jsonDataPush.INNER_CART = $("#perfromqty").val();
				jsonDataPush1.INNER_CART = $("#perfromqty").val();

				if($("#inperfrom").val() == "EACH"){

					jsonDataPush.EACH = $("#inperfromqty").val();
					jsonDataPush1.EACH = $("#inperfromqty").val();

						
				}
				
				
				else{

					swal("", "Please fill the required fields.", "warning");
	
		 		return false;
				}



			}
			else{
				swal("", "Please fill the required fields.", "warning");
	
		 		return false;
			}

		}




		else if($("#perfrom").val() == "EACH"){

			jsonDataPush.EACH = $("#perfromqty").val();
			jsonDataPush1.EACH = $("#perfromqty").val();

		}

		else{

			swal("", "Please fill the required fields.", "warning");
	
		 		return false;

		}



		for(var i=0; i<arrayUnits1.length; i++){
	
				if(JSON.stringify(arrayUnits1[i]) == JSON.stringify(jsonDataPush1)){
					
					swal("", "This unit configuration is already defined.", "warning");
	
					return false;
				}
			}

	
		arrayUnits1.push(jsonDataPush1);


		jsonDataPush.sell_price = 0;
		jsonDataPush.vendor_price = 0;

		arrayUnits.push(jsonDataPush);
	


		var showalldefinedunits = "";
		for(var i=0; i<arrayUnits.length; i++){

						/*if(i % 2 == 0){
							var t = '<h6 style="background: #f1eeee;">&nbsp;&nbsp;<input type="radio" checked name="unittypeselected" value="'+i+'">&nbsp;&nbsp;';
						}else{
							var t = '<h6>&nbsp;&nbsp;<input  type="radio" checked name="unittypeselected" value="'+i+'">&nbsp;&nbsp;';
						}


						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
							
							
						}

						if("CARTON" in arrayUnits[i]){

							t = t+arrayUnits[i].CARTON+" CTN -> ";
						
							
						}

						if("INNER_CART" in arrayUnits[i]){

							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";

						
							
						}

						if("EACH" in arrayUnits[i]){

							t = t+arrayUnits[i].EACH+" EA";

							
							
						}
						

						showalldefinedunits = showalldefinedunits+t+"</h6>";*/
						
						if(i % 2 == 0){
							var t = '<label style="width:100%;"><input type="radio" name="unittypeselected" checked value="'+i+'">';
						}else{
							var t = '<label style="width:100%;"><input  type="radio" name="unittypeselected" checked value="'+i+'">';
						}

						if("PALLET" in arrayUnits[i]){
							t = t+arrayUnits[i].PALLET+" PLT -> ";
							// if(t==""){
							// 	t = arrayUnits[i].PALLET+" PLT -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].PALLET+" PLT -> ";
							// }
							
							
						}

						if("CARTON" in arrayUnits[i]){

							t = t+arrayUnits[i].CARTON+" CTN -> ";
						
							// if(t==""){
							// 	t = arrayUnits[i].CARTON+" CTN -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].CARTON+" CTN -> ";
							// }
							
						}

						if("INNER_CART" in arrayUnits[i]){

							t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";

							// if(t==""){
							// 	t = arrayUnits[i].INNER_CART+" IN-CTN -> ";
							// }
							// else{
							// 	t = t+arrayUnits[i].INNER_CART+" IN-CTN -> ";
							// }
							
						}

						if("EACH" in arrayUnits[i]){

							t = t+arrayUnits[i].EACH+" EA";

							// if(t==""){
							// 	t = arrayUnits[i].EACH+" EA";
							// }
							// else{
							// 	t = t+arrayUnits[i].EACH+" EA";
							// }
							
						}
						

						showalldefinedunits = showalldefinedunits+t+"</label>";
					}


					$("#showalldefinedunits").html(showalldefinedunits);



					$("#receiving3").css("display", "block");
					$("#setunitsscreen").css("display", "none");




		// if($("#pertoqty").val() > 0){
		// 	var jsonDataPush = {};
		// 	var pertoqty = $("#pertoqty").val();
		// 	var perto = $("#perto").val();
		// 	var perfromqty = $("#perfromqty").val();
		// 	var perfrom = $("#perfrom").val();

		// 	jsonDataPush.perFrom = $("#perfrom").val();
		// 	jsonDataPush.perFromQty = $("#perfromqty").val();
		// 	jsonDataPush.perTo = $("#perto").val();
		// 	jsonDataPush.perToQty = $("#pertoqty").val();
			

		// 	for(var i=0; i<arrayUnits.length; i++){
		// 		if(JSON.stringify(arrayUnits[i]) === JSON.stringify(jsonDataPush)){
					
		// 			swal("", "This unit configuration is already defined.", "warning");
	
		// 			return false;
		// 		}
		// 	}
			
		// 	arrayUnits.push(jsonDataPush);


		// 	var showalldefinedunits = '';


		// 	for(var i=0; i<arrayUnits.length; i++){
		// 		showalldefinedunits = showalldefinedunits+"<h5><strong><span style='color:Blue'>1</span> "+arrayUnits[i].perFrom+" :</strong><em class='color-Blue-dark' id='eachpinnercart'><span style='color:Blue'>"+arrayUnits[i].perToQty+"</span> <span style='color:Blue'>"+arrayUnits[i].perTo+"</span></em></h5>";
	
		// 	}

		// 	$("#showalldefinedunits").html(showalldefinedunits);

			
		// 	$("#receiving3").css("display", "block");
		// 	$("#setunitsscreen").css("display", "none");
			
		// 	$("#forunittype_each").click();
			
			
	
		// }
		// else{
			
			
		// 	swal("", "Please enter Quantity.", "warning");
		// 	return false;
			
			
		// }
		
		
	});
   
   
   
   
   $("#adddefinedunitsdata").click(function () {
   
   	$("#receiving3").css("display", "none");
   	$("#setunitsscreen").css("display", "block");
	$("#ponumber1").html($("#ponumber").text());
   	
   });
   
   $("#calcelunits").click(function () {
   
   	$("#receiving3").css("display", "block");
   	$("#setunitsscreen").css("display", "none");
   	
   });
   
   
   
	$("#perfrom").change(function () {



		//appendUnitsDivs

		var inneroptions = '';
		if(this.value == "EACH"){
			inneroptions = '<option value="">None</option>';
		}
		else if(this.value == "INNER_CART"){
			inneroptions = '<option value="EACH">EACH</option>';
		}else if(this.value == "CARTON"){
			inneroptions = '<option value="EACH">EACH</option><option value="INNER_CART">INNER CART</option>';	
		}else if(this.value == "PALLET"){
			inneroptions = '<option value="EACH">EACH</option><option value="INNER_CART">INNER CART</option><option value="CARTON">CARTON</option>';	
		}
		
		$("#inperfrom").html(inneroptions);
	});
   
   
	$("#inperfrom").change(function () {



		//appendUnitsDivs

		var inneroptions = '';
		if(this.value == "INNER_CART"){
			inneroptions = '<option value="EACH">EACH</option>';
		}else if(this.value == "CARTON"){
			inneroptions = '<option value="EACH">EACH</option><option value="INNER_CART">INNER CART</option>';	
		}
		
		$("#ininnerperfrom").html(inneroptions);
	});



	$("#ininnerperfrom").change(function () {



		//appendUnitsDivs

		var inneroptions = '';
		if(this.value == "INNER_CART"){
			inneroptions = '<option value="EACH">EACH</option>';
		}
		
		$("#lastininnerperfrom").html(inneroptions);
	});
	$(".ion-qr-scanner").click(function () {

			cordova.plugins.barcodeScanner.scan(
				function (result) {
					
					$('#serial').val(result.text);
				},
				function (error) {
				swal("", "Scanning cancelled.", "warning");
				return false;				},
                {
                  preferFrontCamera : false, // iOS and Android
                  showFlipCameraButton : true, // iOS and Android
                  showTorchButton : true, // iOS and Android
                  torchOn: false, // Android, launch with the torch switched on (if available)
                  saveHistory: false, // Android, save scan history (default false)
                  prompt : "Place a barcode inside the scan area", // Android
                  resultDisplayDuration: 500, // Android, display scanned text for X ms. 0 suppresses it entirely, default 150
                  disableAnimations : true, // iOS
                  disableSuccessBeep: false // iOS and Android
              }
			);
		
	});
   
   
   $("#rec3_sub1").click(function () {
   
   		$("#gobackR").css("display", "none");
   		$("#rec3_sub1").css("display", "none");
   		$("#receiving3_sub1").css("display", "block");
   		$("#receiving3_sub2").css("display", "block");
   		$("#receiving3_sub3").css("display", "none");
		$("#ponumber1").html($("#ponumber").text());
   	
   });
   
	$("#rec3_sub2").click(function () {

		unitidIndex = $("input[name='unittypeselected']:checked"). val();

		unitStringForJson = "";
						var t = '<p>';
						
						var rec_t = '';

						if("PALLET" in arrayUnits[unitidIndex]){

							rec_t = "PLT";
						}
						else if("CARTON" in arrayUnits[unitidIndex]){

							rec_t = "CTN";
							
						}

						else if("INNER_CART" in arrayUnits[unitidIndex]){

							rec_t = "INCTN";
							
						}

						else if("EACH" in arrayUnits[unitidIndex]){

							rec_t = "EA";
							
						}

						if("PALLET" in arrayUnits[unitidIndex]){
							t = t+arrayUnits[unitidIndex].PALLET+" PLT -> ";
							unitStringForJson = arrayUnits[unitidIndex].PALLET+"PALLET-";

							
							
						}

						if("CARTON" in arrayUnits[unitidIndex]){

							t = t+arrayUnits[unitidIndex].CARTON+" CTN -> ";
							
							if(unitStringForJson == ""){
								unitStringForJson = arrayUnits[unitidIndex].CARTON+"CARTON-";
							}else{
								unitStringForJson = unitStringForJson+arrayUnits[unitidIndex].CARTON+"CARTON-";
							}
						
							
						}

						if("INNER_CART" in arrayUnits[unitidIndex]){

							t = t+arrayUnits[unitidIndex].INNER_CART+" IN-CTN -> ";
							
							if(unitStringForJson == ""){
								unitStringForJson = arrayUnits[unitidIndex].INNER_CART+"INNER_CART-";
							}else{
								unitStringForJson = unitStringForJson+arrayUnits[unitidIndex].INNER_CART+"INNER_CART-";
							}

						
							
						}

						if("EACH" in arrayUnits[unitidIndex]){

							t = t+arrayUnits[unitidIndex].EACH+" EA";
							
							if(unitStringForJson == ""){
								unitStringForJson = arrayUnits[unitidIndex].EACH+"EACH";
							}else{
								unitStringForJson = unitStringForJson+arrayUnits[unitidIndex].EACH+"EACH";
							}


							
							
						}


			unitStringForJson = unitStringForJson+"###"+arrayUnits[unitidIndex].sell_price+"###"+arrayUnits[unitidIndex].vendor_price;			

			showalldefinedunits = t+"</p>";
			
			$("#unittypeindexwithdetails").html(showalldefinedunits);
			unitstringforReveving = rec_t;			
	
			$("#receiving3_sub1").css("display", "block");
			$("#receiving3_sub2").css("display", "none");
			$("#receiving3_sub3").css("display", "block");
			$("#ponumber2").html($("#ponumber").text());
	});
	
	$("#calcelRecieving").click(function(){
		
		// window.location.href = "/Crecieving/manage_recieving";
			var r_id=<?php echo $this->session->r_id?>;
		  
		   window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
	})
	
	function showdesc(val){
			
		    $("#appenddata").html('');
			$("#lblprint").html('');
	
			
	
		console.log(val);
		var end = val.value;
		
	
		
		
		for(var i =0; i< arrDes.length; i++){
			if(arrDes[i]['pid'] == end){
				$('#productdes').html(arrDes[i]['product_details']);
				
			}
				 
		}
			
			

		
	}
  
  
  function printDiv(divName) {
		// var content = document.getElementById(divName).innerHTML;
		// console.log(content);
		// var mywindow = window.open('', '', '');
		// mywindow.document.write('<html><title>Print</title><style type="text/css">');
		// mywindow.document.write('body,td,th{font-family:Arial, Helvetica, sans-serif;font-size:20px;color:#000000;border:1px solid #000;} table{width:100%;border-collapse: collapse;}');
		// mywindow.document.write('</style></head><body style="padding:10px;">')
		// mywindow.document.write(content);
		// mywindow.document.write('</body></html>');
		// mywindow.document.close();
		// setTimeout(function(){
		// 	 mywindow.print();
		// 	return true;
		// }, 3500);
   
		var printContents = document.getElementById(divName).innerHTML;
	    var originalContents = document.body.innerHTML;
		printContents = '<html><head><style>img {-webkit-print-color-adjust: exact;}</style></head><body>'+printContents+'</body></html>';
		
	    document.body.innerHTML = printContents;
		// document.body.style.marginTop="-45px";
	    window.print();
	    document.body.innerHTML = originalContents;


	}
  
  
  async function newsub3(){
	  	$("#qty1").css("border-color", "#ccc");
   	$("#lot").css("border-color", "#ccc");
   	$("#exp_date").css("border-color", "#ccc");
   	$("#sell_date").css("border-color", "#ccc");
   	$("#eic").css("border-color", "#ccc");
   	$("#icc").css("border-color", "#ccc");
   	$("#cp").css("border-color", "#ccc");
   	
   	
   
   
   	var qty1 = $("#qty1").val();	
   	var lot = $("#lot").val();	
   	var exp_date = $("#exp_date").val();	
   	var sell_date = $("#sell_date").val();	
   
   	
   	if(qty1 < 1)
   	{
   		$("#qty1").focus();
   		$("#qty1").css("border-color", "#f16d6d");
   		swal("", "Please fill the quantity!", "warning");
   		return false;
   	}
   	else if(lot == "" && lot_flag !=0 ){
   		$("#lot").focus();
   		$("#lot").css("border-color", "#f16d6d");
   		swal("", "Please fill the Lot!", "warning");
   		return false;
   		
   	}
   	else if(exp_date == "" && expiry_flag !=0){
   		$("#exp_date").focus();
   		$("#exp_date").css("border-color", "#f16d6d");
   		swal("", "Please fill the Expiry date!", "warning");
   		return false;
   		
   	}
		else if((exp_date != "") && (sell_date != "") && (exp_date < sell_date)){
			
			

				
				$("#exp_date").focus();
				$("#exp_date").css("border-color", "#f16d6d");
				swal("", "Expiry date cannot be less than Sell date!", "warning");
				return false;
			
			
		}
		else{
			tt = 1;
			if("PALLET" in arrayUnits[unitidIndex]){
							
						tt = tt*arrayUnits[unitidIndex].PALLET;	
							
						}

						if("CARTON" in arrayUnits[unitidIndex]){

					
							tt = tt*arrayUnits[unitidIndex].CARTON;	
						
							
						}

						if("INNER_CART" in arrayUnits[unitidIndex]){

							
							tt = tt*arrayUnits[unitidIndex].INNER_CART;
						
							
						}

						if("EACH" in arrayUnits[unitidIndex]){

							tt = tt*arrayUnits[unitidIndex].EACH;
							
							
						}

						totalQuantityInEach = tt;



						
						if(totalQuantityInEach>0){
							labelArru = [];
							console.log("serial-flag"+serial_flag);
							if(serial_flag=="1"){
							//modal.style.display = "block";
							
							$('#myModal').modal('toggle');
							$('#myModal').modal('show');
								   // countqty = totalQuantityInEach * $("#qty1").val();
								    countqty = $("#qty1").val();
									if(countqty > 0){
										serialDiv = 1;
										if(countqty == 1){
											
											$("#dynamicHeader").html("("+serialDiv+"/"+countqty+")");
											//$(".modal-footer").html('<a href="#" id="serialSubmit" class="button button-Blue button-full">Submit</a>');
											$(".modal-footer").html('<input type="button"  id="serialSubmit" class="btn btn-success btn-large" value="Submit"/>');
										}
										else{
											$("#dynamicHeader").html("("+serialDiv+"/"+countqty+")");
										}
										

										
									}
							}else{
								await receivePOSaperately(totalQuantityInEach);
							}
						}else{


							swal("", "Units must be defined correctly!", "warning");
							return false;
						}

		}
  }
			
         












async function receivePOSaperately(totalQuantityInEach){
	
			var count = 0;
			var totalquantitys = 0;
			var labelArr = [];
			var qtyyy = $("#qty1").val();
			var qtyRece = parseInt($('#qtynunitrec').html());
			var x = 0;
			var timestamp_gropby = (new Date).getTime();
			
			
			/* alert(qtyyy); */
			
			var formData = {
				
				apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
				data: {
					product_id: $('#itemnumber').html(),
					user_id: localStorage.getItem("user_id"),
					po: $('#ponumber3').html(),
					total_quantity: totalQuantityInEach,
					timestamp_gropby: timestamp_gropby,
					lot: $('#lot').val(),
					serial_number: "",
					expiry_date: $('#exp_date').val(),
					sell_date: $('#sell_date').val(),
					order_type: order_type,
					unit: unitStringForJson,
					qtyyy: qtyyy,
					itemquantity: '',
					cartoon_quantity: '0',
					pallet_quantity:'0',
					innercart_quantity:'',
					purchase_detail_id: purchase_detail_id,
					unit_values: JSON.stringify(arrayUnits),
					
				}
			}
			
			
			
			 $.ajax({
				type: 'POST',
				async: false,
				data: JSON.stringify(formData),
				url: serverUrl + 'updateItemPO_loop',
				success: function(data) {
					
					console.log(formData)
					console.log(data);
					var result = JSON.parse(data);
					
					if (result.data.status == "false") {
						$("#qty1").css("border-color", "#f16d6d");

						$('#resMsg').html(result.data.message);
					} else {
						totalquantitys = result.data.totalQuantity;
						console.log(result.data.label);
						console.log(result.data.printLabel);
						var printLabel =result.data.printLabel;
						var str = '';
						for(var i = 0; i < printLabel.length; i++){
							if(str==''){
								str = printLabel[i]['label'];
							}else{
								str += ','+printLabel[i]['label'];
							}
							$('#lblprint').append("<tr><td><center>"+printLabel[i]['label']+"</center></td></tr>");
							
							if((printLabel.length) == (i+1)){
								$("#appenddata").append('<a href="#" class="toggle-title"><strong class="bg-Blue-dark">'+$("#qty1").val()+'*'+unitstringforReveving+'</strong><p style="margin-left:20px; width: 549px; word-break: break-all; cursor: default;">'+str+'..'+'</p></a><br/>');
							}
							
							
						}
						$('#qtynunitrec').html(totalquantitys);
						
						
					}
					
					console.log(formData);


			var po = $('#ponumber3').html();


			$('#ponumber4').html(po);
			$('#itemnumber4').html($('#itemnumber').html());
			$('#reqqtynunit4').html($('#qtynunit').html());
			$('#unitid').html($('#label1').html());

			$("#sub3").prop('disabled', true);
			$('#sub3').html('Wait...');
			
			
			
			$("#sub3").prop('disabled', false);
			$('#sub3').html('Receive');

			if ($('#unitEachInOneInnerCart').val() > 0) {
				$("#unitEachInOneInnerCart").prop('readonly', true);
			}

			if ($('#unitEachInOneCarton').val() > 0) {
				$("#unitEachInOneCarton").prop('readonly', true);
			}

			if ($('#unitInnerCartInOneCarton').val() > 0) {
				$("#unitInnerCartInOneCarton").prop('readonly', true);
			}

			if ($('#unitCartonInOnePallet').val() > 0) {
				$("#unitCartonInOnePallet").prop('readonly', true);
			}

			
			
			$('#qtynunitrec').html(totalquantitys);


			swal("", "Received successfully", "success");
			
			swal("Receive Successfull. Do you want to recevice more?", {
									  buttons: {
										cancel: "No",
										catch: {
										  text: "Yes",
										  value: "catch",
										}
									  },
									})
									.then((value) => {
										snoshowt = '';
										$('#displayt').html(snoshowt);
										
									  switch (value) {
									 
										case "catch":
										
										// $("#appenddata").append('<a href="#" class="toggle-title"><strong class="bg-Blue-dark">'+$("#qty1").val()+'*'+unitstringforReveving+'</strong><p class="myContainer" style="margin-left:20px; width:549px; word-break: break-all;">'+labelArr.join()+'</p></a><br/>');
										

										$("#forunittype_each").click();
										$("#sell_date").val('');
										$("#serial").val('');
										$("#qty1").val('');	
										$("#lot").val('');	
										$("#exp_date").val('');
										$('#label1').html(labran());

										
										
											stringSerialNumber = "";
											countqty = 0;
											serialDiv = 0;
											totalQuantityInEach = 0;
											
											$(".modal-footer").html('<input type="button"  id="serialNext" class="btn btn-success btn-large" value="Next"/>');
										
										  break;
									 
										default:
										var r_id=<?php echo $this->session->r_id?>;
										console.log(r_id);
										 
										  window.location.href ='<?php echo base_url('Crecieving/manage_recieving/')?>'+r_id;
									  }
									});
			
			
			

				},
				error: function(xhr) {
					console.log(xhr);
				}
			});
			
			
			
			
			
			/* for(var i =0;i< qtyyy;i++){
				var label = labran();
				label = label + i;
				labelArr.push(label);
				var formData = {
				apikey: "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R",
				data: {
					product_id: $('#itemnumber').html(),
					user_id: localStorage.getItem("user_id"),
					po: $('#ponumber3').html(),
					total_quantity: totalQuantityInEach,
					timestamp_gropby: timestamp_gropby,
					lot: $('#lot').val(),
					serial_number: "",
					expiry_date: $('#exp_date').val(),
					sell_date: $('#sell_date').val(),
					order_type: order_type,
					itemquantity: [{
						qty: 1,
						per: '',
						per2: '',
						per3: '',
						label: label,
						unit: unitStringForJson
					}],
					purchase_detail_id: purchase_detail_id,
					unit_values: JSON.stringify(arrayUnits),
				
				}
			}
			} */


			

			/* await ajaxfuncitonToadd(formData,count); */
			
			
		}
		
		
		/* await showdataList(totalquantitys,labelArr); */
			
			
			
			



			
	
	
	/* async function ajaxfuncitonToadd(formData,count){
	
	setTimeout(function(){
		 $.ajax({
				type: 'POST',
				async: false,
				data: JSON.stringify(formData),
				url: serverUrl + 'updateItemPO',
				success: function(data) {
					console.log(data);
					var result = JSON.parse(data);
					if (result.data.status == "false") {
						$("#qty1").css("border-color", "#f16d6d");

						$('#resMsg').html(result.data.message);
					} else {
						totalquantitys = result.data.totalQuantity;
						console.log(result.data.label);
						$('#lblprint').append("<tr><td><center>"+result.data.label+"</center></td></tr>");
						
						$('#qtynunitrec').html(totalquantitys);
						
						count++;
					}

				},
				error: function(xhr) {
					console.log(xhr);
				}
			});
	},500)
	
			
			
			
			
			
									
		} */	
		
		
		
		
	/* 	
	async function showdataList(totalquantitys,labelArr){
		
			
			
			
			
	} */
	
</script>