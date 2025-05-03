<html>
	<head>
		 <meta http-equiv="refresh" content="120">
		 <style>
			body{font-family: "Calibri";}
		 </style>
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#strDt, #endDt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd' // ISO format
            });
        });
    </script>
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>
			
			<div align="center">
			<?php
			
			$strDt = isset($_POST['strDt']) ? $_POST['strDt'] : date('Y-m-d');
			$endDt = isset($_POST['endDt']) ? $_POST['endDt'] : date('Y-m-d');
?>	
        <form action="" method="POST">
            <table>
			<br/>
                <tr style="margin:5px;">
                    <td align="center" colspan="7">
                        From Date: 
                        <input type="text" style="width:150px;" id="strDt" name="strDt" autocomplete="off" value="<?php echo $strDt; ?>" />
                        To Date: 
                        <input type="text" style="width:150px;" id="endDt" name="endDt" autocomplete="off" value="<?php echo $endDt; ?>" />
						<button type="submit" 
                                style="background-color: #4CAF50; color: white; padding: 4px 10px; border: 0; cursor: pointer;" 
                                onmouseover="this.style.backgroundColor='#45a049'; this.style.color='black';"
                                onmouseout="this.style.backgroundColor='#4CAF50'; this.style.color='white';">
                            Search
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>


