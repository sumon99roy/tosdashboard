







<html>
<head>
    <meta http-equiv="refresh" content="60">
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
        <?php include("dbConection.php");?>
        <table>
            <tr style="margin:5px;">
                <td colspan="12"><font size="5"><b>Sailed Vessel </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
            </tr>
        </table>

        <table width="100%" border ='1' cellpadding='0' cellspacing='0'>


            <tr align="center" bgcolor="#D8D0CE">
                <td><b>SlNo.</b></td>
                <td><b>Name</b></td>
                <td><b>Rotation No</b></td>
                <td><b>Berth</b></td>
                
                <td><b>Arrival DateTime</b></td>
                <td><b>Departed DateTime</b></td>
                <td><b>Occupied Time</b></td>
				<td><b>Berth/Terminal Operator</b></td>
                <td><b>Comments</b></td>
            </tr>

         

            <?php

            
            $strQuery = "SELECT * FROM 
			(SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name,sparcsn4.vsl_vessel_visit_details.ib_vyg,
			IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
			(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
			INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
			WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,
			sparcsn4.argo_carrier_visit.ata,
			sparcsn4.argo_carrier_visit.atd,
			TIMESTAMPDIFF(MINUTE,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_carrier_visit.atd) AS diff,
							FLOOR((SELECT diff/60)) AS h,
							FLOOR((SELECT diff%60)) AS mm,
							FLOOR((SELECT h/24)) AS dd,
							(SELECT h%24) AS hh,
							(SELECT CONCAT(dd,'d ',hh,'h ',mm,'m')) AS ocupai,
			sparcsn4.argo_visit_details.etd,
			(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl,ctmsmis.mis_exp_vvd.comments
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
			INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
			INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
			LEFT JOIN ctmsmis.mis_exp_vvd ON ctmsmis.mis_exp_vvd.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			WHERE DATE(sparcsn4.argo_carrier_visit.atd) BETWEEN DATE_ADD(DATE(NOW()), INTERVAL -25 DAY) AND DATE(NOW()) AND sparcsn4.ref_country.cntry_code!='BD'
			union all
			SELECT sparcsn4.vsl_vessel_visit_details.vvd_gkey,sparcsn4.vsl_vessels.name,sparcsn4.vsl_vessel_visit_details.ib_vyg,
			IFNULL(sparcsn4.vsl_vessel_visit_details.flex_string03,sparcsn4.vsl_vessel_visit_details.flex_string02) AS berthop,
			(SELECT sparcsn4.argo_quay.id FROM sparcsn4.argo_quay
			INNER JOIN sparcsn4.vsl_vessel_berthings ON sparcsn4.vsl_vessel_berthings.quay=sparcsn4.argo_quay.gkey
			WHERE sparcsn4.vsl_vessel_berthings.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			ORDER BY sparcsn4.vsl_vessel_berthings.ata DESC LIMIT 1) AS berth,
			sparcsn4.argo_carrier_visit.ata,
			sparcsn4.argo_carrier_visit.atd,
			TIMESTAMPDIFF(MINUTE,sparcsn4.argo_carrier_visit.ata,sparcsn4.argo_carrier_visit.atd) AS diff,
							FLOOR((SELECT diff/60)) AS h,
							FLOOR((SELECT diff%60)) AS mm,
							FLOOR((SELECT h/24)) AS dd,
							(SELECT h%24) AS hh,
							(SELECT CONCAT(dd,'d ',hh,'h ',mm,'m')) AS ocupai,
			sparcsn4.argo_visit_details.etd,
			(SELECT IF(LEFT(berth,1)='G',1,IF(LEFT(berth,1)='C',2,3))) AS sl,ctmsmis.mis_exp_vvd.comments
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON sparcsn4.argo_visit_details.gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_visit_details.gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey
			INNER JOIN sparcsn4.ref_bizunit_scoped ON sparcsn4.ref_bizunit_scoped.gkey=sparcsn4.vsl_vessel_visit_details.bizu_gkey
			INNER JOIN sparcsn4.ref_country ON sparcsn4.ref_country.cntry_code=sparcsn4.vsl_vessels.country_code
			LEFT JOIN ctmsmis.mis_exp_vvd ON ctmsmis.mis_exp_vvd.vvd_gkey=sparcsn4.vsl_vessel_visit_details.vvd_gkey
			WHERE DATE(sparcsn4.argo_carrier_visit.atd) BETWEEN DATE_ADD(DATE(NOW()), INTERVAL -25 DAY) AND DATE(NOW()) AND sparcsn4.ref_country.cntry_code ='BD' and sparcsn4.vsl_vessels.notes='BD') AS tbl
			WHERE berth IS NOT NULL ORDER BY atd DESC LIMIT 50";

           
            $query=mysql_query($strQuery);

            $i=0;
            $redCount=0;

            while($row=mysql_fetch_object($query)){
                $i++;

                ?>
            <?php if((($row->comments) != "ok") && (($row->comments) != "OK")){?>
                   <?php $redCount++;?>
                <tr  bgcolor="#F5B7B1" align="center">

            <?php } else {?>
                <tr align="center">
                <?php } ?>
                    <td><?php  echo $i;?></td>
                    <td><?php  echo $row->name;?></td>
                <td><?php  echo $row->ib_vyg;?></td>
                <td><?php  echo $row->berth;?></td>
                    


                    <td><?php  echo $row->ata;?></td>
                    <td><?php  echo $row->atd;?></td>
                    <td><?php  echo $row->ocupai;?></td>
					<td><?php  echo $row->berthop;?></td>
                    <td><?php echo $row->comments; ?></td>
                </tr>

            <?php } ?>
            <tr align="center">
                <th colspan="2">Total</th>
                <th colspan="3"><?php echo $i; ?></th>
                <th colspan="2" bgcolor="#F5B7B1">Not Ok</th>
                <th bgcolor="#F5B7B1"><?php echo $redCount; ?></th>
            </tr>
        </table>
    </div>
</div>
<br>

<div>
    <div align="center">
        <?php include("dbConection42.php");?>

    </div>
</div>

<?php mysql_close($con_sparcsn4); ?>
<?php mysql_close($con_cchaportdb); ?>
		<?php include('footer.php'); ?>

</body>
</html>