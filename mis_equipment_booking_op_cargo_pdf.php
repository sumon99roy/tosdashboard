<?php
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    $nextToDate = date('Y-m-d', strtotime(' +1 day', strtotime($toDate)));

    $period = new DatePeriod(
        new DateTime($fromDate),
        new DateInterval('P1D'),
        new DateTime($nextToDate)
    );
?>

<?php include("dbConection42.php");?>
<?php
	$i = 0;
	foreach ($period as $key => $value){
		$date = $value->format('Y-m-d');
		if($i>0){
	?>
		<pagebreak>
	<?php
		}
	?>
        <table width="100%" border ='0' cellpadding='0' cellspacing='0'>	
			<caption><font size="6"><b>Daily Equipment Booking operator for the Date of <?php echo $date; ?></b></font></caption>
		<tr>
		<td align="right" valign="top">
		<table width="33%" border ='1' cellpadding='3' cellspacing='0'  valign="top" style="border-collapse: collapse;">	
	
				
			<tr align="center" bgcolor="#D8D0CE">
				<td colspan="4"><font size=4><b>Day Shift</b></font></td>		
			</tr>
			<tr align="center" bgcolor="#D8D0CE">
				<td><b>Equip No.</b></td>
				<td><b>Operator Name</b></td>
				<td><b>Terminal</b></td>
				<td><b>Yard</b></td>		
			</tr>
			<?php
		$strQueryShiftA = "SELECT eguip_no, op_name,terminal, yard FROM cchaportdb.cargo_equipment_op_booking_pos where DATE='$date' and shift='Day' AND (terminal IN ('GCB','CCT','NCT') OR terminal IS NULL)";
       //  $strQueryShiftA = "SELECT eguip_no, op_name,terminal, yard FROM cchaportdb.cargo_equipment_op_booking_pos where DATE='$date' and shift='Day' AND (terminal IN ('GCB','CCT','NCT') OR terminal IS NULL)";
	

		$queryShiftA=mysqli_query($con_cchaportdb,$strQueryShiftA);		
		$i=0;
		while($rowShiftA = mysqli_fetch_object($queryShiftA))
		{
		$i++;												
		?>
		<tr align="center">
			<td><?php if($rowShiftA->eguip_no) echo $rowShiftA->eguip_no; else echo "&nbsp;";?></td>
			<td><?php if($rowShiftA->op_name) echo $rowShiftA->op_name; else echo "&nbsp;";?></td>	
			<td><?php if($rowShiftA->terminal) echo $rowShiftA->terminal; else echo "&nbsp;";?></td>	
			<td><?php if($rowShiftA->yard) echo $rowShiftA->yard; else echo "&nbsp;";?></td>
		</tr>
		<?php } ?> 
   </table>
</td>   
<td align="center"  valign="top">   
   <table width="34%" border ='1' cellpadding='3' cellspacing='0'  valign="top" style="border-collapse: collapse;">	
		<tr align="center" bgcolor="#D8D0CE">
				<td colspan="4"><font size=4><b>Night Shift</b></font></td>		
			</tr>
			<tr align="center" bgcolor="#D8D0CE">
				<td><b>Equip No.</b></td>
				<td><b>Operator Name</b></td>
				<td><b>Terminal</b></td>
				<td><b>Yard</b></td>		
			</tr>

			<?php

			$strQueryShiftB = "select eguip_no, op_name, terminal, yard FROM cchaportdb.cargo_equipment_op_booking_pos where DATE='$date' and shift='Night' AND (terminal IN ('GCB','CCT','NCT') OR terminal IS NULL)";
		 //$strQueryShiftB = "select eguip_no, op_name, terminal, yard FROM cchaportdb.cargo_equipment_op_booking_pos where DATE='$date' and shift='Night' AND (terminal IN ('GCB','CCT','NCT') OR terminal IS NULL)";
	
		$queryShiftB=mysqli_query($con_cchaportdb,$strQueryShiftB);
		$i=0;

		while($rowShiftB = mysqli_fetch_object($queryShiftB))
		{
		$i++;												
		?>
		<tr align="center">
			<td><?php if($rowShiftB->eguip_no) echo $rowShiftB->eguip_no; else echo "&nbsp;";?></td>
			<td><?php if($rowShiftB->op_name) echo $rowShiftB->op_name; else echo "&nbsp;";?></td>	
			<td><?php if($rowShiftB->terminal) echo $rowShiftB->terminal; else echo "&nbsp;";?></td>	
			<td><?php if($rowShiftB->yard) echo $rowShiftB->yard; else echo "&nbsp;";?></td>
		</tr>
		<?php } ?> 
   </table>
   
   </td>
   
   </table>
   <!-- <pagebreak> -->
   
   <?php
   		$i++;
    }
   ?>