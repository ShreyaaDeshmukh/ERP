<!-- Manage Product Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1>Inventory</h1>
            <small>List of all inventories</small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <!--li><a href="#">Inventory</a></li-->
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

        <!-- <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body"> 

                        <form action="<?php echo base_url('Cinventory/product_by_search') ?>" class="form-inline" method="post" accept-charset="utf-8">

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
        </div> -->

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
                                        <th><?php echo display('image') ?>s</th>
                                        <th><?php echo display('product_id') ?></th>
                                        <th><?php echo display('product_name') ?></th>
                                        <!--th><?php echo display('product_model') ?></th-->
                                       <!-- <th><?php echo display('cartoon_quantity') ?></th>-->
                                        <th><?php echo display('supplier_name') ?></th>
                                        <!--th><?php echo display('sell_price') ?></th>
                                        <th><?php echo display('supplier_price') ?></th-->
                                        <th>Incoming Stock</th>
                                        <th>Outgoing Stock</th>
                                        <th><?php echo display('stock') ?></th>
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

                                            <td class="text-center">
                                                <img src="{image}" class="img img-responsive" height="50" width="50">
                                            </td>

                                            <td>
                                                
                                                    {product_id}
                                                     
                                            </td>
                                            <td>
                                                
                                                    {product_name}
                                               		
                                            </td>
                                            <!--td>{product_model} </td-->
                                            <!--<td>{cartoon_quantity}</td>-->
                                            <td>{supplier_name}</td>
                                            <!--td style="text-align: right;">
                                                <?php echo (($position == 0) ? "$currency {price}" : "{price} $currency") ?>
                                            </td>
                                            <td style="text-align: right;">
                                                <?php echo (($position == 0) ? "$currency {supplier_price}" : "{supplier_price} $currency") ?>
                                            </td-->

                                            <td style="text-align: right;">
                                                {PostiveTotal} Each
                                            </td>
                                            <td style="text-align: right;">
                                                {NegativeTotal} Each
                                            </td>
                                            <td style="text-align: right;">
                                                {total_quantity} Each
                                            </td>
                                            
                                            <td>
                                    <center>
                                        <?php echo form_open() ?>

                                        <!--a href="<?php echo base_url() . 'Cqrcode/qrgenerator/{product_id}'; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('qr_code') ?>"><i class="fa fa-qrcode" aria-hidden="true"></i></a>

                                        <a href="<?php echo base_url() . 'Cbarcode/barcode_print/{product_id}'; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('barcode') ?>"><i class="fa fa-barcode" aria-hidden="true"></i></a-->

                                        <a href="<?php echo base_url() . 'Cinventory/product_update_form/{product_id}'; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('view') ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>


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
                            <!-- <div class="text-right"><?php if ($links) {
                                    echo $links;
                                } ?></div> -->
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
    $(".deleteProduct").click(function ()
    {
        var product_id = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are you sure you want to delete? ");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Cinventory/product_delete') ?>',
                        data: {product_id: product_id, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {
                            // alert(datas);
                            // location.reload();
                        }
                    });
        }else{
			return false;
		}
    });
</script>