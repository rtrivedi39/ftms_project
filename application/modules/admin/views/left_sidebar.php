<?php $userrole = checkUserrole();
$emp_section = $this->session->userdata('emp_section_id');
$efile = show_efile_section($emp_section);
$section_exp = explode(',',$emp_section);
//echo $section_exp;
if(in_array('7',$section_exp) && $userrole != 1 && $userrole >= 8 && $userrole != 11 && $userrole != 13 && $userrole != 25 ) {
    $this->load->view('left_sidebar_es');
} else{
	$is_emp_first_login = $this->session->userdata('emp_first_login');
?>  
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar hidden-print">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if (!empty($this->session->userdata('emp_image'))) { ?>
                    <img src="<?php echo USR_IMG_PATH ?><?php echo $this->session->userdata('emp_image') ?>" class="img-circle" alt="User Image" />
                <?php
                } else {
                    ?>
                    <img src="<?php echo ADMIN_THEME_PATH; ?>dist/img/avatar5.png" class="img-circle" alt="User Image" />
                <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?php echo $this->session->userdata('emp_full_name_hi'); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i><?php echo $this->session->userdata('emp_unique_id'); ?> </a>
                <a href="#"><?php echo $this->session->userdata('user_designation_name_hi'); ?></a><br/>
                <a href="#">भुमिका:- <?php echo $this->session->userdata('user_role_name_hi'); ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <?php if($is_emp_first_login==1){ ?>
        <br/>
		<ul class="sidebar-menu">
            <li class="header bg-red"><span class="pull-left">मेनू</span>  <span class="pull-right" id="counter"></span></li>
            <!-- Optionally, you can add icons to the links -->
            <?php if($userrole == '38') { ?>
                <li <?php if ($this->uri->segment(1) == 'data_entry') { echo 'class="active"'; } ?>><a href="<?php echo base_url(); ?>data_entry"><i class="fa fa-plus"></i> <span>Add File Data</span></a></li>
                <li <?php if ($this->uri->segment(2) == 'display_file_data') { echo 'class="active"'; } ?>><a href="<?php echo base_url();?>data_entry/display_file_data"><i class="fa  fa-building-o"></i> <span>Display File List</span></a></li>
            <?php } ?>
            <?php //if (in_array($userrole, array(1,3,4,5)) ){ ?>
                <li>
                    <a href="http://10.115.254.213/lms" data-original-title="Leave" data-toggle="tooltip"><i class="fa fa-dashboard"></i> <span>अवकाश पोर्टल</span></a>
			   </li>
				<li <?php if ($this->uri->segment(1) == 'dashboard') { echo 'class="active"'; } ?>>
               <a href="<?php echo base_url(); ?>dashboard" data-original-title="Dashboard" data-toggle="tooltip"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
			   </li>
			    <li class="googlevoic">
					<a href="<?php echo base_url();?>draft/voic_input" target="_blank" ><i class="fa fa-volume-up"></i> <span>हिंदी /इंग्लिश बोलें</span></a>										
			   </li>
            <?php //} ?>
          
            <?php if (in_array($userrole, array(1,3,4,5)) ){?>
				<?php if($userrole == '3') { ?>
				 <li class="active"><a href="<?php echo base_url('admin');?>/employees"><i class="fa fa-users"></i> <span>कर्मचारी</span></a></li> 
			 <?php } ?>
			<li class="header bg-aqua">Common Navigation</li>
                <li <?php if ($this->uri->segment(1) == 'user_activity' OR $this->uri->segment(1) == 'activity_details') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url(); ?>user_activity" data-original-title="User Activity" data-toggle="tooltip"><i class='fa fa-link'></i> <span>  <?php echo $this->lang->line('user_activity_menu'); ?></span> <i class="fa fa-angle-left pull-right"></i></a>
                </li>
                <li <?php if ($this->uri->segment(2) == 'department_structure') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('admin');?>/department_structure" data-original-title="Department Structure" data-toggle="tooltip"><i class="fa fa-tree"></i> <span><?php echo $this->lang->line('department_structure'); ?></span></a>
                </li>
            <?php } ?>
			<?php $upper_officer=array('3','4','5','6','7');?>
			<?php if(in_array($userrole,$upper_officer)){ ?>
			<li <?php if ($this->uri->segment(1) == 'pa' OR $this->uri->segment(1) == 'pa') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>pa/list" title="Show Personal Assistant List"><i class="fa fa-user"></i>
					<span>
						<?php echo $this->lang->line('permission_allote_to_pay');?>
					</span>
				</a>
			</li>
			<?php } ?>
            <?php if($userrole==8 || $userrole==37 || $userrole==14 || $userrole==5 || $userrole==4 || $userrole==11){?>
                <li>
                    <a href="<?php echo base_url();?>permission/allot" title="संबंधित सहायक को अनुमति प्रदान करें"><i class="fa fa-file-text"></i>
					<span>
						<?php echo $this->lang->line('label_endm_allot_permission_to_da');?>
					</span>
                    </a>
                </li>
            <?php } ?>
             <?php if( $emp_section == 11 || $emp_section == 12 || $emp_section == 45 ){?>
                <li class="header bg-aqua  bg-aqua">जी.पी./ए.जी.पी./स्थायी अधिवक्ता/नोटरी/अन्य</li>
					<li> <a href="<?php echo base_url().'advocate/report'; ?>"><i class='fa fa-link'></i> <span title="अधिवक्ता रिपोर्ट"> अधिवक्ता रिपोर्ट </span> </a></li>
					<li class="treeview">
						<a href="#"><i class='fa fa-link'></i> <span title="जी.पी./ए.जी.पी./स्थायी अधिवक्ता/नोटरी/अन्य">जी.पी./ए.जी.पी./अन्य  जोड़ें</span> <i class="fa fa-angle-left pull-right"></i></a>
						
						<ul class="treeview-menu menu-open">
							<?php $advo_notary_list = get_advo_notary_list();
								foreach($advo_notary_list as $adv_not_list){
							
								 if(( $this->session->userdata('emp_id') ==  45) &&  ($adv_not_list['adm_id'] == 1 || $adv_not_list['adm_id'] == 2)){ // 9 ko hatya gya hai
									 
								 	
									?>
									<li>
										<table style="width:100%" border="0">
											<tr>
												<td style="text-align:left;border:none;"><a href="#"><?php echo $adv_not_list['adm_name']; ?></a></td>
												<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/add/<?php echo $adv_not_list['adm_id'];?>"><i class="fa fa-plus-square"></i><?php echo ' जोंडे' ;?></a></td>
												<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/list/<?php echo $adv_not_list['adm_id'];?>"><i class="fa fa-eye"></i><?php echo ' देंखे';?></a></td>
											</tr>
										</table>									
									</li>								
									<?php } 
									else if(($this->session->userdata('emp_id') == 60 || $this->session->userdata('emp_id') == 58) &&  ($adv_not_list['adm_id'] == 4)){ // 9 ko hatya gya hai
									?>
									<li>
										<table style="width:100%" border="0">
											<tr>
												<td style="text-align:left;border:none;"><a href="#"><?php echo $adv_not_list['adm_name']; ?></a></td>
												<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/add/<?php echo $adv_not_list['adm_id'];?>"><i class="fa fa-plus-square"></i><?php echo ' जोंडे' ;?></a></td>
												<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/list/<?php echo $adv_not_list['adm_id'];?>"><i class="fa fa-eye"></i><?php echo ' देंखे';?></a></td>
											</tr>
										</table>									
									</li>								
									<?php } ?>
								<?php } ?>
								<li style="clear:both;">
									<table style="width:100%" border="0">
										<tr>
											<td style="text-align:left;border:none;"><a href="#"><?php echo 'नियुक्तिया'; ?></a></td>
											<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/post/add"><i class="fa fa-plus-square"></i><?php echo ' जोंडे' ;?></a></td>
											<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/post?advocat_type=<?php echo $adv_not_list['adm_name'];?>"><i class="fa fa-eye"></i><?php echo ' देंखे';?></a></td>
										</tr>
									</table>									
								</li>
						</ul>	
					</li>
	<?php } ?>
            <?php //$this->load->view('sidebars/sidebar_' . $userrole); ?>
            <li class="header bg-aqua">Files Navigation</li>
            <?php $this->load->view('sidebars/ftms_sidebar'); ?>
	    <!-- efile side menu start -->
        <?php $emp_role_levele = get_emp_role_levele();  if($emp_role_levele['emprole_level'] != 14){?>
            <?php  if($efile == 'efile'){ ?>
                <li class="header bg-aqua">E-File Electronic</li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'draft') { echo 'class="active"'; } ?>">
                    <a href="#">
                        <i class="fa fa-folder-open text-green"></i> <span>E-File</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu menu-open" style="display: block;">
                        <?php $count_efiles = json_decode(modules::run('e_filelist/ajax_count_inbox_second', true),true);?>
                        <li><a href="<?php echo base_url(); ?>e-files/inbox"><i class="fa fa-folder-o"></i> अंकित ई-फ़ाइलें (Inbox)  <span class="label label-primary pull-right" id="total_einbox"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[1];}else{ echo 0;}?></span></a></li>
                        <li><a href="<?php echo base_url(); ?>e-files/working"><i class="fa fa-folder-o"></i> कार्यरत ई-फाइलें  (WIP) <span class="label label-primary pull-right" id="total_eworking"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[0];}else{ echo 0;}?></span></a></li>
                        <li><a href="<?php echo base_url(); ?>e-files/sent"><i class="fa fa-folder-o"></i> भेजी गई ई-फ़ाइलें (Sent)  <span class="label label-primary pull-right" id="total_esent"><?php  if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[2];}else{ echo 0;}?></span></a></li>
                    </ul>
                </li>
				<?php if( ($emp_role_levele['emprole_level'] == 7 || $emp_role_levele['emprole_level'] == 6 || $emp_role_levele['emprole_level'] <= 5) && $userrole!='25' ){ ?>
				<li>
                    <a href="<?php echo base_url(); ?>e-files/efile_sign" data-original-title="Sign" data-toggle="tooltip"><i class="fa fa-edit text-aqua"></i> <span>फ़ाइल पर हस्ताक्षर जोड़ें  </span><span class="label label-primary pull-right" id="total_eworking"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[0];}else{ echo 0;}?></span></a> 
                </li>
				<?php } ?>
                <li <?php if ($this->uri->segment(1) == 'draft') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url(); ?>draft" data-original-title="Draft" data-toggle="tooltip"><i class="fa fa-file-word-o"></i> <span>ड्राफ्ट</span></a>
                </li>
				
            <?php }else{ ?>
                <li class="header bg-aqua">E-File Electronic</li>
                <li class="treeview" title="Not Active">
                    <a href="#">
                        <i class="fa fa-folder-open text-green"></i> <span>E-File</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu menu-open" style="display: block;">
                        <li><a href="javascript:void(0)"><i class="fa fa-folder-o"></i> अंकित ई-फ़ाइलें (Inbox)</a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-folder-o"></i> कार्यरत ई-फाइलें  (WIP) </a></li>
                        <li><a href="javascript:void(0)"><i class="fa fa-folder-o"></i> भेजी गई ई-फ़ाइलें (Sent)</a></li>
                    </ul>
                </li>
                <li title="Not Active">
                    <a href="javascript:void(0)" data-original-title="Draft" data-toggle="tooltip"><i class="fa fa-file-word-o"></i> <span>ड्राफ्ट</span></a>
                </li>
            <?php } ?>
        <?php } ?>
            <!-----efile side menu end---->

			 <li class="header bg-aqua">Reporting</li>
			
		<li <?php if ($this->uri->segment(2) == 'file_search') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url(); ?>view_file/file_search"><i class="fa fa-search"></i> <span>फाइल खोजें</span></a>
			</li>
			<?php if($userrole != '9' && $userrole != '1' && $userrole != '2'&& $userrole != '12'&& $userrole != '25'&& $userrole != '13') {?>
                <li <?php if ($this->uri->segment(2) == 'files') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>moniter/files"><i class="fa fa-long-arrow-up" style="width:10px"></i><i  class="fa  fa-long-arrow-down"></i> <span>अंकित / भेजी  नस्तीयां</span></a></li>    
	 <?php }?>
            <?php if (in_array($userrole, array(1,2,3,4,5)) ){ ?>
                <li <?php if ($this->uri->segment(1) == 'reports') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>reports"><i class="fa fa-desktop"></i> <span>रिपोर्टिंग</span></a></li>
            <?php }else{ ?>
				<li <?php if ($this->uri->segment(1) == 'reports') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>reports"><i class="fa fa-desktop"></i> <span>रिपोर्टिंग</span></a></li>
			<?php }?>
            <?php
			$emp_ses_id = emp_session_id();
            $empssection = empdetails($emp_ses_id);
          
            if($empssection[0]['role_id']==3) { ?>
                <li <?php if ($this->uri->segment(2) == 'files') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url(); ?>ps_file_monitor"><i class="fa fa-fw fa-eye"></i> <span>पी .एस. मॉनिटर फ़ाइलें</span></a>
                </li>
            <?php } else if($userrole==3){ ?>
                <li <?php if ($this->uri->segment(2) == 'files') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url(); ?>ps_file_monitor"><i class="fa fa-fw fa-eye"></i> <span>पी .एस. मॉनिटर फ़ाइलें</span></a>
                </li>
            <?php }else{
                if(show_view_as_lvl()!='404'){
                    $is_file_alloted= check_ps_monitor_file_is_alloted('count',$this->session->userdata("emp_id"));
                    if($is_file_alloted>0 && $empssection[0]['role_id']!=9){?>
                        <li <?php if ($this->uri->segment(2) == 'files') { echo 'class="active"'; } ?>>
                            <a href="<?php echo base_url(); ?>ps_file_monitor?empid=<?php echo $this->session->userdata("emp_id"); ?>"><i class="fa fa-fw fa-eye"></i> <span>पी .एस. मॉनिटर फ़ाइलें</span></a>
                        </li>
                    <?php 			}
                }
            }
            ?>
			
			<!--Extra Permission menu-->
			<?php 	$logged_emp_permission = check_pa_is_any_permission(null,null); 
					//($logged_emp_is_permission);
					$logged_emp_is_permission= get_list_with_column(EMPLOYEE_PERMISSION_ALLOTED,'emp_id_assign_by,emp_id_assign_to,epa_section_id,epa_designation_id',null,array('emp_id_assign_to'=>$this->session->userdata("emp_id"),'epa_module_name'=>'files'));
					if(count($logged_emp_is_permission)>0){
						if($logged_emp_is_permission['epa_section_id']!='' || $logged_emp_is_permission['epa_section_id']!=0){
							$permission_empid= $logged_emp_is_permission['emp_id_assign_by'];
							$sql="SELECT emp.emp_id,concat(emp.emp_full_name,' - ',emp.emp_full_name_hi) as empname, 
								concat(rolemaster.emprole_name_en,' - ',rolemaster.emprole_name_hi) as rolename, 
								concat(section.section_name_en,' - ',section.section_name_hi) as section_name 
								FROM `ft_employee` as emp inner join ft_emprole_master as rolemaster 
								on rolemaster.role_id=emp.designation_id 
								inner join ft_sections_master as section on section.section_id=emp.emp_section_id 
								WHERE emp.emp_id=$permission_empid and emp.emp_status=1 and emp.emp_is_retired=0";
								$permission_alloted_empdetail=get_row($sql);
						}else if($logged_emp_is_permission['epa_designation_id']!='' || $logged_emp_is_permission['epa_designation_id']!=0){
							
							
						}
						$so= explode('-',$permission_alloted_empdetail['rolename']);
						if($so[1]==2){
							$so[1]='प्रभारी';
						}
						
						$log_message= ' दिनांक  '.date('Y-m-d').' को '.$this->session->userdata('emp_full_name').'(emp id-'.$this->session->userdata('emp_id').')'.' , '.$permission_alloted_empdetail['empname'].'('.$so[1].')'.'का  कार्य कर रहें थें';
						$today_permision_array=array('today_permission_given_empid'=>$logged_emp_is_permission['emp_id_assign_by'],
												'today_permission_given_secid'=>$logged_emp_is_permission['epa_section_id'],
												'today_permission_given_desigid'=>$logged_emp_is_permission['epa_designation_id'],
												'message'=>$log_message,
						);
						$this->session->set_userdata(array('today_permission_assign'=>$today_permision_array));
					}else{
						$this->session->unset_userdata('today_permission_assign');
					}
					
				if(count($logged_emp_is_permission)>0){ ?>
                  <?php  if($userrole != '25' && $userrole != '12' && $userrole != '13') {?>
				<li class="header bg-aqua">Other Files Work</li>
				<li <?php if ($this->uri->segment(1) == 'today') { echo 'class="active"'; } ?> title="<?php echo $this->lang->line('da_SOfile_title_1').$permission_alloted_empdetail['empname'].'('.$so[1].')'.$this->lang->line('da_SOfile_title_2') ; ?>"><a href="<?php echo base_url();?>today/files/"><i class="fa  fa-building-o"></i> <span><?php echo $so[1]; ?> फाइलें</span></a></li>
			<?php }} ?>