<div align="center">
				<?php include("dbConection.php");?>
				<?php include("dbOracleConnection.php");?>
				
				<?php if ($_SERVER['REQUEST_METHOD'] == 'POST')
					{
						$strDt=date_create($_POST['strDt']);
						$strDt= date_format($strDt, 'd/m/Y');
                        $endDt=date_create($_POST['endDt']);
						$endDt= date_format($endDt, 'd/m/Y');
						 ?>
				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Terminal Handling Percentage From </b></font><font size="4"><?php echo $strDt;?> <b>To</b> <?php echo $endDt;?></font></td>
					</tr>
				</table>
				<?php }else{?>
				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Terminal Handling Percentage From </b></font><font size="4"><?php echo date("d/m/Y")." 00:00:00"?> <b>To</b> <?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<?php }?>
				
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

			
					/*$strQuery = "
					SELECT vvd_gkey,SUM(imp20) AS imp20,SUM(imp40) AS imp40,(SUM(imp20)+SUM(imp40)*2) AS impteus,SUM(exp20) AS exp20,SUM(exp40) AS exp40,(SUM(exp20)+SUM(exp40)*2) AS expteus
					FROM (
					SELECT inv_unit.id,vsl_vessel_visit_details.vvd_gkey as vvd_gkey, 

					(CASE WHEN
					substr(ref_equip_type.nominal_length,-2)=20 AND
					cast(inv_unit_fcy_visit.time_in as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS imp20,				

					(CASE WHEN
					substr(ref_equip_type.nominal_length,-2)!=20
					AND cast(inv_unit_fcy_visit.time_in as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS imp40,

					0 AS exp20,0 AS exp40
					FROM inv_unit
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
					INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ib_cv
					INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
					INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
					INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay
					INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
					INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey
					WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING')

					UNION ALL

					SELECT inv_unit.id,vsl_vessel_visit_details.vvd_gkey, 0 AS imp20, 0 AS imp40,

					(CASE WHEN
					substr(ref_equip_type.nominal_length,-2)=20 AND
					cast(inv_unit_fcy_visit.time_load as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS exp20,				

					(CASE WHEN
					substr(ref_equip_type.nominal_length,-2)!=20
					AND cast(inv_unit_fcy_visit.time_load as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS exp40



					FROM inv_unit
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
					INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
					INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
					INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
					INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay

					INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
					INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey    
													
					WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND inv_unit_fcy_visit.transit_state !='S20_INBOUND'

					) imptbl GROUP BY vvd_gkey";*/
					$strQuery= "";
					if ($_SERVER['REQUEST_METHOD'] == 'POST')
					{
						$strDt=date_create($_POST['strDt']);
						$strDt= "'".date_format($strDt, 'd-M-y')."'";
						//$strDt->format('d-M-y');
                        $endDt=date_create($_POST['endDt']);
						$endDt= "'".date_format($endDt, 'd-M-y')."'";
						
						$strQuery="SELECT berth,SUM(imp20) AS imp20,SUM(imp40) AS imp40,(SUM(imp20)+SUM(imp40)*2) AS impteus,SUM(exp20) AS exp20,SUM(exp40) AS exp40,(SUM(exp20)+SUM(exp40)*2) AS expteus
						FROM (
						SELECT inv_unit.id,vsl_vessel_visit_details.ib_vyg,SUBSTR(argo_quay.id,1,3) AS berth, 

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)=20 AND
						inv_unit_fcy_visit.time_in BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss') 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss') THEN 1 ELSE 0 END)  AS imp20,				

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)!=20 AND 
						inv_unit_fcy_visit.time_in BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss') 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss') THEN 1 ELSE 0 END)  AS imp40,

						0 AS exp20,0 AS exp40
						FROM inv_unit
						INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
						INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ib_cv
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay
						INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
						INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING','60DEPARTED','70CLOSED')
						and argo_carrier_visit.ata BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss')-4 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')

						UNION ALL

						SELECT inv_unit.id,vsl_vessel_visit_details.ib_vyg,SUBSTR(argo_quay.id,1,3) AS berth, 0 AS imp20, 0 AS imp40,

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)=20 AND
						inv_unit_fcy_visit.time_in BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss') 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss') THEN 1 ELSE 0 END)  AS exp20,				

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)!=20 AND 
						inv_unit_fcy_visit.time_in BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss') 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss') THEN 1 ELSE 0 END)  AS exp40



						FROM inv_unit
						INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
						INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay

						INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
						INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey    
														
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING','60DEPARTED','70CLOSED') AND inv_unit_fcy_visit.transit_state !='S20_INBOUND'
						and argo_carrier_visit.ata BETWEEN  to_date(concat(to_char(cast($strDt as date),'yyyy-mm-dd'),' 00:00:00'),'yyyy-mm-dd hh24:mi:ss')-4 
						and to_date(concat(to_char(cast($endDt as date),'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')

						) imptbl where berth in('CCT','NCT','GCB')  GROUP BY berth";

					}
					else
					{
						$strQuery="SELECT berth,SUM(imp20) AS imp20,SUM(imp40) AS imp40,(SUM(imp20)+SUM(imp40)*2) AS impteus,SUM(exp20) AS exp20,SUM(exp40) AS exp40,(SUM(exp20)+SUM(exp40)*2) AS expteus
						FROM (
						SELECT inv_unit.id,vsl_vessel_visit_details.ib_vyg,SUBSTR(argo_quay.id,1,3) AS berth, 

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)=20 AND
						cast(inv_unit_fcy_visit.time_in as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS imp20,				

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)!=20
						AND cast(inv_unit_fcy_visit.time_in as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS imp40,

						0 AS exp20,0 AS exp40
						FROM inv_unit
						INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
						INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ib_cv
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay
						INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
						INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING')

						UNION ALL

						SELECT inv_unit.id,vsl_vessel_visit_details.ib_vyg,SUBSTR(argo_quay.id,1,3) AS berth, 0 AS imp20, 0 AS imp40,

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)=20 AND
						cast(inv_unit_fcy_visit.time_load as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS exp20,				

						(CASE WHEN
						substr(ref_equip_type.nominal_length,-2)!=20
						AND cast(inv_unit_fcy_visit.time_load as date) BETWEEN  to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-1 AND CURRENT_DATE THEN 1 ELSE 0 END)  AS exp40



						FROM inv_unit
						INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
						INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						INNER JOIN argo_quay ON argo_quay.gkey=vsl_vessel_berthings.quay

						INNER JOIN ref_equipment ON ref_equipment.gkey=INV_UNIT.eq_gkey
						INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey    
														
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND inv_unit_fcy_visit.transit_state !='S20_INBOUND'

						) imptbl GROUP BY berth";
					}
					//echo $strQuery;
					$query = oci_parse($con_sparcsn4_oracle, $strQuery);

					 // $query2 = oci_parse($con_sparcsn4_oracle, $strQuery);
				
					 oci_execute($query);
					//  oci_execute($query2);
				
				
					
					//$total=0; 		
					//while(($row = oci_fetch_object($query))!= false){

						
						//$total=$total+$row->IMP20+$row->IMP40+$row->EXP20+$row->EXP40;
					//}
							
					$total=0;
					$imp20 = 0;
					$imp40 = 0;
					$exp20 = 0;
					$exp40 = 0;
					$i=0;
					$cct = 0;
					$gcb = 0;
					$nct = 0;
					$totat_percentage=0;

					while(($row = oci_fetch_object($query))!= false){
						$total=$total+$row->IMP20+$row->IMP40+$row->EXP20+$row->EXP40;
					}

					oci_execute($query);
				
					while(($row = oci_fetch_object($query))!= false){
						
					$i++;
					$berth=$row->BERTH;
					$imp20 +=$row->IMP20;
					$imp40 +=$row->IMP40;
					$exp20 +=$row->EXP20;
					$exp40 +=$row->EXP40;
					$terminal_total_handling=$row->IMP20+$row->IMP40+$row->EXP20+$row->EXP40;
					
					 ?>
					<tr>
						  <td align="center"><?php echo $row->BERTH; ?></td> 
						 <td align="center"><?php echo $row->IMP20; ?></td>
						  <td align="center"><?php echo $row->IMP40; ?></td>
						  <td align="center"><?php echo $row->IMP20+$row->IMP40; ?></td>
						  <td align="center"><?php echo $row->IMPTEUS; ?></td>
						  <td align="center"><?php echo $row->EXP20; ?></td>
						  <td align="center"><?php echo $row->EXP40; ?></td>
						  <td align="center"><?php echo $row->EXP20+$row->EXP40; ?></td>
						  <td align="center"><?php echo $row->EXPTEUS; ?></td>
						  <td align="center"><?php echo $row->IMP20+$row->IMP40+$row->EXP20+$row->EXP40; ?></td>
						  <td align="center"><?php echo $row->IMPTEUS+$row->EXPTEUS; ?></td>
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
								
							$totat_percentage=$cct+$gcb+$nct;
						?>
						
						</td>					  
					</tr>
					<?php } ?>	
						
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
						<th align="center"><?php echo $imp20+$imp40+$exp20+$exp40; ?></th>
						<th align="center"><?php echo $imp20+$imp40*2+$exp20+$exp40*2; ?></th>	
						<th align="center"><?php echo round($totat_percentage)."%"; ?> </th>						
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
			  ['GCB', <?php echo $nct;?>],
			  ['NCT', <?php echo $gcb;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'Handling Percentage', 'width':550, 'height':400};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
			  chart.draw(data, options);
			}
			</script>
		</div>
		<!--?php mysql_close($con_sparcsn4);?-->
		<!--?php oci_close($con_sparcsn4_oracle); ?-->

				<?php include('footer.php'); ?>

	</body>
</html>