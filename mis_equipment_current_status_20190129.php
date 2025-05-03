<?php
	include("mydbPConnectionctmsmis.php");
	?>
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
			<table width="90%" border ='0' cellpadding='0' cellspacing='0'>
				<tr bgcolor="#ffffff" align="center" height="100px">
					<td colspan="13" align="center">
						<table border=0 width="100%">				
							<tr align="center">
								<td colspan="12"><font size="4"><b><u>STATEMENT OF BOOKED EQUIPMENT UNDER ZONE- AB,C & D at </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></u></font></td>
							</tr>
						</table>				
					</td>	
				</tr>
			</table>
	
			
	<table width="90%" border ='1' cellpadding='0' cellspacing='0' >
	
	<tr align="center">
		<td rowspan=2 colspan=3>EQUIPMENT</td>
		<td colspan=4>ZONE-AB</td>
		<td colspan=9>ZONE-C</td>
		<td colspan=4>ZONE-D</td>
		<td rowspan=2>TOTAL</td>
	</tr>
	<tr align="center">			
		<td>Y-JR</td>
		<td>Y-AB</td>
		<td>D-REEFER</td>
		<td>Y-7</td>
		<td>Y-1,2,MN</td>
		<td>Y-3</td>
		<td>Y-5</td>
		<td>Y-6</td>
		<!--td>Y-8</td-->
		<td>Y-8B</td>
		<td>Y-8,BAPEX</td>
		<td>Y-9,10</td>
		<td>Y-11</td>
		<td>NCY</td>
		<td>CCT</td>
		<td>NCT</td>
		<td>ICD</td>
		<td>NOFCY</td>
	</tr>

	<?php
		
		$qgc_cct_tot=0;
		$qgc_nct_tot=0;
		$tot_qgc_booked=0;
		
		$rtg_cct_tot=0;
		$rtg_nct_tot=0;
		$tot_rtg_booked=0;
		
		$mhc_cct_tot=0;
		$mhc_nct_tot=0;
		$tot_mhc_booked=0;
		
		$rmg_cct_tot=0;
		$rmg_nct_tot=0;
		$tot_rmg_booked=0;
		
		$sc_cct_tot=0;
		$sc_nct_tot=0;
		$sc_nofcy_tot=0;
		$sc_icd_tot=0;
		$tot_sc_booked=0;
		
		$flt42_cct_tot=0;
		$flt42_nct_tot=0;
		$flt42_nofcy_tot=0;
		$flt42_icd_tot=0;
		$tot_flt42_booked=0;
		
		//QGC supply - start
		// $qgc_cct="SELECT COUNT(DISTINCT equipement) AS tot_qgc_cct_booked FROM (
		// SELECT *,IF(yard ='CCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		// (SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		// FROM sparcsn4.xps_che 
		// INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		// WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		// WHERE yard IS NOT NULL ORDER BY equipement
		// ) AS t1 WHERE sl=1 AND equipement LIKE 'QGC%'";
		
		// $row_qgc_cct=mysql_query($qgc_cct);
		// $rtn_qgc_cct=mysql_fetch_object($row_qgc_cct);
		
		// $qgc_nct="SELECT COUNT(DISTINCT equipement) AS tot_qgc_nct_booked FROM (
		// SELECT *,IF(yard ='NCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		// (SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		// FROM sparcsn4.xps_che 
		// INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		// WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		// WHERE yard IS NOT NULL ORDER BY equipement
		// ) AS t1 WHERE sl=1 AND equipement LIKE 'QGC%'";
		
		// $row_qgc_nct=mysql_query($qgc_nct);
		// $rtn_qgc_nct=mysql_fetch_object($row_qgc_nct);
		
		$qgc_query="SELECT yard,if(yard='NCT',SUM(yard_tot)-4,SUM(yard_tot)) AS tot FROM (
		SELECT 
		(CASE WHEN  xps_che.short_name IN ('QGC01','QGC02','QGC03','QGC04')  THEN 'CCT' 
		ELSE 'NCT' END) AS yard,
		(CASE WHEN  xps_che.short_name IN ('QGC01','QGC02','QGC03','QGC04')  THEN 1  
		ELSE 1 END) AS yard_tot
		FROM sparcsn4.xps_che 
		WHERE  xps_che.short_name LIKE 'Q%') AS tbl
		GROUP BY yard";
		
		$row_qgc_query=mysql_query($qgc_query);
	//	$rtn_qgc_query=mysql_fetch_object($row_qgc_query);
		
		while($rtn_qgc_query=mysql_fetch_object($row_qgc_query))
		{
			if($rtn_qgc_query->yard=="CCT")
				$qgc_cct_tot=$rtn_qgc_query->tot;
			else if($rtn_qgc_query->yard=="NCT")
				$qgc_nct_tot=$rtn_qgc_query->tot;
		}
		
	//	$qgc_cct_tot=$rtn_qgc_cct->tot_qgc_cct_booked;
	//	$qgc_nct_tot=$rtn_qgc_nct->tot_qgc_nct_booked;
		
		$tot_qgc_booked= $qgc_cct_tot+$qgc_nct_tot;
		
		//QGC supply - end
		
		//RTG supply - start
		$rtg_cct="SELECT count(distinct equipement) AS tot_rtg_cct_booked FROM (
		SELECT *,IF(yard ='CCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'RTG%'";
		
		$row_rtg_cct=mysql_query($rtg_cct);
		$rtn_rtg_cct=mysql_fetch_object($row_rtg_cct);
		
		$rtg_nct="SELECT count(distinct equipement) AS tot_rtg_nct_booked FROM (
		SELECT *,IF(yard ='NCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'RTG%'";
		$row_rtg_nct=mysql_query($rtg_nct);
		$rtn_rtg_nct=mysql_fetch_object($row_rtg_nct);
		
		$rtg_cct_tot=$rtn_rtg_cct->tot_rtg_cct_booked;
		$rtg_nct_tot=$rtn_rtg_nct->tot_rtg_nct_booked;
		
		$tot_rtg_booked= $rtg_cct_tot+$rtg_nct_tot;
		
		//RTG supply - end
		
		//MHC supply - start
		$mhc_query="SELECT yard,SUM(yard_tot) AS tot FROM (
		SELECT 
		(CASE WHEN  xps_che.short_name IN ('MHC01')  THEN 'NCT' 
		ELSE 'CCT' END) AS yard,
		(CASE WHEN  xps_che.short_name IN ('MHC01')  THEN 1  
		ELSE 1 END) AS yard_tot
		FROM sparcsn4.xps_che 
		WHERE  xps_che.short_name LIKE 'MHC%') AS tbl
		GROUP BY yard";
		
		$row_mhc_query=mysql_query($mhc_query);
	//	$rtn_qgc_query=mysql_fetch_object($row_qgc_query);
		
		while($rtn_mhc_query=mysql_fetch_object($row_mhc_query))
		{
			if($rtn_mhc_query->yard=="CCT")
				$mhc_cct_tot=$rtn_mhc_query->tot;
			else if($rtn_mhc_query->yard=="NCT")
				$mhc_nct_tot=$rtn_mhc_query->tot;
		}
		
		
		//$mhc_cct_tot=$rtn_mhc_cct->tot_mhc_cct_booked;
		//$mhc_nct_tot=$rtn_mhc_nct->tot_mhc_nct_booked;
		
		$tot_mhc_booked= $mhc_cct_tot+$mhc_nct_tot;
		//MHC supply - end

		//RMG supply - start
		$rmg_cct="SELECT count(distinct equipement) AS tot_rmg_cct_booked FROM (
		SELECT *,IF(yard ='CCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'RMG%'";
		$row_rmg_cct=mysql_query($rmg_cct);
		$rtn_rmg_cct=mysql_fetch_object($row_rmg_cct);
		
		$rmg_nct="SELECT count(distinct equipement) AS tot_rmg_nct_booked FROM (
		SELECT *,IF(yard ='NCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'RMG%'";
		$row_rmg_nct=mysql_query($rmg_nct);
		$rtn_rmg_nct=mysql_fetch_object($row_rmg_nct);
		
		$rmg_icd="SELECT count(distinct equipement) AS tot_rmg_icd_booked FROM (
		SELECT *,IF(yard ='ICD',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'RMG%'";
		$row_rmg_icd=mysql_query($rmg_icd);
		$rtn_rmg_icd=mysql_fetch_object($row_rmg_icd);
		
		$rmg_cct_tot=$rtn_rmg_cct->tot_rmg_cct_booked;
		$rmg_nct_tot=$rtn_rmg_nct->tot_rmg_nct_booked;
		$rmg_icd_tot=$rtn_rmg_icd->tot_rmg_icd_booked;
		
		$tot_rmg_booked= $rmg_cct_tot+$rmg_nct_tot+$rmg_icd_tot;
		
		
		$sc_icd="SELECT COUNT(DISTINCT short_name) AS icd_sc 
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'SC%' AND yard_block.block IN ('CSE','CSF')";
		$row_sc_icd=mysql_query($sc_icd);
		$rtn_sc_icd=mysql_fetch_object($row_sc_icd);
		$sc_icd_tot=$rtn_sc_icd->icd_sc;
		
		$sc_nct="SELECT COUNT(DISTINCT short_name) AS nct_sc 
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'SC%' and yard_block.terminal='NCT'";
		$row_sc_nct=mysql_query($sc_nct);
		$rtn_sc_nct=mysql_fetch_object($row_sc_nct);
		$sc_nct_tot=$rtn_sc_nct->nct_sc;
		
		$sc_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_sc
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'SC%' AND yard_block.terminal IN ('NOFCY')";
		$row_sc_nofcy=mysql_query($sc_nofcy);
		$rtn_sc_nofcy=mysql_fetch_object($row_sc_nofcy);
		$sc_nofcy_tot=$rtn_sc_nofcy->nofcy_sc;
		
		$sc_cct="SELECT count(distinct equipement) AS tot_sc_cct_booked FROM (
		SELECT *,IF(yard ='CCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'SC%' AND block NOT IN ('CSE','CSF')";

		$row_sc_cct=mysql_query($sc_cct);
		$rtn_sc_cct=mysql_fetch_object($row_sc_cct);
		$sc_cct_tot=$rtn_sc_cct->tot_sc_cct_booked;
		
		
		
		$tot_sc_booked= $sc_nct_tot+$sc_cct_tot+$sc_nofcy_tot+$sc_icd_tot;
		
		// FLT 42 START
		$flt42_icd="SELECT COUNT(DISTINCT short_name) AS icd_flt42 
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'FLT42%' AND yard_block.block IN ('CSE','CSF')";
		$row_flt42_icd=mysql_query($flt42_icd);
		$rtn_flt42_icd=mysql_fetch_object($row_flt42_icd);
		$flt42_icd_tot=$rtn_flt42_icd->icd_flt42;
		
		$flt42_nct="SELECT COUNT(DISTINCT short_name) AS nct_flt42 
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'FLT42%' and yard_block.terminal='NCT'";
		$row_flt42_nct=mysql_query($flt42_nct);
		$rtn_flt42_nct=mysql_fetch_object($row_flt42_nct);
		$flt42_nct_tot=$rtn_flt42_nct->nct_flt42;
		
		$flt42_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_flt42
		FROM sparcsn4.xps_che
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id  
		INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
		WHERE short_name LIKE 'FLT42%' AND yard_block.terminal IN ('NOFCY')";
		$row_flt42_nofcy=mysql_query($flt42_nofcy);
		$rtn_flt42_nofcy=mysql_fetch_object($row_flt42_nofcy);
		$flt42_nofcy_tot=$rtn_flt42_nofcy->nofcy_flt42;
		
		$flt42_cct="SELECT count(distinct equipement) AS tot_flt42_cct_booked FROM (
		SELECT *,IF(yard ='CCT',1,2) AS sl FROM ( SELECT DISTINCT sel_block Block,short_name equipement, 
		(SELECT ctmsmis.yard_block.terminal FROM ctmsmis.yard_block WHERE ctmsmis.yard_block.block=sel_block) AS yard 
		FROM sparcsn4.xps_che 
		INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id 
		WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'SP%') AS tbl 
		WHERE yard IS NOT NULL ORDER BY equipement
		) AS t1 WHERE sl=1 AND equipement LIKE 'FLT42%' AND block NOT IN ('CSE','CSF')";

		$row_flt42_cct=mysql_query($flt42_cct);
		$rtn_flt42_cct=mysql_fetch_object($row_flt42_cct);
		$flt42_cct_tot=$rtn_flt42_cct->tot_flt42_cct_booked;
		
		
		
		$tot_flt42_booked= $flt42_nct_tot+$flt42_cct_tot+$flt42_nofcy_tot+$flt42_icd_tot;
		
		
		// FLT 42 END
		
		
		
		//RMG demand - end
		
		$equipArray= Array();
		
		$tot_equip_sc=0;
		$tot_equip_sc_ab=0;
		$tot_equip_sc_c=0;
		$tot_equip_sc_d=0;
		
		$tot_equip_rst45=0;
		$tot_equip_rst45_ab=0;
		$tot_equip_rst45_c=0;
		
		$tot_equip_flt42=0;
		$tot_equip_flt42_ab=0;
		$tot_equip_flt42_c=0;
		$tot_equip_flt42_d=0;
		
		
		
		$tot_equip_flt16=0;
		$tot_equip_flt16_ab=0;
		$tot_equip_flt16_c=0;
		
		$tot_equip_rst7=0;
		$tot_equip_rst7_ab=0;
		$tot_equip_rst7_c=0;
		
		$tot_equip_flt10=0;
		$tot_equip_flt10_ab=0;
		$tot_equip_flt10_c=0;
		
		$tot_equip_cm=0;
		$tot_equip_cm_ab=0;
		$tot_equip_cm_c=0;
	?>
	<!-- QGC -->
	<tr align="center">
		<td rowspan="2"> 1 </td>
		<td rowspan="2">QGC</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">			
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			
		?>
		<td>Supplied</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php if($qgc_cct_tot!=0) echo $qgc_cct_tot; ?></td>
		<td><?php if($qgc_nct_tot!=0) echo $qgc_nct_tot; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php if($tot_qgc_booked!=0) echo $tot_qgc_booked; ?></td>
		
	</tr>
	<!-- RTG -->
	<tr align="center">		
		<td rowspan="2"> 2 </td>
		<td rowspan="2">RTG</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RTG%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RTG%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RTG%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RTG%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RTG%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RTG%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RTG%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RTG%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RTG%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RTG%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RTG%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RTG%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RTG%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RTG%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RTG%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RTG%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RTG%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">			
		<td>Supplied</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $rtg_cct_tot; ?></td>
		<td><?php echo $rtg_nct_tot; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $tot_rtg_booked; ?></td>
		
	</tr>
	<!-- MHC -->
	<tr align="center">		
		<td rowspan="2"> 3 </td>
		<td rowspan="2">MHC</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'MHC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'MHC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'MHC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'MHC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'MHC%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'MHC%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'MHC%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'MHC%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'MHC%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'MHC%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'MHC%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'MHC%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'MHC%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'MHC%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'MHC%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'MHC%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'MHC%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">			
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				/*$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;*/
			}
		?>
		<td>Supplied</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php if($mhc_cct_tot!=0) echo $mhc_cct_tot; ?></td>
		<td><?php if($mhc_nct_tot!=0) echo $mhc_nct_tot; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php if($tot_mhc_booked!=0) echo $tot_mhc_booked; ?></td>
		<!--td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td-->
		
	</tr>
	<!-- RMG -->
	<tr align="center">	
		<td rowspan="2"> 4 </td>	
		<td rowspan="2">RMG</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RMG%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RMG%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RMG%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RMG%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RMG%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RMG%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RMG%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RMG%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RMG%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RMG%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RMG%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RMG%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RMG%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RMG%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RMG%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RMG%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RMG%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
	</tr>
	<tr align="center">			
		<?php 
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				/*$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;*/
			}
		?>
		<td>Supplied</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<!--td><?php if($rmg_cct_tot!=0) echo $rmg_cct_tot; ?></td-->
		<td>&nbsp;</td>
		<td><?php if($rmg_nct_tot!=0) echo $rmg_nct_tot; ?></td>
		<!--td><?php if($rmg_icd_tot!=0) echo $rmg_icd_tot; ?></td-->
		<td><?php if($rmg_cct_tot!=0) echo $rmg_cct_tot; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $tot_rmg_booked; ?></td>
		
	</tr>
	<!-- SC -->
	<tr align="center">	
		<td rowspan="2"> 5 </td>
		<td rowspan="2">SC</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'SC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'SC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'SC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'SC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'SC%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'SC%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'SC%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'SC%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'SC%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'SC%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'SC%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'SC%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'SC%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'SC%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'SC%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'SC%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'SC%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<!-- WORKSHOP-AB -->
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa = "";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
					FROM sparcsn4.xps_che
					INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
					INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
					WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa !='JR'";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSJS))
						{
							$block_cpa .=  $rowshareYard->block_cpa.",";
						}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
					<?php
					if($nVal>0 and $plusVal>0)
					{
						$tot_equip_sc=$tot_equip_sc+$nVal+$plusVal;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$nVal+$plusVal;
						echo $nVal.",".$plusVal."+"; 
					}
					else if($nVal>0){
						$tot_equip_sc=$tot_equip_sc+$nVal;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$nVal;
						echo $nVal;
					}
					else if($plusVal>0){
						$tot_equip_sc=$tot_equip_sc+$plusVal;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$plusVal;
						echo $plusVal."+"; 
					}
					else{
						$tot_equip_sc=$tot_equip_sc;
						$tot_equip_sc_ab=$tot_equip_sc_ab;
						echo "-";
					} 
					?>
				</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc ="SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='AB'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
					<?php
					if($nValAB>0 and $plusValAB>0)
					{
						$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB+$plusValAB;
						
						echo $nValAB.",".$plusValAB."+"; 
					}
					else if($nValAB>0){
						$tot_equip_sc=$tot_equip_sc+$nValAB;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB;
						echo $nValAB;
					}
					else if($plusValAB>0){
						$tot_equip_sc=$tot_equip_sc+$plusValAB;
						$tot_equip_sc_ab=$tot_equip_sc_ab+$plusValAB;
						echo $plusValAB."+"; 
					}
					else{
						$tot_equip_sc=$tot_equip_sc;
						$tot_equip_sc_ab=$tot_equip_sc_ab;
						echo "-";
					}
					?>
				</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='DREFFER'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_ab=$tot_equip_sc_ab;
					echo "-";
				}
				?>
				</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='Y7'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_ab=$tot_equip_sc_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_ab=$tot_equip_sc_ab;
					echo "-";
				}
				?>
				</label>
		</td>
		<!-- WORKSHOP-C-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='Y3'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='Y5'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
					<?php
					if($nValAB>0 and $plusValAB>0)
					{
						$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
						$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
						
						echo $nValAB.",".$plusValAB."+"; 
					}
					else if($nValAB>0){
						$tot_equip_sc=$tot_equip_sc+$nValAB;
						$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
						echo $nValAB;
					}
					else if($plusValAB>0){
						$tot_equip_sc=$tot_equip_sc+$plusValAB;
						$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
						echo $plusValAB."+"; 
					}
					else{
						$tot_equip_sc=$tot_equip_sc;
						$tot_equip_sc_c=$tot_equip_sc_c;
						echo "-";
					}
					
					?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			/*
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='Y8'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}*/
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				/*if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}*/
			?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa !='Y8B'";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_sc=$tot_equip_sc+$nValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_sc=$tot_equip_sc+$plusValAB;
					$tot_equip_sc_c=$tot_equip_sc_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_sc=$tot_equip_sc;
					$tot_equip_sc_c=$tot_equip_sc_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo $sc_cct_tot; ?></td>
		<td><?php echo $sc_nct_tot; ?></td>
		<td><?php echo $sc_icd_tot; ?></td>
		<td><?php echo $sc_nofcy_tot; ?></td>
		<td><?php $tot_equip_sc_d=$tot_sc_booked; echo $tot_equip_sc+$tot_sc_booked; ?></td>
	
	</tr>
	<!-- RST45 -->
	<tr align="center">		
		<td rowspan="2"> 6 </td>
		<td rowspan="2">RST 45 Ton(L)</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 45%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 45%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 45%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 45%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RST 45%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RST 45%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RST 45%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RST 45%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RST 45%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RST 45%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RST 45%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RST 45%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RST 45%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RST 45%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RST 45%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RST 45%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RST 45%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa = "";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa NOT IN('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nVal+$plusVal;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_rst45=$tot_equip_rst45+$nVal;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusVal;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_ab=$tot_equip_rst45_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
				?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc ="SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst45=$tot_equip_rst45+$nValAB+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$nValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst45=$tot_equip_rst45+$plusValAB;
					$tot_equip_rst45_c=$tot_equip_rst45_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst45=$tot_equip_rst45;
					$tot_equip_rst45_c=$tot_equip_rst45_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo $tot_equip_rst45; ?></td>
	</tr>
	<!-- FLT42 -->
	<tr align="center">		
		<td rowspan="2"> 7 </td>
		<td rowspan="2">FLT 42 Ton</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'FLT 42%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'FLT 42%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'FLT 42%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'FLT 42%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'FLT 42%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'FLT 42%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'FLT 42%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'FLT 42%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'FLT 42%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'FLT 42%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'FLT 42%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'FLT 42%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'FLT 42%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'FLT 42%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'FLT 42%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'FLT 42%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'FLT 42%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa = "";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa NOT IN('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nVal+$plusVal;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_flt42=$tot_equip_flt42+$nVal;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusVal;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_ab=$tot_equip_flt42_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
				?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc ="SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=42 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt42=$tot_equip_flt42+$nValAB+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$nValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt42=$tot_equip_flt42+$plusValAB;
					$tot_equip_flt42_c=$tot_equip_flt42_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt42=$tot_equip_flt42;
					$tot_equip_flt42_c=$tot_equip_flt42_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo $flt42_cct_tot; ?></td>
		<td><?php echo $flt42_nct_tot; ?></td>
		<td><?php echo $flt42_icd_tot; ?></td>
		<td><?php echo $flt42_nofcy_tot; ?></td>
		<td><?php $tot_equip_flt42_d=$tot_flt42_booked; echo $tot_equip_flt42+$tot_flt42_booked; ?></td>
		<!--td><?php echo $tot_equip_flt42; ?></td-->
	</tr>
	<!-- FLT16 -->
	<tr align="center">	
		<td rowspan="2"> 8 </td>
		<td rowspan="2">FLT 16 Ton</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'FLT 16%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'FLT 16%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'FLT 16%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'FLT 16%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'FLT 16%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'FLT 16%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'FLT 16%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'FLT 16%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'FLT 16%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'FLT 16%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'FLT 16%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'FLT 16%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'FLT 16%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'FLT 16%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'FLT 16%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'FLT 16%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'FLT 16%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa = "";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa NOT IN('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nVal+$plusVal;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_flt16=$tot_equip_flt16+$nVal;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusVal;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_ab=$tot_equip_flt16_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa not in('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt16=$tot_equip_flt16+$nValAB+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$nValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt16=$tot_equip_flt16+$plusValAB;
					$tot_equip_flt16_c=$tot_equip_flt16_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt16=$tot_equip_flt16;
					$tot_equip_flt16_c=$tot_equip_flt16_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo $tot_equip_flt16; ?></td>
	</tr>
	<!-- RST7 -->
	<tr align="center">	
		<td rowspan="2"> 9 </td>
		<td rowspan="2">RST 7 Ton</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 7%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 7%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 7%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 7%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RST 7%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RST 7%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RST 7%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RST 7%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RST 7%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RST 7%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RST 7%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RST 7%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RST 7%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RST 7%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RST 7%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RST 7%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RST 7%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa="";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa not in('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nVal+$plusVal;
					$tot_equip_rst7_ab=$tot_equip_rst7+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_rst7=$tot_equip_rst7+$nVal;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusVal;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_ab=$tot_equip_rst7_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0  AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_rst7=$tot_equip_rst7+$nValAB+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$nValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_rst7=$tot_equip_rst7+$plusValAB;
					$tot_equip_rst7_c=$tot_equip_rst7_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_rst7=$tot_equip_rst7;
					$tot_equip_rst7_c=$tot_equip_rst7_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo $tot_equip_rst7; ?></td>
	</tr>
	<!-- FLT10 -->
	<tr align="center">
		<td rowspan="2"> 10 </td>
		<td rowspan="2">FLT 10 Ton</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'FLT 10%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'FLT 10%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'FLT 10%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'FLT 10%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'FLT 10%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'FLT 10%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'FLT 10%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'FLT 10%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'FLT 10%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'FLT 10%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'FLT 10%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'FLT 10%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'FLT 10%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'FLT 10%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'FLT 10%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'FLT 10%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'FLT 10%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa="";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa not in('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nVal+$plusVal;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_flt10=$tot_equip_flt10+$nVal;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusVal;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_ab=$tot_equip_flt10_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc' ) AS tbl WHERE block_cpa NOT IN('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=10 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa="";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_flt10=$tot_equip_flt10+$nValAB+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$nValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_flt10=$tot_equip_flt10+$plusValAB;
					$tot_equip_flt10_c=$tot_equip_flt10_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_flt10=$tot_equip_flt10;
					$tot_equip_flt10_c=$tot_equip_flt10_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo $tot_equip_flt10; ?></td>
	</tr>
	
	<!-- CM -->
	<tr align="center">		
		<td rowspan="2"> 11 </td>
		<td rowspan="2">CM</td>
		<?php 
		
			$jrDeVal="";
			$abDeVal="";
			$refDeVal="";
			$y7DeVal="";
			$y12DeVal="";
			$y3DeVal="";
			$y5DeVal="";
			$y6DeVal="";
			$y8BDeVal="";
			$bapxDeVal="";
			$y910DeVal="";
			$y11DeVal="";
			$ncyDeVal="";
			$cctDeVal="";
			$nctDeVal="";
			$icdDeVal="";
			$nofcyDeVal="";
			$totDeVal="";
			
			$resDemand="";
			
			$demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'CM%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'CM%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'CM%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'CM%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'CM%') AS y12,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'CM%') AS y3,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'CM%') AS y5,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'CM%') AS y6,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'CM%') AS y8B,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'CM%') AS bapx,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'CM%') AS y910,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'CM%') AS y11,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'CM%') AS ncy,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'CM%') AS cct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'CM%') AS nct,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'CM%') AS icd,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'CM%') AS nofcy
			) AS tbl";
			$resDemand = mysql_query($demandQuery);
			while($rowDemand = mysql_fetch_object($resDemand))
			{
				$jrDeVal=$rowDemand->jr;
				$abDeVal=$rowDemand->ab;
				$refDeVal=$rowDemand->refer;
				$y7DeVal=$rowDemand->y7;
				$y12DeVal=$rowDemand->y12;
				$y3DeVal=$rowDemand->y3;
				$y5DeVal=$rowDemand->y5;
				$y6DeVal=$rowDemand->y6;
				$y8BDeVal=$rowDemand->y8B;
				$bapxDeVal=$rowDemand->bapx;
				$y910DeVal=$rowDemand->y910;
				$y11DeVal=$rowDemand->y11;
				$ncyDeVal=$rowDemand->ncy;
				$cctDeVal=$rowDemand->cct;
				$nctDeVal=$rowDemand->nct;
				$icdDeVal=$rowDemand->icd;
				$nofcyDeVal=$rowDemand->nofcy;
				$totDeVal=$rowDemand->tot;
			}
		?>
		<td>Demand</td>
		<td><?php echo $jrDeVal; ?></td>
		<td><?php echo $abDeVal; ?></td>
		<td><?php echo $refDeVal; ?></td>
		<td><?php echo $y7DeVal; ?></td>
		<td><?php echo $y12DeVal; ?></td>
		<td><?php echo $y3DeVal; ?></td>
		<td><?php echo $y5DeVal; ?></td>
		<td><?php echo $y6DeVal; ?></td>
		<td><?php echo $y8BDeVal; ?></td>
		<td><?php echo $bapxDeVal; ?></td>
		<td><?php echo $y910DeVal; ?></td>
		<td><?php echo $y11DeVal; ?></td>
		<td><?php echo $ncyDeVal; ?></td>
		<td><?php echo $cctDeVal; ?></td>
		<td><?php echo $nctDeVal; ?></td>
		<td><?php echo $icdDeVal; ?></td>
		<td><?php echo $nofcyDeVal; ?></td>
		<td><?php echo $totDeVal; ?></td>
		
	</tr>
	<tr align="center">
		<td>Supplied</td>
		<td>
			<?php 
				$strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa='JR' ORDER BY 1";
				$resJRSC = mysql_query($strJRSC);
				$nVal = 0;
				$plusVal = 0;
				$block_cpa = "";
				while($rowJRSC = mysql_fetch_object($resJRSC)){
					$equiJrSc = $rowJRSC->equipment;
					$strChkShareJrSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiJrSc') AS tbl WHERE block_cpa NOT IN('JR')";
					$resCSJS = mysql_query($strChkShareJrSc);
					$numRowCSJS = mysql_num_rows($resCSJS);
					if($numRowCSJS>0)
					{
						$plusVal +=1;
						array_push($equipArray, $equiJrSc);
						while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
					}
					else{
						$nVal +=1;
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nVal>0 and $plusVal>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nVal+$plusVal;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nVal+$plusVal;
					
					echo $nVal.",".$plusVal."+"; 
				}
				else if($nVal>0){
					$tot_equip_cm=$tot_equip_cm+$nVal;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nVal;
					echo $nVal;
				}
				else if($plusVal>0){
					$tot_equip_cm=$tot_equip_cm+$plusVal;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$plusVal;
					echo $plusVal."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_ab=$tot_equip_cm_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa='AB' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('AB')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_ab=$tot_equip_cm_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa='DREFFER' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('DREFFER')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_ab=$tot_equip_cm_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa='Y7' ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y7')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_ab=$tot_equip_cm_ab+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_ab=$tot_equip_cm_ab;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y1','Y2','YMN') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$block_cpa = "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y1','Y2','YMN')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y3') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y3')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y5') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y5')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y6','Y6X') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y6','Y6X')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!--td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
				?>
			</label>
		</td-->
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y8B') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y8B')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('BAPX1','BAPX2','Y8') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc ="SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa not in('BAPX1','BAPX2','Y8')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y9','Y10') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y9','Y10')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('Y11') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('Y11')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>1)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<td>
			<?php 
			
				$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=10 AND block_cpa in('NCY') ORDER BY 1";
				$resABSC = mysql_query($strABSC);
				$nValAB = 0;
				$plusValAB = 0;
				$numRowCSAS = 0;
				$strChkShareABSc = "";
				$equiABSc= "";
				$block_cpa= "";
				while($rowABSC = mysql_fetch_object($resABSC)){
					$equiABSc = $rowABSC->equipment;
					$inarr = in_array($equiABSc, $equipArray);
					if(!$inarr)
					{
						$strChkShareABSc = "SELECT block_cpa,equipement
						FROM (SELECT DISTINCT (SELECT block_cpa FROM ctmsmis.yard_block WHERE block=sel_block) AS block_cpa,short_name AS equipement 
						FROM sparcsn4.xps_che
						INNER JOIN sparcsn4.xps_chezone ON sparcsn4.xps_chezone.che_id=sparcsn4.xps_che.id
						INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=sel_block
						WHERE short_name = '$equiABSc') AS tbl WHERE block_cpa NOT IN('NCY')";
						$resCSAS = mysql_query($strChkShareABSc);
						$numRowCSAS = mysql_num_rows($resCSAS);
						if($numRowCSAS>0)
						{
							$plusValAB +=1;
							array_push($equipArray, $equiABSc);
							while($rowshareYard = mysql_fetch_object($resCSAS)){
								$block_cpa .=  $rowshareYard->block_cpa.",";
							}
						}
						else{
							$nValAB +=1;
						}
					}
				}
				?>
				<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php
				if($nValAB>0 and $plusValAB>0)
				{
					$tot_equip_cm=$tot_equip_cm+$nValAB+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB+$plusValAB;
					
					echo $nValAB.",".$plusValAB."+"; 
				}
				else if($nValAB>0){
					$tot_equip_cm=$tot_equip_cm+$nValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$nValAB;
					echo $nValAB;
				}
				else if($plusValAB>0){
					$tot_equip_cm=$tot_equip_cm+$plusValAB;
					$tot_equip_cm_c=$tot_equip_cm_c+$plusValAB;
					echo $plusValAB."+"; 
				}
				else{
					$tot_equip_cm=$tot_equip_cm;
					$tot_equip_cm_c=$tot_equip_cm_c;
					echo "-";
				}
			?>
			</label>
		</td>
		<!-- Workshop-D-->
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo ""; ?></td>
		<td><?php echo $tot_equip_cm; ?></td>
	</tr>
	
	
	<?php //} ?>
	

