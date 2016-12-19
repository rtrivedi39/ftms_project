<!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php echo 'जी.पी./ए.जी.पी. की सम्पूर्ण जानकारी'; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php// echo $title; ?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <!-- Small boxes (Stat box) -->
          <?php //pr($this->session->flashdata); 
               echo $this->session->flashdata('message');
          ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
			  
                <div class="box-header">
					<h3 class="box-title"><?php // echo $title_tab;?><?php  echo 'जी.पी./ए.जी.पी. की सम्पूर्ण जानकारी';?></h3>
					<div class="tools pull-right">
						<!-- <a   href="<?php echo base_url();?>advocate/advocate_report/<?php echo $adv_type; ?>">
							<button class="btn  btn-info"><?php echo $title; ?> रिपोर्ट</button>
						</a>
						<a  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>">
						  <button class="btn  btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
						</a>
						<a  href="<?php echo base_url();?>advocate/repor_view/<?php echo $adv_type; ?>">
						  <button class="btn  btn-info"><?php echo 'जिलेवार स्वीकृत पद देखे'; ?> </button>
						</a>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $this->uri->segment(3); ?>">
							  <button class="btn  btn-info"><?php echo "सूची देखे"; ?> </button>
						</a>
						 
						-->
						
						<a  href="<?php echo base_url();?>advocate/list/1">
							<button class="btn  btn-primary">जी.पी. की सूची</button>
						 </a>
					
						<a href="<?php echo base_url();?>advocate/list/2">
							<button class="btn  btn-primary">ए.जी.पी. की सूची</button>
						 </a>
						<button class="btn btn-success" onclick="printadvocate_table('advocates')"> Print</button>
					
						 <a href="javascript:history.go(-1)">
							<button class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
						</a>
						
						
                    </div>
					 
                  </div>
                
                  <!-- /.box-header -->
                   <div class="clearfix"></div>
				  <div id="ajax_tbl"></div>
                  <table id="leave_employee" class="table table-bordered table-striped">
					  <thead>
					<tr>
							<td></td>
							<td></td>
							<th colspan="3" align="center" class="text-center">जी.पी.</th>
							<th colspan="3" align="center" class="text-center">ए.जी.पी.</th>
					</tr>
                      <tr>
						<th>क्रमांक</th>
						 <th>जिला</th>
						 <th>तहसील</th>	
						 <?php if(isset($adv_type) && ($adv_type==1 || $adv_type==2)) {?>
						 <!--<th>तालुका</th>-->
						 <?php } ?>
						 <th>स्वीकृत पद </th>
						 <th>भरे पद </th>					
						 <th>रिक्त पद </th>							 
						 <th>स्वीकृत पद </th>
						 <th>भरे पद </th>					
						 <th>रिक्त पद </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
					 //echo $adv_type;
					//pre($get_users);
                        foreach ($get_users as $key => $users) { 	
							$gp_posting = get_agp_districtwise($users['district_id'],null);
							//pre($gp_posting);
						?>						
                        <tr>
						<td title="<?php echo $users['district_id']; ?>"><?php echo $i ; ?></td>
							 <td>
								<?php if(!empty($users['district_id'])){ echo $users['district_name_hi'];}else { echo 'N/A'; }
									//echo $repeat[]=$users['district_id'];
									//pre($repeat);
									//echo $users['district_id'];
								?><br/>
							</td>						 	
							<td>
								<?php if(!empty($users['tahsil_id'])){ echo $users['tahsil_name_hi'] ;   }else { echo 'N/A'; }?><br/>								
							</td>							
							<!--<td>
								<?php //if(!empty($users['taluka_id'])){ echo getTaluka_name($users['taluka_id']);   }else { echo 'N/A'; }?>								
							</td>-->															
							<td><?php
									if($users['tahsil_id']== $gp_posting['tahsil_id']){
										echo $gp_posting['approved_posts']; 
									}else{
										echo '&nbsp;';
									}									
								?>
							</td>
							<td><?php 
								if($users['tahsil_id']== $gp_posting['tahsil_id']){
										echo $gp_posting['filled_posts']; 
									}else{
										echo '&nbsp;';
									}
								?>
							</td>
							<td><?php 
								if($users['tahsil_id']== $gp_posting['tahsil_id']){
										echo $gp_posting['vacant_seats']; 
									}else{
										echo '&nbsp;';
									} ?>
							</td>
							<td><?php  echo $users['approved_posts'];?></td>
							<td><?php echo $users['filled_posts'];?></td>														  
							<td><?php echo @$users['vacant_seats'];?></td>
													
							<td>
								
							</td>
									
                        </tr>
                      <?php $i++; } ?>
                    </tbody>
                </table>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
            </div>
          </div><!-- /.row -->
          <!-- Main row -->
        </section><!-- /.content -->
