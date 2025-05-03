
<html>
	<head>
		 <meta http-equiv="refresh" content="60">
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


            .clearfix:after {
                content: " "; /* Older browser do not support empty content */
                visibility: hidden;
                display: block;
                height: 0;
                clear: both;
            }

            .hr {
                border-top:2px dotted #000;
                /*Rest of stuff here*/
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

	<script>
        function updateClock() {
            const now = new Date();
            let hours = now.getHours();
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            const amPm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            const timeString = `${hours.toString().padStart(2, '0')}:${minutes}:${seconds} ${amPm}`;
            document.getElementById('clock').textContent = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>	
			<?php include("dbConection.php");?>
			<?php include("dbOracleConnection.php");?>


			<div align="right" style="padding-right:25px;">
				<!-- <?php echo date("d/m/Y h:i:s")?> -->
				<?php echo date("d/m/Y");?> <span id="clock"> </span>
			</div>
            <div align="center">
                <u style="font-size: 24px;color: green"><b>Working Vessel</b></u>
            </div>
			<div align="center" >
				<div class="row" >
					<?php
				
					
					
						$strQuery = "SELECT * FROM 
						(
						SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
						NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
                        (
                        SELECT argo_quay.id FROM argo_quay
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
						WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only
                        ) AS berth,
                        argo_carrier_visit.ata,argo_visit_details.etd,
						vsl_vessel_classes.basic_class
						FROM argo_carrier_visit
						INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
						INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
						INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
    
						INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
						INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND ref_country.cntry_code!='BD'
                        UNION ALL
						SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
						NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
						(SELECT argo_quay.id FROM argo_quay
						INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
						WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
						ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,argo_carrier_visit.ata,argo_visit_details.etd, vsl_vessel_classes.basic_class
                        FROM argo_carrier_visit
						INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
						INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
						INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
						INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
						INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
						INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
						WHERE argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND ref_country.cntry_code='BD' AND vsl_vessels.notes='BD'
						) tbl WHERE berth IS NOT NULL ORDER BY DECODE (basic_class,'CELL',1), basic_class ASC";


						$stid = oci_parse($con_sparcsn4_oracle, $strQuery);
						oci_execute($stid);

					
						$i=0;
						$k=0;
						$name="";
						$cont_vessel_working=0;
						$other_vessel_working=0;
						$vessel_class='';
						$rowTotImport='';
						$rowTotImportDischarge='';
						$rowTotExportCon='';
						$rowTotImportContNum='';
					 	while(($row = oci_fetch_object($stid))!= false){

							// AGENT
							$agent_sql = "SELECT Y.id FROM ref_bizunit_scoped r 
							INNER JOIN vsl_vessel_visit_details ON r.gkey=vsl_vessel_visit_details.bizu_gkey
							LEFT JOIN ( ref_agent_representation X       
							LEFT JOIN ref_bizunit_scoped Y ON X.agent_gkey=Y.gkey )  ON r.gkey=X.bzu_gkey 
							WHERE vsl_vessel_visit_details.ib_vyg = '$row->IB_VYG'";

							$agent_data = oci_parse($con_sparcsn4_oracle, $agent_sql);
							oci_execute($agent_data);


							while(($rowAgent = oci_fetch_object($agent_data))!= false){
								$agent=$rowAgent->ID;
							}


							$i++;
							$sqlGetTotImportCont="SELECT COUNT(inv_unit.id) AS tot_cont_import
							FROM  inv_unit 
							INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
							WHERE argo_carrier_visit.cvcvd_gkey='$row->VVD_GKEY'";
							
							$queryTotImportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportCont);
							oci_execute($queryTotImportCont);

						
							while(($rowTotImportCont = oci_fetch_object($queryTotImportCont))!= false){
								$rowTotImportContNum=$rowTotImportCont->TOT_CONT_IMPORT;

							}
							
						

/* 							echo $sqlGetTotImportTeus="  SELECT   tmp.* ,(Case
									when (siz=40) then 2
									else
									1
									end) AS teus  FROM  (
									select (select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
								   INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
								   INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
								   INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
								   ) as siz ,argo_carrier_visit.cvcvd_gkey
								   FROM inv_unit 
								   INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
								   INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
								   WHERE argo_carrier_visit.cvcvd_gkey='$row->VVD_GKEY'
								 )  tmp "; */	

								   $sqlGetTotImportTeus="SELECT   tmp.* ,(Case
									when (siz=20) then 1
									else
									2
									end) AS teus  FROM  (
									select  substr(ref_equip_type.nominal_length,-2) as siz, argo_carrier_visit.cvcvd_gkey
								   FROM inv_unit 
								   INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
								   INNER JOIN ref_equipment ON inv_unit.eq_gkey=ref_equipment.gkey
								   INNER JOIN ref_equip_type ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
								   INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
								   WHERE argo_carrier_visit.cvcvd_gkey='$row->VVD_GKEY'
																 )  tmp ";
							

							$queryTotImportTeus = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportTeus);
							$rowTotImport=oci_execute($queryTotImportTeus);
							$rowTotImportTeus=0;
							while(($rowTotImport = oci_fetch_object($queryTotImportTeus))!= false){
								$rowTotImportTeus = $rowTotImportTeus + $rowTotImport->TEUS;
								$cont_size=$rowTotImport->SIZ;
							}
							
							
							
							$sqlGetTotImportDischargeCont="SELECT COUNT(inv_unit.id) AS tot_discharge_cont
							FROM inv_unit 
							INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
							WHERE inv_unit.category='IMPRT' AND argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY AND time_in IS NOT NULL";

							$queryTotImportDischargeCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportDischargeCont);
							oci_execute($queryTotImportDischargeCont);

							while(($rowTotImportDischargeCont = oci_fetch_object($queryTotImportDischargeCont))!= false){
								$rowTotImportDischarge=$rowTotImportDischargeCont->TOT_DISCHARGE_CONT; 

							}
					
							
							$sqlGetTotExportCont="SELECT COUNT(inv_unit.id) AS tot_exp_cont
							FROM inv_unit
							INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
							INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey 
							INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey 
							WHERE vsl_vessel_visit_details.vvd_gkey=$row->VVD_GKEY";

							$queryTotExportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotExportCont);
							oci_execute($queryTotExportCont);

					

							while(($rowTotExportCont = oci_fetch_object($queryTotExportCont))!= false){

								$rowTotExportCon=$rowTotExportCont->TOT_EXP_CONT;
							}
							
							
						
							$sqlGetTotExportLoadedCont="
							SELECT COUNT(ctmsmis.mis_exp_unit.cont_id) AS exp_loaded_cont
														FROM ctmsmis.mis_exp_unit
														WHERE mis_exp_unit.vvd_gkey=$row->VVD_GKEY  AND mis_exp_unit.preAddStat='0' 
														 AND mis_exp_unit.delete_flag='0'";
							$queryTotExportLoadedCont=mysqli_query($con_sparcsn4,$sqlGetTotExportLoadedCont);
							$rowTotExportLoadedCont=mysqli_fetch_object($queryTotExportLoadedCont);
							
						
							
							if($row->BASIC_CLASS=='CELL') 
							{
								$cont_vessel_working++;
							}
							if($row->BASIC_CLASS!='CELL') 
							{
								$other_vessel_working++;
							}
							if($row->BASIC_CLASS=='CELL' AND  $vessel_class=='') 
							{ 								
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->BASIC_CLASS!='CELL')
							{
								$k++;
							}
						
							if($row->BASIC_CLASS!='CELL' AND  $k==1) 
							{ 
						?>
						        <div class="clearfix"></div>
						        <div align='left'<font style="font-size: 20px;color:#1212e9"><b>Total Container Vessel : <?php echo $cont_vessel_working;?></b></font></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Other Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	}
							
					?>
						<div class="block">
							<div align="left"><font size="5"><b>Berth: <?php echo  $row->BERTH; ?></b></font></div>
							<div align="left"><b>Vessel:</b> <?php echo  $row->NAME; ?></div>
							<div align="left"><b>Rotation:</b> <?php echo  $row->IB_VYG; ?></div>
							<div align="left"><b>Shipping Agent:</b> <?php echo  $agent; ?></div>
							<div align="left"><b>Berth Operator:</b> <?php echo  $row->BERTHOP; ?></div>
							<div align="left"><b>Berthed On:</b> 
							<?php 
							$ataDt = $row->ATA;
							$arrAta = explode('.',$ataDt);
							$strAmPm = $arrAta[3];
							$AmPmArr = explode(' ',$strAmPm);
							echo  $arrAta[0].":".$arrAta[1].":".$arrAta[2]." ".$AmPmArr[1]; 
							?>
						    </div>
							<div align="left"><b>Sailed On(E):</b> 
							<?php 
							$etdDt = $row->ETD;
							$arrEtd = explode('.',$etdDt);
							$strAmPm = $arrEtd[3];
							$AmPmArr = explode(' ',$strAmPm);
							echo $arrEtd[0].":".$arrEtd[1].":".$arrEtd[2]." ".$AmPmArr[1] ;
							 ?>
						    </div>
							
							
							<?php
								if($row->BASIC_CLASS == 'CELL')
								{
							?>
							<div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImportContNum.'(Box),  '.$rowTotImportTeus.'(TEUs)'; ?></div>
							<!-- <div align="left"><b>Container Size:</b> <?php echo  $cont_size; ?></div> -->
							<div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischarge; ?></div>
							<div align="left"><b>Balance:</b> <?php echo  $rowTotImportContNum - $rowTotImportDischarge; ?></div>
							<div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCon; ?></div>
							<div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
							<div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCon-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
							<?php
								}
							?>
						</div>

						<?php 
								$vessel_class=$row->BASIC_CLASS;
						} ?>
				</div>
			</div>
        </div>
		  <div class="clearfix"></div>
		<div align='left'<font style="font-size: 20px;color:#1212e9"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Other Vessel : <?php echo $other_vessel_working;?></b></font></div>
        <div align="center">
            <div><font size="5"><b>Total Vessel:<?php echo $i;?></b></font></div>
        </div>
        <div class="clearfix"></div>
        <div class="hr"></div>
        <div align="center">
            <u style="font-size: 24px;color:green"><b>Incoming Vessel</b></u>
        </div>
        <div align="center">
        <div align="center">
         <div class="row">
             <?php
         
             $strQuery = "SELECT  tbl.*,(Case
			 when substr(berth,1,1)='G' then 1
			 else
			 (Case
			 when substr(berth,1,1)='C' then 2
			 else
			 3
			 end)
			 End) as st FROM
			 (SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
			 NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,ref_bizunit_scoped.id AS agent,
			 (SELECT argo_quay.id FROM argo_quay
			 INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
			 WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
			 ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,
			 argo_visit_details.eta,argo_visit_details.etd,
			 vsl_vessel_classes.basic_class
			 FROM argo_carrier_visit
			 INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
			 INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
			 INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
			 INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
			 INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
			 INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
			 WHERE argo_carrier_visit.phase='20INBOUND'  AND ref_country.cntry_code!='BD'
			 ORDER BY argo_carrier_visit.phase,vsl_vessels.name) tbl ORDER BY basic_class,eta,berth";
			
			$query = oci_parse($con_sparcsn4_oracle, $strQuery);
			oci_execute($query);

	


             $j=0;
			 $in=0;
			 $vessel_class='';
			 $cont_vessel_incoming=0;
			 $other_vessel_incoming=0;
			 $rowTotImport='';
			 $rowTotImportDischarge='';
			 $rowTotExportCon='';
			 while(($row = oci_fetch_object($query))!= false){

				// AGENT
				$agent_sql = "SELECT Y.id FROM ref_bizunit_scoped r 
				INNER JOIN vsl_vessel_visit_details ON r.gkey=vsl_vessel_visit_details.bizu_gkey
				LEFT JOIN ( ref_agent_representation X       
				LEFT JOIN ref_bizunit_scoped Y ON X.agent_gkey=Y.gkey )  ON r.gkey=X.bzu_gkey 
				WHERE vsl_vessel_visit_details.ib_vyg = '$row->IB_VYG'";

				$agent_data = oci_parse($con_sparcsn4_oracle, $agent_sql);
				oci_execute($agent_data);


				while(($rowAgent = oci_fetch_object($agent_data))!= false){
					$agent=$rowAgent->ID;
				}


                 $j++;


                 $sqlGetTotImportCont="SELECT COUNT(inv_unit.id) AS tot_cont_import
				 FROM inv_unit 
				 INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
				 INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
				 WHERE argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY";


				$queryTotImportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportCont);
				oci_execute($queryTotImportCont);

				while(($rowTotImportCont = oci_fetch_object($queryTotImportCont))!= false){
					$rowTotImport=$rowTotImportCont->TOT_CONT_IMPORT;


				}

               
                 $sqlGetTotImportDischargeCont="SELECT COUNT(inv_unit.id) AS tot_discharge_cont
				 FROM inv_unit 
				 INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
				 INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
				 WHERE inv_unit.category='IMPRT' AND argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY AND time_in IS NOT NULL";

				$queryTotImportDischargeCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportDischargeCont);
				oci_execute($queryTotImportDischargeCont);
				while(($rowTotImportDischargeCont = oci_fetch_object($queryTotImportDischargeCont))!= false){
					$rowTotImportDischarge=$rowTotImportDischargeCont->TOT_DISCHARGE_CONT; 

				}

                 $sqlGetTotExportCont="  SELECT COUNT(inv_unit.id) AS tot_exp_cont
				 FROM inv_unit
				 INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
				 INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
				 INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey 
				 INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey 
				 WHERE vsl_vessel_visit_details.vvd_gkey=  $row->VVD_GKEY";

				$queryTotExportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotExportCont);
				oci_execute($queryTotExportCont);
				while(($rowTotExportCont = oci_fetch_object($queryTotExportCont))!= false){

					$rowTotExportCon=$rowTotExportCont->TOT_EXP_CONT;
				}

             
				$sqlGetTotExportLoadedCont="SELECT COUNT(ctmsmis.mis_exp_unit.cont_id) AS exp_loaded_cont
											FROM ctmsmis.mis_exp_unit
											WHERE mis_exp_unit.vvd_gkey=$row->VVD_GKEY  AND mis_exp_unit.preAddStat='0' 
												AND mis_exp_unit.delete_flag='0'";

                 $queryTotExportLoadedCont=mysqli_query($con_sparcsn4, $sqlGetTotExportLoadedCont);
                 $rowTotExportLoadedCont=mysqli_fetch_object($queryTotExportLoadedCont);
				 
							if($row->BASIC_CLASS=='CELL') 
							{
								$cont_vessel_incoming++;
							}
							if($row->BASIC_CLASS!='CELL') 
							{
								$other_vessel_incoming++;
							}
						
							if($row->BASIC_CLASS=='CELL' AND  $vessel_class=='') 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->BASIC_CLASS!='CELL')
							{
								$in++;
							}
						
							if($row->BASIC_CLASS!='CELL' AND  $in==1) 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align='left'<font style="font-size: 20px;color:#1212e9"><b>Total Container Vessel : <?php echo $cont_vessel_incoming;?></b></font></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Other Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	}
							
					?>
                 <div class="block">
                     <div align="left"><font size="5"><b>Berth: <?php echo  $row->BERTH; ?></b></font></div>
                     <div align="left"><b>Vessel:</b> <?php echo  $row->NAME; ?></div>
					 <div align="left"><b>Rotation:</b> <?php echo  $row->IB_VYG; ?></div>
					 <div align="left"><b>Shipping Agent:</b> <?php echo $agent; ?></div>
                     <div align="left"><b>Berth Operator:</b> <?php echo  $row->BERTHOP; ?></div>
                     <div align="left"><b>Berthed On(E):</b> 
					 <?php 
					  $etaDt = $row->ETA;
					  $arrEta = explode('.',$etaDt);
					  $strAmPm = $arrEta[3];
					  $AmPmArr = explode(' ',$strAmPm);
                      echo  $arrEta[0].":".$arrEta[1].":".$arrEta[2]." ".$AmPmArr[1]; 
					 ?></div>

                     <div align="left"><b>Sailed On(E):</b> 
					 <?php 
					 $etdDt = $row->ETD;
					 $arrEtd = explode('.',$etdDt);
					 $strAmPm = $arrEtd[3];
					 $AmPmArr = explode(' ',$strAmPm);
					 echo $arrEtd[0].":".$arrEtd[1].":".$arrEtd[2]." ".$AmPmArr[1] ;
					 
					?></div>
					 <?php
						if($row->BASIC_CLASS == 'CELL') 
						{
					?>
                     <div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImport; ?></div>
                     <div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischarge; ?></div>
                     <div align="left"><b>Balance:</b> <?php echo  $rowTotImport - $rowTotImportDischarge; ?></div>
                     <div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCon; ?></div>
                     <div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                     <div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCon-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
					 <?php
						}
					 ?>
                 </div>
				 <?php 
								$vessel_class=$row->BASIC_CLASS;
				} ?>

         </div>
     </div>
        </div>
        <div class="clearfix"></div>
		<div align='left'<font style="font-size: 20px;color:#1212e9"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Other Vessel : <?php echo $other_vessel_incoming;?></b></font></div>
        <div align="center">
            <div><font size="5"><b>Total Vessel:<?php echo $j;?></b></font></div>
        </div>
		
		<div class="clearfix"></div>
        <div class="hr"></div>
        <div align="center">
            <u style="font-size: 24px;color:green"><b>Outgoing Vessel</b></u>
        </div>
        <div align="center">
        <div align="center">
         <div class="row">
            <?php

            $strQuery = "	SELECT  tbl.*,(Case
							when substr(berth,1,1)='G' then 1
							else
							(Case
							when substr(berth,1,1)='C' then 2
							else
							3
							end)
							End) as st FROM (
						 					 
							SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
							NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,ref_bizunit_scoped.id AS agent,
							(SELECT argo_quay.id FROM argo_quay
							INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
							WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
							ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,argo_visit_details.eta,argo_visit_details.etd,
							vsl_vessel_classes.basic_class
							FROM argo_carrier_visit
							INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
							INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
							INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
							INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
							INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
							INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
						
							WHERE   ref_country.cntry_code!='BD'  and cast(argo_visit_details.etd as date)=CURRENT_DATE
							
							
							union all 
							SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
							NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
							ref_bizunit_scoped.id AS agent,
							(SELECT argo_quay.id FROM argo_quay
							INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
							WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
							ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,argo_visit_details.eta,argo_visit_details.etd,
						 	vsl_vessel_classes.basic_class
							FROM argo_carrier_visit
							INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
							INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
							INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
							INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
							INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
							INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
							WHERE cast(argo_visit_details.etd as date)=  cast(CURRENT_DATE as date)   AND ref_country.cntry_code='BD' and vsl_vessels.notes='BD'
							) tbl ORDER BY basic_class,eta,berth";
           
		   $query = oci_parse($con_sparcsn4_oracle, $strQuery);
		   oci_execute($query);

   

        	$j=0;
			$out=0;
			$j=0;
			$in=0;
			$vessel_class='';
			$cont_vessel_incoming=0;
			$other_vessel_incoming=0;
			$rowTotImport='';
			$rowTotImportDischarge='';
			$rowTotExportCon='';
			while(($row = oci_fetch_object($query))!= false){

				// AGENT
				$agent_sql = "SELECT Y.id FROM ref_bizunit_scoped r 
				INNER JOIN vsl_vessel_visit_details ON r.gkey=vsl_vessel_visit_details.bizu_gkey
				LEFT JOIN ( ref_agent_representation X       
				LEFT JOIN ref_bizunit_scoped Y ON X.agent_gkey=Y.gkey )  ON r.gkey=X.bzu_gkey 
				WHERE vsl_vessel_visit_details.ib_vyg = '$row->IB_VYG'";

				$agent_data = oci_parse($con_sparcsn4_oracle, $agent_sql);
				oci_execute($agent_data);


				while(($rowAgent = oci_fetch_object($agent_data))!= false){
					$agent=$rowAgent->ID;
				}
		 
		 
	
                 $j++;
               
                 $sqlGetTotImportCont="SELECT COUNT(inv_unit.id) AS tot_cont_import
				 FROM inv_unit 
				 INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
				 INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
				 WHERE argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY";

				$queryTotImportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportCont);
				oci_execute($queryTotImportCont);

				while(($rowTotImportCont = oci_fetch_object($queryTotImportCont))!= false){
					$rowTotImport=$rowTotImportCont->TOT_CONT_IMPORT;


				}

        

				$sqlGetTotImportDischargeCont="SELECT COUNT(inv_unit.id) AS tot_discharge_cont
				FROM inv_unit 
				INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
				INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
				WHERE inv_unit.category='IMPRT' AND argo_carrier_visit.cvcvd_gkey=$row->VVD_GKEY  AND time_in IS NOT NULL";


				$queryTotImportDischargeCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotImportDischargeCont);
				oci_execute($queryTotImportDischargeCont);
				while(($rowTotImportDischargeCont = oci_fetch_object($queryTotImportDischargeCont))!= false){
					$rowTotImportDischarge=$rowTotImportDischargeCont->TOT_DISCHARGE_CONT; 

				}


        

				$sqlGetTotExportCont="  SELECT COUNT(inv_unit.id) AS tot_exp_cont
				FROM inv_unit
				INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
				INNER JOIN argo_carrier_visit ON argo_carrier_visit.gkey=inv_unit_fcy_visit.actual_ob_cv
				INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey 
				INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey 
				WHERE vsl_vessel_visit_details.vvd_gkey=  $row->VVD_GKEY";

			   $queryTotExportCont = oci_parse($con_sparcsn4_oracle, $sqlGetTotExportCont);
			   oci_execute($queryTotExportCont);
			   while(($rowTotExportCont = oci_fetch_object($queryTotExportCont))!= false){

				   $rowTotExportCon=$rowTotExportCont->TOT_EXP_CONT;
			   }


              
				$sqlGetTotExportLoadedCont="
				SELECT COUNT(ctmsmis.mis_exp_unit.cont_id) AS exp_loaded_cont
											FROM ctmsmis.mis_exp_unit
											WHERE mis_exp_unit.vvd_gkey=$row->VVD_GKEY  AND mis_exp_unit.preAddStat='0' 
												AND mis_exp_unit.delete_flag='0'";

                 $queryTotExportLoadedCont=mysqli_query($con_sparcsn4, $sqlGetTotExportLoadedCont);
                 $rowTotExportLoadedCont=mysqli_fetch_object($queryTotExportLoadedCont);

				
							if($row->BASIC_CLASS=='CELL' AND  $out_vessel_class=='') 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessels</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->BASIC_CLASS!='CELL')
							{
								$out++;
							}
						
							if($row->BASIC_CLASS!='CELL' AND  $out==1) 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Other Vessels</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	}
							
					?>
				<div class="block">
                     <div align="left"><font size="5"><b>Berth: <?php echo  $row->BERTH; ?></b></font></div>
                     <div align="left"><b>Vessel:</b> <?php echo  $row->NAME; ?></div>
					 <div align="left"><b>Rotation:</b> <?php echo  $row->IB_VYG; ?></div>
					 <div align="left"><b>Shipping Agent:</b> <?php echo  $agent; ?></div>
                     <div align="left"><b>Berth Operator:</b> <?php echo  $row->BERTHOP; ?></div>
                     <div align="left"><b>Berthed On(E):</b> 
					 <?php 
					 $etaDt = $row->ETA;
					 $arrEta = explode('.',$etaDt);
					 $strAmPm = $arrEta[3];
					 $AmPmArr = explode(' ',$strAmPm);
                     echo  $arrEta[0].":".$arrEta[1].":".$arrEta[2]." ".$AmPmArr[1]; 
					 ?></div>
                     
					 <div align="left"><b>Sailed On(E):</b> 
					 <?php 
					 $etdDt = $row->ETD;
					 $arrEtd = explode('.',$etdDt);
					 $strAmPm = $arrEtd[3];
					 $AmPmArr = explode(' ',$strAmPm);
					 echo $arrEtd[0].":".$arrEtd[1].":".$arrEtd[2]." ".$AmPmArr[1] ;
					 
					 ?></div>
					 <?php
						if($row->BASIC_CLASS == 'CELL') 
						{
					?>
                     <div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImport; ?></div>
                     <div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischarge; ?></div>
                     <div align="left"><b>Balance:</b> <?php echo  $rowTotImport - $rowTotImportDischarge; ?></div>
                     <div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCon; ?></div>
                     <div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                     <div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCon-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
					 <?php
						}
					 ?>
                 </div>
             <?php 
					$out_vessel_class=$row->BASIC_CLASS;
			 }
			 ?>
         </div>
     </div>
        </div>
        <div class="clearfix"></div>
        <div align="center">
            <div><font size="5"><b>Total Vessel:<?php echo $j;?></b></font></div>
        </div>
        <?php mysqli_close($con_sparcsn4); ?>
		<?php oci_close($con_sparcsn4_oracle); ?>
		<?php include('footer.php'); ?>
	</body>
</html>
