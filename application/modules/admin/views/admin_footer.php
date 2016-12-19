	<!-- Main Footer -->
	<footer class="main-footer no-print">
			<!-- To the right -->
			<div class="pull-right hidden-xs"> 
            Load in <strong><a href="?profiler=yes" title="View full profiler details">{elapsed_time}</a></strong> seconds  and  <strong>{memory_usage}</strong> Memory used			
        </div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2015-2016 <a href="#">LAW DEPARTMENT</a></strong> All rights reserved.
			<input type="hidden" id="hidden_count_inbox" value="0"/>
	</footer>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
	<div class='control-sidebar-bg'></div>
</div><!-- ./wrapper -->
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>
<!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo ADMIN_THEME_PATH; ?>dist/js/app.min.js" type="text/javascript"></script>
	<!--Text Slider-->
	<script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/text_slider.js" type="text/javascript"></script>	
	<!--End Text Slider-->
	
<?php if ($this->uri->segment(1) == 'leave' || $this->uri->segment(2) == 'addleave' || $this->uri->segment(2) == 'add_leave') { ?>
<!--- Leave Javascript -->
<script src="<?php echo base_url(); ?>themes/leave.js" type="text/javascript"></script>	
<!-- END Leave Javascript-->
<?php } ?>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
	
    <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
     <!--<script type="text/javascript" src="<?php //echo ADMIN_THEME_PATH; ?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>-->
    <script type="text/javascript" src="<?php echo ADMIN_THEME_PATH; ?>common_js/jquery-blink.js" type="text/javascript"></script>

    <script src="<?php echo ADMIN_THEME_PATH; ?>bootstrap/js/multiselect_checkbox.js" type="text/javascript"></script>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>
    <script type="text/javascript">
      
		$(document).ready(function () {
			$(".input-sm").focus();
		});	
		
        $(document).ready(function () {
            var myVar = setInterval(function(){ myTimer() }, 1000);

                function myTimer() {
                    var d = new Date();
                    var t = d.toLocaleTimeString();
                    document.getElementById("counter").innerHTML = t;
                }
        }); 
        $(document).ready(function () {
            $('#leave_tbl, #dataTable').dataTable();
            $('.dataTable').dataTable();
            $('.blink').blink();
            $('.blink_fast').blink({
                delay: 300
            });
        });
      $(function () {
   
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });

       $(function () {
        $("#admin_users_list").dataTable();
        $(document).ready(function () {
            $('#leave_employee').dataTable({
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo ADMIN_THEME_PATH; ?>plugins/datatables/swf/copy_csv_xls_pdf.swf",
                }
            });
            
        });

        $('#admin_users_list').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });

    


        $(document).ready(function() {
            var HTTP_PATH='<?php echo base_url(); ?>';
            $("#emp_role").change(function() {
                var conf = confirm('<?php echo $this->lang->line("emp_role_confirm_message"); ?>');
                if(conf==false){
                  if($("#selected_emp_role").val()!=''){
                    var old_role= $("#selected_emp_role").val();
                    window.location.reload(true)
                  }
                  return false;
                }

                var role_id = $(this).val();
                if(role_id=='3'){
                    $(".supervisor").hide();
                }else{
                    $(".supervisor").show();
					}
                if(role_id!=''){
                  $("#selected_emp_role").val(role_id);
                }
                $.ajax({
                    type: "POST",
                    url: HTTP_PATH + "admin_users/get_supervisore_emp",
                    datatype: "json",
                    async: false,
                    data: {rold_id: role_id},
                    success: function(data) {
                        var r_data = JSON.parse(data);
                        
                        var otpt = '<option value="">Select Supervisore</option>';
                         $.each(r_data, function( index, value ) {
                      
                            otpt+= '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emprole_name_en+'-'+value.emprole_name_hi+' )</option>';
                        });
                        $("#supervisor_emp_id").html(otpt);
                    }
                });
            });

            /*Table*/
            $("#section_id").change(function() {
                var conf = confirm('<?php echo $this->lang->line("emp_role_confirm_message"); ?>');
                if(conf==false){
                  if($("#selected_emp_role").val()!=''){
                    var old_role= $("#selected_emp_role").val();
                    window.location.reload(true)
                  }
                  return false;
                }
                var section_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: HTTP_PATH + "admin_notesheet_master/get_notification_master_menu",
                    datatype: "json",
                    async: false,
                    data: {section_id: section_id},
                    success: function(data) {
                        var r_data = JSON.parse(data);
                  
                        var otpt = '<option value="">Select notesheet menu</option>';
                         $.each(r_data, function( index, value ) {
                         
                            otpt+= '<option value="'+value.notesheet_menu_id+'">'+value.notesheet_menu_title_hi+' ('+value.notesheet_menu_title_en+' )</option>';
                        });
                        $("#notesheet_type").html(otpt);
                    }
                });
            });

            $("#supervisor_emp_id").change(function() {
                var conf = confirm('<?php echo $this->lang->line("emp_supervisor_confirm_message"); ?>');
                if(conf==false){
                  if($("#selected_supervisor_id").val()!=''){
                    var old_role= $("#selected_supervisor_id").val();
                    window.location.reload(true)
                  }
                  return false;
                }
            });
			/*Get unit_id for CR */
			$("#mark_to_officer").change(function() {
                var emp_id = $(this).val();
				if(emp_id==''){
					$("#mark_unitid").val(51);
					return false;
				}
                $.ajax({
                    type: "POST",
                    url: HTTP_PATH + "manage_file/files/get_oficer_unitid",
                    datatype: "json",
                    async: false,
                    data: {emp_id: emp_id},
                    success: function(data) {
                        var r_data = JSON.parse(data);
                       
						$("#mark_unitid").val(r_data.unit_id);
                        /* var otpt = '<option value="">Select notesheet menu</option>';
                         $.each(r_data, function( index, value ) {
                         
                            otpt+= '<option value="'+value.notesheet_menu_id+'">'+value.notesheet_menu_title_hi+' ('+value.notesheet_menu_title_en+' )</option>';
                        });
                        $("#notesheet_type").html(otpt); */
                    }
                });
            });
        });
    function confir_post_data(){
        var confval=confirm('<?php echo $this->lang->line("emp_submit_confirm"); ?>');
        if(confval==false){
        
            return false;
            }
    }
	
	function checkUOnumber(str){

	$("#error-uonumner").text("");
	$.ajax({
	url: "<?php echo base_url(); ?>manage_file/files/checkuo_number", 
    type: 'post',
    data: {uonumner:str},
    success: function(data) {
		  console.log(data);
		  if(data == 1){
			  $("#error-uonumner").text("यह यू.ओ. क्र. पहले से उपस्थित है कृपया जांच  लेवें.");
		  }
      }
		});
  }
  
  </script>
