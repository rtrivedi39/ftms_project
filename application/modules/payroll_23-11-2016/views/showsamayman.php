<section class="content-header">
    <h1>
        <?php echo "समय मान"; ; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><?php echo "समय मान"; ?></li>
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
                        <h1 class="box-title"><?php echo  "समय वेतनमान के अन्तगर्त वेतन नियतन पत्रक"; ?></h1>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
 <div class="col-xs-12">
                          <div class="box-tools pull-left">
  <a href="<?php echo base_url()?>payroll/add_samaymaan/<?php echo "?uid=".$_GET['uid']?>">
                            <button type="button" class="btn  btn-info"><?php echo "समयमान जोड़े" ?></button>
                        </a>
                        </div>
                         <div class="box-tools pull-right">
           
            
                        <a href="javascript:history.go(-1)">
                            <button type="button" class="btn  btn-warning"><?php echo $this->lang->line('Back_button_label'); ?></button>
                        </a>
                    </div>
                          
        
                        </div>
                    </div>
 </div>

                    <div class="box-body">
					 <table width="100%" border="1" cellpadding="0" cellspacing="0">
 <?php foreach ($pay_salary as $key => $pay) {?>
 

  <tr>

    <td>नाम</td>
    <td><?php echo  get_employee_gender(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id) ." ". emp_nmae($pay->pay_emp_unique_id)[0]->emp_full_name_hi; ?>
                                </td>
  </tr>
  <tr>
    <td>  पदनाम</td>
    <td><?php echo  get_employee_role(emp_nmae($pay->pay_emp_unique_id)[0]->emp_id);?></td>
  </tr>
  <tr>
  
    <td>  समयमान के पूर्व प्राप्त (<?php if($pay->pay_emp_samay_man == 2){echo "द्वितीय";} ?>) वेतनमान / वेतन</td>
    <td><?php echo "15600 + 39100 +6600 ग्रेड पे" ;?></td>
  </tr>
  <tr>
   
    <td>समयमान वेतनमान पूर्व प्राप्त पुनरीक्षण

वेतन बैड मे वेतन एवं ग्रेड पे</td>
    <td><?php echo getoldsalry($pay->pay_emp_unique_id)[0]->pay_basic ." + ". getoldsalry($pay->pay_emp_unique_id)[0]->pay_grp." ग्रेड पे "; ?></td>
  </tr>
  <tr>
   
    <td>  दिनाक [ 1-7-2014] को मूल वेतन (वेतन +ग्रेड पे) </td>
  
  <td><?php echo getoldsalry($pay->pay_emp_unique_id)[0]->pay_basic ." + ". getoldsalry($pay->pay_emp_unique_id)[0]->pay_grp." ग्रेड पे "; ?></td>
  </tr>
  <tr>
    
    <td>  समयमान वेतन (<?php if($pay->pay_emp_samay_man == 2){echo "तृतीय";}?>) </td>
    <td><?php echo "15600 + 39100 +6600 ग्रेड पे" ;?></td>
  </tr>
  <tr>
    
    <td>समयमान वेतनमान दिये जाने कि तिथि </td>
    <td><?php echo "1-7-2014";?></td>
  </tr>
  <tr>

    <td>समयमान वेतनमान मे निर्धारण वेतन </td>
    <td><?php echo getoldsalry($pay->pay_emp_unique_id)[0]->pay_basic ." + ". getoldsalry($pay->pay_emp_unique_id)[0]->pay_grp." ग्रेड पे "; ?></td>
  </tr>
 <tr>
  
    <td></td>
    <td><?php echo $pay->pay_remark;?></td>
  </tr>
<tr>
    <td colspan="2"><table width="100%" border="1" cellpadding="&#2406;" cellspacing="0">
  <tr>
    <td>वेतन नियमन दिनाक</td>
    
    <td>समयमान वेतनमान मूल वेतन</td>
    <td>समयमान वेतनमान ग्रेड पे</td>
    <td>समयमान वेतनमान रिमार्क</td>
  </tr>
  <tr>
    <td><?php echo $pay->pay_emp_date;?></td>
   
    <td><?php echo $pay->pay_basic_new;?></td>
    <td><?php echo $pay->pay_grp_new;?></td>
    <td><?php echo $pay->pay_remark;?></td>
  </tr>

</table></td>
  </tr> <td>
 <?php } ?>
</table>
                 
            </div><!-- /.box --></div>
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->

