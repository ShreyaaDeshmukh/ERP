<!-- Supplier Ledger Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('supplier_payment') ?></h1>

            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('supplier_payment') ?></li>
            </ol>
        </div>
    </section>

    <!-- Supplier information -->
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
                        <?php echo form_open('Csupplier/supplier_payment_report/', array('class' => 'form-inline',)) ?>
                        <?php $today = date('d-m-Y'); ?>
                        <div class="row">
                            <div class="form-group">
                                <label  class="col-sm-3">Supplier</label>
                                <div class="col-sm-2">
                                    <select name="supplier_id"  class="form-control">
                                        <option value=""><?php echo display('select_supplier') ?></option>
                                        <?php
                                        if ($supplier) {
                                            ?>
                                            {supplier}
                                            <option value="{supplier_id}">{supplier_name} 
                                            </option>
                                            {/supplier}
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2"><?php echo display('from') ?></label>
                                <div class="col-sm-1">
                                    <input type="text" name="from_date"  value="" class="datepicker form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-sm-2 control-label"><?php echo display('to') ?></label>
                                <div class="col-sm-1">
                                    <input type="text" name="to_date" value="" class="datepicker form-control"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search-plus" aria-hidden="true"></i>
                                        <?php echo display('generate') ?></button>
                                </div>
                            </div>
                        </div>  




                        <?php echo form_close() ?>            
                    </div>
                </div>
            </div>
        </div>

        <!-- Supplier ledger -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('supplier_payment') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">

                            <div class="text-center">
                                <h4>{supplier_name}</h4>
                                <h5><?php echo display('address') ?>:{address}</h5>

                            </div>


                            <table  id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('date') ?></th>
                                        <th class="text-center"><?php echo display('description') ?></th>
                                        <th class="text-center"><?php echo display('deposite_id') ?></th>
                                        <th class="text-center"><?php echo display('credit') ?></th>
                                    </tr>
<!--                                    <tr>
                                        <td  colspan="3" align="center"><?php echo display('previous_balance') ?></td><td align="right"><?php
                                            echo (($position == 0) ? "$currency " : " $currency");
                                            echo number_format($prviousbalance, 2, '.', ',');
                                            ?></td>
                                    </tr>-->
                                </thead>
                                <tbody>


                                    <?php
                                    if ($ledger) {
                                        ?>

                                        <?php foreach ($ledger as $ledger) {
                                            ?>
                                            <tr>
                                                <td><?php echo $ledger['date_of_transection'] ?></td>
                                                <td><?php echo $ledger['description'] ?></td>


                                                <td><?php echo $ledger['deposit_no'] ?></td>
                                                <td align="right"><?php
                                                    if (!empty($ledger['total_taka']))
                                                        echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($ledger['total_taka'], 2, '.', ',');
                                                    ?></td>

                                            </tr>
                                        <?php } ?>
                                        <?php
                                    }
                                    ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" align="right"><b><?php echo display('grand_total') ?>:</b></td>

                                        <td align="right"><b><?php echo (($position == 0) ? "$currency {SubTotal_credit}" : "{SubTotal_credit} $currency") ?></b></td>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Supplier Ledger End  -->
<script type="text/javascript">
    $('#purpose').on('change', function () {
        var x = 0;
        if (this.value > x) {
            $("#datebetween").show();
        } else {
            $("#datebetween").hide();
        }


    });



</script>