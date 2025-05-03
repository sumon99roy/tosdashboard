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
						<td colspan="12"><font size="5"><b>Berth Wise Vessel(Container) Operation at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<table width="100%" border ='1' cellpadding='0' cellspacing='0'>					
					<tr align="center" bgcolor="#D8D0CE">
						<td rowspan="4"><b>SlNo.</b></td>
						<td rowspan="4"><b>Berth</b></td>
						<td rowspan="4"><b>Vessel Name</b></td>
						<!--td style="border-width:3px;border-style: double;"><b>Rotation</b></td>
						<td style="border-width:3px;border-style: double;"><b>Phase</b></td>
						<td style="border-width:3px;border-style: double;"><b>Agent</b></td-->
						<td rowspan="4"><b>Berthed On</b></td>
						<td rowspan="4"><b>Sailed On (ETD)</b></td>
						<td rowspan="4"><b>Berth<br/>Occupation</b></td>
						<td rowspan="4"><b>Vessel<br/>Capacity<br/>(Teus)</b></td>
						<td colspan="6"><b>Import</b></td>
						<td colspan="12"><b>Export</b></td>
					</tr>
					<tr align="center" bgcolor="#D8D0CE">
						<td colspan="2" rowspan="2"><b>Total Container</b></td>
						<td colspan="2" rowspan="2"><b>Discharge Container</b></td>		
						<td colspan="2" rowspan="2"><b>Balance</b></td>
						<td colspan="4"><b>Total Container</b></td>
						<td colspan="4"><b>Loaded On Board</b></td>		
						<td colspan="4"><b>Balance To Be Shipped</b></td>
					</tr>
					
					<tr align="center" bgcolor="#D8D0CE">
						<td colspan="2"><b>Laden</b></td>
						<td colspan="2"><b>Empty</b></td>		
						<td colspan="2"><b>Laden</b></td>
						<td colspan="2"><b>Empty</b></td>	
						<td colspan="2"><b>Laden</b></td>
						<td colspan="2"><b>Empty</b></td>	
					</tr>
					
					<tr align="center" bgcolor="#D8D0CE">
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
						<td><b>Box</b></td>
						<td><b>Teus</b></td>
					</tr>

					<!--tr  align="center">
						<td style="border-width:3px;border-style: double;"><b>Total Import Container</b></td>
						<td style="border-width:3px;border-style: double;"><b>Total Discharge Container</b></td>		
						<td style="border-width:3px;border-style: double;"><b>Balance</b></td>
						<td style="border-width:3px;border-style: double;"><b>Total Export Container</b></td>
						<td style="border-width:3px;border-style: double;"><b>Loaded On Board</b></td>		
						<td style="border-width:3px;border-style: double;"><b>Balance To Be Shipped</b></td>	
					</tr-->

				<?php

					//echo$vvdGkey;
					$strQuery = "SELECT * FROM (
					SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name,sparcsn4.vsl_vessel_visit_details.ib_vyg,
					SUBSTR(sparcsn4.argo_carrier_visit.phase,3) AS phase_str,sparcsn4.ref_bizunit_scoped.id AS agent,
					(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
					INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
					WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
					ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_visit_details.etd,
					TIMEDIFF(NOW(),ata) AS dif,
					TIMESTAMPDIFF(MINUTE,ata,NOW()) AS diff,
					FLOOR((SELECT diff/60)) AS h,
					FLOOR((SELECT diff%60)) AS mm,
					FLOOR((SELECT h/24)) AS dd,
					(SELECT h%24) AS hh,
					(SELECT CONCAT(dd,'d ',hh,'h ',mm,'m')) AS ocupai,
					IFNULL(sparcsn4.vsl_vessels.service_registry_nbr,'') AS capacity,
					(select if(left(berth,1)='G',1,if(LEFT(berth,1)='C',2,3))) as sl
					FROM sparcsn4.argo_carrier_visit
					INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
					INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
					INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
					INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
					WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING')
					ORDER BY sparcsn4.argo_carrier_visit.phase,sparcsn4.vsl_vessels.name) AS tbl WHERE berth IS NOT NULL order by sl,berth";
					
					//echo $strQuery;
					$query=mysql_query($strQuery);

					$i=0;
					$tImpB = 0;
					$tImpT = 0;
					$tDischB = 0;
					$tDischT = 0;
					$tBalB = 0;
					$tBalT = 0;
					
					$tExpLdB = 0;
					$tExpLdT = 0;
					$tExpMtB = 0;
					$tExpMtT = 0;
					
					$tLdLB = 0;
					$tLdLT = 0;
					$tLdMtB = 0;
					$tLdMtT = 0;
					
					$tLdBalB = 0;
					$tLdBalT = 0;
					$tMtBalB = 0;
					$tMtBalT = 0;
					
					while($row=mysql_fetch_object($query)){
					$i++;
					
					$sqlGetTotImportCont="SELECT 
					(SUM(tot20)+SUM(tot40)) AS totbox,(SUM(tot20)+SUM(tot40)*2) AS totteus,
					(SUM(dis20)+SUM(dis40)) AS disbox,(SUM(dis20)+SUM(dis40)*2) AS disteus,
					(SELECT (SUM(tot20)+SUM(tot40))-(SUM(dis20)+SUM(dis40))) AS balbox,(SELECT (SUM(tot20)+SUM(tot40)*2)-(SUM(dis20)+SUM(dis40)*2)) AS balteus
					FROM(
					SELECT 
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 THEN 1 ELSE 0 END) AS tot20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 THEN 1 ELSE 0 END) AS tot40,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND time_in IS NOT NULL THEN 1 ELSE 0 END) AS dis20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 AND time_in IS NOT NULL THEN 1 ELSE 0 END) AS dis40
					FROM sparcsn4.inv_unit 
					INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
					INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ib_cv
					INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey
					INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey
					WHERE inv_unit.category='IMPRT' AND sparcsn4.argo_carrier_visit.cvcvd_gkey=$row->vvd_gkey
					) AS tbl";
					
					$queryTotImportCont=mysql_query($sqlGetTotImportCont);
					$rowTotImportCont=mysql_fetch_object($queryTotImportCont);
					
					$sqlGetTotExportCont="SELECT 
					(SUM(totld20)+SUM(totld40)) AS totldbox,
					(SUM(totld20)+SUM(totld40)*2) AS totldteus,
					(SUM(totmt20)+SUM(totmt40)) AS totmtbox,
					(SUM(totmt20)+SUM(totmt40)*2) AS totmtteus,
					(SUM(loadedld20)+SUM(loadedld40)) AS loadedldbox,
					(SUM(loadedld20)+SUM(loadedld40)*2) AS loadedldteus,
					(SUM(loadedmt20)+SUM(loadedmt40)) AS loadedmtbox,
					(SUM(loadedmt20)+SUM(loadedmt40)*2) AS loadedmtteus,
					(SELECT (SUM(totld20)+SUM(totld40))-(SUM(loadedld20)+SUM(loadedld40))) AS balldbox,
					(SELECT (SUM(totld20)+SUM(totld40)*2)-(SUM(loadedld20)+SUM(loadedld40)*2)) AS balldteus,
					(SELECT (SUM(totmt20)+SUM(totmt40))-(SUM(loadedmt20)+SUM(loadedmt40))) AS balmtbox,
					(SELECT (SUM(totmt20)+SUM(totmt40)*2)-(SUM(loadedmt20)+SUM(loadedmt40)*2)) AS balmtteus
					FROM(
					SELECT 
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND sparcsn4.inv_unit.freight_kind!='MTY' THEN 1 ELSE 0 END) AS totld20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND sparcsn4.inv_unit.freight_kind='MTY' THEN 1 ELSE 0 END) AS totmt20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 AND sparcsn4.inv_unit.freight_kind!='MTY' THEN 1 ELSE 0 END) AS totld40,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 AND sparcsn4.inv_unit.freight_kind='MTY' THEN 1 ELSE 0 END) AS totmt40,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND sparcsn4.inv_unit.freight_kind!='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedld20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)=20 AND sparcsn4.inv_unit.freight_kind ='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedmt20,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 AND sparcsn4.inv_unit.freight_kind !='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedld40,
					(CASE WHEN RIGHT(sparcsn4.ref_equip_type.nominal_length,2)!=20 AND sparcsn4.inv_unit.freight_kind ='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedmt40
					FROM sparcsn4.inv_unit 
					INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
					INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ob_cv
					INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=sparcsn4.inv_unit.gkey
					INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey
					INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey
					WHERE inv_unit.category='EXPRT' AND sparcsn4.argo_carrier_visit.cvcvd_gkey=$row->vvd_gkey
					) AS tbl";
					$queryTotExportCont=mysql_query($sqlGetTotExportCont);
					$rowTotExportCont=mysql_fetch_object($queryTotExportCont);
					
					$emptyBalTeus = $row->capacity-($rowTotExportCont->loadedldteus+$rowTotExportCont->loadedmtteus);
					
					$tImpB += $rowTotImportCont->totbox;
					$tImpT += $rowTotImportCont->totteus;
					$tDischB += $rowTotImportCont->disbox;
					$tDischT += $rowTotImportCont->disteus;
					$tBalB += $rowTotImportCont->balbox;
					$tBalT += $rowTotImportCont->balteus;
					
					$tExpLdB += $rowTotExportCont->totldbox;
					$tExpLdT += $rowTotExportCont->totldteus;
					$tExpMtB += $rowTotExportCont->totmtbox;
					$tExpMtT += $rowTotExportCont->totmtteus;
					
					$tLdLB += $rowTotExportCont->loadedldbox;
					$tLdLT += $rowTotExportCont->loadedldteus;
					$tLdMtB += $rowTotExportCont->loadedmtbox;
					$tLdMtT += $rowTotExportCont->loadedmtteus;
					
					$tLdBalB += $rowTotExportCont->balldbox;
					$tLdBalT += $rowTotExportCont->balldteus;
					$tMtBalB += $rowTotExportCont->balmtbox;
					$tMtBalT += $rowTotExportCont->balmtteus;
					//$tMtBalT += $emptyBalTeus;
				?>
				<tr align="center">
						<td><?php  echo $i;?></td>
						<td><?php if($row->name) echo $row->berth; else echo "&nbsp;";?></td>
						<td><?php if($row->name) echo $row->name; else echo "&nbsp;";?></td>
						<!--td><?php if($row->ib_vyg) echo $row->ib_vyg; else echo "&nbsp;";?></td>		
						<td><?php if($row->phase_str) echo $row->phase_str; else echo "&nbsp;";?></td>
						<td><?php if($row->agent) echo $row->agent; else echo "&nbsp;";?></td-->
						<td><?php echo substr($row->ata,0,-3); ?></td>
						<td><?php echo substr($row->etd,0,-3); ?></td>
						<td><?php echo $row->ocupai; ?></td>
						<td><?php echo $row->capacity; ?></td>
						<td><?php echo $rowTotImportCont->totbox; ?></td>
						<td><?php echo $rowTotImportCont->totteus; ?></td>
						<td><?php echo $rowTotImportCont->disbox; ?></td>
						<td><?php echo $rowTotImportCont->disteus; ?></td>
						<td><?php echo $rowTotImportCont->balbox; ?></td>
						<td><?php echo $rowTotImportCont->balteus; ?></td>
						
						<td><?php echo $rowTotExportCont->totldbox; ?></td>
						<td><?php echo $rowTotExportCont->totldteus; ?></td>
						<td><?php echo $rowTotExportCont->totmtbox; ?></td>
						<td><?php echo $rowTotExportCont->totmtteus; ?></td>
						
						<td><?php echo $rowTotExportCont->loadedldbox; ?></td>
						<td><?php echo $rowTotExportCont->loadedldteus; ?></td>
						<td><?php echo $rowTotExportCont->loadedmtbox; ?></td>
						<td><?php echo $rowTotExportCont->loadedmtteus; ?></td>	
						
						<td><?php echo $rowTotExportCont->balldbox; ?></td>
						<td><?php echo $rowTotExportCont->balldteus; ?></td>	
						<td><?php echo $rowTotExportCont->balmtbox; ?></td>
						<td><?php echo $rowTotExportCont->balmtteus; ?></td>
						<!--td><?php echo $emptyBalTeus; ?></td-->
				</tr>

				<?php } ?>
				<tr align="center">
						<th colspan="7">Total</th>
						<th><?php echo $tImpB; ?></th>
						<th><?php echo $tImpT; ?></th>
						<th><?php echo $tDischB; ?></th>
						<th><?php echo $tDischT; ?></th>
						<th><?php echo $tBalB; ?></th>
						<th><?php echo $tBalT; ?></th>
						
						<th><?php echo $tExpLdB; ?></th>
						<th><?php echo $tExpLdT; ?></th>
						<th><?php echo $tExpMtB; ?></th>
						<th><?php echo $tExpMtT; ?></th>
						
						<th><?php echo $tLdLB; ?></th>
						<th><?php echo $tLdLT; ?></th>						
						<th><?php echo $tLdMtB; ?></th>						
						<th><?php echo $tLdMtT; ?></th>	
						
						<th><?php echo $tLdBalB; ?></th>						
						<th><?php echo $tLdBalT; ?></th>						
						<th><?php echo $tMtBalB; ?></th>						
						<th><?php echo $tMtBalT; ?></th>						
				</tr>
				</table>
			</div>
		</div>
		<br>
		<!-- Sourav -->
		<div>
			<div align="center">
				<?php include("dbConection42.php");?>
				<table>
					<tr style="margin:5px;">
						<td colspan="4"><font size="5"><b>Vessel(Break Bulk) Operation </td>
					</tr>
				</table>
				<table width="50%" border ='1' cellpadding='0' cellspacing='0'>					
					<tr align="center" bgcolor="#D8D0CE">
						<td><b>SlNo.</b></td>
						<td><b>Vessel Name</b></td>
						<td><b>Rotation</b></td>
						<td><b>Arraival Date(ETA)</b></td>
					</tr>
					<?php 
					$j=0;
					$query_bb="SELECT igm_masters.id,igm_masters.Vessel_Name,igm_masters.Import_Rotation_No,vessels_berth_detail.ETA_Date
								from igm_masters INNER JOIN vessels_berth_detail ON vessels_berth_detail.igm_id=igm_masters.id
								where vsl_dec_type='BB' AND DATE(vessels_berth_detail.ETA_Date)= DATE(NOW())";
					$rtn_bb=mysql_query($query_bb);
					while($row_bb=mysql_fetch_object($rtn_bb)){
					$j++;
					?>
					<tr align="center">
						<td><?php  echo $j;?></td>
						<td><?php if($row_bb->Vessel_Name) echo $row_bb->Vessel_Name; else echo "&nbsp;";?></td>
						<td><?php if($row_bb->Import_Rotation_No) echo $row_bb->Import_Rotation_No; else echo "&nbsp;";?></td>
						<td><?php if($row_bb->ETA_Date) echo $row_bb->ETA_Date; else echo "&nbsp;";?></td>	
					</tr>
					
					<?php } ?>
				</table>
			</div>
		</div>
		
		<?php mysql_close($con_sparcsn4); ?>
		<?php mysql_close($con_cchaportdb); ?>
	</body>
</html>