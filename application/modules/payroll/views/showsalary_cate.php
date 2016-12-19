  <?php foreach ($cate_salary as $key => $salary) {?>
   
<!-- Content Header (Page header) -->
<section class="content-header">

   
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"<?php echo $salary->pay_cate_name; ?></li>
    </ol> 
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
              
        <h1>
        <?php echo "वेतन  हेड  ".$salary->pay_cate_name; ?>
    </h1>
                </div>
                <div class="box-body">
                 <div class="box-tools pull-right">
                   <!--     <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
                     -->    <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>
                </div>
            </div>
        </div>
    </div><?php } ?>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">

               <div class="box-body">
               
                   
                    <ul class="nav nav-tabs">
    
  <li><a data-toggle="tab" style="background-color: #00c0ef;color: #fff;" href="#Addions">जोड़े (Addition Salary)</a></li>  
  <li><a data-toggle="tab" style="background-color: #9e1414;color: #fff;" href="#diduction">घटाये (Deduction Salary)</a></li>  
  
  <div class="tab-content">
    <div id="Addions" class="tab-pane fade in active ">
          <div class="col-xs-12">
 
        <div class="box-header">
                    <h1 >Addition</h1>
                </div>

                <form action="<?php echo base_url();?>payroll/upadate_master" method="post">
<?php// pre($dataval);?>
   <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            
         
   <a target="" id="basic_pay" href="#"  class="btn bg-purple btn-flat margin" ><?php  echo $this->lang->line('basic_pay');  ?></a>
   
 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
      
   <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_gradepay'); ?></a>
        <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                  
  <button type="button" class="btn bg-purple" onclick="chckboxval()" data-toggle="modal" data-target="#myda"><?php echo $this->lang->line('pay_da');?></button>
  
        <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                  
      
   <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#myhra"><?php echo $this->lang->line('pay_hra');?></button>
 
  
    <!-- <?php }if($dataval[0]['pay_cate_special'] == 1){  ?> -->
                              
<!--       
   <a target="" id="" href="#" onclick="chnageca('sp')"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_special'); ?></a>
 -->

   <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    
    
 <button type="button" class="btn bg-purple" onclick="chckboxval()" data-toggle="modal" data-target="#mysa"><?php echo $this->lang->line('pay_sa');?></button>
  
 <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    
      
   <button type="button" class="btn bg-purple" onclick="chckboxval()" data-toggle="modal" data-target="#myma"><?php echo $this->lang->line('pay_ma');?></button>
  
       
  
       <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>


   <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_sp');?></a>
   <div id="sp"  class="dn">

 </div>

                <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                 
 
 <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#myca"><?php echo $this->lang->line('pay_ca');?></button>
    <?php }?>
                

               <div id="table-container" class="div-table-content">
<table id="maintable" class="table table-bordered table-striped dataTable no-footer" >
    <thead>     
        <tr>  <th width='15%'><input type="checkbox" onClick="toggle(this)" /> Select All
</th>
                                  

                                    <th width='20%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th width="20%"><?php echo $this->lang->line('emp_name'); ?></th>
                                  
                                    <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th width='20%'><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th width="10%"><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th width='20%'><?php echo  $this->lang->line('pay_special');   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th width="15%"><?php  echo  $this->lang->line('pay_da');?></th>
                                     <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                   <th width="15%"><?php  echo  $this->lang->line('pay_hra');?></th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th width='15%'><?php echo $this->lang->line('pay_others'); ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th width='20%'><?php echo $this->lang->line('pay_sa');  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th width="10%"><?php echo  $this->lang->line('pay_ma'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th width='15%'><?php echo $this->lang->line('pay_sp'); ?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th width='20%'><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                    <?php } ?>
                            <th width='20%'><?php echo $this->lang->line('pay_sum'); ?></th>
                             
                                    
  
                                    <th width='20%'>रिमार्क</th>
        </tr>
