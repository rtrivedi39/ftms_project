  <style>

table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}
table, th, td {
    border: 1px solid #E2DFDF;
    /* padding: 6px 5px 7px 7px; */
}
#table-wrapper {
  position:relative;
}
#table-scroll {
/*  height:150px;*/
  overflow:auto;  
  margin-top:20px;
}
#table-wrapper table {
  width:100%;

}
#table-wrapper table * {
 /* background:yellow;*/
  color:black;
}
#table-wrapper table thead th .text {
  position:absolute;   
  top:-20px;
  z-index:2;
  height:20px;
  width:35%;
  border:1px solid red;
}
</style><?php 

 $curr_financial_year = get_financial_year();
 	$pdfAbspath = "uploads/pdf";
	$content1 = "मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग";
$emp = get_employee_details($this->session->userdata('emp_id')); 
		  //   $pay_year = $curr_financial_year;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo $title; ?></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
        <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
               
                   
                    <div class="box-body ">
					
				  <button onclick="printContents('table-scroll')" class="btn btn-primary btn-sm no-print">Print</button>
					    <div class="box-tools pull-right">
           <a href="<?php echo base_url().$pdfAbspath."/payregister".$emp[0]->emp_unique_id.".pdf" ?>" >
                            <button type="button" class="btn  btn-warning" ><?php echo "Download"; ?></button></a>
                    
            <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
						</div>
                    <div id="table-wrapper">
  <?php $content=""; $content.=' <div id="table-scroll"><table  cellpadding="0"  style="overflow:scroll;width:100px" cellspacing="0"  border="0">
