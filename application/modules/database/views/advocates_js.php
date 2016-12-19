
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
	 function printadvocate_table(data){
		 var page_title = $(".adv_title").text();
		 page_title = "<div><h1 style='text-align:center;'>"+page_title+"</h1>";
		 var restorepage = document.body.innerHTML;
		
		 var printcontent = document.getElementById(data).innerHTML; 
		 printcontent += '' + '<style type="text/css">' + '#leave_employee_length,.DTTT_container { display:none;} .dataTables_info{display:none;  }#leave_employee_filter{display:none;  } .pagination{ display:none;   } .panel_status{ }</style>'; 
		 document.body.innerHTML = page_title+printcontent; 
		 window.print(); document.body.innerHTML = restorepage; 
									   }
	
   $('#advocate_post_type').change(function(){
	  
		if($(this).val() == 'gp') {
			
			$("#appintment_date").show();
			$("#appintment_date_first").hide();
		}
		else if($(this).val() == 'agp'){
			$("#appintment_date").show();
			$("#lokabhiyojak_power").show();
			$("#appintment_date_first").hide();
		}
		else if($(this).val() == 'pra'){
			$("#private_lawyer").show();
			
		}
		else
		{
			$("#appintment_date").hide();
			$("#appintment_date_first").show();
			$("#private_lawyer").hide();
		}
		
   });
   $(document).ready(function () {
	 /*notifyMe() ;*/
	 		
			$("#district_id").change(function() {
			
				var district_id = $(this).val() ;
				var adv_type ='<?php echo $this->uri->segment(3) ?>';
			
				 var HTTP_PATH='<?php echo base_url(); ?>';
			
				   $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/getTahsil_list",
					datatype: "json",
					async: false,
					data: {district_id: district_id},
					success: function(data) {
							  $(".tahsil_list").hide();
						      $("#tahsil_div").html(data);
						      $("#edit_link").attr("href", "new/href/value");
						      /*$("a #edit_link").prop("href", "http://www.jakcms.com")*/
			

					}
            	});
				
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
	   
		   $(".once_registration_number").change(function() {
			   		var registration_number = $(this).val() ;
			   
			   		$.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/get_registration_number",
					datatype: "json",
					async: false,
					data: {registration_number: registration_number},
					success: function(data) {
						console.log(data);
						if(data > 0 ){
							$("#error-once_registration").text("बार कांउसिल पंजीयन क्रमांक हमारे रिकार्ड में पहले से मौजूद है");
							alert("बार कांउसिल पंजीयन क्रमांक हमारे रिकार्ड में पहले से मौजूद है");
							return false;
						}	
						

					}
            	});
			});	
	   
	   		$(".section_no").change(function() {
			   		var section_no = $(this).val() ;
			   
			   		$.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/get_section_number",
					datatype: "json",
					async: false,
					data: {section_no: section_no},
					success: function(data) {
						console.log(data);
						if(data > 0 ){
							$("#error-section_number").text("पंजी क्रमांक हमारे रिकार्ड में पहले से मौजूद है");
							alert("पंजी क्रमांक हमारे रिकार्ड में पहले से मौजूद है");
							return false;
						}	
						

					}
            	});
			});	
	   
		});	
		
	   function get_advocate(tahsil_id )
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
	$("#attach_fitness_cert_status").change(function() {
		
			var fitness = $(this).val() ;
		
			if(fitness == 'y'){
				$(".attach_fitness_cert_status").show();
			}else{
				$(".attach_fitness_cert_status").hide();
			}
		
	});
	$("#is_character_cert_status").change(function() {
			var character_status =  $(this).val() ;
			if(character_status == 'y'){
				$(".is_character_cert_status").show();
			}else{
				$(".is_character_cert_status").hide();
			}
		
	});
	
	$("#cast_category_cert_status").change(function() {
			var character_status =  $(this).val() ;
			if(character_status == 'y'){
				$(".uploda_cc").show();
			}else{
				$(".uploda_cc").hide();
			}
		
	});
	
	$("#cast_category").change(function() {
			var cast_category_status = $(this).val() ;
			if(cast_category_status == 'obc' ||cast_category_status == 'sc' ||cast_category_status == 'st' ){
				$(".cast_category_cert_status").show();
			}else{
				$(".cast_category_cert_status").hide();
			}
		
	});
	$("#non_opjection_cert_status").change(function() {
			var non_opjection_cert_status = $(this).val() ;
			if(non_opjection_cert_status == 'y'){
				$(".non_opjection_cert_status").show();
			}else{
				$(".non_opjection_cert_status").hide();
			}
		
	});
	$("#dhara_twintee_status").change(function() {
			var dhara_twintee_status = $(this).val() ;
			if(dhara_twintee_status == 'y'){
				$(".dhara_twintee_status").show();
			}else{
				$(".dhara_twintee_status").hide();
			}
		
	});
	
	  
  $(document).ready( function () {
	 /*$("#posting_date").change( function () {
        $("#post_renew_date").val('');
        
        
    });*/
    <?php  if($this->uri->segment(2) != 'edit_advocate'){ ?>
    	$(".cast_category_cert_status").hide();
    	$(".attach_fitness_cert_status").hide();
    	$(".uploda_cc").hide();
	<?php } ?>
    	
    	$("#provision_pirod").change( function () {
        var str = $("#posting_date").val();
        var appoint_date_array = str.split("-");
        var appoint_year = parseInt(appoint_date_array[2]);
		var renwal_yr_number=parseInt($(this).val());
		var myDate = new Date();
		var current_year = parseInt(myDate.getFullYear());		
		var next_renewal_year=(appoint_year + renwal_yr_number);
				
		$next_appoint_date = appoint_date_array[0]+'-'+appoint_date_array[1]+'-'+next_renewal_year;
		$("#post_renew_date").val($next_appoint_date);
        
    });
	   
});
	
	
function addrow_budget(){
	
	var counter = 0;
		counter = $('#budget_again tr').length - 1;
 		
		var newRow = $("<tr style='border:#666666 1px solid'>");
		var cols = "";
		var HTTP_PATH='<?php echo base_url(); ?>';
		
		/*$.get(HTTP_PATH+"advocates/getstate_list",function(data){
			
    	}); */
		/*$('#ctr_div').append($("#ctr_row").html());*/
		$.get(HTTP_PATH+"advocates/getstate_list",function(data){
			/*alert(data);*/
			$('.stat_div').html(data);
    	}); 
		$.get(HTTP_PATH+"advocates/getdistict_list",function(data){
			/*alert(data);*/
			$('.distict_div').html(data);
    	}); 
		cols += '<td ><div class="stat_div"></div></td>';
		cols += '<td ><div class="distict_div"></div></td>';	
		cols += '<td ><input type="file" name="charater_certificate_file[]" class="form-control" ></td>';
		cols += '<td ><input type="button" class="ibtnDel"  value="Delete"></td>';
		
		newRow.append(cols);
		
		if (counter == 350) $('#addrowoutof').attr('disabled', true).prop('value', "You've reached the limit");
		$("table.budget_again").append(newRow);
		counter++;
		$('.total_row').val(counter);	

	 $("table.budget_again").on("click", ".ibtnDel", function (event) {
		 $(this).closest("tr").remove();
		 counter -= 1;
		 $('#addrowoutof').attr('disabled', false).prop('value', "Add Row");
		 $('.total_row').val(counter);
	 });
}
     function open_advocate_model(advocate_id){
				  $('#modal-advocate').modal('show');
			}
	document.addEventListener('DOMContentLoaded', function () {
  if (!Notification) {
    alert('Desktop notifications not available in your browser. Try Chromium.'); 
    return;
  }

  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

function notifyMe() {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
  else {
    var notification = new Notification('Notification title', {
      icon: 'http://cdn.sstatic.net/stackexchange/img/logos/so/so-icon.png',
      body: "जिनका नवीनीकरण ख़त्म हो गया है ",
    });

    notification.onclick = function () {
      window.location="<?php echo base_url() ?>advocate/list/1/smtr";      
    };

  }

}

 </script>
<div class="modal fade" id="modal-advocate" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_file1">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i> फ़ाइल देने वाले का नाम</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile"> फ़ाइल देने वाले का नाम</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div><div class="form-group">
                                        <label>Section Receive</label>
                                        <?php $section_exp = explode(',',getEmployeeSection()); ?>
                                        <select class="form-control" name="section_mark1">
                                            <?php foreach($section_exp as $exp){ ?>
                                                echo '<option value="<?php echo $exp ?>"><?php echo getSection($exp) ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
									<div class="form-group pull-right">
											<input type="checkbox" id="physical_file_receive" name="file_status[]" class="physical_file" value="p" >Physical File
										<input type="checkbox" id="electronic_file_receive" name="file_status[]" class="electronic_file" value="e" >E-File
                                </div>
                                    <div class="efile_div"></div>
                            </div>
                        </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm_receive()" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check blink"></i> Receive</button>
                </div>
            </div>
        </form>
    </div>
</div>