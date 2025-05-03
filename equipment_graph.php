<html>
	<head>
		 <meta http-equiv="refresh" content="20">
		  <script src="canvasjs.min.js"></script>
		 <style>
			.row {
			  width: 100%;
			  margin: 0 auto;
			  padding-left:25px;
			  padding-right:25px;
			}
			.block {			  
			  float: left;
			  border: 3px solid #ab88e0;
			  border-radius: 15px;
			  padding:3px;
			  margin:5px;
			  font-family: "Calibri";			  
			}
			
			/* Smartphones (portrait and landscape) ----------- */
			@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
				/*[class*="block"] {
					width: 50%;
				}*/
			}

			/* Smartphones (landscape) ----------- */
			@media only screen and (min-width : 321px) {
				
			}

			/* Smartphones (portrait) ----------- */
			@media only screen and (max-width : 320px) {
				
			}

			/* iPads (portrait and landscape) ----------- */
			@media only screen and (min-device-width : 768px) 
			and (max-device-width : 1024px) {
				
			}

			/* iPads (landscape) ----------- */
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
				
			}

			/* iPads (portrait) ----------- */
			@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) 
			and (orientation : portrait) {
				
			}

			/* Desktops and laptops ----------- */
			@media only screen and (min-width : 1224px) {
				
			}

			/* Large screens ----------- */
			@media only screen and (min-width : 1824px) {
				
			}

			/* iPhone 4 ----------- */
			@media only screen and (-webkit-min-device-pixel-ratio : 1.5),only screen and (min-device-pixel-ratio : 1.5) {
				
			}
		 </style>
	</head>
	<body>
		<div>
			<div align="center">
				<?php include("header.php")?>
			</div>	
			<?php include("dbConection.php");?>
			<div align="right" style="padding-right:25px;">
				<?php echo date("d/m/Y h:i:s")?>
			</div>	
			<div align="center">
				<div>					
					<div>
						<?php
							include("mis_equipment_graph_qgc.php");
						?>
					</div>
					<div>
					<?php
						include("mis_equipment_graph_rtg.php");
					?>
					</div>
				</div>
			</div>			
		</div>
		<!--div style="display:inline-block;">
			<div><font size="6"><b>Total Vessel:<?php echo $i;?></b></font></div>
		</div-->
		<?php mysql_close($con_sparcsn4); ?>
		<?php include('footer.php'); ?>
	</body>
</html>