</thead> 
                            
  
  
                                    <?php $k =0; foreach ($pay_salary as $key => $pay) { $k++; 
                                      ?>
                               
                                        <tr id="<?php echo $pay->pay_id; ?>" class="ck">
                               

                                     <td >
<input type="checkbox" name="foo" onclick="chckboxval()" value="<?php echo $pay->pay_emp_unique_id; ?>"> </td>
                                    
                                    <td><?php echo get_tr_unicode($pay->pay_emp_unique_id); ?></td>
                                    <td ><?php echo emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                  
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <td>
                               
                             <?php echo $pay->pay_basic;  ?>                            </td>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <td >  <?php echo $pay->pay_grp;  ?>                                    </td>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <td>
                                      <?php echo $pay->pay_special;   ?>                                    </td>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <td widtd="115%"><?php  echo  $pay->pay_da;  ?></td>
                            <?php }if($dataval[0]['pay_cate_hra'] == 1){  ?>
                                   <td widtd="115%"><?php  echo  $pay->pay_hra;  ?></td>

                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <td ><?php echo $pay->pay_otders ?> </td>
                               <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <td><?php echo $pay->pay_sa;  ?> </td>

                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <td >
                                      <?php echo $pay->pay_madical; ?>                                    </td>
                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <td >   <?php echo $pay->pay_sp; ?></td> 
                                     <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                       <td> <?php echo $pay->pay_ca ?> </td>
                                      <?php } ?>
                                      <td>
                                      <?php echo $pay->pay_total_sum ?>                                    </td>    
                             
                                   

                             

                                      <td>  <?php echo $pay->pay_remark ?>  </td>
                                </tr>
                              <?php } ?>
</table> 


 </div>          
</div> 

</div> 
 <div id="diduction" class="tab-pane fade in "><h3></h3>
<div class="col-xs-12">
      <div class="box-header">
                    <h1 >Deduction </h1>
                </div>
<?php// pre($dataval);?>
   <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                            
        <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mygpf">
            <?php echo $this->lang->line('pay_gpf');?></button>

  <!--  <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
    -->
   
   <!-- <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_gpf_adv'); ?></a>
 -->
    <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                               
      
     <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mygpf">
            <?php echo $this->lang->line('pay_dpf');?></button>

             <!--
     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                  
      
   <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_dpf_adv'); ?></a>
  -->
    <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                   
      
  

 <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mygis"><?php echo $this->lang->line('pay_gis');?></button>
 
   
   <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    

   <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mygpf">
            <?php echo $this->lang->line('pay_define');?></button>

  
     

                <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                 
   <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_house_rent');?></a>
 
 
        <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>
                                 
   <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#myfule">
            <?php echo $this->lang->line('pay_fule_charge');?></button>

       <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>
          <button type="button" class="btn bg-purple"  data-toggle="modal" onclick="ckval()" data-target="#mypt">
            <?php echo $this->lang->line('pay_professional_tax');?></button>
 
                
   <!--
 <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>
                                 
   <a target="" id="" href="#"  class="btn bg-purple btn-flat margin" ><?php echo $this->lang->line('pay_income_tax');?></a>
   
<?php }?>

  -->        
