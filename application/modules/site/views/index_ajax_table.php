 <table id="advocates_table" class="table table-bordered table-striped">
                    <thead>
                      <tr>
						 <th>जिला</th>
						 <th>तहसील</th>
						 <th>नाम</th>
						 <th>नियुक्ति दिनांक</th>
                         <th>नवीनीकरण दिनांक </th>
						 <th>परिवीक्षा काल </th>
						 <th>Actions</th>
						 <th>Panel</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; 
					 // pre($get_users);
                        foreach ($get_users as $key => $users) { 
							if(!empty($users['scm_name_hi']) && $users['post_renew_date'] != '0000-00-00'  && ($adv_type == 1 || $adv_type == 2) ){
								
										$renew_year = date('Y',strtotime($users['post_renew_date']));
										$current_year = date('Y');
										$diff_year = $current_year - $renew_year;
										
										if($diff_year <= 0){
											$color = '';
											
										}
										else if($diff_year == 1){
											 $color = 'yellow';
											
										}
										else if($diff_year == 2){
											 $color = 'orange';
											
										}
										else if($diff_year >= 3){
											 $color = 'rgba(255, 0, 0, 0.51)';//background: rgba(255, 0, 0, 0.39);
										
										}
										
										
								  }
							?>
                        <tr  style="background:<?php echo @$color; ?>" >
							<td>
								<?php if(!empty($users['scm_district_id'])){ echo getDistrict_name($users['scm_district_id']);}else { echo 'N/A'; }?><br/>
							</td>
						 	<td>
									<?php if(!empty($users['scm_tahsil_id'])){ echo get_tahsil_name($users['scm_tahsil_id']);   }else { echo 'N/A'; }?><br/>
							</td>
							<td><?php 
								if(!empty($users['scm_name_en'])){
									$nm='';
								} else if($users['scm_name_hi']==$users['scm_name_en']){ $nm= ''; }else{ $nm= !empty($nm)?' ('.$users['scm_name_en'].')':'' ;}
								if($users['scm_name_hi']!=''){ echo $users['scm_name_hi'].$nm; }else{ echo $users['scm_name_hi'];}
								if(!empty($users['contact_no'])){
								echo "<br><b> मोबाईल :</b>".@$users['contact_no'];
								}
								if(!empty($users['email_id'])){
								echo "<br><b> ईमेल :</b>".$users['email_id'];
								}
								?>								
							</td>						
							 <?php if($this->uri->segment(3) != 9){?>
                            <td><?php if($users['posting_date']!='1970-01-01' && $users['posting_date']!='01-01-1970'&& $users['posting_date']!='0000-00-00' ){ echo date('d-m-Y',strtotime($users['posting_date']));}else{ echo 'N/A';}?></td>
                            <td><?php if($users['post_renew_date']!='1970-01-01' && $users['post_renew_date']!='01-01-1970'&& $users['post_renew_date']!='0000-00-00' ){  echo date('d-m-Y',strtotime($users['post_renew_date']));}else { echo 'N/A';}?></td>
							
							  <?php } ?>
						<td><?php echo @$users['provision_pirod'] .'-वर्ष' ?>
</td>
                         <td><div class="btn-group">
							<a href="<?php echo base_url('advocate');?>/edit_advocate/<?php echo $adv_type;?>/<?php echo $users['scm_id'];?>" class="btn  btn-twitter">Edit</a>
                               <?php if($this->uri->segment(3) == 4){ ?>
								  	<a href="<?php echo base_url();?>admin_notesheet_master/view_file_notesheet/147/12/<?php echo $users['advocate_file_cr_no'];?>?adv_id=<?php echo $users['scm_id'];?>" class="btn  btn-twitter">नवीनीकरण</a>
								  <?php } ?>
							  </div>
                            </td>
							 <td><button class="btn btn-twitter panel_open" data-scm_id ="<?php echo @$users['scm_id'] ? $users['scm_id'] : null ; ?>" data-scm_name_hi ="<?php echo @$users['scm_name_hi'] ? $users['scm_name_hi'] : null ; ?>" data-advocate_post_type ="<?php echo @$users['advocate_post_type'] ? $users['advocate_post_type'] : null ; ?>" data-advocate_post_type_nm ="<?php  echo @$users['advocate_post_type'] ? advocate_posttype_array($users['advocate_post_type']) : null ; ?>" data-scm_district_id ="<?php echo @$users['scm_district_id'] ? $users['scm_district_id'] : null ; ?>" data-scm_tahsil_id ="<?php echo @$users['scm_tahsil_id'] ? $users['scm_tahsil_id'] : null ; ?>" data-scm_taluka_id ="<?php echo $users['scm_taluka_id'] ? $users['scm_taluka_id'] : null ; ?>" data-posting_date ="<?php  echo @$users['posting_date'] ? date('d-m-Y',strtotime($users['posting_date'])) :null  ; ?>" data-post_renew_date ="<?php echo @$users['post_renew_date'] ? date('d-m-Y',strtotime($users['post_renew_date'])) : null ; ?>">Panel status</button></td>
                        </tr>
                       
                      <?php $i++; } ?>
                    </tbody>
                </table>
    
	<script>
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
   	$('.rd_btn').change(function(){
	var radioValue = $("input[name='panel_status']:checked").val();
	var opt = '';
	
	if(radioValue == 'Y'){
		 opt += '<option value=""> चयन करें</option><option> सत्यापन लंबित हैं |</option><option> पुलिस प्रतिवेदन लंबित हैं |</option><option> कार्यालय में विचाराधीन |</option><option> मंत्री जी को भेजा  गया |</option>'
	}else if(radioValue == 'N'){
		 opt += '<option value=""> चयन करें</option><option>नहीं |</option>'
	}
	 $('#panel_tip').html(opt);
	});
</script>
<!--panel model-->
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
                    <button id="btn-delete" onclick="return confirm('क्या आप  पैनल की स्थिति दर्ज करना चहाते है |')" type="submit" class="btn btn-primary send_btn"> Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End-->