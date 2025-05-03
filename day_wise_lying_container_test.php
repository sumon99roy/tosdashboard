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
					
					$strQueryFLT20 = "SELECT d2, d,COUNT(id) AS cont FROM 
					(
					SELECT sparcsn4.inv_unit.id,
					(SELECT 
							CASE 
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>0 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=240 THEN 1
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>240 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=480 THEN 2
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>480 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=1200 THEN 3
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>1200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=2400 THEN 4
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>2400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=4800 THEN 5
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>4800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=7200 THEN 6
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>7200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=9600 THEN 7
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>9600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=12000 THEN 8
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>12000 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=14400 THEN 9
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>14400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=16800 THEN 10
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>16800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=19200 THEN 11
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>19200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=21600 THEN 12
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>21600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=24000 THEN 13
						ELSE
						14
						END 
					) AS s,
					(SELECT 
						CASE 
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>0 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=240 THEN 10
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>240 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=480 THEN 20
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>480 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=1200 THEN 50
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>1200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=2400 THEN 100
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>2400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=4800 THEN 200
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>4800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=7200 THEN 300
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>7200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=9600 THEN 400
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>9600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=12000 THEN 500
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>12000 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=14400 THEN 600
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>14400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=16800 THEN 700
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>16800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=19200 THEN 800
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>19200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=21600 THEN 900
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>21600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=24000 THEN 1000
						ELSE
						1100
						END 
					) AS d,
					(SELECT 
						CASE 
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>0 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=240 THEN 0
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>240 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=480 THEN 10
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>480 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=1200 THEN 20
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>1200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=2400 THEN 50
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>2400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=4800 THEN 100
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>4800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=7200 THEN 200
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>7200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=9600 THEN 300
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>9600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=12000 THEN 400
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>12000 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=14400 THEN 500
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>14400 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=16800 THEN 600
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>16800 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=19200 THEN 700
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>19200 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=21600 THEN 800
						WHEN TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())>21600 AND TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW())<=24000 THEN 900
						ELSE
						1000
						END 
					) AS d2 
					FROM sparcsn4.inv_unit
					INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
					WHERE transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' AND sparcsn4.inv_unit.freight_kind='FCL'
					) AS tbl GROUP BY d ORDER BY s";					
					
					$queryFLT20=mysql_query($strQueryFLT20);

					$numRowsFLT20 = mysql_num_rows($queryFLT20);
					$total_query = "SELECT COUNT( sparcsn4.inv_unit.id) AS total_cont
						FROM sparcsn4.inv_unit
						INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
						WHERE transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' AND sparcsn4.inv_unit.freight_kind='FCL'";					
					
					$str=mysql_query($total_query);
					$tot_data= mysql_fetch_object($str);
					$tot_con=$tot_data->total_cont;
