<html>
	<head>
	
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");
				include("dbOracleConnection.php");
				?>
				<table>
					

				</table>
				<?php
				
				
					
					
					$strQueryFLT20 = "      
					SELECT d,d2,COUNT(id) AS cont
					  FROM 
				(
				SELECT inv_unit.id,
					(
					case 
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>0 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=240 then 1
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>240 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=480 then 2 
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>480 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=1200 then 3
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>1200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=2400 then 4
					
					
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>2400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=4800 then 5
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>4800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=7200 then 6
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>7200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=9600 then 7
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>9600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=12000 then 8
					
					
					
						when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>12000 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=14400 then 9
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>14400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=16800 then 10
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>16800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=19200 then 11
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>19200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=21600 then 12
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>21600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=24000 then 13
					else 14
					
					end
					) as s
					,
					(
					
					case 
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>0 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=240 then 1
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>240 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=480 then 2 
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>480 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=1200 then 3
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>1200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=2400 then 4
					
					
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>2400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=4800 then 5
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>4800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=7200 then 6
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>7200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=9600 then 7
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>9600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=12000 then 8
					
					
					
						when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>12000 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=14400 then 9
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>14400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=16800 then 10
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>16800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=19200 then 11
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>19200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=21600 then 12
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>21600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=24000 then 13
					else 1100
					
					end
					) as d,
				(
					
					case 
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>0 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=240 then 1
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>240 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=480 then 2 
				when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>480 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=1200 then 3
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>1200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=2400 then 4
					
					
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>2400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=4800 then 5
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>4800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=7200 then 6
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>7200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=9600 then 7
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>9600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=12000 then 8
					
					
					
						when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>12000 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=14400 then 9
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>14400 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=16800 then 10
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>16800 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=19200 then 11
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>19200 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=21600 then 12
					when extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)>21600 and extract(HOUR from CURRENT_DATE-inv_unit_fcy_visit.time_in)<=24000 then 13
					else 	1000
					
					end
					) as d2
				FROM inv_unit
				INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
				WHERE transit_state='S40_YARD' AND inv_unit.category='IMPRT' AND inv_unit.freight_kind='FCL'
				)  tbl  group by d,d2
			";		
					
					// $queryFLT20 = oci_parse($con_sparcsn4_oracle,$strQueryFLT20);
					// oci_execute($queryFLT20);


					$queryFLT20=mysqli_query($con_sparcsn4,$strQueryFLT20);
					
				

					// $numRowsFLT20 = oci_fetch_row($queryFLT20);

					$numRowsFLT20 = mysqli_num_rows($queryFLT20);

					// $results8=array();
					// $numRowsFLT20 = oci_fetch_all($queryFLT20, $results8, null, null, OCI_FETCHSTATEMENT_BY_ROW);
					// oci_free_statement($numRowCSAS); 
					// $queryFLT20= oci_parse($con_sparcsn4_oracle,$strQueryFLT20);
					// oci_execute($queryFLT20);

					// echo "$numRowsFLT20 rows fetched<br>\n";
					// var_dump($results8);
				
					$total_query = "SELECT COUNT( inv_unit.id) AS total_cont
					FROM inv_unit
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
					WHERE transit_state='S40_YARD' AND inv_unit.category='IMPRT' AND inv_unit.freight_kind='FCL'";					
					
					$str = oci_parse($con_sparcsn4_oracle,$total_query);
					oci_execute($str);
					$tot_con=0;
					while(($tot_data = oci_fetch_object($str))!= false)
					{
						$tot_con=$tot_data->TOTAL_CONT;

					}

				
					
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
		dataPoints: 
		[
			
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
	
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
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
					(CASE WHEN inv_goods.destination  NOT IN ('2591','2592','5235') AND inv_unit.remark!='CPA TO OFFDOCK' THEN 1 ELSE 0 END) AS offdock,
					(CASE WHEN inv_goods.destination  IS NULL THEN 1 ELSE 0 END) AS others,


					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_goods.destination IN ('2591')  THEN 1 ELSE 0 END) AS cpa_tues_20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2) IN (40,45) AND inv_goods.destination IN ('2591')  THEN 2 ELSE 0 END) AS cpa_tues_40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_goods.destination IN ('2592')  THEN 1 ELSE 0 END) AS icd_tues_20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2) IN (40,45)  AND inv_goods.destination IN ('2592')  THEN 2 ELSE 0 END) AS icd_tues_40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_goods.destination IN ('5235')  THEN 1 ELSE 0 END) AS pangaon_tues_20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2) IN (40,45)  AND inv_goods.destination IN ('5235')  THEN 2 ELSE 0 END) AS pangaon_tues_40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_goods.destination NOT IN ('2591','2592','5235') AND inv_unit.remark!='CPA TO OFFDOCK'  THEN 1 ELSE 0 END) AS offdock_tues_20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2) IN (40,45)  AND inv_goods.destination NOT IN ('2591','2592','5235') AND inv_unit.remark!='CPA TO OFFDOCK'  THEN 2 ELSE 0 END) AS offdock_tues_40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_goods.destination IS NULL  THEN 1 ELSE 0 END) AS others_tues_20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2) IN (40,45)  AND inv_goods.destination IS NULL  THEN 2 ELSE 0 END) AS others_tues_40

						
					FROM inv_unit
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
					INNER JOIN inv_goods ON inv_goods.gkey = inv_unit.goods 
					
					INNER JOIN ref_equipment ON ref_equipment.gkey=inv_unit.eq_gkey
				INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey  
					WHERE transit_state='S40_YARD' AND inv_unit.category='IMPRT' AND inv_unit.freight_kind='FCL'
					)tbl";
			
			 $res_tbl1 = oci_parse($con_sparcsn4_oracle,$strQuery);
			 oci_execute($res_tbl1);

		

			$cpa = 0;
			$icd = 0;
			$pangoan= 0;
			$offdock = 0;
			$others = 0;
			$total=0; 
			$i=0;	
			
			while(($row = oci_fetch_object($res_tbl1))!= false)
			{

	


			$i++;
				$total=$row->CPA+$row->ICD+$row->PANGOAN+$row->OFFDOCK+$row->OTHERS;
						
			

			$cpa = $row->CPA;
			$icd = $row->ICD;
			$pangoan=  $row->PANGOAN;
			$offdock = $row->OFFDOCK;
			$others = $row->OTHERS;
			$cpa_tues = $row->CPA_TUES;
			$icd_tues = $row->ICD_TUES;
			$pangaon_tues = $row->PANGAON_TUES;
			$offdock_tues = $row->OFFDOCK_TUES;
			$others_tues = $row->OTHERS_TUES;
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
	<?php oci_close($con_sparcsn4_oracle); ?>
</html>
