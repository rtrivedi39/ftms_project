<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Disptach Modal -->
<div class="modal fade" id="dispatch_model" tabindex="-1" role="dialog" aria-labelledby="Dispatchmodel">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_file_byso/" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>नस्ती जावक में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="col-xs-6">जावक शाखा में क्या भेजना चाहते है ?  </div>
                                    <div class="col-xs-3"> <label class="radio"><input type="radio" name="file_types" required value="पत्र" id="dispetch_latter" onclick="check_dispetch_file(this.value);" checked>पत्र </label>
                                    </div>
                                    <div class="col-xs-3"><label class="radio"><input type="radio" name="file_types" required value="नस्ती" id="dispetch_file" onclick="check_dispetch_file(this.value);" >नस्ती</label>
                                    </div>
                                </div>
                            </div>                            

                                <div class="col-xs-12">
                                    <input type="hidden" class="dis_file_id" name="dis_file_id">                                    


                                    <br/>
									<div class="row suspense_slip_div_file" style="display:none;">

										<table id="" class="m_dispatch gridtable multiple_dispatch" border="1px" style="font-size:13px;" width="100%">
                                        <tbody>
                                        <tr><td>नस्ती कहाँ जानी है</td><td>
                                                <select name="dispatch_name[]" id="select_send_file">

                                                    <option value="">चयन करें </option>
                                                    <option value="मान0  विधि मंत्री जी">मान0  विधि मंत्री जी</option>
                                                    <option value="मुख्य सचिव">मुख्य सचिव</option>
                                                    <option value="विभाग">विभाग</option>
                                                    <option value="अन्य">अन्य</option>
                                                </select>
                                            </td></tr>
											<tr><td></td><td>
								                <select class="form-control" name="dispatch_name[]" id="file_department_id" style="display:none;">
                                                    <option value=""> विभाग का चयन करें</option>
                                                    <?php
                                                    $departments_list = get_list(DEPARTMENTS, 'department_default_no', null,'ASC');
                                                    foreach($departments_list as $row){ ?>
                                                        <option ><?php echo @$row['department_default_no']==1000 ? '' :  $row['dept_name_hi']; ?></option>
                                                    <?php } ?>
                                                </select>
												<textarea name="dispatch_name[]" id="other_place_file"  rows="2" cols="50" style="display:none;" placeholder="अन्य जगह का नाम लिखे"></textarea>
											</td></tr>
                                        </tbody>                                
                                    </table>
                                </div>                           
								<div class="row suspense_slip_div_latter">             
                                    <table id="" class="m_dispatch gridtable multiple_dispatch" border="1px" style="font-size:13px;" width="100%">
                                        <tbody>
                                        <tr><td>प्रति</td>
											<td>
											<textarea name="dispatch_name[]" rows="2" cols="50" class="dept_name"></textarea>

                                            </td>
										</tr>
                                        <tr style="display:none;" ><td>प्रतिलिपि </td>
											<td>

                                                <select name="dispatch_name_lists" id="ddl_dipatch_lists">
                                                    <option value="">--विकल्प चुने--</option>
                                                    <option value="1">विभाग </option>
                                                    <option value="2">महाधिवक्ता </option>
                                                </select>

                                            </td>
										</tr>

                                        <tr  id="vibhag"><td>प्रतिलिपि 1</td>
											<td>
                                                <select name="dispatch_name[]"  class="vibhag" multiple="true">
                                                    <option value="">--विभाग चुने--</option>
                                                    <?php foreach(getDepartments() as $row) { ?>
                                                        <option value="<?php echo $row->dept_name_hi; ?>"><?php echo $row->department_default_no.'-'.$row->dept_name_hi; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </td>
										</tr>

                                        <tr  id="mahadhivakta"><td>प्रतिलिपि 2</td>
											<td>
                                                <select name="dispatch_name[]" class="mahadhivakta" multiple="true">
                                                    <option value="">--महाधिवक्ता चुने--</option>
                                                    <option value="महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश">महाधिवक्ता, मान0  उच्च न्यायालय, जबलपुर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, इंदौर, मध्यप्रदेश </option>
                                                    <option value="अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश">अतिरिक्त महाधिवक्ता, मान0  उच्च न्यायालय खण्डपीठ, ग्वालियर, मध्यप्रदेश </option>
                                                </select>

                                            </td>
										</tr>

                                        </tbody>
                                        <tfoot class="other">
											<tr>
											<td colspan="4" style="text-align: left;">
                                                <input type="button" class="addrow" value="अन्य प्रतिलिपि जोड़े" />
                                                <input type="hidden" value="" name="total_row" class="total_row">
											</td>
											</tr>
										</tfoot>
                                    </table>
                                </div>
								<br/>
								<textarea class="form-control" rows="3" placeholder="कोई टीप लिखें" id="remark-dis" name="remark"></textarea>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn" onclick="return confirm('क्या आप Dispatch करना  चाहते है!');"><i class="fa fa-check"></i> हाँ</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-delete" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टीप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> हाँ</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--raginee-->
<div class="modal fade" id="modal-send_upper" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form action="<?php echo base_url() ;?>manage_file/Sendfile_upperofficer" method="post" >-->
		<form method="post" id="form_submit_link">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> टीप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
									<input type="hidden" id="file_section_id_txt" class="" name="file_section_id">
                                    <input type="hidden" id="modal-id2" class="lower_efileid" name="fileids2">
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="rmk1"></textarea>
                                    <br/>
                                    <div id="emp_byfile2"></div>
                                </div>
								<div class="form-group pull-right">
										<input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p"  >Physical File
										 <input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file" >E-File

								</div>
								<div class="efile_div"></div>
								<div style="clear:both;margin-left: 15px;" class="signdata">
										<input type="checkbox" class="get_sign_data" id="get_sign_data" name="get_sign_data" value="">&nbsp; हस्ताक्षर करें									
								</div>
								<div class="signdata sign_data_content"></div>
							</div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>रद्द करें</button>
                          <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary send_btn autoclick <?php if((($this->uri->segment(1)=='e-files')|| ($this->uri->segment(1)=='efile')) && emp_session_id() != '151'){ echo " disabled"; }?>"><i class="fa fa-check"></i>भेजें</button>
						  <input type="hidden" class="modal-send_upper_txt1" name="modal-send_upper_txt1" value="0"/>						  
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--receive model-->
<div class="modal fade" id="modal-receive_file" data-backdrop="static">
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
<!--End-->
<!--receive model-->
<div class="modal fade" id="modal-return_to_cr" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form role="form" method="post" action="<?php echo base_url()?>view_file/Dealing_file/Sent_to_DA">-->
		<form method="post" id="form_submit_cr">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> आवक में भेजें</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="cr_return" name="file_id1">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="file_remark-id" name="file_remark"></textarea>
                                        <br/>
                                        यदि यह फाइल आपके अनुभाग की नही है तो कृपया सम्बंधित अनुभाग का चयन करें |
                                        <div id="section_name_nm"></div>
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
                    <button onclick="return confirm_send()" type="submit" name="return_tocr" value="return_tocr" class="btn btn-primary"><i class="fa fa-share"></i> Return</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!--return file mark to da-->
<div class="modal fade" id="modal-return_da_file" data-backdrop="static">
    <div class="modal-dialog">
        <form role="form" method="post" action="<?php echo base_url()?>view_file/dealing_file/sent_to_da" id="sendfile_upperofficer" class="sendfile_upperofficer">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>टीप लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <input type="hidden" id="modal-id5" name="file_id1" class="lower_efileid">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>

                                    <?php   $section_exp1 = explode(',',getEmployeeSection());
                                    $section_11 = array('0');
                                    if(array_intersect($section_exp1, $section_11)){
                                        ?>
                                    <div class="form-group">
                                        <select class="form-control" name="court_bench_byso" required="required">
                                            <option value="">Select</option>
                                            <?php foreach(highcourt_bench() as $key => $value){
                                                echo '<option value="'.$key.'">'.$value.'</option>';
                                            } ?>
											<option value="sc">दिल्ली सुप्रीम कोर्ट </option>
                                        </select>
                                    </div>
                                    <?php }else if(in_array('0',$section_exp1)){ ?>
                                        <div class="form-group">
                                            <label for="prosecution file type"><?php echo $this->lang->line('file_ka_prakar'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="section_file_type" required>
                                                <option value=""><?php echo $this->lang->line('file_ka_prakar'); ?></option>
                                                <?php
                                                $presecution_file_type= get_prosecution_file_type(); /*function define in common helper. Database filed name : section_file_type in ft_files */
                                                foreach($presecution_file_type as $pftype){ ?>
                                                    <option value="<?php echo $pftype; ?>"><?php echo $pftype; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?php echo form_error('section_file_type');?>
                                        </div>
                                    <?php } ?>
                                    <div id="emp_byfile5"></div>
									<div class="form-group pull-right">
										 <input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p" <?php if(($this->uri->segment(1)!= 'e-files') && ($this->uri->segment(1)!= 'efile') ){ echo "checked disabled" ; } ?> >Physical File
										 <input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file" <?php if(($this->uri->segment(1)== 'e-files') || ($this->uri->segment(1)== 'efile')){ echo "checked disabled"; } ?>>E-File
									</div>
									<div class="efile_div"></div>
									<div class="signdata" style="clear: both; margin-left: 15px; display: block;">
										<input type="checkbox" value="" name="get_sign_data" id="get_sign_data" class="get_sign_data">&nbsp;डिजिटल  हस्ताक्षर जोड़े
									</div>
									<div class="sign_data_content signdata" style="display: block;"></div>
								</div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary autoclick send_btn"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<!-- Model for dispose file in section -->
<div class="modal fade" id="modal-dispose_file" data-backdrop="static">
    <div class="modal-dialog">
        <form action="<?php echo base_url() ;?>manage_file/dispatch_for_close_byso" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>Enter Remark For Dispose File</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-dis" name="filedis_id">                                    
                                    <div class="form-group">
                                    <textarea class="form-control" rows="3" placeholder="आप फाइल को Dispose क्यूँ करना चाहते है कृपया जरुर लिखें|" id="remark-dispose-id" name="filedis_msg" required>सूचनार्थ</textarea>
                                   <br/>
									<select class="form-control" id="dispose_remark">
									<option>सूचनार्थ |</option>
									<option>आदेश जारी |</option>
									<option>नस्ती/प्रकरण आने पर कार्यवाही की जायेगी।</option>
									<option>कार्यवाही की गई ।</option>
									</select>
								   </div>                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="modal-receive_mark" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" id="receive_mark">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल प्राप्त करे और सहायक को अंकित करे  </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">विषय : </label> <span id="subject_show"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile"> फ़ाइल देने वाले का नाम</label>
                                        <input type="text" id="carry_fileemp_name" name="carry_fileemp_name" placeholder="Put name here"  class="form-control">
                                    </div>
                                    <div class="form-group text-right">
                                        <input type="checkbox" checked id="physical_file" name="physical_file" class="physical_file" value="p" disabled> Physical File   <input type="checkbox" id="only_rec" name="only_rec" class="only_rec"> केवल प्राप्त करे
										<input type="hidden"  name="physical_file" value="p" >
										<br><span style="font-weight: bold;color: #B53533;">आप सुनिश्चित कर रहे है कि नस्ती / पत्र की हार्ड-कापी आपके पास है|</span>
                                    </div>
<div class="div_damark">
                                    <div class="text-center"><label for="exampleInputFile text-center">सहायक को  अंकित करें</label></div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>
                                    <label for="exampleInputFile">सहायक के नाम</label>
                                    <div id="emp_byfile6" class="emp_byfile6"></div>
    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>Cancel</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i>Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function receive_with_status(file,file_status){
       var file2 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );

		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else{
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

		}
		if(efile == 'efile' || efile == 'e-files'){
			getphysical_file_from_log(file,file_status); 
		}
		$('#modal-id2').val(file2);
        $('#modal-da_receive').modal('show');
        $('#form_submit_link_file_status').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file2);

    }
</script>
<div class="modal fade" id="modal-da_receive" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form id="form_submit_link_file_status" action="<?php echo base_url() ;?>manage_file/receive_file_sectionno/" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>फाइल प्राप्त करे </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" id="modal-id" name="fileids">
									<div class="form-group">
										<label>कृप्या सुनिश्चित करे की आपके पास फाइल आई है अथवा नही ?</label>
									</div>
									<div class="form-group checkbox">
										<label>
										  <input type="checkbox" id="physical_file_1" name="file_status[]" class="form-group physical_file" value="p" >Physical File
										</label>
										<label>
										<input type="checkbox" id="electronic_file_1" name="file_status[]" value="e" class="form-group electronic_file">E-File

										</label>
									  </div>
									  	<div class="efile_div"></div>
								</div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button id="btn-delete" type="submit" class="btn btn-primary send_btn"><i class="fa fa-check"></i> प्राप्त करें</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
 $("#section_file_categoty").change(function () {
			var section_file_cat = $(this).val();
			window.location.href = '<?php echo base_url() ?>view_file/Dispaly_list?section_id=<?php echo $this->input->get('section_id') ?>&cate='+section_file_cat;
		  });
		  
		  
	function getphysical_file_from_log(file,file_status)
	{
		var empid='';
		empid =  "<?php echo emp_session_id()?>";
		
		var file_id = file;
		var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
			type: "POST",
			url: HTTP_PATH + "view_file/get_physical_file_from_log",
			datatype: "json",
			async: false,
			data: {file_id: file_id,file_status:file_status},
			success: function(data) {
			var r_data = JSON.parse(data);
				 
				/* console.log(r_data );*/
				if(r_data[0]['from_emp_id'] == empid ) {
					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".physical_file").prop( "checked", true );
					$(".physical_file").prop( "disabled", false );
					$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
				}
				
			}
		});
	}
		  
		  
		  
 $(function () {

        $(".rty1").click(function () {
			var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control emp_id" name="emp_id"><option value="">Select DA name</option> ';
                    $.each(r_data, function( index, value ) {
					 if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';

                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+'</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile").html(otpt);
                }
            });
        });
     
        $(".upperuser").click(function () {			
			$(".sign_data_content").html('');
			$('.Da_name_r').val('');

            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/upper_role_officer_new/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control emp_id2" name="emp_id2">';
					$.each(r_data[0], function( index, value ) {
                        if(r_data[1][0].upperofficid == value.emp_id){
                            var selected = 'selected';
                        }else{
                            var selected = null;
                        }
						
						if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';

                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='Shushri';
                            var fword_hi='सुश्री';
                        }
                        otpt1 += '<option value="'+value.emp_id+'" '+selected+'>'+fword_hi+' '+value.emp_full_name_hi+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });
		
		$(".sections_nm").click(function () {
            var file_id = $(this).val();
             var file_section_id = $("#file_section_id_txt").val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_off_nm/"+file_id,
                datatype: "json",
                async: false,
                 data: {file_id: file_id,file_section_id:file_section_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="section_mark" required>';
					otpt1 += '<option value="">Select</option>';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.section_id+'">'+value.section_name_hi+' ('+value.section_name_en+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });

    $(".sections_name").click(function () {
        var file_id = $(this).val();
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "view_file/section_off_nm",
            datatype: "json",
            async: false,
           
            success: function(data) {
                var r_data = JSON.parse(data);
                var otpt1 = '<select class="form-control" id="section_name_nm_id" name="section_name_nm_id">';
                otpt1 += '<option value="">Select</option>';
                $.each(r_data, function( index, value ) {
                    otpt1 += '<option value="'+value.section_id+'" >'+value.section_name_hi+'</option>';
                });
                otpt1 += '</select>';
                $("#section_name_nm").html(otpt1);
            }
        });
    });

        
        $(".rty6").click(function () {
			$(".signdata").hide();
			$(".sign_data_content").html('');

			var subject_show = $(this).closest("tr").find('td:eq(2)').text();
			$('#subject_show').html(subject_show);
			
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "view_file/section_da_name",
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt = '<select class="form-control Da_name_r" name="Da_name" required=""><option value=""> चयन करें </option> ';
                    $.each(r_data, function( index, value ) {
						var secname = value.section_name;
						 if(value.emp_detail_gender=='m'){
                            var fword_en='Shri';
                            var fword_hi='श्री';

                        }else if(value.emp_detail_gender=='f'){
                            var fword_en='shushri';
                            var fword_hi='सुश्री';
                        }
                         otpt += '<option value="'+value.emp_id+'">'+fword_hi+' '+value.emp_full_name_hi+' ('+secname+')</option>';
                    });
                    otpt += '</select>';
                    $("#emp_byfile5").html(otpt);
					$(".emp_byfile6").html(otpt);
                }
            });
        });
    });


	function open_model(file,file_status){
        var file1 = file;
		
		 $(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );

		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else{
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

		}
		if(efile == 'efile' || efile == 'e-files'){
			getphysical_file_from_log(file,file_status); 
		}
        $('#modal-id').val(file1);
        $('#modal-delete').modal('show');
    }
   /* function open_model2(file){
        var file2 = file;
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
    }*/
	
	function open_model2(file,file_status){
		var file2 = file;
		$(".signdata").hide();/*by default hide digital sign checkbox */
		$(".get_sign_data").prop( "checked", false );
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );

		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){			
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".signdata").show(); /*Show Digital sign box*/
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else{
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

		}
		if(efile == 'efile' || efile == 'e-files'){
			$(".signdata").show(); /*Show Digital sign box*/
			getphysical_file_from_log(file,file_status); 
		}
		
        $('#modal-id2').val(file2);
        $('#modal-send_upper').modal('show');
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/Sendfile_upperofficer/'+file2);

    }
        function open_model3(file,file_status){

			var file3 = file;
		var file3 = file;
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";



		if(efile != 'e-files' && efile != 'efile'){
			
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}else{

			if(file_status == 'p'){
				 $(".physical_file").prop( "checked", true );

				 $(".physical_file").prop( "disabled", true );
				 $(".electronic_file").prop( "disabled", true );
				 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}

			else if(file_status == 'e'){
				$(".electronic_file").prop( "checked", true );


				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );


				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			}else{
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".physical_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			}
		}
		 if(efile == 'efile' && efile == 'e-files'){
		 getphysical_file_from_log(file,file_status); 
		 }
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file3);
    }
    function open_model4(file){
        var file4 = file;
        $('#modal-receive_file').modal('show');
        $('#receive_file1').attr('action','<?php echo base_url() ;?>manage_file/receive_by_officer/'+file4);
    }
     function open_model5(file,file_status){
        var file5 = file;
$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );


		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}else{

			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );

			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".signdata").show(); /*Show Digital sign box*/
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
                $(".electronic_file").prop( "disabled", true );
                $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

            }
		}
	 if(efile == 'efile' || efile == 'e-files'){
		$(".signdata").show(); /*Show Digital sign box*/
		getphysical_file_from_log(file,file_status); 
	}
        $('#modal-return_to_cr').modal('show');
         $('#cr_return').val(file5);
    $('#file_remark-id').val('');
		  $('#form_submit_cr').attr('action','<?php echo base_url()?>view_file/dealing_file/sent_to_da');
    }
    function open_model6(file,file_status){

         var file6 = file;
		$(".signdata").hide(); /*by default Hide Digital sign box*/
		$(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );


		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );
		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}else{
			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".signdata").show(); /*Show Digital sign box*/
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
                $(".electronic_file").prop( "disabled", true );
                $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

            }
		}
	 if(efile == 'efile' || efile == 'e-files'){
		$(".signdata").show(); /*Show Digital sign box*/
		getphysical_file_from_log(file,file_status); /**/ 
	}

		var da_name = $('.Da_name_r').val();
		if(da_name != ''){
			$(".signdata").show();
		}  else{
			$(".signdata").hide();
		}





		$('#modal-id5').val(file6);
        $('#modal-return_da_file').modal('show');
    }