<!--<link href=" http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>-->
        
      <link href="<?php echo ADMIN_THEME_PATH; ?>multiselect/css/bootstrap-multiselect.css"
        rel="stylesheet" type="text/css" />
    <script src="<?php echo ADMIN_THEME_PATH; ?>multiselect/js/bootstrap-multiselect.js"
        type="text/javascript"></script>    
        
        
	<?php //echo $this->uri->segment(2); ?>
<?php if($this->uri->segment(1)=='payroll'|| $this->uri->segment(1)=='admin'|| $this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='advocate' || $this->uri->segment(1)=='data_entry' ||$this->uri->segment(1)=='leave'|| $this->uri->segment(2)=='add_employee' || $this->uri->segment(2)=='edit_employee' || $this->uri->segment(2)=='manage_user' || $this->uri->segment(2)=='notesheets' || $this->uri->segment(1)=='add_file' || $this->uri->segment(2)=='add_file' || $this->uri->segment(2)=='dealing' || $this->uri->segment(2)=='file_search' || $this->uri->segment(2)=='edit_file' || $this->uri->segment(2)=='allot' || $this->uri->segment(2)=='save_dealing'|| $this->uri->segment(2)=='rti_file' || $this->uri->segment(1)=='show_file' || $this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='activity_report' || $this->uri->segment(1)=='add_scan_files' || $this->uri->segment(1)=='manage_scan_files' || end($this->uri->segments)=='file' || $this->uri->segment(1)=='admin_notesheet_master' || $this->uri->segment(1)=='reports'|| $this->uri->segment(1)=='return_file' || $this->uri->segment(1)=='update_file'){ ?>
      <link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
      <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	  <script src="<?php echo base_url(); ?>themes/section_feilds.js" type="text/javascript"></script>
      <script type="text/javascript">
      $(function () {
        /*//Date DOB*/
		$('.date1').datepicker();
        $('#emp_detail_dob').datepicker();
        $('#file_uo_date').datepicker();
        $('#sec_mark_date').datepicker();
        $('#receive_date').datepicker();
        $('#judgement_data').datepicker();
		$('#registry_date').datepicker();
		$('#hearing_date').datepicker();
        
    		$('#frm_dt').datepicker();
    		$('#movement_frm_dt').datepicker();
    		$('#movement_to_dt').datepicker();
  		  $('.ps_moniter_date').datepicker();
      });
    </script>  
  <?php } ?>    
  <script type="text/javascript">
      $(document).ready(function() {
        $('#example1').dataTable({
            
            "aoColumnDefs" : [ {
                'bSortable' : false,
                'aTargets' : [ 0 ]
            } ]
        });
		
		var get_tbl = location.href.split('#');
		var seacr = get_tbl[1];
        $('#view_table').dataTable({
			 "dom": '<"top"iflp<"clear">>rt<"bottom"iflp<"clear">>',
			  "pageLength": 25,
			/*Disable sorting on the first column*/
			"aaSorting": [],
            "oSearch": {
				"sSearch": seacr
			}			
		}); 
		
		$('#view_table_dispatch').dataTable({        
            "order": [[ 7, "desc" ]]           
		});
    });    
   
     function print_content() {
          window.print();
    }
	function goBack() {
          window.history.back();
		 
      }
      $('#submit_btn').on('click', function () {
          $ret = confirm('कृपया सुनिश्चित करे की आप यह फाइल दर्ज करना चाहते हैं |');
          if($ret == true){
              var $btn = $(this).button('loading');
              return true
          }else{
              return false
          }
      });

	  $('#scan_add_data').on('submit', function () {
              var $btn = $('#submit_btn_scan').button('loading');
      });

      function confirm_receive() {
          return confirm('कृपया सुनिश्चित करे की आप यह फाइल/पत्र दर्ज करना चाहते हैं!');
      }
      function confirm_send() {
          return  confirm('कृपया सुनिश्चित करे की आप यह फाइल/पत्र प्रेषित करना चाहते हैं!');
      }
      function confirm_return() {
          return  confirm('कृपया सुनिश्चित करे की आप यह फाइल/पत्र वापस करना चाहते हैं!');
      }
      function confirm_reject() {
          return  confirm('कृपया सुनिश्चित करे की आप यह फाइल/पत्र अस्वीकार करना चाहते हैं!!');
      }
	  function confirm_generate_scan() {
          return  confirm('कृपया सुनिश्चित करे की आप का कार्य इस फाइल में  पूर्ण हो चुका है |');
      }        
    $(function () {
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('fast');
            $(this).attr('title', 'Expand this branch').find(' > i').addClass('icon-plus-sign').removeClass('icon-minus-sign');
        } else {
            children.show('fast');
            $(this).attr('title', 'Collapse this branch').find(' > i').addClass('icon-minus-sign').removeClass('icon-plus-sign');
        }
        e.stopPropagation();
    });
});

   /* $(function () {
        $("#section_id_notesheet").change(function () {
           var section_id = $("#section_id_notesheet").val();
           $('notesheet_url').val("href");
        });
    });*/
    
  
    $(function () {
       var $template = $(".template");

       var hash = 2;
       $(".btn-add-panel").on("click", function () {
           var $newPanel = $template.clone();
           $newPanel.find(".collapse").removeClass("in");
           $newPanel.find(".accordion-toggle").attr("href",  "#" + (++hash))
                    .text("Dynamic panel #" + hash);
           $newPanel.find(".panel-collapse").attr("id", hash).addClass("collapse").removeClass("in");
           $("#accordion").append($newPanel.fadeIn());
       });
    });
  </script>
  
  <script>
     $(document).ready(function(){
		$("#designation_div").hide();
		$("#section_div").hide();
		var HTTP_PATH='<?php echo base_url(); ?>';
        <?php if ($this->session->flashdata('notesheet_message')) { ?>
                alert('<?php echo $this->session->flashdata("notesheet_message"); ?>');
        <?php } ?>
		
		$("#permission_type").change(function() 
		{
			
			if($(this).val()=='section_wise'){
				$("#designation_div").hide(); /*Hide designation div*/
				$("#section_div").show(); /*show section div*/
				$("#permission_section_id").prop('required',true);
				$("#designation_id").prop('required',false);
				$(".emp_name_div").show();
				$("#section_emp_id").html('');
				$("#ajax_section_div").hide();
				$("#section_emp_id2").html('');
				$("#ajax_section_div2").hide();
				$("#section_emp_id").attr('title','section_wise');
			}else if($(this).val()=='designation_wise'){
				$("#section_div").hide(); /*Hide designation div*/
				$("#designation_div").show(); /*show section div*/
				$("#permission_section_id").prop('required',false);
				$("#designation_id").prop('required',true);
				$(".emp_name_div").show();
				$("#section_emp_id").html('');
				$("#ajax_section_div").hide();
				$("#section_emp_id2").html('');
				$("#ajax_section_div2").hide();
				$("#section_emp_id").attr('title','designation_wise');
			}else{
				$("#designation_div").hide(); /*Hide designation div*/
				$("#section_div").hide(); /*Hide designation div*/
				$("#permission_section_id").prop('required',false);
				$("#designation_id").prop('required',false);
				$(".emp_name_div").hide();
				$("#section_emp_id").html('');
				$("#ajax_section_div").hide();
				$("#section_emp_id2").html('');
				$("#ajax_section_div2").hide();
				$("#section_emp_id").attr('title','');
			}
		});
		/*Employee list section wise*/
		$("#permission_section_id").change(function() 
		{
			$("#section_div").show();
			var role_id = $(this).val();
			$.ajax({
				type: "POST",
				url: HTTP_PATH + "pa_permission/ajax_get_section_employee",
				datatype: "json",
				async: false,
				data: {section_id: role_id},
				success: function(data) {
					var r_data = JSON.parse(data);
					$("#ajax_section_div").show();
					$("#ajax_section_div2").show();
					var otpt = '<option value="">Select employee</option>';
					 $.each(r_data[0], function( index, value ) {
					  
						otpt+= '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emp_full_name_hi+')</option>';
					});
					$("#section_emp_id").html(otpt);
					$("#section_emp_id2").html(otpt);
				}
			});
		});
		
		$("#section_file_type").change(function() 
		{
			
			if($(this).val() == 'अभ्यावेदन'){
				$("#pre_application").show();
				
			}else{
				$("#pre_application").hide();
			}
			
		});
		
		/*Employee List designation wise*/
		$("#designation_id").change(function() 
		{
			$("#section_div").hide();
			$("#section_emp_id").html('');
			$("#section_emp_id2").html('');
			var role_id = $(this).val();
			request_type='';
			request_type=$('#section_emp_id').attr('title');
			$.ajax({
				type: "POST",
				url: HTTP_PATH + "pa_permission/ajax_get_designation_employee",
				datatype: "json",
				async: false,
				data: {section_id: role_id,requesttype:request_type},
				success: function(data) {
					var r_data = JSON.parse(data);
					$("#ajax_section_div").show();
					$("#ajax_section_div2").show();
					var otpt = '<option value="">Select employee</option>';
					 $.each(r_data[0], function( index, value ) {
					
						otpt+= '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emp_full_name_hi+')</option>';
					});
					$("#section_emp_id").html(otpt);
					$("#section_emp_id2").html(otpt);
				}
			});
		});
		
		$("#section_emp_id").change(function() 
		{
			$("#section_emp_id2").html('');
			role_id = $('#permission_section_id :selected').val();
			empid1= $(this).val();
			request_type='';
			request_type=$('#section_emp_id').attr('title');
			if(request_type=='designation_wise'){
				var method='ajax_get_designation_employee';
				var rqfor='by_designation';
			}else if(request_type=='section_wise'){
				var method='ajax_get_section_employee';
				var rqfor='by_section';
			}
			$.ajax({
				type: "POST",
				url: HTTP_PATH + "pa_permission/"+method,
				datatype: "json",
				async: false,
				data: {section_id: role_id,requesttype:request_type,rqfor:rqfor},
				success: function(data) {
					var r_data = JSON.parse(data);
					
					var otpt = '<option value="">Select employee</option>';
					 $.each(r_data[0], function( index, value ) {
					
						otpt+= '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emp_full_name_hi+')</option>';
					});
					$("#section_emp_id2").html(otpt);
				}
			});
			$("#section_emp_id2 option[value='"+empid1+"']").remove();
		});
		
		/*Auto mark section - Rohit*/
		$("#mark_to_section").change(function() 
		{
			$("#file_head").html('');
		
			section_id= $(this).val();
			if(section_id == '2' || section_id == '14' || section_id == '10' || section_id == '17' || section_id == '15' || section_id == '11' || section_id == '12'|| section_id == '13' || section_id == '7' || section_id == '25' || section_id == '22'){
				$('.mark_csu').val('62');
			} else{
				$('.mark_csu').val('');
			}
			$.ajax({
				type: "POST",
				url: HTTP_PATH + "manage_file/ajax_get_section_head",
				datatype: "json",
				async: false,
				data: {section_id: section_id},
				success: function(data) {
					var r_data = JSON.parse(data);
					
					var otpt = '<option value="">Select head</option>';
					 $.each(r_data, function( index, value ) {
					 
						otpt+= '<option value="'+value.head_code+'">'+value.head_code+' ('+value.head_title+')</option>';
					});
					$("#file_head").html(otpt);
				}
			});
			
            $.ajax({
                type: "POST",
                url: HTTP_PATH + "manage_file/ajax_get_section_file_type",
                datatype: "json",
                async: false,
                data: {section_id: section_id},
                success: function(data) {
                   
                    var f_data = JSON.parse(data);
                    
                    var otpt = '<option value="">Select file type</option>';
                    $.each(f_data, function( index, value ) {
                      
                        otpt+= '<option value="'+value+'">'+value+' ('+value+')</option>';
                    });
                    $("#show_for_procescution").show();
                    $("#section_file_type").html(otpt);
                }
            });


			if(section_id==15){ /*For Procecustin/Abhiyojan*/
				$(".casetype").prop('disabled',true);
				
				$("select.casetype").prop('selectedIndex', 0);
				$(".casetype").hide();
				$(".add_more").hide();
				$(".show_for_procescution").show();
				$(".hide_for_procescution").hide();
				$("#procecution_label").show();
				$("#nyayic_sec_2label").hide();
				$("#lib_sec_1label").hide();
			}else if(section_id==12) /*b-ii*/{
				$(".show_for_procescution").show();
				$("#procecution_label").hide();
				$("#nyayic_sec_2label").show();
				$("#nyayic_sec_1label").hide();
				$(".petition_file_cls").hide();
				$(".hide_for_procescution").hide();
				$("#lib_sec_1label").hide();
				$(".heads_cls").show();
			}
			else if(section_id==11) /*b-i*/{
				$(".show_for_procescution").show();
				$("#procecution_label").hide();
				$("#nyayic_sec_2label").hide();
				$("#nyayic_sec_1label").show();
				$(".petition_file_cls").hide();
				$(".hide_for_procescution").hide();
				$("#lib_sec_1label").hide();
				$(".heads_cls").show();
			}else if(section_id==13) /*Budget*/{
				$(".show_for_procescution").hide();
				$("#procecution_label").hide();
				$("#nyayic_sec_2label").hide();
				$("#nyayic_sec_1label").hide();
				$(".petition_file_cls").hide();
				$(".hide_for_procescution").hide();
				$("#lib_sec_1label").hide();
				$(".heads_cls").show();
			}else if(section_id==19) /*Library*/{
				$(".show_for_procescution").show();
				$("#procecution_label").hide();
				$("#nyayic_sec_2label").hide();
				$("#lib_sec_1label").show();
				$("#nyayic_sec_1label").hide();
				$(".petition_file_cls").hide();
				$(".hide_for_procescution").hide();
				$(".heads_cls").hide();
			}else if(section_id==17) /*OPinion*/{
				$('.hide_for_procescution,show_for_procescution').hide();
			
			}else{ 
				$(".casetype").prop('disabled',false);
				$(".casetype").show();
				$(".add_more").show();
				$(".hide_for_procescution").show();
				$(".show_for_procescution").hide();
				$("#lib_sec_1label").hide();
			}
			
			
			
		});
		/*End 19-09-2015*/
		
    });
	function confirm_delete() {
          var rs = confirm('कृपया पुष्टि करें, आप इसे हटाना चाहते हैं ?');
		  if(rs==true){return true;}
		  else{return false;}
	}
	
	$(function () {
		$('#view_table_info, #view_table_paginate, #view_table_length, #view_table_filter').addClass('no-print');

	});
	
	/*Table Row sum Code added 31 10 2015*/
	function calculateFormula($row, formula){				
		formula = formula.replace(/(\{[a-z0-9_\-]+\})/gi, function(m){
			return $('.' + m.replace(/\{|\}/g, ''), $row).text();
		});				
		var answer = eval(formula); 
		return (isNaN(answer))? 0 : answer;
	}
	/*End 31 10 2015*/
