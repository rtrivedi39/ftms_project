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
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h1 ><?php  echo $pay_salary[0]->emp_full_name;    ?></h1>
                </div>
                <div class="box-body">
                    <?php //$this->load->view('payroll_header') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

               <div class="box-body">
               <?php  // pre($pay_salary); 
	if(count($pay_salary) != 0) { ?><table  class="display" cellspacing="0" width="100%">

<tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr>
  <tr style="text-align:center">
    <td colspan="32"><h2><?php echo  $pay_salary[0]->pay_subject; ?></h2></td>
  
    </tr>

    
    
</table>
<table id="" class="table fixed_headers table-bordered table-striped dataTable fix_maintable" cellspacing="0" width="100%" style="font-size:12px">
	
<thead style="background:white" >
		
                                <tr>
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                   <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                                    <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_special');   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th ><?php  echo  $this->lang->line('pay_da');?></th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_others'); ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_sa');  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_ma'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th ><?php echo $this->lang->line('pay_sp'); ?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                   
									      <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_hra');?></th>
                                  
                                    <?php } ?>
									 
                            <th ><?php echo $this->lang->line('pay_sum'); ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th ><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th ><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                   
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th ><?php echo $this->lang->line('pay_define'); ?></th>
									  <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th ><?php  echo $this->lang->line('pay_gis');?></th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th ><?php echo $this->lang->line('pay_home_loan');?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th ><?php echo $this->lang->line('pay_car_loan');?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th ><?php echo $this->lang->line('pay_house_rent'); ?></th>

                            
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th ><?php echo $this->lang->line('pay_fule_charge'); ?></th>
 <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th ><?php echo $this->lang->line('pay_grain_adv'); ?></th>
                                
                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th ><?php echo $this->lang->line('pay_festival_adv');  ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th ><?php echo $this->lang->line('pay_professional_tax'); ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th ><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th ><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                                    <?php } ?>
                                   <th ><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th ><?php echo $this->lang->line('pay_amount');  ?></th>
                                     <th ></th>
                                </tr>
                              </thead>

	 <tbody>     
                                    <?php $k = 1; foreach ($pay_salary as $key => $pay) { 
                                      ?>    
   <form action="<?php echo base_url();?>payroll/edit_slary_emp1" onsubmit="onsumitsalary(<?php echo $pay->pay_id; ?>)" id="emp<?php echo $pay->pay_id;  ?>" method="post">
                            
                                      <?php
                                      if($pay->no_updated == 0){?>
                                        <tr id="<?php echo $pay->pay_id; ?>">
                                  <?php }else{ ?>
<style type="text/css">

tr.printdrak{
      background-color:#FF9800 !important;
                  color: #000 !important;
    }
	@media print{
		tr.printdrak{
		  background-color:#FF9800 !important;
					  color: #000 !important;
		} 
	}


</style>            <tr id="<?php echo $pay->pay_id; ?>" style="background-color:#FF9800 !important;
                  color: #000 !important; " class="printdrak">
                                    <?php } ?>

                                  
                                    <th  ><?php echo $k."<br/>" ; if(!isset($pay_bill[0]->pbill_computer_no)) {?> <a class="no-print" href="#<?php echo $pay->pay_id; ?>" onclick="efitfrom(<?php echo $pay->pay_id?>)"  > edit</a><?php } ?></th>
                                    <th ><?php echo  get_tr_unicode($pay->emp_unique_id); ?></th>
                                    <th ><?php echo @get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi." <br/>  (". get_employee_designation_id($pay->emp_id).")"; ?></th>
                                <th ><?php echo date("M",strtotime($pay->pay_month)); ?></th>
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){ 
                                          
                                         ?>
                                        <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_basic",$pay->pay_month,$pay->pay_year)[0]->pay_basic;
                                     //echo $pay->pay_basic." ---".$col."<br />";
                                         if ($col ==  $pay->pay_basic) {  ?>
                                       
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
</style>
                                 <th  class="changehead">
                              <?php } ?>
                               <input type="hidden" name="pay_salary_cate_id" id="pay_salary_cate_id<?php echo $pay->pay_id;?>" value="<?php echo $pay->pay_salary_cate_id;  ?>" class="form-control">
        
                                  <input type="hidden" name="pay_id" id="pay_id<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_id;?>" >
                  <input type="hidden" name="pay_month" id="pay_month<?php echo $pay->pay_id;?>" value="<?php echo $pay->pay_month;?>" >
               <input type="hidden" name="no_updated" id="no_updated<?php echo $pay->pay_id;?>" value="<?php echo $pay->no_updated +1; ?>" >
               
                              <div class="username<?php echo $pay->pay_id; ?>" id="pay_basic112"><?php echo $pay->pay_basic;  ?></div>

                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                        <input type="numbar" id="pay_basic<?php echo $pay->pay_id; ?>" name="pay_basic" value="<?php echo $pay->pay_basic;  ?>" ></div>

                            </th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                             <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_grp",$pay->pay_month,$pay->pay_year)[0]->pay_grp;
                                         if ( $col ==  $pay->pay_grp) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> <div class="username<?php echo $pay->pay_id; ?>" id="pay_grp"> <?php echo $pay->pay_grp;  ?></div>
  <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
    <input type="numbar" id="pay_grp<?php echo $pay->pay_id; ?>" name="pay_grp"   value="<?php echo $pay->pay_grp;  ?>" ></div>

                                    </th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                        
                                             <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_special",$pay->pay_month,$pay->pay_year)[0]->pay_special;
                                         if ( $col ==  $pay->pay_special) { ?>
                                       
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


</style>
                                 <th  class="changehead">

                              <?php } ?> 

                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_special;   ?></div>
                                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                          <input type="numbar" name="pay_special"  id="pay_special<?php echo $pay->pay_id; ?>"value="<?php echo $pay->pay_special;  ?>" ></div>


                                    </th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   
                                             <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_da",$pay->pay_month,$pay->pay_year)[0]->pay_da;
                                         if ( $col ==  $pay->pay_da) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                                
                              <?php } ?> 

                                    <?php  echo  $pay->pay_da;  ?></th>

                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_others",$pay->pay_month,$pay->pay_year)[0]->pay_others;
                                         if ( $col ==  $pay->pay_others) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>
                              <?php } ?> 
							<div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_others ?></div>
                                  <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" name="pay_others" id="pay_others<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_others;  ?>" >

                                  </div>
                                                  </th>

                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_sa",$pay->pay_month,$pay->pay_year)[0]->pay_sa;
                                         if ( $col ==  $pay->pay_sa) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>
                              <?php } ?> 


                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                        <?php echo $pay->pay_sa;  ?></div>
                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_sa<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_sa;  ?>" name="pay_sa"  >

                                  </div>

                                      </th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                   <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_madical",$pay->pay_month,$pay->pay_year)[0]->pay_madical;
                                         if ( $col ==  $pay->pay_madical) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>
                              <?php } ?> 

                                      <div class="username<?php echo $pay->pay_id; ?>"  id="pay_special">
                                      <?php echo $pay->pay_madical; ?>
