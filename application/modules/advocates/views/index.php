<?php $userrole = checkUserrole(); ?>
<?php $upper_officer=array('1','3','4','5','6','7'); 
	$dis_type = $_GET['ac'] ;
	?>
	 <!-- Content Header (Page header) -->
<div id="advocates">
        <section class="content-header">
          <h1  class="adv_title">
		  <?php if(!empty($search_type) && $search_type == 'smtr') { echo $advocate_type_name.' जिनका नवीनीकरण आने वाला है' ; }else if(!empty($search_type) && $search_type == 'rdo') {
			  echo $advocate_type_name.' जिनका नवीनीकरण ख़त्म हो गया है' ; 
			  } else{
			  echo $title;
			  }
			  ?>
            <?php  ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <?php //pr($this->session->flashdata); 
               echo $this->session->flashdata('message');
			   ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  
                <div class="box-header">
                 <h3 class="box-title  no-print"><?php echo $title_tab;?></h3>
					<div class="tools pull-right  no-print" >
					
					<?php if($adv_type == 2){
						$tit = 'ए.जी.पी. की ';
						} if($adv_type == 1){
						$tit = 'जी.पी. की ';
						} ?>
					
						<?php if($adv_type == 1){ ?>
						<a   href="<?php echo base_url();?>advocate/list/2">
							<button class="btn btn-sm btn-primary">ए.जी.पी. की सूची</button>
						 </a>
						<?php } ?>
						<?php if($adv_type == 2){	?>
						<a   href="<?php echo base_url();?>advocate/list/1">
							<button class="btn btn-sm btn-primary">जी.पी. की सूची</button>
						 </a>
						<?php } ?>
						<?php if($adv_type == 4){
							?>
							<a   href="<?php echo base_url();?>advocate/list/4">
							<button class="btn btn-sm btn-primary">नोटरी की सूची</button>
							</a>
							<?php
							}?>
						
						<a  href="<?php echo base_url();?>advocate/repor_view/<?php echo $adv_type; ?>">
						  <button class="btn btn-sm btn-info"><?php echo $tit ;?> <?php echo 'जिलेवार स्वीकृत पद देखे'; ?> </button>
						</a>
						<?php if($adv_type == 1 || $adv_type == 2 ){	?>
						<a  href="<?php echo base_url();?>advocate/report_view_agp_gp">
						  <button class="btn btn-sm btn-info"><?php echo ' जी. पी./ए.जी.पी. की सम्पूर्ण जानकारी'; ?> </button>
						</a>
						<?php } ?>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>/rdo" <?php if(!empty($search_type) && $search_type == 'rdo') { echo 'disabled'; }?>  class="btn b btn-sm btn-info">
							<?php echo $advocate_type_name; ?> जिनका नवीनीकरण समाप्त हो गया है 
						</a>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>/smtr" <?php if(!empty($search_type) && $search_type == 'smtr') { echo 'disabled' ; }?> class="btn b btn-sm btn-info">
							<?php echo $advocate_type_name; ?> जिनका नवीनीकरण आने वाला है 
						</a>
						<button class="btn btn-sm btn-success" onclick="printadvocate_table('advocates')"> Print</button>
						<?php /*if($adv_type == 2){
						$tit = 'ए.जी.पी. की '; ?>						
						 <a href="<?php echo base_url();?>advocate/advocate_report/<?php echo $adv_type; ?>">
							<button class="btn  btn-info">ए.जी.पी. की रिपोर्ट</button> 
						 </a>
						 
						<?php } ?>
						<?php if($adv_type == 1){
							$tit = 'जी.पी. की ';	?>
						 <a href="<?php echo base_url();?>advocate/advocate_report/<?php echo $adv_type; ?>">
							<button class="btn  btn-info">जी.पी. की रिपोर्ट</button> 
						 </a>
						 
						<?php } */?>
								
						 <?php if(!in_array($userrole,$upper_officer)){ ?>
						<a  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>">
						  <button class="btn b btn-sm btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
						</a>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>?ac=report">
                            <button class="btn b btn-sm btn-info"><?php echo 'रिपोर्ट' ?> </button>
                        </a>
						<?php } ?>					
						
						
						<a href="javascript:history.go(-1)">
							<button class="btn btn-sm btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
						</a>
                  </div>
                
                  <!-- /.box-header -->
                   <div class="clearfix"></div>
					<br>
                    <div style="width:650px;" class="pull-right no-print">
						<?php //pre($this->session->user_data[]); 
                	 	if($userrole==1){
                    	?>
	                    	<div style="float:right;margin-right: 10px;" class="col-md-3" >
		                       <a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>?ac=del">
							  	<button class="btn b btn-sm btn-danger"><?php echo 'नष्ट करें' ?> </button>
								</a>
								<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>?ac=mod">
								  <button class="btn b btn-sm btn-info"><?php echo 'बदलाव करें' ?> </button>
								</a>
		                    </div>
							
	                    <?php } ?>
						<div style="float:left;margin-right: 10px;" class="col-md-3" >
	                       <?php  $selected  = ''; $lbl='जिले के आधार पर देखें ';?>						
							<?php echo  get_distic_ddl_list_with_lbl('scm_district_id', 'id="district_id"  class="form-control"', $selected,$lbl); ?>
						   
	                    </div>
						<div id="tahsil_div" class="col-md-3" style="margin-right: 10px;">
							<select class="form-control" onchange="get_tahsil_details(this.value,this.text)" id="tahsil_val" name="scm_tahsil_id">
								<option value=""> --तहसील का चयन करें-- </option><option value="2093">Alirajpur - अलीराजपुर</option>
							</select>
						</div>
					<!--	<div id="taluka_div" class="col-md-3"  style="margin-right: 10px;">
							<select class="form-control" id="scm_taluka_id" onchange="get_taluka_details(this.value)" name="scm_taluka_id">
								<option value=""> --तालुका का चयन करें-- </option><option value="369">Alirajpur - अलीराजपुर</option>
							</select>
						</div>-->

                    </div> 
					<br>
				   <div class="clearfix"></div>
				  <div id="ajax_tbl"></div>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>			
						 <th>क्रमांक</th>
						 <th>जिला</th>
						 <th>तहसील</th>
						 <th>नाम</th>
						 	<?php if($adv_type == 4){ ?>
						 <th>प्रथम नियुक्ति  <br>दिनांक</th>
							<?php } ?>
						 <th>नियुक्ति दिनांक  <br> <?php if($adv_type == 4){ echo  "(कब से)" ; } ?></th>
                         <th>नवीनीकरण दिनांक <br> <?php  if($adv_type == 4){ echo '(कब तक)'; } ?> </th>
						 <th>कार्यकाल </th>
						 
						 <?php if(!in_array($userrole,$upper_officer) && $dis_type != 'report'){ ?><th>Actions</th><?php } ?>
						
						 <th width="20%" ><?php if($adv_type == 4){ ?>नवीनीकरण की स्थिति <?php  }else {?>पैनल की स्थिति <?php } ?></th>
							
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
					
                        foreach ($get_users as $key => $users) { 
						if(!empty($users['advocate_file_cr_no']) && !empty($users['section_no_year'])) {
								 $file_id = get_fileid_from_sectionno($users['advocate_file_cr_no'],11 , $users['section_no_year']);
								
									$file_data = get_draft_from_file( $file_id);
								
								 	$file_data['final_draft_id'];
									 }
									  if(!empty($users['scm_name_hi']) && $users['post_renew_date'] != '0000-00-00' && ($adv_type == 1 || $adv_type == 2 )){
								
								
										$renew_year = date('Y',strtotime($users['post_renew_date']));
										$current_year = date('Y');
										$diff_year = $current_year - $renew_year;
										
										if($diff_year <= 0){
											$color = '';
											
										}
										else if($diff_year == 1){
											 $color = 'yellow';
											
										}
										else if($diff_year == 2){
											 $color = 'orange';
											
										}
										else if($diff_year >= 3){
											 $color = ' rgba(255, 0, 0, 0.51)';
										
										}
										
										
								  }
									 ?>
						 <tr style="background:<?php echo @$color; ?>">
							<td><?php echo $i ; ?></td>
							<td>
								<?php if(!empty($users['scm_district_id'])){ echo $users['district_name_hi']; }else { echo 'N/A'; }?><br/>
							</td>
						 	<td>
									<?php if(!empty($users['scm_tahsil_id'])){ echo  $users['tahsil_name_hi'];   }else { echo 'N/A'; }?><br/>
							</td>
							<td style="cursor:pointer" onclick="user_details_open(<?php echo $users['scm_id'] ; ?> , <?php echo $users['advocate_post_type'] ; ?>)"><?php 
								if(!empty($users['scm_name_en'])){
									$nm='';
								} else if($users['scm_name_hi']==$users['scm_name_en']){ $nm= ''; }else{ $nm= !empty($nm)?' ('.$users['scm_name_en'].')':'' ;}
								if($users['scm_name_hi']!=''){ 
									?>
								<a style="curser:pointer;"  >
									<?php echo $users['scm_name_hi'].$nm; ?></a>
								<?php 
								}else{  ?>
									<a onclick="open_advocate_model(<?php echo @$users['scm_id'] ?>)"  ><?php echo $users['scm_name_hi'] ?></a> <?php } ?> 
								<?php 
								if(!empty($users['contact_no'])){
								echo "<br><b> मोबाईल :</b>".@$users['contact_no'];
								}
								if(!empty($users['email_id'])){
								echo "<br><b> ईमेल :</b>".$users['email_id'];
								}
								?>								
							</td>						
							<?php if($adv_type == 4){ ?>
								<td> <?php if(!empty($users['first_appointment_date']) && $users['first_appointment_date']!='1970-01-01' && $users['first_appointment_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['first_appointment_date']));}else{ echo 'N/A';}?></td>
							<?php } ?>
						 <?php if($this->uri->segment(3) != 9){?>
                             <td><?php if(!empty($users['posting_date']) && $users['posting_date']!='1970-01-01' && $users['posting_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['posting_date']));}else{ echo 'N/A';}?></td>
                             <td><?php if(!empty($users['post_renew_date']) && $users['post_renew_date']!='1970-01-01' && $users['post_renew_date']!='0000-00-00' ){  echo date('d-m-Y',strtotime($users['post_renew_date']));}else { echo 'N/A';}?></td>
							
							  <?php } ?>
						<td><?php if(!empty($users['provision_pirod'])){ echo @$users['provision_pirod'] .'-वर्ष'; }else { echo "N/A"; } ?>
</td>

						<?php if(!in_array($userrole,$upper_officer) && $dis_type != 'report'){ ?>
                         <td>
							 <div class="no-print">
								<a href="<?php echo base_url('advocate');?>/edit_advocate/<?php echo $this->uri->segment(3);?>/<?php echo $users['scm_id'];?>" class="btn btn-block btn-twitter">Edit</a>
								
						<?php if($users['working_status'] == 0){ ?>
                            <a  onclick="update_working_status(<?php echo $users['scm_id'] ; ?> , <?php echo $users['advocate_post_type'] ; ?>)" class="btn btn-block btn-warning">पद मुक्त</a>
                        <?php  } ?>
								
                               <?php if($this->uri->segment(3) == 4){ ?>
								  <!--	<a href="<?php echo base_url();?>admin_notesheet_master/view_file_notesheet/147/12/<?php echo $users['advocate_file_cr_no'];?>?adv_id=<?php echo $users['scm_id'];?>" class="btn  btn-twitter">नवीनीकरण</a>-->
								  
								  <?php } ?>
							  </div>
							  <?php if($this->uri->segment(3) == 9 && !empty($file_id)){ ?>
								  
								  	<a href="<?php echo base_url();?>view_file/document_path/index/<?php echo @$file_id; ?>?temp=y&cj_id=<?php echo $users['scm_id'];?>" class="btn  btn-twitter">आदेश/नोटशीट जोड़े</a>
								  	
								  <?php } ?>
								  <?php if(!empty($file_data['final_draft_id'])){?>
									<a href="<?php echo base_url();?>efile/<?php echo @$file_id; ?>" class="btn btn-block btn-sm btn-warning">ई- फाइल जोड़े</a>
									<?php }?>
                            </td>
<?php } ?>
					
							  <td>
							  
							<?php if(!in_array($userrole,$upper_officer) && $dis_type != 'report'){ ?>
								  <button class="btn btn-twitter panel_open" data-scm_id ="<?php echo @$users['scm_id'] ? $users['scm_id'] : null ; ?>" data-scm_name_hi ="<?php echo @$users['scm_name_hi'] ? $users['scm_name_hi'] : null ; ?>" data-advocate_post_type ="<?php echo @$users['advocate_post_type'] ? $users['advocate_post_type'] : null ; ?>" data-advocate_post_type_nm ="<?php  echo @$users['advocate_post_type'] ? advocate_posttype_array($users['advocate_post_type']) : null ; ?>" data-scm_district_id ="<?php echo @$users['scm_district_id'] ? $users['scm_district_id'] : null ; ?>" data-scm_tahsil_id ="<?php echo @$users['scm_tahsil_id'] ? $users['scm_tahsil_id'] : null ; ?>" data-scm_taluka_id ="<?php echo $users['scm_taluka_id'] ? $users['scm_taluka_id'] : null ; ?>" data-posting_date ="<?php  echo @$users['posting_date'] ? date('d-m-Y',strtotime($users['posting_date'])) :null  ; ?>" data-post_renew_date ="<?php echo @$users['post_renew_date'] ? date('d-m-Y',strtotime($users['post_renew_date'])) : null ; ?>">
									  <?php if($adv_type == 1 || $adv_type == 2){ ?>  
										Panel 
									<?php } else if($adv_type == 4 ){ ?>
										Application
										<?php } ?>
										status</button>
							
							<?php } else{ ?>
							
										 <?php
                $panel_dt =  get_panel_data($users['scm_id']) ;
				if(!empty($panel_dt)){
				$date1 = '';
				if($panel_dt['panel_status'] == 'Y'){
				$date1 = date('d-m-Y',strtotime($panel_dt['panel_create_date']));
					}
				if($panel_dt['panel_status'] == 'N'){
				$date1 = date('d-m-Y',strtotime($panel_dt['panel_close_date']));
					}
				
				echo @$panel_dt['panel_status'] == 'Y' ? 'हाँ' : '';
                echo @$panel_dt['panel_status'] == 'N' ? '' : '';
                echo '<br/>';
                echo '<span title="'.$date1.'">'.$panel_dt['panel_discription'].'</span>';
                echo '<br/>';
               	}else{
					echo '-';
					}        
					        
                ?>
						
							<?php if(isset($_GET['ac']) && $_GET['ac']=='del'){ ?>
								<a href="<?php echo base_url().'advocate/delete_records_agp_gp/'.$users['scm_id'].'/'.$users['advocate_post_type'];?>" onclick="return confirm('क्रप्या  सुनिश्चित करें की आप इसे डिलीट करना चाहते है |')" class="btn btn-danger">नष्ठ करें</a>
								
								<?php } ?>
								<?php if(isset($_GET['ac']) && $_GET['ac']=='mod'){ ?>
								<br><a href="<?php echo base_url('advocate');?>/edit_advocate/<?php echo $this->uri->segment(3);?>/<?php echo $users['scm_id'];?>" class="btn  btn-twitter">Edit</a>
								
								<?php } ?>
								
							</td>
							<?php } ?>			
									
                        </tr>
                      <?php $i++; } ?>
                    </tbody>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
</div>
        <script type="text/javascript">
          function is_delete(){
            var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
            if(res===false){
              return false;
            }
          }
        </script>
        <style type="text/css">
        #leave_employee_filter{
          clear: both;
        }
        </style>
<?php $this->load->view('advocates_js')?>
    
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
 
   $(document).ready(function () {
			$("#district_id").change(function() {
			
				var district_id = $(this).val() ;					
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
																		get_advocate_from_dist_tahsil(district_id );
												
												
						

					}
            	});
				/*get taluka list*/
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
	function get_advocate_from_dist_tahsil(district_id ,tahsil_id = null ,taluka_id = null )
	{
		var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
		
		var HTTP_PATH='<?php echo base_url(); ?>';
				 /*get tahsil list*/
				   $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/get_ajax_data/",
					datatype: "json",
					async: false,
					data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id},
					success: function(data) {
						 $("table").remove();
						 $("#ajax_tbl").html(data);
							
							
					}
            	});
	}
	function get_tahsil_details(tahsil_id,scttext){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
			
					 /*get tahsil list*/
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/get_ajax_data/",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
							

						}
					});
	}
	function get_taluka_details(taluka_id){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var tahsil_id = $("#tahsil_val").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
					 /*get tahsil list*/
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/get_ajax_data/",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
												

						}
					});
	}
	  $(".panel_open").click(function(){
       var scm_id = $(this).data("scm_id");
       var scm_name_hi = $(this).data("scm_name_hi");
       var advocate_post_type = $(this).data("advocate_post_type");
       var advocate_post_type_nm = $(this).data("advocate_post_type_nm");
       var scm_district_id = $(this).data("scm_district_id");
       var scm_tahsil_id = $(this).data("scm_tahsil_id");
       var scm_taluka_id = $(this).data("scm_taluka_id");
       var posting_date = $(this).data("posting_date");
       var post_renew_date = $(this).data("post_renew_date");
	   
	    if(scm_tahsil_id == '' || scm_tahsil_id == '0'){
           $('#tehsil_div').hide();
       }
       if(scm_taluka_id == '' || scm_taluka_id == '0'){
           $('.taluka_div').hide();
       }
       if(scm_district_id == '' || scm_district_id == '0'){
           $('#district_div').hide();
       }

       $('#panel_advocate_id').val(scm_id);
       $('#panel_advocate_id_nm').val(scm_name_hi);
       $('#panel_post_id').val(advocate_post_type);
       $('#panel_post_id_nm').val(advocate_post_type_nm);
       $('#panel_district_id').val(scm_district_id);
       $('#panel_tehsil_id').val(scm_tahsil_id);
       $('#panel_taluka_id').val(scm_taluka_id);
       $('#join_date').val(posting_date);
       $('#renew_date').val(post_renew_date);
	   
	   var district_text = $(this).closest("tr").find('td:eq(1)').text();
       var tahsil_text = $(this).closest("tr").find('td:eq(2)').text();
		$('#panel_district_text').val(district_text.trim());
       $('#panel_tehsil_text').val(tahsil_text.trim());

		 if(advocate_post_type == 1 || advocate_post_type == 2){
		  	  $('.user_type').text("पैनल");
		  }else  if(advocate_post_type == 4){
		  	  $('.user_type').text("आवेदन");
		  }
	 $('#list_panel').attr('href','<?php echo base_url() ;?>advocates/manage_adv_panel_list/'+scm_id);
       $('#modal-panel_status').modal('show');
   });
