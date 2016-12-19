<?php
$temp_type = $this->input->get('temp') != '' ? $this->input->get('temp') : '';
$file_s = $this->input->get('fs') != '' ? $this->input->get('fs') : '';
$file_id =  '';
?>
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
                    <div style="float:right">
                        <!--<button class="btn btn-block btn-info"><?php echo $this->lang->line('view_file_mark');?></button>-->
                        <button class="btn btn-block btn-warning" onclick="goBack()"><?php echo $this->lang->line('Back_button_label'); ?></button>
                    </div>
                </div><!-- /.box-header -->
                    <div class="box-body" align="center">
                        <?php if (isset($file_dat_show)) { 
							$file_id = $file_dat_show[0]['file_id'];?>
                            <p>
								पंजी क्रमांक :- <b><?php  echo get_panji_no($file_dat_show[0]['file_id'],$file_dat_show[0]['file_mark_section_id'],$file_dat_show[0]['file_created_date']);  ?></b><br/>
                                File Date :-  <?php echo $file_dat_show[0]['file_uo_or_letter_date'] ?><br/>
                                File Subject :-  <?php echo $file_dat_show[0]['file_subject'] ?>
                                <?php  // $this->session->set_userdata('file_r',$file_dat_show[0]['file_uo_or_letter_no']);
                                // pr($this->session->userdata('file_r'));
                                ?>
                            </p>
                        <?php } ?>
				</div>
			</div>
		</div>
		<?php if($temp_type == 'y' || $temp_type != '') { ?>
		<div class="col-xs-12">
            <!-- Various colors -->
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">Generate Notesheet</h3>
				</div>
				<div class="box-body" align="center">
                        <div class="panel-group" id="accordion">
                            <div class="col-md-5 col-xs-12">
                                <?php
                                $i = 1;
                                //pre($notesheets_menu_list);
                                $count = count($notesheets_menu_list);
                                if (isset($notesheets_menu_list) && !empty($notesheets_menu_list)) {
                                    foreach ($notesheets_menu_list as $key => $docdata) {
                                        if ($i % 2 == 1) {
                                            $clas = "primary";
                                            $cls = "class='btn bg-purple btn-flat margin'";
                                        } else {
                                            $clas = "danger";
                                            $cls = "class='btn bg-olive btn-flat margin'";
                                        }
                                        ?>
                                        <div class="panel panel-<?php echo $clas; ?> template no-padding  margin" >
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>">
                                                        <?php echo $docdata['notesheet_menu_title_hi']; ?>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <?php
													if($this->input->get('type')){
														$notesheets = $this->notesheet_model->get_all_notesheets($docdata['notesheet_menu_id'],$this->input->get('type'));
													}else{
															$notesheets = $this->notesheet_model->get_all_notesheets($docdata['notesheet_menu_id']);
													}                                                    
                                                    if (isset($notesheets) && !empty($notesheets)) {
                                                        foreach ($notesheets as $nkey => $nvalue) {
                                                            ?>
                                                            <?php if (isset($file_dat_show)) { 
                                                                $url = 'admin_notesheet_master/view_file_notesheet/' ;
                                                                $file_id = $file_dat_show[0]['file_id'];
                                                                $target = 'target="_blank"';
                                                                } else {
                                                                    $url = 'attached/doc_file/1/';
                                                                    $file_id = '';
                                                                    $target = '';
                                                                }
                                                               	$mystring = $nvalue['notesheet_title'] ;
																$findme   = 'नोटरी';
																$pos = strpos($mystring, $findme);
																if($pos == 'नोटरी'){
																 $url = 'admin_notesheet_master/view_file_notesheet/' ;
                                                                $file_id = $file_dat_show[0]['file_id'];
																	 ?>
                                                                <a onclick="get_notery_form(<?php echo $file_id ?>,'<?php echo $url; ?><?php echo $nvalue['notesheet_id'] . '/' . $docdata['section_id'] . '/' . $file_id.'/'.$file_s; ?>')"  style="curser:pointer" <?php echo $cls; ?>  >
                                                                    <?php echo $nvalue['notesheet_title']; ?>
                                                                </a>
																<?php 
																} else { ?>
                                                                <a href="<?php echo base_url().$url; ?><?php echo $nvalue['notesheet_id'] . '/' . $docdata['section_id'] . '/' . $file_id.'/'.$file_s; ?>" <?php echo $cls; ?>  >
                                                                    <?php echo $nvalue['notesheet_title']; ?>
                                                                </a>


																	<?php } ?>
																<?php } ?>
                                                       <?php } else {
                                                       echo 'No notesheet found!'; 
                                                    }
                                                    ?>
                    </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($i % ($count / 2) == 0) {
                                            echo '</div><div class="col-md-5 col-xs-12">';
                                        }
                                        $i++;
                                    }
                                    ?>
                                <?php } else {
                                        echo 'No notesheet found!'; 
                                     }
									  // if all section have same notsheet
									
									 if (isset($notesheets_menu_for_all) && !empty($notesheets_menu_for_all)) {
										foreach ($notesheets_menu_for_all as $key => $docdata) { ?>
											<div class="panel panel template no-padding  margin" >
												<div class="panel-heading">
													<h4 class="panel-title">
														<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>">
															<?php echo $docdata['notesheet_menu_title_hi']; ?>
														</a>
													</h4>
												</div>
												<div id="notesheetmenu_<?php echo $docdata['notesheet_menu_id']; ?>" class="panel-collapse collapse">
													<div class="panel-body">
														<?php
														if($this->input->get('type')){
															$notesheets = $this->notesheet_model->get_all_notesheets($docdata['notesheet_menu_id'],$this->input->get('type'));
														}else{
															$notesheets = $this->notesheet_model->get_all_notesheets($docdata['notesheet_menu_id']);
														}
														  // if($_GET['t'] == 'test'){
														   // pre($notesheets);
														  // }
														
														if (isset($notesheets) && !empty($notesheets)) {
															foreach ($notesheets as $nkey => $nvalue) { ?>
															
															<a href="<?php echo base_url().$url; ?><?php echo $nvalue['notesheet_id'] . '/0/' . $file_id.'/'.$file_s; ?>" class="btn bg-olive btn-flat margin"  >
                                                                    <?php echo $nvalue['notesheet_title']; ?>
                                                                </a>
																<?php } ?>
															<?php } ?>
													 </div>
												</div>
											</div>
										<?php } ?>
									<?php } ?>
                            </div>
                        </div> <!-- accordion -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
		<?php } else { ?>
		<div class="col-xs-12">
			<div class="box box-warning">
				<div class="box-header">
					<h3 class="box-title">ड्राफ्ट जोड़े</h3>
				</div>
				<div class="box-body">
				<?php $draft_ids = explode(',',$file_dat_show[0]['final_draft_id']);
					if($draft_ids != null || $draft_ids != 0){
						foreach($draft_ids as $draft_id){
							$draft_data = get_draft($draft_id, 'n');
						}
					}
				?>
					<div class="row">
						<div class="col-md-12"><h4>विभाग  की नोटशीट - N जोड़े</h4> </div>
						<div class="col-md-2 text-center">
						<?php  if(empty($draft_data)){ ?>
							<a href="<?php echo base_url().'draft/create_fileto_draft/'.$file_dat_show[0]['file_id'].'/n'; ?>" class="btn btn-primary btn-flat">ई-नोटशीट </a>
						<?php } else{
							echo '<p class="bg-danger">आप पहले से ही इस फाइल पर नोट शीट जोड़ चुके है, अब नहीं जोड़ सकते कृपया देखे या एडिट करे|<a href="'.base_url().'efile/'.$file_dat_show[0]['file_id'].'" class="btn btn-primary btn-flat"> नोटशीट </a> </p>';
						} ?>
						</div>
					</div><hr/>
					<div class="row">
						<div class="col-md-12"><h4>विभाग को भेजने वाला  पत्राचार Correspondence- C जोड़े</h4> </div>
						<div class="col-md-2 text-center">
							<a href="<?php echo base_url().'draft/create_fileto_draft/'.$file_dat_show[0]['file_id'].'/o'; ?>" class="btn btn-warning btn-flat">ई-आर्डर</a>
						</div>
						<div class="col-md-2 text-center">
							<a href="<?php echo base_url().'draft/create_fileto_draft/'.$file_dat_show[0]['file_id'].'/r'; ?>" class="btn btn-danger btn-flat">ई-स्मरण पत्र</a>
						</div>
						<div class="col-md-2 text-center">
							<a href="<?php echo base_url().'draft/create_fileto_draft/'.$file_dat_show[0]['file_id'].'/ot'; ?>" class="btn btn-success btn-flat">ई-अन्य</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<style type="text/css">
    #leave_employee_filter{
        clear: both;
    }
</style>

<?php $this->load->view('notery_script')?>