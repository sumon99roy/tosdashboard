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
        <?php include("dbConection.php");?>
        <table>
            <tr style="margin:5px;">
                <td colspan="9"><font size="5"><b>Active Yard Lying ICD On </b></font><font size="4"><?php echo date("d/m/Y h:i:s")?></font></td>
            </tr>
        </table>
        <!--cellpadding='0' cellspacing='0'-->
        <table width="100%" border ='1' cellpadding='0' cellspacing='0'>
            <tr align="center" bgcolor="#D8D0CE">
                <td><b>SlNo.</b></td>
                <td><b>Container No</b></td>
                <td><b>Category</b></td>
                <td><b>Rotation No</b></td>
                <td><b>MLO</b></td>
                
                <td><b>Size</b></td>
                <td><b>Height</b></td>
				<td><b>Discharge Time</b></td>
                <td><b>Last Position</b></td>
            </tr>

            <?php

            //echo$vvdGkey;
            $strQuery = "SELECT inv_unit.id,sparcsn4.inv_unit.category,
			(SELECT vsl_vessel_visit_details.ib_vyg
			FROM sparcsn4.argo_carrier_visit
			INNER JOIN sparcsn4.argo_visit_details ON argo_carrier_visit.cvcvd_gkey=argo_visit_details.gkey 
			INNER JOIN sparcsn4.vsl_vessel_visit_details ON vsl_vessel_visit_details.vvd_gkey=argo_visit_details.gkey 
			WHERE argo_carrier_visit.gkey=inv_unit.cv_gkey OR argo_carrier_visit.gkey=inv_unit.declrd_ib_cv
			) AS rotation,
			sparcsn4.ref_bizunit_scoped.id AS mlo,
			(SELECT RIGHT(sparcsn4.ref_equip_type.nominal_length,2) FROM sparcsn4.inv_unit_equip 
			INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
			INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 
			WHERE sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey) AS size,

			((SELECT RIGHT(sparcsn4.ref_equip_type.nominal_height,2) FROM sparcsn4.inv_unit_equip 
			INNER JOIN sparcsn4.ref_equipment ON sparcsn4.ref_equipment.gkey=sparcsn4.inv_unit_equip.eq_gkey 
			INNER JOIN sparcsn4.ref_equip_type ON sparcsn4.ref_equip_type.gkey=sparcsn4.ref_equipment.eqtyp_gkey 
			WHERE sparcsn4.inv_unit_equip.unit_gkey=inv_unit.gkey)/10) AS height,
			sparcsn4.inv_unit_fcy_visit.time_in AS discharge_time,
			inv_goods.destination,
			sparcsn4.inv_unit_fcy_visit.last_pos_slot
			FROM sparcsn4.inv_unit
			INNER JOIN sparcsn4.inv_unit_fcy_visit ON sparcsn4.inv_unit_fcy_visit.unit_gkey=sparcsn4.inv_unit.gkey
			INNER JOIN sparcsn4.inv_goods ON sparcsn4.inv_goods.gkey=sparcsn4.inv_unit.goods
			INNER JOIN sparcsn4.ref_bizunit_scoped ON inv_unit.line_op = sparcsn4.ref_bizunit_scoped.gkey

			WHERE sparcsn4.inv_unit_fcy_visit.transit_state='S40_YARD' AND sparcsn4.inv_unit.category='IMPRT' AND inv_goods.destination='2592'
			ORDER BY sparcsn4.inv_unit.id";

            //echo $strQuery;
            $query=mysql_query($strQuery);
            $i=0;
            while($row=mysql_fetch_object($query)){
                $i++;

                ?>
				<tr align="center" bgcolor="#FCF7F7">
					<td><?php  echo $i;?></td>
                    <td><?php  echo $row->id;?></td>
					<td><?php  echo $row->category;?></td>
					<td><?php  echo $row->rotation;?></td>
                    <td><?php  echo $row->mlo;?></td>
                    <td><?php  echo $row->size;?></td>
					<td><?php  echo $row->height;?></td>
                    <td><?php  echo $row->discharge_time; ?></td>
                    <td><?php  echo $row->last_pos_slot; ?></td>
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