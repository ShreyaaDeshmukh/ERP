<!-- Closing Account start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('closing_account') ?></h1>
            <small><?php echo display('close_your_account') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('accounts') ?></a></li>
                <li class="active"><?php echo display('closing_account') ?></li>
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

            <div class="col-sm-6">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h3><p style="text-align: center; font-size: 17px; color: black; font-weight:bold">
                                    <?php
                                    // echo display('company_name');
                                    echo "<br>";
                                    echo "Cash Closing";
                                    echo "<br>";
                                    echo 'Date' . ':' . date('Y-m-d');
                                    echo "(";
                                    ?>  <span id="time"></span><?php
                                    echo date(" a", time());
                                    echo ")";
                                    ?></p></h3>
                        </div>
                    </div>
                    <div class="panel-body">

                        <?php echo form_open_multipart('Caccounts/add_daily_closing', array('class' => 'form-vertical', 'id' => 'daily_closing')) ?>
                        <div class="form-group row">
                            <label for="last_day_closing" class="col-sm-3 col-form-label"><?php echo display('last_day_closing') ?></label>
                            <div class="col-sm-6">
                                <input type="text" name="last_day_closing" class="form-control" id="last_day_closing" value="{last_day_closing}" readonly="readonly" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cash_in" class="col-sm-3 col-form-label"><?php echo display('receipt') ?></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cash_in" name="cash_in" value="{cash_in}" readonly="readonly" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cash_out" class="col-sm-3 col-form-label"><?php echo display('payment') ?></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cash_out" name="cash_out" value="{cash_out}" readonly="readonly" />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cash_in_hand" class="col-sm-3 col-form-label"><?php echo display('balance') ?></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="cash_in_hand" name="cash_in_hand" value="{cash_in_hand}" readonly="readonly" required />
                            </div>
                        </div>

                        <!--  <div class="form-group row">
                             <label for="bank" class="col-sm-3 col-form-label"><?php echo display('bank') ?></label>
                             <div class="col-sm-6">
                                 <input type="text" class="form-control" id="bank" name="bank_balance" value="{bank_balance}" readonly="readonly" required />
                             </div>
                         </div>
                        -->
<!--                        <div class="form-group row">
                            <label for="adjusment" class="col-sm-3 col-form-label"><?php echo display('adjustment') ?></label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" id="adjusment" name="adjusment" placeholder="<?php echo display('adjustment') ?>" />
                            </div>
                        </div>-->

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" id="add-deposit" class="btn btn-primary" name="add-deposit" value="<?php echo display('day_closing') ?>" required />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">   
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('cash_in_hand') ?></h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center"><?php echo display('note_name') ?></th>
                                    <th class="text-center"><?php echo display('pcs') ?></th>
                                    <th class="text-center"><?php echo display('ammount') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="1000"><?php echo display('1000') ?></td>
                                    <td><input type="number" class="form-control text_1" name="thousands" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_1_bal" readonly=""></td>
                                </tr> 
                                <tr>
                                    <td class="500"><?php echo display('500') ?></td>
                                    <td><input type="number" class="form-control text_2" name="fivehnd" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_2_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="100"><?php echo display('100') ?></td>
                                    <td><input type="number" class="form-control text_3" name="hundrad" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_3_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="50"><?php echo display('50') ?></td>
                                    <td><input type="number" class="form-control text_4" name="fifty" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_4_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="20"><?php echo display('20') ?></td>
                                    <td><input type="number" class="form-control text_5" name="twenty" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_5_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="10"><?php echo display('10') ?></td>
                                    <td><input type="number" class="form-control text_6" name="ten" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_6_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="5"><?php echo display('5') ?></td>
                                    <td><input type="number" class="form-control text_7" name="five" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_7_bal" readonly=""></td>
                                </tr>   
                                <tr>
                                    <td class="2"><?php echo display('2') ?></td>
                                    <td><input type="number" class="form-control text_8" name="two" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_8_bal" readonly=""></td>
                                </tr>
                                <tr>
                                    <td class="1"><?php echo display('1') ?></td>
                                    <td><input type="number" class="form-control text_9" name="one" onkeyup="calculator()"></td>
                                    <td><input type="text" class="form-control text_9_bal" readonly=""></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" align="right"><b><?php echo display('grand_total') ?></b></td>
                                    <td class=""><input type="text" class="form-control total_money" readonly="" name="grndtotal"></td>
                                </tr>
                                <?php echo form_close() ?>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- Calculator form -->

    </section>
</div>
<!-- Closing Account end -->

<script type="text/javascript">
    function calculator() {

        var mul1 = $('.text_1').val();
        var text_1_bal = mul1 * 1000;
        $('.text_1_bal').val(text_1_bal);

        var mul2 = $('.text_2').val();
        var text_2_bal = mul2 * 500;
        $('.text_2_bal').val(text_2_bal);

        var mul3 = $('.text_3').val();
        var text_3_bal = mul3 * 100;
        $('.text_3_bal').val(text_3_bal);

        var mul4 = $('.text_4').val();
        var text_4_bal = mul4 * 50;
        $('.text_4_bal').val(text_4_bal);

        var mul5 = $('.text_5').val();
        var text_5_bal = mul5 * 20;
        $('.text_5_bal').val(text_5_bal);

        var mul6 = $('.text_6').val();
        var text_6_bal = mul6 * 10;
        $('.text_6_bal').val(text_6_bal);

        var mul7 = $('.text_7').val();
        var text_7_bal = mul7 * 5;
        $('.text_7_bal').val(text_7_bal);

        var mul8 = $('.text_8').val();
        var text_8_bal = mul8 * 2;
        $('.text_8_bal').val(text_8_bal);

        var mul9 = $('.text_9').val();
        var text_9_bal = mul9 * 1;
        $('.text_9_bal').val(text_9_bal);


        var total_money = (text_1_bal + text_2_bal + text_3_bal + text_4_bal + text_5_bal + text_6_bal + text_7_bal + text_8_bal + text_9_bal);

        $('.total_money').val(total_money);
    }
</script>
<script type="text/javascript">
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
        t = setTimeout(function () {
            startTime()
        }, 500);
    }
    startTime();
</script>




