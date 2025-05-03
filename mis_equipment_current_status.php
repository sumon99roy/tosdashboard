<?php
	//include("mydbPConnectionctmsmis.php");
    include("dbOracleConnection.php");
    include("dbConection.php");
    include("mydbPConnection.php");
	?>
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
            <td colspan=5>ZONE-AB</td>
            <td colspan=9>ZONE-C</td>
            <td colspan=4>ZONE-D</td>
            <td rowspan=2>TOTAL</td>
        </tr>
        <tr align="center">
            <td>Y-JR</td>
            <td>Y-AB</td>
            <td>D-REEFER</td>
            <td>Y-7</td>
            <td>BP/XY</td>
            <td>Y-1,2,MN</td>
            <td>Y-3</td>
            <td>Y-5</td>
            <td>Y-6</td>
            <!--td>Y-8</td-->
            <td>Y-8B</td>
            <td>Y-8,BX1,BX2</td>
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

        // get block code(CCT) start  3/22/2023 start
   
        // $blockListQuery="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
        // WHERE terminal='CCT' AND  block_cpa!='NULL' ORDER BY block ASC";
        $blockListQuery="SELECT DISTINCT block_cpa AS block FROM yard_block
        WHERE terminal='CCT' AND  block_cpa!='NULL' ORDER BY block ASC";
        
        //$blockListRes=mysqli_query($con_sparcsn4,$blockListQuery);
        $blockListRes=mysqli_query($con_cchaportdb,$blockListQuery);
        $totalRow=mysqli_num_rows($blockListRes);
      
       
       //echo count($blockRowRes);
      
       $blockList="";
       $i=0;
      while($blockRow=mysqli_fetch_object($blockListRes)){
        
           $blockString="";
           $blockString=$blockRow->block;
               
            if($i==($totalRow-1)){
             $blockList=$blockList."'".$blockString."'";
            }
            else{
             $blockList=$blockList."'".$blockString."',";

            }
             $i++;
        

        }
      
       
         $blockList;
        


          // get block code(CCT) stat 3/22/2023 start
        // get block code(NCT) start  3/22/2023 start

        // $blockListQuery1="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
        // WHERE terminal='NCT' AND  block_cpa!='NULL' ORDER BY block ASC ";
        $blockListQuery1="SELECT DISTINCT block_cpa AS block FROM yard_block
        WHERE terminal='NCT' AND  block_cpa!='NULL' ORDER BY block ASC ";
        
        //$blockListRes1=mysqli_query($con_sparcsn4,$blockListQuery1);
        $blockListRes1=mysqli_query($con_cchaportdb,$blockListQuery1);
        $totalRow1=mysqli_num_rows($blockListRes1);
     
       $t=0;
       $blockListNct="";
       while($blockRow1=mysqli_fetch_object($blockListRes1)){
      
           $blockString1="";
           
               $blockString1=$blockRow1->block;
       
            if($t==($totalRow1-1)){
              
                $blockListNct=$blockListNct."'".$blockString1."'";
                
            }
            else{
                $blockListNct=$blockListNct."'".$blockString1."',";

            }
             $t++;
        

        }
         $blockListNct;

          // get block code(NCT) stat 3/22/2023 start

          //get ICD start 3/23/2023
        // $blockListOfIcdQu="SELECT DISTINCT block_cpa AS block,block_unit FROM ctmsmis.yard_block
        // WHERE block_unit='ICD' AND  block_cpa!='NULL' ORDER BY block ASC";
        $blockListOfIcdQu="SELECT DISTINCT block_cpa AS block,block_unit FROM yard_block
        WHERE block_unit='ICD' AND  block_cpa!='NULL' ORDER BY block ASC";
          
         // $blockListOfIcdRes=mysqli_query($con_sparcsn4,$blockListOfIcdQu);
          $blockListOfIcdRes=mysqli_query($con_cchaportdb,$blockListOfIcdQu);
          $totalRowOfIcd=mysqli_num_rows($blockListOfIcdRes);
        
         $d=0;
         $blockListIcd="";
         while($blockRowOfIcd=mysqli_fetch_object($blockListOfIcdRes)){
           // var_dump($blockRowOfIcd);
        
             $blockStringOfIcd="";
             
                $blockStringOfIcd=$blockRowOfIcd->block;
               
              if($d==($totalRowOfIcd-1)){
                //echo $d." ".($totalRowOfIcd-1);
                   $blockListIcd=$blockListIcd."'".$blockStringOfIcd."'";           
              }
              else{
                  $blockListIcd=$blockListIcd."'".$blockStringOfIcd."',";
  
              }
               $d++;
          
  
          }
            $blockListIcd;

           // ICD END 


        //    sc_nofcy for get block start
          $blockListOfIcdQu="SELECT DISTINCT block_cpa AS block FROM yard_block
          WHERE terminal IN ('OFY') AND  block_cpa!='NULL' ORDER BY block ASC";
        // $blockListOfIcdQu="SELECT DISTINCT block_cpa AS block FROM yard_block
        // WHERE terminal IN ('NOFCY','OFY') AND  block_cpa!='NULL' ORDER BY block ASC";


         
         $blockListForScNofcyRes=mysqli_query($con_cchaportdb,$blockListOfIcdQu);
         $totalRowScNOfcy=mysqli_num_rows($blockListForScNofcyRes);
       
         $s=0;
         $blockListOfScNofcy="";
         while($blockRowOfScNofcy=mysqli_fetch_object($blockListForScNofcyRes)){
       
       
            $blockStringOfIcd="";
            
               $blockStringOfScNofcy=$blockRowOfScNofcy->block;
              
             if($s==($totalRowScNOfcy-1)){
                  $blockListOfScNofcy=$blockListOfScNofcy."'".$blockStringOfScNofcy."'";           
             }
             else{
                 $blockListOfScNofcy=$blockListOfScNofcy."'".$blockStringOfScNofcy."',";
             }
              $s++;
         
 
         }
           $blockListOfScNofcy;
           //sc_nofcy for get block End
        $qgc_query="SELECT yard,(CASE WHEN  yard='NCT'  THEN SUM(yard_tot)  
		ELSE SUM(yard_tot) END) AS yard_tot
        FROM (
        SELECT 
        (CASE WHEN  xps_che.short_name IN ('QC01','QC02','QC03','QC04')  THEN 'CCT' 
        ELSE 'NCT' END) AS yard,
        (CASE WHEN  xps_che.short_name IN ('QC01','QC02','QC03','QC04')  THEN 1  
        ELSE 1 END) AS yard_tot
        FROM xps_che 
        WHERE  xps_che.short_name LIKE 'Q%'
        ) tbl GROUP BY yard";

         
         $row_qgc_query = oci_parse($con_sparcsn4_oracle,$qgc_query);
         oci_execute($row_qgc_query);
		 $qgc_cct_tot=0;
		 $qgc_nct_tot=0;
       
        while(($rtn_qgc_query=oci_fetch_object($row_qgc_query))!=false)
        {
            if($rtn_qgc_query->YARD=="CCT")
                $qgc_cct_tot=$rtn_qgc_query->YARD_TOT;
            else if($rtn_qgc_query->YARD=="NCT")
                $qgc_nct_tot=$rtn_qgc_query->YARD_TOT;
        }

       
        $tot_qgc_booked= $qgc_cct_tot+$qgc_nct_tot;//18

        //QGC supply - end

        //RTG supply - start
       
        $rtg_cct="SELECT count(distinct equipement) AS tot_rtg_cct_booked FROM (
            SELECT tbl.*
            FROM ( SELECT DISTINCT sel_block Block,short_name equipement, sel_block  
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE  sel_block IN($blockList)) tbl 
            WHERE sel_block IS NOT NULL  ORDER BY equipement
            )  t1  where t1.equipement LIKE 'RTG%'";

        
        $row_rtg_cct= oci_parse($con_sparcsn4_oracle,$rtg_cct);
        oci_execute($row_rtg_cct);
		$rtn_rtg_cct=0;
	    while(($rtn_rtg_cct=oci_fetch_object($row_rtg_cct)))
		{
			 $rtg_cct_tot=$rtn_rtg_cct->TOT_RTG_CCT_BOOKED;
		}

     
        $rtg_nct="SELECT count(distinct equipement) AS tot_rtg_nct_booked 
        FROM (
        SELECT tbl.* FROM 
        (
        SELECT DISTINCT sel_block Block,short_name equipement,sel_block
        FROM xps_che 
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
        WHERE sel_block IN($blockListNct)
        )  tbl WHERE sel_block IS NOT NULL ORDER BY equipement
        )  t1 WHERE equipement LIKE 'RTG%'";

        $row_rtg_nct= oci_parse($con_sparcsn4_oracle, $rtg_nct);
        oci_execute($row_rtg_nct);

		$rtg_nct_tot=0;
       
        while(($rtn_rtg_nct=oci_fetch_object($row_rtg_nct))!=false)
		{
			$rtg_nct_tot=$rtn_rtg_nct->TOT_RTG_NCT_BOOKED;
		}


        $tot_rtg_booked= $rtg_cct_tot+$rtg_nct_tot;

        //RTG supply - end

        //MHC supply - start
      

    $mhc_query="SELECT yard,SUM(yard_tot) AS tot
    FROM (
    SELECT 
    (CASE WHEN  xps_che.short_name IN ('MH01')  THEN 'NCT'
    WHEN  xps_che.short_name IN ('MH04','MH05')  THEN 'CCT'   
     END) AS yard,
    (CASE WHEN  xps_che.short_name IN ('MH01')  THEN 1  
      WHEN  xps_che.short_name IN ('MH04','MH05')  THEN 1
     END) AS yard_tot
    FROM xps_che 
    WHERE  xps_che.short_name LIKE 'MH%'
    )  tbl
    GROUP BY yard";

       $row_mhc_query = oci_parse($con_sparcsn4_oracle, $mhc_query);
       oci_execute($row_mhc_query);
       
		 $mhc_cct_tot=0;
		 $mhc_nct_tot=0;
   
       while(($rtn_mhc_query=oci_fetch_object($row_mhc_query))!=false)
        {
            if($rtn_mhc_query->YARD=="CCT")
                $mhc_cct_tot=$rtn_mhc_query->TOT;
            else if($rtn_mhc_query->YARD=="NCT")
                $mhc_nct_tot=$rtn_mhc_query->TOT;
        }


        $tot_mhc_booked= $mhc_cct_tot+$mhc_nct_tot;
    
        //MHC supply - end

        //RMG supply - start
   
        $rmg_cct="SELECT count(distinct equipement) AS tot_rmg_cct_booked FROM (
            SELECT tbl.* FROM (
            SELECT DISTINCT sel_block Block,short_name equipement,sel_block
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE short_name IS NOT NULL AND short_name!='' AND short_name NOT LIKE 'HHT%' AND short_name NOT LIKE 'F%' AND short_name NOT LIKE 'SP%' AND sel_block IN($blockList)
            )  tbl WHERE sel_block IS NOT NULL ORDER BY equipement
            )  t1 WHERE  equipement LIKE 'RMG%'";
       
        $row_rmg_cct = oci_parse($con_sparcsn4_oracle, $rmg_cct);
        oci_execute($row_rmg_cct);
		$rmg_cct_tot=0;
     
       while(($rtn_rmg_cct=oci_fetch_object($row_rmg_cct))!=false)
		{
			 $rmg_cct_tot=$rtn_rmg_cct->TOT_RMG_CCT_BOOKED;
		}

               $rmg_nct="SELECT count(distinct equipement) AS tot_rmg_nct_booked
                 FROM (
                 SELECT tbl.* FROM (
                 SELECT DISTINCT sel_block Block,short_name equipement,sel_block

                 FROM xps_che 
                 INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
                 WHERE short_name  LIKE 'RM%' AND sel_block IN($blockListNct)
                 )  tbl 
                  WHERE sel_block IS NOT NULL ORDER BY equipement
                )  t1 WHERE  t1.equipement LIKE 'RMG%'";
     
        $row_rmg_nct = oci_parse($con_sparcsn4_oracle,$rmg_nct);
        oci_execute($row_rmg_nct);
		$rmg_nct_tot=0;
        
        while(($rtn_rmg_nct=oci_fetch_object($row_rmg_nct))!=false)
		{
		     $rmg_nct_tot=$rtn_rmg_nct->TOT_RMG_NCT_BOOKED;
		}

      
        $rmg_icd="SELECT count(distinct equipement) AS tot_rmg_icd_booked 
        FROM (
        SELECT * 
        FROM ( 
        SELECT DISTINCT sel_block Block,short_name equipement ,sel_block
        FROM xps_che 
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
        WHERE  short_name LIKE 'RM%' AND sel_block IN($blockListIcd)
        )  tbl 
        WHERE sel_block IS NOT NULL ORDER BY equipement
        )  t1 WHERE equipement LIKE 'RMG%'";
       
        $row_rmg_icd = oci_parse($con_sparcsn4_oracle,$rmg_icd);
        oci_execute($row_rmg_icd);
		$rmg_icd_tot=0;
        
        while(($rtn_rmg_icd=oci_fetch_object($row_rmg_icd))!=false)
		{
			 $rmg_icd_tot=$rtn_rmg_icd->TOT_RMG_ICD_BOOKED;
		}

        $tot_rmg_booked= $rmg_cct_tot+$rmg_nct_tot+$rmg_icd_tot;


  

        $sc_icd="SELECT  COUNT(DISTINCT short_name) AS icd_sc
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'SC%' AND sel_block IN ('CSE','CSF')";

      
        $row_sc_icd= oci_parse($con_sparcsn4_oracle,$sc_icd);
        oci_execute($row_sc_icd);
		$sc_icd_tot=0;
     
        while(($rtn_sc_icd=oci_fetch_object($row_sc_icd))!=false)
		{
			 $sc_icd_tot=$rtn_sc_icd->ICD_SC;
		}

       
         $sc_nct=" SELECT COUNT(DISTINCT short_name) AS nct_sc 
         FROM xps_che
         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
         WHERE short_name LIKE 'SC%' AND sel_block IN($blockListNct)";
     
         $row_sc_nct= oci_parse($con_sparcsn4_oracle,$sc_nct);
         oci_execute($row_sc_nct);
		 $sc_nct_tot=0;
       
         while(($rtn_sc_nct=oci_fetch_object($row_sc_nct))!=false)
		{
			 $sc_nct_tot=$rtn_sc_nct->NCT_SC;
		}

     
        $sc_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_sc
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'SC%' AND sel_block IN ($blockListOfScNofcy)";
       
        $row_sc_nofcy= oci_parse($con_sparcsn4_oracle,$sc_nofcy);
        oci_execute($row_sc_nofcy);
		$sc_nofcy_tot=0;
       
       while(($rtn_sc_nofcy=oci_fetch_object($row_sc_nofcy))!=false)
		{
			 $sc_nofcy_tot=$rtn_sc_nofcy->NOFCY_SC;
		}


        $sc_cct="SELECT count(distinct equipement) AS tot_sc_cct_booked FROM (
            SELECT tbl.*
            FROM ( SELECT DISTINCT sel_block Block,short_name equipement ,sel_block
            
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE sel_block IN($blockList)
            ) 
            tbl 
            WHERE sel_block IS NOT NULL ORDER BY equipement
            )  t1 WHERE  equipement LIKE 'SC%' AND block NOT IN ('CSE','CSF')";

     
       $row_sc_cct= oci_parse($con_sparcsn4_oracle,$sc_cct);
       oci_execute($row_sc_cct);
		$sc_cct_tot=0;
       
        while(($rtn_sc_cct=oci_fetch_object($row_sc_cct))!=false)
       
		{
			 $sc_cct_tot=$rtn_sc_cct->TOT_SC_CCT_BOOKED;
		}



        $tot_sc_booked= $sc_nct_tot+$sc_cct_tot+$sc_nofcy_tot+$sc_icd_tot;
        // FLT 42 START
       
        $flt42_icd="SELECT COUNT(DISTINCT short_name) AS icd_flt42 
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'FLT42%' AND  sel_block IN ('CSE','CSF')";
        $row_sc_cct= oci_parse($con_sparcsn4_oracle,$flt42_icd);
        oci_execute($row_sc_cct);
		$flt42_icd_tot=0;
       
       while(($rtn_flt42_icd=oci_fetch_object($row_sc_cct))!=false)
       
		{
			 $flt42_icd_tot=$rtn_flt42_icd->ICD_FLT42;
		}

      
        $flt42_nct="SELECT COUNT(DISTINCT short_name) AS nct_flt42 
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'FLT42%'  AND sel_block IN ($blockListNct)";
      
       $row_flt42_nct= oci_parse($con_sparcsn4_oracle,$flt42_nct);
       oci_execute($row_flt42_nct);
		$flt42_nct_tot=0;
       
        while(($rtn_flt42_nct=oci_fetch_object($row_flt42_nct))!=false)
		{
		
            $flt42_nct_tot=$rtn_flt42_nct->NCT_FLT42;
		}

         // nofcy_flt42 for get block start
        
        //  $blockListOfNofcyFlat42="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
        //  WHERE terminal IN ('NOFCY') AND  block_cpa!='NULL' ORDER BY block ASC";
        $blockListOfNofcyFlat42="SELECT DISTINCT block_cpa AS block FROM yard_block
        WHERE terminal IN ('OFY') AND  block_cpa!='NULL' ORDER BY block ASC";
         
         //$blockListForNofcyFlat42Res=mysqli_query($con_sparcsn4,$blockListOfNofcyFlat42);
         $blockListForNofcyFlat42Res=mysqli_query($con_cchaportdb,$blockListOfNofcyFlat42);
         $totalRowNofcyFlat42=mysqli_num_rows($blockListForNofcyFlat42Res);
       
         $z=0;
         $blockList_NofcyFlat42="";
         while($blockRowOfNofcyFlat42=mysqli_fetch_object($blockListForNofcyFlat42Res)){
            
            $blockStringOfNofcyFlat42="";
            
               $blockStringOfNofcyFlat42=$blockRowOfNofcyFlat42->block;
              
             if($z==($totalRowNofcyFlat42-1)){
                  $blockList_NofcyFlat42=$blockList_NofcyFlat42."'".$blockStringOfNofcyFlat42."'";           
             }
             else{
                 $blockList_NofcyFlat42=$blockList_NofcyFlat42."'".$blockStringOfNofcyFlat42."',";
             }
              $z++;
         
 
         }
         // echo $blockList_NofcyFlat42;
           //sc_nofcy for get block End

        
        $flt42_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_flt42
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'FLT42%' AND  sel_block IN ($blockList_NofcyFlat42)";
        
       $row_flt42_nofcy= oci_parse($con_sparcsn4_oracle, $flt42_nofcy);
       oci_execute($row_flt42_nofcy);
		$flt42_nofcy_tot=0;
      
       while(($rtn_flt42_nofcy=oci_fetch_object($row_flt42_nofcy))!=false)
		{
		     $flt42_nofcy_tot=$rtn_flt42_nofcy->NOFCY_FLT42;
		}


     
  
        $flt42_cct="SELECT count(distinct equipement) AS tot_flt42_cct_booked
        FROM (
        SELECT tbl.* 
        FROM ( SELECT DISTINCT sel_block Block,short_name equipement,sel_block
        FROM xps_che 
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
        WHERE  sel_block IN($blockList)
        ) tbl 
        WHERE sel_block IS NOT NULL ORDER BY equipement
        ) t1 WHERE equipement LIKE 'FLT42%' AND block NOT IN ('CSE','CSF')";

      
       $row_flt42_cct= oci_parse($con_sparcsn4_oracle,$flt42_cct);
       oci_execute($row_flt42_cct);
		$flt42_cct_tot=0;
      
        while(($rtn_flt42_cct=oci_fetch_object($row_flt42_cct))!=false)
		{
			 $flt42_cct_tot=$rtn_flt42_cct->TOT_FLT42_CCT_BOOKED;
		}



        $tot_flt42_booked= $flt42_nct_tot+$flt42_cct_tot+$flt42_nofcy_tot+$flt42_icd_tot;


        // FLT 42 END

            // FLT 16 START
                
            $flt16_icd="SELECT COUNT(DISTINCT short_name) AS icd_flt16 
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
            WHERE short_name LIKE 'FLT%' AND  sel_block IN ('CSE','CSF')";
            $row_sc_cct= oci_parse($con_sparcsn4_oracle,$flt16_icd);
            oci_execute($row_sc_cct);
            $flt16_icd_tot=0;

            while(($rtn_flt16_icd=oci_fetch_object($row_sc_cct))!=false)

            {
                $flt16_icd_tot=$rtn_flt16_icd->ICD_FLT16;
            }


            $flt16_nct="SELECT COUNT(DISTINCT short_name) AS nct_flt16 
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
            WHERE short_name LIKE 'FLT%'  AND sel_block IN ($blockListNct)";

            $row_flt16_nct= oci_parse($con_sparcsn4_oracle,$flt16_nct);
            oci_execute($row_flt16_nct);
            $flt16_nct_tot=0;

            while(($rtn_flt16_nct=oci_fetch_object($row_flt16_nct))!=false)
            {

                $flt16_nct_tot=$rtn_flt16_nct->NCT_FLT16;
            }

            


             $flt16_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_flt16
             FROM xps_che
             INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
             WHERE short_name LIKE 'FLT%' AND  sel_block IN ($blockList_NofcyFlat42)";
            $row_flt16_nofcy= oci_parse($con_sparcsn4_oracle, $flt16_nofcy);
            oci_execute($row_flt16_nofcy);
            $flt16_nofcy_tot=0;

            while(($rtn_flt16_nofcy=oci_fetch_object($row_flt16_nofcy))!=false)
            {
                $flt16_nofcy_tot=$rtn_flt16_nofcy->NOFCY_FLT16;
            }




            $flt16_cct="SELECT count(distinct equipement) AS tot_flt16_cct_booked
            FROM (
            SELECT tbl.* 
            FROM ( SELECT DISTINCT sel_block Block,short_name equipement,sel_block
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE  sel_block IN($blockList)
            ) tbl 
            WHERE sel_block IS NOT NULL ORDER BY equipement
            ) t1 WHERE equipement LIKE 'FLT%' AND block NOT IN ('CSE','CSF')";


            $row_flt16_cct= oci_parse($con_sparcsn4_oracle,$flt16_cct);
            oci_execute($row_flt16_cct);
            $flt16_cct_tot=0;

            while(($rtn_flt16_cct=oci_fetch_object($row_flt16_cct))!=false)
            {
                $flt16_cct_tot=$rtn_flt16_cct->TOT_FLT16_CCT_BOOKED;
            }



            $tot_flt16_booked= $flt16_nct_tot+$flt16_cct_tot+$flt16_nofcy_tot+$flt16_icd_tot;

                // RST 45 START
                    
                $rst45_icd="SELECT COUNT(DISTINCT short_name) AS icd_rst45 
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
                WHERE short_name LIKE 'RST45%' AND sel_block IN ('CSE','CSF')";

                $row_rst45_icd= oci_parse($con_sparcsn4_oracle,$rst45_icd);
                oci_execute($row_rst45_icd);
                $rst45_icd_tot=0;

                while(($rtn_rst45_icd=oci_fetch_object($row_rst45_icd))!=false)
                {
                    $rst45_icd_tot=$rtn_rst45_icd->ICD_RST45;
                }


                $rst45_nct="SELECT COUNT(DISTINCT short_name) AS nct_rst45 
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
                WHERE short_name LIKE 'RST45%'  AND sel_block IN ($blockListNct)";

                $row_rst45_nct= oci_parse($con_sparcsn4_oracle,$rst45_nct);
                oci_execute($row_rst45_nct);

                $rst45_nct_tot=0;

                while(($rtn_rst45_nct=oci_fetch_object($row_rst45_nct))!=false)
                {
                    $rst45_nct_tot=$rtn_rst45_nct->NCT_RST45;
                }



                $rst45_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_rst45
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
                WHERE short_name LIKE 'RST45%' AND sel_block IN ($blockList_NofcyFlat42)";
                $row_rst45_nofcy= oci_parse($con_sparcsn4_oracle,$rst45_nofcy);
                oci_execute($row_rst45_nofcy);
                $rst45_nofcy_tot=0;

                while(($rtn_rst45_nofcy=oci_fetch_object($row_rst45_nofcy))!=false)
                {
                    $rst45_nofcy_tot=$rtn_rst45_nofcy->NOFCY_RST45;
                }



                $rst45_cct="SELECT count(distinct equipement) AS tot_rst45_cct_booked FROM (
                    SELECT tbl.* FROM (
                    SELECT DISTINCT sel_block Block,short_name equipement,sel_block
                    FROM xps_che 
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
                    WHERE sel_block IN($blockList)
                    )  tbl 
                    WHERE sel_block IS NOT NULL ORDER BY equipement
                    )  t1 WHERE equipement LIKE 'RST45%' AND block NOT IN ('CSE','CSF')";


                $row_rst45_cct= oci_parse($con_sparcsn4_oracle,$rst45_cct);
                oci_execute($row_rst45_cct);
                $rst45_cct_tot=0;

                while(($rtn_rst45_cct=oci_fetch_object($row_rst45_cct))!=false)
                {
                    $rst45_cct_tot=$rtn_rst45_cct->TOT_RST45_CCT_BOOKED;
                }

                $tot_rst45_booked= $rst45_nct_tot+$rst45_cct_tot+$rst45_nofcy_tot+$rst45_icd_tot;











        // RST 7 START
     
        $rst7_icd="SELECT COUNT(DISTINCT short_name) AS icd_rst7 
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'RST7%' AND sel_block IN ('CSE','CSF')";
      
       $row_rst7_icd= oci_parse($con_sparcsn4_oracle,$rst7_icd);
       oci_execute($row_rst7_icd);
		$rst7_icd_tot=0;
     
       while(($rtn_rst7_icd=oci_fetch_object($row_rst7_icd))!=false)
		{
			 $rst7_icd_tot=$rtn_rst7_icd->ICD_RST7;
		}

      
        $rst7_nct="SELECT COUNT(DISTINCT short_name) AS nct_rst7 
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'RST7%'  AND sel_block IN ($blockListNct)";
     
       $row_rst7_nct= oci_parse($con_sparcsn4_oracle,$rst7_nct);
       oci_execute($row_rst7_nct);
		
		$rst7_nct_tot=0;
       
        while(($rtn_rst7_nct=oci_fetch_object($row_rst7_nct))!=false)
		{
			 $rst7_nct_tot=$rtn_rst7_nct->NCT_RST7;
		}
       

       
        $rst7_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_rst7
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'RST7%' AND sel_block IN ($blockList_NofcyFlat42)";
       $row_rst7_nofcy= oci_parse($con_sparcsn4_oracle,$rst7_nofcy);
       oci_execute($row_rst7_nofcy);
		$rst7_nofcy_tot=0;
        
        while(($rtn_rst7_nofcy=oci_fetch_object($row_rst7_nofcy))!=false)
		{
			 $rst7_nofcy_tot=$rtn_rst7_nofcy->NOFCY_RST7;
		}

    

        $rst7_cct="SELECT count(distinct equipement) AS tot_rst7_cct_booked FROM (
            SELECT tbl.* FROM (
            SELECT DISTINCT sel_block Block,short_name equipement,sel_block
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE sel_block IN($blockList)
            )  tbl 
            WHERE sel_block IS NOT NULL ORDER BY equipement
            )  t1 WHERE equipement LIKE 'RST7%' AND block NOT IN ('CSE','CSF')";

      
       $row_rst7_cct= oci_parse($con_sparcsn4_oracle,$rst7_cct);
       oci_execute($row_rst7_cct);
		$rst7_cct_tot=0;
        
        while(($rtn_rst7_cct=oci_fetch_object($row_rst7_cct))!=false)
		{
			 $rst7_cct_tot=$rtn_rst7_cct->TOT_RST7_CCT_BOOKED;
		}

        $tot_rst7_booked= $rst7_nct_tot+$rst7_cct_tot+$rst7_nofcy_tot+$rst7_icd_tot;

        // RST 7 END


        // CM START
     
        $cm_icd="SELECT COUNT(DISTINCT short_name) AS icd_cm
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'CM%' AND sel_block IN ('CSE','CSF')";
      
       $row_cm_icd= oci_parse($con_sparcsn4_oracle,$cm_icd);
       oci_execute($row_cm_icd);
	   $cm_icd_tot=0;
     
       while(($rtn_cm_icd=oci_fetch_object($row_cm_icd))!=false)
		{
			 $cm_icd_tot=$rtn_cm_icd->ICD_CM;
		}

      
        $cm_nct="SELECT COUNT(DISTINCT short_name) AS nct_cm 
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'CM%'  AND sel_block IN ($blockListNct)";
     
       $row_cm_nct= oci_parse($con_sparcsn4_oracle,$cm_nct);
       oci_execute($row_cm_nct);
		
		$cm_nct_tot=0;
       
        while(($rtn_cm_nct=oci_fetch_object($row_cm_nct))!=false)
		{
			 $cm_nct_tot=$rtn_cm_nct->NCT_CM;
		}
       

       
        $cm_nofcy="SELECT COUNT(DISTINCT short_name) AS nofcy_cm
        FROM xps_che
        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id  
        WHERE short_name LIKE 'CM%' AND sel_block IN ($blockList_NofcyFlat42)";
        $row_cm_nofcy= oci_parse($con_sparcsn4_oracle,$cm_nofcy);
        oci_execute($row_cm_nofcy);
		$cm_nofcy_tot=0;
        
        while(($rtn_cm_nofcy=oci_fetch_object($row_cm_nofcy))!=false)
		{
			 $cm_nofcy_tot=$rtn_cm_nofcy->NOFCY_CM;
		}

    

        $cm_cct="SELECT count(distinct equipement) AS tot_cm_cct_booked FROM (
            SELECT tbl.* FROM (
            SELECT DISTINCT sel_block Block,short_name equipement,sel_block
            FROM xps_che 
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
            WHERE sel_block IN($blockList)
            )  tbl 
            WHERE sel_block IS NOT NULL ORDER BY equipement
            )  t1 WHERE equipement LIKE 'CM%' AND block NOT IN ('CSE','CSF')";

      
       $row_cm_cct= oci_parse($con_sparcsn4_oracle,$cm_cct);
       oci_execute($row_cm_cct);
	   $cm_cct_tot=0;
        
        while(($rtn_cm_cct=oci_fetch_object($row_cm_cct))!=false)
		{
			 $cm_cct_tot=$rtn_cm_cct->TOT_CM_CCT_BOOKED;
		}

        $tot_cm_booked= $cm_nct_tot+$cm_cct_tot+$cm_nofcy_tot+$cm_icd_tot;




        //RMG demand - end

        $equipArray= Array();

        $tot_equip_rtg=0;
        $tot_equip_rtg_ab=0;
        $tot_equip_rtg_c=0;

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
        $tot_equip_rst7_d=0;

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
            <!-- QGC query -->
            <?php
            $jrDeVal="";
            $abDeVal="";
            $refDeVal="";
            $y7DeVal="";
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/

            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);




        
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
            $scyDeVal="";
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
            <td><?php echo $scyDeVal; ?></td>
            <td><?php echo $y12DeVal; ?></td>
            <td><?php echo $y3DeVal; ?></td>
            <td><?php echo $y5DeVal; ?></td>
            <td><?php echo $y6DeVal; ?></td>
            <td><?php echo $y8BDeVal; ?></td>
            <td><?php echo $bapxDeVal; ?></td> <!-- BX2 field no 11 -->
            <td><?php echo $y910DeVal; ?></td>
            <td><?php echo $y11DeVal; ?></td>
            <td><?php echo $ncyDeVal; ?></td>
            <td><?php if($qgc_cct_tot!=0) echo $qgc_cct_tot;?></td>
            <td><?php if($qgc_nct_tot!=0) echo $qgc_nct_tot;?></td>
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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(scy,'-') AS scy,IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RTG%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RTG%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RTG%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RTG%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RTG%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RTG%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RTG%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RTG%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RTG%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RTG%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RTG%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RTG%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RTG%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RTG%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RTG%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RTG%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RTG%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RTG%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/

            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,
			IFNULL(scy,'-') AS scy,IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RTG%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RTG%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RTG%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RTG%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RTG%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
               
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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

          // strChkShareJrSc for get block start
        
      $block_strChkShareJrSc_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa ='JR' ORDER BY block ASC";
 
      $block_strChkShareJrSc_Res=mysqli_query($con_cchaportdb,$block_strChkShareJrSc_qu);
      $totalRow_strChkShareJrSc=mysqli_num_rows($block_strChkShareJrSc_Res);

       $u=0;
       $blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_jr=Array();
	   
       while($blockRow_strChkShareJrSc=mysqli_fetch_object($block_strChkShareJrSc_Res)){
		   
		   
        $blockString_strChkShareJrSc="";
        $blockString_strChkShareJrSc=$blockRow_strChkShareJrSc->block;
		
		$blocks = "'".$blockString_strChkShareJrSc."'";
		array_push($blocklist_jr,$blocks);
							
/*        if($u==($totalRow_strChkShareJrSc-1)){
          $blockList_strChkShareJrSc=$blockList_strChkShareJrSc."'".$blockString_strChkShareJrSc."'";           
       }
       else{
         $blockList_strChkShareJrSc=$blockList_strChkShareJrSc."'".$blockString_strChkShareJrSc."',";
       }
        $u++; */
 

  }
			$jr_blocks = implode(",",$blocklist_jr);
  
			$str_rtg_jr="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($jr_blocks)";
					
					
 			$res_jr_block= oci_parse($con_sparcsn4_oracle,$str_rtg_jr);
			oci_execute($res_jr_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_jr_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_jr_block); 
 			$res_jr_block= oci_parse($con_sparcsn4_oracle,$str_rtg_jr);
			oci_execute($res_jr_block); 
			$jr_tot_rtg=0;
			while(($rowshare_JR_block = oci_fetch_object($res_jr_block)) != false)
				{
					$jr_tot_rtg = $rowshare_JR_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
				
  
			 //$blockList_strChkShareJrSc;
             //strChkShareJrSc for get block End
/*                 $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa='JR' ORDER BY 1";
				
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                
                $nVal = 0;
                $plusVal = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
                 
                      $strChkShareJrSc ="
                    SELECT tbl.equipement,sel_block
                    FROM (
                    SELECT DISTINCT
                    short_name AS equipement,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id 
                    WHERE short_name ='$equiJrSc' AND sel_block IN($blockList_strChkShareJrSc)
                    )tbl 
                    ";
                   
                  
                    $rst7_nofcy_tot=0;
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                
                   $results1=array();
                   $numRowCSJS = oci_fetch_all($resCSJS, $results1, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                   oci_free_statement($resCSJS); 
                   $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                   oci_execute($resCSJS);
                    if($numRowCSJS>0)
                    {
                       
                         $plusVal +=1;
                        array_push($equipArray, $equiJrSc);
                       
                       while(($rowshareYard= oci_fetch_object($resCSJS)) != false)
                        {
            
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
        
                             $block_cpa .=  $rowsBlockCpa->block_cpa.",";
                         
                            }
                         
                        }
                    }
                    else{
                        $nVal +=1;
                    }
                } */
				//running
                ?>
				
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($jr_tot_rtg==0)
                    echo'-';
                     else
					echo $jr_tot_rtg;
                /*     if($nVal>0 and $plusVal>0)
                    {
						
                        $tot_equip_rtg=$tot_equip_rtg+$nVal+$plusVal;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nVal+$plusVal;
                        echo $nVal.",".$plusVal."+";
                    }
                    else if($nVal>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nVal;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nVal;
                        echo $nVal;
                    }
                    else if($plusVal>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusVal;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$plusVal;
                        echo $plusVal."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab;
                       // echo  print_r($blocklist)."---".$block_strChkShareJrSc_qu."-";
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
		<?php		
		$block_strChkShareABzone_rtg="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa ='AB ZONE' ORDER BY block ASC";
 
       $block_strChkShareABzone_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShareABzone_rtg);
       $totalRow_strChkShareABzone_rtg=mysqli_num_rows($block_strChkShareABzone_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";

	   $blocklist_ab=Array();
	   
       while($blockRow_strChkShareABzone_rtg=mysqli_fetch_object($block_strChkShareABzone_rtg_Res)){
		   
		   
        $blockString_ChkShareABzone_rtg="";
        $blockString_ChkShareABzone_rtg=$blockRow_strChkShareABzone_rtg->block;
		
		$blocks_ab = "'".$blockString_ChkShareABzone_rtg."'";
		array_push($blocklist_ab,$blocks_ab);
							
		}
			$ab_blocks = implode(",",$blocklist_ab);
  
			$str_rtg_ab="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($ab_blocks)";
					
					
 			$res_ab_block= oci_parse($con_sparcsn4_oracle,$str_rtg_ab);
			oci_execute($res_ab_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_ab_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_ab_block); 
 			$res_ab_block= oci_parse($con_sparcsn4_oracle,$str_rtg_ab);
			oci_execute($res_ab_block); 
			$jr_tot_rtg=0;
			while(($rowshare_AB_block = oci_fetch_object($res_ab_block)) != false)
				{
					$ab_tot_rtg = $rowshare_AB_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
              /*   $block_strChkShareABSc_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
                WHERE  block_cpa!='NULL' AND block_cpa !='AB' ORDER BY block ASC";
          
               $block_strChkShareABSc_Res=mysqli_query($con_sparcsn4,$block_strChkShareABSc_qu);
               $totalRow_strChkShareABSc=mysqli_num_rows($block_strChkShareABSc_Res);
         
               $v=0;
                $blockList_strChkShareABSc="";
                while($blockRow_strChkShareABSc=mysqli_fetch_object($block_strChkShareABSc_Res)){
             
                 $blockString_strChkShareABSc="";
             
                 $blockString_strChkShareABSc=$blockRow_strChkShareABSc->block;
               
                if($v==($totalRow_strChkShareABSc-1)){
                   $blockList_strChkShareABSc=$blockList_strChkShareABSc."'".$blockString_strChkShareABSc."'";           
                }
                else{
                  $blockList_strChkShareABSc=$blockList_strChkShareABSc."'".$blockString_strChkShareABSc."',";
                }
                 $v++;
          
         
           }
            //$blockList_strChkShareABSc;

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa='AB ZONE' ORDER BY 1";
               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {                    
                        $strChkShareABSc ="SELECT  tbl.equipement,sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_strChkShareABSc)
                         )tbl ";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);

                      
                       $results2=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results2, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                             $block_cpa .=  $rowsBlockCpa->block_cpa.",";            
                            }
                               
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($ab_tot_rtg==0)
                    echo'-';
                     else
						echo $ab_tot_rtg;
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                //for differ
				
		$block_strChkShare_D_reefer_rtg="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa ='D-REEFER' ORDER BY block ASC";
 
       $block_strChkShare_D_reefer_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_D_reefer_rtg);
       $totalRow_strChkShare_D_reefer_rtg=mysqli_num_rows($block_strChkShare_D_reefer_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";

	   $blocklist_D_reefer=Array();
	   
       while($blockRow_strChkShare_D_reefer_rtg=mysqli_fetch_object($block_strChkShare_D_reefer_rtg_Res)){
		   
		   
        //$blockString_ChkShareABzone_rtg="";
        $blockString_ChkShare_D_reefer_rtg=$blockRow_strChkShare_D_reefer_rtg->block;
		
		$blocks_D_reefer = "'".$blockString_ChkShare_D_reefer_rtg."'";
		array_push($blocklist_D_reefer,$blocks_D_reefer);
							
		}
			$d_reefer_blocks = implode(",",$blocklist_D_reefer);
  
			$str_rtg_D_reefer="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($d_reefer_blocks)";
					
					
 			$res_D_reefer_block= oci_parse($con_sparcsn4_oracle,$str_rtg_D_reefer);
			oci_execute($res_D_reefer_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_D_reefer_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_D_reefer_block); 
 			$res_D_reefer= oci_parse($con_sparcsn4_oracle,$str_rtg_D_reefer);
			oci_execute($res_D_reefer); 
			$d_reefer_tot_rtg=0;
			while(($rowshare_D_reefer_block = oci_fetch_object($res_D_reefer)) != false)
				{
					$d_reefer_tot_rtg = $rowshare_D_reefer_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
                /* $block_DREFFER_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
                WHERE  block_cpa!='NULL' AND block_cpa !='D-REEFER' ORDER BY block ASC";
          
               $block_DREFFER_Res=mysqli_query($con_sparcsn4,$block_DREFFER_qu);
               $totalRow_DREFFER=mysqli_num_rows($block_DREFFER_Res);
         
                $ab1=0;
                $blockList_DREFFER="";
                while($blockRow_DREFFER=mysqli_fetch_object($block_DREFFER_Res)){
             
                 $blockString_DREFFER="";
             
                 $blockString_DREFFER=$blockRow_DREFFER->block;
               
                if($ab1==($totalRow_DREFFER-1)){
                   $blockList_DREFFER=$blockList_DREFFER."'".$blockString_DREFFER."'";           
                }
                else{
                  $blockList_DREFFER=$blockList_DREFFER."'".$blockString_DREFFER."',";
                }
                 $ab1++;
          
         
           }
            $blockList_DREFFER;

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa='D-REEFER' ORDER BY 1";

              
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc = "SELECT  tbl.equipement,sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_DREFFER)
                        )tbl";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                       
                        $results3=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results3, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                           while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                              
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($d_reefer_tot_rtg==0)
                    echo'-';
                     else
					echo $d_reefer_tot_rtg;
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

                //block for y7 start
				
				
	  $block_strChkShare_y7_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa ='YARD 7' ORDER BY block ASC";
 
      $block_strChkShare_y7_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y7_rtg_qu);
      $totalRow_strChkShare_y7_rtg=mysqli_num_rows($block_strChkShare_y7_rtg_Res);

       $u=0;
       $blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y7=Array();
	   
       while($blockRow_strChkShare_y7_rtg=mysqli_fetch_object($block_strChkShare_y7_rtg_Res)){
		   
		   
        $blockString_strChkShare_y7_rtg="";
        $blockString_strChkShare_y7_rtg=$blockRow_strChkShare_y7_rtg->block;
		
		$blocks_y7 = "'".$blockString_strChkShare_y7_rtg."'";
		array_push($blocklist_y7,$blocks_y7);
							
/*        if($u==($totalRow_strChkShareJrSc-1)){
          $blockList_strChkShareJrSc=$blockList_strChkShareJrSc."'".$blockString_strChkShareJrSc."'";           
       }
       else{
         $blockList_strChkShareJrSc=$blockList_strChkShareJrSc."'".$blockString_strChkShareJrSc."',";
       }
        $u++; */
		}
			$y7_blocks = implode(",",$blocklist_y7);
  
			$str_rtg_y7="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y7_blocks)";
					
					
 			$res_y7_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y7);
			oci_execute($res_y7_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y7_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y7_block); 
 			$res_y7_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y7);
			oci_execute($res_y7_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y7_block = oci_fetch_object($res_y7_block)) != false)
				{
					$y7_tot_rtg = $rowshare_y7_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
				
				
/*                 $block_Y7_qu="SELECT DISTINCT block as block FROM ctmsmis.yard_block
                WHERE  block_cpa!='NULL' AND block_cpa !='YARD 7' ORDER BY block ASC";
          
               $block_Y7_Res=mysqli_query($con_sparcsn4,$block_Y7_qu);
               $totalRow_Y7=mysqli_num_rows($block_Y7_Res);
         
               $ab3=0;
                $blockList_Y7="";
                while($blockRow_Y7=mysqli_fetch_object($block_Y7_Res)){
             
                 $blockString_Y7="";
             
                 $blockString_Y7=$blockRow_Y7->block;
               
                if($ab3==($totalRow_Y7-1)){
                   $blockList_Y7=$blockList_Y7."'".$blockString_Y7."'";           
                }
                else{
                  $blockList_Y7=$blockList_Y7."'".$blockString_Y7."',";
                }
                 $ab3++;
          
         
           }
             $blockList_Y7;
                // block for y7 end

              
                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block 
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa='YARD 7' ORDER BY 1
				";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = "SELECT  tbl.equipement,sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                        )tbl";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                      
                        $results4=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results4, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                              
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y7_tot_rtg==0)
                    echo'-';
                     else
					echo $y7_tot_rtg;
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
    <?php
	//block for SCY start

	$block_strChkShare_scy_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa LIKE 'SL%' ORDER BY block ASC";
 
      $block_strChkShare_scy_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_scy_rtg_qu);
      $totalRow_strChkShare_scy_rtg=mysqli_num_rows($block_strChkShare_scy_rtg_Res);

       $u=0;
       $blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_scy=Array();
	   
       while($blockRow_strChkShare_scy_rtg=mysqli_fetch_object($block_strChkShare_scy_rtg_Res)){
		   
		   
        $blockString_strChkShare_scy_rtg="";
        $blockString_strChkShare_scy_rtg=$blockRow_strChkShare_scy_rtg->block;
		
		$blocks_scy = "'".$blockString_strChkShare_scy_rtg."'";
		array_push($blocklist_scy,$blocks_scy);
							
		}
			$scy_blocks = implode(",",$blocklist_scy);
  
			$str_rtg_scy="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($scy_blocks)";
					
					
 			$res_scy_block= oci_parse($con_sparcsn4_oracle,$str_rtg_scy);
			oci_execute($res_scy_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_scy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_scy_block); 
 			$res_scy_block= oci_parse($con_sparcsn4_oracle,$str_rtg_scy);
			oci_execute($res_scy_block); 
			$jr_tot_rtg=0;
			while(($rowshare_scy_block = oci_fetch_object($res_scy_block)) != false)
				{
					$scy_tot_rtg = $rowshare_scy_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
		/* $block_SCY_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
		WHERE  block_cpa!='NULL' AND block_cpa !='SCY' ORDER BY block ASC";

		$block_SCY_Res=mysqli_query($con_sparcsn4,$block_SCY_qu);
		$totalRow_SCY=mysqli_num_rows($block_SCY_Res);

		$ab4=0;
		$blockList_SCY="";
		while($blockRow_SCY=mysqli_fetch_object($block_SCY_Res)){

		 $blockString_SCY="";

		 $blockString_SCY=$blockRow_SCY->block;

		if($ab4==($totalRow_SCY-1)){
		   $blockList_SCY=$blockList_SCY."'".$blockString_SCY."'";           
		}
		else{
		  $blockList_SCY=$blockList_SCY."'".$blockString_SCY."',";
		}
		 $ab4++;


		}
		 $blockList_SCY;
		// block for SCY end
                $strSCYSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa='SCY' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strSCYSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                
               
                
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        

                        $strChkShareABSc ="SELECT  tbl.equipement,sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                        )tbl";
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        
                        $results5=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results5, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                              
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($scy_tot_rtg==0)
                    echo'-';
                     else
					echo $scy_tot_rtg;
                    /* if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_ab=$tot_equip_rtg_ab;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <!-- WORKSHOP-C-->
            <td>
                <?php

            //block for YARD 1, 2, MN start
			
		$block_strChkShare_y_1_2_mn_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa IN ('YARD-1', 'YARD 2', 'MN YARD') ORDER BY block ASC";
 
      $block_strChkShare_y_1_2_mn_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y_1_2_mn_rtg_qu);
      $totalRow_strChkShare_y_1_2_mn_rtg=mysqli_num_rows($block_strChkShare_y_1_2_mn_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y_1_2_mn=Array();
	   
       while($blockRow_strChkShare_y_1_2_mn_rtg=mysqli_fetch_object($block_strChkShare_y_1_2_mn_rtg_Res)){
		   
		   
        $blockString_strChkShare_y_1_2_mn_rtg="";
        $blockString_strChkShare_y_1_2_mn_rtg=$blockRow_strChkShare_y_1_2_mn_rtg->block;
		
		$blocks_y_1_2_mn = "'".$blockString_strChkShare_y_1_2_mn_rtg."'";
		array_push($blocklist_y_1_2_mn,$blocks_y_1_2_mn);
							
		}
			$y_1_2_mn_blocks = implode(",",$blocklist_y_1_2_mn);
  
			 $str_rtg_y_1_2_mn="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y_1_2_mn_blocks)";
					
					
 			$res_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_1_2_mn);
			oci_execute($res_y_1_2_mn_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y_1_2_mn_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y_1_2_mn_block); 
 			$res_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_1_2_mn);
			oci_execute($res_y_1_2_mn_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y_1_2_mn_block = oci_fetch_object($res_y_1_2_mn_block)) != false)
				{
					$y_1_2_mn_tot_rtg = $rowshare_y_1_2_mn_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
          /*   $block_Y1Y2YMN_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
            WHERE  block_cpa!='NULL' AND block_cpa NOT IN('YARD-1','YARD 2','MN YARD') ORDER BY block ASC";

            $block_Y1Y2YMN_Res=mysqli_query($con_sparcsn4,$block_Y1Y2YMN_qu);
            $totalRow_Y1Y2YMN=mysqli_num_rows($block_Y1Y2YMN_Res);

            $ab5=0;
            $blockList_Y1Y2YMN="";
            while($blockRow_Y1Y2YMN=mysqli_fetch_object($block_Y1Y2YMN_Res)){

            $blockString_Y1Y2YMN="";

            $blockString_Y1Y2YMN=$blockRow_Y1Y2YMN->block;

            if($ab5==($totalRow_Y1Y2YMN-1)){
            $blockList_Y1Y2YMN=$blockList_Y1Y2YMN."'".$blockString_Y1Y2YMN."'";           
            }
            else{
            $blockList_Y1Y2YMN=$blockList_Y1Y2YMN."'".$blockString_Y1Y2YMN."',";
            }
            $ab5++;


            }
            $blockList_Y1Y2YMN;
            // block for SCY end

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('YARD-1','YARD 2','MN YARD') ORDER BY 1";
               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                
                
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       

                        $strChkShareABSc ="SELECT equipement,sel_block
                        FROM (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name ='$equiABSc' AND sel_block IN($blockList_Y1Y2YMN)
                        ) tbl";
                        
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results6=array();
                         $numRowCSAS = oci_fetch_all($resCSAS, $results6, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                      
                                    $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                               
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($y_1_2_mn_tot_rtg==0)
                     echo'-';
                      else
							echo $y_1_2_mn_tot_rtg;
                   
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                 //block for Y3 start
				 
		$block_strChkShare_y_3_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa='YARD 3' ORDER BY block ASC";
 
      $block_strChkShare_y_3_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y_3_rtg_qu);
      $totalRow_strChkShare_y_3_rtg=mysqli_num_rows($block_strChkShare_y_3_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
		   $blocklist_y_3=Array();
		   
		   while($blockRow_strChkShare_y_3_rtg=mysqli_fetch_object($block_strChkShare_y_3_rtg_Res)){
			   
			   
			$blockString_strChkShare_y_3_rtg="";
			$blockString_strChkShare_y_3_rtg=$blockRow_strChkShare_y_3_rtg->block;
			
			$blocks_y_3 = "'".$blockString_strChkShare_y_3_rtg."'";
			array_push($blocklist_y_3,$blocks_y_3);
								
			}
			$y_3_blocks = implode(",",$blocklist_y_3);
  
			 $str_rtg_y_3="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y_3_blocks)";
					
					
 			$res_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_3);
			oci_execute($res_y_3_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y_3_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y_3_block); 
 			$res_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_3);
			oci_execute($res_y_3_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y_3_block = oci_fetch_object($res_y_3_block)) != false)
				{
					$y_3_tot_rtg = $rowshare_y_3_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
				
               /*  $block_Y3_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
                WHERE  block_cpa!='NULL' AND block_cpa !='YARD 3' ORDER BY block ASC";

                $block_Y3_Res=mysqli_query($con_sparcsn4,$block_Y3_qu);
                $totalRow_Y3=mysqli_num_rows($block_Y3_Res);

                $ab6=0;
                $blockList_Y3="";
                while($blockRow_Y3=mysqli_fetch_object($block_Y3_Res)){

                $blockString_Y3="";

                $blockString_Y3=$blockRow_Y3->block;

                if($ab6==($totalRow_Y3-1)){
                $blockList_Y3=$blockList_Y3."'".$blockString_Y3."'";           
                }
                else{
                $blockList_Y3=$blockList_Y3."'".$blockString_Y3."',";
                }
                $ab6++;


                }
                $blockList_Y3;
             // block for Y3 end

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('YARD 3') ORDER BY 1";
              
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = "SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl ";
                       
                     
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results7=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results7, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                               
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y_3_tot_rtg==0)
                    echo'-';
                     else
					echo $y_3_tot_rtg;
                    
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				// YARD 05 START--
				
		$block_strChkShare_y_5_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa='YARD 05' ORDER BY block ASC";
 
		$block_strChkShare_y_5_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y_5_rtg_qu);
		$totalRow_strChkShare_y_5_rtg=mysqli_num_rows($block_strChkShare_y_5_rtg_Res);

		$u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y_5=Array();
	   
	   while($blockRow_strChkShare_y_5_rtg=mysqli_fetch_object($block_strChkShare_y_5_rtg_Res)){
		   
		   
		$blockString_strChkShare_y_5_rtg="";
		$blockString_strChkShare_y_5_rtg=$blockRow_strChkShare_y_5_rtg->block;
		
		$blocks_y_5 = "'".$blockString_strChkShare_y_5_rtg."'";
		array_push($blocklist_y_5,$blocks_y_5);
							
		}
			$y_5_blocks = implode(",",$blocklist_y_5);
  
			 $str_rtg_y_5="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y_5_blocks)";
					
					
 			$res_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_5);
			oci_execute($res_y_5_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y_5_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y_5_block); 
 			$res_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_5);
			oci_execute($res_y_5_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y_5_block = oci_fetch_object($res_y_5_block)) != false)
				{
					$y_5_tot_rtg = $rowshare_y_5_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
				
                //block for Y5 start
             /*   $block_Y5_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
               WHERE  block_cpa!='NULL' AND block_cpa !='YARD 05' ORDER BY block ASC";

               $block_Y5_Res=mysqli_query($con_sparcsn4,$block_Y5_qu);
               $totalRow_Y5=mysqli_num_rows($block_Y5_Res);

              $ab7=0;
              $blockList_Y5="";
              while($blockRow_Y5=mysqli_fetch_object($block_Y5_Res)){

                $blockString_Y5="";
                
                $blockString_Y5=$blockRow_Y5->block;
                
                if($ab7==($totalRow_Y5-1)){
                $blockList_Y5=$blockList_Y5."'".$blockString_Y5."'";           
                }
                else{
                $blockList_Y5=$blockList_Y5."'".$blockString_Y5."',";
                }
                $ab7++;
                
                
                }
                  $blockList_Y5;
               // block for Y5 end

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('YARD 05') ORDER BY 1";

                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC))
                {
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = " SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y5)
                        )tbl";

                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results8=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results8, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                
                                }
                               
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y_5_tot_rtg==0)
                    echo'-';
                     else
					echo $y_5_tot_rtg;
                    /* if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */

                    ?>
                </label>
            </td>
            <td>
                <?php
                //block for 'Y6','Y6X' start
				
		$block_strChkShare_y_6_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
		WHERE block_cpa='YARD 6' ORDER BY block ASC";
 
      $block_strChkShare_y_6_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y_6_rtg_qu);
      $totalRow_strChkShare_y_6_rtg=mysqli_num_rows($block_strChkShare_y_6_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y_6=Array();
	   
       while($blockRow_strChkShare_y_6_rtg=mysqli_fetch_object($block_strChkShare_y_6_rtg_Res)){
		   
		   
        $blockString_strChkShare_y_6_rtg="";
        $blockString_strChkShare_y_6_rtg=$blockRow_strChkShare_y_6_rtg->block;
		
		$blocks_y_6 = "'".$blockString_strChkShare_y_6_rtg."'";
		array_push($blocklist_y_6,$blocks_y_6);
							
		}
			$y_6_blocks = implode(",",$blocklist_y_6);
  
			 $str_rtg_y_6="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y_6_blocks)";
					
					
 			$res_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_6);
			oci_execute($res_y_6_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y_6_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y_6_block); 
 			$res_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y_6);
			oci_execute($res_y_6_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y_6_block = oci_fetch_object($res_y_6_block)) != false)
				{
					$y_6_tot_rtg = $rowshare_y_6_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}		
				
             /*  $block_Y6_Y6X_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('YARD 6') ORDER BY block ASC";

              $block_Y6_Y6X_Res=mysqli_query($con_sparcsn4,$block_Y6_Y6X_qu);
              $totalRow_Y6_Y6X=mysqli_num_rows($block_Y6_Y6X_Res);

             $ab8=0;
             $blockList_Y6_Y6X_NotIn="";
             while($blockRow_Y6_Y6X=mysqli_fetch_object($block_Y6_Y6X_Res)){

                $blockString_Y6_Y6X="";
                
                $blockString_Y6_Y6X=$blockRow_Y6_Y6X->block;
                
                if($ab8==($totalRow_Y6_Y6X-1)){
                $blockList_Y6_Y6X_NotIn=$blockList_Y6_Y6X_NotIn."'".$blockString_Y6_Y6X."'";           
                }
                else{
                $blockList_Y6_Y6X_NotIn=$blockList_Y6_Y6X_NotIn."'".$blockString_Y6_Y6X."',";
                }
                $ab8++;
                
                
                }
                 $blockList_Y6_Y6X_NotIn;
               // block for Y6 or Y6X end
                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('YARD 6') ORDER BY 1";
                
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc = " SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                        )tbl";
                       
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results9=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results9, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                    if ($y_6_tot_rtg==0)
                    echo'-';
                     else
					echo $y_6_tot_rtg;
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                 //block for Yard 8B start
      $block_strChkShare_y8b_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa ='YARD 8' AND block LIKE '%Y8B%' ORDER BY block ASC";
 
      $block_strChkShare_y8b_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y8b_rtg_qu);
      $totalRow_strChkShare_y8b_rtg=mysqli_num_rows($block_strChkShare_y8b_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y8b=Array();
	   
       while($blockRow_strChkShare_y8b_rtg=mysqli_fetch_object($block_strChkShare_y8b_rtg_Res)){
		   
		   
        $blockString_strChkShare_y8b_rtg="";
        $blockString_strChkShare_y8b_rtg=$blockRow_strChkShare_y8b_rtg->block;
		
		$blocks_y8b = "'".$blockString_strChkShare_y8b_rtg."'";
		array_push($blocklist_y8b,$blocks_y8b);
							
		}
			$y8b_blocks = implode(",",$blocklist_y8b);
  
			 $str_rtg_y8b="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y8b_blocks)";
					
					
 			$res_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y8b);
			oci_execute($res_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y8b_block); 
 			$res_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y8b);
			oci_execute($res_y8b_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_y8b_block)) != false)
				{
					$y8b_tot_rtg = $rowshare_y8b_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y8b_tot_rtg==0)
                    echo'-';
                     else
					echo $y8b_tot_rtg;
                    /* if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

                   //Get block for 'BX2','Y8','BAPX1','BX1' start
				   
		$block_strChkShare_y8_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
        WHERE  block_cpa IN ('YARD 8', 'BAPEX')  AND block NOT LIKE '%y8b%' ORDER BY block ASC";
 
      $block_strChkShare_y8_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y8_rtg_qu);
      $totalRow_strChkShare_y8_rtg=mysqli_num_rows($block_strChkShare_y8_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y8=Array();
	   
       while($blockRow_strChkShare_y8_rtg=mysqli_fetch_object($block_strChkShare_y8_rtg_Res)){
		   
		   
        $blockString_strChkShare_y8_rtg="";
        $blockString_strChkShare_y8_rtg=$blockRow_strChkShare_y8_rtg->block;
		
		$blocks_y8 = "'".$blockString_strChkShare_y8_rtg."'";
		array_push($blocklist_y8,$blocks_y8);
							
		}
			$y8_blocks = implode(",",$blocklist_y8);
  
			  $str_rtg_y8="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y8_blocks)";
					
					
 			$res_y8_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y8);
			oci_execute($res_y8_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y8_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y8_block); 
 			$res_y8_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y8);
			oci_execute($res_y8_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y8_block = oci_fetch_object($res_y8_block)) != false)
				{
					$y8_tot_rtg = $rowshare_y8_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}	   
             /*  $block_BX2_Y8_BAPX1_BX1_qu="SELECT DISTINCT block AS block FROM yard_block
				WHERE  block_cpa ='YARD 8' AND block NOT LIKE '%Y8B%' ORDER BY block ASC";

              $block_BX2_Y8_BAPX1_BX1_Res=mysqli_query($con_sparcsn4,$block_BX2_Y8_BAPX1_BX1_qu);
              $totalRow_BX2_Y8_BAPX1_BX1=mysqli_num_rows($block_BX2_Y8_BAPX1_BX1_Res);

             $ab10=0;
             $blockList_BX2_Y8_BAPX1_BX1_NotIn="";
             while($blockRow_BX2_Y8_BAPX1_BX1=mysqli_fetch_object($block_BX2_Y8_BAPX1_BX1_Res)){

                $blockString_BX2_Y8_BAPX1_BX1="";
                
                $blockString_BX2_Y8_BAPX1_BX1=$blockRow_BX2_Y8_BAPX1_BX1->block;
                
                if($ab10==($totalRow_BX2_Y8_BAPX1_BX1-1)){
                $blockList_BX2_Y8_BAPX1_BX1_NotIn=$blockList_BX2_Y8_BAPX1_BX1_NotIn."'".$blockString_BX2_Y8_BAPX1_BX1."'";           
                }
                else{
                $blockList_BX2_Y8_BAPX1_BX1_NotIn=$blockList_BX2_Y8_BAPX1_BX1_NotIn."'".$blockString_BX2_Y8_BAPX1_BX1."',";
                }
                $ab10++;
                
                
                }
                $blockList_BX2_Y8_BAPX1_BX1_NotIn;
                //Get block for 'BX2','Y8','BAPX1','BX1' start


                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND 
				equipment LIKE 'RTG%' AND block_cpa IN('YARD 8','BAPEX' ) ORDER BY 1"; 
                //BAPX1,BAPX2 replaced by BX2

               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      

                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                         )tbl ";

                      

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results11=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results11, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                 $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                 while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y8_tot_rtg==0)
                    echo '-';
                     else 
					 echo $y8_tot_rtg;
                
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                     //Get All block but not in 'Y9','Y10' start
        $block_strChkShare_y9_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
        WHERE  block_cpa ='YARD 9' OR block_cpa='YARD-10' ORDER BY block ASC";
 
       $block_strChkShare_y9_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y9_rtg_qu);
       $totalRow_strChkShare_y9_rtg=mysqli_num_rows($block_strChkShare_y9_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y9=Array();
	   
       while($blockRow_strChkShare_y9_rtg=mysqli_fetch_object($block_strChkShare_y9_rtg_Res)){
		   
		   
        $blockString_strChkShare_y9_rtg="";
        $blockString_strChkShare_y9_rtg=$blockRow_strChkShare_y9_rtg->block;
		
		$blocks_y9 = "'".$blockString_strChkShare_y9_rtg."'";
		array_push($blocklist_y9,$blocks_y9);
							
		}
			$y9_blocks = implode(",",$blocklist_y9);
  
			 $str_rtg_y9="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y9_blocks)";
					
					
 			$res_y9_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y9);
			oci_execute($res_y9_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y9_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y9_block); 
 			$res_y9_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y9);
			oci_execute($res_y9_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y9_block = oci_fetch_object($res_y9_block)) != false)
				{
					$y9_tot_rtg = $rowshare_y9_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
					
					} */
				  
				}
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y9_tot_rtg==0)
                    echo'-';
                     else
					echo $y9_tot_rtg;
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                //Get All block but not in Y11 start
				
	  $block_strChkShare_y11_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa ='YARD11'   ORDER BY block ASC";
 
       $block_strChkShare_y11_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y11_rtg_qu);
       $totalRow_strChkShare_y11_rtg=mysqli_num_rows($block_strChkShare_y11_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_y11=Array();
	   
       while($blockRow_strChkShare_y11_rtg=mysqli_fetch_object($block_strChkShare_y11_rtg_Res)){
		   
		   
        $blockString_strChkShare_y11_rtg="";
        $blockString_strChkShare_y11_rtg=$blockRow_strChkShare_y11_rtg->block;
		
		$blocks_y11 = "'".$blockString_strChkShare_y11_rtg."'";
		array_push($blocklist_y11,$blocks_y11);
							
		}
			$y11_blocks = implode(",",$blocklist_y11);
  
			 $str_rtg_y11="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($y11_blocks)";
					
					
 			$res_y11_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y11);
			oci_execute($res_y11_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_y11_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_y11_block); 
 			$res_y11_block= oci_parse($con_sparcsn4_oracle,$str_rtg_y11);
			oci_execute($res_y11_block); 
			$jr_tot_rtg=0;
			while(($rowshare_y11_block = oci_fetch_object($res_y11_block)) != false)
			{
				$y11_tot_rtg = $rowshare_y11_block->TOT;
				/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
				$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
				while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
				 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
				
				} */
			  
			}	
           /*  $block_Y11_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
            WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('YARD11') ORDER BY block ASC";

            $block_Y11_Res=mysqli_query($con_sparcsn4,$block_Y11_qu);
            $totalRow_Y11=mysqli_num_rows($block_Y11_Res);

            $ab12=0;
            $blockList_Y11_NotIn="";
            while($blockRow_Y11=mysqli_fetch_object($block_Y11_Res)){

            $blockString_Y11="";

            $blockString_Y11=$blockRow_Y11->block;

            if($ab12==($totalRow_Y11-1)){
            $blockList_Y11_NotIn=$blockList_Y11_NotIn."'".$blockString_Y11."'";           
            }
            else{
            $blockList_Y11_NotIn=$blockList_Y11_NotIn."'".$blockString_Y11."',";
            }
            $ab12++;


            }
            $blockList_Y11_NotIn;
            //Get All block but not in Y11 End

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('YARD11') ORDER BY 1";
           
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                       
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results13=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results13, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($y11_tot_rtg==0)
                    echo'-';
                     else
					echo $y11_tot_rtg; 
                    /* if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

                //Get All block but not in  NCY start
	  $block_strChkShare_ncy_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
      WHERE  block_cpa ='NCY' ORDER BY block ASC";
 
       $block_strChkShare_ncy_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_ncy_rtg_qu);
       $totalRow_strChkShare_ncy_rtg=mysqli_num_rows($block_strChkShare_ncy_rtg_Res);

       $u=0;
       //$blockList_strChkShareJrSc="";
	   

	   
	   $blocklist_ncy=Array();
	   
       while($blockRow_strChkShare_ncy_rtg=mysqli_fetch_object($block_strChkShare_ncy_rtg_Res)){
		   
		   
        $blockString_strChkShare_ncy_rtg="";
        $blockString_strChkShare_ncy_rtg=$blockRow_strChkShare_ncy_rtg->block;
		
		$blocks_ncy = "'".$blockString_strChkShare_ncy_rtg."'";
		array_push($blocklist_ncy,$blocks_ncy);
							
		}
			$ncy_blocks = implode(",",$blocklist_ncy);
  
			 $str_rtg_ncy="SELECT count(short_name) as tot
					FROM xps_che
					INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
					WHERE short_name LIKE 'RTG%' AND sel_block IN($ncy_blocks)";
					
					
 			$res_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rtg_ncy);
			oci_execute($res_ncy_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_ncy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_ncy_block); 
 			$res_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rtg_ncy);
			oci_execute($res_ncy_block); 
			$jr_tot_rtg=0;
			while(($rowshare_ncy_block = oci_fetch_object($res_ncy_block)) != false)
			{
				$ncy_tot_rtg = $rowshare_ncy_block->TOT;
				/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
				$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
				while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
				 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
				
				} */
			  
			}			
             /*  $block_NCY_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('NCY') ORDER BY block ASC";

              $block_NCY_Res=mysqli_query($con_sparcsn4,$block_NCY_qu);
              $totalRow_NCY=mysqli_num_rows($block_NCY_Res);

             $ab14=0;
             $blockList_NCY_NotIn="";
             while($blockRow_NCY=mysqli_fetch_object($block_NCY_Res)){

                $blockString_NCY="";
                
                $blockString_NCY=$blockRow_NCY->block;
                
                if($ab14==($totalRow_NCY-1)){
                $blockList_NCY_NotIn=$blockList_NCY_NotIn."'".$blockString_NCY."'";           
                }
                else{
                $blockList_NCY_NotIn=$blockList_NCY_NotIn."'".$blockString_NCY."',";
                }
                $ab14++;
                
                
                }
                 $blockList_NCY_NotIn;
                 //Get All block but not in NCY End

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RTG%' AND block_cpa in('NCY') ORDER BY 1";
               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                        )tbl";
                       
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results14=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results14, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                 $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($ncy_tot_rtg==0)
                     echo'-';
                      else
						echo $ncy_tot_rtg;  
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$nValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$nValAB;
                        echo $nValAB;
                    }
                    else if($plusValAB>0){
                        $tot_equip_rtg=$tot_equip_rtg+$plusValAB;
                        $tot_equip_rtg_c=$tot_equip_rtg_c+$plusValAB;
                        echo $plusValAB."+";
                    }
                    else{
                        $tot_equip_rtg=$tot_equip_rtg;
                        $tot_equip_rtg_c=$tot_equip_rtg_c;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <!-- Workshop-D-->
            <td><?php echo $rtg_cct_tot; ?></td>
            <td><?php echo $rtg_nct_tot;?></td>
            <td><?php echo $icdDeVal; ?></td>
            <td><?php echo $nofcyDeVal; ?></td>
            <td><?php echo $tot_rtg_booked + $tot_equip_rtg + $jr_tot_rtg + $ab_tot_rtg + $d_reefer_tot_rtg + $y7_tot_rtg + $scy_tot_rtg + $y_1_2_mn_tot_rtg
                  + $y_3_tot_rtg + $y_5_tot_rtg + $y_6_tot_rtg + $ncy_tot_rtg + $y11_tot_rtg + $y8_tot_rtg + $y8b_tot_rtg; ?></td>

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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'MHC%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'MHC%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'MHC%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'MHC%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'MHC%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'MHC%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'MHC%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'MHC%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'MHC%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'MHC%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'MHC%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'MHC%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'MHC%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'MHC%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'MHC%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'MHC%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'MHC%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'MHC%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'MHC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'MHC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'MHC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'MHC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'MHC%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
			
			
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
				
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
            $scyDeVal="";
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

          /*  $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/

            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
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
            <td><?php echo $scyDeVal; ?></td>
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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RMG%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RMG%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RMG%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RMG%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RMG%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RMG%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RMG%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RMG%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RMG%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RMG%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RMG%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RMG%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RMG%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RMG%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RMG%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RMG%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RMG%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RMG%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RMG%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RMG%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RMG%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RMG%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RMG%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);




            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'QGC%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'QGC%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'QGC%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'QGC%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'QGC%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'QGC%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'QGC%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'QGC%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'QGC%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'QGC%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'QGC%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'QGC%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'QGC%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/

            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'QGC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'QGC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'QGC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'QGC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'QGC%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
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
            <td><?php echo $scyDeVal; ?></td>
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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'SC%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'SC%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'SC%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'SC%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'SC%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'SC%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'SC%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'SC%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'SC%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'SC%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'SC%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'SC%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'SC%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'SC%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'SC%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'SC%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'SC%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'SC%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/

            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'SC%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'SC%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'SC%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'SC%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'SC%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
                 //Get All block but not equal to JR ' start

	/* 	  $block_strChkShare_y_5_rtg_qu="SELECT DISTINCT block AS block FROM yard_block
			WHERE block_cpa='YARD 05' ORDER BY block ASC";
	 
		  $block_strChkShare_y_5_rtg_Res=mysqli_query($con_cchaportdb,$block_strChkShare_y_5_rtg_qu);
		  $totalRow_strChkShare_y_5_rtg=mysqli_num_rows($block_strChkShare_y_5_rtg_Res);

		   $u=0;
		   //$blockList_strChkShareJrSc="";
		   

		   
		   $blocklist_y_5=Array();
		   
		   while($blockRow_strChkShare_y_5_rtg=mysqli_fetch_object($block_strChkShare_y_5_rtg_Res)){
			   
			   
			$blockString_strChkShare_y_5_rtg="";
			$blockString_strChkShare_y_5_rtg=$blockRow_strChkShare_y_5_rtg->block;
			
			$blocks_y_5 = "'".$blockString_strChkShare_y_5_rtg."'";
			array_push($blocklist_y_5,$blocks_y_5);
								
			} 
				$y_5_blocks = implode(",",$blocklist_y_5);
				*/
	  
				 $str_jr_sc="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'SC%' AND sel_block IN($jr_blocks)";
						
						
				$res_jr_sc_block= oci_parse($con_sparcsn4_oracle,$str_jr_sc);
				oci_execute($res_jr_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_jr_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_jr_sc_block); 
				$res_jr_sc_block= oci_parse($con_sparcsn4_oracle,$str_jr_sc);
				oci_execute($res_jr_sc_block); 
				$jr_tot_rtg=0;
				while(($rowshare_jr_sc_block = oci_fetch_object($res_jr_sc_block)) != false)
					{
						$jr_tot_sc = $rowshare_jr_sc_block->TOT;				  
					}
            /*   $block_NotEqTo_JR_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND  block_cpa !='JR' ORDER BY block ASC";
			  /*$block_NotEqTo_JR_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block!='NULL' AND  block !='JR' ORDER BY block ASC";

              $block_JR_Res=mysqli_query($con_sparcsn4,$block_NotEqTo_JR_qu);
              $totalRow_JR=mysqli_num_rows($block_JR_Res);

             $ab13=0;
             $blockList_JR_NotIn="";
             while($blockRow_JR=mysqli_fetch_object($block_JR_Res)){

                $blockString_JR="";
                
                $blockString_JR=$blockRow_JR->block;
                
                if($ab13==($totalRow_JR-1)){
                $blockList_JR_NotIn=$blockList_JR_NotIn."'".$blockString_JR."'";           
                }
                else{
                $blockList_JR_NotIn=$blockList_JR_NotIn."'".$blockString_JR."',";
                }
                $ab13++;
                
                
                }
                 //$blockList_JR_NotIn;
                 //Get All block but not equal to JR End
                $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='JR' ORDER BY 1";
               
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                $nVal = 0;
                $plusVal = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
            
                    $strChkShareJrSc ="SELECT  tbl.equipement,tbl.sel_block
                    FROM (
                    SELECT DISTINCT 
                    short_name AS equipement,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiJrSc' AND sel_block IN($blockList_JR_NotIn)
                    )tbl";
                   
                  
				   $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
				   oci_execute($resCSJS);
				   $results15=array();
				   $numRowCSJS = oci_fetch_all($resCSJS, $results15, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				   oci_free_statement($resCSJS); 
				   $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
				   oci_execute($resCSJS);
				   
                    if($numRowCSJS>0)
                    {
                        $plusVal +=1;
                        array_push($equipArray, $equiJrSc);                      

                        while(($rowshareYard = oci_fetch_object($resCSJS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
								$block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nVal +=1;
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($jr_tot_sc==0)
                    echo'-';
                     else
                     echo $jr_tot_sc;  
                   /*  if($nVal>0 and $plusVal>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='AB ZONE' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        

                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_strChkShareABSc)
                        )tbl";

                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results16=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results16, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);

                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
				
				$str_ab_sc="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'SC%' AND sel_block IN($ab_blocks)";
						
						
				$res_ab_sc_block= oci_parse($con_sparcsn4_oracle,$str_ab_sc);
				oci_execute($res_ab_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_ab_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_ab_sc_block); 
				$res_ab_sc_block= oci_parse($con_sparcsn4_oracle,$str_ab_sc);
				oci_execute($res_ab_sc_block); 
				$ab_tot_rtg=0;
				while(($rowshare_ab_sc_block = oci_fetch_object($res_ab_sc_block)) != false)
					{
						$ab_tot_sc = $rowshare_ab_sc_block->TOT;				  
					}
				
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($ab_tot_sc==0)
                     echo'-';
                      else
                    echo $ab_tot_sc;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				
				$str_d_reefer_sc="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'SC%' AND sel_block IN($d_reefer_blocks)";
						
						
				$res_d_reefer_sc_block= oci_parse($con_sparcsn4_oracle,$str_d_reefer_sc);
				oci_execute($res_d_reefer_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_d_reefer_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_d_reefer_sc_block); 
				$res_d_reefer_sc_block= oci_parse($con_sparcsn4_oracle,$str_d_reefer_sc);
				oci_execute($res_d_reefer_sc_block); 
				$d_reefer_tot_rtg=0;
				while(($rowshare_d_reefer_sc_block = oci_fetch_object($res_d_reefer_sc_block)) != false)
					{
						$d_reefer_tot_sc = $rowshare_d_reefer_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='D-REEFER' ORDER BY 1";

                   
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                    
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_DREFFER)
                        )tbl";
                        
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results17=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results17, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($d_reefer_tot_sc==0)
                     echo'-';
                      else
                    
                    echo $d_reefer_tot_sc; 
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_y7_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y7_blocks)";
						
						
				$res_y7_sc_block= oci_parse($con_sparcsn4_oracle,$str_y7_sc);
				oci_execute($res_y7_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y7_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y7_sc_block); 
				$res_y7_sc_block= oci_parse($con_sparcsn4_oracle,$str_y7_sc);
				oci_execute($res_y7_sc_block); 
				$y7_tot_rtg=0;
				while(($rowshare_y7_sc_block = oci_fetch_object($res_y7_sc_block)) != false)
					{
						$y7_tot_sc = $rowshare_y7_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='YARD 7' ORDER BY 1";
                
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                        )tbl";
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results18=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results18, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($y7_tot_sc==0)
                     echo'-';
                      else
                     echo $y7_tot_sc; 
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_scy_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($scy_blocks)";
						
						
				$res_scy_sc_block= oci_parse($con_sparcsn4_oracle,$str_scy_sc);
				oci_execute($res_scy_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_scy_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_scy_sc_block); 
				$res_scy_sc_block= oci_parse($con_sparcsn4_oracle,$str_scy_sc);
				oci_execute($res_scy_sc_block); 
				$scy_tot_rtg=0;
				while(($rowshare_scy_sc_block = oci_fetch_object($res_scy_sc_block)) != false)
					{
						$scy_tot_sc = $rowshare_scy_sc_block->TOT;				  
					}

                /* $strSCYSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa='SCY' ORDER BY 1";
                
                $resABSC = mysqli_query($con_sparcsn4,$strSCYSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results19=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results19, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($scy_tot_sc==0)
                     echo'-';
                      else
                    echo $scy_tot_sc;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <!-- WORKSHOP-C-->
            <td>
                <?php

				$str_y_1_2_mn_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y_1_2_mn_blocks)";
						
						
				$res_y_1_2_mn_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_1_2_mn_sc);
				oci_execute($res_y_1_2_mn_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y_1_2_mn_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y_1_2_mn_sc_block); 
				$res_y_1_2_mn_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_1_2_mn_sc);
				oci_execute($res_y_1_2_mn_sc_block); 
				$y_1_2_mn_tot_rtg=0;
				while(($rowshare_y_1_2_mn_sc_block = oci_fetch_object($res_y_1_2_mn_sc_block)) != false)
					{
						$y_1_2_mn_tot_sc = $rowshare_y_1_2_mn_sc_block->TOT;				  
					}

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD-1','YARD 2','MN YARD') ORDER BY 1";
            
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                          $strChkShareABSc ="SELECT equipement,sel_block
                          FROM (
                          SELECT DISTINCT short_name AS equipement ,sel_block
                          FROM xps_che
                          INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                          WHERE short_name ='$equiABSc' AND sel_block IN($blockList_Y1Y2YMN)
                          ) tbl";
                         
                          
                          $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                          oci_execute($resCSAS);
                          $results20=array();
                          $numRowCSAS = oci_fetch_all($resCSAS, $results20, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                          oci_free_statement($resCSAS); 
                          $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                          oci_execute($resCSAS);
                        
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($y_1_2_mn_tot_sc==0)
                     echo'-';
                      else
                     echo $y_1_2_mn_tot_sc; 
                     
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_y_3_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y_3_blocks)";
						
						
				$res_y_3_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_3_sc);
				oci_execute($res_y_3_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y_3_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y_3_sc_block); 
				$res_y_3_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_3_sc);
				oci_execute($res_y_3_sc_block); 
				$y_3_tot_rtg=0;
				while(($rowshare_y_3_sc_block = oci_fetch_object($res_y_3_sc_block)) != false)
					{
						$y_3_tot_sc = $rowshare_y_3_sc_block->TOT;				  
					}

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD 3') ORDER BY 1";
            
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      

                        $strChkShareABSc = "SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl ";
                      
                    
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results21=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results21, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                 $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($y_3_tot_sc==0)
                     echo'-';
                      else
                    echo $y_3_tot_sc;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_y_5_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y_5_blocks)";
						
						
				$res_y_5_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_5_sc);
				oci_execute($res_y_5_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y_5_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y_5_sc_block); 
				$res_y_5_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_5_sc);
				oci_execute($res_y_5_sc_block); 
				$y_5_tot_rtg=0;
				while(($rowshare_y_5_sc_block = oci_fetch_object($res_y_5_sc_block)) != false)
					{
						$y_5_tot_sc = $rowshare_y_5_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD 05') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
          

                while($rowABSC = mysqli_fetch_object($resABSC))
                {
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       
                        $strChkShareABSc = " SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y5)
                        )tbl";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results22=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results22, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                               
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  
                     if ($y_5_tot_sc==0)
                     echo'-';
                      else
                    echo $y_5_tot_sc; 
					
					
                   /*  if($nValAB>0 and $plusValAB>0)
                    {
                        
                        $tot_equip_sc=$tot_equip_sc+$nValAB+$plusValAB;
                        $tot_equip_sc_c=$tot_equip_sc_c+$nValAB+$plusValAB;

                        echo $nValAB.",".$plusValAB."+";
                    }
                    else if($nValAB>0){
                       // echo "i am in 2";
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
                    } */

                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_y_6_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y_6_blocks)";
						
						
				$res_y_6_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_6_sc);
				oci_execute($res_y_6_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y_6_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y_6_sc_block); 
				$res_y_6_sc_block= oci_parse($con_sparcsn4_oracle,$str_y_6_sc);
				oci_execute($res_y_6_sc_block); 
				$y_6_tot_rtg=0;
				while(($rowshare_y_6_sc_block = oci_fetch_object($res_y_6_sc_block)) != false)
					{
						$y_6_tot_sc = $rowshare_y_6_sc_block->TOT;				  
					}
                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD 6') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                 
            

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = " SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                        )tbl";
                       

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results23=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results23, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
               // 3/29/2023 End change
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($y_6_tot_sc==0)
                     echo'-';
                      else
                    echo $y_6_tot_sc;  
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
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
				
				$str_y8b_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y8b_blocks)";
						
						
				$res_y8b_sc_block= oci_parse($con_sparcsn4_oracle,$str_y8b_sc);
				oci_execute($res_y8b_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y8b_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y8b_sc_block); 
				$res_y8b_sc_block= oci_parse($con_sparcsn4_oracle,$str_y8b_sc);
				oci_execute($res_y8b_sc_block); 
				$y8b_tot_rtg=0;
				while(($rowshare_y8b_sc_block = oci_fetch_object($res_y8b_sc_block)) != false)
					{
						$y8b_tot_sc = $rowshare_y8b_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD 8') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu=""; 
				*/
                // start change 3/29/2023
              /*  while($rowABSC = mysqli_fetch_object($resABSC))
                {
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
                }*/

               /* while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = "SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8B_NotIn)
                        )tbl";
                       
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results24=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results24, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */

                // End change 3/29/2023
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($y8b_tot_sc==0)
                     echo'-';
                      else
                     echo $y8b_tot_sc;  
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_y8_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y8_blocks)";
						
						
				$res_y8_sc_block= oci_parse($con_sparcsn4_oracle,$str_y8_sc);
				oci_execute($res_y8_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y8_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y8_sc_block); 
				$res_y8_sc_block= oci_parse($con_sparcsn4_oracle,$str_y8_sc);
				oci_execute($res_y8_sc_block); 
				//$y8_tot_rtg=0;
				while(($rowshare_y8_sc_block = oci_fetch_object($res_y8_sc_block)) != false)
					{
						$y8_tot_sc = $rowshare_y8_sc_block->TOT;				  
					}

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND 
				equipment LIKE 'SC%' AND block_cpa IN('BAPEX','YARD 8') ORDER BY 1"; //BAPX1,BAPX2 replaced by <BX2></BX2>
               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
             

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                         )tbl ";
                       

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results25=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results25, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                 while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($y8_tot_sc==0)
                     echo'-';
                      else
                    echo $y8_tot_sc; 
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_y9_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y9_blocks)";
						
						
				$res_y9_sc_block= oci_parse($con_sparcsn4_oracle,$str_y9_sc);
				oci_execute($res_y9_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y9_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y9_sc_block); 
				$res_y9_sc_block= oci_parse($con_sparcsn4_oracle,$str_y9_sc);
				oci_execute($res_y9_sc_block); 
				$y9_tot_rtg=0;
				while(($rowshare_y9_sc_block = oci_fetch_object($res_y9_sc_block)) != false)
					{
						$y9_tot_sc = $rowshare_y9_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD 9','YARD-10') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
              

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                 

                    $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                    FROM (
                    SELECT DISTINCT 
                    short_name AS equipement ,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y9_Y10_NotIn)
                    )tbl";
                        
                        
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results26=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results26, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */


                // change End  here 3/29/2023
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($y9_tot_sc==0)
                    echo'-';
                     else
                     echo $y9_tot_sc;  
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_y11_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($y11_blocks)";
						
						
				$res_y11_sc_block= oci_parse($con_sparcsn4_oracle,$str_y11_sc);
				oci_execute($res_y11_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_y11_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_y11_sc_block); 
				$res_y11_sc_block= oci_parse($con_sparcsn4_oracle,$str_y11_sc);
				oci_execute($res_y11_sc_block); 
				$y11_tot_rtg=0;
				while(($rowshare_y11_sc_block = oci_fetch_object($res_y11_sc_block)) != false)
					{
						$y11_tot_sc = $rowshare_y11_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('YARD11') ORDER BY 1";
   
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                
                
               
           

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                   
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results27=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results27, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                    if ($y11_tot_sc==0)
                    echo'-';
                     else 
                    echo $y11_tot_sc;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_ncy_sc="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'SC%' AND sel_block IN($ncy_blocks)";
						
						
				$res_ncy_sc_block= oci_parse($con_sparcsn4_oracle,$str_ncy_sc);
				oci_execute($res_ncy_sc_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_ncy_sc_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_ncy_sc_block); 
				$res_ncy_sc_block= oci_parse($con_sparcsn4_oracle,$str_ncy_sc);
				oci_execute($res_ncy_sc_block); 
				$ncy_tot_rtg=0;
				while(($rowshare_ncy_sc_block = oci_fetch_object($res_ncy_sc_block)) != false)
					{
						$ncy_tot_sc = $rowshare_ncy_sc_block->TOT;				  
					}

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'SC%' AND block_cpa in('NCY') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
           

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {

                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                        )tbl";
                       
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results28=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results28, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($ncy_tot_sc==0)
                    echo'-';
                     else  echo $ncy_tot_sc; 
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
			
			
            <!-- Workshop-D-->
            <td><?php if ($sc_cct_tot==0)
                    echo'-';
                     else  echo $sc_cct_tot; ?></td>
            <td><?php if ($sc_nct_tot==0)
                    echo'-';
                     else  echo $sc_nct_tot; ?></td>
            <td><?php if ($sc_icd_tot==0)
                    echo'-';
                     else echo $sc_icd_tot; ?></td>
            <td><?php if ($sc_nofcy_tot==0)
                    echo'-';
                     else  echo $sc_nofcy_tot; ?></td>
            <!--td><?php $tot_equip_sc_d=$tot_sc_booked; echo $tot_equip_sc+$tot_sc_booked+$y8_tot_sc; ?></td-->
            <td><?php echo $tot_equip_sc+$tot_sc_booked+$jr_tot_sc+$ab_tot_sc+$d_reefer_tot_sc+$y7_tot_sc+$scy_tot_sc+$y_1_2_mn_tot_sc+$y_3_tot_sc+$y_5_tot_sc+ $y_6_tot_sc+$y8b_tot_sc+$y8_tot_sc+$y9_tot_sc+$y11_tot_sc+$ncy_tot_sc; ?></td>
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
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 45%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 45%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 45%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 45%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RST 45%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RST 45%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RST 45%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RST 45%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RST 45%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RST 45%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RST 45%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RST 45%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RST 45%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RST 45%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RST 45%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RST 45%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RST 45%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RST 45%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 45%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 45%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 45%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 45%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RST 45%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
               // var_dump($rowDemand);
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
                //Get All block but not in 'JR' start
				

	  
				$str_rst_jr="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'RST45%' AND sel_block IN($jr_blocks)";
						
						
				$res_rst_jr_block= oci_parse($con_sparcsn4_oracle,$str_rst_jr);
				oci_execute($res_rst_jr_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_jr_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_jr_block); 
				$res_rst_jr_block= oci_parse($con_sparcsn4_oracle,$str_rst_jr);
				oci_execute($res_rst_jr_block); 
				$jr_tot_rst=0;
				while(($rowshare_jr_block = oci_fetch_object($res_rst_jr_block)) != false)
					{
						$jr_tot_rst = $rowshare_jr_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}
              /* $block_JR_query="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('JR') ORDER BY block ASC";

              $block_JR_Result=mysqli_query($con_sparcsn4,$block_JR_query);
              $totalRow_JR_Yard=mysqli_num_rows($block_JR_Result);

             $ab15=0;
             $blockList_JRYard_NotIn="";
             while($blockRow_JRYard=mysqli_fetch_object($block_JR_Result)){

                $blockString_JR_Yard="";
                
                $blockString_JR_Yard=$blockRow_JRYard->block;
                
                if($ab15==($totalRow_JR_Yard-1)){
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."'";           
                }
                else{
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."',";
                }
                $ab15++;
                }
                 $blockList_JRYard_NotIn;
                 //Get All block but not in 'JR' End

                $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='JR' ORDER BY 1";
              
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                $nVal = 0;
                $plusVal = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
                 

                        $strChkShareJrSc ="
                        SELECT sel_block,equipement
                        FROM (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiJrSc' AND sel_block IN($blockList_JRYard_NotIn)
                        ) tbl";
                       
                   
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    $results29=array();
                    $numRowCSJS = oci_fetch_all($resCSJS, $results29, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    oci_free_statement($resCSJS); 
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    if($numRowCSJS>0)
                    {
                        $plusVal +=1;
                        array_push($equipArray, $equiJrSc);
                     
                        while(($rowshareYard = oci_fetch_object($resCSJS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
								
								
								
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nVal +=1;
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($jr_tot_rst==0)
                        echo '-';
                    else
					    echo $jr_tot_rst; 
                    /* if($nVal>0 and $plusVal>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                 //Get All block but not in 'AB' start
				 
				 $str_rst_ab="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'RST45%' AND sel_block IN($ab_blocks)";
						
						
				$res_rst_ab_block= oci_parse($con_sparcsn4_oracle,$str_rst_ab);
				oci_execute($res_rst_ab_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_ab_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_ab_block); 
				$res_rst_ab_block= oci_parse($con_sparcsn4_oracle,$str_rst_ab);
				oci_execute($res_rst_ab_block); 
				$ab_tot_rst=0;
				while(($rowshare_ab_block = oci_fetch_object($res_rst_ab_block)) != false)
					{
						$ab_tot_rst = $rowshare_ab_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}
				 
              /* $block_AB_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('AB ZONE') ORDER BY block ASC";

              $block_AB_Res=mysqli_query($con_sparcsn4,$block_AB_qu);
              $totalRow_AB=mysqli_num_rows($block_AB_Res);

             $ab16=0;
             $blockList_AB_NotIn="";
             while($blockRow_AB=mysqli_fetch_object($block_AB_Res)){

                $blockString_AB="";
                
                $blockString_AB=$blockRow_AB->block;
                
                if($ab16==($totalRow_AB-1)){
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."'";           
                }
                else{
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."',";
                }
                $ab16++;
                }
                 $blockList_AB_NotIn;
                 //Get All block but not in 'AB' End

                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='AB ZONE' ORDER BY 1";
              
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        

                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_AB_NotIn)
                        )tbl";
                       
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results30=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results30, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  
                    if($ab_tot_rst==0)
                    echo '-';
                   else
						echo $ab_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

			// Get All block but not in 'AB' start
			
				$str_rst_d_reefer="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($d_reefer_blocks)";
								
				$res_rst_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_rst_d_reefer);
				oci_execute($res_rst_d_reefer_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_d_reefer_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_d_reefer_block); 
				$res_rst_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_rst_d_reefer);
				oci_execute($res_rst_d_reefer_block); 
				$d_reefer_tot_rst=0;
				while(($rowshare_d_reefer_block = oci_fetch_object($res_rst_d_reefer_block)) != false)
					{
						$d_reefer_tot_rst = $rowshare_d_reefer_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}
			
			   /* $block_DREFFER_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
			   WHERE  block_cpa!='NULL' AND block_cpa NOT IN('D-REEFER') ORDER BY block ASC";

			   $block_DREFFER_Result=mysqli_query($con_sparcsn4,$block_DREFFER_Query);
			   $totalRow_DREFFER_Yard=mysqli_num_rows($block_DREFFER_Result);

			  $ab17=0;
			  $blockList_NotIn_DREFFER="";
			  while($blockRow_DREFFER_ya=mysqli_fetch_object($block_DREFFER_Result)){

				 $blockString_DREFFER_Ya="";
				 
				 $blockString_DREFFER_Ya=$blockRow_DREFFER_ya->block;
				 
				 if($ab17==($totalRow_DREFFER_Yard-1)){
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."'";           
				 }
				 else{
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."',";
				 }
				 $ab17++;
				 }
				 $blockList_NotIn_DREFFER;
				  //Get All block but not in 'AB' End
                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='D-REEFER' ORDER BY 1";
             
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       

                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NotIn_DREFFER)
                         )tbl";
                        
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results32=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results32, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($d_reefer_tot_rst==0)
                    echo '-';
                   else
					echo $d_reefer_tot_rst; 
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_rst_y7="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y7_blocks)";
								
				$res_rst_y7_block= oci_parse($con_sparcsn4_oracle,$str_rst_y7);
				oci_execute($res_rst_y7_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y7_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y7_block); 
				$res_rst_y7_block= oci_parse($con_sparcsn4_oracle,$str_rst_y7);
				oci_execute($res_rst_y7_block); 
				$y7_tot_rst=0;
				while(($rowshare_y7_block = oci_fetch_object($res_rst_y7_block)) != false)
					{
						$y7_tot_rst = $rowshare_y7_block->TOT;
					  
					}

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='YARD 7' ORDER BY 1";
             
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                         )tbl";
                       
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results31=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results31, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes))
                                {
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y7_tot_rst==0)
                    echo '-';
                    else
						echo $y7_tot_rst; 
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
					$str_rst_scy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($scy_blocks)";
								
				$res_rst_scy_block= oci_parse($con_sparcsn4_oracle,$str_rst_scy);
				oci_execute($res_rst_scy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_scy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_scy_block); 
				$res_rst_scy_block= oci_parse($con_sparcsn4_oracle,$str_rst_scy);
				oci_execute($res_rst_scy_block); 
				$scy_tot_rst=0;
				while(($rowshare_scy_block = oci_fetch_object($res_rst_scy_block)) != false)
					{
						$scy_tot_rst = $rowshare_scy_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='SCY' ORDER BY 1";
       
         
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                        )tbl";
                       
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results33=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results33, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          

                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($scy_tot_rst==0)
                    echo '-';
                   else
						echo $scy_tot_rst;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_rst_y_1_2_mn="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y_1_2_mn_blocks)";
								
				$res_rst_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_1_2_mn);
				oci_execute($res_rst_y_1_2_mn_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y_1_2_mn_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y_1_2_mn_block); 
				$res_rst_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_1_2_mn);
				oci_execute($res_rst_y_1_2_mn_block); 
				$y_1_2_mn_tot_rst=0;
				while(($rowshare_y_1_2_mn_block = oci_fetch_object($res_rst_y_1_2_mn_block)) != false)
					{
						$y_1_2_mn_tot_rst = $rowshare_y_1_2_mn_block->TOT;
					  
					}
               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD-1','YARD 2','MN YARD') ORDER BY 1";
             
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y1Y2YMN)
                        )tbl";
                       
                    
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results34=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results34, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                echo $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
						
						
						
						
						
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y_1_2_mn_tot_rst==0)
                    echo '-';
                   else
					echo $y_1_2_mn_tot_rst;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_rst_y_3="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y_3_blocks)";
								
				$res_rst_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_3);
				oci_execute($res_rst_y_3_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y_3_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y_3_block); 
				$res_rst_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_3);
				oci_execute($res_rst_y_3_block); 
				$y_3_tot_rst=0;
				while(($rowshare_y_3_block = oci_fetch_object($res_rst_y_3_block)) != false)
					{
						$y_3_tot_rst = $rowshare_y_3_block->TOT;
					  
					}				

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 3') ORDER BY 1";
          
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";

                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                   
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl";
                        
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results35=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results35, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>1)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y_3_tot_rst==0)
                    echo '-';
                   else
						echo $y_3_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_rst_y_5="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y_5_blocks)";
								
				$res_rst_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_5);
				oci_execute($res_rst_y_5_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y_5_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y_5_block); 
				$res_rst_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_5);
				oci_execute($res_rst_y_5_block); 
				$y_5_tot_rst=0;
				while(($rowshare_y_5_block = oci_fetch_object($res_rst_y_5_block)) != false)
					{
						$y_5_tot_rst = $rowshare_y_5_block->TOT;				  
					}		
                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 05') ORDER BY 1";

                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y5)
                        )tbl";
                      
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results36=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results36, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                 $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y_5_tot_rst==0)
                    echo '-';
                   else
					   echo $y_5_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				
				$str_rst_y_6="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y_6_blocks)";
								
				$res_rst_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_6);
				oci_execute($res_rst_y_6_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y_6_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y_6_block); 
				$res_rst_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rst_y_6);
				oci_execute($res_rst_y_6_block); 
				$y_6_tot_rst=0;
				while(($rowshare_y_6_block = oci_fetch_object($res_rst_y_6_block)) != false)
				{
					$y_6_tot_rst = $rowshare_y_6_block->TOT;				  
				}	

                /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 6') ORDER BY 1";

              
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                        )tbl";
                     
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results37=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results37, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y_6_tot_rst==0)
                    echo '-';
                   else
                    
                    echo $y_6_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
			<?php

           // Get All block but not in 'Y8' start
		   
			$str_rst_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST45%' AND sel_block IN($y8b_blocks)";
							
			$res_rst_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8b);
			oci_execute($res_rst_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst_y8b_block); 
			$res_rst_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8b);
			oci_execute($res_rst_y8b_block); 
			$y8b_tot_rst=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_rst_y8b_block)) != false)
				{
					$y8b_tot_rst = $rowshare_y8b_block->TOT;				  
				}
	   
           /*  $block_Y8_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
             WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('YARD 8') ORDER BY block ASC";

            $block_Y8_Result=mysqli_query($con_sparcsn4,$block_Y8_Query);
            $totalRow_Y8=mysqli_num_rows($block_Y8_Result);

           $ab18=0;
           $blockList_Y8_NotIn="";
           while($blockRow_Y8_Res=mysqli_fetch_object($block_Y8_Result)){

              $blockString_Y8="";
              
              $blockString_Y8=$blockRow_Y8_Res->block;
              
              if($ab18==($totalRow_Y8-1)){
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."'";           
              }
              else{
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."',";
              }
              $ab18++;
              
              
              }
               $blockList_Y8_NotIn;
              // Get All block but not in 'Y8' End

            $strABSC = "SELECT DISTINCT equipment
                FROM ctmsmis.mis_equip_assign_detail
                INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
                INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
                WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 8') ORDER BY 1";
            $resABSC = mysqli_query($con_sparcsn4,$strABSC);
            $nValAB = 0;
            $plusValAB = 0;
            $numRowCSAS = 0;
            $strChkShareABSc = "";
            $equiABSc= "";
            $block_cpa= "";
            $sel_block="";
            $block_cpaQu="";
            while($rowABSC = mysqli_fetch_object($resABSC)){
                $equiABSc = $rowABSC->equipment;
                $inarr = in_array($equiABSc, $equipArray);
                if(!$inarr)
                {
                   
                        $strChkShareJrSc ="
                        SELECT sel_block,equipement
                        FROM (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8_NotIn)
                        ) tbl";
                  
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results38=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results38, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                    if($numRowCSAS>0)
                    {
                        $plusValAB +=1;
                        array_push($equipArray, $equiABSc);
                      
                        while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nValAB +=1;
                    }
                }
            } */
            ?>
			<label title="<?php echo rtrim($block_cpa,","); ?> ">
				<!--?php  echo $y8b_tot_rst;
           /*  if($nValAB>0 and $plusValAB>0)
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
            } */
            ?-->
			</label>
		</td>
            <td>
                <?php

                //  for Y8B
			$str_rst_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST45%' AND sel_block IN($y8b_blocks)";
							
			$res_rst_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8b);
			oci_execute($res_rst_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst_y8b_block); 
			$res_rst_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8b);
			oci_execute($res_rst_y8b_block); 
			$y8b_tot_rst=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_rst_y8b_block)) != false)
				{
					$y8b_tot_rst = $rowshare_y8b_block->TOT;				  
				}				
               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 8') ORDER BY 1";
          
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8B_NotIn)
                        )tbl";
                          
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results39=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results39, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y8b_tot_rst==0)
                    echo '-';
                   else
                    echo $y8b_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                  
                 //for Yard 'BX2','Y8','BAPX1','BX1'
			$str_rst_y8="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST45%' AND sel_block IN($y8_blocks)";
							
			$res_rst_y8_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8);
			oci_execute($res_rst_y8_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst_y8_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst_y8_block); 
			$res_rst_y8_block= oci_parse($con_sparcsn4_oracle,$str_rst_y8);
			oci_execute($res_rst_y8_block); 
			$y8_tot_rst=0;
			while(($rowshare_y8_block = oci_fetch_object($res_rst_y8_block)) != false)
				{
					$y8_tot_rst = $rowshare_y8_block->TOT;				  
				}		 
               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND 
				equipment LIKE 'RST%' AND capacity=45 AND block_cpa IN('BAPEX','YARD 8') ORDER BY 1"; //BAPX1,BAPX2 replaced by <BX2></BX2>
  
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;

                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                 
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                        )tbl";
                       
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results40=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results40, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($y8_tot_rst==0)
                    echo '-';
                   else
						echo $y8_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
                // for 'Y9','Y10'
				
			$str_rst_y9="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST45%' AND sel_block IN($y9_blocks)";
							
			$res_rst_y9_block= oci_parse($con_sparcsn4_oracle,$str_rst_y9);
			oci_execute($res_rst_y9_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst_y9_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst_y9_block); 
			$res_rst_y9_block= oci_parse($con_sparcsn4_oracle,$str_rst_y9);
			oci_execute($res_rst_y9_block); 
			$y9_tot_rst=0;
			while(($rowshare_y9_block = oci_fetch_object($res_rst_y9_block)) != false)
				{
					$y9_tot_rst = $rowshare_y9_block->TOT;				  
				}	

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD 9','YARD-10') ORDER BY 1";
                
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC))
                {
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y9_Y10_NotIn) 
                        )tbl";
                       
                            
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results41=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results41, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                    if($y9_tot_rst==0)
                    echo '-';
                   else
						echo $y9_tot_rst;
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_rst_y11="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($y11_blocks)";
								
				$res_rst_y11_block= oci_parse($con_sparcsn4_oracle,$str_rst_y11);
				oci_execute($res_rst_y11_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_y11_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_y11_block); 
				$res_rst_y11_block= oci_parse($con_sparcsn4_oracle,$str_rst_y11);
				oci_execute($res_rst_y11_block); 
				$y11_tot_rst=0;
				while(($rowshare_y11_block = oci_fetch_object($res_rst_y11_block)) != false)
					{
						$y11_tot_rst = $rowshare_y11_block->TOT;				  
					}

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('YARD11') ORDER BY 1";
               
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                       
                       
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results42=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results42, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>1)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                    if($y11_tot_rst==0)
                    echo '-';
                    else
						echo $y11_tot_rst;
                    /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php
				$str_rst_ncy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST45%' AND sel_block IN($ncy_blocks)";
								
				$res_rst_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rst_ncy);
				oci_execute($res_rst_ncy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst_ncy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_ncy_block); 
				$res_rst_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rst_ncy);
				oci_execute($res_rst_ncy_block); 
				$ncy_tot_rst=0;
				while(($rowshare_ncy_block = oci_fetch_object($res_rst_ncy_block)) != false)
					{
						$ncy_tot_rst = $rowshare_ncy_block->TOT;				  
					}				

               /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('NCY') ORDER BY 1";
    
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                        )tbl";
                       
                       
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results43=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results43, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if($ncy_tot_rst==0)
                    echo '-';
                   else
					echo  $ncy_tot_rst;
					
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <!-- Workshop-D-->
            <td><?php  if($rst45_cct_tot==0)
                    echo '-';
                   else echo $rst45_cct_tot;?></td>
            <td><?php if($rst45_nct_tot==0)
                    echo '-';
                   else echo $rst45_nct_tot; ?></td>
            <td><?php if($rst45_icd_tot==0)
                    echo '-';
                   else echo $rst45_icd_tot; ?></td>
            <td><?php if($rst45_nofcy_tot==0)
                    echo '-';
                   else echo $rst45_nofcy_tot; ?></td> 
            <td><?php echo $tot_equip_rst45+$jr_tot_rst+$ab_tot_rst+$d_reefer_tot_rst+$y7_tot_rst+$scy_tot_rst+$y_1_2_mn_tot_rst+$y_3_tot_rst+$y_5_tot_rst+$y_6_tot_rst+$y8b_tot_rst+$y8_tot_rst+$y9_tot_rst+$y11_tot_rst+$ncy_tot_rst; ?></td>
        </tr>

        <!-- FLT16 -->
        <tr align="center">
            <td rowspan="2"> 7 </td>
            <td rowspan="2">FLT 16 Ton</td>
            <?php

            $jrDeVal="";
            $abDeVal="";
            $refDeVal="";
            $y7DeVal="";
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'FLT 16%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'FLT 16%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'FLT 16%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'FLT 16%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'FLT 16%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'FLT 16%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'FLT 16%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'FLT 16%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'FLT 16%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'FLT 16%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'FLT 16%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'FLT 16%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'FLT 16%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'FLT 16%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'FLT 16%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'FLT 16%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'FLT 16%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'FLT 16%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
       
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'FLT 16%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'FLT 16%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'FLT 16%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'FLT 16%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'FLT 16%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                
                
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
        <!-- 4/2/2023 -->
        <tr align="center">
            <td>Supplied</td>
            <td>
                <?php
                 //Get All block but not in 'JR' start
                $str_flt_jr="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'FLT%' AND sel_block IN($jr_blocks)";

               $res_flt_jr_block= oci_parse($con_sparcsn4_oracle,$str_flt_jr);
                                  oci_execute($res_flt_jr_block);
                $results_=array();
                $numRowCSAS = oci_fetch_all($res_flt_jr_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_flt_jr_block); 
                $res_flt_jr_block= oci_parse($con_sparcsn4_oracle,$str_flt_jr);
                oci_execute($res_flt_jr_block); 
                $jr_tot_flt=0;                  
                while(($rowshare_jr_block = oci_fetch_object($res_flt_jr_block)) != false)
					{
						$jr_tot_flt = $rowshare_jr_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                        }*/
                    }
         /* $block_JR_query="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('JR') ORDER BY block ASC";

              $block_JR_Result=mysqli_query($con_sparcsn4,$block_JR_query);
              $totalRow_JR_Yard=mysqli_num_rows($block_JR_Result);

             $ab15=0;
             $blockList_JRYard_NotIn="";
             while($blockRow_JRYard=mysqli_fetch_object($block_JR_Result)){

                $blockString_JR_Yard="";
                
                $blockString_JR_Yard=$blockRow_JRYard->block;
                
                if($ab15==($totalRow_JR_Yard-1)){
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."'";           
                }
                else{
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."',";
                }
                $ab15++;
                }
                 $blockList_JRYard_NotIn;
                 //Get All block but not in 'JR' End
            $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='JR' ORDER BY 1";
              
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                $nVal = 0;
                $plusVal = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
                 

                        $strChkShareJrSc ="
                        SELECT sel_block,equipement
                        FROM (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiJrSc' AND sel_block IN($blockList_JRYard_NotIn)
                        ) tbl";
                       
                   
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    $results29=array();
                    $numRowCSJS = oci_fetch_all($resCSJS, $results29, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    oci_free_statement($resCSJS); 
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    if($numRowCSJS>0)
                    {
                        $plusVal +=1;
                        array_push($equipArray, $equiJrSc);
                     
                        while(($rowshareYard = oci_fetch_object($resCSJS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
								
								
								
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nVal +=1;
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                    if ($jr_tot_flt==0)
                    echo'-';
					else echo $jr_tot_flt;
                    /* if($nVal>0 and $plusVal>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
                <?php

			// Get All block but not in 'AB' start
			
                $str_flt_ab="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'FLT%' AND sel_block IN($ab_blocks)";
						
						
				$res_flt_ab_block= oci_parse($con_sparcsn4_oracle,$str_flt_ab);
				oci_execute($res_flt_ab_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_ab_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_ab_block); 
				$res_flt_ab_block= oci_parse($con_sparcsn4_oracle,$str_flt_ab);
				oci_execute($res_flt_ab_block); 
				$ab_tot_flt=0;
				while(($rowshare_ab_block = oci_fetch_object($res_flt_ab_block)) != false)
					{
						$ab_tot_flt = $rowshare_ab_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}    
              /* $block_AB_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('AB ZONE') ORDER BY block ASC";

              $block_AB_Res=mysqli_query($con_sparcsn4,$block_AB_qu);
              $totalRow_AB=mysqli_num_rows($block_AB_Res);

             $ab16=0;
             $blockList_AB_NotIn="";
             while($blockRow_AB=mysqli_fetch_object($block_AB_Res)){

                $blockString_AB="";
                
                $blockString_AB=$blockRow_AB->block;
                
                if($ab16==($totalRow_AB-1)){
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."'";           
                }
                else{
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."',";
                }
                $ab16++;
                }
                 $blockList_AB_NotIn;
                 //Get All block but not in 'AB' End  

                 $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='AB ZONE' ORDER BY 1";
              
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        

                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_AB_NotIn)
                        )tbl";
                       
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results30=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results30, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php 
                     if ($ab_tot_flt==0)
                     echo'-';
                     else  
						echo $ab_tot_flt;
                     /* if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>
            <td>
            <?php

              // Get All block but not in 'AB' start  
                
                
            $str_flt_d_reefer="SELECT count(short_name) as tot
              FROM xps_che
              INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
              WHERE short_name LIKE 'FLT%' AND sel_block IN($d_reefer_blocks)";
                              
              $res_flt_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_flt_d_reefer);
              oci_execute($res_flt_d_reefer_block); 
              
              $results_=array();
              $numRowCSAS = oci_fetch_all($res_flt_d_reefer_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
              oci_free_statement($res_flt_d_reefer_block); 
              $res_flt_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_flt_d_reefer);
              oci_execute($res_flt_d_reefer_block); 
              $d_reefer_tot_flt=0;
              while(($rowshare_d_reefer_block = oci_fetch_object($res_flt_d_reefer_block)) != false)
                  {
                      $d_reefer_tot_flt = $rowshare_d_reefer_block->TOT;
                      /* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                      $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                      while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                       $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                      
                      } */
                    
                  }
			
			    /* $block_DREFFER_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
			   WHERE  block_cpa!='NULL' AND block_cpa NOT IN('D-REEFER') ORDER BY block ASC";

			   $block_DREFFER_Result=mysqli_query($con_sparcsn4,$block_DREFFER_Query);
			   $totalRow_DREFFER_Yard=mysqli_num_rows($block_DREFFER_Result);

			  $ab17=0;
			  $blockList_NotIn_DREFFER="";
			  while($blockRow_DREFFER_ya=mysqli_fetch_object($block_DREFFER_Result)){

				 $blockString_DREFFER_Ya="";
				 
				 $blockString_DREFFER_Ya=$blockRow_DREFFER_ya->block;
				 
				 if($ab17==($totalRow_DREFFER_Yard-1)){
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."'";           
				 }
				 else{
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."',";
				 }
				 $ab17++;
				 }
				 $blockList_NotIn_DREFFER;
				  //Get All block but not in 'AB' End
                 $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa='D-REEFER' ORDER BY 1";
             
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       

                         $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                         FROM (
                         SELECT DISTINCT 
                         short_name AS equipement ,sel_block
                         FROM xps_che
                         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                         WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NotIn_DREFFER)
                         )tbl";
                        
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results32=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results32, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($d_reefer_tot_flt==0)
                     echo'-';
                     else 
                    echo $d_reefer_tot_flt;
                    /* if($nValAB>0 and $plusValAB>0)
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
                        $tot_equip_flt16=$tot_equip_rflt16;
                        $tot_equip_flt16_ab=$tot_equip_flt16_ab;
                        echo "-";
                    } */
                    ?>
                </label>
            </td>
            <td>
                
                <?php
                $str_flt_y7="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($y7_blocks)";
								
				$res_flt_y7_block= oci_parse($con_sparcsn4_oracle,$str_flt_y7);
				oci_execute($res_flt_y7_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_y7_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_y7_block); 
				$res_flt_y7_block= oci_parse($con_sparcsn4_oracle,$str_flt_y7);
				oci_execute($res_flt_y7_block); 
				$y7_tot_flt=0;
				while(($rowshare_y7_block = oci_fetch_object($res_flt_y7_block)) != false)
					{
						$y7_tot_flt = $rowshare_y7_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='D-REEFER' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                    
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NotIn_DREFFER)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results46=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results46, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);

                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($y7_tot_flt==0)
                    echo'-';
					else 
                             echo $y7_tot_flt;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php

                $str_flt_scy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($scy_blocks)";
								
				$res_flt_scy_block= oci_parse($con_sparcsn4_oracle,$str_flt_scy);
				oci_execute($res_flt_scy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_scy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_scy_block); 
				$res_flt_scy_block= oci_parse($con_sparcsn4_oracle,$str_flt_scy);
				oci_execute($res_flt_scy_block); 
				$scy_tot_flt=0;
				while(($rowshare_scy_block = oci_fetch_object($res_flt_scy_block)) != false)
					{
						$scy_tot_flt = $rowshare_scy_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa='YARD 7' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                        )tbl";
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results47=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results47, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($scy_tot_flt==0)
                    echo'-';
					else 
                              echo $scy_tot_flt;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_flt_y_1_2_mn="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($y_1_2_mn_blocks)";
								
				$res_flt_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_1_2_mn);
				oci_execute($res_flt_y_1_2_mn_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_y_1_2_mn_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_y_1_2_mn_block); 
				$res_flt_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_1_2_mn);
				oci_execute($res_flt_y_1_2_mn_block); 
				$y_1_2_mn_tot_flt=0;
				while(($rowshare_y_1_2_mn_block = oci_fetch_object($res_flt_y_1_2_mn_block)) != false)
					{
						$y_1_2_mn_tot_flt = $rowshare_y_1_2_mn_block->TOT;
					  
					}






              /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('SCY') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                        )tbl";
                       
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results48=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results48, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_1_2_mn_tot_flt==0)
                     echo'-';
                     else 
                    echo $y_1_2_mn_tot_flt;
                   /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_flt_y_3="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($y_3_blocks)";
								
				$res_flt_y_3_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_3);
				oci_execute($res_flt_y_3_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_y_3_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_y_3_block); 
				$res_flt_y_3_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_3);
				oci_execute($res_flt_y_3_block); 
				$y_3_tot_flt=0;
				while(($rowshare_y_3_block = oci_fetch_object($res_flt_y_3_block)) != false)
					{
						$y_3_tot_flt = $rowshare_y_3_block->TOT;
					  
					}


               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD 3') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                    
                        $strChkShareABSc = "SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl ";
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results50=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results50, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_3_tot_flt==0)
                     echo'-';
                     else 
                           echo $y_3_tot_flt;
                  /*  if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                
                <?php
                $str_flt_y_5="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($y_5_blocks)";
								
				$res_flt_y_5_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_5);
				oci_execute($res_flt_y_5_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_y_5_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_y_5_block); 
				$res_flt_y_5_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_5);
				oci_execute($res_flt_y_5_block); 
				$y_5_tot_flt=0;
				while(($rowshare_y_5_block = oci_fetch_object($res_flt_y_5_block)) != false)
					{
						$y_5_tot_flt = $rowshare_y_5_block->TOT;				  
					}

              /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD 6') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                       $strChkShareABSc = " SELECT equipement,sel_block
                       FROM 
                       (
                       SELECT DISTINCT short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                       )tbl";
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results52=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results52, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($y_5_tot_flt==0)
                    echo'-';
					else 
                            echo $y_5_tot_flt;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <!--td>
			<?php

                $str_flt_y_6="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'FLT%' AND sel_block IN($y_6_blocks)";
                                
                $res_flt_y_6_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_6);
                oci_execute($res_flt_y_6_block); 

                $results_=array();
                $numRowCSAS = oci_fetch_all($res_flt_y_6_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_flt_y_6_block); 
                $res_flt_y_6_block= oci_parse($con_sparcsn4_oracle,$str_flt_y_6);
                oci_execute($res_flt_y_6_block); 
                $y_6_tot_flt=0;
                while(($rowshare_y_6_block = oci_fetch_object($res_flt_y_6_block)) != false)
                {
                    $y_6_tot_flt = $rowshare_y_6_block->TOT;				  
                }

          /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD 8') ORDER BY 1";
            $resABSC = mysqli_query($con_sparcsn4,$strABSC);
            $nValAB = 0;
            $plusValAB = 0;
            $numRowCSAS = 0;
            $strChkShareABSc = "";
            $equiABSc= "";
            $block_cpa= "";
            $sel_block="";
            $block_cpaQu="";
            while($rowABSC = mysqli_fetch_object($resABSC)){
                $equiABSc = $rowABSC->equipment;
                $inarr = in_array($equiABSc, $equipArray);
                if(!$inarr)
                {
                   
                   $strChkShareJrSc ="
                   SELECT sel_block,equipement
                   FROM (
                   SELECT DISTINCT short_name AS equipement ,sel_block
                   FROM xps_che
                   INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                   WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8_NotIn)
                   ) tbl";
                  $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                  oci_execute($resCSAS);
                  $results53=array();
                  $numRowCSAS = oci_fetch_all($resCSAS, $results53, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                  oci_free_statement($resCSAS); 
                  $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                  oci_execute($resCSAS);
                    if($numRowCSAS>0)
                    {
                        $plusValAB +=1;
                        array_push($equipArray, $equiABSc);
                      
                        while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
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
                 if ($y_6_tot_flt==0)
                 echo'-';
                 else 
                     echo $y_6_tot_flt;
           /* if($nValAB>0 and $plusValAB>0)
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
            }*/
            ?>
			</label>
		</td-->
            <td>
                <?php
          // Get All block but not in 'Y8' start
		   
			$str_flt_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'FLT%' AND sel_block IN($y8b_blocks)";
							
			$res_flt_y8b_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8b);
			oci_execute($res_flt_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_flt_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_flt_y8b_block); 
			$res_flt_y8b_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8b);
			oci_execute($res_flt_y8b_block); 
			$y8b_tot_flt=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_flt_y8b_block)) != false)
				{
					$y8b_tot_flt = $rowshare_y8b_block->TOT;				  
				}

