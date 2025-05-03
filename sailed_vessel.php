<html>

<head>
	<script type="text/javascript" src="jquery-1.6.0.min.js"></script>
	<script type="text/javascript" src="calender.jquery-ui.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/calender.jquery-ui.css">
</head>

<body>
	<div>                  
		<div align="center">
			<?php include("header.php") ?>
		</div>
		<div align="center">
			<?php include("dbConection.php"); ?>
			<?php include("dbOracleConnection.php"); ?>

			<script>
				function validateForm() {
					var fromDate = document.getElementById("fdate").value;
					var toDate = document.getElementById("tdate").value;

					if (fromDate === "" || toDate === "") {
						alert("From Date and To Date are required!");
						return false;
					}

					// You can add more complex validation logic if needed

					return true;
				}
			</script>

			<table>

				<tr style="margin:5px;">
					<form action="" method="POST" onsubmit="return validateForm()">
						<td align="center" colspan="7">
							<font size="5">
								From Date

								<input type="date" class="form-control" id="fdate" name="fdate">
						</td>
						</br>
						<td align="center" colspan="7">
							<font size="5">
								To Date

								<input type="date" class="form-control" id="tdate" name="tdate">
						</td>

				</tr>

			</table>
			</br>
            
			<div class="col-sm-12 text-center">
                
				<button type="submit" class="mb-xs mt-xs mr-xs btn btn-success">Search</button>
            
			</div>
            </br>
			</form>

			<?php
			$fdate = "";
			$tdate = "";
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$fdate = $_POST['fdate'];
				$tdate = $_POST['tdate'];
			}
			?>

			<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			?>
        <!--table>
            <tr style="margin:5px;">
                <td colspan="12"><font size="5"><b>Sailed Vessel </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
            </tr>
        </table-->
       
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

       
            // $strQuery = "                                
          

            //     SELECT * FROM 
            //     (SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_visit_details.ib_vyg,
            //     NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
            //     (SELECT argo_quay.id FROM argo_quay
            //     INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
            //     WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
            //     ORDER BY vsl_vessel_berthings.ata  DESC fetch first 1 rows only) AS berth,
            //     argo_carrier_visit.ata,
            //     argo_carrier_visit.atd,

            //     argo_visit_details.etd



            //     FROM argo_carrier_visit
            //     INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
            //     INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
            //     INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
            //     INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
            //     INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
            //     WHERE 
            //     cast(argo_carrier_visit.atd as date) BETWEEN 
            //                 to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-25            
            //                 AND CURRENT_DATE

            //     AND ref_country.cntry_code!='BD'

            //     UNION ALL

            //     SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_visit_details.ib_vyg,
            //     NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
            //     (SELECT argo_quay.id FROM argo_quay
            //     INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
            //     WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
            //     ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,
            //     argo_carrier_visit.ata,
            //     argo_carrier_visit.atd,

            //     argo_visit_details.etd

            //     FROM argo_carrier_visit
            //     INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
            //     INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
            //     INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
            //     INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
            //     INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
            //     WHERE cast(argo_carrier_visit.atd as date) BETWEEN 
            //                 to_date(concat(to_char(CURRENT_DATE,'yyyy-mm-dd'),' 23:59:59'),'yyyy-mm-dd hh24:mi:ss')-25            
            //                 AND CURRENT_DATE
            //     AND ref_country.cntry_code ='BD' AND vsl_vessels.notes='BD')  tbl
            //     WHERE berth IS NOT NULL ORDER BY atd DESC fetch first 50 rows only";

            $strQuery = "SELECT * FROM 
            (SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_classes.basic_class,vsl_vessel_visit_details.ib_vyg,
            NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
            (SELECT argo_quay.id FROM argo_quay
            INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
            WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
            ORDER BY vsl_vessel_berthings.ata  DESC fetch first 1 rows only) AS berth,
            to_char(argo_carrier_visit.ata,'dd/mm/yyyy hh24:mi:ss') as ata,
            to_char(argo_carrier_visit.atd,'dd/mm/yyyy hh24:mi:ss') as atd,
            to_char(argo_visit_details.etd,'dd/mm/yyyy hh24:mi:ss') as etd,
            argo_carrier_visit.atd as depart,
            CONCAT(CONCAT(CONCAT(CEIL(EXTRACT(DAY FROM atd-ata)),'d '), CONCAT(CEIL(EXTRACT(HOUR FROM atd-ata)),'h ')),CONCAT(CEIL(EXTRACT(MINUTE FROM atd-ata)),'m')) as ocupai
            FROM argo_carrier_visit
            INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
            INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
            INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
            INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
            INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
            INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
            WHERE to_char(argo_carrier_visit.ata,'yyyy-mm-dd') BETWEEN 
            '$fdate' AND '$tdate' AND ref_country.cntry_code!='BD'
            
            UNION ALL
            
            SELECT vsl_vessel_visit_details.vvd_gkey,vsl_vessels.name,vsl_vessel_classes.basic_class,vsl_vessel_visit_details.ib_vyg,
            NVL(vsl_vessel_visit_details.flex_string03,vsl_vessel_visit_details.flex_string02) AS berthop,
            (SELECT argo_quay.id FROM argo_quay
            INNER JOIN vsl_vessel_berthings ON vsl_vessel_berthings.quay=argo_quay.gkey
            WHERE vsl_vessel_berthings.vvd_gkey=vsl_vessel_visit_details.vvd_gkey
            ORDER BY vsl_vessel_berthings.ata DESC fetch first 1 rows only) AS berth,
            to_char(argo_carrier_visit.ata,'dd/mm/yyyy hh24:mi:ss') as ata,
            to_char(argo_carrier_visit.atd,'dd/mm/yyyy hh24:mi:ss') as atd,
            to_char(argo_visit_details.etd,'dd/mm/yyyy hh24:mi:ss') as etd,
            argo_carrier_visit.atd as depart,
            CONCAT(CONCAT(CONCAT(CEIL(EXTRACT(DAY FROM atd-ata)),'d '), CONCAT(CEIL(EXTRACT(HOUR FROM atd-ata)),'h ')),CONCAT(CEIL(EXTRACT(MINUTE FROM atd-ata)),'m')) as ocupai
            FROM argo_carrier_visit
            INNER JOIN argo_visit_details ON argo_visit_details.gkey=argo_carrier_visit.cvcvd_gkey
            INNER JOIN vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey
            INNER JOIN vsl_vessels ON vsl_vessels.gkey=vsl_vessel_visit_details.vessel_gkey
            INNER JOIN vsl_vessel_classes ON vsl_vessel_classes.gkey=vsl_vessels.vesclass_gkey
            INNER JOIN ref_bizunit_scoped ON ref_bizunit_scoped.gkey=vsl_vessel_visit_details.bizu_gkey
            INNER JOIN ref_country ON ref_country.cntry_code=vsl_vessels.country_code
            WHERE to_char(argo_carrier_visit.ata,'yyyy-mm-dd') BETWEEN 
            '$fdate' AND '$tdate' AND ref_country.cntry_code ='BD' AND vsl_vessels.notes='BD')  tbl
            WHERE basic_class = 'CELL' AND berth IS NOT NULL ORDER BY ata";

            $query = oci_parse($con_sparcsn4_oracle, $strQuery);
            oci_execute($query);
            $i=0;
            $gkey = null;
            $redCount=0;
                while(($row = oci_fetch_object($query))!= false)
                {
                $i++;

                $comment = "";

                $gkey = $row->VVD_GKEY;
                $strGkey = "select comments from ctmsmis.mis_exp_vvd where vvd_gkey='$gkey'";
                $rslt = mysqli_query($con_sparcsn4,$strGkey);
                while($comments = mysqli_fetch_object($rslt))
                {
                    $comment = $comments->comments;
                }

                ?>
            <?php if(($comment != "ok") && ($comment != "OK")){?>
                   <?php $redCount++;?>
                <tr  bgcolor="#F5B7B1" align="center">

            <?php } else {?>
                <tr align="center">
                <?php } ?>
                    <td><?php  echo $i;?></td>
                    <td><?php  echo $row->NAME;?></td>
                <td><?php  echo $row->IB_VYG;?></td>
                <td><?php  echo $row->BERTH;?></td>
                    


                    <td><?php  echo $row->ATA;?></td>
                    <td><?php  echo $row->ATD;?></td>
                    <td><?php  echo $row->OCUPAI;?></td>
					<td><?php  echo $row->BERTHOP ;?></td>
                    <td><?php echo $comment; ?></td>
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

<?php mysqli_close($con_sparcsn4); ?>
<?php mysqli_close($con_cchaportdb); ?>
<?php oci_close($con_sparcsn4_oracle); ?>

</body>
<?php } ?>
<!--?php } ?-->
</html>
