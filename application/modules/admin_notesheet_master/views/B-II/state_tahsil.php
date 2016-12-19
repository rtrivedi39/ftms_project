<?php if($is_genrate == true){ 
   
} else {
	?>
	<div>
	<div><?php
   echo  get_distic_ddl_list('district',' onchange="get_advocate_incity(this.value );"',''); ;
   ?>
   <div id="tahsil_div"></div></div><?php
} ?>