/*  $block_Y8_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
             WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('YARD 8') ORDER BY block ASC";

            $block_Y8_Result=mysqli_query($con_sparcsn4,$block_Y8_Query);
            $totalRow_Y8=mysqli_num_rows($block_Y8_Result);

           $ab18=0;
           $blockList_Y8_NotIn="";
           while($blockRow_Y8_Res=mysqli_fetch_object($block_Y8_Result)){

              $blockString_Y8="";
              
              $blockString_Y8=$blockRow_Y8_Res->block;
              
              if($ab18==($totalRow_Y8-1)){
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."'";           
              }
              else{
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."',";
              }
              $ab18++;
              
              
              }
               $blockList_Y8_NotIn;
              // Get All block but not in 'Y8' End





                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD 8') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8B_NotIn)
                        )tbl";
                          
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results54=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results54, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y8b_tot_flt==0)
                     echo'-';
                     else 
                         echo $y8b_tot_flt;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                //  for Y8B
                $str_flt_y8b="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'FLT%' AND sel_block IN($y8b_blocks)";
                                
                $res_flt_y8b_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8b);
                oci_execute($res_flt_y8b_block); 

                $results_=array();
                $numRowCSAS = oci_fetch_all($res_flt_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_flt_y8b_block); 
                $res_flt_y8b_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8b);
                oci_execute($res_flt_y8b_block); 
                $y8b_tot_flt=0;
                while(($rowshare_y8b_block = oci_fetch_object($res_flt_y8b_block)) != false)
                    {
                        $y8b_tot_flt = $rowshare_y8b_block->TOT;				  
                    }




              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' 
				AND capacity=16 AND block_cpa IN('BAPEX','YARD 8') ORDER BY 1";//BAPX1,BAPX2 replaced by BX2
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                    
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                       )tbl ";

                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                      $results55=array();
                      $numRowCSAS = oci_fetch_all($resCSAS, $results55, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                      oci_free_statement($resCSAS); 
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y8b_tot_flt==0)
                     echo'-';
                     else 
                    echo $y8b_tot_flt;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php

                //for Yard 'BX2','Y8','BAPX1','BX1'
			$str_flt_y8="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'FLT%' AND sel_block IN($y8_blocks)";
							
			$res_flt_y8_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8);
			oci_execute($res_flt_y8_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_flt_y8_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_flt_y8_block); 
			$res_flt_y8_block= oci_parse($con_sparcsn4_oracle,$str_flt_y8);
			oci_execute($res_flt_y8_block); 
			$y8_tot_flt=0;
			while(($rowshare_y8_block = oci_fetch_object($res_flt_y8_block)) != false)
				{
					$y8_tot_flt = $rowshare_y8_block->TOT;				  
				}

                /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD 9','YARD-10') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y9_Y10_NotIn)
                       )tbl";
                           
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results56=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results56, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y8_tot_flt==0)
                     echo'-';
                     else 
                    echo $y8_tot_flt;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php

                // for 'Y9','Y10'
                                
                $str_flt_y9="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'FLT%' AND sel_block IN($y9_blocks)";
                                
                $res_flt_y9_block= oci_parse($con_sparcsn4_oracle,$str_flt_y9);
                oci_execute($res_flt_y9_block); 
                
                $results_=array();
                $numRowCSAS = oci_fetch_all($res_flt_y9_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_flt_y9_block); 
                $res_flt_y9_block= oci_parse($con_sparcsn4_oracle,$str_flt_y9);
                oci_execute($res_flt_y9_block); 
                $y9_tot_flt=0;
                while(($rowshare_y9_block = oci_fetch_object($res_rst_y9_block)) != false)
                    {
                        $y9_tot_flt = $rowshare_y9_block->TOT;				  
                    }
                            
               
             /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('YARD11') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results57=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results57, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);

                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y9_tot_flt==0)
                     echo'-';
                     else 
                          echo $y9_tot_flt;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_flt_y11="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'FLT%' AND sel_block IN($y11_blocks)";
								
				$res_flt_y11_block= oci_parse($con_sparcsn4_oracle,$str_flt_y11);
				oci_execute($res_flt_y11_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_flt_y11_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_flt_y11_block); 
				$res_flt_y11_block= oci_parse($con_sparcsn4_oracle,$str_flt_y11);
				oci_execute($res_flt_y11_block); 
				$y11_tot_flt=0;
				while(($rowshare_y11_block = oci_fetch_object($res_flt_y11_block)) != false)
					{
						$y11_tot_flt = $rowshare_y11_block->TOT;				  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'FLT%' AND capacity=16 AND block_cpa in('NCY') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                       )tbl";

                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results58=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results58, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);

                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y11_tot_flt==0)
                     echo'-';
                     else 
                          echo $y11_tot_flt;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
          <td>
            <?php
            $str_flt_ncy="SELECT count(short_name) as tot
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
            WHERE short_name LIKE 'FLT%' AND sel_block IN($ncy_blocks)";
                            
            $res_flt_ncy_block= oci_parse($con_sparcsn4_oracle,$str_flt_ncy);
            oci_execute($res_flt_ncy_block); 

            $results_=array();
            $numRowCSAS = oci_fetch_all($res_flt_ncy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            oci_free_statement($res_flt_ncy_block); 
            $res_flt_ncy_block= oci_parse($con_sparcsn4_oracle,$str_flt_ncy);
            oci_execute($res_flt_ncy_block); 
            $ncy_tot_flt=0;
            while(($rowshare_ncy_block = oci_fetch_object($res_flt_ncy_block)) != false)
                {
                    $ncy_tot_flt = $rowshare_ncy_block->TOT;				  
                }
          /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=45 AND block_cpa in('NCY') ORDER BY 1";
    
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                        )tbl";
                       
                       
                      
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results43=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results43, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                } */

            ?>

           <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($ncy_tot_flt==0)
                     echo'-';
                     else 
					echo  $ncy_tot_flt;
					
                   /*  if($nValAB>0 and $plusValAB>0)
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
                    } */
                    ?>
                </label>
            </td>

            <!-- Workshop-D-->
            <td><?php  if ($flt16_cct_tot==0)
                    echo'-';
					else echo $flt16_cct_tot;?></td>
            <td><?php if ($flt16_nct_tot==0)
                    echo'-';else echo $flt16_nct_tot; ?></td>
            <td><?php if ($flt16_icd_tot==0)
                    echo'-';
          else  echo $flt16_icd_tot; ?></td>
            <td><?php if ($flt16_nofcy_tot==0)
                    echo'-';else echo $flt16_nofcy_tot; ?></td>
            <!--td><?php echo ""; ?></td-->
            <td><?php echo $tot_equip_flt16+$jr_tot_flt+$d_reefer_tot_flt+$y7_tot_flt+$scy_tot_flt+$y_1_2_mn_tot_flt+$y_3_tot_flt+$y_5_tot_flt+$y_6_tot_flt+$y8b_tot_flt+$y8_tot_flt+$y9_tot_flt+$y11_tot_flt+$ncy_tot_flt+$flt16_cct_tot+$flt16_nct_tot+$flt16_icd_tot+$flt16_nofcy_tot
            ; ?></td>
        </tr>
        <!-- RST7 -->
        <tr align="center">
            <td rowspan="2"> 8 </td>
            <td rowspan="2">RST 7 Ton</td>
            <?php

            $jrDeVal="";
            $abDeVal="";
            $refDeVal="";
            $y7DeVal="";
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 7%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 7%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 7%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 7%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RST 7%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'RST 7%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'RST 7%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'RST 7%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'RST 7%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'RST 7%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'RST 7%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'RST 7%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'RST 7%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'RST 7%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'RST 7%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'RST 7%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'RST 7%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'RST 7%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'RST 7%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'RST 7%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'RST 7%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'RST 7%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'RST 7%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
                 //Get All block but not in 'JR' start
                 $str_rst7_jr="SELECT count(short_name) as tot
						FROM xps_che
						INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
						WHERE short_name LIKE 'RST7%' AND sel_block IN($jr_blocks)";
            $res_rst7_jr_block= oci_parse($con_sparcsn4_oracle,$str_rst7_jr);
            oci_execute($res_rst7_jr_block); 

            $results_=array();
            $numRowCSAS = oci_fetch_all($res_rst7_jr_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            oci_free_statement($res_rst7_jr_block); 
            $res_rst7_jr_block= oci_parse($con_sparcsn4_oracle,$str_rst7_jr);
            oci_execute($res_rst7_jr_block); 
            $jr_tot_rst7=0;
            while(($rowshare_jr_block = oci_fetch_object($res_rst7_jr_block)) != false)
                {
                    $jr_tot_rst7 = $rowshare_jr_block->TOT;
                    /* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                    $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                    while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                    $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                    
                    } */
                
                }
            /* $block_JR_query="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('JR') ORDER BY block ASC";

              $block_JR_Result=mysqli_query($con_sparcsn4,$block_JR_query);
              $totalRow_JR_Yard=mysqli_num_rows($block_JR_Result);

             $ab15=0;
             $blockList_JRYard_NotIn="";
             while($blockRow_JRYard=mysqli_fetch_object($block_JR_Result)){

                $blockString_JR_Yard="";
                
                $blockString_JR_Yard=$blockRow_JRYard->block;
                
                if($ab15==($totalRow_JR_Yard-1)){
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."'";           
                }
                else{
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."',";
                }
                $ab15++;
                }
                 $blockList_JRYard_NotIn;
                 //Get All block but not in 'JR' End




                $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='JR' ORDER BY 1";
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                $nVal = 0;
                $plusVal = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
                   
                    $strChkShareJrSc ="
                    SELECT sel_block,equipement
                    FROM (
                    SELECT DISTINCT short_name AS equipement ,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiJrSc' AND sel_block IN($blockList_JRYard_NotIn)
                    ) tbl";
                   
              
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    $results60=array();
                    $numRowCSJS = oci_fetch_all($resCSJS, $results60, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    oci_free_statement($resCSJS); 
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    if($numRowCSJS>0)
                    {
                        $plusVal +=1;
                        array_push($equipArray, $equiJrSc);
                       
                        while(($rowshareYard = oci_fetch_object($resCSJS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                     
                    }
                    else{
                        $nVal +=1;
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($jr_tot_rst7==0)
                    echo'-';
                     else  echo $jr_tot_rst7;
                    /*if($nVal>0 and $plusVal>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
             //Get All block but not in 'AB' start  

             $str_rst7_ab="SELECT count(short_name) as tot
             FROM xps_che
             INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
             WHERE short_name LIKE 'RST7%' AND sel_block IN($ab_blocks)";

             $res_rst7_ab_block= oci_parse($con_sparcsn4_oracle,$str_rst7_ab);
                             oci_execute($res_rst7_ab_block); 
                             $results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_ab_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst_ab_block); 
				$res_rst_ab_block= oci_parse($con_sparcsn4_oracle,$str_rst7_ab);
				oci_execute($res_rst7_ab_block); 
				$ab_tot_rst7=0;
				while(($rowshare_ab_block = oci_fetch_object($res_rst7_ab_block)) != false)
					{
						$ab_tot_rst7 = $rowshare_ab_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}
				 
              /* $block_AB_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
              WHERE  block_cpa!='NULL' AND block_cpa NOT IN('AB ZONE') ORDER BY block ASC";

              $block_AB_Res=mysqli_query($con_sparcsn4,$block_AB_qu);
              $totalRow_AB=mysqli_num_rows($block_AB_Res);

             $ab16=0;
             $blockList_AB_NotIn="";
             while($blockRow_AB=mysqli_fetch_object($block_AB_Res)){

                $blockString_AB="";
                
                $blockString_AB=$blockRow_AB->block;
                
                if($ab16==($totalRow_AB-1)){
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."'";           
                }
                else{
                $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."',";
                }
                $ab16++;
                }
                 $blockList_AB_NotIn;
                 //Get All block but not in 'AB' End     
             
                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='AB ZONE' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
               
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_AB_NotIn)
                       )tbl";
                      
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                      $results61=array();
                      $numRowCSAS = oci_fetch_all($resCSAS, $results61, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                      oci_free_statement($resCSAS); 
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($ab_tot_rst7==0)
                     echo'-';
                      else
                               echo $ab_tot_rst7; 
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                // Get All block but not in 'AB' start
                $str_rst7_d_reefer="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($d_reefer_blocks)";
								
				$res_rst7_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_rst7_d_reefer);
				oci_execute($res_rst7_d_reefer_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_d_reefer_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_d_reefer_block); 
				$res_rst7_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_rst7_d_reefer);
				oci_execute($res_rst7_d_reefer_block); 
				$d_reefer_tot_rst7=0;
				while(($rowshare_d_reefer_block = oci_fetch_object($res_rst7_d_reefer_block)) != false)
					{
						$d_reefer_tot_rst7 = $rowshare_d_reefer_block->TOT;
						/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
						$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
						while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
						 $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
						} */
					  
					}
			
			   /* $block_DREFFER_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
			   WHERE  block_cpa!='NULL' AND block_cpa NOT IN('D-REEFER') ORDER BY block ASC";

			   $block_DREFFER_Result=mysqli_query($con_sparcsn4,$block_DREFFER_Query);
			   $totalRow_DREFFER_Yard=mysqli_num_rows($block_DREFFER_Result);

			  $ab17=0;
			  $blockList_NotIn_DREFFER="";
			  while($blockRow_DREFFER_ya=mysqli_fetch_object($block_DREFFER_Result)){

				 $blockString_DREFFER_Ya="";
				 
				 $blockString_DREFFER_Ya=$blockRow_DREFFER_ya->block;
				 
				 if($ab17==($totalRow_DREFFER_Yard-1)){
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."'";           
				 }
				 else{
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."',";
				 }
				 $ab17++;
				 }
				 $blockList_NotIn_DREFFER;
				  //Get All block but not in 'AB' End



                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='D-REEFER' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NotIn_DREFFER)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results62=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results62, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($d_reefer_tot_rst7==0)
                     echo'-';
                      else
                    echo $d_reefer_tot_rst7;

                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_y7="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($y7_blocks)";
								
				$res_rst7_y7_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y7);
				oci_execute($res_rst7_y7_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_y7_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_y7_block); 
				$res_rst7_y7_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y7);
				oci_execute($res_rst7_y7_block); 
				$y7_tot_rst7=0;
				while(($rowshare_y7_block = oci_fetch_object($res_rst7_y7_block)) != false)
					{
						$y7_tot_rst7 = $rowshare_y7_block->TOT;
					  
					}

              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='YARD 7' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc = "SELECT  tbl.equipement,sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                        )tbl";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results63=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results63, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php  if ($y7_tot_rst7==0)
                    echo'-';
                     else
                         echo $y7_tot_rst7;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_scy="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'RST7%' AND sel_block IN($scy_blocks)";
                                
                $res_rst7_scy_block= oci_parse($con_sparcsn4_oracle,$str_rst7_scy);
                oci_execute($res_rst7_scy_block); 

                $results_=array();
                $numRowCSAS = oci_fetch_all($res_rst7_scy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_rst7_scy_block); 
                $res_rst7_scy_block= oci_parse($con_sparcsn4_oracle,$str_rst7_scy);
                oci_execute($res_rst7_scy_block); 
                $scy_tot_rst7=0;
                while(($rowshare_scy_block = oci_fetch_object($res_rst7_scy_block)) != false)
                    {
                        $scy_tot_rst7 = $rowshare_scy_block->TOT;
                    
                    }





              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa='SCY' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                        )tbl";
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results65=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results65, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else
						{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                     if ($scy_tot_rst7==0)
                     echo'-';
                      else
                           echo $scy_tot_rst7;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_y_1_2_mn="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($y_1_2_mn_blocks)";
								
				$res_rst7_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_1_2_mn);
				oci_execute($res_rst7_y_1_2_mn_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_y_1_2_mn_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_y_1_2_mn_block); 
				$res_rst7_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_1_2_mn);
				oci_execute($res_rst7_y_1_2_mn_block); 
				$y_1_2_mn_tot_rst7=0;
				while(($rowshare_y_1_2_mn_block = oci_fetch_object($res_rst7_y_1_2_mn_block)) != false)
					{
						$y_1_2_mn_tot_rst7 = $rowshare_y_1_2_mn_block->TOT;
					  
					}

              /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD-1','YARD 2','MN YARD') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa="";
                $sel_block="";
                 $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                       $strChkShareABSc ="SELECT equipement,sel_block
                        FROM (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name ='$equiABSc' AND sel_block IN($blockList_Y1Y2YMN)
                        ) tbl";
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results67=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results67, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_1_2_mn_tot_rst7==0)
                     echo'-';
                      else
                    echo $y_1_2_mn_tot_rst7;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_y_3="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($y_3_blocks)";
								
				$res_rst7_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_3);
				oci_execute($res_rst7_y_3_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_y_3_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_y_3_block); 
				$res_rst7_y_3_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_3);
				oci_execute($res_rst7_y_3_block); 
				$y_3_tot_rst7=0;
				while(($rowshare_y_3_block = oci_fetch_object($res_rst7_y_3_block)) != false)
					{
						$y_3_tot_rst7 = $rowshare_y_3_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 3') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl";
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results68=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results68, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_3_tot_rst7==0)
                     echo'-';
                      else
                    echo $y_3_tot_rst7;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_y_5="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($y_5_blocks)";
								
				$res_rst7_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_5);
				oci_execute($res_rst7_y_5_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_y_5_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_y_5_block); 
				$res_rst7_y_5_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_5);
				oci_execute($res_rst7_y_5_block); 
				$y_5_tot_rst7=0;
				while(($rowshare_y_5_block = oci_fetch_object($res_rst7_y_5_block)) != false)
					{
						$y_5_tot_rst7 = $rowshare_y_5_block->TOT;				  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0  AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 05') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y5)
                       )tbl";

                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results69=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results69, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_5_tot_rst7==0)
                     echo'-';
                      else
                     echo $y_5_tot_rst7;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_y_6="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($y_6_blocks)";
								
				$res_rst7_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_6);
				oci_execute($res_rst7_y_6_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_y_6_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_y_6_block); 
				$res_rst7_y_6_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y_6);
				oci_execute($res_rst7_y_6_block); 
				$y_6_tot_rst7=0;
				while(($rowshare_y_6_block = oci_fetch_object($res_rst7_y_6_block)) != false)
				{
					$y_6_tot_rst7 = $rowshare_y_6_block->TOT;				  
				}

              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 6') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc = " SELECT equipement,sel_block
                       FROM 
                       (
                       SELECT DISTINCT short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                       )tbl";
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results70=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results70, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y_6_tot_rst7==0)
                     echo'-';
                      else
                     echo $y_6_tot_rst7;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <!--td>
			<?php
       // Get All block but not in 'Y8' start 
       $str_rst7_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST7%' AND sel_block IN($y8b_blocks)";
							
			$res_rst7_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8b);
			oci_execute($res_rst7_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst7_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst7_y8b_block); 
			$res_rst7_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8b);
			oci_execute($res_rst7_y8b_block); 
			$y8b_tot_rst7=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_rst7_y8b_block)) != false)
				{
					$y8b_tot_rst7 = $rowshare_y8b_block->TOT;				  
				}
                /*  $block_Y8_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
             WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('YARD 8') ORDER BY block ASC";

            $block_Y8_Result=mysqli_query($con_sparcsn4,$block_Y8_Query);
            $totalRow_Y8=mysqli_num_rows($block_Y8_Result);

           $ab18=0;
           $blockList_Y8_NotIn="";
           while($blockRow_Y8_Res=mysqli_fetch_object($block_Y8_Result)){

              $blockString_Y8="";
              
              $blockString_Y8=$blockRow_Y8_Res->block;
              
              if($ab18==($totalRow_Y8-1)){
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."'";           
              }
              else{
              $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."',";
              }
              $ab18++;
              
              
              }
               $blockList_Y8_NotIn;
              // Get All block but not in 'Y8' End
       

            $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 8') ORDER BY 1";
            $resABSC = mysqli_query($con_sparcsn4,$strABSC);
            $nValAB = 0;
            $plusValAB = 0;
            $numRowCSAS = 0;
            $strChkShareABSc = "";
            $equiABSc= "";
            $block_cpa="";
            $sel_block="";
            $block_cpaQu="";
            while($rowABSC = mysqli_fetch_object($resABSC)){
                $equiABSc = $rowABSC->equipment;
                $inarr = in_array($equiABSc, $equipArray);
                if(!$inarr)
                {
               
                    $strChkShareJrSc ="
                    SELECT sel_block,equipement
                    FROM (
                    SELECT DISTINCT short_name AS equipement ,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8_NotIn)
                    ) tbl";
                   $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                   oci_execute($resCSAS);
                   $results71=array();
                   $numRowCSAS = oci_fetch_all($resCSAS, $results71, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                   oci_free_statement($resCSAS); 
                   $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                   oci_execute($resCSAS);
                    if($numRowCSAS>0)
                    {
                        $plusValAB +=1;
                        array_push($equipArray, $equiABSc);
                      
                        while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
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
                 if ($y8b_tot_rst7==0)
                 echo'-';
                  else
                echo $y8b_tot_rst7;

           /* if($nValAB>0 and $plusValAB>0)
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
            }*/
            ?>
			</label>
		</td-->
            <td>
                <?php
                 //  for Y8B
			$str_rst7_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST7%' AND sel_block IN($y8b_blocks)";
							
			$res_rst7_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8b);
			oci_execute($res_rst7_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst7_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst7_y8b_block); 
			$res_rst7_y8b_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8b);
			oci_execute($res_rst7_y8b_block); 
			$y8b_tot_rst7=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_rst7_y8b_block)) != false)
				{
					$y8b_tot_rst7 = $rowshare_y8b_block->TOT;				  
				}
    
               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 8') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8B_NotIn)
                        )tbl";
                          
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results72=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results72, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y8b_tot_rst7==0)
                     echo'-';
                      else
                    echo  $y8b_tot_rst7;
                   
                   /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                //for Yard 'BX2','Y8','BAPX1','BX1'
			$str_rst7_y8="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST7%' AND sel_block IN($y8_blocks)";
							
			$res_rst7_y8_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8);
			oci_execute($res_rst7_y8_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst7_y8_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst7_y8_block); 
			$res_rst7_y8_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y8);
			oci_execute($res_rst7_y8_block); 
			$y8_tot_rst7=0;
			while(($rowshare_y8_block = oci_fetch_object($res_rst7_y8_block)) != false)
				{
					$y8_tot_rst7 = $rowshare_y8_block->TOT;				  
				}

              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) 
				AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa IN('BAPEX','YARD 8') ORDER BY 1"; //BAPX1,BAPX2 replaced by BX2
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                        )tbl ";

                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results74=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results74, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y8_tot_rst7==0)
                     echo'-';
                      else
                    echo $y8_tot_rst7;
                  /*  if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
            // for 'Y9','Y10'
            $str_rst7_y9="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'RST7%' AND sel_block IN($y9_blocks)";
							
			$res_rst7_y9_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y9);
			oci_execute($res_rst7_y9_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_rst7_y9_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_rst7_y9_block); 
			$res_rst7_y9_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y9);
			oci_execute($res_rst7_y9_block); 
			$y9_tot_rst7=0;
			while(($rowshare_y9_block = oci_fetch_object($res_rst7_y9_block)) != false)
				{
					$y9_tot_rst7 = $rowshare_y9_block->TOT;				  
				}

               /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD 9','YARD-10') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y9_Y10_NotIn)
                        )tbl";
                            
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results75=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results75, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);

                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y9_tot_rst7==0)
                     echo'-';
                      else
                        echo $y9_tot_rst7;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php

            $str_rst7_y11="SELECT count(short_name) as tot
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
            WHERE short_name LIKE 'RST7%' AND sel_block IN($y11_blocks)";
                            
            $res_rst7_y11_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y11);
            oci_execute($res_rst7_y11_block); 

            $results_=array();
            $numRowCSAS = oci_fetch_all($res_rst7_y11_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            oci_free_statement($res_rst7_y11_block); 
            $res_rst7_y11_block= oci_parse($con_sparcsn4_oracle,$str_rst7_y11);
            oci_execute($res_rst7_y11_block); 
            $y11_tot_rst7=0;
            while(($rowshare_y11_block = oci_fetch_object($res_rst7_y11_block)) != false)
                {
                    $y11_tot_rst7 = $rowshare_y11_block->TOT;				  
                }

              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('YARD11') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results76=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results76, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($y11_tot_rst7==0)
                     echo'-';
                      else
                        echo $y11_tot_rst7;
                    /*if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_rst7_ncy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'RST7%' AND sel_block IN($ncy_blocks)";
								
				$res_rst7_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rst7_ncy);
				oci_execute($res_rst7_ncy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_rst7_ncy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_rst7_ncy_block); 
				$res_rst7_ncy_block= oci_parse($con_sparcsn4_oracle,$str_rst7_ncy);
				oci_execute($res_rst7_ncy_block); 
				$ncy_tot_rst7=0;
				while(($rowshare_ncy_block = oci_fetch_object($res_rst7_ncy_block)) != false)
					{
						$ncy_tot_rst7 = $rowshare_ncy_block->TOT;				  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'RST%' AND capacity=7 AND block_cpa in('NCY') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa="";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                        )tbl";
                       
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results77=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results77, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                     if ($ncy_tot_rst7==0)
                     echo'-';
                      else
                    echo  $ncy_tot_rst7; 
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <!-- Workshop-D-->
            <td><?php if ($rst7_cct_tot==0)
                    echo'-';
                     else echo$rst7_cct_tot ;?></td>
            <td><?php if ($rst7_nct_tot==0)
                    echo'-';
                     else echo $rst7_nct_tot; ?></td>
            <td><?php if ($rst7_icd_tot==0)
                    echo'-';
                     else  echo$rst7_icd_tot;?></td>
            <td><?php if ($rst7_nofcy_tot==0)
                    echo'-';
                     else  echo $rst7_nofcy_tot;?></td>
            <td><?php echo $tot_equip_rst7+$jr_tot_rst7+$ab_tot_rst7+$d_reefer_tot_rst7+$y7_tot_rst7+$scy_tot_rst7+$y_1_2_mn_tot_rst7+$y_3_tot_rst7+$y_5_tot_rst7+$y_6_tot_rst7+$y8b_tot_rst7+$y8b_tot_rst7+$y8_tot_rst7+$y9_tot_rst7+$y11_tot_rst7+$ncy_tot_rst7+$rst7_cct_tot+$rst7_nct_tot+$rst7_icd_tot+$rst7_nofcy_tot; ?></td>





            <!--td><?php echo $rst7_cct_tot; ?></td-->
            <!--td><?php echo $rst7_nct_tot; ?></td-->
            <!--td><?php echo $icdDeVal; ?></td-->
            <!--td><?php echo $nofcyDeVal; ?></td-->
            <!--td><?php echo $tot_rst7_booked+$tot_equip_rst7; ?></td-->
            <!--td><?php echo ""; ?></td-->
            <!--td><?php echo ""; ?></td-->
            <!--td><?php echo ""; ?></td-->
            <!--td><?php echo ""; ?></td-->


            
        <!--td><?php echo ""; ?></td-->
		<!--td><?php echo ""; ?></td-->
		<!--td><?php echo ""; ?></td-->
		<!--td><?php echo ""; ?></td-->
		<!--td><?php echo $tot_equip_rst7; ?></td-->
        </tr>

        <!-- CM -->
        <tr align="center">
            <td rowspan="2"> 9 </td>
            <td rowspan="2">CM</td>
            <?php

            $jrDeVal="";
            $abDeVal="";
            $refDeVal="";
            $y7DeVal="";
            $scyDeVal="";
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

           /* $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'CM%') AS jr,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'CM%') AS ab,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'CM%') AS refer,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'CM%') AS y7,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'CM%') AS scy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y1,Y2,YMN' AND equip_type LIKE 'CM%') AS y12,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y3' AND equip_type LIKE 'CM%') AS y3,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y5' AND equip_type LIKE 'CM%') AS y5,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y6,Y6X' AND equip_type LIKE 'CM%') AS y6,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y8B' AND equip_type LIKE 'CM%') AS y8B,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='BAPX1,BAPX2,Y8' AND equip_type LIKE 'CM%') AS bapx,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y9,Y10' AND equip_type LIKE 'CM%') AS y910,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='Y11' AND equip_type LIKE 'CM%') AS y11,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCY' AND equip_type LIKE 'CM%') AS ncy,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='CCT' AND equip_type LIKE 'CM%') AS cct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NCT' AND equip_type LIKE 'CM%') AS nct,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='ICD' AND equip_type LIKE 'CM%') AS icd,
			(SELECT equip_demand FROM ctmsmis.mis_equip_demand WHERE yard ='NOFCY' AND equip_type LIKE 'CM%') AS nofcy
			) AS tbl";
            $resDemand = mysqli_query($con_sparcsn4,$demandQuery);*/
            $demandQuery="SELECT IFNULL(jr,'-') AS jr,IFNULL(ab,'-') AS ab,IFNULL(refer,'-') AS refer,IFNULL(y7,'-') AS y7,IFNULL(scy,'-') AS scy,
			IFNULL(y12,'-') AS y12,IFNULL(y3,'-') AS y3,IFNULL(y5,'-') AS y5,IFNULL(y6,'-') AS y6,
			IFNULL(y8B,'-') AS y8B,IFNULL(bapx,'-') AS bapx,IFNULL(y910,'-') AS y910,
			IFNULL(y11,'-') AS y11,IFNULL(ncy,'-') AS ncy,
			IFNULL(cct,'-') AS cct,IFNULL(nct,'-') AS nct,
			IFNULL(icd,'-') AS icd,IFNULL(nofcy,'-') AS nofcy,
			IFNULL(jr,0)+IFNULL(ab,0)+IFNULL(refer,0)+IFNULL(y7,0)+IFNULL(scy,0)+
			IFNULL(y12,0)+IFNULL(y3,0)+IFNULL(y5,0)+IFNULL(y6,0)+
			IFNULL(y8B,0)+IFNULL(bapx,0)+IFNULL(y910,0)+
			IFNULL(y11,0)+IFNULL(ncy,0)+IFNULL(cct,0)+IFNULL(nct,0)+IFNULL(icd,0)+IFNULL(nofcy,0) AS tot
			FROM (
			SELECT
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='JR' AND equip_type LIKE 'CM%') AS jr,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='AB' AND equip_type LIKE 'CM%') AS ab,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='DREFFER' AND equip_type LIKE 'CM%') AS refer,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='Y7' AND equip_type LIKE 'CM%') AS y7,
			(SELECT equip_demand FROM mis_equip_demand WHERE yard ='SCY' AND equip_type LIKE 'CM%') AS scy,
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
            $resDemand = mysqli_query($con_cchaportdb,$demandQuery);
            while($rowDemand = mysqli_fetch_object($resDemand))
            {
                $jrDeVal=$rowDemand->jr;
                $abDeVal=$rowDemand->ab;
                $refDeVal=$rowDemand->refer;
                $y7DeVal=$rowDemand->y7;
                $scyDeVal=$rowDemand->scy;
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
            <td><?php echo $scyDeVal; ?></td>
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
    //Get All block but not in 'JR' start
            $str_cm_jr="SELECT count(short_name) as tot
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
            WHERE short_name LIKE 'CM%' AND sel_block IN($jr_blocks)";
            $res_cm_jr_block= oci_parse($con_sparcsn4_oracle,$str_cm_jr);
            oci_execute($res_cm_jr_block); 

            $results_=array();
			$numRowCSAS = oci_fetch_all($res_cm_jr_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_cm_jr_block); 
			$res_cm_jr_block= oci_parse($con_sparcsn4_oracle,$str_cm_jr);
			oci_execute($res_cm_jr_block); 
			$jr_tot_cm=0;
			while(($rowshare_jr_block = oci_fetch_object($res_cm_jr_block)) != false)
				{
					$jr_tot_cm = $rowshare_jr_block->TOT;
					/* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
					$block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
					while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
					$block_cpa .=  $rowsBlockCpa->block_cpa.",";   
						
					} */
					  
				}
            /* $block_JR_query="SELECT DISTINCT block_cpa AS block FROM ctmsmis.yard_block
            WHERE  block_cpa!='NULL' AND block_cpa NOT IN('JR') ORDER BY block ASC";

            $block_JR_Result=mysqli_query($con_sparcsn4,$block_JR_query);
            $totalRow_JR_Yard=mysqli_num_rows($block_JR_Result);

            $ab15=0;
            $blockList_JRYard_NotIn="";
            while($blockRow_JRYard=mysqli_fetch_object($block_JR_Result)){

                $blockString_JR_Yard="";
                
                $blockString_JR_Yard=$blockRow_JRYard->block;
                
                if($ab15==($totalRow_JR_Yard-1)){
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."'";           
                }
                else{
                $blockList_JRYard_NotIn=$blockList_JRYard_NotIn."'".$blockString_JR_Yard."',";
                }
                $ab15++;
                }
                 $blockList_JRYard_NotIn;
                 //Get All block but not in 'JR' End


                $strJRSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa='JR' ORDER BY 1";
                $resJRSC = mysqli_query($con_sparcsn4,$strJRSC);
                $nVal = 0;
                $plusVal = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowJRSC = mysqli_fetch_object($resJRSC)){
                    $equiJrSc = $rowJRSC->equipment;
                   
                    $strChkShareJrSc ="
                    SELECT sel_block,equipement
                    FROM (
                    SELECT DISTINCT short_name AS equipement ,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiJrSc' AND sel_block IN($blockList_JRYard_NotIn)
                    ) tbl";
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    $results78=array();
                    $numRowCSJS = oci_fetch_all($resCSJS, $results78, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                    oci_free_statement($resCSJS); 
                    $resCSJS= oci_parse($con_sparcsn4_oracle,$strChkShareJrSc);
                    oci_execute($resCSJS);
                    if($numRowCSJS>0)
                    {
                        $plusVal +=1;
                        array_push($equipArray, $equiJrSc);
                       
                        while(($rowshareYard = oci_fetch_object($resCSJS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nVal +=1;
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php
                    if ($jr_tot_cm==0)
                    echo'-';
                     else 
                         echo $jr_tot_cm;
                   /* if($nVal>0 and $plusVal>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
             //Get All block but not in 'AB' start

             $str_cm_ab="SELECT count(short_name) as tot
             FROM xps_che
             INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
             WHERE short_name LIKE 'CM%' AND sel_block IN($ab_blocks)";
             
             
            $res_cm_ab_block= oci_parse($con_sparcsn4_oracle,$str_cm_ab);
            oci_execute($res_cm_ab_block); 
            
            $results_=array();
            $numRowCSAS = oci_fetch_all($res_cm_ab_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            oci_free_statement($res_cm_ab_block); 
            $res_cm_ab_block= oci_parse($con_sparcsn4_oracle,$str_cm_ab);
            oci_execute($res_cm_ab_block); 
            $ab_tot_cm=0;
            while(($rowshare_ab_block = oci_fetch_object($res_cm_ab_block)) != false)
                {
                    $ab_tot_cm = $rowshare_ab_block->TOT;
                    /* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                    $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                    while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                    $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                    
                    } */
                
                }
      
   /* $block_AB_qu="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
   WHERE  block_cpa!='NULL' AND block_cpa NOT IN('AB ZONE') ORDER BY block ASC";

   $block_AB_Res=mysqli_query($con_sparcsn4,$block_AB_qu);
   $totalRow_AB=mysqli_num_rows($block_AB_Res);

  $ab16=0;
  $blockList_AB_NotIn="";
  while($blockRow_AB=mysqli_fetch_object($block_AB_Res)){

     $blockString_AB="";
     
     $blockString_AB=$blockRow_AB->block;
     
     if($ab16==($totalRow_AB-1)){
     $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."'";           
     }
     else{
     $blockList_AB_NotIn=$blockList_AB_NotIn."'".$blockString_AB."',";
     }
     $ab16++;
     }
      $blockList_AB_NotIn;
      //Get All block but not in 'AB' End


                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa='AB ZONE' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_AB_NotIn)
                       )tbl";
                      
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                      $results80=array();
                      $numRowCSAS = oci_fetch_all($resCSAS, $results80, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                      oci_free_statement($resCSAS); 
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($ab_tot_cm==0)
                    echo'-';
                     else 
                    echo $ab_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
         // Get All block but not in 'AB' start
         $str_cm_d_reefer="SELECT count(short_name) as tot
         FROM xps_che
         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
         WHERE short_name LIKE 'CM%' AND sel_block IN($d_reefer_blocks)";
                         
         $res_cm_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_cm_d_reefer);
         oci_execute($res_cm_d_reefer_block); 
         
         $results_=array();
         $numRowCSAS = oci_fetch_all($res_cm_d_reefer_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
         oci_free_statement($res_cm_d_reefer_block); 
         $res_cm_d_reefer_block= oci_parse($con_sparcsn4_oracle,$str_cm_d_reefer);
         oci_execute($res_cm_d_reefer_block); 
         $d_reefer_tot_cm=0;
         while(($rowshare_d_reefer_block = oci_fetch_object($res_cm_d_reefer_block)) != false)
             {
                 $d_reefer_tot_cm = $rowshare_d_reefer_block->TOT;
                 /* $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                 $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                 while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                  $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                 
                 } */
               
             }
           /* $block_DREFFER_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
			   WHERE  block_cpa!='NULL' AND block_cpa NOT IN('D-REEFER') ORDER BY block ASC";

			   $block_DREFFER_Result=mysqli_query($con_sparcsn4,$block_DREFFER_Query);
			   $totalRow_DREFFER_Yard=mysqli_num_rows($block_DREFFER_Result);

			  $ab17=0;
			  $blockList_NotIn_DREFFER="";
			  while($blockRow_DREFFER_ya=mysqli_fetch_object($block_DREFFER_Result)){

				 $blockString_DREFFER_Ya="";
				 
				 $blockString_DREFFER_Ya=$blockRow_DREFFER_ya->block;
				 
				 if($ab17==($totalRow_DREFFER_Yard-1)){
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."'";           
				 }
				 else{
				 $blockList_NotIn_DREFFER=$blockList_NotIn_DREFFER."'".$blockString_DREFFER_Ya."',";
				 }
				 $ab17++;
				 }
				 $blockList_NotIn_DREFFER;
				  //Get All block but not in 'AB' End


                $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa='D-REEFER' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa = "";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NotIn_DREFFER)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results81=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results81, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($d_reefer_tot_cm==0)
                    echo'-';
                     else 
                    echo $d_reefer_tot_cm;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
         $str_cm_y7="SELECT count(short_name) as tot
         FROM xps_che
         INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
         WHERE short_name LIKE 'CM%' AND sel_block IN($y7_blocks)";
                         
         $res_cm_y7_block= oci_parse($con_sparcsn4_oracle,$str_cm_y7);
         oci_execute($res_cm_y7_block); 
         
         $results_=array();
         $numRowCSAS = oci_fetch_all($res_cm_y7_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
         oci_free_statement($res_cm_y7_block); 
         $res_cm_y7_block= oci_parse($con_sparcsn4_oracle,$str_cm_y7);
         oci_execute($res_cm_y7_block); 
         $y7_tot_cm=0;
         while(($rowshare_y7_block = oci_fetch_object($res_cm_y7_block)) != false)
             {
                 $y7_tot_cm = $rowshare_y7_block->TOT;
               
             }

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa='YARD 7' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y7)
                        )tbl";
                    
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                      $results82=array();
                      $numRowCSAS = oci_fetch_all($resCSAS, $results82, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                      oci_free_statement($resCSAS); 
                      $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                      oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($y7_tot_cm==0)
                    echo'-';
                     else 
                       echo $y7_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                        echo "0";
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_scy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'CM%' AND sel_block IN($scy_blocks)";
								
				$res_cm_scy_block= oci_parse($con_sparcsn4_oracle,$str_cm_scy);
				oci_execute($res_cm_scy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_cm_scy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_cm_scy_block); 
				$res_cm_scy_block= oci_parse($con_sparcsn4_oracle,$str_cm_scy);
				oci_execute($res_cm_scy_block); 
				$scy_tot_cm=0;
				while(($rowshare_scy_block = oci_fetch_object($res_cm_scy_block)) != false)
					{
						$scy_tot_cm = $rowshare_scy_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa='SCY' ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_SCY)
                       )tbl";

                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results83=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results83, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($scy_tot_cm==0)
                    echo'-';
                     else 
                    echo $scy_tot_cm;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_y_1_2_mn="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'CM%' AND sel_block IN($y_1_2_mn_blocks)";
								
				$res_cm_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_1_2_mn);
				oci_execute($res_cm_y_1_2_mn_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_cm_y_1_2_mn_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_cm_y_1_2_mn_block); 
				$res_cm_y_1_2_mn_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_1_2_mn);
				oci_execute($res_cm_y_1_2_mn_block); 
				$y_1_2_mn_tot_cm=0;
				while(($rowshare_y_1_2_mn_block = oci_fetch_object($res_cm_y_1_2_mn_block)) != false)
					{
						$y_1_2_mn_tot_cm = $rowshare_y_1_2_mn_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD-1','YARD 2','MN YARD') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $block_cpa = "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                      
                       $strChkShareABSc ="SELECT equipement,sel_block
                       FROM (
                       SELECT DISTINCT short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name ='$equiABSc' AND sel_block IN($blockList_Y1Y2YMN)
                       ) tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results84=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results84, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($y_1_2_mn_tot_cm==0)
                    echo'-';
                     else 
                    echo $y_1_2_mn_tot_cm;

                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_y_3="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'CM%' AND sel_block IN($y_3_blocks)";
								
				$res_cm_y_3_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_3);
				oci_execute($res_cm_y_3_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_cm_y_3_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_cm_y_3_block); 
				$res_cm_y_3_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_3);
				oci_execute($res_cm_y_3_block); 
				$y_3_tot_cm=0;
				while(($rowshare_y_3_block = oci_fetch_object($res_cm_y_3_block)) != false)
					{
						$y_3_tot_cm = $rowshare_y_3_block->TOT;
					  
					}

               /* $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 3') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y3)
                        )tbl";
                        
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results85=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results85, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>1)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($y_3_tot_cm==0)
                    echo'-';
                     else 
                    echo $y_3_tot_cm;

                  /*  if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php

            $str_cm_y_5="SELECT count(short_name) as tot
            FROM xps_che
            INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
            WHERE short_name LIKE 'CM%' AND sel_block IN($y_5_blocks)";
                            
            $res_cm_y_5_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_5);
            oci_execute($res_cm_y_5_block); 

            $results_=array();
            $numRowCSAS = oci_fetch_all($res_cm_y_5_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
            oci_free_statement($res_cm_y_5_block); 
            $res_cm_y_5_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_5);
            oci_execute($res_cm_y_5_block); 
            $y_5_tot_cm=0;
            while(($rowshare_y_5_block = oci_fetch_object($res_cm_y_5_block)) != false)
                {
                    $y_5_tot_cm = $rowshare_y_5_block->TOT;				  
                }

                /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 05') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                     
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y5)
                        )tbl";
                      
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results86=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results86, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($y_5_tot_cm==0)
                    echo'-';
                     else 
                          echo $y_5_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_y_6="SELECT count(short_name) as tot
                FROM xps_che
                INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                WHERE short_name LIKE 'CM%' AND sel_block IN($y_6_blocks)";
                                
                $res_cm_y_6_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_6);
                oci_execute($res_cm_y_6_block); 

                $results_=array();
                $numRowCSAS = oci_fetch_all($res_cm_y_6_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_cm_y_6_block); 
                $res_cm_y_6_block= oci_parse($con_sparcsn4_oracle,$str_cm_y_6);
                oci_execute($res_cm_y_6_block); 
                $y_6_tot_cm=0;
                while(($rowshare_y_6_block = oci_fetch_object($res_cm_y_6_block)) != false)
                {
                    $y_6_tot_cm = $rowshare_y_6_block->TOT;				  
                }



             /*   $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 6') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc = " SELECT equipement,sel_block
                        FROM 
                        (
                        SELECT DISTINCT short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y6_Y6X_NotIn)
                        )tbl";
                    
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results87=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results87, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                          
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($y_6_tot_cm==0)
                    echo'-';
                     else 
                             echo $y_6_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <!--td>
			<?php
                // Get All block but not in 'Y8' start
                    $str_cm_y8b="SELECT count(short_name) as tot
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name LIKE 'CM%' AND sel_block IN($y8b_blocks)";
                                
                    $res_cm_y8b_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8b);
                    oci_execute($res_cm_y8b_block); 
                
                $results_=array();
                $numRowCSAS = oci_fetch_all($res_cm_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                oci_free_statement($res_cm_y8b_block); 
                $res_cm_y8b_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8b);
                oci_execute($res_cm_y8b_block); 
                $y8b_tot_cm=0;
                while(($rowshare_y8b_block = oci_fetch_object($res_cm_y8b_block)) != false)
                    {
                        $y8b_tot_cm = $rowshare_y8b_block->TOT;				  
                    }
              
                 /*  $block_Y8_Query="SELECT DISTINCT block AS block FROM ctmsmis.yard_block
                WHERE  block_cpa!='NULL' AND  block_cpa NOT IN('YARD 8') ORDER BY block ASC";

                $block_Y8_Result=mysqli_query($con_sparcsn4,$block_Y8_Query);
                $totalRow_Y8=mysqli_num_rows($block_Y8_Result);

                $ab18=0;
                $blockList_Y8_NotIn="";
                while($blockRow_Y8_Res=mysqli_fetch_object($block_Y8_Result)){

                $blockString_Y8="";
              
                $blockString_Y8=$blockRow_Y8_Res->block;
              
                if($ab18==($totalRow_Y8-1)){
                $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."'";           
                 }
                else{
                $blockList_Y8_NotIn=$blockList_Y8_NotIn."'".$blockString_Y8."',";
                 }
                $ab18++;
              
              
              }
               $blockList_Y8_NotIn;
              // Get All block but not in 'Y8' End
            $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 8') ORDER BY 1";
            $resABSC = mysqli_query($con_sparcsn4,$strABSC);
            $nValAB = 0;
            $plusValAB = 0;
            $numRowCSAS = 0;
            $strChkShareABSc = "";
            $equiABSc= "";
            $block_cpa= "";
            $sel_block="";
            $block_cpaQu="";
            while($rowABSC = mysqli_fetch_object($resABSC)){
                $equiABSc = $rowABSC->equipment;
                $inarr = in_array($equiABSc, $equipArray);
                if(!$inarr)
                {
                   
                    $strChkShareJrSc ="
                    SELECT sel_block,equipement
                    FROM (
                    SELECT DISTINCT short_name AS equipement ,sel_block
                    FROM xps_che
                    INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                    WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8_NotIn)
                    ) tbl";
             
                   $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                   oci_execute($resCSAS);
                   $results88=array();
                   $numRowCSAS = oci_fetch_all($resCSAS, $results88, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                   oci_free_statement($resCSAS); 
                   $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                   oci_execute($resCSAS);
                    if($numRowCSAS>0)
                    {
                        $plusValAB +=1;
                        array_push($equipArray, $equiABSc);
                       
                        while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                        {
                            $sel_block =$rowshareYard->SEL_BLOCK;
                            $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                            $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                            while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                            $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                            }
                        }
                    }
                    else{
                        $nValAB +=1;
                    }
                }
            }*/
            ?>
			<label title="<?php echo rtrim($block_cpa,","); ?>">
				<?php if ($y8b_tot_cm==0)
                    echo'-';
                     else 
                       echo $y8b_tot_cm;
           /*  if($nValAB>0 and $plusValAB>0)
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
            }*/
            ?>
			</label>
		</td-->
            <td>
                <?php
                //  for Y8B
			$str_cm_y8b="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'CM%' AND sel_block IN($y8b_blocks)";
							
			$res_cm_y8b_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8b);
			oci_execute($res_cm_y8b_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_cm_y8b_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_cm_y8b_block); 
			$res_cm_y8b_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8b);
			oci_execute($res_cm_y8b_block); 
			$y8b_tot_cm=0;
			while(($rowshare_y8b_block = oci_fetch_object($res_cm_y8b_block)) != false)
				{
					$y8b_tot_cm= $rowshare_y8b_block->TOT;				  
				}

                /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 8') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y8B_NotIn)
                        )tbl";
                          
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results89=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results89, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($y8b_tot_cm==0)
                    echo'-';
                     else 
                    echo $y8b_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
            //for Yard 'BX2','Y8','BAPX1','BX1'

              $str_cm_y8="SELECT count(short_name) as tot
              FROM xps_che
              INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
              WHERE short_name LIKE 'CM%' AND sel_block IN($y8_blocks)";
                       
             $res_cm_y8_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8);
             oci_execute($res_cm_y8_block); 
       
             $results_=array();
             $numRowCSAS = oci_fetch_all($res_cm_y8_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
             oci_free_statement($res_cm_y8_block); 
             $res_cm_y8_block= oci_parse($con_sparcsn4_oracle,$str_cm_y8);
             oci_execute($res_cm_y8_block); 
             $y8_tot_cm=0;
             while(($rowshare_y8_block = oci_fetch_object($res_cm_y8_block)) != false)
             {
               $y8_tot_cm = $rowshare_y8_block->TOT;				  
             }

               
              /*   $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' 
				AND capacity=50 AND block_cpa IN('BAPEX','YARD 8') ORDER BY 1"; //BAPX1,BAPX2 replaced by BX2
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_BX2_Y8_BAPX1_BX1_NotIn)
                        )tbl ";

                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results90=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results90, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                            
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
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
                    if ($y8_tot_cm==0)
                    echo'-';
                     else 
                           echo $y8_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
           // for 'Y9','Y10'
            $str_cm_y9="SELECT count(short_name) as tot
			FROM xps_che
			INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
			WHERE short_name LIKE 'CM%' AND sel_block IN($y9_blocks)";
							
			$res_cm_y9_block= oci_parse($con_sparcsn4_oracle,$str_cm_y9);
			oci_execute($res_cm_y9_block); 
			
			$results_=array();
			$numRowCSAS = oci_fetch_all($res_cm_y9_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
			oci_free_statement($res_cm_y9_block); 
			$res_cm_y9_block= oci_parse($con_sparcsn4_oracle,$str_cm_y9);
			oci_execute($res_cm_y9_block); 
			$y9_tot_cm=0;
			while(($rowshare_y9_block = oci_fetch_object($res_cm_y9_block)) != false)
				{
					$y9_tot_cm = $rowshare_y9_block->TOT;				  
				}	

                /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD 9','YARD-10') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y9_Y10_NotIn)
                        )tbl";
                              
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        $results91=array();
                        $numRowCSAS = oci_fetch_all($resCSAS, $results91, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                        oci_free_statement($resCSAS); 
                        $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                        oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
            <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($y9_tot_cm==0)
                    echo'-';
                     else 
                             echo $y9_tot_cm;

                  /*  if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_y11="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'CM%' AND sel_block IN($y11_blocks)";
								
				$res_cm_y11_block= oci_parse($con_sparcsn4_oracle,$str_cm_y11);
				oci_execute($res_cm_y11_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_cm_y11_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_cm_y11_block); 
				$res_cm_y11_block= oci_parse($con_sparcsn4_oracle,$str_cm_y11);
				oci_execute($res_cm_y11_block); 
				$y11_tot_cm=0;
				while(($rowshare_y11_block = oci_fetch_object($res_cm_y11_block)) != false)
					{
						$y11_tot_cm = $rowshare_y11_block->TOT;				  
					}

                /*$strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('YARD11') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                $sel_block="";
                $block_cpaQu="";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                        
                        $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                        FROM (
                        SELECT DISTINCT 
                        short_name AS equipement ,sel_block
                        FROM xps_che
                        INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                        WHERE short_name = '$equiABSc' AND sel_block IN($blockList_Y11_NotIn)
                        )tbl";
                       
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results92=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results92, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>1)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                           
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($y11_tot_cm==0)
                    echo'-';
                     else 
                             echo $y11_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
            </td>
            <td>
                <?php
                $str_cm_ncy="SELECT count(short_name) as tot
				FROM xps_che
				INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
				WHERE short_name LIKE 'CM%' AND sel_block IN($ncy_blocks)";
								
				$res_cm_ncy_block= oci_parse($con_sparcsn4_oracle,$str_cm_ncy);
				oci_execute($res_cm_ncy_block); 
				
				$results_=array();
				$numRowCSAS = oci_fetch_all($res_cm_ncy_block, $results_, null, null, OCI_FETCHSTATEMENT_BY_ROW);
				oci_free_statement($res_cm_ncy_block); 
				$res_cm_ncy_block= oci_parse($con_sparcsn4_oracle,$str_cm_ncy);
				oci_execute($res_cm_ncy_block); 
				$ncy_tot_cm=0;
				while(($rowshare_ncy_block = oci_fetch_object($res_rst_ncy_block)) != false)
					{
						$ncy_tot_cm = $rowshare_ncy_block->TOT;				  
					}

              /*  $strABSC = "SELECT DISTINCT equipment
				FROM ctmsmis.mis_equip_assign_detail
				INNER JOIN ctmsmis.mis_equip_detail ON mis_equip_assign_detail.equip_detail_id=mis_equip_detail.id
				INNER JOIN ctmsmis.yard_block ON ctmsmis.yard_block.block=ctmsmis.mis_equip_assign_detail.block
				WHERE start_state =1 AND end_state=0 AND DATE(start_work_time)=DATE(NOW()) AND equipment LIKE 'CM%' AND capacity=50 AND block_cpa in('NCY') ORDER BY 1";
                $resABSC = mysqli_query($con_sparcsn4,$strABSC);
                $nValAB = 0;
                $plusValAB = 0;
                $numRowCSAS = 0;
                $strChkShareABSc = "";
                $equiABSc= "";
                $block_cpa= "";
                while($rowABSC = mysqli_fetch_object($resABSC)){
                    $equiABSc = $rowABSC->equipment;
                    $inarr = in_array($equiABSc, $equipArray);
                    if(!$inarr)
                    {
                       
                       $strChkShareABSc ="SELECT  tbl.equipement,tbl.sel_block
                       FROM (
                       SELECT DISTINCT 
                       short_name AS equipement ,sel_block
                       FROM xps_che
                       INNER JOIN xps_chezone ON xps_chezone.che_id=xps_che.id
                       WHERE short_name = '$equiABSc' AND sel_block IN($blockList_NCY_NotIn)
                       )tbl";
                    
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                       $results93=array();
                       $numRowCSAS = oci_fetch_all($resCSAS, $results93, null, null, OCI_FETCHSTATEMENT_BY_ROW);
                       oci_free_statement($resCSAS); 
                       $resCSAS= oci_parse($con_sparcsn4_oracle,$strChkShareABSc);
                       oci_execute($resCSAS);
                        if($numRowCSAS>0)
                        {
                            $plusValAB +=1;
                            array_push($equipArray, $equiABSc);
                         
                            while(($rowshareYard = oci_fetch_object($resCSAS)) != false)
                            {
                                $sel_block =$rowshareYard->SEL_BLOCK;
                                $block_cpaQu = "SELECT block_cpa FROM ctmsmis.yard_block WHERE block='$sel_block'";
                                $block_cpaRes = mysqli_query($con_sparcsn4,$block_cpaQu);
                                while($rowsBlockCpa = mysqli_fetch_object($block_cpaRes)){
                                $block_cpa .=  $rowsBlockCpa->block_cpa.",";   
                                }
                            }
                        }
                        else{
                            $nValAB +=1;
                        }
                    }
                }*/
                ?>
                <label title="<?php echo rtrim($block_cpa,","); ?>">
                    <?php if ($ncy_tot_cm==0)
                    echo'-';
                     else 
                            echo  $ncy_tot_cm;
                   /* if($nValAB>0 and $plusValAB>0)
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
                    }*/
                    ?>
                </label>
        </td>
            <!-- Workshop-D-->
            <td><?php if ($cm_cct_tot==0)
                    echo'-';
                     else  echo $cm_cct_tot; ?></td>
            <td><?php if ($cm_nct_tot==0)
                    echo'-';
                     else echo $cm_nct_tot; ?></td>
            <td><?php if ($cm_icd_tot==0)
                    echo'-';
                     else echo $cm_icd_tot; ?></td>
            <td><?php if ($cm_nofcy_tot==0)
                    echo'-';
                     else  echo $cm_nofcy_tot; ?></td>
            <td><?php echo $tot_equip_cm+$jr_tot_cm+$ab_tot_cm+$d_reefer_tot_cm+$y7_tot_cm+$scy_tot_cm+$y_1_2_mn_tot_cm+$y_3_tot_cm+$y_5_tot_cm+$y_6_tot_cm+$y8b_tot_cm+$y8_tot_cm+$y9_tot_cm+$y11_tot_cm+$ncy_tot_cm+$cm_cct_tot+$cm_nct_tot+$cm_icd_tot+$cm_nofcy_tot; ?></td>
        </tr>


        <?php //} ?>

       
    </table>

		<BR>
		<table border=0 width="100%">				

			<tr align="center">
				<td colspan="12"><font size="4"><b><u>CONTAINER HANDLING EQUIPMENT POSITION OF ZONE- AB, C, D & PICT</u></b></font></td>
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
				<td colspan=5>ZONE-C</td>
				
				<td colspan=4>ZONE-D</td>
				<td rowspan=3>TOTAL EQUIPMENT</td>
				<!-- <td colspan=2>TOTAL OPERATIONAL</td> -->
                <td colspan=3>TOTAL OPERATIONAL</td>
				<td rowspan=3>TOTAL OUT OF ORDER</td>
			</tr>
			<tr align="center">			
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="2">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="3">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				
				<td rowspan="2">TOTAL NUMBER</td>
				<td colspan="2">OPERATIONAL</td>
				<td rowspan="2">OUT OF ORDER</td>
				<td rowspan="2">BOOKED</td>
				<td rowspan="2">STAND BY</td> 
                <!-- New Add By Nadim Start -->
                <td rowspan="2">PICT</td> 
                  <!-- New Add By Nadim End -->
			</tr>
			<tr align="center">	
				<td>BOOKED</td>
				<td>STAND BY</td>
                
				
				<td>BOOKED</td>
				<td>STAND BY</td>
				<td>PICT</td>
				
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
			
			$qgc_pict_tot=0;
		
			
			$qgc_d_tot=0;
			$qgc_d_booked=0;
			$qgc_d_standby=0;
			$qgc_d_out=0;
			
			/*$qgcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='QGC') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='QGC') AS pict_tot_non_op";
			$rowQGCQry=mysqli_query($con_sparcsn4,$qgcQuery);
			while($rtnQGCQuery=mysqli_fetch_object($rowQGCQry))*/
			$qgcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='QGC') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='QGC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='QGC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='QGC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='QGC') AS pict_tot_non_op";
			$rowQGCQry=mysqli_query($con_cchaportdb,$qgcQuery);
			while($rtnQGCQuery=mysqli_fetch_object($rowQGCQry))
            
            
            
            
            {
				
				$qgc_ab_tot=$rtnQGCQuery->ab_tot;
				$qgc_ab_booked=$tot_qgc_booked;
				$qgc_ab_standby=$rtnQGCQuery->ab_tot - ($tot_qgc_booked+$rtnQGCQuery->ab_tot_non_op);
				$qgc_ab_out=$rtnQGCQuery->ab_tot_non_op;
				
				$qgc_c_tot=$rtnQGCQuery->c_tot;
				$qgc_c_booked=$tot_qgc_booked;
				$qgc_c_standby=$rtnQGCQuery->c_tot - ($tot_qgc_booked+$rtnQGCQuery->c_tot_non_op);
				$qgc_c_out=$rtnQGCQuery->c_tot_non_op;
				
				$qgc_pict_tot=$rtnQGCQuery->pict_tot;
				
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
				
				$qgc_out_order_zone_d=0;
				$qgc_total_equip=0;
				$qgc_stand_by=0;
				$qgc_out_of_order=0;
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
				<td><?php echo $qgc_pict_tot;  ?></td> <!-- PICT -->
				<td><?php echo $qgc_c_out;  ?></td>
				
								
				<td><?php echo $qgc_d_tot;  ?></td>
				<td><?php echo $qgc_d_booked;  ?></td>
				<td><?php echo $qgc_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $qgc_d_out;  ?></td-->
				<td><?php $qgc_out_order_zone_d=($qgc_d_tot-($qgc_d_booked+$qgc_d_standby)); echo (abs ($qgc_d_tot-($qgc_d_booked+$qgc_d_standby)));?></td>
				
				<td> <!--Total Equipment-->
					<?php 
						$qgc_total_equip=$qgc_ab_tot+$qgc_c_tot+$qgc_d_tot+$qgc_pict_tot ; 
						echo $qgc_ab_tot+$qgc_c_tot+$qgc_d_tot+$qgc_pict_tot ;  
					?>
				</td> 
				
				<!--td><?php echo $qgc_ab_booked+$qgc_c_booked+$qgc_d_booked;  ?></td-->
				<td>
					<?php echo $qgc_d_booked;  ?>
				</td>
				<td>
					<?php 
						$qgc_stand_by=$qgc_ab_standby+$qgc_c_standby+$qgc_d_standby; 
						echo $qgc_ab_standby+$qgc_c_standby+$qgc_d_standby;  
					?>
				</td>
				<!--td><?php echo $qgc_ab_out+$qgc_c_out+$qgc_d_out;  ?></td-->
                <td><?php echo $qgc_pict_tot;  ?></td> <!-- PICT for total operational -->
				<td>
					<?php 
						$qgc_out_of_order=$qgc_ab_out+$qgc_c_out+($qgc_d_tot-($qgc_d_booked+$qgc_d_standby)); 
						echo $qgc_ab_out+$qgc_c_out+($qgc_d_tot-($qgc_d_booked+$qgc_d_standby));  
					?>
				</td>
				
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
			
			$rtg_pict_tot=0;
			
			
			$rtg_d_tot=0;
			$rtg_d_booked=0;
			$rtg_d_standby=0;
			$rtg_d_out=0;

			/*$rtgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RTG') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RTG') AS pict_tot_non_op";
			$rowRTGQry=mysqli_query($con_sparcsn4,$rtgQuery);
			while($rtnRTGQuery=mysqli_fetch_object($rowRTGQry))*/
            $rtgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RTG') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RTG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RTG') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RTG') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RTG') AS pict_tot_non_op";
			$rowRTGQry=mysqli_query($con_cchaportdb,$rtgQuery);
			while($rtnRTGQuery=mysqli_fetch_object($rowRTGQry))


            

       
			{
				$rtg_ab_tot=$rtnRTGQuery->ab_tot;
				$rtg_ab_booked=$tot_equip_rtg_ab;
				$rtg_ab_standby=$rtnRTGQuery->ab_tot - ($tot_equip_rtg_ab+$rtnRTGQuery->ab_tot_non_op);
				$rtg_ab_out=$rtnRTGQuery->ab_tot_non_op;
				
				$rtg_c_tot=$rtnRTGQuery->c_tot;
				//$rtg_c_booked=$y8_tot_rtg=$tot_equip_rtg_c;
                $rtg_c_booked=$y_1_2_mn_tot_rtg+$y_3_tot_rtg+$y_5_tot_rtg+$y_6_tot_rtg+$y8b_tot_rtg+$y8_tot_rtg+$y9_tot_rtg+$y11_tot_rtg+$ncy_tot_rtg;
                $rtg_c_standby=$rtnRTGQuery->c_tot - ($rtg_c_booked+$rtnRTGQuery->c_tot_non_op);
				//$rtg_c_standby=$rtnRTGQuery->c_tot - ($tot_equip_rtg_c+$rtnRTGQuery->c_tot_non_op);
				$rtg_c_out=$rtnRTGQuery->c_tot_non_op;
				
				$rtg_pict_tot=$rtnRTGQuery->pict_tot;
				
				
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
				
				$rtg_out_order_zone_d=0;
				$rtg_total_equip=0;
				$rtg_total_booked=0;
				$rtg_stand_by=0;
				$rtg_out_of_order=0;
			?>
			<tr align="center">			
				<td>RTG</td>
				<td><?php echo $rtg_ab_tot;  ?></td>
				<td><?php echo $rtg_ab_booked; ?></td>
				<td><?php echo $rtg_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $rtg_ab_out;  ?></td>
				
				<td><?php echo $rtg_c_tot;?></td>
				<td><?php   echo $rtg_c_booked; ?></td>
                
				<td><?php echo $rtg_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $rtg_pict_tot;  ?></td> <!-- PICT -->
				<td><?php echo $rtg_c_out;  ?></td>
				
				
				
				<td><?php echo $rtg_d_tot;  ?></td>
				<td><?php echo $rtg_d_booked;  ?></td>
				<td><?php echo $rtg_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $rtg_d_out;  ?></td-->
				
				 <td><?php $rtg_out_order_zone_d=(abs($rtg_d_tot-($rtg_d_booked+$rtg_d_standby))); echo(abs ($rtg_d_tot-($rtg_d_booked+$rtg_d_standby)));  ?></td> 
                 
				<!-- <td><?php $rtg_out_order_zone_d=(($rtg_d_booked+$rtg_d_standby)-$rtg_d_tot); echo (($rtg_d_booked+$rtg_d_standby)-$rtg_d_tot);  ?></td> -->
				<td><?php $rtg_total_equip = $rtg_ab_tot+$rtg_c_tot+$rtg_d_tot+$rtg_pict_tot ; echo $rtg_ab_tot+$rtg_c_tot+$rtg_d_tot+$rtg_pict_tot ;  ?></td>
				<td>
					<?php 
						$rtg_total_booked=$rtg_ab_booked+$rtg_c_booked+$rtg_d_booked; 
						echo $rtg_ab_booked+$rtg_c_booked+$rtg_d_booked;  ?>
				</td>
				<td>
					<?php 
						$rtg_stand_by = $rtg_ab_standby+$rtg_c_standby+$rtg_d_standby; 
						echo $rtg_ab_standby+$rtg_c_standby+$rtg_d_standby;  
					?>
				</td>
				<!--td><?php echo $rtg_ab_out+$rtg_c_out+$rtg_d_out;  ?></td-->
                <td><?php echo $rtg_pict_tot;  ?></td> <!-- PICT for total operational -->
				<td>
					<?php 
						$rtg_out_of_order =abs ($rtg_ab_out+$rtg_c_out+$rtg_out_order_zone_d); 
						echo abs($rtg_ab_out+$rtg_c_out+$rtg_out_order_zone_d); 
					?>
				</td>
				
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
			
			$mhc_pict_tot=0;
						
			$mhc_d_tot=0;
			$mhc_d_booked=0;
			$mhc_d_standby=0;
			$mhc_d_out=0;

			/*$mhcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='MHC') AS pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='MHC') AS pict_tot_non_op";
			 $rowMHCQry=mysqli_query($con_sparcsn4,$mhcQuery);
			while($rtnMHCQuery=mysqli_fetch_object($rowMHCQry))*/
            $mhcQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='MHC') AS pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='MHC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='MHC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='MHC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='MHC') AS pict_tot_non_op";
			 $rowMHCQry=mysqli_query($con_cchaportdb,$mhcQuery);
			while($rtnMHCQuery=mysqli_fetch_object($rowMHCQry))
           
           

			{
				$mhc_ab_tot=$rtnMHCQuery->ab_tot;
				$mhc_ab_booked=0;
				$mhc_ab_standby=$rtnMHCQuery->ab_tot - ($tot_mhc_booked+$rtnMHCQuery->ab_tot_non_op);
				$mhc_ab_out=$rtnMHCQuery->ab_tot_non_op;
				
				$mhc_c_tot=$rtnMHCQuery->c_tot;
				$mhc_c_booked=0;
				$mhc_c_standby=$rtnMHCQuery->c_tot - ($tot_mhc_booked+$rtnMHCQuery->c_tot_non_op);
				$mhc_c_out=$rtnMHCQuery->c_tot_non_op;
				
				$mhc_pict_tot=$rtnMHCQuery->pict_tot;
				
				
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
				$mhc_out_order_zone_d=0;
				$mhc_total_equip=0;
				$mhc_total_booked=0;
				$mhc_stand_by=0;
				$mhc_out_of_order=0;
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
				<td><?php echo $mhc_pict_tot;  ?></td> <!-- PICT -->
				<td><?php echo $mhc_c_out;  ?></td>
				
				
				
				<td><?php echo $mhc_d_tot;  ?></td>
				<td><?php echo $mhc_d_booked;  ?></td>
				<td><?php echo $mhc_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $mhc_d_out;  ?></td-->
				<td><?php $mhc_out_order_zone_d=($mhc_d_tot-($mhc_d_booked+$mhc_d_standby)); echo(abs ($mhc_d_tot-($mhc_d_booked+$mhc_d_standby)));  ?></td>
				
				<td>
					<?php 
						$mhc_total_equip=$mhc_ab_tot+$mhc_c_tot+$mhc_d_tot+$mhc_pict_tot; 
						echo $mhc_ab_tot+$mhc_c_tot+$mhc_d_tot+$mhc_pict_tot;  
					?>
				</td>
				<td>
					<?php 
						$mhc_total_booked=$mhc_ab_booked+$mhc_c_booked+$mhc_d_booked; 
						echo $mhc_ab_booked+$mhc_c_booked+$mhc_d_booked;  
					?>
				</td>
				<td>
					<?php 
						$mhc_stand_by=$mhc_ab_standby+$mhc_c_standby+$mhc_d_standby; 
						echo $mhc_ab_standby+$mhc_c_standby+$mhc_d_standby;  
					?>
				</td> <!-- STAND BY -->
				<!--td><?php echo $mhc_ab_out+$mhc_c_out+$mhc_d_out;  ?></td-->
                <td><?php echo $mhc_pict_tot;  ?></td> <!-- PICT for total operational -->
				<td>
					<?php 
						$mhc_out_of_order=$mhc_ab_out+$mhc_c_out+($mhc_d_tot-($mhc_d_booked+$mhc_d_standby)); 
						echo $mhc_ab_out+$mhc_c_out+($mhc_d_tot-($mhc_d_booked+$mhc_d_standby));  
					?>
				</td>
				
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
			
			$rmg_pict_tot=0;
			
			$rmg_d_tot=0;
			$rmg_d_booked=0;
			$rmg_d_standby=0;
			$rmg_d_out=0;

			/*$rmgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RMG') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RMG') AS pict_tot_non_op";
			 $rowRMGQry=mysqli_query($con_sparcsn4,$rmgQuery);
			while($rtnRMGQuery=mysqli_fetch_object($rowRMGQry))*/
            $rmgQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RMG') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RMG') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RMG') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RMG') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RMG') AS pict_tot_non_op";
			$rowRMGQry=mysqli_query($con_cchaportdb,$rmgQuery);
			while($rtnRMGQuery=mysqli_fetch_object($rowRMGQry))

			{
				$rmg_ab_tot=$rtnRMGQuery->ab_tot;
				$rmg_ab_booked=0;
				$rmg_ab_standby=$rtnRMGQuery->ab_tot - ($tot_rmg_booked+$rtnRMGQuery->ab_tot_non_op);
				$rmg_ab_out=$rtnRMGQuery->ab_tot_non_op;
				
				$rmg_c_tot=$rtnRMGQuery->c_tot;
				$rmg_c_booked=0;
				$rmg_c_standby=$rtnRMGQuery->c_tot - ($tot_rmg_booked+$rtnRMGQuery->c_tot_non_op);
				$rmg_c_out=$rtnRMGQuery->c_tot_non_op;
				
				$rmg_pict_tot=$rtnRMGQuery->pict_tot;
				
				
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
				$rmg_out_order_zone_d=0;
				$rmg_total_equip=0;
				$rmg_total_booked=0;
				$rmg_stand_by=0;
				$rmg_out_of_order=0;
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
				<td><?php echo $rmg_pict_tot;  ?></td> <!-- PICT -->
				<td><?php echo $rmg_c_out;  ?></td>
				
				
				
				<td><?php echo $rmg_d_tot;  ?></td>
				<td><?php echo $rmg_d_booked;  ?></td>
				<td><?php echo $rmg_d_standby;  ?></td> <!-- STAND BY -->
				<!--td><?php echo $rmg_d_out;  ?></td-->
				<td><?php $rmg_out_order_zone_d =($rmg_d_tot-($rmg_d_booked+$rmg_d_standby));   echo(abs ($rmg_d_tot-($rmg_d_booked+$rmg_d_standby)));  ?></td>
				
				<td>
					<?php 
						$rmg_total_equip = $rmg_ab_tot+$rmg_c_tot+$rmg_d_tot+$rmg_pict_tot ; 
						echo $rmg_ab_tot+$rmg_c_tot+$rmg_d_tot+$rmg_pict_tot ;  
					?>
				</td>
				<td>
					<?php 
						$rmg_total_booked=$rmg_ab_booked+$rmg_c_booked+$rmg_d_booked;  
						echo $rmg_ab_booked+$rmg_c_booked+$rmg_d_booked;  
					?>
				</td>
				<td>
					<?php 
						$rmg_stand_by=$rmg_ab_standby+$rmg_c_standby+$rmg_d_standby;  
						echo $rmg_ab_standby+$rmg_c_standby+$rmg_d_standby;  
					?>
				</td>
				<!--td><?php echo $rmg_ab_out+$rmg_c_out+$rmg_d_out;  ?></td-->
                <td><?php echo $rmg_pict_tot;  ?></td> <!-- PICT for totall operational-->
				<td>
					<?php 
						$rmg_out_of_order= $rmg_ab_out+$rmg_c_out+($rmg_d_tot-($rmg_d_booked+$rmg_d_standby)); 
						echo $rmg_ab_out+$rmg_c_out+($rmg_d_tot-($rmg_d_booked+$rmg_d_standby));  
					?>
				</td>
				
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
			
			$sc_pict_tot=0;
			
			
			$sc_d_tot=0;
			$sc_d_booked=0;
			$sc_d_standby=0;
			$sc_d_out=0;
			
			/*$scQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='SC') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='SC') AS pict_tot_non_op";
			$rowSCQry=mysqli_query($con_sparcsn4,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))*/

            $scQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') AS  d_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='SC') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='SC') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='SC') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='SC') AS d_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='SC') AS pict_tot_non_op";
			$rowSCQry=mysqli_query($con_cchaportdb,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))

            {
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_sc_ab=$jr_tot_sc+$ab_tot_sc+$d_reefer_tot_sc+$y7_tot_sc+$scy_tot_sc;
                $sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_sc_ab+$rtnSCQuery->ab_tot_non_op);
                $sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_sc_c=$y_1_2_mn_tot_sc+$y_3_tot_sc+$y_5_tot_sc+$y_6_tot_sc+$y8b_tot_sc+$y8_tot_sc+$y9_tot_sc+$y11_tot_sc+$ncy_tot_sc;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_sc_c+$rtnSCQuery->c_tot_non_op);
                
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				$sc_pict_tot=$rtnSCQuery->pict_tot;
				
				
				$sc_d_tot=$rtnSCQuery->d_tot;
				$sc_d_booked=$tot_equip_sc_d=$sc_cct_tot+$sc_nct_tot+$sc_icd_tot+$sc_nofcy_tot;
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
				
				$sc_ab_total_s=0;
				$sc_ab_booked_s=0;
				$sc_ab_standby_s=0;
				$sc_ab_out_s=0;
				
				$sc_c_tot_s=0;
				$sc_c_booked_s=0;
				$sc_c_standby_s=0;
				$sc_c_out_s=0;
				
				
				$sc_d_tot_s=0;
				$sc_d_booked_s=0;
				$sc_d_standby_s=0;
				$sc_out_order_zone_d=0;
				
				$sc_total_equip=0;
				$sc_total_booked=0;
				$sc_stand_by=0;
				$sc_out_of_order=0;
			?>

            <!-- my change strat -->
			<tr align="center">		
				<td>SC</td>
				<td><?php $sc_ab_total_s = $sc_ab_tot; echo $sc_ab_tot; ?></td>
				<td><?php $sc_ab_booked_s=$sc_ab_booked=$jr_tot_sc+$ab_tot_sc+$d_reefer_tot_sc+$y7_tot_sc+$scy_tot_sc;  echo $sc_ab_booked;  ?></td>
                <!--td><?php $sc_ab_booked_sum=$jr_tot_sc+$ab_tot_sc+$d_reefer_tot_sc+$y7_tot_sc+$scy_tot_sc; echo $sc_ab_booked_sum ;?></td-->
				<td><?php $sc_ab_standby_s=$sc_ab_standby; echo $sc_ab_standby;?></td> <!-- STAND BY -->
				<td><?php $sc_ab_out_s=$sc_ab_out; echo(abs ($sc_ab_out));?></td>
				
				<td><?php $sc_c_tot_s=$sc_c_tot;  echo $sc_c_tot;  ?></td>
				<td><?php $sc_c_booked_s=$sc_c_booked=$y_1_2_mn_tot_sc+$y_3_tot_sc+$y_5_tot_sc+$y_6_tot_sc+$y8b_tot_sc+$y8_tot_sc+$y9_tot_sc+$y11_tot_sc+$ncy_tot_sc;  echo $sc_c_booked; ?></td>
                <!--td><?php $sc_c_booked_sum=$y_1_2_mn_tot_sc+$y_3_tot_sc+$y_5_tot_sc+$y_6_tot_sc+$y8b_tot_sc+$y8_tot_sc+$y9_tot_sc+$y11_tot_sc+$ncy_tot_sc; echo $sc_c_booked_sum;  ?></td-->
				<td><?php $sc_c_standby_s=$sc_c_standby; echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $sc_pict_tot;  ?></td> <!-- PICT -->
				<td><?php $sc_c_out_s=$sc_c_out;  echo (abs($sc_c_out));  ?></td>
				
				
				<td><?php $sc_d_tot_s=$sc_d_tot; echo $sc_d_tot;  ?></td>
				<td><?php $sc_d_booked_s=$sc_d_booked=$sc_cct_tot+$sc_nct_tot+$sc_icd_tot+$sc_nofcy_tot; echo $sc_d_booked;  ?></td>
                <!--td><?php $sc_d_booked_sum= $sc_cct_tot+$sc_nct_tot+$sc_icd_tot+$sc_nofcy_tot; echo $sc_d_booked_sum; ?></td-->
				<td><?php $sc_d_standby_s=$sc_d_standby; echo $sc_d_standby;  ?></td> <!-- STAND BY -->
				<td><?php $sc_out_order_zone_d=$sc_d_out; echo(abs( $sc_d_out));  ?></td>
				
				<td><?php $sc_total_equip=$sc_ab_tot+$sc_c_tot+$sc_d_tot+$sc_pict_tot ;  echo $sc_ab_tot+$sc_c_tot+$sc_d_tot+$sc_pict_tot ;  ?></td>
				<td>
					<?php 
						$sc_total_booked= $sc_ab_booked+$sc_c_booked+$sc_d_booked; 
						echo $sc_ab_booked+$sc_c_booked+$sc_d_booked;  
					?>
				</td>
				<td>
					<?php 
						$sc_stand_by=$sc_ab_standby+$sc_c_standby+$sc_d_standby; 
						echo $sc_ab_standby+$sc_c_standby+$sc_d_standby;  
					?>
				</td>
                <td>
                <!-- PICT for totall operational -->
                    <?php echo $sc_pict_tot;  ?>
               </td> 
				<td>
					<?php 
						$sc_out_of_order=$sc_ab_out+$sc_c_out+$sc_d_out; 
						echo $sc_ab_out+$sc_c_out+$sc_d_out;  
					?>
				</td>
				
			</tr>

            

            <!-- my change end -->
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
			
			$rst45_pict_tot=0;
			
			/*$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  c_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST Loaded 45 Ton') AS  pict_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  
					c_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST Loaded 45 Ton') AS  
					pict_tot_non_op
					";
			$rowSCQry=mysqli_query($con_sparcsn4,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))*/


            $scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  c_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST Loaded 45 Ton') AS  pict_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST Loaded 45 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST Loaded 45 Ton') AS  
					c_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST Loaded 45 Ton') AS  
					pict_tot_non_op
					";
			$rowSCQry=mysqli_query($con_cchaportdb,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))



			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_rst45_ab=$sc_ab_booked=$jr_tot_rst+$ab_tot_rst+$d_reefer_tot_rst+$y7_tot_rst+$scy_tot_rst;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_rst45_ab+$rtnSCQuery->ab_tot_non_op);
            
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_rst45_c=$y_1_2_mn_tot_rst+$y_3_tot_rst+$y_5_tot_rst+$y_6_tot_rst+$y8b_tot_rst+$y8_tot_rst+$y9_tot_rst+$y11_tot_rst+$ncy_tot_rst ; 
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
				$rst45_ab_total=0;
				$rst45_ab_booked=0;
				$rst45_ab_standby=0;
				$rst45_ab_out=0;

				$rst45_c_tot=0;
				$rst45_c_booked=0;
				$rst45_c_standby=0;
				$rst45_c_out=0;
				
				$rst45_pict_tot=$rtnSCQuery->pict_tot;
				

				$rst45_d_tot=0;
				$rst45_d_booked=0;
				$rst45_d_standby=0;
				
				$rst45_out_order_zone_d=0;
				$rst45_total_equip=0;
				$rst45_total_booked=0;
				$rst45_stand_by=0;
				$rst45_out_of_order=0;
			?>
			<tr align="center">			
				<td>RST 45 TON(L)</td>
				<td><?php $rst45_ab_total=$sc_ab_tot; echo $sc_ab_tot;  ?></td>
				<td><?php $rst45_ab_booked=$sc_ab_booked=$jr_tot_rst+$ab_tot_rst+$d_reefer_tot_rst+$y7_tot_rst+$scy_tot_rst; echo $sc_ab_booked;  ?></td>
                <!--td><?php $rst45_ab_booked_sum =$jr_tot_rst+$ab_tot_rst+$d_reefer_tot_rst+$y7_tot_rst+$scy_tot_rst; echo $rst45_ab_booked_sum; ?></td-->
				<td><?php $rst45_ab_standby=$sc_ab_standby; echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php $rst45_ab_out=$sc_ab_out;  echo(abs ($sc_ab_out));  ?></td>
				
				<td><?php $rst45_c_tot=$sc_c_tot; echo $sc_c_tot;  ?></td>
				<td><?php $rst45_c_booked=$sc_c_booked=$y_1_2_mn_tot_rst+$y_3_tot_rst+$y_5_tot_rst+$y_6_tot_rst+$y8b_tot_rst+$y8_tot_rst+$y9_tot_rst+$y11_tot_rst+$ncy_tot_rst ; echo $sc_c_booked;  ?></td>
                <!--td><?php $rst45_c_booked_sum=$y_1_2_mn_tot_rst+$y_3_tot_rst+$y_5_tot_rst+$y_6_tot_rst+$y8b_tot_rst+$y8_tot_rst+$y9_tot_rst+$y11_tot_rst+$ncy_tot_rst ; echo $rst45_c_booked_sum;?></td-->
				<td><?php $rst45_c_standby=$sc_c_standby; echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $rst45_pict_tot;  ?></td> <!-- PICT -->
				<td><?php $rst45_c_out=$sc_c_out; echo (abs($sc_c_out));  ?></td>
				
				
				<td><?php echo "";  ?></td>
				<td><?php  $rst45_d_booked_sum=$rst45_cct_tot+$rst45_nct_tot+$rst45_icd_tot+$rst45_nofcy_tot; echo $rst45_d_booked_sum; ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php $rst45_total_equip = $sc_ab_tot+$sc_c_tot+$rst45_pict_tot ; echo $sc_ab_tot+$sc_c_tot+$rst45_pict_tot ;  ?></td>
				<td><?php $rst45_total_booked = $sc_ab_booked+$sc_c_booked; echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php $rst45_stand_by=$sc_ab_standby+$sc_c_standby; echo $sc_ab_standby+$sc_c_standby;  ?></td>
                <td><?php echo $rst45_pict_tot;  ?></td> <!-- PICT for totall operational -->
				<td><?php $rst45_out_of_order=$sc_ab_out+$sc_c_out;  echo $sc_ab_out+$sc_c_out;  ?></td>
				
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
			
			$flt16_pict_tot=0;
		
			
			/*$scQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='FLT 16 Ton') AS pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='FLT 16 Ton') AS pict_tot_non_op";
			$rowSCQry=mysqli_query($con_sparcsn4,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))*/
            $scQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='FLT 16 Ton') AS pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='FLT 16 Ton') AS ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='FLT 16 Ton') AS c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='FLT 16 Ton') AS pict_tot_non_op";
			$rowSCQry=mysqli_query($con_cchaportdb,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))


			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_flt16_ab=$jr_tot_flt+$ab_tot_flt+$d_reefer_tot_flt+$y7_tot_flt+$scy_tot_flt;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_flt16_ab+$rtnSCQuery->ab_tot_non_op);
                
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_flt16_c=$y_1_2_mn_tot_flt+$y_3_tot_flt+$y_5_tot_flt+$y_6_tot_flt+$y8b_tot_flt+$y8_tot_flt+$y9_tot_flt+$y11_tot_flt+$ncy_tot_flt;
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
				
				$flt7_ab_total=0;
				$flt7_ab_booked=0;
				$flt7_ab_standby=0;
				$flt7_ab_out=0;

				$flt7_c_tot=0;
				$flt7_c_booked=0;
				$flt7_c_standby=0;
				$flt7_c_out=0;
				
				$flt16_pict_tot=$rtnSCQuery->pict_tot;
				

				$flt7_d_tot=0;
				$flt7_d_booked=0;
				$flt7_d_standby=0;
				
				
				$flt7_out_order_zone_d=0;
				$flt7_total_equip=0;
				$flt7_total_booked=0;
				$flt7_stand_by=0;
				$flt7_out_of_order=0;
			?>
			<tr align="center">			
				<td>FLT 16 TON</td>
				<td><?php $flt7_ab_total=$sc_ab_tot; echo $sc_ab_tot;  ?></td>
				<td><?php $flt7_ab_booked=$sc_ab_booked=$jr_tot_flt+$ab_tot_flt+$d_reefer_tot_flt+$y7_tot_flt+$scy_tot_flt;  echo $sc_ab_booked;  ?></td>
                <!--td><?php $flt7_ab_booked_sum=$jr_tot_flt+$ab_tot_flt+$d_reefer_tot_flt+$y7_tot_flt+$scy_tot_flt; echo $flt7_ab_booked_sum;?></td-->
				<td><?php $flt7_ab_standby=$sc_ab_standby; echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php $flt7_ab_out=$sc_ab_out; echo (abs($sc_ab_out));  ?></td>
				
				<td><?php $flt7_c_tot=$sc_c_tot; echo $sc_c_tot;  ?></td>
				<td><?php $flt7_c_booked=$sc_c_booked=$y_1_2_mn_tot_flt+$y_3_tot_flt+$y_5_tot_flt+$y_6_tot_flt+$y8b_tot_flt+$y8_tot_flt+$y9_tot_flt+$y11_tot_flt+$ncy_tot_flt; echo $sc_c_booked;  ?></td>
                <!--td><?php $flt7_c_booked_sum=$y_1_2_mn_tot_flt+$y_3_tot_flt+$y_5_tot_flt+$y_6_tot_flt+$y8b_tot_flt+$y8_tot_flt+$y9_tot_flt+$y11_tot_flt+$ncy_tot_flt; echo $flt7_c_booked_sum; ?></td-->
				<td><?php $flt7_c_standby=$sc_c_standby; echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $flt16_pict_tot;  ?></td> <!-- PICT -->
				<td><?php $flt7_c_out=$sc_c_out; echo(abs ($sc_c_out));  ?></td>
				
				
				<td><?php echo "";  ?></td>
				<td><?php  $flt_d_booked_sum=$flt16_cct_tot+$flt16_nct_tot+$flt16_icd_tot+$flt16_nofcy_tot;echo $flt_d_booked_sum; ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php $flt7_total_equip=$sc_ab_tot+$sc_c_tot+$flt16_pict_tot ; echo $sc_ab_tot+$sc_c_tot+$flt16_pict_tot ;  ?></td>
				<td><?php $flt7_total_booked=$sc_ab_booked+$sc_c_booked;  echo $sc_ab_booked+$sc_c_booked;  ?></td>
				<td><?php $flt7_stand_by=$sc_ab_standby+$sc_c_standby; echo $sc_ab_standby+$sc_c_standby;  ?></td>
                <td><?php echo $flt16_pict_tot;  ?></td> <!-- PICT for totall operational -->
				<td><?php $flt7_out_of_order=$sc_ab_out+$sc_c_out; echo $sc_ab_out+$sc_c_out;  ?></td>
				
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
			
			$rst7_pict_tot=0;
			
			
			$sc_d_tot=0;
			$sc_d_booked=0;
			$sc_d_standby=0;
			$sc_d_out=0;
			
			$tot_equip_rst7_d=$tot_rst7_booked;
		
			/*$scQuery="SELECT
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  c_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RST 7 Ton') AS  d_tot,
					(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST 7 Ton') AS  pict_tot,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  
					c_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='D' AND equipment='RST 7 Ton') AS  
					d_tot_non_op,
					(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST 7 Ton') AS  
					pict_tot_non_op
					";
			$rowSCQry=mysqli_query($con_sparcsn4,$scQuery);
			while($rtnSCQuery=mysqli_fetch_object($rowSCQry))*/

            $scQuery="SELECT
            (SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot,
            (SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  c_tot,
            (SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RST 7 Ton') AS  d_tot,
            (SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST 7 Ton') AS  pict_tot,
            (SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='RST 7 Ton') AS  ab_tot_non_op,
            (SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='RST 7 Ton') AS  
            c_tot_non_op,
            (SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='D' AND equipment='RST 7 Ton') AS  
            d_tot_non_op,
            (SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='RST 7 Ton') AS  
            pict_tot_non_op
            ";
           $rowSCQry=mysqli_query($con_cchaportdb,$scQuery);
           while($rtnSCQuery=mysqli_fetch_object($rowSCQry))



			{
				$sc_ab_tot=$rtnSCQuery->ab_tot;
				$sc_ab_booked=$tot_equip_rst7_ab=$jr_tot_rst7+$ab_tot_rst7+$d_reefer_tot_rst7+$y7_tot_rst7+$scy_tot_rst7;
				$sc_ab_standby=$rtnSCQuery->ab_tot - ($tot_equip_rst7_ab+$rtnSCQuery->ab_tot_non_op);
                
				$sc_ab_out=$rtnSCQuery->ab_tot_non_op;
				
				$sc_c_tot=$rtnSCQuery->c_tot;
				$sc_c_booked=$tot_equip_rst7_c=$y_1_2_mn_tot_rst7+$y_3_tot_rst7+$y_5_tot_rst7+$y_6_tot_rst7+$y8b_tot_rst7+$y8_tot_rst7+$y9_tot_rst7+$y11_tot_rst7+$ncy_tot_rst7;
				$sc_c_standby=$rtnSCQuery->c_tot - ($tot_equip_rst7_c+$rtnSCQuery->c_tot_non_op);
				$sc_c_out=$rtnSCQuery->c_tot_non_op;
				
				
				$sc_d_tot=$rtnSCQuery->d_tot;
				$sc_d_booked=$tot_equip_rst7_d=$rst7_cct_tot+$rst7_nct_tot+$rst7_icd_tot+$rst7_nofcy_tot;
				$sc_d_standby=$rtnSCQuery->d_tot - ($tot_equip_rst7_d+$rtnSCQuery->d_tot_non_op);
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
				$rst7_ab_total=0;
				$rst7_ab_booked=0;
				$rst7_ab_standby=0;
				$rst7_ab_out=0;

				$rst7_c_tot=0;
				$rst7_c_booked=0;
				$rst7_c_standby=0;
				$rst7_c_out=0;
				
				$rst7_pict_tot=$rtnSCQuery->pict_tot;
				
				$rst7_d_tot=0;
				$rst7_d_booked=0;
				$rst7_d_standby=0;				
				$rst7_out_order_zone_d=0;
				
				$rst7_total_equip=0;
				$rst7_total_booked=0;
				$rst7_stand_by=0;
				$rst7_out_of_order=0;
                
            ?>
			<tr align="center">			
				<td>RST 7 TON</td>
				<td><?php $rst7_ab_total=$sc_ab_tot; echo $sc_ab_tot;  ?></td>
				<td><?php $rst7_ab_booked=$sc_ab_booked=$jr_tot_rst7+$ab_tot_rst7+$d_reefer_tot_rst7+$y7_tot_rst7+$scy_tot_rst7; echo $sc_ab_booked;  ?></td>
                <!--td><?php $rst7_ab_booked_sum=$jr_tot_rst7+$ab_tot_rst7+$d_reefer_tot_rst7+$y7_tot_rst7+$scy_tot_rst7; echo $rst7_ab_booked_sum; ?></td-->
				<td><?php $rst7_ab_standby=$sc_ab_standby; echo $sc_ab_standby;  ?></td> <!-- STAND BY -->
				<td><?php $rst7_ab_out=$sc_ab_out; echo (abs($sc_ab_out));  ?></td>
				
				<td><?php $rst7_c_tot=$sc_c_tot; echo $sc_c_tot;  ?></td>
				<td><?php $rst7_c_booked=$sc_c_booked=$y_1_2_mn_tot_rst7+$y_3_tot_rst7+$y_5_tot_rst7+$y_6_tot_rst7+$y8b_tot_rst7+$y8_tot_rst7+$y9_tot_rst7+$y11_tot_rst7+$ncy_tot_rst7; echo $sc_c_booked; ?></td>
                <!--td><?php $rst7_c_booked_sum= $y_1_2_mn_tot_rst7+$y_3_tot_rst7+$y_5_tot_rst7+$y_6_tot_rst7+$y8b_tot_rst7+$y8_tot_rst7+$y9_tot_rst7+$y11_tot_rst7+$ncy_tot_rst7; echo $rst7_c_booked_sum; ?></td-->
				<td><?php $rst7_c_standby=$sc_c_standby; echo $sc_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $rst7_pict_tot;  ?></td> <!-- PICT -->
				<td><?php $rst7_c_out=$sc_c_out; echo(abs( $sc_c_out));  ?></td>
				
				
				<td><?php $rst7_d_tot= $sc_d_tot; echo $sc_d_tot;  ?></td>
				<td><?php $rst7_d_booked=$sc_d_booked=$rst7_cct_tot+$rst7_nct_tot+$rst7_icd_tot+$rst7_nofcy_tot;  echo $sc_d_booked;  ?></td>
                <!--td><?php $rst7_d_booked_sum=$rst7_cct_tot+$rst7_nct_tot+$rst7_icd_tot+$rst7_nofcy_tot; echo $rst7_d_booked_sum; ?></td-->
				<td><?php $rst7_d_standby=$sc_d_standby; echo $sc_d_standby;  ?></td> <!-- STAND BY -->
				<td><?php $rst7_out_order_zone_d= $sc_d_out; echo(abs
                ($sc_d_out));  ?></td>
				
				<td><?php $rst7_total_equip = $sc_ab_tot+$sc_c_tot+$sc_d_tot+$rst7_pict_tot; echo $sc_ab_tot+$sc_c_tot+$sc_d_tot+$rst7_pict_tot;  ?></td>
				<td>
					<?php 
						$rst7_total_booked=$sc_ab_booked+$sc_c_booked+$sc_d_booked;  
						echo $sc_ab_booked+$sc_c_booked+$sc_d_booked;  
					?>
				</td>
				<td>
					<?php 
						$rst7_stand_by=$sc_ab_standby+$sc_c_standby+$sc_d_standby;  
						echo $sc_ab_standby+$sc_c_standby+$sc_d_standby;  ?>
				</td>
                <td><?php echo $rst7_pict_tot;  ?></td> <!-- PICT for totall operational-->
				<td><?php $rst7_out_of_order=$sc_ab_out+$sc_c_out+$sc_d_out; echo $sc_ab_out+$sc_c_out+$sc_d_out;  ?></td>
				
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
			
			$cm_pict_tot=0;
			
			/* $cmQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='CM') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM ctmsmis.equip_assign_detail WHERE workshop_zone='PICT' AND equipment='CM') AS  
			pict_tot_non_op";
			$rowCMQry=mysqli_query($con_sparcsn4,$cmQuery);
			 while($rtnCMQuery=mysqli_fetch_object($rowCMQry))*/
            $cmQuery="SELECT
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  c_tot,
			(SELECT IFNULL(equip_num,0) AS equip_num FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='CM') AS  pict_tot,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='AB' AND equipment='CM') AS  ab_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='C' AND equipment='CM') AS  
			c_tot_non_op,
			(SELECT IFNULL(non_operational,0) AS non_operational FROM equip_assign_detail WHERE workshop_zone='PICT' AND equipment='CM') AS  
			pict_tot_non_op";
			$rowCMQry=mysqli_query($con_cchaportdb,$cmQuery);
			while($rtnCMQuery=mysqli_fetch_object($rowCMQry))

			{
				$cm_ab_tot=$rtnCMQuery->ab_tot;
				$cm_ab_booked=$jr_tot_cm+$ab_tot_cm+$d_reefer_tot_cm+$y7_tot_cm+ $scy_tot_cm;
				$cm_ab_standby=$rtnCMQuery->ab_tot - ($cm_ab_booked+$rtnCMQuery->ab_tot_non_op);
				$cm_ab_out=$rtnCMQuery->ab_tot_non_op;
				
				$cm_c_tot=$rtnCMQuery->c_tot;
				$cm_c_booked=$tot_equip_cm_c=$y_1_2_mn_tot_cm+$y_3_tot_cm+$y_5_tot_cm+$y_6_tot_cm+$y8b_tot_cm+ $y8_tot_cm+$y9_tot_cm+$y11_tot_cm+$ncy_tot_cm;
				$cm_c_standby=$rtnCMQuery->c_tot - ($tot_equip_cm_c+$rtnCMQuery->c_tot_non_op);
				$cm_c_out=$rtnCMQuery->c_tot_non_op;
				
				$cm_pict_tot=$rtnCMQuery->pict_tot;
				
				
				if($cm_ab_standby<0)
				{
					$cm_ab_standby=0;
				}
				if($cm_c_standby<0)
				{
					$cm_c_standby=0;
				}
	
				
				//$cm_out_order_zone_d=0;
				$cm_total_equip=0;
				$cm_total_booked=0;
				$cm_stand_by=0;
				$cm_out_of_order=0;
			?>
			<tr align="center">			
				<td>CM</td>
				<td><?php echo $cm_ab_tot;?></td>
				<td><?php  $cm_ab_booked=$jr_tot_cm+$ab_tot_cm+$d_reefer_tot_cm+$y7_tot_cm+ $scy_tot_cm; echo $cm_ab_booked; ?></td>
                <!--td><?php  $cm_ab_booked_sum=$jr_tot_cm+$ab_tot_cm+$d_reefer_tot_cm+$y7_tot_cm+ $scy_tot_cm; echo $cm_ab_booked_sum;  ?></td-->
				<td><?php echo $cm_ab_standby; ?></td> <!-- STAND BY -->
				<td><?php echo $cm_ab_out;?></td>
				
				<td><?php echo $cm_c_tot;  ?></td>                                     
				<td><?php  $cm_c_booked=$y_1_2_mn_tot_cm+$y_3_tot_cm+$y_5_tot_cm+$y_6_tot_cm+$y8b_tot_cm+ $y8_tot_cm+$y9_tot_cm+$y11_tot_cm+$ncy_tot_cm;echo $cm_c_booked;  ?></td>
                <!--td><?php  $cm_c_booked_sum=$y_1_2_mn_tot_cm+$y_3_tot_cm+$y_5_tot_cm+$y_6_tot_cm+$y8b_tot_cm+ $y8_tot_cm+$y9_tot_cm+$y11_tot_cm+$ncy_tot_cm; echo $cm_c_booked_sum; ?></td-->
				<td><?php echo $cm_c_standby;  ?></td> <!-- STAND BY -->
				<td><?php echo $cm_pict_tot;  ?></td> <!-- PICT -->
				<td><?php echo $cm_c_out;  ?></td>
				
				
				<td><?php echo "";  ?></td>
				<td><?php $cm_d_booked_sum=$cm_cct_tot+$cm_nct_tot+$cm_icd_tot+$cm_nofcy_tot; echo $cm_d_booked_sum; ?></td>
				<td><?php echo "";  ?></td> <!-- STAND BY -->
				<td><?php echo "";  ?></td>
				
				<td><?php $cm_total_equip=$cm_ab_tot+$cm_c_tot+$cm_pict_tot ;  echo $cm_ab_tot+$cm_c_tot+$cm_pict_tot ;  ?></td>
				<td><?php $cm_total_booked=$cm_ab_booked+$cm_c_booked;  echo $cm_ab_booked+$cm_c_booked;  ?></td>
				<td><?php $cm_stand_by=$cm_ab_standby+$cm_c_standby;  echo $cm_ab_standby+$cm_c_standby;  ?></td>
                <td><?php echo $cm_pict_tot;  ?></td> <!-- PICT for totall operational -->
				<td><?php $cm_out_of_order=$cm_ab_out+$cm_c_out;  echo $cm_ab_out+$cm_c_out;  ?></td>
				
			</tr>
			<?php } ?>
			
			<tr align="center">		
				<th>Total</td>			
				<th><?php echo $qgc_ab_tot + $rtg_ab_tot + $mhc_ab_tot + $rmg_ab_tot + $sc_ab_total_s + $rst45_ab_total + $flt7_ab_total + $rst7_ab_total + $cm_ab_tot;  ?></th>
				<th><?php echo $rtg_ab_booked + $sc_ab_booked_s + $rst45_ab_booked + $flt7_ab_booked + $rst7_ab_booked + $cm_ab_booked;  ?></th>
                <!--th><?php echo $rtg_ab_booked + $sc_ab_booked_sum + $rst45_ab_booked_sum + $flt7_ab_booked_sum + $rst7_ab_booked_sum + $cm_ab_booked_sum; echo "m"; ?></th-->
				<th><?php echo $rtg_ab_standby + $sc_ab_standby_s + $rst45_ab_standby + $flt7_ab_standby + $rst7_ab_standby + $cm_ab_standby;  ?></th>
				<th><?php echo $qgc_ab_out + $rtg_ab_out + $mhc_ab_out + $rmg_ab_out+$sc_ab_out_s+$rst45_ab_out + $flt7_ab_out + $rst7_ab_out + $cm_ab_out;  ?></th>
				
				<th><?php echo $qgc_c_tot + $rtg_c_tot + $mhc_c_tot + $rmg_c_tot+$sc_c_tot_s + $rst45_c_tot + $flt7_c_tot + $rst7_c_tot + $cm_c_tot;  ?></th>
				<th><?php echo $rtg_c_booked + $sc_c_booked_s + $rst45_c_booked + $flt7_c_booked+$rst7_c_booked + $cm_c_booked;?></th>
				

				<th><?php echo $rtg_c_standby + $sc_c_standby_s + $rst45_c_standby + $flt7_c_standby + $rst7_c_standby + $cm_c_standby;  ?></th>
				
				<th> <!-- PICT -->
					<?php 
						echo $qgc_pict_tot+$rtg_pict_tot+$mhc_pict_tot+$rmg_pict_tot+$sc_pict_tot+$rst45_pict_tot+$flt16_pict_tot+$rst7_pict_tot+$cm_pict_tot; 
					?>
				</th> 
				
				<th><?php echo $qgc_c_out + $rtg_c_out + $mhc_c_out +$rmg_c_out+$sc_c_out_s + $rst45_c_out + $flt7_c_out + $rst7_c_out + $cm_c_out;  ?></th>
				
				
				
				<th><?php echo $qgc_d_tot + $rtg_d_tot + $mhc_d_tot +$rmg_d_tot + $sc_d_tot_s + $rst7_d_tot; ?></th>
				<th><?php echo $qgc_d_booked + $rtg_d_booked + $mhc_d_booked + $rmg_d_booked + $sc_d_booked_s+ $rst7_d_booked;  ?></th>
                <!--th><?php echo $qgc_d_booked + $rtg_d_booked + $mhc_d_booked + $rmg_d_booked + $sc_d_booked_sum+$rst45_d_booked_sum+$flt_d_booked_sum+ $rst7_d_booked_sum+$cm_d_booked_sum;  ?></th-->
				<th><?php echo $qgc_d_standby + $rtg_d_standby+$mhc_d_standby + $rmg_d_standby + $sc_d_standby_s + $rst7_d_standby;  ?></th>
				<th><?php echo $qgc_out_order_zone_d +(abs ($rtg_out_order_zone_d)) + $mhc_out_order_zone_d + $rmg_out_order_zone_d + $sc_out_order_zone_d + $rst7_out_order_zone_d;?></th> 
                
				<th>
					<?php 
						echo $qgc_total_equip + $rtg_total_equip + $mhc_total_equip + $rmg_total_equip + $sc_total_equip + $rst45_total_equip + $flt7_total_equip + $rst7_total_equip + $cm_total_equip;  
						
					?>
				</th>
				<th><?php echo $qgc_d_booked + $rtg_total_booked + $mhc_total_booked + $rmg_total_booked + $sc_total_booked + $rst45_total_booked + $flt7_total_booked + $rst7_total_booked + $cm_total_booked; ?></th>
				<th><?php echo $qgc_stand_by + $rtg_stand_by + $mhc_stand_by+$rmg_stand_by + $sc_stand_by + $rst45_stand_by + $flt7_stand_by + $rst7_stand_by + $cm_stand_by;  ?></th>
                <th> <!-- PICT for total operational-->
					<?php 
						echo $qgc_pict_tot+$rtg_pict_tot+$mhc_pict_tot+$rmg_pict_tot+$sc_pict_tot+$rst45_pict_tot+$flt16_pict_tot+$rst7_pict_tot+$cm_pict_tot; 
					?>
				</th> 
				<th><?php echo  $qgc_out_of_order + $rtg_out_of_order + $mhc_out_of_order + $rmg_out_of_order + $sc_out_of_order + $rst45_out_of_order + $flt7_out_of_order + $rst7_out_of_order + $cm_out_of_order;  ?></th>
			</tr>

			<!--tr align="center">			
				<td><?php //echo $rtnTotQuery->equipment;  ?></td>
				<td><?php //echo $rtnTotQuery->ab_tot;  ?></td>
				<td><?php //echo $rtnTotQuery->ab_tot_booked;  ?></td>
				<td><?php //echo $rtnTotQuery->ab_tot_standby;  ?></td>
				<td><?php //echo $rtnTotQuery->ab_tot_non_op;  ?></td>
				<td><?php //echo $rtnTotQuery->c_tot;  ?></td>
				<td><?php //echo $rtnTotQuery->c_tot_booked;  ?></td>
				<td><?php //echo $rtnTotQuery->c_tot_standby;  ?></td>
				<td><?php //echo $rtnTotQuery->c_tot_non_op;  ?></td>
				<td><?php //echo $rtnTotQuery->tot_equip;  ?></td>
				<td><?php //echo $rtnTotQuery->tot_op_booked;  ?></td>
				<td><?php //echo $rtnTotQuery->tot_op_standby;  ?></td>
				<td><?php //echo $rtnTotQuery->tot_non_op;  ?></td>
				
			</tr-->
			<?php //} ?>
			
		</table>

	</div>


		</div>
			<?php
          //  mysqli_close($con_ctmsmis); 
            mysqli_close($con_sparcsn4); 
            oci_close($con_sparcsn4_oracle);
            ?>
					<?php //include('footer.php'); ?>

	</body>
</html>

