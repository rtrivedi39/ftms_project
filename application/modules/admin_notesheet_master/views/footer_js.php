<?php
if($this->uri->segment(4) == 0)
{ ?>
<script type="text/javascript" src="<?php echo base_url()?>themes/ckeditor/ckeditor.js"></script>
<!-- 
	Attach the editor on the textareas
-->
<script type="text/javascript">
   

    
    CKEDITOR.replace('compose_textarea',
        {
    
            height : 600,
    
        }
    );

   
   
</script>
<?php } ?>
<?php if($this->uri->segment(3) != 'generate_notesheet' && $this->uri->segment(2)!='view_file_notesheet'){ ?>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="<?php echo EDITOR_URL ?>ckeditor.js"></script>
	<script src="<?php echo EDITOR_URL ?>theme/adapters/jquery.js"></script>
	<link href="<?php echo EDITOR_URL ?>sample/css/sample.css" rel="stylesheet">
	<style>
		#editable
		{
			padding: 10px;
			float: left;
		}
	</style>
	<script>
		CKEDITOR.disableAutoInline = true;
		$( document ).ready( function() {
			$( '#editor1' ).ckeditor(); 
			$( '#editable' ).ckeditor();
		} );
		function setValue() {
			$( '#editor1' ).val( $( 'input#val' ).val() );
		}
	</script>
	<?php } ?>
