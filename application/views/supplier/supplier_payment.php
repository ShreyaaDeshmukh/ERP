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
                        <?php $today = date('Y-m-d'); ?>

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

                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl'); ?></th>
                                        <th class="text-left"><?php echo display('supplier_name') ?></th>
                                        <th class="text-center"><?php echo display('date') ?></th>
                                        <th class="text-center"><?php echo display('payment') ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ledger) {
                                        ?>

                                        <?php
                                        $debit = $credit = $balance = $sl = 0;
                                        foreach ($ledger as $ledger) {
                                            $sql = 'SELECT SUM(pay_amount) as payment, date_of_transection FROM transection a '
                                                    . 'WHERE a.relation_id = "' . $ledger['supplier_id'] . '" '
                                                    . 'AND a.transection_type = 1';
//                                            echo $sql;die();
                                            $result = $this->db->query($sql)->result();
                                            $sl++;
                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>Csupplier/supplier_ledger_info/<?php echo $ledger['supplier_id']; ?>">
                                                        <?php echo $ledger['supplier_name'] ?>
                                                    </a>
                                                </td>
                                                <td align="center"><?php echo $result[0]->date_of_transection ?></td>


                                                <td align="right">
                                                    <?php
                                                    echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($result[0]->payment, '2', '.', ',');
                                                    $balance += $result[0]->payment;
                                                    ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        <?php
                                    }
                                    ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" align="right"><b><?php echo display('grand_total') ?>:</b></td>

                                        <td align="right">
                                            <b>
                                                <?php
//                                                echo (($position == 0) ? "$currency {SubTotal_credit}" : "{SubTotal_credit} $currency") 
                                                echo (($position == 0) ? "$currency " : " $currency");
                                                echo number_format(@$balance, '2', '.', ',');
                                                ?>
                                            </b>
                                        </td>

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