<html>
	<head>
		 <meta http-equiv="refresh" content="20">
		 <style>
			.row {
			  width: 100%;
			  margin: 0 auto;
			  padding-left:25px;
			  padding-right:25px;
			}
			.block {			  
			  float: left;
			  border: 3px solid #ab88e0;
			  border-radius: 15px;
			  padding:3px;
			  margin:5px;
			  font-family: "Calibri";			  
			}
			
			/* Smartphones (portrait and landscape) ----------- */
			@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
				/*[class*="block"] {
					width: 50%;
				}*/
			}

			/* Smartphones (landscape) ----------- */
			@media only screen and (min-width : 321px) {
				
			}

			/* Smartphones (portrait) ----------- */
			@media only screen and (max-width : 320px) {
				
			}

			/* iPads (portrait and landscape) ----------- */
			@media only screen and (min-device-width : 768px) 
			and (max-device-width : 1024px) {
				
			}

			/* iPads (landscape) ----------- */
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
				
			}

			/* iPads (portrait) ----------- */
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
			and (orientation : portrait) {
				
			}

			/* Desktops and laptops ----------- */
			@media only screen and (min-width : 1224px) {
				
			}

			/* Large screens ----------- */
			@media only screen and (min-width : 1824px) {
				
			}

			/* iPhone 4 ----------- */
			@media only screen and (-webkit-min-device-pixel-ratio : 1.5),only screen and (min-device-pixel-ratio : 1.5) {
				
			}
		 </style>
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>	
			<?php include("dbConection.php");?>
			<div align="right" style="padding-right:25px;">
				<?php echo date("d/m/Y h:i:s")?>
			</div>	
			<div align="center">
				<div class="row">
					<?php
						$strQuery = "SELECT * FROM 
						(SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name,
						IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
						(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
						INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
						WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
						ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_visit_details.etd,
						(select if(left(berth,1)='G',1,if(LEFT(berth,1)='C',2,3))) as sl
						FROM sparcsn4.argo_carrier_visit
						INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
						INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
						INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
						INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
						WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING')
						ORDER BY sparcsn4.argo_carrier_visit.phase,sparcsn4.vsl_vessels.name) AS tbl WHERE berth IS NOT NULL ORDER BY sl,berth";
						$query=mysql_query($strQuery);
						$i=0;
						while($row=mysql_fetch_object($query)){
							$i++;
							$sqlGetTotImportCont="SELECT COUNT(inv_unit.id) AS tot_cont_import
							FROM sparcsn4.inv_unit 
							INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit.declrd_ib_cv
							WHERE sparcsn4.argo_carrier_visit.cvcvd_gkey=$row->vvd_gkey";
							
							$queryTotImportCont=mysql_query($sqlGetTotImportCont);
							$rowTotImportCont=mysql_fetch_object($queryTotImportCont);
							
							
							$sqlGetTotImportDischargeCont="SELECT COUNT(inv_unit.id) AS tot_discharge_cont
							FROM sparcsn4.inv_unit 
							INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit.declrd_ib_cv
							WHERE inv_unit.category='IMPRT' AND sparcsn4.argo_carrier_visit.cvcvd_gkey=$row->vvd_gkey AND time_in IS NOT NULL";
							$queryTotImportDischargeCont=mysql_query($sqlGetTotImportDischargeCont);
							$rowTotImportDischargeCont=mysql_fetch_object($queryTotImportDischargeCont);
							
							$sqlGetTotExportCont="SELECT COUNT(sparcsn4.inv_unit.id) AS tot_exp_cont
							FROM sparcsn4.inv_unit
							INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ob_cv
							INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey 
							INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey 
							WHERE vsl_vessel_visit_details.vvd_gkey= $row->vvd_gkey";
							$queryTotExportCont=mysql_query($sqlGetTotExportCont);
							$rowTotExportCont=mysql_fetch_object($queryTotExportCont);
							
							$sqlGetTotExportLoadedCont="SELECT COUNT(ctmsmis.mis_exp_unit.cont_id) AS exp_loaded_cont
							FROM ctmsmis.mis_exp_unit
							INNER JOIN sparcsn4.inv_unit ON sparcsn4.inv_unit.gkey=ctmsmis.mis_exp_unit.gkey 
							WHERE mis_exp_unit.vvd_gkey=$row->vvd_gkey AND mis_exp_unit.preAddStat='0' 
							AND inv_unit.category='EXPRT' AND mis_exp_unit.delete_flag='0'";
							$queryTotExportLoadedCont=mysql_query($sqlGetTotExportLoadedCont);
							$rowTotExportLoadedCont=mysql_fetch_object($queryTotExportLoadedCont);
							
					?>
						<div class="block">
							<div align="left"><font size="5"><b>Berth: <?php echo  $row->berth; ?></b></font></div>
							<div align="left"><b>Vessel:</b> <?php echo  $row->name; ?></div>
							<div align="left"><b>Berth Operator:</b> <?php echo  $row->berthop; ?></div>
							<div align="left"><b>Berthed On:</b> <?php echo  $row->ata; ?></div>
							<div align="left"><b>Sailed On(E):</b> <?php echo  $row->etd; ?></div>
							<div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImportCont->tot_cont_import; ?></div>
							<div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
							<div align="left"><b>Balance:</b> <?php echo  $rowTotImportCont->tot_cont_import - $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
							<div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCont->tot_exp_cont; ?></div>
							<div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
							<div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCont->tot_exp_cont-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
						</div>
						<?php }?>
				</div>				
			</div>			
		</div>
		<div style="display:inline-block;">
			<div><font size="6"><b>Total Vessel:<?php echo $i;?></b></font></div>
		</div>
		<?php mysql_close($con_sparcsn4); ?>
	</body>
</html>
