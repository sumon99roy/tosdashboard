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
				<?php include("dbOracleConnection.php");?>

				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Berth Wise Vessel(Break Bulk) Operation at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				<table width="100%" border ='1' cellpadding='0' cellspacing='0'>					
					<tr align="center" bgcolor="#D8D0CE">
						<td rowspan="4"><b>SlNo.</b></td>
						<td rowspan="4"><b>Berth</b></td>
						<td rowspan="4"><b>Vessel Name</b></td>
					
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


				<?php


		
					// $strQuery = "
					// select  tbl3.*, dd || 'd ' || hh ||'h '|| mm ||'m' AS OCUPAI from(
					// select
					// tbl2.*,cast(h / 24 as Int) as dd,REMAINDER(h,24) as hh
					// from
					// (select tb1.*,  cast(diff / 60 as Int) as h,REMAINDER(diff,60) as mm, (Case
					// when substr(berth,1,1)='G' then 1
					// else
					// (Case
					// when substr(berth,1,1)='C' then 2
					// else
					// 3
					// end)
					// End) as st
					// from(
					// SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_visit_details.ib_vyg,
					// extract(minute from argo_carrier_visit.atd-argo_carrier_visit.ata) as diff,
	
					// NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
					// (SELECT argo_quay.id FROM argo_quay
					// INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
					// WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
					// ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,
					// to_char(argo_carrier_visit.ata,'dd/mm/yyyy hh24:mi:ss') as ata,
					// to_char(argo_carrier_visit.atd,'dd/mm/yyyy hh24:mi:ss') as atd,
					// to_char(argo_visit_details.etd,'dd/mm/yyyy hh24:mi:ss') as etd,
					// NVL(vsl_vessels.service_registry_nbr,'') AS capacity
					// 	FROM argo_carrier_visit
					// 		INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
					// 		INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
					// 		INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
					// 		INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
					// 		WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING')
					// 			ORDER BY argo_carrier_visit.phase,vsl_vessels.name
					// ) tb1)  tbl2)tbl3
					// ";

					$strQuery = "select  tbl3.*, dd || 'd ' || hh ||'h '|| mm ||'m' AS OCUPAI from(
						select
						tbl2.*
						from
						(select tb1.*, (Case
						when substr(berth,1,1)='G' then 1
						else
						(Case
						when substr(berth,1,1)='C' then 2
						else
						3
						end)
						End) as st
						from(
						SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_visit_details.ib_vyg,
						extract(minute from argo_carrier_visit.atd-argo_carrier_visit.ata) as diff,
						NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
						(SELECT argo_quay.id FROM argo_quay
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
						WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,
						to_char(argo_carrier_visit.ata,'dd/mm/yyyy hh24:mi:ss') as ata,
						to_char(argo_carrier_visit.atd,'dd/mm/yyyy hh24:mi:ss') as atd,
						to_char(argo_visit_details.etd,'dd/mm/yyyy hh24:mi:ss') as etd,
						CEIL(EXTRACT(HOUR FROM argo_visit_details.etd-argo_carrier_visit.ata)) as hh,CEIL(EXTRACT(DAY FROM argo_visit_details.etd-argo_carrier_visit.ata)) as dd,
						CEIL(EXTRACT(MINUTE FROM argo_visit_details.etd-argo_carrier_visit.ata)) as mm,
						NVL(vsl_vessels.service_registry_nbr,'') AS capacity
							FROM argo_carrier_visit
								INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
								INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
								INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
								INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
								INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
								WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND vsl_vessel_classes.basic_class!='CELL'
									ORDER BY argo_carrier_visit.phase,vsl_vessels.name
						) tb1)  tbl2)tbl3";
					

					$query = oci_parse($con_sparcsn4_oracle, $strQuery);
					oci_execute($query);

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

					while(($row = oci_fetch_object($query))!= false){
						
				
					$i++;
					
			


					$sqlGetTotImportCont="SELECT 
					(SUM(tot20)+SUM(tot40)) AS totbox,(SUM(tot20)+SUM(tot40)*2) AS totteus,
					(SUM(dis20)+SUM(dis40)) AS disbox,(SUM(dis20)+SUM(dis40)*2) AS disteus,
					
					((SUM(tot20)+SUM(tot40))-(SUM(dis20)+SUM(dis40))) AS balbox,
					((SUM(tot20)+SUM(tot40)*2)-(SUM(dis20)+SUM(dis40)*2)) AS balteus
					from (
					SELECT  (SUM(tot20)+SUM(tot40)) AS totbox,(SUM(tot20)+SUM(tot40)*2) AS totteus,
					(SUM(dis20)+SUM(dis40)) AS disbox,(SUM(dis20)+SUM(dis40)*2) AS disteus,SUM(dis20) as dis20,SUM(dis40) as dis40,SUM(tot20) as tot20,SUM(tot40) as tot40
					FROM(
					SELECT argo_carrier_visit.cvcvd_gkey,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 THEN 1 ELSE 0 END) AS tot20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 THEN 1 ELSE 0 END) AS tot40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND time_in IS NOT NULL THEN 1 ELSE 0 END) AS dis20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 AND time_in IS NOT NULL THEN 1 ELSE 0 END) AS dis40
					FROM inv_unit 
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
					INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ib_cv
					INNER JOIN ref_equipment ON ref_equipment.gkey=inv_unit.eq_gkey
					INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey   
					WHERE inv_unit.category='IMPRT' AND argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY
					)tbl
					)tbl2";

					$queryTotImportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportCont);
					oci_execute($queryTotImportCont);


					$totbox=0;
					$totteus=0;
					$disbox=0;
					$disteus=0;
					$balbox=0;
					$balteus=0;
					while(($rowTotImportCont = oci_fetch_object($queryTotImportCont))!= false){
						


					$totbox += $rowTotImportCont->TOTBOX;
					$totteus += $rowTotImportCont->TOTTEUS;
					$disbox += $rowTotImportCont->DISBOX;
					$disteus += $rowTotImportCont->DISTEUS;
					$balbox += $rowTotImportCont->BALBOX;
					$balteus += $rowTotImportCont->BALTEUS;
					}
					$tImpB +=$totbox;
					$tImpT +=$totteus;
					$tDischB +=$disbox;
					$tDischT +=$disteus;
					$tBalB +=$balbox ;
					$tBalT +=$balteus;
				

					$sqlGetTotExportCont="       
					SELECT 
					(SUM(totld20)+SUM(totld40)) AS totldbox,
					(SUM(totld20)+SUM(totld40)*2) AS totldteus,
					(SUM(totmt20)+SUM(totmt40)) AS totmtbox,
					(SUM(totmt20)+SUM(totmt40)*2) AS totmtteus,
					(SUM(loadedld20)+SUM(loadedld40)) AS loadedldbox,
					(SUM(loadedld20)+SUM(loadedld40)*2) AS loadedldteus,
					(SUM(loadedmt20)+SUM(loadedmt40)) AS loadedmtbox,
					(SUM(loadedmt20)+SUM(loadedmt40)*2) AS loadedmtteus,
                    ((SUM(totld20)+SUM(totld40))-(SUM(loadedld20)+SUM(loadedld40))) AS balldbox,
					 ((SUM(totld20)+SUM(totld40)*2)-(SUM(loadedld20)+SUM(loadedld40)*2)) AS balldteus,
					((SUM(totmt20)+SUM(totmt40))-(SUM(loadedmt20)+SUM(loadedmt40))) AS balmtbox,
					 ((SUM(totmt20)+SUM(totmt40)*2)-(SUM(loadedmt20)+SUM(loadedmt40)*2)) AS balmtteus
                    
					FROM(
                    
                         
                     	SELECT 
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_unit.freight_kind!='MTY' THEN 1 ELSE 0 END) AS totld20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_unit.freight_kind='MTY' THEN 1 ELSE 0 END) AS totmt20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 AND inv_unit.freight_kind!='MTY' THEN 1 ELSE 0 END) AS totld40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 AND inv_unit.freight_kind='MTY' THEN 1 ELSE 0 END) AS totmt40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_unit.freight_kind!='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedld20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)=20 AND inv_unit.freight_kind ='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedmt20,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 AND inv_unit.freight_kind !='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedld40,
					(CASE WHEN substr(ref_equip_type.nominal_length,-2)!=20 AND inv_unit.freight_kind ='MTY' AND time_load IS NOT NULL THEN 1 ELSE 0 END) AS loadedmt40
					FROM inv_unit 
					INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
					INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
					
                    INNER JOIN ref_equipment ON ref_equipment.gkey=inv_unit.eq_gkey
                    INNER JOIN ref_equip_type ON ref_equip_type.gkey=ref_equipment.eqtyp_gkey  
					WHERE inv_unit.category='EXPRT' AND argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY
					) tbl
                    ";
					$queryTotExportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotExportCont);
					oci_execute($queryTotExportCont);
					
					

					$totlbox=0;
					$totldteus=0;
					$totmtbox=0;
					$totmtteus=0;
					$loadedldbox=0;
					$loadedldteus=0;
					$loadedmtbox=0;
					$loadedmtteus=0;
					$ballbox=0;
					$balldteus=0;
					$balmtbox=0;
					$balmtteus=0;
					$emptyBalTeus=0;
					$tMempty=0;
					while(($rowTotExportCont = oci_fetch_object($queryTotExportCont))!= false){

					// $queryTotExportCont=mysql_query($sqlGetTotExportCont);
					// $rowTotExportCont=mysql_fetch_object($queryTotExportCont);
					
					$emptyBalTeus = $row->CAPACITY-($rowTotExportCont->LOADEDLDTEUS+$rowTotExportCont->LOADEDMTTEUS);
					

					$totlbox += $rowTotExportCont->TOTLDBOX;
					$totldteus += $rowTotExportCont->TOTLDTEUS;
					$totmtbox += $rowTotExportCont->TOTMTBOX;
					$totmtteus += $rowTotExportCont->TOTMTTEUS;
					
					$loadedldbox += $rowTotExportCont->LOADEDLDBOX;
					$loadedldteus += $rowTotExportCont->LOADEDLDTEUS;
					$loadedmtbox += $rowTotExportCont->LOADEDMTBOX;
					$loadedmtteus += $rowTotExportCont->LOADEDMTTEUS;
					

					$ballbox += $rowTotExportCont->BALLDBOX;
					$balldteus += $rowTotExportCont->BALLDTEUS;
					$balmtbox += $rowTotExportCont->BALMTBOX;
					$balmtteus += $rowTotExportCont->BALMTTEUS;

					}
					$tExpLdB +=$totlbox;
					$tExpLdT +=$totldteus;
					$tExpMtB += $totmtbox ;
					$tExpMtT += $totmtteus;
					$tLdLB +=$loadedldbox;
					$tLdLT +=$loadedldteus;
					$tLdMtB += $loadedmtbox ;
					$tLdMtT += 	$loadedmtteus;

					$tLdBalB +=	$ballbox ;
					$tLdBalT +=$balldteus ;
					$tMtBalB +=$balmtbox;
					$tMtBalT +=$balmtteus;
					$tMempty += $emptyBalTeus;
				?>
				<tr align="center">
						<td><?php  echo $i;?></td>
						<td><?php if($row->NAME) echo $row->BERTH; else echo "&nbsp;";?></td>
						<td><?php if($row->NAME) echo $row->NAME; else echo "&nbsp;";?></td>
					
						<td><?php echo $row->ATA; ?></td>
						<td><?php echo $row->ETD; ?></td>
						<td><?php echo $row->OCUPAI; ?></td>
						<td><?php echo $row->CAPACITY; ?></td>
						<td><?php echo $totbox; ?></td>
						<td><?php echo $totteus; ?></td>
						<td><?php echo $disbox; ?></td>
					
						<td><?php echo $disteus; ?></td>
						<td><?php echo $balbox; ?></td>
						<td><?php echo $balteus; ?></td>
						
						<td><?php echo $totlbox; ?></td>
						<td><?php echo $totldteus; ?></td>
						<td><?php echo $totmtbox; ?></td>
						<td><?php echo $totmtteus; ?></td>
						
						<td><?php echo $loadedldbox; ?></td>
						<td><?php echo $loadedldteus; ?></td>
						<td><?php echo $loadedmtbox; ?></td>
						<td><?php echo $loadedmtteus; ?></td>	
						
						<td><?php echo $ballbox; ?></td>
						<td><?php echo $balldteus; ?></td>	
						<td><?php echo $balmtbox; ?></td>
						<td><?php echo $balmtteus; ?></td>
						<!-- <td><?php echo $emptyBalTeus; ?></td> -->
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
						<!-- <th><?php echo $tMempty; ?></th>	 -->
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
					$rtn_bb=mysqli_query($con_cchaportdb, $query_bb);
					while($row_bb=mysqli_fetch_object($rtn_bb)){
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
		
		<?php mysqli_close($con_sparcsn4); ?>
		<?php  mysqli_close($con_cchaportdb); ?>
		<?php oci_close($con_sparcsn4_oracle); ?>
				<?php include('footer.php'); ?>

	</body>
</html>