</div>
                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_madical<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_madical;  ?>" name="pay_madical" >

                                  </div>
                                    </th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                       <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_sp",$pay->pay_month,$pay->pay_year)[0]->pay_sp;
                                         if ( $col ==  $pay->pay_sp) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?> 
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_sp; ?>
                                              </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_sp<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_sp;  ?>" name="pay_sp"  >

                                  </div>

                                     </th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                     <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_ca",$pay->pay_month,$pay->pay_year)[0]->pay_ca;
                                         if ( $col ==  $pay->pay_ca) { ?>
                                       
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


</style>
                                 <th  class="changehead">
        
                              <?php } ?> 

                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_ca ?>
                                          </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_ca<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_ca;  ?>"  name="pay_ca"  >

                                  </div>

                                    </th>
                                        <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                               <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_hra",$pay->pay_month,$pay->pay_year)[0]->pay_hra;
                                         if ( $col ==  $pay->pay_hra) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?> 
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special">
                                      <?php echo $pay->pay_hra ?>
                                          </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_hra<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_hra;  ?>"  name="pay_hra"  >

                                  </div>

                                    </th>
                                    <?php } ?>     <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_total_sum",$pay->pay_month,$pay->pay_year)[0]->pay_total_sum;
                                         if ( $col ==  $pay->pay_total_sum) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?> 
									
                           <?php echo $pay->pay_total_sum; ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                               <?php $col = @paydiff($pay->emp_unique_id,"pay_gpf",$pay->pay_month,$pay->pay_year)[0]->pay_gpf;
                                         if ( $col ==  $pay->pay_gpf) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?> 
                          <div class="username<?php echo $pay->pay_id; ?>">
                                      <?php echo $pay->pay_gpf; ?>
                                     </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf<?php echo $pay->pay_id; ?>"
									value="<?php echo $pay->pay_gpf;  ?>"   name="pay_gpf" >

                                  </div>


                                    </th>
									
									
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>

                                               <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_gpf_adv",$pay->pay_month,$pay->pay_year)[0]->pay_gpf_adv;
                                         if ( $col ==  $pay->pay_gpf_adv) { ?>
                                       
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


</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                <div class="username<?php echo $pay->pay_id; ?>" id="pay_special" > 

                                    <?php echo  $pay->pay_gpf_adv; ?> </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf_adv<?php echo $pay->pay_id; ?>" 
									value="<?php echo $pay->pay_gpf_adv;  ?>" name="pay_gpf_adv"  >

                                  </div>
                                  </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                              <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_dpf",$pay->pay_month,$pay->pay_year)[0]->pay_dpf;
                                         if ( $col ==  $pay->pay_dpf) { ?>
                                       
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


</style>
                                 <th  class="changehead">
								 
                              <?php } ?> <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                   <?php echo   $pay->pay_dpf ?>

                                         </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_dpf;  ?>" name="pay_dpf"  >

                                  </div>

                                    </th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                            <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_dpf_adv",$pay->pay_month,$pay->pay_year)[0]->pay_dpf_adv;
                                         if ( $col ==  $pay->pay_dpf_adv) { ?>
                                       
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


</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                       <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo   $pay->pay_dpf_adv ?>
                                    </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_dpf_adv;  ?>"  name="pay_dpf_adv" >

                                  </div>
                                    </th>
									   <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                                 <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_defined_contribution",$pay->pay_month,$pay->pay_year)[0]->pay_defined_contribution;
                                         if ( $col ==  $pay->pay_defined_contribution) { ?>
                                       
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


</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                  
                                  <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_defined_contribution ?>
                                            </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_define<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_defined_contribution;  ?>" name="pay_define"  >

                                  </div>

                                      </th>
                                 
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>

                                                 <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_gias",$pay->pay_month,$pay->pay_year)[0]->pay_gias;
                                         if ( $col ==  $pay->pay_gias) { ?>
                                       
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


</style>
</style>
                                 <th  class="changehead">

                              <?php } ?> 
                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_gias ?> 
                                           </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gias<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_gias;  ?>" name="pay_gias"  >

                                  </div>

                                    </th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                                           <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_house_loan",$pay->pay_month,$pay->pay_year)[0]->pay_house_loan;
                                         if ( $col ==  $pay->pay_house_loan) { ?>
                                       
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

</style>

                                 <th  class="changehead">
                              <?php } ?> 
                          <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                              <?php echo $pay->pay_house_loan ?>
                                </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_house_loan<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_house_loan;  ?>" name="pay_house_loan"  >

                                  </div>

                            </th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                   <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_car_loan",$pay->pay_month,$pay->pay_year)[0]->pay_car_loan;
                                         if ( $col ==  $pay->pay_car_loan) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_car_loan ?>
                                    </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_car_loan<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_car_loan;  ?>"  name="pay_car_loan"  >

                                  </div>


                                    </th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                  <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_house_rent",$pay->pay_month,$pay->pay_year)[0]->pay_house_rent;
                                         if ( $col ==  $pay->pay_house_rent) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                  <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                  <?php echo $pay->pay_house_rent ?></div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_house_rent<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_house_rent;  ?>"  name="pay_house_rent" >

                                  </div>

                                </th>

                           
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                               <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_fuel_charge",$pay->pay_month,$pay->pay_year)[0]->pay_fuel_charge;
                                         if ( $col ==  $pay->pay_fuel_charge) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> 

                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                    <?php echo $pay->pay_fuel_charge; ?>
                                    </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_fuel_charge<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_fuel_charge;  ?>" name="pay_fuel_charge"  >

                                  </div>

                                  </th>  <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                           <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_grain_adv",$pay->pay_month,$pay->pay_year)[0]->pay_grain_adv;
                                         if ( $col ==  $pay->pay_grain_adv) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>                <?php } ?> 
                                        <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 


                                      <?php echo $pay->pay_grain_adv ?>

                                      </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_grain_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_grain_adv;  ?>"  name="pay_grain_adv" >

                                  </div>
                                     </th>
                                

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                                                 <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_festival_adv",$pay->pay_month,$pay->pay_year)[0]->pay_festival_adv;
                                         if ( $col ==  $pay->pay_festival_adv) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>
                              <?php } ?> 
                              <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                              <?php echo $pay->pay_festival_adv; ?>
                                </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_festival_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_festival_adv;  ?>"  name="pay_festival_adv" >

                                  </div>

                            </th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                  
                                                 <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_professional_tax",$pay->pay_month,$pay->pay_year)[0]->pay_professional_tax;
                                         if ( $col ==  $pay->pay_professional_tax) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                       <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_professional_tax; ?>
                                      </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_professional_tax<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_professional_tax;  ?>"  name="pay_professional_tax"  >

                                  </div>

                                    </th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                               <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_income_tax",$pay->pay_month,$pay->pay_year)[0]->pay_income_tax;
                                         if ( $col ==  $pay->pay_income_tax) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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

</style>
                              <?php } ?> 
                                   <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                  <?php echo $pay->pay_income_tax ?>
 </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_income_tax<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_income_tax;  ?>"  name="pay_income_tax" >

                                  </div>
                                </th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                              <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_other_adv",$pay->pay_month,$pay->pay_year)[0]->pay_other_adv;
                                         if ($col ==  $pay->pay_other_adv) { ?>
                                       
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

</style>
                                 <th  class="changehead">
                              <?php } ?> 
                                    <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_other_adv ?>
                                      </div>
                                    <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_other_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_other_adv;  ?>"  name="pay_other_advs" >

                                  </div>

                                    </th>

                                    <?php } ?>
                                    <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_total_cut",$pay->pay_month,$pay->pay_year)[0]->pay_total_cut;
                                         if ( $col ==  $pay->pay_total_cut) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?> <?php echo $pay->pay_total_cut; ?></th>
                                 
                                     <?php 
                                        $col = @paydiff($pay->emp_unique_id,"pay_total",$pay->pay_month,$pay->pay_year)[0]->pay_total;
                                         if ( $col ==  $pay->pay_total) { ?>
                                       
                           <th style="padding:0;"> 
                              <?php }else{?> 
                                 <th  class="changehead">
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


</style>
                              <?php } ?><?php echo $pay->pay_total; ?></th>
<th style="padding:0;">                            <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_remark ?>
                                      </div> <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >

    <input type="test" id="remark<?php echo $pay->pay_id; ?>" value=" "  name="remark" >
<button class="btn btn-primary" onclick="postfrom(<?php echo $pay->pay_id; ?>)" type="submit" name="savenotice" id="savenotice"  value="1">
  <?php echo $this->lang->line('submit_botton'); ?></button>
  
                                  </div>   
                                   </th>

                                </tr>
                             </form>
	<?php $k++; }  ?></tbody> 

<tfoot><?php $this->load->view("payroll/total.php");?>
          
             
</tfoot>
</table>
   <div id="bottom_anchor"></div>
</div>

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
  <?php }?></body>
</html>

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
    $pay_special =$("#pay_special"+id).val();
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


      $.post("<?php echo base_url();?>payroll/edit_slary_emp1",{
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