</script>
  <script>
      $(function () {
      /*    $('.load_btn').on('click', function () {

              var $btn = $(this).button('loading')
             
          })*/
          $('.check_field12').change(function(){
              
              if($('.check_field12').is(':checked')){
                  $("#btn_sub1").prop("disabled", false);
                  $("#btn_sub2").prop("disabled", false);
              }else{
                  $("#btn_sub1").prop("disabled", true);
                  $("#btn_sub2").prop("disabled", true);
              }

          });

  
		  /*//send button hide and show on click digital sign
			$(".send_btn").prop("disabled", true);
		    $(document).on('change', '.get_sign_data', function() {			
			   if($('.get_sign_data').is(':checked')){
				   $(".send_btn").prop("disabled", false);
			   } else{
				   $(".send_btn").prop("disabled", true);
			   }
			}); */
   
      });

      $(document).ready(function(){

         var HTTP_PATH='<?php echo base_url(); ?>';
         $("#filter_section_emp_wise").change(function () {
            
             var search_filter = $(this).val();
			 if(search_filter==''){
				return false;
			 }
             request_type='';
               $.ajax({
                 type: "POST",
                 url: HTTP_PATH + "view_file/file_search/ajax_get_section_employee",
                 datatype: "json",
                 async: false,
                 data: {search_filter: search_filter},
                 success: function(data) {
                   var r_data = JSON.parse(data);
                   var otpt = '<option value="">Select employee/Section</option>';
                     if(search_filter=='emp'){
                        $.each(r_data[0], function( index, value ) {
                          
                          otpt+= '<option value="'+value.emp_id+'">'+value.emp_full_name+' ('+value.emp_full_name_hi+')</option>';
                        });
                     }else{
                        $.each(r_data[0], function( index, value ) {
                           
                          otpt+= '<option value="'+value.section_id+'">'+value.section_name_en+' ('+value.section_name_hi+')</option>';
                        });
                     }
                   $("#section_emp_list").html(otpt);
                  
                 }
            });
        });
		
		/*Sign Data*/
			$(".get_sign_data").click(function () {
						
				var da_name = '';
				da_name  = $('.Da_name_r').val();
				var fid = '<?php echo $this->uri->segment(2) ?>';				
				<?php if(emp_session_id() == 2) { ?>
					var sender_name = $('select[name=emp_id] option:selected').text();
				<?php }	else {  ?>						
					if($('#modal-delete').hasClass('in')){

						var sender_name = $('select[name=emp_id] option:selected').text();
						fid = $("#modal-delete .lower_efileid").val();
					}else if($('#modal-send_upper').hasClass('in')){
						var sender_name = $('select[name=emp_id2] option:selected').text();
						fid = $("#modal-send_upper .lower_efileid").val();
					}else if($('#modal-return_da_file').hasClass('in')){						

						var sender_name = $('select[name=Da_name] option:selected').text();
						fid = $("#modal-return_da_file .lower_efileid").val();
					} else{
						alert('Sender name required');

					}
					
				<?php } ?>				
					var eid = '<?php echo emp_session_id(); ?>';
				var final_data_content='';
				
				$.ajax({
					 type: "POST",
					 url: HTTP_PATH + "draft/get_final_content_with_html",
					 datatype: "json",
					 async: false,
					 data: {fileid:fid,empid:eid,sender_name:sender_name,},
					 success: function(data) {
					  
					   $(".sign_data_content").html(data);
					 }
				});
			});
			$(".get_sign_data").click(function () {
			
				if ($('input[name="get_sign_data"]').is(':checked')) {
					
					$('.btn-primary').removeAttr('onclick','');
					var final_data_content="";
					var bs64_d_final_data_content="";
					final_data_content= $("#expand_data").text();
					bs64_d_final_data_content= $("#text_base64decode").val();
					var fid = $("#modal-id2").val();
					var draftlogid = $("#draft_log_id").attr("name");
					var eid = "<?php echo emp_session_id().',1'?>"; /*1 : Live*/
					var site_status = "<?php echo SITE_STATUS; ?>";
					var location_url = "http://10.115.254.213:8080/data_signing/signDataJNLP?url="+site_status+"&other="+bs64_d_final_data_content+"&draft_id="+draftlogid+"&file_id="+fid+"&emp_id="+eid+"&emp_name=bijendra&data="+final_data_content;
					location.href= location_url;
				
				}else{ $(".sign_data_content").html('');
						$('.btn-primary').attr('onclick','return confirm_send()');

				}
			});


			$(document).on('change', '.emp_id,.Da_name_r,.emp_id2', function() {
				 $(".sign_data_content").html('');
				 $(".get_sign_data").prop( "checked", false );	
			});



			var modal_send_upper_txt1 = $(".modal-send_upper_txt1").val();
				if(modal_send_upper_txt1==0 || $('input[name="get_sign_data"]').is(':checked')) { 
				var myVar = setInterval(function(){ 
					if($('input[name="get_sign_data"]').is(':checked')) { 
						if(modal_send_upper_txt1==1){
							return false;
						}else{
							single_check_digitally_sign_or_not(1); 
						}
					}
				}, 3000);
			}
			function single_check_digitally_sign_or_not(isval){
				if(isval==1){
					$("#btn-delete").removeAttr('onclick','');
					var HTTP_PATH='<?php echo base_url(); ?>';
					var draft_log_id = $("#draft_log_id").attr("name");
					$.ajax({
							type: "POST",
							url: HTTP_PATH + "manage_file/efile_updates/single_file_digitally_sign_or_not",
							datatype: "json",
							async: true,
							data:{draft_log_id:draft_log_id},
							success: function(data) {
									if(data>0){
											jQuery(function(){
												$(".modal-send_upper_txt1").val(1);
												$('input[name="get_sign_data"]').prop('checked',false);
												if($('#modal-send_upper').hasClass('in')){
											
													jQuery('#modal-send_upper .autoclick').click();
												}else if($('#modal-return_da_file').hasClass('in')){
													jQuery('#modal-return_da_file .autoclick').click();
												}else if($('#modal-delete').hasClass('in')){
													jQuery('#modal-delete .autoclick').click();
												}
											});
										
									}
									}
					});
				}
			}
			/*Table Row sum Code added 31 10 2015*/
			$(function(){
				var sum = 0;
				$('.stripeTable12 .stripeRow').each(function(i){
				$t = $(this);
				$('#total_price', $t).text(calculateFormula($t, '{qtr-1}+{qtr-2}'));
				var ts= $('.teat_count_price', $t).val(calculateFormula($t, '{qtr-1}+{qtr-2}'));
				sum += parseInt(ts.val());
				});
				$('#total_quantity').html(sum); 
			});
      });
  </script>
  <script>
    function printContents(data){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(data).innerHTML;
        printcontent += '' +
        '<style type="text/css">' +
        'table th, table td {' +
		 'border:.0px solid #000;' +  
        '#inner_content table th,#inner_content table td {' +
        'border:1px solid #000;' +        
        '}' +
        '</style>';
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
	
	
<?php if($this->uri->segment(1)=='data_entry' ||$this->uri->segment(1)=='leave'|| $this->uri->segment(2)=='add_employee' || $this->uri->segment(2)=='edit_employee' || $this->uri->segment(2)=='manage_user' || $this->uri->segment(2)=='notesheets' || $this->uri->segment(1)=='add_file' || $this->uri->segment(2)=='add_file' || $this->uri->segment(2)=='dealing' || $this->uri->segment(2)=='file_search' || $this->uri->segment(2)=='edit_file' || $this->uri->segment(2)=='allot' || $this->uri->segment(2)=='save_dealing'|| $this->uri->segment(2)=='rti_file' || $this->uri->segment(1)=='show_file' || $this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='reports' || $this->uri->segment(1)=='activity_report' || $this->uri->segment(1)=='return_file'){ ?>
	
	 $(document).ready(function() {
    $('#centr_table').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
	$(function () {       
        $('.date_picker').datepicker();
	 });
<?php } ?>
function open_file(scan_id,file_path)
 {
     $('#modal-scan_file').modal('show');
	 var HTTP_PATH='<?php echo base_url(); ?>';
	 $("#show_scan_file").html('<object data="'+HTTP_PATH+'/'+file_path+'" type="application/pdf" width="100%" height="600px"><p>It appears you dont have a PDF plugin for this browser.No biggie... you can <a href="'+HTTP_PATH+'/'+file_path+'">click here to download the PDF file.</a></p></object>');
     $("#open_new_tab").html('<a class="btn btn-primary" target="_blank" href="'+HTTP_PATH+'/'+file_path+'">Open PDF in new tab</a>');

	 }

function show_current_file()
 {
     $('#modal-current_file').modal('show');	
     var HTTP_PATH='<?php echo base_url(); ?>admin/admin_dashboard/show_current_file';
	 $("#show_current_file_loader").show();
     document.getElementById("show_current_file").innerHTML='<object type="text/html" data="'+HTTP_PATH+'" width="100%" height="350px"></object>';
	 $("#show_current_file_loader").hide();
 }
</script>

<!--Add Remark to any file-->
<div class="modal fade" id="remarkmodel_all_section" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
 <div class="modal-dialog">
        <form method="post" id="receive_mark_all_section" action="<?php echo base_url('establishment').'/establishment/add_reamrk' ;?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i>रिमार्क लिखें </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">  
									<p>पंजी क्रमांक:- <b><span id="panji_no">	</span></b></p>							
									<p>विषय:- <b><span id="subject">	</span></b></p>						
                                    <div class="form-group">
                                        <input type="hidden" id="remark_file_id" name="file_id_remark">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Enter ..." id="modal-id" name="file_remark"></textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i>रद्द</button>
                    <button id="btn-delete" onclick="return confirm_send()" type="submit" class="btn btn-primary"><i class="fa fa-check"></i>जोड़े</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- remark Modal -->
<!---- open pdf file ---->
<div class="modal fade" id="modal-scan_file" data-backdrop="static">
    <div class="modal-dialog">
        <!-- <form action="<?php echo base_url() ;?>manage_file/return_file" method="post" >-->
        <form action="<?php echo base_url() ;?>manage_file/return_file_da" method="post" >
            <div class="modal-content">
                <div class="modal-header">
					<button type="button" class=" btn btn-danger" data-dismiss="modal" aria-hidden="true">बंद करें</button>

                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row" align="center" style="height:250px;">
                                <div class="col-xs-12">
                                    <div id="show_scan_file"></div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">बंद करें</button>
                    <div class="pull-right" id="open_new_tab"></div>
                </div>
            </div>
        </form>
    </div>
</div>
<!--- End PDF File --->
 <!---- Show pending file ---->
<div class="modal fade" id="modal-current_file" data-backdrop="static">
    <div class="modal-dialog" id="div_current">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-arrow-right shake"></i> स्वयं को अंकित फाइलें  <a href="<?php echo base_url(); ?>reports/moniter?emp=<?php echo emp_session_id(); ?>">click to show file</a></h4>
                </div>
                <div class="modal-body">
									<div id="show_current_file_loader" style="display:none;">Please wait..</div>
                                    <div id="show_current_file"></div>
                </div>
                <div class="modal-footer">
                    <span class="text-red pull-left">Time : <?php echo date('d/m/y h:i a'); ?></span>
                    <button type="button" class="btn no-print" data-dismiss="modal">बंद करें</button>
                   </div>
            </div>
    </div>
</div>
<!--- Show pending file --->

<script src="<?php echo base_url(); ?>themes/section_feilds.js" type="text/javascript"></script>
<script>
$(document).find('br').each(function(){
    if($(this).attr('type') === '_moz'){
        $(this).remove();
    }
});
$(function () {       
		$('#view_table_filter .input-sm').focus();
	 });
 

/*Code added by 04 04 2016 */
$(".chk_slct_file").click(function() {
		<?php $login_emp_level=get_emp_role_levele();?>
		var new_file_ids='';
		var file_selected_file_ids='';
		var emp_level= "<?php echo $login_emp_level['emprole_level']; ?>";
		var file_total_slct_count=$("#file_total_slct_count").val();
	    var checked = $(this).is(':checked');
        var chkboxid = $(this).attr('id');	
		var file_id= $(this).val();
		file_selected_file_ids=$("#file_selected_file_ids").val();
        if (checked) {			
			if(file_selected_file_ids!='' && file_selected_file_ids!='0'){
				new_file_ids = file_selected_file_ids+','+file_id;
			}else{
				new_file_ids = file_id;
			}
			$("#file_selected_file_ids").val(new_file_ids);
			file_total_slct_count=parseInt(file_total_slct_count)+parseInt(1);			
			$('.chkbox'+chkboxid).prop("disabled", false);  
        } else {
			
			file_selected_file_ids_array = file_selected_file_ids.split(',');			
			file_selected_file_ids_array = jQuery.grep(file_selected_file_ids_array, function(value) {
			  return value != file_id;
			});	
			new_file_ids=file_selected_file_ids_array;		
			file_total_slct_count=parseInt(file_total_slct_count)-parseInt(1);	
            $("#employeelist_"+chkboxid).html('');
			$("#total_nu_radio_selected").val(file_total_slct_count);
			$("#file_selected_file_ids").val(new_file_ids);
			$('.chkbox'+chkboxid).prop("disabled", true); 
        }		
		if(file_total_slct_count==0){			
			$("#auto_add_draft_value_ajax").prop("disabled", true);
			$("#auto_add_draft_value").prop("disabled", true);
			$(".auto_file_received_value").prop("disabled", true);
		}else{
			$("#auto_add_draft_value_ajax").prop("disabled", false);
			$("#auto_add_draft_value").prop("disabled", false);
			$(".auto_file_received_value").prop("disabled", false);
		}		
		$("#total_slct_count").val(file_total_slct_count);
		
    });	
	
	$(document).on('change', '.auto_file_received_value', function(){
		var HTTP_PATH='<?php echo base_url(); ?>';
		var ac_url = HTTP_PATH+"e_filelist/received_multiple_files";		
		if($(this).val()!=''){
			$("#file_emp_mark_id").val($(this).val());
		}
		$("#multi_file_post_frm").attr('action',ac_url);
		var conf = confirm('क्या आप फाइल को प्राप्त करना चाहते हैं और फाइल को आगे बढाना चाहते ? ');
		if(conf==false){
			return false;
		}else{
		console.log($("#multi_file_post_frm").serialize());
		
			$.ajax({    
					type: 'POST',  
					url: ac_url,  
					async: false,
					data:$("#multi_file_post_frm").serialize(),  
					dataType:'json',
					 beforeSend: function() {
						 ajaxindicatorstart('कार्य किया जा रहा है क्रप्या प्रतीक्षा  करें|');
					  },
					success:function(data){
						ajaxindicatorstop();
						alert('फाइल प्राप्त कर ली गयी हैं | ');
						window.location.reload(true);
					},
					error: function(data) { 
						
					}					
			});			
				
		}
	});
		function ajaxindicatorstart(text)
	{
		if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
		jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="<?php echo base_url(); ?>images/loader4.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
		}
		
		jQuery('#resultLoading').css({
			'width':'100%',
			'height':'100%',
			'position':'fixed',
			'z-index':'10000000',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto'
		});	
		
		jQuery('#resultLoading .bg').css({
			'background':'#000000',
			'opacity':'0.7',
			'width':'100%',
			'height':'100%',
			'position':'absolute',
			'top':'0'
		});
		
		jQuery('#resultLoading>div:first').css({
			'width': '250px',
			'height':'75px',
			'text-align': 'center',
			'position': 'fixed',
			'top':'0',
			'left':'0',
			'right':'0',
			'bottom':'0',
			'margin':'auto',
			'font-size':'16px',
			'z-index':'10',
			'color':'#ffffff'
			
		});

	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeIn(300);
	    jQuery('body').css('cursor', 'wait');
	}
	function ajaxindicatorstop()
	{
	    jQuery('#resultLoading .bg').height('100%');
        jQuery('#resultLoading').fadeOut(300);
	    jQuery('body').css('cursor', 'default');
	}
 /* jQuery(document).ajaxStart(function () {
   	
		ajaxindicatorstart('loading data.. please wait..');
  }).ajaxStop(function () {
		
		ajaxindicatorstop();
  });*/
  
	$(document).on('change', '#auto_add_draft_value_ajax', function(){		 
		var draft_content_text = '<p>'+$(this).val()+'</p>';	
		var HTTP_PATH='<?php echo base_url(); ?>';
		var ac_url = HTTP_PATH+"e_filelist/add_multiple_draft";
		$("#multi_file_post_frm").attr('action',ac_url);
		var conf = confirm('कृपया सुनिश्चित करे कि जिन फाइल/पत्र  पर टीप  जोड़ी जा रही  हैं ।  उन फाइल/पत्र का प्राप्त होना अनिवार्य हैं! ');
		if(conf==false){
			return false;	
		}else{
			var file_selected_file_ids=$("#file_selected_file_ids").val();
			$.ajax({    
					type: 'POST',  
					url: ac_url,  

					data:{draft_content_text:draft_content_text,file_selected_file_ids:file_selected_file_ids},  
					dataType:'json',



					success:function(data){

						if(data == 'success'){
							alert('फाइल/पत्र  पर टीप सफलतापूर्वक जोड़ी गई। ');
							window.location.reload(true);
						}						
					},
					error: function(data) { 
						
					}
			});			
		}
	});

<?php $emp_level_array = get_emp_role_levele(); ?>;
var  emp_role_level = '<?php echo $emp_level_array['emprole_level'];?>';
	$(document).ready(function() {
		$("#section_file_type_ddl").change(function() {		
			var sub_type = $(this).val();	
			var url = window.location.href ;
			url = url.split("?")[0];
			window.location = url+'?sstype='+sub_type;
		});			
		$(".remarkbtn_model").click(function () {
           var file_id = $(this).data('file_id'); 
           $('#remark_file_id').val(file_id); 
           if(emp_role_level=='6' || emp_role_level=='13'){
			var panji = $(this).closest("tr").find('td:eq(1)').text();
            $('#panji_no').html(panji); 		
			var da_path_name = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
			
			var subject = $(this).closest("tr").find('td:eq(2)').text();			
            $('#subject').html(subject);  
		   }else{		   
			var panji = $(this).closest("tr").find('td:eq(4)').text();
            $('#panji_no').html(panji);  		
			var da_path_name = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
		
			var subject = $(this).closest("tr").find('td:eq(1)').text();			
            $('#subject').html(subject);  
		   }
		   
        });
	});	
/*End*/	
</script>
<div id="dialog_content" class="dialog_content" style="display:none">
	<div class="dialogModal_header">सूचना</div>
	<div class="dialogModal_content ">
	<b style=" font-size:27px; color:#fff;" >कृपया  लम्बित नस्तियों को समाप्त करने का प्रयास करें ।</b>
	<br><br>
	<a href="<?php echo base_url(); ?>individual_reports" target="‌‌_self">
	<button type="button" data-dialogmodalbut="cancel" class="btn btn-sm  btn-info " style="color:#fff">&nbsp;  लम्बित नस्तियाँ देखे &nbsp; </button> 
	</a>
	</div>
	<div class="dialogModal_footer">
		
		<button type="button" data-dialogmodalbut="cancel" class="btn btn-sm  btn-danger " style="color:#fff">&nbsp;  रद्द करें &nbsp;	</button>
	</div>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>themes/popModal.css">

<script src="<?php echo base_url();?>themes/popModal.js"></script>
<script>
function _pop(url){
$('.dialog_content').dialogModal({
			onOkBut: function() {},
			onCancelBut: function() {},
			onLoad: function() {},
			onClose: function() {},
		});
	}
	

function _popByHours(url, hours) {
	
	function createCookie(name, value, hours) {
	
		var date = new Date();
		date.setTime(date.getTime() + (hours * 3600 * 1000));
		var expires = "; expires=" + date.toGMTString();
		
		document.cookie = name + "=" + value + expires + "; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ')
				c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0)
				return c.substring(nameEQ.length, c.length);
		}
	}

	if (!readCookie("_pop")) {

		_pop(url);
		createCookie("_pop",1, hours);
	}
}
_popByHours("http://google.fr", 2);

