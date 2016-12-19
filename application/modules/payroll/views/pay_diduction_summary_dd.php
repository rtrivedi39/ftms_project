
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php  echo $dd_key = $this->uri->segment(3); ?>
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
                <div class="box-header with-border">
                        <h3 class="box-title"><?php// echo "माह मार्च 2015 के वेतन में सा0भ0नि0 अंशदान में राशि बढाये जाने के संबंध मे।  " ?></h3>                 
                    </div>
                   
                    <div class="box-body">
                        <?php //echo $this->session->flashdata('message');

//pre($pay_salary);
                         ?>
                         <table  class="display" cellspacing="0" width="100%">

<tr style="text-align:center">
    <td colspan="32"><h1>मध्यप्रदेश शासन विधि एवं विधायी कार्य विभाग</h1></td>
    
    </tr>
  <?php $emp_id = $this->uri->segment("3"); if($emp_id == 1){ ?>

  <tr style="text-align:center">
    <td colspan="32">
      <h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का न्यायिक सेवा  
        अधिकारियों का वेतन पत्रक कम्प्यूटर देयक क्रमांक 
        <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   दिनांक 
          <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>   दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?> </h2></td>
  
    </tr>
    <?php }elseif($emp_id == 4){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?>
     2016 का चतुर्थ श्रेणी कर्मचारियों का वेतन विवरण पत्रक
       कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   
            दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
        <?php }elseif($emp_id == 2){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 
      2016 का  परिभाषहित अशंदान  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक
         <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक  
        <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?> ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  
        <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

   <?php }elseif($emp_id == 3){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
     <?php }elseif($emp_id == 9){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिस देयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
   <?php }elseif($emp_id == 10){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
   <?php }elseif($emp_id == 11){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
     <?php }elseif($emp_id == 12){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का प्रथम ,   
द्वितीय एवं तृतीय अधि . /  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>
  
<?php }elseif($emp_id == 7 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: 29-2014 न्याय  प्रशासन 3428 चतुर्थ श्रेणी कर्मचारियों का माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

<?php }elseif($emp_id == 6 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: श्री दिनेश कुमार कुमरे  का वेतन 29-2014 से आहरण अंशदायी होने के कारन पृथक से बनाया जा रहा है | वेतन माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

<?php }elseif($emp_id == 5 ){ ?>


  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माँग संख्या 29-2014 न्याय प्रशासन 114-3428 महाधिवक्ता कायार्लय  वेतन देयक तृतीय श्रेणी कर्मचारी का 
   माह <?php echo $this->uri->segment("4");?> 2016 वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>        दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

    <?php }elseif($emp_id == 8 ){ ?>
  <tr style="text-align:center">
    <td colspan="32"><h2>विषय: माह <?php echo $this->uri->segment("4");?> 2016 का  परिभाषहित अशंदान  कर्मचारियों का वेतन विवरण पत्रक  कम्प्यूटर देयक क्रमांक   <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_computer_no; }?>   दिनांक   <?php echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date)); ?>  ऑफिसदेयक क्रमांक  <?php if(count($pay_bill)== 0){echo "---";}
        else{echo @$pay_bill[0]->pbill_office_no; }?>     दिनांक  <?php if(count($pay_bill)== 0){ 
            echo "---";
          }else{ echo date("d-m-Y",strtotime(@$pay_bill[0]->pbill_vocher_date));
        } ?></h2></td>
  
    </tr>

    <?php }?>
    
</table>
               <table id="maintable" class="table table-bordered table-striped dataTable no-footer" >
