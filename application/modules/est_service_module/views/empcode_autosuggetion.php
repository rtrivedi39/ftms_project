<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<style>
#suggesstion-box ,#suggesstion-box_emp_code ,#suggesstion-box_search {position: absolute;z-index: 99; border-left:1px solid #ccc;border-right:1px solid #ccc;border-bottom: 1px solid #ccc; }
.frmSearch {border: 1px solid #F0F0F0;background-color:#C8EEFD;margin: 2px 0px;padding:40px;}
#employee_unicode-list, #employee_fullname-list{float:left;list-style:none;margin:0;padding:0;width:200px;}
#employee_unicode-list , #employee_fullname-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid; cursor: pointer ;  background: beige;}
/* #employee_unicode-list , #employee_fullname-list li:hover{background:#F0F0F0;} */
#search-box{padding: 10px;border: #F0F0F0 1px solid; }
#scm_name_en-error , #scm_name_hi-error, #advocate_posttype-error , #advocate_aplicant_type-error  ,#scm_address_hi-error{ color:#a94442 }
</style>

<script>

$(document).ready(function(){
			

    $("#app_apply_amount , #app_petrol_lit").keyup(function(){

       var app_apply_amount = $(this).val();
       /* var app_apply_amount = $("#app_apply_amount").val(); */
        var app_petrol_lit = $("#app_petrol_lit").val();

        var mst_condition_999 = $("#mst_condition_999").html();
        var mst_con_type_999 = $("#mst_con_type_999").html();

        var mst_condition_5 = $("#mst_condition_5").html();
        var mst_con_type_5 = $("#mst_con_type_5").html();

        var emp_class_id_hidden = $("#emp_class_id_hidden").val();

        if(mst_condition_5 == undefined){
            mst_condition_5 = mst_condition_999;
            mst_con_type_5 = mst_con_type_999 ;
        }
        
        if(mst_con_type_5 == 'rupee'){
            if(emp_class_id_hidden == 5){
                if(parseFloat(app_apply_amount) > parseFloat(mst_condition_5)){
                    $( "#amount_1" ).addClass( "has-error" );
                    $( "#show_msg_ac").html('<span class="text-danger">नियम अनुसार माह में केवल '+ mst_condition_5 +' रूपए .... ?</span>');
                }else{
                    $( "#amount_1" ).removeClass( "has-error" );
                    $( "#show_msg_ac").html('');
                }
            }else{
                if(parseFloat(app_apply_amount) > parseFloat(mst_condition_5)){
                    $( "#amount_1" ).addClass( "has-error" );
                    $( "#show_msg_ac").html('<span class="text-danger">नियम अनुसार माह में केवल '+ mst_condition_5 +' रूपए .... ?</span>');
                }else{
                    $( "#div_petrol_lit" ).removeClass( "has-error" );
                    $( "#show_msg_ac").html('');
                }
            }
        }
        if(mst_con_type_5 == 'liter'){
            if(emp_class_id_hidden == 5){
                if(parseFloat(app_petrol_lit) > parseFloat(mst_condition_5)){
                    $( "#div_petrol_lit" ).addClass( "has-error" );
                    $( "#show_msg_p").html('<span class="text-danger">नियम अनुसार माह में केवल '+mst_condition_5+' लीटर पेट्रोल .... ?</span>');
                }else{
                    $( "#div_petrol_lit" ).removeClass( "has-error" );
                    $( "#show_msg_p").html('');
                }
            }else{
                if(parseFloat(app_petrol_lit) > parseFloat(mst_condition_5)){
                    $( "#div_petrol_lit" ).addClass( "has-error" );
                    $( "#show_msg_p").html('<span class="text-danger">नियम अनुसार माह में केवल 60 लीटर पेट्रोल .... ?</span>');
                }else{
                    $( "#div_petrol_lit" ).removeClass( "has-error" );
                    $( "#show_msg_p").html('');
                }
            }
        }

    });




	$("#applicant_name").keyup(function(){
		var emp_full_name = $(this).val();
		 var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "establishment/getemployee_from_name",
		data:{ emp_full_name : emp_full_name } ,
		beforeSend: function(){
			$("#applicant_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			console.log(data);
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#applicant_name").css("background","#FFF");
		}
		});
	});

    /*$("#applicant_emp_code").keyup(function(){
        var emp_unique_code = $(this).val();
        var HTTP_PATH='<?php// echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "establishment/getemployee_emp_code",
            data:{ emp_unique_code : emp_unique_code } ,
            beforeSend: function(){
                $("#applicant_emp_code").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){
                console.log(data);
                $("#suggesstion-box_emp_code").show();
                $("#suggesstion-box_emp_code").html(data);
                $("#applicant_emp_code").css("background","#FFF");
            }
        });
    });*/
	
	$("#applicant_emp_code_search").keyup(function(){
		var emp_unique_code = $(this).val();
		 var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "establishment/getemployee_emp_code",
		data:{ emp_unique_code : emp_unique_code } ,
		beforeSend: function(){
			$("#applicant_emp_code_search").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			console.log(data);
			$("#suggesstion-box_search").show();
			$("#suggesstion-box_search").html(data);
			$("#applicant_emp_code_search").css("background","#FFF");
		}
		});
	});

    $("#gpfdpf_adv , #pay_persent").on('keyup change', function (){
	var persent = $("#pay_persent").val();
	var gpfdpf_adv = $("#gpfdpf_adv").val();
        if(persent == '90'){
			var previous_year_amnt = parseFloat($('#previous_year_amnt').val()) + parseFloat($('#current_year_amnt').val()) + parseFloat($('#curr_current_year_amt').val());
			}else{
			var previous_year_amnt = $('#previous_year_amnt').val();
			}    
        if (parseFloat(this.value) && parseFloat(previous_year_amnt) && this.value.length != 0) {
        var minus =  parseFloat(previous_year_amnt) - parseFloat(gpfdpf_adv) ;
        $('#gpfdpf_total_amt').val(minus);
        }else{   
            $('#gpfdpf_total_amt').val('');
        }
    });

  /*  $("#gpfdpf_adv , #pay_persent").change(function(){
        var persent = $("#pay_persent").val();
        var gpfdpf_total_amt = $("#gpfdpf_total_amt").val();
        if (parseFloat(gpfdpf_total_amt) && parseFloat(persent) && gpfdpf_total_amt != 0 ) {
        var max_amount =  parseFloat(gpfdpf_total_amt)* parseFloat(persent)/100 ;
        $('.check_show').show();
        $('#max_amount').html(max_amount);
        }else{
            $('.check_show').hide();
            $('#max_amount').html('');
        }
    }); */
    
        $("#gpfdpf_adv , #pay_persent").change(function(){
        var persent = $("#pay_persent").val();
        var gpfdpf_total_amt = $("#gpfdpf_total_amt").val();
         if(persent == '90'){
		 $('#curr_current_year_div').show();
        }else{            
            $('#curr_current_year_div').hide();
            $('#curr_current_year_amt').val('');
        }
        if(parseFloat(gpfdpf_total_amt) && parseFloat(persent) && gpfdpf_total_amt != 0 ) {
        var max_amount =  parseFloat(gpfdpf_total_amt)* parseFloat(persent)/100 ;
        $('.check_show').show();
        $('#max_amount').html(max_amount);
        }else{
            $('.check_show').hide();
            $('#max_amount').html('');
        }
    });
    
});



