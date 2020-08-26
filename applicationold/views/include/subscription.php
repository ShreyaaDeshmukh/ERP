<!-- Admin Home Start -->

 <div class="content-wrapper">

    <!-- Content Header (Page header) -->
	<section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-world"></i>



        </div>

        <div class="header-title">

            <h1><?php echo display('dashboard')?></h1>

            <small><?php echo display('home')?></small>

            <ol class="breadcrumb">

                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home')?></a></li>

                <li class="active"><?php echo display('dashboard')?></li>

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
			<div class="col-md-12">
				Your Subscription has been expired. Pleaes renew subscription. For reneval contact +91-8962317149
			</div>
		</div>
		
</section> <!-- /.content -->

</div> <!-- /.content-wrapper -->
