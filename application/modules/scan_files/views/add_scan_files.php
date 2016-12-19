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
        <li class="active">नस्ती / पत्र को  अपलोड करें </li>
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
                <form role="form" method="post" action="<?php echo base_url()?>scan_files/manage_scan_files<?php if(isset($id)){ echo '/'.$id;} ?>"  enctype="multipart/form-data" id="scan_form">
					<input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo isset($file_id)?$file_id:''; ?>">
					<input type="hidden" name="url_red" id="url_red" value="<?php echo isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:''; ?>">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="form-group">
                                    <input id="uploadImage1" type="file" name="file_upload" onchange="PreviewImage(1);" style="float: left"/>
									 नस्ती / पत्र  का अपलोड साइज़ : 10 MB
                                    <input type="button" id="reset_pdf" value="Remove doc" style="float: right"/>
                                    <span id="dis_file_size"></span>
                                </div>
                                <div class="form-group" style="border: 1px solid gray;height: 600px;" id="scan_file_div">
                                    <!--  <object id="uploadPreview1" data="<?php echo base_url()?>/uploads/Viwer_example.pdf" width="100%" height="600px"></object>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="Title">नस्ती / पत्र  का नाम</label> <span class="text-danger">*</span></label>
                                    <input type="text" name="file_title" id="file_title" value="<?php if ($this->input->post('file_title')){ echo $this->input->post('file_title');} ?>" placeholder="File title" class="form-control">
                                    <?php echo form_error('file_title');?>
                                </div>
								
								<div class="form-group">
                        <label for="file_mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="file_mark_section_id" id="file_mark_section_id">
                            <?php foreach($section_list as $row){
                                if($file_details[0]['file_mark_section_id'] == $row['section_id']){ ?>
                                    <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($file_details[0]['file_mark_section_id'] == $row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                                <?php  }} ?>
                        </select>
                        <?php echo form_error('file_mark_section_id');?>
                    </div>

                                <div class="form-group">
                                    <label for="Meta">मेटा कुंजी दर्ज करें जिससे इस फाइल  को खोजा  जा सकें </label>
                                    <input type="text" name="meta_key" id="meta_key" value="<?php if ($this->input->post('meta_key')){ echo $this->input->post('meta_key');} ?>" placeholder="Document" class="form-control">
                                    <?php echo form_error('meta_key');?>
                                </div>

                                <div class="form-group">
                                    <label for="Document">नस्ती / पत्र  स्केन  प्रकार </label> <span class="text-danger">*</span></label>
                                    <select class="form-control" name="doc_scan_type">
                                        <option value="front"  <?php  if($this->input->post('doc_scan_type')== 'front'){ echo 'selected';} ?>>Only front page of document</option>
                                        <option value="full"  <?php  if($this->input->post('doc_scan_type')== 'full'){ echo 'selected';} ?>>Whole document</option>
                                    </select>
                                    <?php echo form_error('meta_key');?>
                                </div>
								
								<div class="form-group">
                        <label for="Document">नस्ती / पत्र  प्रकार</label> <span class="text-danger">*</span></label>
                        <select class="form-control" name="scan_file_types" id="scan_file_types" required="">
                            <option value="">चयन करें</option>
                            <option value="1">बाह्य पत्राचार</option>
                            <option value="2">बाह्य नोटशीट</option>
                            <option value="3">विभागीय नोटशीट</option>
                            <option value="4">विभागीय पत्राचार</option>
                        </select>
                        <?php echo form_error('scan_file_types');?>
                    </div>

                    <div class="form-group">
                        <label for="Document">नस्ती / पत्र  उप प्रकार</label> <span class="text-danger">*</span></label>
                        <select class="form-control" name="scan_subfile_types" id="scan_subfile_types" required="">
                        </select>
                    </div>

                                <div class="form-group">
                        <label for="file_subject"> विवरण </label> <span class="text-danger">*</span></label>
                        <textarea class="form-control"  name="file_subject" placeholder="Put subject here" required=""><?php echo @$this->input->post('file_subject') ? $this->input->post('file_subject') : $file_details[0]['file_subject'] ; ?></textarea>
                        <?php echo form_error('file_subject');?>
                    </div>
         <!---file from sratr-->					
<div style="">
                    <div class="form-group">
                        <label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> <span class="text-danger">*</span> </label>
                        <select class="form-control" name="file_offer_by" id="file_offer_by">
                            <!--<option value=""><?php /*echo $this->lang->line('option_select_from'); */?></option>-->
                            <?php foreach(file_from_type() as $key => $value){
                                if($file_details[0]['file_Offer_by'] ==  $key){?>
                                    <option value="<?php echo $key ?>" <?php if ($file_details[0]['file_Offer_by'] == $key) { echo "selected";} ?>><?php echo $value ?></option>
                                <?php   } } ?>
                        </select>
                        <?php echo form_error('file_offer_by');?>
                    </div>

                    <div class="form-group"  id="High_court_show" <?php if(($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u') || ($file_details[0]['file_Offer_by'] == 'm' || $file_details[0]['file_Offer_by'] == 'u')) { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="court_bench" id="court_bench">
                            <?php $i = 1; foreach(highcourt_bench() as $key => $value){
                                if($file_details[0]['court_bench_id'] == $key){?>
                                    <option value="<?php echo $key ?>" <?php if ($this->input->post('court_bench') == $key) { echo "selected";} ?>><?php echo $value ?></option>
                                    <?php $i++; }} ?>
                        </select>
                        <?php echo form_error('court_bench');?>
                    </div>

                    <div class="form-group" id="dept_id_show" <?php if($this->input->post('file_offer_by') == 'v' || $file_details[0]['file_Offer_by'] == 'v') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="file_department_id"><?php echo $this->lang->line('label_dept_name'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="file_department_id" id="file_department_id">
                            <!-- <option value=""><?php /*echo $this->lang->line('option_select_dept'); */?></option>-->
                            <?php foreach($departments_list as $row){
                                if($file_details[0]['file_department_id'] == $row['dept_id']){?>
                                    <option value="<?php echo $row['dept_id']; ?>" <?php  if($this->input->post('file_department_id') == $row['dept_id']){ echo 'selected';} ?>><?php echo $row['dept_name_hi'].",".$row['dept_name_en']; ?></option>
                                <?php }} ?>
                        </select>
                        <?php echo form_error('file_department_id');?>
                    </div>

                    <div class="form-group" id="dist_id_show" <?php if(($this->input->post('file_offer_by') == 'c' || $this->input->post('file_offer_by') == 'jvn') || ($file_details[0]['file_Offer_by'] == 'c' || $file_details[0]['file_Offer_by'] == 'jvn')) { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="district_id"><?php echo $this->lang->line('label_district_name'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="district_id" id="district_id">
                            <?php $i = 1; foreach($district_list as $row){
                                if($file_details[0]['file_district_id'] == $row['district_id']){?>
                                    <option value="<?php echo $row['district_id']; ?>" <?php  if($this->input->post('district_id')==$row['district_id']){ echo 'selected';} ?>><?php echo $row['district_name_hi'].','.$row['district_name_en']; ?></option>
                                    <?php $i++; }} ?>
                        </select>
                        <?php echo form_error('district_id');?>
                    </div>

                    <div class="form-group" id="state_id_show" <?php if($this->input->post('file_offer_by') == 'au' || $file_details[0]['file_Offer_by'] == 'au') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="district_id"><?php echo $this->lang->line('label_state_name'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control" name="state_id" id="state_id">
                            <?php $i = 1; foreach($state_list as $row){
                                if($file_details[0]['file_state_id'] == $row['state_id']){?>
                                    <option value="<?php echo $row['state_id']; ?>" <?php  if($this->input->post('state_id')==$row['state_id']){ echo 'selected';} ?>><?php echo $i." - ".$row['state_name_hi'].'('.$row['state_name_en'].')'; ?></option>
                                    <?php $i++; }} ?>
                        </select>
                        <?php echo form_error('state_id');?>
                    </div>

                    <div class="form-group" id="suprem_court_show" <?php if($this->input->post('file_offer_by') == 'sc' || $file_details[0]['file_Offer_by'] == 'sc') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="suprem_court_show"><?php echo $this->lang->line('label_suprem_court'); ?> <span class="text-danger">*</span></label>
                        <input type="text" name="suprem_court" id="suprem_court" value="<?php echo @$this->input->post('suprem_court') ? @$this->input->post('suprem_court') : 'Delhi , दिल्ली';  ?>"  class="form-control" disabled>
                    </div>

					<div class="form-group delhi_advocate">
                    <?php if($this->input->post('file_offer_by') == 'sc' || $file_details[0]['file_Offer_by'] == 'sc')  {
                    $get_satand_name = get_list(FILES_OTHER_FEILDS,null,array('f_file_id' => $file_id1));  ?>
                        <input type="text" name="gov_adocate_delhi" value="<?php echo $get_satand_name[0]['gov_adocate_delhi'] ; ?>"  readonly="" />
                    <?php } ?>
					</div>
					

                    <div class="form-group" id="dept_name_show" <?php if($this->input->post('file_offer_by') == 'o' || $file_details[0]['file_Offer_by'] == 'o') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                        <label for="file_department_name" id="other_label"><?php echo $this->lang->line('more_detail'); ?></label>
                        <input type="text" name="file_other_name" id="file_other_name" value="<?php echo @$this->input->post('file_other_name') ? $this->input->post('file_other_name') : $file_details[0]['file_department_name'] ?>" placeholder="<?php echo $this->lang->line('more_detail'); ?>" class="form-control">
                        <?php echo form_error('file_other_name');?>
                        <p class="form-helper other_hide" id="otherdept1" style="display:none" ><?php echo $this->lang->line('helper_dept_name'); ?></p>
                    </div>
</div>

                                <div class="form-group text-center">
                                    <input type="checkbox" name="check_field" id="check_field">
                                    <label><?php echo $this->lang->line('check_field'); ?></label><?php echo form_error('check_field');?>
                                </div>

                                <input type="hidden" name="save_meta" id="save_meta" />

                                <div class="box-footer text-center">
                                    <button class="btn btn-primary margin" id="submit_btn_scan" disabled onclick="return confirm_generate()" type="submit"><?php echo $this->lang->line('button_submit'); ?></button>
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
<script src="<?php echo base_url(); ?>themes/pdf_preview.js" type="text/javascript"></script>
<!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->
<script type="text/javascript">

    $('#scan_add_data').on('submit', function (){
        var insertText = $('#meta_key').val();
        var insertText1 = $('#file_mark_section_id option:selected').text();

        if($('#file_offer_by').val() == 'c' || $('#file_offer_by').val() == 'jvn'){
            var insertText3 = $('#dist_id_show option:selected').text();
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            var insertText3 = $('#High_court_show option:selected').text();
        } else if($('#file_offer_by').val() == 'au'){
            var insertText3 = $('#state_id_show option:selected').text();
        }else if($('#file_offer_by').val() == 'v'){
            var insertText3 = $('#dept_id_show option:selected').text();
        }else if($('#file_offer_by').val() == 'sc'){
            var insertText3 = $('.delhi_advocate option:selected').text();
        }else{
            var insertText3 = $('.dept_name_show').val();
        }
        var insertText4 = $('#file_offer_by option:selected').text();

          $('#save_meta').val(insertText+','+insertText1+','+insertText4+','+insertText3);

    });




    $('#check_field').change(function(){
        if($('#check_field').is(':checked')){
            $("#submit_btn_scan").prop("disabled", false);
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
            $("#dist_id_show , #dept_id_show , #High_court_show , #suprem_court_show, #state_id_show").hide();
            $(".delhi_advocate").hide();
            $("#dept_name_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
            $("#file_other_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });
    function chenge_otherdepname(){
        $("#other_label").text('<?php echo $this->lang->line('more_detail');?>');
        $("#file_other_name").attr('placeholder','<?php echo $this->lang->line('more_detail');?>');
    }
    $(document).ready(function(){
        var maxField = 5; 
        var addButton = $('.add_button'); 
        var removebtn = $('.remove_button'); 
        var wrapper = $('.field_wrapper1'); 
        var incr = 1;
        var x = 1; 

        $(addButton).click(function(){ 
            if(x < maxField){ 
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

<script type="text/javascript">
    function PreviewImage(no) {
          var  file_size1 = document.getElementById("uploadImage"+no).files[0].size/ 1048576;
      
        if(file_size1 <= '10') {
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("uploadImage" + no).files[0]);

            oFReader.onload = function (oFREvent) {
                document.getElementById("uploadPreview" + no).data = oFREvent.target.result;
            };
            var sf = document.getElementById("uploadImage"+no).files[0].name;
            sf = sf.substring(0, sf.indexOf('.'));
            $('#file_title').val(sf);
        }
        else{
            alert('u choose more then 10 mb file');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
            $('#uploadImage1').val('');
        }
    }
    $(document).ready(function(){
        $('#reset_pdf').on('click', function() {
            $('#uploadImage1').val('');
            $('#scan_file_div').empty().append('<object id="uploadPreview1" width="100%" height="600px"></object>');
        });
		
		  $("#scan_file_types").change(function() {
            var scan_file_types = $(this).val();
			var section_id = '<?php echo $file_details[0]['file_mark_section_id'];  ?>';
            
            var HTTP_PATH='<?php echo base_url(); ?>';
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "scan_files/get_subfiletype",
                datatype: "json",
                async: false,
                data: {scan_file_id: scan_file_types,
				section_id: section_id},
                success: function(data) {
                    var r_data = JSON.parse(data);
                    
                    var otpt = '<option value="">Select</option>';
                    $.each(r_data, function( index, value ) {
                        
                        otpt+= '<option value="'+value.type_id+'">'+value.sub_file_type+'</option>';
                    });
                    $("#scan_subfile_types").html(otpt);
                }
            });
        });
		
    });
</script>
