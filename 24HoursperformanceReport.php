<html>
	<head>
		 <meta http-equiv="refresh" content="60">
		 <style>
			body{font-family: "Calibri";}
		 </style>
		 <script src="Chart.min.js"></script>
		 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
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
						<td colspan="7"><font size="5"><b>Last 24Hour's Performance Comparison at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
					</tr>
					<tr style="margin:5px;">
						<?php 
							$fileQuery="SELECT DISTINCT manual_file_path,ctms_file_path FROM ctmsmis.performance_file_upload WHERE DATE=DATE(NOW())";
							//echo $fileQuery;
							$rowFile=mysqli_query($con_sparcsn4,$fileQuery);

							$nonctms_path = "";
							$ctms_path = "";

							while($rtnQuery=mysqli_fetch_object($rowFile))
							{
								$nonctms_path = 'http://cpatos.gov.bd/resources/manual_files/'.$rtnQuery->manual_file_path;
								$ctms_path = 'http://cpatos.gov.bd/resources/ctms_files/'.$rtnQuery->ctms_file_path;
							}
						?>
						<td colspan="7" align="center"><font size="4"><b>
							<a href="<?php echo $nonctms_path;?>" target="blank">NON CTMS REPORT</a></b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="4"><b>
							<a href="<?php echo $ctms_path;?>" target="blank">CTMS REPORT</a></b></font>
						</td>
					</tr>
				</table>
				<table id="myTbl" align="center" width="80%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">		
					<tr>
					  <th rowspan="2">SL</th>
					  <th rowspan="2">VESSEL</th>
					  <th rowspan="2">ROTATION</th>
					  <th rowspan="2">BERTH</th>
					  <th rowspan="2">AGENT</th>
					  <th colspan="3">DISCHARGE</th>
					  <th rowspan="2">DISCHARGE CHART</th>
					  <th colspan="3">LOADING</th>
					  <th rowspan="2">LOADING CHART</th>					  
					</tr>
					<tr>
						<th>ACTUAL</th>
						<th>CTMS</th>					 
						<th>MISMATCH(%)</th>					 
						<th>ACTUAL</th>
						<th>CTMS</th>
						<th>MISMATCH(%)</th>
						
					</tr>
					<?php 
					
					$perfomanceQuery="SELECT rotation,vessel_name,berth,agent,discharge_actual,discharge_ctms,loading_actual,loading_ctms,ata_dt 
					FROM ctmsmis.handlingperformancecompare WHERE ata_dt=DATE(NOW())";
					$rowQry=mysqli_query($con_sparcsn4,$perfomanceQuery);
					$dataPoints = array();
					$i=0;
					while($rtnQuery=mysqli_fetch_object($rowQry))
					{
						$i++;
						$arr = array("label"=> $rtnQuery->discharge_actual, "y"=> $rtnQuery->discharge_ctms);
						array_push($dataPoints, $arr);
					?>
					<tr align="center">	
						
						<td><?php echo $i;  ?></td>
						<td><?php echo $rtnQuery->vessel_name;  ?></td>
						<td><?php echo $rtnQuery->rotation;  ?></td>
						<td><?php echo $rtnQuery->berth;  ?></td>
						<td><?php echo $rtnQuery->agent;  ?></td>
						<td><?php echo $rtnQuery->discharge_actual;  ?></td>
						<td><?php echo $rtnQuery->discharge_ctms;  ?></td>
						<td>
							<?php $dis_val=$rtnQuery->discharge_actual-$rtnQuery->discharge_ctms; if($dis_val>0) echo round(($dis_val/$rtnQuery->discharge_actual)*100,2); 
																												 else echo round((-$dis_val/$rtnQuery->discharge_ctms)*100,2); ?>
						</td>
						<td>
						</td>
						<td><?php echo $rtnQuery->loading_actual;  ?></td>
						<td><?php echo $rtnQuery->loading_ctms;  ?></td>
						<td><?php $load_val=$rtnQuery->loading_actual-$rtnQuery->loading_ctms; if($load_val>0) echo round(($load_val/$rtnQuery->loading_actual)*100,2); 
																												else echo round((-$load_val/$rtnQuery->loading_ctms)*100,2);  ?></td>
						<td></td>
						
					</tr>
					
					<?php } ?>
					</table>
					
				<script>
						var table = document.getElementById('myTbl');
						var tableArr = [];
						var tableArr1 = [];
						var tableLab = [];
						var tableLab1 = [];
						//loop all rows and form data array
						
						for ( var i = 2; i < table.rows.length; i++ ) 
						{
						//console.log(i);
						tableArr.push([
						
						 table.rows[i].cells[5].innerHTML,
						 table.rows[i].cells[6].innerHTML,
						 table.rows[i].cells[7].innerHTML
						]);
						
						tableArr1.push([
						
						 table.rows[i].cells[9].innerHTML,
						 table.rows[i].cells[10].innerHTML,
						 table.rows[i].cells[11].innerHTML
						]);
							
						tableLab.push(table.rows[i].cells[0].innerHTML);
						tableLab1.push(table.rows[i].cells[0].innerHTML);
						
						var canvas = document.createElement("canvas");
						var canvas1 = document.createElement("canvas");
						
						canvas.setAttribute("id", "myChart"+i);
						table.rows[i].cells[8].appendChild(canvas);
						
						canvas1.setAttribute("id", "my2Chart"+i);
						table.rows[i].cells[12].appendChild(canvas1);
						}
						//console.log(tableArr);
						//console.log(tableArr1);

						//loop array of data and create chart for each row
						tableArr.forEach(function(e,i){
						  var chartID = "myChart"+ (i+2);
						  var ctx = document.getElementById(chartID).getContext('2d');
						  var myChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ["ACTUAL","CTMS","MIS(%)"],
								datasets: [{
									label: "DISCHARGE",
									data: e,
									backgroundColor: [
										'#FFC300',
										'#68EC0D',
										'#F9350D'
									],
									borderColor: [
										'#F9910D',
										'#0DF94A',
										'#FA1502'
									],
									borderWidth: 1
								}]
							},
							options: {
								maintainAspectRatio: false,
								legend: {
									display: false
								},
								tooltips: {
									callbacks: {
									   label: function(tooltipItem) {
											  return tooltipItem.yLabel;
									   }
									}
								},
								scales: {
									xAxes: [{
									   ticks: {
											fontColor:"black",
									   }
									  }],
									yAxes: [{
										ticks: {
											beginAtZero:true,
											fontColor:"black",
										}
									}]
								}
							}
						});
						});
						
						//2nd loop array of data and create chart for each row
						tableArr1.forEach(function(e,i){
						  var chartID = "my2Chart"+ (i+2);
						  var ctx = document.getElementById(chartID).getContext('2d');
						  var myChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ["ACTUAL","CTMS","MIS(%)"],
								datasets: [{
									label: "LOADING",
									data: e,
									backgroundColor: [
										'#FFC300',
										'#68EC0D',
										'#F9350D'
									],
									borderColor: [
										'#F9910D',
										'#0DF94A',
										'#FA1502'
									],
									borderWidth: 1
								}]
							},
							options: {
								maintainAspectRatio: false,
								legend: {
									display: false
								},
								tooltips: {
									callbacks: {
									   label: function(tooltipItem) {
											  return tooltipItem.yLabel;
									   }
									}
								},
								scales: {
									 xAxes: [{
									   ticks: {
											fontColor:"black",
									   }
									  }],
									yAxes: [{
										ticks: {
											beginAtZero:true,
											fontColor:"black",
										}
									}]
								}
							}
						});
						});
					
						
					</script>
				
				
			</div>
		</div>
		<?php mysqli_close($con_sparcsn4); ?>
		<?php include('footer.php'); ?>
	</body>
</html>