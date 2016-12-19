<script type="text/javascript">
   function user_details_open(usr_id , adv_type){
       var usr_id = usr_id;
       var adv_type = adv_type;
       var HTTP_PATH='<?php echo base_url(); ?>';
       $.ajax({
           type: "POST",
           url: HTTP_PATH + "advocates/get_ajax_user_detail/",
           datatype: "json",
           async: true,
           data: {user_id:usr_id, adv_type: adv_type},
           success: function(data) {
            var r_data = JSON.parse(data);
              console.log(r_data);
               var advocate_t ='<?php echo json_encode(court_name_array()); ?>';
               var advocate_type_ar = JSON.parse(advocate_t);
               var sex = '';
			   console.log(r_data['scm_gender']);
               if(r_data['scm_gender'] == 'F'){
                sex = 'स्त्री';
               }
               if(r_data['scm_gender'] == 'M') {
                sex = 'पुरुष';
               }
			    if(r_data['scm_gender'] == 'O') {
                sex = 'अन्य';
               }

               $("#scm_name_hi_id , #show_name").text(r_data['scm_name_hi']);
			   
			   
			   if(r_data['adv_work_experiance'] == null){
					$("#adv_work_experiance_id").text('-');
			   }
			   else{
				   $("#adv_work_experiance_id").text(r_data['adv_work_experiance']);
				   }
			   if(r_data['scm_father_name_hi'] == null ){
					$("#scm_father_name_hi_id").text('-');
			   }else{
					$("#scm_father_name_hi_id").text(r_data['scm_father_name_hi']);
			   }
			   
               $("#scm_gender_id").text(sex);
			   
			  
			   if( r_data['scm_dob'] != null ){
			   var date_dob    = new Date(r_data['scm_dob']);
				dob_year      = date_dob.getFullYear(),
				 console.log(dob_year);
				dob_month   = date_dob.getMonth() < 10 ? '0' + date_dob.getMonth() : date_dob.getMonth();
				dob_month = parseInt(dob_month) +1;
				dob_day     = date_dob.getDate()  < 10 ? '0' + date_dob.getDate()  : date_dob.getDate();
				dob_date = dob_day + '-' + dob_month + '-'+  dob_year ;
				
				
			   }else{
					$("#scm_dob_id").text("-");
			   }
			   if(r_data['email_id'] == null ){
					$("#email_id_id").text('-');
			   }else{
					$("#email_id_id").text(r_data['email_id']);
			   }
			   if(r_data['scm_address_hi'] == null ){
					$("#scm_address_hi_id").text('-');
			   }else{
					$("#scm_address_hi_id").text(r_data['scm_address_hi']);
			   }
			   
               $("#advocate_type_id").text(advocate_type_ar[r_data['advocate_type']]);
			 
			   if(r_data['posting_date'] != null ){
				   
					var date_post    = new Date(r_data['posting_date']);
					post_yr      = date_post.getFullYear(),
					
					post_month   = date_post.getMonth() < 10 ? '0' + date_post.getMonth() : date_post.getMonth();
					post_month = parseInt(post_month) +1;
					post_day     = date_post.getDate()  < 10 ? '0' + date_post.getDate()  : date_post.getDate();
					post_renew_date = post_day+ '-' + post_month + '-'+  post_yr ;
					$("#posting_date_id").text(post_renew_date);
			    }
			 
			   if(r_data['provision_pirod'] != null){
					$("#provision_pirod_id").text(r_data['provision_pirod']+' वर्ष');
			   }else{
					$("#provision_pirod_id").text('-');

			   }
			 
			  if(r_data['post_renew_date'] != null ){
			   var post_renew_date    = new Date(r_data['post_renew_date']);
				post_renew_yr      = post_renew_date.getFullYear(),
			
				post_renew_month   = post_renew_date.getMonth() < 10 ? '0' + post_renew_date.getMonth() : post_renew_date.getMonth();
				post_renew_month = parseInt(post_renew_month) +1;
				post_renew_day     = post_renew_date.getDate()  < 10 ? '0' + post_renew_date.getDate()  : post_renew_date.getDate();
				post_renew_date = post_renew_day+ '-' + post_renew_month + '-'+  post_renew_yr ;
				$("#post_renew_date_id").text(post_renew_date);
			  }else{
			  	$("#post_renew_date_id").text("-");
			  }
			  if(r_data['adv_invoice_no'] == null){
			     $("#adv_invoice_no_id").text('-');
			  }else{
				 $("#adv_invoice_no_id").text(r_data['adv_invoice_no']);
			  }
			  
			  console.log(r_data['application_for_renewal_date']);
			  if(r_data['application_for_renewal_date'] != null && r_data['application_for_renewal_date'] !='0000-00-00' ){
			   var application_for_renewal_date    = new Date(r_data['application_for_renewal_date']);
				application_for_renewal_yr      = application_for_renewal_date.getFullYear(),
			
				application_for_renewal_month   = application_for_renewal_date.getMonth() < 10 ? '0' + application_for_renewal_date.getMonth() : application_for_renewal_date.getMonth();
				application_for_renewal_month = parseInt(application_for_renewal_month) +1;
				application_for_renewal_day     = application_for_renewal_date.getDate()  < 10 ? '0' + application_for_renewal_date.getDate()  : application_for_renewal_date.getDate();
				application_for_renewal_date = application_for_renewal_day+ '-' + application_for_renewal_month + '-'+  application_for_renewal_yr ;
				$("#application_for_renewal_date").text(application_for_renewal_date);
			  }else{
			  	$("#application_for_renewal_date").text("-");
			  }
			   if(r_data['adv_invoice_date'] != null ){
			  	
			     var adv_invoice_date    = new Date(r_data['adv_invoice_date']);
				invoice_yr      = adv_invoice_date.getFullYear(),
				
				invoice_month   = adv_invoice_date.getMonth() < 10 ? '0' + adv_invoice_date.getMonth() : adv_invoice_date.getMonth();
				invoice_month = parseInt(invoice_month) +1;
				invoice_day     = adv_invoice_date.getDate()  < 10 ? '0' + adv_invoice_date.getDate()  : adv_invoice_date.getDate();
				invoice_date = day+ '-' + invoice_month + '-'+  invoice_day ;
				
				console.log("invoice_date"+invoice_date);
               $("#adv_invoice_date_id").text(invoice_date);
			   }else{
			     $("#adv_invoice_date_id").text("-");
			   }
             if(r_data['once_registration_number_council'] != null ){
               $("#once_registration_number_council_id").text(r_data['once_registration_number_council']);
			 }else{
			  $("#once_registration_number_council_id").text("-");
			 }
           }
		   
       });
       $('#modal-user_details').modal('show');
   }

