<html>
	<head>
		 <meta http-equiv="refresh" content="20">
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
						<td colspan="12"><font size="5"><b>Month Wise Berth Occupancy of Vessel at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<table width="100%" border ='1' cellpadding='0' cellspacing='0'>					
					<tr align="center" bgcolor="#D8D0CE">
						<td><b>SlNo.</b></td>
						<td><b>Month Name</b></td>
						<td><b>Total Vessel</b></td>
						<td><b>Total Occupied Time (HRs.)</b></td>
						<td><b>Average Occupied Time (HRs.) per vessl</b></td>
					</tr>

				<?php

					//echo$vvdGkey;
					$strQuery = "SELECT mName,COUNT(ib_vyg) AS totVsl,ROUND(SUM(diff),2) AS totOcupay,
					ROUND((SELECT SUM(diff)/COUNT(ib_vyg)),2) AS avgOcupay
					FROM(
					SELECT ib_vyg,ata,atd,MONTH(ata) AS mnt,MONTHNAME(ata) AS mName,(TIMESTAMPDIFF(SECOND,ata,IFNULL(atd,NOW()))/3600) AS diff
					FROM sparcsn4.argo_carrier_visit
					INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
					WHERE DATE(sparcsn4.argo_carrier_visit.ata) BETWEEN CONCAT(YEAR(NOW()),'-01-01') AND CONCAT(YEAR(NOW()),'-12-31')
					ORDER BY ata
					) AS tbl GROUP BY mName ORDER BY mnt";
					
					//echo $strQuery;
					$query=mysql_query($strQuery);
					$numRows = mysql_num_rows($query);
					$i=0;
					$x= 0;
					$y= 0;
					$dataPoints = array();
					while($row=mysql_fetch_object($query)){
					$i++;												
					$x +=10;
					$y =$row->avgOcupay;
					//$dataPoints[$x] = $y;
					$arr = array("label"=> $row->mName, "y"=> $y);
					array_push($dataPoints, $arr);
					
					
				?>
				
				<tr align="center">
						<td><?php  echo $i;?></td>
						<td><?php if($row->mName) echo $row->mName; else echo "&nbsp;";?></td>
						<td><?php if($row->totVsl) echo $row->totVsl; else echo "&nbsp;";?></td>	
						<td><?php if($row->totOcupay) echo $row->totOcupay; else echo "&nbsp;";?></td>	
						<td><?php if($row->avgOcupay) echo $row->avgOcupay; else echo "&nbsp;";?></td>	
				</tr>
				<?php } //print_r($dataPoints);?>
				<!--tr align="center">
						<th colspan="7">Total</th>
						<th><?php echo $tImpB; ?></th>
						<th><?php echo $tImpT; ?></th>
						<th><?php echo $tDischB; ?></th>
						<th><?php echo $tDischT; ?></th>
						<th><?php echo $tBalB; ?></th>
						<th><?php echo $tBalT; ?></th>
						
						<th><?php echo $tExpB; ?></th>
						<th><?php echo $tExpT; ?></th>
						<th><?php echo $tLdB; ?></th>
						<th><?php echo $tLdT; ?></th>
						<th><?php echo $tLdBalB; ?></th>
						<th><?php echo $tLdBalT; ?></th>						
				</tr-->
				</table>
			</div>
			<div>
				<br/>
			</div>
			<script>
			window.onload = function () {
			 
			var chart = new CanvasJS.Chart("chartContainer", {
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
			</script>
			<div align="center" id="chartContainer" style="height: 350px; width: 60%; margin: auto;"></div>
			<script src="canvasjs.min.js"></script>
		</div>
		<?php mysql_close($con_sparcsn4); ?>
		<?php include('footer.php'); ?>
	</body>
</html>