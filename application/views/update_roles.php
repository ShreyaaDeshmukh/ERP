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


<head>

<style>

.table-responsive {
    min-height: .01%;
    overflow-x: hidden;
}


</style>


</head>
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

            <div class="col-sm-10">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                        
                            <h4><?php echo 'User Roles' ?> </h4>
                            <h4><?php echo $device_type ?> </h4>

                        </div>
                    </div>
                    <div class="panel-body">

                    <form action="http://localhost/AdminApp/Croles/update_roles_data" method="post"> 

                        <div class="table-responsive" id="web">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo 'Roles' ?></th>
                                        <th><?php echo 'Assign Roles' ?></th>
                                       

                                    </tr>
                                </thead>

                                <tbody>
                               
                                            <tr>
                                             <td>Dashboard</td>

                                            <td> <input type="checkbox" name="dashboard" value="1" <?php echo ($userdata[0]['Dashboard']==1||$userdata[0]['Dashboard']=="1" ? 'checked' : '');?>></td>
                                            </tr>
                                            <tr>
                                         
                                             <td>Purchase</td>

                                            <td> <input type="checkbox" name="purchase" value="1" <?php echo ($userdata[0]['Purchase']==1||$userdata[0]['Purchase']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Receiving</td>

                                            <td> <input type="checkbox" name="recieving" value="1" <?php echo ($userdata[0]['Recieving']==1||$userdata[0]['Recieving']=="1" ? 'checked' : '');?> ></td>
                                            </tr>  <tr>
                                             <td>Pick Ticket</td>

                                            <td> <input type="checkbox" name="pickticket" value="1" <?php echo ($userdata[0]['PickTicket']==1||$userdata[0]['PickTicket']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Inventory</td>

                                            <td> <input type="checkbox" name="inventory" value="1" <?php echo ($userdata[0]['Inventory']==1||$userdata[0]['Inventory']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Masters</td>

                                            <td> <input type="checkbox" name="masters" value="1" <?php echo ($userdata[0]['Masters']==1||$userdata[0]['Masters']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Role Management</td>

                                            <td> <input type="checkbox" name="rolemanagement" value="1" <?php echo ($userdata[0]['RoleManagement']==1||$userdata[0]['RoleManagement']=="1" ? 'checked' : '');?>></td>
                                            </tr>

                                            <tr>
                                             <td>Software Settings</td>

                                            <td> <input type="checkbox" name="softwaresettings" value="1" <?php echo ($userdata[0]['SoftwareSettings']==1||$userdata[0]['SoftwareSettings']=="1" ? 'checked' : '');?>></td>
                                            </tr>


     
                                </tbody>

     
                            </table>
                        </div>

                        <div class="table-responsive" id="mobile">
                            <table id="dataTableExample3" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo 'Roles' ?></th>
                                        <th><?php echo 'Assign Roles' ?></th>
                                       

                                    </tr>
                                </thead>

                                <tbody>
                               
                                            <tr>
                                             <td>Receiving</td>

                                            <td> <input type="checkbox" name="mob_receiving" value="1" <?php echo ($userdata[0]['Mob_receiving']==1||$userdata[0]['Mob_receiving']=="1" ? 'checked' : '');?>></td>
                                            </tr>
                                            <tr>
                                         
                                             <td>Putaway</td>

                                            <td> <input type="checkbox" name="mob_putaway" value="1" <?php echo ($userdata[0]['Mob_putaway']==1||$userdata[0]['Mob_putaway']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Picking</td>

                                            <td> <input type="checkbox" name="mob_picking" value="1" <?php echo ($userdata[0]['Mob_picking']==1||$userdata[0]['Mob_picking']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Inventory</td>

                                            <td> <input type="checkbox" name="mob_inventory" value="1" <?php echo ($userdata[0]['Mob_inventory']==1||$userdata[0]['Mob_inventory']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>MISC</td>

                                            <td> <input type="checkbox" name="mob_misc" value="1" <?php echo ($userdata[0]['Mob_misc']==1||$userdata[0]['Mob_misc']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Checkin</td>

                                            <td> <input type="checkbox" name="mob_checkin" value="1" <?php echo ($userdata[0]['Mob_checkin']==1||$userdata[0]['Mob_checkin']=="1" ? 'checked' : '');?>></td>
                                            </tr>  <tr>
                                             <td>Checkout</td>

                                            <td> <input type="checkbox" name="mob_checkout" value="1" <?php echo ($userdata[0]['Mob_checkout']==1||$userdata[0]['Mob_checkout']=="1" ? 'checked' : '');?>></td>
                                            </tr>

                                </tbody>

     
                            </table>
                        </div>

                        <input type="hidden" name="mob_user_id" value="{id}"/>

                        <input type="submit" id="add-customer" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>"  style="margin-left:40%;margin-right:40%;"/>

</form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php

function update(){
    echo "iii";
    return true;
}

?>
<!-- Edit user end -->



