<html>
	<head>
		 
	</head>
	<body>
	<?php 
		//header("Content-type: application/octet-stream");
		//header("Content-Disposition: attachment; filename=Commodity.xls;");
		//header("Content-Type: application/ms-excel");
		//header("Pragma: no-cache");
		//header("Expires: 0");
	
	?>
		<div>			
			<div align="center">
				<?php include("dbConection42.php");?>
			</div>
			<div>
			
			<?php 
			$from_dt="2018-01-01";
			$to_dt="2018-12-31";
			$sql_month="SELECT DISTINCT MONTHNAME(file_clearence_date) AS igm_month,MONTH(file_clearence_date) AS month_id FROM igm_details
			WHERE DATE(igm_details.file_clearence_date) 
			BETWEEN '$from_dt' AND '$to_dt'";
			//echo $sql_month;
			$resMonth = mysql_query($sql_month);
			while($rowMonth = mysql_fetch_object($resMonth)){
				$chk_from="2018-".$rowMonth->month_id."-01";
				$chk_to="2018-".$rowMonth->month_id."-31";
						
				//echo $chk_from;
			?>
			<table width="90%" border ='1' cellpadding='0' cellspacing='0'>
			
				<tr align="center"><td>CHITTAGONG PORT AUTHORITY</td></tr>
				<tr align="center"><td>STATEMENT OF FOOD GRAINS & OTHER COMMODITIES FOR THE MONTH OF <?php echo $rowMonth->igm_month; ?></td></tr>
				<tr align="center">
					<td>
					<table border="1" cellpadding='0' cellspacing='0'>
						<tr align="center">
							<td>SL</td>
							<td>Vsl Name</td>
							<td>Rotation</td>
							<td>Arraival Date</td>
							<td>Rice Seeds Ton</td>
							<td>Rice Seeds Tues</td>
							<td>Lentil Ton</td>
							<td>Lentil Tues</td>
							<td>Wheat Flower Ton</td>
							<td>Wheat Flower Tues</td>
							<td>Musterad Ton</td>
							<td>Musterad Tues</td>
							<td>Sugar Ton</td>
							<td>Sugar Tues</td>
							<td>Chick Peas Ton</td>
							<td>Chick Peas Tues</td>
							<td>Ginger Ton</td>
							<td>Ginger Tues</td>
							<td>Garlic/Onion Ton</td>
							<td>Garlic/Onion Tues</td>
							<td>Milk Powder Ton</td>
							<td>Milk Powder Tues</td>
							<td>Oil Ton</td>
							<td>Oil Tues</td>
						</tr>
						<?php include("dbConection42.php");?>
						<?php 
						
						$sql_igmData="SELECT Vessel_Name,Import_Rotation_No,
						ROUND(SUM(rice_ton),4) AS rice_ton,
						SUM(rice_tues) AS rice_tues,
						ROUND(SUM(lentil_ton),4) AS lentil_ton,
						SUM(lentil_tues) AS lentil_tues,
						ROUND(SUM(wheat_ton),4) AS wheat_ton,
						SUM(wheat_tues) AS wheat_tues, 
						ROUND(SUM(seed_ton),4) AS seed_ton,
						SUM(seed_tues) AS seed_tues, 
						ROUND(SUM(sugar_ton),4) AS sugar_ton,
						SUM(sugar_tues) AS sugar_tues,   
						ROUND(SUM(peas_ton),4) AS peas_ton,
						SUM(peas_tues) AS peas_tues,
						ROUND(SUM(ginger_ton),4) AS ginger_ton,
						SUM(ginger_tues) AS ginger_tues,
						ROUND(SUM(garlic_ton),4) AS garlic_ton,
						SUM(garlic_tues) AS garlic_tues,
						ROUND(SUM(milk_ton),4) AS milk_ton,
						SUM(milk_tues) AS milk_tues,
						ROUND(SUM(oil_ton),4) AS oil_ton,
						SUM(oil_tues) AS oil_tues
						FROM 
						(
						SELECT igm_masters.Vessel_Name,igm_masters.Import_Rotation_No,
						IF(commudity_detail.commudity_code=4,cont_gross_weight/1000,0) AS rice_ton,
						IF(commudity_detail.commudity_code=4,IF(igm_detail_container.cont_size=20,1,2),0) AS rice_tues,
						IF(commudity_detail.commudity_code=5,cont_gross_weight/1000,0) AS lentil_ton,
						IF(commudity_detail.commudity_code=5,IF(igm_detail_container.cont_size=20,1,2),0) AS lentil_tues,
						IF(commudity_detail.commudity_code=6,cont_gross_weight/1000,0) AS wheat_ton,
						IF(commudity_detail.commudity_code=6,IF(igm_detail_container.cont_size=20,1,2),0) AS wheat_tues,
						IF(commudity_detail.commudity_code=7,cont_gross_weight/1000,0) AS seed_ton,
						IF(commudity_detail.commudity_code=7,IF(igm_detail_container.cont_size=20,1,2),0) AS seed_tues,
						IF(commudity_detail.commudity_code=8,cont_gross_weight/1000,0) AS sugar_ton,
						IF(commudity_detail.commudity_code=8,IF(igm_detail_container.cont_size=20,1,2),0) AS sugar_tues,
						IF(commudity_detail.commudity_code=9,cont_gross_weight/1000,0) AS peas_ton,
						IF(commudity_detail.commudity_code=9,IF(igm_detail_container.cont_size=20,1,2),0) AS peas_tues,
						IF(commudity_detail.commudity_code=36,cont_gross_weight/1000,0) AS ginger_ton,
						IF(commudity_detail.commudity_code=36,IF(igm_detail_container.cont_size=20,1,2),0) AS ginger_tues,
						IF(commudity_detail.commudity_code=37,cont_gross_weight/1000,0) AS garlic_ton,
						IF(commudity_detail.commudity_code=37,IF(igm_detail_container.cont_size=20,1,2),0) AS garlic_tues,
						IF(commudity_detail.commudity_code=41,cont_gross_weight/1000,0) AS milk_ton,
						IF(commudity_detail.commudity_code=41,IF(igm_detail_container.cont_size=20,1,2),0) AS milk_tues,
						IF(commudity_detail.commudity_code=43,cont_gross_weight/1000,0) AS oil_ton,
						IF(commudity_detail.commudity_code=43,IF(igm_detail_container.cont_size=20,1,2),0) AS oil_tues
						FROM igm_details 
						INNER JOIN igm_detail_container ON igm_detail_container.igm_detail_id=igm_details.id
						INNER JOIN igm_masters ON igm_masters.id=igm_details.IGM_id
						INNER JOIN commudity_detail ON commudity_detail.commudity_code=igm_detail_container.commudity_code
						WHERE DATE(igm_details.file_clearence_date) 
						BETWEEN '$chk_from' AND '$chk_to' AND vsl_dec_type='GM'
						) 
						AS tbl
						GROUP BY Vessel_Name";
						//echo $sql_igmData;
						$resIgm = mysql_query($sql_igmData);
						$i=0;
						while($rowIgm = mysql_fetch_object($resIgm)){
						$i++;
						?>
							<tr align="center">
								<td><?php echo $i; ?></td>
								<td><?php echo $rowIgm->Vessel_Name; ?></td>
								<td><?php echo $rowIgm->Import_Rotation_No; ?></td>
								
								<?php 
								include("dbConection.php");
								?>
								<?php 
								$sql_ata="SELECT 
								sparcsn4.argo_carrier_visit.ata
								FROM sparcsn4.argo_carrier_visit
								INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
								INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
								INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
								INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
								WHERE vsl_vessel_visit_details.ib_vyg='$rowIgm->Import_Rotation_No'";
								$resAta = mysql_query($sql_ata);
								$rowAta = mysql_fetch_object($resAta);
								?>
								<td><?php echo $rowAta->ata; ?></td>
								<td><?php echo $rowIgm->rice_ton; ?></td>
								<td><?php echo $rowIgm->rice_tues; ?></td>
								<td><?php echo $rowIgm->lentil_ton; ?></td>
								<td><?php echo $rowIgm->lentil_tues; ?></td>
								<td><?php echo $rowIgm->wheat_ton; ?></td>
								<td><?php echo $rowIgm->wheat_tues; ?></td>
								<td><?php echo $rowIgm->seed_ton; ?></td>
								<td><?php echo $rowIgm->seed_tues; ?></td>
								<td><?php echo $rowIgm->sugar_ton; ?></td>
								<td><?php echo $rowIgm->sugar_tues; ?></td>
								<td><?php echo $rowIgm->peas_ton; ?></td>
								<td><?php echo $rowIgm->peas_tues; ?></td>
								<td><?php echo $rowIgm->ginger_ton; ?></td>
								<td><?php echo $rowIgm->ginger_tues; ?></td>
								<td><?php echo $rowIgm->garlic_ton; ?></td>
								<td><?php echo $rowIgm->garlic_tues; ?></td>
								<td><?php echo $rowIgm->milk_ton; ?></td>
								<td><?php echo $rowIgm->milk_tues; ?></td>
								<td><?php echo $rowIgm->oil_ton; ?></td>
								<td><?php echo $rowIgm->oil_tues; ?></td>
							</tr>
						<?php } 
							
							mysql_close($con_sparcsn4);
							mysql_close($con_cchaportdb);
						?>
					</table>
					<br>
					</td>
				</tr>
			</table>
			<?php } 
			?>
			</div>
		</div>
		<?php mysql_close($con_sparcsn4); ?>
		<?php mysql_close($con_cchaportdb); ?>
		<?php include('footer.php'); ?>
	</body>
</html>