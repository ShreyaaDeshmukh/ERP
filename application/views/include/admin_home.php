<!-- Admin Home Start -->

 <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-world"></i>



        </div>

        <div class="header-title">

            <h1><?php echo display('dashboard')?></h1>

            <small><?php echo display('home')?></small>

            <ol class="breadcrumb">

                <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home')?></a></li>

                <li class="active"><?php echo display('dashboard')?></li>

            </ol>

        </div>

    </section>

    <!-- Main content -->

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

        <!-- First Counter -->

      

        

        <!-- Second Counter -->


        <?php 
        // if($this->session->userdata('user_type') == '1'){                    
            ?>

        <!-- Third Counter -->
	

		<!-- rizwan's code here-->
		<div class="row">

            <!-- This month progress -->

            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                <div class="panel panel-bd">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo "Daily Purchase Orders"?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <div class="">

                            <div class="message_widgets">
                                <table class="table table-bordered table-striped table-hover">

                                <tr>

                                    <th><?php echo "Purchase Entered";?></th>

                                    <td><?php echo ($today_total_purchase ? $today_total_purchase : 0);?></td>

                                </tr>

                                   

                                    <!--<tr>-->

                                    <!--    <th>-->
                                    <!--        <?php echo "Purchase fully received"?></th>-->

                                    <!--    <td><?php echo (($today_fully_received==0)?"0":"$today_fully_received") ?></td>-->

                                    <!--</tr>-->
									
									<tr>

                                        <th><?php echo "Total line Items"?></th>

                                        <td><?php echo (($today_total_purchase_line_item==0)?"0":"$today_total_purchase_line_item") ?></td>

                                    </tr>
									
									
									
									<tr>

                                        <th><?php echo "Full Received line Items"?></th>

                                        <td><?php echo (($today_fully_received_line_item==0)?"0":"$today_fully_received_line_item") ?></td>

                                    </tr>
									
									<tr>

                                        <th><?php echo "Unreceived line Items"?></th>

                                        <td><?php echo (($total_blank_line_item_daily==0)?"0":"$total_blank_line_item_daily") ?></td>

                                    </tr>
                                    

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Total Report -->
			
				
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                <div class="panel panel-bd lobidisable">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo "Daily Pick Ticket"?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <div class="">

                            <div class="message_widgets">
                                <table class="table table-bordered table-striped table-hover">

                                <tr>

                                    <th><?php echo "Ticket Entered";?></th>

                                    <td><?php echo ($today_total_ticket ? $today_total_ticket : 0);?></td>

                                </tr>

                                   
                                    
									<tr>

                                        <th><?php echo "Total line Items"?></th>

                                        <td><?php echo (($count_picking_line_item_today==0)?"0":"$count_picking_line_item_today") ?></td>

                                    </tr>
									
									
									
									<tr>

                                        <th><?php echo "Full Picked line Items"?></th>

                                        <td><?php echo (($today_fully_ticket_line_item==0)?"0":"$today_fully_ticket_line_item") ?></td>

                                    </tr>
									
									<tr>

                                        <th><?php echo "Total Unpicked line Items"?></th>

                                        <td><?php echo (($total_blank_line_item_daily_ticket==0)?"0":"$total_blank_line_item_daily_ticket") ?></td>

                                    </tr>
                                    

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        
		
		
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                <div class="panel panel-bd lobidisable">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo "Monthly Purchase Orders"?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <div class="">

                            <div class="message_widgets">
                                
                                <table class="table table-bordered table-striped table-hover">

                                <tr>

                                    <th><?php echo "Purchase Entered";?></th>

                                    <td><?php echo ($monthly_total_purchase ? $monthly_total_purchase : 0);?></td>

                                </tr>

                                   

                                    

									<tr>

                                        <th><?php echo "Total line Items"?></th>

                                        <td><?php echo (($count_purchase_line_item_month==0)?"0":"$count_purchase_line_item_month") ?></td>

                                    </tr>	
									
									
									
									<tr>

                                        <th><?php echo "Full Received line Items"?></th>

                                        <td><?php
                                        // echo (($count_purchase_line_item_month_fully_received==0)?"0":"$count_purchase_line_item_month_fully_received") 
                                        echo 0;
                                        
                                        ?></td>

                                    </tr>
									
									<tr>

                                        <th><?php echo "Unreceived line Items"?></th>

                                        <td><?php echo (($total_blank_line_item_montly==0)?"0":"$total_blank_line_item_montly") ?></td>

                                    </tr>
									

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
			
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">

                <div class="panel panel-bd lobidisable">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo "Monthly Pick Ticket"?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <div class="">

                            <div class="message_widgets">

                                

                                <table class="table table-bordered table-striped table-hover">

                                <tr>

                                    <th><?php echo "Ticket Entered";?></th>

                                    <td><?php echo ($count_ticket_month ? $count_ticket_month : 0);?></td>

                                </tr>

                                   

                                    
									
									<tr>

                                        <th><?php echo "Total line Items"?></th>

                                        <td><?php echo (($count_picking_line_item_month==0)?"0":"$count_picking_line_item_month") ?></td>

                                    </tr>
                                    
									
									
									<tr>

                                        <th><?php echo "Full Picked line Items"?></th>

                                        <td><?php echo (($month_fully_ticket_line_item==0)?"0":"$month_fully_ticket_line_item") ?></td>

                                    </tr>
									
									<tr>

                                        <th><?php echo "Total Unpicked line Items"?></th>

                                        <td><?php echo ((($count_picking_line_item_month-($month_partially_ticket_line_item+$month_fully_ticket_line_item))==0)?"0":($count_picking_line_item_month-($month_partially_ticket_line_item+$month_fully_ticket_line_item))) ?></td>

                                    </tr>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
		</div>
			
		
        <div class="row">

            <!-- This month progress -->

            <div class="col-md-4">

                <div class="panel panel-bd">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo display('monthly_progress_report')?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <canvas id="lineChart" height="190"></canvas>

                    </div>

                </div>

            </div>

            <!-- Total Report -->

            <div class="col-md-4">

                <div class="panel panel-bd lobidisable">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4><?php echo 'Daily Receiving'?></h4> 

                        </div>

                    </div>

                    <div class="panel-body">

                        <!--<div id="chartContainer" style="height: 370px; width: 100%;"></div>-->
						<canvas id="examChart" height="190"></canvas>

                    </div>

                </div>

            </div>

            <!-- This month progress -->

            <div class="col-md-4">

                <div class="panel panel-bd">

                    <div class="panel-heading">

                        <div class="panel-title">

                            <h4> <?php echo "Inventory Location Wise"?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <canvas id="locationPie" height="190"></canvas>
						
						

                    </div>

                </div>

            </div>

