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
		  <?php  echo $this->session->flashdata('message');?>
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-xs-12">
                    <form role="form" method="post" action="<?php echo base_url()?>pa_permission/da_manage_permission<?php if(isset($id)){ echo '/'.$id;} ?>">
                    <div class="col-md-4">
                        <!-- general form elements -->
                        <h3 class="box-title"><?php echo $this->lang->line('assign_role') ?></h3>
                        <div class="box box-primary" style="margin-top: 15px;">
                            <!-- form start -->
                            <div class="box-body">
								<div class="form-group">
									<?php $loginemprole = checkUserrole();?>
                                    <label for="exampleInputFile">Assign Permission</label><span class="text-danger">*</span>
									<select class="form-control" name="epa_type" required id="permission_type">
										<option value="">Select Type</option>
										<option value="section_wise">Section wise</option>
										<?php if($loginemprole==4 || $loginemprole==5 ){?>
											<option value="designation_wise">Designation wise</option>
										<?php } ?>
									</select>
									<?php echo form_error('epa_type');?>
								</div>
								<div class="form-group" id="designation_div">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('designation_label_name'); ?> <span class="text-danger">*</span></label>
                                    <?php $emp_roles = get_employe_role_designatio(); 
											$hide_role=array(4,5,6,7);
										?>
										<select class="form-control" name="epa_designation_id" id="designation_id" required="">
											 <option value=""><?php echo $this->lang->line('designation_label_name'); ?></option>
												<?php foreach ($emp_roles as $empk => $emprolse) { ?>
													<?php 
														if (is_array($emprolse) && in_array($emprolse['role_id'],$hide_role,false)) { ?>
															<option value="<?php echo $emprolse['role_id']; ?>" <?php if (isset($emp_detail['designation_id']) && @$emp_detail['designation_id'] == $emprolse['role_id']) 
															{
																echo 'selected';
															} 
															else if ($this->input->post('designation_id') == $emprolse['role_id']) 
															{
																echo 'selected';
															} ?> ><?php echo $emprolse['emprole_name_hi']; ?> (<?php echo $emprolse['emprole_name_en']; ?>) 
														<?php } ?>
												<?php } ?>
										</select>
                                    <?php echo form_error('emp_id');?>
                                </div>
                                <div class="form-group" id="section_div">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('section_label_name'); ?> <span class="text-danger">*</span></label>
                                    <?php 
                                    	$alloted_sec_ids= getEmployeeSection();
                                    	//pre($alloted_sec_ids);
                                    	$alloted_sec_ids = explode(',',$alloted_sec_ids);
                                    	$emp_roles = get_list_with_in(SECTIONS, null,'section_id',$alloted_sec_ids);
                                    	//$emp_roles = get_list(SECTIONS, null, null);
                                	?>
									<select class="form-control" name="epa_section_id" id="permission_section_id" required="">
                                        <option value=""><?php echo $this->lang->line('section_label_name');?></option>
                                        <?php foreach ($emp_roles as $empk => $emprolse) { ?>
                                                <?php 
                                                    if (is_array($emprolse)) { ?>
                                                        <option value="<?php echo $emprolse['section_id']; ?>" <?php //if (@$emp_detail['designation_id'] == $emprolse['role_id']) 
                                                        //{
                                                         //   echo 'selected';
                                                        //} 
                                                        //else if ($this->input->post('designation_id') == $emprolse['role_id']) 
                                                        //{
                                                           // echo 'selected';
                                                        //} 
														?> ><?php echo $emprolse['section_short_name']; ?> (<?php echo $emprolse['section_name_hi']; ?>) 
                                                    <?php } ?>
                                            <?php } ?>
                                    </select>
                                    <?php echo form_error('emp_id');?>
                                </div>
								<div class="form-group" id="ajax_section_div" style="display:none">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('section_from_emp_label_name'); ?></label>
									<select  class="form-control" id="section_emp_id" name="emp_id_assign_by"></select>
								</div>
								<div class="form-group" id="ajax_section_div2" style="display:none" class="emp_name_div">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('section_to_emp_label_name'); ?></label>
									<select  class="form-control" id="section_emp_id2" name="emp_id_assign_to"></select>
								</div>
								
								<div class="form-group">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('section_assign_permission_from'); ?> <span class="text-danger">*</span></label>
									<input type="text" id="movement_frm_dt" name="epa_permission_from" value="" class="form-control">
									<?php echo form_error('epa_permission_from');?>
								</div>
								<div class="form-group" >
                                    <label for="exampleInputFile"><?php echo $this->lang->line('section_assign_permission_to'); ?> <span class="text-danger">*</span></label>
									<input type="text" id="movement_to_dt" name="epa_permission_to" value="" class="form-control">
									<?php echo form_error('epa_permission_to');?>
								</div>
                                <div class="form-group">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('manage_permision_label_modules'); ?></label>
                                    <?php //pre($get_permission_list); ?>
                                    <?php   $modules_array = show_modules();$ky=0;
                                            //pre($modules_array);
                                            foreach($modules_array['module_name'] as $modules) { ?>
                                                <br/>
                                                <lable for="exampleInputFile">
                                                    <b><?php echo $modules;  ?></b>
                                                </lable>
                                                <br/>
                                                <?php $chkd=null;  foreach($modules_array['permission'] as $key=>$permission) { ?>
                                                        <?php if($permission!='Edit' && $permission!='Add'){ //echo $get_permission_list[$ky]['epa_add'].'=='.'1' ;?>
															<span style="margin:10px 10px 10px 10px">
																<?php if(isset($_GET['empid']) && $_GET['empid']!=''){ $req_empid=$_GET['empid'];}else{$req_empid=null;}  @$is_checked=check_is_permission_exist($this->session->userdata('emp_id'),$req_empid,strtolower(trim($modules)),$permission);
																	   if($is_checked==true)
																	   {$is_check='checked';}
																	   else{$is_check='';}
																?>
																<input type="checkbox" <?php echo @$chkd;  echo $is_check;  ?>  class="minimal" name="<?php echo strtolower($ky); ?>[<?php echo strtolower('epa_'.$permission); ?>]" value="1" style="margin-left: 15px" />
																<input type="hidden" name="<?php echo $ky;?>[epa_module_name]" value="<?php echo strtolower(trim($modules)); ?>"/>
																<input type="hidden" name="<?php echo $ky;?>[epa_is_active]" value="1"/>
																<b style="margin-left:5px;"><?php echo ucfirst($permission);; ?></b>
															</span>
														<?php } ?>
                                                <?php } ?>
                                                <br/>
                                    <?php $ky++; }  ?>
                                </div>
								<span class="text-danger"><b>Note :</b> All Fields required *</span>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                            	<?php if(isset($id) && $id!=''){ $pid=$id;}else{$pid=null;} ?>
                                <input type="hidden" name="pa_id" value="<?php echo $pid; ?>"/>
                                <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
                            </div>
                        </div><!-- /.box -->
                    </div>
                </form>

				<div class="col-md-8">
                        <!-- general form elements -->
                        <h3 class="box-title"><?php echo $this->lang->line('assign_role') ?></h3>
                        <div class="box box-primary" style="margin-top: 15px;">
                            <!-- form start -->
                            <div class="box-body" style="overflow: auto; width: 790px;">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									  <tr>
										<th><?php echo $this->lang->line('sno'); ?></th>
										<th><?php echo $this->lang->line('permission_assign_from'); ?></th>
										<th><?php echo $this->lang->line('permission_assign_to'); ?></th>
										<th><?php echo $this->lang->line('permission_provided_by'); ?></th>
										<th width="20%">अनुमति</th>
										<th><?php echo $this->lang->line('permission_from_to'); ?></th>
										<th><?php echo $this->lang->line('action'); ?></th>
									  </tr>
									</thead>
									<tbody><?php $get_pa_list=get_permission_alloted_emp('permission_emp');?>
									  <?php $i=1; foreach ($get_pa_list as $key => $palist) { 
									  $section_exp = explode(',',getEmployeeSection());
                                        if(in_array($palist['epa_section_id'], $section_exp)){
									  ?>
										<tr>
										  <td><?php echo $i;?></td>
										  <td><?php echo $palist['emp_assign_by'];?></td>
										  <td><?php echo $palist['emp_assign_to'];?></td>
										  <td><?php echo $palist['session_emp'];?></td>
										  <td><?php
												$alloted_permission= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('epa_module_name'=>$palist['epa_module_name'],'emp_id_assign_by'=>$palist['emp_id_assign_by'],'emp_id_assign_to'=>$palist['emp_id_assign_to']));
												//pre($alloted_permission);
												foreach($alloted_permission as $per_name){
													if($per_name!='Add' && $per_name!='Edit'){
														if($per_name['epa_recieved']==1){ $recieved_permission='<b>Received</b>: <span class="badge bg-green">Yes</span>'; }else{ $recieved_permission='<b>Recieved</b>: <span class="badge bg-red">No</span>';};
														if($per_name['epa_view']==1){ $view_permission='<b>View</b>: <span class="badge bg-green">Yes</span>'; }else{ $view_permission='<b>View</b>: <span class="badge bg-red">No</span>';};
														echo '<span class="badge bg-yellow">'.ucfirst($per_name['epa_module_name']).'</span>:<div style="margin-top:10px;margin-left: 20px;">' ;
														echo $recieved_permission.'&nbsp;&nbsp;&nbsp;';
														echo $view_permission.'</div>';
													}
												}
											  ?>
										  </td>
											<td><?php 
													echo 'From:<br/>'.$palist['epa_permission_from'].'<br/>';
													echo 'To:<br/>'.$palist['epa_permission_to'];
												?>
											</td>
										  <td>
											  <div class="btn-group">
												<a onclick="return confirm_delete();" href="<?php echo base_url();?>permission/delete/<?php echo $palist['epa_id'];?>" class="btn  btn-twitter">Delete</a>
											  </div>
											</td>
										</tr>
									  <?php $i++; }} ?>
									</tbody>
								</table>
                            </div><!-- /.box-body -->
                            
                        </div><!-- /.box -->
                    </div>
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->