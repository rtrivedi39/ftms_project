<div class="modal fade" id="scan_file_model" tabindex="-1" role="dialog" aria-labelledby="Dispatchmodel">

    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url() ;?>scan_file/addscan_fileda" method="post" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					
                    <h4 class="modal-title"><i class="fa fa-fw fa-search"></i>स्कैन के लिये फ़ाइल् खोजे</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
								<div class="form-group">
                <label for="file_uo_number">Meta key</label> <span class="text-danger">*</span></label>
                <input type="text" name="meta_key" id="meta_key" value="" placeholder="Document" class="form-control">
                <span id="error-meta_key" class="text-danger"></span>
            </div>
								 <div class="form-group">
								 
                <label for="file_subject"><?php echo $this->lang->line('label_subject'); ?></label></label>
                <textarea class="form-control"  id="file_subject"  name="file_subject" placeholder="Put subject here"><?php echo isset($val_file_subject) ? $val_file_subject : ''; ?></textarea>
               
            </div>

            <div class="form-group">
                <label for="file_mark_section_id"><?php echo $this->lang->line('label_mark_section'); ?> <span class="text-danger">*</span></label>
                <?php $fdis='block'; if(isset($postdata['other_file_type'])){ if(@$postdata['other_file_type']=='1' || @$postdata['other_file_type']==''){ $dis='show'; $fdis='hide'; ?>
				
                    <select class="form-control marktosc" name="file_mark_section_id"  id="mark_to_section" style="display:<?php echo $fdis;?>">
                    <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
                    <?php foreach($section_list as $row){
                        if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 ) ){}else{  ?>
                            <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';} ?>><?php echo $row['section_name_en'].", ".$row['section_name_hi']; ?></option>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                    </select>
					
                <?php } else{  ?>
                    <select class="form-control marktosc" name="file_mark_section_id" id="mark_to_section" style="display:<?php echo $fdis;?>">
                        <option value="" id="select_t_s"><?php echo $this->lang->line('option_select_section'); ?></option>
						<?php $section = getEmployeeSection(); ?>
                        <?php $i = 1; foreach($section_list as $row){
                            if( ($row['section_id'] == 21 ) || ($row['section_id'] == 26 ) ){}else{  ?>
                                <option value="<?php echo $row['section_id']; ?>" class="sections" <?php  if($this->input->post('file_mark_section_id')==$row['section_id']){ echo 'selected';}else if($section == $row['section_id']){ echo 'selected'; } ?>><?php echo $i." - ".$row['section_name_hi'].'('.$row['section_name_en'].')'; ?></option>
                            <?php } ?>
                            <?php $i++; } ?>
                    </select>
					
                <?php } ?>
                 <span id="error-file_mark_section_id" class="text-danger"></span>
            </div>

            <div class="form-group">
                <label for="offer_by"><?php echo $this->lang->line('offer_by'); ?> </label>
                <select class="form-control" name="file_offer_by" id="file_offer_by">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php foreach(file_from_type() as $key => $value){ ?>
                        <option value="<?php echo $key ?>" <?php if ($this->input->post('file_offer_by') == $key) { echo "selected";} ?>><?php echo $value ?></option>
                    <?php   } ?>
                </select>
              
            </div>
			 <div class="form-group" id="dept_id_show" <?php if($this->input->post('file_offer_by') == 'v') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="file_department_id"><?php echo $this->lang->line('label_dept_name'); ?></label>
                <select class="form-control" name="file_department_id" id="file_dep_id">
                    <option value=""><?php echo $this->lang->line('option_select_dept'); ?></option>
                    <?php foreach($departments_list as $row){ ?>
                        <option value="<?php echo $row['dept_id']; ?>" <?php  if($this->input->post('file_department_id')==$row['dept_id']){ echo 'selected';} ?>><?php echo $row['dept_name_hi']." - ".$row['department_default_no']; ?></option>
                    <?php } ?>
                    <option value="400"><?php echo $this->lang->line('option_other'); ?></option>
                </select>
                <?php echo form_error('file_department_id');?>
            </div>
            <div class="form-group"  id="High_court_show" <?php if($this->input->post('file_offer_by') == 'm' || $this->input->post('file_offer_by') == 'u') { echo "style='display: block'"; } else { echo "style='display: none'";} ?>>
                <label for="High_court_bench"><?php echo $this->lang->line('High_court_bench'); ?> <span class="text-danger">*</span></label>
                <select class="form-control" name="court_bench" id="court_bench">
                    <option value=""><?php echo $this->lang->line('option_select_from'); ?></option>
                    <?php $i = 1; foreach(highcourt_bench() as $key => $value){ ?>
                        echo '<option value="<?php echo $key ?>" <?php if ($this->input->post('court_bench') == $key) { echo "selected";} ?>><?php echo $i.' - '.$value ?></option>
                    <?php $i++; } ?>
                </select>
        
            </div>
			
			<div class="form-group pull-right">
			  <button type="button" class="btn btn-primary" onclick="search_scan_file();"><i class="fa fa-fw fa-search"></i> Search </button>
			   <button type="reset" class="btn btn-primary" > Reset </button>
			</div>
			</div>
		</div>
       </div>
	   <div style="height: auto; width: 90%;">
						<div class="CSSTableGenerator" align="center"  id="search_result" ></div>
                    </div><!-- /.box-body -->
                </div>
			 </div>		
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> रद्द</button>
                    <button style="display:none;" id="btn-scan-file" type="button" class="btn btn-primary" ><i class="fa fa-check" ></i> Add File </button>
                </div>
			
            </div>
        </form>
    </div>
</div>


<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>themes/pdfobject.js"></script>

<script type="text/javascript">
var HTTP_PATH='<?php echo base_url(); ?>';
 function get_file_poup(){
	    $('#scan_file_model').modal('show');
 }
 
 function open_model_csu(file){
    var file5 = file;
    $('#modal-mark_to_csu').modal('show');
    $('#csu_mark').html(file5);
    $('#form_submit_csu').attr('action','<?php echo base_url()?>scan_files/file_mark_cus/'+file5);
}


 function search_scan_file()
 {
	
	$(".CSSTableGenerator").html("");
	
	$("#error-meta_key").text();
	   $("#error-file_mark_section_id").text();
	  
	 flag = 0; 
	 if(  $("#meta_key").val() == ''){
		
		 $("#error-meta_key").text("कृपया इसे जरुर दर्ज करे!");
		  flag = 1
	 }
	 if(  $("#mark_to_section").val() == ''){
		  $("#error-file_mark_section_id").text("कृपया इसे जरुर दर्ज करे!");
		  flag = 1
	 }
	 if( flag == 1){
		 return false;
	 }
	  if( flag == 0){
		
		  $("#search_result").html();
	 
	 
		var meta_key = $("#meta_key").val();
		var file_subject = $("#file_subject").val();
		var mark_to_section = $("#mark_to_section").val();
		var file_mark_section_id = $("#file_mark_section_id").val();
		var file_offer_by = $("#file_offer_by").val();
		var file_department_id = $("#file_dep_id").val();
	   
		var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
			type: "POST",
			url: HTTP_PATH + "scan_file",
			datatype: "json",
			async: false,
			data: {meta_key: meta_key,file_subject:file_subject,file_mark_section_id:file_mark_section_id,file_offer_by:file_offer_by ,file_department_id:file_department_id ,mark_to_section:mark_to_section}, 
			success: function(data) {
				
				var r_data = JSON.parse(data);
				if(r_data.length > 0){
				var otpt = '<table>';
				$.each(r_data, function( index, value ) {
					var filename = get_filename( value.scan_file_path);
					
				otpt += '<tr><td><label class="checkbox"><input type="checkbox" value="'+value.scan_id+'"  name="scan_file_name" class="scan_files"   ><span id="scan_file_name_'+value.scan_id+'">'+filename +'</span></label></td><td><a class="btn btn-twitter btn-xs" onclick="open_file('+value.scan_id+',&#39;'+value.scan_file_path+'&#39;)"  > View </a></td></tr>'; 
				});
			   otpt += '</table>';
			
			   $("#btn-scan-file").show();
			  $("#search_result").html(otpt);
				}
				else{
					$(".CSSTableGenerator").html("");
					
				}
			}
		});
		}
}
 function get_filename(scan_file_path)
 {
	 var scan_file_path = scan_file_path;
	var scan_file_name = scan_file_path.split("/");
	var reversed_array = scan_file_name.reverse(); /*//inverts array [milan,arsenal,fenerbahce]*/
	
	var file_name = reversed_array[0].split("_");
	
	var file_names = []; 
	for(var i=0; i< file_name.length -1; i++)
	{
		file_names.push(file_name[i]); 
		
	}
	var file_name = file_names.join('_');
	
	return file_name;
 }
 
   
  $(document).ready(function() {
        $("#btn-scan-file").click(function(){
            var scan_file_id = [];
			var scan_file_name = [];
            $.each($("input[name='scan_file_name']:checked"), function(){            
                scan_file_id.push($(this).val());
				var scan_file_name_1 = $("#scan_file_name_"+$(this).val()).text();
				
				scan_file_name.push(scan_file_name_1);
				
            });
			console.log(scan_file_name);
			var scan_opt ='';
			scan_opt = "<ul>";
			
			for(var file = 0;file < scan_file_name.length; file++){
				scan_opt += "<li class='my_scan_file_"+scan_file_id[file]+"' style='text-align:left; '><a onclick='open_file("+scan_file_id[file]+")' href='#' >"+scan_file_name[file]+"</a>&nbsp;&nbsp;&nbsp;&nbsp; <a onclick='remove_scan_file("+scan_file_id[file]+")' style='cursor: pointer;' ><img src='"+HTTP_PATH+"images/remove.png' height='18' width='18' title='Delete'></a></li>";
			}
			scan_opt += "<ul>";
			$("#upload_files_id").html(scan_opt); 
			$("#scan_files_id").val(scan_file_id.join(","));
				$('#scan_file_model').modal('hide');
			
        });
    });
   function  remove_scan_file(scan_id){
	
        if (confirm("कृपया सुनिश्चित करें की आप इसे हटाना चाहते है| ")) {
            $( ".my_scan_file_"+scan_id ).remove();/*//scan_files_id*/
            var scan_files_id = $("#scan_files_id").val();
          
            if (scan_files_id.indexOf(scan_id) >= 0){
                scan_files_id = scan_files_id.replace(scan_id, "");
				
				var arr = scan_files_id.split(',');
				console.log(arr.length);
				
				if(arr.length == ''){
					$("#scan_files_id").val('');
				}else{
					$("#scan_files_id").val(scan_files_id);
				}                
            }
        }
    }
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
         
        } else if($('#file_offer_by').val() == 'm' || $('#file_offer_by').val() == 'u'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#state_id_show").hide();
            $("#High_court_show").show();
			$(".delhi_advocate").hide();
          
        } else if($('#file_offer_by').val() == 'au'){
            $("#dist_id_show , #dept_id_show , #dept_name_show , #suprem_court_show,#High_court_show").hide();
            $("#state_id_show").show();
			$(".delhi_advocate").hide();
        }else if($('#file_offer_by').val() == 'v'){
            $("#dept_name_show , #High_court_show , #suprem_court_show ,#dist_id_show,#state_id_show").hide();
            $("#dept_id_show").show();
			$(".delhi_advocate").hide();
            
        }else if($('#file_offer_by').val() == 'sc'){
            $("#dist_id_show , #dept_name_show , #High_court_show ,#dept_id_show,#state_id_show").hide();
            $("#suprem_court_show, .delhi_advocate").show();
           
        } else  {
            $("#dist_id_show , #dept_id_show , #High_court_show , #suprem_court_show,#state_id_show").hide();
			$(".delhi_advocate").hide();
            $("#dept_name_show").show();
            $("#other_label").text('<?php echo $this->lang->line('label_dept_name');?>');
            $("#file_department_name").attr('placeholder','<?php echo $this->lang->line('label_dept_name');?>');
        }
    });


function open_file_in_viewer( scan_id ,file_path){
	 var HTTP_PATH='<?php echo base_url(); ?>';
		var pdf = new PDFObject({
		  url: HTTP_PATH+file_path ,
		  id: "pdfRendered",
		  height:"600px",
		  width:"100%",
		  pdfOpenParams: {
			view: "FitH"
		  }
		}).embed("pdfRenderer");
			
			$("#pdf_viewer").hide();
}
</script>

<!--receive model-->
<div class="modal fade" id="modal-mark_to_csu" data-backdrop="static">
    <div class="modal-dialog">
        <!--<form role="form" method="post" action="<?php echo base_url()?>view_file/Dealing_file/Sent_to_DA">-->
        <form method="post" id="form_submit_csu">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>सेंट्रल स्कैन यूनिट में भेजें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." name="cus_remark"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button onclick="return confirm('क्या फाइल को आप सेंट्रल स्कैन यूनिट में मार्क करना कहते है |')" type="submit" name="return_tocr" value="return_tocr" class="btn btn-primary"><i class="fa fa-share"></i> Return</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->