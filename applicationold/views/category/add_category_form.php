<!-- Add new customer start -->
<?php $r_id = $this->session->r_id;?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('add_category') ?></h1>
            <small><?php echo display('add_new_category') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('category') ?></a></li>
                <li class="active"><?php echo display('add_category') ?></li>
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

        <!-- New customer -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('add_category') ?> </h4>
                        </div>
                    </div>
                  <?php echo form_open('Ccategory/insert_category', array('class' => 'form-vertical','id' => 'insert_category', 'onsubmit'=> 'return checkvalidation();'))?>
                    <div class="panel-body">

                    	<div class="form-group row">
                            <label for="category_name" class="col-sm-3 col-form-label"><?php echo display('category_name')?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="category_name" id="category_name" type="text" placeholder="<?php echo display('category_name') ?>"  required="" tabindex='1'>
                            </div>
							<div id="error_handler" style="display:none;color:red;"></div>
                        </div>
                
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-customer" class="btn btn-success btn-large" name="add-customer" value="<?php echo display('save') ?>"  tabindex='2'/>
								
								 <input type="submit" value="<?php echo display('save_and_add_another') ?>" name="add-customer-another" class="btn btn-large btn-success" id="add-customer-another" tabindex="3">
								 
								 <a href="<?php echo base_url()."Ccategory/manage_category"; ?>"><input type="button" value="Cancel" class="btn btn-large btn-danger" id="calcelRecieving" tabindex="4" ></a>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close()?>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function checkvalidation(){
	console.log("tesat ets asdaffd");
	var category_name = $("#category_name").val();
	var url = "Ccategory/checkCategoryname";
	$.ajax({

            url: url,

            type: 'post',

            success: function (data) {
				if(data=="1"){
					$("#error_handler").text("This category name already exist, please try another");
					return false;
				}else{
					return true;
				}
            },

            data: {category_name:category_name}

        });
}

</script>
<!-- Add new customer end -->




