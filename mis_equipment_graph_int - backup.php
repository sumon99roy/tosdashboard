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
					$strQueryMHC = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupMHC = "SELECT IFNULL(suply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS suply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutMHC = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandMHC = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryMHC=mysql_query($strQueryMHC);
					$querySupMHC=mysql_query($strQuerySupMHC);
					$queryOutMHC=mysql_query($strQueryOutMHC);
					$queryStandMHC=mysql_query($strQueryStandMHC);
					
					$numRowsMHC = mysql_num_rows($queryMHC);
					$numRowsSupMHC = mysql_num_rows($querySupMHC);
					$numRowsOutMHC = mysql_num_rows($queryOutMHC);
					$numRowsStandMHC = mysql_num_rows($queryStandMHC);
					
					?>
				<div class="row">
					<div id="chartContainerMHC" style="height: 200px; width: 90%;">
					</div>
				</div>
			</div>
		</div>
		
	</body>
	<script>
	window.onload = function () {
		var chartMHC = new CanvasJS.Chart("chartContainerMHC", {
		animationEnabled: true,
		title:{
			text: "Daily Euipment Statement of MHC for the month of"
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
			itemclick: toggleDataSeriesMHC
		},
		toolTip:{
			shared: true
		},
		data: [{
			name: "Demand",
			type: "line",
			yValueFormatString: "#",
			showInLegend: true,
			//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
			dataPoints: 
			[
				<?php 
				$i = 0;
				while($rowMHC=mysql_fetch_object($queryMHC))
				{
					$i++;
					
					if($i!=$numRowsMHC){
				?>
				//alert(<?php echo $i."==".$numRows; ?>);
				{ x: new Date(<?php echo $rowMHC->graph_day;?>), y: <?php echo $rowMHC->demand;?> },
				<?php
				}
				else
				{
				?>
				{ x: new Date(<?php echo $rowMHC->graph_day;?>), y: <?php echo $rowMHC->demand;?> }
				<?php
				}
				}
				?>
			]
		},
		{
			name: "Supply",
			type: "line",
			yValueFormatString: "#",
			showInLegend: true,
			dataPoints: 
			[
				<?php 
				$i = 0;
				while($rowSupMHC=mysql_fetch_object($querySupMHC))
				{
					$i++;
					if($i!=$numRowsSupMHC){
				?>
				{ x: new Date(<?php echo $rowSupMHC->graph_day;?>), y: <?php echo $rowSupMHC->suply;?> },
				<?php
				}
				else
				{
				?>
				{ x: new Date(<?php echo $rowSupMHC->graph_day;?>), y: <?php echo $rowSupMHC->suply;?> }
				<?php
				}
				}
				?>
			]
		},
		{
			name: "Stand by",
			type: "line",
			yValueFormatString: "#",
			showInLegend: true,
			dataPoints: 
			[
			
				<?php 
				$i = 0;
				while($rowStandMHC=mysql_fetch_object($queryStandMHC))
				{
					$i++;
					if($i!=$numRowsStandMHC){
				?>
				{ x: new Date(<?php echo $rowStandMHC->graph_day;?>), y: <?php echo $rowStandMHC->stand_by;?> },
				<?php
				}
				else
				{
				?>
				{ x: new Date(<?php echo $rowStandMHC->graph_day;?>), y: <?php echo $rowStandMHC->stand_by;?> }
				<?php
				}
				}
				?>
			]
		},
		{
			name: "Out of order",
			type: "line",
			yValueFormatString: "#",
			showInLegend: true,
			dataPoints: 
			[
				<?php 
				$i = 0;
				while($rowOutMHC=mysql_fetch_object($queryOutMHC))
				{
					$i++;
					if($i!=$numRowsOutMHC){
				?>
				{ x: new Date(<?php echo $rowOutMHC->graph_day;?>), y: <?php echo $rowOutMHC->out_of_order;?> },
				<?php
				}
				else
				{
				?>
				{ x: new Date(<?php echo $rowOutMHC->graph_day;?>), y: <?php echo $rowOutMHC->out_of_order;?> }
				<?php
				}
				}
				?>
			]
		}]
	});

	chartMHC.render();	 
	function toggleDataSeriesMHC(e){
		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
			e.dataSeries.visible = false;
		}
		else{
			e.dataSeries.visible = true;
		}
		chartMHC.render();
	}
}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>