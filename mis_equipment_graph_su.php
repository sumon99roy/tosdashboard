<html>
	<head>
		 <!--meta http-equiv="refresh" content="20"-->
		 <script src="canvasjs.min.js"></script>
			 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
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
						<td colspan="7"><font size="5"><b>CURRENT GRAPH AT </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>

				</table>
				<?php
					$strQuery = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQuerySup = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQueryOut = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					$strQueryStand = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='QGC' ORDER BY demand_suply_date";
					
					$query=mysql_query($strQuery);
					$querySup=mysql_query($strQuerySup);
					$queryOut=mysql_query($strQueryOut);
					$queryStand=mysql_query($strQueryStand);
					
					$numRows = mysql_num_rows($query);
					$numRowsSup = mysql_num_rows($querySup);
					$numRowsOut = mysql_num_rows($queryOut);
					$numRowsStand = mysql_num_rows($queryStand);
					
					$strQueryRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RTG' ORDER BY demand_suply_date";
					$strQuerySupRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RTG' ORDER BY demand_suply_date";
					$strQueryOutRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RTG' ORDER BY demand_suply_date";
					$strQueryStandRTG = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RTG' ORDER BY demand_suply_date";
					
					$queryRTG=mysql_query($strQueryRTG);
					$querySupRTG=mysql_query($strQuerySupRTG);
					$queryOutRTG=mysql_query($strQueryOutRTG);
					$queryStandRTG=mysql_query($strQueryStandRTG);
					
					$numRowsRTG = mysql_num_rows($queryRTG);
					$numRowsSupRTG = mysql_num_rows($querySupRTG);
					$numRowsOutRTG = mysql_num_rows($queryOutRTG);
					$numRowsStandRTG = mysql_num_rows($queryStandRTG);
					
					//RST 45 Ton
					$strQuery_RST_45_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 45' ORDER BY demand_suply_date";
					$strQuerySup_RST_45_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 45' ORDER BY demand_suply_date";
					$strQueryOut_RST_45_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 45' ORDER BY demand_suply_date";
					$strQueryStand_RST_45_Ton= "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 45' ORDER BY demand_suply_date";
					
					$query_RST_45_Ton=mysql_query($strQuery_RST_45_Ton);
					$querySup_RST_45_Ton=mysql_query($strQuerySup_RST_45_Ton);
					$queryOut_RST_45_Ton=mysql_query($strQueryOut_RST_45_Ton);
					$queryStand_RST_45_Ton=mysql_query($strQueryStand_RST_45_Ton);
					
					$numRows_RST_45_Ton = mysql_num_rows($query_RST_45_Ton);
					$numRowsSup_RST_45_Ton = mysql_num_rows($querySup_RST_45_Ton);
					$numRowsOut_RST_45_Ton = mysql_num_rows($queryOut_RST_45_Ton);
					$numRowsStand_RST_45_Ton = mysql_num_rows($queryStand_RST_45_Ton);
					
					
					//RST FLT 16 Ton
					
					$strQuery_FLT_16_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='FLT 16' ORDER BY demand_suply_date";
					$strQuerySup_FLT_16_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='FLT 16' ORDER BY demand_suply_date";
					$strQueryOut_FLT_16_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='FLT 16' ORDER BY demand_suply_date";
					$strQueryStand_FLT_16_Ton= "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='FLT 16' ORDER BY demand_suply_date";
					
					$query_FLT_16_Ton=mysql_query($strQuery_FLT_16_Ton);
					$querySup_FLT_16_Ton=mysql_query($strQuerySup_FLT_16_Ton);
					$queryOut_FLT_16_Ton=mysql_query($strQueryOut_FLT_16_Ton);
					$queryStand_FLT_16_Ton=mysql_query($strQueryStand_FLT_16_Ton);
					
					$numRows_FLT_16_Ton = mysql_num_rows($query_FLT_16_Ton);
					$numRowsSup_FLT_16_Ton = mysql_num_rows($querySup_FLT_16_Ton);
					$numRowsOut_FLT_16_Ton = mysql_num_rows($queryOut_FLT_16_Ton);
					$numRowsStand_FLT_16_Ton = mysql_num_rows($queryStand_FLT_16_Ton); 
					
					//RST 7 Ton
					$strQuery_RST_7_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 7' ORDER BY demand_suply_date";
					$strQuerySup_RST_7_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 7' ORDER BY demand_suply_date";
					$strQueryOut_RST_7_Ton = "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 7' ORDER BY demand_suply_date";
					$strQueryStand_RST_7_Ton= "SELECT demand,suply,stand_by,out_of_order,DATE_FORMAT(demand_suply_date, '%Y,%m,%d') AS graph_day FROM ctmsmis.mis_equip_demand_suply WHERE MONTH(demand_suply_date)=MONTH(NOW()) AND equipment_type='RST 7' ORDER BY demand_suply_date";
					
					$query_RST_7_Ton=mysql_query($strQuery_RST_7_Ton);
					$querySup_RST_7_Ton=mysql_query($strQuerySup_RST_7_Ton);
					$queryOut_RST_7_Ton=mysql_query($strQueryOut_RST_7_Ton);
					$queryStand_RST_7_Ton=mysql_query($strQueryStand_RST_7_Ton);
					
					$numRows_RST_7_Ton = mysql_num_rows($query_RST_7_Ton);
					$numRowsSup_RST_7_Ton = mysql_num_rows($querySup_RST_7_Ton);
					$numRowsOut_RST_7_Ton = mysql_num_rows($queryOut_RST_7_Ton);
					$numRowsStand_RST_7_Ton = mysql_num_rows($queryStand_RST_7_Ton); 
					?>
				<div class="row">
					<div id="chartContainer" style="height: 200px; width: 90%;">
					</div>
					<div id="chartContainerRTG" style="height: 200px; width: 90%;">
					</div>
					<div id="chartContainer_RST_45_Ton" style="height: 200px; width: 90%;">
					</div>
					<div id="chartContainer_FLT_16_Ton" style="height: 200px; width: 90%;">
					</div>					
					<div id="chartContainer_RST_7_Ton" style="height: 200px; width: 90%;">
					</div>
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
			while($rowSupRTG=mysql_fetch_object($querySupRTG))
			{
				$i++;
				if($i!=$numRowsSupRTG){
			?>
			{ x: new Date(<?php echo $rowSupRTG->graph_day;?>), y: <?php echo $rowSupRTG->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupRTG->graph_day;?>), y: <?php echo $rowSupRTG->suply;?> }
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
			while($rowStandRTG=mysql_fetch_object($queryStandRTG))
			{
				$i++;
				if($i!=$numRowsStandRTG){
			?>
			{ x: new Date(<?php echo $rowStandRTG->graph_day;?>), y: <?php echo $rowStandRTG->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandRTG->graph_day;?>), y: <?php echo $rowStandRTG->stand_by;?> }
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
			while($rowOutRTG=mysql_fetch_object($queryOutRTG))
			{
				$i++;
				if($i!=$numRowsOutRTG){
			?>
			{ x: new Date(<?php echo $rowOutRTG->graph_day;?>), y: <?php echo $rowOutRTG->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutRTG->graph_day;?>), y: <?php echo $rowOutRTG->out_of_order;?> }
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

	 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Daily Euipment Statement of QGC for the month of"
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
		itemclick: toggleDataSeries
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
			while($row=mysql_fetch_object($query))
			{
				$i++;
				
				if($i!=$numRows){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $row->graph_day;?>), y: <?php echo $row->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $row->graph_day;?>), y: <?php echo $row->demand;?> }
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
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}





//////////////////////
var chart_RST_45_Ton = new CanvasJS.Chart("chartContainer_RST_45_Ton", {
	animationEnabled: true,
	title:{
		text: "Daily Euipment Statement of RST 45 Ton for the month of"
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
		itemclick: toggleDataSeries_RST_45_Ton
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
			while($row_RST_45_Ton=mysql_fetch_object($query_RST_45_Ton))
			{
				$i++;
				
				if($i!=$numRows_RST_45_Ton){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $row_RST_45_Ton->graph_day;?>), y: <?php echo $row_RST_45_Ton->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $row_RST_45_Ton->graph_day;?>), y: <?php echo $row_RST_45_Ton->demand;?> }
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
			while($rowSup_RST_45_Ton=mysql_fetch_object($querySup_RST_45_Ton))
			{
				$i++;
				if($i!=$numRowsSup_RST_45_Ton){
			?>
			{ x: new Date(<?php echo $rowSup_RST_45_Ton->graph_day;?>), y: <?php echo $rowSup_RST_45_Ton->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSup_RST_45_Ton->graph_day;?>), y: <?php echo $rowSup_RST_45_Ton->suply;?> }
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
			while($rowStand_RST_45_Ton=mysql_fetch_object($queryStand_RST_45_Ton))
			{
				$i++;
				if($i!=$numRowsStand_RST_45_Ton){
			?>
			{ x: new Date(<?php echo $rowStand_RST_45_Ton->graph_day;?>), y: <?php echo $rowStand_RST_45_Ton->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStand_RST_45_Ton->graph_day;?>), y: <?php echo $rowStand_RST_45_Ton->stand_by;?> }
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
			while($rowOut_RST_45_Ton=mysql_fetch_object($queryOut_RST_45_Ton))
			{
				$i++;
				if($i!=$numRowsOut_RST_45_Ton){
			?>
			{ x: new Date(<?php echo $rowOut_RST_45_Ton->graph_day;?>), y: <?php echo $rowOut_RST_45_Ton->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOut_RST_45_Ton->graph_day;?>), y: <?php echo $rowOut_RST_45_Ton->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chart_RST_45_Ton.render();	 
function toggleDataSeries_RST_45_Ton(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart_RST_45_Ton.render();
}


//////////////////////

var chart_FLT_16_Ton = new CanvasJS.Chart("chartContainer_FLT_16_Ton", {
	animationEnabled: true,
	title:{
		text: "Daily Euipment Statement of FLT 16 Ton for the month of"
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
		itemclick: toggleDataSeries_FLT_16_Ton
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
			while($row_FLT_16_Ton=mysql_fetch_object($query_FLT_16_Ton))
			{
				$i++;
				
				if($i!=$numRows_FLT_16_Ton){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $row_FLT_16_Ton->graph_day;?>), y: <?php echo $row_FLT_16_Ton->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $row_FLT_16_Ton->graph_day;?>), y: <?php echo $row_FLT_16_Ton->demand;?> }
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
			while($rowSup_FLT_16_Ton=mysql_fetch_object($querySup_FLT_16_Ton))
			{
				$i++;
				if($i!=$numRowsSup_FLT_16_Ton){
			?>
			{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_day;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_day;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> }
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
			while($rowStand_FLT_16_Ton=mysql_fetch_object($queryStand_FLT_16_Ton))
			{
				$i++;
				if($i!=$numRowsStand_FLT_16_Ton){
			?>
			{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_day;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_day;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> }
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
			while($rowOut_FLT_16_Ton=mysql_fetch_object($queryOut_FLT_16_Ton))
			{
				$i++;
				if($i!=$numRowsOut_FLT_16_Ton){
			?>
			{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_day;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_day;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chart_FLT_16_Ton.render();	 
function toggleDataSeries_FLT_16_Ton(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart_FLT_16_Ton.render();
}



 //////////////////////
var chart_RST_7_Ton = new CanvasJS.Chart("chartContainer_RST_7_Ton", {
	animationEnabled: true,
	title:{
		text: "Daily Euipment Statement of RST 7 Ton for the month of"
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
		itemclick: toggleDataSeries_RST_7_Ton
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
			while($row_RST_7_Ton=mysql_fetch_object($query_RST_7_Ton))
			{
				$i++;
				
				if($i!=$numRows_RST_7_Ton){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $row_RST_7_Ton->graph_day;?>), y: <?php echo $row_RST_7_Ton->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $row_RST_7_Ton->graph_day;?>), y: <?php echo $row_RST_7_Ton->demand;?> }
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
			while($rowSup_RST_7_Ton=mysql_fetch_object($querySup_RST_7_Ton))
			{
				$i++;
				if($i!=$numRowsSup_RST_7_Ton){
			?>
			{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_day;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_day;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> }
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
			while($rowStand_RST_7_Ton=mysql_fetch_object($queryStand_RST_7_Ton))
			{
				$i++;
				if($i!=$numRowsStand_RST_7_Ton){
			?>
			{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_day;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_day;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> }
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
			while($rowOut_RST_7_Ton=mysql_fetch_object($queryOut_RST_7_Ton))
			{
				$i++;
				if($i!=$numRowsOut_RST_7_Ton){
			?>
			{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_day;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_day;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chart_RST_7_Ton.render();	 
function toggleDataSeries_RST_7_Ton(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart_RST_7_Ton.render();
}

 
}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>