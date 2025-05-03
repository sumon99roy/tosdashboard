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
						<td colspan="12"><font size="5"><b>Yard/Terminal Wise Handling Performance at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<table align="center" width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">		
					<tr>
					  <th rowspan="2">TERMINAL</th>
					  <th colspan="4">IMPORT</th>
					  <th colspan="4">EXPORT</th>
					  <th colspan="2">TOTAL (IMP+EXP)</th>
					  <th rowspan="2">PERCENTAGE(%) BOX</th>
					</tr>
					<tr>
					  <th>20'</th>
					  <th>40'/45'</th>
					  <th>Box</th>
					  <th>TEUs</th>
					  
					  <th>20'</th>
					  <th>40'/45'</th>
					  <th>Box</th>
					  <th>TEUs</th>
					  
					  <th>Box</th>
					  <th>TEUs</th>
					</tr>
					<?php

					//echo$vvdGkey;
					$strQuery = "SELECT berth,SUM(imp20) AS imp20,SUM(imp40) AS imp40,(SUM(imp20)+SUM(imp40)*2) AS impteus,SUM(exp20) AS exp20,SUM(exp40) AS exp40,(SUM(exp20)+SUM(exp40)*2) AS expteus
					FROM (
					SELECT sparcsn4.inv_unit.id,sparcsn4.vsl_vessel_visit_details.ib_vyg,LEFT(sparcsn4.argo_quay.id,3) AS berth,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 THEN 1 ELSE 0 END)  AS imp20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 THEN 1 ELSE 0 END)  AS imp40,
					0 AS exp20,0 AS exp40
					FROM sparcsn4.inv_unit
					INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.argo_carrier_visit ON sparcsn4.argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ib_cv
					INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
					INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
					INNER JOIN sparcsn4.argo_quay ON sparcsn4.argo_quay.gkey=sparcsn4.vsl_vessel_berthings.quay
					INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey
					INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey
					WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND DATE(sparcsn4.argo_carrier_visit.ata)=DATE(NOW())

					UNION ALL

					SELECT sparcsn4.inv_unit.id,sparcsn4.vsl_vessel_visit_details.ib_vyg,LEFT(sparcsn4.argo_quay.id,3) AS berth,
					0 AS imp20, 0 AS imp40,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 THEN 1 ELSE 0 END)  AS exp20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 THEN 1 ELSE 0 END)  AS exp40
					FROM sparcsn4.inv_unit
					INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.argo_carrier_visit ON sparcsn4.argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ob_cv
					INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
					INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
					INNER JOIN sparcsn4.argo_quay ON sparcsn4.argo_quay.gkey=sparcsn4.vsl_vessel_berthings.quay
					INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey
					INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey
					WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND sparcsn4.inv_unit_fcy_visit.transit_state !='S20_INBOUND'
					 ) AS imptbl GROUP BY berth";
					
					//echo $strQuery;
					$query=mysql_query($strQuery);
					$query2=mysql_query($strQuery);
					
					$total=0; 		
					while($row=mysql_fetch_object($query)){ 
						$total=$total+$row->imp20+$row->imp40+$row->exp20+$row->exp40;
					}					
					
					$imp20 = 0;
					$imp40 = 0;
					$exp20 = 0;
					$exp40 = 0;
					$i=0;
					$cct = 0;
					$gcb = 0;
					$nct = 0;
					while($row=mysql_fetch_object($query2)){ 	
					$i++;
					$imp20 += $row->imp20;
					$imp40 += $row->imp40;
					$exp20 +=  $row->exp20;
					$exp40 += $row->exp40;
					$terminal_total_handling=$row->imp20+$row->imp40+$row->exp20+$row->exp40;?>
					<tr>
						  <td align="center"><?php echo $row->berth; ?></td>
						  <td align="center"><?php echo $row->imp20; ?></td>
						  <td align="center"><?php echo $row->imp40; ?></td>
						  <td align="center"><?php echo $row->imp20+$row->imp40; ?></td>
						  <td align="center"><?php echo $row->impteus; ?></td>
						  <td align="center"><?php echo $row->exp20; ?></td>
						  <td align="center"><?php echo $row->exp40; ?></td>
						  <td align="center"><?php echo $row->exp20+$row->exp40; ?></td>
						  <td align="center"><?php echo $row->expteus; ?></td>
						  <td align="center"><?php echo  $row->imp20+$row->imp40+$row->exp20+$row->exp40; ?></td>
						  <td align="center"><?php echo $row->impteus+$row->expteus; ?></td>
						<td align="center">
						<?php 
							$result =(($terminal_total_handling/$total)*100); 
							echo round($result,2)."%";  
							if($i==1)
								$cct = $result;
							else if($i==2)
								$gcb = $result;
							else if($i==3)
								$nct = $result;
						?>
						</td>					  
					</tr>
					<?php }?>	
						
					<tr>
						<th align="center">Grand Total</th>
						<th align="center"><?php echo $imp20; ?></th>
						<th align="center"><?php echo $imp40; ?></th>
						<th align="center"><?php echo $imp20+$imp40; ?></th>
						<th align="center"><?php echo $imp20+$imp40*2; ?></th>
						<th align="center"><?php echo $exp20; ?></th>
						<th align="center"><?php echo $exp40; ?></th>
						<th align="center"><?php echo $exp20+$exp40; ?></th>
						<th align="center"><?php echo $exp20+$exp40*2; ?></th>
						<th align="center"><?php echo  $imp20+$imp40+$exp20+$exp40; ?></th>
						<th align="center"><?php echo $imp20+$imp40*2+$exp20+$exp40*2; ?></th>						  
					</tr>
					</table>
			</div>
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
			  ['CCT', <?php echo $cct;?>],
			  ['GCB', <?php echo $gcb;?>],
			  ['NCT', <?php echo $nct;?>]
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
	</body>
</html>