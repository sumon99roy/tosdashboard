<html>
	<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			
			.navbar {
			  overflow: hidden;
			  background-color: #8889e0;
			  font-family: "Arial Black", Gadget, sans-serif;
			  text-align: center;
			}

			.navbar a {
			  display: inline-block;
			  float:left;
			  font-size: 16px;
			  color: white;
			  text-align: center;
			  padding: 14px 16px;
			  text-decoration: none;
			}

			.dropdown {
			  display: inline-block;
			  margin-left: auto;
			  margin-right: auto;
			  overflow: hidden;
			}

			.dropdown .dropbtn {
			  font-size: 16px;  
			  border: none;
			  outline: none;
			  color: white;
			  padding: 14px 16px;
			  background-color: inherit;
			  font-family: inherit;
			  margin: 0;
			}

			.navbar a:hover, .dropdown:hover .dropbtn {
			  background-color: #333;
			}

			.dropdown-content {
			  display: none;
			  position: absolute;
			  background-color: #8889e0;
			  min-width: 160px;
			  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			  z-index: 1;
			}

			.dropdown-content a {
			  float: none;
			  color: black;
			  padding: 12px 16px;
			  text-decoration: none;
			  display: block;
			  text-align: left;
			}

			.dropdown-content a:hover {
			  background-color: #98AFC7;
			}

			.dropdown:hover .dropdown-content {
			  display: block;
			}
		</style>
		<title>TOS Dashboard</title>
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
					<font size="5"><b>CHITTAGONG PORT AUTHORITY</b></font><br><font size="4"><b>TERMINAL OPERATING SYSTEM(TOS)<br>DASHBOARD</b></font>
				</td>
				</tr>
				</table>
			</div>
			<div class="navbar">
				<div class="dropdown">
					<a href="index.php">Home</a>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Performance Report
				  <i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="24HoursperformanceReport.php">Performance Comparison</a>
						<a href="yardWiseEquipPerformance.php">Handling Performance</a>
						<a href="sailed_vessel.php">Sailed Vessel</a>
						<a href="vesselReport.php">Vessel Handling Performance Report</a>
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Operational Report
					  <i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<!--a href="gateOperation.php">Gate Operation</a-->
						<a href="all_gate_in_out_report.php">All Gate In & Out Report</a>
						<!--a href="mis_ocr_info.php">Automated Gate Out Control</a-->
						<a href="vesselAtBerth.php">Vessel Operation (Container)</a>
						<a href="vesselAtBerth_BreakBulk.php">Vessel Operation (Others)</a>
						<!--a href="prevVesselAtBerth.php">Previous Vessel Operation</a-->	
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Occupancy
					  <i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
					  <a href="berthOccupance.php">Berth Occupancy</a>
					  <a href="last24_hour_position.php">24 Hour Lying</a>
					  <!--a href="activeLyingICD.php">Active Lying ICD</a-->
					  <!--a href="activeLyingContainerList.php">Active Lying Container List</a-->
					  <a href="day_wise_lying_container.php">Day Wise Lying Container</a>
					  <a href="yardOccupance.php">Yard Occupancy With Graph </a>  
					  <a href="yardOccupanceGraph.php">Yard Occupancy Without Graph </a> 
					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Equipment (Container)
					  <i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
					  <a href="mis_equipment_current_status.php">Equipment Position</a>
					  <a href="mis_equipment_graph.php">Equipment Graph</a>
					  <a href="mis_equipment_booking_op.php">Equipment Booking Operator(GCB)</a>
					  <a href="mis_equipment_booking_nct_cct_op.php">Equipment Booking Operator(NCT & CCT)</a>

					</div>
				</div>
				<div class="dropdown">
					<button class="dropbtn">Equipment (Cargo)
					  <i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
					  <a href="mis_equipment_current_status_cargo.php">Equipment Position</a>
					  <a href="equipment_positon_for_cargo_handling_graph.php">Equipment Graph</a>
					  <a href="mis_equipment_booking_op_cargo.php">Equipment Booking Operator</a>
					 
					</div>
				</div>
			</div>
			<!--div align="center">
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
			</div-->
		</div>
	</body>
</html>