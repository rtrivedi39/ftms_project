<?php $userrole = checkUserrole();
$login_emp_section=$this->session->userdata('emp_section_id');
$efile = show_efile_section($login_emp_section);?>
<!-- Left side column. contains the logo and sidebar -->
<?php 
$is_emp_first_login = $this->session->userdata("emp_first_login");
?>
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
                <p><?php echo ucfirst($this->session->userdata('emp_full_name')); ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i><?php echo $this->session->userdata('emp_unique_id'); ?> </a>
                <a href="#"><?php echo $this->session->userdata('user_designation_name_hi'); ?></a><br/>
                <a href="#">भुमिका:- <?php echo $this->session->userdata('user_role_name_hi'); ?></a>
            </div>
        </div>

        <?php if($is_emp_first_login==1){ ?>
		<br/>
        <ul class="sidebar-menu">
            <li class="header bg-red"><span class="pull-left">मेनू</span>  <span class="pull-right" id="counter"></span></li>
                <li>
                    <a href="http://10.115.254.213/lms" data-original-title="Leave" data-toggle="tooltip"><i class="fa fa-dashboard"></i> <span>अवकाश पोर्टल</span></a>
			   </li>
				<li <?php if ($this->uri->segment(1) == 'dashboard') { echo 'class="active"'; } ?>>
					<a href="<?php echo base_url(); ?>" data-original-title="Dashboard" data-toggle="tooltip"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
				 <li class="googlevoic">
					<a href="<?php echo base_url();?>draft/voic_input" target="_blank" ><i class="fa fa-volume-up"></i> <span>हिंदी /इंग्लिश बोलें</span></a>
			   </li>
			<!--IT incharge Menu-->
			<?php if(($userrole=='37' && $login_emp_section='7,25') || ($this->session->userdata("emp_id") == 44)){ ?>
			<li pre($userrole); <?php if ($this->uri->segment(1) == 'notice') { echo 'class="active"'; } ?>>
               <a href="<?php echo base_url(); ?>admin/notice" data-original-title="Dashboard" data-toggle="tooltip"><i class="fa fa-file-text"></i> <span>Manage Notice</span></a>
			</li>
			<?php } ?>
			<!--IT incharge Menu End-->

            <?php if($userrole<=8){?>
                <li>
                    <a href="<?php echo base_url();?>permission/allot" title="संबंधित सहायक को अनुमति प्रदान करें"><i class="fa fa-file-text"></i>
					<span>
						<?php echo $this->lang->line('label_endm_allot_permission_to_da');?>
					</span>
                    </a>
                </li>
                <li class="">
					 <a href="<?php echo base_url('admin');?>/notice"><i class="fa fa-users"></i> <span>नोटिस</span></a>
				</li>
            <?php } ?>
			
            <?php //$this->load->view('sidebars/sidebar_' . $userrole); ?>
            <li class="header bg-aqua">Files Navigation</li>
            <li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url('establishment');?>/create_form/index/p" title="Establishment create file"><i class="fa fa-file-o text-yellow"></i> <span>फाइल/ पत्र जोड़े</span></a>
            </li>
			<li class="treeview <?php if (($this->uri->segment(2) == 'view_file_es' || $this->uri->segment(2) == 'view_file_es' ) && $this->uri->segment(1) == 'establishment') { echo 'active'; } ?>">
              <a href="#">
                <i class="fa fa-folder-open text-yellow"></i>
                <span><?php echo "फाइल/ पत्र देखे ";?></span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu menu-open" style="display: block;">
                <li <?php  echo $this->uri->segment(2) == 'view_file_es' && $this->uri->segment(3) == '' ? 'class="active"' : '' ;  ?>>
                    <a href="<?php echo base_url('establishment'); ?>/view_file_es"><i class="fa fa-file-text-o"></i>सभी फाइले/आवेदन देखे</a>
                </li>
                  <li <?php  echo $this->uri->segment(2) == 'view_file_es' && $this->uri->segment(4) == 'cr' ? 'class="active"' : '' ;  ?>>
					<a href="<?php echo base_url('establishment');?>/view_file_es/index/cr"><i class="fa fa-file-text-o"></i>आवक से आयी फाइलें / पत्र </a>
				</li>
                <li <?php  echo $this->uri->segment(3) == 'marked_da_file' ? 'class="active"' : '' ;  ?>>
					<a href="<?php echo base_url('establishment'); ?>/est_files/marked_da_file?type=p" data-original-title="फाइल का स्थापना शाखा में  आवागमन " data-toggle="tooltip" ><i class="fa fa-file-text-o"></i>स्थापना शाखा में बनाई फाइलें / पत्र </a>
				</li>
                <li <?php  echo $this->uri->segment(4) == 'return' ? 'class="active"' : '' ;  ?>>
					<a href="<?php echo base_url('establishment'); ?>/view_file_es/index/return"><i class="fa fa-file-text-o"></i> अधिकारी द्वारा आई फाइलें / पत्र </a>
				</li>
                <li <?php  echo $this->uri->segment(2) == 'complaints' ? 'class="active"' : '' ;  ?>>
					<a href="<?php echo base_url('establishment'); ?>/complaints"><i class="fa fa-file-text-o"></i>किये हुए आवेदन</a>
				</li>
              </ul>
            </li>

			    <!-----efile side menu start---->
        <?php $emp_role_levele = get_emp_role_levele();  if($emp_role_levele['emprole_level'] != 14){?>
            <?php  if($efile == 'efile'){ ?>
                <li class="header bg-aqua">E-File Electronic</li>
				<li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
					<a href="<?php echo base_url('establishment');?>/create_form/index/e" title="Establishment create file"><i class="fa fa-file-o text-green"></i> <span> इ - फाइल/ पत्र जोड़े</span></a>
				</li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'draft') { echo 'class="active"'; } ?>">
                    <a href="#">
                        <i class="fa fa-folder-open text-green"></i> <span>E-File</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu menu-open" style="display: block;" >
                        <?php $count_efiles = json_decode(modules::run('e_filelist/ajax_count_inbox', true),true);?>
                        <li><a href="<?php echo base_url(); ?>e-files/inbox"><i class="fa fa-folder-o"></i> अंकित ई-फ़ाइलें (Inbox)  <span class="label label-primary pull-right" id="total_einbox"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[1];}else{ echo 0;}?></span></a></li>
                        <li><a href="<?php echo base_url(); ?>e-files/working"><i class="fa fa-folder-o"></i> कार्यरत ई-फाइलें  (WIP) <span class="label label-primary pull-right" id="total_eworking"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[0];}else{ echo 0;}?></span></a></li>
                        <li><a href="<?php echo base_url(); ?>e-files/sent"><i class="fa fa-folder-o"></i> भेजी गई ई-फ़ाइलें (Sent)  <span class="label label-primary pull-right" id="total_esent"><?php  if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[2];}else{ echo 0;}?></span></a></li>
                    </ul>
                </li>
                <?php if( $emp_role_levele['emprole_level'] <= 7 && $userrole!='25' ){ ?>
				<li>
                    <a href="<?php echo base_url(); ?>e-files/efile_sign" data-original-title="Sign" data-toggle="tooltip"><i class="fa fa-edit text-aqua"></i> <span>फ़ाइल पर हस्ताक्षर जोड़ें  </span><span class="label label-primary pull-right" id="total_eworking"><?php if(isset($count_efiles) && !empty($count_efiles)){echo $count_efiles[0];}else{ echo 0;}?></span></a> <!--fa-file-word-o-->
                </li>
				<?php } ?>
                <li <?php if ($this->uri->segment(1) == 'draft') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url(); ?>draft" data-original-title="Draft" data-toggle="tooltip"><i class="fa fa-file-word-o"></i> <span>ड्राफ्ट</span></a>
                </li>
            <?php }else{ ?>
                <li class="header bg-aqua">E-File Electronic</li>
				 <li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
					<a href="<?php echo base_url('establishment');?>/create_form/index/e" title="Eshtablishment create file"><i class="fa fa-users"></i> <span> इ - फाइल/ पत्र जोड़े</span></a>
				</li>
                <li class="treeview" title="Not Active">
                    <a href="#">
                        <i class="fa fa-folder-open text-green"></i> <span>E-File</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu " >
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
				<a href="<?php echo base_url();?>reports""><i class="fa fa-desktop"></i> <span>रिपोर्टिंग</span></a></li>
			<?php }?>
        <?php 
        /// condition check for eslogin user
		$bb = check_est_so();

			
		$workemp= fetch_alloted_work(158);
		foreach($workemp as $wrow){ 
		if($this->session->userdata('emp_id') == $wrow['est_word_alloted_emp_id'])
		{
			$wr= 1;
			
		}else{$wr= 0;}
		}
		
        if( $wr == 1 || $bb ==1 ) {
		
			?>
        <li class="header bg-aqua">Salary </li>
                <li class="treeview" title="Not Active">
                    <a href="#">
					
                        <i class="fa fa-shopping-cart"></i> <span>वेतन </span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu " >
                            <li><a href="<?php echo base_url(); ?>payroll/allcate"><i class="fa fa-folder-o"></i> वेतन मास्टर </a></li>
           <li><a href="<?php echo base_url(); ?>payroll/dpfslip"><i class="fa fa-folder-o"></i>  डी पी स्लिप </a></li>
   
		   <!--             <li><a href="<?php echo base_url(); ?>payroll/addallsallary"><i class="fa fa-folder-o"></i> वेतन जोड़ें </a></li>
                         <li><a href="<?php echo base_url(); ?>payroll/payarriyars"><i class="fa fa-folder-o"></i> एरीयस जोड़ें </a></li>
                   <li><a href="<?php echo base_url(); ?>payroll/addsalryonmaster"><i class="fa fa-folder-o"></i>   मास्टर मे वेतन जोड़े </a></li>
                    
                 -->
<!-- 
                    <li><a href="<?php echo base_url(); ?>payroll/paydiduction"><i class="fa fa-folder-o"></i> वेतन कटोती  </a></li>
                     <li><a href="<?php echo base_url(); ?>payroll/paydiduction_paper"><i class="fa fa-folder-o"></i> वेतन कटोती पत्रक</a></li>
  <li><a href="<?php echo base_url(); ?>payroll/alladvnce"><i class="fa fa-folder-o"></i>  अग्रमी </a></li>
                          -->
                
                    <li><a href="<?php echo base_url(); ?>payroll/paybillno"><i class="fa fa-folder-o"></i> बिल नंबर जोड़ें </a></li>
              
                        <li><a href="<?php echo base_url(); ?>payroll/register"><i class="fa fa-folder-o"></i> वेतन रजिस्टर</a></li>
                       <li><a href="<?php echo base_url(); ?>payroll/payslipall"><i class="fa fa-folder-o"></i> वेतन पर्ची क्लास 4 </a></li>
                        <li><a href="<?php echo base_url(); ?>payroll/payslip"><i class="fa fa-folder-o"></i> वेतन पर्ची </a></li>
                    </ul>
                </li>
				
    <li class="header bg-aqua">Salary master </li>
                <li class="treeview" title="Not Active">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i> <span> वेतन डैशबोर्ड </span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu " >
                              <li><a href="<?php echo base_url(); ?>payroll/master"><i class="fa fa-folder-o"></i>वेतन डैशबोर्ड </a></li>
					<!--  <li><a href="<?php echo base_url(); ?>payroll/payconsdiertime"><i class="fa fa-folder-o"></i>समयमान वेतन </a></li> -->

                     <li><a href="<?php echo base_url(); ?>payroll/addempincate"><i class="fa fa-folder-o"></i>कर्मचारी & वेतन हेड</a></li>
                  
                        <li><a href="<?php echo base_url(); ?>payroll/add_incrementmonth"><i class="fa fa-folder-o"></i>कर्मचारी वेतन वृद्धि माह </a></li>
                           <!--   <li><a href="<?php echo base_url(); ?>payroll/autoincremrnt"><i class="fa fa-folder-o"></i> वेतन वृद्धि  </a></li>

                        <li><a href="<?php //echo base_url(); ?>payroll/editda"><i class="fa fa-folder-o"></i> कर्मचारी डी.ए  मास्टर </a></li>
                         --> <li><a href="<?php echo base_url(); ?>payroll/allheads"><i class="fa fa-folder-o"></i> वेतन हेड </a></li>
                            
                          <li><a href="<?php echo base_url(); ?>payroll/pan_adhar_house"><i class="fa fa-folder-o"></i> पेन /  आधार / मकान नंबर जोड़े </a></li>
						  <!--  <li><a href="<?php echo base_url(); ?>admin_employee_vechilde"><i class="fa fa-folder-o"></i> मोबाइल  नंबर जोड़े </a></li> -->
<!-- <li><a href="<?php echo base_url(); ?>payroll/backdatesalary"><i class="fa fa-folder-o"></i> पुराने माह का वेतन </a></li>

                         <li><a href="<?php echo base_url(); ?>payroll/allfixstion"><i class="fa fa-folder-o"></i>  वेतन फिक्सेशन </a></li>
                         
                         <li><a href="<?php echo base_url(); ?>payroll/salaryfixation"><i class="fa fa-folder-o"></i> कर्मचारी वेतन फिक्सेशन </a></li>
-->

    </ul>
                </li>
        <?php } ?>
            <!-----Salary menu end---->

