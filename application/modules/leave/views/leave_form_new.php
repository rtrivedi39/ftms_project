
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
      <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $page_title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $page_title; ?></h3>
                </div><!-- /.box-header -->
                <?php echo $this->session->flashdata('message'); //pre($this->input->post()); //pre($emp_detail); pre($emp_more_detail);?>
<?php if(isset($leave_details->emp_leave_movement_id)){
		?>
      <form enctype="multipart/form-data" role="form" method="post" action="<?php echo base_url() ?>leave/modifyleave">
<?php } else {
	?>
	  <form enctype="multipart/form-data" role="form" method="post" action="<?php echo base_url() ?>leave/addleave">
	<?php 
}?> 
					 <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12">                           
                                <?php if (isset($user_det->emp_full_name)) { ?>

                                    <div class="col-md-6 no-margin no-padding"> 
                                        <label for="exampleInputEmail1" ><?php echo $this->lang->line('leave_emp_name') . '/' . $this->lang->line('leave_emp_designation'); ?> </label>
                                    </div>
                                    <div class="col-md-6 ">
                                        <?php
                                        echo isset($user_det->emp_full_name) ? $user_det->emp_full_name : '';
                                        echo ' / ' . getemployeeRole($user_det->role_id);
                                        ?>
                                    </div>

                                <?php } ?>
                            </div>
                        </div> 
                        <hr class="clearfix"/>
                        <div class="form-group col-md-6" >
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('leave_type'); ?> <span class="text-danger">*</span></label>
                            <select class="form-control" name="leave_type" id="leave_type" <?PHP echo set_value('leave_type') ?> >
                                <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                                <option  value="cl"  <?php if($this->input->get('type') == 'cl'){ echo 'selected'; }else if (isset($leave_details->emp_leave_type)){ if ($leave_details->emp_leave_type == 'cl'){ echo 'selected'; }} ?>><?php echo $this->lang->line('casual_leave'); ?></option>
                                <option value="ol" <?php if($this->input->get('type') == 'ol'){ echo 'selected'; } else if (isset($leave_details->emp_leave_type)){ if ($leave_details->emp_leave_type == 'ol'){ echo 'selected'; }} ?>><?php echo $this->lang->line('optional_leave'); ?></option>
                                <option value="el" <?php if($this->input->get('type') == 'el'){ echo 'selected'; } else if (isset($leave_details->emp_leave_type)){ if ($leave_details->emp_leave_type == 'el'){ echo 'selected'; }} ?>><?php echo $this->lang->line('earned_leave'); ?></option>
                                <option value="hpl" <?php if($this->input->get('type') == 'hpl'){ echo 'selected'; }else if (isset($leave_details->emp_leave_type)){ if ($leave_details->emp_leave_type == 'hpl'){ echo 'selected'; }} ?>><?php echo $this->lang->line('half_pay_leave'); ?></option>
                                <option value="ot"><?php echo $this->lang->line('official_tour'); ?></option>
								<option value="sl"><?php echo $this->lang->line('special_leave'); ?></option>
								<option value="hq"><?php echo $this->lang->line('leave_head_quoter'); ?></option>
                            </select>
                            <?php echo form_error('leave_type'); ?>
                        </div>
                        <div class="form-group col-md-6 " >

                            <label for="exampleInputEmail1"><?php echo $this->lang->line('leave_reason'); ?> <span class="text-danger">*</span></label>
                            <select class="form-control" name="leave_reason_ddl" id="leave_reason_ddl" <?PHP echo set_value('leave_type') ?> >
                                <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                                <?php
                                $leave_resons = leaveReason();
                                foreach ($leave_resons as $leave_reason) {
									if(isset($leave_details->emp_leave_reason)){
									 if($leave_reason == $leave_details->emp_leave_reason){
										 ?>
										  <option selected ><?php echo $leave_reason; ?></option>
										 <?php 
									 }}else{
                                    ?>
                                    <option value='<?php echo $leave_reason; ?>' ><?php echo $leave_reason; ?></option>
                                <?php }
								}
                                ?>

                            </select>
                        </div>

                        
						<div class="clearfix"></div>
                        <div class="form-group col-md-12 cl_reason_other hide_class">
                            <label for="exampleInputFile"><?php echo $this->lang->line('leave_reason'); ?></label>
                            <textarea class="form-control" name="reason" id="reason" rows="3" placeholder="Enter ..."></textarea>
                        </div> 
                        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $this->uri->segment(3); ?>">
                        <input type="hidden" name="on_behalf_id" id="on_behalf_id" value="<?php echo $this->session->userdata('emp_id'); ?>">
                        
                        <div class="clearfix"></div>
                        <div class="form-group col-md-6">

                        </div>
                        <div class="clearfix"></div>
						 
						<div class="hq_leave_type">
                        <div class="form-group col-md-6">
                            <label for="exampleInputPassword1"><?php echo $this->lang->line('start_date'); ?> <span class="text-danger">*</span></label>
                            <input type="text"  data-date-format="dd-mm-yyyy" value="<?php echo isset($leave_details->emp_leave_date)?$leave_details->emp_leave_date:'' ; ?>"  data-provide="datepicker" name="start_date" id="start_date"  class="form-control datepicker">
                            <?php echo form_error('start_date'); ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputFile"><?php echo $this->lang->line('end_date'); ?> <span class="text-danger">*</span></label>
                            <input type="text" data-date-format="dd-mm-yyyy" value="<?php echo isset($leave_details->emp_leave_end_date)?$leave_details->emp_leave_end_date:'' ; ?>"  name="end_date" id="end_date" class="form-control datepicker">
                            <?php echo form_error('end_date'); ?>
                        </div>  
						  </div>  
						<div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line('leave_days'); ?> <span class="text-danger">*</span></label>
                            <input type="number" value="<?php echo isset($leave_details->emp_leave_no_of_days)?$leave_details->emp_leave_no_of_days:'' ; ?>" name="no_days_other" id="no_days_other" class="form-control <?php
                            if (isset($leave_type)) {
                                if (($leave_type == 'cl') || ($leave_type == 'ol')) {
                                    echo " hide_class ";
                                } 
								
                            }if(isset($leave_details->emp_leave_type)){
								if (($leave_details->emp_leave_type == 'cl') || ($leave_details->emp_leave_type == 'ol')) {
                                    echo " hide_class ";
                                } 
								
							}else{
								echo "";
							}
                            ?>">
                            <select name="no_days_ol" id="no_days_ol" class="form-control ol_leave <?php
                            if (isset($leave_type)) {
                                if ($leave_type == 'ol') {
                                    echo "";
                                } 
                            }if(isset($leave_details->emp_leave_type)){
								if ($leave_details->emp_leave_type == 'ol') {
                                    echo "";
                                } 
								
							} 
							
							else {
                                ?>hide_class <?php } ?>">
                                <option value="">-- <?php echo $this->lang->line('leave_select'); ?>--</option>
                                <option <?php if(isset($leave_details->emp_leave_no_of_days)){  if($leave_details->emp_leave_no_of_days == 1){ echo 'selected'; } } ?>>1</option>
                                <option <?php if(isset($leave_details->emp_leave_no_of_days)){ if($leave_details->emp_leave_no_of_days == 2){ echo 'selected'; } } ?>>2</option>
                                <option <?php if(isset($leave_details->emp_leave_no_of_days)){ if($leave_details->emp_leave_no_of_days == 3){ echo 'selected'; } } ?>>3</option>
                            </select>
                            <select name="no_days_cl" id="no_days_cl" class="form-control cl_leave <?php
                            if (isset($leave_type)) {
                                if ($leave_type == 'cl') {
                                    echo "";
                                } 
                            } if(isset($leave_details->emp_leave_type)){
								if ($leave_details->emp_leave_type == 'cl')  {
                                    echo "";
                                } 
								
							}else {
                                ?>hide_class <?php } ?>">
                                <option value="">-- <?php echo $this->lang->line('leave_select'); ?>--</option>
                                <?php
                                $i = .5;
                                while ($i < 9) {
                                    ?>
                                    <option <?php if(isset($leave_details->emp_leave_no_of_days)){  if($leave_details->emp_leave_no_of_days == $i){ echo 'selected'; } } ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                    $i = $i + .5;
                                }
                                ?>
                            </select>
                            <input type="hidden" name="days" id="days" value="">								
                            <?php echo form_error('days'); ?> 
                        </div>
                        <div class="form-group col-md-6 cl_leave_days <?php
                        if (isset($leave_type)) {
                            if ($leave_type == 'cl') {
                                echo "";
                            } else {
                                echo " hide_class ";
                            }
                        } if(!empty($leave_details->emp_leave_half_type)){
							       echo "";
                             }
						
						else {
                            ?>hide_class <?php } ?>">
                            <label for="leave_type" class="radio"><?php echo $this->lang->line('leave_half_type'); ?></label>
                            <label class="radio col-md-6"> <input type="radio" name="half_type" id="first_half" value="FH" <?php if(!empty($leave_details->emp_leave_half_type)){ if($leave_details->emp_leave_half_type == 'FH'){ echo 'checked'; }}?>  ><?php echo $this->lang->line('first_half'); ?></label>
                            <label class="radio col-md-6"> <input type="radio" name="half_type" id="secon_half" value="SH" <?php if(!empty($leave_details->emp_leave_half_type)){ if($leave_details->emp_leave_half_type == 'SH'){ echo 'checked'; }} ?> ><?php echo $this->lang->line('second_half'); ?></label>
                            <?php echo form_error('half_type'); ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="<?php
                        if (isset($leave_type)) {
                            if ($leave_type == 'hpl') {
                                
                            } else {
                                echo "hide_class";
                            }
                        } else {
                            ?> <?php } ?> hpl_leave">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"> <?php echo $this->lang->line('for_EL_with_headquarter_permission'); ?></label>
                            </div>
                            <div class="form-group col-md-6">
                                <select class="form-control" name="headquoter" id="headquoter" >
                                    <option value="" > -- <?php echo $this->lang->line('leave_select'); ?>-- </option>
                                    <option value="1" <?php if(isset($leave_details->emp_leave_is_HQ )){ if($leave_details->emp_leave_is_HQ == 1){ echo 'selected'; } } ?> ><?php echo $this->lang->line('yes'); ?> </option>
                                    <option value="2" <?php if(isset($leave_details->emp_leave_is_HQ )){ if($leave_details->emp_leave_is_HQ == 2){ echo 'selected'; } } ?>><?php echo $this->lang->line('no'); ?> </option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="headquoters_leave
						<?php if(isset($leave_details->emp_leave_is_HQ)){ if($leave_details->emp_leave_is_HQ == 1){}else { echo 'hide_class ' ; }}else { echo 'hide_class ' ;  }?>">
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile"><?php echo $this->lang->line('start_date'); ?> <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($leave_details->emp_leave_HQ_start_date)? $leave_details->emp_leave_HQ_start_date:''; ?>"  data-date-format="dd-mm-yyyy" name="hd_start_date" id="hd_start_date"  class="form-control">
                                <?php echo form_error('hd_start_date'); ?>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile"><?php echo $this->lang->line('end_date'); ?> <span class="text-danger">*</span></label>
                                <input type="text" value="<?php echo isset($leave_details->emp_leave_HQ_end_date)? $leave_details->emp_leave_HQ_end_date:''; ?>" data-date-format="dd-mm-yyyy" name="hd_end_date" id="hd_end_date"  class="form-control">
                                <?php echo form_error('hd_end_date'); ?>
                            </div>  
                        </div>	
                        <div class="<?php if(($this->input->get('type') == 'hpl') ){}else if(isset($leave_details->emp_leave_type)){ if($leave_details->emp_leave_type == 'hpl' ){}} else{ echo ' hide_class '; }?> hq_type ">
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile" class="radio"><?php echo $this->lang->line('leave_header_quoter_leave'); ?> </label>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-12 ">
                                <div class="row">
                                    <div class="radio col-md-6">
                                        <label>
                                            <input type="radio"	name="head_quoter_type" id="general_ground"  <?php if(isset($leave_details->type_of_headquoter )){ if($leave_details->type_of_headquoter == 'GG'){ echo 'checked'; }} ?>  value="GG" ><?php echo $this->lang->line('leave_general_grounds'); ?> 
                                        </label>
                                    </div>
                                    <div class="radio col-md-6">
                                        <label>
                                            <input type="radio" name="head_quoter_type" id="medical_ground" <?php if(isset($leave_details->type_of_headquoter )){ if($leave_details->type_of_headquoter == 'MG'){ echo 'checked'; } }?> value="MG">
                                            <?php echo $this->lang->line('leave_medical_ground'); ?> 
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12 ">
                                <label for="exampleInputFile"><?php echo $this->lang->line('leave_upload_medical_file'); ?> <span class="text-danger">*</span></label>
                                <input type="file" name="medical_file" id="medical_file" class="form-control">
                            </div>
                       	</div>
                        <div class="clearfix"></div>
                        <div class="form-group col-md-12 el_leave <?php
                        if (isset($leave_type)) {
                            if ($leave_type != 'el' ) {
                                echo " hide_class ";
                            } 
							
							else {
                                
                            }
                        } 
						if(  isset($leave_details->emp_leave_type)){
							if($leave_details->emp_leave_type != 'el'){  echo "hide_class "; }
						}
						else {
                            ?> hide_class <?php } ?>">
                            <label for="exampleInputFile"><?php echo $this->lang->line('leave_address'); ?> <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" id="address" rows="3" placeholder="Enter ..."><?php echo isset($leave_details->emp_leave_address)?$leave_details->emp_leave_address:''?></textarea>

                        </div> 
                          <?php //echo "asdas ".$this->uri->segment(2) ;?>
                        <?php if ($this->input->get('type')) {}else if($this->uri->segment(3) ){ ?> 
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile"><?php echo $this->lang->line('leave_of_way'); ?></label>
                            </div> 
                            <div class="form-group col-md-6">
                                <div class="row">
                                    <label class="radio col-md-4 email_radio"> <input type="radio" name="leave_way" id="leave_way_email" value="Email" ><?php echo $this->lang->line('leave_of_email'); ?></label>
                                    <label class="radio col-md-4"> <input type="radio" name="leave_way" id="leave_way_msg" value="Message" ><?php echo $this->lang->line('leave_of_msg'); ?></label>
                                    <label class="radio col-md-4"> <input type="radio" name="leave_way" id="leave_way_other" value="Other"><?php echo $this->lang->line('leave_of_other'); ?></label>
                                </div>
                            </div> 
							
                            <div class="clearfix"></div>
                            <div class="form-group col-md-12">
                                <label for="exampleInputFile"><?php echo $this->lang->line('leave_of_message'); ?></label>
                                <textarea class="form-control" name="leave_message" id="leave_message" rows="3" placeholder="Enter ..."></textarea>

                            </div>
                          
                        <?php } ?>
						   <?php if ( ($this->uri->segment(2) != 'modify_leave' )) { ?>
                              <hr class="clearfix"/>
                             <div id="pay_rent_box" class="row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('leave_of_pay'); ?><span class="text-danger">*</span></label>
                                    <input type="text"  name="pay_grade_pay" id="pay_grade_pay"  class="form-control" >
                                    <?php echo form_error('pay_grade_pay'); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('house_rant'); ?><span class="text-danger">*</span></label>
                                    <select name="emp_houserent" class="form-control" >
                                        <option value=""><?php echo $this->lang->line('house_rant'); ?></option>
                                            <option selected="" value="y">हाँ</option>                                        
                                            <option value="n">नहीं</option>                                        
                                            <option value="rule">सरकारी रूल्स के आधार पर</option>                                        
                                        </select>
                                    <?php echo form_error('emp_houserent'); ?>
                                </div>
                            </div>
						   <?php } ?>
						    <?php if ( ($this->uri->segment(2) == 'modify_leave' )) { ?>
                             <div class="clearfix"></div>
                            
                                <div class="form-group col-md-12">
                                    <label for="exampleInputFile"><?php echo $this->lang->line('leave_cancel_remark'); ?></label>
                                    <textarea name="change_remark" id="change_remark" class="form-control" ></textarea>
                                    <?php echo form_error('pay_grade_pay'); ?>
                                </div>
                                
                           
						   <?php } ?>
                    </div> <!-- body-->		

                   <input type="hidden" name="leave_movement_id" id="leave_movement_id" value="<?php echo isset($leave_details->emp_leave_movement_id)?$leave_details->emp_leave_movement_id:''; ?>">
                   <div class="box-footer">
					<?php if(isset($leave_details->emp_leave_movement_id)){
						?>
						<input class="btn btn-primary" type="submit" name="modify_date" value="<?php echo $this->lang->line('modify_botton'); ?>" >
						<?php 
					}else {?>
						<input class="btn btn-primary" type="submit" name="save_leave" value="<?php echo $this->lang->line('submit_botton'); ?>" >
                        
					<?php } ?>
                    </div>
                   
                </form>
            </div><!-- /.box -->
        </div><!-- /.col6 -->
		
		 <?php $this->load->view('leave_dashboard')?>
    </div><!-- /.row -->
</section><!-- /.content -->
