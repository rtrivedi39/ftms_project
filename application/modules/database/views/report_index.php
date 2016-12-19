<meta charset="UTF-8">
<div class="noprint">
	
<div style="float:right;margin-right: 10px;">
<a   href="<?php echo base_url();?>dashboard">
		<button class="btn  btn-primary">Dashboard</button>
	 </a>
	<?php if($this->uri->segment(3) == 1){?>
	<a   href="<?php echo base_url();?>advocate/advocate_report/2">
		<button class="btn  btn-primary">ए.जी.पी. की सूची</button>
	 </a>
	<?php } ?>
	<?php if($this->uri->segment(3) == 2){?>
	<a   href="<?php echo base_url();?>advocate/advocate_report/1">
		<button class="btn  btn-primary">जी.पी. की सूची</button>
	 </a>
	<?php } ?>   
	<a href="javascript:history.go(-1)">
		<button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
	</a>
	  <a style="curser:pointer"><button onclick="printContents('print_table')" class="btn btn-block btn-warning">Print</button></a>
</div>
<div> 

	
<div class="form-group noprint">
	<label><?php echo "जिला"; ?><span class="text-danger">*</span> :</label>
	<?php  $selected  = '' ;
	?>
	<?php echo  get_distic_ddl_list('scm_district_id', 'id="district_id"  class="form-control"', $selected); ?>
	<?php echo form_error('scm_district_id'); ?>
</div>
<div class="form-group noprint">
	<label><?php echo $this->lang->line('adv_tahsil_label'); ?><span class="text-danger">*</span> :</label>
	<?php  $selected  = '' ;
	?>
	<?php 
		echo get_tahsil_ddl_list('scm_tahsil_id',  'id="tahsil_id" class="form-control tahsil_list"  ',$selected ); ?>
	<div id="tahsil_div"></div>
	<?php echo form_error('scm_tahsil_id'); ?>
</div>
<!--<div class="form-group noprint">
	<label><?php //echo $this->lang->line('adv_taluka_label'); ?><span class="text-danger">*</span> :</label>
	<?php  //$selected  = '' ;?>
	 <?php 
		//echo  get_taluka_ddl_list('scm_taluka_id' , 'id="taluka_id" class="form-control taluka_list',$selected); ?>
	<div id="taluka_div"></div> -->

</div>
</div>

</div>
<div id="print_table" >
	<div align="center"><h2><?php echo @$title; ?></h2></div>
	<div align="center">
		<span id="district_span"></span>
		<span id="tahsil_span"></span>
		<span id="taluka_span"></span>
	</div>

