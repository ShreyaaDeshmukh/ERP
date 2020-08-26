

<!-- Manage Product Start -->
<?php $r_id = $this->session->r_id; ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_product') ?></h1>
            <small><?php echo display('manage_your_product') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('product') ?></a></li>
                <li class="active"><?php echo display('manage_product') ?></li>
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
		<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 
						<form style="float:left;" action="<?php echo base_url('Cproduct/product_by_search/'.$r_id) ?>" class="form-inline" method="post" accept-charset="utf-8">

                            <label class="select"><?php echo display('product_name') ?>:</label>

                            <!-- <select  id="product_sss" class="form-control" name="product_id">
                                <option   value="0" >Select Product</option>
								{all_product_list}
                                <option id ="product" value="{product_id}" selected >{product_name}</option>

                                {/all_product_list}
                            </select> -->


                       <select style="margin-bottom: 10px;" name="product_id" id="product_sss" class="form-control dont-select-me"> 
						<option value=""><?php echo "Search By Product" ?></option>
						<?php foreach($products_list as $allproduct):?>
						<option <?php if(@$_POST['product_id']==$allproduct['product_id']){?> selected="selected "<?php }?> value="<?php echo $allproduct['product_id']?>"><?php echo $allproduct['product_name']?></option>
						<?php endforeach;?>
					    </select>
			

                            <button style="margin-bottom: 10px;" type="submit"  class="btn btn-primary"><?php echo display('search') ?></button>
                            <button style="text-align: right; margin-bottom: 10px; " class="btn btn-danger" type="reset" value="Reset" onclick="resetForm();"><?php echo display('reset')?></button>
                           
                        </form>	
                        <a style="float:right;"href="<?php echo base_url('Cproduct')?>"><input type="button" id="add-product" class="btn btn-success btn-large" name="add-Product" value="Add Product"></a>	            
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 

                        <form action="<?php echo base_url('Cproduct/product_by_search') ?>" class="form-inline" method="post" accept-charset="utf-8">

                            <label class="select"><?php echo display('product_name') ?>:</label>

                            <select class="form-control" name="product_id">
                                <option value="">Select Product</option>
								{all_product_list}
                                <option value="{product_id}">{product_name}-({product_model})</option>
                                {/all_product_list}
                            </select>

                            <button type="submit" class="btn btn-primary"><?php echo display('search') ?></button>

                        </form>		            
                    </div>
                </div>
            </div>
        </div>-->
		
        <!-- Manage Product report -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_product') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <!-- <th><?php echo 'Product Id' ?></th> -->
                                        <th><?php echo display('product_name') ?></th>
                                        <th>Product Description</th>
                                        <!--<th><?php echo display('product_model') ?></th>-->
                                       <!-- <th><?php echo display('cartoon_quantity') ?></th>-->
                                        <th><?php echo display('supplier_name') ?></th>
                                        <!--<th><?php echo display('sell_price') ?></th>
                                        <th><?php echo display('supplier_price') ?></th>-->
                                        <th><?php echo display('image') ?>s</th>
                                        <th style="width : 130px"><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($products_list) {
                                        
                                     
?>
                                        {products_list}
                                        <tr>
                                            <td>{sl}</td>
                                            <!-- <td>{product_id}</td> -->
                                            <td>
                                              
                                                
                                                    {product_name}
                                                </a>			
                                            </td>
                                            <td >
                                               
                                                     {product_details}
                                                    
                                                </a>			
                                            </td>

                                            <!--<td><a href="<?php echo base_url() . 'Cproduct/product_details/{product_id}'; ?>">{product_model} </a></td>-->
                                            <!--<td>{cartoon_quantity}</td>-->
                                            <td>{supplier_name}</td>
                                            <!--<td style="text-align: right;">
                                                <?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php echo (($position == 0) ? "$currency {supplier_price}" : "{supplier_price} $currency") ?>
                                            </td>-->
                                            <td class="text-center">
                                                <img src="{image}" class="img img-responsive" height="50" width="50">
                                            </td>
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>

                                        <a href="<?php echo base_url() . 'Cproduct/product_update_form/{product_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                        <a class="deleteProduct btn btn-danger btn-sm" name="{product_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                        <?php echo form_close() ?>
                                    </center>
                                    </td>
                                    </tr>
                                    {/products_list}
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <div class="text-right"><?php if ($links) {
                                   // echo $links;
                                } ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Manage Product End -->

<!-- Delete Product ajax code -->
<script type="text/javascript">
  var r_id = '<?php echo $r_id; ?>';
  console.log(r_id);
function resetForm(){
    $("#product_sss")[0].selectedIndex = 0;
   
    // window.location.href ="http://plumkit.com/wholesaleLicences/Cproduct/manage_product/"+r_id
	window.location.href = '<?php echo base_url('Cproduct/manage_product/')?>'+r_id 
}


    $(".deleteProduct").click(function ()
    {
        var product_id = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are you sure you want to delete? ");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Cproduct/product_delete') ?>',
                        data: {product_id: product_id, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {
							//console.log(datas);
							//return false;
                            // alert(datas);
                            // location.reload();
								window.location.reload();
                        }
                    });
        }else{
			return false;
		}
    });
</script>