<script>
	
	
function addrow_budget(){
	var counter = 0;
		counter = $('#budget_again tr').length - 1;

		var newRow = $("<tr style='border:#666666 1px solid'>");
		var cols = "";
		cols += '<td style="border:#666666 1px solid"><textarea cols="10" rows="7" name="input0[]" id="input0' + counter + '"  class="input"  placeholder="" ></textarea></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input1[]" id="input1' + counter + '"  class="input"  placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input2[]" id="input2' + counter + '"  class="input"  placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input3[]" id="input3' + counter + '"   class="input" placeholder="" type="text" size="5"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input4[]" id="input4' + counter + '"   class="input"  placeholder="" type="text" size="5"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input5[]" id="input5' + counter + '"  class="input"  placeholder="" type="text" size="5" /></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input6[]" id="input6' + counter + '"  class="input" placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input7[]" id="input7' + counter + '"  olass="input" placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><textarea cols="10" rows="7"  name="input8[]" id="input8' + counter + '"  class="input" placeholder=""></textarea></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input9[]" id="input9' + counter + '"   class="input" placeholder="" type="text" size="5"/></td>';
		cols += '  <td style="border:#666666 1px solid"><input name="input10[]" id="input10' + counter + '"  class="input" placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input11[]" id="input11' + counter + '"  class="input" placeholder="" type="text" size="5"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input12[]" id="input12' + counter + '"  class="input" placeholder="" type="text" size="5"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input13[]" id="input13' + counter + '"  class="input" placeholder="" type="text" size="5"/></td>';
		
		
		cols += '<td style="border:#666666 1px solid"><input type="button" class="ibtnDel"  value="Delete"></td>';
		newRow.append(cols);
		if (counter == 350) $('#addrowoutof').attr('disabled', true).prop('value', "You've reached the limit");
		$("table.budget_again").append(newRow);
		counter++;
		$('.total_row').val(counter);


	 $("table.budget_again").on("click", ".ibtnDel", function (event) {
		 $(this).closest("tr").remove();

		 counter -= 1;
		 $('#addrowoutof').attr('disabled', false).prop('value', "Add Row");
		 $('.total_row').val(counter);
	 });
}

    function validateForm() {
        var a = document.forms["notesheetForm"]["num"].value;
        if (a === '') {
            alert("कृपया सभी फ़ील्ड्स को भरे|");
            return false;
        }
    }
    function formValidate() {
        var fields = ["name, phone", "compname", "mail", "compphone", "adres", "zip"];

        var i, l = fields.length;
        var fieldname;
        for (i = 0; i < l; i++) {
          fieldname = fields[i];
          if (document.forms["register"][fieldname].value === "") {
            alert(fieldname + " can not be empty");
            return false;
          }
        }
        return true;
    }
    function goBack() {
        window.history.back();
    }
    /* monika add function*/
	function totalout()
	{  var sum = 0;var sum1 = 0;var sum2 = 0;var sum3 = 0;var sum4 = 0;var sum5 = 0;var sum6 = 0;var sum7 = 0;var sum8 = 0;

		var sum9 = 0;var sum10 = 0;var sum11 = 0;var sum12 = 0;var sum13 = 0;var sum14 = 0;
		var tcount =$('.total_row').val();

		for($k=0; $k< tcount;$k++  )
		{
			sum1 += Math.round($("#input2"+$k).val());
			sum2 += Math.round($("#input3"+$k).val());
			sum3 += Math.round($("#input4"+$k).val());
			sum4 += Math.round($("#input5"+$k).val());
			sum5 += Math.round($("#input6"+$k).val());
			sum6 += Math.round($("#input7"+$k).val());
			sum7 += Math.round($("#input8"+$k).val());
			sum8 += Math.round($("#input9"+$k).val());
			sum9 += Math.round($("#input10"+$k).val());
			sum10 += Math.round($("#input11"+$k).val());
			sum11 += Math.round($("#input12"+$k).val());
			sum12 += Math.round($("#input13"+$k).val());
			sum13 += Math.round($("#input14"+$k).val());
			sum14 += Math.round($("#input15"+$k).val());
			$("#input2").val(sum1);
			$("#input3").val(sum2);
			$("#input4").val(sum3);
			$("#input5").val(sum4);
			$("#input6").val(sum5);
			$("#input7").val(sum6);
			$("#input8").val(sum7);
			$("#input9").val(sum8);
			$("#input10").val(sum9);
			$("#input11").val(sum10);
			$("#input12").val(sum11);
			$("#input13").val(sum12);
			$("#input14").val(sum13);
			$("#input15").val(sum14);



		}
	}
	function addrowoutof23() {

	var counter = 0;
		counter = $('#pitition_tblout tr').length - 4;

		var newRow = $("<tr style='border:#666666 1px solid'>");
		var cols = "";

		cols += '<td style="border:#666666 1px solid">&nbsp;</td>';
		cols += '<td style="border:#666666 1px solid"><input name="input2' + counter + '" id="input2' + counter + '" onblur="totalout()" class="input"  placeholder="Fees for drafting" type="number" /></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input3' + counter + '" id="input3' + counter + '" onblur="totalout()"  class="input" placeholder="Court Fee" type="number" /></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input4' + counter + '" id="input4' + counter + '"  onblur="totalout()" class="input"  placeholder="Paper Book" type="number" /></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input5" id="input5' + counter + '"  class="input" onblur="totalout()" placeholder="Paper Book" type="number" /></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input6' + counter + '" id="input6' + counter + '" onblur="totalout()" class="input" placeholder="Affidavit" type="number" /></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input7' + counter + '" id="input7' + counter + '"  onblur="totalout()" class="input" placeholder="Photo Copies" type="number"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input8' + counter + '" id="input8' + counter + '"  onblur="totalout()" class="input" placeholder="Computer Typing" type="number"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input9' + counter + '" id="input9' + counter + '" onblur="totalout()"  class="input" placeholder="Translation" type="number"/></td>';
		cols += '  <td style="border:#666666 1px solid"><input name="input10' + counter + '" id="input10' + counter + '" onblur="totalout()"  class="input" placeholder="Communication" type="number"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input11' + counter + '" id="input11' + counter + '" onblur="totalout()"  class="input" placeholder="STD/ Fax " type="number"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input12' + counter + '" id="input12' + counter + '" onblur="totalout()" class="input" placeholder="Misc. Expenss" type="number"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input13' + counter + '" id="input13' + counter + '" onblur="totalout()"  class="input" placeholder="TOTAL" type="number"/></td>';
		cols += '<td style="border:#666666 1px solid"><input name="input14' + counter + '" id="input14' + counter + '" onblur="totalout()" class="input"  placeholder="Not Pay" type="number"/></td>';
		cols += ' <td style="border:#666666 1px solid"><input name="input15' + counter + '" id="input15' + counter + '" onblur="totalout()" class="input"  placeholder="PAY AMOUNT" type="number"/></td>';



		cols += '<td style="border:#666666 1px solid"><input type="button" class="ibtnDel"  value="Delete"></td>';
		newRow.append(cols);
		if (counter == 350) $('#addrowoutof').attr('disabled', true).prop('value', "You've reached the limit");
		$("table.petitionoutof").append(newRow);
		counter++;
		$('.total_row').val(counter);


	 $("table.petitionoutof").on("click", ".ibtnDel", function (event) {
		 $(this).closest("tr").remove();

		 counter -= 1;
		 $('#addrowoutof').attr('disabled', false).prop('value', "Add Row");
		 $('.total_row').val(counter);
	 });


}
    function totalval()
	{var b = 0;var b1 = 0;
		   for (i = 1; i <=  3; i++) {
			$jj=  $("#amonut"+i).val();
			b = +$jj + +b;
		}
		$("#t1amount1").val(b);
		 for (i = 3; i <=  6; i++) {
			$jj1=  $("#amonut"+i).val();
			b1 = +$jj1 + +b1;
		}
		$("#tamount1").val(b1);
	}
    function totalval2()
	{var b = 0;var b1 = 0;

		   for (i = 1; i <=  3; i++) {
			 jk  =  $("#amonut"+i+"0").val();
			    l= parseInt(jk)/2;
				var a=  parseInt(l);
			   k= $("#amonut"+i).val(a);
			jj=  $("#amonut"+i+"2").val(a);
			b = parseInt(a) + parseInt(b);
		}

		$("#tamount1").val(b);
		$("#tamount2").val(b);
	 }
	 function totalval3()
	{

		var b = 0;var b1 = 0; var b2  = 0;var jk= 0;var k= 0;var jj= 0;
		var vcount  =  $("#count1").val();

		   for (i = 0; i <  vcount; i++) {
				jk= $("#amonut0-"+i).val();
			 k= $("#amonut1-"+i).val();
			 jj=$("#amonut2-"+i).val();

			b = +jk + +b;
			b1 = parseInt(k) + parseInt(b1);
			b2 = parseInt(jj) + parseInt(b2);
			console.log('monika'+b+"--"+b1+"--"+b2);

			$("#amount0").val(b);
		$("#amount1").val(b1);
		$("#tamount1").val(b1);
			$("#amount2").val(b2);
		}



	}

