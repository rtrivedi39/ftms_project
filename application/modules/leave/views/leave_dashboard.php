<div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                  <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=cl"><h3><?php echo isset($leaves->cl_leave) ? $leaves->cl_leave : ''; ?></h3></a>
                  <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=cl"><p><?php echo $this->lang->line('reaming_cl'); ?></p></a>
                </div> 
                
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=ol"><h3><?php echo isset($leaves->ol_leave) ? $leaves->ol_leave : ''; ?></h3></a>
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=ol"><p><?php echo $this->lang->line('reaming_ol'); ?></p></a>
                </div>  
                
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=el"><h3><?php echo isset($leaves->el_leave) ? calculate_el($leaves->el_leave) : ''; ?></h3></a>
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=el"><p><?php echo $this->lang->line('reaming_el'); ?></p></a>
                </div>      
                
            </div>
        </div><!-- ./col -->
		 <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=hpl"><h3><?php echo isset($leaves->el_leave) ? $leaves->hpl_leave.' ('.calculate_hpl($leaves->hpl_leave) .')' : ''; ?></h3></a>
                    <a class="small-box-footer leave_font_dashboard" href="<?php echo base_url(); ?>leave/add_leave?type=hpl"><p><?php echo $this->lang->line('reaming_hpl'); ?> (<?php echo $this->lang->line('reaming_commuted'); ?>)</p></a>
                </div> 
             
            </div>
        </div><!-- ./col -->