$(function () {
		$(document).on('change', '.Da_name_r', function() {
			var name_da = $(this).val(); /*// get lists id*/
			if(name_da == ''){
				$(".signdata").hide();
			}else{
				$(".signdata").show();
			}
		});
	});










    function open_model_dispose(file){
        var file_dis = file;
        $('#modal-dis').val(file_dis);
        $('#modal-dispose_file').modal('show');
    }
	function section_section(file,file_status,file_section_id){		
		var filess = file;
		$(".signdata").hide(); /*By Default hide Digital sign box*/
		 $(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );

		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );
			 
			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".signdata").show(); /*Show Digital sign box*/
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

		}
		if(efile == 'efile' || efile == 'e-files'){
			$(".signdata").show(); /*Show Digital sign box*/
			getphysical_file_from_log(file,file_status); /**/ 
		}
        $('#modal-send_upper').modal('show');
         $('#file_section_id_txt').val(file_section_id);
		$('#modal-id2').val(filess);
        $('#form_submit_link').attr('action','<?php echo base_url() ;?>manage_file/section_to_section/'+filess);
    }
    function open_model_cr(file,file_status){
        var file5 = file;

		 $(".physical_file").prop( "checked", false );
		$(".electronic_file").prop( "checked", false );
		$(".electronic_file").prop( "disabled", false );
		$(".physical_file").prop( "disabled", false );

		var efile = "<?php echo $this->uri->segment(1)?>";
		if(efile != 'e-files' && efile != 'efile'){
			$(".physical_file").prop( "checked", true );
			$(".physical_file").prop( "disabled", true );
			$(".electronic_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p"  >');
		}
		else{
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');

			if(file_status == 'p'){
			$(".physical_file").prop( "checked", true );

			 $(".physical_file").prop( "disabled", true );
			 $(".electronic_file").prop( "disabled", true );
			 $(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="p">');
			}
			else if(file_status == 'e'){
			$(".signdata").show(); /*Show Digital sign box*/
			$(".electronic_file").prop( "checked", true );
			$(".electronic_file").prop( "disabled", true );
			$(".physical_file").prop( "disabled", true );
			$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}
			else if(file_status == 'p,e'|| file_status == 'e,p'){
				$(".signdata").show(); /*Show Digital sign box*/
				$(".physical_file").prop( "checked", true );
				$(".electronic_file").prop( "checked", true );
				$(".electronic_file").prop( "disabled", true );
				$(".efile_div").html('<input type="hidden"  name="file_status[]" class="form-group" value="e">');
			}

		}
		if(efile == 'efile' || efile == 'e-files'){
			$(".signdata").show(); /*Show Digital sign box*/
			getphysical_file_from_log(file,file_status); 
		}
        $('#modal-return_to_cr').modal('show');
        $('#cr_return').val(file5);
        $('#form_submit_cr').attr('action','<?php echo base_url()?>manage_file/reject_for_cr/'+file5);
    }
    function confirm_dispose(){
            return confirm('क्या आप Dispose करना  चाहते है!');
    }
	
	function receive_markda(file,file_status){
		var file3 = file;
		$('#modal-receive_mark').modal('show');
		$('#receive_mark').attr('action','<?php echo base_url() ;?>manage_file/receive_sectionno_mark_da/'+file3);
		/*$('input[type="checkbox"][name="only_rec"]').iCheck('check', function(){
			$(".div_damark").hide();
			$(".Da_name_r").prop('required', false);
			$('#receive_mark').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file3);
		});*/
	
		$('#only_rec').change(function(){
			
			if($('#only_rec').is(':checked')){
				$(".div_damark").hide();
				$(".Da_name_r").prop('required', false);
				$('#receive_mark').attr('action','<?php echo base_url() ;?>manage_file/receive_file_sectionno/'+file3);
			}else{
				$(".div_damark").show();
				$('#receive_mark').attr('action','<?php echo base_url() ;?>manage_file/receive_sectionno_mark_da/'+file3);
				$(".Da_name_r").prop('required', true);
			}
		});
	}/*
    add apend div for multiple dispatch*/
    $(document).ready(function () {
        var counter = 0;
        $(".addrow").on("click", function () {
            counter = $('.multiple_dispatch tr').length - 2;
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>प्रतिलिपि ' + counter + '</td><td><textarea name="dispatch_name[]"' + counter + '" rows="2" cols="50"></textarea></td>';
          /*  cols += '';*/
            cols += '<td><input type="button" class="ibtnDel"  value="हटायें"></td>';
            newRow.append(cols);
            if (counter == 10) $('.addrow').attr('disabled', true).prop('value', "You've reached the limit");
            $("table.m_dispatch").append(newRow);
            counter++;
            $('.total_row').val(counter);
        });

        $("table.m_dispatch").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();

            counter -= 1;
            $('.addrow').attr('disabled', false).prop('value', "Add Row");
            $('.total_row').val(counter);
        });

        /*dispatch button on click*/
        $(".dispatch_btn").click(function () {
            var file_id = $(this).data('file_id'); /**/
            $('.dis_file_id').val(file_id);  /*//set model file_id*/
            var dept = $(this).closest("tr").find('td:eq(6)').text();
            $('.dept_name').val(dept);  /*//set model file_id*/

        });
        /*dispatch lists on change*/
        $("#ddl_dipatch_lists").change(function() {
            var list_id = $(this).val(); /*// get lists id*/
            if(list_id == 1){
                $('#mahadhivakta').hide();
                $('#vibhag').show();
                $('.mahadhivakta').val('');
            }else if(list_id == 2){
                $('#mahadhivakta').show();
                $('#vibhag').hide();
                $('.vibhag').val('');
            }else{
                $('.mahadhivakta').hide();
                $('.vibhag').hide(); 
                $('.mahadhivakta, .vibhag').val('');
            }
        });

   
    });
    function check_dispetch_file(file_type){
       
        if(file_type == 'नस्ती'){
			$(".suspense_slip_div_latter").hide();
            $(".suspense_slip_div_file").show();     
            $("#btn-delete" ).removeClass( "disabled" );
            $("#remark-dis" ).prop('required',true);
            $("#select_send_file" ).prop('required',true);
			$(".vibhag").val('');
			$(".mahadhivakta").val('');
			$(".dept_name").val('');
			
        }else{
            $(".suspense_slip_div_latter").show();
            $(".suspense_slip_div_file").hide();
            $("#btn-delete" ).removeClass( "disabled" );
			$("#remark-dis" ).prop('required',false);
			$("#select_send_file" ).prop('required',false);
			$("#select_send_file" ).val('');
			$("#file_department_id").hide();			
			$("#other_place_file").hide();
			$("#file_department_id").val('');			
			$("#other_place_file").val('');
        }
    }
	
	
	$("#select_send_file").change(function () {
        var send_file = $(this).val();
		if(send_file == 'विभाग'){
			 $("#file_department_id").show();			
			 $("#other_place_file").hide();			
		} else if(send_file == 'अन्य'){
			$("#file_department_id").hide();			
			$("#other_place_file").show();	
		} else {
			$("#file_department_id").hide();			
			$("#other_place_file").hide();
			$("#file_department_id").val('');			
			$("#other_place_file").val('');
		}
    });
	$('#dispose_remark').change(function(){
    var  dispose_remark = $('#dispose_remark option:selected').val();
    var  dispose_remark = $('#dispose_remark option:selected').text();
    if(dispose_remark != ''){
        $('#remark-dispose-id').val(dispose_remark);
    }else{
        $('#remark-dispose-id').val('');
    }
});
 $('#section_name_nm').change(function(){
     var  section_name_nm_id = $('#section_name_nm_id option:selected').val();
     var  section_name_nm_text = "यह फाइल "+$('#section_name_nm_id option:selected').text()+" शाखा  से सम्बंधित है |";
     if(section_name_nm_id != ''){
         $('#file_remark-id').val(section_name_nm_text);
     }else{
         $('#file_remark-id').val('');
     }
 });
</script>