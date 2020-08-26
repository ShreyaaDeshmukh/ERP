<!-- Add new customer start -->
<?php $r_id = $this->session->r_id; ?>
<div class="content-wrapper">

    <section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-note2"></i>

        </div>
<!--session->set_flashdata('data_msg'-->
        <div class="header-title">

            <h1><?php echo display('add_customer') ?></h1>

            <small><?php echo display('add_new_customer') ?></small>

            <ol class="breadcrumb">

                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

                <li><a href="#"><?php echo display('customer') ?></a></li>

                <li class="active"><?php echo display('add_customer') ?></li>

            </ol>

        </div>

    </section>



    <section class="content">

        <!-- Alert Message -->
            <?php

            $data_msg = $this->session->userdata('data_msg');

            if (isset($data_msg)) {

        ?>

        <div class="alert alert-info alert-dismissable">

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



        <!-- New customer -->

        <div class="row">

            <div class="col-sm-12">

                <div class="panel panel-bd lobidrag">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4><?php echo display('add_customer') ?> </h4>

                        </div>

                    </div>
                    

                  <?php echo form_open('Ccustomer/insert_customer', array('class' => 'form-vertical','id' => 'insert_customer'))?>

                    <div class="panel-body">



                    	<div class="form-group row">

                            <label for="customer_name" class="col-sm-3 col-form-label"><?php echo display('customer_name') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="customer_name" id="customer_name" type="text" placeholder="<?php echo display('customer_name') ?>"  required ="" tabindex='1'>

                            </div>
                            <label style="width: 10%;" class = "btn btn-large btn-success clickButton">Add ship to</label>
                        </div>
                         <!-- add ship to address functionality below -->
                         <div id = "show"  style="display:none" class="form-group row">
                            
                            <label for="ship_to" class="col-sm-3 col-form-label">Ship To <i class="text-danger"></i></label>
                                <div class = "row">
                            <div class="col-sm-3">

                                <input class="form-control" name ="ship_to_name" id="ship_to_name" type="text" placeholder="Name"  tabindex='2'>

                            </div>

                            <div class="col-sm-3">

                                <input class="form-control" name ="ship_to_email" id="ship_to_email" type="email" placeholder="Email"  tabindex='2'>

                            </div>
                            </div>
                            <div class="row" style="height: 10px;"><div class="col-sm-6"></div></div>
                            <label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label>
                           <div class="row">
                            <div class="col-sm-3">

                                <input class="form-control" name ="ship_to_phone" id="ship_to_phone" type="text" maxlength="12" minlength="12" placeholder="Phone"  tabindex='2'>

                            </div>
                            <div class="col-sm-3">

                                <input class="form-control" name ="ship_to_address" id="ship_to_address" type="text" placeholder="Address"  tabindex='2'>
                                
                            </div>
                           
                            </div>
                            <div class="row" style="height: 10px;"><div class="col-sm-6"></div></div>
                            <label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label>
                           <div class="row">
                            <div class="col-sm-3">

                            <select id="country1" name ="country1" class="form-control countries dont-select-me" onchange="selectState1(this.value)" required tabindex='4'>
									<option value="">Select Country</option>
								 </select> 

                            </div>
                            <div class="col-sm-3">

                            <select name ="state1" id ="state1" class="form-control states dont-select-me"  onchange="selectCity1(this.value)" required tabindex='5'><option value="">Select State</option></select> 

                                
                            </div>
                           
                            </div>
                            <div class="row" style="height: 10px;"><div class="col-sm-6"></div></div>
                            <label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label>
                            <div class="row">
                            <div class="col-sm-3">

                            <select name ="city1" id ="city1" class="form-control cities dont-select-me" required tabindex='6'><option value="">Select City</option></select> 

                            </div>
                            <div class="col-sm-3">

                            <input class="form-control" name="zip1" id="zip1" type="text" maxlength="10" minlength="5" placeholder="<?php echo display('zip') ?>" tabindex='7' required>
                                <span style="float:right;right:-20px;top:-30px;" onclick= "return addMulipleShipAddress(1)" id="addShipTo1"  class="glyphicon glyphicon-plus plusicon"></span>
                            </div>
                           
                            </div>
                        </div>
                        <div id="addmultipleShipaddress">
							
						</div>
                        <!-- end of ship to address -->
						<div class="form-group row">

                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('customer_mobile') ?><i class="text-danger">* eg. 111-111-2222</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="mobile" id="mobile" type="text"  maxlength="12" minlength="12" placeholder="<?php echo display('customer_mobile') ?>"  tabindex='2' required>

                            </div>

                        </div>

                       	<div class="form-group row">

                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('customer_email') ?><i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name ="email" id="email" type="email" placeholder="<?php echo display('customer_email') ?>" tabindex='3'  onkeyup="checkCustomerName(this.value);" required>

                            </div>

                        </div>



                        

                        

                        


                         

						<div class="form-group row">

                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('country') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                 <select id="country" name ="country" class="form-control countries dont-select-me" onchange="selectState(this.value)"  tabindex='4' required>
									<option value="">Select Country</option>
								 </select> 

                            </div>

                        </div>



                        <div class="form-group row">

                            <label for="state" class="col-sm-3 col-form-label"><?php echo display('state') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                 <select name ="state" id ="state" class="form-control states dont-select-me"  onchange="selectCity(this.value)"  tabindex='5' required></select> 

                            </div>

                        </div>



                         <div class="form-group row">

                            <label for="state" class="col-sm-3 col-form-label"><?php echo display('city') ?> <i class="text-danger">*</i></label>

                            <div class="col-sm-6">

                                 <select name ="city" id ="city" class="form-control cities dont-select-me"  tabindex='6' required></select> 

                            </div>

                        </div>

						<div class="form-group row">

                            <label for="zip" class="col-sm-3 col-form-label"><?php echo display('zip') ?><i class="text-danger">* eg. 12345-1234</i></label>

                            <div class="col-sm-6">

                                <input class="form-control" name="zip" id="zip" type="text"  placeholder="<?php echo display('zip') ?>" tabindex='7' required>
                                <span id="errs" style="color:red;"></span>
                            </div>

                        </div>
						
						
                        <div class="form-group row">

                            <label for="address " class="col-sm-3 col-form-label"><?php echo display('customer_address') ?><i class="text-danger">* </i></label>

                            <div class="col-sm-6">

                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('customer_address') ?>" tabindex='8' required></textarea>
								<span style="float:right;right:-20px;top:-30px;" onclick= "return addMulipleAddress()" id="addCustomerTo" class="glyphicon glyphicon-plus plusicon"></span>
                            </div>

                        </div>
						<div id="addmultipleaddress">
							
						</div>
						
						<div class="form-group row">

                            <label for="address " class="col-sm-3 col-form-label"><?php echo 'Customer Detail' ?></label>

                            <div class="col-sm-6">

                                <textarea class="form-control" name="customer_detail" id="customer_detail " rows="3" placeholder="<?php echo 'Customer Detail' ?>" tabindex='9' ></textarea>

                            </div>

                        </div>
						
						
                       <!-- <div class="form-group row">

                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('previous_balance') ?></label>

                            <div class="col-sm-6">

                                <input class="form-control" name="previous_balance" id="previous_balance" type="number" placeholder="<?php echo display('previous_balance') ?>" tabindex='5'>

                            </div>

                        </div> --->



                        



                        <div class="form-group row">

                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>

                            <div class="col-sm-6">

                                <input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-customer" value="<?php echo display('save') ?>"  tabindex='10'/>

								<input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-customer-another" class="btn btn-large btn-success" id="add-customer-another" tabindex='11'>

                            </div>
							<div class="col-sm-3">
								<div class="errorhandler"></div>
							</div>
                        </div>

                    </div>

                    <?php echo form_close()?>

                </div>

            </div>

        </div>

    </section>

</div>

<!-- Add new customer end -->



<!--<script src="//geodata.solutions/includes/countrystatecity.js"></script>-->



<script language="javascript">

var point = 1;


function ajaxCall() {

    this.send = function(data, url, method, success, type) {

        type = type||'json';

        var successRes = function(data) {

            success(data);

        }



        var errorRes = function(e) {

            console.log(e);

            //alert("Error found \nError Code: "+e.status+" \nError Message: "+e.statusText);

            //jQuery('#loader').modal('hide');

        }

        jQuery.ajax({

            url: url,

            type: method,

            data: data,

            success: successRes,

            error: errorRes,

            dataType: type,

            timeout: 60000

        });



    }



}





var call = new ajaxCall();

var rootUrl = '<?php echo base_url()?>';

var url = rootUrl+'/assets/json/countries.json';

        var method = "post";

        var data = {};

        call.send(data, url, method, function(data) {

            if(data){

                console.log(data);

                //    alert(data);



                var selectHTML = "";

               selectHTML="<option value=''>Select Country</option>";
                for(i = 0; i < data.countries.length; i = i + 1) {

                    selectHTML += "<option value='" + data.countries[i].id + "'>" + data.countries[i].name + "</option>";

                }

                document.getElementById("country").innerHTML = selectHTML;
                document.getElementById("country1").innerHTML = selectHTML;
               
            }

            else{

                //   alert('No data');

            }

        });

  function selectState(countryId){    

    var url = rootUrl+'/assets/json/states.json';

        var method = "post";

        var data = {};

        call.send(data, url, method, function(data) {

            if(data){

                console.log(data);

                //    alert(data);



                var selectHTML = "";

                selectHTML="";

                for(i = 0; i < data.states.length; i = i + 1) {

                    if(data.states[i].country_id == countryId){

                        selectHTML += "<option value='" + data.states[i].id + "'>" + data.states[i].name + "</option>";

                    }

                }

                document.getElementById("state").innerHTML = selectHTML;

            }

            else{

                //   alert('No data');

            }

        });

}

function selectState1(countryId){    

var url = rootUrl+'/assets/json/states.json';

    var method = "post";

    var data = {};

    call.send(data, url, method, function(data) {

        if(data){

            console.log(data);

            //    alert(data);



            var selectHTML = "";

            selectHTML="";

            for(i = 0; i < data.states.length; i = i + 1) {

                if(data.states[i].country_id == countryId){

                    selectHTML += "<option value='" + data.states[i].id + "'>" + data.states[i].name + "</option>";

                }

            }

            document.getElementById("state1").innerHTML = selectHTML;

        }

        else{

            //   alert('No data');

        }

    });

}


function selectState2(countryId){    

var url = rootUrl+'/assets/json/states.json';

    var method = "post";

    var data = {};

    call.send(data, url, method, function(data) {

        if(data){

            console.log(data);

            //    alert(data);



            var selectHTML = "";

            selectHTML="";

            for(i = 0; i < data.states.length; i = i + 1) {

                if(data.states[i].country_id == countryId){

                    selectHTML += "<option value='" + data.states[i].id + "'>" + data.states[i].name + "</option>";

                }

            }

            document.getElementById("state"+point).innerHTML = selectHTML;

        }

        else{

            //   alert('No data');

        }

    });

}
// function selectState(countryId){    
//     // http://wholesale.plumkit.com
//     var url = rootUrl+'/api/services.php?action=getStates';

//         var method = "post";

//         var data = {};

//         var maindata = {};

//         maindata.apikey = "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R";

//         var innerdata = {};

//         innerdata.country_id = countryId;

//         maindata.data = innerdata;

//         console.log(maindata);



//          $.ajax({

//             url: url,

//             type: 'post',

//             dataType: 'json',

//             contentType: 'application/json',

//             success: function (data) {

//                 console.log("test etsfsd");

//                 console.log(data.data.data);

//                  var selectHTML = "";

//                 selectHTML="<option value=''>Select State</option>";

//                 for(i = 0; i < data.data.data.length; i = i + 1) {

//                     if(data.data.data[i].country_id == countryId){

//                         selectHTML += "<option value='" + data.data.data[i].id + "'>" + data.data.data[i].name + "</option>";

//                     }

//                 }

//                 document.getElementById("state").innerHTML = selectHTML;
				
//             },

//             data: JSON.stringify(maindata)

//         });



        

        /*call.send(data, url, method, function(data) {

            if(data){

                console.log(data);

                //    alert(data);



                var selectHTML = "";

                selectHTML="<select>";

                for(i = 0; i < data.cities.length; i = i + 1) {

                    if(data.cities[i].state_id == countryId){

                        selectHTML += "<option value='" + data.cities[i].id + "'>" + data.cities[i].name + "</option>";

                    }

                }

                document.getElementById("city").innerHTML = selectHTML;

            }

            else{

                //   alert('No data');

            }

        },'json');*/

// }

// ***********************json select city api**********************************


// function selectCity(countryId){   
//     console.log("gjhdgshdggdhdhdhdhdh"); 
//     var url = rootUrl+'/assets/json/cities.json';
//         var method = "post";
//         var data = {};
//         call.send(data, url, method, function(data) {
//             if(data){
//                 console.log(data);
//                 //    alert(data);

//                 var selectHTML = "";
//                 selectHTML="<option value=''>Select City</option>";
//                 console.log(countryId);
//                 for(i = 0; i < data.cities.length; i = i + 1) {
//                     console.log(data.cities[i].state_id );
//                     // console.log(data.cities[i].id );
//                     // console.log("hahahah");
// 					if(data.cities[i].state_id == countryId){
//                         console.log(data.cities[i].name );
//                         selectHTML += "<option value='" + data.cities[i].id + "'>" + data.cities[i].name + "</option>";
//                     }
//                 }
//                 document.getElementById("city").innerHTML = selectHTML;
//             }
//             else{
//                 //   alert('No data');
//             }
//         });
// }

//***************************end of json api*************************************/

function selectCity(countryId){    

    var url = rootUrl+'/api/services.php?action=getCities';

        var method = "post";

        var data = {};

        var maindata = {};

        maindata.apikey = "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R";

        var innerdata = {};

        innerdata.state_id = countryId;

        maindata.data = innerdata;

        console.log(maindata);



         $.ajax({

            url: url,

            type: 'post',

            dataType: 'json',

            contentType: 'application/json',

            success: function (data) {

                console.log(data.data.data);

                 var selectHTML = "";

                selectHTML="<option value=''>Select City</option>";

                for(i = 0; i < data.data.data.length; i = i + 1) {

                    if(data.data.data[i].state_id == countryId){

                        selectHTML += "<option value='" + data.data.data[i].id + "'>" + data.data.data[i].name + "</option>";

                    }

                }

                document.getElementById("city").innerHTML = selectHTML;

            },

            data: JSON.stringify(maindata)

        });



}

function selectCity1(countryId){    
console.log("cities1");
var url = rootUrl+'/api/services.php?action=getCities';

    var method = "post";

    var data = {};

    var maindata = {};

    maindata.apikey = "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R";

    var innerdata = {};

    innerdata.state_id = countryId;

    maindata.data = innerdata;

    console.log(maindata);



     $.ajax({

        url: url,

        type: 'post',

        dataType: 'json',

        contentType: 'application/json',

        success: function (data) {

            console.log(data.data.data);

             var selectHTML = "";

            selectHTML="<option value=''>Select City</option>";

            for(i = 0; i < data.data.data.length; i = i + 1) {

                if(data.data.data[i].state_id == countryId){

                    selectHTML += "<option value='" + data.data.data[i].id + "'>" + data.data.data[i].name + "</option>";

                }

            }

            document.getElementById("city1").innerHTML = selectHTML;

        },

        data: JSON.stringify(maindata)

    });



}
function selectCity2(countryId){    
console.log("cities1");
var url = rootUrl+'/api/services.php?action=getCities';

    var method = "post";

    var data = {};

    var maindata = {};

    maindata.apikey = "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R";

    var innerdata = {};

    innerdata.state_id = countryId;

    maindata.data = innerdata;

    console.log(maindata);



     $.ajax({

        url: url,

        type: 'post',

        dataType: 'json',

        contentType: 'application/json',

        success: function (data) {

            console.log(data.data.data);

             var selectHTML = "";

            selectHTML="<option value=''>Select City</option>";

            for(i = 0; i < data.data.data.length; i = i + 1) {

                if(data.data.data[i].state_id == countryId){

                    selectHTML += "<option value='" + data.data.data[i].id + "'>" + data.data.data[i].name + "</option>";

                }

            }

            document.getElementById("city"+point).innerHTML = selectHTML;

        },

        data: JSON.stringify(maindata)

    });



}
$('#zip').keyup(function() {
    console.log("adfdasfsd");
    if($("#zip").val().length == 0){
        //do nothing
        
    }
    else{
        if($("#zip").val().length < 5 || ($("#zip").val().length > 5 && $("#zip").val().length < 10) || $("#zip").val().length > 10){
        var err = "Please enter either 5 digits or 9 digits in zip code";
        $("#errs").text(err);
        $(':input[type="submit"]').prop('disabled', true);
       
  }
  else{
    $("#errs").text('');
    $(':input[type="submit"]').prop('disabled', false);
    
  }
    }
 
});

$('#zip1').keyup(function() {
    console.log("adfdasfsd");
    if($("#zip1").val().length == 0){
        //do nothing
        
    }
    else{
        if($("#zip1").val().length < 5 || ($("#zip1").val().length > 5 && $("#zip1").val().length < 10) || $("#zip1").val().length > 10){
        var err = "Please enter either 5 digits or 9 digits in zip code";
        $("#errs1").text(err);
        $(':input[type="submit"]').prop('disabled', true);
       
  }
  else{
    $("#errs").text('');
    $(':input[type="submit"]').prop('disabled', false);
    
  }
    }
 
});
$('#zip2').keyup(function() {
    console.log("adfdasfsd");
    if($("#zip1").val().length == 0){
        //do nothing
        
    }
    else{
        if($("#zip2").val().length < 5 || ($("#zip2").val().length > 5 && $("#zip2").val().length < 10) || $("#zip2").val().length > 10){
        var err = "Please enter either 5 digits or 9 digits in zip code";
        $("#errs1").text(err);
        $(':input[type="submit"]').prop('disabled', true);
       
  }
  else{
    $("#errs").text('');
    $(':input[type="submit"]').prop('disabled', false);
    
  }
    }
 
});
 $(function () {

            $('#mobile').keydown(function (e) {
             var key = e.charCode || e.keyCode || 0;
             $text = $(this); 
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 3) {
                     $text.val($text.val() + '-');
                 }
                 if ($text.val().length === 7) {
                     $text.val($text.val() + '-');
                 }

             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
         })


            $('#zip').keydown(function (e) {
             var key = e.charCode || e.keyCode || 0;
             
             $text = $(this); 
             console.log("key", $text.val());
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 5) {
                     $text.val($text.val() + '-');
                 }
                 // if ($text.val().length === 7) {
                 //     $text.val($text.val() + '-');
                 // }

             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
         })
         $('#zip1').keydown(function (e) {
             var key = e.charCode || e.keyCode || 0;
             
             $text = $(this); 
             console.log("key", $text.val());
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 5) {
                     $text.val($text.val() + '-');
                 }
                 // if ($text.val().length === 7) {
                 //     $text.val($text.val() + '-');
                 // }

             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
         })
         $("#zip2").keydown(function (e) {
             var key = e.charCode || e.keyCode || 0;
             
             $text = $(this); 
             console.log("key", $text.val());
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 5) {
                     $text.val($text.val() + '-');
                 }
                 // if ($text.val().length === 7) {
                 //     $text.val($text.val() + '-');
                 // }

             }

             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
         })
});


