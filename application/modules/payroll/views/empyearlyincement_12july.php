    <style type="text/css" media="print">

        thead
        {
            display: table-header-group;
        }
		.noprint{
		display:none}
       
    </style>
    <style type="text/css" >

      
		h3{line-height: 28px;
		}
    .style2 {font-size: 16px; font-weight: bold; }
    </style><!-- Content Header (Page header) -->
<section class="content-header">
    <h1>

    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">   </li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
  
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <!-- small box -->
            <div class="box box-warning">
                <div class="box-header">
                  <!--  <h3>?? ???? ?????? ??????? ?? ??? ???? ???? ?????? ?? ?????? ????? ?? ?? ???? ????? ????? ???|</h3> -->
                </div>
           <div class="container">
  
<div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">       
                <div class="box-header">
                    <h3 class="box-title"></h3>
                    <div class="box-tools pull-right">
            <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
                     
            <!--
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>-->
                    </div>
                </div><!-- /.box-header -->
        <div class="box-body"></div>
              </div>

        <div id="divname">
                <table width="100%" border="0">
                  <tr>
                    <td colspan="12" align="center"><h1>&#2350;&#2343;&#2381;&#2351;&#2346;&#2381;&#2352;&#2342;&#2375;&#2358; &#2358;&#2366;&#2360;&#2344; &#2357;&#2367;&#2343;&#2367; &#2319;&#2357;&#2306; &#2357;&#2367;&#2343;&#2366;&#2351;&#2368; &#2325;&#2366;&#2352;&#2381;&#2351; &#2357;&#2367;&#2349;&#2366;&#2327;</h1></td>
                  </tr>
                  <tr style="border: none">
                    <td colspan="8" align="left" class="style2" ><div style="margin-left:25%">&#2325;&#2381;&#2352;&#2350;&#2366;&#2306;&#2325;  / 21-&#2309; (&#2360;&#2381;&#2341;&#2366;.)</div></td>
                    <td colspan="4" align="right" class="style2" ><div style="
					margin-right:25%">&#2349;&#2379;&#2346;&#2366;&#2354;<br />
						
                     &#2342;&#2367;&#2344;&#2366;&#2306;&#2325; <?php echo date("d-m-Y"); ?></div></td>
					
                  </tr>
                  <tr>
                    <td colspan="12" align="center" class="style2">&#2310;&#2342;&#2375;&#2358;</td>
                  </tr>
                  <tr>
                    <td colspan="12" align="center" style="width:80%"><div class="style2" style="
					margin:0% 10%">विभाग मे पदस्थ शासकीय सेवको को म. प्र. कोषालय संहिता भाग एक - स. नि. 264 के अनुसार   देय वार्षिक वेतन वृद्धि   माह जुलाई  <?php echo date("Y"); ?> से स्वीकृत की  जाती है | वेतन वृद्धि का लाभ उन्हें म. प्र. वेतन पुनरीक्षित नियम 2006 की कंडिका 9 के अनुसार जुलाई <?php echo date("Y"); ?> की 01 तारीख  से देय होगा |   </div></td>
                  </tr>
                  <tr>
                    <td colspan="12" align="center" class="style2"> लेखा शीर्ष <?php echo gethead($this->uri->segment(3))[0]->pay_cate_budget_no ?>-001 </td>
                  </tr>                  
                  <tr>
                    <td width="8%">&#2325;&#2381;&#2352;.</td>
                    <td width="9%">&#2309;&#2343;&#2367;&#2325;&#2366;&#2352;&#2368; / &#2325;&#2352;&#2381;&#2350;&#2330;&#2366;&#2352;&#2368; &#2344;&#2366;&#2350;</td>
                    <td width="4%">&#2346;&#2342;&#2344;&#2366;&#2350;</td>
                    <td width="5%">&#2351;&#2370;&#2344;&#2367;&#2325; &#2325;&#2379;&#2337;</td>
                    <td width="17%">&#2357;&#2375;&#2340;&#2344;<br>
                    (&#2357;&#2375;&#2340;&#2344; + &#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;)</td>
                    <td width="5%"><p>&#2357;&#2352;&#2381;&#2340;&#2350;&#2366;&#2344; </p>
                    <p>&#2357;&#2375;&#2340;&#2344;</p></td>
                    <td width="5%">&#2357;&#2375;&#2340;&#2344; &#2342;&#2367;&#2344;&#2366;&#2325;</td>
                    <td width="7%">(&#2357;&#2375;&#2340;&#2344; + &#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;)%3</td>
                    <td width="4%">दशांक राशि </td>
                    <td width="7%"><p>&#2357;&#2375;&#2340;&#2344; &#2357;&#2371;&#2342;&#2381;&#2343;&#2367; &#2313;&#2346;&#2352;&#2366;&#2344;&#2381;&#2340;</p>
                    <p>&#2357;&#2375;&#2340;&#2344;</p></td>
                    <td width="4%">&#2327;&#2381;&#2352;&#2375;&#2337; &#2346;&#2375;</td>
                    <td width="25%">रिमार्क </td>
                  
                  </tr>
                  <tr>
				  <?php $ik=0;  foreach ($pay_salary as $pay){ $ik=$ik+1;  ?>
                    <td><?php echo $ik; ?> <a href="<?php echo base_url(); ?>"></a> </td>
                    <td><?php echo get_employee_gender($pay->emp_id) ."  ".$pay->emp_full_name_hi;?></td>
                    <td><?php echo  get_employee_designation_id($pay->emp_id);?></td>
                    <td><?php echo  get_tr_unicode($pay->emp_unique_id);?></td>
                    <td><?php echo $pay->pay_basicmim."-".$pay->pay_basicmax."+".$pay->pay_grade  ?></td>
                    <td><?php echo $pay->pay_basic; ?></td>
                    <td>01-07-<?php echo date("Y"); ?></td>
                    <td><?php $pay1 = $pay->pay_basic + $pay->pay_grp; $payincr = $pay1 * 3;
					echo $payincr/100 ;
					$payaddval = floor($payincr/100);
					 $number = ceil($payaddval / 10) * 10;
					 
					 ?></td>
                    <td><?php echo $number;  ?></td>
                    <td><?php 
					
					
				// $nbasic = ($payaddval / 10) ;
				 //$nbasic1 = $nbasic *10;
			//d	echo "<br />";
					echo  $number +$pay->pay_basic  ;?></td>
                    <td><?php echo $pay->pay_grp; ?></td>
                    <td>		<?php echo $pay->pay_remarkinc; ?>
					
					 <br />
 <div class="eidt<?php echo $pay->emp_unique_id; ?>" style="display:none">
					                    <textarea name="countall" class="eidt" id="pay_remark<?php echo $pay->emp_unique_id; ?>"></textarea>	
										<input name="" type="button"  onclick="addremarksindb(<?php echo $pay->emp_unique_id; ?>)"  value=" जमा"/>
		 </div>		
									  <a href="#<?php echo $pay->pay_id; ?>"  class="hid noprint" onclick="addremarks(<?php echo $pay->emp_unique_id; ?>)">Add Remark</a></td>
    	             </tr>
                  
				  <?php }?>
				  <tr>
                    <td height="47" colspan="12" align="center" class="style2">उपरोक्त वेतन वृद्धि का लाभ मांग संख्या <?php echo gethead($this->uri->segment(3))[0]->pay_cate_budget_no ?>-001 के अंतगर्त  विकलनीय होगा |<br/>
(सचिव , विधि द्वारा अनुमोदित )</td>
                  </tr>
                  <tr>
                    <td colspan="9">पु. क्रमांक         /21 -अ(स्था .)
<br />
प्रतिलिपि :-<br />

१.  वरिष्ठ कोषालय अधिकारी,  विन्ध्याचल भवन भोपाल ,<br />

२.  आहरण  एंव संवितरण  अधिकारी <br />

की ओर सूचनार्थ एंव आवश्यक कायर्वाही हेतु प्रषित |<br /> </td>
                    <td colspan="3" align="center"><p><br />
                      <br/>   (राजेश सिंह)<br/>
                      वरिष्ठ लेखाधिकारी<br/>
                      म.प्र. शासन विधि और विधायी कार्य विभाग <br/>
                      
                    दिनांक:- <?php echo date("d-m-y"); ?></td>
                  </tr>
                </table>
              </div>
                    </div><!-- col 6 -->
        </div><!-- /.box-body -->
        
        </form>
        
      </div><!-- /.box -->
    </div><!-- col 12-->
    </div><!-- /.row -->
 
    </div>
</section><!-- /.content -->
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
	$.post("<?php echo base_url()?>payroll/addremarksindbincr/"+id,
		{"pay_remark":$remarks
		},
		function(a){location.reload();});
 } else {
        txt = "You pressed Cancel!";
    }
}
</script>
