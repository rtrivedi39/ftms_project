
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
                     <thead>
                    
                    
                     
                       <tr>
                         <td colspan="9" align="center">PERIODICAL INCREMENT CERTIFICATE</td>
                         <td colspan="3" align="left"><p style="text-align:center">M.P.T.C. 27</p>
                             <p style="text-align:center">See Subsidiary Rules 264&amp;269</p></td>
                       </tr>
                       <tr>
                         <td colspan="6"  style="padding:0px"><table  style="border:none" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                             <tr  style="border:none">
                               <td>Notes.1  When the    increment claimed is the firs to carry an officer over </td>
                             </tr>
                             <tr  style="border:none">
                               <td >efficiency bar    columns(5),(6)and (7) should be filled up in REDINK.</td>
                             </tr>
                             <tr  style="border:none">
                               <td >2.    The figure (1) or(2) should be placed against each name according as </td>
                             </tr>
                             <tr  style="border:none">
                               <td >the    reason (1)or(2) applies the explanatory memo.should be submitted in any case</td>
                             </tr>
                             <tr  style="border:none">
                               <td>in    which an increment is given otherwise tham for continuous services of the    prescribed period</td>
                             </tr>
                         </table></td>
                           <td colspan="6"  style="padding:0px"><table  style="border:none" width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
                             <td colspan="7">2.The    term &quot; Leave on average pay up to masimun fo 4 month&quot; whenever    occurring </td>
                           </tr>
                           <tr  style="border:none">
                             <td  colspan="7">in    this form includes Ëarned leave up to a maximum of 120 days &quot;so far as    Government</td>
                           </tr>
                           <tr  style="border:none" >
                             <td colspan="7" >servants governed    under the Revised Leave Rules 1934 are comcerned.</td>
                           </tr>
                         </table></td>
                       </tr>
                       <tr>
                         <td width="4%">S.no.</td>
                         <td width="12%">Name    of increment </td>
                         <td width="11%">Whether    substantive or officiating</td>
                         <td width="6%">&#2351;&#2370;&#2344;&#2367;&#2325; &#2325;&#2379;&#2337;</td>
                         <td width="14%">Scale of Pay of Post<br /></td>
                         <td width="8%"><p>Present Pay</p></td>
                         <td width="8%">Date from which present Pay is drawn</td>
                         <td width="7%"><p>Date of Present increment </p></td>
                        
                         <td width="5%"><p>Future Pay</p></td>
                         <td width="8%">Suspended for misconduc</td>
                         <td width="17%">Leave without pay and in the Case of those holdingthe posts in officiating capacity or holding temporary posts in a substantive capacity,all kinds of leave other than leave on average pay during which they would have continued to officiats in the posts but for their going on leave. up to maximun of 4 monts of such leave taken at a time .</td>
                       </tr>
                     </thead>
                     <tbody>
                     <tr>
                       <?php $ik=0;  foreach ($pay_salary as $pay){ $ik=$ik+1;  ?>
                       <td width="4%"><?php echo $ik; ?> <a href="<?php echo base_url(); ?>"></a> </td>
                       <td><?php echo get_employee_gender($pay->emp_id) ."  ".$pay->emp_full_name_hi;?></td>
                       <td>officiating</td>
                       <td><?php echo  get_tr_unicode($pay->emp_unique_id);?></td>
                       <td><?php echo $pay->pay_basicmim." - ".$pay->pay_basicmax." + ".$pay->pay_grade  ?></td>
                       <td><?php echo $pay->basic +  $pay->grp;
 ?></td>
                       <td>01-07-<?php echo date("Y") -1 ; ?></td>
                       <td>01-07-<?php echo date("Y"); ?></td>
                  
                       <td><?php 
					
					
				$pay1 = $pay->basic + $pay->grp; $payincr = $pay1 * 3;
					
					$payaddval = floor($payincr/100);
					 $number = ceil($payaddval / 10) * 10;


			if($pay->pay_incr_status == 1){ echo $pay->basic + $number + $pay->grp;
			?>
                           
                           <?php }else{?>
                         
                           <?php 
					echo  $pay->basic + $pay->grp ; }  ;?></td>
                       <td>&nbsp;</td>
                       <td width="17%"><?php echo $pay->pay_remarkinc; ?> <br />
                           <div class="eidt<?php echo $pay->emp_unique_id; ?>" style="display:none">
                             <textarea name="countall" class="eidt" id="pay_remark<?php echo $pay->emp_unique_id; ?>"></textarea>
                             वेतन वृद्धि  रोकना है
                             <input name="pay_incr_status" id="pay_incr_status<?php echo $pay->emp_unique_id; ?>" type="checkbox" <?php if($pay->pay_incr_status == 1){?>  checked="checked" value="1" <?php }else{?> <?php }?> />
                             <input name="Input" type="button"  onclick="addremarksindb(<?php echo $pay->emp_unique_id; ?>)"  value=" जमा"/>
                           </div>
                         <a href="#<?php echo $pay->pay_id; ?>"  class="hid no-print" onclick="addremarks(<?php echo $pay->emp_unique_id; ?>)"></a></td>
                     </tr>
               
                     <?php }?>
					       </tbody>
					 
					 <tr>
                       <td colspan="6"><p>Ccertified that  the Government servants named above are allowed the sanctioned periodical increment from the date cited in columan(6) for approved service.having been the incumbents of the posts specified for not less than………..years from the date in column(6) after deducting periods of suspension for misconduct and absence on leave without pay and in the case of those holding the pasts in officiating capacity or holding temporary in substantive capacity, all kinds of leave other than leave on average pay during which they would have continued to officiate in posts but    for their going on leave up to maximun four months of such leave taken at a time Further.</p>
                        <center>
 <p>Date:<?php echo date("d-m-Y")?></p>
</center></td>
                       <td colspan="5">certified that during the period/periods of leave.on average pay taken at a time from………..to………….and from…………..to…………..which has/have been counted for increment in the case of officiating Government servant/servants named above,he/they would have Officiated in. the post/posts but for his/their going on leave.                                  2.   CERTIFIED THAT the Government servants named above have allowed periodical increments from the date cited for reasons stated in th explanatory memorandum attached here to.</td>
                       </tr>
                   </table>
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
