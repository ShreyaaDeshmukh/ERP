<?php
// 		if(isset($licence_session)){
// 		print_r($licence_session);
// 		}

//print_r($user_details['username']);

	?>
	

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Wm simplified</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"
  />
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

	


<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <b style="color: white;">WM Simplified</b>
        <!-- <br>Yönetim Paneli</a> -->
    </div>

    <!-- /.login-logo -->
    <div class="login-box-body">
      <H2 class="login-box-msg">License key</H2>
      <?php $this->load->helper('form'); ?>
      <div class="row">
        <div class="col-md-12">
          <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
        </div>
      </div>
      <?php  
     $email_sent= $this->session->flashdata('email_sent');
      ?>
       <!--invalid_key-->
         <?php if($email_sent)
        {
            ?>
        <div class="alert alert-warning alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $email_sent; ?>
        </div>
        <?php } ?>
        
        <!--email_sent-->
       <?php
        $invalid_key = $this->session->flashdata('invalid_key');
        if($invalid_key)
        {
            ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $invalid_key; ?>
        </div>
        <?php }?>
         
      
      <?php
        $this->load->helper('form');
        $error = $this->session->flashdata('error');
        if($error)
        {
            ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $error; ?>
        </div>
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $success; ?>
        </div>
        <?php }
        
   print_r($this->session->userdata('lic_key')); ?>
        <form action="<?php echo base_url(); ?>Admin_dashboard/license" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Enter License key" name="license" required />
            <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
          </div>
         
          <!-- <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div> -->
          <div class="row">
            <div class="col-xs-8">
             
        <!-- <a href="<?php echo base_url() ?>Admin_dashboard/forgotPassword">Forget Password</a><br/> -->
        <a href="<?php echo base_url() ?>Admin_dashboard/login">Cancel</a>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Submit" />
            </div>
            <!-- /.col -->
          </div>
        </form>

        <br>

    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>