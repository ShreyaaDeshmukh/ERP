<!-- Supplier Sales Report Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('supplier_sales_details') ?></h1>
            <small><?php echo display('supplier_sales_details') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('supplier_sales_details') ?></li>
            </ol>
        </div>
    </section>

    <!-- Search Supplier -->
    <section class="content">
<!--        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('supplier_sales_details') ?></h4>
                        </div>
                    </div>
                      <div class="panel-body">
                    <?php echo form_open('#', array('class' => 'form-inline')) ?>
                    <?php $today = date('Y-m-d'); ?>
                                         <label class="select"><?php echo display('search_by_date') ?>: <?php echo display('from') ?></label>
                                                 <input type="text" name="from_date"  value="<?php echo $today; ?>" class="datepicker form-control"/>
                                         <label class="select"><?php echo display('to') ?></label>
                                                 <input type="text" value="<?php echo $today; ?>" name="to_date" class="datepicker form-control"/>
                                         <button type="submit" class="btn btn-success"><?php echo display('search') ?></button>
                    <?php echo form_close() ?>
                     </div> 
                </div>
            </div>
        </div>-->

        <!-- Sales Details -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('supplier_sales_details') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">


                            <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('date') ?></th>
                                        <th><?php echo display('product_name') ?></th>
                                        <th><?php echo display('cartoon') ?></th>
                                        <th><?php echo display('quantity') ?></th>
                                        <th><?php echo display('rate') ?></th>
                                        <th><?php echo display('ammount') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sales_info) {
                                        ?>
                                        {sales_info}
                                        <tr>

                                            <td>{date}</td>
                                            <td>
                                                <a href="<?php echo base_url() . 'Cproduct/product_details/{product_id}'; ?>">
                                                    {product_name} - {product_model}
                                                </a>
                                            </td>
                                            <td align="right">{cartoon}</td>
                                            <td align="right">{quantity}</td>
                                            <td style="text-align:right !Important"><?php echo (($position == 0) ? "$currency {supplier_rate}" : "{supplier_rate} $currency") ?></td>
                                            <td style="text-align:right !Important"><?php echo (($position == 0) ? "$currency {total}" : "{total} $currency") ?></td>

                                        </tr>
                                        {/sales_info}
                                        <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td>
                                            <b><?php echo display('grand_total') ?></b> :
                                        </td>
                                        <td style="text-align:right"><b>
                                                <?php echo (($position == 0) ? "$currency {sub_total}" : "{sub_total} $currency") ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="text-right"><?php echo $links ?></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Supplier Sales Details End -->