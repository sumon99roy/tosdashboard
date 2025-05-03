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
					$toDate=date('Y-m-d');
                    
                    $nextToDate = date('Y-m-d', strtotime(' +1 day', strtotime($toDate)));

                    $period = new DatePeriod(
                        new DateTime($getDate),
                        new DateInterval('P1D'),
                        new DateTime($nextToDate)
                   );
				?>

				<form action="mis_equipment_booking_op_pre_nct_cct_PDF.php" method="POST" target="_blank">
					<table>					
						<br/>
						<tr style="margin:5px;">
							<td align="center" colspan="7">
								From Date: 
								<input type="text" style="width:150px;" id="strDt" name="fromDate" autocomplete="off" value="<?php echo date("Y-m-d");?>"/>
								<script>
										$(function() {
											$( "#strDt" ).datepicker({
												changeMonth: true,
												changeYear: true,
												dateFormat: 'yy-mm-dd', // iso format
											});
										});
								</script>

								To Date: 
								<input type="text" style="width:150px;" id="endDt" name="toDate" autocomplete="off" value="<?php echo date("Y-m-d");?>"/>
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
						</tr>
					</table>
				</form>
		
        <?php
            foreach ($period as $key => $value) {
                $date = $value->format('Y-m-d');
        ?>
        <table width="90%" border ='0' cellpadding='0' cellspacing='0'>	
			<caption><font size="5"><b>Daily Equipment Booking operator(CCT & NCT) for the Date of <?php echo $date; ?></b></font></caption>
		<tr>

		<td align="center" valign="top">
		<table width="350px" border ='1' cellpadding='0' cellspacing='0'  valign="top">	
	
				
			<tr align="center" bgcolor="#D8D0CE">
				<td colspan="3"><font size=4><b>Shift Day</b></font></td>		
			</tr>
			<tr align="center" bgcolor="#D8D0CE">
				<td><b>Equip No.</b></td>
				<td><b>Operator Name</b></td>
				<td><b>Yard</b></td>		
			</tr>
			<?php
	

		  $strQueryShiftA = "SELECT eguip_no, op_name, yard FROM ctmsmis.mis_equipment_op_booking_pos where DATE='$date' and shift='Day' AND (terminal IN ('CCT','NCT') OR terminal IS NULL)";
		

		$queryShiftA=mysqli_query($con_sparcsn4,$strQueryShiftA);
			
		$i=0;
		while($rowShiftA = mysqli_fetch_object($queryShiftA))
		{
		$i++;												
		?>
		<tr align="center">
			<td><?php if($rowShiftA->eguip_no) echo $rowShiftA->eguip_no; else echo "&nbsp;";?></td>
			<td><?php if($rowShiftA->op_name) echo $rowShiftA->op_name; else echo "&nbsp;";?></td>	
			<td><?php if($rowShiftA->yard) echo $rowShiftA->yard; else echo "&nbsp;";?></td>

		</tr>
		<?php } ?> 
   </table>
</td>   




    <td align="center"  valign="top">   
		<table width="450px" border ='1' cellpadding='0' cellspacing='0'  valign="top">	
				<tr align="center" bgcolor="#D8D0CE">
						<td colspan="3"><font size=4><b>Shift Night</b></font></td>		
					</tr>
					<tr align="center" bgcolor="#D8D0CE">
						<td><b>Equip No.</b></td>
						<td><b>Operator Name</b></td>
						<td><b>Yard</b></td>		
					</tr>

					<?php

				$strQueryShiftB = "select eguip_no, op_name, yard FROM ctmsmis.mis_equipment_op_booking_pos where DATE='$date' and shift='Night' AND (terminal IN ('CCT','NCT') OR terminal IS NULL)";
				
				$queryShiftB=mysqli_query($con_sparcsn4,$strQueryShiftB);
				
				$i=0;

				while($rowShiftB = mysqli_fetch_object($queryShiftB))
				{
				$i++;												
				?>
				<tr align="center">
					<td><?php if($rowShiftB->eguip_no) echo $rowShiftB->eguip_no; else echo "&nbsp;";?></td>
					<td><?php if($rowShiftB->op_name) echo $rowShiftB->op_name; else echo "&nbsp;";?></td>	
					<td><?php if($rowShiftB->yard) echo $rowShiftB->yard; else echo "&nbsp;";?></td>
				</tr>
				<?php } ?> 
		</table>
   
    </td>
   
 


   </tr>
   </table>
	
   <br/>
   
   <?php
    }
   ?>

</html>