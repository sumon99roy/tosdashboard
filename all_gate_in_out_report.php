<html>

<head>
	<script type="text/javascript" src="jquery-1.6.0.min.js"></script>
	<script type="text/javascript" src="calender.jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/calender.jquery-ui.css">
</head>

<body>
	<div>
		<div align="center">
			<?php include("header.php") ?>
		</div>
		<div align="center">
			<?php include("dbConection.php"); ?>
			<?php include("dbOracleConnection.php"); ?>

			<script>
				function validateForm() {
					var fromDate = document.getElementById("fdate").value;
					var toDate = document.getElementById("tdate").value;

					if (fromDate === "" || toDate === "") {
						alert("From Date and To Date are required!");
						return false;
					}

					// You can add more complex validation logic if needed

					return true;
				}
			</script>

			<table>

				<tr style="margin:5px;">
					<form action="" method="POST" onsubmit="return validateForm()">
						<td align="center" colspan="6">
							<font size="4">
								From Date

								<input type="date" class="form-control" id="fdate" name="fdate">
						</td>
						</br>
						<td align="center" colspan="6">
							<font size="4">
								To Date

								<input type="date" class="form-control" id="tdate" name="tdate">
						</td>

				</tr>

			</table>
			</br>

			<div class="col-sm-12 text-center">
				<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">View</button>

			</div>

			</form>

			<?php
			$fdate = "";
			$tdate = "";
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$fdate = $_POST['fdate'];
				$tdate = $_POST['tdate'];
			}
			?>

			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			?>


				<table>
					<tr style="margin:5px;">
						<td colspan="12">
							<font size="5"><b>Gate In-Out Report for the month of <?php echo $fdate ?> to <?php echo $tdate; ?> in terms of Box </b></font>
							<font size="4"></font>
						</td>
					</tr>
				</table>
				<table width="100%" border='1' cellpadding='0' cellspacing='0'>
					<tr align="center" bgcolor="#D8D0CE">
						<th style="text-align: center;" rowspan="2">
							Date
						</th>
						<th style="text-align: center;" colspan="2">
							CARGO
						</th>
						<th style="text-align: center;" colspan="2">
							CCT-1
						</th>
						<th style="text-align: center;" colspan="2">
							CCT-2
						</th>
						<th style="text-align: center;" colspan="2">
							CPAR
						</th>
						<th style="text-align: center;" colspan="2">
							GATE-4
						</th>
						<th style="text-align: center;" colspan="2">
							GATE-5
						</th>

						<th style="text-align: center;" colspan="2">
							GCB-1
						</th>
						<th style="text-align: center;" colspan="2">
							GCB-2
						</th>
						<th style="text-align: center;" colspan="2">
							NCT LANE1
						</th>
					</tr>
					<tr align="center" bgcolor="#D8D0CE">
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>

						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>
						<th style="text-align: center;">In</th>
						<th style="text-align: center;">Out</th>

					</tr>

					<?php

				$strQuery = "SELECT visit_date,SUM(cargoIn) AS cargoIn,SUM(cargoOut) AS cargoOut,SUM(cct1In) AS cct1In,SUM(cct1Out) AS cct1Out,
				SUM(cct2In) AS cct2In,SUM(cct1Out) AS cct2Out,SUM(cparIn) AS cparIn,SUM(cparOut) AS cparOut,
				SUM(gate4In) AS gate4In,SUM(gate4Out) AS gate4Out,SUM(gate5In) AS gate5In,SUM(gate5Out) AS gate5Out,
				SUM(gcb1In) AS gcb1In,SUM(gcb1Out) AS gcb1Out,SUM(gcb2In) AS gcb2In,SUM(gcb2Out) AS gcb2Out,
				SUM(nctLnIn) AS nctLnIn,SUM(nctLnOut) AS nctLnOut
				FROM (
				SELECT  TO_CHAR(road_truck_visit_details.created, 'YYYY-MM-DD') AS visit_date,
				road_gates.id AS gate_id,stage_id,
				(CASE WHEN road_gates.id = 'CARGO' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS cargoIn,
				(CASE WHEN road_gates.id = 'CARGO' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS cargoOut,
				(CASE WHEN road_gates.id = 'CCT-1' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS cct1In,
				(CASE WHEN road_gates.id = 'CCT-1' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS cct1Out,
				(CASE WHEN road_gates.id = 'CCT-2' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS cct2In,
				(CASE WHEN road_gates.id = 'CCT-2' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS cct2Out,
				(CASE WHEN road_gates.id = 'CPAR' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS cparIn,
				(CASE WHEN road_gates.id = 'CPAR' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS cparOut,
				(CASE WHEN road_gates.id = 'GATE-4' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS gate4In,
				(CASE WHEN road_gates.id = 'GATE-4' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS gate4Out,
				(CASE WHEN road_gates.id = 'GATE-5' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS gate5In,
				(CASE WHEN road_gates.id = 'GATE-5' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS gate5Out,
				(CASE WHEN road_gates.id = 'GCB-1' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS gcb1In,
				(CASE WHEN road_gates.id = 'GCB-1' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS gcb1Out,
				(CASE WHEN road_gates.id = 'GCB-2' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS gcb2In,
				(CASE WHEN road_gates.id = 'GCB-2' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS gcb2Out,
				(CASE WHEN road_gates.id = 'NCT LANE1' AND stage_id='In Gate' THEN 1 ELSE 0 END) AS nctLnIn,
				(CASE WHEN road_gates.id = 'NCT LANE1' AND (stage_id='outgate' OR stage_id='Out Gate') THEN 1 ELSE 0 END) AS nctLnOut
				FROM road_truck_visit_details
				INNER JOIN 
				road_truck_transactions ON road_truck_transactions.truck_visit_gkey = road_truck_visit_details.tvdtls_gkey
				INNER JOIN 
				road_gates ON road_gates.gkey = road_truck_visit_details.gate_gkey
				WHERE 
				road_truck_visit_details.created >= to_date('$fdate 00:00:00', 'YYYY-MM-DD HH24:MI:SS')
				AND road_truck_visit_details.created < to_date('$tdate 23:59:59', 'YYYY-MM-DD HH24:MI:SS')
				)  tbl WHERE stage_id !='yard' GROUP BY visit_date ORDER BY visit_date";



					$query = oci_parse($con_sparcsn4_oracle, $strQuery);
					oci_execute($query);



					$total_cargo_in = 0;
					$total_cargo_out = 0;
					$total_cct1_in = 0;
					$total_cct1_out = 0;
					$total_cct2_in = 0;
					$total_cct2_out = 0;
					$total_cpar_in = 0;
					$total_cpar_out = 0;
					$total_gate4_in = 0;
					$total_gate4_out = 0;
					$total_gate5_in = 0;
					$total_gate5_out = 0;
					$total_gcb1_in = 0;
					$total_gcb1_out = 0;
					$total_gcb2_in = 0;
					$total_gcb2_out = 0;
					$total_nctln_in = 0;
					$total_nctln_out = 0;


					$i = 0;

					while (($row = oci_fetch_object($query)) != false) {


						$i++;

						$visit_date = $row->VISIT_DATE;
						$cargo_in = $row->CARGOIN;
						$cargo_out = $row->CARGOOUT;
						$cct1_in = $row->CCT1IN;
						$cct1_out = $row->CCT1OUT;
						$cct2_in = $row->CCT2IN;
						$cct2_out = $row->CCT2OUT;
						$cpar_in = $row->CPARIN;
						$cpar_out = $row->CPAROUT;
						$gate4_in = $row->GATE4IN;
						$gate4_out = $row->GATE4OUT;
						$gate5_in = $row->GATE5IN;
						$gate5_out = $row->GATE5OUT;
						$gcb1_in = $row->GCB1IN;
						$gcb1_out = $row->GCB1OUT;
						$gcb2_in = $row->GCB2IN;
						$gcb2_out = $row->GCB2OUT;
						$nctLn_in = $row->NCTLNIN;
						$nctLn_out = $row->NCTLNOUT;


						$total_cargo_in += $cargo_in;
						$total_cargo_out += $cargo_out;
						$total_cct1_in += $cct1_in;
						$total_cct1_out += $cct1_out;
						$total_cct2_in += $cct2_in;
						$total_cct2_out += $cct2_out;
						$total_cpar_in += $cpar_in;
						$total_cpar_out += $cpar_out;
						$total_gate4_in += $gate4_in;
						$total_gate4_out += $gate4_out;
						$total_gate5_in += $gate5_in;
						$total_gate5_out += $gate5_out;
						$total_gcb1_in += $gcb1_in;
						$total_gcb1_out += $gcb1_out;
						$total_nctln_in += $nctLn_in;
						$total_nctln_out += $nctLn_out;


						/*	
						$squery = oci_parse($con_sparcsn4_oracle, $query);
						oci_execute($squery);
						oci_fetch_object($squery);
						echo $squery;
						die();
						
						*/


					?>

						<tr>
							<td style="text-align: center;">
								<?php echo $visit_date; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $cargo_in;

								?>
							</td>
							<td style="text-align: center;">
								<?php echo $cargo_out;

								?>
							</td>
							<td style="text-align: center;">
								<?php echo $cct1_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $cct1_out; ?>

							</td>
							<td style="text-align: center;">
								<?php echo $cct2_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $cct2_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $cpar_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $cpar_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gate4_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gate4_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gate5_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gate5_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gcb1_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gcb1_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gcb2_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $gcb2_out; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $nctLn_in; ?>
							</td>
							<td style="text-align: center;">
								<?php echo $nctLn_out; ?>
							</td>

						</tr>


					<?php	} ?>

					<tr>
						<th style="text-align: center;">Total</th>
						<th style="text-align: center;"><?php echo  $total_cargo_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cargo_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cct1_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cct1_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cct2_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cct2_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cpar_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_cpar_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gate4_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gate4_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gate5_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gate5_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gcb1_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gcb1_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gcb2_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_gcb2_out ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_nctln_in ?>(Box)</th>
						<th style="text-align: center;"><?php echo  $total_nctln_out ?>(Box)</th>

					</tr>



					<tr>
						<th style="text-align: center;">Gate Wise</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cargo_in + $total_cargo_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cct1_in + $total_cct1_out ?>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cct2_in + $total_cct2_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cpar_in + $total_cpar_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_gate4_in + $total_gate4_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_gate5_in + $total_gate5_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_gcb1_in + $total_gcb1_out ?>
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_gcb2_in + $total_gcb2_out ?>

						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_nctln_in + $total_nctln_out ?>

						</th>

					</tr>
					<tr>
						<th style="text-align: center;"></th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">
							All gates:
						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>

						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>

					</tr>


					<tr>
						<th style="text-align: center;"></th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">
							In
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cargo_in + $total_cct1_in + $total_cct2_in + $total_cpar_in + $total_gate4_in + $total_gate5_in + $total_gcb1_in + $total_gcb2_in + $total_nctln_in ?>
						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>

						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">



						</th>
						<th style="text-align: center;" colspan="2">


						</th>

					</tr>
					<tr>
						<th style="text-align: center;"></th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">
							Out
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cargo_out + $total_cct1_out + $total_cct2_out + $total_cpar_out + $total_gate4_out + $total_gate5_out + $total_gcb1_out + $total_gcb2_out + $total_nctln_out ?>
						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>

						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">


						</th>

					</tr>


					<tr>
						<th style="text-align: center;"></th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">
							Grand Total
						</th>
						<th style="text-align: center;" colspan="2">
							<?php echo  $total_cargo_in + $total_cct1_in + $total_cct2_in + $total_cpar_in + $total_gate4_in + $total_gate5_in + $total_gcb1_in + $total_gcb2_in + $total_nctln_in + $total_cargo_out + $total_cct1_out + $total_cct2_out + $total_cpar_out + $total_gate4_out + $total_gate5_out + $total_gcb1_out + $total_gcb2_out + $total_nctln_out ?>
						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">

						</th>

						<th style="text-align: center;" colspan="2">

						</th>
						<th style="text-align: center;" colspan="2">



						</th>
						<th style="text-align: center;" colspan="2">


						</th>

					</tr>


				</table>

		</div>
	</div>

</body>
<?php } ?>

</html>