<?php if($this->uri->segment(2) == 'user_service_forms' || $this->uri->segment(2) == 'user_bill_forms'){ ?>

$(document).ready(function(){
    var emp_id='<?php echo $this->session->userdata('emp_id'); ?>';
    var HTTP_PATH='<?php echo base_url(); ?>';
    $.ajax({
        type: "POST",
        url: HTTP_PATH + "establishment/getemployee_details_fill",
        data:'emp_id='+emp_id,
        beforeSend: function(){
            $("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            var r_data = JSON.parse(data);

            $("#app_mobile_number").val(r_data['emp_mobile_number']);
            $("#applicant_emp_id").val(r_data['emp_id']);
            $("#applicant_name").val(r_data['emp_full_name_hi']);
            $("#applicant_emp_code").val(r_data['emp_unique_id']);
            $("#applicant_designation").val(r_data['emprole_name_hi']);
            $("#applicant_category").val(r_data['emp_class']);
            $("#dpf_account_no").val(r_data['emp_gpf_dpf_code']);
            $("#emp_pay_cate_id").val(r_data['emp_pay_cate_id']);

            $("#previous_year_amnt").val(CurrencyFormat(r_data['pay_before_amount']));
            $("#current_year_amnt").val(CurrencyFormat(r_data['pay_last_amount']));


            $("#applied_amount_adv").val(CurrencyFormat(r_data['applied_amount_adv']));

            $("#employee_name_txt").val('('+r_data['emp_full_name_hi']+')');

            $("#employee_designation_txt").val(r_data['emprole_name_hi']);
            $("#gpfdpf_adv").val(CurrencyFormat(r_data['emp_gpf_dpf_adv']));

            var before_two_year_amt = 	r_data['pay_before_amount'];
            var gpf_dpf_adv 		 = 	r_data['emp_gpf_dpf_adv'];
            var total = parseInt(before_two_year_amt)-parseInt(gpf_dpf_adv);
            $("#gpfdpf_total_amt").val( CurrencyFormat( total));
            $("#suggesstion-box_emp_code").hide();
            $("#suggesstion-box").hide();


            $("#emp_class_id_hidden").val(r_data['emp_class_id']);
        }
    });

});
<?php } ?>

<?php if($this->uri->segment(2) == 'edit_service_forms' && !empty($appdetails)){ ?>
$(document).ready(function(){
    var pay_appid='<?php echo $appdetails['pay_id']; ?>';
    var emp_id='<?php echo $this->session->userdata('emp_id'); ?>';
    var HTTP_PATH='<?php echo base_url(); ?>';
    $.ajax({
        type: "POST",
        url: HTTP_PATH + "establishment/application_edit_fill",
        data: {emp_id: emp_id,pay_appid:pay_appid},
        beforeSend: function(){
            $("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            var r_data = JSON.parse(data);
            $("#applicant_emp_id").val(r_data['emp_id']);
            $("#applicant_name").val(r_data['emp_full_name_hi']);
            $("#applicant_emp_code").val(r_data['emp_unique_id']);
            $("#applicant_designation").val(r_data['emprole_name_hi']);
            $("#applicant_category").val(r_data['emp_class']);
            $("#dpf_account_no").val(r_data['emp_gpf_dpf_code']);
            $("#emp_pay_cate_id").val(r_data['emp_pay_cate_id']);

            $("#applied_amount_adv_words").val(r_data['applied_amount_adv_words']);

            $("#pay_persent").val(r_data['pay_percentage']);

            $("#previous_year_amnt").val(CurrencyFormat(r_data['pay_before_amount']));
            $("#current_year_amnt").val(CurrencyFormat(r_data['pay_last_amount']));


            $("#applied_amount_adv").val(CurrencyFormat(r_data['applied_amount_adv']));

            $("#employee_name_txt").val('('+r_data['emp_full_name_hi']+')');

            $("#employee_designation_txt").val(r_data['emprole_name_hi']);
            $("#gpfdpf_adv").val(CurrencyFormat(r_data['emp_gpf_dpf_adv']));

            var before_two_year_amt = 	r_data['pay_before_amount'];
            
            var gpf_dpf_adv 		 = 	r_data['emp_gpf_dpf_adv'];
            if(r_data['pay_percentage'] == '90' && r_data['pay_amnt_curr_financial'] != ''){
				var total = (parseInt(before_two_year_amt) + parseInt(r_data['pay_last_amount']) + parseInt(r_data['pay_amnt_curr_financial'])) -parseInt(gpf_dpf_adv);
				}else{
				var total = parseInt(before_two_year_amt)-parseInt(gpf_dpf_adv);
				}
            
            $("#gpfdpf_total_amt").val( CurrencyFormat( total));
            $("#suggesstion-box_emp_code").hide();
            $("#suggesstion-box").hide();
            if(r_data['pay_percentage'] == '90' && r_data['pay_amnt_curr_financial'] != ''){
			$("#curr_current_year_amt").val(r_data['pay_amnt_curr_financial']);			
			$('#curr_current_year_div').show();
			}           
            
        }
    });
});
<?php } ?>

function selectEmployee_name( emp_unicode_name  , emp_id )
{
	    var HTTP_PATH='<?php echo base_url(); ?>';
		$.ajax({
		type: "POST",
		url: HTTP_PATH + "establishment/getemployee_details_fill",
		data:'emp_id='+emp_id,
		beforeSend: function(){
			$("#scm_name_en").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			 var r_data = JSON.parse(data);
			
			$("#app_mobile_number").val(r_data['emp_mobile_number']);
			
			  $("#applicant_emp_id").val(r_data['emp_id']);
			  $("#applicant_name").val(r_data['emp_full_name_hi']);
			  $("#applicant_emp_code").val(r_data['emp_unique_id']);
			  $("#applicant_designation").val(r_data['emprole_name_hi']);
			  $("#applicant_category").val(r_data['emp_class']);
			  $("#dpf_account_no").val(r_data['emp_gpf_dpf_code']);
			  $("#emp_pay_cate_id").val(r_data['emp_pay_cate_id']);
			  $("#previous_year_amnt").val(CurrencyFormat(r_data['pay_before_amount']));
			  $("#current_year_amnt").val(CurrencyFormat(r_data['pay_last_amount']));
			
			  $("#employee_name_txt").val('('+r_data['emp_full_name_hi']+')');
			  $("#employee_designation_txt").val(r_data['emprole_name_hi']);
			  $("#gpfdpf_adv").val(CurrencyFormat(r_data['emp_gpf_dpf_adv']));

            $("#applied_amount_adv").val(CurrencyFormat(r_data['applied_amount_adv']));
				
			 var before_two_year_amt = 	r_data['pay_before_amount'];
			 var gpf_dpf_adv 		 = 	r_data['emp_gpf_dpf_adv'];
			 var total = parseInt(before_two_year_amt)-parseInt(gpf_dpf_adv);
			 $("#gpfdpf_total_amt").val( CurrencyFormat( total));
			 $("#suggesstion-box_emp_code").hide();
			 $("#suggesstion-box_search").hide();
			 $("#suggesstion-box").hide();
			 
			 $("#emp_class_id_hidden").val(r_data['emp_class_id']);
		}
	});

}

	$("#temp_less_last_gpf").change(function(){
		 $("#temp_less_last_gpf").val( CurrencyFormat(  $(this).val()));	
	});

function CurrencyFormat(number)
{
    if(number != 0 && number != '' ){
        var decimalplaces = 2;
        var decimalcharacter = ".";
        var thousandseparater = ",";
        number = parseFloat(number);
        var sign = number < 0 ? "-" : "";
        var formatted = new String(number.toFixed(decimalplaces));
        if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
        var integer = "";
        var fraction = "";
        var strnumber = new String(formatted);
        var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
        if( dotpos > -1 )
        {
            if( dotpos ) { integer = strnumber.substr(0,dotpos); }
            fraction = strnumber.substr(dotpos+1);
        }
        else { integer = strnumber; }
        if( integer ) { integer = String(Math.abs(integer)); }
        while( fraction.length < decimalplaces ) { fraction += "0"; }
        temparray = new Array();
        while( integer.length > 3 )
        {
            temparray.unshift(integer.substr(-3));
            integer = integer.substr(0,integer.length-3);
        }
        temparray.unshift(integer);
        integer = temparray.join(thousandseparater);
        return sign + integer + decimalcharacter + fraction;
    }else{
        return '' ;
    }

}


function test_skill(value,showword = 0) {
    var showword = showword ;
    var junkVal = value;
    junkVal=Math.floor(junkVal);
    var obStr=new String(junkVal);
    numReversed=obStr.split("");
    actnumber=numReversed.reverse();

    if(Number(junkVal) >=0){
    }
    else{
        alert('wrong Number cannot be converted');
        return false;
    }
    if(Number(junkVal)==0){
        document.getElementById('applied_amount_adv_words').value='';
        return false;
    }
    if(actnumber.length>9){
        alert('Oops!!!! the Number is too big to covertes');
        return false;
    }

    var iWords=["Zero", " One", " Two", " Three", " Four", " Five", " Six", " Seven", " Eight", " Nine"];
    var ePlace=['Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen'];
    var tensPlace=['dummy', ' Ten', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety' ];

    var iWordsLength=numReversed.length;
    var totalWords="";
    var inWords=new Array();
    var finalWord="";
    j=0;
    for(i=0; i<iWordsLength; i++){
        switch(i)
        {
            case 0:
                if(actnumber[i]==0 || actnumber[i+1]==1 ) {
                    inWords[j]='';
                }
                else {
                    inWords[j]=iWords[actnumber[i]];
                }
                inWords[j]=inWords[j]+' Only';
                break;
            case 1:
                tens_complication();
                break;
            case 2:
                if(actnumber[i]==0) {
                    inWords[j]='';
                }
                else if(actnumber[i-1]!=0 && actnumber[i-2]!=0) {
                    inWords[j]=iWords[actnumber[i]]+' Hundred and';
                }
                else {
                    inWords[j]=iWords[actnumber[i]]+' Hundred';
                }
                break;
            case 3:
                if(actnumber[i]==0 || actnumber[i+1]==1) {
                    inWords[j]='';
                }
                else {
                    inWords[j]=iWords[actnumber[i]];
                }
                if(actnumber[i+1] != 0 || actnumber[i] > 0){
                    inWords[j]=inWords[j]+" Thousand";
                }
                break;
            case 4:
                tens_complication();
                break;
            case 5:
                if(actnumber[i]==0 || actnumber[i+1]==1) {
                    inWords[j]='';
                }
                else {
                    inWords[j]=iWords[actnumber[i]];
                }
                if(actnumber[i+1] != 0 || actnumber[i] > 0){
                    inWords[j]=inWords[j]+" Lakh";
                }
                break;
            case 6:
                tens_complication();
                break;
            case 7:
                if(actnumber[i]==0 || actnumber[i+1]==1 ){
                    inWords[j]='';
                }
                else {
                    inWords[j]=iWords[actnumber[i]];
                }
                inWords[j]=inWords[j]+" Crore";
                break;
            case 8:
                tens_complication();
                break;
            default:
                break;
        }
        j++;
    }

    function tens_complication() {
        if(actnumber[i]==0) {
            inWords[j]='';
        }
        else if(actnumber[i]==1) {
            inWords[j]=ePlace[actnumber[i-1]];
        }
        else {
            inWords[j]=tensPlace[actnumber[i]];
        }
    }
    inWords.reverse();
    for(i=0; i<inWords.length; i++) {
        finalWord+=inWords[i];
    }
    if(showword != 0){
        document.getElementById('applied_amount_adv_words'+showword).value = finalWord;
    }else{
        document.getElementById('applied_amount_adv_words').value = finalWord;
    }

}

  function open_rules_pdf(pdf){
        var pdf = pdf;
        var app_masterid = pdf ;
        var HTTP_PATH='<?php echo base_url(); ?>';
        $.ajax({
            type: "POST",
            url: HTTP_PATH + "est_service_module/get_masers_rules",
            datatype: "json",
            async: false,
            data: {app_master: app_masterid},
            success: function(data) {
                var r_data = JSON.parse(data);
                var i = 1 ;
                var otpt1 = '';
                $.each(r_data, function( index, value ) {
                    otpt1 += '<a href="'+HTTP_PATH+''+value.attach_path+'" target="_blank" class="btn btn-primary margin">'+value.attach_name+'</a> ';
                    i++;
                });
                otpt1 += '';
                if(otpt1 == ''){
                    otpt1 = '<div class="text-center text-danger">कोई नियम संलग्न  नही |</div>';
                }
                $("#rules_pdf_div").html(otpt1);
            }
        });
    }

</script>