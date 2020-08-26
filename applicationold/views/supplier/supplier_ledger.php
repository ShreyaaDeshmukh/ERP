<!-- Supplier Ledger Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('supplier_ledger') ?></h1>
            <small><?php echo display('manage_supplier_ledger') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('supplier') ?></a></li>
                <li class="active"><?php echo display('supplier_ledger') ?></li>
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
                        <?php echo form_open('Csupplier/supplier_ledger/', array('class' => 'form-inline',)) ?>
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
                            <h4><?php echo display('supplier_ledger') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">

                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('sl') ?></th>
                                        <th class="text-center"><?php echo display('supplier_name') ?></th>
                                        <th class="text-center"><?php echo display('total_debit') ?></th>
                                        <th class="text-center"><?php echo display('total_credit') ?></th>
                                        <th class="text-center"><?php echo display('total_balance') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($ledgers) {
                                        $sl = 0;
                                        $debit = $credit = $balance = 0;
                                        foreach ($ledgers as $ledger) {
                                            $sql = 'SELECT (SELECT SUM(amount) FROM supplier_ledger sl '
                                                    . 'WHERE sl.supplier_id = "' . @$ledger['supplier_id'] . '" '
                                                    . 'AND d_c = "d") debit, (SELECT SUM(amount) '
                                                    . 'FROM supplier_ledger sl WHERE sl.supplier_id = "' . @$ledger['supplier_id'] . '" '
                                                    . 'AND d_c = "c") credit';
                                            $result = $this->db->query($sql)->result();
                                            $sl++;
                                            ?>
                                            <tr>
                                                <td><?php echo $sl; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'Csupplier/supplier_ledger_info/' . $ledger['supplier_id']; ?>">
                                                        <?php echo $ledger['supplier_name']; ?>
                                                    </a>
                                                    <?php // echo $ledger['supplier_name']; ?></td>
                                                <td align="right">
                                                    <?php
                                                    echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($result[0]->debit,'2','.',',');
                                                    $debit += $result[0]->debit;
//                                                    if ($ledger['d_c'] == 'd') {
//                                                        echo (($position == 0) ? "$currency " : " $currency");
//                                                        echo number_format($ledger['amount'], 2, '.', ',');
//                                                        $debit += $ledger['amount'];
////                                                         $d = 12;
//                                                    } else {
//                                                        $debit += '0.00';
//                                                    }
                                                    ?>
                                                </td>
                                                <td align="right">
                                                    <?php
                                                    echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($result[0]->credit,'2','.',',');
                                                    $credit += $result[0]->credit;
//                                                    if ($ledger['d_c'] == 'c') {
//                                                        echo (($position == 0) ? "$currency " : " $currency");
//                                                        echo number_format($ledger['amount'], 2, '.', ',');
//                                                        $credit += $ledger['amount'];
//                                                    } else {
//                                                        $credit += '0.00';
//                                                    }
                                                    ?>
                                                </td>
                                                <td align='right'>
                                                    <?php
                                                    $balance = $debit - $credit;
                                                    echo (($position == 0) ? "$currency " : " $currency");
                                                    echo number_format($balance, 2, '.', ',');
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td align="right"><b><?php
                                                echo (($position == 0) ? "$currency " : "$currency");
                                                echo number_format((@$debit), 2, '.', ',');
                                                ?></b></td>
                                        <td align="right"><b><?php
                                                echo (($position == 0) ? "$currency " : "$currency");
                                                echo number_format((@$credit), 2, '.', ',');
                                                ?></b></td>
                                        <td align="right"><b><?php
                                                echo (($position == 0) ? "$currency " : "$currency");
                                                echo number_format((@$balance), 2, '.', ',');
                                                ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>


<!--                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('date') ?></th>
                                        <th class="text-center"><?php echo display('description') ?></th>
                                        <th class="text-center"><?php echo display('invoice_no') ?></th>
                                        <th class="text-center"><?php echo display('total_purch_ctn') ?></th>
                                        <th class="text-center"><?php echo display('deposite_id') ?></th>
                                        <th class="text-center"><?php echo display('debit') ?></th>
                                        <th class="text-center"><?php echo display('credit') ?></th>
                                        <th class="text-center"><?php echo display('balance') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
//                                    echo '<pre>';  print_r($ledger);die();
                            if ($ledger) {
                                ?>

                                <?php foreach ($ledger as $ledger) {
                                    ?>
                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                <td><?php echo $ledger['purchase_date'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td><?php echo $ledger['description'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td><a href="<?php echo base_url() . 'Cpurchase/purchase_details_data/{purchase_id}'; ?>">
                                    <?php echo $ledger['chalan_no'] ?>                                                                                                                                                                                                    </a></td>
                                                                                                                                                                                                                                                                                                                                                                <td align="right"><?php
                                    $Cq = $ledger['cartoon_quantity'];
                                    $q = $ledger['quantity'];
                                    $cartoon = $q / $Cq;
                                    echo $cartoon;
                                    ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td></td>
                                                                                                                                                                                                                                                                                                                                                                <td></td>

                                                                                                                                                                                                                                                                                                                                                                <td align="right"><?php
                                    if (!empty($ledger['total_taka']))
                                        echo (($position == 0) ? "$currency " : " $currency");
                                    echo $ledger['total_taka'];
                                    ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td align="right"><?php
                                    if (!empty($ledger['total_amount']))
                                        echo (($position == 0) ? "$currency " : " $currency");
                                    echo number_format($ledger['total_amount'], 2, '.', ',')
                                    ?></td>
                                                                                                                                                                                                                                                                                                                                                            </tr>
                                <?php } ?>
                                <?php
                            }
                            ?>

                            <?php
                            if ($summary) {
                                ?>

                                <?php foreach ($summary as $value) {
                                    ?>

                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                <td><?php echo $value['ledger_date'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td><?php echo $value['description'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td></td>
                                                                                                                                                                                                                                                                                                                                                                <td></td>

                                                                                                                                                                                                                                                                                                                                                                <td><?php echo $value['deposit_no'] ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td align="right"><?php
                                    echo (($position == 0) ? "$currency " : '');
                                    echo $value['total_debit'];
                                    ?></td>
                                                                                                                                                                                                                                                                                                                                                                <td></td>
                                                                                                                                                                                                                                                                                                                                                                <td align="right"><?php
                                    echo (($position == 0) ? "$currency " : "");
                                    echo $value['total_debit'];
                                    ?></td>
                                                                                                                                                                                                                                                                                                                                                            </tr>

                                <?php } ?>
                                <?php
                            }
                            ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" align="right"><b><?php echo display('grand_total') ?>:</b></td>
                                        <td align="right"><b><?php echo (($position == 0) ? "$currency {SubTotal_debit}" : "{SubTotal_debit} $currency") ?></b></td>
                                        <td align="right"><b><?php echo (($position == 0) ? "$currency {SubTotal_credit}" : "{SubTotal_credit} $currency") ?></b></td>
                                        <td align="right"><b><?php echo (($position == 0) ? "$currency {total_amount}" : "{total_amount} $currency") ?></b></td>
                                    </tr>
                                </tfoot>
                            </table>-->
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