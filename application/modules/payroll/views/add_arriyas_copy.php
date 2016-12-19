<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php //echo $title; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php //echo $title; ?></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h1 ><?php echo " वेतन एरियर्स  डी. ए . ".$_GET['pay_month']." ".$_GET['pay_year']." - ".$_GET['pay_month_end']." ". $_GET['pay_year_end'];?>
                      </h1>
                </div>
                <div class="box-body">
                    <h3 style="text-align: right;"><?php echo "वित्त विभाग  का आदेश नंबर :- ".$_GET['orderno'];?></h3>
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

                        
                        <div class="fix_table-container">
						<form  id="emp" action="<?php echo base_url();?>payroll/epayment/?cate_id=<?php echo $_GET['cate_id']?>&pay_month=<?php echo $_GET['pay_month']?>&pay_year=<?php echo $_GET['pay_year']?>&pay_month_end=<?php echo $_GET['pay_month_end']?>&pay_year_end=<?php echo $_GET['pay_year_end']?>" method="post">
                         
<table id="" class="" cellspacing="0" width="100%" style="font-size:12px">
  
<thead style="background:white" >
      <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22">  <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button>  </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center"><p>GPF Months</p>
        <p> 
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="gpf[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><p>Epayment
        Months</p>
        <p>
            <?php foreach($months as $mm){  $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];?>       
            <input type="checkbox" name="epayment[]" value="<?php echo $pay_da;?>" /> 
            <?php echo $pay_da;?>
            <?php } ?>
          </p></td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr>
<?php } ?>
                                <tr>
                                    
                                    <th ><?php echo "क्र."  ?></th>
                                    <th ><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                    <th ><?php echo $this->lang->line('emp_name')." (पद) "; ?></th>
                                  <th ><?php echo $this->lang->line('emp_pay_month'); ?></th>
                                    <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th ><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th ><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                
                                    <th ><?php echo  $this->lang->line('pay_da')."[".getdavalback($_GET['cate_id'])[0]->salary_da." % ]"; ;  ?></th>
                     <?php } ?>
                            <th > <?php  echo  " नया ".$this->lang->line('pay_da')."[".getdavalnew($_GET['cate_id'])[0]->salary_da." % ]";    ?></th>
                             
                                  
                                   <th ><?php echo "एरियर्स"; ?></th>
                                </tr>
                              </thead>

   <tbody>      
                
                                    <?php $k = 1;$sap = $totalmonth  ; $totalda = 0; foreach ($getemp as $key => $pay) {  
                                       ?>    
                          <tr id="<?php echo $pay->pay_id; ?>">
                                 
       
                                                             
                                    <th  ><?php echo $k; ?></th>
                                    <th ><?php echo $pay->emp_unique_id;  ?></th>
                                    <th ><?php echo @get_employee_gender($pay->emp_id)." ".$pay->emp_full_name_hi." <br/>  (". get_employee_designation_id($pay->emp_id).")"; ?></th>
                                 <th ><?php echo date("M",strtotime($pay->pay_month))." ".$pay->pay_year; ?></th>
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){ 
                                          
                                         ?>
                                  
                                       
                           <th style="padding:0;"> <?php echo $pay->pay_basic;  ?>                            </th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                 
                                       
                           <th style="padding:0;"> <?php echo $pay->pay_grp;  ?>                                    </th>
                              
                                              <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                
                                    <th ><?php echo   $pay->pay_da;  ?></th>
                     <?php } ?>

                            <th style="padding:0;"><?php echo $newda = round((($pay->pay_basic + $pay->pay_grp)* getdavalnew($_GET['cate_id'])[0]->salary_da)/100); ?></th>
                                                
                                   <th colspan="3" ><?php echo $ddda = $newda - $pay->pay_da;  
                                         $totalda =  $totalda +  $ddda ;  ?>
                                          <input name="damonths[]" id="<?php echo $sap; ?>" value="<?php echo $ddda."|". $pay->emp_unique_id."|".$pay->pay_month; ?>" type="hidden" >                                     </th>                                     </th></th>
                                 
                               <input name="sap" id="<?php echo $sap; ?>" value="<?php echo $sap; ?>" type="hidden" ><input name="orderno" id="<?php echo $sap; ?>" value="<?php echo $_GET['orderno']; ?>" type="hidden" >
                          </tr>   
                          <?php if($k == $sap ){ $sap = $totalmonth +  $sap  ; ?>

 <tr  id="<?php echo $pay->pay_id; ?>" style="    background-color: #4CAF50;color: #000;border: 1px solid #000;
">
<th colspan="22" style="text-align: right;"> कुल एरियर्स :- <?php echo $totalda ; ?> <input name="da[]" id="<?php echo $sap; ?>" value="<?php echo $totalda."|". $pay->emp_unique_id; ?>" type="hidden" ></th>
 </tr>
                            <?php  $totalda = 0;  }?>
                         
  <?php $k++; }  ?> </tbody> 

<tfoot>
  <?php if($_GET['cate_id'] == 1 || $_GET['cate_id'] == 2 ){ ?>
<tr>

<th colspan="22"> <button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1">
  Apply Payment</button> </th>
 </tr>
<?php }else{ ?>
<tr>

<th colspan="18"> 
  <table width="100%" border="0" align="center">
    <tr>
      <td align="center">GPF Months  <?php foreach($months as $mm){ 
       $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];
   ?>       
        <input type="checkbox"name="gpf[]" value="<?php  echo $pay_da; ?>" /> <?php  echo $pay_da; ?>
		  <?php } ?>		</td>
      <td align="center">Epayment
   Months 
   <?php pre($months); foreach($months as $mm){ 

      $nn = explode("|", $mm['month']);
    $pay_da = $nn[0];
   ?>
         <input type="checkbox" name="epament[]" value="<?php  echo $pay_da; ?>" /> <?php  echo $pay_da ?> , 
		 <?php } ?>        </td>
      <td align="center"><button class="btn btn-primary" onclick="onsumitsalary()" type="submit" name="savenotice" id="savenotice"  value="1"> Apply Payment</button></td>
    </tr>
  </table></th> 
 </tr
><?php } ?>
</tfoot>  
</table>
<div id="bottom_anchor"></div>
</div>



</form>       
    </div>
</div>
  </div>
    </div>
  </section>
  <script type="text/javascript">

function onsumitsalary(id)
{
   var r = confirm("कृपया सुनिश्चित करें कि डेटा सही है अथवा नहीं");
    if (r == true) {
      $
        document.getElementById("emp").submit();


    } else {
        txt = "You pressed Cancel!";
    }
  

}
  </script>