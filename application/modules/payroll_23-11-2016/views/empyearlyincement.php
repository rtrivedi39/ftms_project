
<style type="text/css" media="print">

    @media print {
        thead {display: table-header-group;}
    }
       @media print and (color)
   * {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
   }
}

  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }


}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1> </h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active"> </li>
</ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Your Page Content Here -->
  <!-- Small boxes (Stat box) -->
  <div class="row">
     <div class="col-md-12">
	 	<div class="box box-primary">
     	 <!-- small box -->
      		<div class="box-body no-padding">
        
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
             
                <div class="box-header">
                  <h3 class="box-title"></h3>
                  <div class="box-tools pull-right">
                    <button onclick="printContents('forPrint')" class="btn btn-primary btn-sm no-print">Print</button>
                   </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
             	 <div id="salincreament">
				 <div class="mailbox-read-message no-padding" id="forPrint">						   
				
				<table width="100%" border="1" >
                <tr>
                    <td colspan="2" align="center" style="text-align:center"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
                  </tr>
                  <tr style="border: none">
                    <td style="text-align:center" > क्रमांक / 21-अ (स्था.) </td>
                    <td style="text-align:center" >भोपाल दिनांक <?php echo date("d-m-Y"); ?></td>
                  </tr>
                  <tr>
                    <td colspan="2" style="text-align:center" >आदेश </td>
                  </tr>
                 
                </table>
				
						<table width="100%" >
                  <thead>
				   <tr>
                    <td colspan="12"  ><div class="style2" style="
					margin:0% 10%">विभाग मे पदस्थ शासकीय सेवको को म. प्र. कोषालय संहिता भाग एक - स. नि. 264 के अनुसार   देय वार्षिक वेतन वृद्धि   माह जुलाई <?php echo date("Y"); ?> से स्वीकृत की  जाती है | वेतन वृद्धि का लाभ उन्हें म. प्र. वेतन पुनरीक्षित नियम 2006 की कंडिका 9 के अनुसार जुलाई <?php echo date("Y"); ?> की 01 तारीख  से देय होगा | </div></td>
                  </tr>
                  <tr>
                    <td colspan="12" align="center" > लेखा शीर्ष <?php echo gethead($this->uri->segment(3))[0]->pay_cate_budget_no ?>-001 </td>
                  </tr>
                    <tr>
                      <td width="10%">&#2325;&#2381;&#2352;.</td>
                      <td width="7%">&#2309;&#2343;&#2367;&#2325;&#2366;&#2352;&#2368; / &#2325;&#2352;&#2381;&#2350;&#2330;&#2366;&#2352;&#2368; &#2344;&#2366;&#2350;</td>
                      <td width="4%">&#2346;&#2342;&#2344;&#2366;&#2350;</td>
                      <td width="5%">&#2351;&#2370;&#2344;&#2367;&#2325; &#2325;&#2379;&#2337;</td>
                      <td width="17%">वेतनमान<br></td>
                      <td width="5%"><p>&#2357;&#2352;&#2381;&#2340;&#2350;&#2366;&#2344; </p>
                        <p>&#2357;&#2375;&#2340;&#2344; + ग्रेड पे</p></td>
                      <td width="5%"><p>&#2357;&#2375;&#2340;&#2344; &#2357;&#2371;&#2342;&#2381;&#2343;&#2367; दिंनाक </p>
                        </td>
                      <td width="7%">(&#2357;&#2375;&#2340;&#2344; + &#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;)3%
                        <p>&#2357;&#2375;&#2340;&#2344; &#2357;&#2371;&#2342;&#2381;&#2343;&#2367;</p>
                        </td>
                      <td width="4%">दशांक राशि </td>
                      <td width="7%"><p>&#2357;&#2375;&#2340;&#2344; &#2357;&#2371;&#2342;&#2381;&#2343;&#2367; &#2313;&#2346;&#2352;&#2366;&#2344;&#2381;&#2340;</p>
                        <p>&#2357;&#2375;&#2340;&#2344;</p></td>
                      <td width="5%">&#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;</td>
                      <td width="14%">रिमार्क  </td>
                    </tr>
                  </thead>
                  <tr>
                    <?php $ik=0;  foreach ($pay_salary as $pay){ $ik=$ik+1;  ?>
                    <td width="10%"><?php echo $ik; ?> <a href="<?php echo base_url(); ?>"></a> </td>
                    <td><?php echo get_employee_gender($pay->emp_id) ."  ".$pay->emp_full_name_hi;?></td>
                    <td><?php echo  get_employee_designation_id($pay->emp_id);?></td>
                    <td><?php echo  get_tr_unicode($pay->emp_unique_id);?></td>
                    <td><?php echo $pay->pay_basicmim." - ".$pay->pay_basicmax." + ".$pay->pay_grade  ?></td>
                    <td><?php echo $pay->basic." + ".$pay->grp; ?></td>
                    <td>01-07-<?php echo date("Y"); ?></td>
                     <td><?php $pay1 = $pay->basic + $pay->grp; $payincr = $pay1 * 3;
					echo $payincr/100 ;
					$payaddval = floor($payincr/100);
					 $number = ceil($payaddval / 10) * 10;
					 
					 ?></td>
                    <td><?php echo $number;  ?></td>
                    <td><?php 
					
					
				// $nbasic = ($payaddval / 10) ;
				 //$nbasic1 = $nbasic *10;
			//d	echo "<br />";


				if($pay->pay_incr_status == 1){ echo $pay->basic + $number ;
			?>
			<input name="pay_basic<?php echo $pay->emp_unique_id; ?>" id="pay_basic<?php echo $pay->emp_unique_id; ?>" type="hidden" value="<?php echo $pay->basic + $number ;?>" /> <?php }else{?>
			<input name="pay_basic<?php echo $pay->emp_unique_id; ?>" id="pay_basic<?php echo $pay->emp_unique_id; ?>" type="hidden" value="<?php echo $pay->basic  ;?>" /> 
			<?php 
					echo  $pay->basic  ; }  ;?></td>
                    <td><?php echo $pay->grp; ?></td>
                      <td width="14%"><?php echo $pay->pay_remarkinc; ?> <br />
                      <div class="eidt<?php echo $pay->emp_unique_id; ?>" style="display:none">
                        <textarea name="countall" class="eidt" id="pay_remark<?php echo $pay->emp_unique_id; ?>"><?php echo $pay->pay_remarkinc; ?> </textarea>
						वेतन वृद्धि  रोकना है
						<input name="pay_incr_status" id="pay_incr_status<?php echo $pay->emp_unique_id; ?>" type="checkbox" <?php if($pay->pay_incr_status == 1){?>  checked="checked" value="1" <?php }else{?>  value="0" <?php }?> />
                        <input name="" type="button"  onclick="addremarksindb(<?php echo $pay->emp_unique_id; ?>)"  value=" जमा"/>
                      </div>
                      <a href="#<?php echo $pay->pay_id; ?>"  class="hid no-print" onclick="addremarks(<?php echo $pay->emp_unique_id; ?>)">Add Remark</a></td>
                  </tr>
                  <?php }?>
                 <tr>
                    <td height="47" colspan="12" align="center" class="style2">उपरोक्त वेतन वृद्धि का लाभ मांग संख्या <?php echo gethead($this->uri->segment(3))[0]->pay_cate_budget_no ?>-001 के अंतर्गत  विकलनीय होगा |<br/>
                      ( प्रमुख सचिव , विधि द्वारा अनुमोदित )</td>
                  </tr>
                  <tr>
                    <td colspan="9">पु. क्रमांक         /21 -अ(स्था .) <br />
                      प्रतिलिपि :-<br />
                      १.  वरिष्ठ कोषालय अधिकारी,  विन्ध्याचल भवन भोपाल ,<br />
                      २.  आहरण  एंव संवितरण  अधिकारी <br />
                      की ओर सूचनार्थ एंव आवश्यक कार्यवाही हेतु प्रेषित |<br />
                    </td>
                    <td colspan="3" align="center"><p><br />
                        <br/>
                        (राजेश सिंह)<br/>
                        वरिष्ठ लेखाधिकारी<br/>
                        म.प्र. शासन विधि और विधायी कार्य विभाग <br/>
                        दिनांक:- <?php echo date("d-m-y"); ?></td>
                  </tr>
                </table>
					
              					<?php if($pay_salary[0]->pay_incr_year != date("Y") ){?>
					<a href="<?php echo base_url()?>payroll/salaryincr"     class="btn btn-primary btn-sm no-print"   >add Salary in paybill </a>                        <?php }else{?>
					<a href="#"     class="btn btn-danger " onclick="alert('वेतन बिल मे वेतन वृद्धि जोड़ चुके ही है')"   >All Ready add Salary in paybill </a> 
					
					<?php }?></div>

              </div>
			  </div>
             
            </div>
            <!-- col 6 -->
          </div>
          <!-- /.box-body -->
        
        </div>
        <!-- /.box -->
      </div>
      <!-- col 12-->
    </div>
    		<!-- /.row -->
	  	</div>
  </div>
  </div>
</section>
<!-- /.content -->
<script>
function addremarks(id)
{

$(".eidt"+id).show();
$(".hid").hide();
}

function addremarksindb(id)
{
  var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
	$remarks= $("#pay_remark"+id).val();
	$pay_basic = $("#pay_basic"+id).val();
	
	if ($("#pay_incr_status"+id).is(":checked"))
{
  // it is checked
  	$pay_incr_status= 1;
}else{
  	$pay_incr_status= 0;
}

	$.post("<?php echo base_url()?>payroll/addremarksindbincr/"+id,
		{"pay_remark":$remarks,
		"pay_basic":$pay_basic,
		"pay_incr_status":$pay_incr_status
		},
		function(a){location.reload();});
 } else {
        txt = "You pressed Cancel!";
    }
}
</script>
