
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?php  $dd_key = $this->uri->segment(3);
			echo   "अग्रमी";
         ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">  <?php  echo   "अग्रमी"; ?></li>
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
                         </div>
                   
                    <div class="box-body">
                       <h1>      <?php 
echo  "अग्रमी";
         ?>    </h1><div class="box-tools pull-right">
                     <!--   <button onclick="printContents('divname')" class="btn btn-primary btn-sm no-print">Print</button>
                         --> 
                    <a href="<?php echo base_url() ?>payroll/add_employee_adv">
                      <button class="btn btn-block btn-info">ऐड नई रिकॉर्ड </button>
                    </a>
                         <button class="btn  btn-warning" title="Back" onclick="goBack()">पिछले पेज में वापस जायें</button>
                    </div>

                    <div id="divname">
   <table id="leave_employee" class="table table-bordered table-striped display">
    <thead>     
        <tr>  <th width='15%'> </th>
         <th width='20%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
         <th width="20%"><?php echo $this->lang->line('emp_name')."[अधिकारी / कर्मचारी पद]"; ?></th>
          <th width='20%'><?php echo "अग्रमी हेड"  ?></th>
             <th width='20%'><?php echo "स्वीकृत अग्रिम/ब्याज सहित कुल कटोती  की जाने वाली राशि

"  ?></th> 
               <th width='20%'><?php echo "कटोती  का माह"  ?></th> 
                  <th width='20%'><?php echo "कुल कटोती  की राशि"  ?></th> 
           </tr>
</thead> <?php $k =0; //pre($emp);
 foreach ($pay_salary as $key => $pay) { $k++; ?>
    <tr id="<?php echo $pay->pea_id; ?>">
                                     <td ><?php echo $k ;?> </td>
                                      <td> <?php  echo  get_tr_unicode($pay->pea_emp_unique_id);   ?></td>
                                      <td ><?php echo get_employee_gender(emp_nmae($pay->pea_emp_unique_id)[0]->emp_id) ." ". emp_nmae($pay->pea_emp_unique_id)[0]->emp_full_name_hi." <br/>  (". get_employee_designation_id(emp_nmae($pay->pea_emp_unique_id)[0]->emp_id).")";  ?></td>
                                   <td ><?php $adv_nme=  get_adv_name($pay->pea_type_id); echo $adv_nme['adv_name_hi']; ?></td>
                                       <td ><?php echo $pay->pea_amount; ?></td>
                                   <td ><?php echo date("F",strtotime($pay->pea_starting_month)); ?></td>
                                   <td ><?php echo $pay->pea_emi_amount;  ?></td>
                                   <td ><?php echo ""; ?></td>
                                    </tr>
                                    <?php } ?>
</table> 

                        </div>

                    </div><!-- /.box-body -->
              
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