<th colspan="28" style="text-align: center">मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</th>'; ?>
 <?php  $in = 0;  foreach ($pay_regi as $key => $pay) { $in = $in +1 ; if($in == 1){
  ?>

  <?php       
   $content.='<tr>
      <th colspan="28" ><table cellpadding="0" cellspacing="0"  border="0" width="100%" border="1">
          <tr>
            <td >Name :</td>
            <td>'. get_employee_gender($pay->emp_id).' '.$pay->emp_full_name_hi.' ('. get_employee_designation_id($pay->emp_id).')</td>
            <td >Unique ID</td>
            <td >'.get_tr_unicode($pay->emp_unique_id).'</td>
            <td >Year </td>
            <td >'.$curr_financial_year.'</td>
          </tr>
            </table></th>
    </tr>';
 }}if(count($pay_regi) != 0 ){
	 
	 $content.='<tr > <th > एरीयर्स / वेतन</th> <th >'.$this->lang->line('emp_pay_month').'</th>';?>
                           <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                      <?php          
   $content.='<th > '.$this->lang->line('basic_pay') .'</th>';
                                  }if($dataval[0]['pay_cate_grp'] == 1){ 
                                    $content.=' <th >'.$this->lang->line('pay_gradepay').'</th>';
                              }if($dataval[0]['pay_cate_special'] == 1){
                                  $content.='<th > '.$this->lang->line('pay_special').'</th>';
                                   }if($dataval[0]['pay_cate_da'] == 1){ 
                                     $content.='<th > '.$this->lang->line('pay_da').'</th>';
                                 }if($dataval[0]['pay_cate_hra'] == 1){ 
                                    $content.='<th > '. $this->lang->line('pay_hra').'</th>';


                                    }if($dataval[0]['pay_cate_other_add'] == 1){ 
                                  $content.='<th > '. $this->lang->line('pay_others').'</th>';
                                             }if($dataval[0]['pay_cate_sa'] == 1){ 
                                     $content.='<th > '. $this->lang->line('pay_sa').'</th>';
                                     }if($dataval[0]['pay_cate_madical'] == 1){  
                                   $content.='<th > '.  $this->lang->line('pay_ma').'</th>';

                                     }if($dataval[0]['pay_cate_sp'] == 1){ 
                                      $content.='<th > '.  $this->lang->line('pay_sp').'</th>';

                                          }if($dataval[0]['pay_cate_ca'] == 1){  
                                     $content.='<th > '.  $this->lang->line('pay_ca').'</th>';
                                  
                                    } 
                           $content.='<th > '.  $this->lang->line('pay_sum').'</th>';
                              if($dataval[0]['pay_cate_gpf'] == 1){
                                     $content.='<th > '.    $this->lang->line('pay_gpf').'</th>';
                                     }if($dataval[0]['pay_cate_gpf_adv'] == 1){ 
                                    $content.='<th > '. $this->lang->line('pay_gpf_adv').'</th>';
                                   }if($dataval[0]['pay_cate_dpf'] == 1){ 
                                     $content.='<th > '.    $this->lang->line('pay_dpf').'</th>';

                                    }if($dataval[0]['pay_cate_dpf_adv'] == 1){  
                                    $content.='<th > '.  $this->lang->line('pay_dpf_adv').'</th>';
                                     }if($dataval[0]['pay_cate_gias'] == 1){  
                                     $content.='<th > '.  $this->lang->line('pay_gis').'</th>';
                                     }if($dataval[0]['pay_cate_defined_contribution'] == 1){  
                                   $content.='<th > '. $this->lang->line('pay_define').'</th>';
                                  }if($dataval[0]['pay_cate_house_loan'] == 1){ 
                             $content.='<th > '. $this->lang->line('pay_home_loan').'</th>';

                             }if($dataval[0]['pay_cate_car_loan'] == 1){ 
							$content.='<th > '.  $this->lang->line('pay_car_loan').'</th>';
							}if($dataval[0]['pay_cate_house_rent'] == 1){ 
                                $content.='<th > '. $this->lang->line('pay_house_rent').'</th>';

                              }if($dataval[0]['pay_cate_garain_adv'] == 1){  
                                
                                      $content.='<th > '.  $this->lang->line('pay_grain_adv').'</th>';
                                
                                
                                     }if($dataval[0]['pay_cate_fuel_charge'] == 1){ 

                                    $content.='<th > '.  $this->lang->line('pay_fule_charge').'</th>';

                                        }if($dataval[0]['pay_cate_festival_adv'] == 1){ 

                             $content.='<th > '.  $this->lang->line('pay_festival_adv').'</th>';


                                    }if($dataval[0]['pay_cate_professional_tax'] == 1){  

                                     $content.='<th > '. $this->lang->line('pay_professional_tax').'</th>';

                                     }if($dataval[0]['pay_cate_income_tax'] == 1){  

                                $content.='<th > '.  $this->lang->line('pay_income_tax').'</th>';

                            
                                  }if($dataval[0]['pay_cate_other_adv'] == 1){  

                                    $content.='<th > '. $this->lang->line('pay_other_adv').'</th>';

                                     } 
                                   $content.='<th > '.  $this->lang->line('pay_total_cut').'</th>';
                                    $content.='<th > '.  $this->lang->line('pay_amount').'</th>    </tr>
                            
                            <tbody>';
