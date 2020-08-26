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
  <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
        .panel-title {
        display: inline;
        font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
        *,
*:before,
*:after {
  box-sizing: border-box;
}
body {
  padding: 1em;
  font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 15px;
  color: #b9b9b9;
  background-color: #e3e3e3;
}
h4 {
  color: #3c8dbc;
  font-size: 1em;
  font-style:bolder
  
}
input,
input[type="radio"] + label,
input[type="checkbox"] + label:before,
select option,
select {
  width: 100%;
  padding: 1em;
  line-height: 1.4;
  background-color: #f9f9f9;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
input:focus {
  outline: 0;
  border-color: #64ac15;
}
input:focus + .input-icon i {
  color: #3c8dbc;
}
input:focus + .input-icon:after {
  border-right-color: #3c8dbc;
}
input[type="radio"] {
  display: none;
}
input[type="radio"] + label,
select {
  display: inline-block;
  width: 50%;
  text-align: center;
  float: left;
  border-radius: 0;
}
input[type="radio"] + label:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
input[type="radio"] + label:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
input[type="radio"] + label i {
  padding-right: 0.4em;
}
input[type="radio"]:checked + label,
input:checked + label:before,
select:focus,
select:active {
  background-color: #3c8dbc;
  color: #fff;
  border-color: #64ac15;
}
input[type="checkbox"] {
  display: none;
}
input[type="checkbox"] + label {
  position: relative;
  display: block;
  padding-left: 1.6em;
}
input[type="checkbox"] + label:before {
  position: absolute;
  top: 0.2em;
  left: 0;
  display: block;
  width: 1em;
  height: 1em;
  padding: 0;
  content: "";
}
input[type="checkbox"] + label:after {
  position: absolute;
  top: 0.45em;
  left: 0.2em;
  font-size: 0.8em;
  color: #fff;
  opacity: 0;
  font-family: FontAwesome;
  content: "\f00c";
}
input:checked + label:after {
  opacity: 1;
}
select {
  height: 3.4em;
  line-height: 2;
}
select:first-of-type {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
select:last-of-type {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
select:focus,
select:active {
  outline: 0;
}
select option {
  background-color: #3c8dbc;
  color: #fff;
}
.btn{
  background-color: #3c8dbc;
  width:60%;
  margin-left: 20%;
  margin-right: 20%;
  margin-top: 5%;
  color:#fff;
  font-weight: bold;
  font-size: medium;
}
.input-group {
  margin-bottom: 1em;
  zoom: 1;
  width:100%
}
.input-group:before,
.input-group:after {
  content: "";
  display: table;
}
.input-group:after {
  clear: both;
}
.input-group-icon {
  position: relative;
}
.input-group-icon input {
  padding-left: 4.4em;
}
.input-group-icon .input-icon {
  position: absolute;
  top: 0;
  left: 0;
  width: 3.4em;
  height: 3.4em;
  line-height: 3.4em;
  text-align: center;
  pointer-events: none;
}
.input-group-icon .input-icon:after {
  position: absolute;
  top: 0.6em;
  bottom: 0.6em;
  left: 3.4em;
  display: block;
  border-right: 1px solid #e5e5e5;
  content: "";
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.input-group-icon .input-icon i {
  -webkit-transition: 0.35s ease-in-out;
  -moz-transition: 0.35s ease-in-out;
  -o-transition: 0.35s ease-in-out;
  transition: 0.35s ease-in-out;
  transition: all 0.35s ease-in-out;
}
.container {
  max-width: 38em;
  padding: 1em 3em 2em 3em;
  margin: 0em auto;
  background-color: #fff;
  border-radius: 4.2px;
  overflow: scroll;

  box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
}
.row {
  zoom: 1;
}
.row:before,
.row:after {
  content: "";
  display: table;
}
.row:after {
  clear: both;
}
.col-half {
  padding-right: 10px;
  float: left;
  width: 50%;
}
.col-half:last-of-type {
  padding-right: 0;
}
.col-third {
  padding-right: 10px;
  float: left;
  width: 33.33333333%;
}
.col-third:last-of-type {
  padding-right: 0;
}
@media only screen and (max-width: 540px) {
  .col-half {
    width: 100%;
    padding-right: 0;
  }
}


</style>


</head>

<script>alert($_POST['plan_id']);</script>
<?php

$plnid=$_POST['plan_id'];
$ar=explode("*",$plnid);
$pid=$ar[0];
$amt=$ar[1];

$maxval=0;

if($amt=="$10")
{
  $maxval=1;

}elseif($amt=="$25")
{
  $maxval=3;

}elseif($amt="$50"){

  $maxval=7;

}else{
  $maxval=15;

}

//  echo "<script>alert('".$pid."');</script>";
//  echo "<script>alert('".$amt."');</script>";

?>
<?php $lic = $this->session->lic_key;
 ?>

<body class="login-page">
<div class="container">
  <!-- <div class="login-box"> -->
    <!-- <div class="login-logo">
      <a href="#">
        <b style="color: white;">WM Simplified</b>
    </div> -->
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

        <form role="form" action="stripePost" method="post" class="require-validation"
        data-cc-on-file="false"
        data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
        id="payment-form">  
          
    <div class="row">
      <h4>Personal Details</h4>
      <div class="input-group input-group-icon form-group required">
        <input type="text" name="full_name" placeholder="Full Name" required/>
        <div class="input-icon"><i class="fa fa-user"></i></div>
      </div>
      <div class="input-group input-group-icon form-group required">
        <input type="number" name="contact_no" placeholder="Contact Number" pattern="^[0–9]$" />
        <div class="input-icon"><i class="fa fa-mobile"></i></div>
      </div>
      <div class="input-group input-group-icon form-group required">
        <input type="email" name="email_address" placeholder="Email Adress" required/>
        <div class="input-icon"><i class="fa fa-envelope"></i></div>
      </div>
      <div class="input-group input-group-icon form-group required">
        <input type="password" name="password" placeholder="Password" required/>
        <div class="input-icon"><i class="fa fa-key"></i></div>
      </div>
    </div>
    <!-- <div class="row">
      <div class="col-half">
        <h4>Date of Birth</h4>
        <div class="input-group">
          <div class="col-third">
            <input type="text" name="date" placeholder="DD"/>
          </div>
          <div class="col-third">
            <input type="text" name="month" placeholder="MM"/>
          </div>
          <div class="col-third">
            <input type="text" name="year" placeholder="YYYY"/>
          </div>
        </div>
      </div>
      <div class="col-half">
        <h4>Gender</h4>
        <div class="input-group form-group required">
          <input type="radio" name="gender" value="male" id="gender-male"/>
          <label for="gender-male">Male</label>
          <input type="radio" name="gender" value="female" id="gender-female"/>
          <label for="gender-female">Female</label>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-half">
        <h4>No. of Web Access</h4>
        <div class="input-group input-group-icon">
          <!-- <input type="checkbox" id="terms"/> -->
          <input type="number" name="no_of_web_access" min="1" max=<?php echo $maxval; ?> placeholder="0" required/>
          <div class="input-icon"><i class="fa fa-desktop"></i></div>
     
        </div>
      </div>
      <div class="col-half">
        <h4>No. of Mobiles Access</h4>
        <div class="input-group input-group-icon">
          <input type="number" name="no_of_mobile_access" min="1" max=<?php echo $maxval; ?> placeholder="0" required/>
          <div class="input-icon"><i class="fa fa-mobile-phone"></i></div>
          <!-- <div class="input-icon"> -->
            <input type="checkbox"></div>
        <!-- </div> -->
      </div>
    </div>

    <div class="row">
      <h4>Payment Details <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png" style="vertical:middle">
    </h4>
     
        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <h4>Card Number</h4> <input
                                    autocomplete='off' class='input-group input-group-icon card-number' size='20'
                                    type='text' required>
                                    
                            </div>
                        </div>
      
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <h4>CVC</h4> <input autocomplete='off'
                                    class='input-group input-group-icon card-cvc' placeholder='CVC' size='4'
                                    type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <h4>Expiration Month</h4> <input
                                    class='input-group input-group-icon card-expiry-month' placeholder='MM' size='2'
                                    type='text' required>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <h4>Expiration Year<h4> <input
                                    class='input-group input-group-icon card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' required>
                            </div>

                            <div class='col-xs-12 form-group card required'>
                                <h4>Amount</h4> <input
                                    autocomplete='off' value=<?php echo $amt; ?> class='input-group input-group-icon card-number' size='20'
                                    type='text' readonly >
                                    
                            </div>

                            <input type="hidden" name="plan_id" value=<?php echo $pid; ?>>
                        </div>
      
    </div>
    <!-- <div class="row">
      <h4>Terms and Conditions</h4>
      <div class="input-group form-group required">
        <input type="checkbox" id="terms" required/>
        <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
      </div>
    </div> -->
    <div class="row">
      <div class="input-group">
        <input type="submit" class="btn" value="Sign Up" />
        <!-- <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label> -->
      </div>

    </div>
  </form>

        <br>
        </div>
    <!-- </div> -->
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
     
<script type="text/javascript">
$(function() {
    var $form         = $(".require-validation");
  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]','input[type=checkbox]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
 
        $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault();
      }
    });
     
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
    
  });
      
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);

                swal(response.error.message);
        } else {
            var token = response['id'];
            $form.find('input[type=text]').empty();

            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
          
            $form.get(0).submit();
        }
    }
     
});
</script>

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