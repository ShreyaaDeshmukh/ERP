<!-- User List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo 'User Roles' ?></h1>
            <small><?php echo'User Roles' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo 'User Roles' ?></li>
            </ol>
        </div>
    </section>
<?php





?>

    <section class="content">
        <!-- Alert Message -->
         <?php
        $data_msg = $this->session->userdata('data_msg');
        if (isset($data_msg)) {
            ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $data_msg ?>                    
            </div>
            <?php } ?>
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
        <!-- User List -->
        <div class="row">

            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                        
                            <h4><?php echo 'User Roles' ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo display('sl') ?></th>
                                        <th><?php echo display('name') ?></th>
                                        <th><?php echo display('email') ?></th>
                                        <th><?php echo "Mobile" ?></th>
                                        <th><?php echo "Platform" ?></th>

                                        <th><?php echo display('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($user_list) {
//                                            echo '<pre>';    print_r($user_list);die();
                                        foreach ($user_list as $user) {
                                            ?>
                                            <tr>
                                             <td><?php echo $user["sl"] ?></td>
                                                <td style="width:30%;"><?php echo $user["first_name"] . " " . $user["last_name"] ?></td>
                                                <td><?php echo $user["email"] ?></td>
                                                <td><?php
                                                    echo $user["mobile"];                                                  
                                                    ?></td>
                                              <td><?php
                                                    echo $user["device_type"];                                                  
                                                    ?></td>
                                                <td>
                                        <center>
                                            <?php echo form_open() ?>
                                            <?php 
                                            // print_r($user["id"]);die;
                                            ?>

           <a href="<?php echo base_url('Croles/view_role_form/' . $user["id"]); ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo display('view') ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                            <a href="<?php echo base_url('Croles/update_role_form/' . $user["id"]); ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            
                                                <!-- <a href="" class="deleteUser btn btn-danger btn-sm" name="<?php echo $user["id"] ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a> -->
                                                
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
        var user_id = $(this).attr('name');
        console.log($(this).attr('name'));
    //    return false;
        // var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are You Sure,Want to Delete ?");
        if (x == true) {
            // alert(user_id);
                $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('User/user_delete') ?>',
                        data: {user_id: user_id},

                        // cache: false,
                        success: function (datas)
                        {
                            
                        },
                       
                    });
                    
        }else{
            // alert(9);
			return false;
		}
    });
</script>