<!--Officer Menu for AGP/GP-->
			 <?php if(in_array($userrole, array(5,3,1,2)) && ($this->session->userdata('emp_id')==253 || $this->session->userdata('emp_id')==264 || $this->session->userdata('emp_id')==1)){?>
				<li class="header bg-aqua">जी.पी./ए.जी.पी./स्थायी अधिवक्ता/नोटरी/अन्य</li>						
					<ul class="treeview-menu menu-open" style="display: block;">
						<li style="clear:both;">
							<table style="width:100%" border="0">
								<tbody>
								<tr>
									<td style="text-align:left;border:none;"><a href="#">जी.पी </a></td>
									<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/list/1"><i class="fa fa-plus-square"></i>सूचीं देखें</a></td>
									<!--<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/repor_view/1"><i class="fa fa-eye"></i> रिपोर्टिंग देंखे</a></td>-->
								</tr>
								<tr>
									<td style="text-align:left;border:none;"><a href="#">ए.जी.पी</a></td>
									<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/list/2"><i class="fa fa-plus-square"></i>सूचीं देखें</a></td>
									<!--<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/repor_view/2"><i class="fa fa-eye"></i> रिपोर्टिंग देंखे</a></td>-->
								</tr>
								<tr>
									<td style="text-align:left;border:none;"><a href="#">नोटरी </a></td>
									<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/list/4"><i class="fa fa-plus-square"></i>सूचीं देखें</a></td>
									<!--<td style="text-align:right;border:none;"><a href="<?php echo base_url();?>advocate/repor_view/2"><i class="fa fa-eye"></i> रिपोर्टिंग देंखे</a></td>-->
								</tr>
							</tbody></table>									
						</li>
					</ul>						
			
			<?php } ?>	
			<!--End Officer Menu for AGP/GP -->

















			<li class="header bg-aqua">Miscellaneous</li>
			<?php  if( in_array($this->session->userdata('emp_id'), array(30,31,54,169))){ ?>
			<li <?php if ($this->uri->segment(1) == 'update_file') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url('update_file');?>"><i class="fa fa-thumb-tack"></i> <span>Update file</span></a>
			</li> 
			<?php } ?>
			<li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url();?>est_service_module" title="Establishment create file"><i class="fa fa-file-o"></i> <span>स्थापना  प्रपत्र</span></a>
            </li> 
			<li <?php if ($this->uri->segment(2) == 'add_complaints') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url('establishment');?>/add_complaints"><i class="fa fa-thumb-tack"></i> <span>आवेदन</span></a>
			</li>
			<!--End Extra Permission menu-->

			<?php if (isset($userrole) && $userrole == '8'){
			?>
			<li <?php if ($this->uri->segment(1) == 'dealing_assistant') { echo 'class="active"'; } ?>>
			<a href="<?php echo base_url();?>dealing_assistant" title="Dealing Assistant List"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('dealing_assistant_manue');?></span></a></li>
			<?php } ?>
			<!-- End show all Dealing Assistant List show only so -->
			<li <?php if ($this->uri->segment(1) == 'send_file_return') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>send_file_return"><i class="fa fa-reply"></i> <span>फाइल वापस ले</span></a>
			</li>
			<?php if(show_view_as_lvl()!='404'){?>
			<li <?php if ($this->uri->segment(1) == 'dashboard') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>dashboard"><i class="fa fa-file-text"></i> <span>फाइल  का  एकीकरण </span></a>
			</li>
			<li <?php if (isset($_GET['task']) && $_GET['task'] == 'reopen') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>view_file/file_search?task=reopen"><i class="fa fa-file-text"></i> <span>फाइल को पुनः खोलें </span></a>
			</li>
			<?php } ?>
			<li <?php if ($this->uri->segment(1) == 'suggestions' ) { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>suggestions"><i class="fa fa-newspaper-o"></i> <span>सुझाव </span></a>
			</li>
			

			<!--End Extra Permission menu-->


        </ul><!-- /.sidebar-menu -->
<?php } ?>
    </section>
    <!-- /.sidebar -->
