<?php //pr( $get_users) ?>
<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
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
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                  <div style="float:right; width:500px" >
					<!-- <a class="col-md-4"   href="<?php echo base_url();?>advocate/advocate_report/<?php echo $adv_type; ?>">
                      	<button class="btn btn-block btn-info">Report</button>
                      </a> -->
                    <a class="col-md-4 pull-right"  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>">
                      <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
                    </a>
					 <div style="float:right;margin-right: 10px;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
							</a>
                    </div>
                  </div>
                
                  <!-- /.box-header -->
                   <div class="clearfix"></div>
					<br>
                    <!--<div style="width:650px;" class="pull-right">
					    <div style="float:left;margin-right: 10px;" class="col-md-3" >
	                       <?php  // $selected  = ''; $lbl='जिले के आधार पर देखें ';?>						
							<?php //echo  get_distic_ddl_list_with_lbl('scm_district_id', 'id="district_id"  class="form-control"', $selected,$lbl); ?>
						   
	                    </div>
						<div id="tahsil_div" class="col-md-3" style="margin-right: 10px;">
							<select class="form-control" onchange="get_tahsil_details(this.value,this.text)" id="tahsil_val" name="scm_tahsil_id">
								<option value=""> --तहसील का चयन करें-- </option><option value="2093">Alirajpur - अलीराजपुर</option>
							</select>
						</div>
						<div id="taluka_div" class="col-md-3"  style="margin-right: 10px;">
							<select class="form-control" id="scm_taluka_id" onchange="get_taluka_details(this.value)" name="scm_taluka_id">
								<option value=""> --तालुका का चयन करें-- </option><option value="369">Alirajpur - अलीराजपुर</option>
							</select>
						</div>
                    </div> -->
					<br>
				   <div class="clearfix"></div>
				  <div id="ajax_tbl"></div>
                  <table id="leave_employee" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						 <?php if($this->uri->segment(3) == 9){?>
                       	  <th>मेरिट क्रमांक</th>
                       	  <th>पंजी क्र.</th>
						 <?php }else{ ?>
						   <th>Sno</th>
						  <?php } ?>
						 <th>नाम</th>
						 <?php if($this->uri->segment(3) == 9){?>
						  <th>पिता का नाम</th>
						  <?php } ?>
						   <?php if($this->uri->segment(3) != 9){?>
						<th> अनुभव</th>
						
						 <th>पता</th>
                        <th>नियुक्ति दिनांक</th>
                        <th>नवीनीकरण दिनांक </th>
                        <!--<th>पदस्ता का प्रकार </th>-->
						<?php } ?>
						<?php if($this->uri->segment(3) == 9){?>
						  <th>पता</th>
						  <th>जाति</th>
						  <th>जाति प्रमाण पत्र</th>
						  <th> चरित्र प्रमाण पत्र</th>
						  <th>अनापत्ति <br>प्रमाण पत्र</th>
						  <th> चिकित्सा जाँच <br>प्रमाण पत्र</th>
						  <?php } ?>
						<th style="width:90px">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
					//pre($get_users);
                        foreach ($get_users as $key => $users) { 
								if(!empty($users['advocate_file_cr_no']) && !empty($users['section_no_year'])) {
								 $file_id = get_fileid_from_sectionno($users['advocate_file_cr_no'],11 , $users['section_no_year']);
								
									$file_data = get_draft_from_file( $file_id);
								
								 	$file_data['final_draft_id'];
									
								  }?>
                        <tr>
							<?php if($this->uri->segment(3) != 9){?>
                            <td><?php echo $i;?></td>
							<?php } ?>
							<?php if($this->uri->segment(3) == 9){?>
                            <td><?php echo !empty($users['marti_no'])?$users['marti_no']:'' ;?></td>
                            <td>
								 <span class="label bg-green" title="शाखा पंजी क्र."style="font-size: 14px;">
								<?php echo !empty($users['advocate_file_cr_no'])?$users['advocate_file_cr_no']:'' ;?>
								 </span>	 
							 </td>
							<?php } ?>
                            <td><?php 
								if(!empty($users['scm_name_en'])){
									$nm='';
								} else if($users['scm_name_hi']==$users['scm_name_en']){ $nm= ''; }else{ $nm= !empty($nm)?' ('.$users['scm_name_en'].')':'' ;}
								if($users['scm_name_hi']!=''){ echo $users['scm_name_hi'].$nm; }else{ echo $users['scm_name_hi'];}
								if(!empty($users['contact_no'])){
								echo "<br><b> मोबाईल :</b>".@$users['contact_no'];
								}
								if(!empty($users['email_id'])){
								echo "<br><b> ईमेल :</b>".$users['email_id'];
								}
								?>
								
							</td>
							<?php if($this->uri->segment(3) == 9){?>
						  	<td><?php echo !empty($users['scm_father_name_hi'])?$users['scm_father_name_hi']:'' ;?></td>
						  	<?php } ?>
							 <?php if($this->uri->segment(3) != 9){?>
                          
							<td><?php if($users['adv_work_experiance']){ echo @$users['adv_work_experiance'] ; } ?></td>
							
                            <td><?php echo $users['scm_address_hi']?><br/>
								<?php if(!empty($users['state_id'])){ echo '<b>राज्य :</b>'.getState($users['state_id']); }else { echo '<b>State :N/A';}?><br/>
								<?php if(!empty($users['scm_district_id'])){ echo '<b>जिला :</b>'.getDistrict_name($users['scm_district_id']);}else { echo '<b> जिला :</b>N/A'; }?><br/>
								<?php if(!empty($users['scm_tahsil_id'])){ echo '<b़> तहसील : </b>'.get_tahsil_name($users['scm_tahsil_id']);   }else { echo '<b़> तहसील :</b> N/A'; }?><br/>
								<?php if(!empty($users['scm_taluka_id'])){ echo '<b> तालुका :</b>'.get_taluka_name($users['scm_taluka_id']);   }else { echo '<b़> तालुका :</b> N/A'; }?><br/>
							</td>
                            <td><?php if($users['posting_date']!='1970-01-01' && $users['posting_date']!='01-01-1970'&& $users['posting_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['posting_date']));}else{ echo 'N/A';}?></td>
                            <td><?php if($users['post_renew_date']!='1970-01-01' && $users['post_renew_date']!='01-01-1970'&& $users['post_renew_date']!='0000-00-00' ){  echo date('d-m-Y',strtotime($users['post_renew_date']));}else { echo 'N/A';}?></td>
							<!-- <td><?php //  if(array_key_exists($users['advocate_post_type'] ,advocate_posttype_array())){ echo advocate_posttype_array($users['advocate_post_type']); } ?></td>-->
							  <?php } ?>
							<?php if($this->uri->segment(3) == 9){?>
						 	<td><?php if(!empty($users['residential_address'])){ echo $users['residential_address'] ; } ?>
							<?php if(!empty($users['home_district'])){ echo '<br/><b> जिला :</b>'.getDistrict_name($users['home_district']); } ?><br/>
							</td>
						 	<td><?php if(!empty($users['category_name'])){ echo cast_category_array( $users['category_name']) ; } ?></td>
						  <td><?php
						
							 if( !empty($users['is_cast_cert_upload']) && $users['is_cast_cert_upload'] == 'y' ){ 
							    echo "हाँ <br>";
								   echo !empty($users['cast_cert_upload_path'])? "<a target='_blank' href='".base_url()."uploads/civil_judge/".$users['cast_cert_upload_path']."'>जाति प्रमाण </a>" :'' ; 
								}
							  else{
								  echo "नहीं ";
							  }
							  ?></td>
						  <td>
						   <?php $civil_judges = get_civil_judge_character_cer( $users['scm_id'] );
						 
						   if( !empty($users['is_character_cert_status']) && $users['is_character_cert_status'] == 'y')
						   { 
					             ?> 
								  
									<?php
								  if(count(@$civil_judges) > 0 && is_array($civil_judges) ){
								  $ss= 1 ;
										foreach($civil_judges as $civil_judge){
										?>
												
												<?php if(!empty($civil_judge->state_id)){ echo '<b> राज्य :</b>'.getState($civil_judge->state_id); }else { echo '<b>राज्य :N/A';}?><br/>
												<?php if(!empty($civil_judge->district_id)){ echo '<b>जिला :</b>'.getDistrict_name($civil_judge->district_id);}else { echo '<b> जिला :</b>N/A'; }?><br/>
												<?php if(!empty($civil_judge->upload_file_name) ){ echo '<a target="_blank" href="'.base_url().'uploads/civil_judge/'.$civil_judge->upload_file_name.' "   > चरित्र प्रमाण पत्र </a>' ;} else { echo 'N/A'; }?><br/>
													<?php if(empty($file_data['final_draft_id'])){ ?>			
												  		<a href="<?php echo base_url().'advocate/delete_char_certificate/'.$civil_judge->charater_certificate_id;?>" style="color:red">नष्ठ करें</a><hr style="border-top:1px solid #000">
										
											<?php $ss++; } ?>
												<?php  } ?>
										<?php  } 
						   }else{
								  echo "नहीं ";
							  } ?>
							  <br><a style="cursor:pointer" onclick="add_more('<?php echo $users['scm_id'];?>')">नया जोड़े</a>
						  </td>
						  <td>
						
						  <?php  if( !empty($users['non_opjection_cert_status']) && $users['non_opjection_cert_status'] == 'y' ){ 
								  echo "हाँ <br>"; echo !empty($users['non_opjection_cert_path'])? "<a target='_blank' href='".base_url()."uploads/civil_judge/".$users['non_opjection_cert_path']."'>अनापत्ति प्रमाण पत्र</a>":''; 
							  }else{
								  echo "नहीं ";
							  }?>
							</td>
						 <td><?php if( !empty($users['attach_fitness_cert_status']) && $users['attach_fitness_cert_status'] == 'y' ){ 
								  echo "हाँ <br>"; echo !empty($users['fitness_file_upload_path'])? "<a target='_blank' href='".base_url()."uploads/civil_judge/".$users['fitness_file_upload_path']."'>चिकित्सा जाँच प्रमाण </a>":''; 
							  }else{
								  echo "नहीं ";
							  }?>
							</td>
						  <?php } ?>
                            <td>
                              <div class="btn-group">
								   <?php if(!empty($users['advocate_file_cr_no']) && !empty($users['section_no_year'])){
								  $file_id = get_fileid_from_sectionno($users['advocate_file_cr_no'] , 11 , $users['section_no_year'] );
								  }?>
								<?php //if($_GET['bij']=='yes'){ pre($this->session->all_userdata());} ?>
                                <?php if($this->session->userdata('admin_logged_in')==1 || $this->session->userdata('emp_id')=='66' || $this->session->userdata('emp_id') ==  148 ){ 
								 if(empty($file_data['final_draft_id']) ){ ?>
									<a href="<?php echo base_url().'advocate/delete_records/'.$users['scm_id'];?>" class="btn  btn-twitter">नष्ठ करें</a>
								<?php } ?>
								<a href="<?php echo base_url('advocate');?>/edit_advocate/<?php echo $this->uri->segment(3);?>/<?php echo $users['scm_id'];?>" class="btn  btn-twitter">Edit</a>
                                <!--<a href="<?php echo base_url();?>dealing_assistant/viewProfile/<?php echo $users['scm_id'];?>" class="btn  btn-twitter">View</a>-->
								<?php } ?>
								  <?php if($this->uri->segment(3) == 4){ ?>
								  	<a href="<?php echo base_url();?>admin_notesheet_master/view_file_notesheet/147/12/<?php echo $users['advocate_file_cr_no'];?>?adv_id=<?php echo $users['scm_id'];?>" class="btn  btn-twitter">नवीनीकरण</a>
								  <?php } ?>
								  <?php if($this->uri->segment(3) == 9 && !empty($file_id)){ ?>
								  
								  	<a href="<?php echo base_url();?>view_file/document_path/index/<?php echo @$file_id; ?>?temp=y&cj_id=<?php echo $users['scm_id'];?>" class="btn  btn-twitter">आदेश/नोटशीट जोड़े</a>
								  	
								  <?php } ?>
								  <?php if(!empty($file_data['final_draft_id'])){?>
									<a href="<?php echo base_url();?>efile/<?php echo @$file_id; ?>" class="btn btn-block btn-sm btn-warning">ई- फाइल जोड़े</a>
									<?php }?>
							  </div>
                            </td>
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
	  function add_more(judge_id){
	    	$('#modal-id').val(judge_id);
			$('#modal-civil_judge').modal('show');
			$('#form_submit_advocate').attr('action','<?php echo base_url() ;?>advocate/add_character_certificate/'+judge_id);
	  }
</script>
<div class="modal fade" id="modal-civil_judge" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form id="form_submit_advocate"  enctype="multipart/form-data" action="<?php echo base_url() ;?>advocate/add_character_certificate/" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>नया चरित्र प्रमाण पत्र जोड़े </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="judge_id">
                                    <div class="form-group">
                                         <label>राज्य </label>
                                         <?php $state_id = '' ; echo get_state_ddl_list('ctr_state_id', ' class="form-control col-md-3"  id="ctr_state_lst"',$state_id);  ?></td>
									</div>
									<div class="form-group">
                                        <label>ज़िला </label>
										<?php $district_id= '';  echo  get_distic_ddl_list('ctr_district_id', 'id="ctr_district_id"  class="form-control col-md-3"',$district_id); ?>
									</div>
									<div class="form-group">
                                        <label>प्रमाण पत्र </label>
                                        <input type="file" name="ctr_charater_certificate_file" class="form-control" >
									</div>
                                 
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>सुरक्षित करें</button>
                </div>
            </div>
        </form>
    </div>
</div>