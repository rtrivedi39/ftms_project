<?php $userrole = checkUserrole(); ?>
<?php $upper_officer=array('1','3','4','5','6','7'); 
	$dis_type = $_GET['ac'] ;
	?>
<!-- Content Header (Page header) -->
<div id="advocates">
        <section class="content-header">
          <h1 class="adv_title">
            <?php// echo $title; ?>
			<?php echo $tit; ?>के जिलेवार स्वीकृत पद देखे
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active"><?php echo $tit; ?> के जिलेवार स्वीकृत पद देखे</li>
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
					<h3 class="box-title  no-print"><?php echo $title_tab;?> </h3>
					<div class="tools pull-right  no-print">
						
					<?php if($adv_type == 1){ ?>
						<a   href="<?php echo base_url();?>advocate/repor_view/2">
							<button class="btn btn-sm btn-primary">ए.जी.पी. के जिलेवार स्वीकृत पद देखे</button>
						 </a>
						<?php } ?>
						<?php if($adv_type == 2){	?>
						<a   href="<?php echo base_url();?>advocate/repor_view/1">
							<button class="btn btn-sm btn-primary">जी.पी. के जिलेवार स्वीकृत पद देखे</button>
						 </a>
						<?php } ?>
						
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $this->uri->segment(3); ?>">
							  <button class="btn btn-sm btn-info"><?php echo $tit; ?> <?php echo "की सूची देखे"; ?> </button>
						</a>
							<?php if($adv_type == 1 || $adv_type == 2 ){	?>
						<a  href="<?php echo base_url();?>advocate/report_view_agp_gp">
							<button class="btn btn-sm btn-info"><?php echo ' जी. पी./ए.जी.पी. की सम्पूर्ण जानकारी'; ?> </button>
						</a>
						<?php } ?>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>/rdo" <?php if(!empty($search_type) && $search_type == 'rdo') { echo 'disabled'; }?>  class="btn b btn-sm btn-info">
							<?php echo $tit; ?> जिनका नवीनीकरण समाप्त हो गया है 
						</a>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>/smtr" <?php if(!empty($search_type) && $search_type == 'smtr') { echo 'disabled' ; }?> class="btn b btn-sm btn-info">
							<?php echo $tit; ?> जिनका नवीनीकरण आने वाला है 
						</a>					
						
					 
						<!--<a   href="<?php //echo base_url();?>advocate/advocate_report/<?php echo $adv_type; ?>">
							<button class="btn  btn-info"><?php //echo $tit; ?> की रिपोर्ट</button>
						</a>-->
						<?php if(!in_array($userrole,$upper_officer)){ ?>
						<a  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>" >
						  <button class="btn btn-sm btn-info"><?php echo $this->lang->line('add_button'); ?> </button>
						</a>
						<a  href="<?php echo base_url();?>advocate/list/<?php echo $adv_type; ?>?ac=report">
                            <button class="btn b btn-sm btn-info"><?php echo 'रिपोर्ट' ?> </button>
                        </a>
						<?php } ?>
						
						<!--<a  href="<?php echo base_url();?>advocate/repor_view/<?php echo $adv_type; ?>">
						  <button class="btn  btn-info"><?php echo $tit; ?> <?php echo 'के जिलेवार स्वीकृत पद देखे'; ?> </button>
						</a>-->				
						<?php 
                	 	if($userrole==1){
                    	?>
	                         <a  href="<?php echo base_url();?>advocate/repor_view/<?php echo $adv_type; ?>?ac=del">
							  	<button class="btn b btn-sm btn-danger"><?php echo 'नष्ट करें' ?> </button>
								</a>								                    
	                    <?php } ?>
						<button class="btn btn-success" onclick="printadvocate_table('advocates')"> Print</button>
						<a href="javascript:history.go(-1)">
							<button class="btn btn-sm btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
						</a>
                    </div>
					 
                  </div>
                
                  <!-- /.box-header -->
                   <div class="clearfix"></div>
				  <div id="ajax_tbl"></div>
                  <table id="leave_employee" class="table table-bordered table-striped"> <!--leave_employee-->
                    <thead>
                      <tr>
			 <th>क्रमांक</th>
						 <th>जिला</th>
						 <?php if(isset($adv_type) && ($adv_type==1 || $adv_type==2|| $adv_type==4)) {?>
						 <th>तहसील</th>						 
						 <!--<th>तालुका</th>-->
						 <?php } ?>
						 <th>स्वीकृत पद </th>
						 <th>भरे पद </th>					
						 <th>रिक्त पद </th>	
						 <th>नाम</th>					 
						<?php if($userrole==1 &&  isset($_GET['ac']) && $_GET['ac']=='del' ){?>
						<th  class="no-print">Action</th>
						<?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
					 //echo $adv_type;
					 //pre($get_users);
                        foreach ($get_users as $key => $users) { ?>
                        <tr>
						<td title="<?php if($userrole==1 &&  isset($_GET['ac']) && $_GET['ac']=='del' ){ echo $users['advocate_posting_id']; }?>"><?php echo $i ; ?></td>
							 <td>
								<?php if(!empty($users['district_id'])){ echo $users['district_name_hi'];}else { echo 'N/A'; }?><br/>
							</td>
						 	<?php if(isset($adv_type) && ($adv_type==1 || $adv_type==2|| $adv_type==4)) {?>
							<td>
								<?php if(!empty($users['tahsil_id'])){ echo $users['tahsil_name_hi'];   }else { echo 'N/A'; }?><br/>								
							</td>								
							<!--<td>
								<?php //if(!empty($users['taluka_id'])){ echo getTaluka_name($users['taluka_id']);   }else { echo 'N/A'; }?>								
							</td>-->
							<?php } ?>
							<td><?php echo $users['approved_posts'];?></td>
							<td><?php echo $users['filled_posts'];?></td>														  
							<td><?php echo @$users['vacant_seats'];?></td>
							<td>
								<?php   
									if(!empty($users['district_id'])  && !empty($users['tahsil_id'])){
										$agpname= get_advocates_name(array('advocate_post_type'=>$adv_type,'scm_district_id'=>$users['district_id'],'scm_tahsil_id'=>$users['tahsil_id']), null,'*'); 
									if(empty($agpname)){
									$pst = ''	;	
									if($adv_type == '1'){ $pst = 'जी.पी. का' ; } if($adv_type == '2'){ $pst = 'ए.जी.पी. के' ; }
									if($users['approved_posts'] == 0){	
									echo $pst." स्वीकृत पद नही  है |";
									}else{ echo $pst." पद रिक्त है |"; }									
									}									
									}else {
										$agpname='';										
									}
										//pre($agpname);	
									echo '<div class="col-xs-12">'; 
									//echo '<tr><td>Name</td><td style="width:90px">पैनल स्थिति</td></tr>';	
									foreach($agpname as $ky=>$agp_gp_name_val){
									//	echo '<div class="col-md-6">'.$agp_gp_name_val->scm_name_hi.'</div>';		
										echo '<div class="col-md-6  pull-left"><a href="javascript:void(0)" style="cursor:pointer" onclick = "user_details_open('.$agp_gp_name_val->scm_id.' , '. $agp_gp_name_val->advocate_post_type .')">'.$agp_gp_name_val->scm_name_hi.'</a></div>';
									?>
									<div class="col-md-6  pull-right no-print">
									<?php if(!in_array($userrole,$upper_officer) && $dis_type != 'report'){ ?>
									<a  href="<?php echo base_url();?>advocate/add/<?php echo $adv_type; ?>"></a>
									
										<button class="btn btn-twitter panel_open" data-scm_id ="<?php echo @$agp_gp_name_val->scm_id ? $agp_gp_name_val->scm_id : null ; ?>" data-scm_name_hi ="<?php echo @$agp_gp_name_val->scm_name_hi ? $agp_gp_name_val->scm_name_hi : null ; ?>" data-advocate_post_type ="<?php echo @$agp_gp_name_val->advocate_post_type ? $agp_gp_name_val->advocate_post_type : null ; ?>" data-advocate_post_type_nm ="<?php  echo @$agp_gp_name_val->scm_post_hi ? $agp_gp_name_val->scm_post_hi : null ; ?>" data-scm_district_id ="<?php echo @$agp_gp_name_val->scm_district_id ? $agp_gp_name_val->scm_district_id : null ; ?>" data-scm_tahsil_id ="<?php echo @$agp_gp_name_val->scm_tahsil_id ? $agp_gp_name_val->scm_tahsil_id : null ; ?>" data-scm_taluka_id ="<?php echo $agp_gp_name_val->scm_taluka_id ? $agp_gp_name_val->scm_taluka_id : null ; ?>" data-posting_date ="<?php echo @$agp_gp_name_val->posting_date ? date('d-m-Y',strtotime($agp_gp_name_val->posting_date)) :null  ; ?>" data-post_renew_date ="<?php echo @$agp_gp_name_val->post_renew_date ? date('d-m-Y',strtotime($agp_gp_name_val->post_renew_date)) : null ; ?>">Panel status</button>
									<?php }else{ ?>
										 <?php
							                $panel_dt =  get_panel_data($agp_gp_name_val->scm_id) ;
											if(!empty($panel_dt)){
											$date1 = '';
				if($panel_dt['panel_status'] == 'Y'){
				$date1 = date('d-m-Y',strtotime($panel_dt['panel_create_date']));
					}
				if($panel_dt['panel_status'] == 'N'){
				$date1 = date('d-m-Y',strtotime($panel_dt['panel_close_date']));
					}
											echo @$panel_dt['panel_status'] == 'Y' ? 'हाँ' : '';
							                echo @$panel_dt['panel_status'] == 'N' ? '' : '';
							                echo ' ';
							                echo $panel_dt['panel_discription'];
							                echo ' ';
							               // echo @$panel_dt['panel_status'] == 'Y' ? date('d-m-Y',strtotime($panel_dt['panel_create_date'])) : '';
							              //  echo @$panel_dt['panel_status'] == 'N' ? date('d-m-Y',strtotime($panel_dt['panel_close_date'])) : '';
												}else{
												echo "-";
												} ?>
									<?php	} ?> 
									</div><br/>									
									
									<?php } ?>									
									<?php echo '</div>';
									//$arra_were= array('advocate_post_type'=>$adv_type,'scm_district_id'=>$users['district_id'],'scm_tahsil_id'=>$users['tahsil_id'])
									
								?>
								<!--Delete-->								
								
							</td>	
							<?php if($userrole==1 &&  isset($_GET['ac']) && $_GET['ac']=='del' ){?>
							<td  class="no-print">
								<?php if($userrole==1 &&  isset($_GET['ac']) && $_GET['ac']=='del' ){?>
									<button class="btn  btn btn-danger" onclick="return delte_post( '<?php echo $adv_type; ?>','<?php echo $users['advocate_posting_id'] ; ?>');"><?php echo 'नष्ट करें' ?> </button>
								<?php } ?>	
							</td>
							<?php } ?>					
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
</div>
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
 
  function delte_post(post_type_id,post_id){
	    var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
		if(res==true ){
			window.location = "<?php echo base_url() ?>advocate/delete_posting_master/"+post_id+"/"+post_type_id;
			
		}else {return false;}
	}
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
	   
	   var district_text = $(this).closest("tr").find('td:eq(1)').text();
       var tahsil_text = $(this).closest("tr").find('td:eq(2)').text();
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
		 opt += '<option value=""> चयन करें</option><option>नहीं |</option><option>प्राप्त </option><option>विचाराधीन</option>'
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
<?php $this->load->view('footer_show_user_detail') ; ?>
