<!-- Add User start -->
<head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

$(document).ready(function(){

    $("#addaccessdiv").hide();


  $("#adduserbtn").click(function(){
 
//  alert("fjbf");

    $("#adduserdiv").hide();
    $("#addaccessdiv").show();

  });
  $("#addacccessbtn").click(function(){
    $("#addaccessdiv").hide();
    $("#adduserdiv").show();
      });

      $('#card_no').on('keypress change', function () {
  $(this).val(function (index, value) {
    return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
  });
});

document.getElementById("amt").value="$"+40;

      
});


</script>
<script>

function addnumber(){

    x = document.getElementById("web").value;
  y = document.getElementById("mobile_access").value;
 

if(x==NaN||x==""||x==null||x==0){
    x=0;
    // $('#web').val(x); 
  }
  if(y==NaN||y==""||y==null||y==0){
    y=0;
  }

 var totalval=parseInt(x)+parseInt(y);

 plan_price = document.getElementById("mobile_access").value;

 choose_plan=document.getElementById("choose_plan").value;

 document.getElementById("plan_id").value= "price_1H8L0WELvDFHHRjVEggH5L37";

 if(choose_plan==40||choose_plan=="40"){
//    $planid= "price_1H8L0WELvDFHHRjVEggH5L37";
   document.getElementById("plan_id").value ="price_1H8L0WELvDFHHRjVEggH5L37"
}
else{
    // $planid= "price_1H8L0WELvDFHHRjVYOxy42ug";
    document.getElementById("plan_id").value ="price_1H8L0WELvDFHHRjVYOxy42ug"

}

total_amount=parseInt(totalval)*parseInt(choose_plan);



// alert(total_amount);

document.getElementById("amt").value="$"+total_amount;

}

</script>

</head>



