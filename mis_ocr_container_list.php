<html>
	<head>
		 <!--meta http-equiv="refresh" content="20"-->
			 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
			 <!-- SOURAV
				* Canvas JS start month from 0 - 11 
				* So In Query 1 Month subtract
			 -->
			<script type="text/javascript" src="jquery-1.6.0.min.js"></script>
			<script type="text/javascript" src="calender.jquery-ui.min.js"></script>
			<link rel="stylesheet" type="text/css" href="css/calender.jquery-ui.css">
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");?>
				
				<?php
					$getDate=$_GET['strdt'];
					$getGate=$_GET['strgate'];
					$getStatus=$_GET['strstat'];
					$cond="";
					if($getStatus=="ok")
					{
						$cond=" AND legal_delivery_st=1";
					}
					else if($getStatus=="fault")
					{
						$cond=" AND legal_delivery_st=0";
					}
					else
					{
						$cond=" ";
					}
				?>
				<table>
					<tr>
						<td colspan="7"><font size="5"><b><?php echo $getGate; ?> Gate Container List for the date of <?php echo $getDate; ?></b></font>
						</td>
					</tr>
				</table>
				
				<div class="row">
					<table width="80%" border="1px" align="center" cellspacing="0" cellpadding="0">
						<thead>
							<tr bgcolor="#C6C5C5">
								<td align="center">Sl</td>
								<td align="center">Container</td>
								<td align="center">Freight Kind</td>
								<td align="center">Status</td>
								<td align="center">Offdock</td>
								<td align="center">Assignment Type</td>
								<td align="center">Assignment Date</td>							
								<td align="center">C&F</td>		
								<td align="center">Trailer Number</td>		
								<td align="center">Actual Gate Out</td>
							</tr>
						</thead>
						<tbody>
							<?php 
								$ocrInfo= "SELECT * FROM ctmsmis.mis_ocr_info
								WHERE entry_dt='$getDate' and cont_number is not null and cont_number !=''".$cond."
								order by entry_dt_time desc";
								$resOcr=mysql_query($ocrInfo);
								$i=0;
								$tot_ok=0;
								$tot_fault=0;
								while($rowOcr=mysql_fetch_object($resOcr))
								{
								$i++;
								
								include("dbConection.php");
								$sql_gate_cont="SELECT sparcsn4.road_truck_visit_details.bat_nbr
								FROM sparcsn4.inv_unit
								INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.unit_gkey=sparcsn4.inv_unit.gkey
								INNER JOIN sparcsn4.road_truck_visit_details ON sparcsn4.road_truck_visit_details.tvdtls_gkey=sparcsn4.road_truck_transactions.truck_visit_gkey
								WHERE sparcsn4.inv_unit.id='$rowOcr->cont_number' 
								ORDER BY sparcsn4.road_truck_visit_details.tvdtls_gkey DESC LIMIT 1";
								$rslt_gate_cont=mysql_query($sql_gate_cont);	
								$row_batNo=mysql_fetch_object($rslt_gate_cont);
								mysql_close($con_sparcsn4);
								
								include("dbConection42.php");								
								$get_offdock_name="SELECT Organization_Name FROM igm_detail_container 
								INNER JOIN igm_details ON igm_details.id=igm_detail_container.igm_detail_id 
								INNER JOIN organization_profiles ON igm_detail_container.off_dock_id= organization_profiles.id 
								WHERE igm_detail_container.cont_number='$rowOcr->cont_number'
								ORDER BY igm_detail_container.id DESC LIMIT 1";
								$rslt_offdock=mysql_query($get_offdock_name);	
								
								$row_offdock=mysql_fetch_object($rslt_offdock);
								mysql_close($con_cchaportdb);
							?>
								<tr  <?php if($rowOcr->legal_delivery_st=="1") { ?> bgcolor="#DAF7A6" <?php } else { ?> bgcolor="#FA1502" <?php } ?>>
									<td align="center"><?php echo $i; ?></td>
									<td align="center"><?php echo $rowOcr->cont_number; ?></td>
									<td align="center"><?php echo $rowOcr->freight_kind; ?></td>
									<td align="center"><?php if($rowOcr->legal_delivery_st=="1") echo "OK"; else echo "Fault"; ?></td>
									<td align="center"><?php echo $row_offdock->Organization_Name; ?></td>
									<td align="center"><?php echo $rowOcr->assign_type; ?></td>
									<td align="center"><?php echo $rowOcr->assign_dt; ?></td>	
									<td align="center"><?php echo $rowOcr->cf_name; ?></td>
									<td align="center"><?php echo $row_batNo->bat_nbr; ?></td>
									<td align="center"><?php echo $rowOcr->entry_dt_time; ?></td>
									
								</tr>
								<?php } ?>
						</tbody>
				</div>
				</div>
			</div>
		</div>
		
	</body>
	
	<?php mysql_close($con_sparcsn4); ?>
			<?php include('footer.php'); ?>

</html>