function checkCustomerName(value){
		console.log(value);
		$.ajax
				({
					url: "<?php echo base_url('Ccustomer/checkCustommernames')?>",
					data: {customer_name:value},
					type: "post",
					success: function(data)
					{
						var obj = JSON.parse(data);
						if(obj.status=="false"){
							$(".errorhandler").text(obj.msg);
							$(".errorhandler").css("width","365px");
							$(".errorhandler").css("color","red");
							$("#add-customer").attr("disabled", "disabled");
							$("#add-customer-another").attr("disabled", "disabled");
							return false;
						}else{
							$(".errorhandler").text("");
							$("#add-customer").removeAttr("disabled");
							$("#add-customer-another").removeAttr("disabled");
							return true;
						}
					} 
				});
	}
	
	function addMulipleAddress(){
		$("#addmultipleaddress").append('<div  class="form-group row"><div class="col-sm-3"></div><div class="col-sm-6"><textarea class="form-control" name="address1[]" id="address " rows="3" placeholder="Customer Address" tabindex="8" required></textarea><span style="float:right;right:-20px;top:-30px;" class="glyphicon glyphicon-minus minusicon removeShipTo"></span><div></div>');
		$(".removeShipTo").click(function(){
			$(this).parent().remove();
		});
	} 

    function addMulipleShipAddress(){
        console.log("dadadadadad",point);
        
            point++;

            var call = new ajaxCall();

var rootUrl = '<?php echo base_url()?>';

var url = rootUrl+'/assets/json/countries.json';

        var method = "post";

        var data = {};

        call.send(data, url, method, function(data) {

            if(data){

                console.log(data);

                //    alert(data);



                var selectHTML = "";

               selectHTML="<option value=''>Select Country</option>";
                for(i = 0; i < data.countries.length; i = i + 1) {

                    selectHTML += "<option value='" + data.countries[i].id + "'>" + data.countries[i].name + "</option>";

                }

                document.getElementById("country"+point).innerHTML = selectHTML;
               
               
            }

            else{

                //   alert('No data');

            }

        });
        
        $("#addmultipleShipaddress").append('<div><div class="row"><label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label><div class="col-sm-3"><input class="form-control" name ="ship_to_name1[]" id="ship_to_name1" type="text" placeholder="Name"  tabindex="2"></div><div class="col-sm-3"><input class="form-control" name ="ship_to_email1[]" id="ship_to_email1" type="email" placeholder="Email"  tabindex="2"></div></div><div style="height:10px;" class="row"></div><div class="row" ><label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label><div class="col-sm-3"><input class="form-control" name ="ship_to_phone1[]" id="ship_to_phone1" type="text" maxlength="12" minlength="12" placeholder="Phone"  tabindex="2"></div><div class="col-sm-3"><input class="form-control" name ="ship_to_address1[]" id="ship_to_address1" type="text" placeholder="Address"  tabindex="2"></div></div><div style="height:10px;" class="row"></div><div class="row"><label for="" class="col-sm-3 col-form-label"><i class="text-danger"></i></label><div class="col-sm-3"><select id="country'+point+'" name ="country2[]" class="form-control countries dont-select-me" onchange="selectState2(this.value)" required tabindex="4"><option value="">Select Country</option></select></div><div class="col-sm-3"><select name ="state2[]" id ="state'+point+'" class="form-control states dont-select-me"  onchange="selectCity2(this.value)" required tabindex="5"><option value="">Select State</option></select></div></div><div style="height:10px;" class="row"></div><div class="row"><label for="" class="col-sm-3 col-form-label"> <i class="text-danger"></i></label><div class="col-sm-3"><select name ="city2[]" id ="city'+point+'" class="form-control cities dont-select-me" required tabindex="6"><option value="">Select City</option></select></div><div class="col-sm-3"><input class="form-control" name="zip2[]" id="zip2" type="text" maxlength="10" minlength="5" placeholder="zip" tabindex="7" required></div></div><span class="glyphicon glyphicon-minus minusicon removeShipMultiple"></span></div>');
        $(".removeShipMultiple").click(function(){
            console.log($(this).parents());

            $(this).parent().remove(); 
            
           
        });
    }
	
	$(document).ready(function(){
        
        $(".clickButton").click(function () {
        $("#show").toggle();
    });

		$(".removeShipTo").click(function(){
			$(this).parent().children().next().remove();
			$(this).remove();
		});

        $(".removeShipMultiple").click(function(){
            $(this).parent().children().next().remove();
			$(this).remove();
        });
	});
</script>