if ($('#back-to-top').length) {
    var scrollTrigger = 100, 
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
}

 check_browser();
    function check_browser(){
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        
        var isFirefox = typeof InstallTrigger !== 'undefined';   
        var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
       
        var isChrome = !!window.chrome && !isOpera;            
        var isIE = /*@cc_on!@*/false || !!document.documentMode;   

        var output = 'Detecting browsers by ducktyping:<hr>';
        if(isChrome==true){
            $("#voice_input").show();
            $(".googlevoic").show();
			$("#ps_moniter_date1").attr('type','date');
        }else{
            $("#voice_input").hide();
            $(".googlevoic").hide();
			$("#ps_moniter_date1").attr('type','text');
			$("#ps_moniter_date1").addClass('ps_moniter_date');
        }
    }
</script>
  <script>
  <?php if(($this->uri->segment(1)=='view_file' || $this->uri->segment(1)=='show_file'|| $this->uri->segment(1)=='e-files'|| $this->uri->segment(1)=='moniter'|| $this->uri->segment(1)=='activity_report'|| $this->uri->segment(1)=='reports'|| $this->uri->segment(1)=='ps_file_monitor'|| $this->uri->segment(1)=='rti') && $this->uri->segment(2)!='efile_sign'){ ?>
        function moveScroll(){
          var scroll = $(window).scrollTop();
          var anchor_top = $(".fix_maintable").offset().top;
          var anchor_bottom = $("#bottom_anchor").offset().top;
          if (scroll>anchor_top && scroll<anchor_bottom) {
              clone_table = $("#clone");
              if(clone_table.length == 0){
                  clone_table = $(".fix_maintable").clone();
                  clone_table.attr('id', 'clone');
                  clone_table.css({position:'fixed',
                      'pointer-events': 'none',
                      top:0});
                  clone_table.width($(".fix_maintable").width());
                  $(".fix_table-container").append(clone_table);
                  $("#clone").css({visibility:'hidden'});
                  $("#clone").css("margin-top", "49px");                  
                  $("#clone thead").css({visibility:'visible'});
              }
          } else {
              $("#clone").remove();
          }
      }
      $(window).scroll(moveScroll);
	  <?php } ?>
  
	  $('#pre_page_entry').change(function(){
                  var  pre_page_entry = $('#pre_page_entry option:selected').val();
                  var HTTP_PATH='<?php echo base_url(); ?>';
                  $.ajax({
                      type: "POST",
                      url: HTTP_PATH + "view_file/fn_pre_page_entry",
                      datatype: "json",
                      async: true,
                      data: {pre_page_entry:pre_page_entry},
                      success: function(data) {
                         window.location.reload();
                      }
          });
      });	
      
      <?php if(isset($_GET['sign']) && $_GET['sign']=='hide'){?>	
      jQuery.each($("body").find("table td "), function() {
	    $('.dsign span').css({"font-size":"16pt"});
		$(".dsign").hide();
	    this.innerHTML = this.innerHTML.split("(Digitally Signed)").join("");
	    var dt="<em style='font-size:16pt'>डिजिटल हस्ताक्षर</em>";
	    this.innerHTML = this.innerHTML.split("Digitally Signed By").join(dt);
		$dg = $("div .dsign").html();
	    this.innerHTML = this.innerHTML.split("(<b>विरेन्दर सिंह</b>)").join($dg);
		});
	
	<?php } ?>
  </script>
  <input type="checkbox" id="pssirfixed" class="pull-right" data-layout="fixed" style="display:none">
  </body>  
    <script src="<?php echo ADMIN_THEME_PATH; ?>plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo ADMIN_THEME_PATH; ?>dist/js/demo.js" type="text/javascript"></script>
	<script>		
		$(document).ready(function() {
			var loggged_in_usr =  <?php echo checkUserrole(); ?>;
			
			if(loggged_in_usr==3){
				$("body").addClass('fixed');				
			}else{				
				$("#pssirfixed").click();
			}
			
			/*Playing Sound*/
			var sfname = HTTP_PATH+'themes/site/images/yougotmail.mp3';
			var audioElement = document.createElement('audio');
			audioElement.setAttribute('src', sfname);
			
			/*audioElement.addEventListener("load", function() {
				audioElement.play();
			}, true);
			*/
			$('.play').click(function() {
				audioElement.play();
			});

			$('.pause').click(function() {
				audioElement.pause();
			});
				
		});
	</script>
</html>
<?php
    $CI = & get_instance();
    $this->benchmark->mark('end');
    $timetot = $this->benchmark->elapsed_time('start', 'end');
    get_log($timetot);
?>