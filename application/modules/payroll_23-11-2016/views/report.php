    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>रिपोर्ट्स माह <?php echo $this->uri->segment("3");?> 2016</title>
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
          
            $('.dataTable').dataTable();
           
        });
</script> 
<style type="text/css">
th{border: 1px #ccc solid}
</style>
 <div class="box-tools pull-right">
                       <!--<button class="btn btn-block btn-info">Mark File</button>-->
                        <button class="btn  btn-warning no-print" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
<?php  // pre($pay_salary); 
	if(count($pay_salary) != 0) {  //
      ?>
<table  class="display" cellspacing="0" width="100%">
      <tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr>  <tr style="text-align:center">
    <td colspan="32"><h1>रिपोर्ट्स माह <?php echo $this->uri->segment("3");?> 2016</h1></td>
    
    </tr>
  
  
</table>
<table id="" class="table" cellspacing="0" border=1 width="100%" style="font-size:12px">
	

<thead>
		
                                <tr class="persist-header">
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                    <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                                  
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                            
                                    <th ><?php echo  $this->lang->line('pay_special');   ?></th>
                                 
                                   <th ><?php  echo  $this->lang->line('pay_da');?></th>
                                   
                                    <th ><?php echo $this->lang->line('pay_others'); ?></th>
                                         
                                    <th ><?php echo $this->lang->line('pay_sa');  ?></th>
                                     
                                    <th ><?php echo  $this->lang->line('pay_ma'); ?></th>

                                  
                                     <th ><?php echo $this->lang->line('pay_sp'); ?></th>

                                     
                                    <th ><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                   
									   
                                    <th ><?php echo $this->lang->line('pay_hra');?></th>
                                  
                            <th ><?php echo $this->lang->line('pay_sum'); ?></th>
                            
                                    <th ><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                   
                                   <th ><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                               
                                    <th ><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                   
                                    <th ><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                   
                                    <th ><?php  echo $this->lang->line('pay_gis');?></th>
                                  
                                    <th ><?php echo $this->lang->line('pay_define'); ?></th>
                                 
                            <th ><?php echo $this->lang->line('pay_home_loan');?></th>

            


                                    <th ><?php echo $this->lang->line('pay_car_loan');?></th>

                             
                                <th ><?php echo $this->lang->line('pay_house_rent'); ?></th>

                            
                                
                                     <th ><?php echo $this->lang->line('pay_grain_adv'); ?></th>
                                
                                
                                

                                   <th ><?php echo $this->lang->line('pay_fule_charge'); ?></th>

                                   

                            <th ><?php echo $this->lang->line('pay_festival_adv');  ?></th>


                                    <th ><?php echo $this->lang->line('pay_professional_tax'); ?></th>

                                     

                                <th ><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            

                                    <th ><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                               
                                   <th ><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th ><?php echo $this->lang->line('pay_amount');  ?></th>
                                     <th ></th>
                                </tr>
                              </thead>

	 <tbody>     
                                    <?php $k =0; foreach ($pay_salary as $key => $pay) { 

                                      $lastmontvale = paydiffmonth($pay->emp_unique_id,$pay->pay_month,$pay->pay_year);
                                        foreach ($lastmontvale as $key => $value) {
                                          # code...
                                     $total = $pay->pay_basic - $value->pay_basic;
                                    $total1 = $pay->pay_grp - $value->pay_grp;
                                      $total2 = $pay->pay_special - $value->pay_special;
                                      $total3 = $pay->pay_da - $value->pay_da;
                                       $total4 = $pay->pay_others - $value->pay_others;
                                        $total5 = $pay->pay_others - $value->pay_others;
                                         $total6 = $pay->pay_sa - $value->pay_sa;
                                          $total7 = $pay->pay_madical - $value->pay_madical;
                                          $total8 = $pay->pay_sp - $value->pay_sp;
                                      $total9 = $pay->pay_ca - $value->pay_ca;
                                     $total10 = $pay->pay_hra - $value->pay_hra;
                                      $total11 = $pay->pay_gpf - $value->pay_gpf;
                                       $total12 = $pay->pay_gpf_adv - $value->pay_gpf_adv;
                                      $total13 = $pay->pay_dpf - $value->pay_dpf;
                                      $total14 = $pay->pay_dpf_adv - $value->pay_dpf_adv;
                                       $total15 = $pay->pay_gias - $value->pay_gias;
                                          $total16 = $pay->pay_defined_contribution - $value->pay_defined_contribution;
                                      $total17 = $pay->pay_house_loan - $value->pay_house_loan;
                                           $total18 = $pay->pay_car_loan - $value->pay_car_loan;
                                              $total19= $pay->pay_house_rent - $value->pay_house_rent;
                                          $total20= $pay->pay_house_rent - $value->pay_house_rent;
                                      $total21= $pay->pay_grain_adv - $value->pay_grain_adv;
                                      $total22= $pay->pay_fuel_charge - $value->pay_fuel_charge;

                                    $total23 = $pay->pay_festival_adv - $value->pay_festival_adv;

                                    $total24= $pay->pay_professional_tax - $value->pay_professional_tax;

                                  $total25= $pay->pay_income_tax - $value->pay_income_tax;

                                                  $total26= $pay->pay_other_adv - $value->pay_other_adv;



                                      if($total != 0 || $total1!= 0 || $total2 != 0 || $total3 != 0 ||  $total4 != 0 || $total5 != 0 || $total6 != 0  || $total7 != 0  || $total8 != 0 || $total9 != 0 || $total10 != 0 || $total10 != 0 ||   $total11 != 0 ||  $total12 != 0 ||  $total13 != 0 || $total14 != 0 || $total15 != 0 ||   $total16 != 0 ||   $total17 != 0 ||   $total18 != 0 ||   $total19 != 0 || $total20 != 0 ||   $total21 != 0 ||   $total22 != 0 ||   $total23 != 0 ||   $total24 != 0 ||   $total25 != 0){ $k++; 
                                    ?>    

                            
                                   
                                        <tr id="<?php echo $pay->pay_id; ?>">
                                                                   
                                    <th  > <?php echo  $k ;?></th>
                                    <th ><?php echo get_tr_unicode($pay->emp_unique_id); ?></th>
                                    <th ><?php echo get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi." <br/>  (". get_employee_role($pay->emp_id).")";  ?></th>
                                     <th ><?php echo date("M",strtotime($pay->pay_month)); ?></th>                                    
                                           <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_basic",$pay->pay_month,$pay->pay_year)[0]->pay_basic;
                                         if ( $col ==  $pay->pay_basic) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
							  <style type="text/css">

th.changehead {
    background-color: red !important;
    color: #fff !important;
}input{    width: 54px;color: #000 !important;}
 @media print
{    
 th.changehead  {
 background-color: #ccc !important;
    color: #000 !important;
font-size: 12 px !important;
font-weight: bold;

 -webkit-print-color-adjust: exact; 
print-color-adjust: exact;

  }

}
  @page { size: landscape; }
    @media print {
        thead {display: table-header-group;}
    }
</style>
           
                                  <th  class="changehead">
                              <?php } ?> 

                                     <?php echo $pay->pay_basic;  ?>
                                    </th>
                                          <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_grp",$pay->pay_month,$pay->pay_year)[0]->pay_grp;
                                         if ( $col ==  $pay->pay_grp) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> <?php echo $pay->pay_grp;  ?></th>
                                    <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_special",$pay->pay_month,$pay->pay_year)[0]->pay_special;
                                         if ( $col ==  $pay->pay_special) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> 
                                      <?php echo $pay->pay_special;   ?></th>

                                       <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_da",$pay->pay_month,$pay->pay_year)[0]->pay_da;
                                         if ( $col ==  $pay->pay_da) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> <?php  echo  $pay->pay_da;  ?></th>
                                      <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_others",$pay->pay_month,$pay->pay_year)[0]->pay_others;
                                         if ( $col ==  $pay->pay_others) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> 

                                    <?php echo $pay->pay_others ?></th>
                          <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_sa",$pay->pay_month,$pay->pay_year)[0]->pay_sa;
                                         if ( $col ==  $pay->pay_sa) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> 


                            <?php echo $pay->pay_sa;  ?></th>
                          <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_madical",$pay->pay_month,$pay->pay_year)[0]->pay_madical;
                                         if ( $col ==  $pay->pay_madical) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> 
                                    <?php echo $pay->pay_madical; ?> </th>
                   <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_sp",$pay->pay_month,$pay->pay_year)[0]->pay_sp;
                                         if ( $col ==  $pay->pay_sp) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?> 
                                  <th  class="changehead">
                              <?php } ?> <?php echo $pay->pay_sp; ?></th>  
                             <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_ca",$pay->pay_month,$pay->pay_year)[0]->pay_ca;
                                         if ( $col ==  $pay->pay_ca) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?> <?php echo $pay->pay_ca ?>  </th>


                                               <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_hra",$pay->pay_month,$pay->pay_year)[0]->pay_hra;
                                         if ( $col ==  $pay->pay_hra) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  <?php echo $pay->pay_hra ?> </th>
                                          <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_total_sum",$pay->pay_month,$pay->pay_year)[0]->pay_total_sum;
                                         if ( $col ==  $pay->pay_total_sum) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  <?php echo $pay->pay_total_sum; ?></th>
                                             <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_gpf",$pay->pay_month,$pay->pay_year)[0]->pay_gpf;
                                         if ( $col ==  $pay->pay_gpf) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>   <?php echo $pay->pay_gpf; ?> </th>
									                               <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_gpf_adv",$pay->pay_month,$pay->pay_year)[0]->pay_gpf_adv;
                                         if ( $col ==  $pay->pay_gpf_adv) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?><?php echo  $pay->pay_gpf_adv; ?> </th>
                                             <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_dpf",$pay->pay_month,$pay->pay_year)[0]->pay_dpf;
                                         if ( $col ==  $pay->pay_dpf) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?><?php echo   $pay->pay_dpf ?> </th>
   <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_dpf_adv",$pay->pay_month,$pay->pay_year)[0]->pay_dpf_adv;
                                         if ( $col ==  $pay->pay_dpf_adv) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?><?php echo   $pay->pay_dpf_adv ?> </th>
                                        <?php 
                                        $col = paydiff($pay->emp_unique_id,"pay_gias",$pay->pay_month,$pay->pay_year)[0]->pay_gias;
                                         if ( $col ==  $pay->pay_gias) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>   <?php echo $pay->pay_gias ?>          </th>
                            <?php   $col = paydiff($pay->emp_unique_id,"pay_defined_contribution",$pay->pay_month,$pay->pay_year)[0]->pay_defined_contribution;
                                         if ( $col ==  $pay->pay_defined_contribution) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>
                             <?php echo $pay->pay_defined_contribution ?>
                                  </th> 
                           <?php   $col = paydiff($pay->emp_unique_id,"pay_house_loan",$pay->pay_month,$pay->pay_year)[0]->pay_house_loan;
                                         if ( $col ==  $pay->pay_house_loan) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?> <?php echo $pay->pay_house_loan ?>   </th>
                               <?php   $col = paydiff($pay->emp_unique_id,"pay_car_loan",$pay->pay_month,$pay->pay_year)[0]->pay_car_loan;
                                         if ( $col ==  $pay->pay_car_loan) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?> <?php echo $pay->pay_car_loan ?> </th>

                                   <?php   $col = paydiff($pay->emp_unique_id,"pay_house_rent",$pay->pay_month,$pay->pay_year)[0]->pay_house_rent;
                                         if ( $col ==  $pay->pay_house_rent) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>       <?php echo $pay->pay_house_rent ?> </th>

                                       
                           <?php   $col = paydiff($pay->emp_unique_id,"pay_grain_adv",$pay->pay_month,$pay->pay_year)[0]->pay_grain_adv;
                                         if ( $col ==  $pay->pay_grain_adv) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                                      <?php echo $pay->pay_grain_adv ?>

                               
                                     </th>
                                
                        <?php   $col = paydiff($pay->emp_unique_id,"pay_fuel_charge",$pay->pay_month,$pay->pay_year)[0]->pay_fuel_charge;
                                         if ( $col ==  $pay->pay_fuel_charge) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                          

                                   
                                    <?php echo $pay->pay_fuel_charge; ?>
                                    

                                  </th>

                          
                                       
                           <?php   $col = paydiff($pay->emp_unique_id,"pay_festival_adv",$pay->pay_month,$pay->pay_year)[0]->pay_festival_adv;
                                         if ( $col ==  $pay->pay_festival_adv) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                          
                         
                              <?php echo $pay->pay_festival_adv; ?>
                                

                            </th>


                                       
                           <?php   $col = paydiff($pay->emp_unique_id,"pay_professional_tax",$pay->pay_month,$pay->pay_year)[0]->pay_professional_tax;
                                         if ( $col ==  $pay->pay_professional_tax) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
             
                                      <?php echo $pay->pay_professional_tax; ?>
                           

                                    </th>

                                    
                              <?php   $col = paydiff($pay->emp_unique_id,"pay_income_tax",$pay->pay_month,$pay->pay_year)[0]->pay_income_tax;
                                         if ( $col ==  $pay->pay_income_tax) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                          
                                  <?php echo $pay->pay_income_tax ?>

                                </th>

                            
              
                                       
                         <?php   $col = paydiff($pay->emp_unique_id,"pay_other_adv",$pay->pay_month,$pay->pay_year)[0]->pay_other_adv;
                                         if ( $col ==  $pay->pay_other_adv) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                            
                                      <?php echo $pay->pay_other_adv ?>
                               

                                    </th>

                               
                                   <?php   $col = paydiff($pay->emp_unique_id,"pay_total_cut",$pay->pay_month,$pay->pay_year)[0]->pay_total_cut;
                                         if ( $col ==  $pay->pay_total_cut) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  
                            <?php echo $pay->pay_total_cut; ?></th>
                                 
                                         <?php   $col = paydiff($pay->emp_unique_id,"pay_total",$pay->pay_month,$pay->pay_year)[0]->pay_total;
                                         if ( $col ==  $pay->pay_total) { ?>
                          <th style="padding:0;"> 
                              <?php }else{?>      <th  class="changehead">
                              <?php } ?>  <?php echo $pay->pay_total; ?></th>
<th style="padding:0;">           
                                      <?php echo $pay->pay_remark ?>
                                    
  
                                
                                   </th>

                                </tr>
                         
</tbody> 
  <?php }}}  ?>

                                 
</table>

  <input  type="button" onclick="window.print();" style="background-color: #052B02;border: solid 1px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" name="Submit" class="no-print"  value="print" /> <input style="background-color: #052B02;border: solid 1px #36730F;margin: 10px auto;
    color: #ffffff;
    padding: 10px;" class="no-print"  type="button" onclick="window.history.back();" name="Submit" value="Go Back" >

  <?php }else{ ?>
  <div class="error" style="    text-align: center;
    background-color: rgba(244, 67, 54, 0.45);
    font-size: 36px;
    border: 1px solid red;
    width: 100%;">No result Found</div>
  <?php }?>
 <style type="text/css" media="print">
  
  @page { size: landscape; }

  @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
    .printdrak {
      background-color: #ccc  !important;
       color: #fff  !important;
    } 


}

</style><script>
    function UpdateTableHeaders() {
       $(".persist-area").each(function() {
       
           var el             = $(this),
               offset         = el.offset(),
               scrollTop      = $(window).scrollTop(),
               floatingHeader = $(".floatingHeader", this)
           
           if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
               floatingHeader.css({
                "visibility": "visible"
               });
           } else {
               floatingHeader.css({
                "visibility": "hidden"
               });      
           };
       });
    }
    
  
    $(function() {
    
       var clonedHeaderRow;
    
       $(".persist-area").each(function() {
           clonedHeaderRow = $(".persist-header", this);
           clonedHeaderRow
             .before(clonedHeaderRow.clone())
             .css("width", clonedHeaderRow.width())
             .addClass("floatingHeader");
             
       });
       
       $(window)
        .scroll(UpdateTableHeaders)
        .trigger("scroll");
       
    });
  </script>