</script>
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="<?php echo base_url(); ?>themes/procetion.js"></script>
<link href="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
<script src="<?php echo ADMIN_THEME_PATH; ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () { 
		
        $('#inner_content table').css('width', '100%');
		$('#inner_content table td,#inner_content table th,#inner_content p,#inner_content table td p').removeAttr('style');
		$('#inner_content table td,#inner_content table th').css('border','1px solid');
		$('#inner_content table td p,#inner_content table th p').css('text-indent','0px');
		
	$( ".out_of_date" ).change(function() {
			
			if($(this).val() == 'विलम्ब' ){
				$( "#late_receive" ).addClass( "show" ).removeClass("hide");
			}else{
				$( "#late_receive" ).addClass("hide").removeClass( "show" );
			}
		});
       /* //Date DOB*/
        $('.date1').datepicker();
        $('#file_uo_date').datepicker();
		$('#date2').datepicker();
        $('#date3').datepicker();
        $('#date4').datepicker();
	
		/*$('.advocate_type').on('change', function() {
			$(".court_type").children('option').hide();
			$(".court_location").children('option').hide();
			if(this.val() === 'महाधिवक्ता'){
				$(".court_type").append('<option value="मध्यप्रदेश उच्च न्यायालय">मध्यप्रदेश उच्च न्यायालय</option>');
				$(".court_location").append('<option value="जबलपुर">जबलपुर</option>');
			}else {
				$(".court_type").children('option').show();
				$(".court_location").children('option').show();
				$(".court_type").children('<option value="मध्यप्रदेश उच्च न्यायालय">मध्यप्रदेश उच्च न्यायालय</option>').hide();
				$(".court_location").children('<option value="जबलपुर">जबलपुर</option>').hide();
			}

		});  */
		
	/*	petition auto select all 10*/
		$(document).ready(function () {
			$(".writ_lists").change(function() {
				var writ = $(".writ_lists").val();
				$(".writ_lists").val(writ);
				
			});		
		});	
		$(document).ready(function () {	

			var slp_div = $(".slp_div").text();
			$("#show_hide").hide();
			$("#show_hide").click(function() {
				
				$("#show_content").text('');
				

				 $(".slp_div").text('');
				 $(".slp_div_text_input").html('<input type="hidden" name="slp_ddiv" value="hide_text" > ' );
				 $(".slp_div").hide();
				$("#show_hide").hide();
				$("#hide_show").show();
			});	
			$("#hide_show").click(function() {
				
				$("#show_content").html("<u>एस. एल. पी. का प्रस्ताव इस कार्यालय को दिनांक   <input type='text' name='date_2'  class='date1'>  को प्राप्त हुआ था |  एस. एल. पी.  की अवधि दिनांक <input type='text' name='date_3'  class='date1'>को समाप्त हो गई हैं | इसलिये विलम्ब  को स्पष्ट करने का उत्तरदायित्व त्रुटिकर्ता का रहेगा | त्रुटिकर्ता धारा 5 लिमिटेशन एक्ट का शपथ-पत्र में दिन-प्रतिदिन के विलंब को स्पष्ट करते हए माननीय सर्वोच्च न्यायालय में  आवेदन पत्र प्रस्तुत करेगा, विलंव का दायित्व विधि विभाग का नहीं रहेगा| </u>");

			    $(".slp_div_text_input").html('<input type="hidden" name="slp_ddiv" value="show_text" > ' );
				$("#show_content").text();
				/*$("#hide_btn").show();*/
				$("#show_hide").show();
				$("#hide_show").hide();
			});	
		});	
		/*//civil auto select all 98*/
		$(document).ready(function () {
			$(".title_loc").change(function() {
				var writ = $(".title_loc").val();
				$(".title_loc").val(writ);
			
			});		
		});	
		
		/*//b-2 auto select all 141*/
		$(document).ready(function () {
			$(".distic_1").blur(function() {
				var dist = $(".distic_1").val();
				$(".distic_1").val(dist);
				
			});		
		});	
		
		/*//b-2 on key up*/
		$(document).ready(function () {
			$(".notriname").blur(function() {
				var notriname = $(".notriname").val();
				$(".notriname").val(notriname);
				
			});		
		});
		
		
		$(document).ready(function () {
			$(".tahsil").blur(function() {
				var tahsil = $(".tahsil").val();
				$(".tahsil").val(tahsil);
				
			});		
		});
		
		/* hide on testing date
		
		$(document).ready(function () {
			$(".notri_todate").blur(function() {
				var notri_todate = $(".notri_todate").val();
				$(".notri_todate").val(notri_todate);
				
			})		
		});		
		
		//b-2 on key up
		$(document).ready(function () {
			$(".notri_fromdate").blur(function() {
				var notri_fromdate = $(".notri_fromdate").val();
				$(".notri_fromdate").val(notri_fromdate);
				
			})		
		});	
		*/
		
		/*b-1 on key up*/
		$(document).ready(function () {
			$(".ad_name").blur(function() {
				var ad_name = $(".ad_name").val();
				$(".ad_name").val(ad_name);
				
			});		
		});	
		
		/*b-1 on key up*/
		$(document).ready(function () {
			$(".ad_designation").blur(function() {
				var ad_designation = $(".ad_designation").val();
				$(".ad_designation").val(ad_designation);
				
			});		
		});	
		
		 
		/*add apend table*/ 
		$(document).ready(function () {
			var counter = 0;

			$("#addrow").on("click", function () {
				
				counter = $('#pitition_tbl tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" class="date1" name="anukrmank[]' + counter + '"><br/><input type="text" class="date1" name="anukrmank_date[]' + counter + '"></td>';
				cols += '<td><textarea name="name_pk[]' + counter + '" rows="5"  cols="20"></textarea></td>';
				cols += '<td><input type="text" name="want_price[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="order_price[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="total_price[]' + counter + '"></td>';
				
				
				cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.petition").append(newRow);
				counter++;
				$('.total_row').val(counter);
			});

			$("table.petition").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addrow').attr('disabled', false).prop('value', "Add Row");
				$('.total_row').val(counter);
			});

			
		});
		
		/* one coulmn pratilipt*/
		$(document).ready(function () {
			var counter = 0;

			$("#addpratilpi").on("click", function () {
				
				counter = $('#tbl_one_column tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
			    cols += '<td valign="top" width="*%"><input type="text" size="100" name="column_one[]' + counter + '"></td>'; 			
				
				cols += '<td width="5%" align="left"><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addpratilpi').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.one_column").append(newRow);
				counter++;
				$('.total_row').val(counter);
			});

			$("table.one_column").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addpratilpi').attr('disabled', false).prop('value', "प्रतिलिपि जोड़े");
				$('.total_row').val(counter);
			});

			
		});	
		
		/* tow coulmn pratilipt*/
		$(document).ready(function () {
			var counter = 0;

			$("#addpratilipi").on("click", function () {
				
				counter = $('#tbl_two_column tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td valign="top" width="10%"><input type="text" name="column_one[]' + counter + '"></td>';
			    cols += '<td valign="top" width="*%"><input type="text" size="100" name="column_two[]' + counter + '"></td>'; 			
				
				cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addpratilipi').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.two_column").append(newRow);
				counter++;
				$('.total_row').val(counter);
			});

			$("table.two_column").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addpratilipi').attr('disabled', false).prop('value', "Add Row");
				$('.total_row').val(counter);
			});

			
		});

		/* four coulmn*/
		$(document).ready(function () {
			var counter = 0;

			$("#addrow").on("click", function () {
				
				counter = $('#tbl_four_column tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" name="column_one[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_two[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_three[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_four[]' + counter + '"></td>';
				
				
				cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.four_column").append(newRow);
				counter++;
				$('.total_row').val(counter);
			});

			$("table.four_column").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addrow').attr('disabled', false).prop('value', "Add Row");
				$('.total_row').val(counter);
			});

			
		});
		
	/*	 four coulmn2*/
		$(document).ready(function () {
			var counter = 0;

			$("#addrow1").on("click", function () {
				
				counter = $('#tbl_four_column1 tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" name="column_one1[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_two1[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_three1[]' + counter + '"></td>';
				cols += '<td><input type="text" name="column_four1[]' + counter + '"></td>';
				
				cols += '<td><input type="button" class="ibtnDel1"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addrow1').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.four_column1").append(newRow);
				counter++;
				$('.total_row1').val(counter);
			});

			$("table.four_column1").on("click", ".ibtnDel1", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addrow1').attr('disabled', false).prop('value', "Add Row");
				$('.total_row1').val(counter);
			});

			
		});

		/* three coulmn*/
		$(document).ready(function () {
			var counter = 0;

			$("#addrow").on("click", function () {
				
				counter = $('#tbl_three_column tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" name="column_one[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_two[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_three[]' + counter + '"></td>';
				
				
				cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.three_column").append(newRow);
				counter++;
				$('.total_row').val(counter);
			});

			$("table.three_column").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addrow').attr('disabled', false).prop('value', "Add Row");
				$('.total_row').val(counter);
			});

			
		});
		
		/* three coulmn2*/
		$(document).ready(function () {
			var counter = 0;

			$("#addrow1").on("click", function () {
				
				counter = $('#tbl_three_column1 tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" name="column_one1[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_two1[]' + counter + '"></td>';
			    cols += '<td><input type="text" name="column_three1[]' + counter + '"></td>';
				
				cols += '<td><input type="button" class="ibtnDel1"  value="Delete"></td>';
				newRow.append(cols);
				if (counter == 350) $('#addrow1').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.three_column1").append(newRow);
				counter++;
				$('.total_row1').val(counter);
			});

			$("table.three_column1").on("click", ".ibtnDel1", function (event) {
				$(this).closest("tr").remove();
				
				counter -= 1;
				$('#addrow1').attr('disabled', false).prop('value', "Add Row");
				$('.total_row1').val(counter);
			});

			
		});
/******** crimanal notesheet ***/
			
			var counter_cri = 0;
			var su = 2;
			$("#addrow").on("click", function () {
				
				counter_cri = $('#fee_notesheet tr').length - 2;

				var newRow = $("<tr>");
				var cols = "";
	  
				cols += '<td><input type="text" value="'+su+'"  name="sr_no[]' + counter_cri + '"></td></td>';
				cols += '<td><input type="text" class="date1"  name="date[]' + counter_cri + '" value=""></td>';
				cols += ' <td><input type="text" name="prakran_no[]' + counter_cri + '"></td>';
				cols += ' <td><input type="text" name="price[]' + counter_cri + '"></td>';
			    cols += '<td><input type="text" name="order_price[]' + counter_cri + '"></td>';
				
				
				
				cols += '<td><input type="button" class="ibtnDel"  value="Delete"></td>';
				newRow.append(cols);
				if (counter_cri == 50) $('#addrow').attr('disabled', true).prop('value', "You've reached the limit");
				$("table.fee_notesheet").append(newRow);
				counter_cri++;
				su++;
				$('.total_row').val(counter_cri);
			});
	
			$("table.fee_notesheet").on("click", ".ibtnDel", function (event) {
				$(this).closest("tr").remove();
				
				counter_cri -= 1;
				$('#addrow').attr('disabled', false).prop('value', "Add Row");
				$('.total_row').val(counter_cri);
			});
});
	$("#nemee_teep_option").change(function() {
		var teep_option = $(this).val();
		
		if(teep_option == 'अनुभाग'){
			$(".section_names_c").show();
			$(".sectary_div").hide();
		}
		else if(teep_option == 'मंत्री'){
			$(".section_names_c,.mantraly_div").hide();
			$(".sectary_div,.address_div,.department_div,.res_minister_div").show();
			$("#respect").val("माननीय");
			$("#ministry").val();
			$("#address").val();
			$('.section_name_c').attr('checked', false);
			
		}
		else if(teep_option == 'मंत्रालय'){
			$(".section_names_c,.mantraly_div,.address_div,.res_minister_div").hide();
			$(".sectary_div,.department_div,.sectary_div,.mantraly_div").show();
			$("#ministry").val("मंत्रालय");
			$("#respect").val();
			$('.section_name_c').attr('checked', false);
			
		}else{
			$(".mantraly_div,.address_div,.sectary_div,.department_div,.section_names_c,#res_minister_div").hide();
		}
   });
	$("#which_jail_1").change(function() {
		$('.which_jail_id').val($(this).val());
   });
   $("#bandi").change(function() {
		$('.bandi').val($(this).val());
   });
    $("#mukti").change(function() {
		$('.mukti').val($(this).val());
   });
    $("#ddl_ngtstate").change(function() {
		$('.ddl_ngtstate').val($(this).val());
   });
    $("#advocate_name_txt").change(function() {
		$('.advocate_name_txt').val($(this).val());
   });
   	$("#emp_name").change(function() {
		$('.emp_name').val($(this).val());
   });
	$(".amount_spend").blur(function() {
		$('.amount_spend').text($(this).val());
		$('.amount_spend').val($(this).val());
   });
   	$("#anukampa").blur(function() {
		alert($(this).val());
		$('.anukampa_emp_name').text($(this).val());
   });
     $("#p_name").change(function() {
		$('.p_name').val($(this).val());
   });
   $("#father_name").change(function() {
		$('.father_name').val($(this).val());
   });
    $("#district").change(function() {
		$('.district').val($(this).val());
   });
   $("#kist_month").blur(function(){
    var temp_gpf_amt = $('#temp_gpf_amt').val();
    var kist_month = $('#kist_month').val();
    if (parseFloat(this.value) && parseFloat(kist_month) && this.value.length != 0) {
        var minus =  parseFloat(temp_gpf_amt) / parseFloat(kist_month) ;
        $('#every_month_amount').val(minus);
    }else{
        $('#every_month_amount').val('');
    }
});
   </script>