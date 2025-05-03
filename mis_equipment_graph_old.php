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
				<table>
					<tr style="margin:5px;">
						<td colspan="7"><font size="5"><b>Daily Equipment Statement for the month of <?php echo date("F"); ?> , <?php echo date("Y")?></b></font><font size="4"></font></td>
					</tr>

				</table>
				<?php
					$strQuery = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='QGC') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySup = "SELECT IFNULL(suply,0) AS suply,graph_day ,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='QGC') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOut = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='QGC') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStand = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='QGC') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$query=mysql_query($strQuery);
					$querySup=mysql_query($strQuerySup);
					$queryOut=mysql_query($strQueryOut);
					$queryStand=mysql_query($strQueryStand);
					
					$numRows = mysql_num_rows($query);
					$numRowsSup = mysql_num_rows($querySup);
					$numRowsOut = mysql_num_rows($queryOut);
					$numRowsStand = mysql_num_rows($queryStand);
					
					$strQueryRTG = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RTG') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupRTG = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RTG') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutRTG = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RTG') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandRTG = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RTG') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryRTG=mysql_query($strQueryRTG);
					$querySupRTG=mysql_query($strQuerySupRTG);
					$queryOutRTG=mysql_query($strQueryOutRTG);
					$queryStandRTG=mysql_query($strQueryStandRTG);
					
					$numRowsRTG = mysql_num_rows($queryRTG);
					$numRowsSupRTG = mysql_num_rows($querySupRTG);
					$numRowsOutRTG = mysql_num_rows($queryOutRTG);
					$numRowsStandRTG = mysql_num_rows($queryStandRTG);
					
					$strQueryMHC = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupMHC = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutMHC = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandMHC = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='MHC') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryMHC=mysql_query($strQueryMHC);
					$querySupMHC=mysql_query($strQuerySupMHC);
					$queryOutMHC=mysql_query($strQueryOutMHC);
					$queryStandMHC=mysql_query($strQueryStandMHC);
					
					$numRowsMHC = mysql_num_rows($queryMHC);
					$numRowsSupMHC = mysql_num_rows($querySupMHC);
					$numRowsOutMHC = mysql_num_rows($queryOutMHC);
					$numRowsStandMHC = mysql_num_rows($queryStandMHC);
					
					$strQueryRMG = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RMG') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupRMG = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RMG') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutRMG = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RMG') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandRMG = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RMG') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryRMG=mysql_query($strQueryRMG);
					$querySupRMG=mysql_query($strQuerySupRMG);
					$queryOutRMG=mysql_query($strQueryOutRMG);
					$queryStandRMG=mysql_query($strQueryStandRMG);
					
					$numRowsRMG = mysql_num_rows($queryRMG);
					$numRowsSupRMG = mysql_num_rows($querySupRMG);
					$numRowsOutRMG = mysql_num_rows($queryOutRMG);
					$numRowsStandRMG = mysql_num_rows($queryStandRMG);
					
					$strQuerySC = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='SC') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupSC = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='SC') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutSC = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='SC') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandSC = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='SC') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$querySC=mysql_query($strQuerySC);
					$querySupSC=mysql_query($strQuerySupSC);
					$queryOutSC=mysql_query($strQueryOutSC);
					$queryStandSC=mysql_query($strQueryStandSC);
					
					$numRowsSC = mysql_num_rows($querySC);
					$numRowsSupSC = mysql_num_rows($querySupSC);
					$numRowsOutSC = mysql_num_rows($queryOutSC);
					$numRowsStandSC = mysql_num_rows($queryStandSC);
					
					$strQueryRST45 = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 45 Ton') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupRST45 = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 45 Ton') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutRST45 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 45 Ton') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandRST45 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 45 Ton') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryRST45=mysql_query($strQueryRST45);
					$querySupRST45=mysql_query($strQuerySupRST45);
					$queryOutRST45=mysql_query($strQueryOutRST45);
					$queryStandRST45=mysql_query($strQueryStandRST45);
					
					$numRowsRST45 = mysql_num_rows($queryRST45);
					$numRowsSupRST45 = mysql_num_rows($querySupRST45);
					$numRowsOutRST45 = mysql_num_rows($queryOutRST45);
					$numRowsStandRST45 = mysql_num_rows($queryStandRST45);
					
					/* FLT 42*/
					$strQueryFLT42 = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 42 Ton') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT42 = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 42 Ton') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT42 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 42 Ton') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT42 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 42 Ton') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT42=mysql_query($strQueryFLT42);
					$querySupFLT42=mysql_query($strQuerySupFLT42);
					$queryOutFLT42=mysql_query($strQueryOutFLT42);
					$queryStandFLT42=mysql_query($strQueryStandFLT42);
					
					$numRowsFLT42 = mysql_num_rows($queryFLT42);
					$numRowsSupFLT42 = mysql_num_rows($querySupFLT42);
					$numRowsOutFLT42 = mysql_num_rows($queryOutFLT42);
					$numRowsStandFLT42 = mysql_num_rows($queryStandFLT42);
					
					/* FLT 42*/
					
					$strQueryFLT10 = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 10 Ton') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT10 = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 10 Ton') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT10 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 10 Ton') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT10 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 10 Ton') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					
					//RST FLT 16 Ton
					
					$strQuery_FLT_16_Ton = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 16 Ton') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySup_FLT_16_Ton = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 16 Ton') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOut_FLT_16_Ton = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 16 Ton') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStand_FLT_16_Ton = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='FLT 16 Ton') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$query_FLT_16_Ton=mysql_query($strQuery_FLT_16_Ton);
					$querySup_FLT_16_Ton=mysql_query($strQuerySup_FLT_16_Ton);
					$queryOut_FLT_16_Ton=mysql_query($strQueryOut_FLT_16_Ton);
					$queryStand_FLT_16_Ton=mysql_query($strQueryStand_FLT_16_Ton);
					
					$numRows_FLT_16_Ton = mysql_num_rows($query_FLT_16_Ton);
					$numRowsSup_FLT_16_Ton = mysql_num_rows($querySup_FLT_16_Ton);
					$numRowsOut_FLT_16_Ton = mysql_num_rows($queryOut_FLT_16_Ton);
					$numRowsStand_FLT_16_Ton = mysql_num_rows($queryStand_FLT_16_Ton); 
					
					//RST 7 Ton
					$strQuery_RST_7_Ton = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 7 Ton') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySup_RST_7_Ton = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 7 Ton') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOut_RST_7_Ton = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 7 Ton') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStand_RST_7_Ton = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='RST 7 Ton') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$query_RST_7_Ton=mysql_query($strQuery_RST_7_Ton);
					$querySup_RST_7_Ton=mysql_query($strQuerySup_RST_7_Ton);
					$queryOut_RST_7_Ton=mysql_query($strQueryOut_RST_7_Ton);
					$queryStand_RST_7_Ton=mysql_query($strQueryStand_RST_7_Ton);
					
					$numRows_RST_7_Ton = mysql_num_rows($query_RST_7_Ton);
					$numRowsSup_RST_7_Ton = mysql_num_rows($querySup_RST_7_Ton);
					$numRowsOut_RST_7_Ton = mysql_num_rows($queryOut_RST_7_Ton);
					$numRowsStand_RST_7_Ton = mysql_num_rows($queryStand_RST_7_Ton); 
					
					/* CM*/
					$strQueryCM = "SELECT IFNULL(demand,0) AS demand,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT demand FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='CM') AS demand,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupCM = "SELECT IFNULL(suply,0) AS suply,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT suply FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='CM') AS suply,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutCM = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT out_of_order FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='CM') AS out_of_order,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandCM = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day,graph_year,graph_month,graph_date FROM
					(
					SELECT 
					(SELECT stand_by FROM ctmsmis.mis_equip_demand_suply WHERE DATE(demand_suply_date)=DATE(mytable.dt) AND equipment_type='CM') AS stand_by,
					DATE_FORMAT(dt, '%Y,%m,%d') AS graph_day,YEAR(NOW()) AS graph_year,MONTH(NOW()) AS graph_month,d AS graph_date
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt,a + b +1 AS d
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryCM=mysql_query($strQueryCM);
					$querySupCM=mysql_query($strQuerySupCM);
					$queryOutCM=mysql_query($strQueryOutCM);
					$queryStandCM=mysql_query($strQueryStandCM);
					
					$numRowsCM = mysql_num_rows($queryCM);
					$numRowsSupCM = mysql_num_rows($querySupCM);
					$numRowsOutCM = mysql_num_rows($queryOutCM);
					$numRowsStandCM = mysql_num_rows($queryStandCM);
					
					/* CM */
					
					
					
					
					?>
				<div class="row">
					<div id="chartContainer" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerRTG" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerMHC" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerRMG" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerSC" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerRST45" style="height: 200px; width: 90%;">
					</div>
					<div id="chartContainerFLT42" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainer_FLT_16_Ton" style="height: 200px; width: 90%;">
					</div>	
					<br>					
					<div id="chartContainer_RST_7_Ton" style="height: 200px; width: 90%;">
					</div>
					<br>
					<div id="chartContainerFLT10" style="height: 200px; width: 90%;">
					</div>
					<div id="chartContainerCM" style="height: 200px; width: 90%;">
					</div>
				</div>
				</div>
			</div>
		</div>
		
	</body>
	<script>
	 window.onload = function () {
var chartRTG = new CanvasJS.Chart("chartContainerRTG", {
	animationEnabled: true,
	title:{
		text: "Equipment Type RTG"
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
		itemclick: toggleDataSeriesRTG
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
			while($rowRTG=mysql_fetch_object($queryRTG))
			{
				$i++;
				$getMonth=$rowRTG->graph_month-1;
				if($i!=$numRowsRTG){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowRTG->graph_day;?>), y: <?php echo $rowRTG->demand;?> },
			{ x: new Date(<?php echo $rowRTG->graph_year.",".$getMonth.",".$rowRTG->graph_date ;?>), y: <?php echo $rowRTG->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowRTG->graph_day;?>), y: <?php echo $rowRTG->demand;?> }
			{ x: new Date(<?php echo $rowRTG->graph_year.",".$getMonth.",".$rowRTG->graph_date ;?>), y: <?php echo $rowRTG->demand;?> }
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
			while($rowSupRTG=mysql_fetch_object($querySupRTG))
			{
				$i++;
				$getMonth=$rowSupRTG->graph_month-1;
				if($i!=$numRowsSupRTG){
			?>
			{ x: new Date(<?php echo $rowSupRTG->graph_year.",".$getMonth.",".$rowSupRTG->graph_date ;?>), y: <?php echo $rowSupRTG->suply;?> },
			//{ x: new Date(<?php echo $rowSupRTG->graph_day;?>), y: <?php echo $rowSupRTG->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupRTG->graph_year.",".$getMonth.",".$rowSupRTG->graph_date ;?>), y: <?php echo $rowSupRTG->suply;?> }
			//{ x: new Date(<?php echo $rowSupRTG->graph_day;?>), y: <?php echo $rowSupRTG->suply;?> }
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
			while($rowStandRTG=mysql_fetch_object($queryStandRTG))
			{
				$i++;
				$getMonth=$rowStandRTG->graph_month-1;
				if($i!=$numRowsStandRTG){
			?>
			//{ x: new Date(<?php echo $rowStandRTG->graph_day;?>), y: <?php echo $rowStandRTG->stand_by;?> },
			{ x: new Date(<?php echo $rowStandRTG->graph_year.",".$getMonth.",".$rowStandRTG->graph_date ;?>), y: <?php echo $rowStandRTG->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStandRTG->graph_day;?>), y: <?php echo $rowStandRTG->stand_by;?> }
			{ x: new Date(<?php echo $rowStandRTG->graph_year.",".$getMonth.",".$rowStandRTG->graph_date ;?>), y: <?php echo $rowStandRTG->stand_by;?> }
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
			while($rowOutRTG=mysql_fetch_object($queryOutRTG))
			{
				$i++;
				$getMonth=$rowOutRTG->graph_month-1;
				if($i!=$numRowsOutRTG){
			?>
			//{ x: new Date(<?php echo $rowOutRTG->graph_day;?>), y: <?php echo $rowOutRTG->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutRTG->graph_year.",".$getMonth.",".$rowOutRTG->graph_date ;?>), y: <?php echo $rowOutRTG->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutRTG->graph_year.",".$getMonth.",".$rowOutRTG->graph_date ;?>), y: <?php echo $rowOutRTG->out_of_order;?> }
			//{ x: new Date(<?php echo $rowOutRTG->graph_day;?>), y: <?php echo $rowOutRTG->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartRTG.render();	 
function toggleDataSeriesRTG(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartRTG.render();
}

	 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Equipment Type QGC"
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
		itemclick: toggleDataSeries
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
			while($row=mysql_fetch_object($query))
			{
				$i++;
				$getMonth=$row->graph_month-1;
				if($i!=$numRows){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $row->graph_year.",".$getMonth.",".$row->graph_date ;?>), y: <?php echo $row->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $row->graph_year.",".$getMonth.",".$row->graph_date ;?>), y: <?php echo $row->demand;?> }
			//{ x: new Date(<?php echo $row->graph_day;?>), y: <?php echo $row->demand;?> }
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
			//$getMonth=$row->graph_month-1;
			while($rowSup=mysql_fetch_object($querySup))
			{
				$i++;
				$getMonth=$rowSup->graph_month-1;
				if($i!=$numRowsSup){
			?>
			//{ x: new Date(<?php echo $rowSup->graph_day;?>), y: <?php echo $rowSup->suply;?> },
			{ x: new Date(<?php echo $rowSup->graph_year.",".$getMonth.",".$rowSup->graph_date ;?>), y: <?php echo $rowSup->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSup->graph_day;?>), y: <?php echo $rowSup->suply;?> }
			{ x: new Date(<?php echo $rowSup->graph_year.",".$getMonth.",".$rowSup->graph_date ;?>), y: <?php echo $rowSup->suply;?> }
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
			//$getMonth=$row->graph_month-1;
			while($rowStand=mysql_fetch_object($queryStand))
			{
				$i++;
				$getMonth=$rowStand->graph_month-1;
				if($i!=$numRowsStand){
			?>
			//{ x: new Date(<?php echo $rowStand->graph_day;?>), y: <?php echo $rowStand->stand_by;?> },
			{ x: new Date(<?php echo $rowStand->graph_year.",".$getMonth.",".$rowStand->graph_date ;?>), y: <?php echo $rowStand->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStand->graph_day;?>), y: <?php echo $rowStand->stand_by;?> }
			{ x: new Date(<?php echo $rowStand->graph_year.",".$getMonth.",".$rowStand->graph_date ;?>), y: <?php echo $rowStand->stand_by;?> }
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
			
			
			while($rowOut=mysql_fetch_object($queryOut))
			{
				$i++;
				$getMonth=$rowOut->graph_month-1;
				//echo("hello : ".$getMonth);
				if($i!=$numRowsOut){
			?>
			//{ x: new Date(<?php echo $rowOut->graph_day;?>), y: <?php echo $rowOut->out_of_order;?> },
			{ x: new Date(<?php echo $rowOut->graph_year.",".$getMonth.",".$rowOut->graph_date ;?>), y: <?php echo $rowOut->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOut->graph_day;?>), y: <?php echo $rowOut->out_of_order;?> }
			{ x: new Date(<?php echo $rowOut->graph_year.",".$getMonth.",".$rowOut->graph_date ;?>), y: <?php echo $rowOut->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

var chartMHC = new CanvasJS.Chart("chartContainerMHC", {
	animationEnabled: true,
	title:{
		text: "Equipment Type MHC"
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
		itemclick: toggleDataSeriesMHC
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
			while($rowMHC=mysql_fetch_object($queryMHC))
			{
				$i++;
				$getMonth=$rowMHC->graph_month-1;
				if($i!=$numRowsMHC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowMHC->graph_day;?>), y: <?php echo $rowMHC->demand;?> },
			{ x: new Date(<?php echo $rowMHC->graph_year.",".$getMonth.",".$rowMHC->graph_date ;?>), y: <?php echo $rowMHC->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowMHC->graph_day;?>), y: <?php echo $rowMHC->demand;?> }
			{ x: new Date(<?php echo $rowMHC->graph_year.",".$getMonth.",".$rowMHC->graph_date ;?>), y: <?php echo $rowMHC->demand;?> }
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
			while($rowSupMHC=mysql_fetch_object($querySupMHC))
			{
				$i++;
				$getMonth=$rowSupMHC->graph_month-1;
				if($i!=$numRowsSupMHC){
			?>
			//{ x: new Date(<?php echo $rowSupMHC->graph_day;?>), y: <?php echo $rowSupMHC->suply;?> },
			{ x: new Date(<?php echo $rowSupMHC->graph_year.",".$getMonth.",".$rowSupMHC->graph_date ;?>), y: <?php echo $rowSupMHC->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupMHC->graph_year.",".$getMonth.",".$rowSupMHC->graph_date ;?>), y: <?php echo $rowSupMHC->suply;?> }
			//{ x: new Date(<?php echo $rowSupMHC->graph_day;?>), y: <?php echo $rowSupMHC->suply;?> }
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
			while($rowStandMHC=mysql_fetch_object($queryStandMHC))
			{
				$i++;
				$getMonth=$rowStandMHC->graph_month-1;
				if($i!=$numRowsStandMHC){
			?>
			//{ x: new Date(<?php echo $rowStandMHC->graph_day;?>), y: <?php echo $rowStandMHC->stand_by;?> },
			{ x: new Date(<?php echo $rowStandMHC->graph_year.",".$getMonth.",".$rowStandMHC->graph_date ;?>), y: <?php echo $rowStandMHC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandMHC->graph_year.",".$getMonth.",".$rowStandMHC->graph_date ;?>), y: <?php echo $rowStandMHC->stand_by;?> }
			//{ x: new Date(<?php echo $rowStandMHC->graph_day;?>), y: <?php echo $rowStandMHC->stand_by;?> }
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
			while($rowOutMHC=mysql_fetch_object($queryOutMHC))
			{
				$i++;
				$getMonth=$rowOutMHC->graph_month-1;
				if($i!=$numRowsOutMHC){
			?>
			//{ x: new Date(<?php echo $rowOutMHC->graph_day;?>), y: <?php echo $rowOutMHC->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutMHC->graph_year.",".$getMonth.",".$rowOutMHC->graph_date ;?>), y: <?php echo $rowOutMHC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutMHC->graph_year.",".$getMonth.",".$rowOutMHC->graph_date ;?>), y: <?php echo $rowOutMHC->out_of_order;?> }
			//{ x: new Date(<?php echo $rowOutMHC->graph_day;?>), y: <?php echo $rowOutMHC->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartMHC.render();	 
function toggleDataSeriesMHC(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartMHC.render();
}

var chartRMG = new CanvasJS.Chart("chartContainerRMG", {
	animationEnabled: true,
	title:{
		text: "Equipment Type RMG"
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
		itemclick: toggleDataSeriesRMG
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
			while($rowRMG=mysql_fetch_object($queryRMG))
			{
				$i++;
				$getMonth=$rowRMG->graph_month-1;
				if($i!=$numRowsRMG){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowRMG->graph_day;?>), y: <?php echo $rowRMG->demand;?> },
			{ x: new Date(<?php echo $rowRMG->graph_year.",".$getMonth.",".$rowRMG->graph_date ;?>), y: <?php echo $rowRMG->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowRMG->graph_year.",".$getMonth.",".$rowRMG->graph_date ;?>), y: <?php echo $rowRMG->demand;?> }
			//{ x: new Date(<?php echo $rowRMG->graph_day;?>), y: <?php echo $rowRMG->demand;?> }
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
			while($rowSupRMG=mysql_fetch_object($querySupRMG))
			{
				$i++;
				$getMonth=$rowSupRMG->graph_month-1;
				if($i!=$numRowsSupRMG){
			?>
			//{ x: new Date(<?php echo $rowSupRMG->graph_day;?>), y: <?php echo $rowSupRMG->suply;?> },
			{ x: new Date(<?php echo $rowSupRMG->graph_year.",".$getMonth.",".$rowSupRMG->graph_date ;?>), y: <?php echo $rowSupRMG->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupRMG->graph_year.",".$getMonth.",".$rowSupRMG->graph_date ;?>), y: <?php echo $rowSupRMG->suply;?> }
			//{ x: new Date(<?php echo $rowSupRMG->graph_day;?>), y: <?php echo $rowSupRMG->suply;?> }
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
			while($rowStandRMG=mysql_fetch_object($queryStandRMG))
			{
				$i++;
				$getMonth=$rowStandRMG->graph_month-1;
				if($i!=$numRowsStandRMG){
			?>
			{ x: new Date(<?php echo $rowStandRMG->graph_year.",".$getMonth.",".$rowStandRMG->graph_date ;?>), y: <?php echo $rowStandRMG->stand_by;?> },
			//{ x: new Date(<?php echo $rowStandRMG->graph_day;?>), y: <?php echo $rowStandRMG->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandRMG->graph_year.",".$getMonth.",".$rowStandRMG->graph_date ;?>), y: <?php echo $rowStandRMG->stand_by;?> },
			//{ x: new Date(<?php echo $rowStandRMG->graph_day;?>), y: <?php echo $rowStandRMG->stand_by;?> }
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
			while($rowOutRMG=mysql_fetch_object($queryOutRMG))
			{
				$i++;
				$getMonth=$rowOutRMG->graph_month-1;
				if($i!=$numRowsOutRMG){
			?>
			{ x: new Date(<?php echo $rowOutRMG->graph_year.",".$getMonth.",".$rowOutRMG->graph_date ;?>), y: <?php echo $rowOutRMG->out_of_order;?> },
			//{ x: new Date(<?php echo $rowOutRMG->graph_day;?>), y: <?php echo $rowOutRMG->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutRMG->graph_year.",".$getMonth.",".$rowOutRMG->graph_date ;?>), y: <?php echo $rowOutRMG->out_of_order;?> },
			//{ x: new Date(<?php echo $rowOutRMG->graph_day;?>), y: <?php echo $rowOutRMG->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartRMG.render();	 
function toggleDataSeriesRMG(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartRMG.render();
}

var chartSC = new CanvasJS.Chart("chartContainerSC", {
	animationEnabled: true,
	title:{
		text: "Equipment Type SC"
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
		itemclick: toggleDataSeriesSC
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
			while($rowSC=mysql_fetch_object($querySC))
			{
				$i++;
				$getMonth=$rowSC->graph_month-1;
				if($i!=$numRowsSC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowSC->graph_day;?>), y: <?php echo $rowSC->demand;?> },
			{ x: new Date(<?php echo $rowSC->graph_year.",".$getMonth.",".$rowSC->graph_date ;?>), y: <?php echo $rowSC->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSC->graph_day;?>), y: <?php echo $rowSC->demand;?> }
			{ x: new Date(<?php echo $rowSC->graph_year.",".$getMonth.",".$rowSC->graph_date ;?>), y: <?php echo $rowSC->demand;?> }
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
			while($rowSupSC=mysql_fetch_object($querySupSC))
			{
				$i++;
				$getMonth=$rowSupSC->graph_month-1;
				if($i!=$numRowsSupSC){
			?>
			//{ x: new Date(<?php echo $rowSupSC->graph_day;?>), y: <?php echo $rowSupSC->suply;?> },
			{ x: new Date(<?php echo $rowSupSC->graph_year.",".$getMonth.",".$rowSupSC->graph_date ;?>), y: <?php echo $rowSupSC->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSupSC->graph_day;?>), y: <?php echo $rowSupSC->suply;?> }
			{ x: new Date(<?php echo $rowSupSC->graph_year.",".$getMonth.",".$rowSupSC->graph_date ;?>), y: <?php echo $rowSupSC->suply;?> }
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
			while($rowStandSC=mysql_fetch_object($queryStandSC))
			{
				$i++;
				$getMonth=$rowStandSC->graph_month-1;
				if($i!=$numRowsStandSC){
			?>
			//{ x: new Date(<?php echo $rowStandSC->graph_day;?>), y: <?php echo $rowStandSC->stand_by;?> },
			{ x: new Date(<?php echo $rowStandSC->graph_year.",".$getMonth.",".$rowStandSC->graph_date ;?>), y: <?php echo $rowStandSC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStandSC->graph_day;?>), y: <?php echo $rowStandSC->stand_by;?> }
			{ x: new Date(<?php echo $rowStandSC->graph_year.",".$getMonth.",".$rowStandSC->graph_date ;?>), y: <?php echo $rowStandSC->stand_by;?> }
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
			while($rowOutSC=mysql_fetch_object($queryOutSC))
			{
				$i++;
				$getMonth=$rowOutSC->graph_month-1;
				if($i!=$numRowsOutSC){
			?>
			//{ x: new Date(<?php echo $rowOutSC->graph_day;?>), y: <?php echo $rowOutSC->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutSC->graph_year.",".$getMonth.",".$rowOutSC->graph_date ;?>), y: <?php echo $rowOutSC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutSC->graph_year.",".$getMonth.",".$rowOutSC->graph_date ;?>), y: <?php echo $rowOutSC->out_of_order;?> }
			//{ x: new Date(<?php echo $rowOutSC->graph_day;?>), y: <?php echo $rowOutSC->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartSC.render();	 
function toggleDataSeriesSC(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartSC.render();
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
			//{ x: new Date(<?php echo $rowFLT10->graph_day;?>), y: <?php echo $rowFLT10->demand;?> },
			{ x: new Date(<?php echo $rowFLT10->graph_year.",".$getMonth.",".$rowFLT10->graph_date ;?>), y: <?php echo $rowFLT10->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowFLT10->graph_day;?>), y: <?php echo $rowFLT10->demand;?> }
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
			//{ x: new Date(<?php echo $rowSupFLT10->graph_day;?>), y: <?php echo $rowSupFLT10->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT10->graph_year.",".$getMonth.",".$rowSupFLT10->graph_date ;?>), y: <?php echo $rowSupFLT10->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT10->graph_year.",".$getMonth.",".$rowSupFLT10->graph_date ;?>), y: <?php echo $rowSupFLT10->suply;?> }
			//{ x: new Date(<?php echo $rowSupFLT10->graph_day;?>), y: <?php echo $rowSupFLT10->suply;?> }
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
			//{ x: new Date(<?php echo $rowStandFLT10->graph_day;?>), y: <?php echo $rowStandFLT10->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT10->graph_year.",".$getMonth.",".$rowStandFLT10->graph_date ;?>), y: <?php echo $rowStandFLT10->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT10->graph_year.",".$getMonth.",".$rowStandFLT10->graph_date ;?>), y: <?php echo $rowStandFLT10->stand_by;?> }
			//{ x: new Date(<?php echo $rowStandFLT10->graph_day;?>), y: <?php echo $rowStandFLT10->stand_by;?> }
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
			//{ x: new Date(<?php echo $rowOutFLT10->graph_day;?>), y: <?php echo $rowOutFLT10->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT10->graph_year.",".$getMonth.",".$rowOutFLT10->graph_date ;?>), y: <?php echo $rowOutFLT10->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOutFLT10->graph_day;?>), y: <?php echo $rowOutFLT10->out_of_order;?> }
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

var chartRST45 = new CanvasJS.Chart("chartContainerRST45", {
	animationEnabled: true,
	title:{
		text: "Equipment Type RST 45 Ton"
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
		itemclick: toggleDataSeriesRST45
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
			while($rowRST45=mysql_fetch_object($queryRST45))
			{
				$i++;
				$getMonth=$rowRST45->graph_month-1;
				if($i!=$numRowsRST45){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowRST45->graph_day;?>), y: <?php echo $rowRST45->demand;?> },
			{ x: new Date(<?php echo $rowRST45->graph_year.",".$getMonth.",".$rowRST45->graph_date ;?>), y: <?php echo $rowRST45->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowRST45->graph_year.",".$getMonth.",".$rowRST45->graph_date ;?>), y: <?php echo $rowRST45->demand;?> }
			//{ x: new Date(<?php echo $rowRST45->graph_day;?>), y: <?php echo $rowRST45->demand;?> }
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
			while($rowSupRST45=mysql_fetch_object($querySupRST45))
			{
				$i++;
				$getMonth=$rowSupRST45->graph_month-1;
				if($i!=$numRowsSupRST45){
			?>
			//{ x: new Date(<?php echo $rowSupRST45->graph_day;?>), y: <?php echo $rowSupRST45->suply;?> },
			{ x: new Date(<?php echo $rowSupRST45->graph_year.",".$getMonth.",".$rowSupRST45->graph_date ;?>), y: <?php echo $rowSupRST45->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSupRST45->graph_day;?>), y: <?php echo $rowSupRST45->suply;?> }
			{ x: new Date(<?php echo $rowSupRST45->graph_year.",".$getMonth.",".$rowSupRST45->graph_date ;?>), y: <?php echo $rowSupRST45->suply;?> }
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
			while($rowStandRST45=mysql_fetch_object($queryStandRST45))
			{
				$i++;
				$getMonth=$rowStandRST45->graph_month-1;
				if($i!=$numRowsStandRST45){
			?>
			//{ x: new Date(<?php echo $rowStandRST45->graph_day;?>), y: <?php echo $rowStandRST45->stand_by;?> },
			{ x: new Date(<?php echo $rowStandRST45->graph_year.",".$getMonth.",".$rowStandRST45->graph_date ;?>), y: <?php echo $rowStandRST45->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandRST45->graph_year.",".$getMonth.",".$rowStandRST45->graph_date ;?>), y: <?php echo $rowStandRST45->stand_by;?> }
			//{ x: new Date(<?php echo $rowStandRST45->graph_day;?>), y: <?php echo $rowStandRST45->stand_by;?> }
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
			while($rowOutRST45=mysql_fetch_object($queryOutRST45))
			{
				$i++;
				$getMonth=$rowOutRST45->graph_month-1;
				if($i!=$numRowsOutRST45){
			?>
			//{ x: new Date(<?php echo $rowOutRST45->graph_day;?>), y: <?php echo $rowOutRST45->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutRST45->graph_year.",".$getMonth.",".$rowOutRST45->graph_date ;?>), y: <?php echo $rowOutRST45->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOutRST45->graph_day;?>), y: <?php echo $rowOutRST45->out_of_order;?> }
			{ x: new Date(<?php echo $rowOutRST45->graph_year.",".$getMonth.",".$rowOutRST45->graph_date ;?>), y: <?php echo $rowOutRST45->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});





chartRST45.render();	 
function toggleDataSeriesRST45(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartRST45.render();
} 


/*FLT 42*/
var chartFLT42 = new CanvasJS.Chart("chartContainerFLT42", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 42 Ton"
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
		itemclick: toggleDataSeriesFLT42
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
			while($rowFLT42=mysql_fetch_object($queryFLT42))
			{
				$i++;
				$getMonth=$rowFLT42->graph_month-1;
				if($i!=$numRowsFLT42){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowFLT42->graph_day;?>), y: <?php echo $rowFLT42->demand;?> },
			{ x: new Date(<?php echo $rowFLT42->graph_year.",".$getMonth.",".$rowFLT42->graph_date ;?>), y: <?php echo $rowFLT42->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowFLT42->graph_day;?>), y: <?php echo $rowFLT42->demand;?> }
			{ x: new Date(<?php echo $rowFLT42->graph_year.",".$getMonth.",".$rowFLT42->graph_date ;?>), y: <?php echo $rowFLT42->demand;?> }
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
			while($rowSupFLT42=mysql_fetch_object($querySupFLT42))
			{
				$i++;
				$getMonth=$rowSupFLT42->graph_month-1;
				if($i!=$numRowsSupFLT42){
			?>
			//{ x: new Date(<?php echo $rowSupFLT42->graph_day;?>), y: <?php echo $rowSupFLT42->suply;?> },
			{ x: new Date(<?php echo $rowSupFLT42->graph_year.",".$getMonth.",".$rowSupFLT42->graph_date ;?>), y: <?php echo $rowSupFLT42->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT42->graph_year.",".$getMonth.",".$rowSupFLT42->graph_date ;?>), y: <?php echo $rowSupFLT42->suply;?> }
			//{ x: new Date(<?php echo $rowSupFLT42->graph_day;?>), y: <?php echo $rowSupFLT42->suply;?> }
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
			while($rowStandFLT42=mysql_fetch_object($queryStandFLT42))
			{
				$i++;
				$getMonth=$rowStandFLT42->graph_month-1;
				if($i!=$numRowsStandFLT42){
			?>
			//{ x: new Date(<?php echo $rowStandFLT42->graph_day;?>), y: <?php echo $rowStandFLT42->stand_by;?> },
			{ x: new Date(<?php echo $rowStandFLT42->graph_year.",".$getMonth.",".$rowStandFLT42->graph_date ;?>), y: <?php echo $rowStandFLT42->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT42->graph_year.",".$getMonth.",".$rowStandFLT42->graph_date ;?>), y: <?php echo $rowStandFLT42->stand_by;?> }
			//{ x: new Date(<?php echo $rowStandFLT42->graph_day;?>), y: <?php echo $rowStandFLT42->stand_by;?> }
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
			while($rowOutFLT42=mysql_fetch_object($queryOutFLT42))
			{
				$i++;
				$getMonth=$rowOutFLT42->graph_month-1;
				if($i!=$numRowsOutFLT42){
			?>
			//{ x: new Date(<?php echo $rowOutFLT42->graph_day;?>), y: <?php echo $rowOutFLT42->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutFLT42->graph_year.",".$getMonth.",".$rowOutFLT42->graph_date ;?>), y: <?php echo $rowOutFLT42->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOutFLT42->graph_day;?>), y: <?php echo $rowOutFLT42->out_of_order;?> }
			{ x: new Date(<?php echo $rowOutFLT42->graph_year.",".$getMonth.",".$rowOutFLT42->graph_date ;?>), y: <?php echo $rowOutFLT42->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});





chartFLT42.render();	 
function toggleDataSeriesFLT42(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartFLT42.render();
} 
/*FLT 42*/




var chart_FLT_16_Ton = new CanvasJS.Chart("chartContainer_FLT_16_Ton", {
	animationEnabled: true,
	title:{
		text: "Equipment Type FLT 16 Ton"
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
		itemclick: toggleDataSeries_FLT_16_Ton
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
			while($row_FLT_16_Ton=mysql_fetch_object($query_FLT_16_Ton))
			{
				$i++;
				$getMonth=$row_FLT_16_Ton->graph_month-1;
				if($i!=$numRows_FLT_16_Ton){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $row_FLT_16_Ton->graph_day;?>), y: <?php echo $row_FLT_16_Ton->demand;?> },
			{ x: new Date(<?php echo $row_FLT_16_Ton->graph_year.",".$getMonth.",".$row_FLT_16_Ton->graph_date ;?>), y: <?php echo $row_FLT_16_Ton->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $row_FLT_16_Ton->graph_day;?>), y: <?php echo $row_FLT_16_Ton->demand;?> }
			{ x: new Date(<?php echo $row_FLT_16_Ton->graph_year.",".$getMonth.",".$row_FLT_16_Ton->graph_date ;?>), y: <?php echo $row_FLT_16_Ton->demand;?> }
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
			while($rowSup_FLT_16_Ton=mysql_fetch_object($querySup_FLT_16_Ton))
			{
				$i++;
				$getMonth=$rowSup_FLT_16_Ton->graph_month-1;
				if($i!=$numRowsSup_FLT_16_Ton){
			?>
			//{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_day;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> },
			{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_year.",".$getMonth.",".$rowSup_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_day;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> }
			{ x: new Date(<?php echo $rowSup_FLT_16_Ton->graph_year.",".$getMonth.",".$rowSup_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowSup_FLT_16_Ton->suply;?> }
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
			while($rowStand_FLT_16_Ton=mysql_fetch_object($queryStand_FLT_16_Ton))
			{
				$i++;
				$getMonth=$rowStand_FLT_16_Ton->graph_month-1;
				if($i!=$numRowsStand_FLT_16_Ton){
			?>
			//{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_day;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> },
			{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_year.",".$getMonth.",".$rowStand_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_day;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> }#
			{ x: new Date(<?php echo $rowStand_FLT_16_Ton->graph_year.",".$getMonth.",".$rowStand_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowStand_FLT_16_Ton->stand_by;?> }
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
			while($rowOut_FLT_16_Ton=mysql_fetch_object($queryOut_FLT_16_Ton))
			{
				$i++;
				$getMonth=$rowOut_FLT_16_Ton->graph_month-1;
				if($i!=$numRowsOut_FLT_16_Ton){
			?>
			//{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_day;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> },
			{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_year.",".$getMonth.",".$rowOut_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_day;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> }
			{ x: new Date(<?php echo $rowOut_FLT_16_Ton->graph_year.",".$getMonth.",".$rowOut_FLT_16_Ton->graph_date ;?>), y: <?php echo $rowOut_FLT_16_Ton->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chart_FLT_16_Ton.render();	 
function toggleDataSeries_FLT_16_Ton(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart_FLT_16_Ton.render();
}



 //////////////////////
var chart_RST_7_Ton = new CanvasJS.Chart("chartContainer_RST_7_Ton", {
	animationEnabled: true,
	title:{
		text: "Equipment Type RST 7 Ton"
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
		itemclick: toggleDataSeries_RST_7_Ton
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
			while($row_RST_7_Ton=mysql_fetch_object($query_RST_7_Ton))
			{
				$i++;
				$getMonth=$row_RST_7_Ton->graph_month-1;
				if($i!=$numRows_RST_7_Ton){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $row_RST_7_Ton->graph_day;?>), y: <?php echo $row_RST_7_Ton->demand;?> },
			{ x: new Date(<?php echo $row_RST_7_Ton->graph_year.",".$getMonth.",".$row_RST_7_Ton->graph_date ;?>), y: <?php echo $row_RST_7_Ton->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $row_RST_7_Ton->graph_day;?>), y: <?php echo $row_RST_7_Ton->demand;?> }
			{ x: new Date(<?php echo $row_RST_7_Ton->graph_year.",".$getMonth.",".$row_RST_7_Ton->graph_date ;?>), y: <?php echo $row_RST_7_Ton->demand;?> }
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
			while($rowSup_RST_7_Ton=mysql_fetch_object($querySup_RST_7_Ton))
			{
				$i++;
				$getMonth=$rowSup_RST_7_Ton->graph_month-1;
				if($i!=$numRowsSup_RST_7_Ton){
			?>
			//{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_day;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> },
			{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_year.",".$getMonth.",".$rowSup_RST_7_Ton->graph_date ;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_day;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> }
			{ x: new Date(<?php echo $rowSup_RST_7_Ton->graph_year.",".$getMonth.",".$rowSup_RST_7_Ton->graph_date ;?>), y: <?php echo $rowSup_RST_7_Ton->suply;?> }
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
			while($rowStand_RST_7_Ton=mysql_fetch_object($queryStand_RST_7_Ton))
			{
				$i++;
				$getMonth=$rowStand_RST_7_Ton->graph_month-1;
				if($i!=$numRowsStand_RST_7_Ton){
			?>
			//{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_day;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> },
			{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_year.",".$getMonth.",".$rowStand_RST_7_Ton->graph_date ;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_day;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> }
			{ x: new Date(<?php echo $rowStand_RST_7_Ton->graph_year.",".$getMonth.",".$rowStand_RST_7_Ton->graph_date ;?>), y: <?php echo $rowStand_RST_7_Ton->stand_by;?> }
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
			while($rowOut_RST_7_Ton=mysql_fetch_object($queryOut_RST_7_Ton))
			{
				$i++;
				$getMonth=$rowOut_RST_7_Ton->graph_month-1;
				if($i!=$numRowsOut_RST_7_Ton){
			?>
			//{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_day;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> },
			{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_year.",".$getMonth.",".$rowOut_RST_7_Ton->graph_date ;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_day;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> }
			{ x: new Date(<?php echo $rowOut_RST_7_Ton->graph_year.",".$getMonth.",".$rowOut_RST_7_Ton->graph_date ;?>), y: <?php echo $rowOut_RST_7_Ton->out_of_order;?> },
			<?php
			}
			}
			?>
		]
	}]
});

chart_RST_7_Ton.render();	 
function toggleDataSeries_RST_7_Ton(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart_RST_7_Ton.render();
}
/*CM*/
var chartCM = new CanvasJS.Chart("chartContainerCM", {
	animationEnabled: true,
	title:{
		text: "Equipment Type CM"
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
		itemclick: toggleDataSeriesCM
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
			while($rowCM=mysql_fetch_object($queryCM))
			{
				$i++;
				$getMonth=$rowCM->graph_month-1;
				if($i!=$numRowsCM){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			//{ x: new Date(<?php echo $rowCM->graph_day;?>), y: <?php echo $rowCM->demand;?> },
			{ x: new Date(<?php echo $rowCM->graph_year.",".$getMonth.",".$rowCM->graph_date ;?>), y: <?php echo $rowCM->demand;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowCM->graph_day;?>), y: <?php echo $rowCM->demand;?> }
			{ x: new Date(<?php echo $rowCM->graph_year.",".$getMonth.",".$rowCM->graph_date ;?>), y: <?php echo $rowCM->demand;?> }
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
			while($rowSupCM=mysql_fetch_object($querySupCM))
			{
				$i++;
				$getMonth=$rowSupCM->graph_month-1;
				if($i!=$numRowsSupCM){
			?>
			//{ x: new Date(<?php echo $rowSupCM->graph_day;?>), y: <?php echo $rowSupCM->suply;?> },
			{ x: new Date(<?php echo $rowSupCM->graph_year.",".$getMonth.",".$rowSupCM->graph_date ;?>), y: <?php echo $rowSupCM->suply;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowSupCM->graph_day;?>), y: <?php echo $rowSupCM->suply;?> }
			{ x: new Date(<?php echo $rowSupCM->graph_year.",".$getMonth.",".$rowSupCM->graph_date ;?>), y: <?php echo $rowSupCM->suply;?> }
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
			while($rowStandCM=mysql_fetch_object($queryStandCM))
			{
				$i++;
				$getMonth=$rowStandCM->graph_month-1;
				if($i!=$numRowsStandCM){
			?>
			//{ x: new Date(<?php echo $rowStandCM->graph_day;?>), y: <?php echo $rowStandCM->stand_by;?> },
			{ x: new Date(<?php echo $rowStandCM->graph_year.",".$getMonth.",".$rowStandCM->graph_date ;?>), y: <?php echo $rowStandCM->stand_by;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowStandCM->graph_day;?>), y: <?php echo $rowStandCM->stand_by;?> }
			{ x: new Date(<?php echo $rowStandCM->graph_year.",".$getMonth.",".$rowStandCM->graph_date ;?>), y: <?php echo $rowStandCM->stand_by;?> },
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
			while($rowOutCM=mysql_fetch_object($queryOutCM))
			{
				$i++;
				$getMonth=$rowOutCM->graph_month-1;
				if($i!=$numRowsOutCM){
			?>
			//{ x: new Date(<?php echo $rowOutCM->graph_day;?>), y: <?php echo $rowOutCM->out_of_order;?> },
			{ x: new Date(<?php echo $rowOutCM->graph_year.",".$getMonth.",".$rowOutCM->graph_date ;?>), y: <?php echo $rowOutCM->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			//{ x: new Date(<?php echo $rowOutCM->graph_day;?>), y: <?php echo $rowOutCM->out_of_order;?> }
			{ x: new Date(<?php echo $rowOutCM->graph_year.",".$getMonth.",".$rowOutCM->graph_date ;?>), y: <?php echo $rowOutCM->out_of_order;?> }
			<?php
			}
			}
			?>
		]
	}]
});

chartCM.render();	 
function toggleDataSeriesCM(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chartCM.render();
}
/*CM*/

}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>