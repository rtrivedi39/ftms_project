<?php $role = checkUserrole(); ?>
<?php $pa_permissions=array();
	  $pa_permissions= check_pa_is_any_permission(null,null); /*Get Logged in user permissions*/
        $section =  $this->session->userdata('emp_section_id');
        $section_array= explode(',',$section);
?>
<?php if($section == 12){ ?>
<li><a href="<?php echo base_url(); ?>advocate/list/"><?php echo "Advocate List"; ?></a></li>
<?php } ?>
<?php if ($role == '1'){?>
		<li class="treeview">
				<a href="#"><i class='fa fa-link'></i> <span>मास्टर्स</span> <i class="fa fa-angle-left pull-right"></i></a>
				<ul class="treeview-menu">
					<li><a href="<?php echo base_url('admin');?>/department"><?php echo $this->lang->line('department_manue');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/district"><?php echo $this->lang->line('district_manue');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/employeerole"><?php echo $this->lang->line('employee_role_manue');?></a></li>
					<li><a href="#"><?php echo $this->lang->line('file_movement_manue');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/sections"><?php echo $this->lang->line('sections_role_manue');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/unit"><?php echo $this->lang->line('unit_level_manue');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/employee_otherwork"><?php echo $this->lang->line('emp_other_work_title_manu');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/notesheet_master_menu"><?php echo $this->lang->line('notesheet_title_type_manu');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/notesheets"><?php echo $this->lang->line('notesheet_title_manu');?></a></li>
					<li><a href="<?php echo base_url('admin');?>/department_posts"><?php echo $this->lang->line('department_post_master_menu_list');?></a></li>
					<li><a href="<?php echo base_url('admin'); ?>/leave_levels"><?php echo $this->lang->line('leave_level_manage_master'); ?></a></li>
					<li><a href="<?php echo base_url('admin'); ?>/heads"><?php echo $this->lang->line('view_heads_menue'); ?></a></li>
					<li><a href="<?php echo base_url(); ?>establishment/category/"><?php echo "स्थापना  श्रेणी"; ?></a></li>
					<li><a href="<?php echo base_url(); ?>advocate/list/"><?php echo "अधिवक्ता सूची "; ?></a></li>
					<li><a href="<?php echo base_url(); ?>sub_file_type"><?php echo "शाखा में नस्ती का उप प्रकार"; ?></a></li>
					<li><a href="<?php echo base_url(); ?>admin/employee_vehicle"><?php echo "कर्मचारी  के  वाहन क्रमांक एवं तेलेफोंर नम्बर"; ?></a></li>
					<li><a href="<?php echo base_url(); ?>admin/teep_list"><?php echo "टीप मास्टर्स "; ?></a></li>
								<li class="header bg-aqua  bg-aqua">जी.पी./ए.जी.पी./स्थायी अधिवक्ता/नोटरी/अन्य</li>
					<li> <a href="<?php echo base_url().'advocate/report'; ?>"><i class='fa fa-link'></i> <span title="अधिवक्ता रिपोर्ट"> अधिवक्ता रिपोर्ट </span> </a></li>
					<li class="treeview">
						<a href="#"><i class='fa fa-link'></i> <span title="जी.पी./ए.जी.पी./स्थायी अधिवक्ता/नोटरी/अन्य">जी.पी./ए.जी.पी./अन्य  जोड़ें</span> <i class="fa fa-angle-left pull-right"></i></a>
						
						<ul class="treeview-menu menu-open">
							<?php $advo_notary_list = get_advo_notary_list();
								foreach($advo_notary_list as $adv_not_list){
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
			<li>
                <a href="<?php echo base_url();?>est_service_module/manage_service_permission/manage_work_allote" title="Establishment create file"><i class="fa fa-file-o"></i> <span>Work Permission</span></a>
            </li>
				</ul>
			</li>
    <li ><a href="<?php echo base_url('admin');?>/employees"><i class="fa fa-users"></i> <span>कर्मचारी</span></a></li>
    <li class=""><a href="<?php echo base_url('admin');?>/notice"><i class="fa fa-users"></i> <span>नोटिस</span></a></li>
<?php } else if ($role == '9'){
    ?>
    <li class=""><a href="<?php echo base_url();?>add_file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
	<!--<li class=""><a href="<?php// echo base_url();?>scan_files"><i class="fa fa-plus"></i> <span>Upload Scan files</span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>-->
    <!--<li class=""><a href="<?php// echo base_url();?>add_scan_files"><i class="fa fa-plus"></i>नई - ई- फ़ाइल जोड़ें <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>-->
    <!-- <li class=""><a href="<?php// echo base_url();?>dashboard/show_file"><i class="fa fa-th"></i> <span>File List</span></a></li>-->
    <li class=""><a href="<?php echo base_url();?>show_file/ALL" title="Display All Files"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('all_files');?></span></a></li>
    <li class=""><a href="<?php echo base_url();?>return_file"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '2'){
    ?>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list"><i class="fa fa-folder-open text-yellow"></i> <span>फाइलें देखें</span></a></li>
<?php
} else if ($role == '3'){
    ?>
    <li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
<?php
} else if ($role == '4'){
    ?>
    <li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '5'){
    ?>
    <li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '6'){
    ?>
	<li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '7'){
    ?>
    <li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '8'){
    ?>  
    <li <?php if ($this->uri->segment(1) == 'view_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file" title="Display Files"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'index') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/index/1" title="सहायक द्वारा अंकित फाइलें"><i class="fa fa-file-text"></i> <span>सहायक द्वारा अंकित फाइलें</span></a></li>
    <?php
    $section_id = getEmployeeSection();
    $section_explode =  explode(',',$section_id);
    if(!in_array('8',$section_explode)) // 8 is dispatch section id.
    { ?>
        <li <?php if ($this->uri->segment(3) == 'return') { echo 'class="active"'; } ?>>
		<a href="<?php echo base_url();?>view_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
    <?php } ?>
<?php
} else if ($role == '10'){
    ?>
    <li <?php if ($this->uri->segment(1) == 'dealing_assistant') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>dealing_assistant" title="Dealing Assistant List"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('dealing_assistant_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(1) == 'view_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file" title="Display Files"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>

<?php
} else if ($role == '11'){
   ?>
    <li <?php if ($this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'Dispaly_list') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '12' || $role == '13' ){
    ?>
	<?php 	//pre($pa_permissions['files']); 
    // if(@$pa_permissions['files']['add']==1){ ?>
    <!--   <li><a href="<?php echo base_url();?>dashboard/add_new_file"><i class="fa fa-file-o"></i> <span>Add file</span></a></li>-->
    <?php// } ?>
    <?php if(@$pa_permissions['files']['received']==1){ ?>
        <li ><a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
        <li ><a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<li <?php if ($this->uri->segment(1) == 'send_file_return') { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url();?>send_file_return"><i class="fa fa-share"></i> <span>फाइल वापस ले</span></a></li>      
	  <?php } ?>
        <?php if(@$pa_permissions['files']['view']==1){ ?>
		
        <li><a href="<?php echo base_url();?>moniter/files"><i class="fa  fa-building-o"></i> <span>फाइल मानीटरिंग</span></a></li>
    <?php } ?>
	<?php if(@$pa_permissions['files']['add']==1){ ?>
			<li class=""><a href="<?php echo base_url();?>add_file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
	<?php } ?>
<?php
} else if ($role == '14'){
    ?>
    <li ><a href="<?php echo base_url();?>dealing_assistant" title="Dealing Assistant List"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('dealing_assistant_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>view_file" title="Display Files"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('view_file_manue');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
    <li ><a href="<?php echo base_url();?>view_file/index/1" title="सहायक द्वारा अंकित फाइलें"><i class="fa fa-file-text"></i> <span>सहायक द्वारा अंकित फाइलें</span></a></li>
    <li ><a href="<?php echo base_url();?>view_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '15'){
    ?>
	<li <?php if ($this->uri->segment(1) == 'dealing_assistant') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>dealing_assistant" title="Dealing Assistant List"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('dealing_assistant_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(1) == 'view_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file" title="Display Files"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('view_file_manue');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
    <li <?php if ($this->uri->segment(3) == '1' && $this->uri->segment(2) == 'index') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/index/1" title="सहायक द्वारा अंकित फाइलें"><i class="fa fa-file-text"></i> <span>सहायक द्वारा अंकित फाइलें</span></a></li>
    <?php
    $section_id = getEmployeeSection();
    $section_explode =  explode(',',$section_id);
    if(!in_array('8',$section_explode)) // 8 is dispatch section id.
    { ?>
        <li <?php if ($this->uri->segment(3) == 'return') { echo 'class="active"'; } ?>>
		<a href="<?php echo base_url();?>view_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
    <?php } ?>
<?php
} else if ($role == '16'){
    ?>
    <li <?php if ($this->uri->segment(2) == 'add_new_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>dashboard/add_new_file"><i class="fa fa-file-o"></i> <span>Add file</span></a></li>


<?php
} else if ($role == '17'){
    ?>
    <li <?php if ($this->uri->segment(2) == 'dealing_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li <?php if ($this->uri->segment(2) == 'add_new_file') { echo 'class="active"'; } ?>>
	<a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
   <!-- <li >
	<a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>
   --> <li >
	<a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '18'){
    ?>
    <li >
	<a href="<?php echo base_url();?>dashboard/add_new_file"><i class="fa fa-file-o"></i> <span>Add file</span></a></li>
<?php
} else if ($role == '19'){
    ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
  <!--  <li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>
  -->  <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
  <!-- <li ><a href="<?php echo base_url();?>drafting/files/index" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span><span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
     <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
     <li ><a href="<?php echo base_url();?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php echo $this->lang->line('document');?></span></a></li>
     <li ><a href="<?php echo base_url();?>view_file/files/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
  -->
 <?php
} else if ($role == '20'){ ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
 <!--   <li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>
 -->   <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '21'){
    ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
    <!--<li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>-->
    <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '22'){
    ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
   <!-- <li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>-->
    <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '23'){
    ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
   <!-- <li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>-->
    <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '24'){
    ?>
    <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
   <!-- <li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>-->
    <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php
} else if ($role == '25'){
    ?>
    <?php if(@$pa_permissions['files']['received']==1){ ?>
        <li ><a href="<?php echo base_url();?>view_file/Dispaly_list" title="Show File List"><i class="fa fa-folder-open text-yellow"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
        <li ><a href="<?php echo base_url();?>view_file/Dispaly_list/1" title="Show Return Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<li <?php if ($this->uri->segment(1) == 'send_file_return') { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url();?>send_file_return"><i class="fa fa-share"></i> <span>फाइल वापस ले</span></a></li>  
  <?php } ?>
    <?php if(@$pa_permissions['files']['view']==1){ ?>
        <li><a href="<?php echo base_url();?>moniter/files"><i class="fa  fa-building-o"></i> <span>फाइल मानीटरिंग</span></a></li>
	<?php } ?>
	<?php if(@$pa_permissions['files']['add']==1){ ?>
			<li class=""><a href="<?php echo base_url();?>add/file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
	<?php } ?>
<?php
} else if ($role == '26'){
    ?>

<?php
} else if ($role == '27'){
    ?>

<?php
} else if ($role == '28'){
    ?>

<?php
} else if ($role == '29'){
    ?>

<?php
} else if ($role == '30'){
    ?>

<?php
} else if ($role == '31'){
    ?>



<?php
} else if ($role == '32'){
    ?>
 <li ><a href="<?php echo base_url();?>view_file/dealing_file" title=""><i class="fa fa-folder-open text-yellow"></i> <span data-toggle="tooltip" data-original-title="Display Files"><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
    <!--<li ><a href="<?php /*echo base_url();*/?>view_file/document_path/index" title=""><i class="fa fa-paperclip"></i> <span  data-toggle="tooltip" data-original-title="Add Documents On Files"><?php /*echo $this->lang->line('document');*/?></span></a></li>-->
    <li ><a href="<?php echo base_url();?>view_file/dealing_file/index/return" title="Returns Files"><i class="fa fa-share"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>


<?php
} else if ($role == '33'){
    ?>


<?php
} else if ($role == '34'){
    ?>



<?php
} else if ($role == '35'){
    ?>



<?php
} else if ($role == '36'){
    ?>

<?php
} else if ($role == '37'){
    ?>
    <li ><a href="<?php echo base_url();?>dealing_assistant" title="Dealing Assistant List"><i class="fa fa-users"></i> <span><?php echo $this->lang->line('dealing_assistant_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>view_file" title="Display Files"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <li ><a href="<?php echo base_url();?>attached/file_doc/1" title=""><i class="fa fa-file-text"></i> <span data-toggle="tooltip" data-original-title="Working Files"><?php echo $this->lang->line('working_file');?></span></a></li>
    <li ><a href="<?php echo base_url();?>view_file/index/1" title="सहायक द्वारा अंकित फाइलें"><i class="fa fa-file-text"></i> <span>सहायक द्वारा अंकित फाइलें</span></a></li>
    <li ><a href="<?php echo base_url();?>view_file/index/return" title="return"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('return_files');?></span></a></li>
<?php } else if ($role == '39'){ ?>
    <li ><a href="<?php echo base_url();?>show_file/csu" title="Display Files"><i class="fa fa-file-text"></i> <span><?php echo $this->lang->line('view_file_manue');?></span></a></li>
    <?php } ?>

<?php if(in_array('22',$section_array) && $role != '1'){ ?>
  
	<?php 

	$emp_id = emp_session_id();
	$empdetails = empdetails($emp_id) ;
	$so_se_above_officer = array(4,5,6,7);
	$empdetails[0]['role_id'];
	if(in_array($empdetails[0]['role_id'] ,$so_se_above_officer  )){
			?>
	<li <?php if ($this->uri->segment(2) == 'view_officer_file' ){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>rti/view_officer_file"><i class="fa fa-file-o"></i> <span><?php echo $this->lang->line('viw_rti_file'); ?></span><span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
	<?php } 
	else if($empdetails[0]['role_id'] == 8 ){
			?>
	<li <?php if ($this->uri->segment(2) == 'view_file' ){ echo 'class="active"'; } ?>><a href="<?php echo base_url();?>rti/notreceive_file"><i class="fa fa-file-o"></i> <span><?php echo $this->lang->line('viw_rti_file'); ?></span><span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
	<?php } else { ?>
	
	<?php } ?>
   
<?php }?>
<?php if($this->session->userdata("emp_id")==125225){ ?>
	<li class=""><a href="<?php echo base_url();?>add_file"><i class="fa fa-plus"></i> <span><?php echo $this->lang->line('add_files');?></span> <span class="fa fa-fw fa-arrow-circle-left blink_fast text-yellow"></span></a></li>
<?php } ?><?php if ($role == '1'){?>
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
                        <i class="fa fa-shopping-cart"></i> <span> वेतन डैशबोर्ड</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu " >
                              <li><a href="<?php echo base_url(); ?>payroll/master"><i class="fa fa-folder-o"></i>वेतन डैशबोर्ड </a></li>
     
                     <li><a href="<?php echo base_url(); ?>payroll/addempincate"><i class="fa fa-folder-o"></i>कर्मचारी & वेतन हेड</a></li>
                  
                        <li><a href="<?php echo base_url(); ?>payroll/add_incrementmonth"><i class="fa fa-folder-o"></i>कर्मचारी वेतन वृद्धि माह </a></li>
                           <li><a href="<?php echo base_url(); ?>payroll/autoincremrnt"><i class="fa fa-folder-o"></i> वेतन वृद्धि  </a></li>

                       <!--    <li><a href="<?php //echo base_url(); ?>payroll/editda"><i class="fa fa-folder-o"></i> कर्मचारी डी.ए  मास्टर </a></li>
                         --> <li><a href="<?php echo base_url(); ?>payroll/allheads"><i class="fa fa-folder-o"></i> वेतन हेड </a></li>
                            
                          <li><a href="<?php echo base_url(); ?>payroll/pan_adhar_house"><i class="fa fa-folder-o"></i> पेन /  आधार / मकान नंबर जोड़े </a></li>
						 
<!-- <li><a href="<?php echo base_url(); ?>payroll/backdatesalary"><i class="fa fa-folder-o"></i> पुराने माह का वेतन </a></li>

                         <li><a href="<?php echo base_url(); ?>payroll/allfixstion"><i class="fa fa-folder-o"></i>  वेतन फिक्सेशन </a></li>
                         
                         <li><a href="<?php echo base_url(); ?>payroll/salaryfixation"><i class="fa fa-folder-o"></i> कर्मचारी वेतन फिक्सेशन </a></li>
-->

    </ul>
    <?php }  ?>
   
       