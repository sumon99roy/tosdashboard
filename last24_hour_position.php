<?php
	include("dbConection.php");
	?>
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
				<table border ='0' cellpadding='0' cellspacing='0'>
					<tr bgcolor="#ffffff" align="center" height="100px">
						<td align="center">
							<table border=0 width="100%">				
								<tr align="center">
									<td><font size="4"><b><u>Container Position From <font size="4"><?php echo date("d/m/Y")." 00:00:00"?></font> <b>To</b> <?php echo date("d/m/Y h:i:s")?></u></b></font></td>
								</tr>
							</table>				
						</td>	
					</tr>
				</table>
				<table>
					<tr>
					
						<td style="width:300px" valign="top" align="left">
							<table border="1" style="border: 1px solid #ab88e0;" width="80%" cellpadding='0' cellspacing='0'>				
							<tr align="center">
								<td colspan="3"><font size="4"><b>Lying Container</b></font></td>
							</tr>
							<tr align="center">
								<td><b>Type</b></td>
								<td colspan="2"><b>Quantity</b></td>
							</tr>
							<?php 
										include("dbOracleConnection.php");
							


								$strQuery = "SELECT 

								(SUM(fcl_cont_tot_20)+SUM(fcl_cont_tot_40)*2) AS fcl_cont_tot,
								(SUM(lcl_cont_tot_20)+SUM(lcl_cont_tot_40)*2) AS lcl_cont_tot,
								(SUM(icd_cont_tot_20)+SUM(icd_cont_tot_40)*2) AS icd_cont_tot,
								(SUM(ict_cont_tot_20)+SUM(ict_cont_tot_40)*2) AS ict_cont_tot,
								(SUM(mty_cont_tot_20)+SUM(mty_cont_tot_40)*2) AS mty_cont_tot,
								(SUM(exprt_cont_tot_20)+SUM(exprt_cont_tot_40)*2) AS exprt_cont_tot
								
								FROM 
								(
								SELECT fcy.transit_state,
								(CASE WHEN inv.freight_kind = 'FCL' AND inv.category='IMPRT' AND inv_goods.destination NOT IN('2592','5235','5239')
								AND substr(ref_equip_type.nominal_length,-2)=20  
								THEN 1 
								ELSE 0 END) AS fcl_cont_tot_20,
								
								(CASE WHEN inv.freight_kind = 'FCL' AND inv.category='IMPRT' AND inv_goods.destination NOT IN('2592','5235','5239')
								AND substr(ref_equip_type.nominal_length,-2)!=20  
								THEN 1 
								ELSE 0 END) AS fcl_cont_tot_40,
								
								(CASE WHEN inv.freight_kind = 'LCL' AND inv.category='IMPRT' AND inv_goods.destination NOT IN('2592','5235','5239') AND substr(ref_equip_type.nominal_length,-2)=20   
								THEN 1 
								ELSE 0 END) AS lcl_cont_tot_20,
								
								(CASE WHEN inv.freight_kind = 'LCL' AND inv.category='IMPRT' AND inv_goods.destination NOT IN('2592','5235','5239') AND substr(ref_equip_type.nominal_length,-2)!=20   
								THEN 1 
								ELSE 0 END) AS lcl_cont_tot_40,
								
								(CASE WHEN inv.freight_kind IN ('LCL','FCL') AND inv.category='IMPRT' AND inv_goods.destination='2592' AND substr(ref_equip_type.nominal_length,-2)=20   
								THEN 1 
								ELSE 0 END) AS icd_cont_tot_20,
								
								(CASE WHEN inv.freight_kind IN ('LCL','FCL') AND inv.category='IMPRT' AND inv_goods.destination='2592' AND substr(ref_equip_type.nominal_length,-2)!=20   
								THEN 1 
								ELSE 0 END) AS icd_cont_tot_40,
								
								
								(CASE WHEN inv.freight_kind IN ('LCL','FCL') AND inv.category='IMPRT' AND inv_goods.destination IN ('5235','5239') AND substr(ref_equip_type.nominal_length,-2)=20
								THEN 1 
								ELSE 0 END) AS ict_cont_tot_20,
								
								(CASE WHEN inv.freight_kind IN ('LCL','FCL') AND inv.category='IMPRT' AND inv_goods.destination IN ('5235','5239') AND substr(ref_equip_type.nominal_length,-2)!=20
								THEN 1 
								ELSE 0 END) AS ict_cont_tot_40,
								
								(CASE WHEN inv.freight_kind IN ('MTY') AND inv.category='IMPRT' AND substr(ref_equip_type.nominal_length,-2)=20
								THEN 1 
								ELSE 0 END) AS mty_cont_tot_20,
								
								(CASE WHEN inv.freight_kind IN ('MTY') AND inv.category='IMPRT' AND substr(ref_equip_type.nominal_length,-2)!=20
								THEN 1 
								ELSE 0 END) AS mty_cont_tot_40,
								
								(CASE WHEN inv.category='EXPRT' AND substr(ref_equip_type.nominal_length,-2)=20
								THEN 1 
								ELSE 0 END) AS exprt_cont_tot_20,
								
								(CASE WHEN inv.category='EXPRT' AND substr(ref_equip_type.nominal_length,-2)!=20
								THEN 1 
								ELSE 0 END) AS exprt_cont_tot_40
								
								FROM inv_unit inv
								INNER JOIN inv_unit_fcy_visit fcy ON inv.gkey=fcy.unit_gkey
								INNER JOIN inv_goods ON inv_goods.gkey=inv.goods
								INNER JOIN ref_equipment ON ref_equipment.gkey=inv.eq_gkey
								INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey
								WHERE fcy.transit_state='S40_YARD'
								)  tmp";
					
								$query = oci_parse($con_sparcsn4_oracle,$strQuery);
								oci_execute($query);

								$fcl_cont_tot_20=0;
								$fcl_cont_tot_40=0;
								$lcl_cont_tot_20=0;
								$lcl_cont_tot_40=0;
								$icd_cont_tot_20=0;
								$icd_cont_tot_40=0;
								$ict_cont_tot_20=0;
								$ict_cont_tot_40=0;
								$mty_cont_tot_20=0;
								$mty_cont_tot_40=0;
								$exprt_cont_tot_20=0;
								$exprt_cont_tot_40=0;


								while(($row_tbl1 = oci_fetch_object($query))!= false)
								{
									
							


									$fcl_cont_tot=$row_tbl1->FCL_CONT_TOT;
									$lcl_cont_tot=$row_tbl1->LCL_CONT_TOT;
									$icd_cont_tot=$row_tbl1->ICD_CONT_TOT;
									$ict_cont_tot=$row_tbl1->ICT_CONT_TOT;
									$mty_cont_tot=$row_tbl1->MTY_CONT_TOT;
									$exprt_cont_tot=$row_tbl1->EXPRT_CONT_TOT;
									
									$tot_exp=$row_tbl1->FCL_CONT_TOT+$row_tbl1->LCL_CONT_TOT+$row_tbl1->ICD_CONT_TOT+$row_tbl1->ICT_CONT_TOT+
												$row_tbl1->MTY_CONT_TOT+$row_tbl1->EXPRT_CONT_TOT;

								}

								?>
								<tr align="center">
									<td>FCL</td>
									<td><?php echo $fcl_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>LCL</td>
									<td><?php echo $lcl_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>ICD</td>
									<td><?php echo $icd_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>ICT</td>
									<td><?php echo $ict_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>MTY</td>
									<td><?php echo $mty_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>EXP</td>
									<td><?php echo $exprt_cont_tot;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td><b>TOTAL</b></td>
									<td><b><?php echo $tot_exp;  ?></b></td>
									<td><b>TEUs</b></td>
								</tr>
								
								
							</table>		
						</td>
					<!-- TBL 2 -->
						<td style="width:400px" valign="top">
							<table border="1" style="border: 1px solid #ab88e0;" width="100%" cellpadding='0' cellspacing='0'>				
							<tr align="center">
								<td colspan="3">
									<font size="4"><b>Container handling</b></font>
									<font size="4"><b>(Vessel performance)</b></font>
								</td>
							</tr>
							<tr align="center">
								<td><b>Type</b></td>
								<td colspan="2"><b>Quantity</b></td>
							</tr>
							<?php 
							
								
									
								
								
									$query_tbl2_imp="SELECT vvd_gkey,SUM(imp20) AS imp20,SUM(imp40) AS imp40,(SUM(imp20)+SUM(imp40)*2) AS impteus,SUM(exp20) AS exp20,SUM(exp40) AS exp40,(SUM(exp20)+SUM(exp40)*2) AS expteus
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
				
									) imptbl GROUP BY vvd_gkey";

									$query = oci_parse($con_sparcsn4_oracle, $query_tbl2_imp);
									oci_execute($query);



																
									$imp20 = 0;
									$imp40 = 0;
									$exp20 = 0;
									$exp40 = 0;
									$i=0;
									$cct = 0;
									$gcb = 0;
									$nct = 0;
									while(($row = oci_fetch_object($query))!= false){

									
									$i++;
									$imp20 += $row->IMP20;
									$imp40 += $row->IMP40;
									$exp20 +=  $row->EXP20;
									$exp40 += $row->EXP40;
									}
								
									
									

								?>
								<tr align="center">
									<td>IMP </td>
									<td><?php echo $imp20+$imp40*2;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td>EXP </td>
									<td><?php echo $exp20+$exp40*2;  ?></td>
									<td>TEUs</td>
								</tr>
								<tr align="center">
									<td><b>TOTAL AT CTG </b></td>
									<td><b><?php echo $imp20+$imp40*2+$exp20+$exp40*2;  ?></b></td>
									<td><b>TEUs</b></td>
								</tr>
								
							</table>
						</td>
					</tr>
				</table>
				
			</div>


		</div>
			<?php mysqli_close($con_sparcsn4); ?>
			<?php oci_close($con_sparcsn4_oracle); ?>
					<?php include('footer.php'); ?>

	</body>
</html>

