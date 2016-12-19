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
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title"><?php echo $title_tab;     ?></h3>
                </div>
                <div class="box-body">
                    <?php $this->load->view('payroll_header') ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Your Page Content Here -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
            
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title_tab; ?></h3>                 
                    </div>
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-xs-2">
                                <label for="exampleInputEmail1"><?php //echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                      <?php foreach ($pay_salary as $key => $pay) {?>
                      
                    
                            <form action="<?php echo base_url();?>payroll/edit_head" method="post" >
                  <input type="hidden" name="pay_cate_id" id="pay_cate_id" value="<?php echo $pay->pay_cate_id;  ?>" class="form-control">
                 
              <div class="form-group">
                <label for="email"><?php echo $this->lang->line('salary_head_name')  ?></label>
                <input type="text" class="form-control" value="<?php echo $pay->pay_cate_name ;?>" name="pay_cate_name" id="pay_cate_name">
              </div>
             
              <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_basic" <?php if($pay->pay_cate_basic == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_da"  <?php if($pay->pay_cate_da == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_da'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_grp" <?php if($pay->pay_cate_grp == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_gradepay'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_hra"  <?php if($pay->pay_cate_hra == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_hra'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox"  name="pay_cate_special" <?php if($pay->pay_cate_special == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_special'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_sa"  <?php if($pay->pay_cate_sa == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_sa'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_sp"  <?php if($pay->pay_cate_sp == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_sp'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_ca"  <?php if($pay->pay_cate_ca == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_ca'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_madical" <?php if($pay->pay_cate_madical == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_ma'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_gpf" <?php if($pay->pay_cate_gpf == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_gpf'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_gpf_adv"  <?php if($pay->pay_cate_gpf_adv == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_gpf_adv'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_dpf" <?php if($pay->pay_cate_dpf == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_dpf'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_dpf_adv" <?php if($pay->pay_cate_dpf_adv == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_dpf_adv'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_gias" <?php if($pay->pay_cate_gias == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_gis'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_defined_contribution"   <?php if($pay->pay_cate_defined_contribution == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_define'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_house_loan"  <?php if($pay->pay_cate_house_loan == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_home_loan'); ?></label>
              </div>

             <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_house_rent"  <?php if($pay->pay_cate_house_rent == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_house_rent'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_car_loan"  <?php if($pay->pay_cate_car_loan == 1) { ?>checked <?php }?>   value="1"> <?php echo $this->lang->line('pay_car_loan'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_fuel_charge" <?php if($pay->pay_cate_fuel_charge == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_fule_charge'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_professional_tax"  <?php if($pay->pay_cate_professional_tax == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_professional_tax'); ?></label>
              </div>


               <div class="checkbox">
                <label><input type="checkbox" name="pay_cate_income_tax"  <?php if($pay->pay_cate_income_tax == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_income_tax'); ?></label>
              </div>

               <div class="checkbox">
                <label><input type="checkbox"  name="pay_cate_festival_adv" <?php if($pay->pay_cate_festival_adv == 1) { ?>checked <?php }?>  value="1"> <?php echo $this->lang->line('pay_festival_adv'); ?></label>
              </div>
             <div class="checkbox">
                <label><input type="checkbox"  name="pay_cate_garain_adv" <?php if($pay->pay_cate_garain_adv == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_grain_adv'); ?></label>
              </div>
               <div class="checkbox">
                <label><input type="checkbox"  name="pay_cate_other_adv" <?php if($pay->pay_cate_other_adv == 1) { ?>checked <?php }?> value="1"> <?php echo $this->lang->line('pay_other_adv'); ?></label>
              </div>



<?php } ?>
              </div>

              <button type="submit" class="btn btn-default">Submit</button>
</form>
                    </div><!-- /.box-body -->
                </form>
            </div><!-- /.box -->
        </div>
    </div><!-- /.row -->
    <!-- Main row -->
</section><!-- /.content -->

<!-- Modal approve -->
