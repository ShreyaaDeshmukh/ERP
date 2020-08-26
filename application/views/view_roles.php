<!-- Edit User start -->

<?php

// $nid ='{id}';

$con=mysqli_connect("localhost", "root","","wholesale");

$sql = "SELECT * FROM `user_roles` where mob_user_id =$id";

$getData = $con->query($sql);

$userdata = [];

if($getData->num_rows > 0)

{  
while ($row = $getData->fetch_assoc()) 
    {
        $userdata[] = $row;    
    }
}
else{
   echo "no data found";
}

?>
<script>

$(document).ready(function(){

   var dtype= '<?php echo $device_type; ?>';

//    alert(dtype);
 if(dtype=="Web"){
    $("#mobile").hide();
    $("#web").show();

 }else{
    $("#web").hide();
    $("#mobile").show();
 }
});
</script>

<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo 'User Roles' ?></h1>
            <small><?php echo 'User Roles' ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('web_settings') ?></a></li>
                <li class="active"><?php echo 'User Roles' ?></li>
            </ol>
        </div>
    </section>

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
                        <div class="table-responsive" id="web">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                        
                               <thead>
                                    <tr>
                                        <th><?php echo 'Dashboard' ?></th>
                                        <th><?php echo 'Purchase' ?></th>
                                        <th><?php echo 'Recieving' ?></th>
                                        <th><?php echo 'Pick Ticket' ?></th>

                                        <th><?php echo 'Inventory' ?></th>
                                        <th><?php echo 'Masters' ?></th>
                                        <th><?php echo 'Role Management' ?></th>
                                        <th><?php echo 'Software Settings' ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                               
                                           
                                            <tr>
                                             <td><?php if($userdata[0]["Dashboard"]==1||$userdata[0]["Dashboard"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["Purchase"]==1||$userdata[0]["Purchase"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["Recieving"]==1||$userdata[0]["Recieving"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["PickTicket"]==1||$userdata[0]["PickTicket"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                            
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>



                                            <td><?php if($userdata[0]["Inventory"]==1||$userdata[0]["Inventory"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>  
                                            
                                            <td><?php if($userdata[0]["Masters"]==1||$userdata[0]["Masters"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td> <td><?php if($userdata[0]["RoleManagement"]==1||$userdata[0]["RoleManagement"]=="1"){
                                                echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                            }
                                            else{
                                               echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                           } ?></td> <td><?php if($userdata[0]["SoftwareSettings"]==1||$userdata[0]["SoftwareSettings"]=="1"){
                                            echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                        }
                                        else{
                                           echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                       } ?></td> 




                                        </tr>
                                 
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive" id="mobile">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                        
                               <thead>
                                    <tr>
                                        <th><?php echo 'Receiving' ?></th>
                                        <th><?php echo 'Putaway' ?></th>
                                        <th><?php echo 'Picking' ?></th>
                                        <th><?php echo 'Inventory' ?></th>

                                        <th><?php echo 'MISC' ?></th>
                                        <th><?php echo 'Checkin' ?></th>
                                        <th><?php echo 'Checkout' ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                               
                                           
                                            <tr>
                                             <td><?php if($userdata[0]["Mob_receiving"]==1||$userdata[0]["Mob_receiving"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["Mob_putaway"]==1||$userdata[0]["Mob_putaway"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["Mob_picking"]==1||$userdata[0]["Mob_picking"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>

                                            <td><?php if($userdata[0]["Mob_inventory"]==1||$userdata[0]["Mob_inventory"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                            
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>



                                            <td><?php if($userdata[0]["Mob_misc"]==1||$userdata[0]["Mob_misc"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>  
                                            
                                            <td><?php if($userdata[0]["Mob_checkin"]==1||$userdata[0]["Mob_checkin"]=="1"){
                                                 echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                             }
                                             else{
                                                echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                            } ?></td>
                                            
                                            <td><?php if($userdata[0]["Mob_checkout"]==1||$userdata[0]["Mob_checkout"]=="1"){
                                                echo '<i class="fa fa-check" aria-hidden="true"  style="color:green;"></i>';
                                            }
                                            else{
                                               echo '<i class="fa fa-times" aria-hidden="true" style="color:red"></i>';
                                           } ?></td>

                                        </tr>
                                 
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- Edit user end -->

<script>
    document.forms['ef'].elements['status'].value = "<?php echo $status ?>";
</script>



