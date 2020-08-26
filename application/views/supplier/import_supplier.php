<!-- Customer js php -->

<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/customer.js.php" ></script>



<!-- Manage Customer Start -->

<div class="content-wrapper">

    <section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-note2"></i>

        </div>

        <div class="header-title">

            <h1><?php echo display('import_supplier') ?></h1>

            <small><?php echo display('manage_your_customer') ?></small>

            <ol class="breadcrumb">

                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

                <li><a href="#"><?php echo display('customer') ?></a></li>

                <li class="active"><?php echo display('import_supplier') ?></li>

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

                        <a href="<?php echo base_url().'my-assets/csv/vendor.csv'?>"><input type="button" id="import-supplier" class="btn btn-success btn-large" name="import-supplier" value="Download Template"></a>	            
                    </div>
                </div>
            </div>
        </div>
        <!-- Manage Customer -->
		
		<div class="row">	
			<div class="col-md-12">
				<div class="panel panel-default">
                    <div class="panel-body"> 
							<form action="<?php echo base_url('Csupplier/vendor_import_action')?>" method="post" enctype= "multipart/form-data">
									<div class="form-group">
										<label for="exampleFormControlFile1">Example file input</label>
										<input type="file" class="form-control-file" id="supplier" name="supplier">
									</div>
									
									<div class="form-group">
										<button type="submit" class="btn btn-primary mb-2">Import</button>
									</div>
							</form>
                                
                    </div>
                </div>
			</div>
		
		</div>
       

    </section>

</div>

<!-- Manage Customer End -->



<!-- Delete Customer ajax code -->

<script type="text/javascript">

    //Delete Customer 

    $(".deleteCustomer").click(function ()

    {

        var customer_id = $(this).attr('name');

        var csrf_test_name = $("[name=csrf_test_name]").val();

        var x = confirm("Are you sure you want to delete? ");

        if (x == true) {

            $.ajax

                    ({

                        type: "POST",

                        url: '<?php echo base_url('Ccustomer/customer_delete') ?>',

                        data: {customer_id: customer_id, csrf_test_name: csrf_test_name},

                        cache: false,

                        success: function (datas)

                        {
							window.location.reload();
                        }

                    });

       }else{
			return false;
		}

    });

</script>