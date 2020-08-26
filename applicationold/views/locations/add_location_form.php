<!-- Add User start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_location') ?></h1>
            <small><?php echo display('add_new_location_information') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('add_location') ?></li>
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

        <!-- New user -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_location') ?> </h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('Clocation/insert_location', array('class' => 'form-vertical',)) ?>
                    <div class="panel-body">
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Building<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="building_id" name="building_id" required="" onchange="selectAisleLocation(this.value);" required>
                                <option value=""><?php echo display('select_one') ?></option>
                                <?php
                                    if ($building_list) {
										foreach($building_list as $building):
                                ?>
                                
                                    <option value="<?php echo $building['id']."###".$building['building_name']?>"><?php echo $building['building_name']?></option>
                               
                                <?php
                                    endforeach;
									}
                                ?>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Aisle Location<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="aisle_id" name="aisle_id" required="" onchange="selectSlotLocation(this.value);" required>
									<option value=""><?php echo display('select_one') ?></option>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Slot<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="slot_id" name="slot_id" required="" onchange="selectLevelLocation(this.value);" required>
									<option value=""><?php echo display('select_one') ?></option>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Level<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="level_id" name="level_id" required="" onchange="selectBinLocation(this.value);" required>
									<option value=""><?php echo display('select_one') ?></option>
                                </select>
                            </div>
                        </div>
						
						<div class="form-group row">
                            <label for="category_id" class="col-sm-3 col-form-label">Bin<i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <select class="form-control dont-select-me" id="bin_id" name="bin_id" required="" onchange="finalLocationValue(this.value);" required>
									<option value=""><?php echo display('select_one') ?></option>
                                </select>
                            </div>
                        </div>
						
						
                        <div class="form-group row">
                            <label for="location_name" class="col-sm-3 col-form-label"><?php echo display('location_name') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="location_name" id="location_name" placeholder="<?php echo display('location_name') ?>" required readonly="true"/>
                            </div>
                        </div>



                        
                

                        
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-location" class="btn btn-primary btn-large" name="add-location" value="<?php echo display('save') ?>"  />

                                <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-location-another" class="btn btn-success" id="add-location-another">
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
var locationvalue = {};
function selectAisleLocation(building_id){
	var buildarr = building_id.split("###");
	console.log(buildarr);
	locationvalue.building = buildarr;
	$.ajax({
		type: 'POST',
		data: {building_id:building_id},
		url:  'Clocation/getAisleLocation',
		success: function (data) {
			console.log(data);
			var result = JSON.parse(data);
			if (result.status == "false") {
				swal("Something went wrong!");
				return false;
			}
			else {
				var location = result.aisle_location;
				var html  = '<option>Select Aisle</option>';
				for(var i =0; i<location.length;i++){
					html += '<option value='+location[i].id+'###'+location[i].location_name+'>'+location[i].location_name+'</option>';
				}
				$("#aisle_id").html(html);
				$("#location_name").val('');
			}
		},
		error: function (xhr) {
			console.log(xhr);
		}
	});
}

function selectSlotLocation(aisle_id){
	var buildarr = aisle_id.split("###");
	console.log(buildarr);
	locationvalue.aisle = buildarr;
	$.ajax({
		type: 'POST',
		data: {aisle_id:aisle_id},
		url:  'Clocation/getSlotLocation',
		success: function (data) {
			console.log(data);
			var result = JSON.parse(data);
			if (result.status == "false") {
				swal("Something went wrong!");
				return false;
			}
			else {
				var location = result.slot_location;
				var html  = '<option>Select Slot</option>';
				for(var i =0; i<location.length;i++){
					html += '<option value='+location[i].id+'###'+location[i].slot_name+'>'+location[i].slot_name+'</option>';
				}
				$("#slot_id").html(html);
				$("#location_name").val('');
			}
		},
		error: function (xhr) {
			console.log(xhr);
		}
	});
}
function selectLevelLocation(slot_id){
	var buildarr = slot_id.split("###");
	locationvalue.slot = buildarr;
	$.ajax({
		type: 'POST',
		data: {slot_id:slot_id},
		url:  'Clocation/getLevelLocation',
		success: function (data) {
			console.log(data);
			var result = JSON.parse(data);
			if (result.status == "false") {
				swal("Something went wrong!");
				return false;
			}
			else {
				var location = result.level_location;
				var html  = '<option>Select Level</option>';
				for(var i =0; i<location.length;i++){
					html += '<option value='+location[i].id+'###'+location[i].level_name+'>'+location[i].level_name+'</option>';
				}
				$("#level_id").html(html);
				$("#location_name").val('');
			}
		},
		error: function (xhr) {
			console.log(xhr);
		}
	});
}

function selectBinLocation(level_id){
	var buildarr = level_id.split("###");
	locationvalue.level = buildarr;
	$.ajax({
		type: 'POST',
		data: {level_id:level_id},
		url:  'Clocation/getBinLocation',
		success: function (data) {
			console.log(data);
			var result = JSON.parse(data);
			if (result.status == "false") {
				swal("Something went wrong!");
				return false;
			}
			else {
				var location = result.bin_location;
				var html  = '<option>Select Bin</option>';
				for(var i =0; i<location.length;i++){
					html += '<option value='+location[i].id+'###'+location[i].bin_name+'>'+location[i].bin_name+'</option>';
				}
				$("#bin_id").html(html);
				$("#location_name").val('');
			}
		},
		error: function (xhr) {
			console.log(xhr);
		}
	});
}

function finalLocationValue(bin_id){
	var buildarr = bin_id.split("###");
	locationvalue.bin = buildarr;
	
	console.log(locationvalue);
	var finallocation = '';
	$.each(locationvalue, function(key, val){
		console.log(key);
		console.log(val);
		if(key=="building"){
			finallocation += val[1];//"BU"+val+" "; 
		}else if(key=="aisle"){
			finallocation += val[1];//"A"+val+" "; 
		}else if(key=="slot"){
			finallocation += val[1];//"SL"+val+" "; 
		}else if(key=="level"){
			finallocation += val[1];//"L"+val+" "; 
		}else if(key=="bin"){
			finallocation += val[1];//"B"+val+" "; 
		}
	});
	console.log(finallocation);
	$("#location_name").val(finallocation);
}

</script>
<!-- Edit user end -->



