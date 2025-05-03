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
					//FLT 20 - start
					$strQueryFLT20 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT20 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT20 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT20 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 20 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					
					$queryFLT20=mysql_query($strQueryFLT20);
					$querySupFLT20=mysql_query($strQuerySupFLT20);
					$queryOutFLT20=mysql_query($strQueryOutFLT20);
					$queryStandFLT20=mysql_query($strQueryStandFLT20);
					
					$numRowsFLT20 = mysql_num_rows($queryFLT20);
					$numRowsSupFLT20 = mysql_num_rows($querySupFLT20);
					$numRowsOutFLT20 = mysql_num_rows($queryOutFLT20);
					$numRowsStandFLT20 = mysql_num_rows($queryStandFLT20);
					//FLT 20 - end
					
					//RRC 05 - start
					$strQueryRRC = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupRRC = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutRRC = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandRRC = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'RRC 05 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryFLT03 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT03 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT03 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT03 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 03 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryFLT1p5 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupFLT1p5 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutFLT1p5 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandFLT1p5 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'FLT 1.5 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryTR25 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupTR25 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutTR25 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandTR25 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tractor 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryHT25 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupHT25 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutHT25 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandHT25 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Heavy Trailer 25 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryLT06 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupLT06 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutLT06 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandLT06 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Light Trailer 06 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryCC = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupCC = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutCC = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandCC = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Car Carrier') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					$strQueryTH04 = "SELECT IFNULL(demand,0) AS demand,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";					
					$strQuerySupTH04 = "SELECT IFNULL(supply,0) AS suply,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryOutTH04 = "SELECT IFNULL(out_of_order,0) AS out_of_order,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
							ORDER BY a + b
					) AS mytable ORDER BY dt) AS tbl";
					$strQueryStandTH04 = "SELECT IFNULL(stand_by,0) AS stand_by,graph_day FROM
					(
					SELECT 
					(SELECT SUM(demand) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS demand,
					(SELECT SUM(supply) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS supply,
					(SELECT SUM(stand_by) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS stand_by,
					(SELECT SUM(out_of_order) FROM ctmsmis.equip_for_cargo_handling WHERE DATE(update_time)=DATE(mytable.dt) AND equip_type = 'Tele Handler 04 Ton') AS out_of_order,
					DATE_FORMAT(DATE_ADD(dt, INTERVAL -1 MONTH), '%Y,%m,%d') AS graph_day
					FROM (
						SELECT CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY dt
						FROM
						(SELECT 0 a UNION SELECT 1 a UNION SELECT 2 UNION SELECT 3
							UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
							UNION SELECT 8 UNION SELECT 9 ) d,
						(SELECT 0 b UNION SELECT 10 UNION SELECT 20
							UNION SELECT 30 UNION SELECT 40) m
						WHERE CONCAT(YEAR(NOW()),'-',MONTH(NOW()),'-01') + INTERVAL a + b DAY  <= LAST_DAY(DATE(NOW()))
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
					?>
				<div class="row">
					<div id="chartContainerFLT20" style="height: 200px; width: 90%;">
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
				</div>
				</div>
			</div>
		</div>
		
	</body>
	<script>
	 window.onload = function () {
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
				
				if($i!=$numRowsRRC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowRRC->graph_day;?>), y: <?php echo $rowRRC->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowRRC->graph_day;?>), y: <?php echo $rowRRC->demand;?> }
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
				if($i!=$numRowsSupRRC){
			?>
			{ x: new Date(<?php echo $rowSupRRC->graph_day;?>), y: <?php echo $rowSupRRC->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupRRC->graph_day;?>), y: <?php echo $rowSupRRC->suply;?> }
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
				if($i!=$numRowsStandRRC){
			?>
			{ x: new Date(<?php echo $rowStandRRC->graph_day;?>), y: <?php echo $rowStandRRC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandRRC->graph_day;?>), y: <?php echo $rowStandRRC->stand_by;?> }
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
				if($i!=$numRowsOutRRC){
			?>
			{ x: new Date(<?php echo $rowOutRRC->graph_day;?>), y: <?php echo $rowOutRRC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutRRC->graph_day;?>), y: <?php echo $rowOutRRC->out_of_order;?> }
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
				
				if($i!=$numRowsFLT03){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowFLT03->graph_day;?>), y: <?php echo $rowFLT03->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT03->graph_day;?>), y: <?php echo $rowFLT03->demand;?> }
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
				if($i!=$numRowsSupFLT03){
			?>
			{ x: new Date(<?php echo $rowSupFLT03->graph_day;?>), y: <?php echo $rowSupFLT03->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT03->graph_day;?>), y: <?php echo $rowSupFLT03->suply;?> }
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
				if($i!=$numRowsStandFLT03){
			?>
			{ x: new Date(<?php echo $rowStandFLT03->graph_day;?>), y: <?php echo $rowStandFLT03->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT03->graph_day;?>), y: <?php echo $rowStandFLT03->stand_by;?> }
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
				if($i!=$numRowsOutFLT03){
			?>
			{ x: new Date(<?php echo $rowOutFLT03->graph_day;?>), y: <?php echo $rowOutFLT03->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT03->graph_day;?>), y: <?php echo $rowOutFLT03->out_of_order;?> }
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
				
				if($i!=$numRowsFLT1p5){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowFLT1p5->graph_day;?>), y: <?php echo $rowFLT1p5->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT1p5->graph_day;?>), y: <?php echo $rowFLT1p5->demand;?> }
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
				if($i!=$numRowsSupFLT1p5){
			?>
			{ x: new Date(<?php echo $rowSupFLT1p5->graph_day;?>), y: <?php echo $rowSupFLT1p5->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT1p5->graph_day;?>), y: <?php echo $rowSupFLT1p5->suply;?> }
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
				if($i!=$numRowsStandFLT1p5){
			?>
			{ x: new Date(<?php echo $rowStandFLT1p5->graph_day;?>), y: <?php echo $rowStandFLT1p5->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT1p5->graph_day;?>), y: <?php echo $rowStandFLT1p5->stand_by;?> }
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
				if($i!=$numRowsOutFLT1p5){
			?>
			{ x: new Date(<?php echo $rowOutFLT1p5->graph_day;?>), y: <?php echo $rowOutFLT1p5->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT1p5->graph_day;?>), y: <?php echo $rowOutFLT1p5->out_of_order;?> }
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
				
				if($i!=$numRowsTR25){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowTR25->graph_day;?>), y: <?php echo $rowTR25->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowTR25->graph_day;?>), y: <?php echo $rowTR25->demand;?> }
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
				if($i!=$numRowsSupTR25){
			?>
			{ x: new Date(<?php echo $rowSupTR25->graph_day;?>), y: <?php echo $rowSupTR25->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupTR25->graph_day;?>), y: <?php echo $rowSupTR25->suply;?> }
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
				if($i!=$numRowsStandTR25){
			?>
			{ x: new Date(<?php echo $rowStandTR25->graph_day;?>), y: <?php echo $rowStandTR25->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandTR25->graph_day;?>), y: <?php echo $rowStandTR25->stand_by;?> }
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
				if($i!=$numRowsOutTR25){
			?>
			{ x: new Date(<?php echo $rowOutTR25->graph_day;?>), y: <?php echo $rowOutTR25->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutTR25->graph_day;?>), y: <?php echo $rowOutTR25->out_of_order;?> }
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
				
				if($i!=$numRowsHT25){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowHT25->graph_day;?>), y: <?php echo $rowHT25->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowHT25->graph_day;?>), y: <?php echo $rowHT25->demand;?> }
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
				if($i!=$numRowsSupHT25){
			?>
			{ x: new Date(<?php echo $rowSupHT25->graph_day;?>), y: <?php echo $rowSupHT25->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupHT25->graph_day;?>), y: <?php echo $rowSupHT25->suply;?> }
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
				if($i!=$numRowsStandHT25){
			?>
			{ x: new Date(<?php echo $rowStandHT25->graph_day;?>), y: <?php echo $rowStandHT25->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandHT25->graph_day;?>), y: <?php echo $rowStandHT25->stand_by;?> }
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
				if($i!=$numRowsOutHT25){
			?>
			{ x: new Date(<?php echo $rowOutHT25->graph_day;?>), y: <?php echo $rowOutHT25->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutHT25->graph_day;?>), y: <?php echo $rowOutHT25->out_of_order;?> }
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
				
				if($i!=$numRowsLT06){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowLT06->graph_day;?>), y: <?php echo $rowLT06->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowLT06->graph_day;?>), y: <?php echo $rowLT06->demand;?> }
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
				if($i!=$numRowsSupLT06){
			?>
			{ x: new Date(<?php echo $rowSupLT06->graph_day;?>), y: <?php echo $rowSupLT06->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupLT06->graph_day;?>), y: <?php echo $rowSupLT06->suply;?> }
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
				if($i!=$numRowsStandLT06){
			?>
			{ x: new Date(<?php echo $rowStandLT06->graph_day;?>), y: <?php echo $rowStandLT06->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandLT06->graph_day;?>), y: <?php echo $rowStandLT06->stand_by;?> }
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
				if($i!=$numRowsOutLT06){
			?>
			{ x: new Date(<?php echo $rowOutLT06->graph_day;?>), y: <?php echo $rowOutLT06->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutLT06->graph_day;?>), y: <?php echo $rowOutLT06->out_of_order;?> }
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
				
				if($i!=$numRowsCC){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowCC->graph_day;?>), y: <?php echo $rowCC->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowCC->graph_day;?>), y: <?php echo $rowCC->demand;?> }
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
				if($i!=$numRowsSupCC){
			?>
			{ x: new Date(<?php echo $rowSupCC->graph_day;?>), y: <?php echo $rowSupCC->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupCC->graph_day;?>), y: <?php echo $rowSupCC->suply;?> }
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
				if($i!=$numRowsStandCC){
			?>
			{ x: new Date(<?php echo $rowStandCC->graph_day;?>), y: <?php echo $rowStandCC->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandCC->graph_day;?>), y: <?php echo $rowStandCC->stand_by;?> }
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
				if($i!=$numRowsOutCC){
			?>
			{ x: new Date(<?php echo $rowOutCC->graph_day;?>), y: <?php echo $rowOutCC->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutCC->graph_day;?>), y: <?php echo $rowOutCC->out_of_order;?> }
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
				
				if($i!=$numRowsTH04){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowTH04->graph_day;?>), y: <?php echo $rowTH04->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowTH04->graph_day;?>), y: <?php echo $rowTH04->demand;?> }
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
				if($i!=$numRowsSupTH04){
			?>
			{ x: new Date(<?php echo $rowSupTH04->graph_day;?>), y: <?php echo $rowSupTH04->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupTH04->graph_day;?>), y: <?php echo $rowSupTH04->suply;?> }
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
				if($i!=$numRowsStandTH04){
			?>
			{ x: new Date(<?php echo $rowStandTH04->graph_day;?>), y: <?php echo $rowStandTH04->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandTH04->graph_day;?>), y: <?php echo $rowStandTH04->stand_by;?> }
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
				if($i!=$numRowsOutTH04){
			?>
			{ x: new Date(<?php echo $rowOutTH04->graph_day;?>), y: <?php echo $rowOutTH04->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutTH04->graph_day;?>), y: <?php echo $rowOutTH04->out_of_order;?> }
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
				
				if($i!=$numRowsFLT20){
			?>
			//alert(<?php echo $i."==".$numRows; ?>);
			{ x: new Date(<?php echo $rowFLT20->graph_day;?>), y: <?php echo $rowFLT20->demand;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowFLT20->graph_day;?>), y: <?php echo $rowFLT20->demand;?> }
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
				if($i!=$numRowsSupFLT20){
			?>
			{ x: new Date(<?php echo $rowSupFLT20->graph_day;?>), y: <?php echo $rowSupFLT20->suply;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowSupFLT20->graph_day;?>), y: <?php echo $rowSupFLT20->suply;?> }
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
				if($i!=$numRowsStandFLT20){
			?>
			{ x: new Date(<?php echo $rowStandFLT20->graph_day;?>), y: <?php echo $rowStandFLT20->stand_by;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowStandFLT20->graph_day;?>), y: <?php echo $rowStandFLT20->stand_by;?> }
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
				if($i!=$numRowsOutFLT20){
			?>
			{ x: new Date(<?php echo $rowOutFLT20->graph_day;?>), y: <?php echo $rowOutFLT20->out_of_order;?> },
			<?php
			}
			else
			{
			?>
			{ x: new Date(<?php echo $rowOutFLT20->graph_day;?>), y: <?php echo $rowOutFLT20->out_of_order;?> }
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

}

	</script>
	<?php mysql_close($con_sparcsn4); ?>
</html>