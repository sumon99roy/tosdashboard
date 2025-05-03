<html>
	<head>
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
				<?php include("dbOracleConnection.php");?>

				<?php
					$strDt = "";
					$endDt = "";
					if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					{ 
						$strDt=$_POST['strDt'];
                        $endDt=$_POST['endDt'];
					}
				?>
				<table>
					
					<tr style="margin:5px;">
						<form action="" method="POST">
                            <td align="center" colspan="7"><font size="5">
                                <input type="text" style="width:150px;" id="strDt" name="strDt" value="<?php echo date("Y-m-d"); ?>"/>
                                <script>
                                        $(function() {
                                            $( "#strDt" ).datepicker({
                                                changeMonth: true,
                                                changeYear: true,
                                                dateFormat: 'yy-mm-dd', // iso format
                                            });
                                        });
                                </script>

                                <input type="text" style="width:150px;" id="endDt" name="endDt" value="<?php echo date("Y-m-d"); ?>"/>
                                <script>
                                        $(function() {
                                            $( "#endDt" ).datepicker({
                                                changeMonth: true,
                                                changeYear: true,
                                                dateFormat: 'yy-mm-dd', // iso format
                                            });
                                        });
                                </script>
                                <button type="submit">Search</button>
                            </td>
						</form>
					</tr>
					
				</table>

				<br>
				
				<?php
					if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					{
				?>
				<!-- <div class="row"> -->
					<table border="1px" align="center" cellspacing="0" cellpadding="3">
						<caption><b><font size="5">Vessel Handling Performance Report from <?php echo $strDt; ?> to <?php echo $endDt; ?></font></b></caption>
						<thead>
							<tr>
								<th>SL</th>
								<th>Vessel name</th>
								<th>Rotation</th>
								<th>Arrival @ O. A.</th>
								<th>P. O. B. @ O. A.</th>
								<th>Waiting @ O. A.</th>
								<th>ATA @ berth</th>



								
								<th>Way time to berth</th>
								<th>P. left from Berth</th>
								
								<th>Start work</th>
								<th>Waitng to start work</th>
								<th>Total days to start work from O. A.</th>
								<!-- <td></td> -->
							</tr>
						</thead>

						<tbody>
							<?php 
								
								
								/* $vslInfo= "SELECT to_char(vsl_vessel_visit_details.off_port_arr,'yyyy-mm-dd HH24:MI:SS') as outer_anchorage_dt,vsl_vessel_visit_details.vvd_gkey,to_char (argo_carrier_visit.ata,'yyyy-mm-dd HH24:MI:SS') as ata, to_char (argo_carrier_visit.ata,'yyyy-mm-dd HH24:MI:SS') as atd ,vsl_vessel_visit_details.ib_vyg,argo_carrier_visit.cvcvd_gkey,argo_visit_details.gkey,vsl_vessel_visit_details.pilot_on_board,vsl_vessel_visit_details.pilot_off_board,to_char(vsl_vessel_visit_details.start_work,'yyyy-mm-dd HH24:MI:SS') as start_work,vsl_vessels.name
								FROM vsl_vessel_visit_details
								INNER JOIN argo_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
								INNER JOIN argo_carrier_visit ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
								INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
								WHERE to_char(argo_carrier_visit.ata,'YYYY-MM-DD HH24-MI-SS')  BETWEEN '$strDt' and '$endDt'"; */		

								 $vslInfo= "SELECT 
								TO_CHAR(vsl_vessel_visit_details.off_port_arr, 'yyyy-mm-dd HH24:MI:SS') AS outer_anchorage_dt,
								vsl_vessel_visit_details.vvd_gkey,
								TO_CHAR(argo_carrier_visit.ata, 'yyyy-mm-dd HH24:MI:SS') AS ata,
								TO_CHAR(argo_carrier_visit.atd, 'yyyy-mm-dd HH24:MI:SS') AS atd,
								vsl_vessel_visit_details.ib_vyg, 
								argo_carrier_visit.cvcvd_gkey,
								argo_visit_details.gkey, 
								TO_CHAR(vsl_vessel_visit_details.FLEX_DATE01, 'yyyy-mm-dd HH24:MI:SS') AS pilot_on_board,
								TO_CHAR(vsl_vessel_visit_details.FLEX_DATE02, 'yyyy-mm-dd HH24:MI:SS') as pilot_off_board, 
								TO_CHAR(vsl_vessel_visit_details.start_work, 'yyyy-mm-dd HH24:MI:SS') AS start_work, 
								vsl_vessels.name,
								-- Difference as days, hours, minutes, and seconds in a single column
								CASE 
									WHEN vsl_vessel_visit_details.off_port_arr IS NULL THEN ''
									ELSE
										TRIM(
											EXTRACT(DAY FROM (vsl_vessel_visit_details.FLEX_DATE01 - vsl_vessel_visit_details.off_port_arr)) || ' days, ' ||
											EXTRACT(HOUR FROM (vsl_vessel_visit_details.FLEX_DATE01 - vsl_vessel_visit_details.off_port_arr)) || ' hours, ' ||
											EXTRACT(MINUTE FROM (vsl_vessel_visit_details.FLEX_DATE01 - vsl_vessel_visit_details.off_port_arr)) || ' minutes, ' ||
											EXTRACT(SECOND FROM (vsl_vessel_visit_details.FLEX_DATE01 - vsl_vessel_visit_details.off_port_arr)) || ' seconds'
										)
								END AS WA_OA
							FROM 
								vsl_vessel_visit_details 
							INNER JOIN 
								argo_visit_details 
								ON vsl_vessel_visit_details.vvd_gkey = argo_visit_details.gkey 
							INNER JOIN 
								argo_carrier_visit 
								ON argo_visit_details.gkey = argo_carrier_visit.cvcvd_gkey 
							INNER JOIN 
								vsl_vessels 
								ON vsl_vessels.gkey = vsl_vessel_visit_details.vessel_gkey 
							WHERE 
								argo_carrier_visit.ata BETWEEN TO_DATE('$strDt', 'YYYY-MM-DD') AND TO_DATE('$endDt', 'YYYY-MM-DD')";

								$resvsl = oci_parse($con_sparcsn4_oracle, $vslInfo);
								oci_execute($resvsl);

								$i=0;
								$tot_ok=0;
								$tot_fault=0;
								$tot_cont=0;
								while(($row = oci_fetch_object($resvsl))!= false)
								{
									$i++;
									$vvd_gkey = $row->VVD_GKEY;
									$query = "SELECT created FROM srv_event WHERE applied_to_gkey='$vvd_gkey' AND event_type_gkey=91 LIMIT 1";
									$resquery=mysqli_query($con_sparcsn4,$query);
									
									$data = mysqli_fetch_object($resquery)
								?>
									<tr>
										<td><b><?php echo $i;?></b></td>
										<td><?php echo $row->NAME; ?></td>
										<td><?php echo $row->IB_VYG; ?></td>
										<td><?php echo $row->OUTER_ANCHORAGE_DT; ?></td>
										<td><?php echo $row->PILOT_ON_BOARD; ?></td>
										<td><?php echo $row->WA_OA; ?></td>
										<!--td>
											<?php 
												/* if(!is_null($row->OUTER_ANCHORAGE_DT) && !is_null($row->PILOT_ON_BOARD)){
													$date1 = date_create($row->OUTER_ANCHORAGE_DT);
													$date2 = date_create($row->PILOT_ON_BOARD);
													$days = date_diff($date1,$date2);
													// var_dump($days); 
													echo $days->d." days ".$days->h." hours ".$days->i." minutes ".$days->s." seconds ";
												} */
											?>
										</td-->
										<td><?php echo $row->ATA; ?></td>
										<td>
											<?php 
												if(!is_null($row->PILOT_ON_BOARD) && !is_null($row->ATA)){
													$date1 = date_create($row->PILOT_ON_BOARD);
													$date2 = date_create($row->ATA);
													$days = date_diff($date1,$date2);
													//var_dump($days); 
													echo $days->d." days ".$days->h." hours ".$days->i." minutes ".$days->s." seconds ";
												}
											?>
										</td>
										<td>
											<?php 
												echo $row->PILOT_OFF_BOARD; 
											?>
									
										</td>
									
										<td><?php echo $row->START_WORK; ?></td>
										<td>
											<?php
												if(!is_null($row->PILOT_OFF_BOARD) && !is_null($row->START_WORK)){
													$date1 = date_create($row->PILOT_OFF_BOARD);
													$date2 = date_create($row->START_WORK);
													$days = date_diff($date1,$date2);
													//var_dump($days); 
													echo $days->d." days ".$days->h." hours ".$days->i." minutes ".$days->s." seconds ";
												}
											?>
										</td>
										<td>
											<?php 
												if(!is_null($row->OUTER_ANCHORAGE_DT) && !is_null($row->START_WORK)){
													$date1 = date_create($row->OUTER_ANCHORAGE_DT);
													$date2 = date_create($row->START_WORK);
													$days = date_diff($date1,$date2);
													//echo "---".$days; 
													//var_dump($days); 
													if($date1 !="" && $date2 !="" && $days!=""
													
													
													){
														echo $days->d." days ".$days->h." hours ".$days->i." minutes ".$days->s." seconds ";

													}
												}
											?>
										</td>
									</tr>
								<?php
									
								}
								?>
						</tbody>
				<!-- </div> -->

				<?php
					}
				?>

			</div>
		</div>
    </body>
	
	<?php mysqli_close($con_sparcsn4); ?>
	<?php oci_close($con_sparcsn4_oracle); ?>
		<?php //include('footer.php'); ?>

</html>