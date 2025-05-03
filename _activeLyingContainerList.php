<html>
<head>
    <!--meta http-equiv="refresh" content="20"-->
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
                <td colspan="9"><font size="5"><b>Active Yard Lying Container On </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
            </tr>
        </table>
        <!--cellpadding='0' cellspacing='0'-->
        <table width="100%" border ='1' cellpadding='0' cellspacing='0'>
            <tr align="center" bgcolor="#D8D0CE">
                <td><b>SlNo.</b></td>
                <td><b>Container No</b></td>
				<td><b>Size</b></td>
                <td><b>Height</b></td>
				<td><b>Freight Kind</b></td>
                <td><b>Rotation No</b></td>
                <td><b>Last Position</b></td>
                <td><b>Vessel Name</b></td>
                <td><b>Time In</b></td>
                <!--td><b>MLO</b></td-->
                
      
				<td><b>Lying Hour</b></td>
				<td><b>Lying Days</b></td>
                <!--td><b>Last Position</b></td-->
            </tr>

            <?php

            //echo$vvdGkey;
            $strQuery = "SELECT * FROM 
			(
			SELECT sparcsn4.inv_unit.id,inv_unit.freight_kind,sparcsn4.vsl_vessel_visit_details.ib_vyg,sparcsn4.vsl_vessels.name AS v_name,


			sparcsn4.inv_unit_fcy_visit.time_in,TIMESTAMPDIFF(HOUR,sparcsn4.inv_unit_fcy_visit.time_in,NOW()) AS hr,
			CONCAT((SELECT FLOOR(hr/24)),' Days ',(SELECT hr%24),' Hrs') AS d,
			 RIGHT(sparcsn4.ref_equip_type.nominal_length,2) AS size,

			 RIGHT(sparcsn4.ref_equip_type.nominal_height,2)/10 AS height,
			 sparcsn4.inv_unit_fcy_visit.last_pos_slot
			FROM sparcsn4.inv_unit
			INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
			INNER JOIN sparcsn4.argo_carrier_visit ON sparcsn4.argo_carrier_visit.gkey=sparcsn4.inv_unit_fcy_visit.actual_ib_cv
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON sparcsn4.vsl_vessel_visit_details.vvd_gkey=sparcsn4.argo_carrier_visit.cvcvd_gkey
			INNER JOIN sparcsn4.vsl_vessels ON sparcsn4.vsl_vessels.gkey=sparcsn4.vsl_vessel_visit_details.vessel_gkey

			INNER JOIN sparcsn4.inv_unit_equip ON sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey
			INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
			INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 

			WHERE transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' 
			) AS tbl WHERE hr>=1000 ORDER BY hr DESC";

            //echo $strQuery;
            $query=mysql_query($strQuery);
            $i=0;
            while($row=mysql_fetch_object($query)){
                $i++;

                ?>
				<tr align="center" bgcolor="#FCF7F7">
					<td><?php  echo $i;?></td>
                    <td><?php  echo $row->id;?></td>
                    <td><?php  echo $row->size;?></td>
                    <td><?php  echo $row->height;?></td>
					<td><?php  echo $row->freight_kind;?></td>
					<td><?php  echo $row->ib_vyg;?></td>
					<td><?php  echo $row->last_pos_slot;?></td>
                    <td><?php  echo $row->v_name;?></td>
                    <td><?php  echo $row->time_in;?></td>
                    <td><?php  echo $row->hr;?></td>
					<td><?php  echo $row->d;?></td>
                    <!--td><?php  echo $row->discharge_time; ?></td>
                    <td><?php  echo $row->last_pos_slot; ?></td-->
                </tr>

            <?php } ?>
        </table>
    </div>
</div>
<br>
<!-- Sourav -->
<?php mysql_close($con_sparcsn4); ?>
<?php include('footer.php'); ?>
</body>
</html>