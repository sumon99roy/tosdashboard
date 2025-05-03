<html>
	<head>
		<style>
			.button {
				background-color:    #8889e0; /* Green */
				border: none;
				color: white;
				padding: 10px 0px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 14px;
				font-family: "Arial Black", Gadget, sans-serif;
				border-radius: 20px;
				width:100%;
			}
			body{font-family: "Calibri";}
		</style>
		<title>CTMS Dashboard</title>
		<link rel="shortcut icon" type="image/x-icon" href="cpa_logo.png" />
	</head>
	<body>
		<?php date_default_timezone_set('Asia/Dhaka');?>
		<div>
			<div align="center" style="padding-right:8%;">
				<table>
				<tr>
				<td>
					<img src="cpa_logo.png" height="75">
				</td>
				<td align="center">
					<font size="5"><b>CHITTAGONG PORT AUTHORITY</b></font><br><font size="4"><b>CONTAINER TERMINAL MANAGEMENT SYSTEM(CTMS)<br>DASHBOARD</b></font>
				</td>
				</tr>
				</table>
			</div>
			<!--div align="center">
				<h1>CTMS Operation</h1>
			</div-->
			<div align="center">
				<div style="width:45%;float:left">
					<div style="width:66%;float:left">
						<div style="width:30%;float:left">
							<a href="index.php" class="button">Home</a>
						</div>
						<div style="width:30%;float:left">
							<a href="gateOperation.php" class="button">Gate Operation</a>
						</div>
						<div style="width:40%;float:left">
							<a href="vesselAtBerth.php" class="button">Vessel Operation</a>
						</div>
					</div>
					<div style="width:34%;float:right">
						<a href="yardWiseEquipPerformance.php" class="button">Handling Performance</a>
					</div>
				</div>
				<div style="width:55%;float:right">
					<div style="width:50%;float:left">
						<div style="width:50%;float:left">
							<a href="berthOccupance.php" class="button">Berth Occupancy</a>
						</div>
						<div style="width:50%;float:right">
							<a href="last24_hour_position.php" class="button">24 Hour Lying</a>
						</div>
					</div>
					<div style="width:50%;float:left">
						<div style="width:40%;float:right">
							<a href="mis_equipment_current_status_cargo.php" class="button">Equip Position(Cargo)</a>
						</div>
						<div style="width:30%;float:right">
							<a href="mis_equipment_current_status.php" class="button">Equip Position</a>
						</div>
						<div style="width:30%;float:left">
							<a href="mis_equipment_graph.php" class="button">Equip Graph</a>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</body>
</html>