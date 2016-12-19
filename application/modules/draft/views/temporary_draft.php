<link href="<?php echo base_url(); ?>themes/e_file_style.css" rel="stylesheet" type="text/css" />
<?php //pr($file_data); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<?php

$url = $subject =  $log_id = null;
$content = 'अनुमोदनार्थ';
if(isset($draft_id) && $draft_id != ''  ){
    $draft_data = get_draft($draft_id);
    $url = '/'.$draft_data['draft_id'];
    if($draft_data['draft_sender_id'] == $draft_data['draft_reciever_id'] && ($draft_data['draft_status'] == 2 || $draft_data['draft_status'] == 3)){
        $content = $draft_data['draft_content_text'];
        $log_id = get_last_log_id($draft_data['draft_id'],$draft_data['draft_reciever_id']);
    } 
  
}  

?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $sub_title; ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url();?>efile/<?php echo $file_data[0]['file_id'];?>" class="btn btn-danger"><i class="fa fa-file-o"></i> Back</a>
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                    </div>
                </div><!-- /.box-header -->
                <form method="post" name="save_draft" action="<?php echo base_url(); ?>draft/draft/save_draft_file<?php echo $url; ?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label>विषय</label>
                           <?php echo   $subject = isset($file_data[0]['file_subject']) ? $file_data[0]['file_subject'] : ''; ?>
                        
                        </div>
                        <div class="form-group">
                            <?php if(isset($draft_data)){
                                $all_drafts = get_draft_log_data($draft_data['draft_id']);
                                if(!empty($all_drafts)){
                                    if($draft_data['draft_type'] == 'n'){
                                        $style = 'padding:2% 13%; background-color:#CCFFCC;';
                                    }else {
                                        $style = 'padding:2% 5%; background-color:#eee;';
                                    }
                                    ?>
                                    <label>ई-<?php echo draft_type($draft_type); ?>  हस्त लेख</label>
                                    <div class="mailbox-read-message no-padding" id="for-print" style="overflow-Y:scroll; max-height:300px;">
                                       
                                    </div><!-- /.mailbox-read-message -->
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <div class="form-group text_editor" id="text_editor" >
                            <label>ई-<?php echo draft_type($draft_type); ?><?php echo $this->lang->line("hand_sheet"); ?></label>
							<div class="form-group text_editor " contenteditable="true" id="text_editor" >
							<div  class="show_content" >
								<div ><?php echo $this->session->userdata('draft_content_text') ?></div>
								<div class="form-group" align="right" style="margin-top:50px;" >
								<div  style="width:50%; text-align:center;"   contenteditable="false">(Digitally Signed)</div>
								<div class="officer-center"   contenteditable="false"> <div> ( <?php echo  get_officer_information($this->input->post('sing_user'));  ?> )</div></div>
								<div class="officer-center"   contenteditable="false"><div><?php echo $officer_dign; ?></div></div>
								<div  class="officer-center"><?php echo $department_mp; ?> </div><br><br><br>
								<div  class="clearfix" ></div>
								<div  class="form-group pull-left" ><?php echo $send_department; ?> </div>
							</div>
							</div>
						</div>
						
                    </div><!-- /.box-body -->
                    <div class="box-footer text_editor">
                        <div class="pull-right">
							<input type="hidden" name="officer_id" id="officer_id" value="<?php echo $this->input->post('sing_user') ?>" >
							<input type="hidden" value="" name="final_content" id="final_content"/>
                            <input type="hidden" name="file_id"  id="file_id" value ="<?php echo isset($file_data[0]['file_id']) ? $file_data[0]['file_id'] : ''; ?>" >
                            <input type="hidden" name="Section_id1" id="Section_id1" value ="<?php echo isset($file_data[0]['file_mark_section_id']) ? $file_data[0]['file_mark_section_id'] : ''; ?>" >
                            <input type="hidden" name="log_id" value ="<?php echo $log_id; ?>" >
                            <input type="hidden" name="draft_type" id="draft_type" value ="<?php echo isset($draft_type) ? $draft_type : ''; ?>" >
                            <input type="hidden" name="draft_subject" id="draft_subject" value ="<?php echo $this->input->post('draft_subject');?>" >
                            <!--<button type="submit" name="btnadddraft" value="add_draft" onClick="return confirm('कृपया सुनिश्चित कर ले की आप ड्राफ्ट पुनः एडिट के किये सहेज रहे है');" class="btn btn-primary"><i class="fa fa-pencil"></i><?php// echo $this->lang->line("btn_save_draft_to_file"); ?></button>-->
                            <a  href="<?php echo base_url() ?>draft/create_fileto_draft/<?php echo isset($file_data[0]['file_id']) ? $file_data[0]['file_id'] : ''; ?>/<?php echo isset($draft_type) ? $draft_type : ''; ?>" class="no-print btn btn-warning margin">वापस जाए और सुधार करे</a>
							
							
							<button type="button" onclick="save_notesheet();" id="btnsave_content" class="btn btn-primary margin" value="" name="savepdf"><i class="fa fa-pencil"></i> <?php echo $this->lang->line("btn_add_draft_to_file"); ?></button> <!--data-loading-text="Saving..."-->
                        </div>
                    
                   
                    </div><!-- /.box-footer -->
                </form>
            </div><!-- /. box -->
            
        </div><!-- /.col -->
        <!--Load Model for Voice Input tool-->
    </div><!-- /.row -->
</section><!-- /.content -->
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- 
	Include the WYSIWYG javascript files

  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'#compose-textarea' });</script>-->