<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Add Mobile User</h1>
            <small><?php echo display('add_new_user_information') ?></small>
            <ol class="breadcrumb">
                <li><a href="/"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active">Add Mobile User</li>
            </ol>
        </div>
    </section>

    <section class="content">
        <!-- Alert Message -->
        <?php
        $data_msg = $this->session->userdata('data_msg');
        if (isset($data_msg)) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $data_msg ?>                    
            </div>
            <?php } ?>
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
        <!-- New user -->
        <div class="row">
        <div class="col-sm-12" id="adduserdiv">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-sm-6 panel-title">
                            <h4>Add New User</h4>  
                         </div>
                        <div class="col-sm-6">
                        <input type="button"  id="adduserbtn" class="btn btn-primary btn-small" name="add-user"  value="Get Access"  tabindex="6" style="float:right"/>

                        </div>
                        </div>
                            
                    </div>
                    
                    <?php echo form_open_multipart('User/insert_user', array('class' => 'form-vertical','onSubmit' => 'return CheckValidation()')) ?>
                    
                    <div class="panel-body" >
                 
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label"><?php echo display('first_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="1" class="form-control" name="first_name" id="first_name" placeholder="<?php echo display('first_name') ?>" maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 col-form-label"><?php echo display('last_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="2" class="form-control" name="last_name" id="last_name" placeholder="<?php echo display('last_name') ?>"  maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="email" tabindex="3" class="form-control" name="email" id="email" placeholder="<?php echo display('email') ?>" onkeyup="return ValidateEmail(this.value)" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label">Mobile <i class="text-danger">* eg. 111-111-2222</i></label>
                            <div class="col-sm-6">
                                <input type="text" tabindex="4" class="form-control" name="mobile" id="mobile" maxlength="10" placeholder="mobile" required="" minlength="10" />
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label"><?php echo display('password') ?> <i class="text-danger">* Enter atleast 6 characters</i></label>
                            <div class="col-sm-6">
                                <input type="password" tabindex="5" class="form-control" id="password" pattern=".{6,10}" name="password" placeholder="<?php echo display('password') ?>" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="platform" class="col-sm-3 col-form-label">Platform<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="platform" id="platform" tabindex="5" required>
                                    <option value=""><?php echo display('select_one') ?></option>
                                    <option value="Web">Web</option>
                                    <option value="iOS">iOS</option>
                                    <option value="Android">Android</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  tabindex="6"/>

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7">
                            </div>
                        </div>

                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

            <div class="col-sm-12" id="addaccessdiv">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="row">
                        <div class="col-sm-6 panel-title">
                            <h4>Add Access</h4>  
                         </div>
                        <div class="col-sm-6">
                        <input type="button" id="addacccessbtn" class="btn btn-primary btn-small" name="add-user"  value="Add User"  tabindex="6" style="float:right"/>

                        </div>
                        </div>
                            
                    </div>
                                         
                    <div class="panel-body" >

                    <form role="form" action="Admin_dashboard/addaccess" method="post" class="require-validation"
                    data-cc-on-file="false"
                    data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>"
                    id="payment-form">
                 
                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label">No of Web access <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" onkeyup="addnumber()" name="no_of_web_access" id="web" placeholder="No of web access" maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-sm-3 col-form-label">No of mobile access <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="number"  class="form-control" onkeyup="addnumber()" name="no_of_mobile_access" id="mobile_access" placeholder="No of mobile access" maxlength="20" required />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="platform" class="col-sm-3 col-form-label">Choose Plan<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control" name="choose_plan" id="choose_plan"   onchange="addnumber()" required>
                                    <!-- <option value=""><?php echo display('select_one') ?></option> -->
                                    <option value="40">Monthly ($40/user)</option>
                                    <option value="450">Yearly ($450/user)</option>
                                </select>
                            </div>
                        </div>                     

                        <div class="col-sm-9 panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                            <div class="col-sm-4">
                                <img class="img-responsive cc-img" src="https://ioetraders.com/storage/2019/12/stripe-payment-method.png.webp" style="width:70%;height:20%; ">
                                </div>
                                <div class="col-sm-8">
                                <h3 class="text-left" style="margin-left:10%">Stripe Payments</h3>
                                <h5 class="text-left" style="margin-left:10%">This payment is secured by STRIPE.</h5>
                                <p>for more information please visit <a href="https://stripe.com/">https://stripe.com/ </a></p>
                                </div>
                               
                            </div>
                        </div>
                        <div class="panel-body">
                        <div class='form-row row'>
                        <label for="platform" class="col-sm-4 col-form-label">Card Number<i class="text-danger">*</i></label>

                            <div class='col-sm-8 form-group card required'>
                                <input
                                    autocomplete='off' placeholder="" id="card_no" class='form-control input-group input-group-icon card-number' name="card_no" maxlength="20"
                                    type='text' required>
                                    
                            </div>
                        </div>
      
                        <div class='form-row row'>
                        <label for="platform" class="col-sm-4 col-form-label">CVC<i class="text-danger">*</i></label>

                            <div class='col-sm-8 form-group cvc required'>
                            <input autocomplete='off'
                                    class='form-control input-group input-group-icon card-cvc' maxlength="3" name="cvc" placeholder='CVC' size='4'
                                    type='text' required>
                            </div>

                        </div>

                        <div class='form-row row'>
                        <label for="platform" class="col-sm-4 col-form-label">Expiration Month<i class="text-danger">*</i></label>

                            <div class='col-sm-8 form-group expiration required'>
                               <input
                                    class='form-control input-group input-group-icon card-expiry-month' name="expiry_month" placeholder='MM' maxlength="2"
                                    type='text' required>
                            </div>
                         

                        </div>

                        <div class='form-row row'>
                        <label for="platform" class="col-sm-4 col-form-label">Expiration Year<i class="text-danger">*</i></label>

                            <div class='col-sm-8 form-group expiration required'>
                               <input
                                    class='form-control input-group input-group-icon card-expiry-year' name="expiry_year" placeholder='YYYY' size='4' maxlength="4"

                                    type='text' required>
                            </div>
                       
                        </div>
                          


                        <div class="form-group row">
                            <label for="first_name" class="col-sm-4 col-form-label">  Amount <i class="text-danger">*</i></label>
                            <div class="col-sm-8">
                            <input id="amt" name="amt" value=40  class='form-control input-group input-group-icon card-number' size='20' type='text'  >      
                            <input type="hidden" name="plan_id" id="plan_id" value="price_1H8L0WELvDFHHRjVEggH5L37">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                              <!-- <input type="submit" id="add-customer" class="btn btn-primary btn-large" onclick="swal('Access Granted Successfully...!!')" name="add-user" value="GET"  tabindex="6"/> -->
                                <input type="button" class="btn btn-primary btn-large" name="add-user" value="Get Access"  tabindex="6"/>

                                <!-- <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-user-another" class="btn btn-success" id="add-customer-another" tabindex="7"> -->
                            </div>
                        </div>
                        </div>
                        </div>

                    

        </form>                

                    </div>
        <br>
                </div>
   
            </div>
        </div>
    </section>
</div><script>	function CheckValidation(){			}		function ValidateEmail 	{	 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))	  {		$("#add-customer").removeAttr("disabled");		$("#add-customer-another").removeAttr("disabled");		return true;	  }		$("#add-customer").attr("disabled", "disabled");		$("#add-customer-another").attr("disabled", "disabled");		return (false)	}</script>

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

         console.log(status);

        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')

                .text(response.error.message);

                // alert("error");
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



<!-- Edit user end -->

