?>
									
                            
                            <?php   $k = 0;$months = ""; $pay_sa ="";$pay_madical=""; $pay_car_loan="";
                 $pay_total =""; $pay_total_cut =""; $pay_grp="";$pay_grp= "";$pay_festival_adv="";$pay_professional_tax="";$pay_income_tax="";
				 $pay_other_adv="";$pay_fuel_charge="";$pay_grain_adv="";$pay_house_rent ="";$pay_house_loan="";$pay_gias="";$pay_gpf_adv="";
				 $pay_total_sum = ""; $pay_gpf =""; $pay_ca=""; $pay_sp="";$pay_hra="";$pay_da="";$pay_special="";$pay_basic="";
                                foreach ($pay_regi as $key => $pay) { 
								 $k++; 
                                     $pay_year = $curr_financial_year;
									$pay_year = explode("-", $pay_year);

                               $flyear = getflyear($pay->pay_month_given,$pay_year[0],$pay_year[1],$pay->pay_year_given);
                       
                       //echo $pay->pay_month_given.",".$pay_year[0].",".$pay_year[1].",".$pay->pay_year_given."<br/>";

                    // echo  "f year".$flyear."<br/>";
                              if($flyear == 1 &&  $flyear != ""  ){
                                  $content.=' <tr  > <td >';
								  if($pay->pay_arriyas == 1 ){   $content.= $pay->pay_arriyas_name ;}else{  $content.='वेतन';}
                              

                                $content.='  </td><td >';
								if($pay->pay_arriyas == 1 ){
												 if(!empty($pay->pay_arriyas_satrdate)){
												$content.= $pay->pay_arriyas_satrdate .'से '.  $pay->pay_arriyas_enddate;
												 
											 }else{
											  $content.= '01-'.$pay->pay_start_month .'-'.  $pay->pay_arriyas_year .' से  30-'. $pay->pay_end_month.' - '.$pay->pay_arriyas_year_end;  
											 }
									 }else{ 
                                         $content.= $pay->pay_month." ".$pay->pay_year ;   } 
										
										$months .= "'".$pay->pay_month."',".'</td>';
                                       if($dataval[0]['pay_cate_basic'] == 1){ 
                            	    $content.="<th >".$pay->pay_basic."</th>";$pay_basic = $pay_basic +$pay->pay_basic;
									
                                }if($dataval[0]['pay_cate_grp'] == 1){ 
                                       $content.= "<th >".$pay->pay_grp ."</th>";$pay_grp = $pay_grp +$pay->pay_grp;
                              }if($dataval[0]['pay_cate_special'] == 1){  
                                       $content.=" <th >".$pay->pay_special."</th>";$pay_special = $pay_special +$pay->pay_special;
                                    }if($dataval[0]['pay_cate_da'] == 1){ 
                                  $content.=" <th >". $pay->pay_da."</th>";$pay_da = $pay_da +$pay->pay_da;
                                  }if($dataval[0]['pay_cate_hra'] == 1){  
                                   $content.="<th >". $pay->pay_hra."</th>";$pay_hra = $pay_hra +$pay->pay_hra;
                                   }if($dataval[0]['pay_cate_other_add'] == 1){  
                                    $content.=" <th >". $pay->pay_others ."</th>";$pay_others = $pay_others +$pay->pay_others;
                                       }if($dataval[0]['pay_cate_sa'] == 1){ 
                                  $content.="  <th >". $pay->pay_sa."</th>";$pay_sa = $pay_sa +$pay->pay_sa;
                                     }if($dataval[0]['pay_cate_madical'] == 1){  
                                  $content.="  <th >". $pay->pay_madical.'</th>';$pay_madical = $pay_madical +$pay->pay_madical;

                                     }if($dataval[0]['pay_cate_sp'] == 1){  
                                    $content.="  <th >". $pay->pay_sp.'</th>';$pay_sp = $pay_sp +$pay->pay_sp;

                                           }if($dataval[0]['pay_cate_ca'] == 1){  
                                     $content.="  <th >".$pay->pay_ca.'</th>';$pay_ca = $pay_ca +$pay->pay_ca;
                                  
                                 } 
                                $content.="  <th >". $pay->pay_total_sum.'</th>';$pay_total_sum = $pay_total_sum +$pay->pay_total_sum;
                              if($dataval[0]['pay_cate_gpf'] == 1){
                                        $content.="  <th >".$pay->pay_gpf.'</th>';$pay_gpf = $pay_gpf +$pay->pay_gpf;
                                     }if($dataval[0]['pay_cate_gpf_adv'] == 1){ 
                                       $content.="  <th >". $pay->pay_gpf_adv.'</th>';$pay_gpf_adv = $pay_gpf_adv +$pay->pay_gpf_adv;
                                    }if($dataval[0]['pay_cate_dpf'] == 1){ 
                                    $content.="  <th >".  $pay->pay_dpf.'</th>';$pay_dpf = $pay_dpf +$pay->pay_dpf;
									}if($dataval[0]['pay_cate_dpf_adv'] == 1){ 
                                     $content.="  <th >".  $pay->pay_dpf_adv.'</th>';$pay_dpf_adv = $pay_dpf_adv +$pay->pay_dpf_adv;
                                   }if($dataval[0]['pay_cate_gias'] == 1){  
                                     $content.="  <th >".  $pay->pay_gias .'</th>';$pay_gias = $pay_gias +$pay->pay_gias;
                                   }if($dataval[0]['pay_cate_defined_contribution'] == 1){ 
                                      $content.="  <th >". $pay->pay_defined_contribution .'</th>';$pay_defined_contribution = $pay_defined_contribution +$pay->pay_defined_contribution;
                                  }if($dataval[0]['pay_cate_house_loan'] == 1){  
                            $content.="  <th >". $pay->pay_house_loan .'</th>';$pay_house_loan = $pay_house_loan +$pay->pay_house_loan;

                             }if($dataval[0]['pay_cate_car_loan'] == 1){ 


                                    $content.="  <th >".$pay->pay_car_loan .'</th>';$pay_car_loan = $pay_car_loan +$pay->pay_car_loan;
								}if($dataval[0]['pay_cate_house_rent'] == 1){ 
                              $content.="  <th >".$pay->pay_house_rent.'</th>';$pay_house_rent = $pay_house_rent +$pay->pay_house_rent;

                              }if($dataval[0]['pay_cate_garain_adv'] == 1){  
                                
                                   $content.="  <th >". $pay->pay_grain_adv.'</th>';$pay_grain_adv = $pay_grain_adv +$pay->pay_grain_adv;
                                
                                
                                     }if($dataval[0]['pay_cate_fuel_charge'] == 1){ 

                                   $content.="  <th >". $pay->pay_fuel_charge.'</th>';$pay_fuel_charge = $pay_fuel_charge +$pay->pay_fuel_charge;

                                      }if($dataval[0]['pay_cate_festival_adv'] == 1){ 

                            $content.="  <th >".$pay->pay_festival_adv.'</th>';$pay_festival_adv = $pay_festival_adv +$pay->pay_festival_adv;


                                       }if($dataval[0]['pay_cate_professional_tax'] == 1){  

                                   $content.="  <th >".$pay->pay_professional_tax.'</th>';$pay_professional_tax = $pay_professional_tax +$pay->pay_professional_tax;

                                      }if($dataval[0]['pay_cate_income_tax'] == 1){  

                              $content.="  <th >". $pay->pay_income_tax ."</th>";$pay_income_tax = $pay_income_tax +$pay->pay_income_tax;

                            
                                 }if($dataval[0]['pay_cate_other_adv'] == 1){ 

                                    $content.="  <th >". $pay->pay_other_adv."</th>";$pay_other_adv = $pay_other_adv +$pay->pay_other_adv;

                                     } 
                                   $content.="  <th >".$pay->pay_total_cut.'</th>';$pay_total_cut = $pay_total_cut +$pay->pay_total_cut;
                                   $content.="  <th >". $pay->pay_total.'</th>'; $pay_total = $pay_total + $pay->pay_total;
						
							
                                 $content.="  </tr>";
								 /////////////////////////
								 
					  }} }  // $emp_id == $dataval[0]['pay_cate_id'] ;
 $months= rtrim($months,",");
 
   $content.=' <tr style="background-color: #4CAF50;"> <th ></th>';
							
										
										$content .= '<th >Total</th>';
                                       if($dataval[0]['pay_cate_basic'] == 1){ 
                            	    $content.="<th >".$pay_basic."</th>";
                                }if($dataval[0]['pay_cate_grp'] == 1){ 
                                       $content.= "<th >".$pay_grp ."</th>";
                              }if($dataval[0]['pay_cate_special'] == 1){  
                                       $content.=" <th >".$pay_special."</th>";
                                    }if($dataval[0]['pay_cate_da'] == 1){ 
                                  $content.=" <th >". $pay_da."</th>";
                                  }if($dataval[0]['pay_cate_hra'] == 1){  
                                   $content.="<th >". $pay_hra."</th>";
                                   }if($dataval[0]['pay_cate_other_add'] == 1){  
                                    $content.=" <th >". $pay_others ."</th>";
                                       }if($dataval[0]['pay_cate_sa'] == 1){ 
                                  $content.="  <th >". $pay_sa."</th>";
                                     }if($dataval[0]['pay_cate_madical'] == 1){  
                                  $content.="  <th >". $pay_madical.'</th>';

                                     }if($dataval[0]['pay_cate_sp'] == 1){  
                                    $content.="  <th >". $pay_sp.'</th>';

                                           }if($dataval[0]['pay_cate_ca'] == 1){  
                                     $content.="  <th >".$pay_ca.'</th>';
                                  
                                 } 
                                $content.="  <th >". $pay_total_sum.'</th>';
                              if($dataval[0]['pay_cate_gpf'] == 1){
                                        $content.="  <th >".$pay_gpf.'</th>';
                                     }if($dataval[0]['pay_cate_gpf_adv'] == 1){ 
                                       $content.="  <th >". $pay_gpf_adv.'</th>';
                                    }if($dataval[0]['pay_cate_dpf'] == 1){ 
                                    $content.="  <th >".  $pay_dpf.'</th>';
									}if($dataval[0]['pay_cate_dpf_adv'] == 1){ 
                                     $content.="  <th >".  $pay_dpf_adv.'</th>';
                                   }if($dataval[0]['pay_cate_gias'] == 1){  
                                     $content.="  <th >".  $pay_gias .'</th>';
                                   }if($dataval[0]['pay_cate_defined_contribution'] == 1){ 
                                      $content.="  <th >". $pay_defined_contribution .'</th>';
                                  }if($dataval[0]['pay_cate_house_loan'] == 1){  
                            $content.="  <th >". $pay_house_loan .'</th>';

                             }if($dataval[0]['pay_cate_car_loan'] == 1){ 


                                    $content.="  <th >".$pay_car_loan .'</th>';
								}if($dataval[0]['pay_cate_house_rent'] == 1){ 
                              $content.="  <th >".$pay_house_rent.'</th>';

                              }if($dataval[0]['pay_cate_garain_adv'] == 1){  
                                
                                   $content.="  <th >". $pay_grain_adv.'</th>';
                                
                                
                                     }if($dataval[0]['pay_cate_fuel_charge'] == 1){ 

                                   $content.="  <th >". $pay_fuel_charge.'</th>';

                                      }if($dataval[0]['pay_cate_festival_adv'] == 1){ 

                            $content.="  <th >".$pay_festival_adv.'</th>';


                                       }if($dataval[0]['pay_cate_professional_tax'] == 1){  

                                   $content.="  <th >".$pay_professional_tax.'</th>';

                                      }if($dataval[0]['pay_cate_income_tax'] == 1){  

                              $content.="  <th >". $pay_income_tax ."</th>";

                            
                                 }if($dataval[0]['pay_cate_other_adv'] == 1){ 

                                    $content.="  <th >". $pay_other_adv."</th>";

                                     } 
                                   $content.="  <th >".$pay_total_cut.'</th>';
                                   $content.="  <th >". $pay_total.'</th>';
						
							
                                 $content.="  </tr>";
                                $content.='</tbody>';      } else{
								
								
   $content.='<tr><th colspan="22"> No result found </th> </tr> '; 

                             } 
                          $content.=' </table>   </div>'; echo  $content;
						  $contents =$content;
		$file_name = "payregister".$pay->emp_unique_id;
		
		genrate_unicode_pdf($contents,$file_name ,$pdfAbspath,'F');
						  
						  ?> <input id="pdfval" type="hidden" name="country" value="<?php echo  base64_encode($content); ?>" /> 
                  </div>

            </div><!-- /.box -->
   </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<script>
function generate_PDF()
{
	var pdf = $("#pdfval").val();
		
	$.ajax({
		url: HTTP_PATH + "incom_tax_form/pdfgen",
		type: "POST",
		async: true,
		data: {contents: pdf},
		success: function(data){
		console.log(data);
		alert(data);
		}
	});
}
</script>