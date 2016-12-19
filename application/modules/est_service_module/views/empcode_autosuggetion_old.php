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


    $("#gpfdpf_adv").keyup(function(){
        var previous_year_amnt = $('#previous_year_amnt').val();
        var gpfdpf_adv = $(this).val();
        if (parseFloat(this.value) && parseFloat(previous_year_amnt) && this.value.length != 0) {
        var minus =  parseFloat(previous_year_amnt) - parseFloat(gpfdpf_adv) ;
        $('#gpfdpf_total_amt').val(minus);
        }else{
            $('#gpfdpf_total_amt').val('');
        }
    });
});



<?php if($this->uri->segment(2) == 'user_service_forms'){ ?>

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
            var total = parseInt(before_two_year_amt)-parseInt(gpf_dpf_adv);
            $("#gpfdpf_total_amt").val( CurrencyFormat( total));
            $("#suggesstion-box_emp_code").hide();
            $("#suggesstion-box").hide();
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
</script>