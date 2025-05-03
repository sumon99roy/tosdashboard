<html>
	<head>
		 <!--meta http-equiv="refresh" content="20"-->
		 <script src="canvasjs.min.js"></script>
			 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
			 <!-- SOURAV
				* Canvas JS start month from 0 - 11 
				* So In Query 1 Month subtract
			 -->
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");?>
				<table>
					<!--tr style="margin:5px;">
						<td colspan="7"><font size="5">Day Wise Container</font><font size="4"></font></td>
					</tr-->

				</table>
				<?php
					//FLT 20 - start
					// $strQueryFLT20 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					// (
					// SELECT 
					// (SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,
					// (SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					// (SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					// (SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					// DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					// FROM (
						// SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						// FROM
						// (SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							// UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							// UNION SELECT 8 UNION SELECT 9 ) d,
						// (SELECT 0 b UNION SELECT 10 UNION SELECT 20
							// UNION SELECT 30 UNION SELECT 40) m
						// WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							// ORDER BY a + b
					// ) AS mytable ORDER BY dt) AS tbl";	
					
					$strQueryFLT20 = "SELECT d,COUNT(id) AS cont FROM 
(
SELECT sparcsn4.inv_unit.id,
(SELECT 
	CASE 
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>0 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=10 THEN 1
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>10 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=20 THEN 2
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>20 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=50 THEN 3
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>50 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=100 THEN 4
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>100 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=200 THEN 5
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>200 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=300 THEN 6
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>300 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=400 THEN 7
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>400 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=500 THEN 8
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>500 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=600 THEN 9
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>600 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=700 THEN 10
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>700 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=800 THEN 11
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>800 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=900 THEN 12
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>900 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=1000 THEN 13
	ELSE
	14
	END 
) AS s,
(SELECT 
	CASE 
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>0 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=10 THEN 10
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>10 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=20 THEN 20
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>20 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=50 THEN 50
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>50 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=100 THEN 100
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>100 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=200 THEN 200
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>200 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=300 THEN 300
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>300 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=400 THEN 400
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>400 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=500 THEN 500
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>500 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=600 THEN 600
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>600 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=700 THEN 700
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>700 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=800 THEN 800
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>800 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=900 THEN 900
	WHEN TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>900 AND TIMESTAMPDIFF(DAY,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=1000 THEN 1000
	ELSE
	1100
	END 
) AS d 
FROM sparcsn4.inv_unit
INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
WHERE transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' AND sparcsn4.inv_unit.freight_kind='FCL'
) AS tbl GROUP BY d ORDER BY s";					
					
					$queryFLT20=mysql_query($strQueryFLT20);

					$numRowsFLT20 = mysql_num_rows($queryFLT20);

					//FLT 20 - end
					
					?>
				<div class="row">
					<div id="chartContainerFLT20" style="height: 400px; width: 100%;">
					</div>
					<br>
				</div>
				<div class="row">
					<b>Y Axis showing Quantity of Lying Container and X Axis showing Lying Day<br> 1100 means 1000+ days</b>
				</div>
				</div>
			</div>
		</div>
		
	</body>
	<?php //echo $numRowsFLT20;?>
	<script>
	 window.onload = function () {

var chartFLT20 = new CanvasJS.Chart("chartContainerFLT20", {
	animationEnabled: true,
	title:{
		text: "Day Wise Lying Container"
	},
	axisX: {
		valueFormatString: "#"
	},
	axisY: {
		title: "Quantity of Lying Container",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT20
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Container",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			/*{x:4,y:5},
			{x:5,y:8},
			{x:6,y:5},
			{x:8,y:19},
			{x:9,y:30},
			{x:10,y:12},
			{x:11,y:63},
			{x:12,y:14},
			{x:13,y:85},
			{x:14,y:21},
			{x:15,y:69},
			{x:16,y:15}
			*/
			<?php
			$i=0;
			while($row= mysql_fetch_object($queryFLT20))		
			{
				$day = $row->d;
				$cont = $row->cont;
				$i++;
				if($i!=$numRowsFLT20)
				{
			?>
					//{x:10,y:50},
					{x:parseInt(<?php echo $day;?>),y:parseInt(<?php echo $cont;?>)},
			<?php
				}
				else
				{	
				//$day = $day."-";
				?>
					//{x:1000,y:200}
					{x:parseInt(<?php echo $day;?>),y:parseInt(<?php echo $cont;?>)}
				<?php
				}
				//$i++;
			}
			?>
		]
	}]
});

chartFLT20.render();	 
function toggleDataSeriesFLT20(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT20.render();
}

}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>