<?php 
			 if(show_view_as_lvl()!='404'){
                    $is_file_alloted= check_ps_monitor_file_is_alloted('count',$this->session->userdata("emp_id"));
                    if($is_file_alloted>0 && $empssection[0]['role_id']!=9){?>
                        <li <?php if ($this->uri->segment(2) == 'files') { echo 'class="active"'; } ?>>
                            <a href="<?php echo base_url(); ?>ps_file_monitor?empid=<?php echo $this->session->userdata("emp_id"); ?>"><i class="fa fa-fw fa-eye"></i> <span>पी .एस. मॉनिटर फ़ाइलें</span></a>
                        </li>
                    <?php 			}
                } ?>
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
							//$get_permission_allot_section_desig=get_list_with_column(EMPLOYEEE_ROLE,'emprole_name_hi,emprole_name_en',null,array('epa_designation_id'=>$logged_emp_is_permission['epa_designation_id']));
							
						}
						$so= explode('-',$permission_alloted_empdetail['rolename']);
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
					//pre($permission_alloted_empdetail);
				if(count($logged_emp_is_permission)>0){ ?>
                  <?php  if($userrole != '25' && $userrole != '12' && $userrole != '13') {?>
				<li class="header bg-aqua">Other Files Work</li>
				<li <?php if ($this->uri->segment(1) == 'today') { echo 'class="active"'; } ?> title="<?php echo $this->lang->line('da_SOfile_title_1').$permission_alloted_empdetail['empname'].'('.$so[1].')'.$this->lang->line('da_SOfile_title_2') ; ?>"><a href="<?php echo base_url();?>today/files/	"><i class="fa  fa-building-o"></i> <span><?php echo $so[1]; ?> फाइलें</span></a></li>
			<?php }} ?>
           <li class="header bg-aqua">Miscellaneous</li>
			<?php if(check_est_so()) { ?>

			<li <?php if ($this->uri->segment(2) == 'category' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url('establishment');?>/category/" title="Eshtablishment category"><i class="fa fa-users"></i> <span>शाखा में कार्य के प्रकार</span></a>
            </li>
			<li <?php if ($this->uri->segment(2) == 'work_allote' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url('establishment');?>/work_allote/" title="Eshtablishment allote work"><i class="fa fa-users"></i> <span>सहायक को कार्य आवंटित करें</span></a>
            </li>
			<?php } ?>
			<li <?php if ($this->uri->segment(2) == 'add_complaints') { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url('establishment');?>/add_complaints"><i class="fa fa-thumb-tack"></i> <span>आवेदन</span></a>
			</li>
			
			<li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url();?>est_service_module" title="Establishment create file"><i class="fa fa-file-o"></i> <span>स्थापना प्रपत्र</span></a>
            </li>
            <li <?php if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php echo base_url();?>est_service_module/index/5" title="Establishment create file"><i class="fa fa-file-o"></i> <span>स्थापना कार्य</span></a>
            </li>
            <!--<li <?php // if ($this->uri->segment(2) == 'create_form' && $this->uri->segment(1) == 'establishment') { echo 'class="active"'; } ?>>
                <a href="<?php // echo base_url();?>est_service_module/manage_service_permission/manage_work_allote" title="Establishment create file"><i class="fa fa-file-o"></i> <span>Work Permission</span></a>
            </li>-->

			 
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
			 <li><a href="<?php echo base_url(); ?>admin_employee_vechilde"><i class="fa fa-folder-o"></i> मोबाइल  नंबर जोड़े </a></li>
			<li <?php if ($this->uri->segment(1) == 'suggestions' ) { echo 'class="active"'; } ?>>
				<a href="<?php echo base_url();?>suggestions"><i class="fa fa-newspaper-o"></i> <span>सुझाव </span></a>
			</li>
            </ul><!-- /.sidebar-menu -->
<?php } ?>

    </section>
    <!-- /.sidebar -->
</aside>
