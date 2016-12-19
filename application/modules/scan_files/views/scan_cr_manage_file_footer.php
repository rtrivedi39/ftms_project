<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>themes/pdf_preview.js" type="text/javascript"></script>
<!--<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>-->


<script type="text/javascript">

$(document).ready(function() {
    $('#result_load').load('<?php echo base_url() ; ?>scan_files/files_scan_upolad/add_new_scan');
    $('.add_filed').show();
    $("#new").prop('disabled', true);
    $("#add").prop('disabled', false);
});

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
            }  })
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
                $(".petition_file_cls").show();
           
            } else if(file_for==2) {
                $('#file_mark_section_id').html("<?php echo $this->lang->line('other_mark_to_officer'); ?>");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").show();
                $(".hide_cls").hide();
            }else if(file_for==3) {
                $('#file_mark_section_id').html("<?php echo $this->lang->line('other_mark_to_officer'); ?>");
                $('#select_t_s').text("<?php echo $this->lang->line('select_other_mark_to_officer'); ?>");
                $("#mark_to_section").hide();
                $("#mark_to_officer").show();
                $(".hide_cls").hide();
            }
        })
    })
    $('#check_field').change(function(){
        
        if($('#check_field').is(':checked')){
            $("#submit_btn_scan").prop("disabled", false);
        }else{
            $("#submit_btn_scan").prop("disabled", true);
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


        $('.choose_option_addscan').on('click', function() {
            if($(this).val() == 'new'){
                $('#result_load').load('<?php echo base_url() ; ?>scan_files/files_scan_upolad/add_new_scan');
                $('.add_filed').show();
                $("#new").prop('disabled',true);
                $("#add").prop('disabled',false);
               
            }else if($(this).val() == 'add'){
                $('#result_load').load('<?php echo base_url() ; ?>scan_files/files_scan_upolad/add_created_scan');
                $('.add_filed').show();
                $("#add").prop('disabled',true);
                $("#new").prop('disabled',false);
            }
        });

        $('#scan_add_data').on('submit', function (){
            var insertText = $('#meta_key').val();
            var insertText1 = $('.marktosc option:selected').text();
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
				
    });


</script>