<table id="maintable" class="table table-bordered table-striped dataTable no-footer" >
<thead>   <tr>
                    <th width='15%'><input type="checkbox" onClick="toggle(this)" /> Select All  </th>
                                    <th width='25%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th width="20%"><?php echo $this->lang->line('emp_name'); ?></th>
                                 
                           
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th width='25%'><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th width="15%"><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th width='15%'><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th width="10%"><?php  echo $this->lang->line('pay_gis');?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_define'); ?></th>
                                 
                         
                     
                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'><?php echo $this->lang->line('pay_house_rent'); ?></th>

                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%"><?php echo $this->lang->line('pay_fule_charge'); ?></th>

                                        

                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='15%'><?php echo $this->lang->line('pay_professional_tax'); ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="15%"><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                                    <?php } ?>
                                   <th width="15%"><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th width="15%"><?php echo $this->lang->line('pay_amount');  ?></th>
                                     <th width="15%"><?php echo "";  ?></th>
									    <th width='20%'>रिमार्क</th>
                                </tr>
  </thead>                  <?php $k =0; foreach ($pay_salary as $key => $pay) { $k++; 
                                      ?>

 <form action="<?php echo base_url();?>payroll/edit_slary_emp1" onsubmit="onsumitsalary(<?php echo $pay->pay_id; ?>)" id="emp<?php echo $pay->pay_id;  ?>" method="post">
      
                          <tr id="<?php echo $pay->pay_id; ?>">
                           

                                  <td >
<input type="checkbox" name="foo"  value="<?php echo $pay->pay_id; ?>"> </td>
                                    <td width='25%'><?php echo get_tr_unicode($pay->pay_emp_unique_id);  ?></td>
                                 <td ><?php echo emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                  
                                  
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                             <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                    <th width='25%'>
                          <div class="username<?php echo $pay->pay_id; ?>" id="pay_special" >
                                      <?php echo $pay->pay_gpf; ?>
                                     </div>
                                      <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_gpf;  ?>"   name="pay_gpf" >

                                  </div>


                                    </th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>

                                   <th width="15%">
                                <div class="username<?php echo $pay->pay_id; ?>" id="pay_special" > 

                                    <?php echo  $pay->pay_gpf_adv; ?> </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_gpf_adv;  ?>" name="pay_gpf_adv"  >

                                  </div>
                                  </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                   <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                    <th width='5%'><?php echo   $pay->pay_dpf ?>

                                         </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_dpf;  ?>" name="pay_dpf"  >

                                  </div>

                                    </th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'>
                                       <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo   $pay->pay_dpf_adv ?>
                                    </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_dpf_adv;  ?>"  name="pay_dpf_adv" >

                                  </div>
                                    </th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>

                                    <th width="10%">
                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_gias ?> 
                                           </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gias<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_gias;  ?>" name="pay_gias"  >

                                  </div>

                                    </th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'>
                                         <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_defined_contribution ?>
                                        </div>
                                       <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_define<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_defined_contribution;  ?>" name="pay_defined_contribution"  >

                                  </div>
                                                                              </th>
                       

                        

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'>
                                       <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                  <?php echo $pay->pay_house_rent ?></div>
                                        <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_house_rent<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_house_rent;  ?>" name="pay_house_rent"  >

                                  </div>
                                </th>

                         
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%">

                                     <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 
                                    <?php echo $pay->pay_fuel_charge; ?>
                                          </div>
                                       <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_fuel_charge<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_fuel_charge;  ?>" name="pay_fuel_charge"  >

                                  </div>
                                  
                                  </th>

                                         


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'>
                                     
                                     <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 
                                      <?php echo $pay->pay_professional_tax; ?>
                                     
      </div>
                                       <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_professional_tax<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_professional_tax;  ?>" name="pay_professional_tax"  >

                                  </div>
                                    </th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>


                                <th width="10%">
                                  
                                     <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 
                                  <?php echo $pay->pay_income_tax ?>

      </div>
                                       <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_income_tax<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_income_tax;  ?>" name="pay_income_tax"  >

                                  </div>
 
                                </th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'>
                                 <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 
                                      <?php echo $pay->pay_other_adv ?>
                                                             
      </div>
                                       <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_other_adv<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_other_adv;  ?>" name="pay_other_adv"  >

                                  </div>

                                    </th>

                                    <?php } ?>
                                   <th width="15%"><?php echo $pay->pay_total_cut; ?></th>
                                    <th width="15%">                           
                                      <?php echo $pay->pay_total ?>
                              
                                   </th>
                                    <th width="15%">       
                                  <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 
                                    <a class="no-print" href="#<?php echo $pay->pay_id; ?>" onclick="efitfrom(<?php echo $pay->pay_id?>)"  >edit</a> </div>              
                                  <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
   <input type="hidden" id="no_updated<?php echo $pay->pay_id; ?>" value="<?php echo $pay->no_updated+1; ?> "  name="remark" >
    <input type="hidden" id="pay_salary_cate_id<?php echo $pay->pay_id; ?>" value="<?php echo $pay->pay_salary_cate_id; ?> "  name="remark" >
    <input type="test" id="remark<?php echo $pay->pay_id; ?>" value=" "  name="remark" >
<button class="btn btn-primary" onclick="postfrom(<?php echo $pay->pay_id; ?>)" type="submit" name="savenotice" id="savenotice"  value="1">
  <?php echo $this->lang->line('submit_botton'); ?></button>
  
                                  </div>   
                              
                                   </th>
                                     
<td>  <?php echo $pay->pay_remark ?>  </td>

                                </tr>
                         
  <?php }  ?>


                    
</table>

</div>

</div>
  </div>
  </ul>
          

             </div> </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->
