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
				<?php include("dbConection.php");?>
				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Gate Operation Detail list at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
				</table>
				
				<table width="50%" border ='1' cellpadding='0' cellspacing='0'>	
				<tr  align="center" bgcolor="#D8D0CE">
					<td style="border-width:3px;border-style: double;"><b>SlNo.</b></td>
					<td style="border-width:3px;border-style: double;"><b>Container No</b></td>
					<td style="border-width:3px;border-style: double;"><b>Container Status</b></td>
					<td style="border-width:3px;border-style: double;"><b>Size</b></td>
					<td style="border-width:3px;border-style: double;"><b>Height</b></td>
					<td style="border-width:3px;border-style: double;"><b>Gate Status</b></td>
					<td style="border-width:3px;border-style: double;"><b>Gate ID</b></td>
					<td style="border-width:3px;border-style: double;"><b>Time</b></td>

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
				$strQuery = "SELECT  inv_unit.id AS cont_no, inv_unit.freight_kind AS cont_status,  

						(SELECT RIGHT(sparcsn4.ref_equip_type.nominal_length,2) FROM sparcsn4.inv_unit_equip 
						INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
						INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 
						WHERE sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey) AS size,

						((SELECT RIGHT(sparcsn4.ref_equip_type.nominal_height,2) FROM sparcsn4.inv_unit_equip 
						INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
						INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 
						WHERE sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey)/10) AS height,

						sparcsn4.road_truck_visit_details.created AS time_at,
						IF(stage_id='In Gate',1,0) AS GateIn,IF(stage_id='Out Gate',1,0) AS GateOut,road_gates.id AS gate_name
						FROM 

						sparcsn4.inv_unit
						INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
						INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.unit_gkey=sparcsn4.inv_unit.gkey
						INNER JOIN sparcsn4.road_truck_visit_details ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
						LEFT JOIN sparcsn4.road_gates ON sparcsn4.road_gates.gkey=road_truck_visit_details.gate_gkey
						WHERE DATE(sparcsn4.road_truck_visit_details.created)=DATE(NOW() )";
				
				//echo $strQuery;
				$query=mysql_query($strQuery);

				$i=0;
				$tIn = 0;
				$tOut = 0;
				$cct1= 0;
				$cct2= 0;
				$cpar= 0;
				$gate4= 0;
				$gate5= 0;
				$nctlane1= 0;
				$nctlane3= 0;
				while($row=mysql_fetch_object($query)){
				$i++;
				/* $tIn += $row->TotalGateIN;
				$tOut += $row->TotalgateOut;
				if($row->GateNo=="CCT-1")
					$cct1= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="CCT-2")
					$cct2= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="CPAR")
					$cpar= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="GATE-4")
					$gate4= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="GATE-5")
					$gate5= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="NCT LANE1")
					$nctlane1= $row->TotalGateIN+$row->TotalgateOut;
				else if($row->GateNo=="NCT LANE3")
					$nctlane3= $row->TotalGateIN+$row->TotalgateOut; */
				/*$sqlGetTotIn="SELECT COUNT(sparcsn4.road_truck_transactions.nbr) AS total_in
								FROM sparcsn4.road_truck_visit_details
								INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
								WHERE DATE(sparcsn4.road_truck_visit_details.created)=DATE(NOW()) AND sparcsn4.road_truck_visit_details.gate_gkey=$row->gkey AND stage_id='In Gate'";
				$queryTotIn=mysql_query($sqlGetTotIn);
				$rowTotIn=mysql_fetch_object($queryTotIn);
				
				$sqlGetTotOut="SELECT COUNT(sparcsn4.road_truck_transactions.nbr) AS total_out
								FROM sparcsn4.road_truck_visit_details
								INNER JOIN sparcsn4.road_truck_transactions ON sparcsn4.road_truck_transactions.truck_visit_gkey=sparcsn4.road_truck_visit_details.tvdtls_gkey
								WHERE DATE(sparcsn4.road_truck_visit_details.created)=DATE(NOW()) AND sparcsn4.road_truck_visit_details.gate_gkey=$row->gkey AND stage_id='Out Gate'";
				$queryTotOut=mysql_query($sqlGetTotOut);
				$rowTotOut=mysql_fetch_object($queryTotOut);*/
				
			?>
			<tr align="center">
				<td><?php  echo $i;?></td>
				<td><?php if($row->cont_no) echo $row->cont_no; else echo "&nbsp;";?></td>
				<td><?php if($row->cont_status) echo $row->cont_status; else echo "&nbsp;";?></td>
				<td><?php if($row->size) echo $row->size; else echo "&nbsp;";?></td>
				<td><?php if($row->height) echo $row->height; else echo "&nbsp;";?></td>
				<td><?php if($row->GateIn=="1") echo 'IN'; else echo "OUT";?></td>
				<td><?php if($row->gate_name) echo $row->gate_name; else echo "&nbsp;";?></td>
				<td><?php if($row->time_at) echo $row->time_at; else echo "&nbsp;";?></td>
		
			</tr>

			<?php } 
			?>
			
			</table>
			</div>
			
		<?php mysql_close($con_sparcsn4); ?>
				<?php include('footer.php'); ?>

	</body>
</html>