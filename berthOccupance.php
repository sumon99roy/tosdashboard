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
			<br>
				<?php include("dbConection.php");?>
				<?php include("dbOracleConnection.php");?>
				<form action="" method="post">
				<select name="selected_year">
							
							  <option value="">-- SELECT YEAR --</option>
							  <?php 
							  
							  $initial = date("Y");
							  $last = $initial-20;
							  for($initial;$initial>=$last;$initial--)
							  {
							  ?>
							  <option value="<?php echo $initial; ?>"><?php echo $initial; ?></option>
							  <?php } ?>
							</select>
							<button type="submit">Search</button>
							</form>
							
							<?php
				
					$getYear=date('Y');
					
					if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					{ 
						$getYear=$_POST['selected_year'];
					}
				?>
				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Month Wise Berth Occupancy of Vessel at </b></font><font size="4"><?php 
						if($getYear==date("Y")){echo date("d/m/Y h:i:s");} else{echo $getYear;}?></font></td>
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

					

					$strQuery = "
					SELECT mName,COUNT(ib_vyg) AS totVsl,ROUND(SUM(diff),2) AS totOcupay,ROUND(( SUM(diff)/COUNT(ib_vyg)),2) AS avgOcupay
					FROM(
					SELECT ib_vyg,ata,atd,
					 EXTRACT(month FROM argo_carrier_visit.ata) as mnt,
					  to_char(argo_carrier_visit.ata,'Mon')  AS mName, 
					extract(SECOND from argo_carrier_visit.atd-argo_carrier_visit.ata) as diff
					FROM argo_carrier_visit
					INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
					WHERE cast(argo_carrier_visit.ata as date) BETWEEN to_date(CONCAT($getYear,'-01-01'),'YYYY -MM-DD' ) AND to_date(CONCAT($getYear,' -12-31'),'YYYY -MM-DD')  
					
					ORDER BY ata
					)  tbl Group By mName
					 ";
					
					
					$query = oci_parse($con_sparcsn4_oracle, $strQuery);
					oci_execute($query);

				

					$i=0;
					$x= 0;
					$y= 0;
					$dataPoints = array();
					while(($row = oci_fetch_object($query))!= false)
					{

				
					$i++;												
					$x +=10;
					$y =$row->AVGOCUPAY;
				
					$arr = array("label"=> $row->MNAME, "y"=> $y);
					array_push($dataPoints, $arr);
					
					
				?>
				
				<tr align="center">
						<td><?php  echo $i;?></td>
						<td><?php if($row->MNAME) echo $row->MNAME; else echo "&nbsp;";?></td>
						<td><?php if($row->TOTVSL) echo $row->TOTVSL; else echo "&nbsp;";?></td>	
						<td><?php if($row->TOTOCUPAY) echo $row->TOTOCUPAY; else echo "&nbsp;";?></td>	
						<td><?php if($row->AVGOCUPAY) echo $row->AVGOCUPAY; else echo "&nbsp;";?></td>	
				</tr>
				<?php }
				
			?>
			
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
		<?php mysqli_close($con_sparcsn4); ?>
		<?php oci_close($con_sparcsn4_oracle); ?>
		<?php include('footer.php'); ?>
	</body>
</html>