<table id="advocate_table" class="table table-bordered table-striped" padding="10" style="border:1px solid #000">
	<thead>
	  <tr>
		<th>क्रमांक</th>
		<th>जिला</th>
		<th>तहसील</th>
		<th>नाम</th>
		<th> प्रथम<br>नियुक्ति दिनांक </th>
		<th> नवीनीकरण<br>दिनांक </th>
		<th> परिवीक्षा काल </th>
		<th> बार कांउसिल <br> पंजीयन क्रमांक </th>
		<th>जन्म तिथि</th>
		<th> मोबाईल  </th>
		<th> ईमेल </th>
		<th>पता </th>
		<th> पैनल की स्थिति </th>		     
	</tr>
	</thead>
	<tbody>
	  <?php $i=1; 
		foreach ($get_users as $key => $users) { ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td>
				<?php if(!empty($users['scm_district_id'])){ echo $users['district_name_hi'];}else { echo 'N/A'; }?>
			</td>
			<td>
			<?php if(!empty($users['scm_tahsil_id'])){ echo $users['tahsil_name_hi'];  }else { echo 'N/A'; }?>
			</td>
			<td><?php if($users['scm_name_hi']!=''){ echo $users['scm_name_hi']; }else{ echo $users['scm_name_hi']; }?>
			</td>
			
			<td><?php if(!empty($users['posting_date'])&& $users['posting_date']!='1970-01-01'&& $users['posting_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['posting_date']));}else{ echo 'N/A';} ?></td>
			<td><?php if(!empty($users['post_renew_date'])&& $users['post_renew_date']!='1970-01-01' && $users['post_renew_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['post_renew_date']));}else{ echo 'N/A';}?></td>
			<td><?php if($users['provision_pirod']){ echo $users['provision_pirod'];}else{ echo 'N/A';}?></td>
			
			
		
			<td><?php echo @$users['once_registration_number_council'] ?></td>
			<td><?php if( !empty($users['post_renew_date'])&& $users['scm_dob']!='1970-01-01'&& $users['scm_dob']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['scm_dob']));}else{ echo 'N/A';}?></td>
			<td><?php if(!empty($users['contact_no'])){  echo $users['contact_no']; }else { echo 'N/A';}?></td>
			<td><?php if(!empty($users['email_id'])){  echo $users['email_id']; }else { echo 'N/A';}?></td>
			<td><?php if(!empty($users['scm_address_hi'])){ echo $users['scm_address_hi']; }else { echo 'N/A';}?></td>
			<td>
                <?php
                $panel_dt =  get_panel_data($users['scm_id']) ;
                echo @$panel_dt['panel_status'] == 'Y' ? 'हाँ' : '';
                echo @$panel_dt['panel_status'] == 'N' ? 'नहीं' : '';
                echo '<br/>';
                echo $panel_dt['panel_discription'];
                echo '<br/>';
                echo @$panel_dt['panel_status'] == 'Y' ? date('d-m-Y',strtotime($panel_dt['panel_create_date'])) : '';
                echo @$panel_dt['panel_status'] == 'N' ? date('d-m-Y',strtotime($panel_dt['panel_close_date'])) : '';
                ?>
            </td>
			
		</tr>
	  <?php $i++; } ?>
	</tbody>
</table>
<div id="ajax_tbl"></div>
</div>
<style>
	table {
    width: 100%;	border: 1px solid black;
	}
	 table {
    border-collapse: collapse;
	}

	 table, th, td {
		border: 1px solid black;
	}
	@media print {
		.noprint{
			display:none;
		}
	}
</style>

<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
 
   $(document).ready(function () {
			$("#district_id").change(function() {
				var district_id = $(this).val() ;
				
			
				 var HTTP_PATH='<?php echo base_url(); ?>';
				 /*get tahsil list */
				   $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/getTahsil_list",
					datatype: "json",
					async: false,
					data: {district_id: district_id},
					success: function(data) {
						    					$(".tahsil_list").hide();
												$("#tahsil_div").html(data);
												get_advocate_from_dist_tahsil(district_id);
												dist_name = $("#district_id :selected").text();
												$("#district_span").html("<br/><b>जिला: </b>"+dist_name);
					

					}
            	});
				/* get taluka list */
				$.ajax({
				
					type: "POST",
					url: HTTP_PATH + "advocates/getaluka_list",
					datatype: "json",
					async: false,
					data: {district_id: district_id},
					success: function(data) {
							  $(".taluka_list").hide();
							  $("#taluka_div").html(data);
						

					}
            	});
			
			
			})	;
	   
		 
		});	
		
	  /* function get_advocate(tahsil_id )
	   {
				var tahsil_val = $("#tahsil_id option:selected").text() ;
				var HTTP_PATH='<?php echo base_url(); ?>';
			    $.ajax({
                type: "POST",
                url: HTTP_PATH + "advocates/get_advocate_single",
                datatype: "json",
                async: false,
                data: {tahsil_id: tahsil_id },
                success: function(data) {
				
                   $("#notery_adv").html(data);
				   $(".adv_tahsil").val(tahsil_val);
				   
                }
				 });
	   }
	*/
	function get_tahsil_details(tahsil_id,scttext){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
			
					 /*get tahsil list */
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/reports_advocate/advocate_report_bypost",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
							 var tehname = $("#tahsil_val option:selected").text();
							$("#tahsil_span").html("<br/><b>तहसील: </b>"+tehname);
							

						}
					});
	}
	function get_taluka_details(taluka_id){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var tahsil_id = $("#tahsil_val").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
					 /*get tahsil list */
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/reports_advocate/advocate_report_bypost",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
							var talukaname = $("#scm_taluka_id option:selected").text();
							$("#taluka_span").html("<br/><b>तालुका: </b>"+talukaname);							

						}
					});
	}
	 
 </script>
<script>
	function get_advocate_from_dist_tahsil(district_id ,tahsil_id = null ,taluka_id = null )
	{
		var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
		
		var HTTP_PATH='<?php echo base_url(); ?>';
				 /*get tahsil list */
				   $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/reports_advocate/advocate_report_bypost",
					datatype: "json",
					async: false,
					data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id},
					success: function(data) {
						 $("table").remove();
						 $("#ajax_tbl").html(data);
							
							
					}
            	});
	}
  /*function printContents(data){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(data).innerHTML;
        printcontent += '' +
        '<style type="text/css">' +
        'table th, table td {' +
		 'border:1px solid #000; ' +  
			'table {'+
			'border-collapse: collapse;'+
			 '}' +
		 '#inner_content table th,#inner_content table td {' +
        'border:1px solid #000;' +        
        '}' +
        '</style>';
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
     }*/ 
  
  function printContents(){
  
        window.print();
    }
	
	
</script>
