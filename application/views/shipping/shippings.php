<!-- User List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_shipping') ?></h1>
            <small><?php echo display('manage_shipping') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo display('manage_shipping') ?></li>
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

                        <a style="float:right;"href="<?php echo base_url('Cshipping')?>"><input type="button" id="add-category" class="btn btn-success btn-large" name="add-category" value="Add Shipping"></a>	            
                    </div>
                </div>
            </div>
        </div>
        <!-- User List -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_shipping') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('shipping_name') ?></th>
                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($shipping_list) {
                                           
                                        foreach ($shipping_list as $user) {
                                            ?>
                                            <tr>
                                                <td><?php echo $user["sl"] ?></td>
                                                <td><?php echo $user["shipping_name"]?></td>
                                                <td>
                                        <center>
                                        
                                            <?php echo form_open() ?>
                                            <a href="<?php echo base_url('Cshipping/shipping_update_form/' . $user["id"]); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
											
											
                                            <?php
                                         
                                                ?>
                                                <a href="" class="deleteUser btn btn-danger btn-sm" name="<?php echo $user["id"] ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php
                                         
                                                ?>
                                                <?php echo form_close() ?>
                                        </center>
                                        </td>
                                        </tr>
                                    <?php }
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- User List End -->


<script type="text/javascript">
    //Delete User Item 
    $(".deleteUser").click(function ()
    {
        var shipping_id = $(this).attr('name');
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are you sure you want to delete? ");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('Cshipping/shipping_delete') ?>',
                        data: {shipping_id: shipping_id, csrf_test_name: csrf_test_name},
                        cache: false,
                        success: function (datas)
                        {
                        }
                    });
        }else{
			return false;
		}
    });
</script>