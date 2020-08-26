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


<?php $lic = $this->session->lic_key;
 ?>

<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <b style="color: white;">WM Simplified</b>
        <!-- <br>Yönetim Paneli</a> -->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <H2 class="login-box-msg">Signup</H2>
      <?php $this->load->helper('form'); ?>
      <div class="row">
        <div class="col-md-12">
          <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
        </div>
      </div>
        
        
       <?php
         $warning = $this->session->flashdata('warning');
        if($warning)
        {
            ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $warning; ?>
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
         <?php 
        $warning = $this->session->flashdata('warning');
        if($warning)
        {
            ?>
        <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $warning; ?>
        </div>
        <?php } ?>
        
        
        <?php }
        $success = $this->session->flashdata('success');
        if($success)
        {
            ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $success; ?>
        </div>
        <?php } ?>

        <form action="<?php echo base_url(); ?>Admin_dashboard/signupMe" method="post">
          <div class="form-group has-feedback">
            <input type="email" id = "email" class="form-control" placeholder="Email" name="email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="number" min="0" class="form-control" placeholder="Mobile" name="mobile" required />
           <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Confirm Password" name="rpassword" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <!-- <input type="password"  placeholder="Repeat Password" name="rpassword" required /> -->
          <select class="form-control" name="subscription">
            <option value="" disabled selected>Select your Subscription</option>
            <option value="Monthly">Monthly</option>
            <option value="Quarterly">Quarterly</option>
            <option value="Yearly">Yearly</option>
          </select>
            <!-- <span class="glyphicon glyphicon-lock form-control-feedback"></span> -->
          </div>
          <div class="row">
            <div class="col-xs-8">
             
        <!-- <a href="<?php echo base_url() ?>forgotPassword">Forget Password</a><br/> -->
        <a href="<?php echo base_url() ?>Admin_dashboard/login"style="font-size:20px">Cancel</a>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <input type="submit" id ="send" class="btn btn-primary btn-block btn-flat" value="Next" />
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

<script>
// $( document ).on( 'click', '#send', function ( e ) {
    // e.preventDefault();
    // hide response if it's visible
    // $( '#response' ).hide();
    // we grab all fields values to create our email
    // var name = $( '#name' ).val();
    // var email = $( '#email' ).val();
    // var lic = ('<?php echo($lic); ?>');
    // console.log(lic);
    // var message = $( '#message' ).val();
    // if ( name === '' || email === '' || message === '' )
    // {
        // all fields are rquired so if one of them is empty the function returns
        // return;
    // }
    // if it's all right we proceed
    // $.ajax( {
        // type: 'post',
        // our baseurl variable in action will call the sendemail() method in our default controller
        // url: "<?php echo base_url(); ?>sendEmail"
        // data: {  email: email, lic: lic },
        // success: function ( result )
        // {
          // console.log(result);
            // Ajax call success and we can show the value returned by our controller function
            // $( '#response' ).html( result ).fadeIn( 'slow' ).delay( 3000 ).fadeOut( 'slow' );
            // $( '#name' ).val( '' );
            // $( '#email' ).val( '' );
            // $( '#message' ).val( '' );
        // },
        // error: function ( result )
        // {
          // console.log("something went wrong");
            // Ajax call failed, so we inform the user something went wrong
            // $( '#response' ).html( 'Server unavailable now: please, retry later.' ).fadeIn( 'slow' ).delay( 3000 ).fadeOut( 'slow' );
            // $( '#name' ).val( '' );
            // $( '#email' ).val( '' );
            // $( '#message' ).val( '' );
        // }
    // } );
// } );
</script>