<?php $this->load->view('advocates_js')?>
        <script type="text/javascript">
          function is_delete(){
            var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
            if(res===false){
              return false;
            }
          }
        </script>
        <style type="text/css">
        #leave_employee_filter{
          clear: both;
        }
        </style>
    
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script type="text/javascript">
 
   $(document).ready(function () {
			$("#district_id").change(function() {
			
				var district_id = $(this).val() ;					
				var HTTP_PATH='<?php echo base_url(); ?>';
				 $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/getTahsil_list",
					datatype: "json",
					async: false,
					data: {district_id: district_id},
					success: function(data) {
						    					$(".tahsil_list").hide();
												$("#tahsil_div").html(data);
												get_advocate_from_dist_tahsil(district_id );
												
												
						

					}
            	});
				/*get taluka list*/
				$.ajax({
				
					type: "POST",
					url: HTTP_PATH + "advocates/getaluka_list",
					datatype: "json",
					async: false,
					data: {district_id: district_id},
					success: function(data) {
							  $(".taluka_list").hide();
							  $("#taluka_div").html(data);
						

					}
            	});
			
			
			})	;
	   
		 
		});	
	function get_advocate_from_dist_tahsil(district_id ,tahsil_id = null ,taluka_id = null )
	{
		var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
		
		var HTTP_PATH='<?php echo base_url(); ?>';
				 /*get tahsil list*/
				   $.ajax({
					type: "POST",
					url: HTTP_PATH + "advocates/get_ajax_data/",
					datatype: "json",
					async: false,
					data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id},
					success: function(data) {
						 $("table").remove();
						 $("#ajax_tbl").html(data);
							
							
					}
            	});
	}
	function get_tahsil_details(tahsil_id,scttext){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
			
					 /*get tahsil list*/
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/get_ajax_data/",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
							

						}
					});
	}
	function get_taluka_details(taluka_id){
			var adv_type = '<?php echo $this->uri->segment(3) ?>' ;
			var district_id = $("#district_id").val();
			var tahsil_id = $("#tahsil_val").val();
			var HTTP_PATH='<?php echo base_url(); ?>';
					 /*get tahsil list*/
					   $.ajax({
						type: "POST",
						url: HTTP_PATH + "advocates/get_ajax_data/",
						datatype: "json",
						async: false,
						data: {adv_type:adv_type, district_id: district_id,tahsil_id:tahsil_id,taluka_id:taluka_id },
						success: function(data) {
							 $("table").remove();
							 $("#ajax_tbl").html(data);
												

						}
					});
	}
	
	  
	  $(".panel_open").click(function(){
       var scm_id = $(this).data("scm_id");
       var scm_name_hi = $(this).data("scm_name_hi");
       var advocate_post_type = $(this).data("advocate_post_type");
       var advocate_post_type_nm = $(this).data("advocate_post_type_nm");
       var scm_district_id = $(this).data("scm_district_id");
       var scm_tahsil_id = $(this).data("scm_tahsil_id");
       var scm_taluka_id = $(this).data("scm_taluka_id");
       var posting_date = $(this).data("posting_date");
       var post_renew_date = $(this).data("post_renew_date");
	   
	    if(scm_tahsil_id == '' || scm_tahsil_id == '0'){
           $('#tehsil_div').hide();
       }
       if(scm_taluka_id == '' || scm_taluka_id == '0'){
           $('.taluka_div').hide();
       }
       if(scm_district_id == '' || scm_district_id == '0'){
           $('#district_div').hide();
       }

       $('#panel_advocate_id').val(scm_id);
       $('#panel_advocate_id_nm').val(scm_name_hi);
       $('#panel_post_id').val(advocate_post_type);
       $('#panel_post_id_nm').val(advocate_post_type_nm);
       $('#panel_district_id').val(scm_district_id);
       $('#panel_tehsil_id').val(scm_tahsil_id);
       $('#panel_taluka_id').val(scm_taluka_id);
       $('#join_date').val(posting_date);
       $('#renew_date').val(post_renew_date);
	   
	   var district_text = $(this).closest("tr").find('td:eq(0)').text();
       var tahsil_text = $(this).closest("tr").find('td:eq(1)').text();
	   $('#panel_district_text').val(district_text.trim());
       $('#panel_tehsil_text').val(tahsil_text.trim());

	    $('#list_panel').attr('href','<?php echo base_url() ;?>advocates/manage_adv_panel_list/'+scm_id);
       $('#modal-panel_status').modal('show');
   });
