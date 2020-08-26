<!-- Add new supplier start -->
<?php $r_id = $this->session->r_id; 
print_r($r_id); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_supplier') ?></h1>
            <small><?php echo display('add_new_supplier') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('add_supplier') ?></li>
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

        <!-- New supplier -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_supplier') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Csupplier/insert_supplier/'.$r_id, array('id' => 'insert_supplier')) ?>
                    <div class="panel-body">

                        <div class="form-group row">
                            <label for="supplier_name" class="col-sm-3 col-form-label"><?php echo display('supplier_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="supplier_name" id="supplier_name" type="text" placeholder="<?php echo display('supplier_name') ?>"  required="" tabindex="1">
                            </div>
                        </div>

                       	<div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('supplier_mobile') ?> <i class="text-danger">* eg. 111-111-2222</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="mobile" id="mobile" type="text" maxlength="12" placeholder="<?php echo display('supplier_mobile') ?>" required="" minlength="12" tabindex="2" required>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label"><?php echo display('email') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="email" id="email" type="email" placeholder="<?php echo display('email') ?>" tabindex="3" required="" >
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('country') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                 <select id="country" name ="country" class="form-control countries dont-select-me" onchange="selectState(this.value)" required tabindex="4" required></select> 
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('state') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                 <select name ="state" id ="state" class="form-control states dont-select-me"  onchange="selectCity(this.value)" required tabindex="5"></select> 
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('city') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                 <select name ="city" id ="city" class="form-control cities dont-select-me" required tabindex="6"></select> 
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="previous_balance" class="col-sm-3 col-form-label"><?php echo display('zip') ?><i class="text-danger">* eg. 12345-1234</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="zip" id="zip" type="text" maxlength="10" minlength="5" placeholder="<?php echo display('zip') ?>" tabindex='7' required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address " class="col-sm-3 col-form-label"><?php echo display('supplier_address') ?><i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="address" id="address " rows="3" placeholder="<?php echo display('supplier_address') ?>" tabindex="8" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"><?php echo display('supplier_details') ?></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="details" id="details" rows="3" placeholder="<?php echo display('supplier_details') ?>" tabindex="9"></textarea>
                            </div>
                        </div>
                        <!--<div class="form-group row">
                            <label for="details" class="col-sm-3 col-form-label"><?php echo display('previous_balance'); ?></label>
                            <div class="col-sm-6">
                                <input class="form-control" name="previous_balance" placeholder="Previous Balance" tabindex="5" type="number">
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-supplier" class="btn btn-primary btn-large" name="add-supplier" value="<?php echo display('save') ?>"  tabindex="10"/>
                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-supplier-another" class="btn btn-large btn-success" id="add-supplier-another" tabindex="11">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Add new supplier end -->

<script language="javascript">
   
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
            }
            else{
                //   alert('No data');
            }
        });
function selectState(countryId){   
    console.log("gjhdgshdggdhdhdhdhdh"); 
    var url = rootUrl+'/assets/json/states.json';
        var method = "post";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data){
                console.log(data);
                //    alert(data);

                var selectHTML = "";
                selectHTML="<option value=''>Select State</option>";
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


function selectCity(countryId){   
    console.log("gjhdgshdggdhdhdhdhdh"); 
    var url = rootUrl+'/assets/json/cities.json';
        var method = "post";
        var data = {};
        call.send(data, url, method, function(data) {
            if(data){
                console.log(data);
                //    alert(data);

                var selectHTML = "";
                selectHTML="<option value=''>Select City</option>";
                
                for(i = 0; i < data.cities.length; i = i + 1) {
                    console.log(data.cities[i].id );
					if(data.cities[i].state_id == countryId){
                        selectHTML += "<option value='" + data.cities[i].id + "'>" + data.cities[i].name + "</option>";
                    }
                }
                document.getElementById("city").innerHTML = selectHTML;
            }
            else{
                //   alert('No data');
            }
        });
}





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



function selectCity(countryId){

    var rootUrl = '<?php echo base_url()?>';
    console.log(rootUrl);


    console.log("haha");  
    var url = rootUrl+'/api/services.php?action=getCities';
    // var url = rootUrl+'/assets/json/cities.json';
        var method = "post";
        var data = {};
        var maindata = {};
        maindata.apikey = "KhOSpc4cf67AkbRpq1hkq5O3LPlwU9IAtILaL27EPMlYr27zipbNCsQaeXkSeK3R";
        var innerdata = {};
        innerdata.state_id = countryId;
        maindata.data = innerdata;
        console.log(maindata);
        console.log("kesa hai");

         $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            contentType: 'application/json',
            success: function (data) {
                console.log(data.data.data);
                console.log("tayyab");
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

         return false;
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
}
 </script>
