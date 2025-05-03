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
				
				<?php
					$getDate=date('Y-m-d');
					$getGate="CPAR";
					if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					{ 
						$getDate=$_POST['strDt'];
						$getGate=$_POST['selected_gate'];
						
						if($getDate=="")
						{
							$getDate=date('Y-m-d');
						}
						if($getGate=="")
						{
							$getGate="CPAR";
						}
					}
				?>
				<table>
					
					<tr style="margin:5px;">
						<form action="" method="POST">
						<td align="center" colspan="7"><font size="5">
							<select name="selected_gate">
							  <option value="">-- SELECT GATE --</option>
							  <option value="CPAR">CPAR</option>
							</select>
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
							<button type="submit">Search</button>
						</td>
						</form>
					</tr>
					<tr>
						<td colspan="7" align="center"><font size="5"><b>Manless Gate Control</b></font>
						</td>
					</tr>
					<tr>
						<td colspan="7" align="center"><font size="5"><b> Gate Name : <?php echo $getGate; ?>  Date : <?php echo $getDate; ?></b></font>
						</td>
					</tr>
					
				</table>
				<br>
				<div class="row">
					<table width="30%" height="30%" border="1px" align="center" cellspacing="0" cellpadding="0">
						<tbody>
							<?php 
								$ocrInfo= "SELECT * FROM ctmsmis.mis_ocr_info
								WHERE entry_dt='$getDate' and cont_number is not null and cont_number !=''
								order by entry_dt_time desc";
								$resOcr=mysqli_query($con_sparcsn4,$ocrInfo);
								$i=0;
								$tot_ok=0;
								$tot_fault=0;
								$tot_cont=0;
								while($rowOcr=mysqli_fetch_object($resOcr))
								{
								$i++;
								if($rowOcr->legal_delivery_st=="1")
								{
									$tot_ok=$tot_ok+1;
								}
								else
								{
									$tot_fault=$tot_fault+1;
								}
								} 
								$tot_cont=$tot_ok+$tot_fault;
								?>
								<tr>
									<td align="center"><?php echo "<font size='5'>Total Container : <b>"." <a href='mis_ocr_container_list.php?strdt=$getDate&strgate=$getGate&strstat=all' target='_blank'>".$tot_cont."</a></b></font>"; ?></td>
								</tr>
								<tr>
									<td align="center"><?php echo "<font size='5'>Total Success Container : <a href='mis_ocr_container_list.php?strdt=$getDate&strgate=$getGate&strstat=ok' target='_blank' ><b>".$tot_ok."</a></b></font>"; ?></td>
								</tr>
								<tr>
									<td align="center"><?php echo "<font size='5'>Total Faulty Container : <a href='mis_ocr_container_list.php?strdt=$getDate&strgate=$getGate&strstat=fault' target='_blank'><b>".$tot_fault."</a></b></font>"; ?></td>
								</tr>
						</tbody>
				</div>
				</div>
			</div>
		</div>
		
	</body>
	
	<?php mysqli_close($con_sparcsn4); ?>
			<?php include('footer.php'); ?>

</html>