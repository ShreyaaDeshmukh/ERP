<?php
$CI = & get_instance();
$CI->load->model('Web_settings');
$CI->load->model('Users');
$Web_settings = $CI->Web_settings->retrieve_setting_editdata();
$users = $CI->Users->profile_edit_data();
$r_id = $this->session->r_id; 
// print_r($r_id);

?>
<!-- Admin header end -->
<style type="text/css">
    .trnb:hover{
        background-color: Blue;
        color: white;

    }
    .trnb a:hover{

        color:white;

    }
</style>
<header class="main-header"> 
<?php 
// print_r($r_id); 
?>
    <a href='<?php echo base_url('my-assets/image/logo/logo.jpg') ?>' class="logo"> <!-- Logo -->
        <span class="logo-mini">
            <!--<b>A</b>BD-->
            <img src="<?php
            if (isset($Web_settings[0]['favicon'])) {
                echo $Web_settings[0]['favicon'];
            }
            ?>" alt="">
        </span>

        <span class="logo-lg">
            <!--<b>Admin</b>BD-->
            <img src='<?php echo base_url('my-assets/image/logo/logo.jpg') ?>' alt="">
            
        </span>
    </a>
    <!-- Header Navbar -->


    <nav class="navbar navbar-static-top">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <!-- Sidebar toggle button-->
            <span class="sr-only">Toggle navigation</span>

            <span class="pe-7s-keypad"></span>
        </a>
        <!--<span class="btn btn-default trnb" style="margin-left: 25%;margin-top: 15px"><a href="<?php echo base_url('Cinvoice') ?>"><i class="ti-layout-accordion-list"></i> <?php echo display('invoice') ?></a></span>  <span class="btn btn-default trnb" style="margin-top: 15px"><a href="<?php echo base_url('Cpayment/receipt_transaction') ?>"><i class="fa fa-money"></i> <?php echo display('receipt') ?> </a></span>
        <span class="btn btn-default trnb" style="margin-top: 15px"><a href="<?php echo base_url('Cpayment') ?>"><i class="fa fa-paypal" aria-hidden="true"></i>
                <?php echo display('payment') ?></a></span> <span class="btn btn-default trnb" style="margin-top: 15px"><a href="<?php echo base_url('Cpurchase') ?>"><i class="ti-shopping-cart"></i> <?php echo display('purchase') ?></a></span>-->


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- settings -->
                <li class="dropdown dropdown-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="pe-7s-settings"></i></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="<?php echo base_url('Admin_dashboard/edit_profile') ?>"><i class="pe-7s-users"></i><?php echo display('user_profile') ?></a></li>-->
                        <li><a href="<?php echo base_url('Admin_dashboard/change_password_form') ?>"><i class="pe-7s-settings"></i><?php echo display('change_password') ?></a></li>
                        <li><a href="<?php echo base_url('Admin_dashboard/logout') ?>"><i class="pe-7s-key"></i><?php echo display('logout') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel text-center">
            <div class="image">
                <img src="<?php echo base_url()?>my-assets/image/user-dummy-pic.png" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <p>
                <?php echo $this->session->userdata('username'); ?>
            </p>
                <!--<a href="#"><i class="fa fa-circle text-success"></i> <?php echo display('online') ?></a>-->
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu">

            <li class="<?php
            if ($this->uri->segment('1') == ("")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="<?php echo base_url() ?>"><i class="ti-dashboard"></i> <span><?php echo display('dashboard') ?></span>
                    <span class="pull-right-container">
                        <span class="label label-success pull-right"></span>
                    </span>
                </a>
            </li>

            <!-- Invoice menu start -->
           <?php /* <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cinvoice")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-layout-accordion-list"></i><span><?php echo display('invoice') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Cinvoice') ?>"><?php echo display('new_invoice') ?></a></li>
                    <li><a href="<?php echo base_url('Cinvoice/manage_invoice') ?>"><?php echo display('manage_invoice') ?></a></li>
                    <li><a href="<?php echo base_url('Cinvoice/pos_invoice') ?>"><?php echo display('pos_invoice') ?></a></li>
                </ul>
            </li> */ ?>
            <!-- Invoice menu end -->
            <!-- Category menu start -->


            <!-- Inventory menu start -->
           
            <!-- Inventory menu end -->



            <!-- Customer menu start -->
            
            <!-- Customer menu end -->

            <!-- Supplier menu start -->
            
            <!-- Supplier menu end  -->

            <!-- Purchase menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cpurchase")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-shopping-cart"></i><span><?php echo display('purchase') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   <!-- <li><a href="<?php echo base_url('Cpurchase') ?>"><?php echo display('add_purchase') ?></a></li>-->
                    <li><a href="<?php echo base_url('Cpurchase/manage_purchase/'.$r_id) ?>"><?php echo display('manage_purchase') ?></a></li>
                </ul>
            </li>
            <!-- Purchase menu end -->

				
			<!-- Purchase menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Creciving")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-shopping-cart"></i><span><?php echo display('Creciving') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url('Crecieving') ?>"><?php echo display('add_recieving') ?></a></li>-->
                    <li><a href="<?php echo base_url('Crecieving/manage_recieving/'.$r_id) ?>"><?php echo display('manage_recieving') ?></a></li>
                </ul>
            </li>
            <!-- Purchase menu end -->

			
            <!-- Purchase menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cticket")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-shopping-cart"></i><span><?php echo display('pick_tickets') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url('Cticket') ?>"><?php echo display('add_ticket') ?></a></li>-->
                    <li><a href="<?php echo base_url('Cticket/manage_ticket/'.$r_id) ?>"><?php echo display('manage_ticket') ?></a></li>
                </ul>
            </li>
            <!-- Purchase menu end -->
            
			
            
			
			
			
            <!-- Category menu end -->
            <!-- Product menu start -->
            <li class="treeview <?php
            if ($this->uri->segment('1') == ("Cinventory")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-bag"></i><span>Inventory</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    
                    <li><a href="<?php echo base_url('Cinventory/manage_product/'.$r_id) ?>">Manage Inventory</a></li>
                    <li><a href="<?php echo base_url('Cinventory/manage_checkout/'.$r_id) ?>">Manage Checkout</a></li>
                    <li><a href="<?php echo base_url('Cinventory/manage_checkin/'.$r_id) ?>">Manage Checkin</a></li>
                    
                </ul>
            </li>
			
			
			<li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccategory") || $this->uri->segment('1') == ("Cproduct") || $this->uri->segment('1') == ("Ccustomer") || $this->uri->segment('1') == ("Caislelocation") || $this->uri->segment('1') == ("Clocation") || $this->uri->segment('1') == ("Cshipping")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-tag"></i><span><?php echo 'Masters' ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview <?php
						if ($this->uri->segment('1') == ("Ccategory")) {
							echo "active";
						} else {
							echo " ";
						}
						?>">
							<a href="#">
								<i class="ti-tag"></i><span><?php echo display('category') ?></span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!--<li><a href="<?php echo base_url('Ccategory/'.$r_id) ?>"><?php echo display('add_category') ?></a></li>-->
								<li><a href="<?php echo base_url('Ccategory/manage_category/'.$r_id) ?>"><?php echo display('manage_category') ?></a></li>
							</ul>
					</li>

                    <li class="treeview <?php
                    if ($this->uri->segment('1') == ("Csupplier")) {
                        echo "active";
                    } else {
                        echo " ";
                    }
                    ?>">
                        <a href="#">
                            <i class="ti-user"></i><span><?php echo display('supplier') ?></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <!--<li><a href="<?php echo base_url('Csupplier') ?>"><?php echo display('add_supplier') ?></a></li>-->
                            <li><a href="<?php echo base_url('Csupplier/manage_supplier/'.$r_id) ?>"><?php echo display('manage_supplier') ?></a></li>
                            <li><a href="<?php echo base_url('Csupplier/import_vendors/'.$r_id) ?>"><?php echo "Import Vendor" ?></a></li>

                           <!-- <li><a href="<?php echo base_url('Csupplier/supplier_ledger_report') ?>"><?php echo display('supplier_ledger') ?></a></li>
        <!--                    <li><a href="<?php echo base_url('Csupplier/supplier_actual_ledger') ?>"><?php echo display('supplier_actual_ledger_sup') ?></a></li>

                            <li><a href="<?php echo base_url('Csupplier/supplier_actual_ledger_sales_price') ?>"><?php echo display('supplier_actual_ledger_sale') ?></a></li>-->
                            <!--<li><a href="<?php echo base_url('Csupplier/supplier_payment') ?>"><?php echo display('supplier_payment_ledger') ?></a></li>
                            <li><a href="<?php echo base_url('Csupplier/supplier_sales_details_all') ?>"><?php echo display('supplier_sales_details') ?></a></li> 
                          <!-- <li><a href="<?php echo base_url($supplier_sales_summary) ?>"><?php echo display('supplier_sales_summary') ?></a></li>
                           <li><a href="<?php echo base_url($sales_payment_actual) ?>"><?php echo display('supplier_payment_actual') ?></a></li> -->

                        </ul>
                    </li>
                    <li class="treeview <?php
                        if ($this->uri->segment('1') == ("Ccustomer")) {
                            echo "active";
                        } else {
                            echo " ";
                        }
                        ?>">
                            <a href="#">
                                <i class="fa fa-handshake-o"></i><span><?php echo display('customer') ?></span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <!--<li><a href="<?php echo base_url('Ccustomer') ?>"><?php echo display('add_customer') ?></a></li>-->
                                <li><a href="<?php echo base_url('Ccustomer/manage_customer/'.$r_id) ?>"><?php echo display('manage_customer') ?></a></li>
                                <li><a href="<?php echo base_url('Ccustomer/import_customers/'.$r_id) ?>"><?php echo "Import Customers" ?></a></li>
                                <!--<li><a href="<?php echo base_url('Ccustomer/credit_customer') ?>"><?php echo display('credit_customer') ?></a></li>
                                <li><a href="<?php echo base_url('Ccustomer/paid_customer') ?>"><?php echo display('paid_customer') ?></a></li>-->
                            </ul>
                        </li>
                
					 <li class="treeview <?php
						if ($this->uri->segment('1') == ("Cproduct")) {
							echo "active";
						} else {
							echo " ";
						}
						?>">
							<a href="#">
								<i class="ti-bag"></i><span><?php echo display('product') ?></span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!--<li><a href="<?php echo base_url('Cproduct') ?>"><?php echo display('add_product') ?></a></li>-->
								<li><a href="<?php echo base_url('Cproduct/manage_product/'.$r_id) ?>"><?php echo display('manage_product') ?></a></li>
								<li><a href="<?php echo base_url('Cproduct/import_product/'.$r_id) ?>"><?php echo "Import Products" ?></a></li>
								<?php
								if ($this->uri->segment(2) == "product_details") {
									?>
									<li><a href="<?php echo base_url($product_statement) ?>"><?php echo display('product_statement') ?></a></li>
								<?php }
								?>
							</ul>
						</li>
					
				
					<li class="treeview <?php
						if ($this->uri->segment('1') == ("Clocation")) {
							echo "active";
						} else {
							echo " ";
						}
						?>">
							<a href="#">
								<i class="ti-location-pin"></i><span><?php echo display('location') ?></span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!--<li><a href="<?php echo base_url('Clocation') ?>"><?php echo display('add_location') ?></a></li>-->
								
								<!--
								<li><a href="<?php echo base_url('Clocation/manage_building') ?>">Manage Building</a></li>
								<li><a href="<?php echo base_url('Caislelocation/manage_location') ?>">Manage Aisle</a></li>
								<li><a href="<?php echo base_url('Clocation/manage_slots') ?>">Manage Slots</a></li>
								<li><a href="<?php echo base_url('Clocation/manage_levels') ?>">Manage Levels</a></li>
								<li><a href="<?php echo base_url('Clocation/manage_bins') ?>">Manage Bins</a></li>
								-->
								<li><a href="<?php echo base_url('Clocation/manage_location/'.$r_id) ?>"><?php echo display('manage_location') ?></a></li>
								<li><a href="<?php echo base_url('Clocation/print_location/'.$r_id) ?>"><?php echo display('location_print') ?></a></li>
								<li><a href="<?php echo base_url('Clocation/import_locations/'.$r_id) ?>">Import Locations</a></li>
							</ul>
						</li>
				
					<li class="treeview <?php
						if ($this->uri->segment('1') == ("Cshipping")) {
							echo "active";
						} else {
							echo " ";
						}
						?>">
							<a href="#">
								<i class="ti-map"></i><span><?php echo display('shipping') ?></span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<!--<li><a href="<?php echo base_url('Cshipping') ?>"><?php echo display('add_shipping') ?></a></li>-->
								<li><a href="<?php echo base_url('Cshipping/manage_shipping/'.$r_id) ?>"><?php echo display('manage_shipping') ?></a></li>
							   
							</ul>
						</li>
				
					
				
				</ul>
            </li>
			
			
            <!-- Product menu end -->
             <!-- Receipt menu start -->
            <?php /*<li class="treeview <?php
            if ($this->uri->segment('1') == ("Creceipt")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-receipt"></i><span><?php echo display('receipt') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url('Creceipt') ?>"><?php echo display('add_receipt') ?></a></li>-->
                    <li><a href="<?php echo base_url('Creceipt/manage_receipt') ?>"><?php echo display('manage_receipt') ?></a></li>
                </ul>
            </li> */ ?>
            <!-- Purchase menu end -->


            <!-- Loction menu start -->

            



            
            


            

            <!-- Purchase menu end -->


			
			<!-- Loction menu start -->
            
            <!-- Purchase menu end -->
			
			
            <!-- Stock menu start --> 
        <!--<li class="treeview <?php
        if ($this->uri->segment('1') == ("Creport")) {
            echo "active";
        } else {
            echo " ";
        }
        ?>">
            <a href="#">
                <i class="ti-bar-chart"></i><span><?php echo display('stock') ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('Creport') ?>"><?php echo display('stock_report') ?></a></li>
                <li><a href="<?php echo base_url('Creport/stock_report_supplier_wise') ?>"><?php echo display('stock_report_supplier_wise') ?></a></li>
                <li><a href="<?php echo base_url('Creport/stock_report_product_wise') ?>"><?php echo display('stock_report_product_wise') ?></a></li>
            </ul>
        </li>-->
        <!-- Stock menu end -->


        <?php
        // if ($this->session->userdata('user_type') == '1') {
            ?>



            <!-- Report menu start -->
            <?php /*<li class="treeview <?php
            if ($this->uri->segment('2') == ("all_report") || $this->uri->segment('2') == ("todays_sales_report") || $this->uri->segment('2') == ("todays_purchase_report") || $this->uri->segment('2') == ("product_sales_reports_date_wise") || $this->uri->segment('2') == ("retrieve_dateWise_PurchaseReports") || $this->uri->segment('2') == ("total_profit_report") || $this->uri->segment('2') == ("retrieve_dateWise_SalesReports")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-book"></i><span><?php echo display('report') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Admin_dashboard/all_report') ?>"><?php echo display('todays_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_sales_report') ?>"><?php echo display('sales_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_purchase_report') ?>"><?php echo display('purchase_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise') ?>"><?php echo display('sales_report_product_wise') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/total_profit_report') ?>"><?php echo display('profit_report') ?></a></li>
                </ul>
                
            </li>*/ ?>















<li class="treeview <?php
            if ($this->uri->segment('1') == ("Ccategory") || $this->uri->segment('1') == ("Cproduct") || $this->uri->segment('1') == ("Ccustomer") || $this->uri->segment('1') == ("Caislelocation") || $this->uri->segment('1') == ("Clocation") || $this->uri->segment('1') == ("Cshipping")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-tag"></i><span><?php echo 'Role Management' ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview <?php
						if ($this->uri->segment('1') == ("Ccategory")) {
							echo "active";
						} else {
							echo " ";
						}
						?>">
                            <a href="<?php echo base_url('Croles/') ?>">
								<i class="ti-tag"></i><span><?php echo 'Assign Roles' ?></span>
								<!-- <span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span> -->
							</a>
						
					</li>

        
                  				</ul>
            </li>
			
			
            <!-- Product menu end -->
             <!-- Receipt menu start -->
            <?php /*<li class="treeview <?php
            if ($this->uri->segment('1') == ("Creceipt")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-receipt"></i><span><?php echo display('receipt') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="<?php echo base_url('Creceipt') ?>"><?php echo display('add_receipt') ?></a></li>-->
                    <li><a href="<?php echo base_url('Creceipt/manage_receipt') ?>"><?php echo display('manage_receipt') ?></a></li>
                </ul>
            </li> */ ?>
            <!-- Purchase menu end -->


            <!-- Loction menu start -->

            






































            
            


            

            <!-- Purchase menu end -->


			
			<!-- Loction menu start -->
            
            <!-- Purchase menu end -->
			
			
            <!-- Stock menu start --> 
        <!--<li class="treeview <?php
        if ($this->uri->segment('1') == ("Creport")) {
            echo "active";
        } else {
            echo " ";
        }
        ?>">
            <a href="#">
                <i class="ti-bar-chart"></i><span><?php echo display('stock') ?></span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="<?php echo base_url('Creport') ?>"><?php echo display('stock_report') ?></a></li>
                <li><a href="<?php echo base_url('Creport/stock_report_supplier_wise') ?>"><?php echo display('stock_report_supplier_wise') ?></a></li>
                <li><a href="<?php echo base_url('Creport/stock_report_product_wise') ?>"><?php echo display('stock_report_product_wise') ?></a></li>
            </ul>
        </li>-->
        <!-- Stock menu end -->


        <?php
        // if ($this->session->userdata('user_type') == '1') {
            ?>



            <!-- Report menu start -->
            <?php /*<li class="treeview <?php
            if ($this->uri->segment('2') == ("all_report") || $this->uri->segment('2') == ("todays_sales_report") || $this->uri->segment('2') == ("todays_purchase_report") || $this->uri->segment('2') == ("product_sales_reports_date_wise") || $this->uri->segment('2') == ("retrieve_dateWise_PurchaseReports") || $this->uri->segment('2') == ("total_profit_report") || $this->uri->segment('2') == ("retrieve_dateWise_SalesReports")) {
                echo "active";
            } else {
                echo " ";
            }
            ?>">
                <a href="#">
                    <i class="ti-book"></i><span><?php echo display('report') ?></span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('Admin_dashboard/all_report') ?>"><?php echo display('todays_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_sales_report') ?>"><?php echo display('sales_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/todays_purchase_report') ?>"><?php echo display('purchase_report') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/product_sales_reports_date_wise') ?>"><?php echo display('sales_report_product_wise') ?></a></li>
                    <li><a href="<?php echo base_url('Admin_dashboard/total_profit_report') ?>"><?php echo display('profit_report') ?></a></li>
                </ul>
            </li>*/ ?>
            
            <!-- Software Settings menu start -->
            <li class="treeview <?php
            // if ($this->uri->segment('1') == ("Company_setup") || $this->uri->segment('1') == ("User") || $this->uri->segment('1') == ("Cweb_setting") || $this->uri->segment('1') == ("Language")) {
            //     echo "active";
            // } else {
            //     echo " ";
            // }
            ?>">




















            
            <!-- Software Settings menu start -->
            <li class="treeview <?php
            // if ($this->uri->segment('1') == ("Company_setup") || $this->uri->segment('1') == ("User") || $this->uri->segment('1') == ("Cweb_setting") || $this->uri->segment('1') == ("Language")) {
            //     echo "active";
            // } else {
            //     echo " ";
            // }
            ?>">
                <a href="#">
                    <i class="ti-settings"></i><span>Software Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <!--<li><a href="javascript:;"><?php echo display('manage_company') ?></a></li>-->
                    <li><a href="<?php echo base_url('User') ?>"><?php echo display('add_user') ?></a></li>
                    <li><a href="<?php echo base_url('User/manage_user') ?>"><?php echo display('manage_users') ?> </a></li>
                    <li><a href="<?php echo base_url('Language') ?>"><?php echo display('language') ?> </a></li>
<!--<li><a href="javascript:;"><?php echo display('setting') ?> </a></li>-->
                </ul>
            </li>
            <!-- Software Settings menu end -->
            <?php
        // }
        ?>

        </ul>
    </div> <!-- /.sidebar -->
</aside>
