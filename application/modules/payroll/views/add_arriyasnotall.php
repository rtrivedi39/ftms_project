  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Pay bill</title>

 <style type="text/css" media="print">
  


  @page { size: landscape; }
    @media print {
        thead {display: table-header-group;}
    }
       @media print and (color) {
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


}<style><style type="text/css">
input{    width: 54px;color: #000 !important;}
.printdrak {
      background-color:#FF9800 !important;
                  color: #000 !important;
    } 


</style>
  <link href="<?php echo base_url();?>/themes/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
       <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />

  <link href="<?php echo base_url();?>/themes/admin/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/themes/admin/plugins/datatables/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" />
   <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>/themes/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>/themes/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  
    <script src="<?php echo base_url();?>/themes/admin/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/themes/admin/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>/themes/admin/plugins/datatables/dataTables.tableTools.js" type="text/javascript"></script>

<script type="text/javascript">

 $(document).ready(function () {
          
            $('.dataTable').dataTable({
    "lengthMenu": [ 10, 25, 50, 75, 100,125,150,175,200, 1000 ],
  "pageLength": 50,
"aaSorting": [],
  
  
});
           
        });
</script>  </head>

<body>

<div class="box-tools pull-right">
                       <!--<button class="btn btn-block btn-info">Mark File</button>-->
                        <button class="btn  btn-warning no-print" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
<table  class="display" cellspacing="0" width="100%">

<tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr></table>
  
<div class="fix_table-container">
<table id="" class="table fixed_headers table-bordered table-striped dataTable fix_maintable" cellspacing="0" width="100%" style="font-size:12px">
	
<thead style="background:white" >

                                <tr>
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                    <!--<th ><?php echo $this->lang->line('emp_pay_month'); ?></th>-->
                               
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                             
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                          
                                    <th ><?php echo  $this->lang->line('pay_special');   ?></th>
                                 
                                   <th ><?php  echo  $this->lang->line('pay_da');?></th>
                                
                               
                                   
                                    <th ><?php echo $this->lang->line('pay_sa');  ?></th>
                                   
                                    <th ><?php echo  $this->lang->line('pay_ma'); ?></th>

                                     
                                     <th ><?php echo $this->lang->line('pay_sp'); ?></th>

                                 
                                    <th ><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                   
									    
                                    <th ><?php echo $this->lang->line('pay_hra');?></th>
                                  
                            
									 
                            <th ><?php echo " सकल राशी"; ?></th>
                                 <th ><?php echo  $this->lang->line('pay_gpf');?>
                                 </th>
                                   
                               
                                    <th ><?php  echo $this->lang->line('pay_dpf'); ?></th>

                               
                                    <th ><?php  echo $this->lang->line('pay_gis');?></th>
                          
                                    <th ><?php echo $this->lang->line('pay_define'); ?></th>
                                 
                                 

                                


                                <th ><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            
                                  

                                    <th ><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                                 
                                   <th ><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th ><?php echo $this->lang->line('pay_amount');  ?></th>
                                     <th >नगद राशी  </th>  <th ><?php echo "रिमार्क";  ?></th>
                                </tr>
                              </thead>

	  <tbody>     
      <?php $k =1; foreach ($_GET['unicode'] as $key => $value) { $k++;
        # code...
     ?>                               
   <form action="<?php echo base_url();?>payroll/edit_slary_emp1" onsubmit="onsumitsalary()" id="emp" method="post">
                            
                                    
                                        <tr id="">
                                   
                                    

                                  
                                    <th  ><?php echo $k."<br/>" ; ?></th>
                                    <th ><?php echo $value  ?></th>
                                    <th ><?php echo @get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi." <br/>  (". get_employee_designation_id($pay->emp_id).")"; ?></th>
                                  <!--   <th ><?php echo date("M",strtotime($pay->pay_month)); ?></th>-->
                                     
                                   
                           <th style="padding:0;"><input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id<?php echo $pay->pay_id;?>" value="<?php echo $pay->pay_salary_cate_id;  ?>" class="form-control">
        
                                  <input type="hidden" name="pay_id" id="pay_id<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_id;?>" >
                  <input type="hidden" name="pay_month" id="pay_month<?php echo $pay->pay_id;?>" value="<?php echo $pay->pay_month;?>" >
               <input type="hidden" name="no_updated" id="no_updated<?php echo $pay->pay_id;?>" value="<?php echo $pay->no_updated +1; ?>" >
               
                              <div class="username<?php echo $pay->pay_id; ?>" id="pay_basic112"><?php echo $pay->pay_basic;  ?></div>

                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                        <input type="numbar" id="pay_basic<?php echo $pay->pay_id; ?>" name="pay_basic" value="<?php echo $pay->pay_basic;  ?>" ></div>

                            </th>
                           
                                    
                                       
                           <th style="padding:0;"> 
                           <div class="username<?php echo $pay->pay_id; ?>" id="pay_grp"> <?php echo $pay->pay_grp;  ?></div>
  <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
    <input type="numbar" id="pay_grp<?php echo $pay->pay_id; ?>" name="pay_grp"   value="<?php echo $pay->pay_grp;  ?>" ></div>

                                    </th>
                          
                                        
                                         
                                       
                           <th style="padding:0;"><div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_special;   ?></div>
                                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                          <input type="numbar" name="pay_special"  id="pay_special<?php echo $pay->pay_id; ?>"value="<?php echo $pay->pay_special;  ?>" ></div>


                                    </th>
                               
                                   
                                         
                                       
                           <th style="padding:0;"><div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> <?php  echo  $pay->pay_da;  ?></div>
                                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                          <input type="numbar" name="pay_da"  id="pay_da<?php echo $pay->pay_id; ?>"value="<?php echo $pay->pay_da;  ?>" ></div>

</th>

                      
            
                                 <th  class="changehead">



              <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_others ?></div>
                                  <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" name="pay_others" id="pay_others<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_others;  ?>" >

                                  </div>
                                                  </th>

                                    
                                 
                                       
                           <th style="padding:0;"> 





                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                        <?php echo $pay->pay_sa;  ?></div>
                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_sa<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_sa;  ?>" name="pay_sa"  >

                                  </div>

                                      </th>
                                   
                           
                                       
                           <th style="padding:0;"> 
                             
                                      <div class="username<?php echo $pay->pay_id; ?>"  id="pay_special">
                                      <?php echo $pay->pay_madical; ?>
</div>
                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_madical<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_madical;  ?>" name="pay_madical" >

                                  </div>
                                    </th>

                                   
                                
                                       
                           <th style="padding:0;"> 
                            
                              
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_sp; ?>
                                              </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_sp<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_sp;  ?>" name="pay_sp"  >

                                  </div>

                                     </th>

                              
                                       
                           <th style="padding:0;"><div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_ca ?>
                                          </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_ca<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_ca;  ?>"  name="pay_ca"  >

                                  </div>

                                    </th>
                                        
                                       
                           <th style="padding:0;"> 
                            
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_hra ?>
                                          </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_hra<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_hra;  ?>"  name="pay_hra"  >

                                  </div>

                                    </th>
                                   
                            <th style="padding:0;"><?php echo $pay->pay_total_sum; ?></th>
                           
                 
                           <th style="padding:0;"> 
                              
                          <div class="username<?php echo $pay->pay_id; ?>">
                                      <?php echo $pay->pay_gpf; ?>
                                     </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf<?php echo $pay->pay_id; ?>"
                  value="<?php echo $pay->pay_gpf;  ?>"   name="pay_gpf" >

                                  </div>


                                    </th>
                  
                  
                                 
                                       
                           <th style="padding:0;"><div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                   <?php echo   $pay->pay_dpf ?>

                                         </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_dpf;  ?>" name="pay_dpf"  >

                                  </div>

                                    </th>

                                   
                  
                                      
                           <th style="padding:0;"> 
                              
                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_gias ?> 
                                           </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gias<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_gias;  ?>" name="pay_gias"  >

                                  </div>

                                    </th>
                                  
                                                 
                            <th style="padding:0;"><div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_defined_contribution ?>
                                            </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_define<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_defined_contribution;  ?>" name="pay_define"  >

                                  </div>

                                      </th>
                                 
                                     
                       
                                 <th  class="changehead">
       
                           
                                   <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                  <?php echo $pay->pay_income_tax ?>
 </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_income_tax<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_income_tax;  ?>"  name="pay_income_tax" >

                                  </div>
                                </th>

                            
                         

                               
                           <th style="padding:0;"> 
                  

                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_other_adv ?>
                                      </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_other_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_other_adv;  ?>"  name="pay_other_advs" >

                                  </div>

                                    </th>

                               
                                   <th ><?php echo $pay->pay_total_cut; ?></th>
                                 
                                     <th ><?php echo $pay->pay_total; ?></th><th ><?php echo $pay->pay_total; ?></th>
<th style="padding:0;">                            <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                     
                                      </div> <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >

    <input type="test" id="remark<?php echo $pay->pay_id; ?>" value=" "  name="remark" >
<button class="btn btn-primary" onclick="postfrom(<?php echo $pay->pay_id; ?>)" type="submit" name="savenotice" id="savenotice"  value="1">
  <?php echo $this->lang->line('submit_botton'); ?></button>
  
                                  </div>   
                                   </th>

                                </tr>
                             </form>
                             <?php } ?>
</tbody> 

<tfoot>
                                 
</table>
<div id="bottom_anchor"></div>
</div>


<script type="text/javascript">
function efitfrom(id)
{

  $(".username1"+id).show();
  $(".username"+id).hide();
}
function onsumitsalary(id)
{
   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
        document.getElementById("emp"+id).submit();


    } else {
        txt = "You pressed Cancel!";
    }
  

}
function postfrom(id)
{
 var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
    $pay_salary_cate_id =$("#pay_salary_cate_id"+id).val();
    $remark =$("#remark"+id).val();
    $pay_basic =$("#pay_basic"+id).val();
    $pay_grp =$("#pay_grp"+id).val();
    $pay_special =$("#pay_special"+id).val(); $pay_da =$("#pay_da"+id).val();
    $pay_hra =$("#pay_hra"+id).val();
    $pay_sa =$("#pay_sa"+id).val();
    $pay_madical =$("#pay_madical"+id).val();
    $pay_others =$("#pay_others"+id).val();
    $pay_ca =$("#pay_ca"+id).val();
    $pay_sp =$("#pay_sp"+id).val();
    $pay_dpf =$("#pay_dpf"+id).val();
    $pay_dpf_adv =$("#pay_dpf_adv"+id).val();
    $pay_gpf =$("#pay_gpf"+id).val();
    $pay_gpf_adv =$("#pay_gpf_adv"+id).val();
    $pay_gias =$("#pay_gias"+id).val();
$pay_define =$("#pay_define"+id).val();
$pay_fuel_charge =$("#pay_fuel_charge"+id).val();
$pay_professional_tax =$("#pay_professional_tax"+id).val();
$pay_income_tax =$("#pay_income_tax"+id).val();
  $pay_grain_adv =$("#pay_grain_adv"+id).val();
  $pay_festival_adv =$("#pay_festival_adv"+id).val();
    $pay_other_adv =$("#pay_other_adv"+id).val();
  $pay_house_loan =$("#pay_house_loan"+id).val();

  $pay_car_loan =$("#pay_car_loan"+id).val();
$pay_house_rent =$("#pay_house_rent"+id).val();
$pay_month = $("#pay_month"+id).val();
$pay_id = $("#pay_id"+id).val();
no_updated=$("#no_updated"+id).val();


      $.post("<?php echo base_url();?>payroll/edit_slary_arreas",{
        'pay_month':$pay_month,
        'pay_id':$pay_id,
        'pay_salary_cate_id' : $pay_salary_cate_id,
        'no_updated':no_updated,
        'pay_remark': $remark,
        'pay_basic' : $pay_basic,
              'pay_grp' :$pay_grp,
              'pay_special' :$pay_special ,
              'pay_hra': $pay_hra,
              'pay_sa': $pay_sa,
              'pay_madical':$pay_madical,
              'pay_others' : $pay_others ,
                'pay_da' : $pay_da ,
               'pay_ca' : $pay_ca ,
              'pay_sp' : $pay_sp ,
               'pay_dpf' : $pay_dpf ,
                'pay_dpf_adv': $pay_dpf_adv,
               'pay_gpf' :  $pay_gpf ,
               'pay_gpf_adv' : $pay_gpf_adv,
              'pay_gias' : $pay_gias ,
              'pay_define' : $pay_define ,
              'pay_fuel_charge': $pay_fuel_charge ,
              'pay_professional_tax': $pay_professional_tax ,
              'pay_income_tax' :$pay_income_tax ,
               'pay_grain_adv' : $pay_grain_adv,
              'pay_festival_adv' :$pay_festival_adv ,
               'pay_other_adv' :$pay_other_adv,
      'pay_house_loan' :$pay_house_loan ,
     'pay_car_loan' :$pay_car_loan ,
      'pay_house_rent' : $pay_house_rent,
      },function(a){

       location.reload();
      });

                               
    } else {
        txt = "You pressed Cancel!";
    }
  //ale

}
//////////////////////



</script><script>
function goBack(){
  window.location='<?php echo $_SERVER['HTTP_REFERER'] ?>';
}
</script>