<?php foreach ($master_salary as $key => $salary) {?>
 

<div id="myca" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change CA  </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changeca" onsubmit="return checkeboxvv()" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current CA " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_ca; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>

              <input type="hidden" name="checkval" class="checkval"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice"  value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>

<div id="myda" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change DA  </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changeda" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current DA " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_da; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalda" class="checkvalda"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>

<div id="myhra" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change HRA  </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changehra" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current HRA " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_hra; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalhra" class="checkvalhra"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<div id="myma" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current Medical Allowance </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changema" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current Medical Allowance " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_madical; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalma" class="checkvalma"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>

<div id="mysa" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current Smchuri Allowance </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changesa" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current Smchuri Allowance " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_smchuri; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalsa" class="checkvalsa"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>

<div id="myfule" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current fuel charge </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changefule" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current fuel charge " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_fuel_charge; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalfule" class="checkvalfule"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<div id="mypt" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current professional tax </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changept" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current professional tax " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_pt; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalpt" class="checkvalpt"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<!-- fule -->
<div id="mygis" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current GIS </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changegis" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current GIS " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_gis; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_fuel_charge; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalgis" class="checkvalgis"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<!-- gpf  -->
<div id="mygpf" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Current GPF </h4>
      </div>
      <div class="modal-body">
           <form action="<?php echo base_url();?>payroll/changegpf" method="post" >
         <div class="form-group">
                <label for="exampleInputEmail1"><?php echo  "Current GPF " ?><span class="text-danger">*</span></label>
               <input type="text" name="pay_ca" id=""  value="<?php echo $salary->salary_gpf; ?>" class="form-control">
               
              <input type="hidden" name="salary_id" id="salary_id"  value="<?php echo $salary->salary_id; ?>" class="form-control">
               
              </div>
              
              <input type="hidden" name="checkvalgpf" class="checkvalgpf"  value=" " class="form-control">
               
                     <input type="hidden" name="cateid" id=""  value="<?php echo $salary->salary_cate_id; ?>" class="form-control">
               
                  
                     <input type="hidden" name="no_update" id=""  value="<?php echo $salary->no_updated + 1; ?>" class="form-control">
               
      </div>
   
      <div class="modal-footer">
       

          <button class="btn btn-primary" type="submit" name="savenotice" id="savenotice" onclick="showdetails()" value="1"><?php echo $this->lang->line('submit_botton'); ?></button>
       
        
      </div>
    </form>
    </div>

  </div>
</div>
<?php  }?>
<script type="text/javascript">

function toggle(source) {
   var allVals = [];
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;


  } 

$('.ck :checked').each(function() {
       allVals.push($(this).val());
     });
      $(".checkval").val(allVals);
   $(".checkvalda").val(allVals);
   $(".checkvalhra").val(allVals);
    $(".checkvalma").val(allVals);
     $(".checkvalsa").val(allVals);
     $(".checkvalgis").val(allVals);
       $(".checkvalpt").val(allVals);
         $(".checkvalgpf").val(allVals);

        $(".checkvalfule").val(allVals);
}
function chckboxval()
{ var allVals = [];

  $('.ck :checked').each(function() {
       allVals.push($(this).val());
     });
    console.log(allVals);
   $(".checkval").val(allVals);
    $(".checkvalda").val(allVals);
       $(".checkvalhra").val(allVals);
         $(".checkvalgis").val(allVals);
$(".checkvalsa").val(allVals);
    $(".checkvalma").val(allVals);
$(".checkvalfule").val(allVals);
       $(".checkvalpt").val(allVals);
        $(".checkvalgpf").val(allVals);
}
function checkeboxvv()
{ uid = $(".checkval").val();
  
  if(uid == "")
  {
    alert("please Select at least one employee");
    return false;
  }else{
  return true;

  }

}function ckval(){
   uid = $(".checkval").val();
 if(uid == "")
  {
    alert("please Select at least one employee");
    return false;
  }else{
  return true;

  }

}
 function efitfrom(id)
{

  $(".username1"+id).show();
  $(".username"+id).hide();
}function postfrom(id)
{
 var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {

     $pay_salary_cate_id =$("#pay_dpf"+id).val();
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

remark=$("#remark"+id).val();

      $.post("<?php echo base_url();?>payroll/edit_slary_master1",{
        'pay_month':$pay_month,
        'pay_id':id,
        'pay_salary_cate_id' : $pay_salary_cate_id,
        'no_updated':no_updated,
        'pay_remark': remark,
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
</script>
<style type="text/css">
input{
  width: 60px;
}
table {
    table-layout:fixed;
}

.div-table-content {
  height:auto;
  overflow-y:auto;
}.dn{display: none;}
</style>