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
                    <h3 class="box-title"><?php //echo $title_tab_header;     ?></h3>
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
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('bulk_action'); ?> </label>
                            </div>
                          
                          
                        </div>
                    </div>
                    <div class="box-body">
                            <form action="<?php echo base_url();?>payroll/post_adv" method="post" >
                  
              <div class="form-group">
                <label for="email"><?php echo $this->lang->line('adv_name')  ?></label>
                <input type="text" class="form-control" name="adv_name_hi" id="adv_name_hi">
              </div>
			             
              <div class="form-group">
                <label for="email"><?php echo $this->lang->line('adv_name_en')  ?></label>
                <input type="text" class="form-control" name="adv_name_en" id="adv_name_hi">
              </div>
             <div class="form-group">
                <label for="email"><?php echo $this->lang->line('advance_amount')  ?></label>
                <input type="text" class="form-control" name="adv_amount" id="adv_amount">
              </div>
              <div class="checkbox">
        <label for="email"><?php echo $this->lang->line('adv_no_installment')  ?></label>
                <input type="text" class="form-control" name="adv_no_installment" id="adv_no_installment">
              </div>

               <div class="checkbox">
                <label for="email"><?php echo $this->lang->line('adv_intrest')  ?></label>
                <input type="text" class="form-control" name="adv_intrest" id="adv_intrest">
              </div>

             


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