//echo $tot_con;
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
					<div class="row">
						<div align="center" id="barchartContainer" style="height: 350px; width: 50%; margin: auto;float:left"></div>
						<div align="center" id="barchartContainer1" style="height: 350px; width: 50%; margin: auto;float:right"></div>
						<script src="canvasjs.min.js"></script>
					</div>
					<div class="row">
						<div align="center" id="barchartContainer2" style="height: 350px; width: 50%; margin: auto;float:left"></div>
						<!--script src="canvasjs.min.js"></script-->
					</div>
					
				</div>
			</div>
		
	</body>
	<?php //echo $numRowsFLT20;?>
	<script>
	 window.onload = function () {

var chartFLT20 = new CanvasJS.Chart("chartContainerFLT20", {
	animationEnabled: true,
	backgroundColor: "#F5DEB3",
	title:{
		text: "Day Wise Lying Container"
	},
	axisX: {
		title: "Number of Days",
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
		name: "Total Containers: "+<?php echo $tot_con;?>,
		type: "spline",
		xValueFormatString: "Day:#",
		yValueFormatString: "#",
		showInLegend: true,
		click: onClick, 
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
			$dataPoints = array();
			$dataPoints1 = array();
			$dataPoints2 = array();
			$cont1 = 0;
			$co2 = 0;
			$cont2 = 0;
			while($row= mysql_fetch_object($queryFLT20))		
			{
				$day = $row->d;
				$day2 = $row->d2;
				$cont = $row->cont;
				$cont1 += $row->cont;
				
				$co2=$tot_con-$cont2;

				$i++;
				$strDays = "";
				$strDays1 = "";
				$strDays2 = "";
				if($day==10)
					$strDays = "0-10 days";
				else if($day==20)
					$strDays = "11-20 days";
				else if($day==50)
					$strDays = "21-50 days";
				else if($day==100)
					$strDays = "51-100 days";
				else if($day==200)
					$strDays = "101-200 days";
				else if($day==300)
					$strDays = "201-300 days";
				else if($day==400)
					$strDays = "301-400 days";
				else if($day==500)
					$strDays = "401-500 days";
				else if($day==600)
					$strDays = "501-600 days";
				else if($day==700)
					$strDays = "601-700 days";
				else if($day==800)
					$strDays = "701-800 days";
				else if($day==900)
					$strDays = "801-900 days";
				else if($day==1000)
					$strDays = "901-1000 days";
				else
					$strDays = "1000+ days";
				
				if($day==1100)
					$strDays1 = "1000+";
				else
					$strDays1 = $day;	
				if($day2==1000)
					$strDays2 = "900+";
				else
					$strDays2 = $day2;
				
				$arr = array("label"=> $strDays, "y"=> $cont);
				$arr1 = array("label"=> $strDays1, "y"=> $cont1);
				$arr2 = array("label"=> $strDays2, "y"=> $co2);
				array_push($dataPoints, $arr);
				array_push($dataPoints1, $arr1);
				array_push($dataPoints2, $arr2);
				if($i!=$numRowsFLT20)
				{
			?>
					//{x:10,y:50},
					{x:parseInt(<?php echo $day;?>),y:parseInt(<?php echo $cont;?>),link:"LyingContainerListFromChart.php?p=<?php echo $day;?>"},
			<?php
				}
				else
				{	
				//$day = $day."-";
				?>
					//{x:1000,y:200}
					{x:parseInt(<?php echo $day;?>),y:parseInt(<?php echo $cont;?>),link:"LyingContainerListFromChart.php?p=<?php echo $day;?>"}
				<?php
				}
				//$i++;
				$cont2 += $row->cont;
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
loadbarchart();
loadbarchart1();
loadbarchart2();
}	

function onClick(e){ 
        window.open(e.dataPoint.link,'_blank');  
};

function loadbarchart() {
			 
var chart = new CanvasJS.Chart("barchartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	/*title:{
		text: "Simple Column Chart with Index Labels"
	},*/
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}

function loadbarchart1() {
			 
var chart = new CanvasJS.Chart("barchartContainer1", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	/*title:{
		text: "Simple Column Chart with Index Labels"
	},*/
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}

function loadbarchart2() {
			 
var chart = new CanvasJS.Chart("barchartContainer2", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	/*title:{
		text: "Simple Column Chart with Index Labels"
	},*/
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
	
	
	
	<?php

			//echo$vvdGkey;
			$strQuery = "SELECT  SUM(cpa)AS cpa, SUM(icd)AS icd, SUM(pangoan)AS pangoan, SUM(offdock)AS offdock, 
						SUM(others) AS others,
						SUM(cpa_tues_20)+SUM(cpa_tues_40) AS cpa_tues,
						SUM(icd_tues_20)+SUM(icd_tues_40) AS icd_tues,
						SUM(pangaon_tues_20)+SUM(pangaon_tues_40) AS pangaon_tues,
						SUM(offdock_tues_20)+SUM(offdock_tues_40) AS offdock_tues,
						SUM(others_tues_20)+SUM(others_tues_40) AS others_tues

						FROM 
						( SELECT
						(CASE WHEN inv_goods.destination IN ('2591') THEN 1 ELSE 0 END) AS cpa,
						(CASE WHEN inv_goods.destination IN ('2592') THEN 1 ELSE 0 END) AS icd,
						(CASE WHEN inv_goods.destination IN ('5235') THEN 1 ELSE 0 END) AS pangoan,
						(CASE WHEN inv_goods.destination  NOT IN ('2591','2592','5235') THEN 1 ELSE 0 END) AS offdock,
						(CASE WHEN inv_goods.destination  IS NULL THEN 1 ELSE 0 END) AS others,


						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND inv_goods.destination IN ('2591')  THEN 1 ELSE 0 END) AS cpa_tues_20,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2) IN (40,45) AND inv_goods.destination IN ('2591')  THEN 2 ELSE 0 END) AS cpa_tues_40,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND inv_goods.destination IN ('2592')  THEN 1 ELSE 0 END) AS icd_tues_20,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2) IN (40,45)  AND inv_goods.destination IN ('2592')  THEN 2 ELSE 0 END) AS icd_tues_40,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND inv_goods.destination IN ('5235')  THEN 1 ELSE 0 END) AS pangaon_tues_20,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2) IN (40,45)  AND inv_goods.destination IN ('5235')  THEN 2 ELSE 0 END) AS pangaon_tues_40,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND inv_goods.destination NOT IN ('2591','2592','5235')  THEN 1 ELSE 0 END) AS offdock_tues_20,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2) IN (40,45)  AND inv_goods.destination NOT IN ('2591','2592','5235')  THEN 2 ELSE 0 END) AS offdock_tues_40,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND inv_goods.destination IS NULL  THEN 1 ELSE 0 END) AS others_tues_20,
						(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2) IN (40,45)  AND inv_goods.destination IS NULL  THEN 2 ELSE 0 END) AS others_tues_40

							
						FROM sparcsn4.inv_unit
						INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
						INNER JOIN sparcsn4.inv_goods ON inv_goods.gkey = inv_unit.goods 
						INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey
						INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
						INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 
						WHERE transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' AND sparcsn4.inv_unit.freight_kind='FCL'
						) AS tbl ";
			
			//echo $strQuery;
			$query=mysql_query($strQuery);
			//$query2=mysql_query($strQuery);
			$cpa = 0;
			$icd = 0;
			$pangoan= 0;
			$offdock = 0;
			$others = 0;
			$total=0; 
			$i=0;	
			
			while($row=mysql_fetch_object($query)){ 
			$i++;
				$total=$row->cpa+$row->icd+$row->pangoan+$row->offdock+$row->others;
				//	ECHO $total;			
			

		/* 	$i=0;
			$cct = 0;
			$gcb = 0;
			$nct = 0; */
			/* while($row=mysql_fetch_object($query2)){ 
SUM(cpa_tues_20)+SUM(cpa_tues_20) AS cpa_tues,
SUM(icd_tues_20)+SUM(icd_tues_40) AS icd_tues,
SUM(pangaon_tues_20)+SUM(pangaon_tues_40) AS pangaon_tues,
SUM(offdock_tues_20)+SUM(offdock_tues_40) AS offdock_tues			
			$i++; */
			$cpa = $row->cpa;
			$icd = $row->icd;
			$pangoan=  $row->pangoan;
			$offdock = $row->offdock;
			$others = $row->others;
			$cpa_tues = $row->cpa_tues;
			$icd_tues = $row->icd_tues;
			$pangaon_tues = $row->pangaon_tues;
			$offdock_tues = $row->offdock_tues;
			$others_tues = $row->others_tues;
			//$terminal_total_handling=$row->imp20+$row->imp40+$row->exp20+$row->exp40; 
			} 
			

			
			$cpa_per=(($cpa/$total)*100);
			$icd_per=(($icd/$total)*100);
			$pangoan_per=(($pangoan/$total)*100);
			$offdock_per=(($offdock/$total)*100);
			$others_per=(($others/$total)*100);
			
			?>
					
			</div>
			<div id="piechart" align="center" style="float:left; padding-left: 200px;"></div>
			<div align="left" style="float:left;">
				<table border=0>
					<tr align="center" >
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
					</tr>
					<tr align="center" >
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
					</tr>
					<tr align="center" >
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
						<td><b>&nbsp;</b></td>
					</tr>
					</table>
					<table border="1">
					 <tr align="center" bgcolor="#D8D0CE">
						<td rowspan="2"><b>LOCATION.</b></td>
						<td colspan="2"><b>CONTAINER</b></td>
					</tr> 
					<tr align="center" bgcolor="#D8D0CE">
						<td><b>BOX</b></td>
						<td><b>TEUS</b></td>
					</tr>
					<tr align="center">
						<td>CPA</td>
						<td><?php echo $cpa;?></td>
						<td><?php echo $cpa_tues;?></td>
					</tr>
					<tr align="center">
						<td>ICD</td>
						<td><?php echo $icd;?></td>
						<td><?php echo $icd_tues;?></td>
					</tr>
					<tr align="center">
						<td>PANGAON</td>
						<td><?php echo $pangoan;?></td>
						<td><?php echo $pangaon_tues;?></td>
					</tr>
					<tr align="center">
						<td>OFFDOCK</td>
						<td><?php echo $offdock;?></td>
						<td><?php echo $offdock_tues;?></td>
					</tr>
					<tr align="center">
						<td>EPZ & OTHERS</td>
						<td><?php echo $others;?></td>
						<td><?php echo $others_tues;?></td>
					</tr>
					<tr align="center">
						<td><b>TOTAL</b></td>
						<td><b><?php echo $cpa+$icd+$pangoan+$offdock+$others;?></b></td>
						<td><b><?php echo $cpa_tues+$icd_tues+$pangaon_tues+$offdock_tues+$others_tues;?></b></td>
					</tr>
					
				</table>

			</div>
			<div  style="width:100%; overflow:hidden;"><?php include('footer.php'); ?></div>

			<script type="text/javascript" src="loader.js"></script>

			<script type="text/javascript">
			// Load google charts
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
		//	alert(<?php echo $cpa_per;?>);
			// Draw the chart and set the chart values
			function drawChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'Percentage per Day'],
			  ['CPA', <?php echo $cpa_per;?>],
			  ['ICD', <?php echo $icd_per;?>],
			  ['PANGAON', <?php echo $pangoan_per;?>],
			  ['OFFDOCK', <?php echo $offdock_per;?>],
			  ['EPZ & OTHERS', <?php echo $others_per;?>]
			]);
			
			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'Lying Container Percentage', 'width':550, 'height':400};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			  chart.draw(data, options);
			}
			</script>
	<?php mysql_close($con_sparcsn4); ?>

</html>
