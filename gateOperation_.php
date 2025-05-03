<html>
	<head>
		 <meta http-equiv="refresh" content="60">
		 <style>
			body{font-family: "Calibri";}
		 </style>
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");?>
				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Gate Operation at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<table width="50%" border ='1' cellpadding='0' cellspacing='0'>	
				<tr  align="center" bgcolor="#D8D0CE">
					<td style="border-width:3px;border-style: double;"><b>SlNo.</b></td>
					<td style="border-width:3px;border-style: double;"><b>Gate</b></td>
					<td style="border-width:3px;border-style: double;"><b>Total In</b></td>
					<td style="border-width:3px;border-style: double;"><b>Total Out</b></td>
					<td style="border-width:3px;border-style: double;"><b>Total</b></td>
				</tr>

				<!--tr  align="center">
					<td style="border-width:3px;border-style: double;"><b>Total Import Container</b></td>
					<td style="border-width:3px;border-style: double;"><b>Total Discharge Container</b></td>		
					<td style="border-width:3px;border-style: double;"><b>Balance</b></td>
					<td style="border-width:3px;border-style: double;"><b>Total Export Container</b></td>
					<td style="border-width:3px;border-style: double;"><b>Loaded On Board</b></td>		
					<td style="border-width:3px;border-style: double;"><b>Balance To Be Shipped</b></td>	
				</tr-->

			<?php

				//echo$vvdGkey;
				$strQuery = "SELECT id AS GateNo,SUM(GateIn) AS TotalGateIN,SUM(GateOut) AS TotalgateOut FROM (
				SELECT IF(stage_id='In Gate',1,0) AS GateIn,IF(stage_id='Out Gate',1,0) AS GateOut,road_gates.id
				FROM sparcsn4.road_truck_visit_details
				INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
				LEFT JOIN sparcsn4.road_gates ON sparcsn4.road_gates.gkey=road_truck_visit_details.gate_gkey
				WHERE sparcsn4.road_truck_visit_details.created BETWEEN CONCAT(DATE(NOW()), ' 00:00:00') AND CONCAT(DATE(NOW()), ' 23:59:59')
				) AS s GROUP BY id";
				
				//echo $strQuery;
				$query=mysql_query($strQuery);

				$i=0;
				$tIn = 0;
				$tOut = 0;
				$cct1= 0;
				$cct2= 0;
				$cpar= 0;
				$gate4= 0;
				$gate5= 0;
				$nctlane1= 0;
				$nctlane3= 0;
				while($row=mysql_fetch_object($query)){
				$i++;
				$tIn += $row->TotalGateIN;
				$tOut += $row->TotalgateOut;
				if($row->GateNo=="CCT-1")
					$cct1= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="CCT-2")
					$cct2= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="CPAR")
					$cpar= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="GATE-4")
					$gate4= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="GATE-5")
					$gate5= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="NCT LANE1")
					$nctlane1= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="NCT LANE3")
					$nctlane3= $row->TotalGateIN+$row->TotalgateOut;
				/*$sqlGetTotIn="SELECT COUNT(sparcsn4.road_truck_transactions.nbr) AS total_in
								FROM sparcsn4.road_truck_visit_details
								INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
								WHERE DATE(sparcsn4.road_truck_visit_details.created)=DATE(NOW()) AND sparcsn4.road_truck_visit_details.gate_gkey=$row->gkey AND stage_id='In Gate'";
				$queryTotIn=mysql_query($sqlGetTotIn);
				$rowTotIn=mysql_fetch_object($queryTotIn);
				
				$sqlGetTotOut="SELECT COUNT(sparcsn4.road_truck_transactions.nbr) AS total_out
								FROM sparcsn4.road_truck_visit_details
								INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
								WHERE DATE(sparcsn4.road_truck_visit_details.created)=DATE(NOW()) AND sparcsn4.road_truck_visit_details.gate_gkey=$row->gkey AND stage_id='Out Gate'";
				$queryTotOut=mysql_query($sqlGetTotOut);
				$rowTotOut=mysql_fetch_object($queryTotOut);*/
				
			?>
			<tr align="center">
				<td><?php  echo $i;?></td>
				<td><?php if($row->GateNo) echo $row->GateNo; else echo "&nbsp;";?></td>
				<td><?php echo $row->TotalGateIN; ?></td>
				<td><?php echo $row->TotalgateOut; ?></td>		
				<td><?php echo $row->TotalGateIN+$row->TotalgateOut; ?></td>		
			</tr>

			<?php } 
			?>
			<tr align="center">
				<th colspan="2">Total</th>
				<th><?php echo $tIn; ?></th>
				<th><?php echo $tOut; ?></td>		
				<th><?php echo $tIn+$tOut; ?></td>		
			</tr>
			</table>
			</div>
			 <!--div align="left" style="padding-left: 330px;">
				   <strong><a target="_blank"  href="gateOperationDetailList.php">Click here for detail List >></a></strong>
			</div-->
			<div id="piechart" align="center"></div>
			<script type="text/javascript" src="loader.js"></script>

			<script type="text/javascript">
			// Load google charts
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);

			// Draw the chart and set the chart values
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'Percentage per Day'],
			  ['CCT-1', <?php echo $cct1;?>],
			  ['CCT-2', <?php echo $cct2;?>],
			  ['CPAR', <?php echo $cpar;?>],
			  ['GATE-4', <?php echo $gate4;?>],
			  ['GATE-5', <?php echo $gate5;?>],
			  ['NCT LANE1', <?php echo $nctlane1;?>],
			  ['NCT LANE3', <?php echo $nctlane3;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'Handling Perfomance', 'width':550, 'height':400};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			  chart.draw(data, options);
			}
			</script>
		</div>
		<?php mysql_close($con_sparcsn4); ?>
				<?php include('footer.php'); ?>

	</body>
</html>