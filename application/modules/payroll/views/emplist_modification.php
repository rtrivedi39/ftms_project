
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
<?php foreach ($pay_salary as $key => $value) {



 # code...
}?>
<!-- Main content -->
<section class="content">
        <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title_tab; ?></h3>                 
                    </div>
                   
                    <div class="box-body">
                        <?php //echo $this->session->flashdata('message'); ?>
                        <table  class="table">
                            <thead>
                                <tr>
                                    
                                    <th width='5%'><?php echo $this->lang->line('sno')  ?></th>
                                    <th width='25%'><?php echo $this->lang->line('emp_unique_code')  ?></th>
                                  
                           <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th width='25%'><?php  echo $this->lang->line('basic_pay');  ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th width="10%"><?php echo  $this->lang->line('pay_gradepay');  ?></th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th width='25%'><?php echo  $this->lang->line('pay_special');   ?></th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th width="15%"><?php  echo  $this->lang->line('pay_da');?></th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th width='5%'><?php echo $this->lang->line('pay_others'); ?></th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_sa');  ?></th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th width="10%"><?php echo  $this->lang->line('pay_ma'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th width='5%'><?php echo $this->lang->line('pay_sp'); ?></th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_ca');?></th>
                                  
                                    <?php } ?>
                            <th width='25%'><?php echo $this->lang->line('pay_sum'); ?></th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th width='25%'><?php echo  $this->lang->line('pay_gpf'); ?></th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th width="15%"><?php  echo $this->lang->line('pay_gpf_adv');  ?> </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th width='5%'><?php  echo $this->lang->line('pay_dpf'); ?></th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_dpf_adv');   ?></th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th width="10%"><?php  echo $this->lang->line('pay_gis');?></th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'><?php echo $this->lang->line('pay_define')."dsf"; ?></th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th width='25%'><?php echo $this->lang->line('pay_home_loan');?></th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th width='25%'><?php echo $this->lang->line('pay_car_loan');?></th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'><?php echo $this->lang->line('pay_house_rent'); ?></th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th width='25%'><?php echo $this->lang->line('pay_grain_adv'); ?></th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%"><?php echo $this->lang->line('pay_fule_charge'); ?></th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th width='25%'><?php echo $this->lang->line('pay_festival_adv');  ?></th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'><?php echo $this->lang->line('pay_professional_tax'); ?></th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="10%"><?php echo  $this->lang->line('pay_income_tax'); ?></th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'><?php echo  $this->lang->line('pay_other_adv'); ?></th>

                                    <?php } ?>
                                   <th width="15%"><?php echo $this->lang->line('pay_total_cut'); ?></th>
                                   <th width="15%"><?php echo $this->lang->line('pay_amount');  ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  $k = 0;
                              // pre($pay_regi);
                               foreach ($pay_salary_master as $key => $value) {
                                 # code...
                               
                                foreach ($pay_salary as $key => $pay) { 
                                    if($pay->pay_emp_unique_id == $value->pay_emp_unique_id) {
                                  $k++; 
                                   // 
                                  //$last_month = Date('F', strtotime($value->pay_month . " last month"));
                                   ?>
								    <tr>
                                  
                                    <th width='5%'><?php echo $k  ?></th>
                                    <th width='25%'><?php echo  get_tr_unicode($pay->emp_unique_id); ?></th>
                                
                                        <?php if($dataval[0]['pay_cate_basic'] == 1){  ?>
                            <th width='25%'><?php if($pay->pay_basic == $value->pay_basic) {

                              echo "-";  
                            }else{
                               echo "<strong>".$pay->pay_basic."</strong>";  
                            }

      
                            ?></th>
                                 <?php }if($dataval[0]['pay_cate_grp'] == 1){  ?>
                                    <th width="10%"><?php  ?>
<?php if($pay->pay_grp == $value->pay_grp) {

                              echo "-";  
                            }else{
                               echo "<strong>".$pay->pay_grp."</strong>";  
                            }

      
                            ?>
                                    </th>
                              <?php }if($dataval[0]['pay_cate_special'] == 1){  ?>
                                    <th width='25%'>

<?php if($pay->pay_special == $value->pay_special) {

                              echo "-";  
                            }else{
                               echo "<strong>".$pay->pay_special."</strong>";  
                            }

      
                            ?>
                                    </th>
                                    <?php }if($dataval[0]['pay_cate_da'] == 1){  ?>
                                   <th width="15%">

                    <?php if($pay->pay_da == $value->pay_da) {

                              echo "-";  
                            }else{
                               echo "<strong>".$pay->pay_da."</strong>";  
                            }

      
                            ?>
                                   </th>
                                   <?php }if($dataval[0]['pay_cate_other_add'] == 1){  ?>
                                    <th width='5%'>

                                        <?php if($pay->pay_others == $value->pay_others) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_others."</strong>";  
                                            }

      
                                     ?>
                                    </th>
                                              <?php }if($dataval[0]['pay_cate_sa'] == 1){  ?>
                                    <th width='25%'>
                              <?php if($pay->pay_sa == $value->pay_sa) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_sa."</strong>";  
                                            }

      
                                     ?>
                                    </th>
                                     <?php }if($dataval[0]['pay_cate_madical'] == 1){  ?>
                                    <th width="10%"><?php  ?>

   <?php if($pay->pay_madical == $value->pay_madical) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_madical."</strong>";  
                                            }

      
                                     ?>
                                    </th>

                                     <?php }if($dataval[0]['pay_cate_sp'] == 1){  ?>
                                     <th width='5%'>

                        <?php if($pay->pay_sp == $value->pay_sp) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_sp."</strong>";  
                                            }

      
                                     ?>

                                     </th>

                                           <?php }if($dataval[0]['pay_cate_ca'] == 1){  ?>
                                    <th width='25%'>    <?php if($pay->pay_ca == $value->pay_ca) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_ca."</strong>";  
                                            }

      
                                     ?></th>
                                  
                                    <?php } ?>
                            <th width='25%'>
                                         <?php if($pay->pay_total_sum == $value->pay_total_sum) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_total_sum."</strong>";  
                                            }

      
                                     ?>
                             </th>
                             <?php if($dataval[0]['pay_cate_gpf'] == 1){  ?>
                                    <th width='25%'>

                                        <?php if($pay->pay_gpf == $value->pay_gpf) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_gpf."</strong>";  
                                            }
     
                                     ?>

                                    </th>
                                    <?php }if($dataval[0]['pay_cate_gpf_adv'] == 1){  ?>
                                   <th width="15%">

                                            <?php if($pay->pay_gpf_adv == $value->pay_gpf_adv) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_gpf_adv."</strong>";  
                                            }
     
                                     ?>
                                    </th>
                                   <?php }if($dataval[0]['pay_cate_dpf'] == 1){  ?>
                                    <th width='5%'>
                                            <?php if($pay->pay_dpf == $value->pay_dpfpay_dpf) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_dpf."</strong>";  
                                            }
     
                                     ?>

                                    </th>

                                     <?php }if($dataval[0]['pay_cate_dpf_adv'] == 1){  ?>
                                    <th width='25%'>
                                      <?php if($pay->pay_dpf_adv == $value->pay_dpf_adv) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_dpf_adv."</strong>";  
                                            }
     
                                     ?>
                                    </th>
                                     <?php }if($dataval[0]['pay_cate_gias'] == 1){  ?>
                                    <th width="10%">

                                          <?php if($pay->pay_gias == $value->pay_gias) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_gias."</strong>";  
                                            }
     
                                     ?>
                                    </th>
                                    <?php }if($dataval[0]['pay_cate_defined_contribution'] == 1){  ?>
                                    <th width='25%'>
                                               <?php if($pay->pay_defined_contribution == $value->pay_defined_contribution) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_defined_contribution."</strong>";  
                                            }
     
                                     ?>

                                    </th>
                                 
                                        <?php }if($dataval[0]['pay_cate_house_loan'] == 1){  ?>
                            <th width='25%'>

                                          <?php if($pay->pay_house_loan == $value->pay_house_loan) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_house_loan."</strong>";  
                                            }
     
                                     ?>
                            </th>

                            <?php }if($dataval[0]['pay_cate_car_loan'] == 1){  ?>


                                    <th width='25%'>

                                              <?php if($pay->pay_car_loan == $value->pay_car_loan) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_car_loan."</strong>";  
                                            }
     
                                     ?>

                                    </th>

                                        <?php }if($dataval[0]['pay_cate_house_rent'] == 1){  ?>
                                <th width='25%'>
                                            <?php if($pay->pay_house_rent == $value->pay_house_rent) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_house_rent."</strong>";  
                                            }
     
                                     ?>

                                </th>

                             <?php }if($dataval[0]['pay_cate_garain_adv'] == 1){  ?>
                                
                                     <th width='25%'>
                                    <?php if($pay->pay_grain_adv == $value->pay_grain_adv) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_grain_adv."</strong>";  
                                            }
     
                                     ?>
                                     </th>
                                
                                
                                     <?php }if($dataval[0]['pay_cate_fuel_charge'] == 1){  ?>

                                   <th width="15%">
                                     <?php if($pay->pay_fuel_charge == $value->pay_fuel_charge) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_grain_adv."</strong>";  
                                            }
     
                                     ?>



                                   </th>

                                         <?php }if($dataval[0]['pay_cate_festival_adv'] == 1){  ?>

                            <th width='25%'>
                                  <?php if($pay->pay_festival_adv == $value->pay_festival_adv) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_festival_adv."</strong>";  
                                            }
     
                                     ?>


                            </th>


                                      <?php }if($dataval[0]['pay_cate_professional_tax'] == 1){  ?>

                                    <th width='5%'><?php echo $pay->pay_professional_tax; ?>
                                         <?php if($pay->pay_professional_tax == $value->pay_professional_tax) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_professional_tax."</strong>";  
                                            }
     
                                     ?>


                                    </th>

                                      <?php }if($dataval[0]['pay_cate_income_tax'] == 1){  ?>

                                <th width="10%">
                                  <?php if($pay->pay_income_tax == $value->pay_income_tax) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_income_tax."</strong>";  
                                            }
     
                                     ?>


                                </th>

                            
                                  <?php }if($dataval[0]['pay_cate_other_adv'] == 1){  ?>

                                    <th width='25%'>

                                          <?php if($pay->pay_other_adv == $value->pay_other_adv) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_other_adv."</strong>";  
                                            }
     
                                     ?>

                                    </th>

                                    <?php } ?>
                                   <th width="15%">
                                               <?php if($pay->pay_total_cut == $value->pay_total_cut) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_total_cut."</strong>";  
                                            }
     
                                     ?>

                                   </th>
                                   <th width="15%">
                                <?php if($pay->pay_total == $value->pay_total) {

                                              echo "-";  
                                            }else{
                                               echo "<strong>".$pay->pay_total."</strong>";  
                                            }
     
                                     ?>






                                   </th>
                                </tr>

                                <?php   } } } ?>
                                
                            </tbody>
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
