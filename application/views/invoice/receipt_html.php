<?php
    $CI =& get_instance();
    $CI->load->model('Web_settings');
    $Web_settings = $CI->Web_settings->retrieve_setting_editdata();
?>

<!-- Printable area start -->
<link href="<?php echo base_url()?>my-assets/css/payslip.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
      document.body.style='<link href="<?php echo base_url()?>my-assets/css/payslip.css" rel="stylesheet" type="text/css">';
	// document.body.style.marginTop="-45px";
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<!-- Printable area end -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('invoice_details') ?></h1>
            <small><?php echo display('invoice_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('invoice') ?></a></li>
                <li class="active"><?php echo display('invoice_details') ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
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
                <div class="panel panel-bd">
	                <div id="printableArea">
	                	<link href="<?php echo base_url()?>my-assets/css/payslip.css" rel="stylesheet" type="text/css">
	                    <div class="panel-body">
	                      <div class="maney">
        <div class="container">
            <div class="border-bottom">
                <!-- address --> 
                <div class="logo_padd">
                        <div class="header_top">
                           <img src="<?php if (isset($Web_settings[0]['logo'])) {echo $Web_settings[0]['logo']; }?>" class="" alt="" style="height: 100px;width:100px">
                        </div> 
                        <div class="header_top">
                            <div class="header_titel">
                                <h3><?php echo display('cash_receipt')?></h3>
                                <h5><?php echo display('customer_copy')?> </h5>
                            </div> 
                        </div> 
                        <div class="header_top">
                            <address class="heading_address">
                                   {company_info}
	                           
	                               
	                                <address style="margin-top:10px">
	                                  
	                                    <?php echo display('address') ?>:{address}<br>
	                                    <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
	                                    <abbr><b><?php echo display('email') ?>:</b></abbr> 
	                                    {email}<br>
	                                    <abbr><b><?php echo display('website') ?>:</b></abbr> 
	                                    {website}
	                                </address>
	                       
	                            {/company_info}
                            </address>
                        </div> 
                 </div>
                    <!-- recipt date -->  
                     <div class="logo_content">
                         <div class="logo_left maney_dis">
                             <h5><?php echo display('receipt_no') ?>:<span>{receipt_no}</span></h5> 
                        </div>
                         <div class="logo_right">
                             <h5> <?php echo display('date') ?>:<span> {date}</span></h5> 

                        </div>
                    </div>  
                     <!-- Recevied From --> 
                    <div class="mayey_discription">
                        <div class="maney_dis-padd">
                            <div class="maney_dis">
                                <h5>Cash Recevied From <span>{customer_name}</span> of<span>
                           <?php echo (($position==0)?"$currency {amount}":"{total_amount} $amount") ?>

                                </span></h5> 
                            </div>
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disri">
                                <h5>Account of <span><?php echo display('customer') ?></span><?php echo display('payment') ?> .</h5> 
                            </div>
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disri">
                                <h5> Payment method chcek . chcek No:<span><?php $check=$check_no;
                                if($check==''){
                                	echo 'Cash';
                                }
                                else{
                                	echo $check;
                                }?></span></h5> 
                            </div> 
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disrip">
                                <h5>With Description:<span>{description}</span></h5> 
                            </div>
                        </div>
                    </div> 
                    <!-- signe --> 
                    <div class="signe">
                        <div class="signe_left">
                            <h5>Authorized By</h5>
                        </div>
                        <div class="signe_right">
                            <h5>Signed By</h5>
                        </div>
                    </div> 
                </div>
            </div>
            <hr class="style3">
         <!-- office copy -->  
         <div class="container">
            <div class="border-bottom">
                <!-- address --> 
                <div class="logo_padd">
                        <div class="header_top">
                          <img src="<?php if (isset($Web_settings[0]['logo'])) {echo $Web_settings[0]['logo']; }?>" class="" alt="" style="height: 100px;width:100px">
                        </div> 
                        <div class="header_top">
                            <div class="header_titeler">
                                <h3><?php echo display('cash_receipt')?></h3>
                                <h5><?php echo display('office_copy')?></h5>
                            </div> 
                        </div> 
                        <div class="header_top">
                             <address class="heading_address">
                                   {company_info}
	                           
	                               
	                                <address style="margin-top:10px">
	                                  
	                                    <?php echo display('address') ?>:{address}<br>
	                                    <abbr><b><?php echo display('mobile') ?>:</b></abbr> {mobile}<br>
	                                    <abbr><b><?php echo display('email') ?>:</b></abbr> 
	                                    {email}<br>
	                                    <abbr><b><?php echo display('website') ?>:</b></abbr> 
	                                    {website}
	                                </address>
	                       
	                            {/company_info}
                            </address>
                        </div> 
                 </div>
                    <!-- recipt date -->  
                     <div class="logo_content">
                         <div class="logo_left maney_dis">
                             <h5><?php echo display('receipt_no') ?>:<span>{receipt_no}</span></h5> 
                        </div>
                         <div class="logo_right">
                             <h5> date:<span> {date}</span></h5> 

                        </div>
                    </div>  
                     <!-- Recevied From --> 
                    <div class="mayey_discription">
                        <div class="maney_dis-padd">
                            <div class="maney_dis">
                                <h5>Cash Recevied From <span>{customer_name}</span>of<span> <?php echo (($position==0)?"$currency {amount}":"{total_amount} $amount") ?></span></h5> 
                            </div>
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disri">
                                 <h5>Account of <span><?php echo display('customer') ?></span><?php echo display('payment') ?> .</h5> 
                            </div>
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disri">
                                <h5> Payment method chcek . chcek No:<span><?php $check=$check_no;
                                if($check==''){
                                	echo 'Cash';
                                }
                                else{
                                	echo $check;
                                }?></span></h5> 
                            </div> 
                        </div>
                        <div class="maney_dis-padd">
                            <div class="maney_disrip">
                                <h5>With Description <span>{description}</span></h5> 
                            </div>
                        </div>
                    </div> 
                    <!-- signe --> 
                    <div class="signe">
                        <div class="signe_left">
                            <h5>Authorized By</h5>
                        </div>
                        <div class="signe_right">
                            <h5>Signed By</h5>
                        </div>
                    </div> 
                </div>
            </div>
         
      </div>
	                    </div>
	                </div>

                     <div class="panel-footer text-left">
                     	<a  class="btn btn-danger" href="<?php echo base_url('Cinvoice');?>"><?php echo display('cancel') ?></a>
						<a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><span class="fa fa-print"></span></a>
						
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->