</aside><?php } ?>
<script> 

var HTTP_PATH='<?php echo base_url(); ?>';
$(document).ready(function() {	
	$.ajax({
		url: HTTP_PATH + "e_filelist/ajax_count_inbox_second",
		datatype: "json",
		async: true,
		data: {section_id: ''},
		success: function(data){
			var r_data = JSON.parse(data);
			$("#total_eworking").text(r_data[0]);
			$("#total_einbox").text(r_data[1]);
			$("#total_esent").text(r_data[2]);
			$("#hidden_count_inbox").val(r_data[1]);
		
		}
	});
});
function count_efile() {
	var get_inbox_number = $("#hidden_count_inbox").val();
	$.ajax({
		url: HTTP_PATH + "e_filelist/ajax_count_inbox_second",
		datatype: "json",
		async: true,
		data: {section_id: ''},
		success: function(data){
			var r_data = JSON.parse(data);
			$("#total_eworking").text(r_data[0]);
			$("#total_einbox").text(r_data[1]);
			$("#total_esent").text(r_data[2]);
			if(r_data[1]>get_inbox_number){
				$(".play").click();
				$("#hidden_count_inbox").val(r_data[1]);
			}else{
				$("#hidden_count_inbox").val(r_data[1]);				
			}
		}
	});
}
function check_sign_data_response() {
	$.ajax({
		url: HTTP_PATH + "sign.php",
		datatype: "json",
		async: true,
		data: {section_id: ''},
		success: function(data){

			console.log(data);
		}
	});
}

/*Check browser tab is active or not*/
var vis = (function(){
    var stateKey, eventKey, keys = {
        hidden: "visibilitychange",
        webkitHidden: "webkitvisibilitychange",
        mozHidden: "mozvisibilitychange",
        msHidden: "msvisibilitychange"
    };
    for (stateKey in keys) {
        if (stateKey in document) {
            eventKey = keys[stateKey];
            break;
        }
    }
    return function(c) {
        if (c) document.addEventListener(eventKey, c);
        return !document[stateKey];
    }
})();
/*var visible = vis(); 
vis();
vis(function(){
  
});*/
$(window).on("focus", function(e) {
    var prevType = $(this).data("prevType");
    if (prevType != e.type) {   
        switch (e.type) {            
            case "focus":
                setInterval("count_efile()", 120000);
                
                break;
        }
    }
    $(this).data("prevType", e.type);
})
</script>