</script>
<div class="modal fade" id="modal-panel_status" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" action="<?php echo base_url() ;?>advocates/manage_adv_panel">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i>पैनल की स्थिति दर्ज  करे  |
					 <a id="list_panel">पैनल की स्थिति देखे </a>
					</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नाम</label></div>
                                        <div class="col-md-9"><input type="text" id="panel_advocate_id_nm" name="panel_advocate_id_nm" class="form-control" readonly></div>
                                        <input type="hidden" id="panel_advocate_id" name="panel_advocate_id">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">पद</label></div>
                                        <div class="col-md-9">
                                         <input type="text" id="panel_post_id_nm" name="panel_post_id_nm" class="form-control" readonly>
                                        </div>
                                        <input type="hidden" id="panel_post_id" name="panel_post_id">
                                    </div>

                                    <div class="form-group row" id="district_div">
                                        <div class="col-md-3"><label for="exampleInputFile">जिला</label></div>
                                        <div class="col-md-9">
										<input type="text" id="panel_district_text" name="panel_district_text"  class="form-control" readonly>
                                        <input type="hidden" id="panel_district_id" name="panel_district_id">
                                        </div>
                                    </div>

                                    <div class="form-group row" id="tehsil_div">
                                        <div class="col-md-3"><label for="exampleInputFile">तहसील</label></div>
                                        <div class="col-md-9">
                                        <input type="text" id="panel_tehsil_text" name="panel_tehsil_text" class="form-control" readonly>
                                        <input type="hidden" id="panel_tehsil_id" name="panel_tehsil_id">
                                        </div>
                                    </div>

                                    <div class="form-group row taluka_div">
                                        <div class="col-md-3"><label for="exampleInputFile">तालुका</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="panel_taluka_id" name="panel_taluka_id"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नियुक्ति दिनांक</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="join_date" name="" placeholder="Put name here"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">नवीनीकरण दिनांक</label></div>
                                        <div class="col-md-9">
                                            <input type="text" id="renew_date" name="" placeholder="Put name here"  class="form-control" readonly>
                                        </div>
                                    </div>

                                    <hr/>
                                    <div class="form-group row">
                                       <div class="col-md-3"><label for="exampleInputFile">पैनल की स्थिति</label></div>
                                       <div class="col-md-3 has-success"><input type="radio" name="panel_status" class="rd_btn" value="Y"/> <label> हां </label> </div>
                                       <div class="col-md-3"><input type="radio" name="panel_status" class="rd_btn" value="N"/> <label> नही </label> </div>
                                    </div>
									
									 <div class="form-group row">
                                        <div class="col-md-3"><label for="exampleInputFile">स्थिति</label></div>
                                        <div class="col-md-9">
                                            <select class="form-control" name="panel_tip" id="panel_tip">
                                               <option value=""> चयन करें</option>                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <div class="col-md-3"><label for="exampleInputFile">स्थिति का कारण</label></div>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="panel_discription" id="panel_discription" required=""></textarea>
                                    </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    <button id="btn-delete" onclick="return confirm('क्या आप  पैनल की स्थिति दर्ज ')" type="submit" class="btn btn-primary send_btn"> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->
<script>

	$('.rd_btn').change(function(){
	var radioValue = $("input[name='panel_status']:checked").val();
	var opt = '';
	if(radioValue == 'Y'){
		 opt += '<option value=""> चयन करें</option><option> सत्यापन लंबित हैं |</option><option> पुलिस प्रतिवेदन लंबित हैं |</option><option> कार्यालय में विचाराधीन |</option><option> मंत्री जी को भेजी गई  |</option>'
	}else if(radioValue == 'N'){
		 opt += '<option value=""> चयन करें</option><option>नहीं |</option>'
	}
	 $('#panel_tip').html(opt);
	});

    $('#panel_tip').change(function(){
        var panel_tip_val = $('#panel_tip option:selected').val();
        if(panel_tip_val != ''){
            var panel_tip = $('#panel_tip option:selected').text();
            $('#panel_discription').val(panel_tip);
        }else{
            $('#panel_discription').val('');
        }

    });
	</script>

