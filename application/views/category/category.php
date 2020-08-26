<!-- Manage Category Start -->
<?php $r_id = $this->session->r_id;  ?>
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('manage_category') ?></h1>
	        <small><?php echo display('manage_your_category') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('category') ?></a></li>
	            <li class="active"><?php echo display('manage_category') ?></li>
	        </ol>
	    </div>
	</section>

	<section class="content">

		<!-- Alert Message -->

		 <div id= "hideToast" style="display: none;" class="alert alert-danger alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	           	This Category is already assigned to products, you can not delete it.                
	    </div>

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
						<form style="float:left;" action="<?php echo base_url('Ccategory/category_by_search') ?>" class="form-inline" method="post" accept-charset="utf-8">
<!-- 
                            <label class="select"><?php echo display('category') ?>:</label>
							<select class="form-control" name="product_id" onchange="this.form.submit();">
                                <option value="">Select Product</option>
								<?php foreach($category_list_product as $category):?>
                                <option <?php if(@$_POST['product_id']==$category['category_id']){?> selected="selected" <?php }?> value="<?php echo $category['category_id']?>"><?php echo $category['category_name']?></option>
                                <?php endforeach;?>
                            </select>

                            <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button> -->

                        </form>	
                        <a style="float:right;"href="<?php echo base_url('Ccategory')?>"><input type="button" id="add-category" class="btn btn-success btn-large" name="add-category" value="Add Category"></a>	            
                    </div>
                </div>
            </div>
        </div>
		<!-- Manage Category -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('manage_category') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th class="text-center"><?php echo display('sl') ?></th>
										<th class="text-center"><?php echo display('category_name') ?></th>
										<th class="text-center"><?php echo display('status') ?></th>
										<th class="text-center"><?php echo display('action') ?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($category_list) {
								?>
								<?php foreach($category_list as $category){?>
									<tr>
										<td class="text-center"><?php echo $category['sl']?></td>
										<td class="text-center"><?php echo $category['category_name']?></td>
										<td class="text-center">
										<?php  echo ($category['status']==1?"Active":"Inactive");?>
										</td>
										<td>
											<center>
											<?php echo form_open()?>
												<a href="<?php echo base_url().'Ccategory/category_update_form/'.$r_id.'/'.$category['category_id'] ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a class="DeleteCategory btn btn-danger btn-sm" name="<?php echo $category['category_id'];?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
											<?php echo form_close()?>
											</center>
										</td>
									</tr>
								
								<?php
								}	}
								?>
								</tbody>
		                    </table>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</section>
</div>
<!-- Manage Category End -->

<!-- Delete Category ajax code -->
<script type="text/javascript">
	//Delete Category 


	$(".DeleteCategory").click(function()
	{	
		var category_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("Are you sure you want to delete? ");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Ccategory/category_delete')?>',
				data: {category_id:category_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
					console.log(datas);
					if(datas == true || datas == 1){
						window.location.reload();
					}else{
						//alert("This Category is already assigned to products, you can not delete it.");
						$("#hideToast").css("display","block");
					}
					//window.location.reload();
				} 
			});
		}else{
			return false;
		}
	});
</script>