</script>
<!--panel model-->
<div class="modal fade" id="modal-panel_status" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" action="<?php echo base_url() ;?>advocates/manage_adv_panel">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i><span class="user_type">पैनल</span>  की स्थिति दर्ज  करे  |
					 <a id="list_panel"><span class="user_type">पैनल</span>  की स्थिति देखे </a>
					</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नाम</label></div>
                                        <div class="col-md-9"><input type="text" id="panel_advocate_id_nm" name="panel_advocate_id_nm" class="form-control" readonly></div>
                                        <input type="hidden" id="panel_advocate_id" name="panel_advocate_id">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">पद</label></div>
                                        <div class="col-md-9">
                                         <input type="text" id="panel_post_id_nm" name="panel_post_id_nm" class="form-control" readonly>
                                        </div>
                                         <input type="hidden" id="panel_post_id" name="panel_post_id">
                                    </div>

                                    <div class="form-group row" id="district_div">
                                        <div class="col-md-3"><label for="exampleInputFile">जिला</label></div>
                                        <div class="col-md-9">
										<input type="text" id="panel_district_text" name="panel_district_text"  class="form-control" readonly>
                                        <input type="hidden" id="panel_district_id" name="panel_district_id">
                                        </div>
                                    </div>

                                    <div class="form-group row" id="tehsil_div">
                                        <div class="col-md-3"><label for="exampleInputFile">तहसील</label></div>
                                        <div class="col-md-9">
                                        <input type="text" id="panel_tehsil_text" name="panel_tehsil_text" class="form-control" readonly>
                                        <input type="hidden" id="panel_tehsil_id" name="panel_tehsil_id">
                                        </div>
                                    </div>

                                    <div class="form-group row taluka_div">
                                        <div class="col-md-3"><label for="exampleInputFile">तालुका</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="panel_taluka_id" name="panel_taluka_id"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नियुक्ति दिनांक</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="join_date" name="" placeholder="Put name here"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नवीनीकरण दिनांक</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="renew_date" name="" placeholder="Put name here"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <hr/>
                                    <div class="form-group row">
                                       <div class="col-md-3"><label for="exampleInputFile"><span class="user_type">पैनल</span>  की स्थिति</label></div>
                                       <div class="col-md-3 has-success"><input type="radio" name="panel_status" class="rd_btn" value="Y"/> <label> हां </label> </div>
                                       <div class="col-md-3"><input type="radio" name="panel_status" class="rd_btn" value="N"/> <label> नही </label> </div>
                                    </div>
									
									 <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">स्थिति</label></div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="panel_tip" id="panel_tip">
                                               <option value=""> चयन करें</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <div class="col-md-3"><label for="exampleInputFile">स्थिति का कारण</label></div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="panel_discription" id="panel_discription" required=""></textarea>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm('क्या आप  पैनल की स्थिति दर्ज करना चहाते है |')" type="submit" class="btn btn-primary send_btn"> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<script>

	function open_advocate_model(advocate_id){
		/*alert("aaa"+advocate_id);*/
		var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "advocates/get_advocate_details",
		datatype: "json",
		async: false,
		data: {advocate_id: advocate_id },
		success: function(data) {
			console.log(data);
		}
			 });
		  $('#modal-advocate').modal('show');
	}
	$('.rd_btn').change(function(){
	var radioValue = $("input[name='panel_status']:checked").val();
	var opt = '';
	if(radioValue == 'Y'){
		 opt += '<option value=""> चयन करें</option><option> सत्यापन लंबित हैं |</option><option> पुलिस प्रतिवेदन लंबित हैं |</option><option> कार्यालय में विचाराधीन |</option><option> मंत्री जी को भेजा  गया |</option>';
	}else if(radioValue == 'N'){
		 opt += '<option value=""> चयन करें</option><option>अप्राप्त </option><option>प्राप्त </option><option>विचाराधीन</option>';
	}
	 $('#panel_tip').html(opt);
	});

	$('#search_types').change(function(){
		var types = $(this).val();
		var url = "<?php echo base_url(); ?>advocate/list/<?php echo $adv_type; ?>/"+types;
		window.location.replace(url);
	});
    $('#panel_tip').change(function(){
        var panel_tip_val = $('#panel_tip option:selected').val();
        if(panel_tip_val != ''){
            var panel_tip = $('#panel_tip option:selected').text();
            $('#panel_discription').val(panel_tip);
        }else{
            $('#panel_discription').val('');
        }

    });
	</script>
	<?php $this->load->view('footer_show_user_detail') ; ?>
