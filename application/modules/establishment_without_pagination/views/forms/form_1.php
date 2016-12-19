
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
            <div class="box">
                <div class="box-header">
                    <div style="float:left"><h3 class="box-title"><?php echo $title_tab;?></h3></div>
                    <button class="btn btn-warning" title="Back" onclick="goBack()" style="float:right"><?php echo $this->lang->line('Back_button_label'); ?>
                </div>


            </div><!-- /.box-header -->
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
            <div class="col-md-12">
                <!-- general form elements -->
                <!-- /.box-header -->
                <!-- form start -->

                <form role="form" method="post" action="<?php echo base_url()?>establishment/manage_forms/manage_files<?php if(isset($id)){ echo '/'.$id;} ?>"  enctype="multipart/form-data">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="file_type"><?php echo $this->lang->line('label_type'); ?></label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="file_type" id="file_type">
                                        <?php foreach(file_types() as $key => $value){
                                            echo '<option value="'.$key.'" >'.$value.'</option>';
                                        } ?>
                                    </select>
                                    <?php echo form_error('file_type');?>
                                </div>

                                <!--Dropdown-->
                                <div class="form-group" id="other_file_div">
                                    <label for="file_type">File mark</label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="other_file_type" id="other_file_type">
                                        <?php
                                        foreach(es_file_marktype() as $key => $value){
                                            echo '<option value="'.$key.'"  >'.$value.'</option>';
                                        }?>
                                    </select>
                                    <?php echo form_error('other_file_type');?>
                                </div>



                                <div class="form-group">
                                    <label for="file_mark_section_id"  id="file_mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                                    <?php $mark_to_officer = upper_officers_list(); //pre($mark_to_officer);?>

                                    <?php $fdis='block'; if(isset($postdata['other_file_type'])){ if(@$postdata['other_file_type']=='1' || @$postdata['other_file_type']==''){ $dis='show'; $fdis='hide'; ?>
                                        <select class="form-control marktosc" name="file_mark_section_id" id="mark_to_section" style="display:<?php echo $fdis;?>">
                                        <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                                        <?php foreach($section_list as $row){
                                            if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 )|| ($row['section_id'] == 7)  ){}else{  ?>
                                                <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                                            <?php } } } ?>
                                        </select>
                                    <?php } else{  ?>

                                        <select class="form-control marktosc" name="file_mark_section_id" id="mark_to_section" style="display:none">
                                            <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                                            <?php foreach($section_list as $row){
                                                if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 )|| ($row['section_id'] == 7)  ){}else{  ?>
                                                    <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>

                                    <?php } ?>
                                    <?php echo form_error('file_mark_section_id');?>

                                    <?php if(isset($postdata['other_file_type'])){  if(@$postdata['other_file_type']=='2'){ $dis='none'; ?>
                                        <select class="form-control marktoof" name="file_mark_officer_id" id="mark_to_officer" style="display:<php echo $dis='none'; ?>">
                                            <option value="" id="select_t_o"><?php echo $this->lang->line('select_other_mark_to_officer'); ?></option>
                                            <?php foreach($mark_to_officer as $offrow){ ?>
                                                <option value="<?php echo $offrow['emp_id']; ?>"  class="officers" <?php if($this->input->post('file_mark_officer_id')==$offrow['emp_id']){ echo 'selected';} ?>><?php echo $offrow['emp_full_name'].", ".getemployeeRole($offrow['role_id'])//if($offrow['emp_section_id']==''); ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } }else { ?>

                                        <select class="form-control marktoof" name="file_mark_officer_id" id="mark_to_officer" style="display:none">
                                            <option value="" id="select_t_o"><?php echo $this->lang->line('select_other_mark_to_officer'); ?></option>
                                            <?php foreach($mark_to_officer as $offrow){ ?>
                                                <option value="<?php echo $offrow['emp_id']; ?>" class="officers" <?php if($this->input->post('file_mark_section_id')==$offrow['emp_id']){ echo 'selected';} ?>><?php echo $offrow['emp_full_name'].", ".getemployeeRole($offrow['role_id'])//if($offrow['emp_section_id']==''); ?></option>
                                            <?php } ?>
                                        </select>

                                    <?php } ?>
                                    <?php echo form_error('file_mark_officer_id');?>


                                    <?php if(isset($postdata['other_file_type'])){  if(@$postdata['other_file_type']=='3'){ $dis='none'; ?>
                                        <select class="form-control marktoof" name="es_user" id="es_user" style="display:<php echo $dis='none'; ?>">
                                            <option value="" id="select_t_o"><?php echo $this->lang->line('select_other_mark_to_officer'); ?></option>
                                            <?php  foreach(get_establishment_employees() as $key => $emp_details){
                                                echo '<option value="'.$emp_details['emp_id'].'"  >'.emp_gender($emp_details['emp_id']).' '.$emp_details['emp_full_name_hi'].' ('.getemployeeRole($emp_details['role_id']).')</option>';
                                            }?>
                                        </select>
                                    <?php } } else{ ?>
                                        <select class="form-control marktoof" name="es_user" id="es_user"  style="display:<?php echo $fdis;?>">
                                            <option value="" id="select_t_o">Establishment Users</option>
                                            <?php  foreach(get_establishment_employees() as $key => $emp_details){
                                                echo '<option value="'.$emp_details['emp_id'].'"  >'.emp_gender($emp_details['emp_id']).' '.$emp_details['emp_full_name_hi'].' ('.getemployeeRole($emp_details['role_id']).')</option>';
                                            }?>
                                        </select>
                                    <?php } ?>

                                </div>

                                <div class="form-group" id="">
                                    <label for="file_uo_number" id="dispaly_num">Information</label> <span class="text-danger">*</span></label>
                                    <input type="text" name="file_uo_number"  onchange="checkUOnumber(this.value)" value="<?php echo isset($val_file_uo_number) ? $val_file_uo_number : ''; ?>" placeholder="<?php echo $this->lang->line('placeholder_dispatch_number'); ?>" class="form-control">
                                    <?php echo form_error('file_uo_number');?>
                                    <span id="error-uonumner" style="color:#D04545;" ></span>
                                </div>

                                <div class="form-group">
                                    <label for="file_uo_date" id="dispaly_date">Information Date</label> <span class="text-danger">*</span></label>
                                    <input type="text" name="file_uo_date" id="file_uo_date" value="<?php if ($this->input->post('file_uo_date')){ echo $this->input->post('file_uo_date');}  ?>" placeholder="<?php echo $this->lang->line('placeholder_dispatch_date'); ?>" class="form-control">
                                    <?php echo form_error('file_uo_date');?>
                                </div>

                                <div class="form-group">
                                    <label for="file_subject">Subject </label> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="file_subject" placeholder="Put subject here"><?php echo isset($val_file_subject) ? $val_file_subject : ''; ?></textarea>
                                    <?php echo form_error('file_subject');?>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="file_subject">File From</label> <span class="text-danger">*</span></label>
                                    <select class="form-control marktosc" name="file_from_section_id" id="file_from_section_id">
                                        <option value="">Select</option>
                                        <?php foreach($section_list as $row){
                                            if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 )|| ($row['section_id'] == 7) ){}else{  ?>
                                                <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                                            <?php } }  ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="file_subject">Description </label> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4"  name="file_description" placeholder="Put description  here"><?php echo isset($val_file_subject) ? $val_file_subject : ''; ?></textarea>
                                    <?php echo form_error('file_subject');?>
                                </div>

                                <div class="form-group">
                                    <label for="from_id">File Upload (if any)</label>
                                    <input type="file" name="file_upload"/>
                                </div>


                                <div class="form-group text-center">
                                    <input type="checkbox" name="check_field" id="check_field">
                                    <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
                                </div>

                                <div class="box-footer text-center">
                                    <button class="btn btn-primary margin" id="submit_btn" disabled onclick="return confirm_generate()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
                                    <button class="btn btn-danger margin" type="reset"><?php echo $this->lang->line('reset_btn'); ?></button>
                                </div>
                                <span class="text-danger"><?php echo $this->lang->line('m_note');?></span>
                            </div>
                        </div>
                    </div>
            </div><!-- /.box-body -->
            </form>
        </div><!-- /.box -->
    </div>
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var tem_file_to = '<?php  echo isset($postdata["other_file_type"])?$postdata["other_file_type"] :'';?>';
        if(tem_file_to=='2' || tem_file_to=='3'){
              $(".marktosc").hide();
        }
    });
    $(function() {
        $('#file_department_id').change(function(){
            if($('#file_department_id').val() != 'other'){
                $("#dept_name_show").hide();
            } else  {
                $("#dept_name_show").show();
            }  });


        /*Get upper user name*/
        $(".user_sectionwise").click(function () {
            var file_id = $(this).val();
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "establishment/upper_role_officer/"+file_id,
                datatype: "json",
                async: false,
                data: {file_id: file_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    var otpt1 = '<select class="form-control" name="emp_id2">';
                    $.each(r_data, function( index, value ) {
                        otpt1 += '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emprole_name_hi+')</option>';
                    });
                    otpt1 += '</select>';
                    $("#emp_byfile2").html(otpt1);
                }
            });
        });





    });

    $(function() {
        $('#file_type').change(function(){
            if($('#file_type').val() == 'f'){
                $('#dispaly_num').html("<?php echo $this->lang->line('label_uo_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_uo_date'); ?>");

            } else if($('#file_type').val() == 'l') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'a') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'r') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_letterno_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }else if($('#file_type').val() == 'n') {
                $('#dispaly_num').html("<?php echo $this->lang->line('label_notice_number'); ?>");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_notice_date'); ?>");

            }else if($('#file_type').val() == 's') {
                $('#dispaly_num').html("<?php echo 'फ़ाइल क्रमांक'; ?>");
                $('#dispaly_date').html("<?php echo 'फ़ाइल दिनांक'; ?>");

            }
            else if($('#file_type').val() == 'w') {
                $('#dispaly_num').html("<?php echo 'Write petion No.'; ?>");
                $('#dispaly_date').html("<?php echo 'Write petition Date'; ?>");

            } else {
                $('#dispaly_num').html("कोई पहचान दर्ज कीजीये (Name)");
                $('#dispaly_date').html("<?php echo $this->lang->line('label_letterno_date'); ?>");

            }
        });

        $('#other_file_type').change(function(){
            var file_for=$(this).val();
            if(file_for==1){
                $('#file_mark_section_id').html("<?php echo $this->lang->line('label_mark_section'); ?>");
                $('#select_t_s').text("<?php echo $this->lang->line('option_select_section'); ?>");
                $("#mark_to_section").show();
                $("#mark_to_officer").hide();
                $("#es_user").hide();
            } else if(file_for==2) {
                $('#file_mark_section_id').html("<?php echo $this->lang->line('other_mark_to_officer'); ?>");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").show();
                $("#es_user").hide();
            }else if(file_for==3) {
                $('#file_mark_section_id').html("ES USERS");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").hide();
                $("#es_user").show();
            }
        })
    });
    $('#check_field').change(function(){
       
        if($('#check_field').is(':checked')){
            $("#submit_btn").prop("disabled", false);
        }else{
            $("#submit_btn").prop("disabled", true);
        }
       

    });
    
    $('#file_offer_by').change(function(){
        if($('#file_offer_by').val() == 'c' || $('#file_offer_by').val() == 'jvn'){
            $("#dist_id_show").show();
            $("#High_court_show, #dept_name_show , #suprem_court_show ,#dept_id_show,#state_id_show").hide();
            $(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show").show();
            $(".delhi_advocate").hide();
            chenge_otherdepname();
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
            $(".delhi_advocate").hide();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#dist_id_show,#state_id_show").hide();
            $("#dept_id_show").show();
            $(".delhi_advocate").hide();
            chenge_otherdepname();
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show, .delhi_advocate").show();
            chenge_otherdepname();
        } else  {
            $("#dist_id_show , #dept_id_show , #High_court_show , #suprem_court_show,#state_id_show").hide();
            $(".delhi_advocate").hide();
            $("#dept_name_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
            $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });

    function chenge_otherdepname(){
        $("#other_label").text('<?php echo $this->lang->line('more_detail');?>');
        $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('more_detail');?>');
    }

    $(document).ready(function(){
        var maxField = 5; 
        var addButton = $('.add_button'); 
        var removebtn = $('.remove_button'); 
        var wrapper = $('.field_wrapper1'); 
        var incr = 1;
        var x = 1; 

        $(addButton).click(function(){ 
            if(x < maxField){ /
                x++; 
                var fieldHTML = '<div class="row" id="TextBoxDiv' + x + '"><div class="col-xs-4 casetype"><select name="files_other_feilds[case_type]['+incr+']" class="form-control"><option value="">Select type</option><?php foreach(case_name() as $case){ ?><option value="<?php echo $case ?>"><?php echo $case ?></option><?php } ?></select></div><div class="col-xs-4"><input type="text" name="files_other_feilds[case_no]['+incr+']" placeholder="Number" value="" class="form-control"></div><div class="col-xs-3"><select Name="files_other_feilds[case_year]['+incr+']" class="form-control"><?php for ($x=date("Y"); $x>2000; $x--) { echo'<option value="'.$x.'">'.$x.'</option>';  } ?></select></div><div class="col-xs-1"></div>  </div>'; 
                $(wrapper).append(fieldHTML); 
                incr++
            }
        });

        $(removebtn).click(function () {
            if(x > 1 && incr >  1) {
                $("#TextBoxDiv" + x).remove();
                x--;
                incr--;
            }
        });
    });
</script>
