<html>
	<head>
		  <!-- <meta http-equiv="refresh" content="130">  -->
		  <!-- <?php set_time_limit(0);?>  -->
	    <style>
			body{font-family: "Calibri";}
			.chart{float:left;}
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
			    <?php include("dbConection42.php");?>

				<table>
					<tr style="margin:5px;">
						<td colspan="12"><font size="5"><b>Yard Occupancy </b></td>
					</tr>
				</table>
				<table align="center" width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">		
					<tr>
					  <th rowspan="2" >YARD</th>
					  <th rowspan="2" >CAPACITY TUES</th>
					  <th colspan="2" >LYING/USED TUES(Total)</th>
					  <th colspan="2" >FREE TUES</th>
					  <th colspan="2">LYING/USED BOX(Total)</th>
					  <!-- <th colspan="2" >FREE BOX</th> -->
					
					</tr>
					<tr>
					  <th>Tues</th>
                      <th>Percentage (%)</th>
					  <th>Tues</th>
					  <th>Percentage (%)</th>
					  <th>Box</th>
                      <!-- <th>Percentage (%)</th> -->
					  <!-- <th>Box</th> -->
					  <!-- <th>Percentage (%)</th> -->

                    </tr>

					<tr>
						<td align="center">CCT</td>

						<td align="center">
						<?php

							// echo $cctTotal = 15658;
							echo $cctTotal = 8376;
							
						?>
						</td>

						<td align="center">
						<?php

						// $cctQuery = "SELECT tbl2.*  FROM(
						// 		SELECT
						// 		tbl.*,
						// 		(Case
						// 		when (siz=20) then 1
						// 		else
						// 		0
						// 		end) AS tot_20
								
						// 		,     (Case
						// 		when (siz!=20) then 1
						// 		else
						// 		0
						// 		end) AS tot_40
							  
								
						// 		FROM(
						// 		SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
								
						// 		(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
						// 		INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
						// 		INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
						// 		INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
						// 		where inv_unit_fcy_visit.unit_gkey=inv_unit.gkey fetch first 1 rows only
						// 		) as siz,
								
						// 		NVL(last_pos_slot,'') AS last_pos_slot
						// 		FROM  inv_unit inv   
						// 		INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
						// 		WHERE fcy.transit_state='S40_YARD')  tbl) tbl2 
						// 		";


						$cctQuery="SELECT tbl2.*  FROM(
							SELECT
							tbl.*,
							(Case
							when (siz=20) then 1
							else
							0
							end) AS tot_20
							
							,     (Case
							when (siz!=20) then 1
							else
							0
							end) AS tot_40
						  
							
							FROM(
							SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
							
							(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
							INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
							where ref_equipment.gkey=inv.eq_gkey
							fetch first 1 rows only
							) as siz,
							NVL(last_pos_slot,'') AS last_pos_slot
							FROM  inv_unit inv   
							INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
							WHERE fcy.transit_state='S40_YARD')  tbl) tbl2";
							
							
				  
							$cctResult = oci_parse($con_sparcsn4_oracle,$cctQuery);
							oci_execute($cctResult);

								// $results8=array();
								// $numRowCSAS = oci_fetch_all($cctResult, $results8, null, null, OCI_FETCHSTATEMENT_BY_ROW);
								//oci_free_statement($numRowCSAS); 

								// $cctResult = oci_parse($con_sparcsn4_oracle,$cctQuery);
								// oci_execute($cctResult);

								//echo "$numRowCSAS rows fetched<br>\n";
								//var_dump($results8);
								
							$cct_teus_20 = 0;
							$cct_teus_40 = 0;
							$cctUsed=0;

							$nct_teus_20 = 0;
							$nct_teus_40 = 0;
							$nctUsed=0;

                            $gcb_teus_20 = 0;
							$gcb_teus_40 = 0;
							$gcbUsed=0;

							$ofy_teus_20 = 0;
							$ofy_teus_40 = 0;
							$ofyUsed=0;

							$scy_teus_20 = 0;
							$scy_teus_40 = 0;
							$scyUsed=0;
						
							$cctBox=0;
							$nctBox=0;
							$gcbBox=0;
							$ofyBox=0;
							$scyBox=0;
							
							while(($cct_row = oci_fetch_object($cctResult))!= false)
							{
								$last_pos_slot = $cct_row->LAST_POS_SLOT;
							
							//	echo "-------".$last_pos_slot;
								 $sql1="SELECT cont_yard('".$last_pos_slot."') AS Yard_No";
								 $sqlRslt1=mysqli_query($con_cchaportdb,$sql1);
								 $row1=mysqli_fetch_object($sqlRslt1);
								 $yard_no=$row1->Yard_No;
								if($yard_no=='CCT'){
									$cctBox++;
									$cct_teus_20 = $cct_teus_20+$cct_row->TOT_20;
									$cct_teus_40 = $cct_teus_40+$cct_row->TOT_40*2;
								}
								
								// $cctUsed = $cct_teus_20 + $cct_teus_40; 	

								 elseif($yard_no=='NCT'){
								 	$nctBox++;
								 	$nct_teus_20 = $nct_teus_20+$cct_row->TOT_20;
								 	$nct_teus_40 = $nct_teus_40+$cct_row->TOT_40*2;
								}
								
								// // $nctUsed = $nct_teus_20 + $nct_teus_40; 	
								 elseif($yard_no=='GCB'){
								  $gcbBox++;
								  $gcb_teus_20 = $gcb_teus_20+$cct_row->TOT_20;
								  $gcb_teus_40 = $gcb_teus_40+$cct_row->TOT_40*2;
								 }

								 elseif($yard_no=='OFY'){
									$ofyBox++;
									$ofy_teus_20 = $ofy_teus_20+$cct_row->TOT_20;
									$ofy_teus_40 = $ofy_teus_40+$cct_row->TOT_40*2;
								   }
								   
								   elseif($yard_no=='SCY'){
									$scyBox++;
									$scy_teus_20 = $scy_teus_20+$cct_row->TOT_20;
									$scy_teus_40 = $scy_teus_40+$cct_row->TOT_40*2;
								   } 
								  
								
								$cctUsed = $cct_teus_20 + $cct_teus_40; 
								$nctUsed = $nct_teus_20 + $nct_teus_40; 	
							    $gcbUsed = $gcb_teus_20 + $gcb_teus_40; 	
                                $ofyUsed = $ofy_teus_20 + $ofy_teus_40; 
								$scyUsed = $scy_teus_20 + $scy_teus_40; 
							} 

							echo $cctUsed;


						?>
						</td>

						<td align="center">
						<?php
						// if($cctTotal>$cctUsed){
						// 	$cctUsedPercentage = ($cctUsed/$cctTotal)*100;
						// 	echo round($cctUsedPercentage,2)."%";}else{
						// 	$cctUsedPercentage = ($cctTotal/$cctUsed)*100;
						// 	echo round($cctUsedPercentage,2)."%";}

						$cctUsedPercentage = ($cctUsed/$cctTotal)*100;
						echo round($cctUsedPercentage,2)."%";


						?>
						</td>

						<td align="center">
						<?php
							echo $cctFree = ($cctTotal - $cctUsed);
						?>
						</td>

						<td align="center">
						<?php
						// if($cctTotal>$cctFree){
						// 	$cctFreePercentage = ($cctFree/$cctTotal)*100;
						// 	echo round($cctFreePercentage,2)."%";}else{
						// 	$cctFreePercentage = ($cctTotal/$cctFree)*100;
						// 	echo round($cctFreePercentage,2)."%";}
						$cctFreePercentage = ($cctFree/$cctTotal)*100;
						echo round($cctFreePercentage,2)."%";
						?>
						</td>
						 <td align="center">
							<?php echo $cctBox; ?>
						</td>
						<!-- <td align="center">
						<?php
						// if($cctTotal>$cctBox){
						// 	 $cctUsedPercentage = ($cctBox/$cctTotal)*100;
						// 	 echo round($cctUsedPercentage,2)."%";}else{
						// 	 $cctFreePercentage = ($cctTotal/$cctBox)*100;
						// 	 echo round($cctFreePercentage,2)."%";}
						$cctUsedPercentage = ($cctBox/$cctTotal)*100;
						echo round($cctUsedPercentage,2)."%";


							?>
						</td> -->
						<!-- <td align="center">
							<?php  echo $cctFreeBox = ($cctTotal - $cctBox); ?>
						</td> -->
						<!-- <td align="center">
							<?php 
							// if($cctTotal>$cctFreeBox){
							// $cctFreePercentage = ($cctFreeBox/$cctTotal)*100;
							// echo round($cctFreePercentage,2)."%"; }else{
							// $cctFreePercentage = ($cctTotal/$cctFreeBox)*100;
							//  echo round($cctFreePercentage,2)."%";} 
                            $cctFreePercentage = ($cctFreeBox/$cctTotal)*100;
							 echo round($cctFreePercentage,2)."%";

							?>
						</td>  -->
					</tr>
					<tr>
						<td align="center">NCT</td>

						<td align="center">
						<?php

							// echo $nctTotal = 30798;
							echo $nctTotal = 13876;

						?>
						</td>

						<td align="center">
						<?php
						
							


							// $nctQuery = "SELECT tbl2.*  FROM(
							// 	SELECT
							// 	tbl.*,
							// 	(Case
							// 	when (siz=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_20
								
							// 	,     (Case
							// 	when (siz!=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_40
							  
								
							// 	FROM(
							// 	SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
								
							// 	(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
							// 	INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
							// 	INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
							// 	INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							// 	where inv_unit_fcy_visit.unit_gkey=inv_unit.gkey fetch first 1 rows only
							// 	) as siz,
								
							// 	NVL(last_pos_slot,'') AS last_pos_slot
							// 	FROM  inv_unit inv   
							// 	INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
							// 	WHERE fcy.transit_state='S40_YARD')  tbl) tbl2 
							// 	";

							// $nctResult = oci_parse($con_sparcsn4_oracle,$nctQuery);
							// oci_execute($nctResult);

								
							// $nct_teus_20 = 0;
							// $nct_teus_40 = 0;
							// $nctUsed=0;
							// while(($nct_row = oci_fetch_object($nctResult))!= false){
							
							// 	$last_pos_slot = $nct_row->LAST_POS_SLOT;
							// 	$sql1="SELECT ctmsmis.cont_yard('".$last_pos_slot."') AS Yard_No";
							// 	$sqlRslt1=mysqli_query($con_sparcsn4, $sql1);
							// 	$row1=mysqli_fetch_object($sqlRslt1);
							// 	$yard_no=$row1->Yard_No;

							// 	if($yard_no=='NCT'){
							// 		$nct_teus_20 = $nct_teus_20+$nct_row->TOT_20;
							// 		$nct_teus_40 = $nct_teus_40+$nct_row->TOT_40*2;
							// 	}
								
							
							// 	$nctUsed = $nct_teus_20 + $nct_teus_40; 		
							// }

							echo $nctUsed;
							
						?>
						</td>

						<td align="center">
						<?php
							// if($nctTotal>$nctUsed){
							// 	$nctUsedPercentage = ($nctUsed/$nctTotal)*100;
							// 	echo round($nctUsedPercentage,2)."%";}else{
							// 	$nctUsedPercentage = ($nctTotal/$nctUsed)*100;
							// 	echo round($nctUsedPercentage,2)."%";}
							
							
							
							
							 $nctUsedPercentage = ($nctUsed/$nctTotal)*100;
							// //$nctUsedPercentage = ($nctTotal/$nctUsed)*100;
							 echo round($nctUsedPercentage,2)."%";
						?>
						</td>

						<td align="center">
						<?php
							echo $nctFree = ($nctTotal - $nctUsed);
						?>
						</td>

						<td align="center">
						<?php
                        //    if($nctTotal>$nctFree){
						// 	$nctFreePercentage = ($nctFree/$nctTotal)*100;
						// 	echo round($nctFreePercentage,2)."%";}else{
						// 	$nctFreePercentage = ($nctTotal/$nctFree)*100;
						// 	echo round($nctFreePercentage,2)."%";}




							  $nctFreePercentage = ($nctFree/$nctTotal)*100;
							// //$nctFreePercentage = ($nctTotal/$nctFree)*100;
							 echo round($nctFreePercentage,2)."%";
						?>
						 </td>
						<td align="center">
							<?php echo $nctBox; ?>
						</td>
						<!-- <td align="center">
						<?php 
                        //   if($nctTotal>$nctBox){
						// 	$nctUsedPercentage = ($nctBox/$nctTotal)*100;
						// 	echo round($nctUsedPercentage,2)."%";}else{
						// 	$nctFreePercentage = ($nctTotal/$nctBox)*100;
						// 	echo round($nctFreePercentage,2)."%";}

							 $nctUsedPercentage = ($nctBox/$nctTotal)*100;
							 echo round($nctUsedPercentage,2)."%"; 
						?>
						</td> -->
						<!-- <td align="center">
							<?php  echo $nctFreeBox = ($nctTotal - $nctBox); ?>
						</td> -->
						<!-- <td align="center">
							<?php  

                        //   if($nctTotal>$nctFreeBox){
	                    //     $nctFreePercentage = ($nctFreeBox/$nctTotal)*100;
	                    //     echo round($nctFreePercentage,2)."%"; }else{
	                    //     $nctFreePercentage = ($nctTotal/$nctFreeBox)*100;
	                    //     echo round($nctFreePercentage,2)."%";} 

							
							 $nctFreePercentage = ($nctFreeBox/$nctTotal)*100;
							 echo round($nctFreePercentage,2)."%";  
							?>
						</td> -->
					 
					
					
					</tr>
					<tr>
						<td align="center">GCB</td>

						<td align="center">
						<?php

							// echo $gcbTotal = 16920;
							echo $gcbTotal= 22266;

						?>
						</td>

						<td align="center">
						<?php
						
							

							// $gcbQuery = "SELECT tbl2.*  FROM(
							// 	SELECT
							// 	tbl.*,
							// 	(Case
							// 	when (siz=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_20
								
							// 	,     (Case
							// 	when (siz!=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_40
							  
								
							// 	FROM(
							// 	SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
								
							// 	(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
							// 	INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
							// 	INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
							// 	INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							// 	where inv_unit_fcy_visit.unit_gkey=inv_unit.gkey fetch first 1 rows only
							// 	) as siz,
								
							// 	NVL(last_pos_slot,'') AS last_pos_slot
							// 	FROM  inv_unit inv   
							// 	INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
							// 	WHERE fcy.transit_state='S40_YARD')  tbl) tbl2 
							// 	";

							// $gcbResult = oci_parse($con_sparcsn4_oracle,$gcbQuery);
							// oci_execute($gcbResult);

								
							// $gcb_teus_20 = 0;
							// $gcb_teus_40 = 0;
							// $gcbUsed=0; 
                            // // $p=0;
							// 	while(($gcb_row = oci_fetch_object($gcbResult))!= false){
							// 		//$p++;
							// 		$gcbUsed++;

							// 	// 	$last_pos_slot = $gcb_row->LAST_POS_SLOT;
							// 	// 	$sql1="SELECT ctmsmis.cont_yard('".$last_pos_slot."') AS Yard_No";
							// 	// 	$sqlRslt1=mysqli_query($con_sparcsn4,$sql1);
							// 	// 	$row1=mysqli_fetch_object($sqlRslt1);
							// 	// 	$yard_no=$row1->Yard_No;
							// 	// 	if($yard_no=='GCB'){
							// 	// 		$nct_teus_20 = $nct_teus_20+$gcb_row->TOT_20;
							// 	// 		$nct_teus_40 = $nct_teus_40+$gcb_row->TOT_40*2;
							// 	// 	}

							

							// 	// $gcbUsed = $gcb_teus_20 + $gcb_teus_40; 
							// }

							// //echo $p; 
							 echo  $gcbUsed;
						?>
						</td>

						<td align="center">
						<?php
                        //    if($gcbTotal>$gcbUsed){
						// 	$gcbUsedPercentage = ($gcbUsed/$gcbTotal)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}else{
						// 	$gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}
						




							 $gcbUsedPercentage = ($gcbUsed/$gcbTotal)*100;
							// $gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
							 echo round($gcbUsedPercentage,2)."%";
						?>
						</td>

						<td align="center">
						<?php
							echo $gcbFree = ($gcbTotal - $gcbUsed);
						?>
						</td>

						<td align="center">
						<?php
                        //  if($gcbTotal>$gcbFree){
						// 	$gcbFreePercentage = ($gcbFree/$gcbTotal)*100;
						// 	echo round($gcbFreePercentage,2)."%";}else{
						// 	$gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
						// 	echo round($gcbFreePercentage,2)."%";}






							 $gcbFreePercentage = ($gcbFree/$gcbTotal)*100;
							// $gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
							 echo round($gcbFreePercentage,2)."%";
						?>
						</td>
						 <td align="center">
							<?php echo $gcbBox; ?>
						</td>
						<!-- <td align="center">
							<?php 
							// if($gcbTotal>$gcbBox){
							// 	$gcbUsedPercentage = ($gcbBox/$gcbTotal)*100;
							// 	echo round($gcbUsedPercentage,2)."%";}else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";}
							
							
							 $gcbUsedPercentage = ($gcbBox/$gcbTotal)*100;
							 echo round($gcbUsedPercentage,2)."%"; 
							?>
						</td> -->
						<!-- <td align="center">
							<?php  echo $gcbFreeBox = ($gcbTotal - $gcbBox); ?>
						</td> -->
						<!-- <td align="center">
							<?php  
							
							// if($gcbTotal>$gcbFreeBox){
							// 	$gcbFreePercentage = ($gcbFreeBox/$gcbTotal)*100;
							// 	echo round($gcbFreePercentage,2)."%"; }else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbFreeBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";} 
	




							 $gcbFreePercentage = ($gcbFreeBox/$gcbTotal)*100;
							 echo round($gcbFreePercentage,2)."%";  
							
							?>
						</td> -->


					</tr>
				
						<?php


						?>
						</td>

						<td align="center">
						<?php
						
				
							
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>

						<td align="center">
						<?php
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>
					</tr>
					<tr>
						<td align="center">OFY</td>

						<td align="center">
						<?php

							
							echo $ofyTotal = 6000;

						?>
						</td>

						<td align="center">
						<?php
						
							

							// $gcbQuery = "SELECT tbl2.*  FROM(
							// 	SELECT
							// 	tbl.*,
							// 	(Case
							// 	when (siz=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_20
								
							// 	,     (Case
							// 	when (siz!=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_40
							  
								
							// 	FROM(
							// 	SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
								
							// 	(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
							// 	INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
							// 	INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
							// 	INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							// 	where inv_unit_fcy_visit.unit_gkey=inv_unit.gkey fetch first 1 rows only
							// 	) as siz,
								
							// 	NVL(last_pos_slot,'') AS last_pos_slot
							// 	FROM  inv_unit inv   
							// 	INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
							// 	WHERE fcy.transit_state='S40_YARD')  tbl) tbl2 
							// 	";

							// $gcbResult = oci_parse($con_sparcsn4_oracle,$gcbQuery);
							// oci_execute($gcbResult);

								
							// $gcb_teus_20 = 0;
							// $gcb_teus_40 = 0;
							// $gcbUsed=0; 
                            // // $p=0;
							// 	while(($gcb_row = oci_fetch_object($gcbResult))!= false){
							// 		//$p++;
							// 		$gcbUsed++;

							// 	// 	$last_pos_slot = $gcb_row->LAST_POS_SLOT;
							// 	// 	$sql1="SELECT ctmsmis.cont_yard('".$last_pos_slot."') AS Yard_No";
							// 	// 	$sqlRslt1=mysqli_query($con_sparcsn4,$sql1);
							// 	// 	$row1=mysqli_fetch_object($sqlRslt1);
							// 	// 	$yard_no=$row1->Yard_No;
							// 	// 	if($yard_no=='GCB'){
							// 	// 		$nct_teus_20 = $nct_teus_20+$gcb_row->TOT_20;
							// 	// 		$nct_teus_40 = $nct_teus_40+$gcb_row->TOT_40*2;
							// 	// 	}

							

							// 	// $gcbUsed = $gcb_teus_20 + $gcb_teus_40; 
							// }

							// //echo $p; 
							 echo  $ofyUsed;
						?>
						</td>

						<td align="center">
						<?php
                        //    if($gcbTotal>$gcbUsed){
						// 	$gcbUsedPercentage = ($gcbUsed/$gcbTotal)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}else{
						// 	$gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}
						




							 $ofyUsedPercentage = ($ofyUsed/$ofyTotal)*100;
							// $gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
							 echo round($ofyUsedPercentage,2)."%";
						?>
						</td>

						<td align="center">
						<?php
							echo $ofyFree = ($ofyTotal - $ofyUsed);
						?>
						</td>

						<td align="center">
						<?php
                        //  if($gcbTotal>$gcbFree){
						// 	$gcbFreePercentage = ($gcbFree/$gcbTotal)*100;
						// 	echo round($gcbFreePercentage,2)."%";}else{
						// 	$gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
						// 	echo round($gcbFreePercentage,2)."%";}






							 $ofyFreePercentage = ($ofyFree/$ofyTotal)*100;
							// $gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
							 echo round($ofyFreePercentage,2)."%";
						?>
						</td>
						 <td align="center">
							<?php echo $ofyBox; ?>
						</td>
						<!-- <td align="center">
							<?php 
							// if($gcbTotal>$gcbBox){
							// 	$gcbUsedPercentage = ($gcbBox/$gcbTotal)*100;
							// 	echo round($gcbUsedPercentage,2)."%";}else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";}
							
							
							 $ofyUsedPercentage = ($ofyBox/$ofyTotal)*100;
							 echo round($ofyUsedPercentage,2)."%"; 
							?>
						</td> -->
						<!-- <td align="center">
							<?php  echo $ofyFreeBox =($ofyTotal - $ofyBox); ?>
						</td> -->
						<!-- <td align="center">
							<?php  
							
							// if($gcbTotal>$gcbFreeBox){
							// 	$gcbFreePercentage = ($gcbFreeBox/$gcbTotal)*100;
							// 	echo round($gcbFreePercentage,2)."%"; }else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbFreeBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";} 
	




							 $ofyFreePercentage = ($ofyFreeBox/$ofyTotal)*100;
							 echo round($ofyFreePercentage,2)."%";  
							
							?>
						</td> -->


					</tr>
				
						<?php


						?>
						</td>

						<td align="center">
						<?php
						
				
							
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>

						<td align="center">
						<?php
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>
					</tr>

					 <tr>
						<td align="center">SCY</td>

						<td align="center">
						<?php

							
							echo $scyTotal = 3000;

						?>
						</td>

						<td align="center">
						<?php
						
							

							// $gcbQuery = "SELECT tbl2.*  FROM(
							// 	SELECT
							// 	tbl.*,
							// 	(Case
							// 	when (siz=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_20
								
							// 	,     (Case
							// 	when (siz!=20) then 1
							// 	else
							// 	0
							// 	end) AS tot_40
							  
								
							// 	FROM(
							// 	SELECT inv.id,inv.gkey AS unit_gkey,fcy.transit_state,
								
							// 	(select substr(ref_equip_type.nominal_length,-2) from ref_equip_type 
							// 	INNER JOIN ref_equipment ON ref_equipment.eqtyp_gkey=ref_equip_type.gkey
							// 	INNER JOIN inv_unit ON inv_unit.eq_gkey=ref_equipment.gkey
							// 	INNER JOIN inv_unit_fcy_visit ON inv_unit_fcy_visit.unit_gkey=inv_unit.gkey
							// 	where inv_unit_fcy_visit.unit_gkey=inv_unit.gkey fetch first 1 rows only
							// 	) as siz,
								
							// 	NVL(last_pos_slot,'') AS last_pos_slot
							// 	FROM  inv_unit inv   
							// 	INNER JOIN inv_unit_fcy_visit fcy ON fcy.unit_gkey = inv.gkey
							// 	WHERE fcy.transit_state='S40_YARD')  tbl) tbl2 
							// 	";

							// $gcbResult = oci_parse($con_sparcsn4_oracle,$gcbQuery);
							// oci_execute($gcbResult);

								
							// $gcb_teus_20 = 0;
							// $gcb_teus_40 = 0;
							// $gcbUsed=0; 
                            // // $p=0;
							// 	while(($gcb_row = oci_fetch_object($gcbResult))!= false){
							// 		//$p++;
							// 		$gcbUsed++;

							// 	// 	$last_pos_slot = $gcb_row->LAST_POS_SLOT;
							// 	// 	$sql1="SELECT ctmsmis.cont_yard('".$last_pos_slot."') AS Yard_No";
							// 	// 	$sqlRslt1=mysqli_query($con_sparcsn4,$sql1);
							// 	// 	$row1=mysqli_fetch_object($sqlRslt1);
							// 	// 	$yard_no=$row1->Yard_No;
							// 	// 	if($yard_no=='GCB'){
							// 	// 		$nct_teus_20 = $nct_teus_20+$gcb_row->TOT_20;
							// 	// 		$nct_teus_40 = $nct_teus_40+$gcb_row->TOT_40*2;
							// 	// 	}

							

							// 	// $gcbUsed = $gcb_teus_20 + $gcb_teus_40; 
							// }

							// //echo $p; 
							 echo  $scyUsed;
						?>
						</td>

						<td align="center">
						<?php
                        //    if($gcbTotal>$gcbUsed){
						// 	$gcbUsedPercentage = ($gcbUsed/$gcbTotal)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}else{
						// 	$gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
						// 	echo round($gcbUsedPercentage,2)."%";}
						




							 $scyUsedPercentage = ($scyUsed/$scyTotal)*100;
							// $gcbUsedPercentage = ($gcbTotal/$gcbUsed)*100;
							 echo round($scyUsedPercentage,2)."%";
						?>
						</td>

						<td align="center">
						<?php
							echo $scyFree = ($scyTotal - $scyUsed);
						?>
						</td>

						<td align="center">
						<?php
                        //  if($gcbTotal>$gcbFree){
						// 	$gcbFreePercentage = ($gcbFree/$gcbTotal)*100;
						// 	echo round($gcbFreePercentage,2)."%";}else{
						// 	$gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
						// 	echo round($gcbFreePercentage,2)."%";}






							 $scyFreePercentage = ($scyFree/$scyTotal)*100;
							// $gcbFreePercentage = ($gcbTotal/$gcbFree)*100;
							 echo round($scyFreePercentage,2)."%";
						?>
						</td>
						 <td align="center">
							<?php echo $scyBox; ?>
						</td>
						<!-- <td align="center">
							<?php 
							// if($gcbTotal>$gcbBox){
							// 	$gcbUsedPercentage = ($gcbBox/$gcbTotal)*100;
							// 	echo round($gcbUsedPercentage,2)."%";}else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";}
							
							
							 $scyUsedPercentage = ($scyBox/$scyTotal)*100;
							 echo round($scyUsedPercentage,2)."%"; 
							?>
						</td> -->
						<!-- <td align="center">
							<?php  echo $scyFreeBox =($scyTotal - $scyBox); ?>
						</td> -->
						<!-- <td align="center">
							<?php  
							
							// if($gcbTotal>$gcbFreeBox){
							// 	$gcbFreePercentage = ($gcbFreeBox/$gcbTotal)*100;
							// 	echo round($gcbFreePercentage,2)."%"; }else{
							// 	$gcbFreePercentage = ($gcbTotal/$gcbFreeBox)*100;
							// 	echo round($gcbFreePercentage,2)."%";} 
	




							 $scyFreePercentage = ($scyFreeBox/$scyTotal)*100;
							 echo round($scyFreePercentage,2)."%";  
							
							?>
						</td> -->


					 </tr>
				
						<?php


						?>
						</td>

						<td align="center">
						<?php
						
				
							
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>

						<td align="center">
						<?php
						?>
						</td>

						<td align="center">
						<?php
						
						?>
						</td>
					</tr>  
							
					<tr>
						<th align="center">Grand Total</th>
						<th align="center"><?php echo $total =$scyTotal+$ofyTotal+ $gcbTotal + $cctTotal + $nctTotal; ?></th>
						<th align="center"><?php echo $used = $scyUsed+$ofyUsed+ $gcbUsed + $cctUsed + $nctUsed; ?></th>
						<th align="center">
						<?php
						// if($total>$used){
						//    $usedPercentage = ($used/$total)*100;
						//    echo round($usedPercentage,2)."%";}else{
						//    $usedPercentage = ($total/$used)*100;
						//    echo round($usedPercentage,2)."%";}
						$usedPercentage = ($used/$total)*100;
						echo round($usedPercentage,2)."%";

						?>
						</th>
						<th align="center"><?php echo $free =($total - $used); ?></th>
						<th align="center">
						<?php
						// if($total>$free){
						// 	$freePercentage = ($free/$total)*100;
						// 	echo round($freePercentage,2)."%";}else{
						// 	$freePercentage = ($total/$free)*100;
						// 	echo round($freePercentage,2)."%";}
						$freePercentage = ($free/$total)*100;
						echo round($freePercentage,2)."%";
						?>
						</th>
						 <th align="center"><?php echo $usedBox = $gcbBox + $cctBox + $nctBox+$ofyBox+$scyBox ;?></th>
						<!-- <th align="center">
						<?php 
						// if($total>$usedBox){
						//    $usedPercentage = ($usedBox/$total)*100;
						//    echo round($usedPercentage,2)."%";}else{
						//    $usedPercentage = ($total/$usedBox)*100;
						//    echo round($usedPercentage,2)."%";}
						$usedPercentage = ($usedBox/$total)*100;
						echo round($usedPercentage,2)."%";
						?>
						</th> -->
						<!-- <th align="center"><?php echo $freeBox =($total - $usedBox);?></th> -->
						<!-- <th align="center">
						<?php 
						// if($total>$freeBox){
                        //     $freePercentage = ($freeBox/$total)*100;
						// 	echo round($freePercentage,2)."%";}else{
                        //     $freePercentage = ($total/$freeBox)*100;
						// 	echo round($freePercentage,2)."%";}
						$freePercentage = ($freeBox/$total)*100;
						echo round($freePercentage,2)."%";

							?>
						</th>			 -->
					</tr>
					</table>
			</div>
			
			<div>
				<div id="cctchart" class="chart"></div>
				<div id="nctchart" class="chart"></div>
				<div id="gcbchart" class="chart"></div>
				<div id="ofychart" class="chart"></div>
				<div id="scychart" class="chart"></div>
			</div>

			<div style="clear:both;"></div>

			<div id="total" align="center"></div>


			<script type="text/javascript" src="loader.js"></script>

			<script type="text/javascript">
			// Load google charts for CCT
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawCCTChart);

			// Draw the chart and set the chart values
			function drawCCTChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'CCT Occupancy Chart'],
			  ['USED TUES',<?php echo $cctUsed;?>],
			  ['FREE TUES',<?php echo $cctFree;?>],
			  ['USED BOX', <?php echo $cctBox;?>]
			//   ['FREE BOX' , <?php echo $cctFreeBox;?>]

			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'CCT Occupancy Chart', 'width':440, 'height':300};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('cctchart'));
			  chart.draw(data, options);
			}

			// Load google charts for NCT
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawNCTChart);

			// Draw the chart and set the chart values
			function drawNCTChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'NCT Occupancy Chart'],
			  ['USED TUES', <?php echo $nctUsed;?>],
			  ['FREE TUES', <?php echo $nctFree;?>],
			  ['USED BOX',  <?php echo $nctBox;?>]
			//   ['FREE BOX',  <?php echo $nctFreeBox;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'NCT Occupancy Chart', 'width':440, 'height':300};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('nctchart'));
			  chart.draw(data, options);
			}    

			// Load google charts for GCB
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawGCBChart);

			// Draw the chart and set the chart values
			function drawGCBChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'GCB Occupancy Chart'],
			  ['USED TUES', <?php echo $gcbUsed;?>],
			  ['FREE TUES', <?php if($gcbFree<0){ echo 0;}else{ echo $gcbFree; };?>],
			  ['USED BOX',  <?php echo $gcbBox;?>]
			//   ['FREE BOX',  <?php echo $gcbFreeBox;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'GCB Occupancy Chart', 'width':440, 'height':300};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('gcbchart'));
			  chart.draw(data, options);
			}
			// Load google charts for OFY
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawOFYChart);

			// Draw the chart and set the chart values
			function drawOFYChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'OFY Occupancy Chart'],
			  ['USED TUES', <?php echo $ofyUsed;?>],
			  ['FREE TUES', <?php if($ofyFree<0){ echo 0;}else{ echo $ofyFree; };?>],
			  ['USED BOX',  <?php echo $ofyBox;?>]
			//   ['FREE BOX',  <?php echo $ofyFreeBox;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'OFY Occupancy Chart', 'width':440, 'height':300};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('ofychart'));
			  chart.draw(data, options);
			}

         // Load google charts for SCY
            google.charts.load('current', {'packages':['corechart']});
		 	google.charts.setOnLoadCallback(drawSCYChart);

			// Draw the chart and set the chart values
		 	function drawSCYChart() {
			  var data = google.visualization.arrayToDataTable([
		 	  ['Task', 'SCY Occupancy Chart'],
		 	  ['USED TUES', <?php echo $scyUsed;?>],
		 	  ['FREE TUES', <?php if($scyFree<0){ echo 0;}else{ echo $scyFree; };?>],
		 	  ['USED BOX',  <?php echo $scyBox;?>]
		 	//   ['FREE BOX',  <?php echo $scyFreeBox;?>]
		 	]);

		 	  // Optional; add a title and set the width and height of the chart
		 	  var options = {'title':'SCY Occupancy Chart', 'width':440, 'height':300};

		 	  // Display the chart inside the <div> element with id="piechart"
	    	  var chart = new google.visualization.PieChart(document.getElementById('scychart'));
			  chart.draw(data, options);
		 	}
		

			// Load google charts for TOTAL
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawTotalChart);

			// Draw the chart and set the chart values
			function drawTotalChart() {
			  var data = google.visualization.arrayToDataTable([
			  ['Task', 'Total Port Occupancy Chart'],
			  ['USED TUES', <?php echo $used;?>],
			  ['FREE TUES', <?php echo $free;?>],
			  ['USED BOX', <?php echo $usedBox;?>]
			//   ['FREE BOX', <?php echo $freeBox;?>]
			]);

			  // Optional; add a title and set the width and height of the chart
			  var options = {'title':'Total Port Occupancy Chart', 'width':550, 'height':400};

			  // Display the chart inside the <div> element with id="piechart"
			  var chart = new google.visualization.PieChart(document.getElementById('total'));
			  chart.draw(data, options);
			}
			</script>

		</div>
		<?php 
			//mysql_close($con_sparcsn4); 
			//oci_close($con_sparcsn4_oracle);

			include('footer.php'); 
		?>

	</body>
</html>