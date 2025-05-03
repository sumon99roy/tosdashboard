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
                <u style="font-size: 24px;color: green"><b>Working Vessel</b></u>
            </div>
			<div align="center" >
				<div class="row" >
					<?php
						$strQuery = "SELECT * FROM 
						(
						SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
						IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
						(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
						INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
						WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
						ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_visit_details.etd,
						(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl,sparcsn4.vsl_vessel_classes.basic_class
						FROM sparcsn4.argo_carrier_visit
						INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
						INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
						INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
						INNER JOIN sparcsn4.vsl_vessel_classes ON sparcsn4.vsl_vessel_classes.gkey=sparcsn4.vsl_vessels.vesclass_gkey
						INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
						INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
						WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND sparcsn4.ref_country.cntry_code!='BD'
						UNION ALL
						SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
						IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
						(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
						INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
						WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
						ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_visit_details.etd,
						(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl,sparcsn4.vsl_vessel_classes.basic_class
						FROM sparcsn4.argo_carrier_visit
						INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
						INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
						INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
						INNER JOIN sparcsn4.vsl_vessel_classes ON sparcsn4.vsl_vessel_classes.gkey=sparcsn4.vsl_vessels.vesclass_gkey
						INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
						INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
						WHERE sparcsn4.argo_carrier_visit.phase IN ('30ARRIVED','40WORKING') AND sparcsn4.ref_country.cntry_code='BD' AND sparcsn4.vsl_vessels.notes='BD'
						) AS tbl WHERE berth IS NOT NULL ORDER BY  basic_class='CELL' DESC";
						$query=mysql_query($strQuery);
						$i=0;
						$k=0;
						$cont_vessel_working=0;
						$other_vessel_working=0;
						while($row=mysql_fetch_object($query)){
							$i++;
							$sqlGetTotImportCont="SELECT COUNT(inv_unit.id) AS tot_cont_import
							FROM sparcsn4.inv_unit 
							INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit.declrd_ib_cv
							WHERE sparcsn4.argo_carrier_visit.cvcvd_gkey=$row->vvd_gkey";
							
							$queryTotImportCont=mysql_query($sqlGetTotImportCont);
							$rowTotImportCont=mysql_fetch_object($queryTotImportCont);
							
							
							$sqlGetTotImportTeus="SELECT SUM(IF(size>=40, 2, 1)) AS teus FROM (
							SELECT inv_unit.id AS tot_cont_import,
							(SELECT RIGHT(sparcsn4.ref_equip_type.nominal_length,2) FROM sparcsn4.inv_unit_equip
							INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
							INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey
							WHERE sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey
							)  AS size

							FROM sparcsn4.inv_unit 
							INNER JOIN sparcsn4.inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey 
							INNER JOIN sparcsn4.argo_carrier_visit ON argo_carrier_visit.gkey=sparcsn4.inv_unit.declrd_ib_cv
							WHERE sparcsn4.argo_carrier_visit.cvcvd_gkey='$row->vvd_gkey') AS tmp";
							
							$queryTotImportTeus=mysql_query($sqlGetTotImportTeus);
							$rowTotImportTeus=mysql_fetch_object($queryTotImportTeus);
							
							
							
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
							
							if($row->basic_class=='CELL') 
							{
								$cont_vessel_working++;
							}
							if($row->basic_class!='CELL') 
							{
								$other_vessel_working++;
							}
							if($row->basic_class=='CELL' AND  $vessel_class=='') 
							{ 								
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->basic_class!='CELL')
							{
								$k++;
							}
						
							if($row->basic_class!='CELL' AND  $k==1) 
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
							<div align="left"><font size="5"><b>Berth: <?php echo  $row->berth; ?></b></font></div>
							<div align="left"><b>Vessel:</b> <?php echo  $row->name; ?></div>
							<div align="left"><b>Rotation:</b> <?php echo  $row->ib_vyg; ?></div>
							<div align="left"><b>Berth Operator:</b> <?php echo  $row->berthop; ?></div>
							<div align="left"><b>Berthed On:</b> <?php echo  $row->ata; ?></div>
							<div align="left"><b>Sailed On(E):</b> <?php echo  $row->etd; ?></div>
							<div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImportCont->tot_cont_import.'(Box),  '.$rowTotImportTeus->teus.'(TEUs)'; ?></div>
							<div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
							<div align="left"><b>Balance:</b> <?php echo  $rowTotImportCont->tot_cont_import - $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
							<div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCont->tot_exp_cont; ?></div>
							<div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
							<div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCont->tot_exp_cont-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
						</div>

						<?php 
								$vessel_class=$row->basic_class;
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
             $strQuery = "SELECT * FROM
			(SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
			IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
			(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
			INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
			WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_visit_details.eta,sparcsn4.argo_visit_details.etd,
			(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl, sparcsn4.vsl_vessel_classes.basic_class
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
			INNER JOIN sparcsn4.vsl_vessel_classes ON sparcsn4.vsl_vessel_classes.gkey=sparcsn4.vsl_vessels.vesclass_gkey
			INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
			INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
			WHERE sparcsn4.argo_carrier_visit.phase='20INBOUND' AND DATE(sparcsn4.argo_visit_details.eta) BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL 1 DAY) AND sparcsn4.ref_country.cntry_code!='BD'
			ORDER BY sparcsn4.argo_carrier_visit.phase,sparcsn4.vsl_vessels.name) AS tbl ORDER BY basic_class,eta,berth";
             $query=mysql_query($strQuery);
             $j=0;
			 $in=0;
			 $vessel_class='';
			 $cont_vessel_incoming=0;
			 $other_vessel_incoming=0;
             while($row=mysql_fetch_object($query)){
                 $j++;
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
				 
							if($row->basic_class=='CELL') 
							{
								$cont_vessel_incoming++;
							}
							if($row->basic_class!='CELL') 
							{
								$other_vessel_incoming++;
							}
						
							if($row->basic_class=='CELL' AND  $vessel_class=='') 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessel</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->basic_class!='CELL')
							{
								$in++;
							}
						
							if($row->basic_class!='CELL' AND  $in==1) 
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
                     <div align="left"><font size="5"><b>Berth: <?php echo  $row->berth; ?></b></font></div>
                     <div align="left"><b>Vessel:</b> <?php echo  $row->name; ?></div>
					 <div align="left"><b>Rotation:</b> <?php echo  $row->ib_vyg; ?></div>
                     <div align="left"><b>Berth Operator:</b> <?php echo  $row->berthop; ?></div>
                     <div align="left"><b>Berthed On(E):</b> <?php echo  $row->eta; ?></div>
                     <div align="left"><b>Sailed On(E):</b> <?php echo  $row->etd; ?></div>
                     <div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImportCont->tot_cont_import; ?></div>
                     <div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
                     <div align="left"><b>Balance:</b> <?php echo  $rowTotImportCont->tot_cont_import - $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
                     <div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCont->tot_exp_cont; ?></div>
                     <div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                     <div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCont->tot_exp_cont-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                 </div>
				 <?php 
								$vessel_class=$row->basic_class;
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
            $strQuery = "SELECT * FROM (
			SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
			IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
			(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
			INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
			WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_visit_details.eta,sparcsn4.argo_visit_details.etd,
			(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl, sparcsn4.vsl_vessel_classes.basic_class
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
			INNER JOIN sparcsn4.vsl_vessel_classes ON sparcsn4.vsl_vessel_classes.gkey=sparcsn4.vsl_vessels.vesclass_gkey
			INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
			INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
			WHERE DATE(sparcsn4.argo_visit_details.etd)=DATE(NOW()) AND sparcsn4.ref_country.cntry_code!='BD'
			union all 
			SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name, vsl_vessel_visit_details.ib_vyg,
			IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
			(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
			INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
			WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,sparcsn4.argo_visit_details.eta,sparcsn4.argo_visit_details.etd,
			(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl, sparcsn4.vsl_vessel_classes.basic_class
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
			INNER JOIN sparcsn4.vsl_vessel_classes ON sparcsn4.vsl_vessel_classes.gkey=sparcsn4.vsl_vessels.vesclass_gkey
			INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
			INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
			WHERE DATE(sparcsn4.argo_visit_details.etd)=DATE(NOW()) AND sparcsn4.ref_country.cntry_code='BD' and sparcsn4.vsl_vessels.notes='BD'
			) AS tbl ORDER BY basic_class,eta,berth";
             $query=mysql_query($strQuery);
             $j=0;
			 $out=0;
             while($row=mysql_fetch_object($query)){
                 $j++;
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

				
							if($row->basic_class=='CELL' AND  $out_vessel_class=='') 
							{ 
						?>
						        <div class="clearfix"></div>
								<div align="center">
									<u style="font-size: 20px;color:blue"><b>Container Vessels</u></u>
								</div>
								 <div class="hr"></div>
						
						<?php	
							}
							if($row->basic_class!='CELL')
							{
								$out++;
							}
						
							if($row->basic_class!='CELL' AND  $out==1) 
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
                     <div align="left"><font size="5"><b>Berth: <?php echo  $row->berth; ?></b></font></div>
                     <div align="left"><b>Vessel:</b> <?php echo  $row->name; ?></div>
					 <div align="left"><b>Rotation:</b> <?php echo  $row->ib_vyg; ?></div>
                     <div align="left"><b>Berth Operator:</b> <?php echo  $row->berthop; ?></div>
                     <div align="left"><b>Berthed On(E):</b> <?php echo  $row->eta; ?></div>
                     <div align="left"><b>Sailed On(E):</b> <?php echo  $row->etd; ?></div>
                     <div align="left"><b>Total Import Container:</b> <?php echo  $rowTotImportCont->tot_cont_import; ?></div>
                     <div align="left"><b>Discharge Container:</b> <?php echo  $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
                     <div align="left"><b>Balance:</b> <?php echo  $rowTotImportCont->tot_cont_import - $rowTotImportDischargeCont->tot_discharge_cont; ?></div>
                     <div align="left"><b>Total Export Container:</b> <?php echo  $rowTotExportCont->tot_exp_cont; ?></div>
                     <div align="left"><b>Loaded On Board:</b> <?php echo  $rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                     <div align="left"><b>Balance To Be Shipped:</b> <?php echo  $rowTotExportCont->tot_exp_cont-$rowTotExportLoadedCont->exp_loaded_cont; ?></div>
                 </div>

             <?php 
					$out_vessel_class=$row->basic_class;
			 }
			 ?>
         </div>
     </div>
        </div>
        <div class="clearfix"></div>
        <div align="center">
            <div><font size="5"><b>Total Vessel:<?php echo $j;?></b></font></div>
        </div>
        <?php mysql_close($con_sparcsn4); ?>
		<?php include('footer.php'); ?>
	</body>
</html>
