<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
        <!-- <small>Optional description</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url('admin');?>/sections"></a></li>
        <li class="active"><?php echo $page_title; ?></li>
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
                    <div style="float:left"><h3 class="box-title"><?php echo $page_title;?></h3></div>
                    
                    <?php
                    if($is_page_edit==0){ ?>
                        <div style="float:right;padding-left: 10px;">
                            <a href="<?php echo base_url('admin');?>/add_sub_file_type">
                                <button class="btn btn-block btn-info"><?php echo $this->lang->line('add_button'); ?></button>
                            </a>
                        </div>
                    <?php } ?>
                    <div style="float:right;">
                        <a href="javascript:history.go(-1)">
                            <button class="btn btn-block btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                </div><!-- /.box-header -->
                <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url()?>sub_file_type/manage_sub_file_type/<?php if(isset($id)){ echo '/'.$id;} ?>">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="box box-primary" style="margin-top: 15px;">
                            <!-- form start -->
                            <?php echo $this->session->flashdata('message'); ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo $this->lang->line('section_name'); ?><span class="text-danger">*</span></label>
									  <?php 
									if(isset($id)){
										
									}else{

									}
                                    $sections = get_list(SECTIONS, null, null);
										
                                   ?>
                                    <select class="form-control" name="section_id" >
                                        <option value=""><?php echo $this->lang->line('section_name'); ?></option>
                                            <?php foreach ($sections as $empk => $emp_section) { ?>
                                               <?php if($get_types['sub_file_type_section_id'] == $emp_section['section_id']){
												   ?>
												    <option value="<?php echo $emp_section['section_id']; ?>" selected ><?php echo $emp_section['section_name_hi']; ?> (<?php echo $emp_section['section_name_en']; ?>)  </option>
												   <?php
											    } else { ?>
                                                    <option value="<?php echo $emp_section['section_id']; ?>"  ><?php echo $emp_section['section_name_hi']; ?> (<?php echo $emp_section['section_name_en']; ?>)  </option>
												<?php } ?>
                                            <?php } ?>
                                    </select>
                                    <?php echo form_error('section_id');?>
                                </div>                              

                                <div class="form-group">
                                    <label for="exampleInputPassword1"><?php echo $this->lang->line('type_name'); ?><span class="text-danger">*</span></label>
                                     <input type="text" name="type_name" id="type_name" placeholder="<?php echo $this->lang->line('type_name'); ?>" value="<?php echo (@$get_types['sub_file_type_name'] ? @$get_types['sub_file_type_name']:'');  echo isset($input_data['type_name'])? $input_data['type_name'] : '' ;?>" placeholder="" class="form-control">
									  <?php echo form_error('type_name');?>
                                </div>
                                
                             </div><!-- /.box-body -->
							 <div class="box-footer">
                                <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
                            </div>
                             </div><!-- /.box -->
                        </div>
					</form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<!-- jQuery 2.1.4 -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('#section_div').hide();
        $('#notice_type_id').change(function(){
         
            if($('#notice_type_id').val() == '2'){
                $('#section_div').show();
            } else {
                $('#section_div').hide();
            }

        })
    })
</script>


    