</div>
        
           <!--<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">

                <div class="panel panel-bd">

                    <div class="panel-body">

                        <div class="statistic-box">

                            <h2><span class="count-number"><?php echo $total_sales ?></span><span class="slight"> <i class="fa fa-play fa-rotate-270 text-warning"> </i> </span></h2>

                            <div class="small"><?php echo display('total_invoice')?></div>

                            <div class="sparkline1 text-center"></div>

                        </div>

                    </div>

                </div>

            </div>-->

        </div>

    </section> <!-- /.content -->

</div> <!-- /.content-wrapper -->

<!-- Admin Home end -->

<?php #print_r($purchase_receiving_graph_data);
$labelArr = [];
$maindata = [];
if(!empty($purchase_receiving_graph_data) && isset($purchase_receiving_graph_data)){
foreach($purchase_receiving_graph_data as $purchase_recieving){
	$labelArr[] = $purchase_recieving['ym'];
}
}
$labels = join(", ", $labelArr);

?> 

<!-- ChartJs JavaScript -->

<script src="<?php echo base_url()?>assets/plugins/chartJs/Chart.min.js" type="text/javascript"></script>


<script type="text/javascript"> 

    //line chart

    var ctx = document.getElementById("lineChart");

    var myChart = new Chart(ctx, {

        type: 'line',

        data: {

            labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","December"],

            datasets: [

               /* {

                    label: "Sales",

                    borderColor: "#2C3136",

                    borderWidth: "1",

                    backgroundColor: "rgba(0,0,0,.07)",

                    pointHighlightStroke: "rgba(26,179,148,1)",

                    data: [

                    <?php

                    if(!empty($monthly_sales_report[0]))

                    for($i=0;$i<12;$i++)

                    echo (!empty($monthly_sales_report[0][$i]) ? $monthly_sales_report[0][$i]->total.", " : null);

                    ?>

                    ]

                },*/

                {

                    label: "Purchase",

                    borderColor: "#73BC4D",

                    borderWidth: "1",

                    backgroundColor: "#73BC4D",

                    pointHighlightStroke: "rgba(26,179,148,1)",

                    data: [

                    <?php

                    if(!empty($monthly_sales_report[1]))

                    for($i=0;$i<12;$i++)

                    echo (!empty($monthly_sales_report[1][$i]) ? $monthly_sales_report[1][$i]->total_month.", " : null);

                    ?> 

                    ]

                }

            ]

        },

        options: {

            responsive: true,

            tooltips: {

                mode: 'index',

                intersect: false

            },

            hover: {

                mode: 'nearest',

                intersect: true

            }



        }

    });

var ctx = document.getElementById("examChart").getContext("2d");

var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [
        <?php 
        // print_r($lbbs['ym']);die;
		foreach($purchase_receiving_graph_data as $lbbs){
			echo "new Date('".$lbbs['ym']."').toLocaleString(),";
		}
		?>
	],
    datasets: [{
      label: 'Purchase Recieving',
      data: [
	  /*{
          t: new Date("2015-2-11"),
          y: 12
        },
        {
          t: new Date("2015-2-12"),
          y: 21
        },
        {
          t: new Date("2015-2-13"),
          y: 32
        }*/
		<?php
//         echo "hii";
//  echo $purchase_receiving_graph_data;die;
                    if(!empty($purchase_receiving_graph_data))
					foreach($purchase_receiving_graph_data as $pp){
						echo "{ t: new Date(".$pp['ym']."), y:".$pp['totalorders']."},";
					}
                    
                    ?> 
      ],
      backgroundColor: "#73BC4D",
      borderColor: "#73BC4D",
      borderWidth: 1
    }]
  }
});	

</script>
<?php #echo "<pre>";print_r($count_location_items); 


$datavalue = join(",", $count_location_items['piechatdata']);
$datatext = join(",", $count_location_items['piechartcoloum']);

?>
<script>
		function getRandomColor() {
		  var letters = '0123456789ABCDEF';
		  var color = '#';
		  for (var i = 0; i < 6; i++) {
			color += letters[Math.floor(Math.random() * 16)];
		  }
		  return color;
		}

		var randomScalingFactor = function() {
			return Math.round(Math.random() * 100);
		};

		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						<?php 
						foreach($count_location_items['piechatdata'] as $locationdata){
							
							echo $locationdata.", ";
						}
						?>
					],
					backgroundColor: [
						<?php
						/*foreach($count_location_items as $locationdata){
							echo "getRandomColor()".",";	
						}*/
						//"grey",
						
						?>
						"#73bc4d",
						"grey"
						
					],
					label: 'Dataset 1'
				}],
				labels: [
					<?php 
						foreach($count_location_items['piechartcoloum'] as $locationdata){
							echo "'".$locationdata."'".",";	
						}
						?>
				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('locationPie').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
	</script>