<thead>   <tr>
                    <th width='15%'> </th>
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
                                    
                                </tr>
  </thead>                  <?php $k =0; foreach ($pay_salary as $key => $pay) { $k++; 
                                      ?>
                          <tr id="<?php echo $pay->pay_id; ?>">
                           

                                  <td ><?php echo $k;?>
</td>
                                        <td width='25%'><?php $firstdigit= substr($pay->pay_emp_unique_id, 0, 1); if($firstdigit == 5 ){$a = 0; }else{$a = "";}echo $a.$pay->pay_emp_unique_id;    ?></td>
                                 <td ><?php echo emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?></td>
                                  
                                  
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                           
                                    <th width='25%'>
                       
                                      <?php echo $pay->pay_gpf; ?>
                                   

                                  </div>


                                    </th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>

                                   <th width="15%">
                                <div class="username<?php echo $pay->pay_id; ?>" id="pay_special" > 

                                    <?php echo  $pay->pay_gpf_adv; ?> </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gpf_adv" value="<?php echo $pay->pay_gpf_adv;  ?>" name="pay_gpf_adv"  >

                                  </div>
                                  </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                   <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                    <th width='5%'><?php echo   $pay->pay_dpf ?>

                                         </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf_adv" value="<?php echo $pay->pay_dpf;  ?>" name="pay_dpf"  >

                                  </div>

                                    </th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'>
                                       <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo   $pay->pay_dpf_adv ?>
                                    </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_dpf_adv" value="<?php echo $pay->pay_dpf_adv;  ?>"  name="pay_dpf_adv" >

                                  </div>
                                    </th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>

                                    <th width="10%">
                                      <div class="username<?php echo $pay->pay_id; ?>" id="pay_special"> 

                                      <?php echo $pay->pay_gias ?> 
                                           </div>
                                   <div class="username1<?php echo $pay->pay_id; ?>" style="display:none" >
                                    <input type="numbar" id="pay_gias" value="<?php echo $pay->pay_gias;  ?>" name="pay_gias"  >

                                  </div>

                                    </th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'>
                                      <?php echo $pay->pay_defined_contribution ?>
                                                                              </th>
                       

                        

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'>
                               
                                  <?php echo $pay->pay_house_rent ?>
                                
                                </th>

                         
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%">

                                     
                                    <?php echo $pay->pay_fuel_charge; ?>
                                  
                                  </th>

                                         


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'>
                                     
                                      <?php echo $pay->pay_professional_tax; ?>
                                     

                                    </th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="10%">
                                  
                                  <?php echo $pay->pay_income_tax ?>
 
                                </th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'>
                                 
                                      <?php echo $pay->pay_other_adv ?>
                                      

                                    </th>

                                    <?php } ?>
                                   <th width="15%"><?php echo $pay->pay_total_cut; ?></th>
                                    <th width="15%">                           
                                      <?php echo $pay->pay_total ?>
                              
                                   </th>
                                 
                                     


                                </tr>
                         
  <?php }  ?><tfoot>
      <tr style="
    background-color: #8BC34A;
    font-size: 16px;
    font-weight: bold;    color: #000;">

                                  
                              
                                    <th width="10%"></th>
                                     <th width="10%"></th>
                                     <th width="10%">Total </th>
                     <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th width='25%'><?php echo  @sumcolumn("pay_gpf" ,$this->uri->segment("3"),$this->uri->segment("4"))['val']; ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th width="15%"><?php echo  @sumcolumn("pay_gpf_adv" ,$this->uri->segment("3"),$this->uri->segment("4"))['val']; ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th width='5%'><?php echo    sumcolumn("pay_dpf" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'><?php echo   sumcolumn("pay_dpf_adv" ,$this->uri->segment("3"),$this->uri->segment("4"))['val']  ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th width="10%"><?php echo   sumcolumn("pay_gias" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'><?php echo sumcolumn("pay_defined_contribution" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>
                                 
                                       
                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'><?php echo sumcolumn("pay_house_rent" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th width='25%'><?php echo sumcolumn("pay_grain_adv" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%"><?php echo  sumcolumn("pay_fuel_charge" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th width='25%'><?php echo  sumcolumn("pay_festival_adv" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'><?php echo sumcolumn("pay_professional_tax" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="10%"><?php echo  sumcolumn("pay_income_tax" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'><?php echo sumcolumn("pay_other_adv" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>

                                    <?php } ?>
                                   <th width="15%"><?php echo sumcolumn("pay_total_cut" ,$this->uri->segment("3"),$this->uri->segment("4"))['val'] ?></th>
                                   <th width="15%"><?php echo sumcolumn("pay_total" ,$this->uri->segment("3"),$this->uri->segment("4"))['val']  ?></th>
                              
                             

                                </tr></tfoot>

                    
</table>

                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">अवकाश स्वीकृत करें</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>leave/leave_approve/approve" accept-charset="UTF-8" role="form" class="form-signin" method="post" id="aer">
                    <div class="modal-body">
					<h3>बचे हुए अवकाश</h3>
					<div class="user_leave_details"></div>
						<input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश स्वीकृति का कारण</label>
                        <textarea name="approve_reson" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btnapprove">जमा करें</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- Modal deny-->
<div class="modal fade" id="denyModal" tabindex="-1" role="dialog" aria-labelledby="denyModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('pay_slip')?></h4>
            </div>
            <div class="modal-body">
                <form action="" >
                    <div class="modal-body">
					<h3><?php ?></h3>
						<div class="user_leave_details"></div>
                        <input type="hidden" name="leaveID" id="leaveID" class="leaveID" value="">
                        <label>अवकाश अस्वीकृति का कारण</label>
                        <textarea name="deny_reson" class="form-control" required=""></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">रद्द</button>
                        <button type="submit" class="btn btn-primary" name="btndeny">जमा करे</button>
                    </div>
                </form>
            </div>      
        </div>
    </div>
</div>
<script type="text/javascript">
    function is_delete() {
        var res = confirm('<?php echo $this->lang->line("delete_confirm_message"); ?>');
        if (res === false) {
            return false;
        }
    }



</script>
