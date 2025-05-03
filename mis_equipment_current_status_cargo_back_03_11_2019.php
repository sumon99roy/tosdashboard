<html>
	<head>
		 <meta http-equiv="refresh" content="20">
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
				<body>
  <table width="100%" cellpadding="0">
   <tr height="100px">
    <td align="center" valign="middle">
     <!--h1>Chittagong Port Authority</h1-->
     <h2>Statement of Booked Cargo Handling Equipment Position &nbsp;&nbsp; <?php echo " Date: ". date("d/m/Y");?></h2>
    </td>
   </tr>

   <!--tr>
    <td align="left" valign="middle">
     <h3><?php echo $stat;?></h3>
    </td>
   </tr-->
   <tr>
    <td>
     <table border="1" align="center" cellspacing="1" cellpadding="1" width="80%">
      <tr>
       <th>Sl. No.</th>     
       <th>Type of Equipment</th>       
       <th>Demand & Supply</th>       
       <th>TM(CCT/NCT+GCB)</th>
       <th>DTM (Heavy Lift)</th>       
       <th>Total</th>
      </tr>
	 <?php
	include("dbConection.php");
	$str = "SELECT equip_type,typ,tmd,dtmd,tot
		FROM
		(
		SELECT tbl.equip_type,
		(CASE 
			WHEN tbl.equip_type LIKE 'Crane 50%' THEN 1
			WHEN tbl.equip_type LIKE 'Crane 30%' THEN 2
			WHEN tbl.equip_type LIKE 'Crane 20%' THEN 3
			WHEN tbl.equip_type LIKE 'Crane 10%' THEN 4
			WHEN tbl.equip_type LIKE 'FLT 20%' THEN 5
			WHEN tbl.equip_type LIKE 'FLT 10%' THEN 6
			WHEN tbl.equip_type LIKE 'FLT 05%' THEN 7
			WHEN tbl.equip_type LIKE 'FLT 03%' THEN 8
			WHEN tbl.equip_type LIKE 'FLT 1.5%' THEN 9
			WHEN tbl.equip_type LIKE 'RRC%' THEN 10
			WHEN tbl.equip_type LIKE 'Tractor%' THEN 11
			WHEN tbl.equip_type LIKE 'Heavy%' THEN 12
			WHEN tbl.equip_type LIKE 'Light%' THEN 13
			WHEN tbl.equip_type LIKE 'Car%' THEN 14
			ELSE 15
		END
		) AS sl,
		'Demand' AS typ,
		(SELECT demand FROM ctmsmis.equip_for_cargo_handling WHERE office='TM' AND equip_type=tbl.equip_type AND DATE(update_time)= DATE(NOW())) AS tmd,
		(SELECT demand FROM ctmsmis.equip_for_cargo_handling WHERE office='DTM' AND equip_type=tbl.equip_type AND DATE(update_time)= DATE(NOW())) AS dtmd,
		(SELECT tmd+dtmd) AS tot
		FROM(
		SELECT DISTINCT equip_type FROM ctmsmis.equip_for_cargo_handling
		) AS tbl
		UNION ALL
		SELECT tbl.equip_type,
		(CASE 
			WHEN tbl.equip_type LIKE 'Crane 50%' THEN 1
			WHEN tbl.equip_type LIKE 'Crane 30%' THEN 2
			WHEN tbl.equip_type LIKE 'Crane 20%' THEN 3
			WHEN tbl.equip_type LIKE 'Crane 10%' THEN 4
			WHEN tbl.equip_type LIKE 'FLT 20%' THEN 5
			WHEN tbl.equip_type LIKE 'FLT 10%' THEN 6
			WHEN tbl.equip_type LIKE 'FLT 05%' THEN 7
			WHEN tbl.equip_type LIKE 'FLT 03%' THEN 8
			WHEN tbl.equip_type LIKE 'FLT 1.5%' THEN 9
			WHEN tbl.equip_type LIKE 'RRC%' THEN 10
			WHEN tbl.equip_type LIKE 'Tractor%' THEN 11
			WHEN tbl.equip_type LIKE 'Heavy%' THEN 12
			WHEN tbl.equip_type LIKE 'Light%' THEN 13
			WHEN tbl.equip_type LIKE 'Car%' THEN 14
			ELSE 15
		END
		) AS sl,
		'Supply' AS typ,
		(SELECT supply FROM ctmsmis.equip_for_cargo_handling WHERE office='TM' AND equip_type=tbl.equip_type AND DATE(update_time)= DATE(NOW())) AS tmd,
		(SELECT supply FROM ctmsmis.equip_for_cargo_handling WHERE office='DTM' AND equip_type=tbl.equip_type AND DATE(update_time)= DATE(NOW())) AS dtmd,
		(SELECT tmd+dtmd) AS tot
		FROM(
		SELECT DISTINCT equip_type FROM ctmsmis.equip_for_cargo_handling
		) AS tbl
		) AS final ORDER BY sl,typ";
	$query=mysql_query($str);					

	//echo $positon;
	$i=0;
	$j=0;	
	//$transit_state="";
	$equip_type = "";
	while($row=mysql_fetch_object($query)){
		if($equip_type!=$row->equip_type)
			$i++;
?>
<tr align="center">	
		<?php if($equip_type!=$row->equip_type){ ?>
		<td rowspan="2"><?php echo $i?></td>
		<td rowspan="2"><?php if($row->equip_type) echo $row->equip_type; else echo "&nbsp;";?></td>
		<?php } ?>
		<td><?php if($row->typ) echo $row->typ; else echo "&nbsp;";?></td>
		<td><?php if($row->tmd) echo $row->tmd; else echo "&nbsp;";?></td>
		<td><?php if($row->dtmd) echo $row->dtmd; else echo "&nbsp;";?></td>
		<td><?php if($row->tot) echo $row->tot; else echo "&nbsp;";?></td>

</tr>
	<?php 
		$equip_type=$row->equip_type;
	} ?>
     </table>
    </td>
   </tr>
  </table>
  </br>
  </br>
  <table border="1" align="center" cellspacing="1" cellpadding="1" width="80%">
	  <tr>
		<td colspan="7" align="center"><h2>Total Cargo Handling Equipment Position </h2></td>
	  </tr>	  
	  <tr>
		<th rowspan="2">SL. No. </th>
		<th rowspan="2">Type of Equipment</th>
		<th rowspan="2">Total Equipment</th>
		<th colspan="2">Total Operational</th>
		<th rowspan="2">Out Of Order</th>
	  </tr>
	  <tr>
		<th>Supplied</th>
		<th>Stand By</th>
	  </tr>
	  <?php
	  $str2 = "SELECT IFNULL(equip_type,'Total=') AS equip_type,total,supply,stand_by,out_of_order
				FROM (
				SELECT equip_type,
				(CASE 
					WHEN equip_type LIKE 'Crane 50%' THEN 1
					WHEN equip_type LIKE 'Crane 30%' THEN 2
					WHEN equip_type LIKE 'Crane 20%' THEN 3
					WHEN equip_type LIKE 'Crane 10%' THEN 4
					WHEN equip_type LIKE 'FLT 20%' THEN 5
					WHEN equip_type LIKE 'FLT 10%' THEN 6
					WHEN equip_type LIKE 'FLT 05%' THEN 7
					WHEN equip_type LIKE 'FLT 03%' THEN 8
					WHEN equip_type LIKE 'FLT 1.5%' THEN 9
					WHEN equip_type LIKE 'RRC%' THEN 10
					WHEN equip_type LIKE 'Tractor%' THEN 11
					WHEN equip_type LIKE 'Heavy%' THEN 12
					WHEN equip_type LIKE 'Light%' THEN 13
					WHEN equip_type LIKE 'Car%' THEN 14
					ELSE 15
				END
				) AS sl,
				(SELECT SUM(supply)+SUM(stand_by)+SUM(out_of_order)) AS total,
				SUM(supply) AS supply,SUM(stand_by) AS stand_by, SUM(out_of_order) AS out_of_order
				FROM ctmsmis.equip_for_cargo_handling where update_time=date(now()) GROUP BY equip_type WITH ROLLUP
				) AS tbl ORDER BY sl ";
	$query2=mysql_query($str2);					

	//echo $positon;
	$k=0;

	//$transit_state="";
	
	while($row2=mysql_fetch_object($query2)){
			$k++;
?>
<tr align="center">	
		<?php if($row2->equip_type!="Total="){ ?>
		<td><?php echo $k?></td>
		<td><?php if($row2->equip_type) echo $row2->equip_type; else echo "&nbsp;";?></td>
		<?php } else { ?>
		<td colspan="2" align="right"><b><?php if($row2->equip_type) echo $row2->equip_type; else echo "&nbsp;";?>&nbsp;&nbsp;</b></td>
		<?php } ?>
		<td><?php if($row2->total) echo $row2->total; else echo "&nbsp;";?></td>
		<td><?php if($row2->supply) echo $row2->supply; else echo "&nbsp;";?></td>
		<td><?php if($row2->stand_by) echo $row2->stand_by; else echo "&nbsp;";?></td>
		<td><?php if($row2->out_of_order) echo $row2->out_of_order; else echo "&nbsp;";?></td>

</tr>
	<?php 
	} ?>
  </table>
 </body>
				

			</div>
		</div>
		<?php mysql_close($con_sparcsn4); ?>
				<?php include('footer.php'); ?>

	</body>
</html>