<html>
	<head>
		 <!--meta http-equiv="refresh" content="20"-->
		 <script src="canvasjs.min.js"></script>
			 <!--script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script-->
			 <!-- SOURAV
				* Canvas JS start month from 0 - 11 
				* So In Query 1 Month subtract
			 -->
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>			
			<div align="center">
				<?php include("dbConection.php");?>
				<?php
					$getMonth=date('m');
					$getYear=date('Y');
					$getMonthName=date("F", mktime(0, 0, 0, $getMonth, 10));
					if ($_SERVER['REQUEST_METHOD'] == 'POST') 
					{ 
						$getMonth=$_POST['selected_month'];
						$getYear=$_POST['selected_year'];
						$getMonthName=date("F", mktime(0, 0, 0, $getMonth, 10));
						//echo $getMonth.'--'.$getYear;
						//	$editFlag=1;
					}
				?>
				<table>
						<tr style="margin:5px;">
						<form  action="" method="post">
						<!--td colspan="7"><font size="5"><b>Equipment Position for Cargo Handling Graph <?php echo date("F"); ?> , <?php echo date("Y")?></b></font><font size="4"></font></td-->
						<td colspan="7" align="center"><font size="5"><b></b></font>
							<select name="selected_month">
							  <option value="">-- SELECT MONTH --</option>
							  <option value="1">JANUARY</option>
							  <option value="2">FEBRUARY</option>
							  <option value="3">MARCH</option>
							  <option value="4">APRIL</option>
							  <option value="5">MAY</option>
							  <option value="6">JUNE</option>
							  <option value="7">JULY</option>
							  <option value="8">AUGUST</option>
							  <option value="9">SEPTEMBER</option>
							  <option value="10">OCTOBER</option>
							  <option value="11">NOVEMBER</option>
							  <option value="12">DECEMBER</option>
							  
							</select>  
							<select name="selected_year">
							  <option value="">-- SELECT YEAR --</option>
							  <?php 
							  $lLimit = 2018;
							  $hLimit = date("Y");
							  for($hLimit;$hLimit>=$lLimit;$hLimit--)
							  {
							  ?>
							  <option value="<?php echo $hLimit; ?>"><?php echo $hLimit; ?></option>
							  <?php } ?>
							</select>
							<button type="submit">Search</button>
						</td>
					</tr>
					</form>
					<tr style="margin:5px;">
						<?php if($editFlag==0){ ?> <!--td colspan="7"><font size="5"><b>Equipment Position for Cargo Handling Graph <?php echo date("F"); ?> , <?php echo date("Y")?></b></font><font size="4"></font></td--> <?php } ?>
							<td colspan="7"><font size="5"><b>Equipment Position for Cargo Handling Graph <?php echo $getMonthName ?> , <?php echo $getYear; ?></b></font><font size="4"></font></td>
					</tr>

				</table>
				<?php
	/* 				$strQueryCrane50De = "SELECT IFNULL(demand,0) AS demand, graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 50 Ton') AS demand,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl"; */
					$strQueryCrane50De = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
							(
							SELECT 
							(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 50 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day, '$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

							FROM (
								SELECT CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY dt, a + b +1 AS d
								FROM
								(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
									UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
									UNION SELECT 8 UNION SELECT 9 ) d,
								(SELECT 0 b UNION SELECT 10 UNION SELECT 20
									UNION SELECT 30 UNION SELECT 40) m
								WHERE CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
									ORDER BY a + b
							) AS mytable ORDER BY dt) AS tbl";	
							
					$strQueryCrane50Sup = "SELECT IFNULL(supply,0) AS supply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 50 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day, '$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY dt, a + b +1 AS d
								FROM
								(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
									UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
									UNION SELECT 8 UNION SELECT 9 ) d,
								(SELECT 0 b UNION SELECT 10 UNION SELECT 20
									UNION SELECT 30 UNION SELECT 40) m
								WHERE CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
									ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryCrane50Out = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 50 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day, '$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY dt, a + b +1 AS d
								FROM
								(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
									UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
									UNION SELECT 8 UNION SELECT 9 ) d,
								(SELECT 0 b UNION SELECT 10 UNION SELECT 20
									UNION SELECT 30 UNION SELECT 40) m
								WHERE CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
									ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
					$strQueryCrane50Stand = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 50 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day, '$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY dt, a + b +1 AS d
								FROM
								(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
									UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
									UNION SELECT 8 UNION SELECT 9 ) d,
								(SELECT 0 b UNION SELECT 10 UNION SELECT 20
									UNION SELECT 30 UNION SELECT 40) m
								WHERE CONCAT($getYear,'-',$getMonth,'-01') + INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
									ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
											
					$queryCrane50De=mysql_query($strQueryCrane50De);
					$queryCrane50Sup=mysql_query($strQueryCrane50Sup);
					$queryCrane50Out=mysql_query($strQueryCrane50Out);
					$queryCrane50Stand=mysql_query($strQueryCrane50Stand);
					
					$numRowsCrane50De = mysql_num_rows($queryCrane50De);
					$numRowsCrane50Sup= mysql_num_rows($queryCrane50Sup);
					$numRowsCrane50Out = mysql_num_rows($queryCrane50Out);
					$numRowsCrane50Stand = mysql_num_rows($queryCrane50Stand);
					
					
					
					$strQueryCrane30De = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 30 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";					
					$strQueryCrane30Sup = "SELECT IFNULL(supply,0) AS supply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 30 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryCrane30Out = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 30 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
						
					$strQueryCrane30Stand = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 30 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
					
					
					$queryCrane30De=mysql_query($strQueryCrane30De);
					$queryCrane30Sup=mysql_query($strQueryCrane30Sup);
					$queryCrane30Out=mysql_query($strQueryCrane30Out);
					$queryCrane30Stand=mysql_query($strQueryCrane30Stand);
					
					$numRowsCrane30De = mysql_num_rows($queryCrane30De);
					$numRowsCrane30Sup= mysql_num_rows($queryCrane30Sup);
					$numRowsCrane30Out = mysql_num_rows($queryCrane30Out);
					$numRowsCrane30Stand = mysql_num_rows($queryCrane30Stand);
				
					
					$strQueryCrane20De = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 20 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";	
						
					$strQueryCrane20Sup = "SELECT IFNULL(supply,0) AS supply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 20 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryCrane20Out = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 20 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
						
					$strQueryCrane20Stand = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 20 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
										
					
					$queryCrane20De=mysql_query($strQueryCrane20De);
					$queryCrane20Sup=mysql_query($strQueryCrane20Sup);
					$queryCrane20Out=mysql_query($strQueryCrane20Out);
					$queryCrane20Stand=mysql_query($strQueryCrane20Stand);
					
					$numRowsCrane20De = mysql_num_rows($queryCrane20De);
					$numRowsCrane20Sup= mysql_num_rows($queryCrane20Sup);
					$numRowsCrane20Out = mysql_num_rows($queryCrane20Out);
					$numRowsCrane20Stand = mysql_num_rows($queryCrane20Stand);
				
					$strQueryCrane10De = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 10 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";	
						
					$strQueryCrane10Sup = "SELECT IFNULL(supply,0) AS supply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 10 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryCrane10Out = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 10 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
						
					$strQueryCrane10Stand = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Crane 10 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";

				
					
					$queryCrane10De=mysql_query($strQueryCrane10De);
					$queryCrane10Sup=mysql_query($strQueryCrane10Sup);
					$queryCrane10Out=mysql_query($strQueryCrane10Out);
					$queryCrane10Stand=mysql_query($strQueryCrane10Stand);
					
					$numRowsCrane10De = mysql_num_rows($queryCrane10De);
					$numRowsCrane10Sup= mysql_num_rows($queryCrane10Sup);
					$numRowsCrane10Out = mysql_num_rows($queryCrane10Out);
					$numRowsCrane10Stand = mysql_num_rows($queryCrane10Stand);
				
					//FLT 20 - start
					
					
					$strQueryFLT20 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";	
						
					$strQuerySupFLT20 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryOutFLT20 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
						
					$strQueryStandFLT20 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";

					/* $strQueryFLT20 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,					
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT20 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT20 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT20 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl"; */
					
					$queryFLT20=mysql_query($strQueryFLT20);
					$querySupFLT20=mysql_query($strQuerySupFLT20);
					$queryOutFLT20=mysql_query($strQueryOutFLT20);
					$queryStandFLT20=mysql_query($strQueryStandFLT20);
					
					$numRowsFLT20 = mysql_num_rows($queryFLT20);
					$numRowsSupFLT20 = mysql_num_rows($querySupFLT20);
					$numRowsOutFLT20 = mysql_num_rows($queryOutFLT20);
					$numRowsStandFLT20 = mysql_num_rows($queryStandFLT20);
					//FLT 20 - end
					
					//FLT 10 - start
					$strQueryFLT10 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 10 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT10 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 10 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT10 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 10 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT10 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
						(
						SELECT 
						(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 10 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

						FROM (
							SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
							FROM
							(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
								UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
								UNION SELECT 8 UNION SELECT 9 ) d,
							(SELECT 0 b UNION SELECT 10 UNION SELECT 20
								UNION SELECT 30 UNION SELECT 40) m
							WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
								ORDER BY a + b
						) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT10=mysql_query($strQueryFLT10);
					$querySupFLT10=mysql_query($strQuerySupFLT10);
					$queryOutFLT10=mysql_query($strQueryOutFLT10);
					$queryStandFLT10=mysql_query($strQueryStandFLT10);
					
					$numRowsFLT10 = mysql_num_rows($queryFLT10);
					$numRowsSupFLT10 = mysql_num_rows($querySupFLT10);
					$numRowsOutFLT10 = mysql_num_rows($queryOutFLT10);
					$numRowsStandFLT10 = mysql_num_rows($queryStandFLT10);
					//FLT 10 - end
					
					//FLT 05 - start
					$strQueryFLT05 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 05 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";		
					
					$strQuerySupFLT05 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 05 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryOutFLT05 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 05 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryStandFLT05 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 05 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT05=mysql_query($strQueryFLT05);
					$querySupFLT05=mysql_query($strQuerySupFLT05);
					$queryOutFLT05=mysql_query($strQueryOutFLT05);
					$queryStandFLT05=mysql_query($strQueryStandFLT05);
					
					$numRowsFLT05 = mysql_num_rows($queryFLT05);
					$numRowsSupFLT05 = mysql_num_rows($querySupFLT05);
					$numRowsOutFLT05 = mysql_num_rows($queryOutFLT05);
					$numRowsStandFLT05 = mysql_num_rows($queryStandFLT05);
					//FLT 05 - end

					//RRC 05 - start
					$strQueryRRC = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";	
					
					$strQuerySupRRC = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryOutRRC = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$strQueryStandRRC = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryRRC=mysql_query($strQueryRRC);
					$querySupRRC=mysql_query($strQuerySupRRC);
					$queryOutRRC=mysql_query($strQueryOutRRC);
					$queryStandRRC=mysql_query($strQueryStandRRC);
					
					$numRowsRRC = mysql_num_rows($queryRRC);
					$numRowsSupRRC = mysql_num_rows($querySupRRC);
					$numRowsOutRRC = mysql_num_rows($queryOutRRC);
					$numRowsStandRRC = mysql_num_rows($queryStandRRC);
					
					//RRC 05 - end
					
					//FLT 03- start
					$strQueryFLT03 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT03 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT03 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT03 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT03=mysql_query($strQueryFLT03);
					$querySupFLT03=mysql_query($strQuerySupFLT03);
					$queryOutFLT03=mysql_query($strQueryOutFLT03);
					$queryStandFLT03=mysql_query($strQueryStandFLT03);
					
					$numRowsFLT03 = mysql_num_rows($queryFLT03);
					$numRowsSupFLT03 = mysql_num_rows($querySupFLT03);
					$numRowsOutFLT03 = mysql_num_rows($queryOutFLT03);
					$numRowsStandFLT03 = mysql_num_rows($queryStandFLT03);
					//FLT 03- end
					
					//FLT 1.5 - start
					$strQueryFLT1p5 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT1p5 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT1p5 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT1p5 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT1p5=mysql_query($strQueryFLT1p5);
					$querySupFLT1p5=mysql_query($strQuerySupFLT1p5);
					$queryOutFLT1p5=mysql_query($strQueryOutFLT1p5);
					$queryStandFLT1p5=mysql_query($strQueryStandFLT1p5);
					
					$numRowsFLT1p5 = mysql_num_rows($queryFLT1p5);
					$numRowsSupFLT1p5 = mysql_num_rows($querySupFLT1p5);
					$numRowsOutFLT1p5 = mysql_num_rows($queryOutFLT1p5);
					$numRowsStandFLT1p5 = mysql_num_rows($queryStandFLT1p5);
					//FLT 1.5 - end
					
					//Tractor 25 - start
					 $strQueryTR25 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupTR25 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutTR25 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandTR25 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryTR25=mysql_query($strQueryTR25);
					$querySupTR25=mysql_query($strQuerySupTR25);
					$queryOutTR25=mysql_query($strQueryOutTR25);
					$queryStandTR25=mysql_query($strQueryStandTR25);
					
					$numRowsTR25 = mysql_num_rows($queryTR25);
					$numRowsSupTR25 = mysql_num_rows($querySupTR25);
					$numRowsOutTR25 = mysql_num_rows($queryOutTR25);
					$numRowsStandTR25 = mysql_num_rows($queryStandTR25); 
					//Tractor 25 - end
					
					//Heavy Trailer 25 - start
					 $strQueryHT25 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupHT25 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutHT25 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandHT25 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryHT25=mysql_query($strQueryHT25);
					$querySupHT25=mysql_query($strQuerySupHT25);
					$queryOutHT25=mysql_query($strQueryOutHT25);
					$queryStandHT25=mysql_query($strQueryStandHT25);
					
					$numRowsHT25 = mysql_num_rows($queryHT25);
					$numRowsSupHT25 = mysql_num_rows($querySupHT25);
					$numRowsOutHT25 = mysql_num_rows($queryOutHT25);
					$numRowsStandHT25 = mysql_num_rows($queryStandHT25); 
					//Heavy Trailer 25 - end
					
					//Light Trailer 06 - start
					 $strQueryLT06 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupLT06 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutLT06 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandLT06 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryLT06=mysql_query($strQueryLT06);
					$querySupLT06=mysql_query($strQuerySupLT06);
					$queryOutLT06=mysql_query($strQueryOutLT06);
					$queryStandLT06=mysql_query($strQueryStandLT06);
					
					$numRowsLT06 = mysql_num_rows($queryLT06);
					$numRowsSupLT06 = mysql_num_rows($querySupLT06);
					$numRowsOutLT06 = mysql_num_rows($queryOutLT06);
					$numRowsStandLT06 = mysql_num_rows($queryStandLT06); 
					//Light Trailer 06 - end
					
					//Car Carrier - start
					 $strQueryCC = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";		
					
					$strQuerySupCC = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutCC = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandCC = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryCC=mysql_query($strQueryCC);
					$querySupCC=mysql_query($strQuerySupCC);
					$queryOutCC=mysql_query($strQueryOutCC);
					$queryStandCC=mysql_query($strQueryStandCC);
					
					$numRowsCC = mysql_num_rows($queryCC);
					$numRowsSupCC = mysql_num_rows($querySupCC);
					$numRowsOutCC = mysql_num_rows($queryOutCC);
					$numRowsStandCC = mysql_num_rows($queryStandCC); 
					//Car Carrier - end
					
					//Tele Handler 04 - start
					 $strQueryTH04 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupTH04 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutTH04 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandTH04 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryTH04=mysql_query($strQueryTH04);
					$querySupTH04=mysql_query($strQuerySupTH04);
					$queryOutTH04=mysql_query($strQueryOutTH04);
					$queryStandTH04=mysql_query($strQueryStandTH04);
					
					$numRowsTH04 = mysql_num_rows($queryTH04);
					$numRowsSupTH04 = mysql_num_rows($querySupTH04);
					$numRowsOutTH04 = mysql_num_rows($queryOutTH04);
					$numRowsStandTH04 = mysql_num_rows($queryStandTH04); 
					//Tele Handler 04 - end
					
				//Pipe Handler  45 - start
					 $strQueryPH45 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pipe Handler 45 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupPH45 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pipe Handler 45 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutPH45 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandPH45 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pipe Handler 45 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryPH45=mysql_query($strQueryPH45);
					$querySupPH45=mysql_query($strQuerySupPH45);
					$queryOutPH45=mysql_query($strQueryOutPH45);
					$queryStandPH45=mysql_query($strQueryStandPH45);
					
					$numRowsPH45 = mysql_num_rows($queryPH45);
					$numRowsSupPH45 = mysql_num_rows($querySupPH45);
					$numRowsOutPH45 = mysql_num_rows($queryOutPH45);
					$numRowsStandPH45 = mysql_num_rows($queryStandPH45); 
					//Pipe Handler  45 - end
					
					//Automatic Weighting & Bagging Machine - start
					 $strQueryAWBM = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Automatic Weighting & Bagging Machine') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupAWBM = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Automatic Weighting & Bagging Machine') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutAWBM = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Automatic Weighting & Bagging Machine') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandAWBM = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Automatic Weighting & Bagging Machine') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryAWBM=mysql_query($strQueryAWBM);
					$querySupAWBM=mysql_query($strQuerySupAWBM);
					$queryOutAWBM=mysql_query($strQueryOutAWBM);
					$queryStandAWBM=mysql_query($strQueryStandAWBM);
					
					$numRowsAWBM = mysql_num_rows($queryAWBM);
					$numRowsSupAWBM = mysql_num_rows($querySupAWBM);
					$numRowsOutAWBM = mysql_num_rows($queryOutAWBM);
					$numRowsStandAWBM = mysql_num_rows($queryStandAWBM); 
					//Automatic Weighting & Bagging Machine - end
					
					//Pneumatic Conveyor - start
					 $strQueryPC = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pneumatic Conveyor') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupPC = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pneumatic Conveyor') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutPC = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pneumatic Conveyor') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandPC = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Pneumatic Conveyor') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryPC=mysql_query($strQueryPC);
					$querySupPC=mysql_query($strQuerySupPC);
					$queryOutPC=mysql_query($strQueryOutPC);
					$queryStandPC=mysql_query($strQueryStandPC);
					
					$numRowsPC = mysql_num_rows($queryPC);
					$numRowsSupPC = mysql_num_rows($querySupPC);
					$numRowsOutPC = mysql_num_rows($queryOutPC);
					$numRowsStandPC = mysql_num_rows($queryStandPC); 
					//Pneumatic Conveyor - end	

					//Variable Reach Stacker 16 Ton- start
					 $strQueryVRS16 = "SELECT IFNULL(demand,0) AS demand, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Variable Reach Stacker 16 Ton') AS demand,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupVRS16 = "SELECT IFNULL(supply,0) AS suply, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Variable Reach Stacker 16 Ton') AS supply,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutVRS16 = "SELECT IFNULL(out_of_order,0) AS out_of_order, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Variable Reach Stacker 16 Ton') AS out_of_order,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandVRS16 = "SELECT IFNULL(stand_by,0) AS stand_by, graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Variable Reach Stacker 16 Ton') AS stand_by,DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,'$getYear' AS graph_year, '$getMonth' AS graph_month,d AS graph_date

					FROM (
						SELECT CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY dt, a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT($getYear,'-',$getMonth,'-01')+ INTERVAL a + b DAY  <= LAST_DAY(CONCAT($getYear,'-',$getMonth,'-01'))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryVRS16=mysql_query($strQueryVRS16);
					$querySupVRS16=mysql_query($strQuerySupVRS16);
					$queryOutVRS16=mysql_query($strQueryOutVRS16);
					$queryStandVRS16=mysql_query($strQueryStandVRS16);
					
					$numRowsVRS16 = mysql_num_rows($queryVRS16);
					$numRowsSupVRS16 = mysql_num_rows($querySupVRS16);
					$numRowsOutVRS16 = mysql_num_rows($queryOutVRS16);
					$numRowsStandVRS16 = mysql_num_rows($queryStandVRS16); 
					//Variable Reach Stacker 16 Ton - end
	
					?>
				<div class="row">
					<div id="chartCrane50" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartCrane30" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartCrane20" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartCrane10" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT20" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT10" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT05" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerRRC" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT03" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT1p5" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerTR25" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerHT25" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerLT06" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerCC" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerTH04" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerPH45" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerAWBM" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerPC" style="height: 200px; width: 90%;">
					</div>
					<br>				
					<div id="chartContainerVRS16" style="height: 200px; width: 90%;">
					</div>
					<br>
				</div>
				</div>
			</div>
		</div>
		
	</body>
	<script>

	 window.onload = function () {
		 
		 
var chartCrane50 = new CanvasJS.Chart("chartCrane50", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Crane 50 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesCrane50
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane50=mysql_fetch_object($queryCrane50De))
			{
				$i++;
				$getMonth=$rowCrane50->graph_month-1;
				if($i!=$numRowsCrane50De){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowCrane50->graph_day;?>), y: <?php echo $rowCrane50->demand;?> },
			{ x: new Date(<?php echo $rowCrane50->graph_year.",".$getMonth.",".$rowCrane50->graph_date ;?>), y: <?php echo $rowCrane50->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane50->graph_year.",".$getMonth.",".$rowCrane50->graph_date ;?>), y: <?php echo $rowCrane50->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane50Sup=mysql_fetch_object($queryCrane50Sup))
			{
				$i++;
				$getMonth=$rowCrane50Sup->graph_month-1;
				if($i!=$numRowsCrane50Sup){
			?>
		//	{ x: new Date(<?php echo $rowCrane50Sup->graph_day;?>), y: <?php echo $rowCrane50Sup->supply;?> },
			{ x: new Date(<?php echo $rowCrane50Sup->graph_year.",".$getMonth.",".$rowCrane50Sup->graph_date ;?>), y: <?php echo $rowCrane50Sup->supply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane50Sup->graph_year.",".$getMonth.",".$rowCrane50Sup->graph_date ;?>), y: <?php echo $rowCrane50Sup->supply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowCrane50Stand=mysql_fetch_object($queryCrane50Stand))
			{
				$i++;
				$getMonth=$rowCrane50Stand->graph_month-1;
				if($i!=$numRowsCrane50Stand){
			?>
		//	{ x: new Date(<?php echo $rowCrane50Stand->graph_day;?>), y: <?php echo $rowCrane50Stand->stand_by;?> },
			{ x: new Date(<?php echo $rowCrane50Stand->graph_year.",".$getMonth.",".$rowCrane50Stand->graph_date ;?>), y: <?php echo $rowCrane50Stand->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane50Stand->graph_year.",".$getMonth.",".$rowCrane50Stand->graph_date ;?>), y: <?php echo $rowCrane50Stand->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane50Out=mysql_fetch_object($queryCrane50Out))
			{
				$i++;
				$getMonth=$rowCrane50Out->graph_month-1;
				if($i!=$numRowsCrane50Out){
			?>
		//	{ x: new Date(<?php echo $rowCrane50Out->graph_day;?>), y: <?php echo $rowCrane50Out->out_of_order;?> },
			{ x: new Date(<?php echo $rowCrane50Out->graph_year.",".$getMonth.",".$rowCrane50Out->graph_date ;?>), y: <?php echo $rowCrane50Out->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane50Out->graph_year.",".$getMonth.",".$rowCrane50Out->graph_date ;?>), y: <?php echo $rowCrane50Out->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartCrane50.render();	 
function toggleDataSeriesCrane50(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCrane50.render();
}

//crane 30_______________________________________________________


var chartCrane30 = new CanvasJS.Chart("chartCrane30", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Crane 30 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesCrane30
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane30=mysql_fetch_object($queryCrane30De))
			{
				$i++;
				$getMonth=$rowCrane30->graph_month-1;
				if($i!=$numRowsCrane30De){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowCrane30->graph_day;?>), y: <?php echo $rowCrane30->demand;?> },
			{ x: new Date(<?php echo $rowCrane30->graph_year.",".$getMonth.",".$rowCrane30->graph_date ;?>), y: <?php echo $rowCrane30->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane30->graph_year.",".$getMonth.",".$rowCrane30->graph_date ;?>), y: <?php echo $rowCrane30->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane30Sup=mysql_fetch_object($queryCrane30Sup))
			{
				$i++;
				$getMonth=$rowCrane30Sup->graph_month-1;
				if($i!=$numRowsCrane30Sup){
			?>
		//	{ x: new Date(<?php echo $rowCrane30Sup->graph_day;?>), y: <?php echo $rowCrane30Sup->supply;?> },
			{ x: new Date(<?php echo $rowCrane30Sup->graph_year.",".$getMonth.",".$rowCrane30Sup->graph_date ;?>), y: <?php echo $rowCrane30Sup->supply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane30Sup->graph_year.",".$getMonth.",".$rowCrane30Sup->graph_date ;?>), y: <?php echo $rowCrane30Sup->supply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowCrane30Stand=mysql_fetch_object($queryCrane30Stand))
			{
				$i++;
				$getMonth=$rowCrane30Stand->graph_month-1;
				if($i!=$numRowsCrane30Stand){
			?>
		//	{ x: new Date(<?php echo $rowCrane30Stand->graph_day;?>), y: <?php echo $rowCrane30Stand->stand_by;?> },
			{ x: new Date(<?php echo $rowCrane30Stand->graph_year.",".$getMonth.",".$rowCrane30Stand->graph_date ;?>), y: <?php echo $rowCrane30Stand->stand_by;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane30Stand->graph_year.",".$getMonth.",".$rowCrane30Stand->graph_date ;?>), y: <?php echo $rowCrane30Stand->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane30Out=mysql_fetch_object($queryCrane30Out))
			{
				$i++;
				$getMonth=$rowCrane30Out->graph_month-1;
				if($i!=$numRowsCrane30Out){
			?>
		//	{ x: new Date(<?php echo $rowCrane30Out->graph_day;?>), y: <?php echo $rowCrane30Out->out_of_order;?> },
			{ x: new Date(<?php echo $rowCrane30Out->graph_year.",".$getMonth.",".$rowCrane30Out->graph_date ;?>), y: <?php echo $rowCrane30Out->out_of_order;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane30Out->graph_year.",".$getMonth.",".$rowCrane30Out->graph_date ;?>), y: <?php echo $rowCrane30Out->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartCrane30.render();	 
function toggleDataSeriesCrane30(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCrane30.render();
}
	
	//crane 20_______________________________________________________


var chartCrane20 = new CanvasJS.Chart("chartCrane20", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Crane 20 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesCrane20
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane20=mysql_fetch_object($queryCrane20De))
			{
				$i++;
				$getMonth=$rowCrane20->graph_month-1;
				if($i!=$numRowsCrane20De){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowCrane20->graph_day;?>), y: <?php echo $rowCrane20->demand;?> },
			{ x: new Date(<?php echo $rowCrane20->graph_year.",".$getMonth.",".$rowCrane20->graph_date ;?>), y: <?php echo $rowCrane20->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane20->graph_year.",".$getMonth.",".$rowCrane20->graph_date ;?>), y: <?php echo $rowCrane20->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane20Sup=mysql_fetch_object($queryCrane20Sup))
			{
				$i++;
				$getMonth=$rowCrane20Sup->graph_month-1;
				if($i!=$numRowsCrane20Sup){
			?>
		//	{ x: new Date(<?php echo $rowCrane20Sup->graph_day;?>), y: <?php echo $rowCrane20Sup->supply;?> },
			{ x: new Date(<?php echo $rowCrane20Sup->graph_year.",".$getMonth.",".$rowCrane20Sup->graph_date ;?>), y: <?php echo $rowCrane20Sup->supply;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane20Sup->graph_year.",".$getMonth.",".$rowCrane20Sup->graph_date ;?>), y: <?php echo $rowCrane20Sup->supply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowCrane20Stand=mysql_fetch_object($queryCrane20Stand))
			{
				$i++;
				$getMonth=$rowCrane20Stand->graph_month-1;
				if($i!=$numRowsCrane20Stand){
			?>
		//	{ x: new Date(<?php echo $rowCrane20Stand->graph_day;?>), y: <?php echo $rowCrane20Stand->stand_by;?> },
			{ x: new Date(<?php echo $rowCrane20Stand->graph_year.",".$getMonth.",".$rowCrane20Stand->graph_date ;?>), y: <?php echo $rowCrane20Stand->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane20Stand->graph_year.",".$getMonth.",".$rowCrane20Stand->graph_date ;?>), y: <?php echo $rowCrane20Stand->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane20Out=mysql_fetch_object($queryCrane20Out))
			{
				$i++;
				$getMonth=$rowCrane20Out->graph_month-1;
				if($i!=$numRowsCrane20Out){
			?>
		//	{ x: new Date(<?php echo $rowCrane20Out->graph_day;?>), y: <?php echo $rowCrane20Out->out_of_order;?> },
			{ x: new Date(<?php echo $rowCrane20Out->graph_year.",".$getMonth.",".$rowCrane20Out->graph_date ;?>), y: <?php echo $rowCrane20Out->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane20Out->graph_year.",".$getMonth.",".$rowCrane20Out->graph_date ;?>), y: <?php echo $rowCrane20Out->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartCrane20.render();	 
function toggleDataSeriesCrane20(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCrane20.render();
}



var chartCrane10 = new CanvasJS.Chart("chartCrane10", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Crane 10"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesCrane10
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane10=mysql_fetch_object($queryCrane10De))
			{
				$i++;
				$getMonth=$rowCrane10->graph_month-1;
				if($i!=$numRowsCrane10De){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowCrane10->graph_day;?>), y: <?php echo $rowCrane10->demand;?> },
			{ x: new Date(<?php echo $rowCrane10->graph_year.",".$getMonth.",".$rowCrane10->graph_date ;?>), y: <?php echo $rowCrane10->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane10->graph_year.",".$getMonth.",".$rowCrane10->graph_date ;?>), y: <?php echo $rowCrane10->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane10Sup=mysql_fetch_object($queryCrane10Sup))
			{
				$i++;
				$getMonth=$rowCrane10Sup->graph_month-1;
				if($i!=$numRowsCrane10Sup){
			?>
		//	{ x: new Date(<?php echo $rowCrane10Sup->graph_day;?>), y: <?php echo $rowCrane10Sup->supply;?> },
			{ x: new Date(<?php echo $rowCrane10Sup->graph_year.",".$getMonth.",".$rowCrane10Sup->graph_date ;?>), y: <?php echo $rowCrane10Sup->supply;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane10Sup->graph_year.",".$getMonth.",".$rowCrane10Sup->graph_date ;?>), y: <?php echo $rowCrane10Sup->supply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowCrane10Stand=mysql_fetch_object($queryCrane10Stand))
			{
				$i++;
				$getMonth=$rowCrane10Stand->graph_month-1;
				if($i!=$numRowsCrane10Stand){
			?>
		//	{ x: new Date(<?php echo $rowCrane10Stand->graph_day;?>), y: <?php echo $rowCrane10Stand->stand_by;?> },
			{ x: new Date(<?php echo $rowCrane10Stand->graph_year.",".$getMonth.",".$rowCrane10Stand->graph_date ;?>), y: <?php echo $rowCrane10Stand->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane10Stand->graph_year.",".$getMonth.",".$rowCrane10Stand->graph_date ;?>), y: <?php echo $rowCrane10Stand->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCrane10Out=mysql_fetch_object($queryCrane10Out))
			{
				$i++;
				$getMonth=$rowCrane10Out->graph_month-1;
				if($i!=$numRowsCrane10Out){
			?>
		//	{ x: new Date(<?php echo $rowCrane10Out->graph_day;?>), y: <?php echo $rowCrane10Out->out_of_order;?> },
			{ x: new Date(<?php echo $rowCrane10Out->graph_year.",".$getMonth.",".$rowCrane10Out->graph_date ;?>), y: <?php echo $rowCrane10Out->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCrane10Out->graph_year.",".$getMonth.",".$rowCrane10Out->graph_date ;?>), y: <?php echo $rowCrane10Out->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartCrane10.render();	 
function toggleDataSeriesCrane10(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCrane10.render();
}


var chartFLT20 = new CanvasJS.Chart("chartContainerFLT20", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 20 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT20
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowFLT20=mysql_fetch_object($queryFLT20))
			{
				$i++;
				$getMonth=$rowFLT20->graph_month-1;
				if($i!=$numRowsFLT20){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT20->graph_day;?>), y: <?php echo $rowFLT20->demand;?> },
			{ x: new Date(<?php echo $rowFLT20->graph_year.",".$getMonth.",".$rowFLT20->graph_date ;?>), y: <?php echo $rowFLT20->demand;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT20->graph_year.",".$getMonth.",".$rowFLT20->graph_date ;?>), y: <?php echo $rowFLT20->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupFLT20=mysql_fetch_object($querySupFLT20))
			{
				$i++;
				$getMonth=$rowSupFLT20->graph_month-1;
				if($i!=$numRowsSupFLT20){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT20->graph_day;?>), y: <?php echo $rowSupFLT20->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT20->graph_year.",".$getMonth.",".$rowSupFLT20->graph_date ;?>), y: <?php echo $rowSupFLT20->suply;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT20->graph_year.",".$getMonth.",".$rowSupFLT20->graph_date ;?>), y: <?php echo $rowSupFLT20->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandFLT20=mysql_fetch_object($queryStandFLT20))
			{
				$i++;
				$getMonth=$rowStandFLT20->graph_month-1;
				if($i!=$numRowsStandFLT20){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT20->graph_day;?>), y: <?php echo $rowStandFLT20->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT20->graph_year.",".$getMonth.",".$rowStandFLT20->graph_date ;?>), y: <?php echo $rowStandFLT20->stand_by;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT20->graph_year.",".$getMonth.",".$rowStandFLT20->graph_date ;?>), y: <?php echo $rowStandFLT20->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutFLT20=mysql_fetch_object($queryOutFLT20))
			{
				$i++;
				$getMonth=$rowOutFLT20->graph_month-1;
				if($i!=$numRowsOutFLT20){
			?>
			//{ x: new Date(<?php echo $rowOutFLT20->graph_day;?>), y: <?php echo $rowOutFLT20->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT20->graph_year.",".$getMonth.",".$rowOutFLT20->graph_date ;?>), y: <?php echo $rowOutFLT20->out_of_order;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT20->graph_year.",".$getMonth.",".$rowOutFLT20->graph_date ;?>), y: <?php echo $rowOutFLT20->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartFLT20.render();	 
function toggleDataSeriesFLT20(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT20.render();
}	 

var chartRRC = new CanvasJS.Chart("chartContainerRRC", {
	animationEnabled: true,
	title:{
		text: "Equipment Type RRC Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesRRC
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowRRC=mysql_fetch_object($queryRRC))
			{
				$i++;
				$getMonth=$rowRRC->graph_month-1;
				if($i!=$numRowsRRC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowRRC->graph_day;?>), y: <?php echo $rowRRC->demand;?> },
			{ x: new Date(<?php echo $rowRRC->graph_year.",".$getMonth.",".$rowRRC->graph_date ;?>), y: <?php echo $rowRRC->demand;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowRRC->graph_year.",".$getMonth.",".$rowRRC->graph_date ;?>), y: <?php echo $rowRRC->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupRRC=mysql_fetch_object($querySupRRC))
			{
				$i++;
				$getMonth=$rowSupRRC->graph_month-1;
				if($i!=$numRowsSupRRC){
			?>
		//	{ x: new Date(<?php echo $rowSupRRC->graph_day;?>), y: <?php echo $rowSupRRC->suply;?> },
			{ x: new Date(<?php echo $rowSupRRC->graph_year.",".$getMonth.",".$rowSupRRC->graph_date ;?>), y: <?php echo $rowSupRRC->suply;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupRRC->graph_year.",".$getMonth.",".$rowSupRRC->graph_date ;?>), y: <?php echo $rowSupRRC->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandRRC=mysql_fetch_object($queryStandRRC))
			{
				$i++;
				$getMonth=$rowStandRRC->graph_month-1;
				if($i!=$numRowsStandRRC){
			?>
		//	{ x: new Date(<?php echo $rowStandRRC->graph_day;?>), y: <?php echo $rowStandRRC->stand_by;?> },
			{ x: new Date(<?php echo $rowStandRRC->graph_year.",".$getMonth.",".$rowStandRRC->graph_date ;?>), y: <?php echo $rowStandRRC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandRRC->graph_year.",".$getMonth.",".$rowStandRRC->graph_date ;?>), y: <?php echo $rowStandRRC->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutRRC=mysql_fetch_object($queryOutRRC))
			{
				$i++;
				$getMonth=$rowOutRRC->graph_month-1;
				if($i!=$numRowsOutRRC){
			?>
		//	{ x: new Date(<?php echo $rowOutRRC->graph_day;?>), y: <?php echo $rowOutRRC->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutRRC->graph_year.",".$getMonth.",".$rowOutRRC->graph_date ;?>), y: <?php echo $rowOutRRC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutRRC->graph_year.",".$getMonth.",".$rowOutRRC->graph_date ;?>), y: <?php echo $rowOutRRC->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartRRC.render();	 
function toggleDataSeriesRRC(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartRRC.render();
}

var chartFLT03 = new CanvasJS.Chart("chartContainerFLT03", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 03 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT03
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowFLT03=mysql_fetch_object($queryFLT03))
			{
				$i++;
				$getMonth=$rowFLT03->graph_month-1;	
				if($i!=$numRowsFLT03){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT03->graph_day;?>), y: <?php echo $rowFLT03->demand;?> },
			{ x: new Date(<?php echo $rowFLT03->graph_year.",".$getMonth.",".$rowFLT03->graph_date ;?>), y: <?php echo $rowFLT03->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT03->graph_year.",".$getMonth.",".$rowFLT03->graph_date ;?>), y: <?php echo $rowFLT03->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupFLT03=mysql_fetch_object($querySupFLT03))
			{
				$i++;
				$getMonth=$rowSupFLT03->graph_month-1;	
				if($i!=$numRowsSupFLT03){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT03->graph_day;?>), y: <?php echo $rowSupFLT03->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT03->graph_year.",".$getMonth.",".$rowSupFLT03->graph_date ;?>), y: <?php echo $rowSupFLT03->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT03->graph_year.",".$getMonth.",".$rowSupFLT03->graph_date ;?>), y: <?php echo $rowSupFLT03->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandFLT03=mysql_fetch_object($queryStandFLT03))
			{
				$i++;
				$getMonth=$rowStandFLT03->graph_month-1;	
				if($i!=$numRowsStandFLT03){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT03->graph_day;?>), y: <?php echo $rowStandFLT03->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT03->graph_year.",".$getMonth.",".$rowStandFLT03->graph_date ;?>), y: <?php echo $rowStandFLT03->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT03->graph_year.",".$getMonth.",".$rowStandFLT03->graph_date ;?>), y: <?php echo $rowStandFLT03->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutFLT03=mysql_fetch_object($queryOutFLT03))
			{
				$i++;
				$getMonth=$rowOutFLT03->graph_month-1;	
				if($i!=$numRowsOutFLT03){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT03->graph_day;?>), y: <?php echo $rowOutFLT03->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT03->graph_year.",".$getMonth.",".$rowOutFLT03->graph_date ;?>), y: <?php echo $rowOutFLT03->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT03->graph_year.",".$getMonth.",".$rowOutFLT03->graph_date ;?>), y: <?php echo $rowOutFLT03->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartFLT03.render();	 
function toggleDataSeriesFLT03(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT03.render();
}

var chartFLT1p5 = new CanvasJS.Chart("chartContainerFLT1p5", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 1.5 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT1p5
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowFLT1p5=mysql_fetch_object($queryFLT1p5))
			{
				$i++;
				$getMonth=$rowFLT1p5->graph_month-1;	
				if($i!=$numRowsFLT1p5){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT1p5->graph_day;?>), y: <?php echo $rowFLT1p5->demand;?> },
			{ x: new Date(<?php echo $rowFLT1p5->graph_year.",".$getMonth.",".$rowFLT1p5->graph_date ;?>), y: <?php echo $rowFLT1p5->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT1p5->graph_year.",".$getMonth.",".$rowFLT1p5->graph_date ;?>), y: <?php echo $rowFLT1p5->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupFLT1p5=mysql_fetch_object($querySupFLT1p5))
			{
				$i++;
				$getMonth=$rowSupFLT1p5->graph_month-1;	
				if($i!=$numRowsSupFLT1p5){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT1p5->graph_day;?>), y: <?php echo $rowSupFLT1p5->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT1p5->graph_year.",".$getMonth.",".$rowSupFLT1p5->graph_date ;?>), y: <?php echo $rowSupFLT1p5->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT1p5->graph_year.",".$getMonth.",".$rowSupFLT1p5->graph_date ;?>), y: <?php echo $rowSupFLT1p5->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandFLT1p5=mysql_fetch_object($queryStandFLT1p5))
			{
				$i++;
				$getMonth=$rowStandFLT1p5->graph_month-1;	
				if($i!=$numRowsStandFLT1p5){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT1p5->graph_day;?>), y: <?php echo $rowStandFLT1p5->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT1p5->graph_year.",".$getMonth.",".$rowStandFLT1p5->graph_date ;?>), y: <?php echo $rowStandFLT1p5->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT1p5->graph_year.",".$getMonth.",".$rowStandFLT1p5->graph_date ;?>), y: <?php echo $rowStandFLT1p5->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutFLT1p5=mysql_fetch_object($queryOutFLT1p5))
			{
				$i++;
				$getMonth=$rowOutFLT1p5->graph_month-1;	
				if($i!=$numRowsOutFLT1p5){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT1p5->graph_day;?>), y: <?php echo $rowOutFLT1p5->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT1p5->graph_year.",".$getMonth.",".$rowOutFLT1p5->graph_date ;?>), y: <?php echo $rowOutFLT1p5->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT1p5->graph_year.",".$getMonth.",".$rowOutFLT1p5->graph_date ;?>), y: <?php echo $rowOutFLT1p5->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartFLT1p5.render();	 
function toggleDataSeriesFLT1p5(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT1p5.render();
}

 var chartTR25 = new CanvasJS.Chart("chartContainerTR25", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Tractor 25 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesTR25
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowTR25=mysql_fetch_object($queryTR25))
			{
				$i++;
				$getMonth=$rowTR25->graph_month-1;	
				if($i!=$numRowsTR25){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowTR25->graph_day;?>), y: <?php echo $rowTR25->demand;?> },
			{ x: new Date(<?php echo $rowTR25->graph_year.",".$getMonth.",".$rowTR25->graph_date ;?>), y: <?php echo $rowTR25->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowTR25->graph_year.",".$getMonth.",".$rowTR25->graph_date ;?>), y: <?php echo $rowTR25->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupTR25=mysql_fetch_object($querySupTR25))
			{
				$i++;
				$getMonth=$rowSupTR25->graph_month-1;	
				if($i!=$numRowsSupTR25){
			?>
		//	{ x: new Date(<?php echo $rowSupTR25->graph_day;?>), y: <?php echo $rowSupTR25->suply;?> },
			{ x: new Date(<?php echo $rowSupTR25->graph_year.",".$getMonth.",".$rowSupTR25->graph_date ;?>), y: <?php echo $rowSupTR25->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupTR25->graph_year.",".$getMonth.",".$rowSupTR25->graph_date ;?>), y: <?php echo $rowSupTR25->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandTR25=mysql_fetch_object($queryStandTR25))
			{
				$i++;
				$getMonth=$rowStandTR25->graph_month-1;	
				if($i!=$numRowsStandTR25){
			?>
		//	{ x: new Date(<?php echo $rowStandTR25->graph_day;?>), y: <?php echo $rowStandTR25->stand_by;?> },
			{ x: new Date(<?php echo $rowStandTR25->graph_year.",".$getMonth.",".$rowStandTR25->graph_date ;?>), y: <?php echo $rowStandTR25->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandTR25->graph_year.",".$getMonth.",".$rowStandTR25->graph_date ;?>), y: <?php echo $rowStandTR25->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutTR25=mysql_fetch_object($queryOutTR25))
			{
				$i++;
				$getMonth=$rowOutTR25->graph_month-1;	
				if($i!=$numRowsOutTR25){
			?>
		//	{ x: new Date(<?php echo $rowOutTR25->graph_day;?>), y: <?php echo $rowOutTR25->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutTR25->graph_year.",".$getMonth.",".$rowOutTR25->graph_date ;?>), y: <?php echo $rowOutTR25->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutTR25->graph_year.",".$getMonth.",".$rowOutTR25->graph_date ;?>), y: <?php echo $rowOutTR25->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartTR25.render();	 
function toggleDataSeriesTR25(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartTR25.render();
}


var chartHT25 = new CanvasJS.Chart("chartContainerHT25", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Heavy Trailer 25 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesHT25
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowHT25=mysql_fetch_object($queryHT25))
			{
				$i++;
				$getMonth=$rowHT25->graph_month-1;		
				if($i!=$numRowsHT25){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowHT25->graph_day;?>), y: <?php echo $rowHT25->demand;?> },
			{ x: new Date(<?php echo $rowHT25->graph_year.",".$getMonth.",".$rowHT25->graph_date ;?>), y: <?php echo $rowHT25->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowHT25->graph_year.",".$getMonth.",".$rowHT25->graph_date ;?>), y: <?php echo $rowHT25->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupHT25=mysql_fetch_object($querySupHT25))
			{
				$i++;
				$getMonth=$rowSupHT25->graph_month-1;		
				if($i!=$numRowsSupHT25){
			?>
		//	{ x: new Date(<?php echo $rowSupHT25->graph_day;?>), y: <?php echo $rowSupHT25->suply;?> },
			{ x: new Date(<?php echo $rowSupHT25->graph_year.",".$getMonth.",".$rowSupHT25->graph_date ;?>), y: <?php echo $rowSupHT25->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupHT25->graph_year.",".$getMonth.",".$rowSupHT25->graph_date ;?>), y: <?php echo $rowSupHT25->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandHT25=mysql_fetch_object($queryStandHT25))
			{
				$i++;
				$getMonth=$rowStandHT25->graph_month-1;		
				if($i!=$numRowsStandHT25){
			?>
		//	{ x: new Date(<?php echo $rowStandHT25->graph_day;?>), y: <?php echo $rowStandHT25->stand_by;?> },
			{ x: new Date(<?php echo $rowStandHT25->graph_year.",".$getMonth.",".$rowStandHT25->graph_date ;?>), y: <?php echo $rowStandHT25->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandHT25->graph_year.",".$getMonth.",".$rowStandHT25->graph_date ;?>), y: <?php echo $rowStandHT25->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutHT25=mysql_fetch_object($queryOutHT25))
			{
				$i++;
				$getMonth=$rowOutHT25->graph_month-1;		
				if($i!=$numRowsOutHT25){
			?>
		//	{ x: new Date(<?php echo $rowOutHT25->graph_day;?>), y: <?php echo $rowOutHT25->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutHT25->graph_year.",".$getMonth.",".$rowOutHT25->graph_date ;?>), y: <?php echo $rowOutHT25->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutHT25->graph_year.",".$getMonth.",".$rowOutHT25->graph_date ;?>), y: <?php echo $rowOutHT25->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartHT25.render();	 
function toggleDataSeriesHT25(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartHT25.render();
}

var chartLT06 = new CanvasJS.Chart("chartContainerLT06", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Light Trailer 06 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesLT06
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowLT06=mysql_fetch_object($queryLT06))
			{
				$i++;
				$getMonth=$rowLT06->graph_month-1;		
				if($i!=$numRowsLT06){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowLT06->graph_day;?>), y: <?php echo $rowLT06->demand;?> },
			{ x: new Date(<?php echo $rowLT06->graph_year.",".$getMonth.",".$rowLT06->graph_date ;?>), y: <?php echo $rowLT06->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowLT06->graph_year.",".$getMonth.",".$rowLT06->graph_date ;?>), y: <?php echo $rowLT06->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupLT06=mysql_fetch_object($querySupLT06))
			{
				$i++;
				$getMonth=$rowSupLT06->graph_month-1;		
				if($i!=$numRowsSupLT06){
			?>
		//	{ x: new Date(<?php echo $rowSupLT06->graph_day;?>), y: <?php echo $rowSupLT06->suply;?> },
			{ x: new Date(<?php echo $rowSupLT06->graph_year.",".$getMonth.",".$rowSupLT06->graph_date ;?>), y: <?php echo $rowSupLT06->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupLT06->graph_year.",".$getMonth.",".$rowSupLT06->graph_date ;?>), y: <?php echo $rowSupLT06->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandLT06=mysql_fetch_object($queryStandLT06))
			{
				$i++;
				$getMonth=$rowStandLT06->graph_month-1;		
				if($i!=$numRowsStandLT06){
			?>
		//	{ x: new Date(<?php echo $rowStandLT06->graph_day;?>), y: <?php echo $rowStandLT06->stand_by;?> },
			{ x: new Date(<?php echo $rowStandLT06->graph_year.",".$getMonth.",".$rowStandLT06->graph_date ;?>), y: <?php echo $rowStandLT06->stand_by;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandLT06->graph_year.",".$getMonth.",".$rowStandLT06->graph_date ;?>), y: <?php echo $rowStandLT06->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutLT06=mysql_fetch_object($queryOutLT06))
			{
				$i++;
				$getMonth=$rowOutLT06->graph_month-1;		
				if($i!=$numRowsOutLT06){
			?>
		//	{ x: new Date(<?php echo $rowOutLT06->graph_day;?>), y: <?php echo $rowOutLT06->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutLT06->graph_year.",".$getMonth.",".$rowOutLT06->graph_date ;?>), y: <?php echo $rowOutLT06->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutLT06->graph_year.",".$getMonth.",".$rowOutLT06->graph_date ;?>), y: <?php echo $rowOutLT06->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartLT06.render();	 
function toggleDataSeriesLT06(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartLT06.render();
}

var chartCC = new CanvasJS.Chart("chartContainerCC", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Car Carrier"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesCC
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowCC=mysql_fetch_object($queryCC))
			{
				$i++;
				$getMonth=$rowCC->graph_month-1;			
				if($i!=$numRowsCC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowCC->graph_day;?>), y: <?php echo $rowCC->demand;?> },
			{ x: new Date(<?php echo $rowCC->graph_year.",".$getMonth.",".$rowCC->graph_date ;?>), y: <?php echo $rowCC->demand;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCC->graph_year.",".$getMonth.",".$rowCC->graph_date ;?>), y: <?php echo $rowCC->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupCC=mysql_fetch_object($querySupCC))
			{
				$i++;
				$getMonth=$rowSupCC->graph_month-1;			
				if($i!=$numRowsSupCC){
			?>
		//	{ x: new Date(<?php echo $rowSupCC->graph_day;?>), y: <?php echo $rowSupCC->suply;?> },
			{ x: new Date(<?php echo $rowSupCC->graph_year.",".$getMonth.",".$rowSupCC->graph_date ;?>), y: <?php echo $rowSupCC->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupCC->graph_year.",".$getMonth.",".$rowSupCC->graph_date ;?>), y: <?php echo $rowSupCC->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandCC=mysql_fetch_object($queryStandCC))
			{
				$i++;
				$getMonth=$rowStandCC->graph_month-1;			
				if($i!=$numRowsStandCC){
			?>
		//	{ x: new Date(<?php echo $rowStandCC->graph_day;?>), y: <?php echo $rowStandCC->stand_by;?> },
			{ x: new Date(<?php echo $rowStandCC->graph_year.",".$getMonth.",".$rowStandCC->graph_date ;?>), y: <?php echo $rowStandCC->stand_by;?> },

			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandCC->graph_year.",".$getMonth.",".$rowStandCC->graph_date ;?>), y: <?php echo $rowStandCC->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutCC=mysql_fetch_object($queryOutCC))
			{
				$i++;
				$getMonth=$rowOutCC->graph_month-1;			
				if($i!=$numRowsOutCC){
			?>
		//	{ x: new Date(<?php echo $rowOutCC->graph_day;?>), y: <?php echo $rowOutCC->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutCC->graph_year.",".$getMonth.",".$rowOutCC->graph_date ;?>), y: <?php echo $rowOutCC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutCC->graph_year.",".$getMonth.",".$rowOutCC->graph_date ;?>), y: <?php echo $rowOutCC->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartCC.render();	 
function toggleDataSeriesCC(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCC.render();
}

var chartTH04 = new CanvasJS.Chart("chartContainerTH04", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Tele Handler 04 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesTH04
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowTH04=mysql_fetch_object($queryTH04))
			{
				$i++;
				$getMonth=$rowTH04->graph_month-1;			
				if($i!=$numRowsTH04){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowTH04->graph_day;?>), y: <?php echo $rowTH04->demand;?> },
			{ x: new Date(<?php echo $rowTH04->graph_year.",".$getMonth.",".$rowTH04->graph_date ;?>), y: <?php echo $rowTH04->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowTH04->graph_year.",".$getMonth.",".$rowTH04->graph_date ;?>), y: <?php echo $rowTH04->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupTH04=mysql_fetch_object($querySupTH04))
			{
				$i++;
				$getMonth=$rowSupTH04->graph_month-1;			
				if($i!=$numRowsSupTH04){
			?>
		//	{ x: new Date(<?php echo $rowSupTH04->graph_day;?>), y: <?php echo $rowSupTH04->suply;?> },
			{ x: new Date(<?php echo $rowSupTH04->graph_year.",".$getMonth.",".$rowSupTH04->graph_date ;?>), y: <?php echo $rowSupTH04->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupTH04->graph_year.",".$getMonth.",".$rowSupTH04->graph_date ;?>), y: <?php echo $rowSupTH04->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandTH04=mysql_fetch_object($queryStandTH04))
			{
				$i++;
				$getMonth=$rowStandTH04->graph_month-1;			
				if($i!=$numRowsStandTH04){
			?>
		//	{ x: new Date(<?php echo $rowStandTH04->graph_day;?>), y: <?php echo $rowStandTH04->stand_by;?> },
			{ x: new Date(<?php echo $rowStandTH04->graph_year.",".$getMonth.",".$rowStandTH04->graph_date ;?>), y: <?php echo $rowStandTH04->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandTH04->graph_year.",".$getMonth.",".$rowStandTH04->graph_date ;?>), y: <?php echo $rowStandTH04->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutTH04=mysql_fetch_object($queryOutTH04))
			{
				$i++;
				$getMonth=$rowOutTH04->graph_month-1;			
				if($i!=$numRowsOutTH04){
			?>
	//	 	{ x: new Date(<?php echo $rowOutTH04->graph_day;?>), y: <?php echo $rowOutTH04->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutTH04->graph_year.",".$getMonth.",".$rowOutTH04->graph_date ;?>), y: <?php echo $rowOutTH04->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutTH04->graph_year.",".$getMonth.",".$rowOutTH04->graph_date ;?>), y: <?php echo $rowOutTH04->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartTH04.render();	 
function toggleDataSeriesTH04(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartTH04.render();
}

var chartFLT10 = new CanvasJS.Chart("chartContainerFLT10", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 10 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT10
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowFLT10=mysql_fetch_object($queryFLT10))
			{
				$i++;
				$getMonth=$rowFLT10->graph_month-1;				
				if($i!=$numRowsFLT10){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT10->graph_day;?>), y: <?php echo $rowFLT10->demand;?> },
			{ x: new Date(<?php echo $rowFLT10->graph_year.",".$getMonth.",".$rowFLT10->graph_date ;?>), y: <?php echo $rowFLT10->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT10->graph_year.",".$getMonth.",".$rowFLT10->graph_date ;?>), y: <?php echo $rowFLT10->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupFLT10=mysql_fetch_object($querySupFLT10))
			{
				$i++;
				$getMonth=$rowSupFLT10->graph_month-1;				
				if($i!=$numRowsSupFLT10){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT10->graph_day;?>), y: <?php echo $rowSupFLT10->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT10->graph_year.",".$getMonth.",".$rowSupFLT10->graph_date ;?>), y: <?php echo $rowSupFLT10->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT10->graph_year.",".$getMonth.",".$rowSupFLT10->graph_date ;?>), y: <?php echo $rowSupFLT10->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandFLT10=mysql_fetch_object($queryStandFLT10))
			{
				$i++;
				$getMonth=$rowStandFLT10->graph_month-1;				
				if($i!=$numRowsStandFLT10){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT10->graph_day;?>), y: <?php echo $rowStandFLT10->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT10->graph_year.",".$getMonth.",".$rowStandFLT10->graph_date ;?>), y: <?php echo $rowStandFLT10->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT10->graph_year.",".$getMonth.",".$rowStandFLT10->graph_date ;?>), y: <?php echo $rowStandFLT10->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutFLT10=mysql_fetch_object($queryOutFLT10))
			{
				$i++;
				$getMonth=$rowOutFLT10->graph_month-1;				
				if($i!=$numRowsOutFLT10){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT10->graph_day;?>), y: <?php echo $rowOutFLT10->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT10->graph_year.",".$getMonth.",".$rowOutFLT10->graph_date ;?>), y: <?php echo $rowOutFLT10->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT10->graph_year.",".$getMonth.",".$rowOutFLT10->graph_date ;?>), y: <?php echo $rowOutFLT10->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartFLT10.render();	 
function toggleDataSeriesFLT10(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT10.render();
}

var chartFLT05 = new CanvasJS.Chart("chartContainerFLT05", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 05 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesFLT05
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowFLT05=mysql_fetch_object($queryFLT05))
			{
				$i++;
				$getMonth=$rowFLT05->graph_month-1;				
				if($i!=$numRowsFLT05){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT05->graph_day;?>), y: <?php echo $rowFLT05->demand;?> },
			{ x: new Date(<?php echo $rowFLT05->graph_year.",".$getMonth.",".$rowFLT05->graph_date ;?>), y: <?php echo $rowFLT05->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT05->graph_year.",".$getMonth.",".$rowFLT05->graph_date ;?>), y: <?php echo $rowFLT05->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupFLT05=mysql_fetch_object($querySupFLT05))
			{
				$i++;
				$getMonth=$rowSupFLT05->graph_month-1;				
				if($i!=$numRowsSupFLT05){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT05->graph_day;?>), y: <?php echo $rowSupFLT05->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT05->graph_year.",".$getMonth.",".$rowSupFLT05->graph_date ;?>), y: <?php echo $rowSupFLT05->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT05->graph_year.",".$getMonth.",".$rowSupFLT05->graph_date ;?>), y: <?php echo $rowSupFLT05->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandFLT05=mysql_fetch_object($queryStandFLT05))
			{
				$i++;
				$getMonth=$rowStandFLT05->graph_month-1;				
				if($i!=$numRowsStandFLT05){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT05->graph_day;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT05->graph_year.",".$getMonth.",".$rowStandFLT05->graph_date ;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT05->graph_year.",".$getMonth.",".$rowStandFLT05->graph_date ;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutFLT05=mysql_fetch_object($queryOutFLT05))
			{
				$i++;
				$getMonth=$rowOutFLT05->graph_month-1;				
				if($i!=$numRowsOutFLT05){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT05->graph_day;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT05->graph_year.",".$getMonth.",".$rowOutFLT05->graph_date ;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT05->graph_year.",".$getMonth.",".$rowOutFLT05->graph_date ;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartFLT05.render();	 
function toggleDataSeriesFLT05(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT05.render();
} 




/* Pipe Handler 45 Ton*/

var chartPH45 = new CanvasJS.Chart("chartContainerPH45", {
	animationEnabled: true,
	title:{
		text: "Equipment Type Pipe Handler 45 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesPH45
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowPH45=mysql_fetch_object($queryPH45))
			{

				$i++;
				$getMonth=$rowPH45->graph_month-1;				
				if($i!=$numRowsPH45){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT05->graph_day;?>), y: <?php echo $rowFLT05->demand;?> },
			{ x: new Date(<?php echo $rowPH45->graph_year.",".$getMonth.",".$rowPH45->graph_date ;?>), y: <?php echo $rowPH45->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowPH45->graph_year.",".$getMonth.",".$rowPH45->graph_date ;?>), y: <?php echo $rowPH45->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupPH45=mysql_fetch_object($querySupPH45))
			{
				$i++;
				$getMonth=$rowSupPH45->graph_month-1;				
				if($i!=$numRowsSupPH45){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT05->graph_day;?>), y: <?php echo $rowSupFLT05->suply;?> },
			{ x: new Date(<?php echo $rowSupPH45->graph_year.",".$getMonth.",".$rowSupPH45->graph_date ;?>), y: <?php echo $rowSupPH45->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupPH45->graph_year.",".$getMonth.",".$rowSupPH45->graph_date ;?>), y: <?php echo $rowSupPH45->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandPH45=mysql_fetch_object($queryStandPH45))
			{
				$i++;
				$getMonth=$rowStandPH45->graph_month-1;				
				if($i!=$numRowsStandPH45){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT05->graph_day;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			{ x: new Date(<?php echo $rowStandPH45->graph_year.",".$getMonth.",".$rowStandPH45->graph_date ;?>), y: <?php echo $rowStandPH45->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandPH45->graph_year.",".$getMonth.",".$rowStandPH45->graph_date ;?>), y: <?php echo $rowStandPH45->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutPH45=mysql_fetch_object($queryOutPH45))
			{
				$i++;
				$getMonth=$rowOutPH45->graph_month-1;				
				if($i!=$numRowsOutPH45){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT05->graph_day;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutPH45->graph_year.",".$getMonth.",".$rowOutPH45->graph_date ;?>), y: <?php echo $rowOutPH45->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutPH45->graph_year.",".$getMonth.",".$rowOutPH45->graph_date ;?>), y: <?php echo $rowOutPH45->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartPH45.render();	 
function toggleDataSeriesPH45(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartPH45.render();
} 


/* Automatic Weighing & Bagging Machine*/

var chartAWBM = new CanvasJS.Chart("chartContainerAWBM", {
	animationEnabled: true,
	title:{
		text: "Automatic Weighing & Bagging Machine"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesAWBM
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowAWBM=mysql_fetch_object($queryAWBM))
			{

				$i++;
				$getMonth=$rowAWBM->graph_month-1;				
				if($i!=$numRowsAWBM){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT05->graph_day;?>), y: <?php echo $rowFLT05->demand;?> },
			{ x: new Date(<?php echo $rowAWBM->graph_year.",".$getMonth.",".$rowAWBM->graph_date ;?>), y: <?php echo $rowAWBM->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowAWBM->graph_year.",".$getMonth.",".$rowAWBM->graph_date ;?>), y: <?php echo $rowAWBM->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupAWBM=mysql_fetch_object($querySupAWBM))
			{
				$i++;
				$getMonth=$rowSupAWBM->graph_month-1;				
				if($i!=$numRowsSupAWBM){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT05->graph_day;?>), y: <?php echo $rowSupFLT05->suply;?> },
			{ x: new Date(<?php echo $rowSupAWBM->graph_year.",".$getMonth.",".$rowSupAWBM->graph_date ;?>), y: <?php echo $rowSupAWBM->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupAWBM->graph_year.",".$getMonth.",".$rowSupAWBM->graph_date ;?>), y: <?php echo $rowSupAWBM->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandAWBM=mysql_fetch_object($queryStandAWBM))
			{
				$i++;
				$getMonth=$rowStandAWBM->graph_month-1;				
				if($i!=$numRowsStandAWBM){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT05->graph_day;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			{ x: new Date(<?php echo $rowStandAWBM->graph_year.",".$getMonth.",".$rowStandAWBM->graph_date ;?>), y: <?php echo $rowStandAWBM->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandAWBM->graph_year.",".$getMonth.",".$rowStandAWBM->graph_date ;?>), y: <?php echo $rowStandAWBM->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutAWBM=mysql_fetch_object($queryOutAWBM))
			{
				$i++;
				$getMonth=$rowOutAWBM->graph_month-1;				
				if($i!=$numRowsOutAWBM){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT05->graph_day;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutAWBM->graph_year.",".$getMonth.",".$rowOutAWBM->graph_date ;?>), y: <?php echo $rowOutAWBM->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutAWBM->graph_year.",".$getMonth.",".$rowOutAWBM->graph_date ;?>), y: <?php echo $rowOutAWBM->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartAWBM.render();	 
function toggleDataSeriesAWBM(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartAWBM.render();
} 


/* Pneumatic Conveyor*/

var chartPC = new CanvasJS.Chart("chartContainerPC", {
	animationEnabled: true,
	title:{
		text: "Pneumatic Conveyor"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesPC
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowPC=mysql_fetch_object($queryPC))
			{

				$i++;
				$getMonth=$rowPC->graph_month-1;				
				if($i!=$numRowsPC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT05->graph_day;?>), y: <?php echo $rowFLT05->demand;?> },
			{ x: new Date(<?php echo $rowPC->graph_year.",".$getMonth.",".$rowPC->graph_date ;?>), y: <?php echo $rowPC->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowPC->graph_year.",".$getMonth.",".$rowPC->graph_date ;?>), y: <?php echo $rowPC->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupPC=mysql_fetch_object($querySupPC))
			{
				$i++;
				$getMonth=$rowSupPC->graph_month-1;				
				if($i!=$numRowsSupPC){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT05->graph_day;?>), y: <?php echo $rowSupFLT05->suply;?> },
			{ x: new Date(<?php echo $rowSupPC->graph_year.",".$getMonth.",".$rowSupPC->graph_date ;?>), y: <?php echo $rowSupPC->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupPC->graph_year.",".$getMonth.",".$rowSupPC->graph_date ;?>), y: <?php echo $rowSupPC->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandPC=mysql_fetch_object($queryStandPC))
			{
				$i++;
				$getMonth=$rowStandPC->graph_month-1;				
				if($i!=$numRowsStandPC){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT05->graph_day;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			{ x: new Date(<?php echo $rowStandPC->graph_year.",".$getMonth.",".$rowStandPC->graph_date ;?>), y: <?php echo $rowStandPC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandPC->graph_year.",".$getMonth.",".$rowStandPC->graph_date ;?>), y: <?php echo $rowStandPC->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutPC=mysql_fetch_object($queryOutPC))
			{
				$i++;
				$getMonth=$rowOutPC->graph_month-1;				
				if($i!=$numRowsOutPC){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT05->graph_day;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutPC->graph_year.",".$getMonth.",".$rowOutPC->graph_date ;?>), y: <?php echo $rowOutPC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutPC->graph_year.",".$getMonth.",".$rowOutPC->graph_date ;?>), y: <?php echo $rowOutPC->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartPC.render();	 
function toggleDataSeriesPC(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartPC.render();
} 


/* Variable Reach Stacker 16 Ton -- Start*/

var chartVRS16 = new CanvasJS.Chart("chartContainerVRS16", {
	animationEnabled: true,
	title:{
		text: "Variable Reach Stacker 16 Ton"
	},
	axisX: {
		valueFormatString: "DD"
	},
	axisY: {
		title: "Scale",
		includeZero: false,
		suffix: ""
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeriesVRS16
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "Demand",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		//console.log(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>);
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowVRS16=mysql_fetch_object($queryVRS16))
			{

				$i++;
				$getMonth=$rowVRS16->graph_month-1;				
				if($i!=$numRowsVRS16){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
		//	{ x: new Date(<?php echo $rowFLT05->graph_day;?>), y: <?php echo $rowFLT05->demand;?> },
			{ x: new Date(<?php echo $rowVRS16->graph_year.",".$getMonth.",".$rowVRS16->graph_date ;?>), y: <?php echo $rowVRS16->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowVRS16->graph_year.",".$getMonth.",".$rowVRS16->graph_date ;?>), y: <?php echo $rowVRS16->demand;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Supply",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowSupVRS16=mysql_fetch_object($querySupVRS16))
			{
				$i++;
				$getMonth=$rowSupVRS16->graph_month-1;				
				if($i!=$numRowsSupVRS16){
			?>
		//	{ x: new Date(<?php echo $rowSupFLT05->graph_day;?>), y: <?php echo $rowSupFLT05->suply;?> },
			{ x: new Date(<?php echo $rowSupVRS16->graph_year.",".$getMonth.",".$rowSupVRS16->graph_date ;?>), y: <?php echo $rowSupVRS16->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupVRS16->graph_year.",".$getMonth.",".$rowSupVRS16->graph_date ;?>), y: <?php echo $rowSupVRS16->suply;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Stand by",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
		
			<?php 
			$i = 0;
			while($rowStandVRS16=mysql_fetch_object($queryStandVRS16))
			{
				$i++;
				$getMonth=$rowStandVRS16->graph_month-1;				
				if($i!=$numRowsStandVRS16){
			?>
		//	{ x: new Date(<?php echo $rowStandFLT05->graph_day;?>), y: <?php echo $rowStandFLT05->stand_by;?> },
			{ x: new Date(<?php echo $rowStandVRS16->graph_year.",".$getMonth.",".$rowStandVRS16->graph_date ;?>), y: <?php echo $rowStandVRS16->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandVRS16->graph_year.",".$getMonth.",".$rowStandVRS16->graph_date ;?>), y: <?php echo $rowStandVRS16->stand_by;?> },
			<?php
			}
			}
			?>
		]
	},
	{
		name: "Out of order",
		type: "line",
		yValueFormatString: "#",
		showInLegend: true,
		dataPoints: 
		[
			<?php 
			$i = 0;
			while($rowOutVRS16=mysql_fetch_object($queryOutVRS16))
			{
				$i++;
				$getMonth=$rowOutVRS16->graph_month-1;				
				if($i!=$numRowsOutVRS16){
			?>
		//	{ x: new Date(<?php echo $rowOutFLT05->graph_day;?>), y: <?php echo $rowOutFLT05->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutVRS16->graph_year.",".$getMonth.",".$rowOutVRS16->graph_date ;?>), y: <?php echo $rowOutVRS16->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutVRS16->graph_year.",".$getMonth.",".$rowOutVRS16->graph_date ;?>), y: <?php echo $rowOutVRS16->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chartVRS16.render();	 
function toggleDataSeriesVRS16(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartVRS16.render();
} 




}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
			<?php include('footer.php'); ?>

</html>