<script type="text/javascript" src="<?php echo base_url()?>themes/ckeditor/ckeditor.js"></script>
<!-- 
	Attach the editor on the textareas
-->
<script src="<?php echo base_url(); ?>themes/pdfobject.js"></script>
<script src="<?php echo base_url(); ?>themes/e_file_style.js" type="text/javascript"></script>
<script>
function save_notesheet(){

 
	var conf = confirm('कपया सुनिश्चित करें कि आप इसे सुरक्षित करना चाहते है | ') ;
	
	if(conf == false ){
		return false;
	}
	$('#btnsave_content').button('loading');
	var content1 = $('.show_content').html().trim();
	content1 = encrypt('encode',content1);
	
	var d_type = $("#draft_type").val(); 
	var file_id = $("#file_id").val(); 
	var section_id = $("#Section_id1").val(); 
	var order_subject = $("#draft_subject").val(); 
	var notesheet_id = '';  
	var file_sts = 'e';  
	var head_id = ''; 
	var is_ajax_return = 1; 
	var d_id = ''; 
	var officer_id = $("#officer_id").val(); 
	
	var HTTP_PATH='<?php echo base_url(); ?>draft/save_draft_file/';
		
            $.ajax({
                url: HTTP_PATH ,
                type: 'POST',
                data: {
                draft_subject:order_subject,file_sts:file_sts, draft_content_text: content1,file_id:file_id,Section_id1:section_id,notesheet_id:notesheet_id,head_id:head_id,draft_type:d_type,officer_id:officer_id, is_ajax_return: is_ajax_return
                },       
                success: function(data) {
			
					if(data == 'saved'){
						window.location="<?php echo base_url(); ?>efile/"+file_id;
					}
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert("some error:- "+textStatus);
					}
			});
}
</script>
<script type="text/javascript">
    function open_file_in_viewer(scan_id ,file_path){
        var HTTP_PATH='<?php echo base_url(); ?>';
        var pdf = new PDFObject({
            url: HTTP_PATH+file_path ,
            id: "pdfRendered",
            height:"400px",
            width:"100%",
            pdfOpenParams: {
                view: "FitH"
            }
        }).embed("pdfRenderer");
        $("#pdf_viewer").hide();
		$("#full_veiwbtn").attr("href", HTTP_PATH+file_path);
    }

    function open_model2_addbookmark(scanid_id){
        var scanid_id = scanid_id;
        $('#bookmark_scan').attr('action','<?php echo base_url()?>scan_files/manage_sacn_bookmark/'+scanid_id);
        $("#scan_id").html(scanid_id);
        $('#modal-send_mark').modal('show');
    }

    function open_model(){
        $('#modal-delete').modal('show');
    }

  
    CKEDITOR.replace('compose_textarea',
        {
           
            height : 600,
            
        }
    );

    $(document).ready(function(){
		$("#for-print").animate({ scrollTop: $('#for-print').prop("scrollHeight")}, 1000);
        $("#edit").show();
        $("#typewithtext").hide();
        $('#voice_input').click(function(){
            $(".text_editor").hide();
            $("#typewithtext").show();
        });
        $('#btn_close').click(function(){
            $(".text_editor").show();
            $("#typewithtext").hide();
        });
        $('#btn_close_paste').click(function(){
            $(".text_editor").show();
            $("#typewithtext").hide();
			var final_old = CKEDITOR.instances.compose_textarea.getData();
            var final_new = $("#final_span").val();
            var final_data = final_old+' '+final_new;
            CKEDITOR.instances['compose_textarea'].setData(final_data);
			$("#final_span").val('');
        }); 
		$('#btn_clear').click(function(){ 
			var ret =  confirm('सुनिश्चित कर ले आप बोला हुआ डाटा डिलीट करना चाहते है'); 
			if(ret == true){
				$("#final_span").val('');
			} else{
				return false;
			}
        });
    });
    check_browser();
    function check_browser(){
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        /*// Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)*/
        var isFirefox = typeof InstallTrigger !== 'undefined';  /* // Firefox 1.0+*/
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
       /* // At least Safari 3+: "[object HTMLElementConstructor]"*/
        var isChrome = !!window.chrome && !isOpera;             /* // Chrome 1+*/
        var isIE = /*@cc_on!@*/false || !!document.documentMode;   /*// At least IE6*/

        var output = 'Detecting browsers by ducktyping:<hr>';
        if(isChrome==true){
            $("#voice_input").show();
        }else{
            $("#voice_input").hide();
        }
    }
</script>