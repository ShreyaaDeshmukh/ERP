<!-- Barcode print js -->
<script type="text/javascript">
	function printDiv(divName) {
		var content = document.getElementById(divName).innerHTML;
		console.log(content);
		var mywindow = window.open('', '', '');
		mywindow.document.write('<html><title>Print</title><style type="text/css">');
		mywindow.document.write('body,td,th{font-family:Arial, Helvetica, sans-serif;font-size:10px;color:#000000;border:1px solid #000;} table{width:100%;border-collapse: collapse;}');
		mywindow.document.write('</style></head><body style="padding:10px;">')
		mywindow.document.write(content);
		mywindow.document.write('</body></html>');
		mywindow.document.close();
		setTimeout(function(){
			 mywindow.print();
			return true;
		}, 3500);
   
	}
</script>

<!-- User List Start -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?php echo display('manage_locations') ?></h1>
            <small><?php echo display('manage_locations') ?></small>
            <ol class="breadcrumb">
                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"><?php echo display('location') ?></a></li>
                <li class="active"><?php echo display('manage_locations') ?></li>
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
        <!-- User List -->
		<div class="row">
			<div class="col-md-12">
				<a  class="btn btn-info" href="#" onclick="printDiv('printableArea')"><?php echo display('print')?></a>
			</div>
		</div>
		<br/>
        <div class="row">
            <div class="col-sm-12">
				
                <div class="panel panel-bd lobidrag">
					
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo display('manage_locations') ?> </h4>
                        </div>
                    </div>
                    <div class="panel-body" style="max-height: 900px !important; overflow-y: scroll !important;">
                        <div class="table-responsive" id="printableArea">
                            <table class="table table-bordered table-striped table-hover">
                               
                                <tbody>
                                    <?php
                                    if ($location_list) {
//                                            echo '<pre>';    print_r($user_list);die();
                                        foreach ($location_list as $user) {
                                            ?>
                                            <tr>
                                               <td>
												<center>
													<?php echo "<p>". $user['location_name']."</p>";?>
													<img src="<?php echo base_url('Cbarcodelocation/barcode_generator/'.$user['location_unique_key'])?>" class="img-responsive center-block" alt="" style="display: block;margin-left: auto;margin-right: auto;height: 100px;width: 30%;">
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
        var csrf_test_name = $("[name=csrf_test_name]").val();
        var x = confirm("Are you sure you want to delete? ");
        if (x == true) {
            $.ajax
                    ({
                        type: "POST",
                        url: '<?php echo base_url('User/user_delete') ?>',
                        data: {user_id: user_id, csrf_test_name: csrf_test_name},
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