</script>

<!--user model-->
<div class="modal fade" id="modal-user_details" data-backdrop="static">
    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-male"></i><span id="show_name"></span> का रिकॉर्ड देखे </h4>
                </div>
                <div class="modal-body">
                    <div class="box-body table-responsive">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">पूरा नाम </label></div>
                                        <div class="col-md-7"><span id="scm_name_hi_id"></span></div>
                                    </div>

                                    <div class="form-group row" id="district_div">
                                        <div class="col-md-5"><label for="exampleInputFile">कार्य अनुभव <br/> (वर्ष में ) :</label></div>
                                        <div class="col-md-7"><span id="adv_work_experiance_id"></span></div>
                                    </div>

                                    <div class="form-group row" id="tehsil_div">
                                        <div class="col-md-5"><label for="exampleInputFile">पिता का नाम:</label></div>
                                        <div class="col-md-7"><span id="scm_father_name_hi_id"></span></div>
                                    </div>

                                    <div class="form-group row taluka_div">
                                        <div class="col-md-5"><label for="exampleInputFile"> लिंग </label></div>
                                        <div class="col-md-7"><span id="scm_gender_id"></span> </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile"> जन्म दिनांक:</label></div>
                                        <div class="col-md-7"><span id="scm_dob_id"></span> </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">ईमेल आई डी:</label></div>
                                        <div class="col-md-7"><span id="email_id_id"></span></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">फ़ोन/मोबाइल नंबर:</label></div>
                                        <div class="col-md-7"><span id="">-</span> </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">वर्तमान पता</label></div>
                                        <div class="col-md-7"><span id="scm_address_hi_id"></span></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">न्यायालय के प्रकार:</label></div>
                                        <div class="col-md-7"><span id="advocate_type_id"></span></div>
                                    </div>

                                </div>
                                <div class="col-xs-6">

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">प्रथम नियुक्ति दिनांक:</label></div>
                                        <div class="col-md-7"><span id="posting_date_id"></span></div>
                                    </div>

                                    <div class="form-group row" id="district_div">
                                        <div class="col-md-5"><label for="exampleInputFile">परिवीक्षा काल</label></div>
                                        <div class="col-md-7"><span id="provision_pirod_id"></span></div>
                                    </div>

                                    <div class="form-group row" id="tehsil_div">
                                        <div class="col-md-5"><label for="exampleInputFile">नवीनीकरण दिनांक:</label></div>
                                        <div class="col-md-7"><span id="post_renew_date_id"></span></div>
                                    </div>

                                    <div class="form-group row taluka_div">
                                        <div class="col-md-5"><label for="exampleInputFile">नवीनीकरण हेतु आवेदन दिनांक:</label></div>
                                        <div class="col-md-7"><span id="application_for_renewal_date"></span></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile"> चालान क्रमांक:</label></div>
                                        <div class="col-md-7"><span id="adv_invoice_no_id"></span></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile"> चालान दिनांक:</label></div>
                                        <div class="col-md-7"><span id="adv_invoice_date_id"></span></div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-5"><label for="exampleInputFile">बार कांउसिल का पंजीयन क्रमांक </label></div>
                                        <div class="col-md-7"><span id="once_registration_number_council_id"></span></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                 </div>
            </div>
    </div>
</div>
<!--End-->