</table>

		<BR>
		<table border=0 width="100%">				

			<tr align="center">
				<td colspan="12"><font size="4"><b><u>CONTAINER HANDLING EQUIPMENT POSITION OF ZONE- AB, C & D</u></b></font></td>
			</tr>
			<tr align="center">
				<td colspan="12"><font size="4"><b></b></font></td>
			</tr>

		</table>
		<BR>
		<table width="90%" border ='1' cellpadding='0' cellspacing='0' >
	
			<tr align="center">
				<td rowspan=3>EQUIPMENT</td>
				<td colspan=4>ZONE-AB</td>
				<td colspan=4>ZONE-C</td>
				<td colspan=4>ZONE-D</td>
				<td rowspan=3>TOTAL EQUIPMENT</td>
				<td colspan=2>TOTAL OPERATIONAL</td>
				<td rowspan=3>TOTAL OUT OF ORDER</td>
			</tr>
			<tr align="center">			
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="2">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="2">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="2">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				<td rowspan="2">BOOKED</td>
				<td rowspan="2">STAND BY</td>
			</tr>
			<tr align="center">	
				<td>BOOKED</td>
				<td>STAND BY</td>
				<td>BOOKED</td>
				<td>STAND BY</td>
				<td>BOOKED</td>
				<td>STAND BY</td>
			</tr>
			<?php 
			$qgc_ab_tot=0;
			$qgc_ab_booked=0;
			$qgc_ab_standby=0;
			$qgc_ab_out=0;
						
			$qgc_c_tot=0;
			$qgc_c_booked=0;
			$qgc_c_standby=0;
			$qgc_c_out=0;
			
			$qgc_d_tot=0;
			$qgc_d_booked=0;
			$qgc_d_standby=0;
			$qgc_d_out=0;
			
			$qgcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS  
			d_tot_non_op";
			$rowQGCQry=mysql_query($qgcQuery);
			while($rtnQGCQuery=mysql_fetch_object($rowQGCQry))
			{
				$qgc_ab_tot=$rtnQGCQuery->ab_tot;
				$qgc_ab_booked=$tot_qgc_booked;
				$qgc_ab_standby=$rtnQGCQuery->ab_tot - ($tot_qgc_booked+$rtnQGCQuery->ab_tot_non_op);
				$qgc_ab_out=$rtnQGCQuery->ab_tot_non_op;
				
				$qgc_c_tot=$rtnQGCQuery->c_tot;
				$qgc_c_booked=$tot_qgc_booked;
				$qgc_c_standby=$rtnQGCQuery->c_tot - ($tot_qgc_booked+$rtnQGCQuery->c_tot_non_op);
				$qgc_c_out=$rtnQGCQuery->c_tot_non_op;
				
				$qgc_d_tot=$rtnQGCQuery->d_tot;
				$qgc_d_booked=$tot_qgc_booked;
				$qgc_d_standby=$rtnQGCQuery->d_tot - ($tot_qgc_booked+$rtnQGCQuery->d_tot_non_op);
				$qgc_d_out=$rtnQGCQuery->d_tot_non_op;
				
				if($qgc_ab_standby<0)
				{
					$qgc_ab_standby=0;
				}
				if($qgc_c_standby<0)
				{
					$qgc_c_standby=0;
				}
				if($qgc_d_standby<0)
				{
					$qgc_d_standby=0;
				}
				
			?>
			
			<tr align="center">						
				<td>QGC</td>
				<td><?php echo $qgc_ab_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $qgc_ab_out;  ?></td>
				
				<td><?php echo $qgc_c_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $qgc_c_out;  ?></td>
				
				<td><?php echo $qgc_d_tot;  ?></td>
				<td><?php echo $qgc_d_booked;  ?></td>
				<td><?php echo $qgc_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $qgc_d_out;  ?></td-->
				<td><?php echo ($qgc_d_tot-($qgc_d_booked+$qgc_d_standby));  ?></td>
				
				<td><?php echo $qgc_ab_tot+$qgc_c_tot+$qgc_d_tot ;  ?></td>
				<!--td><?php echo $qgc_ab_booked+$qgc_c_booked+$qgc_d_booked;  ?></td-->
				<td><?php echo $qgc_d_booked;  ?></td>
				<td><?php echo $qgc_ab_standby+$qgc_c_standby+$qgc_d_standby;  ?></td>
				<!--td><?php echo $qgc_ab_out+$qgc_c_out+$qgc_d_out;  ?></td-->
				<td><?php echo $qgc_ab_out+$qgc_c_out+($qgc_d_tot-($qgc_d_booked+$qgc_d_standby));  ?></td>
				
			</tr>
			<?php } ?>
			<?php 
			$rtg_ab_tot=0;
			$rtg_ab_booked=0;
			$rtg_ab_standby=0;
			$rtg_ab_out=0;
						
			$rtg_c_tot=0;
			$rtg_c_booked=0;
			$rtg_c_standby=0;
			$rtg_c_out=0;
			
			$rtg_d_tot=0;
			$rtg_d_booked=0;
			$rtg_d_standby=0;
			$rtg_d_out=0;

			$rtgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS  
			d_tot_non_op";
			$rowRTGQry=mysql_query($rtgQuery);
			while($rtnRTGQuery=mysql_fetch_object($rowRTGQry))
			{
				$rtg_ab_tot=$rtnRTGQuery->ab_tot;
				$rtg_ab_booked=0;
				$rtg_ab_standby=$rtnRTGQuery->ab_tot - ($tot_rtg_booked+$rtnRTGQuery->ab_tot_non_op);
				$rtg_ab_out=$rtnRTGQuery->ab_tot_non_op;
				
				$rtg_c_tot=$rtnRTGQuery->c_tot;
				$rtg_c_booked=0;
				$rtg_c_standby=$rtnRTGQuery->c_tot - ($tot_rtg_booked+$rtnRTGQuery->c_tot_non_op);
				$rtg_c_out=$rtnRTGQuery->c_tot_non_op;
				
				$rtg_d_tot=$rtnRTGQuery->d_tot;
				$rtg_d_booked=$tot_rtg_booked;
				$rtg_d_standby=$rtnRTGQuery->d_tot - ($tot_rtg_booked+$rtnRTGQuery->d_tot_non_op);
				$rtg_d_out=$rtnRTGQuery->d_tot_non_op;
				
				if($rtg_ab_standby<0)
				{
					$rtg_ab_standby=0;
				}
				if($rtg_c_standby<0)
				{
					$rtg_c_standby=0;
				}
				if($rtg_d_standby<0)
				{
					$rtg_d_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>RTG</td>
				<td><?php echo $rtg_ab_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $rtg_ab_out;  ?></td>
				
				<td><?php echo $rtg_c_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $rtg_c_out;  ?></td>
				
				<td><?php echo $rtg_d_tot;  ?></td>
				<td><?php echo $rtg_d_booked;  ?></td>
				<td><?php echo $rtg_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $rtg_d_out;  ?></td-->
				<td><?php echo ($rtg_d_tot-($rtg_d_booked+$rtg_d_standby));  ?></td>
				
				<td><?php echo $rtg_ab_tot+$rtg_c_tot+$rtg_d_tot ;  ?></td>
				<td><?php echo $rtg_ab_booked+$rtg_c_booked+$rtg_d_booked;  ?></td>
				<td><?php echo $rtg_ab_standby+$rtg_c_standby+$rtg_d_standby;  ?></td>
				<!--td><?php echo $rtg_ab_out+$rtg_c_out+$rtg_d_out;  ?></td-->
				<td><?php echo $rtg_ab_out+$rtg_c_out+($rtg_d_tot-($rtg_d_booked+$rtg_d_standby));  ?></td>
				
			</tr>
			<?php } ?>
			<?php 
			$mhc_ab_tot=0;
			$mhc_ab_booked=0;
			$mhc_ab_standby=0;
			$mhc_ab_out=0;
						
			$mhc_c_tot=0;
			$mhc_c_booked=0;
			$mhc_c_standby=0;
			$mhc_c_out=0;
			
			$mhc_d_tot=0;
			$mhc_d_booked=0;
			$mhc_d_standby=0;
			$mhc_d_out=0;

			$mhcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS  
			d_tot_non_op";
			 $rowMHCQry=mysql_query($mhcQuery);
			while($rtnMHCQuery=mysql_fetch_object($rowMHCQry))
			{
				$mhc_ab_tot=$rtnMHCQuery->ab_tot;
				$mhc_ab_booked=0;
				$mhc_ab_standby=$rtnMHCQuery->ab_tot - ($tot_mhc_booked+$rtnMHCQuery->ab_tot_non_op);
				$mhc_ab_out=$rtnMHCQuery->ab_tot_non_op;
				
				$mhc_c_tot=$rtnMHCQuery->c_tot;
				$mhc_c_booked=0;
				$mhc_c_standby=$rtnMHCQuery->c_tot - ($tot_mhc_booked+$rtnMHCQuery->c_tot_non_op);
				$mhc_c_out=$rtnMHCQuery->c_tot_non_op;
				
				$mhc_d_tot=$rtnMHCQuery->d_tot;
				$mhc_d_booked=$tot_mhc_booked;
				$mhc_d_standby=$rtnMHCQuery->d_tot - ($tot_mhc_booked+$rtnMHCQuery->d_tot_non_op);
				$mhc_d_out=$rtnMHCQuery->d_tot_non_op;
				
				if($mhc_ab_standby<0)
				{
					$mhc_ab_standby=0;
				}
				if($mhc_c_standby<0)
				{
					$mhc_c_standby=0;
				}
				if($mhc_d_standby<0)
				{
					$mhc_d_standby=0;
				}
				
			?>
			
			<tr align="center">			
				<td>MHC</td>
				<td><?php echo $mhc_ab_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $mhc_ab_out;  ?></td>
				
				<td><?php echo $mhc_c_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $mhc_c_out;  ?></td>
				
				<td><?php echo $mhc_d_tot;  ?></td>
				<td><?php echo $mhc_d_booked;  ?></td>
				<td><?php echo $mhc_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $mhc_d_out;  ?></td-->
				<td><?php echo ($mhc_d_tot-($mhc_d_booked+$mhc_d_standby));  ?></td>
				
				<td><?php echo $mhc_ab_tot+$mhc_c_tot+$mhc_d_tot;  ?></td>
				<td><?php echo $mhc_ab_booked+$mhc_c_booked+$mhc_d_booked;;  ?></td>
				<td><?php echo $mhc_ab_standby+$mhc_c_standby+$mhc_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $mhc_ab_out+$mhc_c_out+$mhc_d_out;  ?></td-->
				<td><?php echo $mhc_ab_out+$mhc_c_out+($mhc_d_tot-($mhc_d_booked+$mhc_d_standby));  ?></td>
				
			</tr>
			<?php } ?>
			<!-- rmg start -->
			<?php 
			$rmg_ab_tot=0;
			$rmg_ab_booked=0;
			$rmg_ab_standby=0;
			$rmg_ab_out=0;
						
			$rmg_c_tot=0;
			$rmg_c_booked=0;
			$rmg_c_standby=0;
			$rmg_c_out=0;
			
			$rmg_d_tot=0;
			$rmg_d_booked=0;
			$rmg_d_standby=0;
			$rmg_d_out=0;

			$rmgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS  
			d_tot_non_op";
			 $rowRMGQry=mysql_query($rmgQuery);
			while($rtnRMGQuery=mysql_fetch_object($rowRMGQry))
			{
				$rmg_ab_tot=$rtnRMGQuery->ab_tot;
				$rmg_ab_booked=0;
				$rmg_ab_standby=$rtnRMGQuery->ab_tot - ($tot_rmg_booked+$rtnRMGQuery->ab_tot_non_op);
				$rmg_ab_out=$rtnRMGQuery->ab_tot_non_op;
				
				$rmg_c_tot=$rtnRMGQuery->c_tot;
				$rmg_c_booked=0;
				$rmg_c_standby=$rtnRMGQuery->c_tot - ($tot_rmg_booked+$rtnRMGQuery->c_tot_non_op);
				$rmg_c_out=$rtnRMGQuery->c_tot_non_op;
				
				$rmg_d_tot=$rtnRMGQuery->d_tot;
				$rmg_d_booked=$tot_rmg_booked;
				$rmg_d_standby=$rtnRMGQuery->d_tot - ($tot_rmg_booked+$rtnRMGQuery->d_tot_non_op);
				$rmg_d_out=$rtnRMGQuery->d_tot_non_op;
				
				if($rmg_ab_standby<0)
				{
					$rmg_ab_standby=0;
				}
				if($rmg_c_standby<0)
				{
					$rmg_c_standby=0;
				}
				if($rmg_d_standby<0)
				{
					$rmg_d_standby=0;
				}
				
			?>
			<!-- rmg start -->
			<tr align="center">			
				<td>RMG</td>
				<td><?php echo $rmg_ab_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $rmg_ab_out;  ?></td>
				
				<td><?php echo $rmg_c_tot;  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo $rmg_c_out;  ?></td>
				
				<td><?php echo $rmg_d_tot;  ?></td>
				<td><?php echo $rmg_d_booked;  ?></td>
				<td><?php echo $rmg_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $rmg_d_out;  ?></td-->
				<td><?php echo ($rmg_d_tot-($rmg_d_booked+$rmg_d_standby));  ?></td>
				
				<td><?php echo $rmg_ab_tot+$rmg_c_tot+$rmg_d_tot ;  ?></td>
				<td><?php echo $rmg_ab_booked+$rmg_c_booked+$rmg_d_booked;  ?></td>
				<td><?php echo $rmg_ab_standby+$rmg_c_standby+$rmg_d_standby;  ?></td>
				<!--td><?php echo $rmg_ab_out+$rmg_c_out+$rmg_d_out;  ?></td-->
				<td><?php echo $rmg_ab_out+$rmg_c_out+($rmg_d_tot-($rmg_d_booked+$rmg_d_standby));  ?></td>
				
			</tr>
			<?php } ?>
			<?php 
			$sc_ab_tot=0;
			$sc_ab_booked=0;
			$sc_ab_standby=0;
			$sc_ab_out=0;
			
			$sc_c_tot=0;
			$sc_c_booked=0;
			$sc_c_standby=0;
			$sc_c_out=0;
			
			$sc_d_tot=0;
			$sc_d_booked=0;
			$sc_d_standby=0;
			$sc_d_out=0;
			
			$scQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') 
			AS d_tot_non_op ";
			$rowSCQry=mysql_query($scQuery);
			while($rtnSCQuery=mysql_fetch_object($rowSCQry))
			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_sc_ab;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_sc_ab+$rtnSCQuery->ab_tot_non_op);
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_sc_c;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_sc_c+$rtnSCQuery->c_tot_non_op);

				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				$sc_d_tot=$rtnSCQuery->d_tot;
				$sc_d_booked=$tot_equip_sc_d;
				$sc_d_standby=$rtnSCQuery->d_tot - ($tot_equip_sc_d+$rtnSCQuery->d_tot_non_op);
				$sc_d_out=$rtnSCQuery->d_tot_non_op;
				
				if($sc_ab_standby<0)
				{
					$sc_ab_standby=0;
				}
				if($sc_c_standby<0)
				{
					$sc_c_standby=0;
				}
				if($sc_d_standby<0)
				{
					$sc_d_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>SC</td>
				<td><?php echo $sc_ab_tot;  ?></td>
				<td><?php echo $sc_ab_booked;  ?></td>
				<td><?php echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_ab_out;  ?></td>
				
				<td><?php echo $sc_c_tot;  ?></td>
				<td><?php echo $sc_c_booked;  ?></td>
				<td><?php echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_c_out;  ?></td>
				
				<td><?php echo $sc_d_tot;  ?></td>
				<td><?php echo $sc_d_booked;  ?></td>
				<td><?php echo $sc_d_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_d_out;  ?></td>
				
				<td><?php echo $sc_ab_tot+$sc_c_tot+$sc_d_tot ;  ?></td>
				<td><?php echo $sc_ab_booked+$sc_c_booked+$sc_d_booked;  ?></td>
				<td><?php echo $sc_ab_standby+$sc_c_standby+$sc_d_standby;  ?></td>
				<td><?php echo $sc_ab_out+$sc_c_out+$sc_d_out;  ?></td>
				
			</tr>
			<?php } ?>
			<?php
			$sc_ab_tot=0;
			$sc_ab_booked=0;
			$sc_ab_standby=0;
			$sc_ab_out=0;
			
			$sc_c_tot=0;
			$sc_c_booked=0;
			$sc_c_standby=0;
			$sc_c_out=0;
			
			$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  c_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  
					c_tot_non_op";
			$rowSCQry=mysql_query($scQuery);
			while($rtnSCQuery=mysql_fetch_object($rowSCQry))
			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_rst45_ab;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_rst45_ab+$rtnSCQuery->ab_tot_non_op);
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_rst45_c;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_rst45_c+$rtnSCQuery->c_tot_non_op);
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				if($sc_ab_standby<0)
				{
					$sc_ab_standby=0;
				}
				if($sc_c_standby<0)
				{
					$sc_c_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>RST 45 TON(L)</td>
				<td><?php echo $sc_ab_tot;  ?></td>
				<td><?php echo $sc_ab_booked;  ?></td>
				<td><?php echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_ab_out;  ?></td>
				
				<td><?php echo $sc_c_tot;  ?></td>
				<td><?php echo $sc_c_booked;  ?></td>
				<td><?php echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_c_out;  ?></td>
				
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php echo $sc_ab_tot+$sc_c_tot ;  ?></td>
				<td><?php echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php echo $sc_ab_standby+$sc_c_standby;  ?></td>
				<td><?php echo $sc_ab_out+$sc_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			<!-- FLT 42 -->
			<?php
			$flt42_ab_tot=0;
			$flt42_ab_booked=0;
			$flt42_ab_standby=0;
			$flt42_ab_out=0;
			
			$flt42_c_tot=0;
			$flt42_c_booked=0;
			$flt42_c_standby=0;
			$flt42_c_out=0;
			
			$flt42Query="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 42 TON') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 42 TON') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='FLT 42 TON') AS  d_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 42 TON') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 42 TON') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='FLT 42 TON') 
			AS d_tot_non_op";
			$rowflt42Qry=mysql_query($flt42Query);
			while($rtnflt42Query=mysql_fetch_object($rowflt42Qry))
			{
				$flt42_ab_tot=$rtnflt42Query->ab_tot;
				$flt42_ab_booked=$tot_equip_flt42_ab;
				$flt42_ab_standby=$rtnflt42Query->ab_tot - ($tot_equip_flt42_ab+$rtnflt42Query->ab_tot_non_op);
				$flt42_ab_out=$rtnflt42Query->ab_tot_non_op;
				
				$flt42_c_tot=$rtnflt42Query->c_tot;
				$flt42_c_booked=$tot_equip_flt42_c;
				$flt42_c_standby=$rtnflt42Query->c_tot - ($tot_equip_flt42_c+$rtnflt42Query->c_tot_non_op);
				$flt42_c_out=$rtnflt42Query->c_tot_non_op;
				
				$flt42_d_tot=$rtnflt42Query->d_tot;
				$flt42_d_booked=$tot_equip_flt42_d;
				$flt42_d_standby=$rtnflt42Query->d_tot - ($tot_equip_flt42_d+$rtnflt42Query->d_tot_non_op);
				$flt42_d_out=$rtnflt42Query->d_tot_non_op;
				
				
				if($flt42_ab_standby<0)
				{
					$flt42_ab_standby=0;
				}
				if($flt42_c_standby<0)
				{
					$flt42_c_standby=0;
				}
				if($flt42_d_standby<0)
				{
					$flt42_d_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>FLT 42 TON</td>
				<td><?php echo $flt42_ab_tot;  ?></td>
				<td><?php echo $flt42_ab_booked;  ?></td>
				<td><?php echo $flt42_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $flt42_ab_out;  ?></td>
				
				<td><?php echo $flt42_c_tot;  ?></td>
				<td><?php echo $flt42_c_booked;  ?></td>
				<td><?php echo $flt42_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $flt42_c_out;  ?></td>
				
				<td><?php echo $flt42_d_tot;  ?></td>
				<td><?php echo $flt42_d_booked;  ?></td>
				<td><?php echo $flt42_d_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $flt42_d_out;  ?></td>
				
				<td><?php echo $flt42_ab_tot+$flt42_c_tot+$flt42_d_tot ;  ?></td>
				<td><?php echo $flt42_ab_booked+$flt42_c_booked+$flt42_d_booked;  ?></td>
				<td><?php echo $flt42_ab_standby+$flt42_c_standby+$flt42_d_standby;  ?></td>
				<td><?php echo $flt42_ab_out+$flt42_c_out+$flt42_d_out;  ?></td>
				
			</tr>
			<?php } ?>
			<!-- FLT 42 -->
			
			<?php
			$sc_ab_tot=0;
			$sc_ab_booked=0;
			$sc_ab_standby=0;
			$sc_ab_out=0;
			
			$sc_c_tot=0;
			$sc_c_booked=0;
			$sc_c_standby=0;
			$sc_c_out=0;
			
			$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS  c_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS  
					c_tot_non_op";
			$rowSCQry=mysql_query($scQuery);
			while($rtnSCQuery=mysql_fetch_object($rowSCQry))
			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_flt16_ab;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_flt16_ab+$rtnSCQuery->ab_tot_non_op);
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_flt16_c;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_flt16_c+$rtnSCQuery->c_tot_non_op);
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				if($sc_ab_standby<0)
				{
					$sc_ab_standby=0;
				}
				if($sc_c_standby<0)
				{
					$sc_c_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>FLT 16 TON</td>
				<td><?php echo $sc_ab_tot;  ?></td>
				<td><?php echo $sc_ab_booked;  ?></td>
				<td><?php echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_ab_out;  ?></td>
				
				<td><?php echo $sc_c_tot;  ?></td>
				<td><?php echo $sc_c_booked;  ?></td>
				<td><?php echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_c_out;  ?></td>
				
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php echo $sc_ab_tot+$sc_c_tot ;  ?></td>
				<td><?php echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php echo $sc_ab_standby+$sc_c_standby;  ?></td>
				<td><?php echo $sc_ab_out+$sc_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			<?php
			$sc_ab_tot=0;
			$sc_ab_booked=0;
			$sc_ab_standby=0;
			$sc_ab_out=0;
			
			$sc_c_tot=0;
			$sc_c_booked=0;
			$sc_c_standby=0;
			$sc_c_out=0;
			
			$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  c_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  
					c_tot_non_op";
			$rowSCQry=mysql_query($scQuery);
			while($rtnSCQuery=mysql_fetch_object($rowSCQry))
			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_rst7_ab;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_rst7_ab+$rtnSCQuery->ab_tot_non_op);
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_rst7_c;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_rst7_c+$rtnSCQuery->c_tot_non_op);
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				if($sc_ab_standby<0)
				{
					$sc_ab_standby=0;
				}
				if($sc_c_standby<0)
				{
					$sc_c_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>RST 7 TON</td>
				<td><?php echo $sc_ab_tot;  ?></td>
				<td><?php echo $sc_ab_booked;  ?></td>
				<td><?php echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_ab_out;  ?></td>
				
				<td><?php echo $sc_c_tot;  ?></td>
				<td><?php echo $sc_c_booked;  ?></td>
				<td><?php echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_c_out;  ?></td>
				
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php echo $sc_ab_tot+$sc_c_tot ;  ?></td>
				<td><?php echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php echo $sc_ab_standby+$sc_c_standby;  ?></td>
				<td><?php echo $sc_ab_out+$sc_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			<?php
			$sc_ab_tot=0;
			$sc_ab_booked=0;
			$sc_ab_standby=0;
			$sc_ab_out=0;
			
			$sc_c_tot=0;
			$sc_c_booked=0;
			$sc_c_standby=0;
			$sc_c_out=0;
			
			$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 10 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 10 Ton') AS  c_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 10 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 10 Ton') AS  
					c_tot_non_op";
			$rowSCQry=mysql_query($scQuery);
			while($rtnSCQuery=mysql_fetch_object($rowSCQry))
			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_flt10_ab;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_flt10_ab+$rtnSCQuery->ab_tot_non_op);
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_flt10_c;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_flt10_c+$rtnSCQuery->c_tot_non_op);
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				if($sc_ab_standby<0)
				{
					$sc_ab_standby=0;
				}
				if($sc_c_standby<0)
				{
					$sc_c_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>FLT 10 TON</td>
				<td><?php echo $sc_ab_tot;  ?></td>
				<td><?php echo $sc_ab_booked;  ?></td>
				<td><?php echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_ab_out;  ?></td>
				
				<td><?php echo $sc_c_tot;  ?></td>
				<td><?php echo $sc_c_booked;  ?></td>
				<td><?php echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_c_out;  ?></td>
				
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php echo $sc_ab_tot+$sc_c_tot ;  ?></td>
				<td><?php echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php echo $sc_ab_standby+$sc_c_standby;  ?></td>
				<td><?php echo $sc_ab_out+$sc_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			<!-- CM -->
			<?php
			$cm_ab_tot=0;
			$cm_ab_booked=0;
			$cm_ab_standby=0;
			$cm_ab_out=0;
			
			$cm_c_tot=0;
			$cm_c_booked=0;
			$cm_c_standby=0;
			$cm_c_out=0;
			
			$cmQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  c_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  
					c_tot_non_op";
			$rowCMQry=mysql_query($cmQuery);
			while($rtnCMQuery=mysql_fetch_object($rowCMQry))
			{
				$cm_ab_tot=$rtnCMQuery->ab_tot;
				$cm_ab_booked=$tot_equip_cm_ab;
				$cm_ab_standby=$rtnCMQuery->ab_tot - ($tot_equip_cm_ab+$rtnCMQuery->ab_tot_non_op);
				$cm_ab_out=$rtnCMQuery->ab_tot_non_op;
				
				$cm_c_tot=$rtnCMQuery->c_tot;
				$cm_c_booked=$tot_equip_cm_c;
				$cm_c_standby=$rtnCMQuery->c_tot - ($tot_equip_cm_c+$rtnCMQuery->c_tot_non_op);
				$cm_c_out=$rtnCMQuery->c_tot_non_op;
				
				if($cm_ab_standby<0)
				{
					$cm_ab_standby=0;
				}
				if($cm_c_standby<0)
				{
					$cm_c_standby=0;
				}
				
			?>
			<tr align="center">			
				<td>CM</td>
				<td><?php echo $cm_ab_tot;  ?></td>
				<td><?php echo $cm_ab_booked;  ?></td>
				<td><?php echo $cm_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $cm_ab_out;  ?></td>
				
				<td><?php echo $cm_c_tot;  ?></td>
				<td><?php echo $cm_c_booked;  ?></td>
				<td><?php echo $cm_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $cm_c_out;  ?></td>
				
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php echo $cm_ab_tot+$cm_c_tot ;  ?></td>
				<td><?php echo $cm_ab_booked+$cm_c_booked;  ?></td>
				<td><?php echo $cm_ab_standby+$cm_c_standby;  ?></td>
				<td><?php echo $cm_ab_out+$cm_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			<!-- CM -->
			<!--tr align="center">			
				<td><?php echo $rtnTotQuery->equipment;  ?></td>
				<td><?php echo $rtnTotQuery->ab_tot;  ?></td>
				<td><?php echo $rtnTotQuery->ab_tot_booked;  ?></td>
				<td><?php echo $rtnTotQuery->ab_tot_standby;  ?></td>
				<td><?php echo $rtnTotQuery->ab_tot_non_op;  ?></td>
				<td><?php echo $rtnTotQuery->c_tot;  ?></td>
				<td><?php echo $rtnTotQuery->c_tot_booked;  ?></td>
				<td><?php echo $rtnTotQuery->c_tot_standby;  ?></td>
				<td><?php echo $rtnTotQuery->c_tot_non_op;  ?></td>
				<td><?php echo $rtnTotQuery->tot_equip;  ?></td>
				<td><?php echo $rtnTotQuery->tot_op_booked;  ?></td>
				<td><?php echo $rtnTotQuery->tot_op_standby;  ?></td>
				<td><?php echo $rtnTotQuery->tot_non_op;  ?></td>
				
			</tr-->
			<?php //} ?>
			
		</table>

	</div>


		</div>
			<?php mysql_close($con_ctmsmis); ?>
	</body>
</html>

