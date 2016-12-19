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
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <div style="float:right"> <button class="btn btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                  
                </div><!-- /.box-header -->
                <?php  echo $this->session->flashdata('message'); ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th><?php echo $this->lang->line('sno'); ?></th>
                        <th><?php echo $this->lang->line('list_label_name'); ?></th>
                        <th><?php echo $this->lang->line('list_label_email'); ?></th>
                        <th><?php echo $this->lang->line('list_label_mobile'); ?></th>
                        <th>अनुमति</th>
                        <th><?php echo $this->lang->line('list_label_datetime'); ?></th>
                        <th><?php echo $this->lang->line('action'); ?></th>
                      </tr>
                    </thead>
                    <tbody><?php //pre($get_pa_list);?>
                      <?php $i=1; foreach ($get_pa_list as $key => $palist) { ?>
                        <tr>
                          <td><?php echo $i;?></td>
                          <td><?php echo $palist['emp_full_name'];?></td>
                          <td><?php echo $palist['emp_email'];?></td>
                          <td><?php echo $palist['emp_mobile_number'];?></td>
                          <td><?php
                                $alloted_permission= get_list(EMPLOYEE_PERMISSION_ALLOTED,null,array('emp_id_assign_by'=>$this->session->userdata('emp_id'),'emp_id_assign_to'=>$palist['emp_id']));
                                //pre($alloted_permission);
                                foreach($alloted_permission as $per_name ){
                                    if($per_name['epa_recieved']==1){ $recieved_permission='<b>Received</b>: <span class="badge bg-green">Yes</span>'; }else{ $recieved_permission='<b>Recieved</b>: <span class="badge bg-red">No</span>';};
                                    if($per_name['epa_add']==1){ $add_permission='<b>Add</b>: <span class="badge bg-green">Yes</span>'; }else{ $add_permission='<b>Add</b> : <span class="badge bg-red">No</span>';};
                                    if($per_name['epa_edit']==1){ $edit_permission='<b>Edit</b>: <span class="badge bg-green">Yes</span>'; }else{ $edit_permission='<b>Edit</b> : <span class="badge bg-red">No</span>';};
                                    if($per_name['epa_view']==1){ $view_permission='<b>View</b>: <span class="badge bg-green">Yes</span>'; }else{ $view_permission='<b>View</b>: <span class="badge bg-red">No</span>';};
                                    echo '<span class="badge bg-yellow">'.ucfirst($per_name['epa_module_name']).'</span>:<div style="margin-top:10px;margin-left: 20px;">' ;
                                    echo $recieved_permission.'&nbsp;&nbsp;&nbsp;';
                                    echo $add_permission.'&nbsp;&nbsp;&nbsp;<br/>';
                                    echo $edit_permission.'&nbsp;&nbsp;&nbsp;';
                                    echo $view_permission.'</div>';
                                }
                              ?>
                          </td>
                          <td><?php echo $palist['emp_create_date']; ?></td>
                          <td>
                              <div class="btn-group">
								  <a href="<?php echo base_url();?>pa/list?empid=<?php echo $palist['emp_id']; ?>#view_permision_emp" class="btn  btn-twitter"><?php echo $this->lang->line('assign_role') ?></a>
                                <!-- <a href="<?php //echo base_url('admin');?>/delete_section/<?php //echo $sections['section_id'];?>" onclick="return is_delete();" class="btn  btn-twitter">Delete</a> -->
                              </div>
                            </td>
                        </tr>
                      <?php $i++; } ?>
                    </tbody>
                </table>
              </div><!-- /.box-body -->
                <?php if(isset($_GET['empid']) &&  $_GET['empid']!=''){ ?>
                    <form role="form" method="post" action="<?php echo base_url()?>pa_permission/manage_permission<?php if(isset($id)){ echo '/'.$id;} ?>">
                    <div class="col-md-6" id="view_permision_emp">
                        <!-- general form elements -->
                        <h3 class="box-title"><?php echo $this->lang->line('assign_role') ?></h3>
                        <div class="box box-primary" style="margin-top: 15px;">
                            <!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('list_label_emp_name'); ?></label>
                                    <select class="form-control" name="emp_id" id="emp_id" required="" oninvalid="setCustomValidity('<?php echo $this->lang->line('list_label_emp_name'); ?>')"
                                            onchange="try{setCustomValidity('')}catch(e){}">
                                        <option value=""><?php echo $this->lang->line('select');?></option>
                                        <?php foreach ($get_pa_list as $paemps) { ?>
                                            <option value="<?php echo $paemps['emp_id']; ?>" <?php if(@$paemps['emp_id']==@$id){echo 'selected';} ?> ><?php echo $paemps['emp_full_name'];?></option>
                                        <?php }  ?>
                                    </select>
                                    <?php echo form_error('emp_id');?>
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
                                                <?php  foreach($modules_array['permission'] as $key=>$permission) { ?>
                                                        <?php //echo $get_permission_list[$ky]['epa_add'].'=='.'1' ;?>
                                                        <span style="margin:10px 10px 10px 10px">
                                                            <?php //if($get_permission_list[$ky]['epa_module_name']==strtolower($modules) && isset($get_permission_list[$ky]['epa_add']) && $get_permission_list[$ky]['epa_add'] && $get_permission_list[$ky]['epa_add']==1) { $chkd='checked';}else{ $chkd='';}?>
                                                            <?php //if($get_permission_list[$ky]['epa_module_name']==strtolower($modules) && isset($get_permission_list[$ky]['epa_edit']) && $get_permission_list[$ky]['epa_edit'] && $get_permission_list[$ky]['epa_edit']==1) { $chkd='checked';}else{ $chkd='';}?>
                                                            <?php //if($get_permission_list[$ky]['epa_module_name']==strtolower($modules) && isset($get_permission_list[$ky]['epa_view']) && $get_permission_list[$ky]['epa_view'] && $get_permission_list[$ky]['epa_view']==1) { $chkd='checked';}else{ $chkd='';}?>
                                                            <?php //if($get_permission_list[$ky]['epa_module_name']==strtolower($modules) && isset($get_permission_list[$ky]['epa_recieved']) && $get_permission_list[$ky]['epa_recieved'] && $get_permission_list[$ky]['epa_recieved']==1) { $chkd='checked';}else{ $chkd='';}?>
                                                            <?php  @$is_checked=check_is_permission_exist($this->session->userdata('emp_id'),$_GET['empid'],strtolower(trim($modules)),$permission);
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
                                                <br/>
                                    <?php $ky++; }  ?>
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="pa_id" value="<?php echo @$id; ?>"/>
                                <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
                            </div>
                        </div><!-- /.box -->
                    </div>
                </form>
                <?php } ?>
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->