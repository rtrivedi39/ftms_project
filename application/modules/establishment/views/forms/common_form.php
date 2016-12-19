<style>
    input[type=checkbox] + label {
        color: #dd4b39;
    }
    input[type=checkbox]:checked + label {
        color: #398439;
    }
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $this->lang->line('active_page'); ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" method="post" action="<?php echo base_url()?>establishment/est_files/manage_files<?php if(isset($id)){ echo '/'.$id;} ?>"  enctype="multipart/form-data">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo $title_tab;?></h3>
                        <div class="box-tools pull-right">
                            <?php if(isset($is_page_edit)){ ?>
                                <a href="<?php echo base_url('establishment');?>/forms">
                                    <button class="btn  btn-info">नई फाइल जोड़े</button>
                                </a>
                            <?php } ?>
                            <button class="btn btn-warning" title="Back" onclick="goBack()" ><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php if($this->session->flashdata('message') || $this->session->flashdata('error')) {
                            $msg = $this->session->flashdata('message') ? 'success' : 'danger';
                            ?>
                            <div class="alert alert-<?php echo $msg; ?> alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>
                                    <?php  echo $this->session->flashdata('message');
                                    echo $this->session->flashdata('error'); ?>
                                </strong><br>
                            </div>
                        <?php }?>
                        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" >
                        <input type="hidden" name="file_mark_section_id" id="file_mark_section_id" value="7" >
                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $this->uri->segment(3); ?>" >
                        <input type="hidden" name="section_file_page" value="<?php echo $this->uri->segment('3'); ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <div class="form-group">
                                            1  नस्ती / पत्र  का अपलोड साइज़ : 10 MB
                                            <!--<input type="button" id="reset_pdf" value="Remove doc" style="float: right"/>
                                            <button type="button" id="add_multi_btn" class="btn btn-social btn-sm" style="float: right"><i class='fa fa-fw fa-plus'></i> ADD more doc</button>-->
                                            <div style="float: right"><button type="button" id="add_multi_btn" class="btn btn-sm" ><i class='fa fa-fw fa-plus'></i> एक से अधिक नस्ती / पत्र  जोड़ें</button>
                                                <button type="button" id="remove1" class="btn btn-sm remove1"><i class="fa fa-fw fa-remove"></i> नस्ती / पत्र  को हटाये</button></div>
                                            <span id="dis_file_size"></span>
                                        </div>
                                        <div class="box box-solid collapsed-box">
                                            <div class="box-header with-border">
                                                <div class="col-md-5">
                                                    <input id="uploadImage0" type="file" name="file_upload[]" onchange="PreviewImage(0);" style="float: left"/>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="file_title[]" id="file_title0" placeholder="File title" class="form-control">
                                                </div>
                                                <div class="col-md-1" data-original-title="Add Bookmark" data-toggle="tooltip">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body no-padding"> <!-- style="display:block" --->
                                                <input type="text" name="add_bookmark_text0[]" class="form-control" placeholder="Add important page no. of selected pdf file. eg : pageno.=pagetitle,">
                                                example : 1=noteshee,2=order,3=otherpage
                                            </div><!-- /.box-body -->
                                        </div>

                                        <div class="form-group" id="add_multi_choose"></div>

                                        <div class="form-group" style="border: 1px solid gray;height: 600px;" id="scan_file_div">
                                            <!--  <object id="uploadPreview1" data="<?php echo base_url()?>/uploads/Viwer_example.pdf" width="100%" height="600px"></object>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group col-md-6">
                                    <label for="file_type_status"><?php echo $this->lang->line('label_file_type_status'); ?></label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="file_type_status" id="file_type_status">
                                        <?php $file_type_status_array = array('p' => 'भोतिक फाइल (p - file)','e' => 'ई - फाइल (e - file)');
                                        foreach($file_type_status_array as  $key => $value){ ?>
                                            <option value="<?php echo $key ; ?>" <?php echo (isset($file_data) && $file_data[0]['file_status'] == $key || $file_type_status == $key) ? 'selected' : '' ;?>><?php echo $value ; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('file_type_status');?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="file_type"><?php echo $this->lang->line('label_file_type'); ?></label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="file_type" id="file_type">
                                        <?php foreach(est_file_types() as $key => $value){ ?>
                                            <option value="<?php echo $key ; ?>" <?php echo (isset($file_data) && $file_data[0]['file_type'] == $key) ? 'selected' : '' ;?>><?php echo $value ; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('file_type');?>
                                </div>
                                <div class="form-group">
                                    <label for="subject"><?php echo $this->lang->line('label_subject'); ?> <span class="text-danger">*</span></label>
                                    <textarea name="file_subject" required id="file_subject" class="form-control"><?php echo (isset($file_data) && $file_data[0]['file_subject'] != '') ? $file_data[0]['file_subject'] : '' ;?></textarea>
                                    <?php echo form_error('emp_id');?>
                                </div>
                                <div class="form-group">
                                    <label for="discription"><?php echo $this->lang->line('label_file_discription'); ?></label>
                                    <textarea name="file_discription" id="file_discription" class="form-control" placeholder="यदि जरुरी हो तो "><?php echo (isset($file_data) && $file_data[0]['file_description'] != '') ? $file_data[0]['file_description'] : '' ;?></textarea>
                                    <?php echo form_error('file_discription');?>
                                </div>

                                <h4 align="center"><b> नस्ती / पत्र  की मेटा कुंजी :</b></h4>
                                <div class="form-group">
                                    <div id="add_multi_subtype">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label for="Document"> नस्ती / पत्र  का प्रकार</label> <span class="text-danger">*</span>
                                               <?php $scan_file_perent = scan_file_perent_type(); ?>
					                            <select data-inrr="0" class="form-control scan_file_types" name="scan_file_types[]" id="scan_file_types">
					                                <option value="">चयन करें</option>
					                                <?php foreach($scan_file_perent as $key => $scan_file){ ?>
					                                    <option value=" <?php echo $key ; ?>"><?php echo $scan_file ; ?></option>
					                                <?php } ?>
					                            </select>
                                                <?php echo form_error('scan_file_types');?>
                                            </div>

                                            <div class="col-xs-6">
                                                <label for="Document">नस्ती / पत्र  का उप प्रकार</label> <span class="text-danger">*</span></label>
                                                    <div id="scan_subfile_types_div0">
												        <select class="form-control" name="scan_subfile_types[]" id="scan_subfile_types0">
					                                    </select>
					                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="Meta">मेटा कुंजी दर्ज करें जिससे इस फाइल  को खोजा  जा सकें </label>
                                    <input type="text" name="meta_key" id="meta_key" value="<?php if ($this->input->post('meta_key')){ echo $this->input->post('meta_key');} ?>" placeholder="Document" class="form-control" >
                                    <?php echo form_error('meta_key');?>
                                </div>

                                <div class="form-group">
                                    <label for="Document">नस्ती / पत्र  स्केन  प्रकार</label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="doc_scan_type">
                                        <option value="front"  <?php  if($this->input->post('doc_scan_type')== 'front'){ echo 'selected';} ?>>Only front page of document</option>
                                        <option value="full"  <?php  if($this->input->post('doc_scan_type')== 'full'){ echo 'selected';} ?>>Whole document</option>
                                    </select>
                                </div>

                                <input type="hidden" name="save_meta" id="save_meta" />
                                <div class="form-group text-center">
                                    <input type="checkbox" name="check_field" id="check_field">
                                    <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
                                </div>
                            </div><!-- /.column 6 -->

                        </div><!-- /row -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-right">
                        <button class="btn btn-primary margin" id="submit_btn_scan" name="edit_scan_files" value="normal_flow" disabled onclick="return confirm_generate_scan()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                        <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('reset_btn'); ?></button>
                    </div>

                    <span class="text-danger text-right"><?php echo $this->lang->line('m_note');?></span>
            </div>
            </form>
        </div><!-- /.box -->
    </div><!-- /.column 12 -->
    </div><!-- /row -->
</section><!-- /.content -->
<?php $this->load->view('view_footer_script'); ?>
