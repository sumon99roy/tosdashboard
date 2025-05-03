<html>
	<head>
		 <meta http-equiv="refresh" content="60">
		 <style>
			body{font-family: "Calibri";}
		 </style>
		 <script src="canvasjs.min.js"></script>
			 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
	</head>
	<body>
		<div>
			<div align="center">
				<?php //include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");?>
				<!--table>
					<tr style="margin:5px;">
						<td colspan="7"><font size="5"><b>CURRENT GRAPH AT </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>

				</table-->
				<?php
					$strQueryRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQuerySupRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQueryOutRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQueryStandRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					
					$queryRTG=mysql_query($strQueryRTG);
					$querySupRTG=mysql_query($strQuerySupRTG);
					$queryOutRTG=mysql_query($strQueryOutRTG);
					$queryStandRTG=mysql_query($strQueryStandRTG);
					
					$numRowsRTG = mysql_num_rows($queryRTG);
					$numRowsSupRTG = mysql_num_rows($querySupRTG);
					$numRowsOutRTG = mysql_num_rows($queryOutRTG);
					$numRowsStandRTG = mysql_num_rows($queryStandRTG);
					?>
				<div id="chartContainerRTG" style="height: 300px; width: 100%;">
				</div>
			</div>
		</div>
		
	</body>
	<script>
	 window.onload = function () {

var chartRTG = new CanvasJS.Chart("chartContainerRTG", {
	animationEnabled: true,
	title:{
		text: "Daily Euipment Statement of RTG for the month of"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesRTG
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "spline",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowRTG=mysql_fetch_object($queryRTG))
			{
				$i++;
				
				if($i!=$numRowsRTG){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowRTG->graph_day;?>), y: <?php echo $rowRTG->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowRTG->graph_day;?>), y: <?php echo $rowRTG->demand;?> }
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "spline",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSup=mysql_fetch_object($querySup))
			{
				$i++;
				if($i!=$numRowsSup){
			?>
			{ x: new Date(<?php echo $rowSup->graph_day;?>), y: <?php echo $rowSup->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSup->graph_day;?>), y: <?php echo $rowSup->suply;?> }
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "spline",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStand=mysql_fetch_object($queryStand))
			{
				$i++;
				if($i!=$numRowsStand){
			?>
			{ x: new Date(<?php echo $rowStand->graph_day;?>), y: <?php echo $rowStand->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStand->graph_day;?>), y: <?php echo $rowStand->stand_by;?> }
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "spline",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOut=mysql_fetch_object($queryOut))
			{
				$i++;
				if($i!=$numRowsOut){
			?>
			{ x: new Date(<?php echo $rowOut->graph_day;?>), y: <?php echo $rowOut->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOut->graph_day;?>), y: <?php echo $rowOut->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartRTG.render();	 
function toggleDataSeriesRTG(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartRTG.render();
}

}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>